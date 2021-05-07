@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products Details</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Products
        </button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success-message'))
        <div class="alert alert-success">
            {{ session()->get('success-message') }}
        </div>
    @endif
{{-- 
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('product.search')}}" method="POST">
                @csrf
            <input name="search" type="text" placeholder="Search" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

    </div> --}}

    {{-- @if(isset($search))
        <p>
        <span class="alert alert-success"> you are searching for '{{$search}}' , found ({{count($product)}})</span>
        </p>
    @endif --}}

        <div class="dropdown mb-3 d-flex justify-content-end">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Categories List
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                <a class="dropdown-item" href="{{route('products.list')}}">All Product</a>

                @foreach ($categories as $category)

                <a class="dropdown-item" href="{{route('products.list',['category_id'=>$category->id])}}">{{$category->name}}</a>

                @endforeach
            {{-- @dd($products) --}}
            </ul>
        </div>



    <table class="table table-success table-bordered table-striped text-center">
        <thead>
            <tr>
                <th scope="col">serial</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Action</t>
            </tr>
        </thead>
        @foreach ($products as $key => $data)
            <tbody>
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->productCategory->name }}</td>
                    <td>
                        <img style="width: 100px;height:100px" src="{{ url('/files/product/' . $data->image) }}" alt="">
                    </td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->unit_price }} BDT</td>
                    <td>
                        <a class="text-danger mx-2" href={{ route('products.delete', $data['id']) }}><i
                                class="far fa-trash-alt"></i></a>
                        <a class="text-success mx-2" href={{ route('products.edit', $data['id']) }}><i
                                class="far fa-edit"></i></a>
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
                                    placeholder="Product Name">
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
                                <label for="exampleFormControlInput1" class="form-label">Unit Price</label>
                                <input type="double" name="unit_price" class="form-control" id="exampleFormControlInput1"
                                placeholder="1000BDT">
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

    <div class="d-flex justify-content-center ">
        {{ $products->links()}}
    </div>
@endsection
