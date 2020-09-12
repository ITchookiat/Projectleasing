<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;

use App\Buyer;
use App\Sponsor;
use App\Register;
use App\Cardetail;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $dataRegis = DB::table('registers')->get();
        if ($request->type == 1){ //รายการลิสซิ่ง
          $RegisterNo = $request->Regno;
          if($RegisterNo == ''){
            $data = DB::table('buyers')
                ->leftjoin('sponsors','buyers.id','=','sponsors.Buyer_id')
                ->leftjoin('cardetails','buyers.id','=','cardetails.Buyercar_id')
                ->leftjoin('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                // ->where('cardetails.Date_Appcar','!=',Null)
                ->where('cardetails.Date_Appcar', $date)
                ->where('cardetails.Approvers_car','<>','')
                ->where('buyers.Contract_buyer','not like', '22%')
                ->where('buyers.Contract_buyer','not like', '33%')
                ->orderBy('buyers.id', 'ASC')
                ->get();
          }else{
            $data = DB::table('buyers')
            ->leftjoin('cardetails','buyers.id','=','cardetails.Buyercar_id')
            ->where('cardetails.License_car', $RegisterNo)
            ->get();
          }
        }
        elseif ($request->type == 2){ //รายการ
          $datenow = date('Y-m-d');
          $newfdate = '';
          $newtdate = '';
          $branch = '';
          $status = '';
  
          if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
          }
          if ($request->has('branch')) {
            $branch = $request->get('branch');
          }
          if ($request->has('status')) {
            $status = $request->get('status');
          }
          if ($request->has('Contno')) {
            $contno = $request->get('Contno');
          }
  
          if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
              $data = DB::table('registers')
                ->where('registers.Date_regis',$datenow)
                ->orderBy('registers.Date_regis', 'DESC')
                ->get();
          }
          else {

            $data = DB::table('registers')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                  return $q->whereBetween('registers.Date_regis',[$newfdate,$newtdate]);
                })
                // ->when(!empty($status), function($q) use($status){
                //   return $q->where('cardetails.StatusApp_car','=',$status);
                // })
                ->orderBy('registers.Date_regis', 'DESC')
                ->get();
  
          }

        }
        $type = $request->type;    
        return view('registration.view', compact('type','data','dataRegis','branch','newfdate','newtdate','status','Setdate','RegisterNo'));
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
      if($request->type == 1){
        $Register = new Register([
          'Date_regis' => $request->get('dateaccept'),
          'Regno_regis' => $request->get('licensecar'),
          'NewReg_regis' => $request->get('Newlicensecar'),
          'TypeofReg_regis' => $request->get('Typetransfer'),
          'Comp_regis' => $request->get('Companyown'),
          'CustName_regis' => $request->get('Namebuyer'),
          'CustSurN_regis' => $request->get('Lastbuyer'),
          'Brand_regis' => $request->get('Brandcar'),
          'Model_regis' => $request->get('Modelcar'),
          'Desc_regis' => $request->get('Describeregis'),
          'CashoutDate_regis' => $request->get('Datetransport'),
          'DocrecDate_regis' => $request->get('Dategetregis'),
          'DocChk_regis' => $request->get('Doccheck'),
          'KeyChk_regis' => $request->get('Keycheck'),
          'RecChk_regis' => $request->get('Receiptcheck'),

          'CustAmt_regis'=> $request->get('Budgetamount2'),
          'RecptAmt_regis'=> $request->get('Budgetreceipt2'),
          'TechAmt_regis'=> $request->get('Budgettecnique2'),
          'CopyAmt_regis'=> $request->get('Budgetcopy2'),

          'TransInAmt_regis'=> $request->get('TransferinExtra2'),
          'TransAmt_regis'=> $request->get('Transferextra2'),
          'NewCarAmt_regis'=> $request->get('Newcarextra2'),
          'TaxAmt_regis'=> $request->get('Taxextra2'),
          'RegAmt_regis'=> $request->get('Regisextra2'),
          'DocAmt_regis'=> $request->get('Docextra2'),
          'FixAmt_regis'=> $request->get('Editextra2'),
          'CancelAmt_regis'=> $request->get('Cancelextra2'),
          'OtherAmt_regis'=> $request->get('Otherextra2'),
          'EMSAmt_regis'=> $request->get('EMSfee2'),
          'Remainfee_regis' => str_replace(",","",$request->get('Remainfee2')),
          'Flag_regis'=> 'N',
        ]);
        $Register->save();
      }
      $type = 2; // 
      $newfdate = '';
      $newtdate = '';
      $data = '';
      return redirect()->Route('Register',$type)->with(['data' => $data,'newfdate' => $newfdate,'newtdate' => $newtdate,'success' => 'เพิ่มข้อมูลเรียบร้อย']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      if($request->type == 1){ //รายงานทะเบียน
          $newfdate = '';
          $newtdate = '';
          $typetransfer = '';
          $company = '';
  
          if ($request->has('Fromdate')) {
            $newfdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $newtdate = $request->get('Todate');
          }
          if ($request->has('Typetransfer')) {
            $typetransfer = $request->get('Typetransfer');
          }
          if ($request->has('Companyown')) {
            $company = $request->get('Companyown');
          }
          $Amount = $request->get('RegisterAmount');
          $CountAmount = count($typetransfer);

          $data = DB::table('registers')
          ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
            return $q->whereBetween('registers.Date_regis',[$newfdate,$newtdate]);
          })
          ->when(!empty($typetransfer), function($q) use ($typetransfer) {
            return $q->whereIn('registers.TypeofReg_regis',$typetransfer);
          })
          ->when(!empty($company), function($q) use ($company) {
            return $q->where('registers.Comp_regis',$company);
          })
          ->orderBy('registers.Date_regis', 'DESC')
          ->get();
          $type = $request->type;
          $SetTopic = "Report".date('Y-m-d');
          $pdf = new PDF();
          $pdf::SetTitle('รายงานทะเบียน');
          $pdf::AddPage('L', 'A4');
      }
      elseif($request->type == 2){ //ใบเสร็จรับเงินแต่ละรายการ
        $data = Register::where('Reg_id',$id)->first();
        $type = $request->type;
        $SetTopic = "Receipt".date('Y-m-d');
        $pdf = new PDF();
        $pdf::SetTitle('ใบเสร็จรับเงิน');
        $pdf::AddPage('L', 'A5');

      }
      $view = \View::make('registration.reportRegis' ,compact('data','type','newfdate','newtdate','typetransfer','company','Amount','CountAmount'));
      $html = $view->render();

      $pdf::SetMargins(5, 5, 5);
      $pdf::SetFont('thsarabunpsk', '', 15, '', true);
      $pdf::SetAutoPageBreak(TRUE, 21);
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output($SetTopic.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      if($request->type == 1){
        $data = DB::table('buyers')
          ->leftJoin('cardetails','Buyers.id','=','cardetails.Buyercar_id')
          ->where('buyers.id',$id)->first();
        $Getregister = Register::where('Buyer_id',$id)->first();
          $Register = new Register([
            'Buyer_id' => $id,
            'Date_regis' => date('Y-m-d'),
            'Regno_regis' => $data->License_car,
            'NewReg_regis' => $data->Nowlicense_car,
            'Brand_regis' => $data->Brand_car,
            'Model_regis' => $data->Model_car,
            'CustName_regis' => $data->Name_buyer,
            'CustSurN_regis' => $data->last_buyer,
            'Flag_regis' => 'T',
          ]);
          $Register->save();
        $type = 2; // 
        $newfdate = '';
        $newtdate = '';
        $data = DB::table('registers')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('registers.Date_regis',[$newfdate,$newtdate]);
              })
              ->orderBy('registers.Date_regis', 'DESC')
              ->get();
        return redirect()->Route('Register',$type)->with(['data' => $data,'newfdate' => $newfdate,'newtdate' => $newtdate,'success' => 'เลือกข้อมูลเรียบร้อย']);
      }elseif($request->type == 2){
        $data = Register::where('Reg_id',$id)->first();
        $type = $request->type;
        return view('registration.edit', compact('type','data'));

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
          $user = Register::where('Reg_id',$id)->first();
            $user->TypeofReg_regis = $request->get('Typetransfer');
            $user->Comp_regis = $request->get('Companyown');
            $user->Desc_regis = $request->get('Describeregis');
            $user->Regno_regis = $request->get('licensecar');
            $user->NewReg_regis = $request->get('Newlicensecar');
            $user->Brand_regis = $request->get('Brandcar');
            $user->Model_regis = $request->get('Modelcar');
            $user->CustName_regis = $request->get('Namebuyer');
            $user->CustSurN_regis = $request->get('Lastbuyer');

            $user->CashoutDate_regis = $request->get('Datetransport');
            $user->DocrecDate_regis = $request->get('Dategetregis');
            $user->DocChk_regis = $request->get('Doccheck');
            $user->KeyChk_regis = $request->get('Keycheck');
            $user->RecChk_regis = $request->get('Receiptcheck');

            $user->CustAmt_regis = $request->get('Budgetamount');
            $user->RecptAmt_regis = $request->get('Budgetreceipt');
            $user->TechAmt_regis = $request->get('Budgettecnique');
            $user->CopyAmt_regis = $request->get('Budgetcopy');

            $user->TransInAmt_regis = $request->get('TransferinExtra');
            $user->TransAmt_regis = $request->get('Transferextra');
            $user->NewCarAmt_regis = $request->get('Newcarextra');
            $user->TaxAmt_regis = $request->get('Taxextra');
            $user->RegAmt_regis = $request->get('Regisextra');
            $user->DocAmt_regis = $request->get('Docextra');
            $user->FixAmt_regis = $request->get('Editextra');
            $user->CancelAmt_regis = $request->get('Cancelextra');
            $user->OtherAmt_regis = $request->get('Otherextra');
            $user->EMSAmt_regis = $request->get('EMSfee');
            $user->Remainfee_regis = str_replace(",","",$request->get('Remainfee'));
          $user->update();

          // $expenses = Expenses::where('Buyerexpenses_id',$id)->first();
          //   $expenses->tran_Price = $SettranPrice;
          //   $expenses->other_Price = $SetotherPrice;
          // $expenses->update();

        // dd($Getcardetail);
        return redirect()->back()->with('success','อัพเดทข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if($request->type == 1){
        $item1 = Register::find($id);
        $item1->Delete();
      }
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
}
