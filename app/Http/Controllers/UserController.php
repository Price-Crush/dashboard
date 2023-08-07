<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExecutiveManagementRequest;
use App\Http\Requests\UpdateExecutiveManagementRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\AdminCity;
use App\Models\AdminCountry;
use App\Models\AdminPromotionLevel;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\AdminState;
use App\Models\User;
use App\Models\UserType;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {
        // $users = User::orderBy('id', 'Desc')->where('id', '!=', Auth::id())->where('user_type_id', 1)->paginate(10);
        // return view('higher_managements.index')
        //     ->with('users', $users);

        $users = User::where('id','<>' , auth()->user()->id);
        if(request()->filled('search_item')){
            $users = $users->where(function($query) {
                $query->where('name', 'like', '%'.request()->search_item.'%')
                ->orWhere('email', 'like', '%'.request()->search_item.'%')
                ->orWhere('phone', 'like', '%'.request()->search_item.'%');
            });
        }
        
        $users = $users->orderby('id','desc')->paginate(10);
       
        return view('users.index')
            ->with('users', $users);
    }

    public function store(UserStoreRequest $request)
    {

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->user_type_id = 1;
        $users->phone = $request->phone;
        $users->is_active = $request->is_active;
        if ($request->hasFile('profile_pic')) {
            if ($request->file('profile_pic')->isValid()) {
                $path = $request->file('profile_pic')->store('users', 'public_file');
                $users->profile_pic = 'files/' . $path;
            }
        }

        $users->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    public function edit($id)
    {
        $user = User::find($id);
        // $user_types = UserType::all();
        $permissions = Permission::all();
        $roles = Role::all();

        $countries = Country::all();

        return view('users.edit')
            ->with(['user'=> $user, 'permissions'=>$permissions,'roles'=>$roles,'countries'=>$countries]);
    }


    public function update(UserUpdateRequest $request, $id)
    {

        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        if (isset($request->password) && $request->password != null) {
            $users->password = Hash::make($request->password);
        }
        $users->phone = $request->phone;
        $users->is_active = $request->is_active;
        if ($request->hasFile('profile_pic')) {
            if ($request->file('profile_pic')->isValid()) {
                $path = $request->file('profile_pic')->store('users', 'public_file');
                $users->profile_pic = 'files/' . $path;
            }
        }

        $users->update();


        toastr()->success('Data Updated Successfully');
        return back();
    }

    public function destroy($id)
    {

        $users = User::find($id)->delete();
        toastr()->success('Data Deleted Successfully');
        return back();

    }

    public function updateRole(Request $request, $id){
        $user = User::find($id);
        $user->syncRoles($request->role);
        
        toastr()->success('Data Updated Successfully');
        return back();

    }

    public function givePermission(Request $request, $id){
        $user = User::find($id);
        $user->givePermissionTo($request->permission);

        toastr()->success('Data Saved Successfully');
        return back();

    }
    public function revokePermission(Request $request, $id){
        $user = User::find($id);
        $user->revokePermissionTo($request->permission);

        toastr()->success('Data Deleted Successfully');
        return back();

    }

    public function addArea(Request $request, $id){
        if($request->filled('city_id')){
            $check_city = AdminCity::where('city_id',$request->city_id)->where('user_id',$id)->first();
            if($check_city)
            {
                toastr()->error($check_city->cities->name_en .' City already exist !!.');
                return back();
            }

            $city = AdminCity::create([
                'user_id' => $id,
                'city_id' => $request->city_id
            ]);

        } else if($request->filled('state_id')){
            $check_state = AdminState::where('state_id',$request->state_id)->where('user_id',$id)->first();
            if($check_state)
            {
                toastr()->error($check_state->state->name_en .' State already exist !!.');
                return back();
            }

            $state = AdminState::create([
                'user_id' => $id,
                'state_id' => $request->state_id
            ]);

        } else if($request->filled('country_id')){
            $check_country = AdminCountry::where('country_id',$request->country_id)->where('user_id',$id)->first();
            if($check_country)
            {
                toastr()->error($check_country->country->name_en .' Country already exist !!.');
                return back();
            }

            $country = AdminCountry::create([
                'user_id' => $id,
                'country_id' => $request->country_id
            ]);

        }

        toastr()->success('Data Saved Successfully');
        return back();

    }
    public function removeArea(Request $request, $id){

        if($request->filled('city_id')){
            $delete_city = AdminCity::findOrFail($request->city_id)->delete();
        } else if($request->filled('state_id')){
            $delete_sate = AdminState::findOrFail($request->state_id)->delete();
        } else if($request->filled('country_id')){
            $delete_country = AdminCountry::findOrFail($request->country_id)->delete();
        }

        toastr()->success('Data Deleted Successfully');
        return back();

    }

    // public function executive_management_index()
    // {
    //     $users = User::orderBy('id', 'Desc')->where('id', '!=', Auth::id())->where('user_type_id', 2)->paginate(10);
    //     $levels = AdminPromotionLevel::all();

    //     return view('executive_management.index')
    //         ->with('users', $users)
    //         ->with('levels', $levels)
    //     ;
    // }

    // public function executive_management_store(StoreExecutiveManagementRequest $request)
    // {

    //     $users = new User();
    //     $users->name = $request->name;
    //     $users->email = $request->email;
    //     $users->password = Hash::make($request->password);
    //     $users->user_type_id = 2;
    //     $users->phone = $request->phone;
    //     $users->is_active = $request->is_active;
    //     $users->promotion_level_id = $request->promotion_level_id;
    //     if ($request->hasFile('profile_pic')) {
    //         if ($request->file('profile_pic')->isValid()) {
    //             $path = $request->file('profile_pic')->store('users', 'public_file');
    //             $users->profile_pic = 'files/' . $path;
    //         }
    //     }
    //     $users->save();

    //     toastr()->success('Data Saved Successfully');
    //     return back();
    // }

    // public function executive_management_show($id)
    // {
    //     $user = User::find($id);
    //     $levels = AdminPromotionLevel::all();
    //     $cities = City::all();
    //     $states = State::all();
    //     $countries = Country::all();

    //     return view('executive_management.show')
    //         ->with('user', $user)
    //         ->with('levels', $levels)
    //         ->with('cities', $cities)
    //         ->with('states', $states)
    //         ->with('countries', $countries)
    //     ;
    // }

    // public function executive_management_update(UpdateExecutiveManagementRequest $request, $id)
    // {

    //     $users = User::find($id);
    //     $users->name = $request->name;
    //     $users->email = $request->email;
    //     if (isset($request->password) && $request->password != null) {
    //         $users->password = Hash::make($request->password);
    //     }
    //     $users->phone = $request->phone;
    //     $users->is_active = $request->is_active;
    //     $users->promotion_level_id = $request->promotion_level_id;
    //     if ($request->hasFile('profile_pic')) {
    //         if ($request->file('profile_pic')->isValid()) {
    //             $path = $request->file('profile_pic')->store('users', 'public_file');
    //             $users->profile_pic = 'files/' . $path;
    //         }
    //     }
    //     $users->update();

    //     toastr()->success('Data Updated Successfully');
    //     return back();
    // }

    // public function change_status($user_id, $status_id)
    // {
    //     $user = User::findOrFail($user_id);
    //     $user->is_active = $status_id;
    //     $user->update();

    //     toastr()->success('Data Updated Successfully');
    //     return back();
    // }

    // public function store_city(Request $request)
    // {
    //     $validated = $request->validate([
    //         'city_id.*' => 'required|numeric|exists:cities,id',
    //         'user_id' => 'required|numeric|exists:users,id',
    //     ]);

    //     $city_ids = $request->city_id;

    //     foreach ($city_ids as $key => $city_id) {
    //         $check_city = AdminCity::where('city_id',$city_ids)->where('user_id',$request->user_id)->first();
    //         if($check_city)
    //         {
    //             toastr()->error($check_city->cities->name_en .' City already exist !!.');
    //             return back();
    //         }


    //         $city = new AdminCity();
    //         $city->user_id = $request->user_id;
    //         $city->city_id = $city_id;
    //         $city->save();
    //     }

    //     toastr()->success('Data Saved Successfully');
    //     return back();
    // }

    // public function delete_city($id)
    // {
    //     $delete_city = AdminCity::findOrFail($id)->delete();

    //     toastr()->success('Data Deleted Successfully');
    //     return back();
    // }

    // public function store_state(Request $request)
    // {
    //     $validated = $request->validate([
    //         'state_id.*' => 'required|numeric|exists:states,id',
    //         'user_id' => 'required|numeric|exists:users,id',
    //     ]);

    //     $state_ids = $request->state_id;

    //     foreach ($state_ids as $key => $state_id) {
    //         $check_state = AdminState::where('state_id',$state_id)->where('user_id',$request->user_id)->first();
    //         if($check_state)
    //         {
    //             toastr()->error($check_state->state->name_en .' State already exist !!.');
    //             return back();
    //         }


    //         $state = new AdminState();
    //         $state->user_id = $request->user_id;
    //         $state->state_id = $state_id;
    //         $state->save();
    //     }

    //     toastr()->success('Data Saved Successfully');
    //     return back();
    // }

    // public function delete_state($id)
    // {
    //     $delete_state = AdminState::findOrFail($id)->delete();

    //     toastr()->success('Data Deleted Successfully');
    //     return back();
    // }

    // public function store_country(Request $request)
    // {
    //     $validated = $request->validate([
    //         'country_id.*' => 'required|numeric|exists:countries,id',
    //         'user_id' => 'required|numeric|exists:users,id',
    //     ]);

    //     $country_ids = $request->country_id;

    //     foreach ($country_ids as $key => $country_id) {
    //         $check_country = AdminCountry::where('country_id',$country_id)->where('user_id',$request->user_id)->first();
    //         if($check_country)
    //         {
    //             toastr()->error($check_country->country->country_enName .' Country already exist !!.');
    //             return back();
    //         }


    //         $country = new AdminCountry();
    //         $country->user_id = $request->user_id;
    //         $country->country_id = $country_id;
    //         $country->save();
    //     }

    //     toastr()->success('Data Saved Successfully');
    //     return back();
    // }

    // public function delete_country($id)
    // {
    //     $delete_country= AdminCountry::findOrFail($id)->delete();

    //     toastr()->success('Data Deleted Successfully');
    //     return back();
    // }

}
