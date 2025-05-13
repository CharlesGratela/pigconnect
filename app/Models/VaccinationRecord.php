<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pigId',
        'vaccineName',
        'vaccineType',
        'dateAdministered',
        'vaccine_image',
    ];

    public function pig()
    {
        return $this->belongsTo(Pig::class, 'pigId');
    }
}