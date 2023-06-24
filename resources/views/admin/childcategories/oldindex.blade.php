@extends('admin.layouts.master', ['navItem' => 'categories', 'module' => 'Childcategories'])
@section('title', 'All Childcategories ')

@section('content')
    {{-- Child Categories --}}
    <div class="container-fluid">
        {{-- Cards Row --}}
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
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/childcategories/childcategories.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">
                                </div>
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
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/childcategories/active.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">
                                </div>
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
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/childcategories/inactive.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">
                                </div>
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
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/childcategories/featured.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Child Categories Default Image">
                                </div>
                            </div>
                        </a>
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

                        <a href="{{ URL::to('/admin/childcategories/create') }}" title="Go to Add New Childcategory Page"
                            class="btn btn-primary">Add Childcategory</a>

                        <button class="btn btn-primary ml-2" id="enable-ordering">
                            Enable Ordering
                        </button>
                        <button class="btn btn-primary ml-2" style="display: none;" id="disable-ordering">
                            Disable Ordering
                        </button>

                        <button class="btn btn-success ml-2" style="display: none;" id="update-ordering">
                            Update Ordering
                        </button>

                        <a href="{{ URL::to('/admin/childcategory/archive') }}" title="Go to Archive"
                            class="btn btn-danger ml-2"> <i class="fa fa-trash"></i> Archive</a>

                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="sortable-datatable" class="table table-hover dataTable ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @php $count = 1; @endphp
                                    @foreach ($childcategories as $childcategory)
                                        <tr elid="{{ $childcategory->id }}">

                                            <td width="5%">{{ $count }}</td>
                                            <td width="10%">
                                                @if ($childcategory->image)
                                                    <img src='{{ config('app.url') . "storage/childcategories/image/lg/$childcategory->image" }}'
                                                        alt="{{ $childcategory->title . ' image' }}"
                                                        class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/childcategories/default.svg') }}"
                                                        alt="Childcategory Default image" class="w-100 rounded">
                                                @endif

                                            </td>
                                            <td>{{ $childcategory->title }} <br>
                                            <strong>Sub:</strong> {{ $childcategory->category->title ?? '' }} <br>
                                            <strong>Main: </strong> {{ $childcategory->subcategory->title ?? '' }} </td>
                                            <td>{{ $childcategory->order }}</td>
                                            <td>
                                                @if ($childcategory->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($childcategory->featured)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-primary text-uppercase font-weight-bold">No
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/childcategories/$childcategory->id/edit") }}"
                                                    title="Edit This Childcategory" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form
                                                    action="{{ URL::to('admin/childcategories/' . $childcategory->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger archive-btn"
                                                        title="Archive This Child Category">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-trash-o"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
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

        $(document).ready(function() {

            getSortingData();
            $('#enable-ordering').click(function() {
                sorting(true);
                table_sortable.page.len(500).draw();
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
                    url: "/admin/childcategory/order/update",
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
        $(document).ready(function() {
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
