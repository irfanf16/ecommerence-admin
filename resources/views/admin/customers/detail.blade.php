@extends('admin.layouts.master', ['navItem' => 'customers', 'module' => 'Customers'])
@section('title', 'Customer Profile Information')

@section('content')
    <style>
        .table th {
            width: 15%;
            background-color: #d9d9d9
        }

        .table td {
            width: 20%;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
        }

        .bg-files {
            background-color: #d9d9d94f;
            margin: 0px;
            padding: 1rem;
        }

    </style>

    <div class="container-fluid">
        {{-- PRINT ERROR MESSAGES --}}
        @if ($message = Session::get('errors'))
            @php
                $count = count($message);
//            @endphp
            <div class="alert alert-danger alert-block" id="ErrorAlertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="text-white">Attention please !</h4>
                @for ($i = 0; $i < $count; $i++)
                    <strong>{{ $message[$i] }}</strong><br>
                @endfor
            </div>
        @endif

        {{-- PRINT SUCCESS MESSAGES --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="SuccessAlertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        {{-- VENDOR PROFILE INFORMATION CARD --}}
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0 text-center">Customer Profile Information</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">

                    {{-- Personal Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Personal Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $customer->name }}</td>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                    <th>Mobile Number:</th>
                                    <td>{{ $customer->mobile }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    {{--tabs--}}

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-3">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Address</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Cart Items</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Wishlist Items</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Orders</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Questions</a>
                        </li>
                        <li class="nav-item p-3">
                            <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Reviews</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
                                        <th width="2%">Sr.</th>
                                        <th width="10%">Address</th>
                                        <th width="10%">Country</th>
                                        <th width="10%">City</th>
                                        <th width="10%">Address Type</th>
                                        <th width="10%">Zone No</th>
                                        <th width="10%">Street No</th>
                                        <th width="10%">Building No</th>
                                        <th width="10%">Floor No</th>
                                        <th width="10%">Apartment No</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($addresses as $address)
                                        @php $id=1 @endphp
                                        <tr>
                                            <td width="2%">{{$id}}</td>
                                            <td width="10%">{{ $address->user_address ?? 'N/A'}}</td>
                                            <td width="10%">{{ $address->country_detail->name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $address->city_detail->name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $address->address_type->name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $address->user_zone_no ?? 'N/A'}}</td>
                                            <td width="10%">{{ $address->user_street_no ?? 'N/A'}}</td>
                                            <td width="10%">{{ $address->user_building_no ?? 'N/A'}}</td>
                                            <td width="10%">{{ $address->user_floor_no ?? 'N/A'}}</td>
                                            <td width="10%">{{ $address->user_appartment_no ?? 'N/A'}}</td>
                                        </tr>
                                        @php $id++ @endphp
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
{{--                                        <th width="2%">Sr.</th>--}}
                                        <th width="10%">Image</th>
                                        <th width="10%">Name</th>
                                        <th width="10%">Store Name</th>
                                        <th width="10%">Seller Sku</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cartItems as $item)
{{--                                        @php $id=1 @endphp--}}
                                        <tr>
{{--                                            <td width="2%">{{$id}}</td>--}}
                                            <td width="10%"><img
                                                    src="{{ $image_url.$item->product_detail->primary_image ?? 'default.svg'}}">
                                            </td>
                                            <td width="10%">{{ $item->product_detail->name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->product_detail->store->store_name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->variant_detail->seller_sku ?? 'N/A' }}</td>

                                        </tr>
{{--                                        @php $id++ @endphp--}}
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
                                        {{--                                        <th width="2%">Sr.</th>--}}
                                        <th width="10%">Image</th>
                                        <th width="10%">Name</th>
                                        <th width="10%">Store Name</th>
                                        <th width="10%">Seller Sku</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($wishlistItems as $item)
                                        {{--                                        @php $id=1 @endphp--}}
                                        <tr>
                                            {{--                                            <td width="2%">{{$id}}</td>--}}
                                            <td width="10%"><img
                                                    src="{{ $image_url.$item->product_detail->primary_image ?? 'default.svg'}}">
                                            </td>
                                            <td width="10%">{{ $item->product_detail->name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->product_detail->store->store_name ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->variant_detail->seller_sku ?? 'N/A' }}</td>
                                        </tr>
                                        {{--                                        @php $id++ @endphp--}}
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
                                        {{--                                        <th width="2%">Sr.</th>--}}
                                        <th>Document</th>
                                        <th>Order No</th>
                                        <th>Order Date</th>
                                        <th>Update Date</th>
                                        <th>Paid With</th>
                                        <th>Total Bill</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)

                                    <tr>
                                        <td>
                                            <a href="{{ url('admin/order-invoice/' . $order->id) }}"
                                               target="_blank">Invoice</a>
                                        </td>
                                        <td>{{ $order->order_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->packages_bill }}</td>
                                        <td class="text-center">
                                            {{-- view order --}}
                                            <a href="{{ route('orders.show', $order->id) }}"
                                               class="btn btn-primary">
                                                <span class="btn-inner-icon"><i class=" fa fa-eye"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-5" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
                                        {{--                                        <th width="2%">Sr.</th>--}}
                                        <th width="10%">Customer Question</th>
                                        <th width="10%">Vendor Reply</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Reported</th>
                                        <th width="10%">Reported By</th>
                                        <th width="10%">Viewed</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($productQuestions as $item)
                                        {{--                                        @php $id=1 @endphp--}}
                                        <tr>
                                            {{--                                            <td width="2%">{{$id}}</td>--}}
                                            <td width="10%">
                                                {{ $item->customer_question ?? 'N/A' }}
                                            </td>
                                            <td width="10%">{{ $item->vendor_reply ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->status ? 'Active' : 'Inactive'  }}</td>
                                            <td width="10%">{{ $item->is_reported ? 'Yes' : 'No' }}</td>
                                            <td width="10%">{{ $item->reported_by ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->is_viewed ?? 'N/A' }}</td>
                                        </tr>
                                        {{--                                        @php $id++ @endphp--}}
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-6" role="tabpanel">
                            <div class="table-responsive mt-5">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example order-table"
                                    id="orders-listing">
                                    <thead>
                                    <tr>
                                        {{--                                        <th width="2%">Sr.</th>--}}
                                        <th width="10%">Customer Rating</th>
                                        <th width="10%">Customer Review</th>
                                        <th width="10%">Vendor Reply</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Reported</th>
                                        <th width="10%">Reported By</th>
                                        <th width="10%">Viewed</th>
                                        <th width="10%">Likes On Review</th>
                                        <th width="10%">Likes On Reply</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($productReviews as $item)
                                        {{--                                        @php $id=1 @endphp--}}
                                        <tr>
                                            {{--                                            <td width="2%">{{$id}}</td>--}}
                                            <td width="10%">
                                                {{ $item->customer_rating ?? 'N/A' }}
                                            </td>
                                            <td width="10%">
                                                {{ $item->customer_review ?? 'N/A' }}
                                            </td>
                                            <td width="10%">{{ $item->vendor_reply ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->status ? 'Active' : 'Inactive'  }}</td>
                                            <td width="10%">{{ $item->is_reported ? 'Yes' : 'No' }}</td>
                                            <td width="10%">{{ $item->reported_by ?? 'N/A' }}</td>
                                            <td width="10%">{{ $item->is_viewed ?? 'N/A' }}</td>
                                            <td width="10%">
                                                {{ $item->likes_on_review ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $item->likes_on_reply }}
                                            </td>
                                        </tr>
                                        {{--                                        @php $id++ @endphp--}}
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('customScripts')

    <script>
        $(document).ready(function () {
            // ON PAGE LOAD
            if ($("#vendor_profile_status").val() == 3) {
                $(".review-note").removeClass("d-none");
            } else {
                $("#review_note").val('');
                $(".review-note").addClass("d-none");
            }

            // ON STATUS CHANGE
            $("#vendor_profile_status").change(function (e) {
                e.preventDefault();
                var val = $(this).val();
                if (val == 3) {
                    $(".review-note").removeClass("d-none");
                } else {
                    $("#review_note").val('');
                    $(".review-note").addClass("d-none");
                }
            });
        });
    </script>
@endsection
