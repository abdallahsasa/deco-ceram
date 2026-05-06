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

    public function getHeroImageUrlAttribute()
    {
        if (!$this->hero_image) return asset('images/placeholder.jpg');
        if (str_starts_with($this->hero_image, 'http') || str_starts_with($this->hero_image, '/')) return $this->hero_image;
        return asset('storage/' . $this->hero_image);
    }

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) return asset('images/placeholder.jpg');
        if (str_starts_with($this->logo, 'http') || str_starts_with($this->logo, '/')) return $this->logo;
        return asset('storage/' . $this->logo);
    }
}
