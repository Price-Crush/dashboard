<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantNotificationLogRequest;
use App\Http\Requests\UpdateMerchantNotificationLogRequest;
use App\Models\MerchantNotificationLog;

class MerchantNotificationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = MerchantNotificationLog::orderby('id','Desc')->get();

        return view('notifications.index')
        ->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMerchantNotificationLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMerchantNotificationLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MerchantNotificationLog  $merchantNotificationLog
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantNotificationLog $merchantNotificationLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantNotificationLog  $merchantNotificationLog
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantNotificationLog $merchantNotificationLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMerchantNotificationLogRequest  $request
     * @param  \App\Models\MerchantNotificationLog  $merchantNotificationLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantNotificationLogRequest $request, MerchantNotificationLog $merchantNotificationLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantNotificationLog  $merchantNotificationLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantNotificationLog $merchantNotificationLog)
    {
        //
    }
}
