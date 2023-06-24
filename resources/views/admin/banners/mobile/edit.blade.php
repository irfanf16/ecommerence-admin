@extends('admin.layouts.master',['navItem' => 'banners'])
@section('title', 'Edit This Cover ')

@section('content')
    <div class="container-fluid ">

        {{-- Error Messages - Alerts --}}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header form-bdr-top pb-0">
                <h5 class="d-inline">Edit This Cover</h5>
                <a href="{{ URL::to('/admin/mobile/covers') }}" title="Go To All MObile Covers Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Mobile Homescreen Cover form --}}
                    <form action='{{ URL::to("/admin/mobile/covers/$cover->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- title --}}
                        <div class="col-md-12">
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label mt-4">Image</label>
                                </div>
                                <div class="col-md-3">
                                    @if ($cover->image)
                                        <img src='{{ config('app.url') . "storage/banners/mobile/sm/$cover->image" }}'
                                            alt="Mobile Covers" class="w-100 rounded">
                                    @else
                                        <img src="{{ URL::to('/admin/images/default/banner.svg') }}"
                                            alt="Cover Default image" class="w-100 rounded">
                                    @endif
                                </div>
                                <div class="col-md-6">
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
                                            {{ $cover->status ? 'checked' : '' }}>
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

@section('customScripts')

    {{-- script for text editor --}}
    <script type="text/javascript">
        $('#description').summernote({
            height: 200,
            airMode: false
        });
    </script>

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

@endsection
