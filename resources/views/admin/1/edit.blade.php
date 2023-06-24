@extends('admin.layouts.master',['navItem' => 'categories'])
@section('title', 'Edit This Category ')

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
                <h5 class="d-inline">Edit This Category</h5>
                <a href="{{ URL::to('/admin/categories') }}" title="Go To All Categories Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- category form --}}
                    <form action='{{ URL::to("/admin/categories/$category->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- title --}}
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $category->title }}" placeholder="Please Enter Category title..."
                                        required>
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
                                        placeholder="Please write Description about Category...">{{ $category->description }}</textarea>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label mt-4">Image</label>
                                </div>
                                <div class="col-md-2">
                                    @if ($category->image)
                                        <img src='{{ config('app.url') . "admin/images/categories/sm/$category->image" }}'
                                            alt="{{ $category->title . ' image' }}" class="w-100 rounded-circle">
                                    @else
                                        <img src="{{ URL::to('/admin/images/default/category.svg') }}"
                                            alt="category Default image" class="w-100 rounded-circle">
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <input name="image" id="image" type="file" class="mt-4">
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
                                            {{ $category->status ? 'checked' : '' }}>
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>
                            {{-- featured --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="featured" class="col-form-label">Featured</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="featured" id="featured"
                                            {{ $category->featured ? 'checked' : '' }}>
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
