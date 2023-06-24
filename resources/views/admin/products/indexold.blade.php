@extends('admin.layouts.master', ['navItem' => 'products', 'module' => 'Products'])
@section('title', 'All Products ')

@section('head')


@endsection

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        {{-- Total Products --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $products_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('/admin/images/icons/product/newproduct.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Total Products ">
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
                                <h5>Active</h5>
                                <h2>{{ $active_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/product/active-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Active Products ">
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
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/product/inactive-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Inactive Products ">
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
                                <h5>Featured</h5>
                                <h2>{{ $featured_products }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ url('admin/images/icons/product/featured-product.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Featured Products ">
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
                    <div class="header">
                        <h2><strong>Products</strong></h2>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th width="10%">Image</th>
                                        <th>Product Details</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Featured</th>
                                        <th width="10%">Variants</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>
                                                @if ($product->primary_image)
                                                    <img src='{{ config('app.url') . "/storage/product/images/sm/$product->primary_image" }}'
                                                        alt="{{ $product->name . ' image' }}"
                                                        class="w-100 rounded img-bdr-primary">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/default/product.svg') }}"
                                                        alt="Product Default image" class="w-100 rounded img-bdr-primary">
                                                @endif
                                            </td>
                                            <td>
                                                <b>Product: </b>{{ $product->name }} <br>
                                                <b>Category: </b>{{ $product->category->title }} <br>
                                                <b>Subcategory: </b>{{ $product->subcategory->title }} <br>
                                                <b>Childcategory: </b>{{ $product->childcategory->title }} <br>
                                                <b>Brand: </b>{{ $product->brand->name }}
                                            </td>
                                            <td>

                                                    <label class="toggle-switch">
                                                        <input data-id="{{$product->id}}" type="checkbox" class="float-right toggle-class product-status-changed" name="status" id="status-{{ $product->id }}"
                                                            {{ $product->status ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                    </label>


                                                {{-- @if ($product->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif --}}
                                            </td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input data-id="{{$product->id}}" type="checkbox" class="float-right toggle-class product-feature" name="status" id="status-{{ $product->id }}"
                                                           {{ $product->featured ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
{{--                                                @if ($product->featured)--}}
{{--                                                    <span--}}
{{--                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Yes--}}
{{--                                                    </span>--}}
{{--                                                @else--}}
{{--                                                    <span--}}
{{--                                                        class="badge badge-lg badge-primary text-uppercase font-weight-bold">No--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
                                            </td>
                                            <td>
                                                <a href='{{ URL::to("admin/products/$product->id/variants") }}'
                                                    class="btn btn-primary btn-sm mb-1 w-100 text-white"
                                                    title="Go to All Variants of This Product Page">Variants</a>
                                                <a href='{{ URL::to("admin/products/$product->id/reviews") }}'
                                                    class="btn btn-warning btn-sm mb-1 w-100 text-white"
                                                    title="Go to All Reviews of This Product Page">Reviews</a>
                                                <a href='{{ URL::to("admin/products/$product->id/questions") }}'
                                                    class="btn btn-info btn-sm mb-1 w-100 text-white"
                                                    title="Go to All Questions of This Product Page">Questions</a>
                                            </td>
                                            <td>
                                                <a href="{{ URL::to("admin/products/$product->id") }}"
                                                    title="Show This Product Detail" class="btn btn-primary btn-sm">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </a>
                                                <form action="{{ URL::to('admin/products/' . $product->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete This Product">
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
    @endsection


    {{-- pagination  --}}
<script>
    
</script>