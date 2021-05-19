<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    {{-- style.css --}}
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/sidebar.css" rel="stylesheet">
    <link href="/css/header.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body class="main-background">
    @include('backend.partials.header')

    <div class="container-fluid">
        <div class="row">

            @include('backend.partials.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">

                @yield('content')

            </main>


        </div>
    </div>

    @include('backend.partials.scripts');

</body>

</html>
