<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreedingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'sow_id',
        'boar_id',
        'date_of_breeding',
        'expected_farrowing_date',
    ];

    public function sow()
    {
        return $this->belongsTo(Pig::class, 'sow_id');
    }

    public function boar()
    {
        return $this->belongsTo(Pig::class, 'boar_id');
    }
}