@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Report</h1>
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
    <div class="bg-light p-3">
        <form action="{{ route('sales.report') }}" method="GET">

            <div class="row mb-3">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="from" class="col-sm-2 col-form-label fw-bolder">Date from:</label>
                                <div class="col-sm-10">
                                    <input id="from" type="date" class="form-control" name="from_date" max="{{date('Y-m-d')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="to" class="col-sm-2 col-form-label fw-bolder">Date to:</label>
                                <div class="col-sm-10">
                                    <input id="to" type="date" class="form-control" name="to_date" max="{{date('Y-m-d')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class=" btn  modal-cancel text-white fw-bolder ">Search</button>
                    <button onclick="printDiv('printableArea')" class="btn modal-submit text-white fw-bolder"><span
                            data-feather="printer"></span>print</button>
                </div>
            </div>
        </form>
    </div>

    <div id="printableArea">
        @if (count($sales) > 0 )
        <h2 class="fw-bolder text-center mb-3 title">Sales Report</h2>
        @if (isset($fromDate) && $fromDate != '1970-01-01')
        <div>
            <p class="text-secondary">from: {{ date('M-d, Y', strtotime($fromDate)) }} to
                {{ date('M-d, Y', strtotime($toDate)) }}, Number of records: {{ count($sales) }}</p>
            <h3></h3>
        </div>
    @endif
        <table class="table table-bordered  text-center">
            <thead class="text-center table-header">
                <tr>
                    <th scope="col">Serial</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Employee Email</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="table-light">
                    @foreach ($sales as $key => $item)
                        {{-- @dd($item->productDetails->name ) --}}
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $item->sale->salesEmp->employeeDetail->name }}</td>
                            <td>{{ $item->sale->salesEmp->employeeDetail->email }}</td>
                            <td>{{ $item->sale->customer->name }}</td>
                            <td>{{ $item->sale->customer->email }}</td>
                            <td>{{ $item->productDetails->name }}</td>
                            <td>{{ $item->productDetails->unit_price }}BDT</td>
                            <td>{{ $item->quantity }}Qty</td>
                            <td>{{ $item->subtotal }}BDT</td>
                            <td>{{ date('Y-M-d', strtotime($item->created_at)) }}</td>
                        </tr>
                    @endforeach
                    
            </tbody>
            <tbody class="table-header">
                <td colspan="7"></td>
                <td colspan="1" class="fw-bold text-start">Total Quantity={{$t_quantity}}Qty</td>
                <td colspan="1" class="fw-bold text-start">Total Amount={{$total}}BDT</td>
                <td></td>
            </tbody>
        </table>
        @else
        @if (isset($fromDate) && $fromDate != '1970-01-01')
        <div>
            <p class="text-secondary">from: {{ date('M-d, Y', strtotime($fromDate)) }} to
                {{ date('M-d, Y', strtotime($toDate)) }}, Number of records: {{ count($sales) }}</p>
            <h3></h3>
        </div>
    @endif
            <div class="text-center text-danger fw-bolder fs-3" colspan="10">No data found!</div>
        @endif
    </div>

@endsection
