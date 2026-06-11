<div>
    <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Sub-Kategori (Misal: Hair Colouring)</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" required
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
</div>



<div>
    <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700">Deskripsi Kategori</label>
    <textarea name="description" id="description" rows="2"
              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div>
    <label for="parent_id" class="mb-1.5 block text-sm font-medium text-gray-700">Rumpun Kategori Utama</label>
    <select name="parent_id" id="parent_id" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
        <option value="">-- Jadikan Kategori Utama --</option>
        @foreach($mainCategories as $main)
            <option value="{{ $main->id }}" {{ old('parent_id', $category->parent_id ?? '') == $main->id ? 'selected' : '' }}>
                {{ $main->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="image" class="mb-1.5 block text-sm font-medium text-gray-700">Gambar Kategori/Sub-Kategori</label>
    @if(isset($category) && $category->image)
        <div class="mb-2">
            <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : asset($category->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-xl">
        </div>
    @endif
    <input type="file" name="image" id="image" accept="image/*"
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
    <p class="mt-1 text-xs text-gray-500">Maksimal 2MB. Format: jpeg, jpg, png, webp.</p>
</div>
