<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
        'name',
        'type',
        'location',
        'summary',
        'description',
        'images',
        'featured'
    ];

    protected $casts = [
        'images' => 'array',
        'featured' => 'boolean',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'project_product');
    }
}
