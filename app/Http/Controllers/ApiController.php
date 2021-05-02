<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ApiController extends Controller
{
    public function customerDetails($id)
    {
        $customer = Customer::find($id);
        
        $random = 1100;
        return  \response()->json([
            'data'=>$customer,
            'invoice_no'=>$random+1
        ]);
    }
}
