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
                        <form action="{{ route('password.submit') }}" method="post">
                            @csrf

                            {{-- @dd($token) --}}


                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Enter New Password:</label>
                                    <input type="password" required name="password" class="form-control" placeholder="**" id="">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Re-enter Password:</label>
                                    <input type="password" required name="password_confirmation" class="form-control"
                                        placeholder="**" id="">
                                </div>
                            </div>

                            <input type="hidden" value="{{ $token }}" name="token">
                            <input type="hidden" value="{{ $email }}" name="email">

                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
