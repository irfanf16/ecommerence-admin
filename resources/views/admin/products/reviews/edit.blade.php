@extends('admin.layouts.master',['navItem' => 'products', 'module' => 'Reviews'])
@section('title', 'Edit This Product Review ')

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
            <div class="card-header border-bottom-0 form-bdr-top pb-0">
                <h5 class="d-inline">Edit This Product Review</h5>
                <a href='{{ URL::to("/admin/products/$review->product_id/reviews") }}'
                    title="Go To Product All Reviews Page" class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">

                    {{-- product review form --}}
                    <form action='{{ URL::to("/admin/products/$review->product_id/reviews/$review->id") }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            {{-- rating --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="rating" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Rating
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="number" min="1" max="5" id="rating" name="rating"
                                        value="{{ $review->rating }}" required>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        Review
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="review" name="review"
                                        value="{{ $review->review }}">
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
                                            {{ $review->status ? 'checked' : '' }}>
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
