<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationOrderCustomer extends Model
{
    use HasFactory;

    protected $table = "notification_order_customers";

    protected $fillable = [
        'notification_order_id',
        'customer_id',
        'available_at',
        'sent_at'
    ];

    public function notification(){
        return $this->belongsTo(NotificationOrder::class,'notification_order_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
