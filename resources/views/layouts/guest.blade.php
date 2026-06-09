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
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="w-full">
            @yield('content')
        </div>
    </main>
</body>
</html>
