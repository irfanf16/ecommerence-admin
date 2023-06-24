@extends('admin.layouts.master',['navItem' => 'banners'])
@section('title', 'Edit This Website Banner Image ')

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
                <h5 class="d-inline">Edit This Banner</h5>
                <a href="{{ URL::to('/admin/website/banners') }}" title="Go To All Banners Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">

                    {{-- Website Banner Image --}}
                    <div class="col-md-12 mb-5">
                        @if ($banner->image)
                            <img src='{{ config('app.url') . "storage/banners/website/lg/$banner->image" }}'
                                alt="{{ $banner->title . ' image' }}" class="w-100 rounded">
                        @else
                            <img src="{{ URL::to('/admin/images/default/banner.svg') }}" alt="Banner Default image"
                                class="w-100 rounded-circle">
                        @endif
                    </div>


                    {{-- website homepage banner form --}}
                    <form action='{{ URL::to("/admin/website/banners/$banner->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- title --}}
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">*</sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $banner->title }}" placeholder="Please Enter Banner title..." required>
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
                                    <textarea class="form-control" name="description" id="description" rows="5" cols="30"
                                        >{{ $banner->description }}</textarea>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row my-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label mt-4">
                                        <sup class="font-weight-bold text-danger">*</sup>Image
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input name="image" id="image" type="file" class="mt-4">
                                </div>
                            </div>
                            {{-- Link --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">*</sup>Banner Link
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="link" name="link"
                                        value="{{ $banner->link }}" placeholder="Please Enter Banner Link..." required>
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
                                            {{ $banner->status ? 'checked' : '' }}>
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
