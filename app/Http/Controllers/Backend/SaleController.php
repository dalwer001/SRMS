<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\taskCompleteConfirmation;
use App\Models\Cart;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SaleController extends Controller
{
    public function salesDetails()
    {

        if (auth()->user()->role == 'admin') {
            $sales = Sale::paginate(20);
        } 
        else{
            $users = auth()->user()->employeeProfile->id;
            $sales = Sale::where('employee_id', $users)->paginate(20);
        }

        return view('backend.contents.sales.salesDetails-list', compact('sales'));
    }

    public function salesDetailsView($id)
    {
        $sale = Sale::find($id);
        $saleDetails = SaleDetails::where('sale_id', $id)->get();
        return view('backend.contents.sales.salesInvoiceDetails-list', compact('sale', 'saleDetails'));
    }



    public function newSale()
    {
        $users = auth()->user()->employeeProfile->id;
        //  $products = Product::all();
        $task = Task::where('employee_id', $users)
            ->where('target_quantity', '!=', 0)
            ->where('start_date', '<=', Carbon::now())
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
        $request->validate([
            'product_id' => 'required',
            'product_quantity' => 'required|gt:0'
        ]);



        $product = Product::find($request->product_id);
     
        $subtotal = $request->product_quantity * $product->unit_price;

        $task = Task::where('product_id', $request->product_id)
            ->where('employee_id',  auth()->user()->employeeProfile->id)
            ->where('start_date','<',Carbon::now())
            ->first();
            // dd($task);
            // foreach($task as $data)
            // {
                // dd($data[1]);
                if ($task->end_date < Carbon::now()) {

                    $product = Product::where('id', $task->product_id)->first();
        
        
                    $product_return = $product->quantity + $task->target_quantity;
        
                    $product->update([
                        'quantity' => $product_return,
                    ]);
        
                    $task->update([
                        'target_quantity' => 0,
                        'total_price' => 0
                    ]);
                    // dd($product_return);
        
                    // $task->delete();
        
                    return redirect()->back()->with('error-message', $product->name . ' product task already date over');
                }
        
            
        // dd($quantity);

        $cart = Cart::where('employee_id', auth()->user()->employeeProfile->id)
            ->where('product_id', $request->product_id)->first();

        // dd($cart);

        if ($cart) {
            $cart->update([
                'product_quantity' => $cart->product_quantity + $request->product_quantity
            ]);
        } else {
           

            Cart::create([
                'employee_id' => auth()->user()->employeeProfile->id,
                'product_id' => $request->product_id,
                'product_quantity' => $request->product_quantity,
                'unit_price' => $product->unit_price,
                'subtotal' => $subtotal
            ]);
        }
        // dd($create_date);
        // dd($cart);

        $left_quantity = $task->target_quantity - $request->product_quantity;
        $left_price = $task->total_price - $subtotal;

        $task->update([
            'target_quantity' => $left_quantity,
            'total_price' => $left_price
        ]);
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
            'total_price' => $left_price
        ]);

        $products->delete();

        return redirect()->route('newSale.list');
    }


    public function productSold(Request $request)
    {
        if($request->total_amount == 0)
        {
            return redirect()->back()->with('error-message', 'No product added.');
        }

        $request->validate([
            'employee_id' => 'required',
            'invoice_no' => 'required',
            'customer_id' => 'required',
        ]);

        $sale = Sale::create([
            'employee_id' => $request->employee_id,
            'total_amount' => $request->total_amount,
            'customer_id' => $request->customer_id,
            'invoice_no' => $request->invoice_no
        ]);

        $cartData = Cart::all();
        $sq = 0;
        $sub_t = 0;
        foreach ($cartData as $data) {

            $sp = SaleDetails::create([
                'sale_id' => $sale->id,
                'product_id' => $data->product_id,
                'unit_price' => $data->unit_price,
                'quantity' => $data->product_quantity,
                'subtotal' => $data->subtotal,
            ]);
            $sq = $sq + $sp->quantity;
            $sub_t = $sub_t + $sp->subtotal;
        }
        // dd($sq);

        Cart::where('employee_id', $request->employee_id)->delete();


        $task = Task::where('employee_id',  auth()->user()->employeeProfile->id)
                        ->where('end_date','>',Carbon::now())
                        ->first();
        $startDate = $task->start_date;
        $endDate = $task->end_date;
        $sale = Sale::where('employee_id',  auth()->user()->employeeProfile->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

        // dd($sale);
        // dd($task->id);
        $task_q = 0;

        //all task;
        $task_quantity = $task = Task::where('employee_id',  auth()->user()->employeeProfile->id)->get();

        foreach ($task_quantity as $data) {
            // dd( $data->total_price);
            $task_id= $data->id;
            $task_q = $task_q + $data->target_quantity;
            $date = $data->end_date;
        }
        $total_p = 0;
        foreach ($sale as $data) {
            $total_p = $total_p + $data->total_amount;
        }

        // if($date<$)

        // dd($total_p);

        $saleDate  = Sale::where('employee_id', auth()->user()->employeeProfile->id)->first();
        // dd($saleDate);
        $salary = Employee::find(auth()->user()->employeeProfile->id);
        // dd($saleDate->created_at <= $date);
        if ($saleDate->created_at <= $date) {
            if ($task_q == 0) {
                $total_commission = $total_p * 0.025;
                
            $commission = Commission::create([
                    'task_id'=>$task_id,
                    'employee_id'=>auth()->user()->employeeProfile->id,
                    'commission'=>$total_commission
                ]);

                // $total_S = $commission + $salary->salary;

                // $salary->update([
                //     'salary' => $total_S,
                // ]);
                // foreach ($task_quantity as $data) {
                //     $data->delete();
                // }
            }
        }
        Mail::to('admin@gmail.com')->send(new taskCompleteConfirmation($commission));
        // else {
        //     $left_q = $task_q - $sq;
        //     $left_p = $total_p - $sub_t;
        //     $total_loss = ($left_q * $left_p) * 0.025;
        //     $total_S = abs($salary->salary - $total_loss);
        //     $salary->update([
        //         'salary' => $total_S,
        //     ]);

        //     foreach ($task as $data) {
        //         // $product = Product::where('id', $data->product_id)->first();

        //         // $product_return = $product->quantity + $data->target_quantity;

        //         // // dd($product_return);
        //         // $product->update([
        //         //     'quantity' => $product_return,
        //         // ]);
        //         $data->delete();

        // }

        // return redirect()->route('newSale.list')->with('error', 'you have existed the sales date, your task is update to null');


        return redirect()->route('newSale.list');
    }



    public function search()
    {

        // if (isset($_GET['from_date'])) {
        //     $fromDate = date('Y-m-d', strtotime($_GET['from_date']));
        //     $sales = Sale::whereDate('created_at', [$fromDate])->get();
        // } 
        // if (isset($_GET['from_date'])==null) {
        //     return redirect()->route('saleDetails.list');
        // }
        // return view('backend.contents.sales.salesDetails-list', compact('sales'));
    }


    public function delete($id){
        $sales = Sale::find($id);
        try{
            $sales->delete();
            return redirect()->route('saleDetails.list')->with('error-message','Sale deleted successfully.');
        }
        catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This sales already have task.');
            }
            return back();
        }
    }
}
