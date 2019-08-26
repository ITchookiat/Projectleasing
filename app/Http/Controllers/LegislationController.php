<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
                  // ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
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

        $data = DB::table('legislations')
                  ->orderBy('Contract_legis', 'ASC')
                  ->get();

                  // dd($data);

        $type = $request->type;
        return view('legislation.view', compact('type', 'result','data'));

      }elseif ($request->type == 2) {
        $data = DB::table('legislations')
                  ->orderBy('Contract_legis', 'ASC')
                  ->get();

        // dd($data);

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
    public function store(Request $request, $SetStr1, $SetStr2)
    {
      // dd('ghjk.');
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
      $item = Legislation::find($id);
      $item->Delete();
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
}
