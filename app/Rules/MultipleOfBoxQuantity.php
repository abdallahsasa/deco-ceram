<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Variant;

class MultipleOfBoxQuantity implements ValidationRule
{
    protected $variantId;

    public function __construct($variantId)
    {
        $this->variantId = $variantId;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $variant = Variant::with('sizeModel')->find($this->variantId);

        if (!$variant || !$variant->sizeModel) {
            return;
        }

        $pcsPerBox = $variant->sizeModel->pcs_per_box;
        $sqmPerBox = $variant->sizeModel->sqm_per_box;

        // If the value is pieces
        if (is_int($value) && $value % $pcsPerBox !== 0) {
            $fail("The quantity must be a multiple of the box quantity ($pcsPerBox pieces).");
        }

        // If the value is sqm (we check if it matches a multiple of sqm_per_box with small epsilon for floating point)
        if (is_numeric($value) && $sqmPerBox > 0) {
            $remainder = fmod($value, $sqmPerBox);
            if ($remainder > 0.0001 && ($sqmPerBox - $remainder) > 0.0001) {
                $fail("The area must be a multiple of the box coverage ($sqmPerBox sqm).");
            }
        }
    }
}
