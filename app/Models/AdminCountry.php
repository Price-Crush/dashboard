<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCountry extends Model
{
    use HasFactory;

    protected $fillable=[
        'country_id',
        'user_id'
    ];


    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function customers(){
        return $this->hasMany(Customer::class,'resident_country','country_id');
    }

    public function merchants(){
        return $this->hasMany(Merchant::class,'country_id','country_id');
    }

    // Get stores of the country
    public function stores(){
        return $this->belongsToMany(MerchantStore::class,'store_countries','country_id','store_id');
    }
    // Get notification orders count of the country
    public function notificationOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->notificationOrders->count();

        return $count;
    }
    // Get banner orders count of the country
    public function bannerOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->bannerOrders->count();

        return $count;
    }
    // Get notification orders income of the country
    public function notificationOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->notificationOrders->sum('price');

        return $income;
    }
    // Get banner orders income of the country
    public function bannerOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->bannerOrders->sum('price');

        return $income;
    }

}
