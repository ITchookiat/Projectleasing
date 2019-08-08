<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exporter;

class ExcelController extends Controller
{

    public function excel(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $today = date('Y-m-d');

      if($request->type == 1){
        $data = DB::table('recordcalls')
                  ->whereBetween('date_record',[$today,$today])
                  ->get()
                  ->toArray();

        $data_array[] = array('งานโทรค้าง 1 งวด รวมทุกสาขา');
        $data_array[] = array('ลำดับ', 'เลขที่สัญญา', 'ชื่อลูกค้า', 'วันดิว งวดแรก', 'เบอร์โทร', 'ค้างชำระ', 'หมายเหตุ');

        foreach($data as $key => $call){

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
      elseif($request->type == 2){
        dd('ส่วนปัตตานี');
      }
      elseif($request->type == 3){  //รายงานสินเชื่อ
        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $Y2 = date('Y') +543;
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;
        $date2 = $d.'-'.$m.'-'.$Y2;

        $newfdate = '';
        $newtdate = '';
        $agen = '';
        $yearcar = '';
        $typecar = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y')-543 ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y')-543 ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
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
        ->orderBy('buyers.Contract_buyer', 'ASC')
        ->get()
        ->toArray();

        $data_array[] = array('ลำดับ', 'วันที่โอน', 'สถานะ', 'ยี่ห้อ', 'รุ่น', 'ทะเบียนเดิม', 'ทะเบียนใหม่', 'เลขสัญญา', 'ปี', 'ยอดจัด', 'พรบ.', 'ดอกเบี้ย', 'งวดผ่อน(เดือน)', 'ค่าใช้จ่ายขนส่ง', 'อื่นๆ', 'ค่าประเมิน', 'ค่าการตลาด', 'อากร',
        'รวม คชจ', 'คงเหลือ', 'ค่าคอมก่อนหัก3%', 'ค่ค่าคอมหลังหัก3%', 'วันที่โอนรถ', 'เอกสารผู้ค้ำ', 'ผู้รับเงิน', 'เลขที่บัญชี', 'เบอร์โทรผู้รับเงิน', 'ผู้รับค่าคอม', 'เลขที่บัญชี', 'เบอร์โทรผู้แนะนำ', 'ใบขับขี่', 'แถมประกัน');

          foreach($data as $key => $row){
            $date = date_create($row->Date_Due);
            $Date_Due = date_format($date, 'd-m-Y');

            $data_array[] = array(
             'ลำดับ' => $key+1,
             'วันที่โอน' => $Date_Due,
             'สถานะ' => $row->status_car,
             'ยี่ห้อ' => $row->Brand_car,
             'รุ่น' => $row->Model_car,
             'ทะเบียนเดิม' => $row->License_car,
             'ทะเบียนใหม่' => $row->Nowlicense_car,
             'เลขสัญญา' => $row->Contract_buyer,
             'ปี' => $row->Year_car,
             'ยอดจัด' => $row->Top_car,
             'พรบ.' => $row->act_Price,
             'ดอกเบี้ย' => $row->Percent_car,
             'งวดผ่อน(เดือน)' => $row->Timeslacken_car,
             'ค่าใช้จ่ายขนส่ง' => $row->tran_Price,
             'อื่นๆ' => $row->other_Price,
             'ค่าประเมิน' => $row->evaluetion_Price,
             'ค่าการตลาด' => $row->marketing_Price,
             'อากร' => $row->duty_Price,
             'รวม คชจ.' => $row->totalk_Price,
             'คงเหลือ' => $row->balance_Price,
             'ค่าคอมก่อนหัก3%' => $row->Commission_car,
             'ค่าคอมหลังหัก3%' => $row->commit_Price,
             'วันที่โอนรถ' => $row->Date_Due,
             'เอกสารผู้ค้ำ' => $row->deednumber_SP,
             'ผู้รับเงิน' => $row->Payee_car,
             'เลขที่บัญช(ผู้รับเงิน)ี' => $row->Accountbrance_car,
             'เบอร์โทร(ผู้รับเงิน)' => $row->Tellbrance_car,
             'ผู้รับค่าคอม' => $row->Agent_car,
             'เลขที่บัญชี(รับคอม)' => $row->Accountagent_car,
             'เบอร์โทรผู้แนะนำ' => $row->Tellagent_car,
             'ใบขับขี่' => $row->Driver_buyer,
             'แถมประกัน' => $row->Insurance_car,
            );
          }
        $data_array = collect($data_array);
        $excel = Exporter::make('Excel');
        $excel->load($data_array);
        return $excel->stream('reportapprove.xlsx');
      }
      elseif($request->type == 4){
        dd('ส่วนนราธิวาส');
      }
      elseif($request->type == 5){
        dd('ส่วนสายบุรี');
      }
      elseif($request->type == 6){
        dd('ส่วนสุไหงโก-ลก');
      }
      elseif($request->type == 7){
        dd('ส่วนเบตง');
      }
      
    }

}
