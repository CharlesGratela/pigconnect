<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pig extends Model
{
    use HasFactory;

    protected $primaryKey = 'PigId'; // Specify the primary key column

    protected $fillable = [
        'user_id',
        'weight',
        'date_of_birth',
        'gender',
        'image',
        'mark',
        'breed',
        'price_per_kilo',
        'status',
    ];
        public function vaccinationRecords()
        {
            return $this->hasMany(VaccinationRecord::class);
        }
}