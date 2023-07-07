@extends('admin.layouts.master',['navItem' => 'dashsboard', 'module' => 'Dashboard'])
@section('title', 'Dashboard | Admin ')

@section('content')
    <div class="container-fluid">
        <div class="page-block">

            <div class="row clearfix">

                {{-- Categories --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/categories') }}" title="Go to all categories page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Categories</h6>
                                        <h2>{{ $categories_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/categories/default.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Categories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Subcategories --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/subcategories') }}" title="Go to all subcategories page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Subcategories</h6>
                                        <h2>{{ $subcategories_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/subcategories/default.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Subcategories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Child Categories --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/childcategories') }}" title="Go to all childcategories page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Childcategories</h6>
                                        <h2>{{ $childcategories_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/childcategories/default.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Childcategories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Stores --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/stores/vendor') }}" title="Go to all stores page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Stores</h6>
                                        <h2>{{ $stores_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons//stores/default.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Stores Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Vendors --}}
{{--                <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="body pb-0">--}}
{{--                            <a href="{{ URL::to('/admin/vendor/profiles') }}" title="Go to all vendors page">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-8 px-1">--}}
{{--                                        <h6>Vendors</h6>--}}
{{--                                        <h2>{{ $vendors_count }}</h2>--}}
{{--                                    </div>--}}
{{--                                    --}}{{--                                <div class="col-md-4 px-2">--}}
{{--                                    --}}{{--                                    <img src="{{ URL::to('admin/images/icons/vendor.svg') }}"--}}
{{--                                    --}}{{--                                        class="rounded w-100 stats-icons" alt="Vendors Default Image">--}}
{{--                                    --}}{{--                                </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                {{-- Buyers --}}
{{--                <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="body pb-0">--}}
{{--                            <a href="{{ URL::to('/admin/customer/profiles') }}" title="Go to all buyers page">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-8 px-1">--}}
{{--                                        <h6>Buyers</h6>--}}
{{--                                        <h2>{{ $buyers_count }}</h2>--}}
{{--                                    </div>--}}
{{--                                    --}}{{--                                <div class="col-md-4 px-2">--}}
{{--                                    --}}{{--                                    <img src="{{ URL::to('admin/images/icons/user.svg') }}"--}}
{{--                                    --}}{{--                                        class="rounded w-100 stats-icons" alt="Users Default Image">--}}
{{--                                    --}}{{--                                </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                {{-- Products --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/products') }}" title="Go to all products page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Products</h6>
                                        <h2>{{ $products_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/new-product.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Products Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Brands --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/brands') }}" title="Go to all brands page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Brands</h6>
                                        <h2>{{ $brands_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/brand.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Brands Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Attributes --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/attributes') }}" title="Go to all attributes page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Attributes</h6>
                                        <h2>{{ $attributes_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="https://img.icons8.com/color/48/000000/edit-property.png"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Attributes Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Variants --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="javascript:void(0)" title="Go to all variants page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Variants</h6>
                                        <h2>{{$variants_count}}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/choices.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Variants Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Orders --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body pb-0">
                            <a href="{{ URL::to('/admin/orders') }}" title="Go to all orders page">
                                <div class="row">
                                    <div class="col-md-8 px-1">
                                        <h6>Orders</h6>
                                        <h2>{{$orders_count}}</h2>
                                    </div>
                                    {{--                                <div class="col-md-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/order.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Orders Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Partners --}}
{{--                <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="body pb-0">--}}
{{--                            <a href="{{ URL::to('/admin/partners') }}" title="Go to all Parters page">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-8 px-1">--}}
{{--                                        <h6>Partners</h6>--}}
{{--                                        <h2>{{ $partners_count }}</h2>--}}
{{--                                    </div>--}}
{{--                                    --}}{{--                                <div class="col-md-4 px-2">--}}
{{--                                    --}}{{--                                    <img src="{{ URL::to('admin/images/icons/user.svg') }}"--}}
{{--                                    --}}{{--                                        class="rounded w-100 stats-icons" alt="Users Default Image">--}}
{{--                                    --}}{{--                                </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        {{-- graphs  section --}}
        <div class="row clearfix">

            {{-- recent orders --}}
            <div class=" col-md-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2>Recent Orders</h2>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Order Date</th>
                                    <th>Order By</th>
                                    <th>View</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($recent_orders as $order)

                                    <tr>
                                        <td>{{$order->order_no}}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                        <td>{{$order->user->name ?? 'N/A'}}</td>
                                        <td align="center">
                                            <a href="{{ route('orders.show', $order->id) }}"
                                               class="btn btn-success btn-sm float-centre" title="View Order"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-md-12">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2>Recent Products</h2>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Date</th>
                                    <th>Store Name</th>
{{--                                    <th>Product Name</th>--}}
                                    <th>View</th>
                                </tr>
                                </thead>

                                <tbody>
                                 @foreach ($recent_products as $product)

                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                    <td>{{$product->store->store_name}}</td>
{{--                                    <td>{{$product->name}}</td>--}}
                                    <td align="center">
                                        {{-- view order --}}
                                        <a href="products/{{$product->id }}"
                                           class="btn btn-success btn-sm float-centre" title="View Order"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>

                                </tr>
                                 @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-md-6">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2>Recent Registered Stores</h2>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Vendor Name</th>
                                    <th>Store Nane</th>
                                    <th>Registered Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>

                                <tbody>
                                 @foreach ($recent_stores as $store)

                                <tr>
                                    <td>{{$store->vendor_details->name}}</td>
                                    <td>{{$store->store_name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($store->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                    <td align="center">
                                        <a href="{{ URL::to("admin/stores/vendor/$store->id") }}"
                                           title="Show This Vendor Store Detail" class="btn btn-sm btn-success">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                        </a>
                                    </td>

                                </tr>
                                 @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-md-6">
                <div class="card">
                    <div class="header form-bdr-top">
                        <h2>Recent Registered User Stores</h2>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Store Nane</th>
                                    <th>Registered Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>

                                <tbody>
                                 @foreach ($recent_user_stores as $store)
                                <tr>
                                    <td>{{$store->customer_details->name}}</td>
                                    <td>{{$store->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($store->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                    <td align="center">
                                        <a href="{{ URL::to("admin/stores/customer/$store->id") }}"
                                           title="Show This customer Store" class="btn btn-sm btn-success">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                        </a>
                                    </td>

                                </tr>
                                 @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

            {{-- graphs --}}
            {{--            <div class="col-xl-4 col-lg-12 col-md-12">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="header">--}}
            {{--                        <h2>Revenue Statistics</h2>--}}
            {{--                    </div>--}}
            {{--                    <div class="body">--}}
            {{--                        <div class="d-flex bd-highlight mb-4">--}}
            {{--                            <div class="flex-fill bd-highlight">--}}
            {{--                                <h5 class="mb-0">21,521 <i class="fa fa-angle-up"></i></h5>--}}
            {{--                                <small>Today</small>--}}
            {{--                            </div>--}}
            {{--                            <div class="flex-fill bd-highlight">--}}
            {{--                                <h5 class="mb-0">%12.35 <i class="fa fa-angle-down"></i></h5>--}}
            {{--                                <small>Last month %</small>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div id="chart-bar-rotated" class="c3_chart"></div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="col-xl-4 col-lg-6 col-md-6">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="header">--}}
            {{--                        <h2>Products Monthly Sales</h2>--}}
            {{--                    </div>--}}
            {{--                    <div class="body">--}}
            {{--                        <div class="d-flex bd-highlight mb-4">--}}
            {{--                            <div class="flex-fill bd-highlight">--}}
            {{--                                <h5 class="mb-0">2,521 <i class="fa fa-angle-up"></i></h5>--}}
            {{--                                <small>Today</small>--}}
            {{--                            </div>--}}
            {{--                            <div class="flex-fill bd-highlight">--}}
            {{--                                <h5 class="mb-0">18.35 <i class="fa fa-angle-down"></i></h5>--}}
            {{--                                <small>Last month %</small>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div id="chart-area-step" class="c3_chart"></div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="col-xl-4 col-lg-6 col-md-6">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="header">--}}
            {{--                        <h2>ToDo List</h2>--}}
            {{--                    </div>--}}
            {{--                    <div class="body todo_list">--}}
            {{--                        <div class="form-group d-flex mb-1">--}}
            {{--                            <div class="input-group">--}}
            {{--                                <input type="text" class="form-control" placeholder="Type your task here...">--}}
            {{--                            </div>--}}
            {{--                            <button class="btn btn-primary ml-2" type="button" id="button-addon2">Add</button>--}}
            {{--                        </div>--}}
            {{--                        <ul class="list-group">--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Walk the dog this evening--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Go shopping at 3 PM--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Keep coding 'till you're dead--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Enjoy every moment you have--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Sleep well tonight--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
            {{--                                Sleep well tonight--}}
            {{--                                <span class="badge badge-primary badge-pill">x</span>--}}
            {{--                            </li>--}}
            {{--                        </ul>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>


    </div>
@endsection
