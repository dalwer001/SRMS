<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function mangeSales(){
        return view('backend.contents.sales.manage-sales-list');
    }

    public function saleSummary()
    {
        return view('backend.contents.sales.sale-summary-list');
    }
}
