@extends('admin.layouts.master', ['navItem' => 'categories', 'module' => 'Subcategories'])
@section('title', 'All Subcategories ')

@section('content')
    {{-- Sub Categories --}}
    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <a href="{{ URL::to('/admin/subcategories') }}" title="Go to all Subcategories page">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Total</h5>
                                    <h2>{{ $subcategories_count }}</h2>
                                </div>
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/subcategories/subcategories.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Sub Categories Default Image">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <a href="{{ URL::to('/admin/subcategories') }}" title="Go to all sub categories page">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Active</h5>
                                    <h2>{{ $active_subcategories }}</h2>
                                </div>
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/subcategories/active.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Sub Categories Default Image">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <a href="{{ URL::to('/admin/subcategories') }}" title="Go to all Sub categories page">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Inactive</h5>
                                    <h2>{{ $inactive_subcategories }}</h2>
                                </div>
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/subcategories/inactive.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Sub Categories Default Image">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <a href="{{ URL::to('/admin/subcategories') }}" title="Go to all Sub categories page">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Featured</h5>
                                    <h2>{{ $featured_subcategories }}</h2>
                                </div>
                                <div class="col-4 px-2">
                                    <img src="{{ URL::to('admin/images/icons/subcategories/featured.svg') }}"
                                        class="rounded w-100 stats-icons" alt="Sub Categories Default Image">
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
                        <h2 class="text-center"><strong>SubCategory</strong></h2>

                    </div>
                    <hr>
                    <div class="header justify-content-start">

                        <a href="{{ URL::to('/admin/subcategories/create') }}" title="Go to Add New Subcategory Page"
                            class="btn btn-primary">Add Subcategory</a>

                        <button class="btn btn-primary ml-2" id="enable-ordering">
                            Enable Ordering
                        </button>
                        <button class="btn btn-primary ml-2" style="display: none;" id="disable-ordering">
                            Disable Ordering
                        </button>

                        <button class="btn btn-success ml-2" style="display: none;" id="update-ordering">
                            Update Ordering
                        </button>

                        <a href="{{ URL::to('/admin/subcategory/archive') }}" title="Go to Archive"
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
                                        <th>Popular</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @php $count = 1; @endphp
                                    @foreach ($subcategories as $subcategory)
                                        <tr elid="{{ $subcategory->id }}">
                                            <td width="5%">{{ $count }}</td>

                                            <td width="10%">
                                                @if ($subcategory->image)
                                                    <img src='{{ config('app.url') . "storage/subcategories/image/lg/$subcategory->image" }}'
                                                        alt="{{ $subcategory->title . ' image' }}"
                                                        class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/subcategories/default.svg') }}"
                                                        alt="Subcategory Default image" class="w-100 rounded">
                                                @endif
                                            </td>
                                            <td>{{ $subcategory->title }} <br>
                                            <strong>Main:</strong> {{ $subcategory->category->title ?? '' }}</td>
                                            <td><strong>{{ $subcategory->order }}</strong></td>

                                            <td>
                                                <label class="toggle-switch">
                                                    <input data-id="{{$subcategory->id}}" type="checkbox" class="float-right toggle-class subcategory_status_change" name="status" id="status-{{ $subcategory->id }}"
                                                        {{ $subcategory->status ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input data-id="{{$subcategory->id}}" type="checkbox" class="float-right toggle-class subcategory_feature_change" name="featured" id="status-{{ $subcategory->id }}"
                                                        {{ $subcategory->featured ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="toggle-switch">
                                                    <input data-id="{{$subcategory->id}}" type="checkbox" class="float-right toggle-class subcategory_popular_change" name="popular" id="status-{{ $subcategory->id }}"
                                                        {{ $subcategory->popular ? 'checked' : '' }} data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive">
                                                <span class="toggle-switch-slider" title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/subcategories/$subcategory->id/edit") }}"
                                                    title="Edit This Subcategory" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action='{{ URL::to("admin/subcategories/$subcategory->id") }}'
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger archive-btn"
                                                        title="Archive This Subcategory">
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
                    url: "/admin/subcategory/order/update",
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
                            swal("SubCategory has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("SubCategory is Safe!");
                        }
                    });
            });
        });
    </script>
@endsection


