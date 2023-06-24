@extends('admin.layouts.master', ['navItem' => 'vendors', 'module' => 'Vendors'])
@section('title', 'Rejected Vendors Profiles ')

@section('content')
    <div class="container-fluid">
        @include('admin.layouts.vendorpartial')
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Rejected Vendor Profiles - {{ $vendors['rejected_vendors_count'] }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="10%">Logo</th>
                                        <th>Vendor Details</th>
                                        <th>Registered On</th>
                                        <th>Profile Updated On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($rejected_vendors->vendors as $vendor)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>
                                                @if ($vendor->profile_image)
                                                    <img src='{{ config('app.url') . "admin/images/vendors/sm/$vendor->profile_image" }}'
                                                        alt="{{ $vendor->name . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/vendor.svg') }}"
                                                        alt="Vendor Default image" class="w-100 rounded">
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $vendor->name }}</strong><br>
                                                {{ $vendor->email }}<br>
                                                {{ $vendor->mobile }}
                                            </td>
                                            <td>{{ date('d-M-Y', strtotime($vendor->created_at)) }}</td>
                                            <td>{{ date('d-M-Y', strtotime($vendor->updated_at)) }}</td>
                                            <td>
                                                <a href="{{ URL::to("admin/vendor/profile/detail/$vendor->id") }}"
                                                    title="View This Vendor Profile" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
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
