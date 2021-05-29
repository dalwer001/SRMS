<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
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

        if (auth()->user()->role == 'employee') {
            $task_emp = Task::where('employee_id', auth()->user()->employeeProfile->id)->get();
            // dd($task_emp);
            $task_quantity = 0;
            foreach ($task_emp as $data) {
                $task_quantity += $data->target_quantity;
            }
            return view('backend.contents.dashboard.dashboard-list', compact('totalNumberofProduct', 'quantity', 'totalEmployee', 'activeProduct', 'activeEmployee', 'totalCustomer', 'total_sale', 'grandTotalSale', 'totalActiveProduct', 'task_quantity'));
        }




        // dd($quantity);
        return view('backend.contents.dashboard.dashboard-list', compact('totalNumberofProduct', 'quantity', 'totalEmployee', 'activeProduct', 'activeEmployee', 'totalCustomer', 'total_sale', 'grandTotalSale', 'totalActiveProduct'));
    }
}
