@extends('admin.layouts.master', ['navItem' => 'reviews', 'module' => 'Customers'])
@section('title', 'All Reviews List ')
@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2 id="total">12</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ URL::to('/admin/images/icons/product/newproduct.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Total Products "> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Active Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2 id="active">00</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/active-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Active Products "> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- InActive Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2 id="inactive">12</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/inactive-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Inactive Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Featured Products --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Answered</h5>
                                <h2 id="answered">22</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/featured-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Featured Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Pending</h5>
                                <h2 id="pending">22</h2>
                            </div>
                            {{-- <div class="col-4 px-2"> --}}
                            {{-- <img src="{{ url('admin/images/icons/product/featured-product.svg') }}" --}}
                            {{-- class="rounded w-100 stats-icons" alt="Featured Products "> --}}
                            {{-- </div> --}}
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong> Reviews List </strong></h2>
                    </div>

                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        
                            <div class="row mb-5 mt-5 page-block">
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Status</label>
                                    <select id="review_status" name="status" class="form-control reviews_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('review_status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (Session::get('review_status') == 2) selected @endif value="0">In-Active
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>From:</label>
                                    <input id="reviews_from_date" value="{{ Session::get('reviews_from_date') }}" type="date"
                                           class="form-control reviews_filters">
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>To:</label>
                                    <input id="reviews_to_date" value="{{ Session::get('reviews_to_date') }}" type="date"
                                           class="form-control reviews_filters">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="reviews_datatable_length" name="datatable_length"
                                                    class="form-control form-control-sm reviews_filters">
                                                <option
                                                    {{ Session::get('reviews_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('reviews_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('reviews_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('reviews_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select>entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="reviewSearch" value="{{ old('search') }}" type="search"
                                                          name="search" class="form-control form-control-sm"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="" style="position: relative;">
                                        <div class="pre-loader" style="display: none">
                                            <div class="loader-for-datatable" style=""></div>
                                        </div>
                                        <table id="DataTables_Table_0" class="table table-hover  no-footer"
                                               role="grid" aria-describedby="DataTables_Table_0_info">
                                            <thead>
                                            <tr role="row">
                                                <th width="2%">Sr.</th>
                                                <th width="20%">Product Detail</th>
                                                <th width="25%">Customer Detail</th>
                                                <th width="20%">Review</th>
                                                <th width="10%">Rating</th>
                                                <th width="20%">Vendor Reaction</th>
                                                <th width="15%">Status</th>
                                                <th width="15%">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="reviewsList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="reviewsPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('customScripts')

    <script>
        $(document).ready(function() {

            var page_id = 1;
            @if (Session::has('review_page_id'))
                page_id = '{{ Session::get('review_page_id') }}'
            @endif
            getReviews(page_id);
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

    <script>
        $(document).ready(function() {
            $('body').on('click', '.archive-btn', function() {
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This Product will be Archived",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Product has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Product is Safe!");
                        }
                    });
            });
        });

    </script>

    @if (session()->has('response'))
        <script>
            AlertSwal(<?php echo json_encode(session()->get('response')); ?>);
        </script>
    @endif

    <script>
        

  
        </script>
@endsection
