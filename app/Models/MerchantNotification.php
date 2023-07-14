<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantNotification extends Model
{
    use HasFactory;

    public function Merchant()
    {
        return $this->belongsTo(Merchant::class,'merchant_id','id');
    }

    public function store()
    {
        return $this->belongsTo(MerchantStore::class,'store_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function status()
    {
        return $this->belongsTo(MerchantNotificationStatus::class,'status_id','id');
    }
}
