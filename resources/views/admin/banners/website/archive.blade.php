@extends('admin.layouts.master', ['navItem' => 'banners', 'module' => 'Categories'])
@section('title', 'List of archieved banners ')

@section('content')
    <div class="container-fluid">

        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="header justify-content-center">
                        <h2 class="text-center"><strong>Archieved Website Banners</strong></h2>
                    </div>
                    <hr>

                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Banner Info</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($banners as $banner)
                                        <tr>
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
                                            <td width="10%">
                                                <form id="archive-{{ $banner->id }}"
                                                    action="{{ URL::to('admin/website/banners/restore') }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $banner->id }}">
                                                    <button type="button" class="btn btn-sm btn-success restore-btn"
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
                            swal("Banner has been Restored!", {
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
