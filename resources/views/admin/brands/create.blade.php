@extends('admin.layouts.master', ['navItem' => 'categories'])
@section('title', 'Add New Brand ')

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
                <h5 class="d-inline">Add New Brand</h5>
                <a href="{{ URL::to('/admin/brands') }}" class="btn btn-primary float-right d-inline"
                    title="Go Back to All Brands Page">
                    <strong>back</strong>
                </a>
            </div>

            <div class="card-body">
                <form action="{{ URL::to('/admin/brands') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            {{-- arabic name  --}}
                            <div class="col-md-12 mb-4">
                                <label for="name_ar">
                                    <strong>Russian Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name_ar" id="name_ar" required>
                            </div>

                            {{-- arabic name  --}}
                            <div class="col-md-12 mb-4">
                                <label for="name_ar">
                                    <strong>Spanish Name: <sup class="text-danger">*</sup></strong>
                                </label>
                                <input type="text" class="form-control" name="name_es" id="name_es" required>
                            </div>
                            {{-- brand description --}}
                            <div class="col-md-12 mb-4">
                                <label for="fullname">
                                    <strong>Brand Description:</strong>
                                </label>
                                <textarea class="form-control" name="description" id="description" rows="8"></textarea>
                            </div>
                            {{-- categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">

                                    <strong> Select Category </strong>
                                </label>
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline" data-toggle="modal" data-target="#add"> Add New
                                </button>
                                <select class="form-control categories" style="height: auto;"
                                    placeholder="Select Categories" multiple="multiple" name="categories[]" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Sub categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="subcategories">
                                    <strong> Select SubCategory </strong>
                                </label>
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline" data-toggle="modal" data-target="#add-sub"> Add New
                                </button>
                                <select class="form-control subcategories" style="height: auto;"
                                    placeholder="Select SubCategories" multiple="multiple" name="subcategories[]" id="subcategory">
                                </select>
                            </div>
                            {{-- Child categories --}}
                            <div class="col-md-12 mb-4">
                                <label for="categories">
                                    <strong> Select ChildCategory </strong>
                                </label>
                                <button type="button" class="btn btn-sm btn-primary  float-right d-inline" data-toggle="modal" data-target="#add-child"> Add New
                                </button>
                                <select class="form-control childcategories" style="height: auto;"
                                    placeholder="Select ChildCategories" multiple="multiple" name="childcategories[]" id="childCategory">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            {{-- logo Image --}}
                            <div class="col-md-12 mb-4">
                                <label for="profile_image">
                                    <strong>Logo Image:</strong>
                                </label>
                                <input type="file" class="form-control" id="logo_image" name="logo_image">
                            </div>
                            {{-- Cover Image --}}
                            <div class="col-md-12 mb-4">
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
                                    <input type="checkbox" name="featured" id="featured">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>

                            {{-- status --}}
                            <div class="col-md-4 my-4">
                                <label class="d-block">
                                    <strong>Status:</strong>
                                </label>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" id="status">
                                    <span class="toggle-switch-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    {{-- button --}}
                    <button type="submit" class="btn btn-primary float-right">Add</button>
                </form>
            </div>
        </div>
    </div>
    @include('admin.partials.categoryModal')
    @include('admin.partials.subCategoryModal')
    @include('admin.partials.childCategoryModal')
@endsection

@section('customScripts')

    {{-- script for text editor --}}
    <script type="text/javascript">
        // api url
        var api_url = "{{ config('app.url') }}";


        $('#description').summernote({
            height: 200
        });



        $(document).ready(function() {
            $('.categories').select2();
            $('.subcategories').select2();
            $('.childcategories').select2();
            $('.brands').select2();
            $('.attributes').select2();

            // $('.categories').change(function() {
            //     var category_id = $(this).val();
            //     $.ajax({
            //         url: `${api_url}/admin/categories/${category_id}/subcategories`,
            //         type: "GET",
            //         "crossDomain": true,
            //         success: function(res) {
            //             console.log(res);
            //         }
            //     });
            // });

            $('#category').change(function(e) {
                let categoryId = $(this).val();
                getMultipleSubCats(categoryId);
            });

            $('#subcategory').change(function(e) {
                let subcategoryId = $(this).val();
                getMultipleChildCats(subcategoryId);
            });

        });
    </script>

@endsection
