<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
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
        $customer= Customer::where('employee_id',$users)->get();
        $sales = Cart::where('employee_id', $users)->get();
        $s_total=0;
        $p_quantity=0;
        // dd($sales);
        foreach($sales as $data){
        $s_total=$s_total + $data->subtotal;
        $p_quantity=$p_quantity+$data->product_quantity;
        }



        // dd($s_total,$p_quantity);
        return view('backend.contents.sales.create-sale-list',compact('task','customer','sales','s_total','p_quantity'));
    }

        public function saleProductCreate(Request $request)
        {
            // $unit_price = Task::where('product_id',$product-$request->product_id)->get();
            // dd($unit_price);
            $product = Product::find($request->product_id);

            $subtotal =$request->product_quantity*$product->unit_price;

            $task= Task::where('product_id', $request->product_id  )
                            ->where('employee_id' ,  auth()->user()->employeeProfile->id)
                            ->first();
            // dd($quantity);





            // dd($product);

           Cart::create([
                'employee_id'=>auth()->user()->employeeProfile->id,
                'product_id' => $request->product_id,
                'product_quantity' => $request->product_quantity ,
                'unit_price' => $product->unit_price,
                'subtotal' => $subtotal
            ]);
            // dd($cart);

            $left_quantity = $task->target_quantity - $request->product_quantity;
            $task->update([
                'target_quantity' => $left_quantity,
            ]);
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

            $task= Task::where('product_id', $products->product_id  )
                            ->where('employee_id' ,  auth()->user()->employeeProfile->id)
                            ->first();


            $left_quantity = $task->target_quantity + $products->product_quantity;
            $task->update([
                'target_quantity' => $left_quantity,
            ]);

            $products->delete();

            return redirect()->route('newSale.list');
        }

        public function productSold(Request $request){

            $sale = Sale::create([
                'employee_id'=> $request->employee_id,
                'total_amount'=> $request->total_amount,
                'customer_id'=> $request->customer_id,
                'invoice_no'=> $request->invoice_no
            ]);

            $cartData= Cart::all();
                foreach($cartData as $data){
                    SaleDetails::create([
                        'sale_id' => $sale->id,
                        'product_id'=> $data->product_id,
                        'unit_price'=>$data->unit_price,
                        'quantity'=> $data->product_quantity,
                        'subtotal'=> $data->subtotal,
                    ]);
                }


                Cart::where('employee_id', $request->employee_id)->delete();

            return redirect()->route('newSale.list');

        }
}
