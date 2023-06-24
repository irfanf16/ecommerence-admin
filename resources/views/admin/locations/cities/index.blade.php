@extends('admin.layouts.master', ['navItem' => 'locations'])
@section('title', 'All Cities ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>TOTAL</h6>
                        <h2>{{ $cities_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>ACTIVE</h6>
                        <h2>{{ $active_cities }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>IN-ACTIVE</h6>
                        <h2>{{ $inactive_cities }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Cities</strong></h2>
                        <a href="{{ URL::to('/admin/cities/create') }}" title="Go to Add New City Page"
                            class="btn btn-primary">Add City</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable"
                                class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
{{--                                        <th>Logo</th>--}}
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
{{--                                        <th>Logo</th>--}}
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
{{--                                            <td width="10%">--}}
{{--                                                @if ($city->image)--}}
{{--                                                    <img src='{{ config('app.url') . "admin/images/locations/sm/$city->image" }}'--}}
{{--                                                        alt="{{ $city->name . ' image' }}"--}}
{{--                                                        class="w-100 rounded-circle">--}}
{{--                                                @else--}}
{{--                                                    <img src="{{ URL::to('/admin/images/default/city.svg') }}"--}}
{{--                                                        alt="City Default image" class="w-100 rounded-circle">--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td>{{ $city->name }}</td>
                                            <td>
                                                @if ($city->status)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/cities/$city->id/edit") }}"
                                                    title="Edit This City" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action="{{ URL::to('admin/cities/' . $city->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        title="Delete This City">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            @php $count++; @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
