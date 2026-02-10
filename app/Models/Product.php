<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'material',
        'finish',
        'size',
        'thickness',
        'look',
        'color',
        'collection',
        'description',
        'applications',
        'images',
        'featured',
        'price_range'
    ];

    protected $casts = [
        'applications' => 'array',
        'images' => 'array',
        'featured' => 'boolean',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_product');
    }
}
