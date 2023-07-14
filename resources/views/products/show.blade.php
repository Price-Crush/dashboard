@extends('layouts.app')
@section('title', 'product - ' . $product->product_name)
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- page users view start -->
        <section class="page-users-view">
            <div class="row">
                <!-- account start -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Product Name</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="users-view-image">
                                    <img src="{{ asset($product->image) }}"
                                        class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                </div>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Product Name EN</td>
                                            <td>{{ $product->product_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Product Name AR</td>
                                            <td>{{ $product->product_name_ar ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Product Name TR</td>
                                            <td>{{ $product->product_name_tr ?? '-' }}</td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">Created At</td>
                                            <td>{{ $product->created_at->format('Y-m-d') ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 col-md-12 col-lg-5">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tr>
                                            <td class="font-weight-bold">Price</td>
                                            <td>{{ $product->price ?? '-' }} USD</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Is Private Discount ?</td>
                                            <td>
                                                @if ($product->is_private_discount == 1)
                                                    <span class="badge badge-primary">Yes</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($product->is_private_discount == 1)
                                            <tr>
                                                <td class="font-weight-bold">Private Discount</td>
                                                <td>{{ $product->private_discount }}
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-12">
                                    @if ($product->is_active == 1)
                                        <a href="/admin-panel/products/status/{{ $product->id }}/0"
                                            onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                            class="btn btn-outline-danger"><i class="fa fa-times-circle"></i> Block</a>
                                    @elseif($product->is_active == 0)
                                        <a href="/admin-panel/products/status/{{ $product->id }}/1"
                                            onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                            class="btn btn-outline-success"><i class="fa fa-check-circle"></i>
                                            Active</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Product Description English</div>
                        </div>
                        <div class="card-body">
                            {{ $product->product_name ?? 'No Content Available' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Product Description Arabic</div>
                        </div>
                        <div class="card-body">
                            {{ $product->product_name_ar ?? 'No Content Available' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Product Description Turkish</div>
                        </div>
                        <div class="card-body">
                            {{ $product->product_name_tr ?? 'No Content Available' }}
                        </div>
                    </div>
                </div>
                <!-- account end -->
                <div class="col-md-12 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-2">Images</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($product->product_images->count() != 0)
                                    @foreach ($product->product_images as $image)
                                        <div class="col-6 col-md-4 col-lg-3 mb-2">
                                            <div class="img-handler mb-2">
                                                <img src="{{ asset($image->file) }}" alt="" style="width:100%;border_radius:6px">
                                            </div>
                                            @if ($image->is_active == 1)
                                                <a href="/admin-panel/products/image/status/{{ $image->id }}/0"
                                                    onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                                    class="btn btn-outline-danger"><i class="fa fa-times-circle"></i>
                                                    DisActive</a>
                                            @elseif($image->is_active == 0)
                                                <a href="/admin-panel/products/image/status/{{ $image->id }}/1"
                                                    onclick="if(!confirm('Are You Sure ? ')){event.preventDefault();}"
                                                    class="btn btn-outline-success"><i class="fa fa-check-circle"></i>
                                                    Active</a>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12 col-12">
                                        No Data Available !!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page users view end -->

    </div>
@endsection
