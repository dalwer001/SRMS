<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function Sales(){
        return view('backend.contents.sales.sales-list');
    }
}
