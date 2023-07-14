<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function business_sectors()
    {
        return $this->belongsTo(BusinessSector::class, 'business_sector_id', 'id');
    }

    public function education_status()
    {
        return $this->belongsTo(EducationalStatus::class, 'educational_status_id', 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function c_resident_country()
    {
        return $this->belongsTo(Country::class, 'resident_country', 'id');
    }

    public function customer_fav_lang()
    {
        return $this->belongsTo(Language::class, 'fav_lang', 'id');
    }

    public function second_fav_lang()
    {
        return $this->belongsTo(Language::class, 'sec_fav_lang', 'id');
    }

    public function customer_cities()
    {
        return $this->hasMany(CustomerCity::class,'customer_id','id');
    }

    public function customer_states()
    {
        return $this->hasMany(CustomerState::class,'customer_id','id');
    }

    public function customer_countries()
    {
        return $this->hasMany(CustomerCountry::class,'customer_id','id');
    }

    public function customer_categories()
    {
        return $this->hasMany(CustomerFavCategory::class,'customer_id','id');
    }

    public function customer_stores()
    {
        return $this->hasMany(CustomerFavStore::class,'customer_id','id');
    }

    public function block_by_admin()
    {
        return $this->belongsTo(User::class,'block_by','id');
    }

    public function c_warning_alerts()
    {
        return $this->belongsTo(MerchantWarningCard::class,'warning_id','id');
    }
}
