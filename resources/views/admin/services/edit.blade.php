@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="mx-auto max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-900">Edit Layanan</h1>

    <div class="mt-6 rounded-2xl border border-rose-100 bg-white p-6 shadow-sm sm:p-8">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" class="space-y-5">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['service' => $service])
            <div class="flex gap-3">
                <button type="submit"
                        class="rounded-xl bg-gradient-to-r from-rose-500 to-pink-600 px-6 py-2.5 font-semibold text-white shadow-md transition hover:from-rose-600 hover:to-pink-700">
                    Perbarui
                </button>
                <a href="{{ route('admin.services.index') }}"
                   class="rounded-xl border border-gray-200 px-6 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
