<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Legislation;
use App\Legiscourt;
use App\LegisImage;

class LegislationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->type == 1) {
        $data = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->join('SFHP.VIEW_CUSTMAIL','SFHP.ARMAST.CUSCOD','=','SFHP.VIEW_CUSTMAIL.CUSCOD')
                  ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,8.69])
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
                  ->whereBetween('SFHP.ARMAST.HLDNO',[6.7,8.69])
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

      }
      elseif ($request->type == 2) {
        // $data = DB::table('legislations')
        //           ->orderBy('Contract_legis', 'ASC')
        //           ->get();

        $data = DB::table('legislations')
                  ->join('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->orderBy('legislations.Contract_legis', 'ASC')
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
          'DateVAT_legis' => $data->DTSTOPV,
          'NameGT_legis' => (iconv('Tis-620','utf-8',$dataGT->NAME)),
          'IdcardGT_legis' => (str_replace(" ","",$dataGT->IDNO)),
          'Realty_legis' => $SetRealty,

          'Mile_legis' => $data->MILERT,
          'Period_legis' => $data->TOT_UPAY,
          'Countperiod_legis' => $data->T_NOPAY,
          'Beforeperiod_legis' => $data->EXP_FRM,
          'Beforemoey_legis' => $data->SMPAY,
          'Remainperiod_legis' => $data->T_NOPAY - $data->EXP_FRM,
          'Sumperiod_legis' => $data->BALANC - $data->SMPAY,
          'Flag' => 'Y',
        ]);
        $LegisDB->save();

        $Legiscourt = new Legiscourt([
          'legislation_id' => $LegisDB->id,
          'fillingdate_court' => Null,
          'law_court' =>  Null,
          'bnumber_court' =>  Null,
          'rnumber_court' =>  Null,
          'capital_court' =>  Null,
          'indictment_court' =>  Null,
          'pricelawyer_court' =>  Null,
          'examiday_court' =>  Null,
          'fuzzy_court' =>  Null,
          'examinote_court' =>  Null,
          'orderday_court' =>  Null,
          'ordersend_court' =>  Null,
          'checkday_court' =>  Null,
          'checksend_court' =>  Null,
          'buyer_court' =>  Null,
          'support_court' =>  Null,
          'note_court' =>  Null,
          'social_flag' =>  Null,
          'setoffice_court' =>  Null,
          'sendoffice_court' =>  Null,
          'checkresults_court' =>  Null,
          'sendcheckresults_court' =>  Null,
          'received_court' =>  Null,
          'telresults_court' =>  Null,
          'dayresults_court' =>  Null,
          'propertied_court' =>  Null,
          'sequester_court' =>  Null,
          'sendsequester_court' =>  Null,
          'latitude_court' =>  Null,
          'longitude_court' =>  Null,
        ]);
        $Legiscourt->save();


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
    public function edit($id,$type)
    {
      // dump($type);
      if ($type == 2) {
        $data = DB::table('legislations')
        ->where('legislations.id',$id)->first();

        return view('legislation.edit',compact('data','id','type'));
      }
      elseif ($type == 3){
        $data = DB::table('legiscourts')
        ->where('legiscourts.legislation_id',$id)->first();

        return view('legislation.editlegis1',compact('data','id','type'));
      }
      elseif ($type == 11){
        $data = DB::table('legiscourts')
        ->where('legiscourts.legislation_id',$id)->first();
        $dataImages = DB::table('legisimages')
        ->where('legisimages.legisImage_id',$id)->get();
        $SumImage = count($dataImages);
        if($SumImage > 0){
          $column = 100/$SumImage - 0.8;
        }else{
          $column = 0;
        }

        $datalatlong = DB::table('legiscourts')->get();

        foreach ($datalatlong as $key => $value) {
          $lat = $value->latitude_court;
          $long = $value->longitude_court;
        }

        // dump($lat,$long);

        return view('legislation.info',compact('data','id','type','dataImages','SumImage','column','lat','long'));
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
      // dd($request);

      if ($type == 2) {
        $user = Legislation::find($id);
          $user->Certificate_list = $request->get('Certificatelist');
          $user->Authorize_list = $request->get('Authorizelist');
          $user->Authorizecase_list = $request->get('Authorizecaselist');
          $user->Purchase_list = $request->get('Purchaselist');
          $user->Promise_list = $request->get('Promiselist');
          $user->Titledeed_list = $request->get('Titledeedlist');
          $user->Terminatebuyer_list = $request->get('Terminatebuyerlist');
          $user->Terminatesupport_list = $request->get('Terminatesupportlist');
          $user->Acceptbuyerandsup_list = $request->get('Acceptbuyerandsuplist');
          $user->Twodue_list = $request->get('Twoduelist');
          $user->AcceptTwodue_list = $request->get('AcceptTwoduelist');
          $user->Confirm_list = $request->get('Confirmlist');
          $user->Accept_list = $request->get('Acceptlist');
        $user->update();
      }
      elseif ($type == 3) {
        $Legiscourt = Legiscourt::where('legislation_id',$id)->first();
          $Legiscourt->fillingdate_court = $request->get('fillingdatecourt');
          $Legiscourt->law_court = $request->get('lawcourt');
          $Legiscourt->bnumber_court = $request->get('bnumbercourt');
          $Legiscourt->rnumber_court = $request->get('rnumbercourt');
          $Legiscourt->capital_court = $request->get('capitalcourt');
          $Legiscourt->indictment_court = $request->get('indictmentcourt');
          $Legiscourt->pricelawyer_court = $request->get('pricelawyercourt');
          $Legiscourt->examiday_court = $request->get('examidaycourt');
          $Legiscourt->fuzzy_court = $request->get('fuzzycourt');
          $Legiscourt->examinote_court = $request->get('examinotecourt');
          $Legiscourt->orderday_court = $request->get('orderdaycourt');
          $Legiscourt->ordersend_court = $request->get('ordersendcourt');
          $Legiscourt->checkday_court = $request->get('checkdaycourt');
          $Legiscourt->checksend_court = $request->get('checksendcourt');
          $Legiscourt->buyer_court = $request->get('buyercourt');
          $Legiscourt->support_court = $request->get('supportcourt');
          $Legiscourt->note_court = $request->get('notecourt');
          $Legiscourt->social_flag = $request->get('socialflag');
          $Legiscourt->setoffice_court = $request->get('setofficecourt');
          $Legiscourt->sendoffice_court = $request->get('sendofficecourt');
          $Legiscourt->checkresults_court = $request->get('checkresultscourt');
          $Legiscourt->sendcheckresults_court = $request->get('sendcheckresultscourt');
          $Legiscourt->received_court = $request->get('radio-receivedflag');
          $Legiscourt->telresults_court = $request->get('telresultscourt');
          $Legiscourt->dayresults_court = $request->get('dayresultscourt');
          $Legiscourt->propertied_court = $request->get('radio-propertied');
          $Legiscourt->sequester_court = $request->get('sequestercourt');
          $Legiscourt->sendsequester_court = $request->get('sendsequestercourt');
        $Legiscourt->update();
      }
      elseif ($type == 11) {
        $Legiscourt = Legiscourt::where('legislation_id',$id)->first();
        $Legiscourt->latitude_court = $request->get('latitude');
        $Legiscourt->longitude_court = $request->get('longitude');
        $Legiscourt->update();

        if ($request->hasFile('file_image')) {
        $image_array = $request->file('file_image');
        $array_len = count($image_array);
        // dd($array_len);
        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          $destination_path = public_path('/upload-image');
          $image_array[$i]->move($destination_path,$image_new_name);

          $Uploaddb = new LegisImage([
            'legisImage_id' => $id,
            'name_image' => $image_new_name,
            'size_image' => $image_size,
          ]);
          // dd($Uploaddb);
          $Uploaddb ->save();
        }
       }
      }
        // return redirect()->Route('legislation.edit',$id,2)->with('success','อัพเดตข้อมูลเรียบร้อย');
        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
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
