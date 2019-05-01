<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = [
        'secretKey', 'teacher_id','section_id','subject_id'
    ];
}
