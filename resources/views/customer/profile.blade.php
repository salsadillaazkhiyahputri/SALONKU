@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="mx-auto max-w-3xl py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-10 text-center sm:text-left flex flex-col sm:flex-row items-center gap-6">
        <div class="h-24 w-24 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 p-1 shadow-lg shadow-rose-200">
            <div class="h-full w-full rounded-full border-4 border-white bg-white flex items-center justify-center overflow-hidden">
                <span class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-br from-rose-500 to-pink-600">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
            </div>
        </div>
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 font-serif italic mb-2">Profil Saya</h1>
            <p class="text-lg text-rose-500 font-medium">Kelola informasi akun dan amankan datamu.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-8 rounded-2xl bg-green-50 p-5 shadow-sm border border-green-100 flex items-start gap-4">
            <div class="rounded-full bg-green-100 p-1.5 text-green-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-green-800">{{ session('success') }}</h3>
            </div>
        </div>
    @endif

    <div class="relative bg-white rounded-[2.5rem] shadow-xl shadow-rose-100/30 border border-rose-100 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-gradient-to-br from-rose-50 to-pink-50 opacity-70 blur-3xl pointer-events-none"></div>

        <form method="POST" action="{{ route('profile.update') }}" class="relative z-10 p-8 sm:p-12 space-y-10">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2 border-b border-rose-50 pb-4">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    Informasi Dasar
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-bold text-gray-900">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 font-medium transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200">
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-gray-900">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 font-medium transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="phone" class="mb-2 block text-sm font-bold text-gray-900">No. Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 font-medium transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2 border-b border-rose-50 pb-4">
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    Keamanan Akun
                </h2>
                <p class="text-sm font-medium text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-gray-900">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200 placeholder-gray-400"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-bold text-gray-900">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full rounded-2xl border-2 border-gray-100 bg-gray-50 px-5 py-4 text-gray-900 transition focus:border-rose-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-rose-200 placeholder-gray-400"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-rose-100 flex justify-end">
                <button type="submit"
                        class="w-full sm:w-auto rounded-full bg-gradient-to-r from-rose-500 to-pink-600 px-10 py-4 font-bold text-white shadow-xl shadow-rose-200 transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-1 hover:shadow-2xl hover:shadow-rose-300/50">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
