@extends('admin.layouts.master', ['navItem' => 'products', 'module' => 'Variants'])
@section('title', 'Product Variants ')

@section('content')

    <div class="container-fluid">

        {{-- Data Table Row --}}
        <div class="row clearfix">
            {{-- Cards Row --}}
            <div class="col-md-12">
                <div class="card border">
                    <div class="body">
                        <div class="row">
{{--                            <div class="col-md-6">--}}
{{--                                --}}{{-- <h2 class="text-capitalize">{{ $variant->product->name }}</h2> --}}
{{--                                --}}{{-- <h6>{{ strip_tags($product->short_description) }}</h6> --}}
{{--                            </div>--}}
                            <div class="col-md-3">
                                <div class="card border-0 bg-light-grey mb-0">
                                    <div class="body">
                                        <h5>Total Stock</h5>
                                        <h2><b>{{ $total_stock }}</b></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="card border-0 bg-light-grey mb-0">
                                    <div class="body">
                                        <h5>Total Sold Stock</h5>
                                         <h2><b>{{ $sold_stock }}</b></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Variants - {{ $variants_count }}</strong></h2>
{{--                        <a--}}
{{--                        href='{{ URL::to("/admin/products/$product->id/variants/create") }}'--}}
{{--                            title="Add new variant for this product" class="btn btn-primary text-white">Add Variant</a> --}}
                        <a
                        href='{{ URL::to("/admin/products") }}'
                            title="Add new variant for this product" class="btn btn-primary text-white">Back</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="20%">Variant Details</th>
                                        <th>Price</th>
                                        <th>Special Price</th>
                                        <th>Quantity</th>
                                        <th>Sold Stock</th>
                                        <th>Seller Sku</th>
                                        {{-- <th>Add Stocks</th> --}}
                                        <th width="16%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($variants as $variant)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>
                                                <b>Variant: </b> {{ $variant->product->name }}

                                            </td>
                                            <td>{{ $variant->price }}</td>
                                            <td>{{ $variant->special_price }}</td>
                                            <td>{{ $variant->quantity }}</td>
                                            <td>{{ $variant->sold_stock }}</td>
                                            <td>{{ $variant->seller_sku }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target-id="{{ $variant->id }}" data-target-pid="{{ $variant->product->id }}" data-target="#stocksModal"><i class="fa-solid fa-plus"></i></button>
{{--                                                    <a--}}
{{--                                                     href='{{ URL::to("/admin/products/$product->id/variants/$variant->id/edit") }}'--}}
{{--                                                        title="Edit This Product Variant" class="btn btn-primary text-white btn-sm">--}}
{{--                                                        <span class="btn-inner--icon">--}}
{{--                                                            <i class="fa fa-edit"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </a>--}}
{{--                                                    <form--}}
{{--                                                        action='{{ URL::to("/admin/products/$product->id/variants/$variant->id") }}'--}}
{{--                                                        method="POST" class="d-inline">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}

{{--                                                        <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                                            title="Delete This Product Variant">--}}
{{--                                                            <span class="btn-inner-icon">--}}
{{--                                                                <i class="fa fa-trash-o"></i>--}}
{{--                                                            </span>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
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

    <!-- Add New Stocks Modal -->
    <div class="modal fade" id="stocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 py-2">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Stocks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addStocks" action="" method="POST">
                    @csrf
                    <div class="modal-body px-0 py-3 border-0 ">
                        <div class="col-12">
                            <input type="number" class="form-control" name="add_stock" id="add_stock" required
                                placeholder="Enter Stocks Amount">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Add</button>
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
                var url = `/admin/products/${productId}/variants/${variantId}/addstock`;
                // console.log(productId, variantId, url);

                $('#addStocks').attr('action', url);
            });
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
