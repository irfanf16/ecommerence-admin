@extends('admin.layouts.master', ['navItem' => 'products'])
@section('title', 'All Attributes ')

@section('content')

    <div class="container-fluid">



        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="header">
                        <h2><strong>Keys</strong></h2>
                        <a href="{{ URL::to('/admin/keys/create') }}" title="Go to Add New Attribute Page"
                            class="btn btn-primary">Add Key</a>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table id="" class="table table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach ($keys->data as $key)
                                        <tr>
                                            <td width="5%">{{ $count }}</td>
                                            <td>{{ $key->name }}</td>
                                            <td width="15%">
                                                @if ($key->status)
                                                    <span
                                                        class="badge badge-lg badge-pill badge-success text-uppercase font-weight-bold">Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge badge-lg badge-pill badge-danger text-uppercase font-weight-bold">Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td width="18%">
                                                <a href="{{ URL::to("admin/keys/$key->id/edit") }}" title="Edit This Key"
                                                    class="btn btn-primary">
                                                    <span class="btn-inner--icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                                <form action="{{ URL::to('admin/keys/' . $key->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger archive-btn"
                                                        title="Delete This key">
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
            $('body').on('click', '.archive-btn', function() {
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
