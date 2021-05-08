@extends('backend.main')
@section('content')



    {{-- @dd($sale->salesEmp->employeeDetail->employeeProfile->contact_no) --}}
<div id="printableArea">

    <div class=" d-flex justify-content-between mb-2 mt-3">
        <h4 class="text-danger">Date: {{date("Y-M-d",strtotime($sale->created_at))}}</h4>
        <h3 class="text-primary">INVOICE #{{ $sale->invoice_no }}</h3>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-left border p-3">

            <h3 class="border-bottom text-info">Customer Info</h3>
            <h5>{{ $sale->customer->name }}</h5>
            <p><b>Mobile :</b> +88{{ $sale->customer->contact_no }}</p>
            <p><b>Email :</b> {{ $sale->customer->email }}</p>
            <p><b>Address :</b> {{ $sale->customer->address }}</p>

    </div>






    <div class="mb-3 py-3">
        <table class="table table-bordered mb-2 border-success">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Product Unit Price</th>
                    <th>Product Sub Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($saleDetails as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="col-md-3">{{ $item->productDetails->name }}</td>
                        <td class="col-md-3"> {{ $item->quantity }}</td>
                        <td class="col-md-3"> {{ $item->unit_price }}</td>
                        <td class="col-md-3"> {{ $item->subtotal }} BDT</td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <strong>Total Amount = </strong>
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


    <div class="col-xs-6 col-sm-12 col-md-6  border p-3">

        <h3 class="border-bottom text-info">Sales By</h3>
        <h5> <strong>Name:</strong> {{ $sale->salesEmp->employeeDetail->name }}</h5>
        <p> <strong>Mobile No:</strong> +88{{ $sale->salesEmp->employeeDetail->employeeProfile->contact_no }}</p>
        <p> <strong> Email: </strong>{{ $sale->salesEmp->employeeDetail->email }}</p>
        <p> <strong>Address: </strong> {{ $sale->salesEmp->employeeDetail->employeeProfile->address }}</p>

    </div>
</div>

    <div class=" d-flex justify-centent-end">
        <button class="btn btn-success mt-2" style="width: 120px" onclick="printDiv('printableArea')" >Print</button>
    </div>





@endsection
