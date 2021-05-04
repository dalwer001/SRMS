@extends('backend.main')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-md-4 my-3">
            <div class="card bg-success text-white shadow" style="width: 20rem;height:10rem;">
                <div class="card-body">
                    <h5 class="text-center"> <small>Number of Product</small></h5>
                    <h1 class="text-center">{{$totalNumberofProduct}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-3">
            <div class="card bg-warning text-white shadow" style="width: 20rem; height:10rem">
                <div class="card-body">
                    <h5 class="text-center"> <small>Total Quantity of Product</small> </h5>
                    <h1 class="text-center">{{$quantity}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 my-3">
            <div class="card bg-primary text-white shadow" style="width: 20rem;height:10rem;">
                <div class="card-body">
                    <h5 class="text-center"> <small>Total Number of Employee</small> </h5>
                    <h1 class="text-center">{{$totalEmployee}}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-3">
            <div class="card bg-danger text-white shadow" style="width: 20rem;height:10rem;">
                <div class="card-body">
                    <h5 class="text-center"> <small>Total Number of Active Employee</small> </h5>
                    <h1 class="text-center">{{$activeEmployee}}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-3">
            <div class="card bg-info text-white shadow" style="width: 20rem;height:10rem;">
                <div class="card-body">
                    <h5 class="text-center"> <small>Total Customer</small> </h5>
                    <h1 class="text-center">{{$totalCustomer}}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-3">
            <div class="card bg-secondary text-white shadow" style="width: 20rem;height:10rem;">
                <div class="card-body">
                    <h5 class="text-center"> <small>Todays's Sale</small> </h5>
                    <h1 class="text-center">200</h1>
                </div>
            </div>
        </div>

    </div>


@endsection
