@extends('admin.layouts.master',['navItem' => 'subcategories', 'module' => 'Subcategories'])
@section('title', 'Add New Subcategory ')

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
                <h5 class="d-inline">Add New Subcategory</h5>
                <a href="{{ URL::to('/admin/subcategories') }}" title="Go To Subcategories Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- subcategory form --}}
                    <form action="{{ URL::to('/admin/subcategories') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">


                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Sub Category Title
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
                                        <sup class="font-weight-bold text-danger">* </sup>Russian Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" required>
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
                                    <input type="text" class="form-control" id="title_es" name="title_es" required>
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
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add"> Add New
                                    </button>
                                    <select class="form-control show-tick ms select2"
                                        data-placeholder="Select Main Category" name="category_id" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-brand"> Add New
                                    </button>
                                    <select class="form-control show-tick ms brands" data-placeholder="Select Brands"
                                        style="height: auto ;" name="brands[]" multiple>
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>





                            {{-- attributes --}}
                            <div class="row mb-4 " style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">Attributes</label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-attrib"> Add New
                                    </button>
                                    <select class="form-control select2" style="height: auto;"
                                        placeholder="Select Attributes" multiple="multiple" style="height: auto;"
                                        name="attributes[]" id="">
                                        <option disabled selected value="">Select Attributes</option>
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
                                    <input name="image" id="image" multiple type="file">
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
                    </form>
                </div>
            </div>
        </div>

    </div>

    @include('admin.partials.categoryModal')
    @include('admin.partials.brandModal')
    @include('admin.partials.attributeModal')
@endsection


@section('customScripts')


    <script>
        $(document).ready(function() {

            $('.brands').select2();
            $('.subcategories').select2();
            $('.categories').select2();
            $('.childcategories').select2();

        });
    </script>


@endsection
