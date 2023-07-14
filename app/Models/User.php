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

    public function executive_cities()
    {
        return $this->hasMany(AdminCity::class,'user_id','id');
    }

    public function executive_states()
    {
        return $this->hasMany(AdminState::class,'user_id','id');
    }

    public function executive_countries()
    {
        return $this->hasMany(AdminCountry::class,'user_id','id');
    }
}
