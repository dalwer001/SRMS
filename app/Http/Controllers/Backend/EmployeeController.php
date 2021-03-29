<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\controller;
use App\Models\Employee;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //get method
    public function employees(){
        $employees=Employee::all();
        return view('backend.contents.employees.employees-list',compact('employees'));
    }


    // post method
    public function create(Request $request){
        // dd($request-> all());
        Employee::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'contact_no'=> $request -> contact_no,
            'rank' => $request -> rank,
            'birth_date' => $request ->birth_date,
            'join_date'=> $request->join_date,
            'salary'=> $request -> salary
        ]);
        return redirect()->back();
    }

    //delete method
    public function delete($id){
        $employees=Employee::find($id);
        $employees->delete();
        return redirect()->route('employees.list');
    }

    // edit method
    public function edit($id)
    {

        $employees = Employee::find($id);
        return view('backend.contents.employees.employee-edit-list',['employees'=>$employees]);
    }


    public function update(Request $request)
    {
        $employees=Employee::find($request->id);
        $employees->name=$request->name;
        $employees->email=$request -> email;
        $employees->contact_no=$request -> contact_no;
        $employees->rank=$request -> rank;
        $employees->birth_date=$request ->birth_date;
        $employees->join_date=$request->join_date;
        $employees->salary=$request -> salary;
        $employees->save();
        return redirect()->route('employees.list');

    }


}
