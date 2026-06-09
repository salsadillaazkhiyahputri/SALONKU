@extends('layouts.app')

@section('title', 'Buat Reservasi')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700 mb-4 shadow-sm border border-rose-200">
                Langkah 1 dari 2
            </span>
            <h1 class="text-4xl font-extrabold text-gray-900 font-serif italic mb-2">Buat Reservasi</h1>
            <p class="text-lg text-gray-600">Pilih layanan yang kamu inginkan dan jadwalkan kedatanganmu.</p>
        </div>
        <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm border border-gray-200 transition-all hover:bg-gray-50 hover:text-rose-600 hover:border-rose-200 hover:-translate-x-1">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>
    </div>

    @if (session('error'))
        <div class="mb-6 rounded-2xl bg-red-50 p-4 shadow-sm border border-red-100">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800">{{ session('error') }}</h3>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-rose-100/50 border border-rose-100 overflow-hidden relative">
        <!-- Decorative background -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-gradient-to-br from-rose-100 to-pink-100 opacity-50 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-gradient-to-tr from-rose-50 to-pink-50 opacity-50 blur-3xl pointer-events-none"></div>

        <form action="{{ route('customer.reservations.store') }}" method="POST" class="relative z-10 p-6 sm:p-10">
            @csrf

            <div class="space-y-12">
                <!-- Pilih Layanan -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-pink-500 text-white font-black shadow-md shadow-rose-200">1</div>
                        <h2 class="text-2xl font-bold text-gray-900">Pilih Layanan</h2>
                    </div>
                    
                    <div class="space-y-8 max-h-[500px] overflow-y-auto pr-4 custom-scrollbar rounded-2xl">
                        @php
                            $groupedCategories = collect($categories)->groupBy('parent_category');
                        @endphp

                        @foreach($groupedCategories as $superName => $subCategories)
                            <div class="bg-rose-50/30 rounded-[2rem] p-6 sm:p-8 border border-rose-100/50">
                                <h3 class="font-serif text-3xl font-extrabold text-gray-900 mb-6 drop-shadow-sm">{{ $superName }}</h3>
                                
                                <div class="space-y-6">
                                    @foreach($subCategories as $category)
                                        @if($category->services->count() > 0)
                                            <div>
                                                <h4 class="font-bold text-rose-600 mb-3 flex items-center gap-2">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                    {{ $category->name }}
                                                </h4>
                                                <div class="grid sm:grid-cols-2 gap-4">
                                                    @foreach($category->services as $service)
                                                        <label class="group relative flex flex-col p-5 rounded-2xl border-2 border-gray-100 bg-white hover:border-rose-300 hover:shadow-md cursor-pointer transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/50 has-[:checked]:shadow-rose-100">
                                                            <div class="flex items-start justify-between mb-3">
                                                                <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" 
                                                                    data-category="{{ $superName }}"
                                                                    class="service-checkbox mt-1 w-5 h-5 text-rose-500 border-gray-300 rounded focus:ring-rose-500"
                                                                    @checked(is_array(old('service_ids')) ? in_array($service->id, old('service_ids')) : (isset($selected_service) && $selected_service == $service->id))>
                                                                <span class="text-sm font-black text-rose-600 bg-rose-100 px-3 py-1 rounded-full whitespace-nowrap">{{ $service->formattedPrice() }}</span>
                                                            </div>
                                                            <div class="mt-auto">
                                                                <p class="text-base font-bold text-gray-900 group-hover:text-rose-600 transition-colors">{{ $service->name }}</p>
                                                                <p class="text-sm font-medium text-gray-500 flex items-center gap-1.5 mt-2">
                                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                    {{ $service->duration_minutes }} menit
                                                                </p>
                                                            </div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('service_ids')
                        <p class="mt-3 text-sm font-medium text-red-600 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Stylist Dinamis -->
                <div id="stylists-section" class="hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-pink-500 text-white font-black shadow-md shadow-rose-200">2</div>
                        <h2 class="text-2xl font-bold text-gray-900">Pilih Stylist</h2>
                    </div>
                    <div id="stylists-wrapper" class="grid sm:grid-cols-2 gap-6 p-6 sm:p-8 rounded-[2rem] bg-rose-50/30 border border-rose-100/50">
                        <!-- Selects will be generated here by JS -->
                    </div>
                </div>

                <!-- Tanggal & Waktu -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-pink-500 text-white font-black shadow-md shadow-rose-200">3</div>
                        <h2 class="text-2xl font-bold text-gray-900">Tentukan Jadwal</h2>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 p-6 sm:p-8 rounded-[2rem] bg-rose-50/30 border border-rose-100/50">
                        <div>
                            <label for="reservation_date" class="mb-2 block text-sm font-bold text-gray-900">Tanggal Kunjungan</label>
                            <input type="date" name="reservation_date" id="reservation_date" 
                                min="{{ date('Y-m-d') }}" value="{{ old('reservation_date') }}" required
                                class="w-full rounded-2xl border-2 border-white bg-white px-5 py-4 text-gray-900 font-bold shadow-sm transition focus:border-rose-400 focus:outline-none focus:ring-4 focus:ring-rose-200">
                            @error('reservation_date')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="start_time" class="mb-2 block text-sm font-bold text-gray-900">Waktu Kedatangan</label>
                            <input type="time" name="start_time" id="start_time" 
                                min="09:00" max="20:00" value="{{ old('start_time') }}" required
                                class="w-full rounded-2xl border-2 border-white bg-white px-5 py-4 text-gray-900 font-bold shadow-sm transition focus:border-rose-400 focus:outline-none focus:ring-4 focus:ring-rose-200">
                            <p class="mt-2 text-xs font-bold text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Jam operasional: 09:00 - 20:00 WIB</p>
                            @error('start_time')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 font-black">4</div>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">Catatan Tambahan <span class="text-sm font-medium text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">(Opsional)</span></h2>
                    </div>
                    <textarea name="notes" id="notes" rows="3" placeholder="Contoh: Kulit saya sensitif terhadap produk tertentu..."
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-8 mt-8 border-t border-rose-100 flex flex-col items-center">
                    <button type="submit" class="w-full sm:w-auto min-w-[300px] rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-10 py-5 text-xl font-bold text-white shadow-xl shadow-rose-200 transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-1 hover:shadow-2xl hover:shadow-rose-300/50 focus:ring-4 focus:ring-rose-300">
                        Buat Reservasi Sekarang
                    </button>
                    <p class="text-center text-sm font-medium text-gray-500 mt-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pembayaran dilakukan di kasir salon kami. Total harga akan dikalkulasi sesuai layanan.
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #fecdd3; 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #fda4af; 
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.service-checkbox');
    const wrapper = document.getElementById('stylists-wrapper');
    const stylistsSection = document.getElementById('stylists-section');
    const stylistsData = @json($stylists);

    function updateStylists() {
        const checkedCategories = new Set();
        checkboxes.forEach(cb => {
            if (cb.checked) {
                checkedCategories.add(cb.getAttribute('data-category'));
            }
        });

        wrapper.innerHTML = '';

        if (checkedCategories.size === 0) {
            stylistsSection.classList.add('hidden');
            return;
        }

        stylistsSection.classList.remove('hidden');

        Array.from(checkedCategories).forEach(category => {
            const categoryStylists = stylistsData.filter(s => s.specialty === category);
            
            let optionsHtml = `<option value="" disabled selected>Pilih ahlinya...</option>`;
            categoryStylists.forEach(s => {
                optionsHtml += `<option value="${s.id}">${s.name}</option>`;
            });

            const html = `
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-50">
                    <label class="mb-3 block text-sm font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Stylist untuk ${category}
                    </label>
                    <div class="relative">
                        <select name="stylists[]" required
                                class="w-full appearance-none rounded-xl border-2 border-gray-100 bg-gray-50 px-4 py-3 pl-11 text-gray-900 font-medium transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200">
                            ${optionsHtml}
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-rose-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateStylists);
    });

    updateStylists();
});
</script>
@endsection
