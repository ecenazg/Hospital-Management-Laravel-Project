<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurses extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'department_name'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_name', 'department_name');
    }

}
