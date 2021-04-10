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
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">serial</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col" colspan="2">total amount</th>
                    <th scope="col" colspan="2">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>
                        <select class="form-select" name="product_id">
                            <option selected>Open this select menu</option>
                                <option value="1">E-cap</option>
                        </select>
                    </td>
                    <td>500</td>
                    <td colspan="2">1000Tk</td>
                    <td colspan="2">
                        <a class="btn btn-success">Add</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="2"></td>
                <td class="fw-bold">Total Product Quantity= 500 </td>
                <td colspan="3" class="fw-bold">Grand Total Amount= 1000Tk </td>
            </tfoot>
        </table>
        <div>
            <a href="" class="btn btn-primary">Submit</a>
        </div>
    </div>
@endsection
