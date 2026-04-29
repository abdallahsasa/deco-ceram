<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'id',
        'name',
        'dimensions',
        'thickness',
        'pcs_per_box',
        'sqm_per_box',
        'kg_per_box',
        'boxes_per_pallet',
        'sqm_per_pallet',
        'kg_per_pallet',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
