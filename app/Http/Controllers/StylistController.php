<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StylistController extends Controller
{
    public function index(): View
    {
        return view('admin.stylists.index', [
            'stylists' => Stylist::orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        $categories = \App\Models\Category::whereNotNull('parent_category')->pluck('parent_category')->unique();
        return view('admin.stylists.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Stylist::create($validated);

        return redirect()->route('admin.stylists.index')
            ->with('success', 'Stylist berhasil ditambahkan.');
    }

    public function edit(Stylist $stylist): View
    {
        $categories = \App\Models\Category::whereNotNull('parent_category')->pluck('parent_category')->unique();
        return view('admin.stylists.edit', compact('stylist', 'categories'));
    }

    public function update(Request $request, Stylist $stylist): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $stylist->update($validated);

        return redirect()->route('admin.stylists.index')
            ->with('success', 'Data stylist berhasil diperbarui.');
    }

    public function toggleStatus(Stylist $stylist): RedirectResponse
    {
        $stylist->update([
            'status' => $stylist->status === 'active' ? 'inactive' : 'active',
        ]);

        return back()->with('success', 'Status stylist berhasil diubah.');
    }

    public function destroy(Stylist $stylist): RedirectResponse
    {
        if ($stylist->reservations()->exists()) {
            return back()->with('error', 'Stylist tidak dapat dihapus karena memiliki riwayat reservasi.');
        }

        $stylist->delete();

        return redirect()->route('admin.stylists.index')
            ->with('success', 'Stylist berhasil dihapus.');
    }
}
