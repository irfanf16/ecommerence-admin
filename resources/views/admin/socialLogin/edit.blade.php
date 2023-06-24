@extends('admin.layouts.master',['navItem' => 'settings', 'module' => 'Settings'])
@section('title', 'Edit Social Link ')

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
                <h5 class="d-inline">Add New Link</h5>
                <a href="{{ URL::to('/admin/social') }}" title="Go To Categories Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                {{-- <div class="col-md-8 mx-auto"> --}}
                    {{-- category form --}}
                    <form action="{{ url("admin/social/update/$social->id") }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" value="{{ $social->title }}" name="title" required>
                                </div>
                            </div>
                                </div>

                            {{-- </div> --}}

                            {{-- logo_image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="logoImage" class="col-form-label">Logo</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="logo" id="logo_image" type="file">
                                </div>
                            </div>
                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input data-id="{{$social->id}}" type="checkbox" class="float-right toggle-class product-feature" name="status" id="status-{{ $social->id }}"
                                               {{ $social->status ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                        <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
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
            $('.subcategories').select2();
            $('.categories').select2();
            $('.childcategories').select2();
        });
    </script>

@endsection
