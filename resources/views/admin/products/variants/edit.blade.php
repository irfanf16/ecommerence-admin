@extends('admin.layouts.master',['navItem' => 'products', 'module' => 'Variants'])
@section('title', 'Edit This Product Variant ')

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
                <h5 class="d-inline">Edit Variant</h5>
                <a href='{{ URL::to("admin/products/$variant->product_id/variants") }}'
                    title="Go To All Variants Of This Product Page" class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- form --}}
                    <form action='{{ URL::to("/admin/products/$variant->product_id/variants/$variant->id") }}'
                        method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- select attribute --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="attribute_id" class="control-label"><strong>Attribute:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="attribute_id" id="attribute"
                                    required>
                                    <option selected disabled>Choose Attribute</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}"
                                            {{ $variant->attribute_id == $attribute->id ? 'selected' : '' }}>
                                            {{ $attribute->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- select variant --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="variant_id" class="control-label"><strong>Variant:<sup
                                            class="text-danger">*</sup></strong></label>
                                <select class="form-control show-tick ms select2" name="variant_id" id="variant" required>
                                    <option selected disabled>Choose Variant</option>
                                    @foreach ($attributes as $attribute)
                                        @foreach ($attribute->variants as $var)
                                            @if ($var->attribute_id == $variant->attribute_id)
                                                <option value="{{ $var->id }}"
                                                    {{ $var->id == $variant->variant_id ? 'selected' : '' }}>
                                                    {{ $var->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            {{-- retail_price --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="retail_price" class="control-label"><strong>Retail Price:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="number" class="form-control" name="retail_price" id="retail_price"
                                    value="{{ $variant->retail_price }}" required
                                    placeholder="Enter product Retail price">
                            </div>
                            {{-- sale_price --}}
                            <div class="col-md-6 mt-2 mb-4">
                                <label for="sale_price" class="control-label"><strong>Sale Price:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="number" class="form-control" name="sale_price" id="sale_price"
                                    value="{{ $variant->sale_price }}" required placeholder="Enter product Sale Price">
                            </div>
                            {{-- sku --}}
                            <div class="col-md-6  mb-4">
                                <label for="sku" class="control-label"><strong>SKU:<sup
                                            class="text-danger">*</sup></strong></label>
                                <input type="text" class="form-control" name="sku" id="sku" value="{{ $variant->sku }}"
                                    required placeholder="Enter SKU">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
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

    {{-- Sweet Alert --}}
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
