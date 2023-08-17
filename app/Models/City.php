<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id',
        'name_ar',
        'name_en',
        'name_tr',
        'user_banner_price',
    ];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }
}
