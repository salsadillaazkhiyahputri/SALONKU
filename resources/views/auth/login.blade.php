@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<div class="flex min-h-[70vh] items-center justify-center">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Selamat Datang</h1>
            <p class="mt-2 text-gray-600">Masuk ke akun SalonKu Anda</p>
        </div>

        <div class="rounded-2xl border border-rose-100 bg-white p-8 shadow-xl shadow-rose-100/50">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-gray-900 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-gray-900 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                           class="h-4 w-4 rounded border-gray-300 text-rose-600 focus:ring-rose-500">
                    <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 py-3 font-semibold text-white shadow-lg shadow-rose-200 transition hover:from-rose-600 hover:to-pink-700">
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-rose-600 hover:text-rose-700">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
