<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\InternalNotification;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index')
            ->with('categories', $categories)
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $categories = new Category();
        $categories->name_ar = $request->name_ar;
        $categories->name_en = $request->name_en;
        $categories->name_tr = $request->name_tr;
        $categories->is_active = $request->is_active;
        $categories->save();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'New';
        $internal_notification->title = 'New Category';
        $internal_notification->details = Auth::user()->name.' add a new category '.$request->name_en;
        $internal_notification->is_read = 0;
        $internal_notification->save();

        toastr()->success('Data Saved Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit')
            ->with('category', $category)
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->name_tr = $request->name_tr;
        $category->is_active = $request->is_active;
        $category->update();

        if(count($category->getChanges()) != 0)
        {
            $internal_notification = new InternalNotification();
            $internal_notification->user_id = Auth::id();
            $internal_notification->type = 'Update';
            $internal_notification->title = 'Update Category';
            $internal_notification->details = Auth::user()->name.' update category '.$request->name_en;
            $internal_notification->is_read = 0;
            $internal_notification->save();
        }


        toastr()->success('Data Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $internal_notification = new InternalNotification();
        $internal_notification->user_id = Auth::id();
        $internal_notification->type = 'Delete';
        $internal_notification->title = 'Delete Category';
        $internal_notification->details = Auth::user()->name.' delete category '.$request->name_en;
        $internal_notification->is_read = 0;
        $internal_notification->save();


        toastr()->success('Data Deleted Successfully');
        return back();
    }
}
