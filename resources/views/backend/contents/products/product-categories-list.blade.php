@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products Categories</h1>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Products Categories
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

    <table class="table table-success table-bordered table-striped ">
        <thead class="text-center">
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @foreach ($productCategories as $key=> $data)
            <tbody>
                <tr>
                    <th scope="row" class="text-center">{{ $key+1 }}</th>
                    <td class="text-center">{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td class="text-center">
                        <a class="text-danger mx-2" href={{ route('productCategory.delete', $data['id']) }}><i
                                class="far fa-trash-alt"></i></a>
                        <a class="text-success mx-2" href="#"><i class="far fa-edit"></i></a>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>

    {{-- modal --}}
    <div>
        <form method="post" action="{{ route('productCategory.create') }}">
            @csrf
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Product Categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Categories Name</label>
                                <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Product Category Name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Description</label>
                                <textarea type="text" name="description" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Write description"></textarea>
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
