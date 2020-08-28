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
            $contno = '';
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
                $datemonth = date('m');
                $dateyear = date('Y');
                $data = DB::table('buyers')
                  ->leftjoin('sponsors','buyers.id','=','sponsors.Buyer_id')
                  ->leftjoin('cardetails','buyers.id','=','cardetails.Buyercar_id')
                  ->leftjoin('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                  ->leftJoin('registers','Buyers.id','=','registers.Buyer_id')
                //   ->where('cardetails.Date_Appcar','=',Null)
                //   ->where('cardetails.Date_Appcar','!=', null)
                  ->whereMonth('cardetails.Date_Appcar',$datemonth)
                  ->whereYear('cardetails.Date_Appcar',$dateyear)
                  ->where('buyers.Contract_buyer','not like', '22%')
                  ->where('buyers.Contract_buyer','not like', '33%')
                  ->orderBy('buyers.Contract_buyer', 'ASC')
                  ->get();
            }
            else {
              if($contno != ''){
                $newfdate = '';
                $newtdate = '';
                $branch = '';
                $status = '';
              }
              $data = DB::table('buyers')
                  ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                  ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                  ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
                  ->leftJoin('registers','Buyers.id','=','registers.Buyer_id')
                  ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
                  })
                  ->when(!empty($branch), function($q) use($branch){
                    return $q->where('cardetails.branch_car',$branch);
                  })
                  ->when(!empty($status), function($q) use($status){
                    return $q->where('cardetails.StatusApp_car','=',$status);
                  })
                  ->when(!empty($contno), function($q) use($contno){
                    return $q->where('buyers.Contract_buyer','=',$contno);
                  })
                  // ->where('cardetails.Date_Appcar','!=', null)
                  ->where('buyers.Contract_buyer','not like', '22%')
                  ->where('buyers.Contract_buyer','not like', '33%')
                  ->orderBy('buyers.Contract_buyer', 'ASC')
                  ->get();
    
            }
    
            $type = $request->type;    
            $countData = count($data);
            return view('registration.view', compact('type','data','countData','branch','newfdate','newtdate','status','Setdate','contno','SetStrConn','SetStr1','SetStr2'));
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

            // 'Income_buyer' => $request->get('Incomebuyer'),
            // 'Purchase_buyer' => $request->get('Purchasebuyer'),
            // 'Support_buyer' => $request->get('Supportbuyer'),
            // 'securities_buyer' => $request->get('securitiesbuyer'),
            // 'deednumber_buyer' => $request->get('deednumberbuyer'),
            // 'area_buyer' => $request->get('areabuyer'),
            // 'BeforeIncome_buyer' => $BeforeIncome,
            // 'AfterIncome_buyer' => $AfterIncome,
            // 'Gradebuyer_car' => $request->get('Gradebuyer'),
            // 'Objective_car' => $request->get('objectivecar'),
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
          $user->update();
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
