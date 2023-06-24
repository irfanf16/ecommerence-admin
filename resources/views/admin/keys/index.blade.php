@extends('admin.layouts.master', ['navItem' => 'categories'])
@section('title', 'All Keys ')

@section('content')

    <div class="container-fluid">
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Keys</strong></h2>
                        @can('admin-keys-write')
                        <a href="{{ URL::to('/admin/keys/create') }}" title="Go to Add New Attribute Page"
                           class="btn btn-primary">Add Key</a>
                        @endcan
                    </div>
                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="key_datatable_length" class="form-control form-control-sm">
                                                <option selected value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="keySearch" value="" type="search" class="form-control form-control-sm"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="" style="position: relative;">
                                        <div class="pre-loader" style="display: none">
                                            <div class="loader-for-datatable" style=""></div>
                                        </div>
                                    <table id="DataTables_Table_0"
                                           class="table table-hover  no-footer" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                        <tr role="row">
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                               @can('admin-keys-edit')
                                            <th>Actions</th>
                                            @endcan
                                        </tr>
                                        </thead>
                                        <tbody id="recordsList">

                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                            </div>
                            <div class="row" id="paginationList">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
    @if (Session::has('response'))
        {{ $response = Session::get('response')['action'] }}
        {{ $message = Session::get('response')['message'] }}

        <script>
            $(document).ready(function () {

                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
            });
        </script>
    @endif


    <script>
        $(document).ready(function () {
            var page_id=1
            getKeys(page_id);


            $('body').on('click', '.archive-btn', function () {
                // alert("hit");
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This File will be moved to Archive",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Key has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Key is Safe!");
                        }
                    });
            });
        });
    </script>
@endsection
