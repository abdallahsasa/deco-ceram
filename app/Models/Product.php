<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'collection_id',
        'category_id',
        'material',
        'finish',
        'size',
        'thickness',
        'look',
        'color',
        'description',
        'technical_specs',
        'downloads',
        'applications',
        'images',
        'featured',
        'price_range'
    ];

    protected $casts = [
        'technical_specs' => 'array',
        'downloads' => 'array',
        'applications' => 'array',
        'images' => 'array',
        'featured' => 'boolean',
    ];

    /**
     * Get the technical specs.
     *
     * @param  string|null  $value
     * @return array
     */
    public function getTechnicalSpecsAttribute($value)
    {
        return json_decode($value ?? '[]', true) ?? [];
    }

    /**
     * Get the downloads.
     *
     * @param  string|null  $value
     * @return array
     */
    public function getDownloadsAttribute($value)
    {
        return json_decode($value ?? '[]', true) ?? [];
    }

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

    /**
     * Get the applications.
     *
     * @param  string|null  $value
     * @return array
     */
    public function getApplicationsAttribute($value)
    {
        return json_decode($value ?? '[]', true) ?? [];
    }

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($product) {
            if (!$product->id) {
                $slug = Str::slug($product->name);
                $product->id = $product->collection_id . '-' . $slug;
            }

            if (!$product->category_id && $product->collection_id) {
                $product->category_id = $product->collection?->category_id;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_product');
    }

    public function getPrimaryImageUrlAttribute()
    {
        $image = $this->images[0] ?? null;
        if (!$image) return asset('images/placeholder.jpg');
        
        if (str_starts_with($image, 'http')) return $image;
        
        $cleanPath = ltrim($image, '/');
        
        // Check public folder
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }
        
        // Check storage folder (via /storage link)
        if (file_exists(storage_path('app/public/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }
        
        return asset('images/placeholder.jpg');
    }

    public function getGalleryUrlsAttribute()
    {
        return collect($this->images)->map(function ($image) {
            if (str_starts_with($image, 'http')) return $image;
            $cleanPath = ltrim($image, '/');
            if (file_exists(public_path($cleanPath))) return asset($cleanPath);
            if (file_exists(storage_path('app/public/' . $cleanPath))) return asset('storage/' . $cleanPath);
            return asset('images/placeholder.jpg');
        })->toArray();
    }
}
