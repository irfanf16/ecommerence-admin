@extends('admin.layouts.master',['navItem' => 'products'])
@section('title', 'Add New Variant ')

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
            <div class="card-header form-bdr-top pb-0">
                <h5 class="d-inline">Add Variant</h5>
                <a href="{{ route('productVariants.index') }}" title="Go To All Variants Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="row">

                    {{-- Add Variant --}}
                    <div class="col-md-4 mt-2 mb-4">
                        <label for="variant_id" class="control-label"><strong>Variant:<sup
                                    class="text-danger">*</sup></strong></label>
                        <select class="form-control show-tick ms select2" name="variant_id" id="variant_id" required
                            placeholder="Choose Brand">
                            <option value=""></option>

                            <option value="">color</option>
                            <option value="">size</option>
                            <option value="">dimension</option>


                        </select>
                    </div>

                    {{-- retail_price --}}
                    <div class="col-md-4 mt-2 mb-4">
                        <label for="retail_price" class="control-label"><strong>Retail Price:<sup
                                    class="text-danger">*</sup></strong></label>
                        <input type="number" class="form-control" name="retail_price" id="retail_price" required
                            placeholder="Enter product Retail price">
                    </div>

                    {{-- sale_price --}}
                    <div class="col-md-4 mt-2 mb-4">
                        <label for="sale_price" class="control-label"><strong>Sale Price:<sup
                                    class="text-danger">*</sup></strong></label>
                        <input type="number" class="form-control" name="sale_price" id="sale_price" required
                            placeholder="Enter product Sale Price">
                    </div>


                    {{-- total_stock --}}
                    <div class="col-md-4  mb-4">
                        <label for="total_stock" class="control-label"><strong>Total Stock:<sup
                                    class="text-danger">*</sup></strong></label>
                        <input type="number" class="form-control" name="total_stock" id="total_stock" required
                            placeholder="Enter Total Stock">
                    </div>

                    {{-- remaining_stock --}}
                    <div class="col-md-4  mb-4">
                        <label for="remaining_stock" class="control-label"><strong>Remaining Stock:<sup
                                    class="text-danger">*</sup></strong></label>
                        <input type="number" class="form-control" name="remaining_stock" id="remaining_stock" required
                            placeholder="Enter Remaining Stock">
                    </div>

                </div>

                <hr>

                {{-- images --}}
                <div class="row">

                    {{-- image1 --}}
                    <div class="col-md-4  mb-4 mt-3">
                        <label for="image1" class="control-label"><strong>Image 1 :</strong></label>
                        <input type="file" class="form-control" name="image1" id="image1" required title="select Image">
                    </div>

                    {{-- image2 --}}
                    <div class="col-md-4  mb-4 mt-3">
                        <label for="image2" class="control-label"><strong>Image 2:</strong></label>
                        <input type="file" class="form-control" name="image2" id="image2" required title="select Image">
                    </div>

                    {{-- image3 --}}
                    <div class="col-md-4  mb-4 mt-3">
                        <label for="image3" class="control-label"><strong>Image 3:</strong></label>
                        <input type="file" class="form-control" name="image3" id="image3" required title="select Image">
                    </div>

                    {{-- image4 --}}
                    <div class="col-md-4  mb-4">
                        <label for="image4" class="control-label"><strong>Image 4:</strong></label>
                        <input type="file" class="form-control" name="image4" id="image4" required title="select Image">
                    </div>

                    {{-- image5 --}}
                    <div class="col-md-4  mb-4">
                        <label for="image5" class="control-label"><strong>Image 5:</strong></label>
                        <input type="file" class="form-control" name="image5" id="image5" required title="select Image">
                    </div>

                    {{-- image6 --}}
                    <div class="col-md-4  mb-4">
                        <label for="image6" class="control-label"><strong>Image 6:</strong></label>
                        <input type="file" class="form-control" name="image6" id="image6" required title="select Image">
                    </div>

                </div>
                <hr>
                {{-- status --}}
                <div class="row mb-4 mt-4">
                    <div class="col-md-3">
                        <label for="status" class="col-form-label"><b> Status </b></label>
                    </div>
                    <div class="col-md-9">
                        <label class="toggle-switch">
                            <input type="checkbox" name="status" id="status">
                            <span class="toggle-switch-slider"></span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Add</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    </div>
@endsection
