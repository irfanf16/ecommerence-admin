@extends('admin.layouts.master',['navItem' => 'banners'])
@section('title', 'Add New Cover For Mobile Homescreen ')

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
                <h5 class="d-inline">Add New Cover</h5>
                <a href="{{ URL::to('/admin/mobile/covers') }}" title="Go to all mobile screen covers page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Cover form --}}
                    <form action="{{ URL::to('/admin/mobile/covers') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            {{-- image --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="image" class="col-form-label">Cover Image</label>
                                </div>
                                <div class="col-md-9">
                                    <input name="image" id="image" type="file" required>
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

    {{-- script for text editor --}}
    <script type="text/javascript">
        $('#description').summernote({
            height: 200,
            airMode: false
        });

    </script>

@endsection
