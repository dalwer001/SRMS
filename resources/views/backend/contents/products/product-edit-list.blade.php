@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success">Edit Product Information</h1>
    </div>

    {{-- modal --}}
    <div class="p-5">

        <form method="POST" action="{{ route('products.update',$products['id'])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label fw-bolder"">Product Name</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Product Name" value="{{$products['name']}} " readonly>
            </div>

            <div class="form-group">
                <label class="fw-bolder">Image</label>
                <br>
                <img style="width: 150px;" class="mb-2" src="{{url('/files/product/'.$products->image)}}" alt="">
                <input name="product_image" type="file" class="form-control" value="{{ $products['product_image'] }}" src="" id="">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label  fw-bolder"">Product Quantity</label>
                <input type="number" name="quantity" class="form-control"  placeholder="500" value="{{$products['quantity']}}">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label  fw-bolder">Price</label>
                <input type="double" name="unit_price" class="form-control"  placeholder="5BDT" value="{{$products['unit_price']}}">
            </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">update</button>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection
