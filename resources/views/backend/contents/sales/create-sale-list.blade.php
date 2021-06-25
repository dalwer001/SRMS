@extends('backend.main')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Create Sale</h1>
    </div>

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

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

<div class="px-3">
    <form action="{{ route('productSold.list') }}" method="post">
        @csrf
        <input type="hidden" name="employee_id" value="{{ auth()->user()->employeeProfile->id }}">
        <input type="hidden" name="total_amount" value="{{ $s_total }}">
    <div class="p-3">
        <div class="row bg-light border p-3">
            <div class="col-md-6">
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label fw-bolder">Customer Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="customer_name" class="form-control" id="customer_name" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label fw-bolder">Email</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="customer_id" id="customer_id">
                            <option value="">select customer email</option>
                            @foreach ($customer as $data)
                                <option value="{{ $data->id }}">{{ $data->email }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label fw-bolder">Contact No</label>
                    <div class="col-sm-10">
                        <input type="text" name="contact_no" class="form-control" id="customer_phone" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label fw-bolder">Invoice No</label>
                    <div class="col-sm-10">
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- add product for sale --}}
    <div class="bg-light p-3 border">
        <div class="d-flex justify-content-start my-3">
            <button type="button" class="btn add-btn fw-bolder" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-plus-square add-icon"></i> Product
            </button>
        </div>

        <div class="col-md-12 mt-2">
            <table class="table table-bordered">
                <thead class="text-center table-header">
                    <tr>
                        <th scope="col">serial</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col" colspan="2">Sub Total</th>
                        <th scope="col" colspan="2">Handle</th>
                    </tr>
                </thead>
                {{-- @dd($sales) --}}
                @foreach ($sales as $key => $item)

                    <tbody class="text-center table-light">
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $item->p_name->name }}</td>
                            <td><img style="width: 80px;height:80px" src="{{ url('/files/product/' . $item->p_name->image) }}" alt=""></td>
                            <td>{{ $item->product_quantity }}Qty</td>
                            <td>{{ $item->unit_price }}BDT</td>
                            <td colspan="2">{{ $item->subtotal }}BDT</td>
                            <td colspan="2">
                                <a href={{ route('newSale.delete', $item['id']) }}><i class="far fa-trash-alt text-danger fs-5"></i></a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

                <tfoot>
                    <td colspan="3"></td>
                    <td colspan="2" class="fw-bold">Total Product Quantity= {{ $p_quantity }}Qty</td>
                    <td colspan="3" class="fw-bold"> Total Amount= {{ $s_total }}BDT</td>
                </tfoot>
            </table>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn fw-bolder modal-submit"
                        onclick="return confirm('Are you sure?')">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>

    <div>

        <form method="post" action="{{ route('saleProduct.create') }}">
            @csrf

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">

                                <input type="hidden" name="employee_id" class="form-control" id="exampleFormControlInput1"
                                    placeholder="500" value={{ auth()->user()->employeeProfile->id }}>
                        </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                <select class="form-select" name="product_id">
                                    <option value=''>Select product</option>
                                    @foreach ($task as $data)
                                        <option value="{{ $data->product_id }}">{{ $data->product->name }}-{{ $data->product->generic }}
                                            {{ $data->target_quantity }}Qty</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Quantity</label>
                                <input type="number" name="product_quantity" class="form-control"
                                    id="exampleFormControlInput1" placeholder="500">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modal-cancel text-white fw-bolder" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn modal-submit text-white fw-bolder">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@push('customer_js')
    <script>
        let customer_id = document.querySelector('#customer_id');
        let customer_name = document.querySelector('#customer_name');
        let customer_phone = document.querySelector('#customer_phone');
        let invoice_no = document.querySelector('#invoice_no');



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
