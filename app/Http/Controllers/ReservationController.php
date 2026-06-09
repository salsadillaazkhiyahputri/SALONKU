<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function customerDashboard(): View
    {
        $superCategories = \App\Models\Category::with(['services' => function ($query) {
            $query->where('is_active', true)->orderBy('name');
        }])->get()->groupBy('parent_category');

        return view('customer.dashboard', [
            'superCategories' => $superCategories,
        ]);
    }

    public function index(): View
    {
        $user = auth()->user();

        return view('customer.reservations.index', [
            'reservations' => $user->reservations()
                ->with(['services', 'stylists'])
                ->latest()
                ->get(),
            'history' => $user->reservations()
                ->with(['services', 'stylists'])
                ->where('status', Reservation::STATUS_COMPLETED)
                ->latest()
                ->get(),
        ]);
    }

    public function create(Request $request): View
    {
        $categories = \App\Models\Category::with(['services' => function ($query) {
            $query->where('is_active', true)->orderBy('name');
        }])->get();

        return view('customer.reservations.create', [
            'categories' => $categories,
            'stylists' => Stylist::active()->orderBy('name')->get(),
            'selected_service' => $request->query('service_id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_ids' => ['required', 'array', 'min:1'],
            'service_ids.*' => ['exists:services,id'],
            'stylists' => ['required', 'array', 'min:1'],
            'stylists.*' => ['exists:stylists,id'],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $services = Service::whereIn('id', $validated['service_ids'])
            ->where('is_active', true)
            ->get();

        if ($services->isEmpty()) {
            return back()->withInput()->with('error', 'Layanan tidak valid atau tidak aktif.');
        }

        $stylistIds = array_values(array_unique(array_filter($validated['stylists'])));
        
        $activeStylistsCount = Stylist::whereIn('id', $stylistIds)
            ->where('status', 'active')
            ->count();

        if ($activeStylistsCount !== count($stylistIds)) {
            return back()->withInput()->with('error', 'Salah satu stylist yang dipilih tidak valid atau tidak aktif.');
        }

        $slotHashes = [];
        foreach ($stylistIds as $sId) {
            $slotHashes[$sId] = Reservation::generateSlotHash(
                $sId,
                $validated['reservation_date'],
                $validated['start_time']
            );
        }

        $totalPrice = $services->sum('price');

        try {
            DB::transaction(function () use ($validated, $services, $slotHashes, $totalPrice, $stylistIds) {
                // lockForUpdate: cegah race condition
                $conflict = DB::table('reservation_stylist')
                    ->join('reservations', 'reservations.id', '=', 'reservation_stylist.reservation_id')
                    ->whereIn('reservation_stylist.slot_hash', array_values($slotHashes))
                    ->whereIn('reservations.status', Reservation::ACTIVE_STATUSES)
                    ->lockForUpdate()
                    ->exists();

                if ($conflict) {
                    throw new \RuntimeException('SLOT_TAKEN');
                }

                $reservation = Reservation::create([
                    'user_id' => auth()->id(),
                    'reservation_date' => $validated['reservation_date'],
                    'start_time' => $validated['start_time'],
                    'total_price' => $totalPrice,
                    'status' => Reservation::STATUS_PENDING,
                    'notes' => $validated['notes'] ?? null,
                ]);

                $reservation->services()->attach($services->pluck('id')->toArray());
                
                $syncData = [];
                foreach ($stylistIds as $sId) {
                    $syncData[$sId] = ['slot_hash' => $slotHashes[$sId]];
                }
                $reservation->stylists()->attach($syncData);
            });
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'SLOT_TAKEN') {
                return back()
                    ->withInput()
                    ->with('error', 'Maaf, stylist sudah dipesan pada tanggal dan jam tersebut. Silakan pilih waktu lain.');
            }
            throw $e;
        } catch (UniqueConstraintViolationException | QueryException $e) {
            return back()
                ->withInput()
                ->with('error', 'Maaf, stylist sudah dipesan pada tanggal dan jam tersebut. Silakan pilih waktu lain.');
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    public function adminDashboard(Request $request): View
    {
        $date = $request->input('date', now()->toDateString());

        $todayReservations = Reservation::with(['user', 'services', 'stylists'])
            ->whereDate('reservation_date', $date)
            ->orderBy('start_time')
            ->get();

        $pendingReservations = Reservation::with(['user', 'services', 'stylists'])
            ->where('status', Reservation::STATUS_PENDING)
            ->latest()
            ->get();

        return view('admin.dashboard', [
            'selectedDate' => $date,
            'todayReservations' => $todayReservations,
            'pendingReservations' => $pendingReservations,
            'metrics' => [
                'total_today' => $todayReservations->count(),
                'pending' => $pendingReservations->count(),
                'confirmed_today' => $todayReservations->where('status', Reservation::STATUS_CONFIRMED)->count(),
                'completed_today' => $todayReservations->where('status', Reservation::STATUS_COMPLETED)->count(),
            ],
        ]);
    }

    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:confirmed,cancelled,completed'],
        ]);

        if ($validated['status'] === Reservation::STATUS_CANCELLED) {
            $reservation->update([
                'status' => Reservation::STATUS_CANCELLED,
            ]);
            $reservation->releaseSlot();
        } else {
            $reservation->update(['status' => $validated['status']]);
        }

        $message = match ($validated['status']) {
            'confirmed' => 'Reservasi berhasil dikonfirmasi.',
            'cancelled' => 'Reservasi berhasil ditolak/dibatalkan.',
            'completed' => 'Reservasi ditandai selesai.',
        };

        return back()->with('success', $message);
    }
}
