@extends('admin.layouts.master',['navItem' => 'categories', 'module' => 'Childcategories'])
@section('title', 'Edit This Childcategory ')

@section('content')
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
                <h5 class="d-inline">Edit This Childcategory</h5>
                <a href="{{ URL::to('/admin/childcategories') }}" title="Go To Childcategory Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- childcategory form --}}
                    <form id="form" action='{{ URL::to("/admin/childcategories/$childcategory->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">

                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Child Category Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $childcategory->title }}" required>
                                </div>
                            </div>
                            {{-- arabic title  --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title_ar" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Russian Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title_ar" name="title_ar"
                                        value="{{ $childcategory->title_ar }}" required>
                                </div>
                            </div>
                            {{-- arabic title  --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title_ar" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Spanish Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title_es" name="title_es"
                                           value="{{ $childcategory->title_es }}" required>
                                </div>
                            </div>
                            {{-- category_id --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Category
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-placeholder="Select Main Category"
                                        id="category" name="category_id" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $childcategory->category_id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- subcategory_id --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Subcategory
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-placeholder="Select Subategory"
                                        id="subcategory" name="subcategory_id" required>
                                        {{-- <option></option> --}}
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ $subcategory->id == $childcategory->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            {{-- Brands --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        Brands
                                    </label>
                                </div>
                                @php
                                    // dd($childcategory->brands);
                                    $haystack = array_column($childcategory->brands, 'id');

                                @endphp
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms brands" data-placeholder="Select Brands"
                                        name="brands[]" style="height: auto ;" multiple>
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            @if (in_array($brand->id, $haystack))
                                                <option selected value="{{ $brand->id }}">{{ $brand->name }}
                                                </option>

                                            @else

                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Attribute --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        Attributes
                                    </label>
                                </div>
                                @php
                                    // dd($childcategory->brands);
                                    $haystack = array_column($childcategory->attributes, 'id');

                                @endphp
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms attributes"
                                        data-placeholder="Select Attributes" name="attributes[]" multiple
                                        style="height:auto;">
                                        <option></option>
                                        @foreach ($attributes as $attribute)
                                            @if (in_array($attribute->id, $haystack))

                                                <option selected value="{{ $attribute->id }}">{{ $attribute->title }}
                                                </option>
                                            @else
                                                <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>

                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            {{-- SKU Attribute --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        SKU Attributes
                                    </label>
                                </div>
                                @php
                                    // dd($childcategory->brands);
                                    $haystack = array_column($childcategory->sku_attributes, 'id');

                                @endphp
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms attributes"
                                        data-placeholder="Select Attributes" name="sku_attributes[]" multiple
                                        style="height:auto;">
                                        <option></option>
                                        @foreach ($attributes as $attribute)
                                            @if (in_array($attribute->id, $haystack))

                                                <option selected value="{{ $attribute->id }}">{{ $attribute->title }}
                                                </option>
                                            @else
                                                <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>

                                            @endif
                                        @endforeach
                                    </select>
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
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                        cols="30">{{ $childcategory->description }}</textarea>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label mt-4">Image</label>
                                </div>
                                <div class="col-md-7">
                                    <input name="image" id="image" type="file" class="mt-4">
                                </div>
                                <div class="col-md-2">
                                    @if ($childcategory->image)
                                        <img src='{{ config('app.url') . "storage/childcategories/image/lg/$childcategory->image" }}'
                                            alt="{{ $childcategory->title . ' image' }}" class="w-100 rounded">
                                    @else
                                        <img src="{{ URL::to('/admin/images/icons/childcategories/default.svg') }}"
                                            alt="Childcategory Default image" class="w-100 rounded">
                                    @endif
                                </div>
                            </div>
                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input name="status" type="checkbox"
                                            {{ $childcategory->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                            {{-- featured --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="featured" class="col-form-label">Featured</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input name="featured" type="checkbox"
                                            {{ $childcategory->featured ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                </div>
            </div>
        </div>
        </form>

    </div>
    </div>
    </div>
@endsection

@section('customScripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#form").validate();
            $('.brands').select2();
            $('.attributes').select2();


            // GET SPECIFIC SERVICES FROM DB USING AJAX
            $('#category').change(function(e) {
                let categoryId = $(this).val();
                getSubCats(categoryId);
            });
        });
    </script>

    {{-- SWEET ALERT --}}
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
