@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">New sale</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Name</label>
                <div class="col-sm-10">
                    <input type="text" name="customer_name" class="form-control" id="customer_name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <select class="form-select" name="customer_id" id="customer_id">
                        <option selected>select Customer email</option>
                        @foreach ($customer as $data)
                            <option value="{{ $data->id }}">{{ $data->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Contact No.</label>
                <div class="col-sm-10">
                    <input type="text" name="contact_no" class="form-control" id="customer_phone">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Invoice No.</label>
                <div class="col-sm-10">
                    <input type="text" name="invoice_no" id="invoice_no" class="form-control">
                </div>
            </div>
        </div>
    </div>
    {{-- add product for sale --}}
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Products
        </button>
    </div>

    <div class="col-md-12 mt-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">serial</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col" colspan="2">total amount</th>
                    <th scope="col" colspan="2">Handle</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th scope="row">1</th>
                    <td id="product_name">E-cap</td>
                    <td>500</td>
                    <td>2.5BDT</td>
                    <td colspan="2">1000BDT</td>
                    <td colspan="2">
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="2"></td>
                <td colspan="2" class="fw-bold">Total sold Product Quantity= 500 </td>
                <td colspan="3" class="fw-bold">Grand Total Amount= 1000BDT </td>
            </tfoot>
        </table>
        <div>
            <a href="" class="btn btn-primary">Submit</a>
        </div>
    </div>


    <div>
        {{-- method="post" action="{{ route('saleProduct.create') }}" --}}
        <form>
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select" name="product_id" id="product_id">
                                    <option selected>Product Name</option>
                                    @foreach ($task as $data)
                                        <option value="{{ $data->product_id }}">{{ $data->product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="exampleFormControlInput1"
                                    placeholder="500">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id='addBtn'>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <ul id="myUL">

    </ul>
@endsection

@push('customer_js')
    <script>
        let customer_id = document.querySelector('#customer_id');
        let customer_name = document.querySelector('#customer_name');
        let customer_phone = document.querySelector('#customer_phone');
        let invoice_no = document.querySelector('#invoice_no');
        let product_id = document.querySelector('#product_id');


        customer_id.addEventListener('change', (e) => {
            let id = e.target.value;

            const url = "{{ url('get-customer') }}/" + id;
            fetch(url)
                .then(res => res.json())
                .then(res => {
                    customer_name.value = res.data.name;
                    customer_phone.value = res.data.contact_no;
                    invoice_no.value = res.invoice_no;
                })
        })

    


    </script>
@endpush
