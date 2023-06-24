@extends('admin.layouts.master', ['navItem' => 'categories', 'module' => 'Categories'])
@section('title', 'All Categories ')

@section('content')

    <div class="container-fluid">


        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Categories</strong></h2>

                    </div>
                    <hr>
                    <div class="header justify-content-start">


                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Popular</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td width="10%">
                                                @if ($category->logo_image)
                                                    <img src='{{ config('app.url') . "admin/images/categories/logo/sm/$category->logo_image" }}'
                                                        alt="{{ $category->title . ' image' }}" class="w-100 rounded">
                                                @else
                                                    <img src="{{ URL::to('/admin/images/icons/categories/default.svg') }}"
                                                        alt="category Default image" class="w-100 rounded">
                                                @endif

                                            </td>
                                            <td><strong>{{ $category->title }}</strong></td>
                                            <td width="10%">
                                                @if ($category->status)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="10%">
                                                @if ($category->featured)
                                                    <span
                                                        class="badge badge-lg badge-success text-uppercase font-weight-bold">Yes
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-primary text-uppercase font-weight-bold">No
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="10%">
                                                @if ($category->popular)
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

                                                <form id="archive-{{ $category->id }}"
                                                    action="{{ URL::to('admin/category/restore') }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                                    <button type="button" class="btn btn-success restore-btn"
                                                        title="Restore">
                                                        <span class="btn-inner-icon">
                                                            <i class="fa fa-refresh"></i> Restore
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
            $('.restore-btn').click(function() {
                var form = $(this).parents('form');
                swal({
                        title: "Are you sure?",
                        text: "This File will be Restored",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Category has been Restored!", {
                                icon: "success",
                            });
                            form.submit();

                        } else {
                            swal("Aborted !");
                        }
                    });
            });
        });
    </script>
@endsection
