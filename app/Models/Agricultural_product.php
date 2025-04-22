<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agricultural_product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'measurement_unit',
        'seasonal',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function market_price()
    {
        return $this->hasMany(Market_price::class);
    }
}
