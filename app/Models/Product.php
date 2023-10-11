<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function store() {
        return $this->belongsTo(MerchantStore::class,'store_id');
    }
}
