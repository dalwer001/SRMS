<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function tasks()
    {
        $employees=Employee::all();
        $products = Product::all();
        $tasks = Task::all();
        return view('backend.contents.task.task-list', compact('tasks','employees','products'));
    }

    public function create(Request $request)
    {
        Task::create([
            'employee_id' => $request->employee_id,
            'product_id' => $request->product_id,
            'target_quantity' => $request->target_quantity,
            'target_price' => $request->target_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        return redirect()->back();
    }
}
