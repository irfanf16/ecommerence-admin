@extends('admin.layouts.master',['navItem' => 'categories'])
@section('title', 'Edit This Attribute ')

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
                <h5 class="d-inline">Edit This Attribute</h5>
                <a href="{{ URL::to('/admin/attributes') }}" title="Go To All Attribute Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Attribute form --}}
                    <form action='{{ URL::to("/admin/attributes/$attribute->id") }}' method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $attribute->title }}" required>
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
                                        value="{{ $attribute->title_ar }}" required>
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
                                        cols="30">{{ $attribute->description }}</textarea>
                                </div>
                            </div> --}}



                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="status" id="status"
                                            {{ $attribute->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>



                            {{-- Sub Category --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">SubCategory</label>
                                </div>
                                <div class="col-md-9">
                                    @php
                                        $haystack = array_column($attribute->subcategories, 'id');

                                    @endphp
                                    <select class="form-control select2" style="height: auto;"
                                        placeholder="Select SubCategory" multiple="multiple" name="subcategories[]" id="">


                                        @foreach ($subcategories as $subcategory)
                                            @if (in_array($subcategory->id, $haystack))
                                                <option selected value="{{ $subcategory->id }}">
                                                    {{ $subcategory->title }}
                                                </option>
                                            @else
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->title }}
                                                </option>

                                            @endif
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
                                    @php
                                        $haystack = array_column($attribute->childcategories, 'id');

                                    @endphp
                                    <select class="form-control select2" style="height: auto;"
                                        placeholder="Select ChildCategory" multiple="multiple" name="childcategories[]"
                                        id="">
                                        <option disabled selected value="">Select ChildCategory</option>
                                        @foreach ($childcategories as $childcategory)
                                            @if (in_array($childcategory->id, $haystack))

                                                <option selected value="{{ $childcategory->id }}">
                                                    {{ $childcategory->title }}
                                                </option>
                                            @else
                                                <option value="{{ $childcategory->id }}">{{ $childcategory->title }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            {{-- Keys --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label">Keys</label>
                                </div>
                                <div class="col-md-9">
                                    @php
                                        $haystack = array_column($attribute->keys, 'id');

                                    @endphp
                                    <select class="form-control select2" style="height: auto;" placeholder="Select Keys "
                                        multiple="multiple" name="keys[]" id="">


                                        @foreach ($keys as $key)
                                            @if (in_array($key->id, $haystack))
                                                <option selected value="{{ $key->id }}">
                                                    {{ $key->name }}
                                                </option>
                                            @else
                                                <option value="{{ $key->id }}">{{ $key->name }}
                                                </option>

                                            @endif
                                        @endforeach

                                    </select>
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
