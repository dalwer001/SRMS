<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fw-bolder bg-secondary" href="#">SRMS</a>
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
                <a href="{{route('employee.profile')}}" class="text-decoration-none"><span style="color:white; margin-right: 30px;">{{ auth()->user()->name }}</span></a>
                @endif
                <a class="btn btn-danger" href="{{ route('logout') }}"> Logout</a>
            @else
                <a class="btn btn-success" href="{{ route('login.form') }}">Login</a>
            @endauth

        </li>
    </ul>
</header>
