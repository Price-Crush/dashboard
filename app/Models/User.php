<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_type()
    {
        return $this->hasOne(UserType::class , 'id','user_type_id');
    }

    public function level()
    {
        return $this->belongsTo(AdminPromotionLevel::class ,'promotion_level_id', 'id');
    }
    // Get ids of the cities the user is managing 
    public function executive_cities()
    {
        return $this->hasMany(AdminCity::class,'user_id','id');
    }
    // Get ids the states the user is managing 
    public function executive_states()
    {
        return $this->hasMany(AdminState::class,'user_id','id');
    }
    // Get ids of the countries the user is managing 
    public function executive_countries()
    {
        return $this->hasMany(AdminCountry::class,'user_id','id');
    }

    // Get ids of the stores in the cities the user is managing 
    public function getCityStoreIds(){
        return MerchantStore::whereIn('city_id',$this->executive_cities()->pluck('city_id'))->pluck('id');
    }
    // Get ids of the stores in the states the user is managing 
    public function getStateStoreIds(){
        return MerchantStore::whereIn('state_id',auth()->user()->executive_states()->pluck('state_id'))->pluck('id');
    }
    // Get ids of the stores in the countries the user is managing 
    public function getCountryStoreIds(){
        return MerchantStore::whereIn('country_id',auth()->user()->executive_countries()->pluck('country_id'))->pluck('id');
    }
     // Get ids of all stores the user is managing 
     public function getStoreIds(){
        return $this->getCityStoreIds()->merge($this->getStateStoreIds())->merge($this->getCountryStoreIds());
     }

    // Get ids of the customers in the cities the user is managing 
    public function getCityCustomerIds(){
        return Customer::whereIn('city_id',$this->executive_cities()->pluck('city_id'))->pluck('id');
    }
    // Get ids of the customers in the states the user is managing 
    public function getStateCustomerIds(){
        return Customer::whereIn('state_id',auth()->user()->executive_states()->pluck('state_id'))->pluck('id');
    }
    // Get ids of the customers in the countries the user is managing 
    public function getCountryCustomerIds(){
        return Customer::whereIn('resident_country',auth()->user()->executive_countries()->pluck('country_id'))->pluck('id');
    }
    // Get ids of all customers the user is managing 
    public function getCustomerIds(){
        return $this->getCityCustomerIds()->merge($this->getStateCustomerIds())->merge($this->getCountryCustomerIds());
    }
    // Get all notifications the user is managing 
    public function getNotificationOrders(){
        return ($this->hasRole('high_manager'))? new MerchantNotificationOrder() : MerchantNotificationOrder::whereIn('store_id',$this->getStoreIds());
    }
    // Get all banners the user is managing 
    public function getStoreBannerOrderOrders(){
        return ($this->hasRole('high_manager'))? new StoreBannerOrder() : StoreBannerOrder::whereIn('store_id',$this->getStoreIds());
    }
    // Get all customers the user is managing 
    public function getCustomers(){
        return ($this->hasRole('high_manager'))? Customer::where('is_anonymous', 0) : Customer::whereIn('id',$this->getCustomerIds())->where('is_anonymous', 0);
    }
    // Get all merchants the user is managing 
    public function getMerchants(){
        return ($this->hasRole('high_manager'))? new Merchant() 
        : Merchant::whereIn('city_id',$this->executive_cities()->pluck('city_id'))
        ->orWhereIn('state_id',$this->executive_states()->pluck('state_id'))
        ->orWhereIn('country_id',$this->executive_countries()->pluck('country_id'));
    }
    // Get all merchants the user is managing 
    public function getStores(){
        return ($this->hasRole('high_manager'))? new MerchantStore() 
        : MerchantStore::whereIn('city_id',$this->executive_cities()->pluck('city_id'))
        ->orWhereIn('state_id',$this->executive_states()->pluck('state_id'))
        ->orWhereIn('country_id',$this->executive_countries()->pluck('country_id'));
    }
    // Get all merchant offers the user is managing 
    public function getMerchantOffers(){
        return ($this->hasRole('high_manager'))? new MerchantOffer() : MerchantOffer::whereIn('store_id',$this->getStoreIds());
    }
    // Get all merchant notifications the user is managing 
    public function getMerchantNotifications(){
        return ($this->hasRole('high_manager'))? new MerchantNotification() : MerchantNotification::whereIn('store_id',$this->getStoreIds());
    }

    // Get list of cities the user is managing 
    public function getCities(){
        return ($this->hasRole('high_manager'))? new City() : City::whereIn('id',$this->executive_cities()->pluck('city_id'));
    }
    // Get list of states the user is managing 
    public function getStates(){
        return ($this->hasRole('high_manager'))? new State() : State::whereIn('id',$this->executive_states()->pluck('state_id'));
    }
    // Get list of countries the user is managing 
    public function getCountries(){
        return ($this->hasRole('high_manager'))? new Country() : Country::whereIn('id',$this->executive_countries()->pluck('country_id'));
    }

}
