@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
            <p class="mt-1 text-gray-600">CRUD Super Kategori dan Sub-Kategori</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-rose-600 hover:to-pink-700">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left text-sm">
                <thead class="bg-rose-50/50">
                    <tr class="text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama Sub Kategori</th>
                        <th class="px-6 py-4">Super Kategori</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-rose-50/30">
                            <td class="px-6 py-4">
                                @if($category->image)
                                    <img src="{{ $category->image }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gray-200"></div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900">{{ $category->name }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($category->description, 50) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium bg-rose-100 text-rose-800">
                                    {{ $category->parent_category ?: 'Utama' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini? Pastikan tidak ada layanan yang terhubung.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
