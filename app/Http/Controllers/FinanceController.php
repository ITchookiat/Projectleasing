<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recordcall;
use DB;
use PDF;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request, $type)
     {

       // dump($request, $type);
       $month = date('m');
       $year = date('Y');
       $fmonth = $month;
       $fyear = $year;
       if ($request->has('Frommonth')) {
         $fmonth = $request->get('Frommonth');
       }
       if ($request->has('Fromyear')) {
         $fyear = $request->get('Fromyear');
       }
       $SetMonth = $fyear."-".$fmonth;
       $star = $SetMonth."-"."01";
       if($SetMonth == "$fyear-02"){
        $end = $SetMonth."-"."28";
       }elseif($SetMonth == "$fyear-04"){
       $end = $SetMonth."-"."30";
       }elseif($SetMonth == "$fyear-06"){
         $end = $SetMonth."-"."30";
       }elseif($SetMonth == "$fyear-09"){
         $end = $SetMonth."-"."30";
       }elseif($SetMonth == "$fyear-11"){
       $end = $SetMonth."-"."30";
       }else{
       $end = $SetMonth."-"."31";
       }
       // $a = 'กส ไม่ค้ำประกัน';
       // $allstat = DB::connection('ibmi')
       //       ->table('SFHP.INVTRAN')
       //       ->where('SFHP.INVTRAN.BAAB', 'like', $a)
       //       ->get();
       // $sum_allstat = count($allstat);
       $allstat = DB::connection('ibmi')
             ->table('SFHP.ARMAST')
             ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
             ->where('SFHP.ARMAST.CONTNO', 'not like', '02-%')
             ->where('SFHP.ARMAST.CONTNO', 'not like', '10-%')
             ->whereBetween('SFHP.ARMAST.ISSUDT',['2019-01-01','2019-01-31'])
             ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
             ->get();
       $sum_allstat = count($allstat);

       // dd($allstat);

       for($i=0; $i<$sum_allstat; $i++){
         $test[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$allstat[$i]->BAAB)));

       }

       $count_test = count($test);
       $count1 = 0;
       $count2 = 0;
       $count3 = 0;
       $count4 = 0;
       $count5 = 0;
       $count6 = 0;
       $count7 = 0;



       for($j=0; $j<$count_test; $j++){
           if ($test[$j] == "กสค้ำมีหลักทรัพย์") {
             $count1 = $count1 + 1;
           }elseif ($test[$j] == "กสค้ำไม่มีหลักทรัพย") {
             $count2 = $count2 + 1;
           }elseif ($test[$j] == "กสไม่ค้ำประกัน") {
             $count3 = $count3 + 1;
           }elseif ($test[$j] == "ซขค้ำมีหลักทรัพย์") {
             $count4 = $count4 + 1;
           }elseif ($test[$j] == "ซขค้ำไม่มีหลักทรัพย") {
             $count5 = $count5 + 1;
           }elseif ($test[$j] == "ซขไม่ค้ำประกัน") {
             $count6 = $count6 + 1;
           }elseif ($test[$j] == "ลูกค้าVIP1") {
             $count7 = $count7 + 1;
           }
       }

       dump($count1);
       dump($count2);
       dump($count3);
       dump($count4);
       dump($count5);
       dump($count6);
       dump($count7);

         return view('finance.home', compact('type','fmonth','fyear'));
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
