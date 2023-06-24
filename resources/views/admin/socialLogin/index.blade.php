@extends('admin.layouts.master', ['navItem' => 'settings', 'module' => 'Settings'])
@section('title', 'Social Links ')

@section('content')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <div class="container-fluid">
        {{-- Cards Row --}}
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card border-0">
                    <div class="body pb-1">
                        <div class="row">
                            <div class="col-8">
                                <h5>Total</h5>
                                {{-- <h2>{{ $categories_count }}</h2> --}}
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
                                {{-- <h2>{{ $active_categories }}</h2> --}}
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
                                {{-- <h2>{{ $inactive_categories }}</h2> --}}
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
                                {{-- <h2>{{ $featured_categories }}</h2> --}}
                            </div>
                            <div class="col-4 px-2">
                                <img src="{{ URL::to('admin/images/icons/categories/featured.svg') }}"
                                     class="rounded w-100 stats-icons" alt="Categories Default Image">
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
                        @can('admin-sociallinks-write')
                            <a href="{{ route('admin.social.create') }}" title="Go to Add New Social Link Page"
                               class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Add Social Link</a>
                        @endcan
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="sortable-datatable" class="table table-hover dataTable ">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    @can('admin-sociallinks-edit')
                                    <th>Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody id="sortable">
                                @php $count = 1; @endphp
                                @foreach ($socialLinks as $social)
                                    <tr class="bg-white">
                                        <td width="5%"></td>
                                        <td width="10%">
                                            @if ($social->logo)
                                                <img
                                                    src='{{ config('app.url') . "storage/social_links/$social->logo" }}'
                                                    alt="{{ $social->title . ' image' }}" class="w-100 rounded">
                                            @else
                                                <img src="{{ URL::to('/admin/images/icons/categories/default.svg') }}"
                                                     alt="category Default image" class="w-100 rounded">
                                            @endif

                                        </td>
                                        <td><strong>{{ $social->title }}</strong></td>
                                        <td width="10%">
                                            <label class="toggle-switch">
                                                <input data-id="{{$social->id}}" type="checkbox"
                                                       class="float-right toggle-class product-feature" name="status"
                                                   @if(!\App\Traits\userPermissionCheck::userPermissionCheck('admin-sociallinks-edit'))  disabled @endif   id="status-{{ $social->id }}"
                                                       {{ $social->status ? 'checked' : '' }} data-onstyle="success"
                                                       data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                       data-off="InActive">
                                                <span class="toggle-switch-slider"
                                                      title="Activate/Deactivate Your Product"></span>
                                            </label>
                                        </td>
                                        @can('admin-sociallinks-edit')
                                        <td width="18%">
                                            <a href="{{ URL::to("admin/social/edit/$social->id") }}"
                                               title="Edit This Link" class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                            </a>
                                            <form id="archive-{{ $social->id }}"
                                                  action="{{ URL::to('admin/social/' . $social->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger archive-btn"
                                                        title="Archive This Link">
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

        $(document).ready(function () {

            getSortingData();
            $('#enable-ordering').click(function () {
                sorting(true);
                table_sortable.page.len(100).draw();
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
                    url: "/admin/category/order/update",
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
                            swal("Social Link has been archived!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Social Link is Safe!");
                        }
                    });
            });
        });
    </script>
@endsection
