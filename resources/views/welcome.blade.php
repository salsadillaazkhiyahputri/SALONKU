@extends('layouts.guest')

@section('title', 'Kecantikan & Relaksasi')

@section('content')
<div class="space-y-20 pb-20">

    {{-- Hero Section --}}
    <div class="relative overflow-hidden rounded-[3rem] bg-[#fdf5f6] shadow-2xl shadow-rose-200/50 ring-1 ring-pink-100 min-h-[85vh] flex items-center mt-4">
        
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/salon_interior_1781016053439.png') }}" alt="Salon Interior" class="w-full h-full object-cover object-center scale-105" onerror="this.src='https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1920&q=80'" />
            <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#fdf5f6]/80 to-transparent"></div>
        </div>

        <!-- Navbar Overlay -->
        <nav class="absolute top-0 w-full z-50 px-6 sm:px-12 py-6 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group shrink-0">
                <span class="text-2xl sm:text-3xl font-black tracking-tight text-gray-900">Salon<span class="text-rose-500">Ku</span></span>
            </a>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden sm:inline-flex px-5 py-2.5 text-sm font-bold text-gray-700 hover:text-rose-600 transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-rose-200 transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-0.5 hover:shadow-lg">
                    Daftar Sekarang
                </a>
            </div>
        </nav>
        
        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col p-8 sm:p-16 lg:p-24 w-full">
            <div class="max-w-2xl mt-12 sm:mt-0">
                <span class="inline-flex items-center gap-2 rounded-full bg-rose-100/80 px-4 py-2 text-sm font-bold text-rose-700 backdrop-blur-md ring-1 ring-rose-200 mb-6 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                    Buka Setiap Hari 09.00 - 21.00
                </span>
                <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl lg:text-7xl leading-[1.1]">
                    <span class="block text-pink-600 mb-2 font-serif italic drop-shadow-sm font-normal">Kecantikan &</span>
                    Relaksasi Sempurna.
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-700 font-medium leading-relaxed max-w-xl">
                    Temukan harmoni antara perawatan rambut, kuku, dan spa terbaik. Dikelola oleh stylist profesional dengan produk premium eksklusif hanya untuk Anda.
                </p>
                
                <div class="mt-10 flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-full bg-gray-900 px-8 py-4 text-sm sm:text-base font-bold text-white transition-all hover:bg-black hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-300">
                        Reservasi Sekarang
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="#layanan" class="w-full sm:w-auto inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm sm:text-base font-bold text-gray-900 transition-all hover:bg-gray-50 ring-1 ring-gray-200 hover:-translate-y-1 hover:shadow-lg">
                        Lihat Layanan
                    </a>
                </div>
                
                <div class="mt-12 flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Customer">
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=100&q=80" alt="Customer">
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&w=100&q=80" alt="Customer">
                        <div class="w-12 h-12 rounded-full border-2 border-white bg-rose-100 flex items-center justify-center text-rose-700 font-bold text-sm z-10">+2k</div>
                    </div>
                    <div class="text-sm font-medium text-gray-600">
                        Dipercaya oleh lebih dari <br> <span class="font-bold text-gray-900">2,000+ pelanggan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Layanan Unggulan --}}
    <div id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-rose-500 font-bold tracking-wide uppercase text-sm mb-3">Layanan Kami</h2>
            <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-900 font-serif">Perawatan dari Ujung Kepala hingga Ujung Kaki</h3>
            <p class="mt-4 text-gray-600 text-lg">Semua yang Anda butuhkan untuk tampil memukau dan merasa lebih segar setiap harinya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm ring-1 ring-rose-50 hover:shadow-xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-2 group">
                <div class="w-14 h-14 bg-rose-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-rose-500 transition-colors duration-300">
                    <svg class="w-7 h-7 text-rose-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">Hair Styling & Color</h4>
                <p class="text-gray-600 leading-relaxed">Dari potongan rambut tren terbaru hingga pewarnaan balayage yang elegan oleh ahlinya.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm ring-1 ring-rose-50 hover:shadow-xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-2 group">
                <div class="w-14 h-14 bg-rose-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-rose-500 transition-colors duration-300">
                    <svg class="w-7 h-7 text-rose-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">Relaxing Spa</h4>
                <p class="text-gray-600 leading-relaxed">Pijat aromaterapi dan perawatan tubuh lengkap untuk menghilangkan stres dan lelah.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm ring-1 ring-rose-50 hover:shadow-xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-2 group">
                <div class="w-14 h-14 bg-rose-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-rose-500 transition-colors duration-300">
                    <svg class="w-7 h-7 text-rose-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">Nail Art & Care</h4>
                <p class="text-gray-600 leading-relaxed">Manicure dan pedicure premium dengan pilihan warna gel yang cantik dan tahan lama.</p>
            </div>
        </div>
    </div>

    {{-- CTA Banner --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 rounded-[3rem] p-10 sm:p-16 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-rose-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            
            <div class="relative z-10 max-w-2xl text-center md:text-left">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Siap memanjakan diri hari ini?</h2>
                <p class="text-gray-400 text-lg">Buat akun sekarang dan dapatkan kemudahan reservasi tanpa antre, kapan saja, dari mana saja.</p>
            </div>
            <div class="relative z-10 shrink-0">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-rose-500 px-8 py-4 text-base font-bold text-white transition-all hover:bg-rose-400 hover:shadow-lg hover:shadow-rose-500/30 hover:-translate-y-1">
                    Mulai Reservasi
                </a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="pt-10 pb-6 border-t border-rose-100 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} SalonKu. Semua Hak Cipta Dilindungi.</p>
    </footer>

</div>
@endsection
