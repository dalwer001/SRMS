<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Models\Employee;

use Illuminate\Http\Request;

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


        Employee::create([
            'image'=>$file_name,
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'join_date' => $request->join_date,
            'salary' => $request->salary,
            'password' => $request->password
        ]);
        return redirect()->back();
    }

    //delete method
    public function delete($id)
    {
        $employees = Employee::find($id);
        $employees->delete();
        return redirect()->route('employees.list');
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
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->contact_no = $request->contact_no;
        $employees->address = $request->address;
        $employees->birth_date = $request->birth_date;
        $employees->join_date = $request->join_date;
        $employees->salary = $request->salary;
        $employees->password = $request->password;
        $employees->save();
        return redirect()->route('employees.list');
    }
}
