<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $fillable = [
        'name',
        'banner',
        'description',
    ];
}
