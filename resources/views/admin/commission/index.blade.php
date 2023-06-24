@extends('admin.layouts.master',['navItem' => 'commissions', 'module' => 'commissions-history'])
@section('title', 'Commission')

@section('content')
    <div class="container-fluid">
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Commission History</strong></h2>

                    </div>
                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row mb-5 mt-5">
                                {{--                                <div class="col-sm-12 col-md-3">--}}
                                {{--                                    <label>Categories</label>--}}
                                {{--                                    <select id="category_id" class="form-control">--}}
                                {{--                                        <option selected value="">All</option>--}}
                                {{--                                        <option value="25">25</option>--}}
                                {{--                                        <option value="50">50</option>--}}
                                {{--                                        <option value="100">100</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-sm-12 col-md-3">--}}
                                {{--                                    <label>Sub Categories</label>--}}
                                {{--                                    <select id="subcategory_id" class="form-control">--}}
                                {{--                                        <option selected value="">All</option>--}}
                                {{--                                        <option value="25">25</option>--}}
                                {{--                                        <option value="50">50</option>--}}
                                {{--                                        <option value="100">100</option>--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                                <div class="col-sm-12 col-md-6">
                                    <label>Form:</label>
                                    <input id="from_date" value="" type="date" class="form-control ">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label>To:</label>
                                    <input id="to_date" value="" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="DataTables_Table_0"
                                           class="table table-hover  no-footer" role="grid"
                                           aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                        <tr role="row">
                                            <th style="width: 5%">Id</th>
                                            <th style="width: 10%">Category</th>
                                            <th style="width: 10%">Sub Category</th>
                                            <th style="width: 10%">Child Category</th>
                                            <th style="width: 14%">Storak Commission</th>
                                            <th style="width: 15%">My Store Commission</th>
                                            <th style="width: 15%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody id="CommissionList">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{--                            <div class="row" id="paginationList">--}}

                            {{--                            </div>--}}
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
            var page_id = 1
            getCommissions();


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
