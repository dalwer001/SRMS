<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request){
        $sales =[];
        // $fromDate = $request->input('from_date');
        // $toDate = $request->input('to_date');
        if(isset($_GET['from_date']))
        { 
            $fromDate = date('Y-m-d',strtotime($_GET['from_date']));
            $toDate = date('Y-m-d',strtotime($_GET['to_date']));
            
            // $fromDate = date('Y-m-d',$fromDate);
            // $toDate = date('Y-m-d',$toDate);

            if ($fromDate > $toDate){
                return redirect()->back()->with('error-message','Invalid date selection.');
            }
            // if ($fromDate == $toDate){
            //     return redirect()->back()->with('error-message','Invalid date selection.');
            // }
            

            // $sales = SaleDetails::where('created_at','<=',$fromDate)
            //                 ->where('created_at','>=',$toDate)->get();
            $sales = SaleDetails::whereBetween('created_at',[$fromDate,$toDate])->get();
            $total=0;
            $t_quantity=0;
            foreach($sales as $data)
            {
                $total+=$data->subtotal;
                $t_quantity+=$data->quantity;
            }
            return view('backend.contents.report.report-list',compact('sales','fromDate','toDate','total','t_quantity'));
        }
        return view('backend.contents.report.report-list',compact('sales'));
        
    }
    
}
