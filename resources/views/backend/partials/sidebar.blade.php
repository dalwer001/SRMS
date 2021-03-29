<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse ">
      <div class="position-sticky pt-3 ">
        <ul class="nav flex-column item-hover ">
          <li class="nav-item ">
            <a class="nav-link active text-white" aria-current="page" href="{{route('dashboard.list')}}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="{{route('sales.list')}}">
              <span data-feather="file"></span>
              Sales
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="#">
              <span data-feather="file"></span>
              Products Categories
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="{{route('products.list')}}">
              <span data-feather="file"></span>
              Products
            </a>
            <li class="nav-item ">
                <a class="nav-link text-white" href="{{route('tasks.list')}}">
                  <span data-feather="file"></span>
                  Tasks
                </a>
              </li>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="{{route('employees.list')}}">
              <span data-feather="users"></span>
              Employees
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
        </ul>
        </div>
      </nav>
