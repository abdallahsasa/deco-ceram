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
        'status',
    ];

    public function items()
    {
        return $this->hasMany(QuoteRequestItem::class);
    }
}
