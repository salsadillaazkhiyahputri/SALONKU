<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('id')->constrained('categories')->cascadeOnDelete();
        });

        // Remap data
        $mains = [
            'Hair Treatment' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80',
            'Nails' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&w=800&q=80',
            'Face Treatment' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=800&q=80',
        ];

        $mainIds = [];
        foreach ($mains as $name => $image) {
            $id = DB::table('categories')->insertGetId([
                'name' => $name,
                'image' => $image,
                'description' => "Kategori Utama: $name",
                'parent_category' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $mainIds[$name] = $id;
        }

        DB::table('categories')->whereNotNull('parent_category')->orderBy('id')->chunk(100, function ($categories) use ($mainIds) {
            foreach ($categories as $cat) {
                if (isset($mainIds[$cat->parent_category])) {
                    DB::table('categories')->where('id', $cat->id)->update([
                        'parent_id' => $mainIds[$cat->parent_category]
                    ]);
                }
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('parent_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('parent_category')->nullable()->after('name');
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
