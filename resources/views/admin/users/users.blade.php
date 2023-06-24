@extends('admin.layouts.master', ['navItem' => 'users'])
@section('title', 'Users List')

@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close > span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25rem;
            width: 1.25rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close > span:hover {
            background-color: transparent !important;
        }

    </style>
    <div class="container-fluid">

        {{-- warning message row --}}
        {{-- @if (!$store_info)
            <div class="custom-notification danger card">
                <a href="{{ URL::to('/vendor/profile/edit') }}" title="Go To Profile Edit Page">
                    <div class="notification-content">
                        <h2>Store Information Missing!</h2>
                        <p>To add a product please fill your store information first!</p>
                    </div>
                </a>
            </div>
        @endif --}}



        {{-- Data Table Row --}}
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card border">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Users</h3>
                    </div>

                    <div class="card-header border-0">
                        <h6>


                            {{-- <a href="{{ URL::to('/vendor/products/create') }}" title="Go to Add New User "
                                    class="btn btn-primary ">Add User</a> --}}


                            {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}

                            @can('admin-usermanagement-write')
                                <a data-toggle="modal" data-target="#AddUser" title="Go to Add New User Page"
                                   class="btn btn-primary float-right text-white">Add User</a>
                            @endcan

                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table id="example-datatable" class="table table-hover dataTable js-basic-example">
                                <thead>
                                <tr>
                                    <th width="5%">Sr.</th>
                                    <th width="10%">Name</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                    @can('admin-usermanagement-edit')
                                    <th width="10%">Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @php $count = 1; @endphp
                                @foreach ($users as $user)

                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->subrole->name }}</td>
                                        @can('admin-usermanagement-edit')
                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{ url('/') }}/admin/users/{{ $user->id }}/edit">
                                                Edit
                                            </a>
                                        </td>
                                        @endcan
                                    </tr>
                                    @php $count = $count+ 1; @endphp
                                @endforeach

                                </tbody>
                            </table>


                            {{-- modals --}}

                            <!-- Modal -->

                            <div class="modal fade" id="AddUser" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 60%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Add User
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('/') }}/admin/users" method="POST" id="adduser">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                           required
                                                           placeholder="Name" aria-describedby="helpId">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                           required placeholder="Email" aria-describedby="helpId">
                                                </div>

                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <input type="number" name="mobile" id="mobile" class="form-control"
                                                           required placeholder="Mobile Number"
                                                           aria-describedby="helpId">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" required placeholder="password"
                                                           aria-describedby="helpId">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Select Role</label>
                                                    <select class="form-control" name="subrole_id" id="" required
                                                            placeholder="Select Role">
                                                        @foreach ($subroles as $subrole)
                                                            <option value="{{ $subrole->id }}">{{ $subrole->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button id="adduser-btn" class="btn btn-primary">
                                                    Add User
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CREATE-NEW-STORE-ALERT MODEL --}}
    <div class="modal fade" id="createStoreModal" tabindex="-1" role="dialog" aria-labelledby="createStoreModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title text-danger" id="createStoreModalTitle">Store Information Missing !!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>To add a product please fill your store information first. Click below button to go to edit
                        profile
                        screen.</p>
                    <a href="{{ URL::to('/vendor/profile/edit') }}" class="btn btn-primary text-white">Complete store
                        information here</a>
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
            $(document).ready(function () {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);
                $('#clickyes').click(function (e) {
                    e.preventDefault();
                    alert("element");
                    var element = $('#invoice').html();
                    alert(element);

                });
            });
        </script>

    @endif




    <script>
        $(document).ready(function () {

            // confirm Delete
            $('body').on('click', '.archive-btn', function () {
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "This Product will be moved to Archive",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Product has been archived!", {
                                icon: "success",
                            });
                            form.submit();
                            // var count_variants = from.parants('table').find('.variant-delete-btn').length();
                            // if(count_variants >/ 1)


                        } else {
                            swal("Product is Safe!");
                        }
                    });
            });

            // $('body').on('submit', '#adduser', function(e) {
            //     e.preventDefault();
            //     var formdata = new FormData($(this)[0]);
            //     // console.log(formdata);
            // });


            // Restrict last variant delete
            // var count_variants = $('.variant-delete-btn').length;
            // console.log()


        });
    </script>

@endsection
