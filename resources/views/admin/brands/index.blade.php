@extends('admin.layouts.master', ['navItem' => 'categories'])
@section('title', 'All Brands ')

@section('content')
    <div class="container-fluid">
        {{-- Cards Row --}}
        {{-- Total Brands --}}
        <div class="page-block">

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Total</h5>
                                    <h2>{{ $brands_count }}</h2>
                                </div>
                                {{--                            <div class="col-4 px-2">--}}
                                {{--                                <img src="{{ url('admin/images/icons/brands/brand.svg') }}"--}}
                                {{--                                    class="rounded w-100 stats-icons" alt="Total Brands ">--}}
                                {{--                            </div>--}}
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
                                {{--                            <div class="col-4 px-2">--}}
                                {{--                                <img src="{{ url('admin/images/icons/brands/active.svg') }}"--}}
                                {{--                                    class="rounded w-100 stats-icons" alt="Active Brands ">--}}
                                {{--                            </div>--}}
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
                                {{--                            <div class="col-4 px-2">--}}
                                {{--                                <img src="{{ url('admin/images/icons/brands/inactive.svg') }}"--}}
                                {{--                                    class="rounded w-100 stats-icons" alt="Inactive Brands ">--}}
                                {{--                            </div>--}}
                            </div>
                            </a>
                        </div>
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
                        @can('admin-brands-write')
                        <a href="{{ URL::to('/admin/brands/create') }}" title="Go to Add New Brand Page"
                           class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Add New Brand</a>
                        @endcan
                        <a href="{{ URL::to('/admin/brands/archive') }}" title="Go to Archive"
                           class="btn btn-danger ml-2"> <i class="fa fa-trash"></i> Archive</a>


                    </div>
                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="brand_datatable_length" class="form-control form-control-sm">
                                                <option selected value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="brandSearch" value="" type="search"
                                                          class="form-control form-control-sm"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="" style="position: relative;">
                                        <div class="pre-loader" style="display: none">
                                            <div class="loader-for-datatable" style=""></div>
                                        </div>
                                    <table id="DataTables_Table_0"
                                           class="table table-hover  no-footer" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                        <tr role="row">
                                            <th>Id</th>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Featured</th>
                                            @can('admin-brands-edit')
                                            <th>Action</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody id="brandList">

                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="paginationList">
                            </div>
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
            $(document).ready(function () {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endif


    <script>
        $(document).ready(function () {

            var brand_id = 1;
            getBrands(brand_id);

            $('body').on('click', '.archive-btn', function () {
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
                            swal("Brand has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Brand is Safe!");
                        }
                    });
            });
        });
    </script>

@endsection
