@extends('admin.layouts.master',['navItem' => 'partners'])
@section('title', 'Edit This Partner ')

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
                <h5 class="d-inline">Edit This partner</h5>
                <a href="{{ URL::to('/admin/partners') }}" title="Go To All Partners Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- website homepage partner form --}}
                    <form action='{{ URL::to("/admin/partners/$partner->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- title --}}
                        <div class="col-md-12 my-5">
                            <div class="row  mt-auto">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">*</sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $partner->title }}" placeholder="Please Enter partner title..."
                                        required>
                                </div>
                            </div>

                            {{-- image --}}
                            <div class="row my-5">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label mt-4">
                                        <sup class="font-weight-bold text-danger">*</sup>Image
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    @if ($partner->image)
                                        <img src='{{ config('app.url') . "admin/images/partners/org/$partner->image" }}'
                                            alt="{{ $partner->title . ' image' }}" class="w-100 rounded img-bdr-primary">
                                    @else
                                        <img src="{{ URL::to('/admin/images/default/partner.svg') }}"
                                            alt="partner Default image" class="w-100 rounded img-bdr-primary">
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <input name="image" id="image" type="file" class="mt-4">
                                </div>
                            </div>

                            {{-- status --}}
                            <div class="row mb-4 my-5">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="status" id="status"
                                            {{ $partner->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
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
