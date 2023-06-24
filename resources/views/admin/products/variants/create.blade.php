@extends('admin.layouts.master',['navItem' => 'products', 'module' => 'Variants'])
@section('title', 'Add New Variant For This Product ')

@section('content')
    <div class="container-fluid ">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
            @php $errors = Session::get('errors'); @endphp
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-header border-bottom-0 form-bdr-top pb-0">
                <h5 class="d-inline">Add Variant</h5>
                <a href='{{ URL::to("admin/products/$product->id/variants") }}' title="Go To All Variants Of This Product Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- form --}}
                    <form action='{{ URL::to("/admin/products/$product->id/variants") }}' method="POST">
                        @method('post')
                        @csrf

                        <div class="row">
                            {{-- Add Attribute --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="attribute_id" class="control-label"><strong>Attribute:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="attribute_id" id="attribute"
                                    required placeholder="Choose Attribute">
                                    <option value=""></option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Add Variant --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="variant_id" class="control-label"><strong>Variant:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="variant_id" id="variant" required
                                    placeholder="Choose Variant">
                                    <option selected disabled></option>
                                </select>
                            </div>
                            {{-- retail_price --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="retail_price" class="control-label"><strong>Retail Price:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="number" class="form-control" name="retail_price" id="retail_price" required
                                    placeholder="Enter product Retail price">
                            </div>
                            {{-- sale_price --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="sale_price" class="control-label"><strong>Sale Price:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="number" class="form-control" name="sale_price" id="sale_price" required
                                    placeholder="Enter product Sale Price">
                            </div>
                            {{-- total_stock --}}
                            <div class="col-md-6  mb-4">
                                <label for="total_stock" class="control-label"><strong>Total Stock:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="number" class="form-control" name="total_stock" id="total_stock" required
                                    placeholder="Enter Total Stock">
                            </div>
                            {{-- sku --}}
                            <div class="col-md-6  mb-4">
                                <label for="sku" class="control-label"><strong>SKU:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="text" class="form-control" name="sku" id="sku" required
                                    placeholder="Enter SKU">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Add</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
    <script>
        $(document).ready(function() {
            // GET SPECIFIC VARIANTS
            $('#attribute').change(function(e) {
                let attributeId = $(this).val();
                getVariants(attributeId);
            });
        });
    </script>

@endsection
