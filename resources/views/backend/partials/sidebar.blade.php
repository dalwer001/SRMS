<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar bg-dark collapse background shadow">
    <div class="position-sticky pt-3 ">
        <div class="row p-3">
            {{-- <div class="sidebar-header "> --}}
            <div class="col-md-6 ">
                @if (auth()->user()->role == 'employee')

                    <div class="avatar m-auto">
                        <img src="{{ url('/files/employee/' . auth()->user()->employeeProfile->image) }}" alt="..."
                            class="img-fluid rounded-circle w-100 h-100">
                    </div>

                @else
                    <div class="avatar m-auto">
                        <img src="{{ url('img/shojib.jpg') }}" alt="..." class="img-fluid rounded-circle w-100 h-100">
                    </div>

                @endif
            </div>

            <div class="col-md-6  m-0 pt-3 ">
                <div>
                    <h1 class="h5 text-white d-flex jutify-ceontent-center">{{ auth()->user()->name }}</h1>
                </div>
                <div>
                    <p class="text-light"><i class="fas fa-circle text-success"></i> online</p>
                </div>
            </div>
            {{-- </div> --}}
        </div>
        <ul class="nav flex-column item-hover border-top" id='nav'>

            <li class="nav-item ">
                <a class="nav-link active text-white" aria-current="page" href="{{ route('dashboard.list') }}">
                    <i class="fas fa-home text-white"></i>
                    Dashboard
                </a>
            </li>
            @if (auth()->user()->role == 'admin')

                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('products.categories') }}">
                        <i class="far fa-file-alt text-warning"></i>
                        Product Categories
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('products.list') }}">
                        <i class="far fa-file-alt text-warning"></i>
                        Products
                    </a>

                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('employees.list') }}">
                        <i class="far fa-user text-info"></i>
                        Employees
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link text-white " href="{{ route('tasks.list') }}">
                        <i class="fas fa-tasks text-danger"></i>
                        Tasks
                    </a>
                </li>
            @endif


            <li class="nav-item  dropend">
                <a class="nav-link text-white dropdown-toggle btn-group" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-balance-scale text-primary"></i>
                    Sales
                </a>
                <ul class="dropdown-menu background m-0 bg-dark">
                    <li> <a class="nav-link  text-white" href="{{ route('saleDetails.list') }}">
                            Sale Details</a>
                    </li>
                    {{-- <li> <a class="nav-link text-white" href="{{ route('saleSummary.list') }}">Sale
                            Summary</a>
                    </li> --}}


                    @if (auth()->user()->role == 'employee')

                        <li> <a class="nav-link text-white" href="{{ route('newSale.list') }}">Create Sale</a> </li>

                    @endif
                </ul>
            </li>

            @if (auth()->user()->role == 'employee')
            {{-- @dd(auth()->user()->employeeProfile->id) --}}
                <li class="nav-item ">
                    <a class="nav-link text-white"
                        href="{{ route('employeeTask.list', auth()->user()->employeeProfile->id) }}">
                        <i class="fas fa-tasks text-danger"></i>
                        Tasks @if ($countTask)
                            <span class="badge bg-danger rounded-pill">{{ $countTask }}</span>
                        @endif
                    </a>
                </li>
            @endif

            <li class="nav-item ">
                <a class="nav-link text-white" href="{{ route('customers.list') }}">
                    <i class="fas fa-users text-secondary"></i>
                    Customer
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('sales.report') }}">
                        <i class="fas fa-chart-bar text-success"></i>
                        Reports
                    </a>
                </li>
            @endif

        </ul>

        {{-- @if (auth()->user()->role == 'employee')
            <div class="text-center" style="margin-top: 500px"> --}}
                {{-- <div class="div-clock row d-flex justify-content-center bg-warning"> --}}
                    {{-- <div class="col-md-4">
                        <i class="far fa-clock text-white fs-1 mt-3" style="margin-left:80px;"></i>
                    </div> --}}
                    <div class=" bg-primary d-flex justify-content-center">
                        <p id="myClockDisplay" class="clock fw-bolder text-light  fs-5 " onload="showTime()"> </p>  
                        <p id="myDateDisplay" class="date fw-bolder text-light  fs-5 mx-2" onload="today()"></p>
                    </div>
                {{-- </div> --}}

            {{-- </div>
        @endif --}}


        {{-- @if (auth()->user()->role == 'admin')
            <div class="text-center" style="margin-top: 320px">
                <div class="div-clock row d-flex justify-content-center">
                    <div class="col-md-4">
                        <i class="far fa-clock text-white fs-1 mt-3" style="margin-left:80px;"></i>
                    </div>
                    <div class="div-date col-md-8">
                        <div id="myClockDisplay" class="clock fw-bolder text-light me-5 fs-5" onload="showTime()"></div>
                        <div id="myDateDisplay" class="date fw-bolder text-light me-5 fs-5 mb-5" onload="today()"></div>
                    </div>
                </div>

            </div>
        @endif --}}


    </div>



</nav>


{{-- <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">

        <button class="accordion-button collapsed text-light fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            <i class="fa fa-balance-scale text-primary"></i>
             Sales
        </button>

        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body background">
                <div>

                    <a class=" text-white" href="{{ route('saleDetails.list') }}">
                        Sale Details</a>

                </div>
                @if (auth()->user()->role == 'employee')
                    <div>
                        <a class=" text-white" href="{{ route('newSale.list') }}">Create Sale</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div> --}}
