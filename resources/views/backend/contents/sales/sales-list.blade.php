@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sales Details</h1>
    </div>
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Employee_ID</th>
                <th scope="col">Employee_Name</th>
                <th scope="col">Product</th>
                <th scope="col">Fillup Selling Target</th>
                <th scope="col">Total Selling Price</th>
                <th scope="c_ol">Total Sold</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>35268</td>
                <td>Rishad</td>
                <td>P32569</td>
                <td>36</td>
                <td>50000TK</td>
                <td>5000</td>
                <td>Active</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>635268</td>
                <td>Anik</td>
                <td>P36959</td>
                <td>39</td>
                <td>60000TK</td>
                <td>6500</td>
                <td>Active</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>455268</td>
                <td>Arob</td>
                <td>P32569</td>
                <td>105</td>
                <td>90000TK</td>
                <td>8000</td>
                <td>Offline</td>
            </tr>
        </tbody>
    </table>
@endsection
