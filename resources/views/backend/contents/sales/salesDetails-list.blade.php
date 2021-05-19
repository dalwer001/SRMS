@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sale Details</h1>
    </div>

    {{-- <div class="row">
            <form action="{{route('saleDetails.search')}}" method="get">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-sm-10">
                            <input id="from_date" type="date" class="form-control" name="from_date" pleacholder="search by date">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div> 
                    </div>
                </form>
        </div> --}}


        @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <table class="table table-success table-bordered table-striped">
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
                <td>{{$item->total_amount}}BDT</td>
                <td>{{date("Y-M-d",strtotime($item->created_at))}}</td>
                <td>
                    @if(auth()->user()->role=='admin')
                    <a class="text-primary mx-2" onclick="return confirm('Are you sure?')" href="{{route('salesDetails.delete',$item['id'])}}"><i class="far fa-trash-alt "></i></a>
                    @endif
                    <a class="text-primary mx-2" href="{{ route('salesDetailsView.list', $item['id']) }}"><i class="far fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center ">
        {{ $sales->links()}}
    </div>
@endsection

