@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Edit Product Categories Information</h1>
    </div>

    
<div class="px-5">

    <div class="p-5 bg-light border">

        <form method="POST" action="{{ route('productCategory.update',$productCategory['id'])}}">
            @csrf
            @method('PUT')
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label fw-bolder"">Category Name</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Product Category Name" value="{{$productCategory['name']}} ">
            </div>
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label  fw-bolder">Description</label>
                <textarea type="text" name="description" class="form-control"  placeholder=" Write description...">{{$productCategory['description']}}</textarea>
            </div>
            <div>
                <button type="submit" class="btn fw-bolder modal-submit" onclick="return confirm('Are you sure?')">Update</button>
                <a type="cancle" class="btn fw-bolder modal-cancel" href="{{route('products.categories')}}" >Cancle</a>
            </div>
        </form>
    </div>
</div>

@endsection
