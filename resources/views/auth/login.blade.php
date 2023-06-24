@extends('auth.master')
@section('title', 'Login ')

@section('content')

    <style>
        .logo-dim {
            width: 200px !important;
        }

    </style>
    <!-- Login Header -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="{{ URL::to('/admin/images/logos/logo.svg') }}" class="logo-dim" alt="Lucid">
                    </div>

                    <div class="card">
                        {{-- Error Message --}}
                        @if (isset($status))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ $status }}
                            </div>
                        @endif
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            {{-- login form --}}
                            <form class="form-auth-small" action="{{ URL::to('/login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email"
                                        value="admin@gmail.com" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a
                                            href="auth-forgot-password.html">Forgot password?</a></span>
                                    {{-- <span>Don't have an account? <a href="{{URL::to('/register')}}">Register</a></span> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Block -->
@endsection

@section('customScripts')
    <!-- Load and execute javascript code used only in this page -->

    <script>
        $(function() {

        });

    </script>
@endsection
