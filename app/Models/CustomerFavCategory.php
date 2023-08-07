<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFavCategory extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}