@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success">Edit Product Information</h1>
    </div>

    {{-- modal --}}
    <div>

        <form method="POST" action="{{ route('products.update',$products['id'])}}">
            @csrf
            @method('PUT')
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Product Name:</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Product Name" value="{{$products['name']}}">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
                <input type="number" name="quantity" class="form-control"  placeholder="500" value="{{$products['quantity']}}">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Price</label>
                <input type="number" name="price" class="form-control"  placeholder="1000Tk" value="{{$products['price']}}">
            </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">update</button>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection
