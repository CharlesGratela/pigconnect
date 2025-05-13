<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age_of_pigs',
        'price_range',
        'preferred_weight',
        'prefer_nearby',
        'breed', // Add the breed field
    ];
}