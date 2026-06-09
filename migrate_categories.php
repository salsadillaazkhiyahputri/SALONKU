<?php
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

$images = [
    'Hair Treatment' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
    'Nails' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=800&q=80',
    'Face Treatment' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80'
];

$descriptions = [
    'Hair Treatment' => 'Perawatan rambut profesional untuk menjaga kesehatan dan keindahan rambut Anda.',
    'Nails' => 'Layanan perawatan kuku lengkap untuk kuku yang cantik dan sehat.',
    'Face Treatment' => 'Perawatan wajah dengan produk berkualitas untuk kulit cerah dan bersinar.'
];

DB::transaction(function () use ($images, $descriptions) {
    $mainCats = [];
    foreach(['Hair Treatment', 'Nails', 'Face Treatment'] as $catName) {
        $cat = Category::create([
            'name' => $catName,
            'parent_category' => null,
            'description' => $descriptions[$catName],
            'image' => $images[$catName]
        ]);
        $mainCats[$catName] = $cat->id;
    }

    $services = Service::with('category')->get();
    foreach($services as $service) {
        $parentName = $service->category ? $service->category->parent_category : null;
        if (isset($mainCats[$parentName])) {
            $service->update(['category_id' => $mainCats[$parentName]]);
        }
    }

    $newIds = array_values($mainCats);
    // Remove foreign key constraints temporarily if needed, but since we updated the services, they should be fine
    Category::whereNotIn('id', $newIds)->delete();
});
echo "Migration complete.\n";
