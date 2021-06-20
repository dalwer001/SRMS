@extends('backend.main')
@section('content')

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

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 title">Dashboard</h1>
    </div>
    @if (auth()->user()->role == 'admin')
        <div class="row">
            <div class="col-md-4 my-3">
                <div class="card products text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-box-tissue fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Number of Product</small></h5>
                        <h1 class="text-center">{{ $totalNumberofProduct }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3">
                <div class="card quantity text-white shadow" style="width: 20rem; height:10rem">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-box-tissue fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Quantity of Product</small> </h5>
                        <h1 class="text-center">{{ $quantity }}<span class="fs-5">Qty</span></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-3">
                <div class="card employee text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-users fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Number of Employee</small> </h5>
                        <h1 class="text-center">{{ $totalEmployee }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card active-employee text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-user-tie fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Number of Active Employee</small> </h5>
                        <h1 class="text-center">{{ $activeEmployee }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card customer text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-house-user fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Customer</small> </h5>
                        <h1 class="text-center">{{ $totalCustomer }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card sale text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-balance-scale fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Today's Sale</small> </h5>
                        <h1 class="text-center">{{ $total_sale }}<span class="fs-5">BDT</span></h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card totalsale text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-chart-bar fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Sale</small> </h5>
                        <h1 class="text-center">{{ $grandTotalSale }}<span class="fs-5">BDT</span></h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card active-product text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-truck-loading fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Active Product</small> </h5>
                        <h1 class="text-center">{{ $activeProduct }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="card active-quantity text-white shadow" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-toolbox fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Total Active Product Quantity</small> </h5>
                        <h1 class="text-center">{{ $totalActiveProduct }}<span class="fs-5">Qty</span></h1>
                    </div>
                </div>
            </div>

        </div>
    @endif


    @if (auth()->user()->role == 'employee')
        <div class="row">
            <div class="col-md-4 py-5 ">
                <div class="card active-quantity text-white shadow emp-task" style="width: 20rem;height:10rem;">
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fas fa-box-tissue fs-1 text-light mb-2"></i>
                        </div>
                        <h5 class="text-center border-top"> <small>Task Product Quantity</small> </h5>
                        <h1 class="text-center">{{ $task_quantity }}<span class="fs-5">Qty</span></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_num_product" style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-toolbox fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Number of Product</small> </h5>
                            <h1 class="text-center">{{ $num_product }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_sold_quantity"
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-cart-plus fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Total Sold Quantity of Product</small> </h5>
                            <h1 class="text-center">{{ $emp_sold_quantity }}<span class="fs-5">Qty</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_left_quantity"
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-cart-arrow-down fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Left Quantity of Product</small> </h5>
                            <h1 class="text-center">{{ abs($task_quantity - $emp_sold_quantity) }}<span
                                    class="fs-5">Qty</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_total_target_price"
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-money-bill-alt fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Total target price</small> </h5>
                            <h1 class="text-center">{{ $t_price }} <span class="fs-5">BDT</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_total_sold_price"
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-money-check fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Total sold price</small> </h5>
                            <h1 class="text-center">{{ $emp_total_price }} <span class="fs-5">BDT</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_remaining_target_price"
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-chart-line fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Remaining target Price</small> </h5>
                            <h1 class="text-center">{{ abs($t_price - $emp_total_price) }} <span class="fs-5">BDT</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_Grand_Total_Quantity "
                        style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-clipboard-list fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Grand Total Quantity of Sale</small> </h5>
                            <h1 class="text-center">{{ $grandSale_p }}<span class="fs-5">Qty</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-5">
                <div class="col-md-6">
                    <div class="card active-quantity text-white shadow emp_grand_price" style="width: 20rem;height:10rem;">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-chart-area fs-1 text-light mb-2"></i>
                            </div>
                            <h5 class="text-center border-top"> <small>Grand Total of Sale Price</small> </h5>
                            <h1 class="text-center">{{ $grandTotal_price }} <span class="fs-5">BDT</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
