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
    <label for="image" class="mb-1.5 block text-sm font-medium text-gray-700">URL Gambar (Unsplash)</label>
    <input type="url" name="image" id="image" value="{{ old('image', $category->image ?? '') }}"
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
</div>
