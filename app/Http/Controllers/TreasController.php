<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
      if ($type == 2) {

        //   $dataDB = DB::table('legislations')
        //   ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
        //   ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
        //   ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
        //   ->where('legislations.Contract_legis','=', $request->Contract)
        //   ->when(!empty($NumberBill), function($q) use($NumberBill){
        //     return $q->where('legispayments.Jobnumber_Payment',$NumberBill);
        //   })
        //   ->when(!empty($Fromdate)  && !empty($Todate), function($q) use ($Fromdate, $Todate) {
        //     return $q->whereBetween('legispayments.Date_Payment',[$Fromdate,$Todate]);
        //   })
        //   ->orderBy('legislations.id', 'ASC')
        //   ->first();

        // $pdf = new PDF();
        // $pdf::SetTitle('ใบเสร็จรับชำระค่างวด');
        // $pdf::AddPage('L', 'A5');
        // $pdf::SetMargins(16, 5, 5, 5);
        // $pdf::SetFont('freeserif', '', 11, '', true);
        // $pdf::SetAutoPageBreak(TRUE, 5);

        // $view = \View::make('legislation.reportCompro' ,compact('data'));
        // $html = $view->render();
        // $pdf::WriteHTML($html,true,false,true,false,'');
        // $pdf::Output('report.pdf');
        
        }
    }
}
