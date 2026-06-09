@extends('layouts.app')

@section('title', 'Katalog Layanan')

@section('content')
<div class="space-y-12 pb-16">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden rounded-[2.5rem] bg-[#fdf5f6] shadow-xl shadow-rose-100/50 ring-1 ring-pink-100">
        <div class="absolute inset-0 opacity-80">
            <img src="{{ asset('images/salon_interior_1781016053439.png') }}" alt="Salon Interior" class="w-full h-full object-cover object-center scale-105" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#fdf5f6] via-[#fdf5f6]/95 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#fdf5f6]/60 to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex flex-col p-10 sm:p-16 lg:p-20">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-rose-100 px-4 py-2 text-sm font-bold text-rose-700 backdrop-blur-md ring-1 ring-rose-200 mb-6 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                    Tersedia Hari Ini
                </span>
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-7xl">
                    <span class="block text-pink-600 mb-2 font-serif italic drop-shadow-sm">Layanan</span>
                    Salon & Spa
                </h1>
                <p class="mt-6 text-lg text-gray-700 font-medium leading-relaxed max-w-xl">
                    Pilih kategori perawatan yang kamu inginkan. Nikmati pengalaman memanjakan diri dengan fasilitas premium dan stylist profesional kami.
                </p>
                
                <div class="mt-10 flex items-center gap-4">
                    <a href="#katalog" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-8 py-4 text-sm font-bold text-white transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-1 hover:shadow-xl hover:shadow-rose-200">
                        Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    @php
        // Data Super Kategori diambil dari Database dan digroup by parent_category
        $superImages = [
            'Hair Treatment' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
            'Nails' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=800&q=80',
            'Face Treatment' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80'
        ];
    @endphp

    {{-- Kategori Utama (Grid of Cards) --}}
    {{-- Kategori Utama --}}
    <div id="katalog" class="max-w-6xl mx-auto pt-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Pilih Layanan</h2>
            <p class="mt-4 text-lg text-gray-600">Telusuri berbagai menu perawatan unggulan kami.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
            @foreach($superCategories as $superName => $categories)
                @php
                    $superImage = $superImages[$superName] ?? 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80';
                @endphp
                
                <!-- Card Super Kategori -->
                <div onclick="openModal('modal-{{ Str::slug($superName) }}')" class="cursor-pointer group relative flex flex-col overflow-hidden rounded-3xl bg-white shadow-sm border border-rose-50 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg hover:shadow-rose-200 text-left w-full focus:outline-none focus:ring-4 focus:ring-rose-200">
                    <div class="aspect-square w-full overflow-hidden bg-rose-50 relative">
                        <img src="{{ $superImage }}" alt="{{ $superName }}" class="h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent transition-opacity duration-300 group-hover:opacity-80"></div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                            <span class="inline-block rounded-md bg-rose-500/90 backdrop-blur-md px-2 py-0.5 text-[10px] font-bold text-white mb-2 shadow-sm">
                                {{ count($categories) }} Kategori
                            </span>
                            <h3 class="text-base sm:text-lg font-extrabold font-serif leading-tight group-hover:text-rose-200 transition-colors drop-shadow-sm">{{ $superName }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Modal List Layanan untuk Super Kategori ini -->
                <div id="modal-{{ Str::slug($superName) }}" class="fixed inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-md transition-opacity" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-[2.5rem] bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-3xl flex flex-col max-h-[85vh] ring-1 ring-rose-100">
                            
                            <!-- Header Modal (Lebih kecil) -->
                            <div class="relative h-28 sm:h-32 w-full shrink-0">
                                <img src="{{ $superImage }}" alt="{{ $superName }}" class="w-full h-full object-cover" />
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-gray-900/40"></div>
                                
                                <!-- Tombol Close -->
                                <button onclick="closeModal('modal-{{ Str::slug($superName) }}')" class="absolute top-4 right-4 h-8 w-8 sm:h-10 sm:w-10 flex items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-md hover:bg-rose-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>

                                <div class="absolute bottom-4 left-6 sm:bottom-6 sm:left-8">
                                    <h3 class="text-2xl sm:text-3xl font-extrabold font-serif text-white drop-shadow-md">{{ $superName }}</h3>
                                </div>
                            </div>

                            <!-- Isi List Layanan -->
                            <div class="p-6 sm:p-8 overflow-y-auto bg-rose-50/30">
                                <div class="space-y-8">
                                    @foreach($categories as $subCategory)
                                        <div class="bg-white rounded-2xl p-6 shadow-sm ring-1 ring-rose-100">
                                            <h4 class="text-xl font-bold text-gray-900 font-serif mb-4 flex items-center gap-3">
                                                <span class="w-5 h-5 flex items-center justify-center rounded-full bg-rose-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                </span>
                                                {{ $subCategory->name }}
                                            </h4>
                                            
                                            <div class="space-y-3">
                                                @foreach($subCategory->services as $service)
                                                    <div class="group flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 rounded-xl hover:bg-rose-50 transition-colors ring-1 ring-transparent hover:ring-rose-100">
                                                        <div class="flex-1">
                                                            <div class="flex items-baseline justify-between w-full mb-1">
                                                                <h5 class="text-sm font-bold text-gray-900 group-hover:text-rose-600 transition-colors">{{ $service->name }}</h5>
                                                                <div class="hidden sm:block flex-1 border-b border-dotted border-rose-300 mx-3 relative top-[-4px]"></div>
                                                                <span class="text-base font-extrabold text-rose-600 whitespace-nowrap">{{ $service->formattedPrice() }}</span>
                                                            </div>
                                                            <p class="text-xs font-medium text-gray-500 flex items-center gap-1.5 mt-1">
                                                                <svg class="w-3 h-3 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                {{ $service->duration_minutes }} Menit
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @if($subCategory->services->isEmpty())
                                                    <p class="text-xs text-gray-500 italic">Belum ada layanan di kategori ini.</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Sticky Footer Button -->
                            <div class="shrink-0 bg-white p-5 border-t border-rose-100 flex flex-col sm:flex-row justify-between items-center gap-4 rounded-b-[2.5rem]">
                                <p class="text-xs font-medium text-gray-500">Jadwalkan perawatan impianmu sekarang.</p>
                                <a href="{{ route('customer.reservations.create', ['category' => $superName]) }}" 
                                   class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-rose-200 transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-0.5 hover:shadow-lg w-full sm:w-auto">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            // Allow slight delay for transition
            setTimeout(() => {
                modal.classList.add('opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
            document.body.style.overflow = 'auto';
        }
    }

    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed') && !event.target.closest('.transform')) {
            const modals = document.querySelectorAll('.fixed.z-50:not(.hidden)');
            modals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
</script>
@endsection
