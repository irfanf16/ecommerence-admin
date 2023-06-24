@extends('admin.layouts.master',['navItem' => 'products'])
@section('title', 'Add New Variant ')

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
            <div class="card-header form-bdr-top border-bottom-0 pb-0">
                <h5 class="d-inline">Add Variant</h5>
                <a href="{{ URL::to('/admin/variants') }}" title="Go To All Variants Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Variant form --}}
                    <form action="{{ URL::to('/admin/variants') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            {{-- attribute_id --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Select Attribute
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control show-tick ms select2" data-placeholder="Select Attribute"
                                        name="attribute_id" required>
                                        <option></option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Title
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title" required>
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
                                    <textarea class="form-control" type="text" name="description" id="description" rows="5"
                                        cols="30"></textarea>
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
