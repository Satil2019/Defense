<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section_teacher extends Model
{
    protected $fillable = [
        'section_id', 'teacher_id','sectionName','subjectName'
    ];
}
