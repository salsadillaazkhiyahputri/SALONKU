<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\Stylist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SalonKu',
            'email' => 'admin@salonku.test',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'customer@salonku.test',
            'password' => Hash::make('password'),
            'role' => User::ROLE_CUSTOMER,
            'phone' => '081298765432',
        ]);

        // Kategori Utama
        $mains = [
            'Hair Treatment' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
            'Nails' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=800&q=80',
            'Face Treatment' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80',
        ];

        $mainIds = [];
        foreach ($mains as $name => $image) {
            $main = Category::create([
                'name' => $name,
                'image' => $image,
                'description' => "Kategori Utama: $name",
                'parent_id' => null,
            ]);
            $mainIds[$name] = $main->id;
        }

        // Sub Kategori
        $subCategoriesData = [
            // Hair
            ['name' => 'Hair Treatment', 'parent_id' => $mainIds['Hair Treatment'], 'image' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80', 'description' => 'Perawatan rambut dasar.'],
            ['name' => 'Hair Colouring', 'parent_id' => $mainIds['Hair Treatment'], 'image' => 'https://images.unsplash.com/photo-1620331311520-246422fd82f9?auto=format&fit=crop&w=800&q=80', 'description' => 'Pewarnaan rambut profesional.'],
            ['name' => 'Hair Spa / Mask', 'parent_id' => $mainIds['Hair Treatment'], 'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80', 'description' => 'Spa dan masker rambut.'],
            
            // Nails
            ['name' => 'Manicure', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=800&q=80', 'description' => 'Perawatan kuku tangan.'],
            ['name' => 'Pedicure', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1516975080661-46bba2040bb0?auto=format&fit=crop&w=800&q=80', 'description' => 'Perawatan kuku kaki.'],
            ['name' => 'PO Press On Nail', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059e98b?auto=format&fit=crop&w=800&q=80', 'description' => 'Kuku palsu custom.'],
            ['name' => 'Design', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?auto=format&fit=crop&w=800&q=80', 'description' => 'Seni desain kuku.'],
            ['name' => 'Extension', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1519014816548-bf5fe059e98b?auto=format&fit=crop&w=800&q=80', 'description' => 'Ekstensi kuku.'],
            ['name' => 'Removal', 'parent_id' => $mainIds['Nails'], 'image' => 'https://images.unsplash.com/photo-1599305090598-fe179d501227?auto=format&fit=crop&w=800&q=80', 'description' => 'Penghapusan gel/ekstensi.'],
            
            // Face
            ['name' => 'Face Treatment', 'parent_id' => $mainIds['Face Treatment'], 'image' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80', 'description' => 'Perawatan wajah.'],
        ];

        $categoryIds = [];
        foreach ($subCategoriesData as $cat) {
            $created = Category::create($cat);
            $categoryIds[$cat['name']] = $created->id;
        }

        $services = [
            // Hair Treatment
            ['category' => 'Hair Treatment', 'name' => 'Potong', 'price' => 15000, 'duration_minutes' => 30],
            ['category' => 'Hair Treatment', 'name' => 'Potong Cuci Tonik', 'price' => 20000, 'duration_minutes' => 45],
            ['category' => 'Hair Treatment', 'name' => 'Potong Cuci Blow', 'price' => 20000, 'duration_minutes' => 45],
            ['category' => 'Hair Treatment', 'name' => 'Cuci Catok', 'price' => 25000, 'duration_minutes' => 45],
            ['category' => 'Hair Treatment', 'name' => 'Cuci Blow', 'price' => 25000, 'duration_minutes' => 45],
            ['category' => 'Hair Treatment', 'name' => 'Cuci Curly', 'price' => 25000, 'duration_minutes' => 45],
            ['category' => 'Hair Treatment', 'name' => 'Smoothing', 'price' => 150000, 'duration_minutes' => 120],
            ['category' => 'Hair Treatment', 'name' => 'Toning', 'price' => 150000, 'duration_minutes' => 60],
            
            // Hair Colouring
            ['category' => 'Hair Colouring', 'name' => 'Pendek', 'price' => 100000, 'duration_minutes' => 90],
            ['category' => 'Hair Colouring', 'name' => 'Medium', 'price' => 120000, 'duration_minutes' => 90],
            ['category' => 'Hair Colouring', 'name' => 'Panjang', 'price' => 200000, 'duration_minutes' => 120],
            ['category' => 'Hair Colouring', 'name' => 'Highlight', 'price' => 250000, 'duration_minutes' => 150],
            ['category' => 'Hair Colouring', 'name' => 'Ombre', 'price' => 200000, 'duration_minutes' => 150],
            
            // Hair Spa / Mask
            ['category' => 'Hair Spa / Mask', 'name' => 'Pendek', 'price' => 70000, 'duration_minutes' => 60],
            ['category' => 'Hair Spa / Mask', 'name' => 'Medium', 'price' => 100000, 'duration_minutes' => 60],
            ['category' => 'Hair Spa / Mask', 'name' => 'Panjang', 'price' => 150000, 'duration_minutes' => 60],
            ['category' => 'Hair Spa / Mask', 'name' => 'Creambath', 'price' => 200000, 'duration_minutes' => 60],

            // Manicure
            ['category' => 'Manicure', 'name' => 'Manicure (Wudhu Friendly)', 'price' => 55000, 'duration_minutes' => 45],
            ['category' => 'Manicure', 'name' => 'Manicure Gel (Basic)', 'price' => 75000, 'duration_minutes' => 60],
            ['category' => 'Manicure', 'name' => 'Manicure Gel (Cat Eye/Glitter)', 'price' => 90000, 'duration_minutes' => 60],
            ['category' => 'Manicure', 'name' => 'Manicure Gel (Art/Design)', 'price' => 85000, 'duration_minutes' => 90],
            ['category' => 'Manicure', 'name' => 'Additional Leveling/Overlay', 'price' => 3000, 'duration_minutes' => 15],

            // PO Press On Nail
            ['category' => 'PO Press On Nail', 'name' => 'Basic Color', 'price' => 40000, 'duration_minutes' => 30],
            ['category' => 'PO Press On Nail', 'name' => 'Press On Nail With Design', 'price' => 55000, 'duration_minutes' => 45],
            ['category' => 'PO Press On Nail', 'name' => 'Additional Liquid Glue', 'price' => 5000, 'duration_minutes' => 5],
            ['category' => 'PO Press On Nail', 'name' => 'Additional Sticker Glue', 'price' => 2000, 'duration_minutes' => 5],
            ['category' => 'PO Press On Nail', 'name' => 'Add Press On Tool Kit', 'price' => 2000, 'duration_minutes' => 5],
            ['category' => 'PO Press On Nail', 'name' => 'Additional Req Shape/Length', 'price' => 1000, 'duration_minutes' => 5],

            // Design
            ['category' => 'Design', 'name' => 'Marble', 'price' => 3000, 'duration_minutes' => 15],
            ['category' => 'Design', 'name' => 'Air Brush', 'price' => 5000, 'duration_minutes' => 15],
            ['category' => 'Design', 'name' => 'Painting', 'price' => 5000, 'duration_minutes' => 15],
            ['category' => 'Design', 'name' => 'French', 'price' => 3000, 'duration_minutes' => 10],
            ['category' => 'Design', 'name' => '3D', 'price' => 5000, 'duration_minutes' => 15],
            ['category' => 'Design', 'name' => 'Chrome', 'price' => 4000, 'duration_minutes' => 10],
            ['category' => 'Design', 'name' => 'Sticker', 'price' => 1000, 'duration_minutes' => 5],
            ['category' => 'Design', 'name' => 'Accessories', 'price' => 7000, 'duration_minutes' => 5],

            // Extension
            ['category' => 'Extension', 'name' => 'Fake Nail Regular', 'price' => 7000, 'duration_minutes' => 15],
            ['category' => 'Extension', 'name' => 'Fake Nail Premium', 'price' => 9000, 'duration_minutes' => 15],
            ['category' => 'Extension', 'name' => 'Hard Gel (Builder Gel)', 'price' => 13000, 'duration_minutes' => 20],
            ['category' => 'Extension', 'name' => 'Refill Gel', 'price' => 5000, 'duration_minutes' => 15],
            ['category' => 'Extension', 'name' => 'Additional Request for Shape / Length', 'price' => 3000, 'duration_minutes' => 10],

            // Removal
            ['category' => 'Removal', 'name' => 'Remove Nail Gel (Luxemynails)', 'price' => 4000, 'duration_minutes' => 15],
            ['category' => 'Removal', 'name' => 'Remove Nail Gel (Other Salon)', 'price' => 7000, 'duration_minutes' => 15],
            ['category' => 'Removal', 'name' => 'Remove Fake Nail (Luxemynails)', 'price' => 5000, 'duration_minutes' => 15],
            ['category' => 'Removal', 'name' => 'Remove Fake Nail (Other Salon)', 'price' => 9000, 'duration_minutes' => 15],
            ['category' => 'Removal', 'name' => 'Additional for Remove 3D / Acc', 'price' => 5000, 'duration_minutes' => 10],
            ['category' => 'Removal', 'name' => 'Remove Kit', 'price' => 20000, 'duration_minutes' => 10],

            // Pedicure
            ['category' => 'Pedicure', 'name' => 'Pedicure Gel', 'price' => 90000, 'duration_minutes' => 60],
            ['category' => 'Pedicure', 'name' => 'Callus Treatment', 'price' => 40000, 'duration_minutes' => 30],
            ['category' => 'Pedicure', 'name' => 'Ingrown Nail Treatment', 'price' => 30000, 'duration_minutes' => 30],

            // Face Treatment
            ['category' => 'Face Treatment', 'name' => 'Facial Basic', 'price' => 100000, 'duration_minutes' => 60],
            ['category' => 'Face Treatment', 'name' => 'Facial Acne/Detox', 'price' => 150000, 'duration_minutes' => 90],
            ['category' => 'Face Treatment', 'name' => 'Facial Anti Aging', 'price' => 200000, 'duration_minutes' => 90],
            ['category' => 'Face Treatment', 'name' => 'Totok Wajah', 'price' => 50000, 'duration_minutes' => 30],
        ];

        foreach ($services as $svc) {
            Service::create([
                'name' => $svc['name'],
                'category_id' => $categoryIds[$svc['category']],
                'description' => null,
                'price' => $svc['price'],
                'duration_minutes' => $svc['duration_minutes'],
                'is_active' => true,
            ]);
        }

        Stylist::insert([
            // Hair Treatment Stylists
            [
                'name' => 'Sari Dewi',
                'specialty' => 'Hair Treatment',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Kartika',
                'specialty' => 'Hair Treatment',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Hairdo',
                'specialty' => 'Hair Treatment',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Nails Stylists
            [
                'name' => 'Maya Indah',
                'specialty' => 'Nails',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siska Nails',
                'specialty' => 'Nails',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lili Extension',
                'specialty' => 'Nails',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Face Treatment Stylists
            [
                'name' => 'Dewi Lestari',
                'specialty' => 'Face Treatment',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayu Skincare',
                'specialty' => 'Face Treatment',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
