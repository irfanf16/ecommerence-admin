@extends('admin.layouts.master',['navItem' => 'settings'])
@section('title', 'Edit App Settings')

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
                <h5 class="d-inline">Edit App Setting</h5>
                <a href="{{ url('/admin/dashboard') }}" title="Back to Dashboard"
                    class="btn btn-primary float-right d-inline mb-2">Go
                    Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <form action="{{ route('app.settings.update', $setting->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        {{-- title --}}
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label"><strong>Short Code</strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="shortcode" id="title" required value="{{ $setting->shortcode }}">
                            </div>
                        </div>  

                        {{-- slogan --}}
                        <div class="form-group row">
                            <label for="slogan" class="col-sm-2 col-form-label"><strong>Description</strong></label>
                            <div class="col-sm-10">
                               <textarea name="description" id="" cols="69" rows="3">{{ $setting->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4 my-4">
                            <label class="d-block">
                                <strong>Status:</strong>
                            </label>
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" id="status"
                                    {{ $setting->value2 ? 'checked' : '' }}>
                                <span class="toggle-switch-slider"></span>
                            </label>
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
