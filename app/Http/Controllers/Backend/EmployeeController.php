<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\controller;
use App\Models\Commission;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController extends Controller
{
    //get method
    public function employees(Request $request)
    {
        $disable = Carbon::now()->subYears(18)->format('Y-m-d');

        $search = $request->input('search');

        if ($request->has('search')) {
            $employees = Employee::whereHas('employeeDetail', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate(10);
        } else {
            $employees = Employee::paginate(10);
        }

        return view('backend.contents.employees.employees-list', compact('employees', 'search', 'disable'));
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
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'email|required|unique:users',
                'contact_no' => 'required|digits:11|regex:/(01)[0-9]{9}/|numeric|unique:employees',
                'address' => 'required',
                'gender' => 'required',
                'birth_date' =>'required|date|before_or_equal:' . \Carbon\Carbon::now()->subYears(18)->format('Y-m-d'),
                'salary' => 'required'
            ]);

            $users = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('123456')
            ]);

            //employee add


            Employee::create([
                'image' => $file_name,
                'user_id' => $users->id,
                'contact_no' => $request->contact_no,
                'address' => $request->address,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary
            ]);
            DB::commit();
            return redirect()->back()->with('success-message', 'Employee created successfully.');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error-message','You missed something or given wrong input');
        }
    }

    //delete method
    public function delete($id)
    {
        $employees = Employee::find($id);
        $users=User::find($employees->user_id);
        try {
            $employees->delete();
            $users->delete();
            return redirect()->route('employees.list');
        } catch (Throwable $e) {
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
        $users = User::where('id', $employees->user_id)->first();
        return view('backend.contents.employees.employee-edit-list', compact('employees', 'users'));
    }


    public function update(Request $request)
    {
        $employees = Employee::find($request->id);
        $user = User::find($employees->user_id);



        if ($request->hasFile('employee_image')) {

            $image_path = public_path() . '/files/employee/' . $employees->image;

            if ($employees->image) {
                unlink($image_path);
            }

            $file_name = '';

            $file = $request->file('product_image');
            if ($file->isValid()) {
                $file_name = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('product', $file_name);
            }

            $employees->image->update([
                'image' => $file_name
            ]);
        }
        // dd($employees->user_id);


        if ($user->email  == $request->email && $employees->contact_no == $request->contact_no) {
            $employees->update([
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary,
            ]);
            User::find($employees->user_id)->update([
                'name' => $request->name,
            ]);
        }

        else if ($user->email  == $request->email) {
            $request->validate([
                'contact_no' => 'required|digits:11|regex:/(01)[0-9]{9}/|numeric|unique:employees',
            ]);
            $employees->update([
                'contact_no' => $request->contact_no,
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary,
            ]);
            User::find($employees->user_id)->update([
                'name' => $request->name,
            ]);
        }
        
        else if($employees->contact_no == $request->contact_no)
        {
            $request->validate([
                'email'=>'email|unique:users',
            ]);
            $employees->update([
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary,
            ]);
            User::find($employees->user_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }

        else {
            $request->validate([
                'email'=>'email|unique:users',
                'contact_no' => 'required|digits:11|regex:/(01)[0-9]{9}/|numeric|unique:employees',
            ]);

            $employees->update([
                'contact_no' => $request->contact_no,
                'gender' => $request->gender,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'salary' => $request->salary,
            ]);
            User::find($employees->user_id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }


        return redirect()->route('employees.list')->with('success-message',$user->name.' '.'info update successfully');
    }

    public function view($id)
    {
        $employees = Employee::find($id);
        $sales = Commission::where('employee_id', $employees->id)->get();
        return view('backend.contents.employees.employee-view-list', compact('employees', 'sales'));
    }

    public function employeesApi(){
        $employees = Employee::all();
        return $employees;
    }
}

