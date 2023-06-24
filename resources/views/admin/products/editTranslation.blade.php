@extends('admin.layouts.master',['navItem'=>'products', 'module' => 'Products'])
@section('title', 'Edit Translation')

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
                     action='{{ URL::to("admin/product/$product->id/updateTranslation") }}'
                      enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- product name --}}
                        <div class="col-md-6 mt-2">
                            <label for="name" class="control-label"><strong>Product Name:<sup
                                        class="text-danger">*</sup></strong> </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}"
                                required placeholder="Enter product name in Arabic">
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="name" class="control-label"><strong>Product Arabic Name:<sup
                                        class="text-danger">*</sup></strong> </label>
                            <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ $product->name_ar }}"
                                required placeholder="Enter product name in Arabic">
                        </div>

                        {{-- Short Description --}}
                        <div class="col-md-12 mt-5">
                            <label for="short_desc" class="control-label"><strong>Short Description:<sup
                                        class="text-danger">*</sup></strong></label>
                            <textarea class="form-control description" name="short_description"
                                id="short_description">{{ $product->short_description }}</textarea>
                        </div>
                        <div class="col-md-12 mt-5">
                            <label for="short_desc" class="control-label"><strong>Short Arabic Description:<sup
                                        class="text-danger">*</sup></strong></label>
                            <textarea class="form-control description" name="short_description_ar"
                                id="short_description_ar">{{ $product->short_description_ar }}</textarea>
                        </div>
                        {{-- detailed description --}}
                        <div class="col-md-12 mb-4">
                            <label for="detailed_desc" class="control-label"><strong>Detailed 
                                    Description:</strong></label>
                            <textarea class="form-control description" name="detailed_description"
                                id="detailed_description">{{ $product->detailed_description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="detailed_desc" class="control-label"><strong>Detailed Arabic
                                    Description:</strong></label>
                            <textarea class="form-control description" name="detailed_description_ar"
                                id="detailed_description_ar">{{ $product->detailed_description_ar }}</textarea>
                        </div>
                        {{-- Veriy Translation  --}}
                        <div class="col-md-4 mb-5">
                            <div class="row">
                                <label for="status" class="col-sm-4 col-form-label"><strong>Translation:</strong></label>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="float-right" name="translation_verified" id="translation"
                                        {{ $product->translation_verified ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider" title="Activate/Deactivate Your Product Translation"></span>
                                </label>
                            </div>
                            <p class="field-info"><small>( If Enabled then Translation go Live on Store)</small></p>
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
                        {{-- <div class="col-md-4 mb-5">
                            <div class="row">
                                <label for="featured" class="col-sm-4 col-form-label"><strong>Featured:</strong></label>
                                <label class="toggle-switch">
                                    <input type="checkbox" class="float-right" name="featured" id="featured"
                                        {{ $product->featured ? 'checked' : '' }}>
                                    <span class="toggle-switch-slider" title="Featured Your Product"></span>
                                </label>
                            </div>
                            <p class="field-info"><small>( If Enabled then Product will be Featured)</small></p>
                        </div> --}}
                    </div>
                  <input type="submit" class="btn btn-primary float-right" value="Update">
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
