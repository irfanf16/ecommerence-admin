@extends('admin.layouts.master', ['navItem' => 'stores', 'module' => 'Customer Stores'])
@section('title', 'All Customer Stores ')

@section('content')
    <div class="container-fluid">
        {{-- stats Cards Row --}}
        <div class="page-block">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $stores_count }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/stores/store.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Store Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_stores }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Active Store Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Verified</h5>
                                <h2>{{ $verified_stores }}</h2>
                            </div>
                            {{--<div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/stores/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Verified Store Default Image">
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Featured</h5>
                                <h2>{{ $featured_stores }}</h2>
                            </div>
{{--                            <div class="col-4 px-2">--}}
{{--                                <img src="{{ URL::to('admin/images/icons/stores/featured.svg') }}"--}}
{{--                                    class="rounded w-100 stats-icons" alt="Featured Store Default Image">--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header form-bdr-top">
                        <h2><strong>Customer Stores</strong></h2>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Store Info</th>
                                        <th>Owner Details</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($stores as $store)
                                        <tr>
                                            <td width="5%">{{ $loop->iteration }}</td>
                                            <td width="10%">
                                                @if ($store->profile)
                                                    <img src='{{ config('app.url') . "storage/user-store/profile/lg/$store->profile" }}'
                                                        alt="{{ $store->name . ' image' }}" class="w-50 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/stores/default.svg') }}"
                                                        alt="Store Default image" class="w-50 rounded">
                                                @endif
                                            </td>
                                            <td width="30%">
                                                <strong>{{ $store->name ?? '' }}</strong><br>
                                                <small>{{ $store->code }}</small>
                                            </td>

                                            <td>
                                                <strong>{{ $store->customer_details->name ?? ''}}</strong>
                                                <br>{{ $store->customer_details->email ?? '' }}
                                                {{-- <br>{{ $store->customer_details->phone }} --}}
                                                <br>{{ $store->customer_details->mobile ?? '' }}
                                            </td>
                                            <td width="5%">
                                                <label class="toggle-switch">
                                                    <input data-id="{{$store->id}}" type="checkbox" class="float-right toggle-class customer_store_status" name="status" id="status-{{ $store->id }}"
                                                           @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-customerstores-edit')) disabled @endif  {{ $store->status ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td width="5%">
                                                <label class="toggle-switch">
                                                    <input data-id="{{$store->id}}" type="checkbox" class="float-right toggle-class customer_store_feature" name="featured" id="status-{{ $store->id }}"
                                                           @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-customerstores-edit')) disabled @endif   {{ $store->featured ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td width="10%">
                                                <a href="{{ URL::to("admin/stores/customer/$store->id") }}"
                                                    title="Show This customer Store" class="btn btn-sm btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
                                                {{-- <a href="{{ URL::to("admin/collections/$store->id") }}"
                                                    title="Show This customer Store" class="btn btn-sm btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a> --}}

{{--                                                <form action='{{ URL::to("admin/stores/$store->id") }}' method="POST"--}}
{{--                                                    class="d-inline">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="btn btn-sm btn-danger"--}}
{{--                                                        title="Delete This Customer Store">--}}
{{--                                                        <span class="btn-inner-icon">--}}
{{--                                                            <i class="fa fa-trash-o"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
                                            </td>
                                            @php $count++; @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Session::has('response'))
    @section('customScripts')
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
