<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ApiController extends Controller
{
    public function customerDetails($id)
    {
        $customer = Customer::find($id);
        $invID = Sale::orderBy('id','desc')->first()->id ?? 0;

        $random=1+($invID = str_pad($invID, 4, '0', STR_PAD_LEFT));

        return  \response()->json([
            'data'=>$customer,
            'invoice_no'=>$random
        ]);
    }
}
