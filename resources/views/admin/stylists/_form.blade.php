<div>
    <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Stylist</label>
    <input type="text" name="name" id="name" value="{{ old('name', $stylist->name ?? '') }}" required
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
</div>

<div>
    <label for="specialty" class="mb-1.5 block text-sm font-medium text-gray-700">Spesialisasi Kategori</label>
    <select name="specialty" id="specialty" required
            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
        <option value="" disabled selected>Pilih Kategori...</option>
        @foreach($categories as $cat)
            <option value="{{ $cat }}" @selected(old('specialty', $stylist->specialty ?? '') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700">Status</label>
    <select name="status" id="status" required
            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
        <option value="active" @selected(old('status', $stylist->status ?? 'active') === 'active')>Aktif</option>
        <option value="inactive" @selected(old('status', $stylist->status ?? '') === 'inactive')>Nonaktif</option>
    </select>
</div>
