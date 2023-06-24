@extends('vendor.layouts.master', ['navItem' => 'users'])
@section('title', 'Edit User ')

@section('content')
    <style>
        .modal-header .close {
            padding: 0px !important;
            margin: 0px !important;
        }

        button {
            outline: none !important;
        }

        .close>span:not(.sr-only) {
            background-color: transparent;
            line-height: 20px;
            height: 1.25 rem;
            width: 1.25 rem;
            border-radius: 50%;
            font-size: 1.8rem;
            color: black;
            display: block;
            transition: all 0.2s ease-in-out;
        }

        .close>span:hover {
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
                        <h3 class="mb-0">Edit User</h3>
                    </div>

                    <div class="card-header border-0">
                        <h6>



                            {{-- <a href="{{ URL::to('/vendor/products/create') }}" title="Go to Add New User "
                                    class="btn btn-primary ">Add User</a> --}}


                            {{-- <a href="{{ URL::to('/vendor/product/upload-csv') }}"
                                    title="Go to Product CSV File Upload Page" class="btn btn-success float-right mx-2">Add
                                    CSV
                                    File</a> --}}



                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">


                            <form action="{{ url('/') }}/vendor/users/{{ $user->id }}" method="POST" id="adduser">
                                <div class="modal-body">
                                    @csrf
                                    @method('Patch')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required
                                            placeholder="Name" aria-describedby="helpId" value="{{ $user->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" required
                                            placeholder="Email" aria-describedby="helpId" value="{{ $user->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" name="mobile" id="mobile" class="form-control" required
                                            placeholder="Mobile Number" aria-describedby="helpId"
                                            value="{{ $user->mobile }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="password" aria-describedby="helpId">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Select Role</label>
                                        <select class="form-control" name="subrole_id" id="" required
                                            placeholder="Select Role">
                                            @foreach ($subroles as $subrole)
                                                @if ($subrole->id == $user->subrole->id)
                                                    <option selected value="{{ $subrole->id }}">{{ $subrole->name }}
                                                    </option>

                                                @else


                                                    <option value="{{ $subrole->id }}">{{ $subrole->name }}
                                                    </option>

                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <br>
                                <button type="submit" id="" class="btn btn-primary">
                                    Save
                                </button>

                            </form>
















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
                    <p>To add a product please fill your store information first. Click below button to go to edit profile
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
            $(document).ready(function() {
                let response = "<?php echo $response; ?>";
                let message = "<?php echo $message; ?>";
                sweetAlert(response, message);

            });
        </script>

    @endif




    <script>
        $(document).ready(function() {


        });
    </script>


@endsection
