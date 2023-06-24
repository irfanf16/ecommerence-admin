<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 forbidden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 m-auto">
                <img src="{{ URL::to('/admin/images/errors/403.svg') }}" class="mw-100 mt-5 mb-4" alt="403 Unauthorized">
                <h5 class="text-center mb-3">You are not allowed to access the requested resource.</h5>
                <a href='{{ URL::to('/') }}' class="btn btn-primary mx-auto d-block">Go back to login page</a>
            </div>
        </div>
    </div>
</body>

</html>
