@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sales Details</h1>
    </div>
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th scope="col">E_ID</th>
                <th scope="col">Employee_Name</th>
                <th scope="col">Product</th>
                <th scope="col">Target</th>
                <th scope="col">Total Sold Price</th>
                <th scope="c_ol">Total product Sold</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Rishad</td>
                <td>P32569</td>
                <td>1000</td>
                <td>50000TK</td>
                <td>5000</td>
                <td>Active</td>
            </tr>

        </tbody>
    </table>
@endsection
