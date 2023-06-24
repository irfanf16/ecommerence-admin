@extends('admin.layouts.master', ['navItem' => 'incomplete profiles', 'module' => 'Vendors'])
@section('title', 'Incomplete Vendor Profile Information')

@section('content')
    <style>
        .table tr th {
            width: 25%;
            background-color: #d9d9d9
        }

        .table tr td {
            width: 75%;
        }

        p {
            font-size: 13px !important;
            margin-bottom: 0px;
        }
        span{
            font-size: 12px !important;
        }

    </style>


    <div class="container-fluid">
        @include('admin.layouts.vendorpartial')
        {{-- Print Success Message --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="SuccessAlertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        {{-- Vendor Profile Information --}}
        <div class="card">
            <div class="card-header border-0">
                <h3 class="text-center">Vendor Information  
                    <sup class="badge badge-pill badge-danger">Incomplete</sup>
                </h3>
                {{-- <a href="{{ URL::to('/admin/vendor/profiles/incomplete') }}" class="btn btn-primary d-inline float-right">Back</a> --}}
            </div>

            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Personal Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $profile_detail->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td>{{ $profile_detail->email }}
                                        @if ($profile_detail->is_email_verified)
                                            <span class="badge badge-pill badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Unverified</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td>{{ $profile_detail->mobile }}
                                        @if ($profile_detail->is_mobile_verified)
                                            <span class="badge badge-pill badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Unverified</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <h5 class="pt-4">Other Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Business Information</th>
                                    <td>
                                        @if ($profile_detail->business_info)
                                            <p class="badge badge-pill badge-success">Completed</p>
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Business Documents</th>
                                    <td>
                                        @if ($profile_detail->business_info)
                                            @if ($profile_detail->business_info->business_docs)
                                                <p class="badge badge-pill badge-success">Completed</p>
                                            @else
                                                <p class="badge badge-pill badge-danger">Incomplete</p>
                                            @endif
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bank Account Details</th>
                                    <td>
                                        @if ($profile_detail->bank_account)
                                            <p class="badge badge-pill badge-success">Completed</p>
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Store Information</th>
                                    <td>
                                        @if ($profile_detail->store)
                                            <p class="badge badge-pill badge-success">Completed</p>
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Warehouse Address</th>
                                    <td>
                                        @if ($profile_detail->store)
                                            @if ($profile_detail->store->warehouse_address)
                                                <p class="badge badge-pill badge-success">Completed</p>
                                            @else
                                                <p class="badge badge-pill badge-danger">Incomplete</p>
                                            @endif
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return Address</th>
                                    <td>
                                        @if ($profile_detail->store)
                                            @if ($profile_detail->store->warehouse_address)
                                                <p class="badge badge-pill badge-success">Completed</p>
                                            @else
                                                <p class="badge badge-pill badge-danger">Incomplete</p>
                                            @endif
                                        @else
                                            <p class="badge badge-pill badge-danger">Incomplete</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
