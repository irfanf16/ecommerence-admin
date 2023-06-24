@extends('admin.layouts.master', ['navItem' => 'stores', 'module' => 'Customer Stores'])
@section('title', 'Customer Store Information')

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
            {{-- <div class="card-header border-0">
                <h3 class="mb-0 text-center">Vendor Profile Information
                    @if ($store->vendor_profile_status == 1)
                        <sup class="badge badge-pill badge-info text-white">Under Review</sup>
                    @elseif($store->vendor_profile_status == 2)
                        <sup class="badge badge-pill badge-success">&#10003; Approved</sup>
                    @elseif($store->vendor_profile_status == 3)
                        <sup class="badge badge-pill badge-danger">Rejected</sup>
                    @endif
                </h3>
            </div> --}}

            <div class="card-body">
                <div class="col-md-12">

                    {{-- Personal Information --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="d-inline">
                               Customer Store Information
                                {{-- @if ($userStore->is_verified)
                                    <span class="badge badge-pill badge-success">Verified</span>
                                @else
                                    <span class="badge badge-pill badge-danger">Unverified</span>
                                @endif --}}
                            </h4>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Store Name:</th>
                                    <td>{{ $userStore->name }}</td>
                                    <th>Owner Name:</th>
                                    <td>{{ $userStore->customer_details->name ?? 'N/A' }}</td>
                                    <th>Owner Email:</th>
                                    <td>{{ $userStore->customer_details->email ?? 'N/A' }}</td>
                                    <th>Owner Mobile:</th>
                                    <td>{{ $userStore->customer_details->mobile ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="d-inline">
                               Customer Store Collections
                            </h4>
                            <a href="{{ URL::to("admin/stores/customer")  }}" class="btn btn-primary d-inline float-right">Back</a>

                            <div class="body pt-4">
                                <div class="table-responsive">
                                    <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Visibility</th>
                                                <th style="width: 100%">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $count = 1; @endphp
                                           @foreach($collections as $collection)
                                           <tr>
                                               <td>{{ $count }}</td>
                                               <td>
                                                   {{ $collection->name }}
                                               </td>
                                               <td>
                                                {{ $collection->code }}
                                               </td>
                                               <td width="5%">
                                                   <label class="toggle-switch">
                                                       <input data-id="{{$collection->id}}" type="checkbox" class="float-right toggle-class collection_visibility_change" name="visibility" id="status-{{ $collection->id }}"
                                                           {{ $collection->visibility ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                   <span class="toggle-switch-slider" title="Activate/Deactivate Your Collection"></span>
                                                   </label>
                                               </td>
                                               <td>
                                                <a href="{{ URL::to("admin/stores/customer/collections/$collection->id") }}"
                                                    title="Show This customer Store" class="btn btn-sm btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>

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
