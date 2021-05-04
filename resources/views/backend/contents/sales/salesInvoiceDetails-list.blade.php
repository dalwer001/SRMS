@extends('backend.main')
@section('content')



{{-- @dd($sale->salesEmp->employeeDetail->employeeProfile->contact_no) --}}
    <div class="row p-5 ">
        <div class="col-xs-6 col-sm-12 col-md-6 text-right">
            <div class="receipt-right">
                <h5>{{$sale->salesEmp->employeeDetail->name}}</h5>
                <p>+88{{$sale->salesEmp->employeeDetail->employeeProfile->contact_no}}</p>
                <p>{{$sale->salesEmp->employeeDetail->email}}</p>
                <p>{{$sale->salesEmp->employeeDetail->employeeProfile->address}}</p>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 text-left">
            <div class="receipt-right">
                <h5>{{$sale->customer->name}}</h5>
                <p><b>Mobile :</b> +88{{$sale->customer->contact_no}}</p>
                <p><b>Email :</b> {{$sale->customer->email}}</p>
                <p><b>Address :</b> {{$sale->customer->address}}</p>
            </div>
        </div>
    </div>


    <div class=" d-flex justify-content-end mb-2">
        <h3>INVOICE #{{$sale->invoice_no}}</h3>
    </div>


    <div class="mb-3 p-3">
        <table class="table table-bordered mb-2">
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
                @foreach ($saleDetails as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td class="col-md-3">{{$item->productDetails->name}}</td>
                    <td class="col-md-3"> {{$item->quantity}}</td>
                    <td class="col-md-3"> {{$item->unit_price}}</td>
                    <td class="col-md-3"> {{$item->subtotal}} BDT</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="4">
                            <strong>Total Amount = </strong>
                    </td>
                    <td>
                        <p>
                            <strong> {{$sale->total_amount}} BDT</strong>
                        </p>
                    </td>
                </tr>

            </tfoot>





        </table>
    </div>



@endsection
