<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(){
        $sales =[];
        if(isset($_GET['from_date']))
        {
            $fromDate = date('Y-m-d',strtotime($_GET['from_date']));
            $toDate = date('Y-m-d',strtotime($_GET['to_date']));
            $sales = SaleDetails::whereBetween('created_at',[$fromDate,$toDate])->get();
        }

        return view('backend.contents.report.report-list',compact('sales'));
    }
}
