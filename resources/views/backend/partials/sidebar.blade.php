<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar bg-dark collapse background">
    <div class="position-sticky pt-3 ">
        <div class="row">
            <div class="sidebar-header">
                <div class="col-md-12 ">
                    @if (auth()->user()->role == 'employee')
                        {
                        <div class="avatar m-auto">
                            <img src="{{ url('/files/employee/' . auth()->user()->employeeProfile->image) }}"
                                alt="..." class="img-fluid rounded-circle w-100 h-100">
                        </div>
                        }
                    @else{
                        <div class="avatar m-auto">
                            <img src="{{ url('img/shojib.jpg') }}" alt="..."
                                class="img-fluid rounded-circle w-100 h-100">
                        </div>
                        }
                    @endif
                </div>

                <div class="col-md-12 text-center">
                    <h1 class="h5 text-white ">{{ auth()->user()->name }}</h1>
                </div>
            </div>
        </div>
        <ul class="nav flex-column item-hover ">
            @if (auth()->user()->role == 'admin')
                <li class="nav-item ">
                    <a class="nav-link active text-white" aria-current="page" href="{{ route('dashboard.list') }}">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
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

                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('employees.list') }}">
                        <i class="far fa-user"></i>
                        Employees
                    </a>
                </li>
            @endif


            <li class="nav-item  dropend">
                <a class="nav-link text-white dropdown-toggle btn-group" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-balance-scale"></i>
                    Sales
                </a>
                <ul class="dropdown-menu background m-0 bg-dark">
                    <li> <a class="nav-link  text-white" href="{{ route('manageSales.list') }}">Manage
                            sale</a>
                    </li>
                    <li> <a class="nav-link text-white" href="{{ route('saleSummary.list') }}">Sale
                            Summary</a>
                    </li>


                    @if (auth()->user()->role == 'employee')
                        {
                        <li> <a class="nav-link text-white" href="{{ route('newSale.list') }}">New Sale</a> </li>
                        }
                    @endif
                </ul>
            </li>


            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('tasks.list') }}">
                    <i class="fas fa-tasks"></i>
                    Tasks
                </a>
            </li>





            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('customers.list') }}">
                    <i class="fas fa-users"></i>
                    Customer
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="fas fa-chart-bar"></i>
                        Reports
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
