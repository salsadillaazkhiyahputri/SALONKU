@extends('layouts.app')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-12 text-center sm:text-left">
        <h1 class="text-4xl font-extrabold text-gray-900 font-serif italic mb-3">Riwayat & Jadwal</h1>
        <p class="text-lg text-rose-500 font-medium">Pantau status antrean dan riwayat perawatan cantikmu bersama ahlinya.</p>
    </div>

    <div class="space-y-16">
        {{-- Reservasi Aktif --}}
        <div>
            <div class="flex items-center gap-4 mb-8">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-400 to-pink-500 text-white shadow-lg shadow-rose-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Perawatan Mendatang</h2>
            </div>

            <div class="space-y-6">
                @forelse($reservations as $reservation)
                    <div class="group relative flex flex-col sm:flex-row items-start sm:items-center justify-between rounded-[2rem] bg-white border border-rose-100 p-6 sm:p-8 shadow-xl shadow-rose-100/30 transition-all hover:shadow-2xl hover:shadow-rose-100/50 hover:border-rose-200 overflow-hidden">
                        <!-- Decorative glow -->
                        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-gradient-to-bl from-rose-100 to-transparent opacity-50 blur-2xl group-hover:scale-125 transition-transform duration-700"></div>

                        <div class="flex items-start sm:items-center gap-6 relative z-10 w-full sm:w-auto">
                            <div class="flex flex-col items-center justify-center shrink-0 w-20 h-20 rounded-[1.5rem] bg-gradient-to-br from-rose-50 to-pink-50 text-rose-600 border border-rose-100 shadow-inner">
                                <span class="text-xs font-bold uppercase tracking-wider">{{ $reservation->reservation_date->format('M') }}</span>
                                <span class="text-2xl font-black">{{ $reservation->reservation_date->format('d') }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-xl text-gray-900 mb-1">
                                    @foreach($reservation->services as $svc)
                                        <span class="inline-block mr-1">{{ $svc->name }}@if(!$loop->last), @endif</span>
                                    @endforeach
                                </div>
                                <div class="flex flex-wrap items-center gap-3 text-sm font-medium text-gray-600">
                                    <span class="flex items-center gap-1 bg-white border border-gray-100 px-3 py-1 rounded-full shadow-sm">
                                        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-rose-600 font-bold">{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} WIB</span>
                                    </span>
                                    <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-full border border-gray-100">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span class="text-gray-500">Stylist:</span>
                                        <span class="text-gray-700 font-bold">
                                            @foreach($reservation->stylists as $st)
                                                {{ $st->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 sm:mt-0 w-full sm:w-auto flex justify-end relative z-10">
                            <span class="inline-flex items-center gap-2 rounded-full px-5 py-2 text-sm font-bold shadow-md {{ $reservation->statusColor() }} backdrop-blur-sm bg-white/90 border border-current">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-current opacity-40"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-current"></span>
                                </span>
                                {{ $reservation->statusLabel() }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center rounded-[2.5rem] border-2 border-dashed border-rose-200 bg-rose-50/50 py-20 px-6 text-center">
                        <div class="mb-6 h-24 w-24 rounded-full bg-white flex items-center justify-center text-rose-400 shadow-xl shadow-rose-100/50">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <p class="text-gray-900 font-bold text-2xl mb-2 font-serif italic">Belum ada reservasi aktif nih.</p>
                        <p class="text-gray-500 font-medium mb-8 text-lg">Yuk, manjakan dirimu dan pesan layanan sekarang!</p>
                        <a href="{{ route('customer.dashboard') }}" class="rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-8 py-3.5 text-base font-bold text-white shadow-lg shadow-rose-200 hover:shadow-xl hover:shadow-rose-300 hover:-translate-y-1 hover:from-rose-600 hover:to-pink-700 transition-all">
                            Lihat Katalog Layanan
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Riwayat --}}
        <div>
            <div class="flex items-center gap-4 mb-8">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 shadow-sm border border-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Perawatan Selesai</h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($history as $item)
                    <div class="group rounded-[2rem] border border-gray-100 bg-white p-6 shadow-sm hover:shadow-xl hover:shadow-rose-100/50 hover:border-rose-200 transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="h-10 w-10 rounded-full bg-rose-50 flex items-center justify-center text-rose-500 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-rose-600 bg-rose-100/80 px-3 py-1.5 rounded-full">
                                Rp {{ number_format($item->services->sum('price'), 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <div class="font-bold text-lg text-gray-900 mb-2 leading-tight">
                            @foreach($item->services as $svc)
                                <span class="block">{{ $svc->name }}</span>
                            @endforeach
                        </div>
                        
                        <div class="space-y-2 mt-4 pt-4 border-t border-gray-50">
                            <p class="text-sm font-medium text-gray-500 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $item->reservation_date->format('d M Y') }}
                            </p>
                            <p class="text-sm font-medium text-gray-500 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @foreach($item->stylists as $st)
                                    {{ $st->name }}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 font-medium bg-gray-50 rounded-[2rem] border border-dashed border-gray-200">
                        Kamu belum memiliki riwayat perawatan yang selesai.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
