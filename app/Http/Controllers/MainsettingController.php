<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Mainsetting;
use App\Target;

class MainsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = DB::table('mainsettings')
        ->where('Settype_set','=','เช่าซื้อ')
        ->first();

        $data2 = DB::table('mainsettings')
        ->where('Settype_set','=','เงินกู้')
        ->first();

        $type = $request->type;
        if($request->type == 1){
            return view('setting.option',compact('type','data','data2'));
        }
        elseif($request->type == 2){
            return view('setting.option',compact('type','data','data2'));
        }
        elseif($request->type == 3){
            return view('setting.program',compact('type','data','data2'));
        }
        elseif($request->type == 4){
            $dataLeasing = DB::table('targets')
                ->where('Target_Type','=','Leasing')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

            $dataPloan = DB::table('targets')
                ->where('Target_Type','=','Ploan')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

            $dataMicro = DB::table('targets')
                ->where('Target_Type','=','Micro')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

            $dataMotor = DB::table('targets')
                ->where('Target_Type','=','Motor')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();
            // dump($dataLeasing,$dataPloan,$dataMicro,$dataMotor);
            return view('setting.program',compact('type','dataLeasing','dataPloan','dataMicro','dataMotor'));
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
        if($request->type == 1){
            $TargetDB = new Target([
                'Target_Type' => $request->get('TargetType'),
                'Target_Month' => $request->get('TargetMonth'),
                'Target_Year' => $request->get('TargetYear'),
                'Target_Pattani' => $request->get('TargetPattani'),
                'Target_Saiburi' => $request->get('TargetSaiburi'),
                'Target_Kophor' => $request->get('TargetKhopor'),
                'Target_Yarang' => $request->get('TargetYarang'),
                'Target_Yala' => $request->get('TargetYala'),
                'Target_Betong' => $request->get('TargetBetong'),
                'Target_Bannangsta' => $request->get('TargetBangnansta'),
                'Target_Yaha' => $request->get('TargetYaha'),
                'Target_Narathiwat' => $request->get('TargetNara'),
                'Target_Kolok' => $request->get('TargetKolok'),
                'Target_Tanyongmas' => $request->get('TargetTangyongmas'),
                'Target_Rosok' => $request->get('TargetRosok'),
                'Target_Dateadd' => Date('Y-m-d'),
                'Target_Useradd' => auth()->user()->name
            ]);
            $TargetDB->save();
        }
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = DB::table('targets')
            ->where('Target_id','=',$id)
            ->first();
        // dd($data);
        $type = $request->type;
        return view('setting.option',compact('type','data'));
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
        if($request->type == 1){ //เช่าซื้อ
            $Set1 = Mainsetting::find($request->SetID);
            if($Set1 != null){
                $Set1->Dutyvalue_set = $request->get('Dutyvalue');
                $Set1->Marketvalue_set = $request->get('Marketvalue');
                $Set1->Comagent_set = $request->get('ComAgenttvalue');
                $Set1->Taxvalue_set = $request->get('Taxvalue');
                $Set1->Interesttype_set = $request->get('Interesttype');
                $Set1->Tabbuyer_set = $request->get('TabBuyer');
                $Set1->Tabsponser_set = $request->get('TabSponser');
                $Set1->Tabcardetail_set = $request->get('TabCardetail');
                $Set1->Tabexpense_set = $request->get('TabExpense');
                $Set1->Tabchecker_set = $request->get('TabChecker');
                $Set1->Tabincome_set = $request->get('TabIncome');
                $Set1->Userupdate_set = $request->get('NameUser');
                $Set1->update();
            }else{
                // dd($request->type,$Set1);
                $DataSet = new Mainsetting([
                    'Dutyvalue_set' => $request->get('Dutyvalue'),
                    'Marketvalue_set' => $request->get('Marketvalue'),
                    'Comagent_set' => $request->get('ComAgenttvalue'),
                    'Taxvalue_set' => $request->get('Taxvalue'),
                    'Taxvalue_set' => $request->get('Taxvalue'),
                    'Interesttype_set' => $request->get('Interesttype'),
                    'Tabsponser_set' => $request->get('TabSponser'),
                    'Tabcardetail_set' => $request->get('TabCardetail'),
                    'Tabexpense_set' => $request->get('TabExpense'),
                    'Tabchecker_set' => $request->get('TabChecker'),
                    'Tabincome_set' => $request->get('TabIncome'),
                    'Userupdate_set' => $request->get('NameUser'),
                    'Settype_set' => 'เช่าซื้อ',
                ]);
                $DataSet->save();
            }
        }
        elseif($request->type == 2){ //เงินกู้
            $Set2 = Mainsetting::find($request->SetID);
            if($Set2 != null){
                // $Set2->Dutyvalue_set = $request->get('Dutyvalue');
                // $Set2->Marketvalue_set = $request->get('Marketvalue');
                $Set2->Comagent_set = $request->get('ComAgenttvalue');
                $Set2->Taxvalue_set = $request->get('Taxvalue');
                $Set2->Interesttype_set = $request->get('Interesttype');
                $Set2->Tabbuyer_set = $request->get('TabBuyer');
                $Set2->Tabsponser_set = $request->get('TabSponser');
                $Set2->Tabcardetail_set = $request->get('TabCardetail');
                $Set2->Tabexpense_set = $request->get('TabExpense');
                $Set2->Tabchecker_set = $request->get('TabChecker');
                $Set2->Tabincome_set = $request->get('TabIncome');
                $Set2->Userupdate_set = $request->get('NameUser');
                $Set2->update();
            }else{
                $DataSet = new Mainsetting([
                    // 'Dutyvalue_set' => $request->get('Dutyvalue'),
                    // 'Marketvalue_set' => $request->get('Marketvalue'),
                    'Comagent_set' => $request->get('ComAgenttvalue'),
                    'Taxvalue_set' => $request->get('Taxvalue'),
                    'Interesttype_set' => $request->get('Interesttype'),
                    'Tabbuyer_set' => $request->get('TabBuyer'),
                    'Tabsponser_set' => $request->get('TabSponser'),
                    'Tabcardetail_set' => $request->get('TabCardetail'),
                    'Tabexpense_set' => $request->get('TabExpense'),
                    'Tabchecker_set' => $request->get('TabChecker'),
                    'Tabincome_set' => $request->get('TabIncome'),
                    'Userupdate_set' => $request->get('NameUser'),
                    'Settype_set' => 'เงินกู้',
                ]);
                $DataSet->save();
            }
        }
        elseif($request->type == 3){ //ยอดเป้า
            $target = Target::where('Target_id',$id)->first();
                $target->Target_Type = $request->get('TargetType');
                $target->Target_Month = $request->get('TargetMonth');
                $target->Target_Year = $request->get('TargetYear');
                $target->Target_Pattani = $request->get('TargetPattani');
                $target->Target_Saiburi = $request->get('TargetSaiburi');
                $target->Target_Kophor = $request->get('TargetKhopor');
                $target->Target_Yarang = $request->get('TargetYarang');
                $target->Target_Yala = $request->get('TargetYala');
                $target->Target_Betong = $request->get('TargetBetong');
                $target->Target_Bannangsta = $request->get('TargetBangnansta');
                $target->Target_Yaha = $request->get('TargetYaha');
                $target->Target_Narathiwat = $request->get('TargetNara');
                $target->Target_Kolok = $request->get('TargetKolok');
                $target->Target_Tanyongmas = $request->get('TargetTangyongmas');
                $target->Target_Rosok = $request->get('TargetRosok');
            $target->update();
        }
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
