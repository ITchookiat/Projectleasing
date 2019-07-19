<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\ARMAST;
// use App\ARPAY;
// use App\INVTRAN;
// use App\VIEW_CUSTMAIL;
use DB;
use PDF;

class CallController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $date = date('Y-m-d', strtotime('-1 days'));
    $fdate = '';
      $tdate = '';
      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }
      // dd($fdate);

    if ($request->type == 1)
    {
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

      $ptbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '01-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumpt = count($ptbranch);

      $ylbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '03-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumyl = count($ylbranch);

      $nrbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '04-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumnr = count($nrbranch);

      $sbbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '05-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumsb = count($sbbranch);

      $klbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '06-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumkl = count($klbranch);

      $btbranch= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '07-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sumbt = count($btbranch);

      $branch02= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '02-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sum02 = count($branch02);

      $branch10= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'like', '10-%')
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();
      $sum10 = count($branch10);

      $branch0210= DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
            ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
            ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
            ->whereBetween('SFHP.ARMAST.HLDNO',[1,1.49])
            ->where('SFHP.ARMAST.CONTNO', 'not like', '01-%')
            ->where('SFHP.ARMAST.CONTNO', 'not like', '03-%')
            ->where('SFHP.ARMAST.CONTNO', 'not like', '04-%')
            ->where('SFHP.ARMAST.CONTNO', 'not like', '05-%')
            ->where('SFHP.ARMAST.CONTNO', 'not like', '06-%')
            ->where('SFHP.ARMAST.CONTNO', 'not like', '07-%')
            ->get();

          $flag1 = true;
          $flag2 = false;
          $flag3 = false;
          $flag4 = false;
          $flag5 = false;
          $flag6 = false;

          foreach ($branch0210 as $key => $value) {
            // code...
            if($flag1 == true){
              $count1[] = $branch0210[$key];
              $flag1 = false;
              $flag2 = true;

            } elseif($flag2 == true){
              $count2[] = $branch0210[$key];
              $flag2 = false;
              $flag3 = true;

            } elseif($flag3 == true){
              $count3[] = $branch0210[$key];
              $flag3 = false;
              $flag4 = true;

            }elseif($flag4 == true){
              $count4[] = $branch0210[$key];
              $flag4 = false;
              $flag5 = true;

            }elseif($flag5 == true){
              $count5[] = $branch0210[$key];
              $flag5 = false;
              $flag6 = true;

            }elseif($flag6 == true){
              $count6[] = $branch0210[$key];
              $flag6 = false;
              $flag1 = true;
            }

            // dd($count1);
          }

      // dump($count1, $count2, $count3, $count4, $count5, $count6);
      //dd($branch0210);

      // dump($allbranch);

      return view('call.home', compact('type','allbranch','ptbranch','ylbranch','nrbranch','sbbranch','klbranch','btbranch','branch02','branch10',
      'sumall','sumpt','sumyl','sumnr','sumsb','sumkl','sumbt','sum02','sum10','branch0210','count1','count2','count3','count4','count5','count6'));

    }elseif ($request->type == 2){
      return view('call.month');
    }
    elseif ($request->type == 3) {
      return view('call.check');
    }
  }

  public function viewdetail(Request $request, $SetStr1, $SetStr2)
  {

    $SetStrConn = $SetStr1."/".$SetStr2;
    // dd($SetStrConn);

    $info = DB::connection('ibmi')
    ->table('SFHP.ARMAST')
    ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
    ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
    ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
    ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
    ->first();

    $info2 = DB::connection('ibmi')
    ->table('SFHP.ARPAY')
    ->where('SFHP.ARPAY.CONTNO','=', $SetStrConn)
    ->get();

    $info3 = DB::connection('ibmi')
    ->table('SFHP.VIEW_ARMGAR')
    ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
    ->first();

    // dd($info3->NAME);

    return view('call.viewdetail', compact('info', 'info2', 'info3'));
  }

}
