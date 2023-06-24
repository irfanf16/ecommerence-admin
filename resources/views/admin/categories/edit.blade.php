@extends('admin.layouts.master',['navItem' => 'categories' , 'module' => 'Categories'])
@section('title', 'Edit This Category ')

@section('content')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid ">

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

        <div class="card">
            <div class="card-header border-bottom-0 form-bdr-top pb-0">
                <h5 class="d-inline">Edit This Category</h5>
                <a href="{{ URL::to('/admin/categories') }}" title="Go To All Categories Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">

                    {{-- category cover image --}}
                    <div class="col-md-12 mb-5">
                        @if ($category->banner_image)
                            <img src='{{ config('app.url') . "storage/categories/banner/lg/$category->banner_image" }}'
                                alt="{{ $category->title . ' image' }}" class="w-100 rounded img-bdr-primary">
                        @else
                            <img src="{{ URL::to('/admin/images/default/banner.jpg') }}"
                                alt="category Default Banner image" class="w-100 rounded img-bdr-primary">
                        @endif
                    </div>

                    {{-- category form --}}
                    <form action='{{ URL::to("/admin/categories/$category->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- title --}}
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $category->title }}" placeholder="Please Enter Category title..."
                                        required>
                                </div>
                            </div>
                            {{-- arabic title  --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title_ar" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Arabic Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title_ar" name="title_ar"
                                        value="{{ $category->title_ar }}" placeholder="Please Enter Category title..."
                                        required>
                                </div>
                            </div>
                            {{-- description --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="description" class="col-form-label">
                                        Description
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="description" id="description" rows="5" cols="30"
                                        placeholder="Please write Description about Category...">{{ $category->description }}</textarea>
                                </div>


                            </div>

                            <div class="row mb-4">
                                {{-- Brands --}}
                                <div class="col-md-3 ">
                                    <label for="categories">
                                        Select Brands
                                    </label>
                                </div>

                                <div class="col-md-9">

                                    @php
                                        $haystack = array_column($category->brands, 'id');

                                    @endphp
                                    <select class="form-control brands" style="height: auto;" placeholder="Select Brands"
                                        multiple="multiple" name="brands[]" id="">
                                        @foreach ($brands as $brand)

                                            @if (in_array($brand->id, $haystack))

                                                <option selected value="{{ $brand->id }}"> {{ $brand->name }}
                                                </option>

                                            @else
                                                <option value="{{ $brand->id }}"> {{ $brand->name }}
                                                </option>

                                            @endif

                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        {{-- logo_image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="logoImage" class="col-form-label mt-4">Mega Menu Image (500x500)</label>
                            </div>
                            <div class="col-md-7">
                                <input name="logo_image" id="logo_image" type="file" class="mt-4">
                            </div>
                            <div class="col-md-2">
                                @if ($category->logo_image)
                                    <img src='{{ config('app.url') . "storage/categories/logo/lg/$category->logo_image" }}'
                                        alt="{{ $category->title . ' image' }}" class="w-100 rounded img-bdr-primary">
                                @else
                                    <img src="{{ URL::to('/admin/images/icons/categories/default.svg') }}"
                                        alt="category Default Logo image" class="w-100 rounded img-bdr-primary">
                                @endif
                            </div>
                        </div>
                        {{-- mobile_image --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="MobileImage" class="col-form-label mt-4"> Image (150x150) /png</label>
                            </div>
                            <div class="col-md-7">
                                <input name="mobile_image" id="mobile_image" type="file" class="mt-4">
                            </div>
                            <div class="col-md-2">
                                @if ($category->mobile_image)
                                    <img src='{{ config('app.url') . "storage/categories/mobile/lg/$category->mobile_image" }}'
                                        alt="{{ $category->title . 'Mobile Image' }}"
                                        class="w-100 rounded img-bdr-primary">
                                @else
                                    <img src="{{ URL::to('/admin/images/icons/categories/default.svg') }}"
                                        alt="category Default Logo image" class="w-100 rounded img-bdr-primary">
                                @endif
                            </div>
                        </div>
                        {{-- banner_image --}}
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label for="bannerImage" class="col-form-label mt-4">Banner Image (1200 x 225)</label>
                            </div>
                            <div class="col-md-9">
                                <input name="banner_image" id="banner_image" type="file" class="mt-4">
                            </div>
                        </div>
                        {{-- status --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="status" class="col-form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status"
                                        {{ $category->status ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                        {{-- featured --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="featured" class="col-form-label">Featured</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="featured" id="featured"
                                        {{ $category->featured ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                        {{-- popular --}}
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="popular" class="col-form-label">Popular</label>
                            </div>
                            <div class="col-md-9">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="popular" id="popular"
                                        {{ $category->popular ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {

            $('.brands').select2();
        });
    </script>

@endsection
