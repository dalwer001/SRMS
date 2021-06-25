@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Products </h1>
        <button type="button" class="btn add-btn fw-bolder" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-plus-square add-icon"></i> Products
        </button>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="px-5">
        <div class="row ">
            <div class="dropdown mb-3 d-flex justify-content-end">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Categories List
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    <a class="dropdown-item" href="{{ route('products.list') }}">All Product</a>

                    @foreach ($categories as $category)

                        <a class="dropdown-item"
                            href="{{ route('products.list', ['category_id' => $category->id]) }}">{{ $category->name }}</a>

                    @endforeach
                    {{-- @dd($products) --}}
                </ul>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-md-4">
                <form action="{{ route('products.list') }}" method="GET">
                    @csrf
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <input name="search" type="text" placeholder="Search by product" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn text-light btn-sm search-button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered text-center">
            <thead class="text-center table-header">
                <tr>
                    <th scope="col">serial</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Generic Name</th>
                    <th scope="col">Product Category</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</t>
                </tr>
            </thead>
            @foreach ($products as $key => $data)
                <tbody class="table-light">
                    <tr>
                        <th scope="row">{{$products->firstItem()+$key}}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->generic }}</td>
                        <td>{{ $data->productCategory->name }}</td>
                        <td>
                            <img style="width: 80px;height:80px" src="{{ url('/files/product/' . $data->image) }}" alt="">
                        </td>
                        <td>{{ $data->quantity }}Qty</td>
                        <td>{{ $data->unit_price }}BDT</td>
                        <td>
                            {{ $data->status }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    select status
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @if ($data->status == 'Active')
                                        <li><a class="dropdown-item"
                                                href="{{ route('status.update', ['id' => $data->id, 'status' => 'Inactive']) }}">Inactive</a>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item"
                                                href="{{ route('status.update', ['id' => $data->id, 'status' => 'Active']) }}">Active</a>
                                        </li>
                                    @endif
                                </ul>
                                <a class="text-danger fs-5 mx-2" onclick="return confirm('Are you sure?')"
                                    href={{ route('products.delete', $data['id']) }}><i class="far fa-trash-alt"></i></a>
                                <a class="text-success fs-5 mx-2" href={{ route('products.edit', $data['id']) }}><i
                                        class="far fa-edit"></i></a>
                            </div>

                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        @if (isset($search))
        <p class="text-secondary">
        <span >searching for '{{$search}}', found '{{count($products)}}' results</span>
        </p>
        @endif
    </div>
    {{-- modal --}}
    <div>
        <form method="post" action="{{ route('products.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    placeholder="Product Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Generic Name</label>
                                <input type="text" name="generic" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Generic Name" required>
                            </div>



                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Category</label>
                                <select class="form-select" name="category_id">
                                    <option value="">Open this select menu</option>
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
                                    placeholder="500Qty." required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Unit Price</label>
                                <input type="double" name="unit_price" class="form-control" id="exampleFormControlInput1"
                                    placeholder="5BDT" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn modal-cancel text-white fw-bolder"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn modal-submit text-white fw-bolder">Ok</button>
                        </div>
        </form>
    </div>
</div>
</div>
    <div class="d-flex justify-content-center ">
        {{$products->links()}}
    </div>
@endsection
