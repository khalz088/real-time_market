<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market_price extends Model
{
    protected $fillable = [
        'agricultural_product_id',
        'wholesale_price',
        'retail_price',
        'quantity_available',
        'is_organic',
        'price_trend',
        'price_change_percent',
    ];

    public function agriculturalProduct()
    {
        return $this->belongsTo(Agricultural_product::class);
    }
}
