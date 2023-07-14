<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantOffer extends Model
{
    use HasFactory;

    public function store()
    {
        return $this->belongsTo(MerchantStore::class,'store_id','id');
    }


    public function status()
    {
        return $this->belongsTo(MerchantOfferStatus::class,'status_id','id');
    }

}
