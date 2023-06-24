@extends('admin.layouts.master', ['navItem' => 'categories', 'module' => 'Categories'])
@section('title', 'All Categories ')

@section('content')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="page-block">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0">
                        <div class="body pb-1">
                            <div class="row">
                                <div class="col-8">
                                    <h5>Total</h5>
                                    <h2>{{ $categories_count }}</h2>
                                </div>
                                {{-- <div class="col-4 px-2"> --}}
                                {{-- <img src="{{ URL::to('admin/images/icons/categories/category.svg') }}" --}}
                                {{-- class="rounded w-100 stats-icons" alt="Categories Default Image"> --}}
                                {{-- </div> --}}
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
                                {{-- <div class="col-4 px-2"> --}}
                                {{-- <img src="{{ URL::to('admin/images/icons/categories/active.svg') }}" --}}
                                {{-- class="rounded w-100 stats-icons" alt="Categories Default Image"> --}}
                                {{-- </div> --}}
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
                                {{-- <div class="col-4 px-2"> --}}
                                {{-- <img src="{{ URL::to('admin/images/icons/categories/inactive.svg') }}" --}}
                                {{-- class="rounded w-100 stats-icons" alt="Categories Default Image"> --}}
                                {{-- </div> --}}
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
                                {{-- <div class="col-4 px-2"> --}}
                                {{-- <img src="{{ URL::to('admin/images/icons/categories/featured.svg') }}" --}}
                                {{-- class="rounded w-100 stats-icons" alt="Categories Default Image"> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Categories</strong></h2>

                    </div>
                    <hr>
                    <div class="header justify-content-start">
                      @can('admin-categories-write')
                        <a href="{{ URL::to('/admin/categories/create') }}" title="Go to Add New Category Page"
                            class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Add Category</a>
                        @endcan
                          @can('admin-categories-write')

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

                        <a href="{{ URL::to('/admin/category/archive') }}" title="Go to Archive"
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
                                        <th>Products</th>
                                        @can('admin-categories-edit')
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @php $count = 1; @endphp
                                    @foreach ($categories as $category)
                                        <tr class="bg-white" order-id="{{ $category->order }}" elid="{{ $category->id }}">
                                            <td width="5%">{{ $count }}</td>
                                            <td width="10%">
                                                @if ($category->logo_image)
                                                    <img src='{{ config('app.url') . "storage/categories/logo/lg/$category->logo_image" }}'
                                                        alt="{{ $category->title . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/categories/default.svg') }}"
                                                        alt="category Default image" class="w-100 rounded">
                                                @endif

                                            </td>

                                            <td><strong>{{ $category->title }}</strong></td>
                                            <td><strong>{{ $category->order }}</strong></td>
                                            <td width="10%">
                                                <label class="toggle-switch">
                                                    <input data-id="{{ $category->id }}" type="checkbox"
                                                     @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-categories-eidt')) disabled @endif class="float-right toggle-class category_status_change"
                                                        name="status" id="status-{{ $category->id }}"
                                                        {{ $category->status ? 'checked' : '' }} data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive">
                                                    <span class="toggle-switch-slider"
                                                        title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td width="10%">
                                                <label class="toggle-switch">
                                                    <input data-id="{{ $category->id }}" type="checkbox"
                                                           @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-categories-eidt')) disabled @endif  class="float-right toggle-class category_feature_change"
                                                        name="featured" id="status-{{ $category->id }}"
                                                        {{ $category->featured ? 'checked' : '' }} data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive">
                                                    <span class="toggle-switch-slider"
                                                        title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td width="10%">
                                                <label class="toggle-switch">
                                                    <input data-id="{{ $category->id }}" type="checkbox"
                                                           @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-categories-eidt')) disabled @endif  class="float-right toggle-class category_popular_change"
                                                        name="popular" id="status-{{ $category->id }}"
                                                        {{ $category->popular ? 'checked' : '' }} data-onstyle="success"
                                                        data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive">
                                                    <span class="toggle-switch-slider"
                                                        title="Activate/Deactivate Your Product"></span>
                                                </label>
                                            </td>
                                            <td>{{ $category->products_count }}</td>
                                            @can('admin-categories-edit')

                                            <td width="18%">
                                                <a href="{{ URL::to("admin/categories/$category->id/edit") }}"
                                                    title="Edit This Category" class="btn btn-sm btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form id="archive-{{ $category->id }}"
                                                    action="{{ URL::to('admin/categories/' . $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm archive-btn"
                                                        title="Archive This Category">
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
