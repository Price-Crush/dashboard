<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreBanner extends Model
{
    use HasFactory;

    public function merchant()
    {
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }

    public function store()
    {
        return $this->belongsTo(MerchantStore::class,'store_id','id');
    }

    public function status()
    {
        return $this->belongsTo(StoreBannerOrderStatus::class,'status_id','id');
    }
}
