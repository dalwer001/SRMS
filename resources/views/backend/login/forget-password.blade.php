<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRMS</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">

</head>


<body class="container login-bg " style=>
    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <main class="shadow m-5 ">
        <div class="row">

            <div class="col-md-12 col-sm-12 bg-light">


                <div class="p-5 m-5">
                    <form action="{{ route('newPass.create') }}" method="post">
                        @csrf
                        <label for="inputEmail" class="mb-2 text-primary fw-bold">Enter Your Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control mb-3"
                            placeholder="Email address" required autofocus>
                        <button class="w-100 btn btn-lg btn-danger fw-bold" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
