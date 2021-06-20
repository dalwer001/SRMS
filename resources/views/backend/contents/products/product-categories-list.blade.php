@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Products Categories</h1>
        <button type="button" class="btn add-btn fw-bolder"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fas fa-plus-square add-icon"></i> Products Categories
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
    <div class="py-3">
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('products.categories')}}" method="GET">
                @csrf
                <div class="row d-flex align-items-center">
                    <div class="col-md-6">
                        <input name="search" type="text" placeholder="Search by category" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn text-light btn-sm search-button">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

    <table class="table table-bordered ">
        <thead class="text-center table-header">
        <tr>
                <th scope="col" >Serial</th>
                <th scope="col" >Category Name</th>
                <th scope="col" >Description</th>
                <th scope="col" >Action</th>
            </tr>
        </thead>
        @foreach ($categories as $key => $data)
            <tbody class="table-light">
                <tr>
                    <th scope="row" class="text-center">{{ $categories->firstItem()+$key }}</th>
                    <td class="text-center">{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td class="text-center">
                        <a class="text-danger fs-5  mx-2" onclick="return confirm('Are you sure?')" href={{ route('productCategory.delete', $data['id']) }}><i
                                class="far fa-trash-alt"></i></a>
                        <a class="text-success  fs-5 mx-2" href="{{route('productCategory.edit',$data['id'])}}"><i class="far fa-edit"></i></a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
    @if (isset($search))
    <p class="text-seconadry">
    <span>searching for '{{$search}}' found '{{count($categories)}}' results</span>
    </p>
    @endif
</div>

    {{-- modal --}}
    <div>
        <form method="post" action="{{ route('productCategory.create') }}">
            @csrf
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header modal-header">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Add New Product Categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label fw-bolder">Category Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Product Category Name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label fw-bolder">Description</label>
                                <textarea type="text" name="description" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Write description..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn modal-cancel text-white fw-bolder" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn fw-bolder text-center text-white modal-submit" >Ok</button>
                        </div>
        </form>
    </div>
</div>
</div>
    <div class="d-flex justify-content-center ">
        {{ $categories->links() }}
    </div>
@endsection
