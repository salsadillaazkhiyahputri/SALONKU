@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-10">
    {{-- Header Section --}}
    <div class="relative overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-rose-100">
        <div class="absolute right-0 top-0 h-full w-1/2 bg-gradient-to-l from-rose-50 to-transparent"></div>
        <div class="relative flex flex-col gap-6 p-8 sm:flex-row sm:items-center sm:justify-between lg:p-10">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Halo, <span class="text-pink-600">{{ auth()->user()->name }}</span>! 👋
                </h1>
                <p class="mt-2 text-lg text-gray-600">Pantau dan kelola operasional SalonKu hari ini.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.services.index') }}"
                   class="group flex items-center gap-2 rounded-xl border border-rose-200 bg-white px-5 py-2.5 text-sm font-semibold text-rose-700 shadow-sm transition-all hover:border-rose-300 hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                    <svg class="h-4 w-4 text-rose-400 group-hover:text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Kelola Layanan
                </a>
                <a href="{{ route('admin.stylists.index') }}"
                   class="group flex items-center gap-2 rounded-xl border border-rose-200 bg-white px-5 py-2.5 text-sm font-semibold text-rose-700 shadow-sm transition-all hover:border-rose-300 hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                    <svg class="h-4 w-4 text-rose-400 group-hover:text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Kelola Stylist
                </a>
            </div>
        </div>
    </div>

    {{-- Metrik Ringkasan --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Hari Ini -->
        <div class="relative overflow-hidden rounded-3xl bg-white p-6 shadow-sm ring-1 ring-rose-100 transition-all hover:shadow-md hover:ring-rose-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 text-rose-600 shadow-inner">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-rose-500 uppercase tracking-wider">Total Hari Ini</p>
                    <p class="text-3xl font-black text-gray-900 tracking-tight">{{ $metrics['total_today'] }}</p>
                </div>
            </div>
        </div>

        <!-- Menunggu Konfirmasi -->
        <div class="relative overflow-hidden rounded-3xl bg-white p-6 shadow-sm ring-1 ring-amber-100 transition-all hover:shadow-md hover:ring-amber-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-100 to-orange-100 text-amber-600 shadow-inner">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-amber-600 uppercase tracking-wider">Antrean Baru</p>
                    <p class="text-3xl font-black text-gray-900 tracking-tight">{{ $metrics['pending'] }}</p>
                </div>
            </div>
            @if($metrics['pending'] > 0)
                <div class="absolute right-0 top-0 flex h-4 w-4 items-center justify-center">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-amber-500"></span>
                </div>
            @endif
        </div>

        <!-- Dikonfirmasi Hari Ini -->
        <div class="relative overflow-hidden rounded-3xl bg-white p-6 shadow-sm ring-1 ring-blue-100 transition-all hover:shadow-md hover:ring-blue-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600 shadow-inner">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-blue-500 uppercase tracking-wider">Telah Dikonfirmasi</p>
                    <p class="text-3xl font-black text-gray-900 tracking-tight">{{ $metrics['confirmed_today'] }}</p>
                </div>
            </div>
        </div>

        <!-- Selesai Hari Ini -->
        <div class="relative overflow-hidden rounded-3xl bg-white p-6 shadow-sm ring-1 ring-green-100 transition-all hover:shadow-md hover:ring-green-300 hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 text-green-600 shadow-inner">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-green-600 uppercase tracking-wider">Selesai Hari Ini</p>
                    <p class="text-3xl font-black text-gray-900 tracking-tight">{{ $metrics['completed_today'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Antrean Masuk --}}
    <div class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-lg shadow-rose-100/50">
        <div class="bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-5 sm:px-8 flex items-center justify-between border-b border-rose-200">
            <div>
                <h2 class="text-xl font-extrabold text-white">Antrean Menunggu Konfirmasi</h2>
                <p class="mt-1 text-sm font-medium text-rose-100">Mohon segera konfirmasi pesanan pelanggan berikut.</p>
            </div>
            @if($pendingReservations->count() > 0)
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1 text-sm font-bold text-rose-600 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-rose-500 animate-pulse"></span>
                    {{ $pendingReservations->count() }} Menunggu
                </span>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left text-sm">
                <thead class="bg-rose-50/50">
                    <tr class="text-xs uppercase tracking-wider text-rose-500 font-bold border-b border-rose-100">
                        <th class="px-8 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Jadwal Reservasi</th>
                        <th class="px-6 py-4">Layanan & Stylist</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white">
                    @forelse($pendingReservations as $reservation)
                        <tr class="hover:bg-rose-50/40 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-rose-100 to-pink-100 text-rose-700 font-bold ring-2 ring-white shadow-sm">
                                        {{ substr($reservation->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 text-base">{{ $reservation->user->name }}</p>
                                        <p class="text-xs font-medium text-gray-500">{{ $reservation->user->phone ?? $reservation->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2 text-gray-900 font-medium">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $reservation->reservation_date->format('d M Y') }}
                                </div>
                                <div class="flex items-center gap-2 text-rose-600 font-bold mt-1">
                                    <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-rose-300 mb-1">Layanan</p>
                                        @foreach($reservation->services as $svc)
                                            <span class="inline-flex items-center rounded-md bg-rose-50 px-2 py-1 text-xs font-bold text-rose-700 ring-1 ring-inset ring-rose-500/20 mr-1 mb-1">{{ $svc->name }}</span>
                                        @endforeach
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-rose-300 mb-1">Stylist</p>
                                        @foreach($reservation->stylists as $st)
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                                <span class="text-sm font-medium text-gray-700">{{ $st->name }} <span class="text-gray-400 text-xs">({{ $st->specialty }})</span></span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex gap-2 justify-end">
                                    <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit"
                                                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 px-4 py-2 text-sm font-bold text-white transition-all hover:from-green-600 hover:to-emerald-700 hover:-translate-y-0.5 shadow-sm shadow-green-200">
                                            Terima
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit"
                                                class="inline-flex items-center justify-center rounded-xl bg-white border border-rose-200 px-4 py-2 text-sm font-bold text-rose-600 transition-all hover:bg-rose-50 hover:border-rose-300 hover:shadow-sm"
                                                onclick="return confirm('Yakin ingin menolak reservasi ini?')">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-50 mb-4 text-rose-400">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="mt-4 text-sm font-bold text-gray-900">Semua Beres!</h3>
                                <p class="mt-1 text-sm text-gray-500">Tidak ada antrean yang menunggu konfirmasi saat ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Jadwal Harian --}}
    <div class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-sm ring-1 ring-black/5">
        <div class="bg-gradient-to-b from-rose-50/50 to-white px-6 py-5 sm:px-8 flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-rose-100 gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Jadwal Reservasi Harian</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">Pilih tanggal untuk melihat jadwal secara mendetail.</p>
            </div>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-3 bg-white p-1.5 rounded-2xl border border-rose-200/60 shadow-sm">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" name="date" value="{{ $selectedDate }}"
                           class="block w-full rounded-xl border-0 bg-transparent py-2 pl-10 pr-4 text-sm font-bold text-gray-900 ring-1 ring-inset ring-rose-100 transition focus:ring-2 focus:ring-inset focus:ring-rose-500">
                </div>
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-5 py-2 text-sm font-bold text-white transition-all hover:from-rose-600 hover:to-pink-700 shadow-sm shadow-rose-200">
                    Lihat Jadwal
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left text-sm">
                <thead class="bg-rose-50/30">
                    <tr class="text-xs uppercase tracking-wider text-gray-500 font-bold border-b border-rose-100">
                        <th class="px-8 py-4">Jam</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Detail</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($todayReservations as $reservation)
                        <tr class="hover:bg-rose-50/40 transition-colors">
                            <td class="px-8 py-5">
                                <div class="inline-flex items-center justify-center rounded-xl bg-rose-100 px-4 py-2.5 text-base font-black text-rose-700 ring-1 ring-inset ring-rose-200">
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <p class="font-bold text-gray-900">{{ $reservation->user->name }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $reservation->user->phone ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-5">
                                <div class="space-y-1.5">
                                    <div class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-rose-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        <div>
                                            @foreach($reservation->services as $svc)
                                                <span class="block text-sm font-bold text-gray-700">{{ $svc->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-rose-300 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <div>
                                            @foreach($reservation->stylists as $st)
                                                <span class="block text-sm font-medium text-gray-600">{{ $st->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $reservation->statusColor() }} ring-1 ring-inset {{ str_replace('bg-', 'ring-', $reservation->statusColor()) }}/20">
                                    {{ $reservation->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                @if($reservation->status === 'confirmed')
                                    <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline-flex justify-end">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit"
                                                class="inline-flex items-center justify-center rounded-xl bg-blue-50 px-4 py-2 text-sm font-bold text-blue-600 transition-all hover:bg-blue-600 hover:text-white border border-blue-200 hover:border-transparent">
                                            Selesaikan Pesanan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-sm font-medium text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-rose-50 mb-4 text-rose-300">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900">Jadwal Kosong</h3>
                                <p class="mt-1 text-sm text-gray-500">Tidak ada reservasi pada tanggal {{ \Carbon\Carbon::parse($selectedDate)->format('d F Y') }}.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
