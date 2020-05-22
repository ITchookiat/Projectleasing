<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;

use App\Buyer;
use App\Sponsor;
use App\Cardetail;
use App\Expenses;

class TreasController extends Controller
{
    public function index(Request $request)
    {
        $date = date('Y-m-d');

        if ($request->type == 1) {
            $newfdate = '';
            $newtdate = '';

            if ($request->has('Fromdate')){
                $newfdate = $request->get('Fromdate');
            }
            if ($request->has('Todate')){
                $newtdate = $request->get('Todate');
            }

            if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
                $data = DB::table('buyers')
                        ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                        ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                        ->where('cardetails.Date_Appcar', $date)
                        ->where('buyers.Contract_buyer','not like', '22%')
                        ->where('buyers.Contract_buyer','not like', '33%')
                        ->where('cardetails.Approvers_car','<>','')
                        ->orderBy('buyers.Contract_buyer', 'ASC')
                        ->get();

            }
            else {
                $data = DB::table('buyers')
                        ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                        ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                        ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                            return $q->whereBetween('cardetails.Date_Appcar',[$newfdate,$newtdate]);
                        })
                        ->where('buyers.Contract_buyer','not like', '22%')
                        ->where('buyers.Contract_buyer','not like', '33%')
                        ->where('cardetails.Approvers_car','<>','')
                        ->orderBy('buyers.Contract_buyer', 'ASC')
                        ->get();
            }
            return view('treasury.view', compact('data','newfdate','newtdate'));
        }
        elseif ($request->type == 2) {
            $type = $request->type;
            
            return view('treasury.viewReport',compact('type'));
        }
    }

    public function SearchData(Request $request, $type, $id)
    {
        if ($type == 1 or $type == 2) {
            $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                    ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                    ->where('buyers.id', $id)
                    ->first();

            $GetType = $type;
            return view('treasury.viewDetail', compact('data','GetType'));
        }    
    }

    public function updateAnalysis(Request $request, $type, $id)
    {
        if ($type == 1) {
            if ($request->has('checkAccount') != NULL) {
                $user = Cardetail::find($id);
                    $user->UserCheckAc_car = $request->get('checkAccount');
                    $user->DateCheckAc_car = date('Y-m-d');
                $user->update();
            }
        
            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
    }

    public function ReportDueDate(Request $request, $type)
    {
        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $Y2 = date('Y') +543;
        $m = date('m');
        $d = date('d');
        $date2 = $d.'-'.$m.'-'.$Y2;

        $newfdate = '';
        $newtdate = '';

        if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
        }

        if ($type == 2) {
            $dataReport = DB::table('buyers')
                    ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                    ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                        return $q->whereBetween('cardetails.Date_Appcar',[$newfdate,$newtdate]);
                    })
                    ->where('buyers.Contract_buyer','not like', '22%')
                    ->where('buyers.Contract_buyer','not like', '33%')
                    ->where('cardetails.Approvers_car','<>','')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get();

            $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานนำเสนอ');
            $pdf::AddPage('L', 'A4');
            $pdf::SetMargins(5, 5, 5, 0);
            $pdf::SetFont('freeserif', '', 8, '', true);
            $pdf::SetAutoPageBreak(TRUE, 25);

            $pdf::WriteHTML($html,true,false,true,false,'');
            $pdf::Output('report.pdf');
        
        }
    }
}
