<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse ">
    <div class="position-sticky pt-3 ">
        <ul class="nav flex-column item-hover ">
            <li class="nav-item ">
                <a class="nav-link active text-white" aria-current="page" href="{{ route('dashboard.list') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item  dropend">
                <a class="nav-link text-white dropdown-toggle btn-group"
                        type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-balance-scale"></i>
                    Sales
                </a>
                <ul class="dropdown-menu bg-dark m-0">
                    <li> <a class="nav-link text-white" href="">New Sale</a> </li>
                    <li> <a class="nav-link  text-white" href="{{ route('manageSales.list')}}">Manage sale</a></li>
                    <li> <a class="nav-link text-white" href="{{ route('saleSummary.list')}}">Sale Summary</a></li>
                </ul>

            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('products.categories') }}">
                    <i class="far fa-file-alt"></i>
                    Products Categories
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('products.list') }}">
                    <i class="far fa-file-alt"></i>
                    Products
                </a>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('tasks.list') }}">
                    <i class="fas fa-tasks"></i>
                    Tasks
                </a>
            </li>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('employees.list') }}">
                    <i class="far fa-user"></i>
                    Employees
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('customers.list') }}">
                    <i class="fas fa-users"></i>
                    Customer
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    <i class="fas fa-chart-bar"></i>
                    Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
