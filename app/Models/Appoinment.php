<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id','doctor_id','department_id','date','time','status','notes'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function doctors(){
        return $this->belongsTo(Users::class);
    }

    public function patients(){
        return $this->belongsTo(Users::class);
    }
}
