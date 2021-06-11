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


    <main class="m-5">
        <div class=" d-flex justify-content-center">
            <form action="{{ route('password.submit') }}" method="post"
                class="login-background col-md-6 p-5 rounded mt-5s shadow">
                @csrf
                {{-- @dd($token) --}}
                <div class="d-flex justify-content-center">
                    <img src="/img/SRMS.png" class="w-50 img-fluid" alt="">
                </div>
                <h1 class="h3 mb-3 fw-normal text-center fw-bolder text-light mt-3 fs-3">Reset Password</h1>
                <label for="inputEmail" class="mb-2 text-primary fw-bold fs-4 text-light ">Enter New Password</label>
                <input type="password" id="" name="password" class="form-control mb-4 p-3" placeholder="New Password"
                    required>
                <label for="inputEmail" class="mb-2 text-primary fw-bold fs-4 text-light ">Re-enter Password:</label>
                <input type="password" id="" name="password_confirmation" class="form-control mb-4 p-3"
                    placeholder="Re-enter Password" required>
                <input type="hidden" value="{{ $token }}" name="token">
                <input type="hidden" value="{{ $email }}" name="email">
                <button class="w-100 btn btn-lg login-btn fw-bold mt-3" type="submit">Submit</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
