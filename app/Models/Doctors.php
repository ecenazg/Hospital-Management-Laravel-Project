<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'name',
        'email',
        'specialization',
        'department_name',
        
        
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_name', 'department_name');
    }
}
