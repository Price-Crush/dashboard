<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DayWeek;
use App\Models\AdminDayWeek;
use Auth;
class WeekDayController extends Controller
{
    public function index()
    {
        $days = DayWeek::all();
        $adminDays = AdminDayWeek::where('user_id',Auth::id())->get();

        return view('week_days.index')
        ->with('days',$days)
        ->with('adminDays',$adminDays)
        ;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_id' => 'required|numeric|exists:day_weeks,id',
            'from' => 'required',
            'to' => 'required',
        ]);

        $check_day = AdminDayWeek::where('user_id',auth::id())->where('day_id',$request->day_id)->first();
        if($check_day != null)
        {
            toastr()->error('Day already exist !!');
            return back();
        }

        $adminDays = new AdminDayWeek();
        $adminDays->user_id = Auth::id();
        $adminDays->day_id = $request->day_id;
        $adminDays->from = $request->from;
        $adminDays->to = $request->to;
        $adminDays->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    public function edit($id)
    {
        $days = DayWeek::all();
        $adminDay = AdminDayWeek::findOrFail($id);

        return view('week_days.edit')
        ->with('days',$days)
        ->with('adminDay',$adminDay)
        ;
    }

    public function update($id,Request $request)
    {
        $validated = $request->validate([
            'day_id' => 'required|numeric|exists:day_weeks,id',
            'from' => 'required',
            'to' => 'required',
        ]);

        $check_day = AdminDayWeek::where('user_id',auth::id())->where('day_id',$request->day_id)->first();


        $adminDay = AdminDayWeek::find($id);
        $adminDay->user_id = Auth::id();

        if($request->day_id != $adminDay->day_id)
        {
            if($check_day != null)
            {
                toastr()->error('Day already exist !!');
                return back();
            }
        }
        $adminDay->day_id = $request->day_id;
        $adminDay->from = $request->from;
        $adminDay->to = $request->to;
        $adminDay->update();

        toastr()->success('Data Updated Successfully');
        return back();
    }

    public function destroy($id)
    {
        $adminDay = AdminDayWeek::findOrFail($id)->delete();

        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
