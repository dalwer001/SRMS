@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Sale Details</h1>
    </div>

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

    <div class="px-5">

        <div class="row py-3">
            <div class="col-md-4">
                <form action="{{ route('saleDetails.list') }}" method="GET">
                    @csrf
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            @if(auth()->user()->role == 'admin')
                            <input name="search" type="text" placeholder="Search by employee" 
                            class="form-control">
                            @else
                            <input name="search" type="text" placeholder="Search by customer" 
                            class="form-control">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn text-light btn-sm search-button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <table class="table  table-bordered text-center">
        <thead class="text-center table-header">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Invoice no.</th>
                @if(auth()->user()->role=='admin')
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                @endif
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody class="table-light">
            @foreach ($sales as $key=>$item)
            {{-- @dd($item->salesEmp->employeeDetail) --}}
            <tr>
                <th scope="row">{{$sales->firstItem()+$key}}</th>
                <td>{{$item->invoice_no}}</td>
                @if(auth()->user()->role=='admin')
                <td>{{$item->salesEmp->employeeDetail->name}}</td>
                <td>{{$item->salesEmp->employeeDetail->email}}</td>
                @endif
                <td>{{$item->customer->name}}</td>
                <td>{{$item->customer->email}}</td>
                <td>{{$item->total_amount}}BDT</td>
                <td>{{date("Y-M-d",strtotime($item->created_at))}}</td>
                <td>
                    @if(auth()->user()->role=='admin')
                    <a class="text-danger fs-5 mx-2" onclick="return confirm('Are you sure?')" href="{{route('salesDetails.delete',$item['id'])}}"><i class="far fa-trash-alt "></i></a>
                    @endif
                    <a class="text-primary fs-5 mx-2" href="{{ route('salesDetailsView.list', $item['id']) }}"><i class="far fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($search))
    <p>
    <span class="text-secondary">searching for '{{$search}}' , found '{{count($sales)}}' result.</span>
    </p>
    @endif
</div>
</div>
</div>
    <div class="d-flex justify-content-center ">
        {{ $sales->links()}}
    </div>
@endsection

