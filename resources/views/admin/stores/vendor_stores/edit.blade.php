    @extends('admin.layouts.master', ['navItem' => 'stores' , 'module' => 'Stores'])
@section('title', 'Edit This Store ')

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
            <div class="card-header border-bottom-0">
                <h5 class="d-inline">Edit This Store</h5>
                <a href="{{ URL::to('/admin/stores/vendor') }}" class="btn btn-primary float-right d-inline"
                    title="Go Back to All Stores Page">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <form action='{{ URL::to("/admin/stores/vendor/$store->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-md-8 mx-auto">
                        <div class="row">

                            {{-- Store cover image --}}
                            <div class="col-md-12 mb-5">
                                @if ($store->cover_image)
                                    <img src='{{ config('app.url') . "admin/images/stores/cover/sm/$store->cover_image" }}'
                                        alt="{{ $store->store_name . ' Logo' }}" class="w-100 rounded img-bdr-primary">
                                @else
                                    <img src="{{ URL::to('/admin/images/icons/stores/banner.jpg') }}"
                                        alt="Store Default Cover Image" class="w-100 rounded img-bdr-primary">
                                @endif
                            </div>

                            {{-- choose Vendor --}}
{{--                            <div class="col-md-6 mb-4">--}}
{{--                                <label for="fullname">--}}
{{--                                    <strong>Select Vendor: <sup class="text-danger">*</sup></strong>--}}
{{--                                </label>--}}
{{--                                 <select class="form-control show-tick ms select2" name="user_id" id="user_id" required>--}}
{{--                                    <option disabled>Select Vendor</option>--}}
{{--                                    @foreach ($vendors as $vendor)--}}
{{--                                        <option value="{{ $vendor->id }}"--}}
{{--                                            {{ $vendor->id == $store->user_id ? 'selected' : '' }}>{{ $vendor->name }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            {{-- Store name --}}
                            <div class="col-md-6 mb-4">
                                <label for="fullname">
                                    <strong>Store Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="store_name" id="store_name"
                                    value="{{ $store->store_name }}" required>
                            </div>

                            {{-- Store description --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Store Description: <sup class="text-danger">*</sup></strong>
                                </label>
                                <textarea class="form-control" name="description" id="description"
                                    rows="8">{{ $store->short_description }}</textarea>
                            </div>
                        </div>

                        {{-- logo Image --}}
                        <div class="row mt-4">
                            <div class="col-md-10">
                                <label for="profile_image">
                                    <strong>Logo Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="logo_image" name="logo_image">
                            </div>
                            <div class="col-md-2">
                                @if ($store->logo_image)
                                    <img src='{{ config('app.url') . "admin/images/stores/logo/sm/$store->logo_image" }}'
                                        alt="{{ $store->store_name . ' Logo' }}" class="w-100 rounded">
                                @else
                                    <img src="{{ URL::to('/admin/images/icons/stores/default.svg') }}"
                                        alt="Store Default Logo" class="w-100 rounded">
                                @endif
                            </div>
                        </div>

                        {{-- Cover Image --}}
                        <div class="row mt-4">
                            <div class="col-md-10 mb-4">
                                <label for="profile_image">
                                    <strong>Cover Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image">
                            </div>
                            {{-- <div class="col-md-2">
                                @if ($store->cover_image)
                                    <img src='{{ config('app.url') . "admin/images/stores/cover/sm/$store->cover_image" }}'
                                        alt="{{ $store->store_name . ' Logo' }}" class="w-100 rounded">
                                @else
                                    <img src="{{ URL::to('/admin/images/icons/stores/default.svg') }}"
                                        alt="Store Default Cover Image" class="w-100 rounded">
                                @endif
                            </div> --}}
                        </div>

                        {{-- featured --}}
                        <div class="row mt-4">
                            <div class="col-md-4 mb-4">
                                <label class="d-block">
                                    <strong>Featured:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="featured" id="featured"
                                        {{ $store->featured ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>

                            {{-- status --}}
                            <div class="col-md-4 mb-4">
                                <label class="d-block">
                                    <strong>Status:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status"
                                        {{ $store->status ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
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
