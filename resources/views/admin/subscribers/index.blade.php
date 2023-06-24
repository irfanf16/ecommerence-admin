@extends('admin.layouts.master', ['navItem' => 'subscribers', 'module' => 'Subscribers'])
@section('title', 'All Subscribers ')

@section('content')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                <h2>{{ $categories_count }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/category.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Categories Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Active</h5>
                                <h2>{{ $active_categories }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/active.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Categories Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Inactive</h5>
                                <h2>{{ $inactive_categories }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/inactive.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Categories Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Featured</h5>
                                <h2>{{ $featured_categories }}</h2>
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/featured.svg') }}"
                                    class="rounded w-100 stats-icons" alt="Categories Default Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Subscribers</strong></h2>

                    </div>
                    <hr>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="sortable-datatable" class="table table-hover dataTable ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Platform</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @php $count = 1; @endphp
                                    @foreach ($subscribers as $subscriber)
                                        <tr class="bg-white">
                                            <td width="5%">{{ $count }}</td>
                                            <td><strong>{{ $subscriber->email }}</strong></td>
                                            <td><strong>{{ $subscriber->platform_type }}</strong></td>
                                            @php $count++; @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            $(document).ready(function() {

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
            $('body').find('[elid]').each(function() {
                var elid = $(this).attr('elid');
                var newobj = {
                    id: elid,
                    order: $counter
                };
                $sorting.push(newobj);

                $counter = $counter + 1;
            });
            console.log($sorting);
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

        $(document).ready(function() {

            getSortingData();
            $('#enable-ordering').click(function() {
                sorting(true);
                table_sortable.page.len(100).draw();
                sortableEnable();
            });

            $('#disable-ordering').click(function() {
                sorting(false);
                table_sortable.page.len(10).draw();
                sortableDisable();
            });

            $('#update-ordering').click(function() {
                getSortingData();
                var data = {
                    data: $sorting,
                    _token: "{{ csrf_token() }}"
                };
                $.ajax({
                    type: 'POST',
                    url: "/admin/category/order/update",
                    data: data,
                    success: function(res) {
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


            $('body').on('click', '.archive-btn', function() {
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
@endsection
