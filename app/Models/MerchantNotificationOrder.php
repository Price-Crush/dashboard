<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MerchantNotificationOrder extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(MerchantStore::class, 'store_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(MerchantNotificationOrderStatus::class, 'status_id', 'id');
    }

    public function notification_order_cities()
    {
        return $this->hasMany(NotificationCityOrder::class,'notification_order_id','id');
    }

    public function notification_order_states()
    {
        return $this->hasMany(NotificationStateOrder::class,'notification_order_id','id');
    }

    public function notification_order_countries()
    {
        return $this->hasMany(NotificationCountryOrder::class,'notification_order_id','id');
    }
    public function isLaunched()
    {
        $launchDate = new Carbon($this->launch_date);
        return $launchDate->isBefore(Carbon::now());
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class,'notification_order_customers', 'notification_order_id', 'customer_id');
    }

    public function notifiedCustomers()
    {
        return $this->belongsToMany(Customer::class,'notification_order_customers', 'notification_order_id', 'customer_id')->wherePivotNotNull('sent_at');
    }

}
