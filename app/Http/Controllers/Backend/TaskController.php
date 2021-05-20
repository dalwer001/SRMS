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
use Throwable;

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

        $products = Task::where('employee_id', $request->employee_id)->get();
        // dd($products);
        foreach ($products as $data) {
            // dd($data->end_date!=Carbon::create($request->start_date)->addMonth());

            if ($data->product_id == $request->product_id && $data->start_date > $request->start_date) {
                return redirect()->back()->with('error-message', 'This date is invalid because given date is less than task start date.');
            }

            if ($data->product_id == $request->product_id && $data->end_date >= $request->start_date) {
                return redirect()->back()->with('error-message', 'This task already exist and wait for the next month.');
            }

            if ($product_quantity < $request->target_quantity) {
                return redirect()->back()->with('error-message', 'Not enough product in store');
            }
            if ($request->target_quantity < 0) {
                return redirect()->back()->with('error-message', 'Give wrong value');
            }

            // dd($data->target_quantity);
            //     if($data->product_id == $request->product_id && $data->end_date <= $request->start_date && $data->target_quantity==0 ){

            //         $products = Task::where('employee_id', $request->employee_id)
            //         ->where('product_id',$request->product_id)
            //         ->update([
            //             'target_quantity' => $request->target_quantity,
            //             'total_price' => $total_price,
            //             'start_date' => $request->start_date,
            //             'end_date' => Carbon::create($request->start_date)->addMonth()
            //         ]);
            //         $left_quantity = $product_quantity - $request->target_quantity;
            //         // dd($left_quantity);

            //         Product::where('id', $request->product_id)->update([
            //             'quantity' => $left_quantity
            //         ]);
            //         return redirect()->back()->with('error-message','This product have already task');

            // }
        }



        // dd(Carbon::create($request->start_date)->addMonth());

        // dd($products);
        $request->validate([
            'employee_id' => 'required',
            'product_id' => 'required',
            'target_quantity' => 'required|gt:0',
            'start_date'  =>  'required|after:yesterday',
        ]);


        // dd(Carbon::create($request->start_date)->addMonth());
        if ($product_quantity < $request->target_quantity) {
            return redirect()->back()->with('error-message', 'Not enough product in store');
        } elseif ($products && $data->start_date > $request->start_date && $data->start_date < $request->start_date) {
            return redirect()->back()->with('error-message', 'This task already given and wait for the next month');
        } elseif ($products  && $data->employee_id == $request->employee_id && $data->start_date != $request->start_date && $request->start_date < Carbon::create($data->start_date)->addMonth()) {
            return redirect()->back()->with('error-message', 'This task already given and wait for the next month');
        }
        // dd($data);
        else {
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

            return redirect()->back()->with('success-message', 'Task created successfully');
        }
        // else{
        //     return redirect()->back()->with('error-message',' ');
        // }

    }

    public function delete($id)
    {
        $task = Task::find($id);

        try {
            $products = Product::where('id', $task->product_id)->first();
            $left_quantity = $task->target_quantity + $products->quantity;
            $products->update([
                'quantity' => $left_quantity,
            ]);
            $task->delete();
            return redirect()->route('tasks.list')->with('error-message', 'Task deleted successfully.');
        } 
        catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This task already has sales');
            }
            return back();
        }
    }
}
