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

<body class="container login-bg ">

    <main class=" m-5 shadow ">
        <div class="row ">
            <div class="col-md-6 col-sm-12 bg-dark text-warning ">
                <div class="p-5 m-5 ">
                    <h1>Welcome</h1>
                    <p class="m-3">To</p>
                    <h1>SRMS</h1>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 bg-white ">
                <div class="p-5 m-5">
                    <form>
                        <h1 class="h3 mb-3 fw-normal ">Login</h1>
                        <label for="inputEmail" class="mb-2">Email</label>
                        <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email address"
                            required autofocus>
                        <label for="inputPassword" class="mb-2">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-danger" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>


    </main>



</body>

</html>
