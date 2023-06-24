@extends('admin.layouts.master',['navItem' => 'categories'])
@section('title', 'Add New Key ')

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
                <h5 class="d-inline">Add Key</h5>
                <a href="{{ URL::to('/admin/attributes') }}" title="Go To All Attribute Page"
                    class="btn btn-primary float-right d-inline">Go Back</a>
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    {{-- Attribute form --}}
                    <form action="{{ URL::to('/admin/keys') }}" method="POST">
                        @csrf

                        <div class="col-md-12">
                            {{-- title --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="Title" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Name
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            {{-- arabic title  --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="name_ar" class="col-form-label">
                                        <sup class="font-weight-bold text-danger">* </sup>Arabic Name
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                                </div>
                            </div>
                            {{-- status --}}
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="status" class="col-form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="status" id="status">
                                        <span class="toggle-switch-slider"></span>
                                    </label>
                                </div>
                            </div>




                            {{-- Attributes --}}
                            <div class="row mb-4 subcat-block" style="">
                                <div class="col-md-3">
                                    <label for="category" class="col-form-label"> Attributes </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2" style="height: auto;" placeholder="Select SubCategory"
                                        multiple="multiple" required name="attributes[]" id="">
                                        <option disabled selected value="">Select attributes</option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->title }}</option>
                                        @endforeach

                                    </select>
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


@section('customScripts')

    <script>
        // console.log($api_path);
        // $(document).ready(function() {
        //     $('[name=category]').change(function() {
        //         var id = $(this).val();

        //         // console.log(id);
        //         $.ajax({
        //             url: `${$api_path}api/admin/categories/${id}/subcategories`,
        //             headers: {
        //                 "Authorization": $token
        //             },
        //             type: "GET",
        //             success: function(res) {
        //                 // console.log(res);
        //                 if (res.status == 200) {
        //                     $('[name=subcategory]').html(`
    //                         <option value="">Select SubCategory</option>
    //                     `);
        //                     res.subcategories.forEach(subcat => {

        //                         $('[name=subcategory]').append(`
    //                             <option value="${subcat.id}">${subcat.title}</option>
    //                         `);
        //                     });
        //                     $('.subcat-block').show();
        //                 }

        //             }
        //         });

        //     });
        // });
    </script>

@endsection
