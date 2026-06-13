@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
            <p class="mt-1 text-gray-600">CRUD Kategori Utama SalonKu</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-rose-600 hover:to-pink-700">
            + Tambah Kategori
        </a>
    </div>

    @forelse($categories as $mainCategory)
        <div class="overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm mb-6">
            <div class="bg-gradient-to-r from-rose-50 to-pink-50 px-6 py-4 border-b border-rose-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    @if($mainCategory->image)
                        <img src="{{ $mainCategory->image }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                    @else
                        <div class="w-12 h-12 rounded-lg bg-rose-200 flex items-center justify-center text-rose-500 font-bold shadow-sm">{{ substr($mainCategory->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $mainCategory->name }} <span class="text-[10px] font-bold text-rose-600 bg-rose-100 px-2 py-0.5 rounded-full ml-2 uppercase tracking-wider">Utama</span></h2>
                        <p class="text-xs text-gray-500 mt-1">{{ Str::limit($mainCategory->description, 80) }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.categories.edit', $mainCategory) }}"
                       class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-bold text-gray-700 transition hover:bg-gray-50 shadow-sm">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $mainCategory) }}"
                          onsubmit="return confirm('Yakin ingin menghapus kategori utama ini? Semua sub-kategori mungkin terpengaruh.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-50 shadow-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            
            @if($mainCategory->subCategories->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">
                    <thead class="bg-white">
                        <tr class="text-xs uppercase tracking-wide text-gray-400 border-b border-gray-100">
                            <th class="px-6 py-3 w-16"></th>
                            <th class="px-6 py-3">Nama Sub-Kategori</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        @foreach($mainCategory->subCategories as $category)
                            <tr class="hover:bg-rose-50/30 group transition-colors">
                                <td class="px-6 py-3">
                                    @if($category->image)
                                        <img src="{{ $category->image }}" class="w-12 h-12 min-w-[3rem] min-h-[3rem] shrink-0 aspect-square rounded-md object-cover">
                                    @else
                                        <div class="w-12 h-12 min-w-[3rem] min-h-[3rem] shrink-0 aspect-square rounded-md bg-gray-100 flex items-center justify-center text-gray-400 font-bold">{{ substr($category->name, 0, 1) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-3">
                                    <p class="font-bold text-gray-900">{{ $category->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($category->description, 50) }}</p>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50 opacity-0 group-hover:opacity-100 focus:opacity-100">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus sub-kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 opacity-0 group-hover:opacity-100 focus:opacity-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-6 text-center">
                    <p class="text-sm text-gray-500 italic">Belum ada sub-kategori di dalam kategori ini.</p>
                </div>
            @endif
        </div>
    @empty
        <div class="rounded-3xl border border-dashed border-rose-200 bg-rose-50/50 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <h3 class="mt-4 text-lg font-bold text-gray-900">Tidak Ada Kategori</h3>
            <p class="mt-2 text-sm text-gray-500">Anda belum membuat kategori apapun.</p>
        </div>
    @endforelse
</div>
@endsection
