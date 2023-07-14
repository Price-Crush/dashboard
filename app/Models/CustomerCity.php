<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCity extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
