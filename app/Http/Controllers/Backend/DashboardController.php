<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $Product = Product::all();
        $totalNumberofProduct = $Product->count();
        $quantity=0;
        foreach ($Product as  $data) {
            $quantity+=$data->quantity;
        }

        $totalEmployee = Employee::all()->count();
        $activeEmployee =Employee::where('status','active')->count();

        $totalCustomer = Customer::all()->count();
        // $mytime = Carbon::now()->format('Y-m-d h:m:s');
        $todaySale = Sale::whereDate('created_at',now()->today())->get();
        $total_sale=0;
        foreach($todaySale as $data)
        {
            $total_sale += $data->total_amount;
        }

        $grandTotal = Sale::all();
        $grandTotalSale=0;
        foreach($grandTotal as $data)
        {
            $grandTotalSale += $data->total_amount;
        }




        // dd($quantity);
        return view('backend.contents.dashboard.dashboard-list',compact('totalNumberofProduct','quantity','totalEmployee','activeEmployee','totalCustomer','total_sale','grandTotalSale'));
    }
}
