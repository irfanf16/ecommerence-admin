@extends('admin.layouts.master', ['navItem' => 'categories', 'module' => 'Childcategories'])
@section('title', 'All Childcategories ')

@section('content')
    {{-- Child Categories --}}
    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="page-block">

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <a href="{{ URL::to('/admin/childcategories') }}" title="Go to all childcategories page">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Total</h5>
                                        <h2>{{ $childcategories_count }}</h2>
                                    </div>
                                    {{--                                <div class="col-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/childcategories/childcategories.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <a href="{{ URL::to('/admin/childcategories') }}" title="Go to all Child categories page">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Active</h5>
                                        <h2>{{ $active_childcategories }}</h2>
                                    </div>
                                    {{--                                <div class="col-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/childcategories/active.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <a href="{{ URL::to('/admin/childcategories') }}" title="Go to all Child categories page">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Inactive</h5>
                                        <h2>{{ $inactive_childcategories }}</h2>
                                    </div>
                                    {{--                                <div class="col-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/childcategories/inactive.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <a href="{{ URL::to('/admin/childcategories') }}" title="Go to all Child categories page">
                                <div class="row">
                                    <div class="col-8">
                                        <h5>Featured</h5>
                                        <h2>{{ $featured_childcategories }}</h2>
                                    </div>
                                    {{--                                <div class="col-4 px-2">--}}
                                    {{--                                    <img src="{{ URL::to('admin/images/icons/childcategories/featured.svg') }}"--}}
                                    {{--                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">--}}
                                    {{--                                </div>--}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Child Categories</strong></h2>

                    </div>
                    <hr>
                    <div class="header justify-content-start">
                        @can('admin-childcategories-write')
                            <a href="{{ URL::to('/admin/childcategories/create') }}"
                               title="Go to Add New Childcategory Page"
                               class="btn btn-primary">Add Childcategory</a>
                        @endcan
                        {{--                        <button class="btn btn-primary ml-2" id="enable-ordering">--}}
                        {{--                            Enable Ordering--}}
                        {{--                        </button>--}}
                        {{--                        <button class="btn btn-primary ml-2" style="display: none;" id="disable-ordering">--}}
                        {{--                            Disable Ordering--}}
                        {{--                        </button>--}}

{{--                        <button class="btn btn-success ml-2" style="display: none;" id="update-ordering">--}}
{{--                            Update Ordering--}}
{{--                        </button>--}}

                        <a href="{{ URL::to('/admin/childcategory/archive') }}" title="Go to Archive"
                           class="btn btn-danger ml-2"> <i class="fa fa-trash"></i> Archive</a>

                    </div>
                    <div class="body pt-0">
                        <div id="DataTables" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length"><label>Show
                                            <select id="child_datatable_length" class="form-control form-control-sm">
                                                <option selected value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="example-datatable_filter" class="dataTables_filter"><label>
                                            Search:<input id="childSearch" value="" type="search"
                                                          class="form-control form-control-sm"></label>
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
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>Popular</th>
                                                <th>Products</th>
                                                @can('admin-childcategories-edit')
                                                <th>Actions</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody id="childList">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="childPaginationList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

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
        var $sorting = [];

        function getSortingData() {
            $sorting = [];
            $counter = 1;
            $('body').find('[elid]').each(function () {
                var elid = $(this).attr('elid');
                var newobj = {
                    id: elid,
                    order: $counter
                };
                $sorting.push(newobj);

                $counter = $counter + 1;
            });
            // console.log($sorting);
        }

        function updateOrder() {
            var data = $sorting;
        }

        function sorting(sorting = true) {
            if (sorting) {

                $('#enable-ordering').hide();
                $('#update-ordering').show();
                $('#disable-ordering').show();
            } else {
                $('#enable-ordering').show();

                $('#disable-ordering').hide();
                $('#update-ordering').hide();
            }
        }

        $(document).ready(function () {

            getSortingData();
            $('#enable-ordering').click(function () {
                sorting(true);
                table_sortable.page.len(500).draw();
                sortableEnable();

            });

            $('#disable-ordering').click(function () {
                sorting(false);
                table_sortable.page.len(10).draw();
                sortableDisable();
            });

            $('#update-ordering').click(function () {
                getSortingData();
                var data = {
                    data: $sorting,
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    type: 'POST',
                    url: "/admin/childcategory/order/update",
                    data: data,
                    success: function (res) {
                        // console.log(res);
                        if (res.status == 200) {
                            swal("Great", "Ordering is Successfull!", "success");
                            location.reload();
                        }
                    }
                });
            });


            var table_sortable = $('#sortable-datatable').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength'
                ]
            });


            // $("#sortable").sortable();

            function sortableEnable() {
                $("#sortable").sortable();
                $("#sortable").sortable("option", "disabled", false);
                // ^^^ this is required otherwise re-enabling sortable will not work!
                $("#sortable").disableSelection();
                return false;
            }

            function sortableDisable() {
                $("#sortable").sortable("disable");
                return false;
            }


        });
    </script>

    <script>
        $(document).ready(function () {

            var child_id = 1;
            getChildCategories(child_id);

            $('body').on('click', '.archive-btn', function () {
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
                            swal("Category has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Category is Safe!");
                        }
                    });
            });
        });
    </script>

    {{-- pagination  --}}

    <script>


    </script>

@endsection
