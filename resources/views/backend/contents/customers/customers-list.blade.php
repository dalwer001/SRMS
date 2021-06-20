@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Customer</h1>

        @if (auth()->user()->role == 'employee')
            <button type="button" class="btn add-btn fw-bolder" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-plus-square add-icon"></i> Customer
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





    <div class="px-5">

        <div class="row py-3">
            <div class="col-md-4">
                <form action="{{ route('customers.list') }}" method="GET">
                    @csrf
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <input name="search" type="text" placeholder="Search by customer" class="form-control">
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
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    @if(auth()->user()->role=="admin")
                    <th scope="col">Employee Email</th>
                    @endif
                    <th scope="col">Contact No</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-light">

                @foreach ($customers as $key => $data)
                    <tr>
                        <th scope="row">{{ $customers->firstItem()+$key }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        @if(auth()->user()->role=="admin")
                        <td>{{ $data->customerEmployee->employeeDetail->email }}</td>
                        @endif
                        <td>{{ $data->contact_no }}</td>
                        <td class="text-start">{{ $data->address }}</td>
                        <td class="text-start">{{ $data->city }}</td>
                        <td>
                            @if (auth()->user()->role == 'admin')
                                <a class="text-danger fs-5 mx-2" onclick="return confirm('Are you sure?')"
                                    href={{ route('customers.delete', $data['id']) }}><i
                                        class="far fa-trash-alt"></i></a>
                            @endif
                            @if (auth()->user()->role == 'employee')
                                <a class="text-success fs-5 mx-2" href={{ route('customers.edit', $data['id']) }}><i
                                        class="far fa-edit"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            @if (isset($search))
                <p class="text-secondary">
                    <span>searching for '{{ $search }}' found '{{ count($customers) }}' results</span>
                </p>
            @endif
    </div>


    <div>
        <!-- Vertically centered modal -->


        <!-- Vertically centered scrollable modal -->
        <!-- Button trigger modal -->

        @if (auth()->user()->role != 'admin')
            <!-- Modal -->
            <form method="post" action="{{ route('customers.create') }}">
                @csrf
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <option value="Sylhet">Sylhet</option>
                                        <option value="Rangpur">Rangpur</option>
                                        <option value="Mymensingh">Mymensingh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn modal-cancel text-white fw-bolder"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn modal-submit text-white fw-bolder">Ok</button>
                            </div>
            </form>
        @endif
    </div>
</div>
</div>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
@endsection
