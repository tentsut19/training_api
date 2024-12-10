<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table ='tb_product_category';
    
    public function products() {
        return $this->hasMany(Product::class);
    }
}