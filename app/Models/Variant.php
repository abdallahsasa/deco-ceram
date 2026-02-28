<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'size',
        'finish',
        'thickness',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
