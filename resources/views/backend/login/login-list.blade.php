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
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <main class="shadow m-5 ">
        <div class="row  d-flex  " style="margin-top: 20%">
            <div class="col-md-6 col-sm-12 backgroundForm text-warning ">
                <div class="p-5 m-5 ">
                    <h1>Welcome</h1>
                    <p class="m-3">To</p>
                    <h1>SRMS</h1>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 bg-light">


                <div class="p-5 m-5">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <h1 class="h3 mb-3 fw-normal  text-center fw-bolder text-info">Login</h1>
                        <label for="inputEmail" class="mb-2 text-primary fw-bold">Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control mb-3"
                            placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="mb-2 text-primary fw-bold">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control mb-3"
                            placeholder="Password" required>
                        <button class="w-100 btn btn-lg btn-danger fw-bold" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
