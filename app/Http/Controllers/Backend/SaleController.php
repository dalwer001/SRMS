<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Task;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function mangeSales(){

        return view('backend.contents.sales.manage-sales-list');
    }

    public function saleSummary()
    {
        return view('backend.contents.sales.sale-summary-list');
    }

    public function newSale(){
        $users=auth()->user()->employeeProfile->id;
        //  $products = Product::all();
        $task= Task::where('employee_id',$users)->get();
        $customer = Customer::all();
        
        // dd($task);
        return view('backend.contents.sales.new-sale-list',compact('task','customer'));
    }

        public function saleProductCreate(Request $request)
        {
            Sale::create([
                'employee_id'=>$request->customer_id,
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ,
                'unit_price' => $request->unit_price,
                'total_amount' => $request->total_amount
            ]);


        }
}
