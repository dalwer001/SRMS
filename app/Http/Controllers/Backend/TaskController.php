<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function tasks()
    {
        $employees = Employee::all();
        $products = Product::all();
        $tasks = Task::all();
        return view('backend.contents.task.task-list', compact('tasks', 'employees', 'products'));
    }

    public function employeeTask($id)
    {
        $employee = Task::where('employee_id', $id)->get();
        return view('backend.contents.task.employeeTask-list', compact('employee'));
    }

    public function create(Request $request)
    {

        $unit_price = Product::where('id', $request->product_id)->get();
        // dd($unit_price);
        foreach ($unit_price as $data) {

            $total_price =  $data->unit_price * $request->target_quantity;
            $product_quantity = $data->quantity;
        }

        $products = Task::where('employee_id',$request->employee_id)->get();
        foreach($products as $data)
        {
            if($data->product_id==$request->product_id)
            {
            return redirect()->back()->with('error','This task already given');
            }
        }



        // dd($products);
        $request->validate([
            'employee_id' => 'required',
            'product_id' => 'required',
            'target_quantity' => 'required',
            'start_date'  =>  'required|after:today',


        ]);
// dd(Carbon::create($request->start_date)->addMonth());


        Task::create([
            'employee_id' => $request->employee_id,
            'product_id' => $request->product_id,
            'target_quantity' => $request->target_quantity,
            'total_price' => $total_price,
            'start_date' => $request->start_date,
            'end_date' => Carbon::create($request->start_date)->addMonth(),
        ]);

        $left_quantity = $product_quantity - $request->target_quantity;
        // dd($left_quantity);


        Product::where('id', $request->product_id)->update([
            'quantity' => $left_quantity
        ]);

        return redirect()->back();
    }
}
