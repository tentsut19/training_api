<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTable extends Model
{
    protected $table ='course_table';

    public function userTable() {
        return $this->belongsTo(UserTable::class);
    }
}
