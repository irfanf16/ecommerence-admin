@extends('admin.layouts.master', ['navItem' => 'orders'])
@section('title', 'List of all Orders ')
@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>TOTAL</h6>
                        <h2>1500</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>COMPLETED</h6>
                        <h2>1200</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>ACTIVE</h6>
                        <h2>200</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>CANCELLED</h6>
                        <h2>100</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Orders</strong></h2>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th width="5%">Sr.</th>
                                        <th>Order Details</th>
                                        <th width="18%">Status</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp

                                    <tr>
                                        <td>{{ $count }}</td>

                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="#" title="Edit This Order" class="btn btn-primary">
                                                <span class="btn-inner-icon">
                                                    <i class="fa fa-edit"></i>
                                                </span>
                                            </a>
                                            <form action="#" method="POST" class="d-inline">
                                                @csrf
                                               
                                                <button type="button" class="btn btn-danger" title="Delete This Order">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-trash-o"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                        @php $count++; @endphp
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
