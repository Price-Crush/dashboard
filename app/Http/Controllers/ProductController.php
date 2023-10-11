<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\FirebaseService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')
        ->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function change_status($product_id,$status_id)
    {
        if($status_id){ //Activate product
            $status_name = "Activation";
            $status_action = "Activated";
        } else { //Block product
            $status_name = "Blocking";
            $status_action = "Blocked";
        }

        $product = Product::findOrFail($product_id);
        $product->is_active = $status_id;
        $product->update();

        // Send status change notification to merchant
        if(FirebaseService::sendNotification("Product ".$status_name,
            "Product ".$product->product_name." is ".$status_action.".",
            collect([$product->store->merchant?->customer?->fcm_token]))) {
            toastr()->success('Product '.$status_action.' Successfully');

        } else {
            toastr()->error('Could not notify merchant');
        }

        return back();
    }

    public function change_status_image($image_id,$status_id)
    {
        $image = ProductImage::findOrFail($image_id);
        $image->is_active = $status_id;
        $image->update();

        toastr()->success('Status Updated Successfully');
        return back();
    }
}
