<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <meta name="description"
        content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
{{--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/charts-c3/plugin.css') }}" />
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/select2/select2.css') }}" />
    <!-- colorpicker -->
    <link rel="stylesheet"
        href="{{ URL::to('/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <!-- tagsinput -->
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/css/main.css') }}" type="text/css">

    {{-- files includes for datatables in index pages --}}
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/css/main.css') }}">

    {{-- sweetalerts --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="{{ URL::to('/admin/css/sweetalerts.css') }}">
    <script src="{{ URL::to('/admin/js/sweetalerts.js') }}"></script>

    <!-- summernote text editor css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Custom CSS File --}}
    <link rel="stylesheet" href="{{ URL::to('/admin/css/custom.css') }}">
    <script src="{{ URL::to('/admin/js/customscripts.js') }}"></script>
    @yield('head')

{{--    for loader --}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">--}}
{{--    <link href='https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700' rel='stylesheet' type='text/css'>--}}
</head>

<body class="theme-indigo">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30">
                <img src="{{ URL::to('/admin/images/preloaders/preloader.svg') }}" width="200" height="100"
                    alt="Pre-loader">
            </div>
            <p>Please wait...</p>
        </div>
    </div>

    {{-- INCLUDE TOPBAR --}}
    @include('admin.layouts.topbar')

    <div class="main_content" id="main-content">

        {{-- INCLUDE SIDEBAR --}}
        @include('admin.layouts.sidebar')

        {{-- INCLUDE SEETTINGS0-BAR --}}
        {{-- @include('admin.layouts.settingsbar') --}}

        <div class="page">

            {{-- breadcrumb navbar --}}
            {{-- @include('admin.layouts.navbar') --}}

            @yield('content')

        </div>
    </div>

    {{-- JQuery --}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>--}}
    <!-- Core -->
    <script src="{{ URL::to('/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/c3.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/jvectormap.bundle.js') }}"></script>

    <!-- JVectorMap Plugin Js -->
    <script src="{{ URL::to('/assets/js/theme.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/index.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/todo-js.js') }}"></script>

    <!-- Select2 Js -->
    <script src="{{ URL::to('/assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ URL::to('/assets/js/theme.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ URL::to('/assets/js/pages/advanced-form.js') }}"></script>

    {{-- summernote text editor --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ URL::to('/assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::to('/assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>


    {{-- js global Variables --}}
    <script>
        var $api_path = "{{ config('app.url') }}";
        var $token = "{{ Session::get('token') }}";
    </script>

    @yield('customScripts')
    <script>
        $(document).ready(function() {

            $('.select2').select2();
        });
    </script>
</body>

</html>
