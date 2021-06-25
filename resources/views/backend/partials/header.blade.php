<header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 header-bg">
    @if (auth()->user()->role == 'admin')
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bolder  text-center  text-light header-shadow fs-4 bg-light"
            href="{{ route('dashboard.list') }}"><img src="/img/SRMS.png" class="w-25 img-fluid" /></a>
    @else
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bolder  text-center  text-light header-shadow fs-4 bg-light"
            href="{{ route('dashboard.list') }}"><img src="/img/SRMS.png" class="w-25 img-fluid" /></a>
    @endif
    <button class="navbar-toggler position-absolute d-md-none collapsed bg-primary" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            @auth()
                @if (auth()->user()->role == 'employee')
                    <span style="color:white;" data-feather="user"></span>
                    <a href="{{ route('employee.profile') }}" class="text-decoration-none fw-bolder"><span
                            style="color:white; margin-right: 30px;">{{ auth()->user()->name }}</span></a>
                @else
                    <span style="color:white;" data-feather="user"></span>
                    <a href="#" class="text-decoration-none"><span
                            style="color:white; margin-right: 30px;">{{ auth()->user()->name }}</span></a>
                @endif
                <a class="btn btn-outline-danger btn-sm text-white" href="{{ route('logout') }}"> Logout</a>
            @else
                <a class="btn btn-success" href="{{ route('login.form') }}">Login</a>
            @endauth
        </li>
    </ul>
</header>
