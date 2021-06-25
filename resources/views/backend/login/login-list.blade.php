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


<body class="container login-bg " >
    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between m-3">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between m-3">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between m-3">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <main class=" m-5 ">
        {{-- <div class="row"> --}}
            {{-- <div class="col-md-12  text-center  text-light">
                <div class="p-5 text-">
                    <h1>Welcome</h1>
                    <p class="m-3">To</p>
                    <h1>SRMS</h1>
                </div>
            </div> --}}

            {{-- <div class="col-md-6  "> --}}
                <div class=" d-flex justify-content-center">
                    <form action="{{ route('login') }}" method="post" class="login-background col-md-6 p-5 rounded mt-5s shadow">
                        @csrf
                        <div class="d-flex justify-content-center">
                        <img src="/img/SRMS.png" class="w-50 img-fluid" alt="">
                        </div>
                        <h1 class="h3 mb-3 fw-normal text-center fw-bolder text-light mt-3 fs-3">Login</h1>
                        <label for="inputEmail" class="mb-2 text-primary fw-bold fs-4 text-light ">Email</label>
                        <input type="email" name="email" id="inputEmail" class="form-control mb-4 p-3"
                            placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="mb-2 text-primary fw-bold fs-4 text-light ">Password</label>

                    <input type="password" id="inputPassword" name="password" class="form-control mb-4 p-3"
                            placeholder="Password" required>
                            {{-- Employee <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> 
                            Admin <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"> --}}

                            {{-- <br>  --}}
    {{-- <div id="ifYes" style="visibility:hidden"> --}}
        <a href="{{ route('forgetPassword') }}" class="text-decoration-none text-light">* Forget Password</a>
    {{-- </div> --}}

                        <button class="w-100 btn btn-lg login-btn fw-bold mt-3" type="submit">Login</button>
                    </form>
                </div>
            {{-- </div> --}}
        {{-- </div> --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

}
    </script> --}}
</body>

</html>
