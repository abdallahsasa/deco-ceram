<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_request_id',
        'product_id',
        'variant_name',
        'meters',
        'quantity',
        'boxes',
        'pcs',
        'pcs_per_box',
        'sqm_per_box',
    ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getVariantAttribute()
    {
        if (!$this->variant_name) {
            return null;
        }

        preg_match('/^(.*?)\s*\((.*?)\)$/', $this->variant_name, $matches);
        if (count($matches) === 3) {
            $sizePart = trim($matches[1]);
            $finishPart = trim($matches[2]);

            return \App\Models\Variant::where('product_id', $this->product_id)
                ->where(function ($query) use ($sizePart) {
                    $query->where('size', $sizePart)
                          ->orWhereHas('sizeModel', function ($q) use ($sizePart) {
                              $q->where('name', $sizePart);
                          });
                })
                ->where('finish', $finishPart)
                ->first();
        }

        return null;
    }
}
