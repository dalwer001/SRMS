@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Edit Employee Information</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    {{-- modal --}}
    <div class="px-5">

        <div class="p-5 bg-light border">

            <form method="POST" action="{{ route('employees.update', $employees['id']) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Employee Name</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Employee Name" value="{{ $users['name'] }}">
                </div>

                <div class="form-group">
                    <label class="fw-bolder">Image</label>
                    <br>
                    <img style="width: 150px;" class="mb-2" src="{{ url('/files/employee/' . $employees->image) }}"
                        alt="">
                    <input name="product_image" type="file" class="form-control"
                        value="{{ $employees['employee_image'] }}" src="" id="">
                </div>

                {{-- <div class="mb-3">
                <label for="">Upload Image</label>
                <input name="employee_image" type="file" class="form-control" value="{{$employee['image']}}">
            </div> --}}

                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="Employee email" value="{{ $users['email'] }}">
                </div>

                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Contact Number</label>
                    <input type="text" name="contact_no" class="form-control" id="exampleFormControlInput1"
                        placeholder="01785496362" value="{{ $employees['contact_no'] }}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="{{ $employees['gender'] }}" selected>{{ $employees['gender'] }}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Address</label>
                    <textarea type="text" name="address" class="form-control" id="exampleFormControlInput1"
                        placeholder="Enter Your Address">{{ $employees['address'] }}</textarea>
                </div>

                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Salary</label>
                    <input type="number" class="form-control" name="salary" id="exampleFormControlInput1"
                        placeholder="50000TK" value="{{ $employees['salary'] }}">
                </div>

                <div class=" mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Birthday Date</label>
                    <input type="date" class="form-control" name="birth_date" id="exampleFormControlInput1"
                        placeholder="Birthday-date" value="{{ $employees['birth_date'] }}">
                </div>

                <div>
                    <button type="submit" class="btn fw-bolder modal-submit"
                        onclick="return confirm('Are you sure?')">Update</button>
                    <a type="cancle" class="btn fw-bolder modal-cancel" href="{{ route('employees.list') }}">Cancle</a>
                </div>
            </form>

        </div>

    </div>

@endsection
