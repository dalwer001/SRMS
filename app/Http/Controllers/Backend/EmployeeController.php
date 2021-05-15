<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Models\Commission;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController extends Controller
{
    //get method
    public function employees()
    {
        
        $employees = Employee::all();
        return view('backend.contents.employees.employees-list', compact('employees'));
    }


    // post method
    public function create(Request $request)
    {
        // dd($request-> all());
            // dd($request->file('employee_image')->getClientOriginalExtension());

        $file_name = '';
        //step1: check request has file?
        if ($request->hasFile('employee_image')) {
            //file is valid or not
            $file = $request->file('employee_image');
            if ($file->isValid()) {
                //generate unique file name
                $file_name = date('Ymdhms') . '.' . $file->getClientOriginalExtension();

                //store image into local directory
                $file->storeAs('employee', $file_name);
            }
        }

        DB::beginTransaction();

        try{
            $request->validate([
                'name' => 'required',
                'email' => 'email|required|unique:users',
                'contact_no'=>'required|min:11|numeric',
                'address'=>'required',
                'gender'=>'required',
                'birth_date'=>'required',
                'join_date'=>'required',
                'salary'=>'required'
            ]);

            $users = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('123456')
            ]);

            //employee add


            Employee::create([
                'image'=>$file_name,
                'user_id'=>$users->id,
                'contact_no' => $request->contact_no,
                'address' => $request->address,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'join_date' => $request->join_date,
                'salary' => $request->salary
            ]);

            DB::commit();
            return redirect()->back()->with('message-success','Employee created successfully.');
        }
        catch(Throwable $e){
            DB::rollBack();
            return redirect()->back();
    }
}

    //delete method
    public function delete($id)
    {
        $employees = Employee::find($id);
        try{
            $employees->delete();
            return redirect()->route('employees.list');
        }
        catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This employee already have task.');
            }
            return back();
        }

    }

    // edit method
    public function edit($id)
    {
        $employees = Employee::find($id);
        return view('backend.contents.employees.employee-edit-list', compact('employees'));
    }


    public function update(Request $request)
    {
        $employees = Employee::find($request->id);
        $employees->update([
        'name' => $request->name,
        'email' => $request->email,
        'contact_no' => $request->contact_no,
        'gender' => $request->gender,
        'address' => $request->address,
        'birth_date' => $request->birth_date,
        'salary' => $request->salary,
        'password' =>  bcrypt($request->password)
        ]);
        return redirect()->route('employees.list');
    }

    public function view($id)
    {
        $employees = Employee::find($id);

        $sales = Commission::where('employee_id', $employees->id)->get();
        return view('backend.contents.employees.employee-view-list', compact('employees','sales'));
    }
}
