<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Layanan</label>
        <input type="text" name="name" id="name" value="{{ old('name', $service->name ?? '') }}" required
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
    </div>
    <div>
        <label for="category_id" class="mb-1.5 block text-sm font-medium text-gray-700">Kategori</label>
        <select name="category_id" id="category_id" required
                class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
            <option value="" disabled selected>Pilih Kategori...</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $service->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div>
    <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi</label>
    <textarea name="description" id="description" rows="3"
              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="price" class="mb-1.5 block text-sm font-medium text-gray-700">Harga (Rp)</label>
        <input type="number" name="price" id="price" value="{{ old('price', $service->price ?? '') }}" min="0" required
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
        
        <div class="mt-2 flex items-center gap-2">
            <input type="hidden" name="is_starting_price" value="0">
            <input type="checkbox" name="is_starting_price" id="is_starting_price" value="1"
                   @checked(old('is_starting_price', $service->is_starting_price ?? false))
                   class="h-4 w-4 rounded border-gray-300 text-rose-600 focus:ring-rose-500">
            <label for="is_starting_price" class="text-xs text-gray-600">Jadikan harga "Mulai dari Rp..."</label>
        </div>
    </div>
    <div>
        <label for="duration_minutes" class="mb-1.5 block text-sm font-medium text-gray-700">Durasi (menit)</label>
        <input type="number" name="duration_minutes" id="duration_minutes"
               value="{{ old('duration_minutes', $service->duration_minutes ?? 60) }}" min="15" max="480" required
               class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
    </div>
</div>

<div class="flex items-center gap-2">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" id="is_active" value="1"
           @checked(old('is_active', $service->is_active ?? true))
           class="h-4 w-4 rounded border-gray-300 text-rose-600 focus:ring-rose-500">
    <label for="is_active" class="text-sm text-gray-700">Layanan aktif</label>
</div>
