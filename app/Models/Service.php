<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'is_starting_price',
        'duration_minutes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_starting_price' => 'boolean',
            'duration_minutes' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function formattedPrice(): string
    {
        $price = 'Rp ' . number_format($this->price, 0, ',', '.');
        return $this->is_starting_price ? 'Mulai ' . $price : $price;
    }
}
