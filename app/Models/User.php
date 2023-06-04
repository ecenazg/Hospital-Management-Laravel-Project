<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'password','national_id','birth_date','phone','blood_group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }



    // Short Cuts
    public function hasDepartment($departmentId){
        return in_array($departmentId,$this->departments->pluck('id')->toArray());
    }
}