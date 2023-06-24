@extends('admin.layouts.master',['navItem' => 'settings'])
@section('title', 'Site Settings')

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
                <h5 class="d-inline">Settings</h5>
                <a href="{{ url('/admin/dashboard') }}" title="Back to Dashboard"
                    class="btn btn-primary float-right d-inline">Go
                    Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <form action="{{ route('siteSettings.index') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        {{-- title --}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label"><strong>Title</strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>

                        {{-- slogan --}}
                        <div class="form-group row">
                            <label for="slogan" class="col-sm-2 col-form-label"><strong>Slogan</strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slogan" id="slogan" required>
                            </div>
                        </div>

                        {{-- favicon --}}
                        <div class="form-group row">
                            <label for="favicon" class="col-sm-2 col-form-label"><strong>Favicon</strong></label>
                            <div class="col-sm-10">
                                <input name="favicon" id="favicon" title=" Select Favicon" type="file">
                            </div>
                        </div>

                        {{-- preloader --}}
                        <div class="form-group row">
                            <label for="preloader" class="col-sm-2 col-form-label"><strong>Preloader</strong></label>
                            <div class="col-sm-10">
                                <input type="file" name="preloader" id="preloader" title="Select Preloader">
                            </div>
                        </div>

                        {{-- logo --}}
                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label"><strong>Storak Logo</strong></label>
                            <div class="col-sm-10">
                                <input type="file" name="logo" id="logo" title="Storak logo">
                            </div>
                        </div>
                        <button class="btn btn-success float-right mt-4">Update</button>
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
