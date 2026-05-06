<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'size_id',
        'sku',
        'price_full_pallet',
        'price_partial_pallet',
        'finish_type',
        'is_active',
        'name',
        'size',
        'finish',
        'thickness',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'price_full_pallet' => 'decimal:2',
        'price_partial_pallet' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the images.
     *
     * @param  string|null  $value
     * @return array
     */
    public function getImagesAttribute($value)
    {
        return json_decode($value ?? '[]', true) ?? [];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizeModel()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
