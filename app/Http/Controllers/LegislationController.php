<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use Carbon\Carbon;

use App\Legislation;
use App\Legiscourt;
use App\Legiscourtcase;
use App\LegisImage;
use App\Legiscompromise;
use App\legispayment;
use App\legisasset;

class LegislationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = DB::connection('ibmi')
      ->table('SFHP.ARMAST')
      ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
      ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
      ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,99.99])
      ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
      ->get();
      // dd($data);

      $count = count($data);
      for($i=0; $i<$count; $i++){
        $str[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$data[$i]->CONTSTAT)));
        if ($str[$i] == "ฟ") {
          $result[] = $data[$i];
        }
      }

      if($request->type == 1) {
        $dataAro = DB::connection('ibmi')
        ->table('SFHP.ARMAST')
        ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
        ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,199.99])
        ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
        ->get();

        $count2 = count($dataAro);
        for($j=0; $j<$count2; $j++){
          $str2[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$dataAro[$j]->CONTSTAT)));
          if ($str2[$j] == "ฟ") {
            $result2[] = $dataAro[$j];
          }
        }

        $data = DB::table('legislations')
                  ->orderBy('Contract_legis', 'ASC')
                  ->get();

        $type = $request->type;
        return view('legislation.view', compact('type', 'result','data','result2'));

      }
      elseif ($request->type == 2) {   //งานฟ้อง
        $data = DB::table('legislations')
                  ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                  ->where('legislations.Flag_status','=', '2')
                  ->orderBy('legislations.Contract_legis', 'ASC')
                  ->get();
        // dd($data);

        $type = $request->type;
        return view('legislation.view', compact('type', 'data','result'));
      }
      elseif ($request->type == 6) {
        $data = DB::table('legislations')
                  ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  // ->where('legislations.Flag_status','=', '1')
                  ->orderBy('legislations.Contract_legis', 'ASC')
                  ->get();

        $type = $request->type;
        return view('legislation.view', compact('type', 'data','result'));
      }
      elseif ($request->type == 7) {   //งานประนอมหนี้
        $data = DB::table('legislations')
                  ->leftjoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  // ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                  ->where('legislations.Flag_status','=', '2')
                  ->where('Legiscompromises.Date_Promise','!=', null)
                  ->where('Legiscompromises.KeyPay_id','!=', null)
                  ->orderBy('legislations.Contract_legis', 'ASC')
                  ->get();
        $count1 = count($data);
        // dd($data);

        $dataPay = DB::table('legislations')
                  ->join('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                  ->get();
        $count2 = count($dataPay);
        // dd($dataPay);

        if($count1 != 0 && $count2 != 0){
            $Pay = [];
            for ($i=0; $i < $count1; $i++) {
              for ($j=0; $j < $count2; $j++) {
                  if($data[$i]->legislation_id == $dataPay[$j]->legis_Com_Payment_id){
                    $Pay = DB::table('legispayments')
                          ->where('legis_Com_Payment_id', '=', $data[$i]->legislation_id)
                          ->orderBy('Payment_id', 'DESC')
                          ->first();
                  }
                }
              $ResultPay[] = $Pay;
            }
         }
         else{
           $ResultPay = [];
         }
         // dd($ResultPay);

         // $dataPay = DB::table('legispayments')
         //           ->get();
         // $dataCount = count($dataPay);
         //
         // if ($dataCount != 0) {
         //   dd('asd');
         //   foreach ($data as $key => $value) {
         //     $SetDate = '';
         //     foreach ($dataPay as $key => $row) {
         //       if ($value->legisPromise_id == $row->legis_Com_Payment_id) {
         //         if ($SetDate == '') {
         //           $SetDate = $row->Date_Payment;
         //         }else {
         //           if ($SetDate < $row->Date_Payment) {
         //             $SetDate = $row->Date_Payment;
         //             $SetArray[] = ['id'=>$row->legis_Com_Payment_id,'Date'=>$SetDate];
         //             $SetDate = '';
         //           }
         //         }
         //       }
         //     }
         //   }
         // }else {
         //   $SetArray[] = ['id'=>'','Date'=>''];
         // }

        $type = $request->type;
        return view('legislation.view', compact('type', 'data','ResultPay','result'));
      }
      elseif ($request->type == 8) {   //สืบทรัพย์
        $data = DB::table('legislations')
                  ->join('legisassets','legislations.id','=','legisassets.legisAsset_id')
                  ->orderBy('legisassets.legisAsset_id', 'ASC')
                  ->get();

                  // dd($data);
        $type = $request->type;
        return view('legislation.view', compact('type', 'data','result'));
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
    public function store(Request $request, $id, $type)
    {
      $SetDate = ($request->get('DatePayment'));
      $DateDue = \Carbon\Carbon::parse($SetDate)->format('Y')-543 ."-". \Carbon\Carbon::parse($SetDate)->format('m')."-". \Carbon\Carbon::parse($SetDate)->format('d');
      $SetGoldPay = str_replace (",","",$request->get('GoldPayment'));
      // dd($DateDue);

      if ($type == 5) { //เพิ่มข้อมูลชำระ
        $LegisPay = new legispayment([
          'legis_Com_Payment_id' => $id,
          'Date_Payment' => $DateDue,
          'Gold_Payment' =>  $SetGoldPay,
          'Type_Payment' =>  $request->get('TypePayment'),
          'Adduser_Payment' =>  $request->get('AdduserPayment'),
          'Note_Payment' =>  $request->get('NotePayment'),
        ]);
        $LegisPay->save();

        $Legiscom = Legiscompromise ::find($id);
          $Legiscom->KeyPay_id = $id;
        $Legiscom->update();

        return redirect()->back()->with(['id' => $id,'type' => $type,'success' => 'บันทึกข้อมูลเรียบร้อย']);
      }
    }

    public function Savestore(Request $request, $SetStr1, $SetStr2, $SetRealty, $type)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;

      if ($type == 1) {
        $SetStrConn = $SetStr1."/".$SetStr2;
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
                  ->first();

        $dataGT = DB::connection('ibmi')
                  ->table('SFHP.VIEW_ARMGAR')
                  ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
                  ->first();

        $LegisDB = new Legislation([
          'Date_legis' => $date,
          'KeyCourts_id' => Null,
          'KeyCompro_id' => Null,
          'Contract_legis' => $data->CONTNO,
          'Name_legis' => (iconv('TIS-620', 'utf-8', str_replace(" ","",$data->SNAM)." ".str_replace(" ","",$data->NAME1)."  ".str_replace(" ","",$data->NAME2))),
          'Idcard_legis' => (str_replace(" ","",$data->IDNO)),
          'BrandCar_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->TYPE))),
          'register_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->REGNO))),
          'YearCar_legis' => $data->MANUYR,
          'Category_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->BAAB))),
          'DateDue_legis' => $data->FDATE,
          'Pay_legis' => $data->NCARCST,
          'DateVAT_legis' => $data->DTSTOPV,
          'NameGT_legis' => (iconv('Tis-620','utf-8',$dataGT->NAME)),
          'IdcardGT_legis' => (str_replace(" ","",$dataGT->IDNO)),
          'Realty_legis' => $SetRealty,

          'Mile_legis' => $data->MILERT,
          'Period_legis' => $data->TOT_UPAY,
          'Countperiod_legis' => $data->T_NOPAY,
          'Beforeperiod_legis' => $data->EXP_FRM,
          'Beforemoey_legis' => $data->SMPAY,
          'Remainperiod_legis' => $data->EXP_TO,
          'Staleperiod_legis' => $data->EXP_PRD, //ค้าง
          'Realperiod_legis' => $data->HLDNO, //ค้างงวดจริง
          'Sumperiod_legis' => $data->BALANC - $data->SMPAY,
          'Flag' => 'Y',
          'Flag_status' => '1',
        ]);
        $LegisDB->save();

        return redirect()->Route('legislation', $type)->with('success','รับเรื่องเรียบร้อย');
      }
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
    public function edit($id, $type)
    {
      if ($type == 2) {     //ข้อมูลผู้เช่าซื้อ
        $data = DB::table('legislations')
        ->where('legislations.id',$id)->first();
        $StrCon = explode("/",$data->Contract_legis);
        $SetStr1 = $StrCon[0];
        $SetStr2 = $StrCon[1];
        $SetStrConn = $SetStr1."/".$SetStr2;

        $data1 = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
                  ->first();

        return view('legislation.edit',compact('data','data1','id','type'));
      }
      elseif ($type == 3){  //ชั้นศาล
        $data = DB::table('legislations')
                  ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                  ->where('legiscourts.legislation_id',$id)->first();

        return view('legislation.court',compact('data','id','type'));
      }
      elseif ($type == 4) { //ประนอมหนี้-รายละเอียด
        $data = DB::table('legislations')
                  ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                  ->where('legislations.id', $id)
                  ->orderBy('legispayments.Payment_id', 'DESC')
                  ->first();

        $dataPay = DB::table('legispayments')
                  ->where('legispayments.legis_Com_Payment_id', $id)
                  ->get();

        $dataPranom = DB::table('Legiscompromises')
                  ->where('legisPromise_id', $id)
                  ->count();
        // dd($data);
        $SumCount = 0;  //ค่าผ่อนชำระทั้งหมด
        $SumPay = 0;    //ค่าชำระ
        $SumPayDue = 0; //ค่าเงินก้อนแรก

        foreach ($dataPay as $key => $value) {
          $GetPay = str_replace (",","",$value->Gold_Payment);
          if ($value->Type_Payment == "เงินก้อนแรก") {
            $SumPayDue = $SumPayDue + $GetPay;
          }
          $SumCount = $SumCount + $GetPay;
        }

        if ($data->Total_Promise != Null) {
          $Getdata = str_replace (",","",$data->Total_Promise);
          $SumPay = $Getdata - $SumCount;
          $SumAllPAy = $Getdata - $SumPayDue;

          if ($data->Discount_Promise != Null) {
            $GetDiscount = str_replace (",","",$data->Discount_Promise);
            $SumPay = $SumPay - $GetDiscount;
          }
        }else {
          $SumAllPAy = 0;
          $Getdata = 0;
        }

        // dd($SumAllPAy);
        $Typecom = [
          'ประนอมที่ศาล' => 'ประนอมที่ศาล',
          'ประนอมที่บริษัท' => 'ประนอมที่บริษัท',
          'ประนอมหลังยึดทรัพย์' => 'ประนอมหลังยึดทรัพย์',
        ];

        return view('legislation.compromise',compact('data','id','type','Typecom','dataPay','SumPay','SumAllPAy','Getdata','SumCount','dataPranom'));
      }
      elseif ($type == 5) { //เพิ่มข้อมูลชำระ
        return view('legislation.payment',compact('data','id','type'));
      }
      elseif ($type == 6) { //เพิ่มข้อมูลงาน วิเคราะห์
        $data = DB::table('legislations')
        ->where('legislations.id',$id)->first();
        $StrCon = explode("/",$data->Contract_legis);
        $SetStr1 = $StrCon[0];
        $SetStr2 = $StrCon[1];
        $SetStrConn = $SetStr1."/".$SetStr2;

        $data1 = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
                  ->first();

        // dd($data1);
        return view('legislation.editAnalyze',compact('data','data1','id','type'));
      }
      elseif ($type == 7) { //ชั้นบังคับคดี
        $data = DB::table('legislations')
                  ->leftJoin('legiscourtcases','legislations.id','=','legiscourtcases.legislation_id')
                  ->where('legiscourtcases.legislation_id',$id)->first();

        return view('legislation.courtcase',compact('data','id','type'));
      }
      elseif ($type == 8) { //สืบทรัพย์
        $data = DB::table('legislations')
                  ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                  ->where('legislations.id', $id)
                  ->first();
        // dd($data);

        return view('legislation.asset',compact('data','id','type'));
      }
      elseif ($type == 11){ //รูปและแผนที
        $data = DB::table('legiscourts')
        ->where('legiscourts.legislation_id',$id)->first();
        $dataImages = DB::table('legisimages')
        ->where('legisimages.legisImage_id',$id)->get();
        $SumImage = count($dataImages);
        if($SumImage > 0){
          $column = 100/$SumImage - 0.8;
        }else{
          $column = 0;
        }

        $lat = $data->latitude_court;
        $long = $data->longitude_court;
        // dd($datalatlong);

        // foreach ($datalatlong as $key => $value) {
        //   $lat = $value->latitude_court;
        //   $long = $value->longitude_court;
        // }


        return view('legislation.info',compact('data','id','type','dataImages','SumImage','column','lat','long'));
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
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;
      // dd($request);
      if ($type == 2) {     //ข้อมูลผู้เช่าซื้อ
        $user = Legislation::find($id);
          //หน้าทีมทนาย
          if ($request->get('Statuslegis') != Null) {
            $user->Status_legis = $request->get('Statuslegis');
            $user->txtStatus_legis = $request->get('txtStatuslegis');
            $user->DateStatus_legis = $request->get('DateStatuslegis');
            $user->DateUpState_legis = date('Y-m-d');
          }

          $user->Pay_legis = str_replace(",","",$request->get('Paylegis'));
          $user->Period_legis = str_replace(",","",$request->get('Periodlegis'));
          $user->Countperiod_legis = $request->get('Countperiodlegis');
          $user->Beforeperiod_legis = $request->get('Beforeperiodlegis');
          $user->Remainperiod_legis = $request->get('Remainperiodlegis');
          $user->Beforemoey_legis = str_replace(",","",$request->get('Beforemoeylegis'));
          $user->Staleperiod_legis = str_replace(",","",$request->get('Staleperiodlegis'));
          $user->Realperiod_legis = str_replace(",","",$request->get('Realperiod_legis'));
          $user->Sumperiod_legis = str_replace(",","",$request->get('Sumperiodlegis'));
          $user->DateVAT_legis = $request->get('DateVATlegis');
          $user->Certificate_list = $request->get('Certificatelist');
          $user->Authorize_list = $request->get('Authorizelist');
          $user->Authorizecase_list = $request->get('Authorizecaselist');
          $user->Purchase_list = $request->get('Purchaselist');
          $user->Promise_list = $request->get('Promiselist');
          $user->Titledeed_list = $request->get('Titledeedlist');
          //หน้าทีมวิเคราะห์
          $user->Terminatebuyer_list = $request->get('Terminatebuyerlist');
          $user->Terminatesupport_list = $request->get('Terminatesupportlist');
          $user->Acceptbuyerandsup_list = $request->get('Acceptbuyerandsuplist');
          $user->Twodue_list = $request->get('Twoduelist');
          $user->AcceptTwodue_list = $request->get('AcceptTwoduelist');
          $user->Confirm_list = $request->get('Confirmlist');
          $user->Accept_list = $request->get('Acceptlist');
        $user->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($type == 3) { //ชั้นศาล
        $user = Legislation::find($id); //update status
          $user->Status_legis = $request->get('Statuslegis');
          $user->txtStatus_legis = $request->get('txtStatuslegis');
          $user->DateStatus_legis = $request->get('DateStatuslegis');
        $user->update();

        $Legiscourt = Legiscourt::where('legislation_id',$id)->first();
          $Legiscourt->fillingdate_court = $request->get('fillingdatecourt');
          $Legiscourt->law_court = $request->get('lawcourt');
          $Legiscourt->bnumber_court = $request->get('bnumbercourt');
          $Legiscourt->rnumber_court = $request->get('rnumbercourt');
          $Legiscourt->capital_court = $request->get('capitalcourt');
          $Legiscourt->indictment_court = $request->get('indictmentcourt');
          $Legiscourt->pricelawyer_court = $request->get('pricelawyercourt');
          $Legiscourt->examiday_court = $request->get('examidaycourt');
          $Legiscourt->fuzzy_court = $request->get('fuzzycourt');
          $Legiscourt->examinote_court = $request->get('examinotecourt');
          $Legiscourt->orderday_court = $request->get('orderdaycourt');
          $Legiscourt->ordersend_court = $request->get('ordersendcourt');
          $Legiscourt->checkday_court = $request->get('checkdaycourt');
          $Legiscourt->checksend_court = $request->get('checksendcourt');
          $Legiscourt->buyer_court = $request->get('buyercourt');
          $Legiscourt->support_court = $request->get('supportcourt');
          $Legiscourt->note_court = $request->get('notecourt');
          $Legiscourt->social_flag = $request->get('socialflag');
          $Legiscourt->setoffice_court = $request->get('setofficecourt');
          $Legiscourt->sendoffice_court = $request->get('sendofficecourt');
          $Legiscourt->checkresults_court = $request->get('checkresultscourt');
          $Legiscourt->sendcheckresults_court = $request->get('sendcheckresultscourt');
          $Legiscourt->received_court = $request->get('radio-receivedflag');
          $Legiscourt->telresults_court = $request->get('telresultscourt');
          $Legiscourt->dayresults_court = $request->get('dayresultscourt');
        $Legiscourt->update();

        $Legislation = Legislation::find($id);
          $Legislation->KeyCourts_id = $Legiscourt->court_id;
        $Legislation->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($type == 4) { //ประนอมหนี้-รายละเอียด
        $data = DB::table('Legiscompromises')
                  ->where('Legiscompromises.legisPromise_id', $id)->first();

        $SetTotalPromise = str_replace (",","",$request->get('TotalPromise'));
        // dd($SetTotalPromise);
        $SetSumPromise = str_replace (",","",$request->get('SumPromise'));
        $SetDuePay = str_replace (",","",$request->get('DuePayPromise'));
        $SetDiscount = str_replace (",","",$request->get('DiscountPromise'));

        if ($data == Null) {
            $LegisPromise = new Legiscompromise([
              'Date_Promise' => $date,
              'legisPromise_id' => $id,
              'KeyPay_id' => Null,
              'Flag_Promise' => $request->get('FlagPromise'),
              'Total_Promise' => $SetTotalPromise,
              'Type_Promise' =>  $request->get('TypePromise'),
              'DateNsale_Promise' =>  $request->get('DateNsalePromise'),
              'Dateset_Promise' =>  $request->get('DatesetPromise'),
              'Payall_Promise' =>  $request->get('PayallPromise'),
              'Sum_Promise' =>  $SetSumPromise,
              'Discount_Promise' =>  $SetDiscount,
              'Due_Promise' =>  $request->get('DuePromise'),
              'DuePay_Promise' =>  $request->get('DuePayPromise'),
              'Datelast_Promise' =>  $request->get('DatelastPromise'),
              'SumAll_Promise' =>  $request->get('SumAllPromise'),
              'Note_Promise' =>  $request->get('NotePromise'),
            ]);
            $LegisPromise->save();

            $Legislation = Legislation::find($id);
              $Legislation->KeyCompro_id = $LegisPromise->legisPromise_id;
            $Legislation->update();

        }else {
          // dd($request->get('FlagPromise'));
          $LegisPromise = Legiscompromise::where('legisPromise_id',$id)->first();
            $LegisPromise->Flag_Promise = $request->get('FlagPromise');
            $LegisPromise->Total_Promise = $SetTotalPromise;
            $LegisPromise->Type_Promise = $request->get('TypePromise');
            $LegisPromise->DateNsale_Promise = $request->get('DateNsalePromise');
            $LegisPromise->Dateset_Promise = $request->get('DatesetPromise');
            $LegisPromise->Payall_Promise = $request->get('PayallPromise');
            $LegisPromise->Sum_Promise = $SetSumPromise;
            $LegisPromise->Discount_Promise = $SetDiscount;
            $LegisPromise->Due_Promise = $request->get('DuePromise');
            $LegisPromise->DuePay_Promise = $SetDuePay;
            $LegisPromise->Datelast_Promise = $request->get('DatelastPromise');
            $LegisPromise->SumAll_Promise = $request->get('SumAllPromise');
            $LegisPromise->Note_Promise = $request->get('NotePromise');
          $LegisPromise->update();

          // dd($LegisPromise);
        }
        // dd($LegisPromise);
        $data = DB::table('legislations')
                  ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  ->where('Legiscompromises.legisPromise_id', $id)
                  ->orderBy('legislations.Contract_legis', 'ASC')
                  ->first();

        // dd($data);
        $Typecom = [
          'ประนอมที่ศาล' => 'ประนอมที่ศาล',
          'ประนอมที่บริษัท' => 'ประนอมที่บริษัท',
          'ประนอมหลังยึดทรัพย์' => 'ประนอมหลังยึดทรัพย์',
        ];

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
      }
      elseif ($type == 6) { //เตรียมเอกสารฝ่ายวิเคราะห์
        $user = Legislation::find($id);
          $user->Pay_legis = str_replace(",","",$request->get('Paylegis'));
          $user->Period_legis = str_replace(",","",$request->get('Periodlegis'));
          $user->Countperiod_legis = $request->get('Countperiodlegis');
          $user->Beforeperiod_legis = $request->get('Beforeperiodlegis');
          $user->Remainperiod_legis = $request->get('Remainperiodlegis');
          $user->Beforemoey_legis = str_replace(",","",$request->get('Beforemoeylegis'));
          $user->Staleperiod_legis = str_replace(",","",$request->get('Staleperiodlegis'));
          $user->Realperiod_legis = str_replace(",","",$request->get('Realperiod_legis'));
          $user->Sumperiod_legis = str_replace(",","",$request->get('Sumperiodlegis'));
          $user->DateVAT_legis = $request->get('DateVATlegis');
          $user->Terminatebuyer_list = $request->get('Terminatebuyerlist');
          $user->Terminatesupport_list = $request->get('Terminatesupportlist');
          $user->Acceptbuyerandsup_list = $request->get('Acceptbuyerandsuplist');
          $user->Twodue_list = $request->get('Twoduelist');
          $user->AcceptTwodue_list = $request->get('AcceptTwoduelist');
          $user->Confirm_list = $request->get('Confirmlist');
          $user->Accept_list = $request->get('Acceptlist');
          $user->Noteby_legis = $request->get('NotebyAnalysis');
        $user->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($type == 7) { //ชั้นบังคับคดี
        if($request->get('Paidseguester') != ''){
          $Paidseguester = str_replace(",","",$request->get('Paidseguester'));
        }else{
          $Paidseguester = 0;
        }

        if($request->get('Amountsequester') != ''){
          $Amountsequester = str_replace(",","",$request->get('Amountsequester'));
        }else{
          $Amountsequester = 0;
        }

        $Legiscourtcase = Legiscourtcase::where('legislation_id',$id)->first();
          $Legiscourtcase->datepreparedoc_case = $request->get('datepreparedoc');
          $Legiscourtcase->noteprepare_case = $request->get('noteprepare');
          $Legiscourtcase->datesetsequester_case = $request->get('DatesetSequester');
          $Legiscourtcase->resultsequester_case = $request->get('ResultSequester');
          $Legiscourtcase->notesequester_case = $request->get('Notesequester');
          $Legiscourtcase->paidsequester_case = $Paidseguester;
          $Legiscourtcase->datenextsequester_case = $request->get('DatenextSequester');
          $Legiscourtcase->resultsell_case = $request->get('ResultSell');
          $Legiscourtcase->datesoldout_case = $request->get('Datesoldout');
          $Legiscourtcase->amountsequester_case = $Amountsequester;
          $Legiscourtcase->statussequester_case = NULL;
        $Legiscourtcase->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($type == 8) {
        $data = DB::table('legisassets')
                  ->where('legisassets.legisAsset_id', $id)->first();

        if ($data == Null) {
            $LegisAsset = new legisasset([
              'legisAsset_id' => $id,
              'Status_asset' => $request->get('statusasset'),
              'Price_asset' => Null,
              'propertied_asset' => $request->get('radio_propertied'),
              'sequester_asset' =>  $request->get('sequesterasset'),
              'sendsequester_asset' => $request->get('sendsequesterasset'),
              'Dateresult_asset' => Null,
              'NewpursueDate_asset' => $request->get('NewpursueDateasset'),
              'Notepursue_asset' =>  $request->get('Notepursueasset'),
            ]);
            $LegisAsset->save();

        }else {
          if ($data->Dateresult_asset == Null or $data->Dateresult_asset == "ไม่เจอ") {
            if ($request->get('sendsequesterasset') == "เจอ" or $request->get('sendsequesterasset') == "หมดอายุความ") {
              $Dateresult = date('Y-m-d');
            }else {
              $Dateresult = Null;
            }
          }

          $LegisAsset = legisasset::where('legisAsset_id',$id)->first();
            $LegisAsset->Status_asset = $request->get('statusasset');
            $LegisAsset->Price_asset = Null;
            $LegisAsset->propertied_asset = $request->get('radio_propertied');
            $LegisAsset->sequester_asset = $request->get('sequesterasset');
            $LegisAsset->sendsequester_asset = $request->get('sendsequesterasset');
            $LegisAsset->Dateresult_asset = $Dateresult;
            $LegisAsset->NewpursueDate_asset = $request->get('NewpursueDateasset');
            $LegisAsset->Notepursue_asset =  $request->get('Notepursueasset');
          $LegisAsset->update();
        }

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
      }
      elseif ($type == 11) { //รูปและแผนที่
        $Legiscourt = Legiscourt::where('legislation_id',$id)->first();
          $Legiscourt->latitude_court = $request->get('latitude');
          $Legiscourt->longitude_court = $request->get('longitude');
        $Legiscourt->update();

        if ($request->hasFile('file_image')) {
          $image_array = $request->file('file_image');
          $array_len = count($image_array);
          // dd($array_len);
          for ($i=0; $i < $array_len; $i++) {
            $image_size = $image_array[$i]->getClientSize();
            $image_lastname = $image_array[$i]->getClientOriginalExtension();
            $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

            $destination_path = public_path('/upload-image');
            $image_array[$i]->move($destination_path,$image_new_name);

            $Uploaddb = new LegisImage([
              'legisImage_id' => $id,
              'name_image' => $image_new_name,
              'size_image' => $image_size,
            ]);
            // dd($Uploaddb);
            $Uploaddb ->save();
          }
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($type == 100) { //Json ประนอมหนี้

        $input = $request->all();
        $data = DB::table('Legiscompromises')
                  ->where('Legiscompromises.legisPromise_id',$input["Getid"])->get();
        $dataCount = count($data);

        if ($dataCount == 0) {
            $LegisPromise = new Legiscompromise([
              'legisPromise_id' => $input["Getid"],
              'Total_Promise' => Null,
              'Type_Promise' =>  Null,
              'Payall_Promise' =>  Null,
              'Sum_Promise' =>  Null,
              'Due_Promise' =>  Null,
              'DuePay_Promise' =>  Null,
              'Datelast_Promise' =>  Null,
              'SumAll_Promise' =>  Null,
              'Note_Promise' =>  Null,
            ]);
            $LegisPromise->save();

        }else {
          $Legiscourt = Legiscompromise::where('legisPromise_id',$input["Getid"])->first();
            $Legiscourt->Total_Promise = $request->get('TotalPromise');
            $Legiscourt->Type_Promise = $request->get('TypePromise');
            $Legiscourt->Payall_Promise = $request->get('PayallPromise');
            $Legiscourt->Pay1_Promise = $request->get('Pay1Promise');
            $Legiscourt->Pay2_Promise = $request->get('Pay2Promise');
            $Legiscourt->Pay3_Promise = $request->get('Pay3Promise');
            $Legiscourt->Sum_Promise = $request->get('SumPromise');
            $Legiscourt->Due_Promise = $request->get('DuePromise');
            $Legiscourt->DuePay_Promise = $request->get('DuePayPromise');
            $Legiscourt->Datelast_Promise = $request->get('DatelastPromise');
            $Legiscourt->SumAll_Promise = $request->get('SumAllPromise');
          $Legiscourt->update();
        }

        $data = DB::table('Legiscompromises')
                  ->where('Legiscompromises.legisPromise_id',$input["Getid"])->get();

        $Typecom = [
          'ประนอมที่ศาล' => 'ประนอมที่ศาล',
          'ประนอมที่บริษัท' => 'ประนอมที่บริษัท',
          'หลังยึดทรัพย์' => 'หลังยึดทรัพย์',
        ];

        return response()->json(['success'=> $data]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function updateLegislation(Request $request, $id, $type)
     {
       // dd( $id, $type,$request->get('Flag'));
       if ($type == 6) {     //ข้อมูลผู้เช่าซื้อจากฝ่ายวิเคราะห์
         $nowday = date('Y-m-d');
         $user = Legislation::find($id);
               $user->Flag_status = $request->get('Flag');
               $user->Datesend_Flag = $nowday;
         $user->update();

         $data = DB::table('legiscourts')
                  ->where('legislation_id', '=', $id)
                  ->count();

         $Legiscourt = new Legiscourt([
           'legislation_id' => $id,
           'fillingdate_court' => Null,
           'law_court' =>  Null,
           'bnumber_court' =>  Null,
           'rnumber_court' =>  Null,
           'capital_court' =>  Null,
           'indictment_court' =>  Null,
           'pricelawyer_court' =>  Null,
           'examiday_court' =>  Null,
           'fuzzy_court' =>  Null,
           'examinote_court' =>  Null,
           'orderday_court' =>  Null,
           'ordersend_court' =>  Null,
           'checkday_court' =>  Null,
           'checksend_court' =>  Null,
           'buyer_court' =>  Null,
           'support_court' =>  Null,
           'note_court' =>  Null,
           'social_flag' =>  Null,
           'setoffice_court' =>  Null,
           'sendoffice_court' =>  Null,
           'checkresults_court' =>  Null,
           'sendcheckresults_court' =>  Null,
           'received_court' =>  Null,
           'telresults_court' =>  Null,
           'dayresults_court' =>  Null,
           'latitude_court' =>  Null,
           'longitude_court' =>  Null,
         ]);
         $Legiscourt->save();


         $Legiscourtcase = new Legiscourtcase([
           'legislation_id' => $id,
           'datepreparedoc_case' => Null,
           'noteprepare_case' =>  Null,
           'datesetsequester_case' =>  Null,
           'resultsequester_case' =>  Null,
           'notesequester_case' =>  Null,
           'paidsequester_case' =>  Null,
           'datenextsequester_case' =>  Null,
           'resultsell_case' =>  Null,
           'datesoldout_case' =>  Null,
           'amountsequester_case' =>  Null,
           'statussequester_case' =>  Null,
         ]);
         $Legiscourtcase->save();

         return redirect()->Route('legislation',$type)->with('success','ส่งเรียบร้อย');
       }
     }

    public function destroy($id ,$type)
    {
      if ($type == 1) { //ลบทั้งหมด
        $item = Legislation::find($id);
        $item2 = Legiscourt::where('legislation_id',$id);
        $item3 = Legiscompromise::where('legisPromise_id',$id);
        $item4 = legispayment::where('legis_Com_Payment_id',$id);

        $item->Delete();
        $item2->Delete();
        $item3->Delete();
        $item4->Delete();
      }
      elseif ($type == 2) { //ลบตาราง Payment
        $item = legispayment::where('Payment_id',$id);

        $item->Delete();
      }
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function deleteImageAll($id)
    {

      $item = LegisImage::where('legisImage_id','=',$id)->get();

      foreach ($item as $key => $value) {
        $itemID = $value->legisImage_id;
        $itemPath = $value->name_image;

        Storage::delete($itemPath);
      }

        $deleteItem = LegisImage::where('legisImage_id',$itemID);
        $deleteItem->Delete();

      return redirect()->back()->with('success','ลบรูปทั้งหมดเรียบร้อยแล้ว');
    }
}
