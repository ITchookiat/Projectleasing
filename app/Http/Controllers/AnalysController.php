<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;

use App\Buyer;
use App\Sponsor;
use App\Sponsor2;
use App\Cardetail;
use App\homecardetail;
use App\UploadfileImage;
use App\Expenses;
use Carbon\Carbon;
use Helper;

class AnalysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;

      if ($request->type == 1){ //สินเชื่อ

        // if(auth()->user()->type != 1 and auth()->user()->type != 2 and auth()->user()->type != 4){
        //   dd('You not admin');
        // }

        $newfdate = '';
        $newtdate = '';
        $branch = '';
        $status = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if (session()->has('fdate')){
          $fdate = session('fdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }

        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }
        if (session()->has('tdate')){
          $tdate = session('tdate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }

        if ($request->has('branch')) {
          $branch = $request->get('branch');
        }
        if (session()->has('branch')){
          $branch = session('branch');
        }

        if ($request->has('status')) {
          $status = $request->get('status');
        }
        if (session()->has('status')){
          $status = session('status');
        }

        if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
          if (session()->has('fdate') != false or $request->has('tdate') != false) {
            $data = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
            ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
            })
            ->when(!empty($branch), function($q) use($branch){
              return $q->where('cardetails.branch_car',$branch);
            })
            ->when(!empty($status), function($q) use($status){
              return $q->where('cardetails.StatusApp_car','=',$status);
            })
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

          }else {
            $data = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
            ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
            ->where('cardetails.Approvers_car','=',Null)
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();
          }

        }else {
          // dd($branch);
            $data = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
            ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
            })
            ->when(!empty($branch), function($q) use($branch){
              return $q->where('cardetails.branch_car',$branch);
            })
            ->when(!empty($status), function($q) use($status){
              return $q->where('cardetails.StatusApp_car','=',$status);
            })
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();
        }

        // dd($data);
        $type = $request->type;
        $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
        $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');

        $datesum = date('Y-m-d');

        $topcar = DB::table('buyers')
        ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
        ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
        ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
        // ->where('buyers.Date_Due', '=', $datesum)
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

        return view('analysis.view', compact('type', 'data','branch','newfdate','newtdate','status','Setdate','SumTopcar','SumCommissioncar','SumCommitprice'));
      }
      elseif ($request->type == 2){
        return view('analysis.createbuyer');
      }
      elseif ($request->type == 3){ //รายงาน สินเชื่อ
        $datadrop = DB::table('buyers')
        ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
        ->select('cardetails.Agent_car', DB::raw('count(*) as total'))
        ->where('cardetails.Agent_car','<>',Null)
        ->groupBy('cardetails.Agent_car')
        ->get();

        $datayear = DB::table('buyers')
        ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
        ->select('cardetails.Year_car', DB::raw('count(*) as total'))
        ->where('cardetails.Year_car','<>',Null)
        ->groupBy('cardetails.Year_car')
        ->get();

        $datastatus = DB::table('buyers')
        ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
        ->select('cardetails.status_car', DB::raw('count(*) as total'))
        ->where('cardetails.status_car','<>',Null)
        ->groupBy('cardetails.status_car')
        ->get();

        $databranch = DB::table('buyers')
        ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
        ->select('cardetails.branch_car', DB::raw('count(*) as total'))
        ->where('cardetails.branch_car','<>',Null)
        ->groupBy('cardetails.branch_car')
        ->get();

        $newfdate = '';
        $newtdate = '';
        $agen = '';
        $yearcar = '';
        $typecar = '';
        $branch = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }
        if ($request->has('agen')) {
          $agen = $request->get('agen');
        }
        if ($request->has('yearcar')) {
          $yearcar = $request->get('yearcar');
        }
        if ($request->has('typecar')) {
          $typecar = $request->get('typecar');
        }
        if ($request->has('branch')) {
          $branch = $request->get('branch');
        }


        if ($request->has('Fromdate') == false and $request->has('Todate') == false and $request->has('agen') == false) {
          $data = DB::table('buyers')
          ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
          ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
          ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
          ->where('cardetails.Approvers_car','!=',Null)
          ->orderBy('buyers.Contract_buyer', 'ASC')
          ->get();

          // dd($data);
        }else {
          $data = DB::table('buyers')
          ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
          ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
          ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
          ->where('cardetails.Approvers_car','!=',Null)
          ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
            return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
          })
          ->when(!empty($agen), function($q) use($agen){
            return $q->where('cardetails.Agent_car',$agen);
          })
          ->when(!empty($yearcar), function($q) use($yearcar){
            return $q->where('cardetails.Year_car',$yearcar);
          })
          ->when(!empty($typecar), function($q) use($typecar){
            return $q->where('cardetails.status_car',$typecar);
          })
          ->when(!empty($branch), function($q) use($branch){
            return $q->where('cardetails.branch_car',$branch);
          })
          ->orderBy('buyers.Contract_buyer', 'ASC')
          ->get();
        }

        // dd($data);

        if ($newfdate != '' and $newtdate != '') {
          $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
          $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
        }elseif ($newfdate == '' or $newtdate == '') {
        }
        $type = $request->type;
        return view('analysis.viewReport', compact('type', 'data','newfdate','newtdate','datadrop','agen','datedue','datayear','yearcar','datastatus','typecar','databranch','branch'));
      }
      elseif ($request->type == 4){ //รถบ้าน
        $newfdate = '';
        $newtdate = '';
        $status = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if (session()->has('fdate')){
          $fdate = session('fdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }

        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }
        if (session()->has('tdate')){
          $tdate = session('tdate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }

        if ($request->has('status')) {
          $status = $request->get('status');
        }
        if (session()->has('status')){
          $status = session('status');
        }

        if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
            if (session()->has('fdate') != false or $request->has('tdate') != false) {
              $data = DB::table('buyers')
              ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
              ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
              })
              ->when(!empty($status), function($q) use($status){
                return $q->where('homecardetails.statusapp_HC','=',$status);
              })
              ->orderBy('buyers.Contract_buyer', 'ASC')
              ->get();

            }else {
              $data = DB::table('buyers')
              ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
              ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
              ->where('homecardetails.dateapp_HC','=',Null)
              ->orderBy('buyers.Contract_buyer', 'ASC')
              ->get();
            }

        }else {
            $data = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
            })
            ->when(!empty($status), function($q) use($status){
              return $q->where('homecardetails.statusapp_HC','=',$status);
            })
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();
        }

        $type = $request->type;
        $SumTopcar = 0;
        $SumCommissioncar = 0;
        $SumCommitprice = 0;

        $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
        $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');

        return view('analysis.view', compact('type', 'data','newfdate','newtdate','status','SumTopcar','SumCommissioncar','SumCommitprice'));
      }
      elseif ($request->type == 5){
        return view('analysis.createhomecar');
      }
      elseif ($request->type == 6){ //รายงาน รถบ้าน

        $datadrop = DB::table('buyers')
                  ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                  ->select('homecardetails.agent_HC', DB::raw('count(*) as total'))
                  ->where('homecardetails.agent_HC','<>',Null)
                  ->groupBy('homecardetails.agent_HC')
                  ->get();

        $datayear = DB::table('buyers')
                  ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                  ->select('homecardetails.year_HC', DB::raw('count(*) as total'))
                  ->where('homecardetails.year_HC','<>',Null)
                  ->groupBy('homecardetails.year_HC')
                  ->get();

        $newfdate = '';
        $newtdate = '';
        $agen = '';
        $yearcar = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }
        if ($request->has('agen')) {
          $agen = $request->get('agen');
        }
        if ($request->has('yearcar')) {
          $yearcar = $request->get('yearcar');
        }

        if ($request->has('Fromdate') == false and $request->has('Todate') == false and $request->has('agen') == false) {
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                    ->where('homecardetails.approvers_HC','!=',Null)
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get();
        }else {
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                    ->where('homecardetails.approvers_HC','!=',Null)
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                      return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
                    })
                    ->when(!empty($agen), function($q) use($agen){
                      return $q->where('homecardetails.agent_HC',$agen);
                    })
                    ->when(!empty($yearcar), function($q) use($yearcar){
                      return $q->where('homecardetails.year_HC',$yearcar);
                    })
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get();
        }

        // dd($newfdate);
        if ($newfdate != '' and $newtdate != '') {
          $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
          $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
        }elseif ($newfdate == '' or $newtdate == '') {
          // dd('123456');
        }

        $type = $request->type;
        return view('analysis.viewReport', compact('type', 'data','newfdate','newtdate','datadrop','agen','datedue','datayear','yearcar'));
      }
      elseif($request->type == 7){ //รายงานส่งผู้บริหาร
        $approvedate = date('Y-m-d');
        if ($request->has('Approvedate')) {
          $approvedate = $request->get('Approvedate');
          $approvedate = \Carbon\Carbon::parse($approvedate)->format('Y') ."-". \Carbon\Carbon::parse($approvedate)->format('m')."-". \Carbon\Carbon::parse($approvedate)->format('d');
        }
        $dataReport = DB::table('buyers')
                        ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                        ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                        ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                        ->when(!empty($approvedate), function($q) use($approvedate){
                          return $q->where('cardetails.Date_Appcar',$approvedate);
                        })
                        ->where('cardetails.Approvers_car','<>','')
                        ->orderBy('buyers.Contract_buyer', 'ASC')
                        ->get();
        $type = $request->type;
        return view('analysis.viewReport', compact('type', 'dataReport','approvedate'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $SetDateDue = str_replace ("/","-",$request->get('DateDue'));
      $dateConvert0 = date_create($SetDateDue);
      $DateDue = date_format($dateConvert0, 'Y-m-d');
      $BeforeIncome = str_replace (",","",$request->get('Beforeincome'));
      $AfterIncome = str_replace (",","",$request->get('Afterincome'));
      if($BeforeIncome == ''){
        $BeforeIncome = '0';
      }
      if($AfterIncome == ''){
        $AfterIncome = '0';
      }

      $newDateDue = \Carbon\Carbon::parse($request->DateDue)->format('Y') ."-". \Carbon\Carbon::parse($request->DateDue)->format('m')."-". \Carbon\Carbon::parse($request->DateDue)->format('d');
      $SetPhonebuyer = str_replace ( "_","",$request->get('Phonebuyer'));
      // dd($newDateDue);

      $Buyerdb = new Buyer([
        'Contract_buyer' => $request->get('Contract_buyer'),
        'Date_Due' => $newDateDue,
        'Name_buyer' => $request->get('Namebuyer'),
        'last_buyer' => $request->get('lastbuyer'),
        'Nick_buyer' => $request->get('Nickbuyer'),
        'Status_buyer' => $request->get('Statusbuyer'),
        'Phone_buyer' => $SetPhonebuyer,
        'Phone2_buyer' => $request->get('Phone2buyer'),
        'Mate_buyer' => $request->get('Matebuyer'),
        'Idcard_buyer' => $request->get('Idcardbuyer'),
        'Address_buyer' => $request->get('Addressbuyer'),
        'AddN_buyer' => $request->get('AddNbuyer'),
        'StatusAdd_buyer' => $request->get('StatusAddbuyer'),
        'Workplace_buyer' => $request->get('Workplacebuyer'),
        'House_buyer' => $request->get('Housebuyer'),
        'Driver_buyer' => $request->get('Driverbuyer'),
        'HouseStyle_buyer' => $request->get('HouseStylebuyer'),
        'Career_buyer' => $request->get('Careerbuyer'),
        'Income_buyer' => $request->get('Incomebuyer'),
        'Purchase_buyer' => $request->get('Purchasebuyer'),
        'Support_buyer' => $request->get('Supportbuyer'),
        'securities_buyer' => $request->get('securitiesbuyer'),
        'deednumber_buyer' => $request->get('deednumberbuyer'),
        'area_buyer' => $request->get('areabuyer'),
        'BeforeIncome_buyer' => $BeforeIncome,
        'AfterIncome_buyer' => $AfterIncome,
        'Gradebuyer_car' => $request->get('Gradebuyer'),
      ]);
      $Buyerdb->save();

      $SettelSP = str_replace ("_","",$request->get('telSP'));
      $Sponsordb = new Sponsor([
        'Buyer_id' => $Buyerdb->id,
        'name_SP' => $request->get('nameSP'),
        'lname_SP' => $request->get('lnameSP'),
        'nikname_SP' => $request->get('niknameSP'),
        'status_SP' => $request->get('statusSP'),
        'tel_SP' => $SettelSP,
        'relation_SP' => $request->get('relationSP'),
        'mate_SP' => $request->get('mateSP'),
        'idcard_SP' => $request->get('idcardSP'),
        'add_SP' => $request->get('addSP'),
        'addnow_SP' => $request->get('addnowSP'),
        'statusadd_SP' => $request->get('statusaddSP'),
        'workplace_SP' => $request->get('workplaceSP'),
        'house_SP' => $request->get('houseSP'),
        'deednumber_SP' => $request->get('deednumberSP'),
        'area_SP' => $request->get('areaSP'),
        'housestyle_SP' => $request->get('housestyleSP'),
        'career_SP' => $request->get('careerSP'),
        'income_SP' => $request->get('incomeSP'),
        'puchase_SP' => $request->get('puchaseSP'),
        'support_SP' => $request->get('supportSP'),
        'securities_SP' => $request->get('securitiesSP'),
      ]);
      $Sponsordb->save();

      $SettelSP2 = str_replace ("_","",$request->get('telSP2'));
      $Sponsor2db = new Sponsor2([
        'Buyer_id2' => $Buyerdb->id,
        'name_SP2' => $request->get('nameSP2'),
        'lname_SP2' => $request->get('lnameSP2'),
        'nikname_SP2' => $request->get('niknameSP2'),
        'status_SP2' => $request->get('statusSP2'),
        'tel_SP2' => $SettelSP2,
        'relation_SP2' => $request->get('relationSP2'),
        'mate_SP2' => $request->get('mateSP2'),
        'idcard_SP2' => $request->get('idcardSP2'),
        'add_SP2' => $request->get('addSP2'),
        'addnow_SP2' => $request->get('addnowSP2'),
        'statusadd_SP2' => $request->get('statusaddSP2'),
        'workplace_SP2' => $request->get('workplaceSP2'),
        'house_SP2' => $request->get('houseSP2'),
        'deednumber_SP2' => $request->get('deednumberSP2'),
        'area_SP2' => $request->get('areaSP2'),
        'housestyle_SP2' => $request->get('housestyleSP2'),
        'career_SP2' => $request->get('careerSP2'),
        'income_SP2' => $request->get('incomeSP2'),
        'puchase_SP2' => $request->get('puchaseSP2'),
        'support_SP2' => $request->get('supportSP2'),
        'securities_SP2' => $request->get('securitiesSP2'),
      ]);
      $Sponsor2db->save();

      if ($request->get('Topcar') != Null) {
        $SetTopcar = str_replace (",","",$request->get('Topcar'));
      }else {
        $SetTopcar = 0;
      }

      if ($request->get('Commissioncar') != Null) {
        $SetCommissioncar = str_replace (",","",$request->get('Commissioncar'));
      }else {
        $SetCommissioncar = 0;
      }

      if (auth()->user()->branch == 10 or auth()->user()->branch == 11 or auth()->user()->type == 4) {
        $Homecardetaildb = new homecardetail([
          'Buyerhomecar_id' => $Buyerdb->id,
          'brand_HC' => $request->get('brandHC'),
          'year_HC' => $request->get('yearHC'),
          'colour_HC' => $request->get('colourHC'),
          'oldplate_HC' => $request->get('oldplateHC'),
          'newplate_HC' => $request->get('newplateHC'),
          'mile_HC' => $request->get('mileHC'),
          'model_HC' => $request->get('modelHC'),
          'type_HC' => $request->get('typeHC'),
          'price_HC' => $request->get('priceHC'),
          'downpay_HC' => $request->get('downpayHC'),
          'insurancefee_HC' => $request->get('insurancefeeHC'),
          'transfer_HC' => $request->get('transferHC'),
          'topprice_HC' => $request->get('toppriceHC'),
          'interest_HC' => $request->get('interestHC'),
          'vat_HC' => $request->get('vatHC'),
          'period_HC' => $request->get('periodHC'),
          'paypor_HC' => $request->get('payporHC'),
          'payment_HC' => $request->get('paymentHC'),
          'payperriod_HC' => $request->get('payperriodHC'),
          'tax_HC' => $request->get('taxHC'),
          'taxperriod_HC' => $request->get('taxperriodHC'),
          'totalinstalments_HC' => $request->get('totalinstalmentsHC'),
          'baab_HC' => $request->get('baabHC'),
          'guarantee_HC' => $request->get('guaranteeHC'),
          'firstpay_HC' => $request->get('firstpayHC'),
          'insurance_HC' => $request->get('insuranceHC'),
          'agent_HC' => $request->get('agentHC'),
          'tel_HC' => $request->get('telHC'),
          'commit_HC' => $request->get('commitHC'),
          'purchhis_HC' => $request->get('purchhisHC'),
          'supporthis_HC' => $request->get('supporthisHC'),
          'other_HC' => $request->get('otherHC'),
          'sale_HC' => $request->get('saleHC'),
          'approvers_HC' => $request->get('approversHC'),
          'contrac_HC' => $request->get('contracHC'),
          'totalinstalments1_HC' => $request->get('totalinstalments1HC'),
          'insurancekey_HC' => $request->get('insurancekeyHC'),
          'dateapp_HC' => Null,
          'statusapp_HC' => 'รออนุมัติ',
          'branchUS_HC' => $request->get('branchUSHC'),
          'note_HC' => $request->get('noteHC'),
        ]);
        $Homecardetaildb ->save();

        $type = 4;
      }else {

        // dd($request->get('Midpricecar'));

        $Cardetaildb = new Cardetail([
          'Buyercar_id' => $Buyerdb->id,
          'Brand_car' => $request->get('Brandcar'),
          'Year_car' => $request->get('Yearcar'),
          'Colour_car' => $request->get('Colourcar'),
          'License_car' => $request->get('Licensecar'),
          'Nowlicense_car' => $request->get('Nowlicensecar'),
          'Mile_car' => $request->get('Milecar'),
          'Midprice_car' => $request->get('Midpricecar'),
          'Model_car' => $request->get('Modelcar'),
          'Top_car' => $SetTopcar,
          'Interest_car' => $request->get('Interestcar'),
          'Vat_car' => $request->get('Vatcar'),
          'Timeslacken_car' => $request->get('Timeslackencar'),
          'Pay_car' => $request->get('Paycar'),
          'Paymemt_car' => $request->get('Paymemtcar'),
          'Timepayment_car' => $request->get('Timepaymentcar'),
          'Tax_car' => $request->get('Taxcar'),
          'Taxpay_car' => $request->get('Taxpaycar'),
          'Totalpay1_car' => $request->get('Totalpay1car'),
          'Totalpay2_car' => $request->get('Totalpay2car'),
          'Dateduefirst_car' => $request->get('Dateduefirstcar'),
          'Insurance_car' => $request->get('Insurancecar'),
          'status_car' => $request->get('statuscar'),
          'Percent_car' => $request->get('Percentcar'),
          'Payee_car' => $request->get('Payeecar'),
          'Accountbrance_car' => $request->get('Accountbrancecar'),
          'Tellbrance_car' => $request->get('Tellbrancecar'),
          'Agent_car' => $request->get('Agentcar'),
          'Accountagent_car' => $request->get('Accountagentcar'),
          'Commission_car' => $SetCommissioncar,
          'Tellagent_car' => $request->get('Tellagentcar'),
          'Purchasehistory_car' => $request->get('Purchasehistorycar'),
          'Supporthistory_car' => $request->get('Supporthistorycar'),
          'Loanofficer_car' => $request->get('Loanofficercar'),
          'Approvers_car' => $request->get('Approverscar'),
          'Date_Appcar' => Null,
          'Check_car' => Null,
          'StatusApp_car' => 'รออนุมัติ',
          'DocComplete_car' => $request->get('doccomplete'),
          'branch_car' => $request->get('branchcar'),
          'branchbrance_car' => $request->get('branchbrancecar'),
          'branchAgent_car' => $request->get('branchAgentcar'),
          'Note_car' => $request->get('Notecar'),
          'Insurance_key' => $request->get('Insurancekey'),
        ]);
        $Cardetaildb ->save();

        if ($request->get('tranPrice') != Null) {
          $SettranPrice = str_replace (",","",$request->get('tranPrice'));
        }else {
          $SettranPrice = 0;
        }
        if ($request->get('otherPrice') != Null) {
          $SetotherPrice = str_replace (",","",$request->get('otherPrice'));
        }else {
          $SetotherPrice = 0;
        }
        if ($request->get('totalkPrice') != Null) {
          $SettotalkPrice = str_replace (",","",$request->get('totalkPrice'));
        }else {
          $SettotalkPrice = 0;
        }
        if ($request->get('balancePrice') != Null) {
          $SetbalancePrice = str_replace (",","",$request->get('balancePrice'));
        }else {
          $SetbalancePrice = 0;
        }
        if ($request->get('commitPrice') != Null) {
          $SetcommitPrice = str_replace (",","",$request->get('commitPrice'));
        }else {
          $SetcommitPrice = 0;
        }
        if ($request->get('actPrice') != Null) {
          $SetactPrice = str_replace (",","",$request->get('actPrice'));
        }else {
          $SetactPrice = 0;
        }
        if ($request->get('closeAccountPrice') != Null) {
          $SetcloseAccountPrice = str_replace (",","",$request->get('closeAccountPrice'));
        }else {
          $SetcloseAccountPrice = 0;
        }
        if ($request->get('P2Price') != Null) {
          $SetP2Price = str_replace (",","",$request->get('P2Price'));
        }else {
          $SetP2Price = 0;
        }

        $Expensesdb = new Expenses([
          'Buyerexpenses_id' => $Buyerdb->id,
          'act_Price' => $SetactPrice,
          'closeAccount_Price' => $SetcloseAccountPrice,
          'P2_Price' => $SetP2Price,
          'vat_Price' => $request->get('vatPrice'),
          'tran_Price' => $SettranPrice,
          'other_Price' => $SetotherPrice,
          'evaluetion_Price' => $request->get('evaluetionPrice'),
          'totalk_Price' => $SettotalkPrice,
          'balance_Price' => $SetbalancePrice,
          'commit_Price' => $SetcommitPrice,
          'marketing_Price' => $request->get('marketingPrice'),
          'duty_Price' => $request->get('dutyPrice'),
          'insurance_Price' => $request->get('insurancePrice'),
          'note_Price' => $request->get('notePrice'),
        ]);
        $Expensesdb ->save();

        $type = 1;
      }

      $image_new_name = "";
      if ($request->hasFile('file_image')) {
        $image_array = $request->file('file_image');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          $destination_path = public_path('/upload-image');
          $image_array[$i]->move($destination_path,$image_new_name);

          $Uploaddb = new UploadfileImage([
            'Buyerfileimage_id' => $Buyerdb->id,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }

      return redirect()->Route('Analysis',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$type,$fdate,$tdate,$branch,$status,Request $request)
    {

      if ($type == 1) {
        $data = DB::table('buyers')
                  ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
                  ->leftJoin('sponsor2s','buyers.id','=','sponsor2s.Buyer_id2')
                  ->leftJoin('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                  ->leftJoin('expenses','Buyers.id','=','expenses.Buyerexpenses_id')
                  ->where('buyers.id',$id)->first();

        $GetDocComplete = $data->DocComplete_car;
        $Gettype = $type;

        $type = $type;
        $fdate = $fdate;
        $tdate = $tdate;
        $branch = $branch;
        $status = $status;

        // dd($Getfdate);
      }
      elseif ($type == 4) {
        $data = DB::table('buyers')
                  ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
                  ->leftJoin('sponsor2s','buyers.id','=','sponsor2s.Buyer_id2')
                  ->leftJoin('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                  ->where('buyers.id',$id)->first();

        $Gettype = $type;
      }

      $dataImage = DB::table('uploadfile_images')->where('Buyerfileimage_id',$data->id)->get();
      $countImage = count($dataImage);
      $newDateDue = \Carbon\Carbon::parse($data->Date_Due)->format('Y') ."-". \Carbon\Carbon::parse($data->Date_Due)->format('m')."-". \Carbon\Carbon::parse($data->Date_Due)->format('d');

      $Statusby = [
        'โสด' => 'โสด',
        'สมรส' => 'สมรส',
        'หย่าร้าง' => 'หย่าร้าง',
      ];
      $Addby = [
        'ตามทะเบียนบ้าน' => 'ตามทะเบียนบ้าน',
      ];
      $Houseby = [
        'บ้านตึก 1 ชั้น' => 'บ้านตึก 1 ชั้น',
        'บ้านตึก 2 ชั้น' => 'บ้านตึก 2 ชั้น',
        'บ้านไม้ 1 ชั้น' => 'บ้านไม้ 1 ชั้น',
        'บ้านไม้ 2 ชั้น' => 'บ้านไม้ 2 ชั้น',
        'บ้านเดี่ยว' => 'บ้านเดี่ยว',
        'แฟลต' => 'แฟลต',
      ];
      $Driverby = [
        'มี' => 'มี',
        'ไม่มี' => 'ไม่มี',
      ];
      $HouseStyleby = [
        'ของตนเอง' => 'ของตนเอง',
        'อาศัยบิดา-มารดา' => 'อาศัยบิดา-มารดา',
        'อาศัยผู้อื่น' => 'อาศัยผู้อื่น',
        'บ้านพักราชการ' => 'บ้านพักราชการ',
        'บ้านเช่า' => 'บ้านเช่า',
      ];
      $Careerby = [
        'ตำรวจ' => 'ตำรวจ',
        'ทหาร' => 'ทหาร',
        'ครู' => 'ครู',
        'ข้าราชการอื่นๆ' => 'ข้าราชการอื่นๆ',
        'ลูกจ้างเทศบาล' => 'ลูกจ้างเทศบาล',
        'ลูกจ้างประจำ' => 'ลูกจ้างประจำ',
        'สมาชิก อบต.' => 'สมาชิก อบต.',
        'ลูกจ้างชั่วคราว' => 'ลูกจ้างชั่วคราว',
        'รับจ้าง' => 'รับจ้าง',
        'พนักงานบริษัทเอกชน' => 'พนักงานบริษัทเอกชน',
        'อาชีพอิสระ' => 'อาชีพอิสระ',
        'กำนัน' => 'กำนัน',
        'ผู้ใหญ่บ้าน' => 'ผู้ใหญ่บ้าน',
        'ผู้ช่วยผู้ใหญ่บ้าน' => 'ผู้ช่วยผู้ใหญ่บ้าน',
        'นักการภารโรง' => 'นักการภารโรง',
        'มอเตอร์ไซร์รับจ้าง' => 'มอเตอร์ไซร์รับจ้าง',
        'ค้าขาย' => 'ค้าขาย',
        'เจ้าของธุรกิจ' => 'เจ้าของธุรกิจ',
        'เจ้าของอู่รถ' => 'เจ้าของอู่รถ',
        'ให้เช่ารถบรรทุก' => 'ให้เช่ารถบรรทุก',
        'ช่างตัดผม' => 'ช่างตัดผม',
        'ชาวนา' => 'ชาวนา',
        'ชาวไร่' => 'ชาวไร่',
        'แม่บ้าน' => 'แม่บ้าน',
        'รับเหมาก่อสร้าง' => 'รับเหมาก่อสร้าง',
        'ประมง' => 'ประมง',
        'ทนายความ' => 'ทนายความ',
        'พระ' => 'พระ',
      ];
      $Incomeby = [
        '5,000 - 10,000' => '5,000 - 10,000',
        '10,000 - 15,000' => '10,000 - 15,000',
        '15,000 - 20,000' => '15,000 - 20,000',
        'มากกว่า 20,000' => 'มากกว่า 20,000',
      ];
      $HisCarby = [
        '0 คัน' => '0 คัน',
        '1 คัน' => '1 คัน',
        '2 คัน' => '2 คัน',
        '3 คัน' => '3 คัน',
        '4 คัน' => '4 คัน',
        '5 คัน' => '5 คัน',
        '6 คัน' => '6 คัน',
        '7 คัน' => '7 คัน',
        '8 คัน' => '8 คัน',
        '9 คัน' => '9 คัน',
        '10 คัน' => '10 คัน',
        '11 คัน' => '11 คัน',
        '12 คัน' => '12 คัน',
        '13 คัน' => '13 คัน',
        '14 คัน' => '14 คัน',
        '15 คัน' => '15 คัน',
        '16 คัน' => '16 คัน',
        '17 คัน' => '17 คัน',
        '18 คัน' => '18 คัน',
        '19 คัน' => '19 คัน',
        '20 คัน' => '20 คัน',
      ];
      $relationSPp = [
        'พี่น้อง' => 'พี่น้อง',
        'ญาติ' => 'ญาติ',
        'เพื่อน' => 'เพื่อน',
        'บิดา' => 'บิดา',
        'มารดา' => 'มารดา',
      ];
      $Brandcarr = [
        'ISUZU' => 'ISUZU',
        'MITSUBISHI' => 'MITSUBISHI',
        'TOYOTA' => 'TOYOTA',
        'MAZDA' => 'MAZDA',
        'FORD' => 'FORD',
        'NISSAN' => 'NISSAN',
        'HONDA' => 'HONDA',
        'CHEVROLET' => 'CHEVROLET',
        'MG' => 'MG',
        'SUZUKI' => 'SUZUKI',
      ];
      $Interestcarr = [
        '0.55' => '0.55',
        '0.65' => '0.65',
        '0.80' => '0.80',
        '0.90' => '0.90',
        '1.05' => '1.05',
        '1.20' => '1.20',
        '1.40' => '1.40',
        '1.55' => '1.55',
        '1.70' => '1.70',
      ];
      $Timeslackencarr = [
        '12' => '12',
        '18' => '18',
        '24' => '24',
        '30' => '30',
        '36' => '36',
        '42' => '42',
        '48' => '48',
        '54' => '54',
        '60' => '60',
        '66' => '66',
        '72' => '72',
        '78' => '78',
        '84' => '84',
      ];
      $Insurancecarr = [
        'แถม ป2+ 1ปี' => 'แถม ป2+ 1ปี',
        'ไม่แถม' => 'ไม่แถม',
        'ซื้อ ป2+ 1ป' => 'ซื้อ ป2+ 1ป',
        'ซื้อ ป1 1ปี' => 'ซื้อ ป1 1ปี',
        'มี ป1 อยู่แล้ว' => 'มี ป1 อยู่แล้ว',
      ];
      $statuscarr = [
        'กส.ค้ำมีหลักทรัพย์' => 'กส.ค้ำมีหลักทรัพย์',
        'กส.ค้ำไม่มีหลักทรัพย์' => 'กส.ค้ำไม่มีหลักทรัพย์',
        'กส.ไม่ค้ำประกัน' => 'กส.ไม่ค้ำประกัน',
        'ซข.ค้ำมีหลักทรัพย์' => 'ซข.ค้ำมีหลักทรัพย์',
        'ซข.ค้ำไม่มีหลักทรัพย์' => 'ซข.ค้ำไม่มีหลักทรัพย์',
        'ซข.ไม่ค้ำประกัน' => 'ซข.ไม่ค้ำประกัน',
        'VIP1' => 'VIP1',
      ];
      // $Loanofficercarr = [
      //   'นาย.ซอลาฮุดดีน ตอแก' => 'นาย.ซอลาฮุดดีน ตอแก',
      //   'นาง.วิธุกร ณ พิชัย' => 'นาง.วิธุกร ณ พิชัย',
      //   'นาง.วุฐิกุล ศุกลรัตน์' => 'นาง.วุฐิกุล ศุกลรัตน์',
      //   'นาย.ต่วนมุหยีดีน ลอจ' => 'นาย.ต่วนมุหยีดีน ลอจิ',
      //   'นาย.ฤทธิพร ดือราแม' => 'นาย.ฤทธิพร ดือราแม',
      //   'นาย.เดะมะ มะ' => 'นาย.เดะมะ มะ',
      //   'นาย.มะยูโซะ อามะ' => 'นาย.มะยูโซะ อามะ',
      //   'น.ส.รุสนีดา อูมา' => 'น.ส.รุสนีดา อูมา',
      //   'น.ส.ฮายาตี นิบง' => 'น.ส.ฮายาตี นิบง',
      //   'นาย.ซุลกิฟลี แมเราะ' => 'นาย.ซุลกิฟลี แมเราะ',
      //   'น.ส.สาลีละห์ เจะโซะ' => 'น.ส.สาลีละห์ เจะโซะ',
      //   'นาย.ฟิกรีย์ บาราเต๊ะ' => 'นาย.ฟิกรีย์ บาราเต๊ะ',
      //   'น.ส.ซูไฮดา สะมาแอ' => 'น.ส.ซูไฮดา สะมาแอ',
      //   'นาย.ธนวัฒน์ อาแว' => 'นาย.ธนวัฒน์ อาแว',
      //   'นาย.มัซวัน มะสาแม' => 'นาย.มัซวัน มะสาแม',
      //   'น.ส.เพ็ญทิพย์ หนูบุญล้อม' => 'น.ส.เพ็ญทิพย์ หนูบุญล้อม',
      // ];
      $evaluetionPricee = [
        '1,000' => '1,000',
        '1,500' => '1,500',
        '2,000' => '2,000',
        '2,500' => '2,500',
      ];
      $securitiesSPp = [
        'โฉนด' => 'โฉนด',
        'นส.3' => 'นส.3',
        'นส.3 ก' => 'นส.3 ก',
        'นส.4' => 'นส.4',
        'นส.4 จ' => 'นส.4 จ',
      ];
      $Getinsurance = [
        '0' => 'ลูกค้าโอนเอง',
        '7700' => '7700',
        '20000' => '20000',
      ];
      $Gettransfer = [
        '0' => 'ลูกค้าโอนเอง',
        '3950' => '3950',
        '4950' => '4950',
        '6950' => '6950',
      ];
      $Getinterest = [
        '0.55' => '0.55',
        '0.65' => '0.65',
        '0.70' => '0.70',
        '0.75' => '0.75',
        '0.85' => '0.85',
        '1.00' => '1.00',
        '1.20' => '1.20',
      ];
      $GetSale = [
        'มารูวัน หะยีเจะแม' => 'มารูวัน หะยีเจะแม',
        'แวยูคิมสี อาแว' => 'แวยูคิมสี อาแว',
        'อลิสา หิดาวรรณ' => 'อลิสา หิดาวรรณ',
        'ธัญญ์วรา สีลาภเกื้อ' => 'ธัญญ์วรา สีลาภเกื้อ',
      ];
      $GetypeHC = [
      'รถเทิร์น' => 'รถเทิร์น',
        'รถยึด' => 'รถยึด',
        'รถฝากขาย' => 'รถฝากขาย',
      ];
      $GetbaabHC = [
        'ซข.ค้ำมีหลักทรัพย์' => 'ซข.ค้ำมีหลักทรัพย์',
        'ซข.ค้ำไม่มีหลักทรัพย์' => 'ซข.ค้ำไม่มีหลักทรัพย์',
        'ซข.ไม่ค้ำประกัน' => 'ซข.ไม่ค้ำประกัน',
      ];
      $GetguaranteeHC = [
        'โฉนด' => 'โฉนด',
        'ข้าราชการ' => 'ข้าราชการ',
        'เจ้าบ้าน' => 'เจ้าบ้าน',
        'บุคคลธรรมดา' => 'บุคคลธรรมดา',
        'ไม่ค้ำ' => 'ไม่ค้ำ',
      ];
      $relationSP = [
        'พี่น้อง' => 'พี่น้อง',
        'ญาติ' => 'ญาติ',
        'เพื่อน' => 'เพื่อน',
        'บิดา' => 'บิดา',
        'มารดา' => 'มารดา',
        'บุตร' => 'บุตร',
      ];
      $GradeBuyer = [
        'ลูกค้าเก่าผ่อนดี' => 'ลูกค้าเก่าผ่อนดี',
        'ลูกค้ามีงานตาม' => 'ลูกค้ามีงานตาม',
        'ลูกค้าใหม่' => 'ลูกค้าใหม่',
        'ปิดจัดใหม่' => 'ปิดจัดใหม่',
      ];


      // dd($Gettype);
      if ($type == 1) {
        return view('Analysis.edit',
            compact('data','id','dataImage','Statusby','Addby','Houseby','Driverby','HouseStyleby','Careerby','Incomeby',
            'HisCarby','StatusSPp','relationSPp','addSPp','housestyleSPp','Brandcarr','Interestcarr','Timeslackencarr',
            'Insurancecarr','statuscarr','newDateDue','evaluetionPricee','securitiesSPp','GetDocComplete','Getinsurance',
            'Gettransfer','Getinterest','fdate','tdate','branch','status','type','Gettype','countImage','GradeBuyer'));
      }
      elseif ($type == 4) {
        return view('analysis.edithomecar',
            compact('data','id','dataImage','Statusby','Addby','Houseby','Driverby','HouseStyleby','Careerby','Incomeby',
            'HisCarby','StatusSPp','relationSPp','addSPp','housestyleSPp','Brandcarr','Interestcarr','Timeslackencarr',
            'Insurancecarr','statuscarr','newDateDue','evaluetionPricee','securitiesSPp','Getinsurance',
            'Gettransfer','Getinterest','fdate','tdate','branch','status','Gettype','GetSale','GetypeHC','GetbaabHC',
            'GetguaranteeHC','relationSP','countImage','GradeBuyer'));
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        date_default_timezone_set('Asia/Bangkok');

        $newDateDue = \Carbon\Carbon::parse($request->DateDue)->format('Y') ."-". \Carbon\Carbon::parse($request->DateDue)->format('m')."-". \Carbon\Carbon::parse($request->DateDue)->format('d');
        $SetPhonebuyer = str_replace ( "_","",$request->get('Phonebuyer'));

        $Getcardetail = Cardetail::where('Buyercar_id',$id)->first();
        $Gethomecardetail = homecardetail::where('Buyerhomecar_id',$id)->first();

        if ($request->get('Approverscar') != Null) {
          if ($Getcardetail->Date_Appcar == Null) {
            $Y = date('Y');
            $m = date('m');
            $d = date('d');

            $newDateDue = $Y.'-'.$m.'-'.$d;
          }
        }elseif ($request->get('approversHC') != Null) {
          if ($Gethomecardetail->dateapp_HC == Null) {
            $Y = date('Y');
            $m = date('m');
            $d = date('d');

            $newDateDue = $Y.'-'.$m.'-'.$d;
          }
        }

        $user = Buyer::find($id);
          $user->Contract_buyer = $request->get('Contract_buyer');
          $user->Date_Due = $newDateDue;
          $user->Name_buyer = $request->get('Namebuyer');
          $user->last_buyer = $request->get('lastbuyer');
          $user->Nick_buyer = $request->get('Nickbuyer');
          $user->Status_buyer = $request->get('Statusbuyer');
          $user->Phone_buyer = $SetPhonebuyer;
          $user->Phone2_buyer = $request->get('Phone2buyer');
          $user->Mate_buyer = $request->get('Matebuyer');
          $user->Idcard_buyer = $request->get('Idcardbuyer');
          $user->Address_buyer = $request->get('Addressbuyer');
          $user->AddN_buyer = $request->get('AddNbuyer');
          $user->StatusAdd_buyer = $request->get('StatusAddbuyer');
          $user->Workplace_buyer = $request->get('Workplacebuyer');
          $user->House_buyer = $request->get('Housebuyer');
          $user->Driver_buyer = $request->get('Driverbuyer');
          $user->HouseStyle_buyer = $request->get('HouseStylebuyer');
          $user->Career_buyer = $request->get('Careerbuyer');
          $user->Income_buyer = $request->get('Incomebuyer');
          $user->Purchase_buyer = $request->get('Purchasebuyer');
          $user->Support_buyer = $request->get('Supportbuyer');
          $user->securities_buyer = $request->get('securitiesbuyer');
          $user->deednumber_buyer = $request->get('deednumberbuyer');
          $user->BeforeIncome_buyer = str_replace(",","",$request->get('Beforeincome'));
          $user->AfterIncome_buyer = str_replace(",","",$request->get('Afterincome'));
          $user->Gradebuyer_car = $request->get('Gradebuyer');
        $user->update();

        $SettelSP = str_replace ("_","",$request->get('telSP'));

        $sponsor = Sponsor::where('Buyer_id',$id)->first();
          $sponsor->name_SP = $request->get('nameSP');
          $sponsor->lname_SP = $request->get('lnameSP');
          $sponsor->nikname_SP = $request->get('niknameSP');
          $sponsor->status_SP = $request->get('statusSP');
          $sponsor->tel_SP = $SettelSP;
          $sponsor->relation_SP = $request->get('relationSP');
          $sponsor->mate_SP = $request->get('mateSP');
          $sponsor->idcard_SP = $request->get('idcardSP');
          $sponsor->add_SP = $request->get('addSP');
          $sponsor->addnow_SP = $request->get('addnowSP');
          $sponsor->statusadd_SP = $request->get('statusaddSP');
          $sponsor->workplace_SP = $request->get('workplaceSP');
          $sponsor->house_SP = $request->get('houseSP');
          $sponsor->deednumber_SP = $request->get('deednumberSP');
          $sponsor->area_SP = $request->get('areaSP');
          $sponsor->housestyle_SP = $request->get('housestyleSP');
          $sponsor->career_SP = $request->get('careerSP');
          $sponsor->income_SP = $request->get('incomeSP');
          $sponsor->puchase_SP = $request->get('puchaseSP');
          $sponsor->support_SP = $request->get('supportSP');
          $sponsor->securities_SP = $request->get('securitiesSP');
        $sponsor->update();

        $SettelSP2 = str_replace ("_","",$request->get('telSP2'));

        $sponsor2 = Sponsor2::where('Buyer_id2',$id)->first();
          if ($sponsor2 != Null) {
            $sponsor2->name_SP2 = $request->get('nameSP2');
            $sponsor2->lname_SP2 = $request->get('lnameSP2');
            $sponsor2->nikname_SP2 = $request->get('niknameSP2');
            $sponsor2->status_SP2 = $request->get('statusSP2');
            $sponsor2->tel_SP2 = $SettelSP2;
            $sponsor2->relation_SP2 = $request->get('relationSP2');
            $sponsor2->mate_SP2 = $request->get('mateSP2');
            $sponsor2->idcard_SP2 = $request->get('idcardSP2');
            $sponsor2->add_SP2 = $request->get('addSP2');
            $sponsor2->addnow_SP2 = $request->get('addnowSP2');
            $sponsor2->statusadd_SP2 = $request->get('statusaddSP2');
            $sponsor2->workplace_SP2 = $request->get('workplaceSP2');
            $sponsor2->house_SP2 = $request->get('houseSP2');
            $sponsor2->deednumber_SP2 = $request->get('deednumberSP2');
            $sponsor2->area_SP2 = $request->get('areaSP2');
            $sponsor2->housestyle_SP2 = $request->get('housestyleSP2');
            $sponsor2->career_SP2 = $request->get('careerSP2');
            $sponsor2->income_SP2 = $request->get('incomeSP2');
            $sponsor2->puchase_SP2 = $request->get('puchaseSP2');
            $sponsor2->support_SP2 = $request->get('supportSP2');
            $sponsor2->securities_SP2 = $request->get('securitiesSP2');
          $sponsor2->update();
        }else {
          $SettelSP2 = str_replace ("_","",$request->get('telSP2'));
          $Sponsor2db = new Sponsor2([
            'Buyer_id2' => $id,
            'name_SP2' => $request->get('nameSP2'),
            'lname_SP2' => $request->get('lnameSP2'),
            'nikname_SP2' => $request->get('niknameSP2'),
            'status_SP2' => $request->get('statusSP2'),
            'tel_SP2' => $SettelSP2,
            'relation_SP2' => $request->get('relationSP2'),
            'mate_SP2' => $request->get('mateSP2'),
            'idcard_SP2' => $request->get('idcardSP2'),
            'add_SP2' => $request->get('addSP2'),
            'addnow_SP2' => $request->get('addnowSP2'),
            'statusadd_SP2' => $request->get('statusaddSP2'),
            'workplace_SP2' => $request->get('workplaceSP2'),
            'house_SP2' => $request->get('houseSP2'),
            'deednumber_SP2' => $request->get('deednumberSP2'),
            'area_SP2' => $request->get('areaSP2'),
            'housestyle_SP2' => $request->get('housestyleSP2'),
            'career_SP2' => $request->get('careerSP2'),
            'income_SP2' => $request->get('incomeSP2'),
            'puchase_SP2' => $request->get('puchaseSP2'),
            'support_SP2' => $request->get('supportSP2'),
            'securities_SP2' => $request->get('securitiesSP2'),
          ]);
          $Sponsor2db->save();
        }

      if (auth()->user()->branch == 10 or auth()->user()->branch == 11 or auth()->user()->type == 4) {

        $Homecardetail = homecardetail::where('Buyerhomecar_id',$id)->first();
          $Homecardetail->brand_HC = $request->get('brandHC');
          $Homecardetail->year_HC = $request->get('yearHC');
          $Homecardetail->colour_HC = $request->get('colourHC');
          $Homecardetail->oldplate_HC = $request->get('oldplateHC');
          $Homecardetail->newplate_HC = $request->get('newplateHC');
          $Homecardetail->mile_HC = $request->get('mileHC');
          $Homecardetail->model_HC = $request->get('modelHC');
          $Homecardetail->type_HC = $request->get('typeHC');
          $Homecardetail->price_HC = $request->get('priceHC');
          $Homecardetail->downpay_HC = $request->get('downpayHC');
          $Homecardetail->insurancefee_HC = $request->get('insurancefeeHC');
          $Homecardetail->transfer_HC = $request->get('transferHC');
          $Homecardetail->topprice_HC = $request->get('toppriceHC');
          $Homecardetail->interest_HC = $request->get('interestHC');
          $Homecardetail->vat_HC = $request->get('vatHC');
          $Homecardetail->period_HC = $request->get('periodHC');
          $Homecardetail->paypor_HC = $request->get('payporHC');
          $Homecardetail->payment_HC = $request->get('paymentHC');
          $Homecardetail->payperriod_HC = $request->get('payperriodHC');
          $Homecardetail->tax_HC = $request->get('taxHC');
          $Homecardetail->taxperriod_HC = $request->get('taxperriodHC');
          $Homecardetail->totalinstalments_HC = $request->get('totalinstalmentsHC');
          $Homecardetail->baab_HC = $request->get('baabHC');
          $Homecardetail->guarantee_HC = $request->get('guaranteeHC');
          $Homecardetail->insurance_HC = $request->get('insuranceHC');
          $Homecardetail->agent_HC = $request->get('agentHC');
          $Homecardetail->tel_HC = $request->get('telHC');
          $Homecardetail->commit_HC = $request->get('commitHC');
          $Homecardetail->purchhis_HC = $request->get('purchhisHC');
          $Homecardetail->supporthis_HC = $request->get('supporthisHC');
          $Homecardetail->other_HC = $request->get('otherHC');
          $Homecardetail->sale_HC = $request->get('saleHC');

          if ($request->get('approversHC') != Null) {
            $SetStatusApp = 'อนุมัติ';

            if ($Homecardetail->dateapp_HC == Null) {
              $Y = date('Y') +543;
              $Y2 = date('Y');
              $m = date('m', strtotime('+1 month'));
              $m2 = date('m');
              $d = date('d');
              $datefirst = $d.'-'.$m.'-'.$Y;
              $dateApp = $Y2.'-'.$m2.'-'.$d;

              $Homecardetail->firstpay_HC = $datefirst;
              $Homecardetail->dateapp_HC = $dateApp;
              $SetStatusApp = 'อนุมัติ';


              $branchType = Null;
              if ($Homecardetail->branchUS_HC == "รถบ้าน") {
                  $branchType = 10;
              }elseif ($Homecardetail->branchUS_HC == "รถยืดขายผ่อน") {
                  $branchType = 11;
              }

              if ($branchType != Null) {
                if ($branchType == 10) { //สาขารถบ้าน
                  $connect = Buyer::where('Contract_buyer', 'like', '10%' )
                                    ->orderBy('Contract_buyer', 'desc')->limit(1)
                                    ->get();
                }elseif ($branchType == 11) { //สาขารถยืดขายผ่อน
                  $connect = Buyer::where('Contract_buyer', 'like', '11%' )
                                    ->orderBy('Contract_buyer', 'desc')->limit(1)
                                    ->get();
                }

                $contract = $connect[0]->Contract_buyer;
                $SetStr = explode("/",$contract);
                $StrNum = $SetStr[1] + 1;

                $num = "1000";
                $SubStr = substr($num.$StrNum, -4);
                $StrConn = $SetStr[0]."/".$SubStr;

                $GetIdConn = Buyer::where('id',$id)->first();
                  $GetIdConn->Contract_buyer = $StrConn;
                $GetIdConn->update();
              }
            }
          }else {
            $SetStatusApp = 'รออนุมัติ';
          }

          $Homecardetail->approvers_HC = $request->get('approversHC');
          $Homecardetail->totalinstalments1_HC = $request->get('totalinstalments1HC');
          $Homecardetail->statusapp_HC = $SetStatusApp;
        $Homecardetail->update();
      }
      else {
          if ($request->get('Topcar') != Null) {
            $SetTopcar = str_replace (",","",$request->get('Topcar'));
          }else {
            $SetTopcar = 0;
          }

          if ($request->get('Commissioncar') != Null) {
            $SetCommissioncar = str_replace (",","",$request->get('Commissioncar'));
          }else {
            $SetCommissioncar = 0;
          }

          $cardetail = Cardetail::where('Buyercar_id',$id)->first();
            $cardetail->Brand_car = $request->get('Brandcar');
            $cardetail->Year_car = $request->get('Yearcar');
            $cardetail->Colour_car = $request->get('Colourcar');
            $cardetail->License_car = $request->get('Licensecar');
            $cardetail->Nowlicense_car = $request->get('Nowlicensecar');
            $cardetail->Mile_car = $request->get('Milecar');
            $cardetail->Midprice_car = $request->get('Midpricecar');
            $cardetail->Model_car = $request->get('Modelcar');
            $cardetail->Top_car = $SetTopcar;
            $cardetail->Interest_car = $request->get('Interestcar');
            $cardetail->Vat_car = $request->get('Vatcar');
            $cardetail->Timeslacken_car = $request->get('Timeslackencar');
            $cardetail->Pay_car = $request->get('Paycar');
            $cardetail->Paymemt_car = $request->get('Paymemtcar');
            $cardetail->Timepayment_car = $request->get('Timepaymentcar');
            $cardetail->Tax_car = $request->get('Taxcar');
            $cardetail->Taxpay_car = $request->get('Taxpaycar');
            $cardetail->Totalpay1_car = $request->get('Totalpay1car');
            $cardetail->Totalpay2_car = $request->get('Totalpay2car');
            $cardetail->Insurance_key = $request->get('Insurancekey');

            if ($request->get('Approverscar') != Null) { //กรณี อนุมัติ
                $SetStatusApp = 'อนุมัติ';

              if ($cardetail->Approvers_car == Null) {
                $Y = date('Y') +543;
                $Y2 = date('Y');
                $m = date('m', strtotime('+1 month'));
                $m2 = date('m');
                $d = date('d');
                $test = date('d-m-Y', strtotime('+1 month'));
                $dateduebefore = \Carbon\Carbon::parse($test)->format('Y')+543 ."-". \Carbon\Carbon::parse($test)->format('m')."-". \Carbon\Carbon::parse($test)->format('d');
                $dateduechange = date_create($dateduebefore);
                $datefirst = date_format($dateduechange, 'd-m-Y');

                $dateApp = $Y2.'-'.$m2.'-'.$d;

                $cardetail->Dateduefirst_car = $datefirst;
                $cardetail->Date_Appcar = $dateApp;
                $SetStatusApp = 'อนุมัติ';

                $branchType = Null;
                if ($cardetail->branch_car == "ปัตตานี") {
                    $branchType = 01;
                }elseif ($cardetail->branch_car == "ยะลา") {
                    $branchType = 03;
                }elseif ($cardetail->branch_car == "นราธิวาส") {
                    $branchType = 04;
                }elseif ($cardetail->branch_car == "สายบุรี") {
                    $branchType = 05;
                }elseif ($cardetail->branch_car == "โกลก") {
                    $branchType = 06;
                }elseif ($cardetail->branch_car == "เบตง") {
                    $branchType = 07;
                }elseif ($cardetail->branch_car == "รถบ้าน") {
                    $branchType = 10;
                }elseif ($cardetail->branch_car == "รถยืดขายผ่อน") {
                    $branchType = 11;
                }

                if ($branchType != Null) {
                  if ($branchType == 01) { //สาขาปัตตานี
                    $connect = Buyer::where('Contract_buyer', 'like', '01%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  // dd($connect);
                  }elseif ($branchType == 03) { //สาขายะลา
                    $connect = Buyer::where('Contract_buyer', 'like', '03%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 04) { //สาขานรา
                    $connect = Buyer::where('Contract_buyer', 'like', '04%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 05) { //สาขาสายบรุี
                    $connect = Buyer::where('Contract_buyer', 'like', '05%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 06) { //สาขาโกลก
                    $connect = Buyer::where('Contract_buyer', 'like', '06%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 07) { //สาขาเบตง
                    $connect = Buyer::where('Contract_buyer', 'like', '07%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 10) { //สาขารถบ้าน
                    $connect = Buyer::where('Contract_buyer', 'like', '10%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 11) { //สาขารถยืดขายผ่อน
                    $connect = Buyer::where('Contract_buyer', 'like', '11%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }

                  // dd($connect);

                  $contract = $connect[0]->Contract_buyer;
                  $SetStr = explode("/",$contract);
                  $StrNum = $SetStr[1] + 1;

                  $num = "1000";
                  $SubStr = substr($num.$StrNum, -4);
                  $StrConn = $SetStr[0]."/".$SubStr;

                  $GetIdConn = Buyer::where('id',$id)->first();
                    $GetIdConn->Contract_buyer = $StrConn;
                  $GetIdConn->update();
                }
              }
            }
            else {                                       //ยกเลิก หรือ ไม่อนุมัติ
              if (auth()->user()->type == 1 or auth()->user()->type == 2) {
                $SetStatusApp = 'รออนุมัติ';
                $cardetail->Dateduefirst_car = Null;
                $cardetail->Date_Appcar = Null;

                $branchType = Null;
                if ($cardetail->branch_car == "ปัตตานี") {
                    $branchType = 01;
                }elseif ($cardetail->branch_car == "ยะลา") {
                    $branchType = 03;
                }elseif ($cardetail->branch_car == "นราธิวาส") {
                    $branchType = 04;
                }elseif ($cardetail->branch_car == "สายบุรี") {
                    $branchType = 05;
                }elseif ($cardetail->branch_car == "โกลก") {
                    $branchType = 06;
                }elseif ($cardetail->branch_car == "เบตง") {
                    $branchType = 07;
                }elseif ($cardetail->branch_car == "รถบ้าน") {
                    $branchType = 10;
                }elseif ($cardetail->branch_car == "รถยืดขายผ่อน") {
                    $branchType = 11;
                }
                if ($branchType != Null) {
                  if ($branchType == 01) { //สาขาปัตตานี
                    $connect = Buyer::where('Contract_buyer', 'like', '01%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 03) { //สาขายะลา
                    $connect = Buyer::where('Contract_buyer', 'like', '03%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 04) { //สาขานรา
                    $connect = Buyer::where('Contract_buyer', 'like', '04%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 05) { //สาขาสายบรุี
                    $connect = Buyer::where('Contract_buyer', 'like', '05%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 06) { //สาขาโกลก
                    $connect = Buyer::where('Contract_buyer', 'like', '06%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 07) { //สาขาเบตง
                    $connect = Buyer::where('Contract_buyer', 'like', '07%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 10) { //สาขารถบ้าน
                    $connect = Buyer::where('Contract_buyer', 'like', '10%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }elseif ($branchType == 11) { //สาขารถยืดขายผ่อน
                    $connect = Buyer::where('Contract_buyer', 'like', '11%' )
                                      ->orderBy('Contract_buyer', 'desc')->limit(1)
                                      ->get();
                  }

                  $contract = $connect[0]->Contract_buyer;
                  $SetStr = explode("/",$contract);
                  $StrNum = $SetStr[0];

                  $GetIdConn = Buyer::where('id',$id)->first();
                    $GetIdConn->Contract_buyer = $StrNum;
                  $GetIdConn->update();
                }
              }
              else {
                $SetStatusApp = 'รออนุมัติ';
              }
            }
            // if ($request->get('Checkcar') != Null) {
            //   $SetCheckcar = $request->get('Checkcar');
            // }else {
            //   if ($cardetail->Check_car != Null) {
            //     $SetCheckcar = $cardetail->Check_car;
            //   }else {
            //     $SetCheckcar = Null;
            //   }
            // }

            $cardetail->Insurance_car = $request->get('Insurancecar');
            $cardetail->status_car = $request->get('statuscar');
            $cardetail->Percent_car = $request->get('Percentcar');
            $cardetail->Payee_car = $request->get('Payeecar');
            $cardetail->Accountbrance_car = $request->get('Accountbrancecar');
            $cardetail->Tellbrance_car = $request->get('Tellbrancecar');
            $cardetail->Agent_car = $request->get('Agentcar');
            $cardetail->Accountagent_car = $request->get('Accountagentcar');
            $cardetail->Commission_car = $SetCommissioncar;
            $cardetail->Tellagent_car = $request->get('Tellagentcar');
            $cardetail->Purchasehistory_car = $request->get('Purchasehistorycar');
            $cardetail->Supporthistory_car = $request->get('Supporthistorycar');
            $cardetail->Approvers_car = $request->get('Approverscar');
            $cardetail->Check_car = $request->get('Checkcar');
            $cardetail->StatusApp_car = $SetStatusApp;
            $cardetail->DocComplete_car = $request->get('doccomplete');
            $cardetail->branchbrance_car = $request->get('branchbrancecar');
            $cardetail->branchAgent_car = $request->get('branchAgentcar');
            $cardetail->Note_car = $request->get('Notecar');
          $cardetail->update();

          if ($request->get('tranPrice') != Null) {
            $SettranPrice = str_replace (",","",$request->get('tranPrice'));
          }else {
            $SettranPrice = 0;
          }
          if ($request->get('otherPrice') != Null) {
            $SetotherPrice = str_replace (",","",$request->get('otherPrice'));
          }else {
            $SetotherPrice = 0;
          }
          if ($request->get('totalkPrice') != Null) {
            $SettotalkPrice = str_replace (",","",$request->get('totalkPrice'));
          }else {
            $SettotalkPrice = 0;
          }
          if ($request->get('balancePrice') != Null) {
            $SetbalancePrice = str_replace (",","",$request->get('balancePrice'));
          }else {
            $SetbalancePrice = 0;
          }
          if ($request->get('commitPrice') != Null) {
            $SetcommitPrice = str_replace (",","",$request->get('commitPrice'));
          }else {
            $SetcommitPrice = 0;
          }
          if ($request->get('actPrice') != Null) {
            $SetactPrice = str_replace (",","",$request->get('actPrice'));
          }else {
            $SetactPrice = 0;
          }
          if ($request->get('closeAccountPrice') != Null) {
            $SetcloseAccountPrice = str_replace (",","",$request->get('closeAccountPrice'));
          }else {
            $SetcloseAccountPrice = 0;
          }
          if ($request->get('P2Price') != Null) {
            $SetP2Price = str_replace (",","",$request->get('P2Price'));
          }else {
            $SetP2Price = 0;
          }

          $expenses = Expenses::where('Buyerexpenses_id',$id)->first();
            $expenses->act_Price = $SetactPrice;
            $expenses->closeAccount_Price = $SetcloseAccountPrice;
            $expenses->P2_Price = $SetP2Price;
            $expenses->vat_Price = $request->get('vatPrice');
            $expenses->tran_Price = $SettranPrice;
            $expenses->other_Price = $SetotherPrice;
            $expenses->evaluetion_Price = $request->get('evaluetionPrice');
            $expenses->totalk_Price = $SettotalkPrice;
            $expenses->balance_Price = $SetbalancePrice;
            $expenses->commit_Price = $SetcommitPrice;
            $expenses->marketing_Price = $request->get('marketingPrice');
            $expenses->duty_Price = $request->get('dutyPrice');
            $expenses->insurance_Price = $request->get('insurancePrice');
            $expenses->note_Price = $request->get('notePrice');
          $expenses->update();
      }


        if ($request->hasFile('file_image')) {
          $image_array = $request->file('file_image');
          $array_len = count($image_array);

          for ($i=0; $i < $array_len; $i++) {
            $image_size = $image_array[$i]->getClientSize();
            $image_lastname = $image_array[$i]->getClientOriginalExtension();
            $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

            $destination_path = public_path('/upload-image');
            $image_array[$i]->move($destination_path,$image_new_name);

            $Uploaddb = new UploadfileImage([
              'Buyerfileimage_id' => $id,
              'Name_fileimage' => $image_new_name,
              'Size_fileimage' => $image_size,
            ]);
            // dd($Uploaddb);
            $Uploaddb ->save();
          }
        }
      $fdate = $request->fdate;
      $tdate = $request->tdate;
      $branch = $request->branch;
      $status = $request->status;

      if ($branch == "Null") {
        $branch = Null;
      }
      if ($status == "Null") {
        $status = Null;
      }

      if ($type == 1) {
        return redirect()->Route('Analysis',$type)->with(['fdate' => $fdate,'tdate' => $tdate,'branch' => $branch,'status' => $status,'success' => 'อัพเดตข้อมูลเรียบร้อย']);
      }elseif ($type == 4) {
        return redirect()->Route('Analysis',$type)->with(['fdate' => $fdate,'tdate' => $tdate,'branch' => $branch,'status' => $status,'success' => 'อัพเดตข้อมูลเรียบร้อย']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item1 = Buyer::find($id);
      $item2 = Sponsor::where('Buyer_id',$id);
      $item3 = Cardetail::where('Buyercar_id',$id);
      $item4 = Expenses::where('Buyerexpenses_id',$id);
      $item6 = homecardetail::where('Buyerhomecar_id',$id);
      $item7 = Sponsor2::where('Buyer_id2',$id);

      $item5 = UploadfileImage::where('Buyerfileimage_id','=',$id)->get();

      foreach ($item5 as $key => $value) {
        $itemID = $value->Buyerfileimage_id;
        $itemPath = $value->Name_fileimage;

        Storage::delete($itemPath);
      }

      // $datadelete = DB::table('buyers')
      //           ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
      //           ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
      //           ->join('expenses','Buyers.id','=','expenses.Buyerexpenses_id')
      //           ->where('buyers.id',$id)->first();
      //
      // $datacontract = DB::table('buyers')
      //                 ->orderBy('Contract_buyer', 'ASC')
      //                 ->get();
      //
      // $numcount = count($datacontract);
      // // dd($numcount);
      //
      //   $getnum = 0;
      //   for ($i=0; $i < $numcount; $i++) {
      //     // dump($datacontract[$i]->Contract_buyer);
      //     dump($i);
      //     if ($datacontract[$i]->Contract_buyer == $datadelete->Contract_buyer) {
      //       $getnum = $i  + 1;
      //
      //       if ($getnum != $numcount) { //ลบข้าม
      //         $GetContract = $datacontract[$i]->Contract_buyer;
      //
      //         $SetStrCon = $GetContract;
      //         $SetStr = explode("-",$SetStrCon);
      //         $StrNum = $SetStr[0];
      //         dd($StrNum);
      //
      //         $user = Buyer::find($id);
      //         $user->Date_Soldout_plus = $GetContract;
      //
      //         dump($getnum);
      //         dump($GetContract);
      //       }elseif ($getnum == $numcount) {
      //         dd('sdf');
      //       }
      //     }
      //   }

        $deleteItem = UploadfileImage::where('Buyerfileimage_id',$itemID);
        $deleteItem->Delete();

        $item1->Delete();
        $item2->Delete();
        $item3->Delete();
        $item4->Delete();
        $item6->Delete();
        $item7->Delete();

      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function deleteImageAll($id)
    {

      // dd($id);
      $item = UploadfileImage::where('Buyerfileimage_id','=',$id)->get();

      foreach ($item as $key => $value) {
        $itemID = $value->Buyerfileimage_id;
        $itemPath = $value->Name_fileimage;

        Storage::delete($itemPath);
      }

        $deleteItem = UploadfileImage::where('Buyerfileimage_id',$itemID);
        $deleteItem->Delete();

      return redirect()->back()->with('success','ลบรูปทั้งหมดเรียบร้อยแล้ว');
    }

    public function deleteImageEach($id,$type,$fdate,$tdate,$branch,$status,Request $request)
    {

      // dd($id);
      $id = $id;
      $type = $type;
      $fdate = $fdate;
      $tdate = $tdate;
      $branch = $branch;
      $status = $status;

      $data = UploadfileImage::where('Buyerfileimage_id','=',$id)->get();
      $countData = count($data);
      // dd($data[0]->fileimage_id);

      return view('analysis.viewimage', compact('data','countData','id','type','fdate','tdate','branch','status'));
    }

    public function destroyImage($id,$type,$fdate,$tdate,$branch,$status,Request $request)
    {
      // dd($id,$type,$fdate,$tdate,$branch,$status);
      $id = $id;
      $type = $type;
      $fdate = $fdate;
      $tdate = $tdate;
      $branch = $branch;
      $status = $status;

      $item1 = UploadfileImage::where('fileimage_id',$id);
      // dd($item1);
      $data = UploadfileImage::where('fileimage_id','=',$id)->get();
      foreach ($data as $key => $value) {
        $itemPath = $value->Name_fileimage;
        Storage::delete($itemPath);
      }

      $item1->Delete();

      // return redirect()->back()->with('success','ลบรูปเรียบร้อยแล้ว');
      return redirect()->back()->with(['id' => $id,'type' => $type,'fdate' => $fdate,'tdate' => $tdate,'branch' => $branch,'status' => $status,'success' => 'ลบรูปสำเร็จเรียบร้อย']);
    }

}
