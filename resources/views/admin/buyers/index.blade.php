@extends('admin.layouts.master', ['navItem' => 'buyers'])
@section('title', 'All Buyers ')

@section('content')
    <div class="container-fluid">
        {{-- stats Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $users_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/buyers/buyer.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Buyer Default Image">
                            </div>
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
                                <h2>{{ $active_users_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/buyers/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Active Buyer Default Image">
                            </div>
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
                                <h2>{{ $inactive_users_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/buyers/inactive.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Verified Buyer Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Unverified</h5>
                                <h2>{{ $unverified_users_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/buyers/inactive.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Unverified Buyer Default Image">

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
                        <h2><strong>Users</strong></h2>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="10%">Image</th>
                                        <th>User Details</th>
                                        <th width="5%">Verified</th>
                                        <th width="5%">Status</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>
                                                @if ($user->profile_image)
                                                    <img src='{{ config('app.url') . "admin/images/users/sm/$user->profile_image" }}'
                                                        alt="{{ $user->name . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/buyers/default.svg') }}"
                                                        alt="User Default image" class="w-100 rounded">
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $user->name }}</strong><br>
                                                {{ $user->email }}<br>
                                                {{ $user->mobile }}
                                            </td>
                                            <td>
                                                @if ($user->is_email_verified)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">No
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="5%">
                                                @if ($user->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ URL::to("admin/users/$user->id/edit") }}"
                                                    title="View This User" class="btn btn-primary btn-sm">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action='{{ URL::to("admin/users/$user->id") }}' method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Inactive This User">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
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
