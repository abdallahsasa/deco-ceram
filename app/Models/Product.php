<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
