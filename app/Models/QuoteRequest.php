<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'project_type',
        'message',
        'address',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(QuoteRequestItem::class);
    }

    public function getTotalWeight()
    {
        $totalWeight = 0;
        foreach ($this->items as $item) {
            $variant = $item->variant;
            if ($variant && $variant->sizeModel && $variant->sizeModel->kg_per_box) {
                $totalWeight += $item->boxes * $variant->sizeModel->kg_per_box;
            } else {
                // fallback: 24 kg per sqm
                $totalWeight += ($item->meters ?? 0) * 24;
            }
        }
        return ceil($totalWeight);
    }

    public function getTotalPallets()
    {
        $totalPallets = 0;
        foreach ($this->items as $item) {
            $variant = $item->variant;
            if ($variant && $variant->sizeModel && $variant->sizeModel->boxes_per_pallet > 0) {
                $totalPallets += ceil($item->boxes / $variant->sizeModel->boxes_per_pallet);
            } else {
                // fallback: 40 boxes per pallet
                $totalPallets += ceil(($item->boxes ?? 1) / 40);
            }
        }
        return max(1, $totalPallets);
    }
}
