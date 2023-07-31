<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    public function stores()
    {
        return $this->hasMany(MerchantStore::class,'merchant_id','id');
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

    public function m_warning_alerts()
    {
        return $this->belongsTo(MerchantWarningCard::class,'warning_id','id');
    }

    public function block_by_admin()
    {
        return $this->belongsTo(User::class,'block_by','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
