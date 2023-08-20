<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    public static function notificationGeneralPrice(){
        return AppSetting::where('name','notification_general_price')->first()->value;
    }
}
