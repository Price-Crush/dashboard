<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCountry extends Model
{
    use HasFactory;

    public function countries()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
