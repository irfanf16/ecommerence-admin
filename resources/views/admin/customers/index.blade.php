@extends('admin.layouts.master', ['navItem' => 'customers', 'module' => 'Customers'])
@section('title', 'All Customers Profiles ')
@section('content')

    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Customers </strong></h2>
                    </div>

                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5 mt-5 page-block">


                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>Status</label>
                                    <select id="status" name="status" class="form-control customer_filters">
                                        <option value="">All</option>
                                        <option @if (Session::get('customer_status') == 1) selected @endif value="1">Active
                                        </option>
                                        <option @if (Session::get('customer_status') == 2) selected @endif value="0">In-Active
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>From:</label>
                                    <input id="customer_from_date" value="{{ Session::get('customer_from_date') }}" type="date"
                                           class="form-control customer_filters">
                                </div>
                                <div class="col-sm-12 col-md-4 mt-2">
                                    <label>To:</label>
                                    <input id="customer_to_date" value="{{ Session::get('customer_to_date') }}" type="date"
                                           class="form-control customer_filters">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="customer_datatable_length" name="datatable_length"
                                                    class="form-control form-control-sm customer_filters">
                                                <option
                                                    {{ Session::get('customer_datatable_length') == 10 ? 'selected' : '' }}
                                                    value="10">
                                                    10
                                                </option>
                                                <option
                                                    {{ Session::get('customer_datatable_length') == 25 ? 'selected' : '' }}
                                                    value="25">
                                                    25
                                                </option>
                                                <option
                                                    {{ Session::get('customer_datatable_length') == 50 ? 'selected' : '' }}
                                                    value="50">
                                                    50
                                                </option>
                                                <option
                                                    {{ Session::get('customer_datatable_length') == 100 ? 'selected' : '' }}
                                                    value="100">
                                                    100
                                                </option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="customerSearch" value="{{ old('search') }}" type="search"
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
                                                <th width="2%">Sr.</th>
                                                <th width="10%">Name</th>
                                                <th width="10%">Email</th>
                                                <th width="10%">Phone</th>
                                                <th width="10%">Registered With</th>
                                                <th width="10%">Registered Date</th>
                                                <th width="10%">Status</th>
                                                <th width="10%">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody id="customerList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="customerPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('customScripts')

    <script>
        $(document).ready(function() {

            var page_id = 1;
            @if (Session::has('customer_page_id'))
                page_id = '{{ Session::get('customer_page_id') }}'
            @endif
            getCustomers(page_id);
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

    </script>

    @if (session()->has('response'))
        <script>
            AlertSwal(<?php echo json_encode(session()->get('response')); ?>);
        </script>
    @endif
@endsection
