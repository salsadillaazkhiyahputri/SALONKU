@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Layanan</h1>
            <p class="mt-2 text-gray-600 font-medium">CRUD katalog layanan salon per kategori</p>
        </div>
        <a href="{{ route('admin.services.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-rose-200 transition-all hover:from-rose-600 hover:to-pink-700 hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Layanan
        </a>
    </div>

    @forelse($categories as $category)
        <div class="overflow-hidden rounded-3xl border border-rose-100 bg-white shadow-lg shadow-rose-100/50">
            <div class="bg-gradient-to-r from-rose-50 to-pink-50 px-6 py-4 border-b border-rose-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $category->name }}</h2>

                </div>
                <span class="text-sm font-bold text-rose-500">{{ $category->services->count() }} Layanan</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="bg-white">
                        <tr class="text-xs uppercase tracking-wider text-gray-400 font-bold border-b border-gray-100">
                            <th class="px-6 py-4">Nama Layanan</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4">Durasi</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        @forelse($category->services as $service)
                            <tr class="hover:bg-rose-50/40 transition-colors group">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-900 text-base group-hover:text-rose-600 transition-colors">{{ $service->name }}</p>
                                    @if($service->description)
                                        <p class="text-xs text-gray-500 mt-1 max-w-md">{{ Str::limit($service->description, 80) }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-rose-500">{{ $service->formattedPrice() }}</td>
                                <td class="px-6 py-4 text-gray-600 font-medium">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $service->duration_minutes }} mnt
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $service->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <a href="{{ route('admin.services.edit', $service) }}"
                                           class="inline-flex items-center justify-center rounded-xl bg-blue-50 px-3 py-2 text-sm font-bold text-blue-600 transition-all hover:bg-blue-600 hover:text-white shadow-sm">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center rounded-xl bg-red-50 px-3 py-2 text-sm font-bold text-red-600 transition-all hover:bg-red-600 hover:text-white shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada layanan di kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="rounded-3xl border border-dashed border-rose-200 bg-rose-50/50 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <h3 class="mt-4 text-lg font-bold text-gray-900">Tidak Ada Kategori</h3>
            <p class="mt-2 text-sm text-gray-500">Anda belum membuat kategori atau layanan apapun.</p>
        </div>
    @endforelse
</div>
@endsection
