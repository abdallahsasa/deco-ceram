<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'slug', 'description', 'image'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
