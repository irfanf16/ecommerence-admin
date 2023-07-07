@extends('admin.layouts.master', ['navItem' => 'categories'])
@section('title', 'Edit This Brand ')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



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
            <div class="card-header pb-0 border-bottom-0">
                <h5 class="d-inline">Edit This Brand</h5>
                <a href='{{ URL::to('/admin/brands') }}' class="btn btn-primary float-right d-inline"
                    title="Go Back to All Brands Page">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <form action='{{ URL::to("/admin/brands/$brand->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6 mx-auto">

                        <div class="row">
                            {{-- choose category --}}
                            {{-- <div class="col-md-6 mb-4">
                                <label for="fullname">
                                    <strong>Select Category: <sup class="text-danger">*</sup></strong>
                                </label>
                                <select class="form-control show-tick ms select2" name="category_id" id="user_id" required>
                                    <option disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            {{-- brand name --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Brand Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $brand->name }}"
                                    required>
                            </div>
                            {{-- arabic name  --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Russian Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name_ar" id="name" value="{{ $brand->name_ar }}"
                                    required>
                            </div>
                            {{-- arabic name  --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Spanish Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name_es" id="name" value="{{ $brand->name_es }}"
                                       required>
                            </div>

                            {{-- brand description --}}
                            <div class="col-md-12 mb-3">
                                <label for="fullname">
                                    <strong>Brand Description:</strong>
                                </label>
                                <textarea class="form-control" name="description" id="description"
                                    rows="8">{{ $brand->description }}</textarea>
                            </div>


                            {{-- categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">
                                    <strong> Select Category </strong>
                                </label>
                                @php
                                    $haystack = array_column($brand->categories, 'id');

                                @endphp
                                <select class="form-control categories" style="height: auto;"
                                    placeholder="Select Categories" multiple="multiple" name="categories[]" id="">
                                    @foreach ($categories as $category)

                                        @if (in_array($category->id, $haystack))

                                            <option selected value="{{ $category->id }}"> {{ $category->title }}
                                            </option>

                                        @else
                                            <option value="{{ $category->id }}"> {{ $category->title }}
                                            </option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            {{-- Sub categories --}}

                            <div class="col-md-12 mb-4">
                                <label for="subcategories">
                                    <strong> Select SubCategory </strong>
                                </label>
                                @php
                                    $haystack = array_column($brand->subcategories, 'id');

                                @endphp
                                <select class="form-control subcategories" style="height: auto;"
                                    placeholder="Select SubCategories" multiple="multiple" name="subcategories[]" id="">
                                    @foreach ($subcategories as $subcategory)
                                        @if (in_array($subcategory->id, $haystack))

                                            <option selected value="{{ $subcategory->id }}"> {{ $subcategory->title }}
                                            </option>

                                        @else
                                            <option value="{{ $subcategory->id }}"> {{ $subcategory->title }}
                                            </option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            {{-- Child categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">
                                    <strong> Select ChildCategory </strong>
                                </label>
                                @php
                                    $haystack = array_column($brand->childcategories, 'id');

                                @endphp
                                <select class="form-control childcategories" style="height: auto;"
                                    placeholder="Select ChildCategories" multiple="multiple" name="childcategories[]" id="">
                                    @foreach ($childcategories as $childcategory)
                                        @if (in_array($childcategory->id, $haystack))

                                            <option selected value="{{ $childcategory->id }}">
                                                {{ $childcategory->title }}
                                            </option>

                                        @else
                                            <option value="{{ $childcategory->id }}"> {{ $childcategory->title }}
                                            </option>

                                        @endif

                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="row">
                            {{-- logo Image --}}
                            <div class="col-md-3 mb-4">
                                @if ($brand->logo_image)
                                    <img src='{{ config('app.url') . "storage/brands/logo/sm/$brand->logo_image" }}'
                                        alt="{{ $brand->name . ' image' }}" class="w-100 rounded-circle">
                                @else
                                    <img src="{{ URL::to('/admin/images/default/brand.svg') }}"
                                        alt="Brand Default Logo Image" class="w-100 rounded-circle">
                                @endif
                            </div>
                            <div class="col-md-9 mt-3">
                                <label for="profile_image">
                                    <strong>Logo Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="logo_image" name="logo_image">
                            </div>

                            {{-- Cover Image --}}
                            <div class="col-md-3 mb-4">
                                @if ($brand->cover_image)
                                    <img src='{{ config('app.url') . "storage/brands/cover/sm/$brand->cover_image" }}'
                                        alt="{{ $brand->name . ' image' }}" class="w-100">
                                @else
                                    <img src="{{ URL::to('/admin/images/default/brand.svg') }}"
                                        alt="Brand Default Cover Image" class="w-100 rounded-circle">
                                @endif
                            </div>
                            <div class="col-md-9 mt-3">
                                <label for="profile_image">
                                    <strong>Cover Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image">
                            </div>

                            {{-- featured --}}
                            <div class="col-md-4 my-4">
                                <label class="d-block">
                                    <strong>Featured:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="featured" id="featured"
                                        {{ $brand->featured ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>

                            {{-- status --}}
                            <div class="col-md-4 my-4">
                                <label class="d-block">
                                    <strong>Status:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status"
                                        {{ $brand->status ? 'checked' : '' }}>
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

@section('customScripts')

    {{-- script for text editor --}}
    <script type="text/javascript">
        $('#description').summernote({
            height: 200
        });

        $(document).ready(function() {

            $('.categories').select2();
            $('.subcategories').select2();
            $('.childcategories').select2();
        });
    </script>

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

@endsection
