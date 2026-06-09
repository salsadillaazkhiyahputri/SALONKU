@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="py-12 sm:py-24 lg:pb-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl font-serif italic">
                Tampil Sempurna,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-pink-600">Percaya Diri Sepanjang Hari</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                SalonKu menawarkan layanan perawatan rambut, kuku, dan spa premium dengan stylist profesional kami. 
                Pesan jadwal perawatanmu secara online sekarang juga tanpa ribet.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('register') }}" class="rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-rose-200 hover:from-rose-600 hover:to-pink-700 hover:-translate-y-0.5 transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">
                    Mulai Reservasi
                </a>
                <a href="#services" class="text-sm font-semibold leading-6 text-gray-900 hover:text-rose-600 transition">
                    Lihat Layanan Kami <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>

        <div class="mt-16 flow-root sm:mt-24">
            <div class="relative -m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                <div class="rounded-md shadow-2xl ring-1 ring-gray-900/10 overflow-hidden bg-white/80 backdrop-blur aspect-[16/9] flex items-center justify-center">
                    <!-- Placeholder for hero image -->
                    <div class="text-center p-8">
                        <span class="inline-flex items-center justify-center p-4 bg-rose-100 rounded-full mb-4 text-rose-500">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Perawatan Profesional</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">Kami menggunakan produk terbaik untuk memastikan rambut dan kulitmu sehat berkilau.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div id="services" class="py-24 sm:py-32 bg-white">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7 text-rose-600">Layanan Terbaik</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl font-serif italic">Perawatan Lengkap dari Ujung Rambut ke Ujung Kaki</p>
            <p class="mt-6 text-lg leading-8 text-gray-600">Di SalonKu, kami mengerti bahwa setiap orang memiliki keunikan tersendiri. Stylist kami siap mendengarkan kebutuhanmu.</p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                <!-- Hair -->
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-500">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                        </div>
                        Hair Treatment & Styling
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Dari potongan rambut tren terkini, pewarnaan ombre/balayage, hingga perawatan keratin untuk rambut selembut sutra.</dd>
                </div>
                <!-- Nails -->
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-pink-500">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        </div>
                        Manicure & Pedicure
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Perawatan kuku premium dengan pilihan cat kuku gel berkualitas tinggi yang awet dan menyehatkan.</dd>
                </div>
                <!-- Face -->
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-rose-400">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Face & Skincare
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Facial menyegarkan dan riasan wajah profesional untuk momen spesialmu.</dd>
                </div>
                <!-- Spa -->
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-pink-400">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </div>
                        Spa & Relaxation
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Lupakan sejenak rutinitasmu dan nikmati pijatan relaksasi untuk melepaskan penat.</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
