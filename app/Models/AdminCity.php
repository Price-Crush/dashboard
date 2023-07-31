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
}
