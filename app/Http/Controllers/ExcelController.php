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
      elseif($request->type == 4){
        dd('ส่วนนราธิวาส');
      }
      elseif($request->type == 5){
        dd('ส่วนสายบุรี');
      }
      elseif($request->type == 7){
        dd('ส่วนเบตง');
      }
      elseif($request->type == 11){  //รายงานปรับโครงสร้างหนี้
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
        $branch = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }

        if ($request->get('Fromdate') == Null and $request->get('Todate') == Null) {
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                    ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                    ->where('cardetails.Approvers_car','!=',Null)
                    ->where('buyers.Contract_buyer','like', '22%')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get()
                    ->toArray();
        }else{
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                    ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                    ->where('cardetails.Approvers_car','!=',Null)
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                      return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
                    })
                    ->where('buyers.Contract_buyer','like', '22%')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get()
                    ->toArray();
        }
        // dd($data);

        $data_array[] = array('ลำดับ', 'วันทำสัญญา', 'เลขสัญญา', 'ชื่อ-สกุล', 'สถานะ', 'ยี่ห้อ', 'สี', 'ปี', 'ป้ายทะเบียน', 'ยอดจัด', 'ชำระต่องวด','ระยะเวลาผ่อน','ดอกเบี้ย', 'วันที่ชำระงวดแรก', 'ยอดผ่อนชำระทั้งหมด ', 'เลขสัญญาเดิม', 'ค่างวดเดิม', 'ระยะเวลาผ่อนเดิม', 'คชจ. ปรับโครงสร้าง', 'เจ้าหน้าที่รับลูกค้า');

          foreach($data as $key => $row){
            $date = date_create($row->Date_Due);
            $Date_Due = date_format($date, 'd-m-Y');

            $data_array[] = array(
             'ลำดับ' => $key+1,
             'วันทำสัญญา' => $Date_Due,
             'เลขสัญญา' => $row->Contract_buyer,
             'ชื่อ-สกุล' => $row->Name_buyer.' '.$row->last_buyer,
             'สถานะ' => $row->status_car,
             'ยี่ห้อ' => $row->Brand_car,
             'สี' => $row->Colour_car,
             'ปี' => $row->Year_car,
             'ป้ายทะเบียน' => $row->License_car,
             'ยอดจัด' => $row->Top_car,
             'ชำระต่องวด' => $row->Pay_car,
             'ระยะเวลาผ่อน' => $row->Timeslacken_car,
             'ดอกเบี้ย' => $row->Interest_car,
             'วันที่ชำระงวดแรก' => $row->Dateduefirst_car,
             'ยอดผ่อนชำระทั้งหมด' => $row->Totalpay1_car,
             'เลขสัญญาเดิม' => $row->Note_car,
             'ค่างวดเดิม' => $row->other_Price,
             'ระยะเวลาผ่อนเดิม' => $row->note_Price,
             'คชจ. ปรับโครงสร้าง' => 2500,
             'เจ้าหน้าที่รับลูกค้า' => $row->Loanofficer_car,
            );
          }
        $data_array = collect($data_array);
        $excel = Exporter::make('Excel');
        $excel->load($data_array);
        return $excel->stream('reportrestructure.xlsx');
      }
      elseif($request->type == 14){  //รายงานมาตรการช่วยเหลือ
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
        $branch = '';

        if ($request->has('Fromdate')) {
          $fdate = $request->get('Fromdate');
          $newfdate = \Carbon\Carbon::parse($fdate)->format('Y') ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        }
        if ($request->has('Todate')) {
          $tdate = $request->get('Todate');
          $newtdate = \Carbon\Carbon::parse($tdate)->format('Y') ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
        }
        // if ($request->has('agen')) {
        //   $agen = $request->get('agen');
        // }
        // if ($request->has('yearcar')) {
        //   $yearcar = $request->get('yearcar');
        // }
        // if ($request->has('typecar')) {
        //   $typecar = $request->get('typecar');
        // }
        // if ($request->has('branch')) {
        //   $branch = $request->get('branch');
        // }

        if ($request->get('Fromdate') == Null and $request->get('Todate') == Null) {
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                    ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                    ->where('cardetails.Approvers_car','!=',Null)
                    ->where('buyers.Contract_buyer','like', '33%')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get()
                    ->toArray();
        }
        else{
          $data = DB::table('buyers')
                    ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                    ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                    ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                    ->where('cardetails.Approvers_car','!=',Null)
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                      return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
                    })
                    // ->when(!empty($agen), function($q) use($agen){
                    //   return $q->where('cardetails.Agent_car',$agen);
                    // })
                    // ->when(!empty($yearcar), function($q) use($yearcar){
                    //   return $q->where('cardetails.Year_car',$yearcar);
                    // })
                    // ->when(!empty($typecar), function($q) use($typecar){
                    //   return $q->where('cardetails.status_car',$typecar);
                    // })
                    // ->when(!empty($branch), function($q) use($branch){
                    //   return $q->where('cardetails.branch_car',$branch);
                    // })
                    ->where('buyers.Contract_buyer','like', '33%')
                    ->orderBy('buyers.Contract_buyer', 'ASC')
                    ->get()
                    ->toArray();
        }

        $data_array[] = array('ลำดับ','สาขา','วันที่อนุมัติ','เลขสัญญาเดิม','มาตรการช่วยเหลือ','เลขสัญญา','แบบ','ยี่ห้อ','ทะเบียน','ปี','ยอดจัด','ค่างวด','ระยะเวลาผ่อน','ยอดรวม','วันที่ชำระงวดแรก','ที่อยู่','เบอร์ติดต่อ');

          foreach($data as $key => $row){
            $date = date_create($row->Date_Due);
            $Date_Due = date_format($date, 'd-m-Y');
            $date2 = date_create($row->Dateduefirst_car);
            $Date_DueFirstcar = date_format($date2, 'd-m-Y');

            if($row->Loanofficer_car == 'นายต่วนมุหยีดีน ลอจิ' or $row->Loanofficer_car == 'นางวิธุกร ณ พิชัย' or $row->Loanofficer_car == 'นางวุฐิกุล ศุกลรัตน์'){
              $Branch = 'ปัตตานี';
            }
            elseif($row->Loanofficer_car == 'นายเดะมะ มะ' or $row->Loanofficer_car == 'นายมะยูโซะ อามะ' or $row->Loanofficer_car == 'นายฤทธิพร ดือราแม'){
              $Branch = 'ยะลา';
            }
            elseif($row->Loanofficer_car == 'น.ส.ฮายาตี นิบง' or $row->Loanofficer_car == 'นายซุลกิฟลี แมเราะ' or $row->Loanofficer_car == 'นายมัซวัน มะสาแม'){
              $Branch = 'นราธิวาส';
            }
            elseif($row->Loanofficer_car == 'นายฟิกรีย์ บาราเต๊ะ' or $row->Loanofficer_car == 'น.ส สาลีละห์ เจะโซะ'){
              $Branch = 'สายบุรี';
            }
            elseif($row->Loanofficer_car == 'นายฟาอีส อูมา' or $row->Loanofficer_car == 'สุภาพร สุขแดง'){
              $Branch = 'โกลก';
            }
            elseif($row->Loanofficer_car == 'น.ส.เพ็ญทิพย์ หนูบุญล้อม' or $row->Loanofficer_car == 'น.ส สาลีละห์ เจะโซะ'){
              $Branch = 'เบตง';
            }

            $data_array[] = array(
             'ลำดับ' => $key+1,
             'สาขา' => $Branch,
             'วันที่อนุมัติ' => $Date_Due,
             'เลขสัญญาเดิม' => $row->Note_car,
             'มาตรการช่วยเหลือ' => $row->Objective_car,
             'เลขสัญญา' => $row->Contract_buyer,
             'แบบ' => $row->status_car,
             'ยี่ห้อ' => $row->Brand_car,
             'ทะเบียน' => $row->License_car,
             'ปี' => $row->Year_car,
             'ยอดจัด' => number_format($row->Top_car,2),
             'ค่างวด' => $row->Pay_car,
             'ระยะเวลาผ่อน' => $row->Timeslacken_car,
             'ยอดรวม' => $row->Totalpay1_car,
             'วันที่ชำระงวดแรก' => $Date_DueFirstcar,
             'ที่อยู่' => $row->StatusAdd_buyer,
             'เบอร์ติดต่อ' => $row->Phone_buyer,
            );
          }
        $data_array = collect($data_array);
        $excel = Exporter::make('Excel');
        $excel->load($data_array);
        return $excel->stream('reportCovidapprove.xlsx');
      }
    }
}
