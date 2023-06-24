@extends('admin.layouts.master', ['navItem' => 'brands'])
@section('title', 'All Brands ')

@section('content')
    <div class="container-fluid">
        {{-- Cards Row --}}
        {{-- Total Brands --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $brands_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/brands/brand.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Total Brands ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Active Brands --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_brands }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/brands/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Active Brands ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- InActive Brands --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_brands }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/brands/inactive.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Inactive Brands ">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Brands</strong></h2>

                    </div>
                    <hr>
                    <div class="header justify-content-start">

                        <a href="{{ URL::to('/admin/brands/create') }}" title="Go to Add New Brand Page"
                            class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Add New Brand</a>

                        <a href="{{ URL::to('/admin/brands/archive') }}" title="Go to Archive"
                            class="btn btn-danger ml-2"> <i class="fa fa-trash"></i> Archive</a>


                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Brand Details</th>
                                        <th>Featured</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td width="10%">
                                                @if ($brand->logo_image)
                                                    <img src='{{ config('app.url') . "storage/brands/logo/sm/$brand->logo_image" }}' alt="{{ $brand->name . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/brands/default.svg') }}"
                                                        alt="Brand Default image" class="w-100 rounded">
                                                @endif
                                            </td>
                                            <td><strong>{{ $brand->name }}</strong></td>
                                            <td width="5%">
                                                @if ($brand->featured)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-primary text-uppercase font-weight-bold">No
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="5%">
                                                @if ($brand->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/brands/$brand->id/edit") }}"
                                                    title="Edit This Brand" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action='{{ URL::to("admin/brands/$brand->id") }}' method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger archive-btn"
                                                        title="Archive This Brand">
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

@section('customScripts')
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



    <script>
        $(document).ready(function() {

            var brand_id = 1;
            getBrands(brand_id);

            $('body').on('click', '.archive-btn', function() {
                var form = $(this).parents('form');
                swal({
                        title: "Are you sure?",
                        text: "This File will be moved to Archive",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Category has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Category is Safe!");
                        }
                    });
            });
        });
    </script>

@endsection
