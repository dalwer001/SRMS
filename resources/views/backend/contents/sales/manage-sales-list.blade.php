@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage sale</h1>
    </div>
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Invoice no.</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Product</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Email</th>
                <th scope="col">Mobile No</th>
                <th scope="col">Total product Sold</th>
                <th scope="col">Total Sold Price</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>1101</td>
                <td>Rishad</td>
                <td>rishad@gmail.com</td>
                <td>E-cap</td>
                <td>Arob</td>
                <td>arob@gmail.com</td>
                <td>01322556222</td>
                <td>1000</td>
                <td>4000TK</td>
                <td>04-22-2021</td>
                <td>
                    <a class="btn btn-primary" href="#">View</a>
                    <a class="btn btn-danger" href="#">Delete</a>
                    <a class="btn btn-warning" href="#">Edit</a>
                </td>
            </tr>

        </tbody>
    </table>
@endsection

