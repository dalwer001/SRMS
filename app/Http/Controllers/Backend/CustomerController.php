<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //get method
    public function customers()
    {
        $employees=Employee::all();
        $customers = Customer::all();
        return view('backend.contents.customers.customers-list', compact('customers','employees'));
    }

    //post method
    public function create(Request $request)
    {
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id'=>$request->employee_id,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'city' => $request->city,
        ]);
        return redirect()->back();
    }

    //DELETE METHOD
    public function delete($id)
    {
        $customers = Customer::find($id);
        $customers->delete();
        return redirect()->route('customers.list');
    }

    //edit view
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view('backend.contents.customers.customer-edit-list',compact('customers'));
    }

    // update method
    public function update(Request $request)
    {
        $customers=Customer::find($request->id);
        $customers->name=$request->name;
        $customers->email=$request->email;
        $customers->contact_no=$request->contact_no;
        $customers->address=$request->address;
        $customers->city=$request->city;
        $customers->save();
        return redirect()->route('customers.list');
    }
}
