@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer Details</h1>

        @if (auth()->user()->role == 'employee')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Customer
            </button>
        @endif
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-success table-striped table-bordered text-center">
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

            @foreach ($customers as $key => $data)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->customerEmployee->employeeDetail->email }}</td>
                    <td>{{ $data->contact_no }}</td>
                    <td class="text-start">{{ $data->address }}</td>
                    <td class="text-start">{{ $data->city }}</td>
                    <td>
                        @if (auth()->user()->role == 'admin')
                            <a class="text-danger mx-2" href={{ route('customers.delete', $data['id']) }}><i
                                    class="far fa-trash-alt"></i></a>
                        @endif
                        @if (auth()->user()->role == 'employee')
                            <a class="text-success mx-2" href={{ route('customers.edit', $data['id']) }}><i
                                    class="far fa-edit"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <!-- Vertically centered modal -->


        <!-- Vertically centered scrollable modal -->
        <!-- Button trigger modal -->

        @if (auth()->user()->role != 'admin')
            <!-- Modal -->
            <form method="post" action="{{ route('customers.create') }}">
                @csrf
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
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
                                        <option value="{{ auth()->user()->employeeProfile->id }}">
                                            {{ auth()->user()->email }}</option>
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
                                    <select class="form-select" name="city" aria-label="Default select example">
                                        <option selected>select City</option>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="khulna">khulna</option>
                                        <option value="Rajshahi">Rajshahi</option>
                                        <option value="Barisal">Barisal</option>
                                        <option value="Chittagong">Chittagong</option>
                                        <option value="Shylet">Shylet</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Mymensingh">Mymensingh</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ok</button>
                            </div>
            </form>
        @endif
    </div>
    </div>
    </div>
@endsection
