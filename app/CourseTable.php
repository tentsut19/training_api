<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTable extends Model
{
    protected $table ='course_table';

    public function teacher() {
        return $this->belongsTo(UserTable::class,'teacher_id');
    }
}
