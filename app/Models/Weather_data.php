<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather_data extends Model
{
    protected $fillable = [
        'forecast_date',
        'temperature_high',
        'temperature_low',
        'rainfall',
        'humidity',
        'weather_condition',
    ];

    protected function casts()
    {
        return [
            'forecast_date' => 'date',
        ];
    }
}
