<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Exporter;
use Carbon\Carbon;
use App\Holdcar;

class PrecController extends Controller
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

        if ($request->type == 1) {
          $fdate = $date;
          $tdate = $date;
          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();

          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','type'));
        }
        elseif ($request->type == 2) {
          $fdate = $date;
          $tdate = $date;
          $follower = '';
          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }
          if ($request->has('follower')) {
            $follower = $request->get('follower');
          }

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->when(!empty($follower), function($q) use($follower){
                      return $q->where('SFHP.ARMAST.BILLCOLL',$follower);
                    })
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();

          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','follower','type'));
        }
        elseif ($request->type == 3) {
          $newdate = date('Y-m-d', strtotime('+3 days'));
          $fdate = $newdate;
          $tdate = $newdate;
          $newDay = date('d')+3;

          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
            $newDay = substr($fdate, 8, 9);
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }

          $data1 = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();


          $data2 = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->when(!empty($newDay), function($q) use ($newDay) {
                      return $q->whereDay('SFHP.ARMAST.FDATE',$newDay);
                    })
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();

          $count = count($data2);

          for ($i=0; $i < $count; $i++) {
            if($data2[$i]->EXP_FRM == $data2[$i]->EXP_TO){
                $data3[] = $data2[$i];
                $data = $data1->concat($data3);
            }else{
                $data = $data1;
            }
          }

          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','type'));
        }
        elseif ($request->type == 4) {
          $fdate = $date;
          $tdate = $date;
          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->whereBetween('SFHP.ARMAST.HLDNO',[4.7,5.69])
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();
          // dd($data);

          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','type'));
        }
        elseif ($request->type == 5) {
          $fdate = '';
          $tdate = '';
          $Statuscar = '';
          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }
          if ($request->has('Statuscar')) {
            $Statuscar = $request->get('Statuscar');
          }
          // dd($fdate,$tdate);
          $data = DB::table('holdcars')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('holdcars.Date_hold',[$fdate,$tdate]);
          })
          ->when(!empty($Statuscar), function($q) use ($Statuscar) {
            return $q->where('holdcars.Statuscar',$Statuscar);
          })
          ->orderBy('holdcars.Date_hold', 'ASC')
          ->get();

          $type = $request->type;
          return view('precipitate.viewstock', compact('data','type','fdate','tdate','Statuscar'));
        }
        elseif ($request->type == 6) {
          // dd($request->type);
          $type = $request->type;
          return view('precipitate.createstock', compact('type'));
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
        if($request->type == 6) {
          $SetPricehold = str_replace (",","",$request->get('Pricehold'));
          $SetAmounthold = str_replace (",","",$request->get('Amounthold'));
          $SetPayhold = str_replace (",","",$request->get('Payhold'));
          $SetCapitalAccount = str_replace (",","",$request->get('CapitalAccount'));
          $SetCapitalTopprice = str_replace (",","",$request->get('CapitalTopprice'));
          $Holdcardb = new Holdcar([
            'Contno_hold' => $request->get('Contno'),
            'Name_hold' => $request->get('NameCustomer'),
            'Brandcar_hold' => $request->get('Brandcar'),
            'Number_Regist' => $request->get('Number_Regist'),
            'Year_Product' => $request->get('Yearcar'),
            'Date_hold' => $request->get('Datehold'),
            'Team_hold' => $request->get('Teamhold'),
            'Price_hold' => $SetPricehold,
            'Statuscar' => $request->get('Statuscar'),
            'Note_hold' => $request->get('Note'),
            'Date_came' => $request->get('Datecame'),
            'Amount_hold' => $SetAmounthold,
            'Pay_hold' => $SetPayhold,
            'Datecheck_Capital' => $request->get('DatecheckCapital'),
            'Datesend_Stockhome' => $request->get('DatesendStockhome'),
            'Datesend_Letter' => $request->get('DatesendLetter'),
            'Barcode_No' => $request->get('BarcodeNo'),
            'Capital_Account' => $SetCapitalAccount,
            'Capital_Topprice' => $SetCapitalTopprice,
            'Note2_hold' => $request->get('Note2'),
            'Letter_hold' => $request->get('Letter'),
            'Date_send' => $request->get('Datesend'),
            'Barcode2' => $request->get('Barcode2'),
            'Accept_hold' => $request->get('Accept'),
            'Soldout_hold' => $request->get('Soldout'),
          ]);
          $Holdcardb->save();
          $type = 5;
          return redirect()->Route('Precipitate', $type)->with('success','บันทึกข้อมูลเรียบร้อย');
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
    public function edit($id,Request $request)
    {
        if($request->type == 5) {
          // dd($id);
          $data = DB::table('holdcars')
                    ->where('holdcars.hold_id',$id)
                    ->first();

          $type = $request->type;

          $Statuscar = [
            '1' => 'ยึดจากลูกค้าครั้งแรก',
            '2' => 'ลูกค้ามารับรถคืน',
            '3' => 'ยึดจากลูกค้าครั้งที่สอง',
            '4' => 'ส่งรถบ้าน',
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

          $Teamhold = [
            '102' => '102 - นายอับดุลเล๊าะ กาซอ',
            '104' => '104 - นายอนุวัฒน์ อับดุลราน',
            '105' => '105 - นายธีรวัฒน์ เจ๊ะกา',
            '112' => '112 - นายราชัน เจ๊ะกา',
            '113' => '113 - นายฟิฏตรี วิชา',
            '114' => '114 - นายอานันท์ กาซอ',
          ];

          return view('Precipitate.editstock', compact('data','type','id','Statuscar','Brandcarr','Teamhold'));
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
        if($type == 5) {
          $SetPricehold = str_replace (",","",$request->get('Pricehold'));
          $SetAmounthold = str_replace (",","",$request->get('Amounthold'));
          $SetPayhold = str_replace (",","",$request->get('Payhold'));
          $SetCapitalAccount = str_replace (",","",$request->get('CapitalAccount'));
          $SetCapitalTopprice = str_replace (",","",$request->get('CapitalTopprice'));

          $hold = Holdcar::where('Hold_id',$id)->first();
            $hold->Contno_hold = $request->get('Contno');
            $hold->Name_hold = $request->get('NameCustomer');
            $hold->Brandcar_hold = $request->get('Brandcar');
            $hold->Number_Regist = $request->get('Number_Regist');
            $hold->Year_Product = $request->get('Yearcar');
            $hold->Date_hold = $request->get('Datehold');
            $hold->Team_hold = $request->get('Teamhold');
            $hold->Price_hold = $SetPricehold;
            $hold->Statuscar = $request->get('Statuscar');
            $hold->Note_hold = $request->get('Note');
            // dd($hold->Note_hold);
            $hold->Date_came = $request->get('Datecame');
            $hold->Amount_hold = $SetAmounthold;
            $hold->Pay_hold = $SetPayhold;
            $hold->Datecheck_Capital = $request->get('DatecheckCapital');
            $hold->Datesend_Stockhome = $request->get('DatesendStockhome');
            $hold->Datesend_Letter = $request->get('DatesendLetter');
            $hold->Barcode_No = $request->get('BarcodeNo');
            $hold->Capital_Account = $SetCapitalAccount;
            $hold->Capital_Topprice = $SetCapitalTopprice;
            $hold->Note2_hold = $request->get('Note2');
            $hold->Letter_hold = $request->get('Letter');
            $hold->Date_send = $request->get('Datesend');
            $hold->Barcode2 = $request->get('Barcode2');
            $hold->Accept_hold = $request->get('Accept');
            $hold->Soldout_hold = $request->get('Soldout');
          $hold->update();
          return redirect()->Route('Precipitate', $type)->with('success','อัพเดทข้อมูลเรียบร้อย');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $type)
    {
      if($type == 5) {
        $item1 = Holdcar::find($id);
        $item1->Delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
      }
    }

    public function ReportPrecDue(Request $request, $SetStr1, $SetStr2)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;

      $fdate = '';
      $tdate = '';
      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }

      if ($request->type == 1) {
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->where('SFHP.ARMAST.BILLCOLL','=',99)
                  ->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate])
                  ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                  ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                  ->get();

        $view = \View::make('precipitate.ReportPrecDue' ,compact('data','date','fdate','tdate'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายงานข้อมูลติดตาม');
        $pdf::AddPage('L', 'A4');
        $pdf::SetMargins(5, 5, 5, 0);
        $pdf::SetFont('freeserif', '', 8, '', true);
        $pdf::SetAutoPageBreak(TRUE, 25);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('ReportPrecDue.pdf');
      }     //รายงาน ใบติดตาม     //รายงาน ใบติดตาม
      elseif ($request->type == 2) {  //รายงาน ใบแจ้งหนี้

        $SetStrConn = $SetStr1."/".$SetStr2;
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->leftJoin('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->leftJoin('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                  ->leftJoin('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->leftJoin('SFHP.VIEW_ARMGAR','SFHP.ARMAST.CONTNO','=','SFHP.VIEW_ARMGAR.CONTNO')
                  ->leftJoin('SFHP.ARMGAR','SFHP.ARMAST.CONTNO','=','SFHP.ARMGAR.CONTNO')
                  ->leftJoin('SFHP.TBROKER','SFHP.ARMAST.RECOMCOD','=','SFHP.TBROKER.MEMBERID')
                  ->select('SFHP.ARMAST.*','SFHP.VIEW_CUSTMAIL.*','SFHP.INVTRAN.*','SFHP.TBROKER.*','SFHP.VIEW_ARMGAR.NAME','SFHP.VIEW_ARMGAR.NICKNM',
                           'SFHP.ARMGAR.RELATN','SFHP.VIEW_ARMGAR.ADDRES','SFHP.VIEW_ARMGAR.TUMB','SFHP.VIEW_ARMGAR.AUMPDES',
                           'SFHP.VIEW_ARMGAR.PROVDES','SFHP.VIEW_ARMGAR.OFFIC','SFHP.VIEW_ARMGAR.TELP')
                  ->where('SFHP.ARMAST.BILLCOLL','=',99)
                  ->where('SFHP.ARMAST.CONTNO','=',$SetStrConn)
                  ->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate])
                  ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                  ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                  ->get();

        $view = \View::make('precipitate.ReportInvoice' ,compact('data','date','fdate','tdate'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายงานข้อมูลติดตาม');
        $pdf::AddPage('P', 'A4');
        $pdf::SetMargins(5, 5, 5, 0);
        $pdf::SetFont('freeserif', '', 10, '', true);
        $pdf::SetAutoPageBreak(TRUE, 25);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('ReportInvoice.pdf');
      }
    }

    public function excel(Request $request)
    {
      if($request->type == 1){
      }
      elseif($request->type == 2){
      }
      elseif($request->type == 3){
          $newdate = date('Y-m-d', strtotime('+3 days'));
          $fdate = $newdate;
          $tdate = $newdate;
          $newDay = date('d')+3;

              if ($request->has('Fromdate')) {
                $fdate = $request->get('Fromdate');
                $newDay = substr($fdate, 8, 9);
              }
              if ($request->has('Todate')) {
                $tdate = $request->get('Todate');
              }

          $data1 = DB::connection('ibmi')
          ->table('SFHP.ARMAST')
          ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
          ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
          ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
          return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
          })
          ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
          ->where('SFHP.ARMAST.BILLCOLL','=',99)
          ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
          ->get();


          $data2 = DB::connection('ibmi')
          ->table('SFHP.ARMAST')
          ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
          ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
          ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
          ->where('SFHP.ARMAST.BILLCOLL','=',99)
          ->when(!empty($newDay), function($q) use ($newDay) {
          return $q->whereDay('SFHP.ARMAST.FDATE',$newDay);
          })
          ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
          ->get();
          $count = count($data2);

          for ($i=0; $i < $count; $i++) {
            if($data2[$i]->EXP_FRM == $data2[$i]->EXP_TO){
            $data3[] = $data2[$i];
            $data = $data1->concat($data3);
            }else{
            $data = $data1;
            }
          }

          $type = $request->type;

          $data_array[] = array('สาขา', 'เลขที่สัญญา', 'รหัสลูกค้า', 'ชื่อลูกค้า', 'ที่อยู่', 'วันที่ขาย', 'วันดิวงวดแรก', 'ราคาขาย',
                          'เงินดาวน์', 'วันชำระล่าสุด', 'สถานะสัญญา', 'ผ่อนงวดละ', 'งวดค้างชำระ', 'รวมชำระแล้ว', 'ค้างจากงวด', 'ค้างถึงงวด',
                          'ชำระล่าสุด', 'ชำระดาวน์', 'พนักงานเก็บเงิน', 'รุ่นรถ', 'สีรถ', 'เลขทะเบียน', 'เลขถัง', 'ค้างดาวน์', 'ค้างเบี้ยปรับ',
                          'ค้างลูกหนี้อื่น', 'ลูกหนี้คงเหลือ', 'ค้างงวด', 'ค้างงวดจริง', 'ผู้ตรวจสอบ', 'เบอร์โทร');
                          foreach($data as $key => $row){
                            $date1 = date_create($row->ISSUDT);
                            $ISSUDT = date_format($date1, 'd-m-Y');

                            $date2 = date_create($row->FDATE);
                            $FDATE = date_format($date2, 'd-m-Y');

                            $date3 = date_create($row->LPAYD);
                            $LPAYD = date_format($date3, 'd-m-Y');

                            $data_array[] = array(
                             'สาขา' => $row->LOCAT,
                             'เลขที่สัญญา' => $row->CONTNO,
                             'รหัสลูกค้า' => $row->CUSCOD,
                             'ชื่อลูกค้า' => iconv('Tis-620','utf-8', str_replace(" ","",$row->SNAM).str_replace(" ","",$row->NAME1).'   '.str_replace(" ","",$row->NAME2)),
                             'ที่อยู่' => iconv('Tis-620','utf-8',str_replace(" ","",$row->ADDRES).' '.str_replace(" ","",$row->TUMB).' '.str_replace(" ","",$row->AUMPDES).' '.str_replace(" ","",$row->PROVDES).' '.str_replace(" ","",$row->AUMPCOD)),
                             'วันที่ขาย' => $ISSUDT,
                             'วันดิวงวดแรก' => $FDATE,
                             'ราคาขาย' => number_format($row->TOTPRC, 2),
                             'เงินดาวน์' => number_format($row->PAYDWN, 2),
                             'วันชำระล่าสุด' => $LPAYD,
                             'สถานะสัญญา' => iconv('Tis-620','utf-8',$row->CONTSTAT),
                             'ผ่อนงวดละ' => number_format($row->T_LUPAY, 2),
                             'งวดค้างชำระ' => number_format($row->EXP_AMT, 2),
                             'รวมชำระแล้ว' => number_format($row->SMPAY, 2),
                             'ค้างจากงวด' => $row->EXP_FRM,
                             'ค้างถึงงวด' => $row->EXP_TO,
                             'ชำระล่าสุด' => number_format($row->LPAYA, 2),
                             'ชำระดาวน์' => number_format($row->PAYDWN, 2),
                             'พนักงานเก็บเงิน' => $row->BILLCOLL,
                             'รุ่นรถ' => iconv('TIS-620', 'utf-8', $row->MODEL),
                             'สีรถ' => iconv('TIS-620', 'utf-8', $row->COLOR),
                             'เลขทะเบียน' => iconv('TIS-620', 'utf-8', $row->REGNO),
                             'เลขถัง' => $row->STRNO,
                             'ค้างดาวน์' => '',
                             'ค้างเบี้ยปรับ' => '',
                             'ค้างลูกหนี้อื่น' => '',
                             'ลูกหนี้คงเหลือ' => number_format($row->BALANC - $row->SMPAY, 2),
                             'ค้างงวด' => number_format($row->EXP_PRD, 0),
                             'ค้างงวดจริง' => number_format($row->HLDNO, 2),
                             'ผู้ตรวจสอบ' => $row->CHECKER,
                             'เบอร์โทร' => iconv('Tis-620','utf-8',str_replace("-","", str_replace("/",",",$row->TELP))),
                            );
                          }
                        $data_array = collect($data_array);
                        $excel = Exporter::make('Excel');
                        $excel->load($data_array);

                        return $excel->stream($newDay.'.xlsx');
      }
    }

}
