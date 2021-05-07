@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Task</h1>

        @if (auth()->user()->role == 'admin')
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Task
            </button>
        @endif

    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('error-message'))
        <div class="alert alert-danger">
            {{ session()->get('error-message') }}
        </div>
    @endif


    <table class="table table-secondary table-bordered table-striped text-center">
        <thead>
            <tr>
                <th scope="col">serial</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Product Name</th>
                <th scope="col">Total Price</th>
                <th scope="col">Target quantity</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>

                @if (auth()->user()->role == 'admin')
                    <th scope="col">Action</th>
                @endif

            </tr>
        </thead>
        @foreach ($tasks as $key => $data)
            <tbody>
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $data->employee->employeeDetail->name }}</td>
                    <td>{{ $data->employee->employeeDetail->email }}</td>
                    <td>{{ $data->product->name }}</td>
                    <td>{{ $data->total_price }} BDT</td>
                    <td>{{ $data->target_quantity }}</td>
                    <td>{{date("Y-M-d",strtotime($data->start_date)  )}}</td>
                    <td>{{date("Y-M-d",strtotime($data->end_date ) )}}</td>

                    @if (auth()->user()->role == 'admin')
                        <td>
                            <a class="text-danger mx-2" href=""><i class="far fa-trash-alt"></i></a>
                            <a class="text-success mx-2" href=""><i class="far fa-edit"></i></a>
                        </td>
                    @endif
                </tr>
            </tbody>
        @endforeach

    </table>

    <div>
        <form method="post" action="{{ route('tasks.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Employee Name</label>
                                <select class="form-select" name="employee_id">
                                    <option selected>Open this select menu</option>
                                    @foreach ($employees as $data)
                                        <option value="{{ $data->id }}">{{ $data->employeeDetail->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select" name="product_id">
                                    <option selected>Open this select menu</option>
                                    
                                    @foreach ($products as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}-{{$data->quantity}} Qty</option>
                                    @endforeach
                                </select>
                                {{-- @dd($data); --}}

                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Target Product Quantity</label>
                                <input type="number" name="target_quantity" class="form-control"
                                    id="exampleFormControlInput1" placeholder="500">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="exampleFormControlInput1"
                                    placeholder="12-05-2021">
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                        </div>
        </form>
    </div>
@endsection
