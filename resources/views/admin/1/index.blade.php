@extends('admin.layouts.master', ['navItem' => 'categories'])
@section('title', 'All Categories ')

{{-- Main Categories --}}
@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>TOTAL</h6>
                        <h2>{{ $categories_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>ACTIVE</h6>
                        <h2>{{ $active_categories }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>IN-ACTIVE</h6>
                        <h2>{{ $inactive_categories }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>FEATURED</h6>
                        <h2>{{ $featured_categories }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Categories</strong></h2>
                        <a href="{{ URL::to('/admin/categories/create') }}" title="Go to Add New Category Page"
                            class="btn btn-primary">Add Category</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable"
                                class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td width="10%">
                                                @if ($category->image)
                                                    <img src='{{ config('app.url') . "admin/images/categories/sm/$category->image" }}'
                                                        alt="{{ $category->title . ' image' }}"
                                                        class="w-100 rounded-circle">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/default/category.svg') }}"
                                                        alt="category Default image" class="w-100 rounded-circle">
                                                @endif

                                            </td>
                                            <td>{{ $category->title }}</td>
                                            <td>
                                                @if ($category->status)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->featured)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-primary text-uppercase font-weight-bold">No
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/categories/$category->id/edit") }}"
                                                    title="Edit This Category" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action="{{ URL::to('admin/categories/' . $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        title="Delete This Category">
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
