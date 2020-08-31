<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        if ($request->type == 1){ //รายการ
          $data = DB::table('buyers')
              ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
              ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
              ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
              ->where('cardetails.Date_Appcar','=',Null)
              ->where('buyers.Contract_buyer','not like', '22%')
              ->where('buyers.Contract_buyer','not like', '33%')
              ->orderBy('buyers.Contract_buyer', 'ASC')
              ->get();
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
                ->orderBy('registers.Date_regis', 'ASC')
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
                ->orderBy('registers.Date_regis', 'ASC')
                ->get();
  
          }
  
          $countData = count($data);
        }
        $type = $request->type;    
        return view('registration.view', compact('type','data','countData','branch','newfdate','newtdate','status','Setdate','contno','SetStrConn','SetStr1','SetStr2'));
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
    public function edit(Request $request, $id)
    {
        $data = DB::table('buyers')
            ->leftJoin('sponsors','buyers.id','=','sponsors.Buyer_id')
            ->leftJoin('sponsor2s','buyers.id','=','sponsor2s.Buyer_id2')
            ->leftJoin('cardetails','Buyers.id','=','cardetails.Buyercar_id')
            ->leftJoin('expenses','Buyers.id','=','expenses.Buyerexpenses_id')
            ->leftJoin('registers','Buyers.id','=','registers.Buyer_id')
            // ->select('buyers.*','sponsors.*','sponsor2s.*','cardetails.*','expenses.*','registers.*','buyers.created_at AS createdBuyers_at')
            ->where('buyers.id',$id)->first();

        $type = $request->type;
        return view('registration.edit',compact('data','type'));
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
        $Getcardetail = Cardetail::where('Buyercar_id',$id)->first();
        $Getregister = Register::where('Buyer_id',$id)->first();

        if($Getregister == null){
          $Registerdb = new Register([
            'Buyer_id' => $id,
            'Date_regis' => date('Y-m-d'),
            'Regno_regis' => $request->get('licensecar'),
            'TypeofReg_regis' => $request->get('Typetransfer'),
            'Comp_regis' => $request->get('Companyown'),
            'CustName_regis' => $request->get('Namebuyer'),
            'NewReg_regis' => $request->get('Newlicensecar'),
            'Desc_regis' => $request->get('Describeregis'),

            'CashoutDate_regis' => $request->get('Datetransport'), //วันที่เบิกขนส่ง
            'DocrecDate_regis' => $request->get('Dategetregis'), //วันที่รับเล่ม
            'DocChk_regis' => $request->get('Doccheck'),
            'KeyChk_regis' => $request->get('Keycheck'),
            'RecChk_regis' => $request->get('Receiptcheck'),

            'CustAmt_regis' => $request->get('Budgetamount'),
            'RecptAmt_regis' => $request->get('Budgetreceipt'),
            'TechAmt_regis' => $request->get('Budgettecnique'),
            'CopyAmt_regis' => $request->get('Budgetcopy'),

            'TransInAmt_regis' => $request->get('TransferinExtra'),
            'TransAmt_regis' => $request->get('Transferextra'),
            'NewCarAmt_regis' => $request->get('Newcarextra'),
            'TaxAmt_regis' => $request->get('Taxextra'),
            'RegAmt_regis' => $request->get('Regisextra'),
            'DocAmt_regis' => $request->get('Docextra'),
            'FixAmt_regis' => $request->get('Editextra'),
            'CancelAmt_regis' => $request->get('Cancelextra'),
            'OtherAmt_regis' => $request->get('Otherextra'),
            'EMSAmt_regis' => $request->get('EMSfee'),
            'Remainfee_regis' => $request->get('Remainfee'),
          ]);
          $Registerdb->save();
        }else{
          $user = Register::where('Buyer_id',$id)->first();
            $user->TypeofReg_regis = $request->get('Typetransfer');
            $user->Comp_regis = $request->get('Companyown');
            $user->Desc_regis = $request->get('Describeregis');

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
            $user->Remainfee_regis = $request->get('Remainfee');
          $user->update();

          // $expenses = Expenses::where('Buyerexpenses_id',$id)->first();
          //   $expenses->tran_Price = $SettranPrice;
          //   $expenses->other_Price = $SetotherPrice;
          // $expenses->update();


        }
        // dd($Getcardetail);
        return redirect()->back()->with('success','อัพเดทข้อมูลเรียบร้อย');
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
}
