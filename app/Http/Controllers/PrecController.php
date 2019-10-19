<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PrecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;

        if ($request->type == 1) {
          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.99])
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();
          $type = $request->type;
          return view('precipitate.view', compact('data', 'type'));
        }
        elseif ($request->type == 2) {
          $fdate = $date;
          $tdate = $date;
          $follower = '';

          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }
          if ($request->has('follower')) {
            $follower = $request->get('follower');
          }

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->when(!empty($follower), function($q) use($follower){
                      return $q->where('SFHP.ARMAST.BILLCOLL',$follower);
                    })
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();

          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','follower','type'));
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
