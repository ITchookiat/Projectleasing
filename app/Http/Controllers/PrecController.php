<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;

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
          $fdate = $date;
          $tdate = $date;

          if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
          }

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                      return $q->whereBetween('SFHP.ARPAY.DDATE',[$fdate,$tdate]);
                    })
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();

          // dd($data);
          $type = $request->type;
          return view('precipitate.view', compact('data','fdate','tdate','type'));
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
                    ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.99])
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
        elseif ($request->type == 3) {
          $newdate = date('Y-m-d', strtotime('+3 days'));

          $data = DB::connection('ibmi')
                    ->table('SFHP.ARMAST')
                    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                    ->where('SFHP.ARMAST.BILLCOLL','=',99)
                    ->whereBetween('SFHP.ARPAY.DDATE',[$newdate,$newdate])
                    ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
                    ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                    ->get();
                    
          $type = $request->type;
          return view('precipitate.view', compact('data', 'type'));
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

    public function ReportPrecDue(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;

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

      $view = \View::make('precipitate.ReportPrecDue' ,compact('data','date'));
      $html = $view->render();
      $pdf = new PDF();
      $pdf::SetTitle('รายงานข้อมูลติดตาม');
      $pdf::AddPage('L', 'A4');
      $pdf::SetMargins(5, 5, 5, 0);
      $pdf::SetFont('freeserif', '', 8, '', true);
      $pdf::SetAutoPageBreak(TRUE, 25);

      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('ReportPrecDue.pdf');
    }
}
