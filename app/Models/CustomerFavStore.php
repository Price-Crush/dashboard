<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFavStore extends Model
{
    use HasFactory;

    public function stores()
    {
        return $this->belongsTo(MerchantStore::class,'store_id','id');
    }
}
