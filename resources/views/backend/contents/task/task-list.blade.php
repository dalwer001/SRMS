@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Tasks</h1>

        @if (auth()->user()->role == 'admin')
            <button type="button" class="btn add-btn fw-bolder" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-plus-square add-icon"></i> Task
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
            <form action="{{ route('tasks.list') }}" method="GET">
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
                <th scope="col">serial</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Image</th>
                <th scope="col">Total Price</th>
                <th scope="col">Target quantity</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Status</th>

                @if (auth()->user()->role == 'admin')
                    <th scope="col">Action</th>
                @endif

            </tr>
        </thead>
        @foreach ($tasks as $key => $data)
            <tbody class="bg-light">
                <tr>
                    <th scope="row">{{$tasks->firstItem()+$key}}</th>
                    <td>{{ $data->employee->employeeDetail->name }}</td>
                    <td>{{ $data->employee->employeeDetail->email }}</td>
                    <td>{{ $data->product->name }}</td>
                    <td><img style="width: 80px;height:80px" src="{{ url('/files/product/' . $data->product->image) }}" alt=""></td>
                    <td>{{ $data->total_price }}BDT</td>
                    <td>{{ $data->target_quantity }}Qty</td>
                    <td>{{ date('Y-M-d', strtotime($data->start_date)) }}</td>
                    <td>{{ date('Y-M-d', strtotime($data->end_date)) }}</td>
                    <td>{{$data->status}}</td>
                        <td>
                            @if($data->status=='pending')
                            <a class="text-danger fs-5 mx-2" onclick="return confirm('Are you sure?')" href="{{ route('tasks.delete', $data['id']) }}"><i class="far fa-trash-alt"></i></a>
                            @elseif($data->status=='complete')
                                <a href="" class="btn btn-outline-success">Task Completed Successfully</a>
                            @else
                                <a href="" class="btn btn-outline-primary">Task is processing</a>
                            @endif

                        </td>
                </tr>
            </tbody>
        @endforeach

    </table>
    @if (isset($search))
    <p class="text-secondary">
        <span>searching for '{{ $search }}' found '{{ count($tasks) }}' results</span>
    </p>
@endif
</div>
    <div>
        <form method="post" action="{{ route('tasks.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <option value="">Open this select Employee</option>
                                    @foreach ($employees as $data)
                                        <option value="{{ $data->id }}">{{ $data->employeeDetail->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select " name="product_id">
                                    <option value="">Open this select product</option>

                                    @foreach ($products as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}-{{ $data->generic }}-{{ $data->quantity }} Qty
                                        </option>
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
                                <input type="date" name="start_date" class="form-control" id="exampleFormControlInput1" min="{{date('Y-m-d')}}"
                                    placeholder="12-05-2021">
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
    {{$tasks->links()}}
</div>

@endsection
