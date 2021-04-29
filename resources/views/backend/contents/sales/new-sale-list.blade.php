@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New sale</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <select class="form-select" name="customer_id">
                        <option selected>Open this select email</option>
                        <option value="1">minaj@gmail.com</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="inputPassword3">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Contact No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Invoice No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" readonly>
                </div>
            </div>
        </div>
    </div>
    {{-- add product for sale --}}
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Products
        </button>
    </div>

    <div class="col-md-12 mt-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">serial</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col" colspan="2">total amount</th>
                    <th scope="col" colspan="2">Handle</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th scope="row">1</th>
                    <td>E-cap</td>
                    <td>500</td>
                    <td>2.5BDT</td>
                    <td colspan="2">1000BDT</td>
                    <td colspan="2">
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="2"></td>
                <td colspan="2" class="fw-bold">Total sold Product Quantity= 500 </td>
                <td colspan="3" class="fw-bold">Grand Total Amount= 1000BDT </td>
            </tfoot>
        </table>
        <div>
            <a href="" class="btn btn-primary">Submit</a>
        </div>
    </div>


    <div>
        <form method="post" action="{{route('saleProduct.create')}}">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select" name="product_id">
                                    <option selected>Product Name</option>
                                    @foreach ($task as $data)
                                    <option value="{{$data->product_id}}">{{$data->product->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="exampleFormControlInput1"
                                    placeholder="500">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
