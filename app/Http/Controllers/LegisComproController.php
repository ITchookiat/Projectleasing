<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use PDF;
use Carbon\Carbon;

use App\Legislation;
use App\Legiscompromise;
use App\legispayment;

class LegisComproController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->type == 1) {       //หน้าหลัก ประนอมหนี้
          $dataNew = DB::table('legislations')
              ->join('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->where('Legiscompromises.Date_Promise','!=', null)
              ->where('legislations.Flag','!=', 'C')
              ->get();

          $dataOld = DB::table('legislations')
              ->join('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->where('legislations.Flag_status','=', '3')
              ->where('legislations.Flag','=', 'C')
              ->get();

          $data1 = count($dataNew);
          $data2 = count($dataOld);

          $Sum1 = 0;
          $Sum2 = 0;
          $SumPrice1 = 0;
          $SumDiscount1 = 0;

          $Sum3 = 0;
          $Sum4 = 0;
          $SumPrice2 = 0;
          $SumDiscount2 = 0;

          foreach ($dataNew as $key => $value) {
            $Sum1 += $value->Total_Promise;
            $Sum2 += $value->Sum_Promise;
            $SumPrice1 += ($value->Sum_FirstPromise + $value->Sum_DuePayPromise);
            $SumDiscount1 += $value->Discount_Promise;
          }
          foreach ($dataOld as $key => $value) {
            $Sum3 += $value->Total_Promise;
            $Sum4 += $value->Sum_Promise;
            $SumPrice2 += ($value->Sum_FirstPromise + $value->Sum_DuePayPromise);
            $SumDiscount2 += $value->Discount_Promise;
          }

          $type = $request->type;
          return view('legislation.viewCompro', compact('dataNew','dataOld','type','data1','data2',
                                                        'Sum1','Sum2','SumPrice1','SumDiscount1','Sum3','Sum4','SumPrice2','SumDiscount2'));
      }
      elseif ($request->type == 2) {   //ลูกหนี้ประนอมหนี้(ใหม่)
          $lastday = date('Y-m-d', strtotime("-90 days"));
          $newfdate = '';
          $newtdate = '';
          $status = '';
  
          if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
          }
          if ($request->has('status')) {
            $status = $request->get('status');
          }
  
          $data = DB::table('legislations')
            ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
            })
            ->where('legislations.Flag','!=', 'C')
            ->where('Legiscompromises.Date_Promise','!=', null)
            ->orderBy('legislations.Contract_legis', 'ASC')
            ->get();
  
          $type = $request->type;
          return view('legislation.viewCompro', compact('type', 'data','newfdate','newtdate','status','dataPay','dataType'));
      }
      elseif ($request->type == 3) {   //ลูกหนี้ประนอมหนี้(เก่า)
          $lastday = date('Y-m-d', strtotime("-90 days"));
          $newfdate = '';
          $newtdate = '';
          $status = '';
  
          if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
          }
          if ($request->has('status')) {
            $status = $request->get('status');
          }
  
          $data = DB::table('legislations')
              ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
              })
              ->where('legislations.Flag','=', 'C')
              ->where('legislations.KeyCompro_id', '!=', NULL)
              ->orderBy('legislations.Contract_legis', 'ASC')
              ->get();

          if($status == "ชำระปกติ"){
            $data = DB::table('legislations')
                  ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                  ->where('Legiscompromises.Status_Promise','=', Null)
                  ->where('legispayments.Flag_Payment', '=', 'Y')
                  ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
                  })
                  ->when(!empty($status), function($q) use($lastday){
                    return $q->where('legispayments.Date_Payment','>=',$lastday);
                  })
                  ->orderBy('legislations.Contract_legis', 'ASC')
                  ->get();
  
          }
          elseif($status == "ขาดชำระ"){
            $data = DB::table('legislations')
                  ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                  ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                  ->where('Legiscompromises.Status_Promise','=', NULL)
                  ->where('legispayments.Flag_Payment', '=', 'Y')
                  ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    return $q->whereBetween('legispayments.Date_Payment',[$newfdate,$newtdate]);
                  })
                  ->when(!empty($status), function($q) use($lastday){
                      return $q->where('legispayments.Date_Payment','<',$lastday);
                    })
                  ->get();
          }
          elseif($status == "ปิดบัญชี"){
            $data = DB::table('legislations')
              ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->where('Legiscompromises.Status_Promise','!=', NULL)
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('Legiscompromises.DateStatus_Promise',[$newfdate,$newtdate]);
              })
              ->orderBy('legislations.Contract_legis', 'ASC')
              ->get(); 
          }
  
          $type = $request->type;
          return view('legislation.viewCompro', compact('type', 'data','newfdate','newtdate','status','dataPay','dataType'));
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
      $Payment = legispayment ::find($request->id);
          if ($Payment != Null) {
              DB::table('legispayments')
              ->where('legis_Com_Payment_id', $request->id)
              ->update([
                  'Flag_Payment' => 'N'
              ]);
          }

      $GetNumPeriod = DB::table('legispayments')
              ->where('legis_Com_Payment_id', $request->id)
              ->orderBy('Period_Payment', 'desc')->limit(1)
              ->first();

      $connect = DB::table('legispayments')
              ->orderBy('Jobnumber_Payment', 'desc')->limit(1)
              ->get();
      $connectCon = count($connect);

      if ($connectCon != 0) {
          $GetJob = $connect[0]->Jobnumber_Payment;
          $SetStr = explode("-",$GetJob);
          $SetJobNumber = $SetStr[1] + 1;
  
          // ดึงปีและเดือนปัจจุบัน
          $SetNumDate = substr($SetStr[1],0,2);
          $Day = date('Y');
          $SubDay = substr($Day,2);
          $month = date('m');
  
          $num = "1000";
          $SubStr = substr($num.$SetJobNumber, -4);
          if ($SetNumDate == $SubDay) {
              $StrConn = $SetStr[0]."-".$SubDay."".$month."".$SubStr;
          }else {
              $StrConn = $SetStr[0]."-".$SubDay."".$month."0001";
          }
  
          // จำนวนงวด
          if ($GetNumPeriod != Null) {
              $Period = $GetNumPeriod->Period_Payment;
              $SetPeriod = $Period + 1;
          }else {
              $SetPeriod = 1;
          }
      }else {
          $Day = date('Y');
          $SubDay = substr($Day,2);
          $month = date('m');

          $StrConn = "ABL"."-".$SubDay."".$month."0001";
          $SetPeriod = 1;
      }

      $LegisPay = new legispayment([
          'legis_Com_Payment_id' => $request->id,
          'Date_Payment' => $request->get('DatePayment'),
          'Gold_Payment' => str_replace (",","",$request->get('GoldPayment')),
          'Type_Payment' =>  $request->get('TypePayment'),
          'Adduser_Payment' =>  $request->get('AdduserPayment'),
          'Note_Payment' =>  $request->get('NotePayment'),
          'Flag_Payment' =>  $request->get('FlagPayment'),
          'Jobnumber_Payment' => $StrConn,
          'Period_Payment' => $SetPeriod,
        ]);
      $LegisPay->save();

      $dataSum = DB::table('legispayments')
        ->join('Legiscompromises','legispayments.legis_Com_Payment_id','=','Legiscompromises.legisPromise_id')
        ->where('legis_Com_Payment_id','=', $request->id)
        ->get();

      $countdataSum = count($dataSum);
      $sum = 0;
      $SumFirst = 0;
      $SumPayDue = 0;

      if($countdataSum != 0){
        foreach ($dataSum as $key => $value) {
          $sum += $value->Gold_Payment;
          if ($value->Type_Payment == "เงินก้อนแรก(เงินสด)" || $value->Type_Payment == "เงินก้อนแรก(เงินโอน)") {
              $SumFirst += $value->Gold_Payment;
          }else {
              $SumPayDue += $value->Gold_Payment;
          }
        }
      }

      $Legiscom = Legiscompromise ::find($request->id);
          $Legiscom->KeyPay_id = $request->id;
          $Legiscom->Sum_Promise = $dataSum[0]->Total_Promise - $sum;
          $Legiscom->Sum_FirstPromise = $SumFirst;
          $Legiscom->Sum_DuePayPromise = $SumPayDue;
          $Legiscom->DatePayment_Promise = $request->get('DatePayment');
          $Legiscom->CashPayment_Promise = str_replace (",","",$request->get('GoldPayment'));
      $Legiscom->update();

      $type = 4;
      return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $type = $id;
      if ($id == 1 or $id == 2) {   //ติดตามประนอมหนี้ + การชำระค่างวด(บุคคล)
        return view('legislation.viewReport',compact('type'));
      }
      elseif ($id == 3) {           //ตรวจสอบการรับชำระ
        $dataDB = DB::table('users')
          ->where('users.type','=', "แผนก การเงินนอก")
          ->orwhere('users.type','=', "แผนก เร่งรัด")
          ->get();

        return view('legislation.viewReport',compact('type','dataDB'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      if ($request->type == 3 or $request->type == 2) {      //edit ลูกหนี้ประนอมหนี้
        $data = DB::table('legislations')
            ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
            ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
            ->where('legislations.id', $id)
            ->orderBy('legispayments.Period_Payment', 'desc')->limit(1)
            ->first();
                
        $dataPranom = DB::table('Legiscompromises')
            ->where('legisPromise_id', $id)
            ->count();

        $dataPay = DB::table('legispayments')
            ->where('legispayments.legis_Com_Payment_id', $id)
            ->get();

        $SumFirst = 0;
        $SumPayDue  = 0;
        if ($dataPay != NULL) {
            foreach ($dataPay as $key => $value) {
                if ($value->Type_Payment == "เงินก้อนแรก(เงินสด)" || $value->Type_Payment == "เงินก้อนแรก(เงินโอน)") {
                    $SumFirst += $value->Gold_Payment;
                }else {
                    $SumPayDue += $value->Gold_Payment;
                }
            }
        }
        
        $SumPay = $data->Total_Promise - ($SumFirst + $SumPayDue + $data->Discount_Promise);
        $type = $request->type;
        return view('legislation.compromise',compact('data','id','type','dataPay','SumPay','dataPranom','SumFirst','SumPayDue'));
      }
      elseif ($request->type == 5) {      //ดึงข้อมูล payments
          $data = DB::table('legislations')
              ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
              ->where('legispayments.legis_Com_Payment_id', $id)
              // ->orderBy('legispayments.Period_Payment', 'desc')->limit(1)
              ->where('legispayments.Flag_Payment', '=', 'Y')
              ->first();

          $dataPranom = DB::table('legislations')
              ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->where('legislations.id', $id)
              ->first();

          return view('legislation.payment',compact('data','dataPranom','id','type'));
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = DB::table('Legiscompromises')
          ->where('Legiscompromises.legisPromise_id', $id)->first();

      $SetTotalPromise = str_replace (",","",$request->get('TotalPromise'));
      $SetSumPromise = str_replace (",","",$request->get('Sumhide'));
      $SetDuePay = str_replace (",","",$request->get('DuePayPromise'));
      $SetDiscount = str_replace (",","",$request->get('DiscountPromise'));
      $SetPayallPromise = str_replace (",","",$request->get('PayallPromise'));

      if ($data == Null) {
          $LegisPromise = new Legiscompromise([
            'Date_Promise' => date('Y-m-d'),
            'legisPromise_id' => $id,
            'KeyPay_id' => Null,
            'Flag_Promise' => $request->get('FlagPromise'),
            'Total_Promise' => $SetTotalPromise,
            'Type_Promise' =>  $request->get('TypePromise'),
            'DateNsale_Promise' =>  $request->get('DateNsalePromise'),
            'Dateset_Promise' =>  $request->get('DatesetPromise'),
            'Payall_Promise' =>  $SetPayallPromise,
            'DateFirst_Promise' => $request->get('DateFirstPromise'),
            'Sum_Promise' =>  $SetSumPromise,
            'Discount_Promise' =>  $SetDiscount,
            'Due_Promise' =>  $request->get('DuePromise'),
            'DuePay_Promise' =>  $SetDuePay,
            'Note_Promise' =>  $request->get('NotePromise'),
            'User_Promise' =>  auth()->user()->name,
          ]);
          $LegisPromise->save();
      }else {
          $LegisPromise = Legiscompromise::where('legisPromise_id',$id)->first();
          $LegisPromise->Flag_Promise = $request->get('FlagPromise');
          $LegisPromise->Total_Promise = $SetTotalPromise;
          $LegisPromise->Type_Promise = $request->get('TypePromise');
          $LegisPromise->DateNsale_Promise = $request->get('DateNsalePromise');
          $LegisPromise->Dateset_Promise = $request->get('DatesetPromise');
          $LegisPromise->Payall_Promise = $SetPayallPromise;
          $LegisPromise->DateFirst_Promise = $request->get('DateFirstPromise');
          $LegisPromise->Sum_Promise = $SetSumPromise;
          $LegisPromise->Discount_Promise = $SetDiscount;
          $LegisPromise->Due_Promise = $request->get('DuePromise');
          $LegisPromise->DuePay_Promise = $SetDuePay;
          $LegisPromise->Note_Promise = $request->get('NotePromise');
          $LegisPromise->Sum_FirstPromise = $request->get('SumFirst');
          $LegisPromise->Sum_DuePayPromise = $request->get('SumPayDue');
          $LegisPromise->DatePayment_Promise = $request->get('DatehidePayment');
          $LegisPromise->CashPayment_Promise = str_replace (",","",$request->get('GoldPayment'));
          if ($request->get('StatusCompro') != NULL) {
            $LegisPromise->Status_Promise = $request->get('StatusCompro');
            $LegisPromise->DateStatus_Promise = date('Y-m-d');
          }else {
            $LegisPromise->Status_Promise = NULL;
            $LegisPromise->DateStatus_Promise = NULL;
          }
        $LegisPromise->update();
      }

      $data = DB::table('legislations')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('Legiscompromises.legisPromise_id', $id)
          ->orderBy('legislations.Contract_legis', 'ASC')
          ->first();

      // update key ลูก
      $Legislation = Legislation::find($id);
        $Legislation->KeyCompro_id = $data->Promise_id;
      $Legislation->update();

      return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if ($request->type == 1) { //ลบรายการ(ประนอมหนี้เก่า)ทั้งหมด
          $item = Legislation::find($id);
          $item1 = Legiscompromise::where('legisPromise_id',$id);
          $item2 = legispayment::where('legis_Com_Payment_id',$id);
  
          $item->Delete();
          $item1->Delete();
          $item2->Delete();
      }
      elseif ($request->type == 2) { //ลบตาราง Payment
        $item1 = legispayment::where('Payment_id',$id)->first();
        $dataFind = DB::table('legiscompromises')
                      ->where('legisPromise_id','=', $item1->legis_Com_Payment_id)->first();

        $total = $dataFind->Sum_Promise + $item1->Gold_Payment;
        $Legiscom = Legiscompromise ::find($item1->legis_Com_Payment_id);
            $Legiscom->Sum_Promise = $total;
            if ($item1->Type_Payment == 'เงินก้อนแรก(เงินสด)' || $item1->Type_Payment == 'เงินก้อนแรก(เงินโอน)') {
                $Legiscom->Sum_FirstPromise -= $item1->Gold_Payment;
            }else {
                $Legiscom->Sum_DuePayPromise -= $item1->Gold_Payment;
            }
            $Legiscom->update();

        $item = legispayment::where('Payment_id',$id);
        $item->Delete();

        $LegisPay = legispayment::where('legis_Com_Payment_id',$item1->legis_Com_Payment_id)->latest()->first();
        if ($LegisPay != Null) {
          DB::table('legispayments')
            ->where('Payment_id', $LegisPay->Payment_id)
            ->update([
                'Flag_Payment' => 'Y'
            ]);

          $Legiscom = Legiscompromise ::find($item1->legis_Com_Payment_id);
            $Legiscom->DatePayment_Promise = $LegisPay->Date_Payment;
            $Legiscom->CashPayment_Promise = $LegisPay->Gold_Payment;
          $Legiscom->update(); 
        }
      }
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function ReportCompro(Request $request, $type)
    {
      if ($type == 2) {       //รายงาน Excel ลูกหนี้ใหม่
        $data = DB::table('legislations')
          ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
          ->where('legislations.Flag','!=', 'C')
          ->where('Legiscompromises.Date_Promise','!=', null)
          ->where('legispayments.Flag_Payment', '=', 'Y')
          ->orderBy('legislations.Contract_legis', 'ASC')
          ->get();

        $status = 'ลูกหนี้ประนอมหนี้ใหม่';
        Excel::create('รายงานลูกหนี้ประนอมหนี้ใหม่', function ($excel) use($data,$status) {
          $excel->sheet($status, function ($sheet) use($data,$status) {
              $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
              $sheet->prependRow(2, array($status));
              $sheet->cells('A3:P3', function($cells) {
                $cells->setBackground('#FFCC00');
              });
              $row = 3;
              $sheet->row($row, array('ลำดับ', 'เลขที่สัญญา', 'ชื่อ-สกุล','เริ่มประนอมหนี้', 'สถานะลูกหนี้', 
                  'ยอดประนอมหนี้', 'เงินก้อนแรก','สถานะก้อนแรก','จำนวนงวด', 'งวดละ','ยอดชำระรวม', 'ยอดคงเหลือ', 
                  'วันที่ชำระล่าสุด', 'ยอดชำระล่าสุด', 'ประเภทชำระ', 'วันที่ดิวถัดไป','หมายเหตุ'));

              foreach ($data as $key => $value) {
                if ($value->Status_Promise == NULL) {
                  $lastday = date('Y-m-d', strtotime("-90 days"));
                  $payAll = str_replace(",","",$value->Payall_Promise);
                  if($value->DatePayment_Promise < $lastday){
                    $SetStatus = "ขาดชำระ";
                  }else {
                    $SetStatus = "ชำระปกติ";
                  }
                }else {
                  $SetStatus = $value->Status_Promise;
                }

                if ($value->Sum_FirstPromise == $payAll) {
                  $SetStatusPayAll = "ครบชำระก้อนแรก";
                }else {
                  $SetStatusPayAll = "ขาดชำระก้อนแรก";
                }

                $sheet->row(++$row, array(
                  $key+1,
                  $value->Contract_legis,
                  $value->Name_legis,
                  $value->Date_Promise,
                  $SetStatus,
                  number_format($value->Total_Promise, 2),
                  $value->Payall_Promise,
                  $SetStatusPayAll,
                  $value->Due_Promise,
                  number_format($value->DuePay_Promise, 0),
                  number_format($value->Sum_FirstPromise + $value->Sum_DuePayPromise, 2),
                  number_format($value->Sum_Promise, 2),
                  substr($value->created_at,0,10),
                  number_format($value->Gold_Payment, 2),
                  $value->Type_Payment,
                  $value->Date_Payment,
                  $value->Note_Promise,
                ));

              }
          });
        })->export('xlsx');
      }
      elseif ($type == 3) {   //รายงาน Excel ลูกหนี้เก่า
        $data = DB::table('legislations')
          ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
          ->where('legislations.Flag','=', 'C')
          ->where('legispayments.Flag_Payment', '=', 'Y')
          ->orderBy('legislations.Contract_legis', 'ASC')
          ->get();

        $status = 'ลูกหนี้ประนอมหนี้เก่า';
        Excel::create('รายงานลูกหนี้ประนอมหนี้เก่า', function ($excel) use($data,$status) {
          $excel->sheet($status, function ($sheet) use($data,$status) {
              $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
              $sheet->prependRow(2, array($status));
              $sheet->cells('A3:P3', function($cells) {
                $cells->setBackground('#FFCC00');
              });
              $row = 3;
              $sheet->row($row, array('ลำดับ', 'เลขที่สัญญา', 'ชื่อ-สกุล','เริ่มประนอมหนี้', 'สถานะลูกหนี้', 
                  'ยอดประนอมหนี้', 'เงินก้อนแรก','สถานะก้อนแรก','จำนวนงวด', 'งวดละ','ยอดชำระรวม', 'ยอดคงเหลือ', 
                  'วันที่ชำระล่าสุด', 'ยอดชำระล่าสุด', 'ประเภทชำระ', 'วันที่ดิวถัดไป','หมายเหตุ'));

              foreach ($data as $key => $value) {
                if ($value->Status_Promise == NULL) {
                  $lastday = date('Y-m-d', strtotime("-90 days"));
                  $payAll = str_replace(",","",$value->Payall_Promise);
                  if($value->DatePayment_Promise < $lastday){
                    $SetStatus = "ขาดชำระ";
                  }else {
                    $SetStatus = "ชำระปกติ";
                  }
                }else {
                  $SetStatus = $value->Status_Promise;
                }

                if ($value->Sum_FirstPromise == $payAll) {
                  $SetStatusPayAll = "ครบชำระก้อนแรก";
                }else {
                  $SetStatusPayAll = "ขาดชำระก้อนแรก";
                }

                $sheet->row(++$row, array(
                  $key+1,
                  $value->Contract_legis,
                  $value->Name_legis,
                  $value->Date_Promise,
                  $SetStatus,
                  number_format($value->Total_Promise, 2),
                  $value->Payall_Promise,
                  $SetStatusPayAll,
                  $value->Due_Promise,
                  number_format($value->DuePay_Promise, 0),
                  number_format($value->Sum_FirstPromise + $value->Sum_DuePayPromise, 2),
                  number_format($value->Sum_Promise, 2),
                  substr($value->created_at,0,10),
                  number_format($value->Gold_Payment, 2),
                  $value->Type_Payment,
                  $value->Date_Payment,
                  $value->Note_Promise,
                ));

              }
          });
        })->export('xlsx');
      }
      elseif ($type == 4) {   //รายงาน ตรวจสอบการรับชำระ
        $newfdate = '';
        $newtdate = '';
        $CashReceiver = '';

        if ($request->has('Fromdate')) {
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = Carbon::parse($tdate)->addDays(+1);
        }
        if ($request->has('CashReceiver')) {
          $CashReceiver = $request->get('CashReceiver');
        }

        $data = DB::table('legislations')
          ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
          ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
            return $q->whereBetween('legispayments.created_at',[$newfdate,$newtdate]);
          })
          ->when(!empty($CashReceiver), function($q) use($CashReceiver){
              return $q->where('legispayments.Adduser_Payment','=',$CashReceiver);
            })
          ->orderBy('legispayments.created_at','ASC')
          ->get();

        $newtdate = Carbon::parse($tdate);

        $pdf = new PDF();
        $pdf::SetTitle('รายงานตรวจสอบยอดชำระ');
        $pdf::AddPage('L', 'A4');
        $pdf::SetFont('thsarabunpsk', '', 14, '', true);
        $pdf::SetMargins(5, 5, 5, 0);
        $pdf::SetAutoPageBreak(TRUE, 18);

        $view = \View::make('legislation.reportCompro' ,compact('data','type','dataCount','CashReceiver','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 5) {   //รายงาน การชำระค่างวด(บุคคล)
        $dataDB = DB::table('legislations')
          ->join('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->join('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
          ->where('legislations.Contract_legis', '=', $request->Contract)
          ->get();

        $dataCount = count($dataDB);

        if ($dataCount != 0) {
          if ($dataDB[0]->Flag == "C") {
            $data = DB::connection('ibmi')
              ->table('ASFHP.ARMAST')
              ->join('ASFHP.INVTRAN','ASFHP.ARMAST.CONTNO','=','ASFHP.INVTRAN.CONTNO')
              ->join('ASFHP.VIEW_CUSTMAIL','ASFHP.ARMAST.CUSCOD','=','ASFHP.VIEW_CUSTMAIL.CUSCOD')
              ->where('ASFHP.ARMAST.CONTNO','=', $dataDB[0]->Contract_legis)
              ->first();
          }else {
            $data = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
              ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
              ->where('SFHP.ARMAST.CONTNO','=', $dataDB[0]->Contract_legis)
              ->first();
          }
        }else {
          dd('ไม่มีเลขที่สัญญานี้ไม่ระบบประนอมหนี้');
        }

        $pdf = new PDF();
        $pdf::SetTitle('รายงาน การชำระค่างวด(บุคคล)');
        $pdf::AddPage('P', 'A4');
        $pdf::SetMargins(5, 5, 5, 5);
        $pdf::SetFont('freeserif', '', 8, '', true);

        $view = \View::make('legislation.reportCompro' ,compact('data','dataDB','type','dataCount','status','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
              }
    }
}
