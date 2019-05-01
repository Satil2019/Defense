<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section_student extends Model
{
    protected $fillable = [
        'section_id', 'student_id','sectionName','subjectName'
    ];
}
