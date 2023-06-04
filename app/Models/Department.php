<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_head',
        'description',
        
    ];
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function doctors(){
        return $this->belongsToMany(User::class)->Doctor();
    }

    public function patients(){
        return $this->belongsToMany(User::class)->Patient();
    }
}
