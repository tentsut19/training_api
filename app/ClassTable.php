<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTable extends Model
{
    protected $table ='class_table';

    public function students(){
        return $this->belongsTo(UserTable::class,'student_id');
    }
    public function course(){
        return $this->belongsTo(CourseTable::class,'course_id');
    }
}
