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
        if (str_starts_with($this->hero_image, 'http')) return $this->hero_image;
        
        $cleanPath = ltrim($this->hero_image, '/');
        if (file_exists(public_path($cleanPath))) return asset($cleanPath);
        if (file_exists(storage_path('app/public/' . $cleanPath))) return asset('storage/' . $cleanPath);
        
        return asset('images/placeholder.jpg');
    }

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) return asset('images/placeholder.jpg');
        if (str_starts_with($this->logo, 'http')) return $this->logo;
        
        $cleanPath = ltrim($this->logo, '/');
        if (file_exists(public_path($cleanPath))) return asset($cleanPath);
        if (file_exists(storage_path('app/public/' . $cleanPath))) return asset('storage/' . $cleanPath);
        
        return asset('images/placeholder.jpg');
    }
}
