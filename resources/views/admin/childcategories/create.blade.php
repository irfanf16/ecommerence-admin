@extends('admin.layouts.master',['navItem' => 'categories', 'module' => 'Childcategories'])
@section('title', 'Add New Childcategory ')

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
            <div class="card-header border-bottom-0 pb-0 form-bdr-top">
                <h5 class="d-inline">Add New Childcategory</h5>
                <a href="{{ URL::to('/admin/childcategories') }}" title="Go To Childcategory Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- childcategory form --}}
                    <form id="form" action="{{ URL::to('/admin/childcategories') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">

                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Child Categroy Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title" required>
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
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                                </div>
                            </div>
                            {{-- category_id --}}
                
                            <div class="row mb-3 ml-4">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Category
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add"> Add New
                                    </button>
                                    <select class="form-control select2" data-placeholder="Select Main Category"
                                        id="category" name="category_id" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- subcategory_id --}}
                            <div class="row mb-3  ">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Subcategory
                                    </label>
                                    
                                </div>
                                <div class="col-md-9">
                            <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-sub"> Add New
                            </button>
                                    <select class="form-control select2" data-placeholder="Select Subategory"
                                        id="subcategory" name="subcategory_id" required>
                                        <option></option>
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
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-brand"> Add New
                                    </button>
                                    <select class="form-control show-tick ms brands" data-placeholder="Select Brands"
                                        name="brands[]" multiple style="height: auto ;">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms attributes"
                                        data-placeholder="Select Attributes" name="attributes[]" style="height: auto ;"
                                        multiple>
                                        <option></option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
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
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms attributes"
                                        data-placeholder="Select SKU Attributes" name="sku_attributes[]"
                                        style="height: auto ;" multiple>
                                        <option></option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
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
                                        cols="30"></textarea>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label">Image</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="image" id="image" type="file">
                                </div>
                            </div>
                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input name="status" type="checkbox">
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
                                        <input name="featured" type="checkbox">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Add</button>
                        </div>
                </div>
            </div>
        </div>
        </form>

    </div>
    </div>
    </div>

    {{-- main category modal --}}

    @include('admin.partials.categoryModal')

    {{-- sub category modal  --}}
    @include('admin.partials.subCategoryModal')

    {{-- brand modal  --}}
    @include('admin.partials.brandModal')

  @endphp

@endsection

@section('customScripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#form").validate();
            $('.brands').select2();
            $('.attributes').select2();

            // GET SPECIFIC SUB-CATEGORIES
            $('#category').change(function(e) {
                let categoryId = $(this).val();
                getSubCats(categoryId);
            });
            
        });
    </script>



@endsection
