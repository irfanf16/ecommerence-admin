@extends('admin.layouts.master', ['navItem' => 'buyers'])
@section('title', 'Edit This Buyer ')

@section('content')
    <div class="container-fluid">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card form-bdr-top">
            <div class="card-header border-0">
                <h5 class="d-inline">Edit This Buyer</h5>
                <a href="{{ URL::to('/admin/buyers') }}" class="btn btn-primary float-right d-inline"
                    title="Go Back to All Buyers Page">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body pt-0">
                <form action='{{ URL::to("/admin/buyers/$user->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- User Image --}}
                    <div class="row">
                        <div class="col-md-2 mb-5 mx-auto">
                            @if ($user->profile_image)
                                <img src='{{ config('app.url') . "admin/images/buyers/md/$user->profile_image" }}'
                                    alt="{{ $user->name . ' Profile image' }}" class="w-100 rounded-circle">
                            @else
                                <img src="{{ URL::to('/admin/images/default/user.svg') }}"
                                    alt="User Default Profile Image" class="w-100 rounded-circle">
                            @endif
                            <h2 class="text-center mt-2"><strong>{{ $user->name }}</strong></h2>
                        </div>
                    </div>

                    <div class="row">
                        {{-- User name --}}
                        <div class="col-md-4 mb-4">
                            <label for="fullname">
                                <strong>User Name: <sup class="text-danger">*</sup></strong>
                            </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}"
                                required>
                        </div>
                        {{-- business email --}}
                        <div class="col-md-4 mb-4">
                            <label for="email">
                                <strong>Email:<sup class="text-danger">*</sup></strong>
                            </label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"
                                required>
                        </div>
                        {{-- mobile --}}
                        <div class="col-md-4 mb-4">
                            <label for="mobile">
                                <strong>Mobile:<sup class="text-danger">*</sup></strong>
                            </label>
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                value="{{ $user->mobile }}" required>
                        </div>
                        {{-- phone --}}
                        <div class="col-md-4 mb-4">
                            <label for="phone">
                                <strong>Phone:</strong>
                            </label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                        </div>

                        {{-- address --}}
                        <div class="col-md-4 mb-4">
                            <label for="address">
                                <strong>Address:<sup class="text-danger">*</sup></strong>
                            </label>
                            <input type="text" class="form-control" name="address" id="address"
                                value="{{ $user->address }}" required>
                        </div>

                        {{-- POB --}}
                        <div class="col-md-4 mb-4">
                            <label for="pob">
                                <strong>POB:<sup class="text-danger">*</sup></strong></strong>
                            </label>
                            <input type="number" class="form-control" name="pob" id="pob" value="{{ $user->pob }}"
                                required>
                        </div>

                        {{-- country dropdown --}}
                        <div class="col-md-4 mb-4">
                            <label for="country">
                                <strong>Country:<sup class="text-danger">*</sup></strong>
                            </label>
                            <select class="form-control show-tick ms select2" name="country_id" id="country_id" required>
                                <option disabled>Select Country</option>
                                <option value="1" selected>Qatar</option>
                            </select>
                        </div>

                        {{-- City --}}
                        <div class="col-md-4 mb-4">
                            <label for="city">
                                <strong>City:<sup class="text-danger">*</sup></strong></strong>
                            </label>
                            <select class="form-control show-tick ms select2" name="city_id" id="city_id" required>
                                <option disabled>Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $city->id == $user->city_id ? 'selected' : '' }}>{{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-4 mb-4">
                            <label for="profile_image">
                                <strong>Gender:</strong>
                            </label>
                            <select class="form-control show-tick ms select2" name="gender" id="gender" required>
                                <option disabled>Select Gender</option>
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female</option>
                                <option value="3" {{ $user->gender == 3 ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        {{-- DOB --}}
                        <div class="col-md-4 mb-4">
                            <label for="profile_image">
                                <strong>Date of Birth:</strong>
                            </label>
                            <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->dob }}">
                        </div>

                        {{-- Profile Image --}}
                        <div class="col-md-4 mb-4">
                            <label for="profile_image">
                                <strong>Profile Image:</strong>
                            </label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h5><strong> Manage User Profile</strong></h5>
                        </div>
                        {{-- status --}}
                        <div class="col-md-3 mb-4">
                            <label class="d-block">
                                <strong>Status:</strong>
                            </label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" id="status" {{ $user->status ? 'checked' : '' }}>
                                <span class="toggle-switch-slider"></span>
                            </label>
                        </div>

                        {{-- mobile verified --}}
                        <div class="col-md-3 mb-4">
                            <label class="d-block">
                                <strong>Mobile Verified:</strong>
                            </label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_verified" id="is_verified"
                                    {{ $user->is_mobile_verified ? 'checked' : '' }}>
                                <span class="toggle-switch-slider"></span>
                            </label>
                        </div>

                        {{-- email verified --}}
                        <div class="col-md-3 mb-4">
                            <label class="d-block">
                                <strong>Email Verified:</strong>
                            </label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_email_verified" id="is_email_verified"
                                    {{ $user->is_email_verified ? 'checked' : '' }}>
                                <span class="toggle-switch-slider"></span>
                            </label>
                        </div>
                    </div>

                    {{-- button --}}
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
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
