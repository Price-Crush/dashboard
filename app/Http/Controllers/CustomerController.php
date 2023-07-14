<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\AdminCity;
use App\Models\AdminCountry;
use App\Models\AdminState;
use App\Models\Customer;
use App\Models\MerchantWarningCard;
use App\Models\InternalNotification;
use Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->user_type_id == 2) {
            $area_ids = [];
            $cities = [];
            $states = [];
            $countries = [];

            $cities_ids = [];
            $states_ids = [];
            $countries_ids = [];

            if (Auth::user()->promotion_level_id == 1) {
                $cities_ids = AdminCity::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 2) {
                $states_ids = AdminState::where('user_id', Auth::id())->get();
            } elseif (Auth::user()->promotion_level_id == 3) {
                $countries_ids = AdminCountry::where('user_id', Auth::id())->get();
            }

            foreach ($cities_ids as $city) {
                $cities[] = $city->city_id;
            }
            foreach ($states_ids as $state) {
                $states[] = $state->state_id;
            }
            foreach ($countries_ids as $country) {
                $countries[] = $country->country_id;
            }

            $customers = Customer::whereHas('c_resident_country', function ($query) use ($countries) {
                if (count($countries) != 0) {
                    $query->wherein('resident_country', $countries);
                }
            })
                ->whereHas('state', function ($query) use ($states) {
                    if (count($states) != 0) {
                        $query->wherein('state_id', $states);
                    }
                })
                ->whereHas('city', function ($query) use ($cities){
                    if (count($cities) != 0) {
                    $query->wherein('city_id', $cities);
                    }
                })
                ->where('is_anonymous', 0)->get();

        } else {
            $customers = Customer::where('is_anonymous', 0)->get();
        }

        return view('customers.index')
            ->with('customers', $customers)
        ;
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::with('customer_categories.categories')->findOrFail($id);
        $alerts = MerchantWarningCard::all();

        return view('customers.show')
            ->with('customer', $customer)
            ->with('alerts', $alerts)
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function change_status($customer_id, $status_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $customer->is_active = $status_id;
        $customer->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Activate';
        $internal_notification->title = 'Activate Customer';
        $internal_notification->details = Auth::user()->name.' activate customer '.$customer->name;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function block_customer(Request $request,$id)
    {
        $validated = $request->validate([
            'block_type' => 'required|numeric',
            'block_reason' => 'required|string|max:255',
            'active_date' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->is_active = 2;
        $customer->block_type = $request->block_type;
        $customer->block_reason = $request->block_reason;
        $customer->block_by = Auth::id();
        if($request->block_type == 1)
        {
            $customer->active_date = $request->active_date;
        }
        $customer->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Block';
        $internal_notification->title = 'Block Customer';
        $internal_notification->details = Auth::user()->name.' block customer '.$customer->name;
        $internal_notification->is_read = 0;
        $internal_notification->save();


        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function alert_customer(Request $request,$id)
    {
        $validated = $request->validate([
            'warning_id' => 'nullable|numeric|exists:merchant_warning_cards,id',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->warning_id = $request->warning_id;
        $customer->update();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Alert';
        $internal_notification->title = 'Alert Customer';
        $internal_notification->details = Auth::user()->name.' alert customer '.$customer->name;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Status Updated Successfully');
        return back();
    }

    public function anonymous()
    {
        $anonymouses = Customer::where('is_anonymous', 1)->get();

        return view('customers.anonymous')
            ->with('anonymouses', $anonymouses)
        ;
    }
}
