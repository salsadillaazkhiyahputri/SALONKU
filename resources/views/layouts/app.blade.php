<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SalonKu') — Reservasi Salon Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fdf5f6] font-sans antialiased text-gray-900 flex flex-col">
    <!-- Sticky Wrapper for Premium Floating Pill Navbar -->
    <div class="sticky top-0 z-50 pt-4 pb-4 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-[#fdf5f6] to-transparent">
        <nav class="mx-auto max-w-5xl flex h-20 items-center justify-between rounded-full bg-white/95 backdrop-blur-xl shadow-lg shadow-rose-100/50 border border-rose-50 px-4 sm:px-8 transition-all duration-300 relative">
            
            <!-- Logo -->
            <a href="{{ auth()->check() ? (auth()->user()->isAdmin() ? route('admin.dashboard') : route('customer.dashboard')) : route('login') }}"
               class="flex items-center gap-3 group shrink-0">
                <span class="text-xl sm:text-2xl font-black tracking-tight text-gray-900">Salon<span class="text-rose-500">Ku</span></span>
            </a>

            @auth
                <!-- Navigation Links (Always Visible) -->
                <div class="flex items-center gap-1 flex-1 min-w-0 px-4 lg:px-8 overflow-x-auto no-scrollbar whitespace-nowrap">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Kelola Kategori
                        </a>
                        <a href="{{ route('admin.services.index') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('admin.services.*') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Kelola Layanan
                        </a>
                        <a href="{{ route('admin.stylists.index') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('admin.stylists.*') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Kelola Stylist
                        </a>
                    @else
                        <a href="{{ route('customer.dashboard') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('customer.dashboard') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Katalog Layanan
                        </a>
                        <a href="{{ route('customer.reservations.create') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('customer.reservations.create') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Buat Reservasi
                        </a>
                        <a href="{{ route('customer.reservations.index') }}"
                           class="relative px-4 py-2 text-sm font-bold rounded-full transition-all duration-300 {{ request()->routeIs('customer.reservations.index') ? 'text-white bg-gradient-to-r from-rose-500 to-pink-500 shadow-md shadow-rose-200 hover:-translate-y-0.5' : 'text-gray-600 hover:text-rose-600 hover:bg-rose-50' }}">
                            Riwayat Reservasi
                        </a>
                    @endif
                </div>

                <!-- User Profile & Actions -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <!-- User Badge -->
                    <a href="{{ route('customer.profile') }}" class="group flex items-center gap-2 rounded-full border-2 border-transparent bg-gray-50/50 p-1 pr-4 transition-all hover:bg-white hover:border-rose-100 hover:shadow-sm">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-rose-100 to-pink-100 text-sm font-black text-rose-600 shadow-inner group-hover:scale-105 transition-transform">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-900 leading-tight group-hover:text-rose-600 transition-colors">{{ auth()->user()->name }}</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-rose-500">{{ auth()->user()->isAdmin() ? 'Admin' : 'Pelanggan' }}</span>
                        </div>
                    </a>

                    <div class="h-8 w-px bg-gray-200"></div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="group flex h-10 w-10 items-center justify-center rounded-full bg-rose-50 text-rose-600 transition-all hover:bg-rose-500 hover:text-white focus:outline-none focus:ring-4 focus:ring-rose-200 shadow-sm"
                                title="Keluar">
                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </form>
                </div>
            @endauth
        </nav>
    </div>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8 w-full flex-grow">
        @if(session('success'))
            <div class="mb-8 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-bold text-green-800 flex items-center gap-3 shadow-sm">
                <svg class="h-6 w-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-bold text-red-800 flex items-center gap-3 shadow-sm">
                <svg class="h-6 w-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-6 text-sm font-bold text-red-800 shadow-sm">
                <div class="flex items-start gap-3">
                    <svg class="h-6 w-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-auto border-t border-rose-100 bg-white/60 py-8 text-center text-sm font-medium text-gray-500">
        &copy; {{ date('Y') }} SalonKu — Reservasi Salon Kecantikan Online
    </footer>

    <style>
        /* Hide scrollbar for nav links on small screens */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</body>
</html>
