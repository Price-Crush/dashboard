<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StoreBannerOrder extends Model
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

    public function banner_order_cities()
    {
        return $this->hasMany(BannerCityOrder::class,'banner_order_id','id');
    }

    public function banner_order_states()
    {
        return $this->hasMany(BannerStateOrder::class,'banner_order_id','id');
    }

    public function banner_order_countries()
    {
        return $this->hasMany(BannerCountryOrder::class,'banner_order_id','id');
    }

    public function isLaunched() : bool {
        $launchDate = new Carbon($this->to_date);
        return $launchDate->isBefore(Carbon::now());
    }

}
