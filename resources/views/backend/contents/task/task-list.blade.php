@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daily Task</h1>
        <button class="btn btn-success">Add Tasks</button>
    </div>
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Employee_ID</th>
                <th scope="col">Employee_Name</th>
                <th scope="col">Product_ID</th>
                <th scope="col">Target Price</th>
                <th scope="col">Target quantity</th>
                <th scope="col">Selling quantity</th>
                <th scope="col">Left quantity </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>35268</td>
                <td>Rishad</td>
                <td>P32569</td>
                <td>5000TK</td>
                <td>1000</td>
                <td>500</td>
                <td>500</td>
                <td>
                    <button class="btn btn-primary">View</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-warning">Edit</button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>635268</td>
                <td>Anik</td>
                <td>P36959</td>
                <td>1000TK</td>
                <td>3000</td>
                <td>1200</td>
                <td>1800</td>
                <td>
                    <button class="btn btn-primary">View</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-warning">Edit</button>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>455268</td>
                <td>Arob</td>
                <td>P32569</td>
                <td>10000TK</td>
                <td>3000</td>
                <td>2000</td>
                <td>1000</td>
                <td><button class="btn btn-primary">View</button>
                    <button class="btn btn-danger">Delete</button>
                    <button class="btn btn-warning">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
