<div>
    <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Sub-Kategori (Misal: Hair Colouring)</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" required
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200">
</div>

<div>
    <label for="parent_category" class="mb-1.5 block text-sm font-medium text-gray-700">Nama Super Kategori (Kartu Depan, Misal: Hair Treatment)</label>
    <input type="text" name="parent_category" id="parent_category" value="{{ old('parent_category', $category->parent_category ?? '') }}"
           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 transition focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-200" placeholder="Kosongkan jika ini bukan Sub-Kategori">
    <p class="mt-1 text-xs text-gray-500">Semua sub-kategori dengan Super Kategori yang sama akan disatukan di 1 kartu depan.</p>
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
