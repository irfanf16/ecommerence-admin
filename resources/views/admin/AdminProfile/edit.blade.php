@extends('admin.layouts.master', ['navItem' => 'adminProfile'])
@section('title', ' Admin Profile')

@section('content')
    <div class="container-fluid">

        {{-- Error Messages - Custom Validation Errors Code --}}
        @if (count($errors) > 0)
            @php $errors = Session::get('errors'); @endphp
            <div class="card bg-danger" id="alertBox">
                <div class="card-header bg-danger text-white">
                    <strong>Errors - Please Resolve These FIrst</strong>
                    <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
                </div>
                <div class="card-body p-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="card form-bdr-top">
            <div class="card-header border-0">
                <h5 class="d-inline">Edit Your Profile</h5>
                <a href="{{ URL::to('/admin/dashboard') }}" class="btn btn-primary float-right d-inline"
                    title="Go Back to All Dashboard">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <div class="row">

                    {{-- profile section --}}
                    <div class="col-md-5 px-5">

                        {{-- Vendor Image --}}
                        <div class="row">
                            <div class="col-md-6 mb-5 mx-auto ">
                                @if (1 == 1)
                                    <img src="{{ URL::to('/admin/images/default/user.svg') }}"
                                        alt="Admin Default Profile Image" class="w-100 rounded-circle">

                                @else
                                    <img src='{{ Auth::user()->avatar }}'
                                        alt="{{ Auth::user()->name . ' Profile image' }}" class="w-100 rounded-circle">
                                @endif
                                @if (Auth::user())
                                    <h2 class="text-center mt-4 mb-4 "><strong>{{ Auth::user()->name }}</strong>
                                    </h2>
                                @else
                                    <h6 class="text-center mt-2 mb-4"><strong>Storak</strong></h6>
                                @endif

                            </div>

                        </div>
                        <div class="row">

                            {{-- status --}}
                            <div class="col-md-6 mb-3">
                                <label>
                                    <strong>Profile Status:</strong>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="toggle-switch float-right mr-3">
                                    <input type="checkbox" name="status" id="status">
                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Profile"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row mt-3">

                            {{-- mobile verification --}}
                            <div class="col-md-12">

                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                    class="fa fa-phone fa-1x" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="input-group-append">
                                            <input type="email" class="form-control" name=" email" id="email"
                                                aria-label="email" aria-describedby="basic-addon2" required>
                                            <button class="btn btn-outline-secondary btn-danger"
                                                type="submit">Verify</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            {{-- Email verification --}}

                            <div class="col-md-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf

                                    {{-- if email is verified --}}

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                    class="fa fa-envelope fa-1x" aria-hidden="true"></i></span>
                                        </div>

                                        <input type="email" class="form-control" name=" email" id="email" aria-label="email"
                                            aria-describedby="basic-addon2" required>

                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btn-danger"
                                                type="submit">Verify</button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            {{-- verified Store --}}
                            {{-- <div class="col-md-3 float-left">
                                    <img src="{{ url('vendor/images/verify/store.svg') }}" class="img-fluid"
                                        alt="verified status" width="50px" height="50px">
                                </div> --}}

                            {{-- verfied email --}}
                            {{-- <div class="col-md-3 float-left ">
                                    <img src="{{ url('vendor/images/verify/email.svg') }}" class="img-fluid"
                                        alt="verfied email">
                                </div> --}}

                        </div>
                    </div>

                    {{-- input fields section --}}
                    <div class="col-md-7">
                        <form action='{{ route('adminProfile.update') }}' method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                {{-- Full name --}}

                                <div class="col-md-6 mb-3">
                                    <label for="name">
                                        <strong>Full Name: <sup class="text-danger">*</sup></strong>
                                    </label>
                                    @if (Auth::user())
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ Auth::user()->name }}" required>
                                    @else

                                        <input type="text" class="form-control" name="name" id="name" value="Storak"
                                            required>

                                    @endif

                                </div>

                                {{-- business email --}}

                                <div class="col-md-6 mb-3">
                                    <label for="email">
                                        <strong>Email:<sup class="text-danger">*</sup></strong>
                                    </label>

                                    @if (Auth::user())
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ Auth::user()->email }}" required>

                                    @else
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="storak@gmail.com" required>
                                    @endif


                                </div>

                                {{-- mobile --}}

                                <div class="col-md-6 mb-3">
                                    <label for="mobile">
                                        <strong>Mobile:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $mobile }}">
                                </div>

                                {{-- phone --}}

                                <div class="col-md-6 mb-3">
                                    <label for="phone">
                                        <strong>Phone:</strong>
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone ?? '' }}">
                                </div>
 
                                {{-- address --}}

                                <div class="col-md-6 mb-3">
                                    <label for="address">
                                        <strong>Address:<sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" name="address" id="address" Multan required>
                                </div>

                                {{-- POB --}}

                                <div class="col-md-6 mb-3">
                                    <label for="pob">
                                        <strong>POB:<sup class="text-danger">*</sup></strong></strong>
                                    </label>
                                    <input type="text" class="form-control" name="pob" id="pob" value="25689" required>
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
                                        <option value="1" selected>Multan</option>
                                        {{-- <option disabled>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == $vendor->city_id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                {{-- Website Url --}}
                                <div class="col-md-6 mb-3">
                                    <label for="url">
                                        <strong>Website:</strong>
                                    </label>
                                    <input type="url" class="form-control" id="website" name="website" value="">
                                </div>

                                {{-- Gender --}}
                                <div class="col-md-6 mb-3">
                                    <label for="gender">
                                        <strong>Gender:</strong>
                                    </label>
                                    <select class="form-control show-tick ms select2" name="gender" id="gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">female</option>
                                        <option value="transgender">transgender</option>
                                        {{-- <option disabled>Select Gender</option>
                                        <option value="1">male</option>
                                        <option value="1" {{ $vendor->gender == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ $vendor->gender == 2 ? 'selected' : '' }}>Female</option>
                                        <option value="3" {{ $vendor->gender == 3 ? 'selected' : '' }}>Other</option> --}}
                                    </select>
                                </div>

                                {{-- DOB --}}
                                <div class="col-md-6 mb-3">
                                    <label for="dob">
                                        <strong>Date of Birth:</strong>
                                    </label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="">
                                </div>

                                {{-- Profile Image --}}
                                <div class="col-md-6 mb-3">
                                    <label for="image">
                                        <strong>Profile Image:</strong>
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>

                            {{-- button --}}
                            <button type="submit" class="btn btn-primary float-right">Update</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('customScripts')

    //Jquery code for errors hide
    <script>
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });
    </script>

@endsection
