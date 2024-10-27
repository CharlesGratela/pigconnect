<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pig extends Model
{
    use HasFactory;

    protected $fillable = [
        'pigfarmID',
        'weight',
        'date_of_birth',
        'gender',
        'image',
        'status',
    ];
}