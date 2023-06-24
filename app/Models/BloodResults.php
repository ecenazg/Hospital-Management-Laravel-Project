<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodResults extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'min',
        'max',
        'specialization',
        
    ];

    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'name', 'name');
    }
}
