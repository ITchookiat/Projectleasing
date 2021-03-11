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
        if($request->type == 1){
            $data = DB::table('mainsettings')
            ->where('Settype_set','=','เช่าซื้อ')
            ->first();
        }
        $type = $request->type;
        return view('setting.option',compact('type','data'));
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
        if($request->type == 1){
            $Set1 = Mainsetting::find($request->SetID);
            if($Set1 != null){
                $Set1->Dutyvalue_set = $request->get('Dutyvalue');
                $Set1->Marketvalue_set = $request->get('Marketvalue');
                $Set1->Comagent_set = $request->get('ComAgenttvalue');
                $Set1->Taxvalue_set = $request->get('Taxvalue');
                $Set1->Userupdate_set = $request->get('NameUser');
                $Set1->update();
            }else{
                // dd($request->type,$Set1);
                $DataSet = new Mainsetting([
                    'Dutyvalue_set' => $request->get('Dutyvalue'),
                    'Marketvalue_set' => $request->get('Marketvalue'),
                    'Comagent_set' => $request->get('ComAgenttvalue'),
                    'Taxvalue_set' => $request->get('Taxvalue'),
                    'Userupdate_set' => $request->get('NameUser'),
                    'Settype_set' => 'เช่าซื้อ',
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
