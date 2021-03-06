<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
use Excel;

use App\Buyer;
use App\Sponsor;
use App\Cardetail;
use App\Expenses;

class ReportAnalysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('sdfdsfd');
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
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ReportPDFIndex(Request $request, $id, $type)
    {
      $dataReport = DB::table('buyers')
                      ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
                      ->leftJoin('sponsor2s','buyers.id','=','sponsor2s.Buyer_id2')
                      ->leftJoin('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                      ->leftJoin('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                      ->leftJoin('data_customers','Buyers.Walkin_id','=','data_customers.Customer_id')
                      ->select('buyers.*','sponsors.*','sponsor2s.*','cardetails.*','expenses.*','data_customers.Customer_id','data_customers.Resource_news','buyers.created_at AS createdBuyers_at')
                      ->where('buyers.id',$id)->first();
      // $newDateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543 ."-". \Carbon\Carbon::parse($dataReport->Date_Due)->format('m')."-". \Carbon\Carbon::parse($dataReport->Date_Due)->format('d');
      $DateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('d')."-".\Carbon\Carbon::parse($dataReport->Date_Due)->format('m');
      $DateDueYear = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543;

      $newDateDue = $DateDue."-".$DateDueYear;
      $now = Carbon::now();
      $date = Carbon::parse($now)->format('d-m-Y');
      // dd($date);

      $view = \View::make('analysis.ReportAnalys' ,compact('dataReport','newDateDue','date','type','dataStructure'));
      $html = $view->render();

      $pdf = new PDF();
      $pdf::SetTitle('แบบฟอร์มขออนุมัติเช่าซื้อรถยนต์');
      $pdf::AddPage('P', 'A4');
      $pdf::SetMargins(10, 5, 5, 5);
      $pdf::SetFont('freeserif', '', 11, '', true);
      $pdf::SetAutoPageBreak(TRUE, 5);
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }

    public function ReportHomecar(Request $request, $id, $type)
    {
      $dataReport = DB::table('buyers')
      ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
      ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
      ->where('buyers.id',$id)->first();

      // dd($type);
      $DateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('d')."-".\Carbon\Carbon::parse($dataReport->Date_Due)->format('m');
      $DateDueYear = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543;

      $newDateDue = $DateDue."-".$DateDueYear;
      $now = Carbon::now();
      $date = Carbon::parse($now)->format('d-m-Y');

      $view = \View::make('analysis.ReportAnalys' ,compact('dataReport','newDateDue','date','type'));
      $html = $view->render();

      $pdf = new PDF();
      $pdf::SetTitle('แบบฟอร์มขออนุมัติเช่าซื้อรถยนต์');
      $pdf::AddPage('P', 'A4');
      $pdf::SetMargins(10, 5, 5, 5);
      $pdf::SetFont('freeserif', '', 11, '', true);
      $pdf::SetAutoPageBreak(TRUE, 5);
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }

    public function ReportDueDate(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $Y2 = date('Y') +543;
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;
      $date2 = $d.'-'.$m.'-'.$Y2;
      
      $newfdate = date('Y-m-d');
      $newtdate = date('Y-m-d');
      if($request->type == 1){  //รายงานอนุมัติประจำวัน
        if ($request->Flag == 1) {
          $dataReport = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
            ->where('buyers.Date_Due',$date)
            ->where('buyers.Contract_buyer','not like', '22%')
            ->where('buyers.Contract_buyer','not like', '33%')
            // ->where('cardetails.Approvers_car','<>','')
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

          $type = 1;
        }
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
      elseif($request->type == 2){ //ปรับโครงสร้างหนี้
        $dataReport = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
            ->where('cardetails.Date_Appcar',$date)
            ->where('buyers.Contract_buyer','like', '22%')
            ->where('cardetails.Approvers_car','<>','')
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

        $type = $request->type;
        $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2','type'));
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
      elseif($request->type == 3){ //มาตรการช่วยเหลือ
        $dataReport = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
            ->where('cardetails.Date_Appcar',$date)
            ->where('buyers.Contract_buyer','like', '33%')
            ->where('cardetails.Approvers_car','<>','')
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

        $type = $request->type;
        $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2','type'));
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
      elseif($request->type == 7){ //รายงานส่งผู้บริหาร
        $ids = $request->choose;
        $approvedate = date('Y-m-d');
        $fdate = date('Y-m-d');
        $tdate = date('Y-m-d');

        if ($request->has('Approvedate')) {
          $approvedate = $request->get('Approvedate');
          $approvedate = \Carbon\Carbon::parse($approvedate)->format('Y') ."-". \Carbon\Carbon::parse($approvedate)->format('m')."-". \Carbon\Carbon::parse($approvedate)->format('d');
        }
        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $fdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $tdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }

        $dataReport = DB::table('buyers')
            ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
            ->when(!empty($ids), function($q) use($ids){
              return $q->whereIn('buyers.id', $ids);
              })
            ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                return $q->whereBetween('cardetails.Date_Appcar',[$fdate,$tdate]);
              })
            ->where('cardetails.Approvers_car','<>','')
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

        $type = $request->type;
        $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2','type'));
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
      elseif ($request->type == 8) {  //Excel เช่าซื้อ-รถบ้าน
        $newfdate = '';
        $newtdate = '';

        if ($request->has('Fromdate')){
            $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')){
            $newtdate = $request->get('Todate');
        }

        if ($request->Flag == 1) {
          $data = DB::table('buyers')
            ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->leftJoin('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->leftJoin('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
            ->leftjoin('upload_lat_longs','buyers.id','=','upload_lat_longs.Use_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
            })
            ->where('buyers.Contract_buyer','not like', '22%')
            ->where('buyers.Contract_buyer','not like', '33%')
            ->where('buyers.Contract_buyer','not like', '10%')
            ->where('buyers.Contract_buyer','not like', '11%')
            ->where('cardetails.Approvers_car','!=',NULL)
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

          $status = 'สัญญาสินเชื่อลิสซิ่ง';
          Excel::create('รายการสัญญาสินเชื่อลิสซิ่ง', function ($excel) use($data,$status) {
            $excel->sheet($status, function ($sheet) use($data,$status) {
                $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
                $sheet->prependRow(2, array($status));
                $sheet->cells('A3:AV3', function($cells) {
                  $cells->setBackground('#FFCC00');
                });
                $row = 3;
                $sheet->row($row, array('ลำดับ','ประเภท','เลขที่สัญญา', 'ชื่อ-สกุล','สาขา', 'วันที่โอน', 'สถานะ',
                  'ยี่ห้อ','รุ่น','ปี', 'ทะเบียนเดิม','ทะเบียนใหม่', 'ยอดจัด', 'ค่าดำเนินการ', 'ชำระต่องวด', 'กำไรดอกเบี้ย','ดอกเบี้ย/เดือน','งวดผ่อน(เดือน)',
                  'พรบ.','ยอดปิดบัญชี','ซื้อประกัน', '% ยอดจัด','ค่าใช้จ่ายขนส่ง','อื่นๆ','ค่าประเมิน','ค่าการตลาด','อากร',
                  'รวม คชจ', 'คงเหลือ', 'ค่าคอมก่อนหัก 3%', 'ค่าคอมหลังหัก 3%', 
                  'เลขที่โฉนดผู้ค่ำ', 'ผู้รับเงิน','เลขบัญชี','เบอร์โทรผู้รับเงิน', 'ผู้รับค่าคอม','เลขบัญชี','เบอร์โทรผู้แนะนำ', 
                  'ใบขับขี่','ประกันภัย','สถานะผู้เช่าซื้อ','ตำแหน่งที่อยู่ผู้เช่าซื้อ', 'ตำแหน่งที่อยู่ผู้ค่ำ','รายละเอียดอาชีพ','ผลการประเมินลูกค้า', 'ผลการตรวจสอบลูกค้า','ความพึงพอใจลูกค้า','ผลการตรวจสอบนายหน้า','ความพึงพอใจนายหน้า'));

                foreach ($data as $key => $value) {
                  $sheet->row(++$row, array(
                    $key+1,
                    'NULL',
                    $value->Contract_buyer,
                    $value->Name_buyer.' '.$value->last_buyer,
                    $value->branch_car,
                    $value->Date_Due,
                    $value->status_car,
                    $value->Brand_car,
                    $value->Model_car,
                    $value->Year_car,
                    $value->License_car,
                    $value->Nowlicense_car,
                    number_format($value->Top_car, 2),
                    $value->Vat_car,
                    $value->Pay_car,
                    $value->Tax_car,
                    $value->Interest_car,
                    $value->Timeslacken_car,
                    $value->act_Price,
                    $value->closeAccount_Price,
                    $value->P2_Price,
                    $value->Percent_car,
                    $value->tran_Price,
                    $value->other_Price,
                    $value->evaluetion_Price,
                    $value->marketing_Price,
                    $value->duty_Price,
                    $value->totalk_Price,
                    $value->balance_Price,
                    $value->Commission_car,
                    $value->commit_Price,
                    $value->deednumber_SP,
                    $value->Payee_car,
                    $value->Accountbrance_car,
                    $value->Tellbrance_car,
                    $value->Agent_car,
                    $value->Accountagent_car,
                    $value->Tellagent_car,
                    $value->Driver_buyer,
                    $value->Insurance_car,
                    $value->Gradebuyer_car,
                    $value->Buyer_latlong,
                    $value->Support_latlong,
                    $value->CareerDetail_buyer,
                    $value->ApproveDetail_buyer,
                    $value->Memo_buyer,
                    $value->Prefer_buyer,
                    $value->Memo_broker,
                    $value->Prefer_broker,
                  ));

                }
            });
          })->export('xlsx');

        }elseif ($request->Flag == 2) {
          $data = DB::table('buyers')
            ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->leftJoin('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
            })
            ->where('homecardetails.approvers_HC','!=',Null)
            ->where('buyers.Contract_buyer','not like', '22%')
            ->where('buyers.Contract_buyer','not like', '33%')
            ->orderBy('buyers.Contract_buyer', 'ASC')
            ->get();

          $status = 'สัญญาสินเชื่อรถบ้าน';
          Excel::create('รายการสัญญาสินเชื่อรถบ้าน', function ($excel) use($data,$status) {
            $excel->sheet($status, function ($sheet) use($data,$status) {
                $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
                $sheet->prependRow(2, array($status));
                $sheet->cells('A3:V3', function($cells) {
                  $cells->setBackground('#FFCC00');
                });
                $row = 3;
                $sheet->row($row, array('ลำดับ','เลขที่สัญญา', 'ชื่อ-สกุล','สาขา', 'วันที่โอน', 'สถานะ',
                  'ยี่ห้อ','รุ่น','ปี', 'ทะเบียนเดิม','ทะเบียนใหม่', 'ยอดจัด','งวดผ่อน(เดือน)',
                  'ค่าคอม','นานหน้า','เบอร์โทรนายหน้า', 'ประกันภัย','ราคารถ', 'เงินดาวน์', 'ค่าโอน',
                  'ค่าประกัน', 'พนักงานขาย',));

                foreach ($data as $key => $value) {
                  $sheet->row(++$row, array(
                    $key+1,
                    $value->Contract_buyer,
                    $value->Name_buyer.' '.$value->last_buyer,
                    $value->branchUS_HC,
                    $value->Date_Due,
                    $value->baab_HC,
                    $value->brand_HC,
                    $value->model_HC,
                    $value->year_HC,
                    $value->oldplate_HC,
                    $value->newplate_HC,
                    $value->topprice_HC,
                    $value->period_HC,
                    $value->commit_HC,
                    $value->agent_HC,
                    $value->tel_HC,
                    $value->insurance_HC,
                    $value->price_HC,
                    $value->downpay_HC,
                    $value->transfer_HC,
                    $value->insurancefee_HC,
                    $value->sale_HC,
                  ));
                }
            });
          })->export('xlsx');
        }
      }
    }
}
