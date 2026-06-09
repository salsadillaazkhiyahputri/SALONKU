@extends('layouts.app')

@section('title', 'Kelola Stylist')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Stylist</h1>
            <p class="mt-1 text-gray-600">Atur ketersediaan dan data stylist</p>
        </div>
        <a href="{{ route('admin.stylists.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-rose-600 hover:to-pink-700">
            + Tambah Stylist
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-rose-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left text-sm">
                <thead class="bg-rose-50/50">
                    <tr class="text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Spesialisasi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($stylists as $stylist)
                        <tr class="hover:bg-rose-50/30">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stylist->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $stylist->specialty ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $stylist->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $stylist->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('admin.stylists.toggle', $stylist) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">
                                            {{ $stylist->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.stylists.edit', $stylist) }}"
                                       class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 transition hover:bg-gray-50">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.stylists.destroy', $stylist) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus stylist ini?')">
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
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada stylist.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
