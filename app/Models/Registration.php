<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'full_name',
        'age',
        'gender',
        'phone',
        'email',
        'address',
        'marathon_category',
        'registration_date',
        'emergency_contact_name',
        'emergency_contact_phone',
        'experience_level',
        'shirt_size',
    ];
}