@extends('admin.layouts.master', ['navItem' => 'vendors'])
@section('title', 'Edit This Vendor ')

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
                <h5 class="d-inline">Edit This Vendor</h5>
                <a href="{{ URL::to('/admin/vendors') }}" class="btn btn-primary float-right d-inline"
                    title="Go Back to All Vendors Page">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <form action='{{ URL::to("/admin/vendors/$vendor->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- profile section --}}
                        <div class="col-md-4">
                            {{-- Vendor Image --}}
                            <div class="row">
                                <div class="col-md-6 mb-5 mx-auto">
                                    @if ($vendor->profile_image)
                                        <img src='{{ config('app.url') . "admin/images/vendors/sm/$vendor->profile_image" }}'
                                            alt="{{ $vendor->name . ' Profile image' }}" class="w-100 rounded-circle">
                                    @else
                                        <img src="{{ URL::to('/admin/images/default/vendor.svg') }}"
                                            alt="Vendor Default Profile Image" class="w-100 rounded-circle">
                                    @endif
                                    <h2 class="text-center mt-2"><strong>{{ $vendor->name }}</strong></h2>
                                </div>
                            </div>
                        </div>

                        {{-- input fields section --}}
                        <div class="col-md-8">
                            <div class="row">
                                {{-- Full name --}}
                                <div class="col-md-6 mb-3">
                                    <label for="fullname">
                                        <strong>Full Name: <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $vendor->name }}" required>
                                </div>

                                {{-- business email --}}
                                <div class="col-md-6 mb-3">
                                    <label for="email">
                                        <strong>Email:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ $vendor->email }}" required>
                                </div>

                                {{-- mobile --}}
                                <div class="col-md-6 mb-3">
                                    <label for="mobile">
                                        <strong>Mobile:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="mobile" id="mobile"
                                        value="{{ $vendor->mobile }}" required>
                                </div>

                                {{-- phone --}}
                                <div class="col-md-6 mb-3">
                                    <label for="phone">
                                        <strong>Phone:</strong>
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        value="{{ $vendor->phone }}">
                                </div>

                                {{-- address --}}
                                <div class="col-md-6 mb-3">
                                    <label for="address">
                                        <strong>Address:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        {{ $vendor->address }} required>
                                </div>

                                {{-- POB --}}
                                <div class="col-md-6 mb-3">
                                    <label for="pob">
                                        <strong>POB:<sup class="text-danger">*</sup></strong></strong>
                                    </label>
                                    <input type="text" class="form-control" name="pob" id="pob"
                                        value="{{ $vendor->pob }}" required>
                                </div>

                                {{-- country dropdown --}}
                                <div class="col-md-6 mb-3">
                                    <label for="country">
                                        <strong>Country:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <select class="form-control show-tick ms select2" name="country_id" id="country_id"
                                        required>
                                        <option disabled>Select Country</option>
                                        <option value="1" selected>Qatar</option>
                                    </select>
                                </div>

                                {{-- City --}}
                                <div class="col-md-6 mb-3">
                                    <label for="city">
                                        <strong>City:<sup class="text-danger">*</sup></strong></strong>
                                    </label>
                                    <select class="form-control show-tick ms select2" name="city_id" id="city_id" required>
                                        <option disabled>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == $vendor->city_id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Website Url --}}
                                <div class="col-md-6 mb-3">
                                    <label for="profile_image">
                                        <strong>Website:</strong>
                                    </label>
                                    <input type="url" class="form-control" id="website" name="website"
                                        value="{{ $vendor->website }}">
                                </div>

                                {{-- Gender --}}
                                <div class="col-md-6 mb-3">
                                    <label for="profile_image">
                                        <strong>Gender:</strong>
                                    </label>
                                    <select class="form-control show-tick ms select2" name="gender" id="gender" required>
                                        <option disabled>Select Gender</option>
                                        <option value="1" {{ $vendor->gender == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ $vendor->gender == 2 ? 'selected' : '' }}>Female</option>
                                        <option value="3" {{ $vendor->gender == 3 ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                {{-- DOB --}}
                                <div class="col-md-6 mb-3">
                                    <label for="profile_image">
                                        <strong>Date of Birth:</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dob" name="dob"
                                        value="{{ $vendor->dob }}">
                                </div>

                                {{-- Profile Image --}}
                                <div class="col-md-6 mb-3">
                                    <label for="profile_image">
                                        <strong>Profile Image:</strong>
                                    </label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h5><strong> Manage Vendor Profile</strong></h5>
                                </div>
                                {{-- status --}}
                                <div class="col-md-3 mb-3">
                                    <label class="d-block">
                                        <strong>Status:</strong>
                                    </label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="status" id="status">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>

                                {{-- featured --}}
                                <div class="col-md-3 mb-3">
                                    <label class="d-block">
                                        <strong>Featured:</strong>
                                    </label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="featured" id="featured">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>

                                {{-- verified --}}
                                <div class="col-md-3 mb-3">
                                    <label class="d-block">
                                        <strong>Profile Verification:</strong>
                                    </label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="is_verified" id="is_verified">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>

                            {{-- button --}}
                            <button type="submit" class="btn btn-primary float-right">Add</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
