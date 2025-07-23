<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'conditions',
        'discount',
        'discount_type',
        'start_at',
        'end_at',
        'precedence'
    ];
}
