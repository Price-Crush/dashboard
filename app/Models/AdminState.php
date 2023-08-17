<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminState extends Model
{
    use HasFactory;
    protected $fillable=[
        'state_id',
        'user_id'
    ];


    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function customers(){
        return $this->hasMany(Customer::class,'state_id','state_id');
    }

    public function merchants(){
        return $this->hasMany(Merchant::class,'state_id','state_id');
    }

    // Get stores of the state
    public function stores(){
        return $this->hasMany(MerchantStore::class,'state_id','state_id');
    }
    // Get notification orders count of the state
    public function notificationOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->notificationOrders->count();

        return $count;
    }
    // Get banner orders count of the state
    public function bannerOrdersCount()
    {
        $count = 0;
        foreach($this->stores as $store)
            $count += $store->bannerOrders->count();

        return $count;
    }
    // Get notification orders income of the state
    public function notificationOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->notificationOrders->sum('price');

        return $income;
    }
    // Get banner orders income of the state
    public function bannerOrdersIncome()
    {
        $income = 0;
        foreach($this->stores as $store)
            $income += $store->bannerOrders->sum('price');

        return $income;
    }
}
