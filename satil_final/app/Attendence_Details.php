<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence_Details extends Model
{
    protected $fillable = [
        'teacher_id', 'is_present', 'password','user_type'
    ];
}
