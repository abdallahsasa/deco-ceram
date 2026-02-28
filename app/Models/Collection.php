<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'id',
        'brand_id',
        'category_id',
        'name',
        'slug',
        'hero_image',
        'description'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
