<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Task;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function salesDetails()
    {

        if (auth()->user()->role == 'admin') {
            $sales = Sale::all();
        } else {
            $users = auth()->user()->employeeProfile->id;
            $sales = Sale::where('employee_id', $users)->get();
        }

        return view('backend.contents.sales.salesDetails-list', compact('sales'));
    }

    public function salesDetailsView($id)
    {
        $sale = Sale::find($id);
        $saleDetails = SaleDetails::where('sale_id', $id)->get();
        return view('backend.contents.sales.salesInvoiceDetails-list', compact('sale', 'saleDetails'));
    }


    public function saleSummary()
    {
        return view('backend.contents.sales.sale-summary-list');
    }

    public function newSale()
    {
        $users = auth()->user()->employeeProfile->id;
        //  $products = Product::all();
        $task = Task::where('employee_id', $users)
        ->where('target_quantity','!=',0)
        ->get();
        $customer = Customer::where('employee_id', $users)->get();
        $sales = Cart::where('employee_id', $users)->get();
        $s_total = 0;
        $p_quantity = 0;
        // dd($sales);
        foreach ($sales as $data) {
            $s_total = $s_total + $data->subtotal;
            $p_quantity = $p_quantity + $data->product_quantity;
        }



        // dd($s_total,$p_quantity);
        return view('backend.contents.sales.create-sale-list', compact('task', 'customer', 'sales', 's_total', 'p_quantity'));
    }


    public function saleProductCreate(Request $request)
    {
        // $unit_price = Task::where('product_id',$product-$request->product_id)->get();
        // dd($unit_price);
        $product = Product::find($request->product_id);

        $subtotal = $request->product_quantity * $product->unit_price;

        $task = Task::where('product_id', $request->product_id)
            ->where('employee_id',  auth()->user()->employeeProfile->id)
            ->first();
        // dd($quantity);




        $cart = Cart::where('employee_id', auth()->user()->employeeProfile->id)
            ->where('product_id', $request->product_id)->first();


        if($cart){
            $cart->update([
                'product_quantity'=>$cart->product_quantity + $request->product_quantity
            ]);
        }else{
            Cart::create([
                'employee_id'=>auth()->user()->employeeProfile->id,
                'product_id' => $request->product_id,
                'product_quantity' => $request->product_quantity ,
                'unit_price' => $product->unit_price,
                'subtotal' => $subtotal
            ]);
        }
        // dd($product);


        // dd($cart);

        $left_quantity = $task->target_quantity - $request->product_quantity;
        $left_price = $task->total_price - $subtotal;

        $task->update([
            'target_quantity' => $left_quantity,
            'total_price'=>$left_price
        ]);


        // if($task->target_quantity==0)
        // {
        //     $commission = $task->total_price * 0.05;
        //     $salary = Employee::find(auth()->user()->employeeProfile->id);

        //     $salary->update([
        //         'salary'=> $salary->salary + $commission,
        //     ]);
        // }
        // else{
        //     $commission = $task->target_quantity -
        // }
        // dd($left_quantity);

        // Task::where('id', $request->product_id)->update([
        //     'target_quantity' => $left_quantity
        // ]);

        // dd($left_quantity);

        return redirect()->back();
    }

    public function saleProductDelete($id)
    {
        $products = Cart::find($id);

        $task = Task::where('product_id', $products->product_id)
            ->where('employee_id',  auth()->user()->employeeProfile->id)
            ->first();


        $left_quantity = $task->target_quantity + $products->product_quantity;
        $left_price = $task->total_price + $products->subtotal;
        $task->update([
            'target_quantity' => $left_quantity,
            'total_price'=>$left_price
        ]);

        $products->delete();

        return redirect()->route('newSale.list');
    }


    public function productSold(Request $request)
    {

        $sale = Sale::create([
            'employee_id' => $request->employee_id,
            'total_amount' => $request->total_amount,
            'customer_id' => $request->customer_id,
            'invoice_no' => $request->invoice_no
        ]);

        $cartData = Cart::all();
        $sq=0;
        $sub_t=0;
        foreach ($cartData as $data) {
        $sp= SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $data->product_id,
                'unit_price' => $data->unit_price,
                'quantity' => $data->product_quantity,
                'subtotal' => $data->subtotal,
            ]);
            $sq=$sq+$sp->quantity;
            $sub_t=$sub_t+$sp->subtotal;
        }
        // dd($sq);

        Cart::where('employee_id', $request->employee_id)->delete();


        $task = Task::where('employee_id',  auth()->user()->employeeProfile->id)->get();

            $task_q= 0;
            $total_p=0;
            foreach($task as $data)
            {
                $task_q =$task_q+$data->target_quantity; 
                $total_p = $total_p+$data->total_price;
                $date= $data->end_date;
            }

            // dd($task_q - $sq);

        $saleDate  = Sale::where('employee_id', auth()->user()->employeeProfile->id)->first();
        // dd($saleDate);
        $salary = Employee::find( auth()->user()->employeeProfile->id);

        if ($saleDate->created_at <= $date) {
            if ($task_q== 0) {
                $commission = $total_p * 0.05;
                $total_S= $commission+$salary->salary;
                $salary->update([
                    'salary'=> $total_S,
                ]);
            }
        }
        else{
            $left_q = $task_q - $sq;
            $left_p=$total_p-$sub_t;
            $total_loss=$left_q*$left_p*0.05;
            $total_S=$total_loss-$salary->salary;
            $salary->update([
                'salary'=> $total_S,
            ]);

            // dd($left_p);

            foreach($task as $data)
            {
                $data->delete();
            }
            
            return redirect()->route('newSale.list')->with('error','you have existed the sales date, your task is update to null');
        }








        return redirect()->route('newSale.list');
    }
}
