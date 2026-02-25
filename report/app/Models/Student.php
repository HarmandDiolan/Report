<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 
        'course', 
        'office', 
        'contactNumber', 
        'dateStart',
        'hoursOfDuty',
        'daysOfDuty',
        'endOfDuty',
        'school_id'
    ];

    public function schools(){

        return this->belongsTo(School::class);

    }

    public function offices(){

        return $this->hasMany(Office::class);
    }
}
