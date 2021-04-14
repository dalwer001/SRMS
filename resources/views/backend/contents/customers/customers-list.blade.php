@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer Details</h1>


        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Customer
        </button>


    </div>
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Contact No</th>
                <th scope="col">Address</th>
                <th scope="col">City</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $key=>$data)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{ $data->employee->email }}</td>
                    <td>{{$data->contact_no}}</td>
                    <td>{{$data->address}}</td>
                    <td>{{$data->city}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm">View</a>
                        <a class="btn btn-danger btn-sm"  href={{route('customers.delete',$data['id'])}}>Delete</a>
                        <a class="btn btn-warning btn-sm" href={{route('customers.edit',$data['id'])}}>Edit</a>
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
        <form method="post" action="{{ route('customers.create') }}">
            @csrf
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Customer Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Customer Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Customer Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Customer email" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Employee Email</label>
                                <select class="form-select" name="employee_id">
                                    <option selected>Open this select menu</option>
                                    @foreach ($employees as $data)
                                        <option value="{{ $data->id }}">{{ $data->email }}</option>
                                    @endforeach
                                </select>
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
                                <label for="exampleFormControlInput1" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="exampleFormControlInput1"
                                    placeholder="write your address" required>
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
