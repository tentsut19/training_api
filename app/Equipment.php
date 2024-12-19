<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table ='tb_equipment';

    public function stock() {
        return $this->belongsTo(Stock::class);
    }
}
