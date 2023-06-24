@extends('admin.layouts.master',['navItem' => 'categories'])
@section('title', 'Add New Category ')

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
                <h5 class="d-inline">Add New Category</h5>
                <a href="{{ URL::to('/admin/categories') }}" title="Go To Categories Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-9 mx-auto">
                    {{-- category form --}}
                    <form action="{{ URL::to('/categories') }}" method="POST">
                        @csrf

                        <div class="col-md-12">

                            {{-- choose category --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="fullname">
                                        <strong>Select Category: <sup class="text-danger">*</sup></strong>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms select2" name="category_id" id="mainCat">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- choose subcategory --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="fullname">
                                        <strong>Select Subcategory: <sup class="text-danger">*</sup></strong>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms select2" name="subcategory_id" id="subCat">
                                        <option value="" selected>choose category first</option>
                                    </select>
                                </div>
                            </div>

                            {{-- choose childcategory --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="fullname">
                                        <strong>Select Childcategory: <sup class="text-danger">*</sup></strong>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms select2" name="childcategory_id" id="childCat">
                                        <option value="" selected>choose subcategory first</option>
                                    </select>
                                </div>
                            </div>

                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Please Enter Category title..." required>
                                </div>
                            </div>

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
                            <button type="submit" class="btn btn-primary float-right">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('customScripts')

    <script>
        $(document).ready(function() {

            $("#mainCat").change(function(e) {
                e.preventDefault();
                $("#subCat").empty();
                $("#childCat").empty();

                let id = $(this).val();


                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "GET",
                    url: "/subcategories",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        // console.log(response);
                        // return;

                        let records = response.subcategories.length;

                        if (records > 0) {
                            $("#subCat").html(
                                '<option value="" selected>select subcategory</option>'
                            );
                            subcategories = response.subcategories;
                            $.each(subcategories, function(key, subcategory) {
                                $("#subCat").append(
                                    '<option  value="' +
                                    subcategory.id +
                                    '">' +
                                    subcategory.name +
                                    "</option>"
                                );
                            });
                        } else {
                            $("#subCat").html(
                                '<option value="" selected>No Record Found</option>'
                            );
                        }
                    },
                });

            });

            $("#subCat").change(function(e) {
                e.preventDefault();

                let id = $(this).val();
                console.log(id);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "GET",
                    url: "/childcategories",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        // console.log(response);
                        // return;

                        let records = response.childcategories.length;

                        if (records > 0) {
                            $("#childCat").empty();
                            $("#childCat").html(
                                '<option value="" selected>select childcategory</option>'
                            );
                            childcategories = response.childcategories;
                            $.each(childcategories, function(key, childcategory) {
                                $("#childCat").append(
                                    '<option  value="' +
                                    childcategory.id +
                                    '">' +
                                    childcategory.name +
                                    "</option>"
                                );
                            });
                        } else {
                            $("#childCat").html(
                                '<option value="" selected>No Record Found</option>'
                            );
                        }
                    },
                });

            });
        });

    </script>

@endsection
