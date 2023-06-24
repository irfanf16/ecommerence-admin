@extends('admin.layouts.master', ['navItem' => 'products', 'module' => 'Products'])
@section('title', 'All Products ')

@section('head')


@endsection

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
                                    <h5>Total</h5>
                                    <h2>{{ $products_count }}</h2>
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
                                    <h2>{{ $active_products }}</h2>
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
                                    <h2>{{ $inactive_products }}</h2>
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
                                    <h5>Featured</h5>
                                    <h2>{{ $featured_products }}</h2>
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
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5 mt-5 page-block">
                                <div class="col-sm-12 col-md-3">
                                    <label>Categories</label>
                                    <select id="category_id" name="category_id" class="form-control filters_products">
                                        <option value="">All</option>
                                        @foreach ($categories as $category)
                                            <option @if (Session::get('category_id') == $category->id) selected @endif
                                                value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label>Sub Categories</label>
                                    <select id="subcategory_id" name="subcategory_id" class="form-control filters_products">
                                        <option value="">All</option>
                                        @foreach ($sub_categories as $category)
                                            <option @if (Session::get('subcategory_id') == $category->id) selected @endif
                                                value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label>Child Categories</label>
                                    <select id="childcategory_id" name="childcategory_id"
                                        class="form-control filters_products">
                                        <option value="">All</option>
                                        @foreach ($child_categories as $category)
                                            <option @if (Session::get('childcategory_id') == $category->id) selected @endif
                                                value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label>Stores</label>
                                    <select id="store_id" name="store_id" class="form-control filters_products">
                                        <option value="">All</option>
                                        @foreach ($stores as $store)
                                            <option @if (Session::get('store_id') == $store->id) selected @endif
                                                value="{{ $store->id }}">{{ $store->store_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Brands</label>
                                    <select id="brand_id" name="brand_id" class="form-control filters_products">
                                        <option value="">All</option>
                                        @foreach ($brands as $brand)
                                            <option @if (Session::get('brand_id') == $brand->id) selected @endif
                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control filters_products">
                                        <option value="">All</option>
                                        <option @if (Session::get('status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (Session::get('status') == 2) selected @endif value="0">In-Active
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Featured</label>
                                    <select id="featured" class="form-control filters_products">
                                        <option value="">All</option>
                                        <option @if (Session::get('featured') == 1) selected @endif value="1">Featured
                                        </option>
                                        <option @if (Session::get('featured') == 2) selected @endif value="0">
                                            Non-Featured</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Form:</label>
                                    <input id="from_date" value="{{ Session::get('from_date') }}" type="date"
                                        class="form-control filters_products">
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>To:</label>
                                    <input id="to_date" value="{{ Session::get('from_to') }}" type="date"
                                        class="form-control filters_products">
                                </div>
                                <div class="col-sm-12 col-md-3 mt-2">
                                    <label>Translation</label>
                                    <select id="translation" class="form-control filters_products">
                                        <option value="">All</option>
                                        <option @if (Session::get('translation') == 1) selected @endif value="1">Translated
                                        </option>
                                        <option @if (Session::get('translation') == 2) selected @endif value="0">
                                            Pending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="product_datatable_length" name="datatable_length"
                                                class="form-control form-control-sm filters_products">
                                                <option
                                                    {{ Session::get('product_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('product_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('product_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('product_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="productSearch" value="{{ old('search') }}" type="search"
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
                                                    <th width="10%">Status</th>
                                                    <th width="10%">Featured</th>
                                                    <th width="10%">Translation</th>
                                                    <th width="10%">Created_at</th>
                                                    <th width="10%">Variants</th>
                                                    @can('admin-products-edit')
                                                    <th width="10%">Actions</th>
                                                    @endcan
                                                </tr>
                                            </thead>
                                            <tbody id="productList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="productPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- product variants model --}}
    <div id="productVariantModels"></div>
@endsection




@section('customScripts')

    <script>
        $(document).ready(function() {

            var page_id = 1;
            @if (Session::has('product_page_id'))
                page_id = '{{ Session::get('product_page_id') }}'
            @endif
            getProducts(page_id);



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
        p
    </script>

    @if (session()->has('response'))
        <script>
            AlertSwal(<?php echo json_encode(session()->get('response')); ?>);
        </script>
    @endif
@endsection


{{-- pagination --}}
<script></script>
