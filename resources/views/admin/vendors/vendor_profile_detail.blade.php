@extends('admin.layouts.master', ['navItem' => 'vendors', 'module' => 'Vendors'])
@section('title', 'Vendor Profile Information')

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
            @endphp
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
                <h3 class="mb-0 text-center">Vendor Profile Information
                    @if ($profile_details->vendor_profile_status == 1)
                        <sup class="badge badge-pill badge-info text-white">Under Review</sup>
                    @elseif($profile_details->vendor_profile_status == 2)
                        <sup class="badge badge-pill badge-success">&#10003; Approved</sup>
                    @elseif($profile_details->vendor_profile_status == 3)
                        <sup class="badge badge-pill badge-danger">Rejected</sup>
                    @endif
                </h3>
            </div>

            <div class="card-body">
                <div class="col-md-12">

                    {{-- Personal Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Personal Information
                                @if ($profile_details)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $profile_details->name }}</td>
                                    <th>Email:</th>
                                    <td>{{ $profile_details->email }}</td>
                                    <th>Mobile Number:</th>
                                    <td>{{ $profile_details->mobile }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>

                    {{-- Business Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Business Information
                                @if ($profile_details->business_info)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $profile_details->business_info->company_name ?? null }}</td>
                                    <th>Select ID Type</th>
                                    <td>ID</td>
                                    <th>Person ID Number</th>
                                    <td>{{ $profile_details->business_info->person_id_no ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Person Incharge Name</th>
                                    <td>{{ $profile_details->business_info->person_incharge_name ?? null }}</td>
                                    <th>Person Incharge Mobile</th>
                                    <td>{{ $profile_details->business_info->person_incharge_mobile ?? null }}</td>
                                    <th>Person Incharge Email:</th>
                                    <td>{{ $profile_details->business_info->person_incharge_email ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>QATAR</td>
                                    <th>City</th>
                                    <td>{{ $profile_details->business_info->city->name ?? null }}</td>
                                    <th>Zone Number</th>
                                    <td>{{ $profile_details->business_info->company_zone_no ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Street Number</th>
                                    <td>{{ $profile_details->business_info->company_street_no ?? null }}</td>
                                    <th>Building Number</th>
                                    <td>{{ $profile_details->business_info->company_building_no ?? null }}</td>
                                    <th>Floor Number</th>
                                    <td>{{ $profile_details->business_info->company_floor_no ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Apartment Number</th>
                                    <td>{{ $profile_details->business_info->company_appartment_no ?? null }}</td>
                                    <th>Address (Optional)</th>
                                    <td colspan="4">{{ $profile_details->business_info->company_address ?? null }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>


                    {{-- Bank Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Bank Information
                                @if ($profile_details->bank_account)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Account Title</th>
                                    <td>{{ $profile_details->bank_account->account_title ?? null }}
                                    </td>
                                    <th>Account Number:</th>
                                    <td>{{ $profile_details->bank_account->account_no ?? null }}
                                    </td>
                                    <th>Bank Name</th>
                                    <td>{{ $profile_details->bank_account->bank_name ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Branch Code</th>
                                    <td>{{ $profile_details->bank_account->branch_code ?? null }}
                                    </td>
                                    <th>IBAN</th>
                                    <td colspan="3">
                                        {{ $profile_details->bank_account->iban ?? null }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>


                    {{-- Store Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Store Information
                                @if ($profile_details->store)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Store Name</th>
                                    <td>{{ $profile_details->store->store_name ?? null }}</td>
                                    <th>Category</th>
                                    <td>{{ $profile_details->store->category->title ?? null }}</td>
                                    <th>Holiday Mode</th>
                                    @if ($profile_details->store)
                                        <td>{{ $profile_details->store->holiday_mode ? 'On' : 'Off' }}
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Tagline</th>
                                    <td colspan="6">{{ $profile_details->store->tag_line ?? null }}</td>
                                </tr>
                                <tr>
                                    <th>Short Desc</th>
                                    <td colspan="6">
                                        {{ $profile_details->store->short_description ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Detailed Desc</th>
                                    <td colspan="6">
                                        {{ $profile_details->store->short_description ?? null }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>


                    {{-- Warehouse Address Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Warehouse Address Information
                                @if ($profile_details->store)
                                    @if ($profile_details->store->warehouse_address)
                                        <span class="badge badge-pill badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Incomplete</span>
                                    @endif
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Warehouse Name</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_name ?? null }}
                                    </td>

                                    <th>Contact Email</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_email ?? null }}
                                    </td>

                                    <th>Mobile
                                        Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_phone_no ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>QATAR</td>

                                    <th>City</th>
                                    <td>{{ $profile_details->store->warehouse_address->city->name ?? null }}
                                    </td>
                                    <th>Zone Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_zone_no ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Street Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_street_no ?? null }}
                                    </td>

                                    <th>Building Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_building_no ?? null }}
                                    </td>

                                    <th>Floor Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_floor_no ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Apartment Number</th>
                                    <td>{{ $profile_details->store->warehouse_address->warehouse_appartment_no ?? null }}
                                    </td>
                                    <th>Address (Optional)</th>
                                    <td colspan="4">
                                        {{ $profile_details->store->warehouse_address->warehouse_address ?? null }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>


                    {{-- Return Address Address --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>
                                Return Address Information
                                @if ($profile_details->store)
                                    @if ($profile_details->store->warehouse_address)
                                        <span class="badge badge-pill badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Incomplete</span>
                                    @endif
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            </h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Warehouse
                                        Name</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_name ?? null }}
                                    </td>
                                    <th>Contact Email</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_email ?? null }}
                                    </td>
                                    <th>Mobile
                                        Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_phone_no ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>QATAR</td>
                                    <th>City</th>
                                    <td>{{ $profile_details->store->return_address->city->name ?? null }}
                                    </td>
                                    <th>Zone Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_zone_no ?? null }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Street Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_street_no ?? null }}
                                    </td>
                                    <th>Building Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_building_no ?? null }}
                                    </td>
                                    <th>Floor Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_floor_no ?? null }}
                                    </td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Apartment Number</th>
                                    <td>{{ $profile_details->store->return_address->warehouse_appartment_no ?? null }}
                                    </td>
                                    <th>Address (Optional)</th>
                                    <td colspan="4">
                                        {{ $profile_details->store->return_address->warehouse_address ?? null }}
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <hr>



                    {{-- Uploaded Files --}}
                    <h2 class="mt-5">Uploaded Files</h2>

                    {{-- Business Incharge Docs --}}
                    <div class="row bg-files mb-5">
                        <h4 class="col-12 text-left p-0">
                            Business Incharge Id Documents
                            @if ($profile_details->business_info)
                                @if ($profile_details->business_info->person_id_front_image && $profile_details->business_info->person_id_back_image)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        </h4>
                        {{-- ID - Front Side --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font px-0">ID - Front Side</h6>
                                @if ($profile_details->business_info)
                                    <img src="{{ config('app.url') . 'admin/images/businesses/id/md/' . $profile_details->business_info->person_id_front_image }}"
                                        class="mw-100" />

                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        {{-- ID - Back Side --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font px-0">ID - Back Side</h6>
                                @if ($profile_details->business_info)
                                    <img src="{{ config('app.url') . 'admin/images/businesses/id/md/' . $profile_details->business_info->person_id_back_image }}"
                                        class="mw-100" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />

                                @endif
                            </div>
                        </div>
                    </div>


                    {{-- Business Documents --}}
                    <div class="row bg-files mb-5">
                        <h4 class="col-12 text-left p-0">
                            Business Documents
                            @if ($profile_details->business_info)
                                @if ($profile_details->business_info->business_docs)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Incomplete</span>
                                @endif
                            @else
                                <span class="badge badge-pill badge-danger">Incomplete</span>
                            @endif
                        </h4>
                        @foreach ($documents as $document)
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($document->active_inputs as $active_input)
                                        <h6 class="col-6 text-left p-0">
                                            {{ $active_input->input_name }}
                                        </h6>
                                        @if ($profile_details->business_info)
                                            @if ($profile_details->business_info->business_docs)
                                                <a href='{{ config('app.doc_url') . "vendor/doc/preview/$active_input->id" }}'
                                                    target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ URL::to('/admin/images/default/preview.png') }}" />
                                                    Preview
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>


                    {{-- Store Documents --}}
                    <div class="row bg-files mb-5">
                        <h4 class="col-12 text-left p-0">Store Documents</h4>
                        {{-- logo image --}}
                        <div class="col-md-4">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font px-0">Store Logo</h6>
                                @if ($profile_details->store)
                                    <img src="{{ config('app.url') . 'admin/images/stores/logo/md/' . $profile_details->store->logo_image }}"
                                        class="mw-100" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <h6 class="col-12 text-left cust-font px-0">Store Cover</h6>
                                @if ($profile_details->store)
                                    <img src="{{ config('app.url') . 'admin/images/stores/cover/md/' . $profile_details->store->cover_image }}"
                                        class="mw-100" />
                                @else
                                    <img src="{{ URL::to('vendor/images/default/default_photo.svg') }}"
                                        class="mw-100" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>

                    <hr>
                    {{-- Update Vendor Profile Status --}}
                    <div class="row">
                        <h3 class="text-center px-3 py-3">Update Vendor Profile Status</h3>
                        <div class="col-md-12">

                            <form @can('admin-vendors-edit') action='{{ URL::to("admin/vendor/profile/update-status/$profile_details->id") }}' @endcan
                                method="post">
                                <div class="row">
                                    <input type="hidden" name="vendor_request_id"
                                        value="{{ $vendor_request->id ?? null }}">
                                    <div class="col-md-12 mb-3">
                                        <select class="form-control" name="vendor_profile_status"
                                            id="vendor_profile_status">
                                            <option value="">Select Profile Status</option>
                                            <option value="2"
                                                {{ $profile_details->vendor_profile_status == 2 ? 'selected' : '' }}>
                                                Accepted</option>
                                            <option value="3"
                                                {{ $profile_details->vendor_profile_status == 3 ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row review-note d-none">
                                    <h6 class="text-left px-3">Review Note</h6>
                                    <div class="col-md-12">
                                        @csrf
                                        <div class="col-md-12 px-0 mb-3">
                                            <textarea class="form-control" name="review_note" id="review_note"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @can('admin-vendors-edit')
                                <button class="btn btn-tertiary btn-lg float-right">Save</button>
                                @endcan
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
@section('customScripts')
    <script>
        $(document).ready(function() {
            // ON PAGE LOAD
            if ($("#vendor_profile_status").val() == 3) {
                $(".review-note").removeClass("d-none");
            } else {
                $("#review_note").val('');
                $(".review-note").addClass("d-none");
            }

            // ON STATUS CHANGE
            $("#vendor_profile_status").change(function(e) {
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
