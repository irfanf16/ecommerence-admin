@extends('admin.layouts.master', ['navItem' => 'adminCredentials'])
@section('title', ' Admin Credentials')

@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6 mx-auto mb-4" id="wrongPass">

            {{-- // PRINT ERRORS --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Update Password</h5>
                </div>

                <form id="updatePassword" action='{{ URL::to('admin/profile/password/update') }}' method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="d-flex flex-column">
                            <div class="form-group">
                                <label for="OldPassword">Old Password<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="password" name="old_password"
                                    placeholder="enter your old password" required />
                            </div>
                            <div class="form-group">
                                <label for="NewPassword">New Password<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="password" min="8" name="new_password" id="password"
                                    placeholder="enter new password" required />
                            </div>
                            <div class="form-group">
                                <label for="ConfirmPassword">Confirm Password<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="password" min="8" name="password_confirmation"
                                    id="password_confirmation" placeholder="enter new password again" required />
                                <p class='text-danger pt-1 d-none error-msg'>Password and Confirm Password does not match.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button class="btn btn-primary float-right mb-3 update-btn" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // MATCH PASSWORD AND CONFIRM PASSWORD
            $(".update-btn").click(function(e) {
                e.preventDefault();

                var newPassword = $("#password").val();
                var confirmPassword = $("#password_confirmation").val();

                if (newPassword != confirmPassword) {
                    $(".error-msg").removeClass("d-none");

                } else {
                    $("#updatePassword").submit();
                }
            });

        });
</div>
@endsection