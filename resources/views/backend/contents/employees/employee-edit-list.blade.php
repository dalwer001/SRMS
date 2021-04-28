@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success">Edit Employee Information</h1>
    </div>

    {{-- modal --}}
    <div>

        <form method="POST" action="{{ route('employees.update', $employees['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Employee Name:</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                    placeholder="Employee Name" value="{{ $employees['name'] }}">
            </div>

            {{-- <div class="mb-3">
                <label for="">Upload Image</label>
                <input name="employee_image" type="file" class="form-control" value="{{$employee['image']}}">
            </div> --}}

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                    placeholder="Employee email" value="{{ $employees['email'] }}">
            </div>

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Contact Number</label>
                <input type="text" name="contact_no" class="form-control" id="exampleFormControlInput1"
                    placeholder="01785496362" value="{{ $employees['contact_no'] }}">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <select class="form-select" name="gender">
                    <option selected>Select Gender</option>
                    <option value="{{ $employees['gender'] }}">Male</option>
                    <option value="{{ $employees['gender'] }}">Female</option>
                </select>
            </div>

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="exampleFormControlInput1"
                    placeholder="Enter Your Address" value="{{ $employees['address'] }}">
            </div>

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Salary</label>
                <input type="number" class="form-control" name="salary" id="exampleFormControlInput1" placeholder="50000TK"
                    value="{{ $employees['salary'] }}">
            </div>

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Birthday Date</label>
                <input type="date" class="form-control" name="birth_date" id="exampleFormControlInput1"
                    placeholder="Birthday-date" value="{{ $employees['birth_date'] }}">
            </div>

            <div class=" mb-3">
                <label for="exampleFormControlInput1" class="form-label">Join Date</label>
                <input type="date" class="form-control" name="join_date" id="exampleFormControlInput1"
                    placeholder="join-Date" value="{{ $employees['join_date'] }}">
            </div>
        </div>
    <div>
        <button type=" submit" class="btn btn-primary">update</button>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection
