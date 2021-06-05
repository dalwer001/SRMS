<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $Product = Product::all();
        $totalNumberofProduct = $Product->count();
        $quantity = 0;
        foreach ($Product as  $data) {
            $quantity += $data->quantity;
        }

        $ProductActive = Product::where('status', 'Active')->get();
        $activeProduct = $ProductActive->count();
        $totalActiveProduct = 0;
        foreach ($ProductActive  as  $data) {
            $totalActiveProduct += $data->quantity;
        }



        $totalEmployee = Employee::all()->count();
        $activeEmployee = Employee::where('status', 'active')->count();

        $totalCustomer = Customer::all()->count();
        // $mytime = Carbon::now()->format('Y-m-d h:m:s');
        $todaySale = Sale::whereDate('created_at', now()->today())->get();
        $total_sale = 0;
        foreach ($todaySale as $data) {
            $total_sale += $data->total_amount;
        }

        $grandTotal = Sale::all();
        $grandTotalSale = 0;
        foreach ($grandTotal as $data) {
            $grandTotalSale += $data->total_amount;
        }

        $date = Carbon::now();

        if (auth()->user()->role == 'employee') {
            $task_emp = Task::where('employee_id', auth()->user()->employeeProfile->id)
                ->where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->get();


            $task_quantity = 0;
            $num_product = $task_emp->count();
            // dd($num_product);
            $t_price = 0;
            foreach ($task_emp as $data) {
                $task_quantity += $data->target_quantity;
                $t_price += $data->total_price;
                // $num_product += $data->start_date;
            }

            if ($task_emp->count() != 0) {
                $sales = saleDetails::whereIn('sale_id', function ($query) use ($data) {

                    $query->from('sales')->select('id')->where('employee_id', auth()->user()->employeeProfile->id)
                        ->whereBetween('created_at', [$data->start_date, $data->end_date])
                        ->get();
                })->get();

                $emp_sold_quantity = 0;

                $emp_total_price = 0;
                foreach ($sales as $data) {
                    $emp_sold_quantity += $data->quantity;
                    $emp_total_price += $data->subtotal;
                }
            }else{

            $emp_total_price = 0;

            $emp_sold_quantity = 0;

            }





            $grandSales = sale::where('employee_id', auth()->user()->employeeProfile->id)->get();
            $grandTotal_price = 0;
            foreach ($grandSales as $data) {
                $grandTotal_price += $data->total_amount;
            }


            $grandSaleProduct = saleDetails::whereIn('sale_id', function ($query) {

                $query->from('sales')->select('id')->where('employee_id', auth()->user()->employeeProfile->id)
                    ->get();
            })->get();

            $grandSale_p = 0;
            foreach ($grandSaleProduct as $data) {
                $grandSale_p += $data->quantity;
            }

            return view('backend.contents.dashboard.dashboard-list', compact('totalNumberofProduct', 'quantity', 'totalEmployee', 'activeProduct', 'activeEmployee', 'totalCustomer', 'total_sale', 'grandTotalSale', 'totalActiveProduct', 'task_quantity', 'num_product', 'emp_sold_quantity', 't_price', 'emp_total_price', 'grandTotal_price', 'grandSale_p'));
        }




        // dd($quantity);
        return view('backend.contents.dashboard.dashboard-list', compact('totalNumberofProduct', 'quantity', 'totalEmployee', 'activeProduct', 'activeEmployee', 'totalCustomer', 'total_sale', 'grandTotalSale', 'totalActiveProduct'));
    }
}
