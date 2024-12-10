<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='tb_product';

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }
}
