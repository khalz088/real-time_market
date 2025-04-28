<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'user_id'
    ];

    public function agriculturalProduct()
    {
        return $this->belongsTo(Agricultural_product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
