@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products Details</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Products
        </button>
    </div>
    @if (session()->has('success-message'))
        <div class="alert alert-success">
            {{ session()->get('success-message') }}
        </div>
    @endif
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">serial</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        @foreach ($products as $key => $data)
            <tbody>
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->productCategory->name }}</td>
                    <td>
                        <img style="width: 100px;" src="{{ url('/files/product/' . $data->image) }}" alt="">
                    </td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->price }}Tk</td>
                    <td>
                        <a class="btn btn-primary" href="#">View</a>
                        <a class="btn btn-danger" href={{ route('products.delete', $data['id']) }}>Delete</a>
                        <a class="btn btn-warning" href={{ route('products.edit', $data['id']) }}>Edit</a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>

    {{-- modal --}}
    <div>
        <form method="post" action="{{ route('products.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Product Name" >
                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Category</label>
                                <select class="form-select" name="category_id">
                                    <option selected>Open this select menu</option>
                                    @foreach ($categories as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="">Upload Image</label>
                                <input name="product_image" type="file" class="form-control">
                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="exampleFormControlInput1"
                                    placeholder="500">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="exampleFormControlInput1"
                                    placeholder="1000Tk">


                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ok</button>
                        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
