<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantStore extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function primary_language()
    {
        return $this->belongsTo(Language::class,'primary_store_language','id');
    }

    public function secondry_language()
    {
        return $this->belongsTo(Language::class,'second_store_language','id');
    }

    public function appearance_level()
    {
        return $this->belongsTo(StoreAppearanceLevel::class,'appearance_level_id','id');
    }

    public function store_status()
    {
        return $this->belongsTo(MerchantStoreStatus::class,'status_id','id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function store_cities()
    {
        return $this->hasMany(StoreCity::class,'store_id','id');
    }

    public function store_states()
    {
        return $this->hasMany(StoreState::class,'store_id','id');
    }

    public function store_countries()
    {
        return $this->hasMany(StoreCountry::class,'store_id','id');
    }

    public function store_categories()
    {
        return $this->hasMany(StoreCategory::class,'store_id','id');
    }

    public function store_rates()
    {
        return $this->hasMany(StoreRate::class,'store_id','id');
    }

    public function store_banners()
    {
        return $this->hasMany(StoreBanner::class,'store_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'store_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    public function notificationOrders()
    {
        return $this->hasMany(MerchantNotificationOrder::class,'store_id');
    }
    public function bannerOrders()
    {
        return $this->hasMany(StoreBannerOrder::class,'store_id');
    }
}
