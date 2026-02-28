<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'logo',
        'hero_image',
        'description',
        'official_distributor'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
