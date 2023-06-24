@extends('admin.layouts.master', ['navItem' => 'banners'])
@section('title', 'List of all website homepage banners ')

@section('content')

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>TOTAL</h6>
                        <h2>{{ $banners_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>ACTIVE</h6>
                        <h2>{{ $active_banners }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border">
                    <div class="body">
                        <h6>IN-ACTIVE</h6>
                        <h2>{{ $inactive_banners }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">

                    {{-- card-header --}}
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Website Banners</strong></h2>
                    </div>
                    {{-- <hr> --}}
                    <div class="header justify-content-start">
                        @can('admin-covers-write')
                        <a href="{{ URL::to('/admin/website/banners/create') }}" title="Go to Add New Banners Page"
                            class="btn btn-primary"> <i class="fa fa-plus-circle"></i>Add Banner</a>
                        @endcan
                        @can('admin-covers-edit')
                        <button class="btn btn-primary ml-2" id="enable-ordering">
                            Enable Ordering
                        </button>
                        <button class="btn btn-primary ml-2" style="display: none;" id="disable-ordering">
                            Disable Ordering
                        </button>

                        <button class="btn btn-success ml-2" style="display: none;" id="update-ordering">
                            Update Ordering
                        </button>
                            @endcan
                        <a href="{{ URL::to('/admin/website/banners/archive') }}" title="Go to Archived Banners Page"
                            class="btn btn-danger ml-2"> <i class="fa fa-trash"></i>Archive</a>
                    </div>

                    {{-- card-body --}}
                    <div class="body">
                        <div class="table-responsive">
                            <table id="sortable-datatable" class="table table-hover dataTable ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Banner Info</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        @can('admin-covers-edit')
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>

                                <tbody id="sortable">
                                    @php $count = 1; @endphp
                                    @foreach ($banners as $banner)

                                        {{-- elid = Element ID --}}
                                        <tr class="bg-white" order-id="{{ $banner->order }}"
                                            elid="{{ $banner->id }}">
                                            <td width="5%">{{ $count }}</td>
                                            <td width="15%">
                                                @if ($banner->image)
                                                    <img src='{{ config('app.url') . "storage/banners/website/lg/$banner->image" }}'
                                                        alt="{{ $banner->title . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/default/banner.svg') }}"
                                                        alt="Banner Default image" class="w-100 rounded-circle">
                                                @endif

                                            </td>
                                            <td>{{ $banner->title }}</td>
                                            <td width="5%">{{ $banner->order }}</td>
                                            <td>
                                                @if ($banner->status)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            @can('admin-covers-edit')

                                            <td width='10%'>
                                                <a href='{{ URL::to("admin/website/banners/$banner->id/edit") }}'
                                                    title="Edit This Banner" class="btn btn-sm btn-primary">
                                                    <span class="btn-inner-icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action='{{ URL::to("admin/website/banners/$banner->id") }}'
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Delete This Banner">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            @endcan
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
    {{-- Jquery UI FOR DATATABLE SORTING -- DRAG AND DROP --}}
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
                $('#disable-ordering').show();
                $('#update-ordering').show();
            } else {
                $('#enable-ordering').show();
                $('#disable-ordering').hide();
                $('#update-ordering').hide();
            }
        }

        // AFTER PAGE-RENDERING
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
                    url: "/admin/website/banners/order/update",
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


            // RESTORE ARCHIEVED BANNER
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
