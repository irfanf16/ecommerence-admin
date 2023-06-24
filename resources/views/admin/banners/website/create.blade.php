@extends('admin.layouts.master',['navItem' => 'banners'])
@section('title', 'Add New Banner For Website Homepage ')

@section('content')
    <div class="container-fluid ">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header form-bdr-top pb-0">
                <h5 class="d-inline">Add New Banner</h5>
                <a href="{{ URL::to('/admin/website/banners') }}" title="Go To All Banners Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Banner form --}}
                    <form action="{{ URL::to('/admin/website/banners') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">*</sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Please Enter Banner title...">
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
                                    <textarea class="form-control" name="description" id="description"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">*</sup>Image
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input name="image" id="image" type="file" required>
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
                                        placeholder="Please Enter Banner Link..." required>
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
