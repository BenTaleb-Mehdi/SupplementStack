<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_percentage',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relationship to Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate discounted price
    public function getDiscountedPriceAttribute()
    {
        $originalPrice = $this->product->price;
        $discount = ($originalPrice * $this->discount_percentage) / 100;
        return $originalPrice - $discount;
    }

    // Scope for active promotions
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
            });
    }
}
