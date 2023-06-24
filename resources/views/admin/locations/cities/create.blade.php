@extends('admin.layouts.master',['navItem' => 'locations'])
@section('title', 'Add New City ')

@section('content')
    <div class="container-fluid ">
        {{-- Error Messages - Custom --}}
        {{-- @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            <div class="card bg-danger" id="alertBox">
                <div class="card-header bg-danger text-white">
                    <strong>Errors - Please Resolve These FIrst</strong>
                    <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
                </div>
                <div class="card-body p-0">
                    <ul>
                        @foreach ($errors as $error)
                            <li class="text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif --}}

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
                <h5 class="d-inline">Add New City</h5>
                <a href="{{ URL::to('/admin/cities') }}" title="Go To All Cities Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- City form --}}
                    <form action="{{ URL::to('/admin/cities') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            {{-- Name --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Name" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Name
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Please Enter City Name..." required>
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
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });

    </script>

@endsection
