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
                <h5 class="d-inline">Edit This Key</h5>
                <a href="{{ URL::to('/admin/keys') }}" title="Go To All Attribute Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Attribute form --}}
                    <form action='{{ URL::to("/admin/keys/$key->id") }}' method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Name
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="name"
                                        value="{{ $key->name }}" required>
                                </div>
                            </div>

                            {{-- arabic title  --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="name_ar" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Arabic Name
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        value="{{ $key->name_ar }}" required>
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
                                            {{ $key->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>



                            {{-- Sub Category --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="" class="col-form-label">Attributes</label>
                                </div>
                                <div class="col-md-9">
                                    @php
                                        $haystack = array_column($key->attributes, 'id');

                                    @endphp
                                    <select class="form-control select2" style="height: auto;" placeholder="Select Attibutes" multiple="multiple"
                                        required name="attributes[]" id="">


                                        @foreach ($attributes as $attribute)
                                            @if (in_array($attribute->id, $haystack))
                                                <option selected value="{{ $attribute->id }}">
                                                    {{ $attribute->title }}
                                                </option>
                                            @else
                                                <option value="{{ $attribute->id }}">{{ $attribute->title }}
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
