<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Throwable;

class CustomerController extends Controller
{
    //get method
    public function customers(Request $request)
    {

        // dd($users);
        $employees = Employee::all();
        if (auth()->user()->role == 'admin') {
            
            $customers = Customer::paginate(10);
            $search = $request->input('search');

            if($request->has('search')){
                $customers = Customer::where('name','like',"%{$search}%")
                ->paginate(10);
            }else{
                $customers = customer::paginate(10);;
            }
            return view('backend.contents.customers.customers-list', compact('customers', 'employees','search'));
        } else {
            $users = auth()->user()->employeeProfile->id;
            $customers = Customer::where('employee_id', $users)->paginate(10);
        }

        $search = $request->input('search');

        if($request->has('search')){
            $customers = Customer::where('name','like',"%{$search}%")
            ->where('employee_id', $users)->paginate(10);
        }else{
            $customers = customer::where('employee_id', $users)->paginate(10);;
        }

        return view('backend.contents.customers.customers-list', compact('customers', 'employees','search'));
    }

    //post method
    public function create(Request $request)
    {
        $customer = Customer::where('employee_id', auth()->user()->employeeProfile->id)->get();
        // dd($customer);
        foreach ($customer as $data) {
            if ($data->email == $request->email) {
                $request->validate([
                    'email' => 'email|required|unique:customers',
                ]);
            }
        }

        $request->validate([
            'name' => 'required',
            'employee_id' => 'required',
            'contact_no' => 'required|digits:11|regex:/(01)[0-9]{9}/|numeric|unique:customers',
            'address' => 'required',
            'city' => 'required'
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'city' => $request->city
        ]);

        
        return redirect()->back()->with('success-message','Customer created successfully.');
    }

    //DELETE METHOD
    public function delete($id)
    {
        $customers = Customer::find($id);

        try {
            $customers->delete();
            return redirect()->route('customers.list');
        } catch (Throwable $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error-message', 'This customer already have sale');
            }
            return back();
        }
    }

    //edit view
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view('backend.contents.customers.customer-edit-list', compact('customers'));
    }

    // update method
    public function update(Request $request)
    {
        $customers = Customer::find($request->id);

        if ($customers->email  == $request->email && $customers->contact_no == $request->contact_no)
        {
            $customers->update([
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city
                ]);
        }
        else if($customers->email  == $request->email)
        {
            $request->validate([
                'contact_no' => 'required|digits:11|regex:/(01)[0-9]{9}/|numeric|unique:customers',
            ]);
            $customers->update([
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'address' => $request->address,
                'city' => $request->city
                ]);
        }
        else if($customers->contact_no == $request->contact_no)
        {
            $request->validate([
            'email' => 'email|required|unique:customers',
        ]);
            $customers->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city
                ]);
        }
        else{
            $request->validate([
                'email' => 'email|required|unique:customers',
                'contact_no' => 'required|digits:11||regex:/(01)[0-9]{9}/|numeric|unique:customers',
            ]);
            $customers->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'address' => $request->address,
                'city' => $request->city
                ]);
        }
        return redirect()->route('customers.list')->with('success-message',$customers->name.' '.'info update successfully');
    }
}
