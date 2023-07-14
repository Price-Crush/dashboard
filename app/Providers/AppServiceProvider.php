<?php

namespace App\Providers;

use App\Models\InternalNotification;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->user_type_id == 1) {
                $internal_notifications = InternalNotification::where('is_read', 0)->orderby('id','Desc')->get();
            } else {
                $internal_notifications = InternalNotification::where('is_read', 0)->where('user_id', Auth::id())->orderby('id','Desc')->get();
            }

            $view
                ->with('internal_notifications', $internal_notifications)
            ;
        });
    }
}
