<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exporter;

class ExcelController extends Controller
{

    function excel(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $today = date('Y-m-d');

      if($request->type == 1){
          $data = DB::table('recordcalls')
          ->whereBetween('date_record',[$today,$today])
          // ->where('group', '=', '01')
          ->get()
          ->toArray();
          $data_array[] = array('งานโทรค้าง 1 งวด รวมทุกสาขา');
          $data_array[] = array('ลำดับ', 'เลขที่สัญญา', 'ชื่อลูกค้า', 'วันดิว งวดแรก', 'เบอร์โทร', 'ค้างชำระ', 'หมายเหตุ');
          foreach($data as $key => $call)
          {
          $date = date_create($call->fdate);
          $fdate = date_format($date, 'd-m-Y');

          $data_array[] = array(
          'ลำดับ' => $key+1,
          'เลขที่สัญญา' => $call->contno,
          'ชื่อลูกค้า' => $call->name,
          'วันดิว งวดแรก' => $fdate,
          'เบอร์โทร' => $call->tel,
          'ค้างชำระ' => $call->exp_amt,
          'หมายเหตุ' => ''
          );
          }
          $data_array = collect($data_array);
          // dd($data_array);
          $excel = Exporter::make('Excel');
          $excel->load($data_array);
          return $excel->stream('calldaily.xlsx');
      }
      
      if($request->type == 2){
      dd('ส่วนปัตตานี');
      }
      if($request->type == 3){
      dd('ส่วนยะลา');
      }
      if($request->type == 4){
      dd('ส่วนนราธิวาส');
      }
      if($request->type == 5){
      dd('ส่วนสายบุรี');
      }
      if($request->type == 6){
      dd('ส่วนสุไหงโก-ลก');
      }
      if($request->type == 7){
      dd('ส่วนเบตง');
      }
      if($request->type == 11){
      $newfdate = $request->newfdate;
      $newtdate = $request->newtdate;
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $Y2 = date('Y') +543;
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;
      $date2 = $d.'-'.$m.'-'.$Y2;

        $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y')-543 ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
        $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y')-543 ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');

      $data = DB::table('buyers')
      ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
      ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
      ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
      ->where('cardetails.Approvers_car','!=',Null)
      ->whereBetween('buyers.Date_Due', [$newfdate,$newtdate])
      ->orderBy('buyers.Contract_buyer', 'ASC')
      ->get()
      ->toArray();
      // dd($data);
      $data_array[] = array('ลำดับ', 'วันที่โอน', 'สถานะ', 'ยี่ห้อ');
      foreach($data as $key => $row)
      {
      $date = date_create($row->Date_Due);
      $Date_Due = date_format($date, 'd-m-Y');

      $data_array[] = array(
       'ลำดับ' => $key+1,
       'วันที่โอน' => $Date_Due,
       'สถานะ' => $row->status_car,
       'ยี่ห้อ' => $row->Brand_car
      );
      }
      $data_array = collect($data_array);

      $excel = Exporter::make('Excel');
      $excel->load($data_array);
      return $excel->stream('reportapprove.xlsx');
      }

    }

}
