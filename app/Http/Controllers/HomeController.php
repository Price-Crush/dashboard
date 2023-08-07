<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\InternalNotification;
use Carbon\Carbon;
use DB;
class HomeController extends Controller
{
    public function dashboard(){
       
        $fromDate = (request()->from_date)? Carbon::create(request()->from_date) : Carbon::now()->startOfMonth();
        $toDate = (request()->to_date)? Carbon::create(request()->to_date) : Carbon::now()->endOfMonth();

        $statistics = (object) [
            'stores' => auth()->user()->getStores()->whereBetween('created_at',[$fromDate,$toDate])->count(),
            'merchants' => auth()->user()->getMerchants()->whereBetween('created_at',[$fromDate,$toDate])->count(),
            'customers' => auth()->user()->getCustomers()->whereBetween('created_at',[$fromDate,$toDate])->count(),
            'notificationOrders' => auth()->user()->getNotificationOrders()->whereBetween('created_at',[$fromDate,$toDate])->count(),
            'bannerOrders' => auth()->user()->getStoreBannerOrderOrders()->whereBetween('created_at',[$fromDate,$toDate])->count(),
            'offers' => auth()->user()->getMerchantOffers()->whereBetween('created_at',[$fromDate,$toDate])->count(),
        ];

        $notificationPricePerMonth = auth()->user()->getNotificationOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])
            ->select(DB::raw('sum(price) as `prices`'),  DB::raw('MONTH(created_at) month'))
            ->groupby('month')->pluck('prices','month')->toArray();
        $bannerPricePerMonth = auth()->user()->getStoreBannerOrderOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])
            ->select(DB::raw('sum(price) as `prices`'),  DB::raw('MONTH(created_at) month'))
            ->groupby('month')->pluck('prices','month')->toArray();

        $months = [];
        for($i=1; $i<=12;$i++)
            $months[$i] = 0;
        
        $notificationPricePerMonth = array_replace($months,$notificationPricePerMonth);
        $bannerPricePerMonth = array_replace($months,$bannerPricePerMonth);
     
        $charts = (object)[
            'notificationOrders' => (object) [
                'count' => auth()->user()->getNotificationOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])->count(),
                'revenue' => number_format(auth()->user()->getNotificationOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])->sum('price'),2),
                'revenuePerMonth' => array_values($notificationPricePerMonth),
            ],
            'bannerOrders' => (object) [
                'count' => auth()->user()->getStoreBannerOrderOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])->count(),
                'revenue' => number_format(auth()->user()->getStoreBannerOrderOrders()->where('status_id',2)->whereBetween('created_at',[$fromDate,$toDate])->sum('price'),2),
                'revenuePerMonth' => array_values($bannerPricePerMonth),
            ],
        ];
      
        return view('dashboard')->with([
            'statistics'=>$statistics,
            'charts'=>$charts,
            'from_date' => $fromDate->format('Y-m-d'),
            'to_date' => $toDate->format('Y-m-d'),
        ]);
    } 
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
