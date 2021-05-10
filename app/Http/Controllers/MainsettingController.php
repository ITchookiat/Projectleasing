<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Mainsetting;

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
            // return view('setting.program',compact('type','data','data2'));
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
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อย');
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
