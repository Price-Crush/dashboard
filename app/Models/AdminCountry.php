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
}
