<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCity extends Model
{
    use HasFactory;

    protected $fillable=[
        'city_id',
        'user_id'
    ];

    public function cities()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function customers(){
        return $this->hasMany(Customer::class,'city_id','city_id');
    }

    public function merchants(){
        return $this->hasMany(Merchant::class,'city_id','city_id');
    }

    // Get stores of the city
    public function stores(){
        return $this->hasMany(MerchantStore::class,'city_id','city_id');
    }
    // Get notification orders count of the city
    public function notificationOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->notificationOrders->count();

        return $count;
    }
    // Get banner orders count of the city
    public function bannerOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->bannerOrders->count();

        return $count;
    }
    // Get notification orders income of the city
    public function notificationOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->notificationOrders->sum('price');

        return $income;
    }
    // Get banner orders income of the city
    public function bannerOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->bannerOrders->sum('price');

        return $income;
    }
}
