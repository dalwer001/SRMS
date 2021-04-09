@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sale Summary</h1>
    </div>
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Email</th>
                <th scope="col">Daily Target</th>
                <th scope="col">Current sale</th>
                <th scope="col">Sale leftover</th>
                <th scope="col">Montly sale leftover</th>
                <th scope="col">Total product Sold</th>
                <th scope="col">Total Sold Price</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Rishad</td>
                <td>rishad@gmail.com</td>
                <td>500</td>
                <td>200</td>
                <td>300</td>
                <td>3500</td>
                <td>1000</td>
                <td>4000TK</td>
                <td>Active</td>
                <td>
                    <a class="btn btn-primary" href="#">View</a>
                    <a class="btn btn-danger" href="#">Delete</a>
                    <a class="btn btn-warning" href="#">Edit</a>
                </td>
            </tr>

        </tbody>
    </table>
@endsection
