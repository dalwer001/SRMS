@extends('backend.main')
@section('content')
    {{-- @dd($employee); --}}

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">{{ auth()->user()->name }} Tasks</h1>
    </div>

    <div class="px-5">
        <div class="row py-3">
            <div class="col-md-4">
                <form action="{{ route('employeeTask.list',auth()->user()->employeeProfile->id) }}" method="GET">
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
                    <th scope="col">Product Image</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Target quantity</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            @foreach ($employee as $key => $data)
                <tbody class="bg-light">
                    <tr>
                        <th scope="row">{{ $employee->firstItem() + $key }}</th>
                        <td>{{ $data->product->name }}</td>
                        <td><img style="width: 80px;height:80px" src="{{ url('/files/product/' . $data->product->image) }}" alt=""></td>
                        <td>{{ $data->total_price }}BDT</td>
                        <td>{{ $data->target_quantity }}Qty</td>
                        <td>{{ date('Y-M-d', strtotime($data->start_date)) }}</td>
                        <td>{{ date('Y-M-d', strtotime($data->end_date)) }}</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                </tbody>
            @endforeach

        </table>
        @if (isset($search))
        <p class="text-secondary">
            <span>searching for '{{ $search }}' found '{{ count($employee) }}' results</span>
        </p>
    @endif
    </div>
    </div>
    </div>
    <div class="d-flex justify-content-center ">
        {{ $employee->links() }}
    </div>
@endsection
