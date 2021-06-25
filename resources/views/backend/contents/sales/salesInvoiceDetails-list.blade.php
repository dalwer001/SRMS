@extends('backend.main')
@section('content')



    {{-- @dd($sale->salesEmp->employeeDetail->employeeProfile->contact_no) --}}
<div id="printableArea">

    <div class=" d-flex justify-content-between mb-2 mt-3">
        <h4 class="text-primary">Date: {{date("Y-M-d",strtotime($sale->created_at))}}</h4>
        <h3 class="invoice">INVOICE #{{ $sale->invoice_no }}</h3>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-left bg-light border p-3">

            <h3 class="border-bottom  title">Customer Info</h3>
            <h5>{{ $sale->customer->name }}</h5>
            <p><b>Mobile :</b> +88{{ $sale->customer->contact_no }}</p>
            <p><b>Email :</b> {{ $sale->customer->email }}</p>
            <p><b>Address :</b> {{ $sale->customer->address }}</p>

    </div>






    <div class=" py-3">
        <table class="table table-bordered mb-2 mt-2 text-center">
            <thead class="text-center table-header">
                <tr>
                    <th>Serial</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Sub Total</th>
                </tr>
            </thead>

            <tbody class="table-light">
                @foreach ($saleDetails as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="col-md-3">{{ $item->productDetails->name }}</td>
                        <td class="col-md-3"><img style="width: 80px;height:80px" src="{{ url('/files/product/' . $item->productDetails->image) }}" alt=""></td>
                        <td class="col-md-3"> {{ $item->quantity }}</td>
                        <td class="col-md-3"> {{ $item->unit_price }}</td>
                        <td class="col-md-3"> {{ $item->subtotal }} BDT</td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <strong class="d-flex justify-content-end">Total Amount = </strong>
                    </td>
                    <td>
                        <p>
                            <strong> {{ $sale->total_amount }} BDT</strong>
                        </p>
                    </td>
                </tr>

            </tfoot>
        </table>
    </div>


    <div class="col-xs-6 col-sm-12 col-md-12 bg-light  border p-3">

        <h3 class="border-bottom  title">Sales By</h3>
        <h5> {{ $sale->salesEmp->employeeDetail->name }}</h5>
        <p> <strong>Mobile No:</strong> +88{{ $sale->salesEmp->employeeDetail->employeeProfile->contact_no }}</p>
        <p> <strong> Email: </strong>{{ $sale->salesEmp->employeeDetail->email }}</p>
        {{-- <p> <strong>Address: </strong> {{ $sale->salesEmp->employeeDetail->employeeProfile->address }}</p> --}}

    </div>
</div>

    <div class=" d-flex justify-centent-end">
        <button class="btn mt-2 modal-submit fw-bolder text-light " style="width: 120px" onclick="printDiv('printableArea')" >Print</button>
    </div>

@endsection
