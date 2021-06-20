@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Edit Customer Information</h1>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    <div class="px-5">

        <div class="p-5 bg-light border">

            <form method="POST" action="{{ route('customers.update', $customers['id']) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 form-group">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Customers Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Customer Name"
                        value="{{ $customers['name'] }}">
                </div>

                <div class="mb-3 form-group">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Customers Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Customer Email"
                        value="{{ $customers['email'] }}">
                </div>

                <div class="mb-3 form-group">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Contact No</label>
                    <input type="text" name="contact_no" class="form-control" placeholder="01763956456"
                        value="{{ $customers['contact_no'] }}">
                </div>

                <div class="mb-3">

                    <label for="exampleFormControlInput1" class="form-label fw-bolder">Address</label>
                    <textarea type="text" name="address" class="form-control" id="exampleFormControlInput1"
                        placeholder="write your address">{{ $customers['address'] }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-bolder">City</label>
                    <select class="form-select" name="city" aria-label="Default select example">
                        @if ($customers['city'])
                            <option value="{{ $customers['city'] }}" selected>{{ $customers['city'] }}</option>
                            {{-- @else --}}
                            <option value="Dhaka">Dhaka</option>
                            <option value="khulna">khulna</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Mymensingh">Mymensingh</option>
                        @endif
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn fw-bolder modal-submit"
                        onclick="return confirm('Are you sure?')">Update</button>
                    <a type="cancle" class="btn fw-bolder modal-cancel" href="{{ route('customers.list') }}">Cancle</a>
                </div>
            </form>
        </div>
    </div>
@endsection
