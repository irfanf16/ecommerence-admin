@extends('admin.layouts.master', ['navItem' => 'massUpload', 'module' => 'Products'])
@section('title', 'Mass upload Products ')

@section('content')

    <div class="container-fluid">


        <div class="row">
            <div class="col-8" style="margin: 0 auto;">
                <form action="{{ url('/') }}/admin/massupload/product" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mass Upload Products</h5>


                            <div class="input-group">
                                <input class="form-control" type="file" name="product_csv" placeholder="Product CSV"
                                    required aria-label="Product CSV " aria-describedby="my-addon">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="my-addon">Product CSV</span>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <button class="btn btn-success" style="margin: 0 auto;">
                                    Submit
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

@if (Session::has('response'))
    @section('customScripts')
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function() {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endsection
@endif
