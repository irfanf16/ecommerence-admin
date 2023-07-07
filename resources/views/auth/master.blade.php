<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>@yield('title') - StorakMart</title>
    <link rel="stylesheet" href={{ URL::to('/assets/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/assets/vendor/fontawesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ URL::to('/assets/css/main.css') }}" type="text/css">
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ URL::to('/admin/images/favicon/preloader.svg') }}" width="48" height="48"
                    alt="ArrOw"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- WRAPPER -->
    @yield('content')
    <!-- END WRAPPER -->

    <!-- Core -->
    <script src="{{ URL::to('/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ URL::to('/assets/bundles/vendorscripts.bundle.js') }}"></script>

    <script src="{{ URL::to('/assets/js/theme.js') }}"></script>
</body>

</html>
