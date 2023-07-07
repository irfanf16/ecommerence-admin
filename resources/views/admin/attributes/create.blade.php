@extends('admin.layouts.master',['navItem' => 'categories'])
@section('title', 'Add New Attribute ')

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
            <div class="card-header form-bdr-top pb-0">
                <h5 class="d-inline">Add Attribute</h5>
                <a href="{{ URL::to('/admin/attributes') }}" title="Go To All Attribute Page"
                    class="btn btn-primary float-right d-inline mb-3">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Attribute form --}}
                    <form action="{{ URL::to('/admin/attributes') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            {{-- title arabic  --}}
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
                            {{-- title arabic  --}}
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
                            {{-- description --}}
                            {{-- <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="description" class="col-form-label">
                                        Description
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                        cols="30"></textarea>
                                </div>
                            </div> --}}
                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="status" id="status">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>

                            {{-- Category --}}
                            {{-- <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">Category</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2" placeholder="Select Category" required
                                        name="category" id="">
                                        <option disabled selected value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}


                            {{-- Sub Category --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">SubCategory</label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-sub"> Add New
                                    </button>
                                    <select class="form-control select2" style="height: auto;"
                                        placeholder="Select SubCategory" multiple="multiple" name="subcategories[]" id="">
                                        <option disabled selected value="">Select SubCategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            {{-- Child Category --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">ChildCategory</label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-child"> Add New
                                    </button>
                                    <select class="form-control select2" style="height: auto;"
                                        placeholder="Select ChildCategory" multiple="multiple" name="childcategories[]"
                                        id="">
                                        <option disabled selected value="">Select ChildCategory</option>
                                        @foreach ($childcategories as $childcategory)
                                            <option value="{{ $childcategory->id }}">{{ $childcategory->title }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">Keys</label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-primary  float-right d-inline mb-1" data-toggle="modal" data-target="#add-key"> Add New
                                    </button>
                                    <select class="form-control select2" style="height: auto;" placeholder="Select Keys "
                                        multiple="multiple" name="keys[]" id="">


                                        @foreach ($keys as $key)

                                            <option value="{{ $key->id }}">{{ $key->name }}
                                            </option>


                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.subCategoryModal')
    @include('admin.partials.childCategoryModal')
    @include('admin.partials.keyModal')
@endsection


@section('customScripts')

    <script>
        // console.log($api_path);
        // $(document).ready(function() {
        //     $('[name=category]').change(function() {
        //         var id = $(this).val();

        //         // console.log(id);
        //         $.ajax({
        //             url: `${$api_path}api/admin/categories/${id}/subcategories`,
        //             headers: {
        //                 "Authorization": $token
        //             },
        //             type: "GET",
        //             success: function(res) {
        //                 // console.log(res);
        //                 if (res.status == 200) {
        //                     $('[name=subcategory]').html(`
    //                         <option value="">Select SubCategory</option>
    //                     `);
        //                     res.subcategories.forEach(subcat => {

        //                         $('[name=subcategory]').append(`
    //                             <option value="${subcat.id}">${subcat.title}</option>
    //                         `);
        //                     });
        //                     $('.subcat-block').show();
        //                 }

        //             }
        //         });

        //     });
        // });
    </script>

@endsection
