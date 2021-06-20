@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Employees </h1>

        {{-- <button class="btn btn-success" >ADD</button> --}}
        <button type="button" class="btn add-btn fw-bolder"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-plus-square add-icon"></i> Employees
        </button>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="px-5">
        <div class="row py-3">
            <div class="col-md-4">
                <form action="{{ route('employees.list') }}" method="GET">
                    @csrf
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <input name="search" type="text" placeholder="Search by employee" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn text-light btn-sm search-button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered text-center">
            <thead class="text-center table-header">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Employee Image</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Salary</th>
                <th scope="col">Birthday Date</th>
                <th scope="col">Join date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-light">
            @foreach ($employees as $key => $data)
                <tr>
                    <th scope="row">{{ $employees->firstItem()+$key }}</th>
                    <td>
                        <img style="width: 80px; height:80px;" src="{{ url('/files/employee/' . $data->image) }}" alt="">
                    </td>
                    <td>{{ $data->employeeDetail->name }}</td>
                    <td>{{ $data->employeeDetail->email }}</td>
                    <td>{{ $data->contact_no }}</td>
                    <td>{{ $data->gender }}</td>
                    <td class="text-start">{{ $data->address }}</td>
                    <td>{{ $data->salary }}BDT</td>
                    <td>{{ $data->birth_date }}</td>
                    <td>{{date("Y-M-d",strtotime($data->created_at))}}</td>
                    <td>
                        <a class="text-primary  fs-6 mx-2" href="{{ route('employees.view', $data['id']) }}"><i
                                class="far fa-eye"></i></a>
                        <a class="text-danger fs-6 mx-2" onclick="return confirm('Are you sure?')"  href={{ route('employees.delete', $data['id']) }}><i
                                class="far fa-trash-alt"></i></a>
                        <a class="text-success  fs-6 mx-2"  href={{ route('employees.edit', $data['id']) }}><i
                                class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($search))
    <p>
    <span class="text-secondary">searching for '{{$search}}' , found '{{count($employees)}}' results</span>
    </p>
@endif
</div>

    <div>
        <!-- Vertically centered modal -->


        <!-- Vertically centered scrollable modal -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <form method="post" action="{{ route('employees.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">Create New Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="">Upload Image</label>
                                <input name="employee_image" type="file" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Employee Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Employee Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Employee email" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Contact Number</label>
                                <input type="text" name="contact_no" class="form-control" id="exampleFormControlInput1"
                                    placeholder="01785496362" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <div>
                                    <small>*Please give your parmanent address</small>
                                </div>
                                <textarea type="text" name="address" class="form-control" id="exampleFormControlInput1"
                                    placeholder="write your address" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Salary</label>
                                <input type="number" class="form-control" name="salary" id="exampleFormControlInput1"
                                    placeholder="50000BDT" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Birthday Date</label>
                                <div>
                                    <small>*18 year's required</small>
                                </div>
                                <input type="date" min="01-01-2003" class="form-control" name="birth_date" id="exampleFormControlInput1"
                                    placeholder="Birthday-date" max={{$disable}} required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modal-cancel text-white fw-bolder" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn modal-submit text-white fw-bolder">Ok</button>
                        </div>
        </form>
    </div>
</div>
</div>
    <div class="d-flex justify-content-center ">
        {{ $employees->links() }}
    </div>
@endsection
