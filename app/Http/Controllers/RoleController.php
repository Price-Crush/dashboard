<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderby('id','Desc')->paginate(10);

        return view('roles.index')
        ->with('roles',$roles)
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
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $name = strtolower(str_replace(' ', '_', trim($request->name_en)));
        $role = Role::create([
            'name' => $name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'name_tr' => $request->name_tr,
        ]);

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit')
        ->with(['role'=>$role, 'permissions'=>$permissions])
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name_en = $request->name_en;
        $role->name_ar = $request->name_ar;
        $role->name_tr = $request->name_tr;
        $role->update();

        toastr()->success('Data Saved Successfully');
        return back();
    }
    
    public function givePermission(Request $request, Role $role)
    {
       
        $role->givePermissionTo($request->permission);
        toastr()->success('Data Saved Successfully');
        return back();
    }

    public function revokePermission(Request $request, Role $role)
    {
        $role->revokePermissionTo($request->permission);
        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $check_permission = RoleHasPermission::where('role_id',$role->id)->first();

        if($check_permission)
        {
            toastr()->error('You Cant Delete Role , Role Have Permissions !!');
            return back();
        }

        $role->delete();

        toastr()->success('Data Saved Successfully');
        return back();

    }
}
