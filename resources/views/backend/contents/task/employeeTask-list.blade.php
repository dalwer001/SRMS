@extends('backend.main')
@section('content')
{{-- @dd($employee); --}}

    
        <div class="col-md-6  mt-5 mb-5 px-2 py-5 border">
            <h5 class="text-primary">Name: <small class="text-dark ">{{auth()->user()->name}}</small></h5>
            <h5 class="text-primary">Email: <small class="text-dark ">{{auth()->user()->email}}</small></h5>
        </div>


    <table class="table table-success table-striped table-bordered shadow">
        <thead>
            <tr>
                <th scope="col">serial</th>
                <th scope="col">Product Name</th>
                <th scope="col">Total Price</th>
                <th scope="col">Target quantity</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>

            </tr>
        </thead>
        @foreach ($employee as $key => $data)
            <tbody>
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $data->product->name }}</td>
                    <td>{{ $data->total_price}} BDT</td>
                    <td>{{ $data->target_quantity}}</td>
                    <td>{{date("Y-M-d",strtotime($data->start_date) )}}</td>
                    <td>{{date("Y-M-d",strtotime($data->end_date ) )}}</td>
                </tr>
            </tbody>
        @endforeach

    </table>
@endsection
