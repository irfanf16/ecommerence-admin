@extends('admin.layouts.master',['navItem'=>'products', 'module' => 'Products'])
@section('title', 'Edit This Product')

@section('content')
    <div class="container-fluid">

        {{-- Error Messages - Alerts --}}
        @if (Session::has('errors'))
{{--            @php $errors = Session::get('errors'); @endphp--}}
            @foreach ($errors as $error)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry! </strong>{{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card form-bdr-top">
            <div class="card-header border-0">
                <h5 class="d-inline">Edit This Product | Basic Details</h5>
                <a href="{{ route('products.index') }}" class="btn btn-primary d-inline float-right">Back</a>
            </div>

            <div class="card-body">
                <form method="POST"
{{--                      action='{{ URL::to("admin/products/$product->id") }}' --}}
                      enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- product name --}}
                        <div class="col-md-6 mt-2">
                            <label for="name" class="control-label"><strong>Product Name:<sup
                                        class="text-danger">*</sup></strong> </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}"
                                required placeholder="Enter product name">
                        </div>
                        {{-- Store --}}
                        <div class="col-md-3 mt-2">
                            <label for="store" class="control-label"><strong>Store:<sup
                                        class="text-danger">*</sup></strong></label>
                            <select class="form-control show-tick ms select2" name="store_id" id="store_id" required
                                placeholder="Choose Store">
                                <option value=""></option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}"
                                        {{ $store->id == $product->store_id ? 'selected' : '' }}>
                                        {{ $store->store_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Brand --}}
                        <div class="col-md-3 mt-2">
                            <label for="store" class="control-label"><strong>Brand:<sup
                                        class="text-danger">*</sup></strong></label>
                            <select class="form-control show-tick ms select2" name="brand_id" id="brand_id" required
                                placeholder="Choose Brand">
                                <option value=""></option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- category --}}
                        <div class="col-md-4 mt-4 mb-4">
                            <label for="categorty" class="control-label"><strong>Categorty:<sup
                                        class="text-danger">*</sup></strong></label>
                            <select class="form-control show-tick ms select2" name="category_id" id="category" required
                                placeholder="Search...">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- subcategory --}}
                        <div class="col-md-4 mt-4 mb-4">
                            <label for="subcategorty" class="control-label"><strong>Subcategorty:<sup
                                        class="text-danger">*</sup></strong></label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory"
                                placeholder="Choose Category First">
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                        {{ $subcategory->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- childcategory --}}
                        <div class="col-md-4 mt-4 mb-4">
                            <label for="childcategory" class="control-label"><strong>Childcategory:<sup
                                        class="text-danger">*</sup></strong></label>
                            <select class="form-control show-tick ms select2" name="childcategory_id" id="childCategory"
                                placeholder="Choose Subcategory First">
                                @foreach ($childcategories as $childcategory)
                                    <option value="{{ $childcategory->id }}"
                                        {{ $childcategory->id == $product->childcategory_id ? 'selected' : '' }}>
                                        {{ $childcategory->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Short Description --}}
                        <div class="col-md-12">
                            <label for="short_desc" class="control-label"><strong>Short Description:<sup
                                        class="text-danger">*</sup></strong></label>
                            <textarea class="form-control description" name="short_description"
                                id="short_description">{{ $product->short_description }}</textarea>
                        </div>
                        {{-- detailed description --}}
                        <div class="col-md-12 mb-4">
                            <label for="detailed_desc" class="control-label"><strong>Detailed
                                    Description:</strong></label>
                            <textarea class="form-control description" name="detailed_description"
                                id="detailed_description">{{ $product->detailed_description }}</textarea>
                        </div>

                        {{-- Images --}}
                        <div class="col-md-2">
                            @if ($product->primary_image)
                                <img src='{{ config('app.url') . "admin/images/products/primary/sm/$product->primary_image" }}'
                                    alt="{{ $product->name . ' image' }}" class="w-100 rounded img-bdr-primary">
                            @else
                                <img src="{{ URL::to('/admin/images/default/product.svg') }}" alt="Product Default image"
                                    class="w-100 rounded img-bdr-primary">
                            @endif
                        </div>
                        <div class="col-md-5 my-5">
                            <label for="image" class="control-label"><strong> Product Primary Image:<sup
                                        class="text-danger">*</sup></strong>
                            </label>
                            <input type="file" class="form-control" name="primary_image"
                                placeholder="Select 1 Primary Image" title="Product Primary Image">
                            <p class="field-info"><small>(use only jpeg,png,jpg| Max Size:2Mb)</small></p>
                        </div>
                        {{-- Video Link --}}
                        <div class="col-md-5 my-5">
                            <label for="video_url" class="control-label"><strong> Video Link:</strong>
                            </label>
                            <input type="url" class="form-control" name="video_url" id="video_url"
                                value="{{ $product->video_url }}" placeholder="Video URL">
                            <p class="field-info"><small>(Product Promotional Video
                                    URL - YouTube, Facebook)</small></p>
                        </div>

                        {{-- purchase note --}}
                        <div class="col-md-12 mb-5">
                            <label for="purchase_note" class="control-label"><strong> Purchase Note:</strong>
                            </label>
                            <textarea class="form-control" name="purchase_note" id="purchase_note" rows="5"
                                placeholder="Write some purchase note ">
{{--                                {{ $product->purchase_note }}--}}
                            </textarea>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <label for="status" class="col-sm-4 col-form-label"><strong>Status:</strong></label>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="float-right" name="status" id="status"
                                        {{ $product->status ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                </label>
                            </div>
                            <p class="field-info"><small>( If Enabled then Product go Live on Store)</small></p>
                        </div>
                        {{-- Featured --}}
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <label for="featured" class="col-sm-4 col-form-label"><strong>Featured:</strong></label>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="float-right" name="featured" id="featured"
                                        {{ $product->featured ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider" title="Featured Your Product"></span>
                                </label>
                            </div>
                            <p class="field-info"><small>( If Enabled then Product will be Featured)</small></p>
                        </div>
                        {{-- free delivery --}}
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <label for="free_delivery" class="col-sm-6 col-form-label"><strong>Free
                                        Delivery:</strong></label>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="float-right" name="free_delivery" id="free_delivery"
{{--                                        {{ $product->free_delivery ? 'checked' : '' }}--}}
                                    >
                                    <span class="toggle-switch-slider" title="Enable Free Delivery"></span>
                                </label>
                            </div>
                            <p class="field-info">( If Enabled then Product delivery will be free)</p>
                        </div>

                    </div>

                    {{-- button --}}
{{--                    <input type="submit" class="btn btn-primary float-right" value="Update">--}}
                </form>
            </div>
        </div>
    </div>


@endsection

@section('customScripts')

    <script type="text/javascript">
        // TEXT EDITOR
        $('.description').summernote({
            height: 200
        });

        // ALERT CLOSE BUTTON
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });

        // GET SPECIFIC SUB-CATEGORIES
        $('#category').change(function(e) {
            console.log('event hit');
            let categoryId = $(this).val();
            getSubCats(categoryId);
        });

        // GET SPECIFIC CHILD-CATEGORIES
        $('#subcategory').change(function(e) {
            let subcategoryId = $(this).val();
            console.log('subcategory event hit' + subcategoryId);

            getChildCats(subcategoryId);
        });
    </script>

    {{-- ALERT MESSAGE --}}
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
