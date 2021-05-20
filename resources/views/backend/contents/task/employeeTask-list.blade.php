@extends('backend.main')
@section('content')
{{-- @dd($employee); --}}

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 title">{{auth()->user()->name}} Tasks</h1>
</div>

<div class="px-5">
    <table class="table table-bordered text-center">
        <thead class="text-center table-header">
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
            <tbody class="bg-light">
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
</div>
@endsection
