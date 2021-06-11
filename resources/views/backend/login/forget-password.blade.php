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
        <div class="alert alert-success d-flex justify-content-between mt-2">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between mt-2">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <main class=" m-5 ">
                <div class=" d-flex justify-content-center">
                    <form action="{{ route('newPass.create') }}" method="post" class="login-background col-md-6 p-5 rounded mt-5s shadow">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <img src="/img/SRMS.png" class="w-50 img-fluid" alt="">
                            </div>
                        <label for="inputEmail" class="mb-2 text-primary fw-bold fs-4 text-light ">Enter Your Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control mb-4 p-3"
                            placeholder="Email address" required autofocus>
                        <button class="w-100 btn btn-lg btn-danger login-btn fw-bold" type="submit">Submit</button>
                    </form>
                </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
