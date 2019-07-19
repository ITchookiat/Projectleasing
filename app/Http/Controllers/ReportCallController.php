<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Recordcall;
use Carbon\Carbon;

class ReportCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        //
        // dd($type);
        date_default_timezone_set('Asia/Bangkok');
        $today = date('Y-m-d');
        $date = date('Y-m-d', strtotime('-1 days'));

        $data_today = DB::table('recordcalls')
        ->select('CONTNO')
        ->where('date_record', '=', $date)
        ->orderBy('CONTNO', 'ASC')
        ->get();
        // dd($data_today);
        $sum_data_today = count($data_today);

        $data_0210 = DB::table('recordcalls')
                    ->where('CONTNO', 'not like', '01-%')
                    ->where('CONTNO', 'not like', '03-%')
                    ->where('CONTNO', 'not like', '04-%')
                    ->where('CONTNO', 'not like', '05-%')
                    ->where('CONTNO', 'not like', '06-%')
                    ->where('CONTNO', 'not like', '07-%')
                    ->where('date_record', '=', $date)
                    ->get();

        $flag1 = true;              $count1 = [];
        $flag2 = false;             $count2 = [];
        $flag3 = false;             $count3 = [];
        $flag4 = false;             $count4 = [];
        $flag5 = false;             $count5 = [];
        $flag6 = false;             $count6 = [];
        $flag7 = false;             $count7 = [];
        $flag8 = false;             $count8 = [];
        $flag9 = false;             $count9 = [];
        $flag10 = false;            $count10 = [];
        $flag11 = false;            $count11 = [];
        $flag12 = false;            $count12 = [];
        $flag13 = false;            $count13 = [];
        $flag14 = false;            $count14 = [];
        $flag15 = false;            $count15 = [];
        $flag16 = false;            $count16 = [];

        foreach ($data_0210 as $key => $value) {
        // code...
        if($flag1 == true){
        $count1[] = $data_0210[$key];
        $flag1 = false;
        $flag2 = true;

        } elseif($flag2 == true){
        $count2[] = $data_0210[$key];
        $flag2 = false;
        $flag3 = true;

        } elseif($flag3 == true){
        $count3[] = $data_0210[$key];
        $flag3 = false;
        $flag4 = true;

        }elseif($flag4 == true){
        $count4[] = $data_0210[$key];
        $flag4 = false;
        $flag5 = true;
        // dump($count4);
        }elseif($flag5 == true){
        $count5[] = $data_0210[$key];
        $flag5 = false;
        $flag6 = true;
        // dump($count5);
        }elseif($flag6 == true){
        $count6[] = $data_0210[$key];
        $flag6 = false;
        $flag7 = true;
        // dump($count6);
        }elseif($flag7 == true){
        $count7[] = $data_0210[$key];
        $flag7 = false;
        $flag8 = true;
        // dump($count6);
        }elseif($flag8 == true){
        $count8[] = $data_0210[$key];
        $flag8 = false;
        $flag9 = true;
        // dump($count6);
        }elseif($flag9 == true){
        $count9[] = $data_0210[$key];
        $flag9 = false;
        $flag10 = true;
        // dump($count6);
        }elseif($flag10 == true){
        $count10[] = $data_0210[$key];
        $flag10 = false;
        $flag11 = true;
        // dump($count6);
        }elseif($flag11 == true){
        $count11[] = $data_0210[$key];
        $flag11 = false;
        $flag12 = true;
        // dump($count6);
        }elseif($flag12 == true){
        $count12[] = $data_0210[$key];
        $flag12 = false;
        $flag13 = true;
        // dump($count6);
        }elseif($flag13 == true){
        $count13[] = $data_0210[$key];
        $flag13 = false;
        $flag14 = true;
        // dump($count6);
        }elseif($flag14 == true){
        $count14[] = $data_0210[$key];
        $flag14 = false;
        $flag15 = true;
        // dump($count6);
        }elseif($flag15 == true){
        $count15[] = $data_0210[$key];
        $flag15 = false;
        $flag16 = true;
        // dump($count6);
        }elseif($flag16 == true){
        $count16[] = $data_0210[$key];
        $flag16 = false;
        $flag1 = true;
        // dump($count6);
        }
        }

        // dd($count1,$count2,$count3,$count4,$count5,$count6,$count7,$count8,$count9,$count10,$count11,$count12,$count13,$count14,$count15,$count16);

        $pattani = collect([$count1,$count10])->collapse();
        $yala = collect([$count2,$count5])->collapse();
        $nara = collect([$count11,$count16,$count8])->collapse();
        $saiburi = collect([$count4,$count13,$count7])->collapse();
        $kolok = collect([$count3,$count9,$count15])->collapse();
        $betong = collect([$count12,$count14,$count6])->collapse();

        if ($request->type == 1){
          $data_all = DB::table('recordcalls')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_all = count($data_all);
        }

        if ($request->type == 2){
          $data_pt = DB::table('recordcalls')
          ->where('CONTNO', 'like', '01-%')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_pt = count($data_pt);

        }

        if ($request->type == 3){
          $data_yl = DB::table('recordcalls')
          ->where('CONTNO', 'like', '03-%')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_yl = count($data_yl);

        }

        if ($request->type == 4){
          $data_nr = DB::table('recordcalls')
          ->where('CONTNO', 'like', '04-%')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_nr = count($data_nr);

        }

        if ($request->type == 5){
          $data_sb = DB::table('recordcalls')
          ->where('CONTNO', 'like', '05-%')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_sb = count($data_sb);

        }

        if ($request->type == 6){
          $data_kl = DB::table('recordcalls')
          ->where('CONTNO', 'like', '06-%')
          ->where('date_record', '=', $date)
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_kl = count($data_kl);

        }

        if ($request->type == 7){
          $data_bt = DB::table('recordcalls')
          ->where('CONTNO', 'like', '07-%')
          ->orderBy('CONTNO', 'ASC')
          ->get();
          $sum_data_bt = count($data_bt);

        }

        $ReportType = $request->type;

        $view = \View::make('call.reportAll', compact('ReportType', 'data_all','data_pt', 'data_yl', 'data_nr','data_sb', 'data_kl', 'data_bt',
         'pattani', 'yala', 'nara', 'saiburi', 'kolok', 'betong'));
        $html = $view->render();

        $pdf = new PDF();
       if ($request->type == 1) {
          $pdf::SetTitle('รายงานงานโทรทุกสาขา');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 2) {
          $pdf::SetTitle('รายงานงานโทรสาขาปัตตานี');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 3) {
          $pdf::SetTitle('รายงานงานโทรสาขายะลา');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 4) {
          $pdf::SetTitle('รายงานงานโทรสาขานราธิวาส');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 5) {
          $pdf::SetTitle('รายงานงานโทรสาขาสายบุรี');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 6) {
          $pdf::SetTitle('รายงานงานโทรสาขาสุไงโก-ลก');
          $pdf::AddPage('P', 'A4');
        }elseif ($request->type == 7) {
          $pdf::SetTitle('รายงานงานโทรสาขาสุไงเบตง');
          $pdf::AddPage('P', 'A4');
        }

        // $pdf::AddPage('P', 'A4');
                // set margins
        $pdf::SetMargins(5, 5, 6);

        $pdf::SetFont('freeserif', 8);
        $pdf::SetAutoPageBreak(TRUE, 18.5);

        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::lastPage();
        $pdf::Output('reportcall.pdf');

    }

    public function store(Request $request)
    {
      // dd($request);
      if($request->get('date') == ''){
      $date = date('Y-m-d', strtotime('-1 days'));
      }else{
      $date = $request->get('date');
      }
      // dd($date);

      $SetContno = $request->get('contno');
      $SetName = $request->get('name');
      $SetFdate = $request->get('fdate');
      $SetTel = $request->get('tel');
      $SetExpamt = $request->get('exp_amt');
      $SetExpfrm = $request->get('exp_frm');
      $SetExpto = $request->get('exp_to');
      $SetPrd = $request->get('exp_prd');
      $SetHldno = $request->get('hldno');
      $array_len = count($SetContno);

      for($i=0; $i<$array_len; $i++){

          $Contno = $SetContno[$i];
          $Name = $SetName[$i];
          $Fdate = $SetFdate[$i];
          $Tel = $SetTel[$i];
          $AMT = $SetExpamt[$i];
          $FRM = $SetExpfrm[$i];
          $To = $SetExpto[$i];
          $PRD = $SetPrd[$i];
          $Hldno = $SetHldno[$i];
          $recordcalldb = new Recordcall([
            'CONTNO' => $Contno,
            'name' => $Name,
            'fdate' => $Fdate,
            'tel' => $Tel,
            'exp_amt' => $AMT,
            'exp_frm' => $FRM,
            'exp_to' => $To,
            'exp_prd' => $PRD,
            'HLDNO' => $Hldno,
            'date_record' => $date,
          ]);
          $recordcalldb->save();
      }
      // dd($recordcalldb);
      $type = 1;
      return redirect()->Route('call', $type)->with('success','บันทึกข้อมูลเรียบร้อย');

      }

      //dhfdj
      public function update(Request $request, $type)
      {

        $SetContno = $request->get('contno');
        $SetLhldo = $request->get('l_hldno');
        $SetPaid = $request->get('paid');
        $array_len = count($SetContno);

        // dd($SetContno, $SetLhldo, $SetPaid);

        for($i=0; $i<$array_len; $i++){

            $Contno = $SetContno[$i];
            $l_hldno = $SetLhldo[$i];
            $Paid = $SetPaid[$i];

            $update = DB::table('recordcalls')
                    ->whereIn('CONTNO', [$Contno])
                    ->update(['l_hldno' => $l_hldno]);

            $update1 = DB::table('recordcalls')
                    ->whereIn('CONTNO', [$Contno])
                    ->update(['pay_status' => $Paid]);

          }

        return redirect()->Route('call', $type)->with('success','อัพเดทข้อมูลเรียบร้อย');

        }


}
