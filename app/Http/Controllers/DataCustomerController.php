<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Exporter;
use Helper;

use App\Data_customer;
use App\Buyer;
use App\Cardetail;
use App\Sponsor;
use App\Sponsor2;
use App\Expenses;
use App\UploadfileImage;
use App\upload_lat_long;

use App\Micro_Ploan;
use App\MP_Datacar;
use App\MP_Sponsor;
use App\MP_Sponsor2;
use App\MP_Expense;
use App\MP_upload_lat_long;
use App\MP_uploadfile_image;

class DataCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type)
    {
        $datenow = date('Y-m-d');
        $newfdate = '';
        $newtdate = '';
        $status = '';
        if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
            $tdate = \Carbon\Carbon::parse($request->get('Todate'));
            $newtdate = $tdate->addDay();
        }
        if ($request->has('Status')) {
            if($request->get('Status') == 'ลูกค้าสอบถาม'){
                $status = 1;
            }elseif($request->get('Status') == 'ลูกค้าจัดสินเชื่อ'){
                $status = 2;
            }
        }
        if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
            $data = DB::table('data_customers')
            ->where('created_at','>', $datenow)
            ->orderBY('created_at', 'DESC')
            ->get();
        }else {
            $data = DB::table('data_customers')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('created_at',[$newfdate,$newtdate]);
            })
            ->when(!empty($status), function($q) use ($status) {
                return $q->where('Status_leasing','=', $status);
            })
            ->orderBY('created_at', 'DESC')
            ->get();
            }
        $SettingValue = DB::table('mainsettings')
            ->where('Settype_set','=','เช่าซื้อ')
            ->first();

        $SettingValue2 = DB::table('mainsettings')
            ->where('Settype_set','=','เงินกู้')
            ->first();
        $newtdate = $request->get('Todate');
        return view('datacustomer.view', compact('data','type','newfdate','newtdate','status','SettingValue','SettingValue2'));
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
        if ($request->get('Topcar') != Null) {
            $SetTopcar = str_replace (",","",$request->get('Topcar'));
        }else {
            $SetTopcar = 0;
        }
        $Customerdb = new Data_customer([
            'License_car' => $request->get('Licensecar'),
            'Brand_car' => $request->get('Brandcar'),
            'Model_car' => $request->get('Modelcar'),
            'Typecardetails' => $request->get('Typecardetail'),
            'Top_car' => $SetTopcar,
            'Year_car' => $request->get('Yearcar'),
            'Name_buyer' => $request->get('Namebuyer'),
            'Last_buyer' => $request->get('Lastbuyer'),
            'Phone_buyer' => $request->get('Phonebuyer'),
            'IDCard_buyer' => $request->get('IDCardbuyer'),
            'Name_agent' => $request->get('Nameagent'),
            'Phone_agent' => $request->get('Phoneagent'),
            'Resource_news' => $request->get('News'),
            'Branch_car' => $request->get('branchcar'),
            'Note_car' => $request->get('Notecar'),
            'Name_user' => $request->get('NameUser'),
            'Type_leasing' => $request->get('TypeLeasing'),
            'Status_leasing' => 1,
          ]);
          $Customerdb->save();
          return redirect()->back()->with('success','บันทึกเรียบร้อยแล้ว');
    }

    public function savestatus(Request $request, $value, $id)
    {
        $data = Data_customer::find($id);
          $data->Status_leasing = $value;
        $data->update();

        $DateDue = date('Y-m-d');
        $SetYear = date('Y') + 543;

        if ($data->Type_leasing == 'F01') {
            if($data->Branch_car == 'ปัตตานี'){
                $SetContract = '01-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'ยะลา'){
                $SetContract = '03-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'นราธิวาส'){
                $SetContract = '04-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'สายบุรี'){
                $SetContract = '05-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'โกลก'){
                $SetContract = '06-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'เบตง'){
                $SetContract = '07-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'โคกโพธิ์'){
                $SetContract = '08-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'ตันหยงมัส'){
                $SetContract = '09-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'รือเสาะ'){
                $SetContract = '12-'.$SetYear.'/';
            }
             elseif($data->Branch_car == 'บันนังสตา'){
                $SetContract = '13-'.$SetYear.'/';
            }
            elseif($data->Branch_car == 'ยะหา'){
                $SetContract = '14-'.$SetYear.'/';
            }
            else{
                $SetContract = '00-'.$SetYear.'/';
            }
        }else {
            if($data->Branch_car == 'ปัตตานี'){
            $SetContract = $data->Type_leasing.'-'.$SetYear.'50';
            }
            elseif($data->Branch_car == 'ยะลา'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'51';
            }
            elseif($data->Branch_car == 'นราธิวาส'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'52';
            }
            elseif($data->Branch_car == 'สายบุรี'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'53';
            }
            elseif($data->Branch_car == 'โกลก'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'54';
            }
            elseif($data->Branch_car == 'เบตง'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'55';
            }
            elseif($data->Branch_car == 'โคกโพธิ์'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'56';
            }
            elseif($data->Branch_car == 'ตันหยงมัส'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'57';
            }
            elseif($data->Branch_car == 'รือเสาะ'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'58';
            }
            elseif($data->Branch_car == 'บันนังสตา'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'59';
            }
            elseif($data->Branch_car == 'ยะหา'){
                $SetContract = $data->Type_leasing.'-'.$SetYear.'60';
            }
            else{
                $SetContract = $data->Type_leasing.'-'.$SetYear.'00';
            }
        }

        if(auth()->user()->branch == '01'){
            $SetUserBranch = 'ปัตตานี';
        }elseif(auth()->user()->branch == '03'){
            $SetUserBranch = 'ยะลา';
        }elseif(auth()->user()->branch == '04'){
            $SetUserBranch = 'นราธิวาส';
        }elseif(auth()->user()->branch == '05'){
            $SetUserBranch = 'สายบุรี';
        }elseif(auth()->user()->branch == '06'){
            $SetUserBranch = 'โกลก';
        }elseif(auth()->user()->branch == '07'){
            $SetUserBranch = 'เบตง';
        }elseif(auth()->user()->branch == '08'){
            $SetUserBranch = 'โคกโพธิ์';
        }elseif(auth()->user()->branch == '09'){
            $SetUserBranch = 'ตันหยงมัส';
        }elseif(auth()->user()->branch == '12'){
            $SetUserBranch = 'รือเสาะ';
        }elseif(auth()->user()->branch == '13'){
            $SetUserBranch = 'บันนังสตา';
        }elseif(auth()->user()->branch == '14'){
            $SetUserBranch = 'ยะหา';
        }else{
            $SetUserBranch = $data->Branch_car;
        }

        //Save ลูกค้าเช่าซื้อ && Save ลูกค้า PM
        if ($data->Type_leasing == 'F01') {
            $Buyerdb = new Buyer([
                'Contract_buyer' => $SetContract,
                'Date_Due' => $DateDue,
                'Name_buyer' => $data->Name_buyer,
                'last_buyer' => $data->Last_buyer,
                'Phone_buyer' => $data->Phone_buyer,
                'Idcard_buyer' => $data->IDCard_buyer,
                'Walkin_id' => $data->Customer_id,
                'SendUse_Walkin' => $SetUserBranch,
            ]);
            $Buyerdb->save();
            $Sponsordb = new Sponsor([
                'Buyer_id' => $Buyerdb->id,
            ]);
            $Sponsordb->save();
            $Cardetaildb = new Cardetail([
                'Buyercar_id' => $Buyerdb->id,
                'Brand_car' => $data->Brand_car,
                'Year_car' => $data->Year_car,
                'Typecardetails' => $data->Typecardetails,
                'License_car' => $data->License_car,
                'Top_car' => $data->Top_car,
                'Agent_car' => $data->Name_agent,
                'Tellagent_car' => $data->Phone_agent,
                'Loanofficer_car' => $data->Name_user,
                'StatusApp_car' => 'รออนุมัติ',
                'DocComplete_car' => $request->get('doccomplete'),
                'branch_car' => $SetUserBranch,
            ]);
            $Cardetaildb ->save();
            $Expensesdb = new Expenses([
                'Buyerexpenses_id' => $Buyerdb->id,
                'balance_Price' => 0,
                'commit_Price' => 0,
            ]);
            $Expensesdb ->save();
        }else {
            $Micro_Ploan = new Micro_Ploan([
                'Contract_MP' => $SetContract,
                'Type_Con' => $data->Type_leasing,
                'Date_Due' => $DateDue,
                'Name_MP' => $data->Name_buyer,
                'last_MP' => $data->Last_buyer,
                'Phone_MP' => $data->Phone_buyer,
                'Idcard_MP' => $data->IDCard_buyer,
                'Walkin_id' => $data->Customer_id,
                'SendUse_Walkin' => $SetUserBranch,
            ]);
            $Micro_Ploan->save();
            $MP_Datacar = new MP_Datacar([
                'MP_id' => $Micro_Ploan->id,
                'Brand_car' => $data->Brand_car,
                'Year_car' => $data->Year_car,
                'Typecardetails' => $data->Typecardetails,
                'License_car' => $data->License_car,
                'Top_car' => $data->Top_car,
                'Agent_car' => $data->Name_agent,
                'Tellagent_car' => $data->Phone_agent,
                'Loanofficer_car' => $data->Name_user,
                'StatusApp_car' => 'รออนุมัติ',
                'DocComplete_car' => $request->get('doccomplete'),
                'branch_car' => $SetUserBranch,
            ]);
            $MP_Datacar ->save();
            $MP_Sponsor = new MP_Sponsor([
                'MP_id' => $Micro_Ploan->id,
            ]);
            $MP_Sponsor->save();
            $MP_Expense = new MP_Expense([
                'MP_id' => $Micro_Ploan->id,
                'balance_Price' => 0,
                'commit_Price' => 0,
            ]);
            $MP_Expense ->save();
        }

        return redirect()->back()->with('success','บันทึกเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $datenow = date('Y-m-d');
        $newfdate = '';
        $newtdate = '';
        $status = '';
        if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
            $tdate = \Carbon\Carbon::parse($request->get('Todate'));
            $newtdate = $tdate->addDay();
        }
        if ($request->has('Status')) {
            $status = $request->get('Status');
        }

        if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
            $data = DB::table('data_customers')
            ->where('created_at','>', $datenow)
            ->orderBY('created_at', 'DESC')
            ->get();
        }else{
            $data = DB::table('data_customers')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('created_at',[$newfdate,$newtdate]);
            })
            ->when(!empty($status), function($q) use ($status) {
                return $q->where('Status_leasing','=', $status);
            })
            ->orderBY('created_at', 'ASC')
            ->get();
        }
        $newtdate = $request->get('Todate');

        if($request->Type == 1){ //PDF
            $SetTopic = "WalkinPDFReport ".$datenow;

            $view = \View::make('datacustomer.reportWalkin' ,compact('data','type','newfdate','newtdate','status','datenow'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานลูกค้า Walk in');
            $pdf::AddPage('L', 'A4');
            $pdf::SetMargins(5, 5, 5, 0);
            $pdf::SetFont('thsarabunpsk', '', 14, '', true);
            $pdf::SetAutoPageBreak(TRUE, 21);
            $pdf::WriteHTML($html,true,false,true,false,'');
            $pdf::Output($SetTopic.'.pdf');
                
        }
        elseif($request->Type == 2){ //Excel
            $data_array[] = array('ลำดับ','วันที่','สาขา','ประเภท','ทะเบียน','ยี่ห้อ','รุ่น','ประเภทรถ','ปี', 'ยอดจัด', 'ชื่อ-สกุล ลูกค้า','เบอร์ลูกค้า','เลขบัตรประชาชน', 'ชื่อ-สกุล นายหน้า', 'เบอร์นายหน้า', 'หมายเหตุ', 'ที่มาลูกค้า','ประเภทลูกค้า','เจ้าหน้าที่ผู้คีย์');

            foreach($data as $key => $row){
                $date = date_create(substr($row->created_at,0,10));
                $Date_Due = date_format($date, 'd-m-Y');

                if($row->Status_leasing == 1){
                    $status = 'ลูกค้าสอบถาม';
                }elseif($row->Status_leasing == 2){
                    $status = 'ลูกค้าจัดสินเชื่อ';
                }

                $data_array[] = array(
                'ลำดับ' => $key+1,
                'วันที่' => $Date_Due,
                'สาขา' => $row->Branch_car,
                'ประเภท' => $row->Type_leasing,
                'ทะเบียน' => $row->License_car,
                'ยี่ห้อ' => $row->Brand_car,
                'รุ่น' => $row->Model_car,
                'ประเภทรถ' => $row->Typecardetails,
                'ปี' => $row->Year_car,
                'ยอดจัด' => number_format($row->Top_car,2),
                'ชื่อ-สกุล ลูกค้า' => $row->Name_buyer.' '.$row->Last_buyer,
                'เบอร์ลูกค้า' => $row->Phone_buyer,
                'เลขบัตรประชาชน' => $row->IDCard_buyer,
                'ชื่อ-สกุล นายหน้า' => $row->Name_agent,
                'เบอร์นายหน้า' => $row->Phone_agent,
                'หมายเหตุ' => $row->Note_car,
                'ที่มาลูกค้า' => $row->Resource_news,
                'ประเภทลูกค้า' => $status,
                'เจ้าหน้าที่ผู้คีย์' => $row->Name_user,
                );
            }
            $data_array = collect($data_array);
            $excel = Exporter::make('Excel');
            $excel->load($data_array);
            return $excel->stream('CustomerWalkin.xlsx');
        }
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
        $item1 = Data_customer::find($id);
        $item1->Delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

}
