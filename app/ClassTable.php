<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTable extends Model
{
    protected $table ='class_table';

    public function userTable() {
        return $this->hasMany(UserTable::class);
    }
    public function courseTable() {
        return $this->belongsTo(CourseTable::class);
    }
}
