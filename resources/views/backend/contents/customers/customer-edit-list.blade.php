@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-success">Edit Customer Information</h1>
    </div>


    <div>

        <form method="POST" action="{{ route('customers.update', $customers['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Customers Name</label>
                <input type="text" name="name" class="form-control" placeholder="Customer Name"
                    value="{{ $customers['name'] }}">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Customers Email</label>
                <input type="email" name="email" class="form-control" placeholder="Customer Email"
                    value="{{ $customers['email'] }}">
            </div>

            <div class="mb-3 form-group">
                <label for="exampleFormControlInput1" class="form-label">Contact No</label>
                <input type="text" name="contact_no" class="form-control" placeholder="01763956456"
                    value="{{ $customers['contact_no'] }}">
            </div>

            <div class="mb-3">
<<<<<<< HEAD
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="exampleFormControlInput1"
                placeholder="write your address" value="{{ $customers['address']}}"></input>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="exampleFormControlInput1"
                    placeholder="write your address" value="{{ $customers['city'] }}">
=======
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="exampleFormControlInput1"
                    placeholder="write your address" value="{{$customers['city']}}">
>>>>>>> e49002b14e5cf9513fed40bd27636051b544517a
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
