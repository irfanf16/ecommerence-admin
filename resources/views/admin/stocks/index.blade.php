@extends('admin.layouts.master', ['navItem' => 'stocks', 'module' => 'stocks'])
@section('title', 'All Stocks ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        {{-- Total Products --}}
        <div class="page-block">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Total Stock</h5>
                                    <h2 id="total_stock">0</h2>
                                </div>
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
                                    <h5>Sold Stock</h5>
                                    <h2 id="sold_stock">0</h2>
                                </div>
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
                                    <h5>In-Stock (Products)</h5>
                                    <h2 id="in_stock_products">0</h2>
                                </div>
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
                                    <h5>Out-Stock (Products)</h5>
                                    <h2 id="out_stock_products">0</h2>
                                </div>
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
                    <div class="header">
                        <h2><strong>Product Stocks</strong></h2>
                    </div>

                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5 mt-5 page-block">

                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control product_stock_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('status_stock') == 1) selected @endif value="1">In-Stock (Products)
                                        </option>
                                        <option @if (Session::get('status_stock') == 2) selected @endif value="0">Out-Stock (Products)
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Form:</label>
                                    <input id="from_date" value="{{ Session::get('from_date_stock') }}" type="date"
                                        class="form-control product_stock_filters">
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>To:</label>
                                    <input id="to_date" value="{{ Session::get('from_to_stock') }}" type="date"
                                        class="form-control product_stock_filters">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="product_stock_datatable_length" name="datatable_length"
                                                class="form-control form-control-sm product_stock_filters">
                                                <option
                                                    {{ Session::get('product_stock_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('product_stock_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('product_stock_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('product_stock_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="productStockSearch" value="{{ old('search') }}" type="search"
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
                                                    <th width="5%">Sr.</th>
                                                    <th width="10%">Image</th>
                                                    <th width="20%">Product Details</th>
                                                    <th width="20%">Variant</th>
                                                    <th width="10%">Price</th>
                                                    <th width="10%">Special Price</th>
                                                    <th width="15%">Available Stocks</th>
                                                    <th width="15%">Sold Stocks</th>
                                                    <th width="15%">last Updated</th>
                                                    <th width="15%">Status</th>
                                                    @can('admin-stockmanagement-edit')
                                                    <th width="10%">Actions</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody id="productStockList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="productStockPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add New Stocks Modal -->
    <div class="modal fade" id="stocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 py-2">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Information's</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addStocks" action="" method="POST">
                    @csrf
                    <div class="modal-body px-0 py-3 border-0 ">
                        <div class="col-12 p-2">
                            <span class="">Add Stock</span>
                            <input type="number" class="form-control" name="add_stock" id="add_stock" required
                                 value="0"  placeholder="Add New Stocks Amount">
                        </div>
                        <div class="col-12 p-2">
                            <span class="">Variant Price</span>
                            <input type="number" class="form-control" name="price" id="price" required
                                   value="" placeholder="Enter Price Amount">
                        </div><div class="col-12 p-2">
                            <span class="">Variant Special Price</span>
                            <input type="number" class="form-control" name="special_price" id="special_price" required
                                 value=""  placeholder="Enter special price Amount">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection




@section('customScripts')
    <script>
        $(document).ready(function() {
            $("#stocksModal").on("show.bs.modal", function(e) {
                var variantId = $(e.relatedTarget).data('target-id');
                var productId = $(e.relatedTarget).data('target-pid');
                var price = $(e.relatedTarget).data('target-price');
                var special_price = $(e.relatedTarget).data('target-special_price');
                var url = `/admin/products/${productId}/variants/${variantId}/addstock`;
                // console.log(productId, variantId, url);


                document.getElementById('price').value=price;
                document.getElementById('special_price').value=special_price;

                $('#addStocks').attr('action', url);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var page_id = 1;
            @if (Session::has('product_stock_page_id'))
                page_id = '{{ Session::get('product_stock_page_id') }}'
            @endif
            getProductStocks(page_id);
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


{{-- pagination --}}
<script></script>
