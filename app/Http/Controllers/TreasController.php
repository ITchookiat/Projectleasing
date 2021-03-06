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

use App\Micro_Ploan;

class TreasController extends Controller
{
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $newfdate = '';
        $newtdate = '';
        if ($request->has('Fromdate')){
            $newfdate = $request->get('Fromdate');
        }
        elseif ($request->newfdate != '') {
            $newfdate = $request->newfdate;
        }
        if ($request->has('Todate')){
            $newtdate = $request->get('Todate');
        } elseif ($request->newtdate != '') {
            $newtdate = $request->newtdate;
        }

        if ($request->type == 1) {      //รายงาน
            $type = $request->type;
            $Flag = $request->Flag;
            return view('treasury.viewReport',compact('type','Flag'));
        }
        elseif ($request->type == 2) {  //view index
            if ($newfdate == NULL and $newtdate == NULL) {
                $data = DB::table('buyers')
                    ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                    ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                    ->where('cardetails.Date_Appcar', $date)
                    ->where('buyers.Contract_buyer','not like', '22%')
                    ->where('buyers.Contract_buyer','not like', '33%')
                    ->where('cardetails.Approvers_car','<>','')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get();

                $dataP = DB::table('MP_Datas')
                    ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                    ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                    ->where('MP_Datacars.Date_Appcar', $date)
                    ->where('MP_Datacars.Approvers_car','<>','')
                    ->where('MP_Datas.Type_Con','not like','P06%')
                    ->where('MP_Datas.Type_Con','not like','P07%')
                    ->orderBy('MP_Datas.Contract_MP', 'ASC')
                    ->get();

                $dataM = DB::table('MP_Datas')
                    ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                    ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                    ->where('MP_Datacars.Date_Appcar', $date)
                    ->where('MP_Datacars.Approvers_car','<>','')
                    ->where('MP_Datas.Type_Con','not like','P03%')
                    ->where('MP_Datas.Type_Con','not like','P04%')
                    ->orderBy('MP_Datas.Contract_MP', 'ASC')
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

                $dataP = DB::table('MP_Datas')
                    ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                    ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                        return $q->whereBetween('MP_Datacars.Date_Appcar',[$newfdate,$newtdate]);
                    })
                    ->where('MP_Datacars.Approvers_car','<>','')
                    ->where('MP_Datas.Type_Con','not like','P06%')
                    ->where('MP_Datas.Type_Con','not like','P07%')
                    ->orderBy('MP_Datas.Contract_MP', 'ASC')
                    ->get();

                $dataM = DB::table('MP_Datas')
                    ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                    ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                        return $q->whereBetween('MP_Datacars.Date_Appcar',[$newfdate,$newtdate]);
                    })
                    ->where('MP_Datacars.Approvers_car','<>','')
                    ->where('MP_Datas.Type_Con','not like','P03%')
                    ->where('MP_Datas.Type_Con','not like','P04%')
                    ->orderBy('MP_Datas.Contract_MP', 'ASC')
                    ->get();
            }
            $CountData = count($data);
            $CountPloan = count($dataP);
            $CountMicro = count($dataM);

            if ($newfdate == false and $newtdate == false) {
                $newfdate = date('Y-m-d');
                $newtdate = date('Y-m-d');
            }

            $count = 0;
            if ($request->Flag == '2') {
                $topcar = DB::table('buyers')
                    ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                    ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                    ->whereBetween('buyers.Date_Due',[$newfdate,$newtdate])
                    ->get();
                $count = count($topcar);

                if($count != 0){
                    for ($i=0; $i < $count; $i++) {
                        @$SumTopcar += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                        @$SumCommissioncar += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                        @$SumCommitprice += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                    }
                }else{
                    $SumTopcar = 0;
                    $SumCommissioncar = 0;
                    $SumCommitprice = 0;
                }
            }
            elseif ($request->Flag == '3' or $request->Flag == '4') {
                $topcar = DB::table('MP_Datas')
                    ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                    ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                    ->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate])
                    ->get();
                $count = count($topcar);

                $SumTopcar = 0;
                $SumCommissioncar = 0;
                $SumCommitprice = 0;
                $SumTopcarP = 0;
                $SumCommitpriceP = 0;
                $SumTopcarM = 0;
                $SumCommitpriceM = 0;

                if($count != 0){
                    for ($i=0; $i < $count; $i++) {
                        if ($topcar[$i]->Type_Con == 'P03' or $topcar[$i]->Type_Con == 'P04') {
                            @$SumTopcarP += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                            @$SumCommissionP += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                            @$SumCommitpriceP += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                        }
                        elseif ($topcar[$i]->Type_Con == 'P06' or $topcar[$i]->Type_Con == 'P007') {
                            @$SumTopcarM += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                            @$SumCommissionM+= $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                            @$SumCommitpriceM+= $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                        }
                    }
                }
            }

            $Flag = $request->Flag;
            $type = $request->type;
            return view('treasury.view', 
                   compact('data','dataP','dataM','newfdate','newtdate','SumTopcar','SumCommissioncar','SumCommitprice','SumTopcarP','SumCommissionP','SumCommitpriceP','SumTopcarM','SumCommissionM','SumCommitpriceM',
                           'CountData','CountPloan','CountMicro','type','Flag'));
        }
    }

    public function SearchData(Request $request, $type, $id)
    {
        if ($type == 1 or $type == 2) {
            $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                    ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                    ->select('buyers.*','sponsors.*','cardetails.*','Expenses.*','buyers.created_at AS createdBuyers_at')
                    ->where('buyers.id', $id)
                    ->first();

                    // dd($data);

            if ($data->Payee_car != NULL) {
                $SetAccount = str_replace ("-","",$data->Accountbrance_car);
                $SetTell = str_replace ("-","",$data->Tellbrance_car);
            }else {
                $SetAccount = "";
                $SetTell = "";
            }

            if ($data->Payee_car != NULL) {
                $SetAccountGT = str_replace ("-","",$data->Accountagent_car);
                $SetTellGT = str_replace ("-","",$data->Tellagent_car);
            }else {
                $SetAccountGT = "";
                $SetTellGT = "";
            }

            $GetType = $type;
            return view('treasury.viewDetail', compact('data','GetType','SetAccount','SetTell','SetAccountGT','SetTellGT'));
        }
        elseif ($type == 3) {
            $data = DB::table('buyers')
                ->leftJoin('cardetails','buyers.id','=','cardetails.Buyercar_id')
                ->where('cardetails.Date_Appcar','>=',date('Y-m-d'))
                ->where('cardetails.UserCheckAc_car','=',Null)
                ->where('buyers.Contract_buyer','not like', '22%')
                ->where('buyers.Contract_buyer','not like', '33%')
                ->get();

            $dataMP = DB::table('MP_Datas')
                ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->where('MP_Datacars.Date_Appcar','>=',date('Y-m-d'))
                ->where('MP_Datacars.UserCheckAc_car','=',Null)
                ->get();
        
            
            $countData = Count($data) + Count($dataMP);

            if ($countData == 0) {
               $countData = NULL;
            }else {
               $countData = '<span class="badge badge-danger navbar-badge">'.$countData.'</span>';
            }
            
            echo $countData;
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->type == 1) {      //update Analysis
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

        if ($type == 1) {       //เช่าซื้อ
            $dataReport = DB::table('buyers')
                ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
                })
                ->where('buyers.Contract_buyer','not like', '22%')
                ->where('buyers.Contract_buyer','not like', '33%')
                ->orderBy('buyers.Contract_buyer', 'ASC')
                ->get();

            $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
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
        elseif ($type == 2) {   //PLoan
            $dataReport = DB::table('MP_Datas')
                ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
                })
                ->where('MP_Datas.Type_Con','not like','P06%')
                ->where('MP_Datas.Type_Con','not like','P07%')
                ->orderBy('MP_Datas.Contract_MP', 'ASC')
                ->get();

            $type = 101;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
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
        elseif ($type == 3) {   //Micro
            $dataReport = DB::table('MP_Datas')
            ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
            ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
            })
            ->where('MP_Datas.Type_Con','not like','P03%')
            ->where('MP_Datas.Type_Con','not like','P04%')
            ->orderBy('MP_Datas.Contract_MP', 'ASC')
            ->get();

            $type = 102;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
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
        // elseif ($type == 3) {
        //     $dataReport = DB::table('buyers')
        //     ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
        //     ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
        //     ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
        //         return $q->whereBetween('cardetails.DateCheckAc_car',[$newfdate,$newtdate]);
        //     })
        //     ->where('cardetails.UserCheckAc_car','<>',NULL)
        //     ->orderBy('buyers.Contract_buyer', 'ASC')
        //     ->get();

        //     dd('ยังไม่เปิดให้ใช้งาน');

        //     $view = \View::make('treasury.reportTreas' ,compact('dataReport','type','newfdate','newtdate'));
        //     $html = $view->render();
        //     $pdf = new PDF();
        //     $pdf::SetTitle('รายงานแผนกการเงิน');
        //     $pdf::AddPage('L', 'A4');
        //     $pdf::SetMargins(5, 5, 5, 0);
        //     $pdf::SetFont('freeserif', '', 8, '', true);
        //     $pdf::SetAutoPageBreak(TRUE, 25);

        //     $pdf::WriteHTML($html,true,false,true,false,'');
        //     $pdf::Output('report.pdf');
        // }
    }
}
