<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'name',
        'illness',
        'email',
        'test',
        'department_name',
        'doctor_id',

    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    public function laboratory()
{
    return $this->belongsTo(Laboratory::class, 'test', 'name');
}



}
