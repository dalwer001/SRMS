@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sale Details</h1>
    </div>
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Invoice no.</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $key=>$item)
            {{-- @dd($item->salesEmp->employeeDetail) --}}

            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$item->invoice_no}}</td>
                <td>{{$item->salesEmp->employeeDetail->name}}</td>
                <td>{{$item->salesEmp->employeeDetail->email}}</td>
                <td>{{$item->customer->name}}</td>
                <td>{{$item->customer->email}}</td>
                <td>{{$item->total_amount}}</td>
                <td>{{date("Y-M-d",strtotime($item->created_at))}}</td>
                <td>
                    <a class="text-primary mx-2" href="{{ route('salesDetailsView.list', $item['id']) }}"><i class="far fa-eye"></i></a>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
@endsection

