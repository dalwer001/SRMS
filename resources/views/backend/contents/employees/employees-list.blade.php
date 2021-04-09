@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Employee Details</h1>

        {{-- <button class="btn btn-success" >ADD</button> --}}
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Employees
        </button>


    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Employee Image</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No</th>
                <th scope="col">Address</th>
                <th scope="col">Salary</th>
                <th scope="col">Birthday Date</th>
                <th scope="col">Join date</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $key=>$data)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>
                        <img style="width: 80px; height:80px;" src="{{url('/files/employee/'.$data->image)}}" alt="">
                    </td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->contact_no }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->salary }}</td>
                    <td>{{ $data->birth_date }}</td>
                    <td>{{ $data->join_date }}</td>
                    <td>{{ $data->password }}</td>
                    <td>
                        <a class="btn btn-primary ">View</a>
                        <a class="btn btn-danger "  href={{route('employees.delete',$data['id'])}}>Delete</a>
                        <a class="btn btn-warning " href={{route('employees.edit',$data['id'])}}>Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <!-- Vertically centered modal -->


        <!-- Vertically centered scrollable modal -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <form method="post" action="{{ route('employees.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Employee</h5>
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
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <textarea type="text" name="address" class="form-control" id="exampleFormControlInput1"
                                    placeholder="write your address" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Salary</label>
                                <input type="number" class="form-control" name="salary" id="exampleFormControlInput1"
                                    placeholder="50000TK" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Birthday Date</label>
                                <input type="date" class="form-control" name="birth_date" id="exampleFormControlInput1"
                                    placeholder="Birthday-date" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                                <input type="date" class="form-control" name="join_date" id="exampleFormControlInput1"
                                    placeholder="join-Date" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="exampleFormControlInput1"
                                    value="123@asd" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                        </div>
        </form>



    </div>
    </div>
    </div>
@endsection
