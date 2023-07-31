<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\InternalNotification;
class HomeController extends Controller
{
    public function all_internal_notifications()
    {
        if (Auth::user()->user_type_id == 1) {
            $all_notifications = InternalNotification::orderby('id','desc')->paginate(10);
            foreach($all_notifications->where('is_read', 0) as $all_notification){
                $notification = InternalNotification::find($all_notification->id);
                $notification->is_read = 1;
                $notification->update();
            }
        } else {
            $all_notifications = InternalNotification::where('user_id', Auth::id())->paginate(10);
            foreach($all_notifications->where('is_read', 0) as $all_notification){
                $notification = InternalNotification::find($all_notification->id);
                $notification->is_read = 1;
                $notification->update();
            }
        }

        return view('auth.notifications')
        ->with('all_notifications',$all_notifications)
        ;
    }
}
