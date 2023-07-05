<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'patient_id',
        'name',
        'phone_number',
        'location',
        'year_of_birth',
        'visit_count',
        'last_visit',
        'illness',
        'email',
        'test',
        'department_name',
        'doctor_id',

    ];
    protected $casts = [
        'last_visit' => 'date',
    ];

    public function getLastVisitAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class)
            ->orderBy('id', 'desc');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    public function laboratory()
{
    return $this->belongsTo(Laboratory::class, 'test', 'name');
}



}
