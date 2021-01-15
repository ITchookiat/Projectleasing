<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Storage;
use File;
use Carbon\Carbon;
use Exporter;
use Excel;
use Helper;

use App\Legislation;
use App\Legiscourt;
use App\Legiscourtcase;
use App\LegisImage;
use App\Legiscompromise;
use App\legispayment;
use App\legisasset;
use App\legischeat;
use App\Legisexhibit;
use App\Legisland;

class LegislationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->type == 1) {        //Main รายชื่อส่งฟ้อง

        $type = $request->type;
        return view('legislation.PopUp',compact('type'));
      }
      elseif ($request->type == 6) {   //Main ลูกหนี้เตรียมฟ้อง
        $newfdate = '';
        $newtdate = '';
        $FlagStatus = '';

        if ($request->has('Fromdate')){
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')){
          $newtdate = $request->get('Todate');
        }
        if ($request->get('FlagStatus')){
          $FlagStatus = $request->get('FlagStatus');
        }

        $data = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Flag_status','=', '1')
          ->orderBy('legislations.id', 'DESC')
          ->get();
      
        if ($request->has('Fromdate') != false and $request->has('Todate') != false) {
          $data = DB::table('legislations')
            ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
            ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('legislations.Date_legis',[$newfdate,$newtdate]);
            })
            ->when(!empty($FlagStatus), function($q) use($FlagStatus){
              return $q->where('legislations.Flag_status',$FlagStatus);
            })
            ->orderBy('legislations.id', 'DESC')
            ->get();
        }

        $type = $request->type;
        return view('legislation.viewLegis', compact('type', 'data','newfdate','newtdate','FlagStatus'));
      }
      elseif ($request->type == 8) {   //สืบทรัพย์
        $newfdate = '';
        $newtdate = '';
        $SetSelect = '';

        if ($request->has('Fromdate')){
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $newtdate = $request->get('Todate');
        }
        if ($request->has('status')) {
          $SetSelect = $request->get('status');
        }

        if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
          $data = DB::table('legislations')
            ->join('legisassets','legislations.id','=','legisassets.legisAsset_id')
            ->orderBy('legisassets.legisAsset_id', 'ASC')
            ->get();
        }else {
          $data = DB::table('legislations')
            ->join('legisassets','legislations.id','=','legisassets.legisAsset_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('legisassets.Date_asset',[$newfdate,$newtdate]);
            })
            ->when(!empty($SetSelect), function($q) use($SetSelect){
              return $q->where('propertied_asset',$SetSelect);
            })
            ->orderBy('legisassets.legisAsset_id', 'ASC')
            ->get();
        }

        $type = $request->type;
        return view('legislation.viewLegis', compact('type', 'data','newfdate','newtdate','SetSelect'));
      }
      elseif ($request->type == 10) {   //ของกลาง
        $fdate = '';
        $tdate = '';
        $terminateexhibit = '';
        $typeexhibit = '';

        if ($request->has('Fromdate')){
          $fdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
        }
        if ($request->has('TerminateExhibit')){
          $terminateexhibit = $request->get('TerminateExhibit');
        }
        if ($request->has('Typeexhibit')) {
          $typeexhibit = $request->get('Typeexhibit');
        }

        $data = DB::table('legisexhibits')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('Dateaccept_legis',[$fdate,$tdate]);
          })
          ->when(!empty($terminateexhibit), function($q) use($terminateexhibit){
            return $q->where('Terminate_legis',$terminateexhibit);
          })
          ->when(!empty($typeexhibit), function($q) use($typeexhibit){
            return $q->where('Typeexhibit_legis',$typeexhibit);
          })
          ->get();

        $type = $request->type;
        return view('legislation.viewLegis', compact('type','data','fdate','tdate','terminateexhibit','typeexhibit'));
      }
      elseif ($request->type == 12) {   //ขายฝาก
        $dataLand = DB::table('legislands')
                  ->orderBy('ContractNo_legis', 'ASC')
                  ->get();
        $type = $request->type;
        return view('legislation.view', compact('type','dataLand'));
      }
      elseif ($request->type == 20) {   //Main legislation
        //ลูกหนี้เตรียมฟ้อง
        $data1 = DB::table('legislations')
          ->where('legislations.Flag_status','=', '1')
          ->count();

        //ลูกหนี้รอฟ้อง
        $data2 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_status','=', '2')
          ->where('legislations.Flag_Class','=', 'ลูกหนี้รอฟ้อง')
          ->count();

        //ลูกหนี้ชั้นศาล
        $data3 = DB::table('legislations')
        ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legiscourts.fillingdate_court','!=', NULL)
          ->count();

        //ลูกหนี้ชั้นบังคับคดี
        $data4 = DB::table('legislations')
          ->where('legislations.Flag_Class','=', 'สถานะส่งคัดโฉนด')
          ->orwhere('legislations.Flag_Class','=', 'สถานะส่งยึดทรัพย์')
          ->count();

        //ลูกหนี้โกงเจ้าหนี้
        $data5 = DB::table('legislations')
          ->where('legislations.Flag_Class','=', 'สถานะส่งโกงเจ้าหนี้')
          ->count();

        //ลูกหนี้สืบทรัพย์
        $data6 = DB::table('legisassets')
          ->count();

        //ลูกหนี้ปิดจบงาน
        $data7 = DB::table('legislations')
          ->where('legislations.Status_legis','!=', NULL)
          ->count();

        $type = $request->type;
        return view('legislation.view', compact('type','data1','data2','data3','data4','data5','data6','data7'));
      }
      elseif ($request->type == 21) {   //Main ลูกหนี้รอฟ้อง
        $newfdate = '';
        $newtdate = '';

        if ($request->has('Fromdate')){
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')){
          $newtdate = $request->get('Todate');
        }

        $data = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
            return $q->whereBetween('legislations.Datesend_Flag',[$newfdate,$newtdate]);
          })
          ->where('legislations.Flag_status','=', '2')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'ลูกหนี้รอฟ้อง')
          ->orderBy('legislations.id', 'DESC')
          ->get();

        $type = $request->type;
        return view('legislation.viewLegis', compact('type', 'data','newfdate','newtdate'));
      }
      elseif ($request->type == 22) {   //Main ลูกหนี้ชั้นศาล
        //ลูกหนี้ชั้นศาล
        $data = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legiscourts.fillingdate_court','!=', NULL)
          ->count();

        $data1 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งฟ้อง')
          ->get();

        $data2 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งสืบพยาน')
          ->get();

        $data3 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งคำบังคับ')
          ->get();

        $data4 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งตรวจผลหมาย')
          ->get();

        $data5 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งตั้งเจ้าพนักงาน')
          ->get();

        $data6 = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งตรวจผลหมายตั้ง')
          ->get();

        $Count1  = count($data1);
        $Count2  = count($data2);
        $Count3  = count($data3);
        $Count4  = count($data4);
        $Count5  = count($data5);
        $Count6  = count($data6);
        
        $type = $request->type;
        $Flag = $request->Flag;
        return view('legislation.viewLegis', compact('type','Flag','data','data1','data2','data3','data4','data5','data6',
                                                     'Count1','Count2','Count3','Count4','Count5','Count6'));
      }
      elseif ($request->type == 23) {   //Main ลูกหนี้ชั้นบังคับคดี
        $data1 = DB::table('legislations')
          ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งคัดโฉนด')
          ->get();

        $data2 = DB::table('legislations')
          ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legislations.Flag_Class','=', 'สถานะส่งยึดทรัพย์')
          ->get();

        $Count1  = count($data1);
        $Count2  = count($data2);

        $Flag = $request->Flag;
        $type = $request->type;
        return view('legislation.viewLegis', compact('type','Flag','data1','data2','Count1','Count2'));
      }
      elseif ($request->type == 24) {   //Main ลูกหนี้ชั้นโกงเจ้าหนี้
        $data = DB::table('legislations')
          ->leftJoin('legischeats','legislations.id','=','legischeats.legislation_id')
          ->where('legislations.Status_legis','=', NULL)
          ->where('legischeats.DateNotice_cheat','!=', NULL)
          ->get();

        $type = $request->type;
        return view('legislation.viewLegis', compact('type','data'));
      }
      elseif ($request->type == 25) {   //Main ลูกหนี้ปิดจบงาน
        $data = DB::table('legislations')
          ->where('legislations.Status_legis','!=', NULL)
          ->get();

        $type = $request->type;
        return view('legislation.viewLegis', compact('type','data'));
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

    public function SearchData(Request $request, $type)
    {
      if ($type == 1) {
        $DB_type = $request->get('DB_type');
        $Contract = $request->get('Contno');

        if ($DB_type == 1) {       //ลูกหนี้ปกติ
          $data = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
              ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
              ->where('SFHP.ARMAST.CONTNO','=', $Contract)
              ->first();
          
          $dataGT = DB::connection('ibmi')
              ->table('SFHP.VIEW_ARMGAR')
              ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $Contract)
              ->first();

          // query ทรัพย์
          $dataAro = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
              ->where('SFHP.ARMAST.CONTNO','=', $Contract)
              ->first();
          
          if ($dataAro != NULL) {
            $SetRealty = 'มีทรัพย์';
          }else {
            $SetRealty = 'ไม่มีทรัพย์';
          }
        }
        elseif ($DB_type == 2) {   //ลูกหนี้ประนอม
          $data = DB::connection('ibmi')
              ->table('ASFHP.ARMAST')
              ->leftjoin('ASFHP.INVTRAN','ASFHP.ARMAST.CONTNO','=','ASFHP.INVTRAN.CONTNO')
              ->leftjoin('ASFHP.VIEW_CUSTMAIL','ASFHP.ARMAST.CUSCOD','=','ASFHP.VIEW_CUSTMAIL.CUSCOD')
              ->where('ASFHP.ARMAST.CONTNO','=', $Contract)
              ->first();

          // query ทรัพย์
          $dataAro = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
              ->where('SFHP.ARMAST.CONTNO','=', $Contract)
              ->first();
          
          if ($dataAro != NULL) {
            $SetRealty = 'มีทรัพย์';
          }else {
            $SetRealty = 'ไม่มีทรัพย์';
          }
        }

        $datalegis = DB::table('legislations')
                  ->where('legislations.Contract_legis',$Contract)->first();

        if ($data != NULL) {
          $output ='<div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="far fa-id-card fa-lg"></i></span>
  
                            <div class="info-box-content">
                              <h6 style="color: red">'.$data->CONTNO.'</h6>
                              <span class="info-box-number" style="font-size: 17px; color: blue">'.(iconv('TIS-620', 'utf-8', str_replace(" ","",$data->SNAM)))." ".(iconv('TIS-620', 'utf-8', str_replace(" ","",$data->NAME1)))." ".(iconv('TIS-620', 'utf-8', str_replace(" ","",$data->NAME2))).'</span>
                            </div>
  
                            <div class="info-box-content">
                              <div class="card-tools d-inline float-right">
                                <form name="form1" method="get" action="'.action('LegislationController@Savestore').'" enctype="multipart/form-data">
                                  <input type="hidden" name="type" value="'.$DB_type.'"/>
                                  <input type="hidden" name="Contno" value="'.$Contract.'"/>';

                                  if ($datalegis != NULL) {
                            $output.='<button type="button" class="btn btn-block btn-outline-danger">
                                        <i class="fas fa-user-check"></i> ลูกหนี้อยู่ในระบบแล้ว
                                      </button>';
                                  }else {
                            $output.='<button type="submit" class="btn btn-block btn-outline-success">
                                        <i class="fas fa-user-plus"></i> บันทึก
                                      </button>';
                                  }
  
                        $output.='<input type="hidden" name="_method" value="PATCH"/>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>';

            $output.='<div class="row text-sm">
                        <div class="col-6">
                          <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label text-right">วันทำสัญญา: </label>
                            <div class="col-sm-8">';
                      $output.='<input type="text" class="form-control form-control-sm" value="'.date('d-m-Y', strtotime($data->FDATE)).'"readonly>';
                  $output.='</div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-0">
                            <label class="col-sm-3 col-form-label text-right">ค้างงวด : </label>
                            <div class="col-sm-8">';
                      $output.='<input type="text" class="form-control form-control-sm" value="'.$data->HLDNO.'"readonly>';
                  $output.='</div>
                          </div>
                        </div>
                      </div>';

                      $priceCus = $data->BALANC - $data->SMPAY;

            $output.='<div class="row text-sm">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-4 col-form-label text-right">ยอดคงเหลือ: </label>
                          <div class="col-sm-8">';
                    $output.='<input type="text" class="form-control form-control-sm" value="'.number_format($priceCus, 2).'"readonly>';
                $output.='</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                          <div class="col-sm-8">';
                    $output.='<input type="text" class="form-control form-control-sm" value="'.$SetRealty.'"readonly>';
                $output.='</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>';
  
          echo $output;
        }else {
          $output ='<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                      ไม่พบข้อมูล. โปรดตรวจสอบเลขที่สัญญา หรือฐานข้อมูล.
                    </div>';
          echo $output;
        }
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $SetGoldPay = str_replace (",","",$request->get('GoldPayment'));

      if ($request->type == 2) { //สถานะปิดบัญชี (เพื่ออกไปเสร็จ)
        $id = $request->id;
        $SetContract = $request->ContractNo;
        $SetPriceAcc = str_replace(",","", $request->PriceAccount);
        $SetTopCloseAcc = str_replace(",","", $request->TopCloseAccount);
        $SetTDiscountAcc = str_replace(",","", $request->DiscountAccount);

        $user = Legislation::find($id);
          $user->DateStatus_legis = $request->DateCloseAccount;
          $user->PriceStatus_legis = $SetPriceAcc;
          $user->txtStatus_legis = $SetTopCloseAcc;
          $user->Discount_legis = $SetTDiscountAcc;
        $user->update();

        $data = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
              ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
              ->where('SFHP.ARMAST.CONTNO','=', $request->ContractNo)
              ->first();

        $dataDB = DB::table('legislations')
              ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
              ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->where('legislations.id','=', $id)
              ->first();

        $type = 3; //เปลี่ยนเป็นเบอร์ 3 เพื่อสงไปยังหน้าพิมพ์ใบเสร็จ เพราะมี เบอร์ 1,2 อยู่แล้ว
        $view = \View::make('legislation.reportCompro' ,compact('data','user','type','dataDB'));
        $html = $view->render();

        $pdf = new PDF();
        $pdf::SetTitle('ใบเสร็จปิดบัญชี');
        $pdf::AddPage('L', 'A5');
        $pdf::SetMargins(16, 5, 5, 5);
        $pdf::SetFont('freeserif', '', 11, '', true);
        $pdf::SetAutoPageBreak(TRUE, 5);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($request->type == 10){ //เพิ่มข้อของกลาง
        $Dateresult = NULL;
        if($request->get('DategetResult1') != Null){
          $Dateresult = $request->get('DategetResult1');
        }
        if($request->get('DategetResult2') != Null){
          $Dateresult = $request->get('DategetResult2');
        }
        $LegisExhibit = new Legisexhibit([
          'Contract_legis' => $request->get('ContractNo'),
          'Dateaccept_legis' => $request->get('DateExhibit'),
          'Name_legis' =>  $request->get('NameContract'),
          'Policestation_legis' =>  $request->get('PoliceStation'),
          'Suspect_legis' =>  $request->get('NameSuspect'),
          'Plaint_legis' =>  $request->get('PlaintExhibit'),
          'Inquiryofficial_legis' =>  $request->get('InquiryOfficial'),
          'Inquiryofficialtel_legis' =>  $request->get('InquiryOfficialtel'),
          'Terminate_legis' =>  $request->get('TerminateExhibit'),
          'DateLawyersend_legis' =>  $request->get('DateLawyersend'),
          'Typeexhibit_legis' =>  $request->get('TypeExhibit'),
          'Currentstatus_legis' =>  $request->get('Currentstatus'),
          'Nextstatus_legis' =>  $request->get('Nextstatus'),
          'Noteexhibit_legis' =>  $request->get('NoteExhibit'),
          'Dategiveword_legis' =>  $request->get('DateGiveword'),
          'Typegiveword_legis' =>  $request->get('TypeGiveword'),
          'Datepreparedoc_legis' =>  $request->get('DatePreparedoc'),
          'Dateinvestigate_legis' =>  $request->get('DateInvestigate'),
          'Datecheckexhibit_legis' =>  $request->get('DateCheckexhibit'),
          'Datesendword_legis' =>  $request->get('DateSendword'),
          'Resultexhibit1_legis' =>  $request->get('ResultExhibit1'),
          'Processexhibit1_legis' =>  $request->get('ProcessExhibit1'),
          'Datesenddetail_legis' =>  $request->get('DateSenddetail'),
          'Resultexhibit2_legis' =>  $request->get('ResultExhibit2'),
          'Processexhibit1_legis' =>  $request->get('ProcessExhibit2'),
          'Dategetresult_legis' =>  $Dateresult,
        ]);
        $LegisExhibit->save();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
    }

    public function Savestore(Request $request)
    {
      if ($request->Contno != '') {
        $SetStrConn = $request->Contno;
      }
      
      if ($request->type == 1) {       //ลูกหนี้ปกติ
        $data = DB::connection('ibmi')
          ->table('SFHP.ARMAST')
          ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
          ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
          ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
          ->first();

        // query ทรัพย์
        $dataAro = DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
            ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
            ->first();
        
        if ($dataAro != NULL) {
          $SetRealty = 'มีทรัพย์';
        }else {
          $SetRealty = 'ไม่มีทรัพย์';
        }

        $dataGT = DB::connection('ibmi')
            ->table('SFHP.VIEW_ARMGAR')
            ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
            ->first();

        if ($dataGT == Null) {
            $SetGTName = Null;
            $SetGTIDNO = Null;
            $SetGTAddress = Null;
        }else {
            $SetGTName = (iconv('Tis-620','utf-8',$dataGT->NAME));
            $SetGTIDNO = (str_replace(" ","",$dataGT->IDNO));
            $SetGTAddress = (iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->ADDRES))." ต.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->TUMB))." อ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->AUMPDES))." จ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->PROVDES))."  ".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->ZIP)));
        }

        $LegisDB = new Legislation([
          'Date_legis' => date('Y-m-d'),
          'KeyCourts_id' => Null,
          'KeyCompro_id' => Null,
          'Contract_legis' => $data->CONTNO,
          'Name_legis' => (iconv('TIS-620', 'utf-8', str_replace(" ","",$data->SNAM)." ".str_replace(" ","",$data->NAME1)."  ".str_replace(" ","",$data->NAME2))),
          'Idcard_legis' => (str_replace(" ","",$data->IDNO)),
          'Address_legis' => (iconv('TIS-620', 'utf-8', str_replace(" ","",$data->ADDRES))." ต.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data->TUMB))." อ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data->AUMPDES))." จ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data->PROVDES))."  ".iconv('TIS-620', 'utf-8', str_replace(" ","",$data->ZIP))),
          'BrandCar_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->TYPE))),
          'register_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->REGNO))),
          'YearCar_legis' => $data->MANUYR,
          'Category_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->BAAB))),
          'DateDue_legis' => $data->FDATE,
          'Pay_legis' => $data->NCARCST,
          'DateVAT_legis' => $data->DTSTOPV,
          'NameGT_legis' => $SetGTName,
          'IdcardGT_legis' => $SetGTIDNO,
          'AddressGT_legis' => $SetGTAddress,
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
          'Phone_legis' => (iconv('Tis-620','utf-8',$data->TELP)),
          'Flag_status' => '1',  //ลูกหนี้ปกติ
          'UserSend1_legis' => auth()->user()->name,
        ]);
        $LegisDB->save();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 2) {   //ลูกหนี้ประนอมหนี้
        $data = DB::connection('ibmi')
            ->table('ASFHP.ARMAST')
            ->leftjoin('ASFHP.INVTRAN','ASFHP.ARMAST.CONTNO','=','ASFHP.INVTRAN.CONTNO')
            ->leftjoin('ASFHP.VIEW_CUSTMAIL','ASFHP.ARMAST.CUSCOD','=','ASFHP.VIEW_CUSTMAIL.CUSCOD')
            ->where('ASFHP.ARMAST.CONTNO','=', $SetStrConn)
            ->first();

        // query ทรัพย์
        $dataAro = DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
            ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
            ->first();
        
        if ($dataAro != NULL) {
          $SetRealty = 'มีทรัพย์';
        }else {
          $SetRealty = 'ไม่มีทรัพย์';
        }

        $dataGT = DB::connection('ibmi')
            ->table('ASFHP.VIEW_ARMGAR')
            ->where('ASFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
            ->first();

        if ($dataGT == Null) {
            $SetGTName = Null;
            $SetGTIDNO = Null;
        }else {
            $SetGTName = (iconv('Tis-620','utf-8',$dataGT->NAME));
            $SetGTIDNO = (str_replace(" ","",$dataGT->IDNO));
        }

        $LegisDB = new Legislation([
          'Date_legis' => date('Y-m-d'),
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
          'NameGT_legis' => $SetGTName,
          'IdcardGT_legis' => $SetGTIDNO,
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
          'Flag' => 'C',
          'Phone_legis' => (iconv('Tis-620','utf-8',$data->TELP)),
          'Flag_status' => '3',  //ลูกหนี้ประนอม
          'UserSend1_legis' => auth()->user()->name,
        ]);
        $LegisDB->save();

        $LegisPromise = new Legiscompromise([
          'Date_Promise' => date('Y-m-d'),
          'legisPromise_id' => $LegisDB->id,
          'User_Promise' =>  auth()->user()->name,
        ]);
        $LegisPromise->save();

        $Legislation = Legislation::find($LegisDB->id);
          $Legislation->KeyCompro_id = $LegisPromise->legisPromise_id;
        $Legislation->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 3) {  //ลูกหนี้ขายฝาก
        // $SetStrConn = $SetStr1."/".$SetStr2;
        // $data = DB::connection('ibmi')
        //           ->table('LSFHP.ARMAST')
        //           ->join('LSFHP.INVTRAN','LSFHP.ARMAST.CONTNO','=','LSFHP.INVTRAN.CONTNO')
        //           ->join('LSFHP.VIEW_CUSTMAIL','LSFHP.ARMAST.CUSCOD','=','LSFHP.VIEW_CUSTMAIL.CUSCOD')
        //           ->where('LSFHP.ARMAST.CONTNO','=', $SetStrConn)
        //           ->first();
        // $dataGT = DB::connection('ibmi')
        //           ->table('LSFHP.VIEW_ARMGAR')
        //           ->where('LSFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
        //           ->first();

        // if ($dataGT == Null) {
        //   $SetGTName = Null;
        //   $SetGTIDNO = Null;
        // }else {
        //   $SetGTName = (iconv('Tis-620','utf-8',$dataGT->NAME));
        //   $SetGTIDNO = (str_replace(" ","",$dataGT->IDNO));
        // }

        // $LegisLand = new Legisland([
        //   'Date_legis' => $date,
        //   'ContractNo_legis' => $data->CONTNO,
        //   'Name_legis' => (iconv('TIS-620', 'utf-8', str_replace(" ","",$data->SNAM).str_replace(" ","",$data->NAME1)."  ".str_replace(" ","",$data->NAME2))),
        //   'Idcard_legis' => (str_replace(" ","",$data->IDNO)),
        //   'BrandCar_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->TYPE))),
        //   'register_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->REGNO))),
        //   'YearCar_legis' => $data->MANUYR,
        //   'Category_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->BAAB))),
        //   'DateDue_legis' => $data->SDATE,
        //   'Pay_legis' => $data->NCARCST,
        //   'DateVAT_legis' => $data->DTSTOPV,
        //   'NameGT_legis' => $SetGTName,
        //   'IdcardGT_legis' => $SetGTIDNO,
        //   'Realty_legis' => $SetRealty,
        //   'Period_legis' => $data->TOT_UPAY,
        //   'Countperiod_legis' => $data->T_NOPAY,
        //   'Beforeperiod_legis' => $data->EXP_FRM,
        //   'Beforemoney_legis' => $data->SMPAY,
        //   'Sumperiod_legis' => $data->BALANC - $data->SMPAY,
        //   'Remainperiod_legis' => $data->EXP_TO,
        //   'Staleperiod_legis' => $data->EXP_PRD, //ค้าง
        //   'Realperiod_legis' => $data->HLDNO, //ค้างงวดจริง
        //   'StatusContract_legis' => (iconv('Tis-620','utf-8',$data->CONTSTAT)),
        //   'Flag' => 'Y',
        // ]);
        // $LegisLand->save();
        // $tab = 2;
        // $type = 1;
        // return redirect()->Route('legislation', $type)->with(['tab' => $tab , 'success' => '่ส่งดำเนินเรื่องเรียบร้อย']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
      if ($request->type == 1) {    //ส่งทนาย(ลูกหนี้เตรียมฟ้อง)
        $user = Legislation::find($id);
          $user->Flag_status = 2;
          $user->Flag_Class = "ลูกหนี้รอฟ้อง";
          $user->UserSend2_legis = auth()->user()->name;
          $user->Datesend_Flag = date('Y-m-d');
        $user->update();

        $Legiscourt = new Legiscourt([
          'legislation_id' => $id,
        ]);
        $Legiscourt->save();

        $Legiscourtcase = new Legiscourtcase([
          'legislation_id' => $id,
        ]);
        $Legiscourtcase->save();

        return redirect()->back()->with('success','ส่งให้ทนายเรียบร้อย');
      }
      elseif ($request->type == 11) {  //ลูกหนี้ของกลาง
        $type = $request->type;
        return view('legislation.createexhibit',compact('type'));
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
      if ($request->type == 2) {     //ลูกหนี้(หน้าข้อมูลลูกหนี้)
        $data = DB::table('legislations')
          ->where('legislations.id',$id)->first();

        $StrCon = explode("/",$data->Contract_legis);
        $SetStr1 = $StrCon[0];
        $SetStr2 = $StrCon[1];
        $SetStrConn = $SetStr1."/".$SetStr2;
        $contractNo = str_replace("/","",$data->Contract_legis);

        if ($data->Flag == "C") {
          $data1 = DB::connection('ibmi')
                ->table('ASFHP.ARMAST')
                ->join('ASFHP.INVTRAN','ASFHP.ARMAST.CONTNO','=','ASFHP.INVTRAN.CONTNO')
                ->join('ASFHP.VIEW_CUSTMAIL','ASFHP.ARMAST.CUSCOD','=','ASFHP.VIEW_CUSTMAIL.CUSCOD')
                ->where('ASFHP.ARMAST.CONTNO','=', $SetStrConn)
                ->first();

          $dataGT = DB::connection('ibmi')
                ->table('SFHP.VIEW_ARMGAR')
                ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
                ->first();

        }else {
          $data1 = DB::connection('ibmi')
                ->table('SFHP.ARMAST')
                ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
                ->first();

          $dataGT = DB::connection('ibmi')
                ->table('SFHP.VIEW_ARMGAR')
                ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
                ->first();
        }

        $dataImages = DB::table('legisimages')
          ->where('legisimages.legisImage_id',$id)
          ->where('legisimages.type_image',2)
          ->orderBy('legisimages.image_id', 'ASC')
          ->get();

        $countDataImages = count($dataImages);
        if($request->preview == 1){
          $dataFile = DB::table('legisimages')
            ->where('legisimages.image_id',$request->file_id)
            ->where('legisimages.type_image',2)
            ->orderBy('legisimages.image_id', 'ASC')
            ->first();

          $contractNo = str_replace("/","",$data->Contract_legis);
          return view('legislation.preview',compact('dataFile','contractNo'));
        }

        $type = $request->type;
        return view('legislation.edit',compact('data','data1','dataGT','id','type','dataImages','countDataImages'));
      }
      elseif ($request->type == 3){  //ชั้นศาล(หน้าลูกหนี้ชั้นศาล)
        $data = DB::table('legislations')
                  ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->where('legiscourts.legislation_id',$id)->first();

        $type = $request->type;
        return view('legislation.court',compact('data','id','type'));
      }
      elseif ($request->type == 6) { //ลูกหนี้เตรียมฟ้อง
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

        $type = $request->type;
        return view('legislation.editAnalyze',compact('data','data1','id','type'));
      }
      elseif ($request->type == 7) { //ชั้นบังคับคดี(หน้าลูกหนี้ชั้นบังคับคดี)
        $data = DB::table('legislations')
          ->leftJoin('legiscourtcases','legislations.id','=','legiscourtcases.legislation_id')
          ->where('legiscourtcases.legislation_id',$id)->first();

        $dataImages = DB::table('legisimages')
          ->where('legisimages.legisImage_id',$id)
          ->where('legisimages.type_image',3)
          ->orderBy('legisimages.image_id', 'ASC')
          ->get();

        $countDataImages = count($dataImages);
        if($request->preview == 2){
          $dataFile = DB::table('legisimages')
            ->where('legisimages.image_id',$request->file_id)
            ->where('legisimages.type_image',3)
            ->orderBy('legisimages.image_id', 'ASC')
            ->first();
          $contractNo = str_replace("/","",$data->Contract_legis);

          return view('legislation.preview',compact('dataFile','contractNo'));
        }

        $type = $request->type;
        return view('legislation.courtcase',compact('data','id','type','dataImages','countDataImages'));
      }
      elseif ($request->type == 8) { //ชั้นสืบทรัพย์
        $data = DB::table('legislations')
          ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
          ->where('legislations.id', $id)
          ->first();

        $type = $request->type;
        return view('legislation.asset',compact('data','id','type'));
      }
      elseif ($request->type == 10){ //ของกลาง
        $data = DB::table('legisexhibits')
                  ->where('Legisexhibit_id', $id)
                  ->first();
        $data1 = DB::connection('ibmi')
              ->table('SFHP.ARMAST')
              ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
              ->where('SFHP.ARMAST.CONTNO','=', $data->Contract_legis)
              ->first();

        $type = $request->type;
        return view('legislation.editmore',compact('data','data1','id','type'));
      }
      elseif ($request->type == 11){ //รูปและแผนที
        $data = DB::table('legislations')
                  ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->where('legiscourts.legislation_id',$id)->first();

        $dataImages = DB::table('legisimages')
                    ->where('legisimages.legisImage_id',$id)
                    ->where('legisimages.type_image',1)
                    ->get();

        $SumImage = count($dataImages);
        if($SumImage > 0){
          $column = 100/$SumImage - 0.8;
        }else{
          $column = 0;
        }

        $lat = $data->latitude_court;
        $long = $data->longitude_court;

        // dd($data);

        // foreach ($datalatlong as $key => $value) {
        //   $lat = $value->latitude_court;
        //   $long = $value->longitude_court;
        // }


        return view('legislation.info',compact('data','id','type','dataImages','SumImage','column','lat','long'));
      }
      elseif ($request->type == 12){ //ขายฝาก
        $data = DB::table('legislands')
                  ->where('Legisland_id', $id)
                  ->first();
        $StrCon = explode("/",$data->ContractNo_legis);
        $SetStr1 = $StrCon[0];
        $SetStr2 = $StrCon[1];
        $SetStrConn = $SetStr1."/".$SetStr2;
        $data1 = DB::connection('ibmi')
                  ->table('LSFHP.ARMAST')
                  ->join('LSFHP.INVTRAN','LSFHP.ARMAST.CONTNO','=','LSFHP.INVTRAN.CONTNO')
                  ->join('LSFHP.VIEW_CUSTMAIL','LSFHP.ARMAST.CUSCOD','=','LSFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->where('LSFHP.ARMAST.CONTNO','=', $SetStrConn)
                  ->first();
        return view('legislation.editmore',compact('data','data1','id','type'));
      }
      elseif ($request->type == 13) { //ชั้นโกงเจ้าหนี้(หน้าลูกหนี้ชั้นโกงเจ้าหนี้)
        $data = DB::table('legislations')
          ->leftJoin('legischeats','legislations.id','=','legischeats.legislation_id')
          ->where('legislations.id',$id)
          ->first();

        $type = $request->type;
        return view('legislation.cheat',compact('data','id','type'));
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
      // dd($request);
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;

      if ($request->type == 2) {     //ลูกหนี้(หน้าข้อมูลลูกหนี้)
        $user = Legislation::find($id);
          // เพิ่มสถานะจบงาน
          if ($request->get('Statuslegis') != Null) {
            $user->Status_legis = $request->get('Statuslegis');
            $user->UserStatus_legis = auth()->user()->name;
            $user->DateUpState_legis = $request->get('DateStatuslegis');

            //ปิดบัญชี
            $user->DateStatus_legis = $request->get('DateCloseAccount');
            $user->PriceStatus_legis = $request->get('PriceAccount');
            $user->txtStatus_legis = $request->get('TopCloseAccount');
            $user->Discount_legis = $request->get('DiscountAccount');
          }
          elseif ($request->get('Statuslegis') == Null) {
            $user->Status_legis = NULL;
            $user->UserStatus_legis = NULL;
            $user->DateUpState_legis = NULL;

            $user->DateStatus_legis = NULL;
            $user->PriceStatus_legis = NULL;
            $user->txtStatus_legis = NULL;
            $user->Discount_legis = NULL;
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
          $user->Note = $request->get('Legisnote');
          $user->Address_legis = $request->get('Adreeslegis');
          $user->AddressGT_legis = $request->get('AdreesGTlegis');
          $user->Phone_legis = $request->get('Phonelegis');
        $user->update();

        if ($request->hasFile('filePDF')) {
          $image_array = $request->file('filePDF');
          $contractNo = str_replace("/","",$request->contract);

            $image_size = $image_array->getClientSize();
            $image_lastname = $image_array->getClientOriginalExtension();
            // $image_new_name = str_replace("/","",$user->Contract_legis). '.' .$image_array->getClientOriginalExtension();
            $image_new_name = $image_array->getClientOriginalName();

            $destination_path = public_path().'/legislation/'.$contractNo;
            $image_array->move($destination_path,$image_new_name);

            $Uploaddb = new LegisImage([
              'legisImage_id' => $id,
              'name_image' => $image_new_name,
              'size_image' => $image_size,
              'type_image' => '2',
            ]);
            $Uploaddb ->save();
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 3) { //ชั้นศาล(หน้าลูกหนี้ชั้นศาล)
        $user = Legislation::find($id); //update status
          if ($request->get('Statuslegis') != Null) {
            $user->Status_legis = $request->get('Statuslegis');
            $user->UserStatus_legis = auth()->user()->name;
            $user->DateUpState_legis = $request->get('DateStatuslegis');

            //ปิดบัญชี
            $user->DateStatus_legis = $request->get('DateCloseAccount');
            $user->PriceStatus_legis = $request->get('PriceAccount');
            $user->txtStatus_legis = $request->get('TopCloseAccount');
            $user->Discount_legis = $request->get('DiscountAccount');
          }
          elseif ($request->get('Statuslegis') == Null) {
            $user->Status_legis = NULL;
            $user->UserStatus_legis = NULL;
            $user->DateUpState_legis = NULL;

            $user->DateStatus_legis = NULL;
            $user->PriceStatus_legis = NULL;
            $user->txtStatus_legis = NULL;
            $user->Discount_legis = NULL;
          }
        $user->update();

        $Setcapitalcourt = str_replace (",","",$request->get('capitalcourt'));
        $Setindictmentcourt = str_replace (",","",$request->get('indictmentcourt'));
        $Setpricelawyercourt = str_replace (",","",$request->get('pricelawyercourt'));

        $Legiscourt = Legiscourt::where('legislation_id',$id)->first();
          $Legiscourt->fillingdate_court = $request->get('fillingdatecourt');
          $Legiscourt->law_court = $request->get('lawcourt');
          $Legiscourt->bnumber_court = $request->get('bnumbercourt');
          $Legiscourt->rnumber_court = $request->get('rnumbercourt');
          $Legiscourt->capital_court = $Setcapitalcourt;
          $Legiscourt->indictment_court = $Setindictmentcourt;
          $Legiscourt->pricelawyer_court = $Setpricelawyercourt;
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

          if ($Legiscourt->DateComplete_court == NULL) {
            if ($request->get('fillingdatecourt') != NULL) {
              $Legiscourt->DateComplete_court = date('Y-m-d');
              $Legiscourt->User_court = auth()->user()->name;
            }
          }
        $Legiscourt->update();

        if ($request->get('FlagClass') == NULL) {
          if ($request->get('fillingdatecourt') != NULL) {
            $SetFlagClass = 'สถานะส่งฟ้อง';
          }else {
            $SetFlagClass = 'ลูกหนี้รอฟ้อง';
          }
        }else {
          $SetFlagClass = $request->get('FlagClass');
        }

        // update key ลูก
        $Legislation = Legislation::find($id);
          $Legislation->KeyCourts_id = $Legiscourt->court_id;
          $Legislation->Flag_Class = $SetFlagClass;
        $Legislation->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 6) { //บันทึกข้อมูล(เตรียมฟ้อง)
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
          $user->Phone_legis = $request->get('Phonelegis');
        $user->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 7) { //ชั้นบังคับคดี(มีการบันทึกโกงเจ้าหนี้อยู่ด้วย)
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

        if ($request->get('StatusCase') == "ถอนบังคับคดีปิดบัญชี") {
          if ($request->get('txtStatusCase1') != Null) {
            $SettxtStatus = $request->get('txtStatusCase1');
            $SetDateStatus = $request->get('DateStatusCase1');
          }
        }elseif ($request->get('StatusCase') == "ถอนบังคับคดียึดรถ") {
          if ($request->get('txtStatusCase2') != Null) {
            $SettxtStatus = $request->get('txtStatusCase2');
            $SetDateStatus = $request->get('DateStatusCase2');
          }
        }elseif ($request->get('StatusCase') == "ถอนบังคับคดียอดเหลือน้อย") {
          if ( $request->get('txtStatusCase3') != Null) {
            $SettxtStatus = $request->get('txtStatusCase3');
            $SetDateStatus = $request->get('DateStatusCase3');
          }
        }elseif ($request->get('StatusCase') == "ถอนบังคับคดีขายเต็มจำนวน") {
          $SettxtStatus = NULL;
          $SetDateStatus = $request->get('Datesoldout');
        }elseif ($request->get('StatusCase') == "ประนอมหลังยึดทรัพย์") {
          $SettxtStatus = NULL;
          $SetDateStatus = date('Y-m-d');
        }else {
          $SettxtStatus = $request->get('StatusCase');
          $SetDateStatus = $request->get('DateStatuslegis');
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
          $Legiscourtcase->NumAmount_case = $request->get('CountSeliing');
          $Legiscourtcase->Status_case = $request->get('StatusCase');
          $Legiscourtcase->DateStatus_case = $SetDateStatus;
          $Legiscourtcase->txtStatus_case = $SettxtStatus;
          $Legiscourtcase->Flag_case = $request->get('Flagcase');
        $Legiscourtcase->update();

        $Flag_Class = $request->get('FlagClass');
        if ($request->get('Flagcase') != NULL) {  //กรณีมีเลือก โกงเจ้าหนี้ ให้สร้างรายการใน DB
          $LegisCheat = legischeat::where('legislation_id',$id)->first();
          if ($LegisCheat == NULL) {
            $LegisCheat = new legischeat([
              'legislation_id' => $id,
              'DateNotice_cheat' => date ("Y-m-d", strtotime("+60 days", strtotime($request->get('datepreparedoc')))),
              'Dateindictment_cheat' => NULL,
              'DateExamine_cheat' => NULL,
              'Datedeposition_cheat' => NULL,
              'Dateplantiff_cheat' => NULL,
              'Status_cheat' => auth()->user()->name,
              'DateStatus_cheat' => date ("Y-m-d"),
              'note_cheat' => NULL,
            ]);
            $LegisCheat->save();
          }
          $Flag_Class = 'สถานะส่งโกงเจ้าหนี้';
        }

        $user = Legislation::find($id); //update status
          if ($request->get('StatusCase') != Null) {
            $user->Status_legis = $request->get('StatusCase');
            $user->UserStatus_legis = auth()->user()->name;
            $user->DateUpState_legis = $SetDateStatus;

            $user->DateStatus_legis = $request->get('DateCloseAccount');
            $user->PriceStatus_legis = $request->get('PriceAccount');
            $user->txtStatus_legis = $request->get('TopCloseAccount');
            $user->Discount_legis = $request->get('DiscountAccount');
          }
          elseif ($request->get('StatusCase') == Null) {
            $user->Status_legis = NULL;
            $user->UserStatus_legis = NULL;
            $user->DateUpState_legis = NULL;
          }
          $user->Flag_Class = $Flag_Class;
        $user->update();

        if ($request->hasFile('filePDF')) {
          $image_array = $request->file('filePDF');
          $contractNo = str_replace("/","",$request->contract);

            $image_size = $image_array->getClientSize();
            $image_lastname = $image_array->getClientOriginalExtension();
            // $image_new_name = str_replace("/","",$user->Contract_legis). '.' .$image_array->getClientOriginalExtension();
            $image_new_name = $image_array->getClientOriginalName();

            $destination_path = public_path().'/legislation/'.$contractNo;
            $image_array->move($destination_path,$image_new_name);

            $Uploaddb = new LegisImage([
              'legisImage_id' => $id,
              'name_image' => $image_new_name,
              'size_image' => $image_size,
              'type_image' => '3',
            ]);
            $Uploaddb ->save();
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 8) { //สืบทรัพย์
        $data = DB::table('legisassets')
                  ->where('legisassets.legisAsset_id', $id)->first();

        $SetPriceasset = str_replace (",","",$request->get('Priceasset'));

        if ($data == Null) {
            $LegisAsset = new legisasset([
              'legisAsset_id' => $id,
              'Date_asset' => $request->get('Dateasset'),
              'Status_asset' => $request->get('statusasset'),
              'Price_asset' => $SetPriceasset,
              'propertied_asset' => $request->get('radio_propertied'),
              'sequester_asset' =>  $request->get('sequesterasset'),
              'sendsequester_asset' => $request->get('sendsequesterasset'),
              'Dateresult_asset' => Null,
              'NewpursueDate_asset' => $request->get('NewpursueDateasset'),
              'Notepursue_asset' =>  $request->get('Notepursueasset'),
              'User_asset' =>  auth()->user()->name,
            ]);
            $LegisAsset->save();
        }else {
          if ($request->get('sendsequesterasset') == "สืบทรัพย์เจอ" or $request->get('sendsequesterasset') == "หมดอายุความคดี" or $request->get('sendsequesterasset') == "จบงานสืบทรัพย์") {
            $Dateresult = date('Y-m-d');
          }else {
            $Dateresult = Null;
            if ($request->get('radio_propertied') == "Y") {
              $Dateresult = date('Y-m-d');
            }else {
              $Dateresult = Null;
            }
          }

          $LegisAsset = legisasset::where('legisAsset_id',$id)->first();
            $LegisAsset->Date_asset = $request->get('Dateasset');
            $LegisAsset->Status_asset = $request->get('statusasset');
            $LegisAsset->Price_asset = $SetPriceasset;
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
      elseif ($request->type == 10){ //ของกลาง
          $Dateresult = NULL;
          if($request->get('TypeExhibit') == 'ของกลาง'){
            $Dateresult = $request->get('DategetResult1');
          }
          if($request->get('TypeExhibit') == 'ยึดตามมาตราการ(ปปส.)'){
            $Dateresult = $request->get('DategetResult2');
          }
          $LegisExhibit = Legisexhibit::where('Legisexhibit_id',$id)->first();
            $LegisExhibit->Contract_legis = $request->get('ContractNo');
            $LegisExhibit->Dateaccept_legis = $request->get('DateExhibit');
            $LegisExhibit->Name_legis =  $request->get('NameContract');
            $LegisExhibit->Policestation_legis =  $request->get('PoliceStation');
            $LegisExhibit->Suspect_legis =  $request->get('NameSuspect');
            $LegisExhibit->Plaint_legis =  $request->get('PlaintExhibit');
            $LegisExhibit->Inquiryofficial_legis =  $request->get('InquiryOfficial');
            $LegisExhibit->Inquiryofficialtel_legis =  $request->get('InquiryOfficialtel');
            $LegisExhibit->Terminate_legis =  $request->get('TerminateExhibit');
            $LegisExhibit->DateLawyersend_legis =  $request->get('DateLawyersend');
            $LegisExhibit->Typeexhibit_legis =  $request->get('TypeExhibit');
            $LegisExhibit->Currentstatus_legis =  $request->get('Currentstatus');
            $LegisExhibit->Nextstatus_legis =  $request->get('Nextstatus');
            $LegisExhibit->Noteexhibit_legis =  $request->get('NoteExhibit');
            $LegisExhibit->Dategiveword_legis =  $request->get('DateGiveword');
            $LegisExhibit->Typegiveword_legis =  $request->get('TypeGiveword');
            $LegisExhibit->Datepreparedoc_legis =  $request->get('DatePreparedoc');
            $LegisExhibit->Dateinvestigate_legis =  $request->get('DateInvestigate');
            $LegisExhibit->Datecheckexhibit_legis =  $request->get('DateCheckexhibit');
            $LegisExhibit->Datesendword_legis =  $request->get('DateSendword');
            $LegisExhibit->Resultexhibit1_legis =  $request->get('ResultExhibit1');
            $LegisExhibit->Processexhibit1_legis =  $request->get('ProcessExhibit1');
            $LegisExhibit->Datesenddetail_legis =  $request->get('DateSenddetail');
            $LegisExhibit->Resultexhibit2_legis =  $request->get('ResultExhibit2');
            $LegisExhibit->Processexhibit2_legis =  $request->get('ProcessExhibit2');
            $LegisExhibit->Dategetresult_legis =  $Dateresult;
          $LegisExhibit->update();

          return redirect()->back()->with('success','อัพเดทข้อมูลเรียบร้อย');
      }
      elseif ($request->type == 11) { //รูปและแผนที่
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
              'type_image' => '1',
            ]);
            // dd($Uploaddb);
            $Uploaddb ->save();
          }
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 13) { //โกงเจ้าหนี้
        $LegisCheat = legischeat::where('legislation_id',$id)->first();
          $LegisCheat->DateNotice_cheat = $request->get('DateNoticeCheat');
          $LegisCheat->Dateindictment_cheat = $request->get('DateindictmentCheat');
          $LegisCheat->DateExamine_cheat = $request->get('DateExamineCheat');
          $LegisCheat->Datedeposition_cheat = $request->get('DatedepositionCheat');
          $LegisCheat->Dateplantiff_cheat = $request->get('DateplantiffCheat');
          $LegisCheat->Status_cheat = $request->get('StatusCheat');
          $LegisCheat->DateStatus_Cheat = $request->get('DateStatusCheat');
          $LegisCheat->note_cheat = $request->get('noteCheat');
        $LegisCheat->update();

        $user = Legislation::find($id); //update status
          if ($request->get('StatusCheat') != Null) {
            $user->Status_legis = $request->get('StatusCheat');
            $user->UserStatus_legis = auth()->user()->name;
            $user->DateUpState_legis = $request->get('DateStatusCheat');

            $user->DateStatus_legis = $request->get('DateCloseAccount');
            $user->PriceStatus_legis = $request->get('PriceAccount');
            $user->txtStatus_legis = $request->get('TopCloseAccount');
            $user->Discount_legis = $request->get('DiscountAccount');
          }
          elseif ($request->get('StatusCheat') == Null) {
            $user->Status_legis = NULL;
            $user->UserStatus_legis = NULL;
            $user->DateUpState_legis = NULL;
          }
        $user->update();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
      elseif ($request->type == 12) {  //ขายฝาก
        $LegisLand = Legisland::where('Legisland_id',$id)->first();
          $LegisLand->Beforemoney_legis = str_replace(",","",$request->get('Beforemoneylegis'));
          $LegisLand->Sumperiod_legis = str_replace(",","",$request->get('Sumperiodlegis'));
          $LegisLand->Realperiod_legis =  $request->get('Realperiodlegis');
          $LegisLand->Datenotice_legis =  $request->get('DateNotice');
          $LegisLand->Dategetnotice_legis =  $request->get('DateGetNotice');
          $LegisLand->Datepetition_legis =  $request->get('DatePetition');
          $LegisLand->Dateinvestigate_legis =  $request->get('DateInvestigate');
          $LegisLand->Dateadjudicate_legis =  $request->get('DateAdjudicate');
          $LegisLand->Dateeviction_legis =  $request->get('DateEviction');
          $LegisLand->Datepost_legis =  $request->get('DatePost');
          $LegisLand->Datecheckasset_legis =  $request->get('DateCheckAsset');
          $LegisLand->Resultcheck_legis =  $request->get('ResultCheck');
          $LegisLand->Datearrest_legis =  $request->get('DateArrest');
          $LegisLand->Datestaffarrest_legis =  $request->get('DateStaffArrest');
          $LegisLand->Noteland_legis =  $request->get('NoteLand');
          $LegisLand->Statusland_legis =  $request->get('Statuslandlegis');
          $LegisLand->Datestatusland_legis =  $request->get('DateStatuslandlegis');
        $LegisLand->update();

        return redirect()->back()->with('success','อัพเดทข้อมูลเรียบร้อย');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
      if ($request->type == 1) { //ลบทั้งหมด หน้าเตรียมฟ้อง
        $item = Legislation::find($id);
        $item2 = Legiscourt::where('legislation_id',$id);
        $item3 = Legiscompromise::where('legisPromise_id',$id);
        $item4 = legispayment::where('legis_Com_Payment_id',$id);
        $item5 = legisasset::where('legisAsset_id',$id);
        $item6 = Legiscourtcase::where('legislation_id',$id);

        $item->Delete();
        $item2->Delete();
        $item3->Delete();
        $item4->Delete();
        $item5->Delete();
        $item6->Delete();
      }
      elseif ($request->type == 3) { //ลบตาราง ของกลาง Exhibit
        $item = Legisexhibit::where('Legisexhibit_id',$id);
        $item->Delete();
      }
      elseif ($request->type == 4) { //ลบตาราง ขายฝาก Legisland
        $item = Legisland::where('legisland_id',$id);
        $item->Delete();
      }
      elseif ($request->type == 5) { //ลบไฟล์อัพโหลดเอกสาร
        $contractNo = str_replace("/","",$request->contract);
        $item1 = LegisImage::where('image_id','=', $request->file_id)->first();
        $itemPath = public_path().'/Legislation/'.$contractNo.'/'.$item1->name_image;
        // dd($itemPath);
        File::delete($itemPath);
        $item1->Delete();
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

    public function ReportReceipt(Request $request, $id, $type)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y') + 543;
      $Y2 = date('Y');
      $m = date('m');
      $d = date('d');
      $time = date('H:i');
      $date = $Y2.'-'.$m.'-'.$d;
      $date2 = $Y.'-'.$m.'-'.$d;

      if ($type == 2) { //ใบเสร็จรับชำระค่างวด
        $dataDB = DB::table('legislations')
                ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                ->leftJoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
                ->where('legispayments.Payment_id','=', $id)
                ->orderBy('legispayments.Payment_id', 'ASC')
                ->first();


        // if ($dataDB->Flag == "C") {
        //   $data = DB::connection('ibmi')
        //     ->table('ASFHP.ARMAST')
        //     ->join('ASFHP.INVTRAN','ASFHP.ARMAST.CONTNO','=','ASFHP.INVTRAN.CONTNO')
        //     ->join('ASFHP.VIEW_CUSTMAIL','ASFHP.ARMAST.CUSCOD','=','ASFHP.VIEW_CUSTMAIL.CUSCOD')
        //     ->where('ASFHP.ARMAST.CONTNO','=', $dataDB->Contract_legis)
        //     ->first();
        // }else {
        //   $data = DB::connection('ibmi')
        //     ->table('SFHP.ARMAST')
        //     ->leftJoin('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
        //     ->leftJoin('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
        //     ->where('SFHP.ARMAST.CONTNO','=', $dataDB->Contract_legis)
        //     ->first();
        // }

        $pdf = new PDF();
        $pdf::SetTitle('ใบเสร็จรับชำระค่างวด');
        $pdf::AddPage('L', 'A5');
        $pdf::SetMargins(16, 5, 5, 5);
        $pdf::SetFont('freeserif', '', 11, '', true);
        $pdf::SetAutoPageBreak(TRUE, 5);

        $view = \View::make('legislation.reportCompro' ,compact('data','dataPay','dataDB','type','dataCount','status','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 16) { //รายงานลูกหนี้ประนอม
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
                  return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
                })
                ->when(!empty($status), function($q) use($lastday){
                    return $q->where('legispayments.Date_Payment','<',$lastday);
                 })
                ->get();
        }
        elseif($status == "ปิดบัญชี"){
          $data = DB::table('legislations')
            ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
            ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
            ->where('Legiscompromises.Status_Promise','!=', NULL)
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
            })
            ->where('legispayments.Flag_Payment', '=', 'Y')
            ->orderBy('legislations.Contract_legis', 'ASC')
            ->get();
        }else {
          $data = DB::table('legislations')
            ->leftjoin('legispayments','legislations.id','=','legispayments.legis_Com_Payment_id')
            ->leftjoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('Legiscompromises.Date_Promise',[$newfdate,$newtdate]);
            })
            ->where('Legiscompromises.Date_Promise','!=', null)
            ->where('legispayments.Flag_Payment', '=', 'Y')
            ->orderBy('legislations.Contract_legis', 'ASC')
            ->get();
        }

        $pdf = new PDF();
        $pdf::SetTitle('รายงานลูกหนี้ประนอมหนี้');
        $pdf::AddPage('L', 'A4');
        $pdf::SetFont('thsarabunpsk', '', 12, '', true);
        $pdf::SetAutoPageBreak(TRUE, 20);

        $view = \View::make('legislation.reportCompro' ,compact('data','dataPay','dataDB','type','status','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 10){ //รายงานลูกหนี้ของกลาง
        $fdate = '';
        $tdate = '';
        $terminateexhibit = '';
        $typeexhibit = '';
        if ($request->has('Fromdate')){
          $fdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
        }
        if ($request->has('TerminateExhibit')){
          $terminateexhibit = $request->get('TerminateExhibit');
        }
        if ($request->has('Typeexhibit')) {
          $typeexhibit = $request->get('Typeexhibit');
        }
        $data = DB::table('legisexhibits')
                  ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                    return $q->whereBetween('Dateaccept_legis',[$fdate,$tdate]);
                  })
                  ->when(!empty($terminateexhibit), function($q) use($terminateexhibit){
                    return $q->where('Terminate_legis',$terminateexhibit);
                  })
                  ->when(!empty($typeexhibit), function($q) use($typeexhibit){
                    return $q->where('Typeexhibit_legis',$typeexhibit);
                  })
                  ->get();
        $pdf = new PDF();
        $pdf::SetTitle('รายงานลูกหนี้ของกลาง');
        $pdf::AddPage('L', 'A4');
        $pdf::SetMargins(5, 5, 5, 5);
        $pdf::SetFont('thsarabunpsk', '', 14, '', true);
        $pdf::SetAutoPageBreak(TRUE, 5);

        $view = \View::make('legislation.reportCompro' ,compact('data','type','dataCount','status','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 17) { //รายงานลูกหนี้
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

        if($status == "ลูกหนี้ฟ้อง"){
          $data = DB::table('legislations')
                ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
                ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('legiscourts.fillingdate_court',[$newfdate,$newtdate]);
                })
                ->where('legislations.KeyCourts_id','!=', NULL)
                ->where('legislations.Status_legis','=', NULL)
                ->where('legislations.Flag_status','=', '2')
                ->orderBy('legiscourts.fillingdate_court', 'ASC')
                ->get();

        }elseif ($status == "ลูกหนี้รอฟ้อง") {
          $data = DB::table('legislations')
                ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
                ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('legislations.Datesend_Flag',[$newfdate,$newtdate]);
                })
                ->where('legiscourts.fillingdate_court','=', NULL)
                ->where('legislations.KeyCourts_id','=', NULL)
                ->where('legislations.Status_legis','=', NULL)
                ->where('legislations.Flag_status','=', '2')
                ->orderBy('legislations.id', 'DESC')
                ->get();

        }elseif ($status == "ลูกหนี้ปิดจบงาน"){
          $data = DB::table('legislations')
                ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
                ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('legislations.DateUpState_legis',[$newfdate,$newtdate]);
                })
                ->where('legislations.Status_legis','!=', NULL)
                ->where('legislations.Flag_status','=', '2')
                ->orderBy('legislations.id', 'DESC')
                ->get();

        }else {
          $data = DB::table('legislations')
                ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
                ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
                ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
                ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('legiscourts.Datesend_Flag',[$newfdate,$newtdate]);
                })
                ->where('legislations.Flag_status','=', '2')
                ->orderBy('legislations.id', 'DESC')
                ->get();

                $status = 'ลูกหนี้รวม';
        }

        if ($newfdate != NULL) {
          $Fdate = date('d-m-Y', strtotime($newfdate));
          $Tdate = date('d-m-Y', strtotime($newtdate));
        }else {
          $Fdate = "";
          $Tdate = "";
        }

        Excel::create('รายงานลูกหนี้', function ($excel) use($data,$status,$date,$Fdate,$Tdate) {
          $excel->sheet($status, function ($sheet) use($data,$status,$date,$Fdate,$Tdate) {
              $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
              $sheet->prependRow(2, array("จากวันที่  ".$Fdate,"ถึงวันที่  ".$Tdate));
              $sheet->cells('A3:P3', function($cells) {
                $cells->setBackground('#FFCC00');
              });
              $row = 3;
              $sheet->row($row, array('เลขที่สัญญา','ชื่อ-นามสกุล','ยอดคงเหลือ','ยอดตั้งฟ้อง','ค่าฟ้อง','เบอร์โทร','ผู้ส่งฟ้อง','วันถืองาน','วันที่ฟ้อง','ระยะเวลา','สถานะลูกหนี้','สถานะทรัพย์','สถานะประนอมหนี้','วันที่ปิดงาน','ยอดชำระ','หมายเหตุ'));
              $Summperiod = 0;    //รวมยอดคงเหลือ
              $SumAmount = 0;
              $SumTextStatus = 0; //ยอดปิดบัญชี
              $SumIndictment = 0; //รวมค่าฟ้อง

              foreach ($data as $value) {
                $SumCourt = ($value->capital_court + $value->indictment_court + $value->pricelawyer_court);
                $Summperiod += $value->Sumperiod_legis;
                $SumAmount += $SumCourt;
                $SumTextStatus += $value->txtStatus_legis + ($value->Total_Promise - $value->Sum_Promise);
                $SumIndictment += $value->indictment_court;

                if ($value->txtStatus_legis != NULL) {
                  $TextStatus = $value->txtStatus_legis;
                }else {
                  $TextStatus = $value->Total_Promise - $value->Sum_Promise;
                }

                //สถานะลูกหนี้
                if ($value->Status_legis != NULL) {
                  $SetText = $value->Status_legis;
                }
                else {
                  $SetText = 'รอฟ้อง';
                  $Newdate = date_create($date);

                  // วันที่สืบพยาน
                  if ($value->examiday_court != Null) {
                    $Tab1 = date_create($value->examiday_court);
                    $DateEx = date_diff($Newdate,$Tab1);
                    // วันที่ส่งจริง/ส่งคำบังคับ
                    if($value->fuzzy_court != Null){
                      $Tab1 = date_create($value->fuzzy_court);
                      $DateEx = date_diff($Newdate,$Tab1);
                    }
                    // วันที่ตรวจผลหมายจริง
                    if ($value->ordersend_court != Null) {
                      $Tab2 = date_create($value->ordersend_court);
                      $DateEx2 = date_diff($Newdate,$Tab2);
                    }elseif ($value->ordersend_court == Null) {
                      $Tab2 = date_create($value->orderday_court);
                      $DateEx2 = date_diff($Newdate,$Tab2);
                    }
                    // วันที่ตรวจผลหมาย
                    if ($value->checkday_court != Null) {
                      $Tab3 = date_create($value->checkday_court);
                      $DateEx3 = date_diff($Newdate,$Tab3);
                    }
                    // วันที่ตั้งเจ้าพนักงาน
                    if ($value->sendoffice_court != Null) {
                      $Tab4 = date_create($value->sendoffice_court);
                      $DateEx4 = date_diff($Newdate,$Tab4);
                    }elseif ($value->sendoffice_court == Null) {
                      $Tab4 = date_create($value->setoffice_court);
                      $DateEx4 = date_diff($Newdate,$Tab4);
                    }
                    // วันที่ตรวจผลหมายตั้ง
                    if ($value->sendcheckresults_court != Null) {
                      $Tab5 = date_create($value->sendcheckresults_court);
                      $DateEx5 = date_diff($Newdate,$Tab5);
                    }elseif ($value->sendcheckresults_court == Null) {
                      $Tab5 = date_create($value->checkresults_court);
                      $DateEx5 = date_diff($Newdate,$Tab5);
                    }
                    // เตรียมเอกสาร/ชั้นบังคับคดี
                    if ($value->datepreparedoc_case != Null) {
                      $Tab6 = date_create($value->datepreparedoc_case);
                      $DateEx6 = date_diff($Newdate,$Tab6);
                    }else {
                      $Tab6 = date_create("0000-00-00");
                      $DateEx6 = date_diff($Newdate,$Tab6);
                    }
                    // ยึดทรัพย์/ชั้นบังคับคดี
                    if ($value->datesetsequester_case != Null) {
                      $Tab7 = date_create($value->datesetsequester_case);
                      $DateEx7 = date_diff($Newdate,$Tab7);
                    }else {
                      $Tab7 = date_create("0000-00-00");
                      $DateEx7 = date_diff($Newdate,$Tab7);
                    }
                    // วันที่แจ้งความ/โกงเจ้าหนี้
                    if ($value->DateNotice_cheat != Null) {
                      $Tab8 = date_create($value->DateNotice_cheat);
                      $DateEx8 = date_diff($Newdate,$Tab8);
                    }else {
                      $Tab8 = date_create("0000-00-00");
                      $DateEx8 = date_diff($Newdate,$Tab8);
                    }

                    if($Newdate <= $Tab1){
                      if($DateEx->days <= 7){
                        $SetText = 'สืบพยาน';
                      }else {
                        $SetText = 'รอสืบพยาน';
                      }
                    }
                    elseif($Newdate <= $Tab2){
                      if($DateEx2->days <= 7){
                        $SetText = 'ส่งคำบังคับ';
                      }else {
                        $SetText = 'รอส่งคำบังคับ';
                      }
                    }
                    elseif($Newdate <= $Tab3){
                      if($DateEx3->days <= 7){
                        $SetText = 'ตรวจผลหมาย';
                      }else {
                        $SetText = 'รอตรวจผลหมาย';
                      }
                    }
                    elseif($Newdate <= $Tab4){
                      if($value->checksend_court != Null){
                        if($DateEx4->days <= 7){
                          $SetText = 'ตั้งเจ้าพนักงาน';
                        }else {
                          $SetText = 'รอตั้งเจ้าพนักงาน';
                        }
                      }else {
                        $SetText = 'รอผลตรวจหมายจริง';
                      }
                    }
                    elseif($Newdate <= $Tab5){
                      if($DateEx5->days <= 7){
                        $SetText = 'ตรวจผลหมายตั้ง';
                      }else {
                        $SetText = 'รอตรวจผลหมายตั้ง';
                      }
                    }
                    else{
                      if($Newdate <= $Tab6){    // เตรียมเอกสาร/ชั้นบังคับคดี
                        if($DateEx6->days <= 7){
                          $SetText = 'คัดโฉนด';
                        }else {
                          $SetText = 'รอคัดโฉนด';
                        }
                      }
                      elseif($Newdate <= $Tab7){  // ยึดทรัพย์/ชั้นบังคับคดี
                        if($DateEx7->days <= 7){
                          $SetText = 'ตั้งเรื่องยึดทรัพย์';
                        }else {
                          $SetText = 'รอตั้งเรื่องยึดทรัพย์';
                        }
                      }
                      elseif($value->resultsequester_case != Null){ // ประกาศขาย/ชั้นบังคับคดี
                        if($value->resultsequester_case == "ขายไม่ได้"){
                          $SetText = 'บังคับคดี/ขายไม่ได้';
                        }else {
                          if($value->resultsell_case == "เต็มจำนวน"){
                            $SetText = 'ขายได้/เต็มจำนวน';
                          }
                          elseif($value->resultsell_case == "ไม่เต็มจำนวน"){
                            $SetText = 'ขายได้/ไม่เต็มจำนวน';
                          }
                          else {
                            $SetText = 'รอผลจากการขาย';
                          }
                        }
                      }
                      elseif($Newdate <= $Tab8){  // โกงเจ้าหนี้
                        if($DateEx8->days <= 7){
                          $SetText = 'โกงเจ้าหนี้';
                        }else {
                          $SetText = 'โกงเจ้าหนี้';
                        }
                      }
                      else {
                        $SetText = 'รอขั้นตอนต่อไป';
                      }
                    }
                  }
                  else {
                    if($value->fillingdate_court == Null){
                      $SetText = "รอฟ้อง";
                    }
                    elseif($value->fillingdate_court != Null){
                      $SetText = "ฟ้อง";
                    }
                  }
                }
                //สถานะสืบทรัพย์
                if ($value->propertied_asset == "Y") {
                  $SetTextAsset = "มีทรัพย์";
                }elseif ($value->propertied_asset == "N") {
                  $SetTextAsset = "ไม่มีทรัพย์";
                }else {
                  $SetTextAsset = "ไม่มีข้อมูล";
                }
                //สถานะประนอมหนี้
                if ($value->Status_Promise != NULL) {
                  $SetTextCompro = $value->Status_Promise;
                }else {
                  if ($value->Date_Promise != NULL) {
                    $SetTextCompro = "ประนอมหนี้";
                  }else {
                    $SetTextCompro = "ไม่มีข้อมูล";
                  }
                }

                if ($value->DateUpState_legis != NULL) {
                  $SetDatelegis = Helper::formatDateThai($value->DateUpState_legis);

                  // $SetDatelegis = date('d-m-Y', strtotime($value->DateUpState_legis));
                }else {
                  $SetDatelegis = "";
                }

                //เพิ่ม 2 ฟิวด์
                if($value->fillingdate_court != Null){
                  $SetDatefillingdate = Helper::formatDateThai($value->fillingdate_court);
                }
                else{
                  $SetDatefillingdate = '';
                }
                $date = date('Y-m-d');
                //ระยะเวลางานข
                if($value->Status_legis != Null){
                  $Cldate = date_create($value->DateComplete_court);
                  $nowCldate = date_create($value->DateUpState_legis);
                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                  $duration = $ClDateDiff->format("%a วัน");
                }
                else{
                  $Cldate = date_create($value->fillingdate_court);
                  $nowCldate = date_create($date);
                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                  $duration = $ClDateDiff->format("%a วัน");
                }
                ///วันถืองาน
                if($value->DateComplete_court != Null){
                  $Cldate = date_create($value->Datesend_Flag);
                  $nowCldate = date_create($value->DateComplete_court);
                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                  $date_carry = $ClDateDiff->format("%a วัน");
                }
                elseif($value->DateUpState_legis != Null){
                  $Cldate = date_create($value->Datesend_Flag);
                  $nowCldate = date_create($value->DateUpState_legis);
                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                  $date_carry = $ClDateDiff->format("%a วัน");
                }
                elseif($value->DateComplete_court == Null){
                  $Cldate = date_create($value->Datesend_Flag);
                  $nowCldate = date_create($date);
                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                  $date_carry = $ClDateDiff->format("%a วัน");
                }

                $sheet->row(++$row, array(
                  $value->Contract_legis,
                  $value->Name_legis,
                  number_format($value->Sumperiod_legis, 2),
                  number_format($SumCourt, 2),
                  number_format($value->indictment_court, 2),
                  $value->Phone_legis,
                  $value->User_court,
                  $date_carry,
                  $SetDatefillingdate,
                  $duration,
                  $SetText,
                  $SetTextAsset,
                  $SetTextCompro,
                  $SetDatelegis,
                  number_format($TextStatus, 2),
                  $value->Note
                ));

              }
              $sheet->appendRow(function($rows) {
                $rows->setBackground('#FFCC00');
              });
              $sheet->appendRow(array('รวมทั้งหมด','',number_format($Summperiod,2).'  บาท',number_format($SumAmount,2).'  บาท',number_format($SumIndictment,2).'  บาท','','','','','','','','','',number_format($SumTextStatus,2).'  บาท'));
          });
        })->export('xlsx');

      }
      elseif ($type == 18) {  //รายงานลูกหนี้สืบพยาน
        $newfdate = '';
        $newtdate = '';

        if ($request->has('Fromdate')) {
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $newtdate = $request->get('Todate');
        }

        $data = DB::table('legislations')
              ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('legiscourts.examiday_court',[$newfdate,$newtdate]);
              })
              ->orderBy('legiscourts.examiday_court', 'ASC')
              ->get();

        $pdf = new PDF();
        $pdf::SetTitle('รายงานลูกหนี้สิบพยาน');
        $pdf::AddPage('P', 'A4');
        $pdf::SetMargins(5, 5, 5, 5);
        $pdf::SetFont('freeserif', '', 8, '', true);

        $view = \View::make('legislation.reportLegis' ,compact('data','type','newfdate','newtdate'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 19) {  //รายงานลูกหนี้สืบทรัพย์
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
              ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
              ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
              ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
              ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('legisassets.Date_asset',[$newfdate,$newtdate]);
              })
              ->when(!empty($status), function($q) use($status){
                return $q->where('legisassets.propertied_asset',$status);
              })
              ->orderBy('legislations.id', 'DESC')
              ->get();

        foreach ($data as $value) {
          //สถานะลูกหนี้
          if ($value->Status_legis != NULL) {
            $SetText = $value->Status_legis;
          }
          else {
            $SetText = 'รอฟ้อง';
            $Newdate = date_create($date);

            // วันที่สืบพยาน
            if ($value->examiday_court != Null) {
              $Tab1 = date_create($value->examiday_court);
              $DateEx = date_diff($Newdate,$Tab1);
              // วันที่ส่งจริง/ส่งคำบังคับ
              if($value->fuzzy_court != Null){
                $Tab1 = date_create($value->fuzzy_court);
                $DateEx = date_diff($Newdate,$Tab1);
              }
              // วันที่ตรวจผลหมายจริง
              if ($value->ordersend_court != Null) {
                $Tab2 = date_create($value->ordersend_court);
                $DateEx2 = date_diff($Newdate,$Tab2);
              }elseif ($value->ordersend_court == Null) {
                $Tab2 = date_create($value->orderday_court);
                $DateEx2 = date_diff($Newdate,$Tab2);
              }
              // วันที่ตรวจผลหมาย
              if ($value->checkday_court != Null) {
                $Tab3 = date_create($value->checkday_court);
                $DateEx3 = date_diff($Newdate,$Tab3);
              }
              // วันที่ตั้งเจ้าพนักงาน
              if ($value->sendoffice_court != Null) {
                $Tab4 = date_create($value->sendoffice_court);
                $DateEx4 = date_diff($Newdate,$Tab4);
              }elseif ($value->sendoffice_court == Null) {
                $Tab4 = date_create($value->setoffice_court);
                $DateEx4 = date_diff($Newdate,$Tab4);
              }
              // วันที่ตรวจผลหมายตั้ง
              if ($value->sendcheckresults_court != Null) {
                $Tab5 = date_create($value->sendcheckresults_court);
                $DateEx5 = date_diff($Newdate,$Tab5);
              }elseif ($value->sendcheckresults_court == Null) {
                $Tab5 = date_create($value->checkresults_court);
                $DateEx5 = date_diff($Newdate,$Tab5);
              }
              // เตรียมเอกสาร/ชั้นบังคับคดี
              if ($value->datepreparedoc_case != Null) {
                $Tab6 = date_create($value->datepreparedoc_case);
                $DateEx6 = date_diff($Newdate,$Tab6);
              }else {
                $Tab6 = date_create("0000-00-00");
                $DateEx6 = date_diff($Newdate,$Tab6);
              }
              // ยึดทรัพย์/ชั้นบังคับคดี
              if ($value->datesetsequester_case != Null) {
                $Tab7 = date_create($value->datesetsequester_case);
                $DateEx7 = date_diff($Newdate,$Tab7);
              }else {
                $Tab7 = date_create("0000-00-00");
                $DateEx7 = date_diff($Newdate,$Tab7);
              }
              // วันที่แจ้งความ/โกงเจ้าหนี้
              if ($value->DateNotice_cheat != Null) {
                $Tab8 = date_create($value->DateNotice_cheat);
                $DateEx8 = date_diff($Newdate,$Tab8);
              }else {
                $Tab8 = date_create("0000-00-00");
                $DateEx8 = date_diff($Newdate,$Tab8);
              }

              if($Newdate <= $Tab1){
                if($DateEx->days <= 7){
                  $SetText = 'สืบพยาน';
                }else {
                  $SetText = 'รอสืบพยาน';
                }
              }
              elseif($Newdate <= $Tab2){
                if($DateEx2->days <= 7){
                  $SetText = 'ส่งคำบังคับ';
                }else {
                  $SetText = 'รอส่งคำบังคับ';
                }
              }
              elseif($Newdate <= $Tab3){
                if($DateEx3->days <= 7){
                  $SetText = 'ตรวจผลหมาย';
                }else {
                  $SetText = 'รอตรวจผลหมาย';
                }
              }
              elseif($Newdate <= $Tab4){
                if($value->checksend_court != Null){
                  if($DateEx4->days <= 7){
                    $SetText = 'ตั้งเจ้าพนักงาน';
                  }else {
                    $SetText = 'รอตั้งเจ้าพนักงาน';
                  }
                }else {
                  $SetText = 'รอผลตรวจหมายจริง';
                }
              }
              elseif($Newdate <= $Tab5){
                if($DateEx5->days <= 7){
                  $SetText = 'ตรวจผลหมายตั้ง';
                }else {
                  $SetText = 'รอตรวจผลหมายตั้ง';
                }
              }
              else{
                if($Newdate <= $Tab6){    // เตรียมเอกสาร/ชั้นบังคับคดี
                  if($DateEx6->days <= 7){
                    $SetText = 'คัดโฉนด';
                  }else {
                    $SetText = 'รอคัดโฉนด';
                  }
                }
                elseif($Newdate <= $Tab7){  // ยึดทรัพย์/ชั้นบังคับคดี
                  if($DateEx7->days <= 7){
                    $SetText = 'ตั้งเรื่องยึดทรัพย์';
                  }else {
                    $SetText = 'รอตั้งเรื่องยึดทรัพย์';
                  }
                }
                elseif($value->resultsequester_case != Null){ // ประกาศขาย/ชั้นบังคับคดี
                  if($value->resultsequester_case == "ขายไม่ได้"){
                    $SetText = 'บังคับคดี/ขายไม่ได้';
                  }else {
                    if($value->resultsell_case == "เต็มจำนวน"){
                      $SetText = 'ขายได้/เต็มจำนวน';
                    }
                    elseif($value->resultsell_case == "ไม่เต็มจำนวน"){
                      $SetText = 'ขายได้/ไม่เต็มจำนวน';
                    }
                    else {
                      $SetText = 'รอผลจากการขาย';
                    }
                  }
                }
                elseif($Newdate <= $Tab8){  // โกงเจ้าหนี้
                  if($DateEx8->days <= 7){
                    $SetText = 'โกงเจ้าหนี้';
                  }else {
                    $SetText = 'โกงเจ้าหนี้';
                  }
                }
                else {
                  $SetText = 'รอขั้นตอนต่อไป';
                }
              }
            }
            else {
              if($value->fillingdate_court == Null){
                $SetText = "รอฟ้อง";
              }
              elseif($value->fillingdate_court != Null){
                $SetText = "ฟ้อง";
              }
            }
          }

          $SetaArry[] = ['id_status' => $value->id, 'txt_status' => $SetText];
        }
        
        $pdf = new PDF();
        $pdf::SetTitle('รายงานลูกหนี้สิบทรัพย์');
        $pdf::AddPage('L', 'A4');
        $pdf::SetMargins(5, 5, 5, 5);
        // $pdf::SetFont('freeserif', '', 8, '', true);
        $pdf::SetFont('thsarabunpsk', '', 10, '', true);

        $view = \View::make('legislation.reportAsset' ,compact('data','type','newfdate','newtdate','status','SetaArry'));
        $html = $view->render();
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($type == 20) {  //Main ลูกหนี้ฟ้องทั้งหมด
        $data = DB::table('legislations')
          ->leftJoin('legiscourts','legislations.id','=','legiscourts.legislation_id')
          ->leftJoin('Legiscourtcases','legislations.id','=','Legiscourtcases.legislation_id')
          ->leftJoin('Legiscompromises','legislations.id','=','Legiscompromises.legisPromise_id')
          ->leftJoin('legisassets','legislations.id','=','legisassets.legisAsset_id')
          ->where('legislations.Flag_status','=', '2')
          ->get();

        $status = 'ลูกหนี้ฟ้องทั้งหมด';
        Excel::create('รายงานติดตามลูกหนี้ฟ้องทั้งหมด', function ($excel) use($data,$status) {
          $excel->sheet($status, function ($sheet) use($data,$status) {
              $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
              $sheet->prependRow(2, array($status));
              $sheet->cells('A3:P3', function($cells) {
                $cells->setBackground('#FFCC00');
              });
              $row = 3;
              $sheet->row($row, array('ลำดับ', 'เลขที่สัญญา', 'ชื่อ-สกุล', 'เบอร์ติดต่อ',
                  'ผู้ส่งฟ้อง', 'วันที่ฟ้อง', 'ยอดคงเหลือ', 'ยอดตั้งฟ้อง', 'ยอดค่าฟ้อง',
                  'วันสืบพยาน', 'วันส่งคำบังคับ', 'วันตรวจผลหมาย', 'วันตั้งเจ้าพนักงาน', 'วันตรวจผลหมายตั้ง',
                  'สถานะลูกหนี้', 'วันที่สืบทรัพย์', 'สถานะทรัพย์', 'สถานะประนอมหนี้', 'หมายเหตุ'));

              foreach ($data as $key => $value) {

                //วันสืบพยาน
                if ($value->fuzzy_court != NULL) {
                  $Setexamiday = $value->fuzzy_court;
                }else {
                  $Setexamiday = $value->examiday_court;
                }

                //วันส่งคำบังคับ
                if ($value->ordersend_court != NULL) {
                  $Setordersend = $value->ordersend_court;
                }else {
                  $Setordersend = $value->orderday_court;
                }

                //วันตรวจผลหมาย
                if ($value->checksend_court != NULL) {
                  $Setchecksend = $value->checksend_court;
                }else {
                  $Setchecksend = $value->checkday_court;
                }
                
                //วันตั้งเจ้าพนักงาน
                if ($value->sendoffice_court != NULL) {
                  $Setsendoffice = $value->sendoffice_court;
                }else {
                  $Setsendoffice = $value->setoffice_court;
                }

                //วันตรวจผลหมายตั้ง
                if ($value->sendcheckresults_court != NULL) {
                  $Setsendcheckresults = $value->sendcheckresults_court;
                }else {
                  $Setsendcheckresults = $value->checkresults_court;
                }

                //สถานะลูกหนี้
                if ($value->Status_legis != NULL) {
                  $SetStatus = $value->Status_legis;
                }else {
                  if ($value->Flag_Class != NULL) {
                    $SetStatus = $value->Flag_Class;
                  }
                }

                //สถานะสืบทรัพย์
                if ($value->propertied_asset == "Y") {
                  $SetTextAsset = "มีทรัพย์";
                }elseif ($value->propertied_asset == "N") {
                  $SetTextAsset = "ไม่มีทรัพย์";
                }else {
                  $SetTextAsset = "ไม่มีข้อมูล";
                }

                //สถานะประนอมหนี้
                if ($value->Status_Promise != NULL) {
                  $SetTextCompro = $value->Status_Promise;
                }else {
                  if ($value->Date_Promise != NULL) {
                    $SetTextCompro = "ประนอมหนี้";
                  }else {
                    $SetTextCompro = "ไม่มีข้อมูล";
                  }
                }

                $sheet->row(++$row, array(
                  $key+1,
                  $value->Contract_legis,
                  $value->Name_legis,
                  $value->Phone_legis,
                  $value->User_court,
                  $value->fillingdate_court,
                  number_format($value->Sumperiod_legis, 2),
                  number_format($value->capital_court + $value->indictment_court + $value->pricelawyer_court, 2),
                  number_format($value->indictment_court, 2),
                  $Setexamiday,
                  $Setordersend,
                  $Setchecksend,
                  $Setsendoffice,
                  $Setsendcheckresults,
                  $SetStatus,
                  $value->Date_asset,
                  $SetTextAsset,
                  $SetTextCompro,
                  $value->Note,
                ));
              }
          });
        })->export('xlsx');
      }
    }
}
