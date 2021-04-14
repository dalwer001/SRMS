@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Task</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Task
        </button>
    </div>
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">serial</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Target Price</th>
                <th scope="col">Monthly Target quantity</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @foreach ($tasks as $key=>$data)
            <tbody>
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$data->employee->name}}</td>
                    <td>{{$data->product->name}}</td>
                    <td>{{$data->target_price}}</td>
                    <td>{{$data->target_quantity}}</td>
                    <td>{{$data->start_date}}</td>
                    <td>{{$data->end_date}}</td>
                    <td>
                        <a class="text-primary mx-2" href=""><i class="far fa-eye"></i></a>
                        <a class="text-danger mx-2" href=""><i class="far fa-trash-alt"></i></a>
                        <a class="text-success mx-2" href=""><i class="far fa-edit"></i></a>
                    </td>
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
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select" name="product_id">
                                    <option selected>Open this select menu</option>
                                    @foreach ($products as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Target Price</label>
                                <input type="number" name="target_price" class="form-control" id="exampleFormControlInput1"
                                    placeholder="5000TK">
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

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="exampleFormControlInput1"
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
