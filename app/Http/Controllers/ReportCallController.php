<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class ReportCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$Type)
    {
        //
        dd($Type);

        if ($request->type == 1){
          $allbranch = DB::connection('ibmi')
                ->table('SFHP.ARMAST')
                ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
                ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
                ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                ->get();
          $sumall = count($allbranch);
        }
        return view('call.reportAll');

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
        //
    }
}
