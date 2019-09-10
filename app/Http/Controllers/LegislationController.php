<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Legislation;

class LegislationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->type == 1) {
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,7.69])
                  ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                  ->get();

                  $count = count($data);
                  for($i=0; $i<$count; $i++){
                    $str[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$data[$i]->CONTSTAT)));
                    if ($str[$i] == "ฟ") {
                      $result[] = $data[$i];
                    }
                  }

        $dataAro = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.AROTHGAR','SFHP.ARMAST.CONTNO','=','SFHP.AROTHGAR.CONTNO')
                  ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,7.69])
                  ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                  ->get();

                  $count2 = count($dataAro);
                  for($j=0; $j<$count2; $j++){
                    $str2[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$dataAro[$j]->CONTSTAT)));
                    if ($str2[$j] == "ฟ") {
                      $result2[] = $dataAro[$j];
                    }
                  }

        $data = DB::table('legislations')
                  ->orderBy('Contract_legis', 'ASC')
                  ->get();

        $type = $request->type;
        return view('legislation.view', compact('type', 'result','data','result2'));

      }elseif ($request->type == 2) {
        $data = DB::table('legislations')
                  ->orderBy('Contract_legis', 'ASC')
                  ->get();

        $type = $request->type;
        return view('legislation.view', compact('type', 'data'));
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
    public function store(Request $request, $SetStr1, $SetStr2, $SetRealty)
    {
        $SetStrConn = $SetStr1."/".$SetStr2;
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->where('SFHP.ARMAST.CONTNO','=', $SetStrConn)
                  ->first();

        $dataGT = DB::connection('ibmi')
                  ->table('SFHP.VIEW_ARMGAR')
                  ->where('SFHP.VIEW_ARMGAR.CONTNO','=', $SetStrConn)
                  ->first();

        $SetBalancePrice = $data->BALANC - $data->SMPAY;

        $LegisDB = new Legislation([
          'Contract_legis' => $data->CONTNO,
          'Name_legis' => (iconv('TIS-620', 'utf-8', str_replace(" ","",$data->SNAM)." ".str_replace(" ","",$data->NAME1)."  ".str_replace(" ","",$data->NAME2))),
          'Idcard_legis' => (str_replace(" ","",$data->IDNO)),
          'BrandCar_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->TYPE))),
          'register_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->REGNO))),
          'YearCar_legis' => $data->MANUYR,
          'Category_legis' => (iconv('Tis-620','utf-8',str_replace(" ","",$data->BAAB))),
          'DateDue_legis' => $data->FDATE,
          'Pay_legis' => $data->NCARCST,
          'BalancePrice_legis' => $SetBalancePrice,
          'DateVAT_legis' => $data->DTSTOPV,
          'NameGT_legis' => (iconv('Tis-620','utf-8',$dataGT->NAME)),
          'IdcardGT_legis' => (str_replace(" ","",$dataGT->IDNO)),
          'Realty_legis' => $SetRealty,
          'Flag' => 'Y',
        ]);
        $LegisDB->save();

        return redirect()->Route('legislation',1)->with('success','ส่งฟ้องเรียบร้อย');
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
      $data = DB::table('legislations')
                ->where('legislations.id',$id)->first();

                // dump($data);
      return view('legislation.edit',compact('data','id'));
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
        dd($request->list1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Legislation::find($id);
      $item->Delete();
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
}
