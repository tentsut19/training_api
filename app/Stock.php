<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table ='tb_stock';

    public function equipments() {
        return $this->hasMany(Equipment::class);
    }
}
