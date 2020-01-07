<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\data_car;
use App\checkDocument;
use Carbon\Carbon;
use PDF;

class DatacarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $fdate = '';
      $tdate = '';
      $carType = '';

      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }
      if ($request->has('carType')) {
        $carType = $request->get('carType');
      }

      // dd($fdate);
      if ($request->type == 1) {
          if ($request->has('carType') != Null) {
            $data = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                        return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                      })
                      ->when(!empty($carType), function($q) use($carType){
                        return $q->where('data_cars.car_type',$carType);
                      })
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();

          }else {
            $data = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                        return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                      })
                      ->where('data_cars.car_type','<>',6)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
          }
        $title = 'รถยนต์ทั้งหมด';
      }
      elseif ($request->type == 2) {          //รถยนต์ระหว่างทำสี
        $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.car_type','=',2)
                    ->orderBy('data_cars.create_date', 'ASC')
                    ->get();
        $title = 'รถยนต์ระหว่างทำสี';
      }
      elseif ($request->type == 3) {          //รถยนต์รอซ่อม
        $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.car_type','=',3)
                    ->orderBy('data_cars.create_date', 'ASC')
                    ->get();
        $title = 'รถยนต์รอซ่อม';
      }
      elseif ($request->type == 4) {          //รถยนต์ระหว่างซ่อม
        $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.car_type','=',4)
                    ->orderBy('data_cars.create_date', 'ASC')
                    ->get();
        $title = 'รถยนต์ระหว่างซ่อม';
      }
      elseif ($request->type == 5) {          //รถยนต์ที่พร้อมขาย
        $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.car_type','=',5)
                    ->orderBy('data_cars.create_date', 'ASC')
                    ->get();
        $title = 'รถยนต์ที่พร้อมขาย';
      }
      elseif ($request->type == 6) {          //รถยนต์ที่ขายแล้ว
        $data = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
                             })
                      ->where('data_cars.car_type','=',6)
                      ->orderBy('data_cars.Date_Soldout_plus', 'ASC')
                      ->get();
        $title = 'รถยนต์ที่ขายแล้ว';
      }
      elseif ($request->type == 7) {          //รถยนต์นำเข้าใหม่
        $data = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                             })
                      ->where('data_cars.car_type','=',1)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
        $title = 'รถยนต์นำเข้าใหม่';
      }
      elseif ($request->type == 8) {          //รถยืมใช้
        $data = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                             })
                      ->where('data_cars.BorrowStatus','=','1')
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
        $title = 'รถยืมใช้';
      }
      elseif ($request->type == 11) {
        $data1 = data_car::count(); //รถในสต็อกทั้งหมด
        $data2 = data_car::where('car_type', '=', 2 )->count(); //ระหว่างทำสี
        $data3 = data_car::where('car_type', '=', 3 )->count(); //รอซ่อม
        $data4 = data_car::where('car_type', '=', 4 )->count(); //ระหว่างซ่อม
        $data5 = data_car::where('car_type', '=', 5 )->count(); //พร้อมขาย
        $data6 = data_car::where('car_type', '=', 6 )->count(); //ขายแล้ว

        $type = $request->type;
        return view('homecar.home', compact('data1', 'data2', 'data3', 'data4', 'data5', 'data6','type'));

      }
      $type = $request->type;
      // dd($type);
      return view('homecar.view', compact('data','title','type','fdate','tdate','carType'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        $title = '';
        $type = $request->type;
        return view('homecar.create', compact('title','type'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'DateCar' => 'required',
          'PriceCar' => 'required',
          'BrandCar' => 'required',
          'Number_Regist' => 'required|unique:data_cars',
          'OriginCar' => 'required'
        ]);  /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */
        $SetPriceStr = str_replace (",","",$request->get('PriceCar'));
        // dd($SetPriceStr);
        $SetOfferStr = str_replace (",","",$request->get('OfferPrice'));
        if ($SetOfferStr == "") {
          $SetOfferStr = $request->get('OfferPrice');
        }
          $SetDateCar = str_replace ("/","-",$request->get('DateCar'));
          $dateConvert0 = date_create($SetDateCar);
          $DateCar = date_format($dateConvert0, 'Y-m-d');
          if($request->get('AccountingCost') != Null){
            $SetAccountingCost = str_replace (",","",$request->get('AccountingCost'));
          }else{
            $SetAccountingCost = Null;
          }

          // dd($date1);
        $datacardb = new data_car([
          'create_date' => $DateCar,
          'Fisrt_Price' => $SetPriceStr,
          'Offer_Price' => $SetOfferStr,
          'Brand_Car' => $request->get('BrandCar'),
          'Number_Tank' => $request->get('Number_Tank'),
          'Version_Car' => $request->get('VersionCar'),
          'Number_Machine' => $request->get('Number_Machine'),
          'Model_Car' => $request->get('ModelCar'),
          'Number_Miles' => $request->get('MilesCar'),
          'Color_Car' => $request->get('ColorCar'),
          'Gearcar' => $request->get('Gearcar'),
          'Year_Product' => $request->get('YearCar'),
          'Size_Car' => $request->get('SizeCar'),
          'Number_Regist' => $request->get('Number_Regist'),
          'Job_Number' => $request->get('JobCar'),
          'Name_Sale' => $request->get('SaleCar'),
          'Origin_Car' => $request->get('OriginCar'),
          'Car_type' => $request->get('Cartype'),
          'Date_Status' => $DateCar,
          'Accounting_Cost' => $SetAccountingCost,
        ]);
        // dd($datacardb);
        $datacardb->save();
        if ($request->get('DateNumberUser') != "") {
          $SetDateNumberUser = $request->get('DateNumberUser');
        }elseif ($request->get('DateNumberUserHidden') != "") {
          $SetDateNumberUser = $request->get('DateNumberUserHidden');
        }
        else {
          $SetDateNumberUser = null;
        }
        if ($request->get('DateExpire') != "") {
          $SetDateExpire = $request->get('DateExpire');
        }elseif ($request->get('DateExpireHidden') != "") {
          $SetDateExpire = $request->get('DateExpireHidden');
        }
        else {
          $SetDateExpire = null;
        }
        $checkDoc = new checkDocument([
          'Datacar_id' => $datacardb->id,
          'Contracts_Car' => $request->get('ContractsCar'),
          'Manual_Car' => $request->get('ManualCar'),
          'Act_Car' => $request->get('ActCar'),
          'Insurance_Car' => $request->get('InsuranceCar'),
          'Key_Reserve' => $request->get('KeyReserve'),
          'Expire_Tax' => $request->get('ExpireTax'),
          'Date_NumberUser' => $SetDateNumberUser,
          'Date_Expire' => $SetDateExpire,
          'Check_Note' => $request->get('CheckNote'),
        ]);
        $checkDoc->save();
        // dd($checkDoc);
        $type = 1;
        return redirect()->Route('datacar',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
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
    public function edit($id,Request $request)
    {
        $datacar = DB::table('data_cars')
        ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
        ->where('data_cars.id',$id)->first();
      // dd($datacar);
      $arrayCarType = [
        1 => 'รถยนต์นำเข้าใหม่',
        2 => 'รถยนต์ระหว่างทำสี',
        3 => 'รถยนต์รอซ่อม',
        4 => 'รถยนต์ระหว่างซ่อม',
        5 => 'รถยนต์พร้อมขาย',
        6 => 'รถยนต์ที่ขายแล้ว',
      ];
      $arrayOriginType = [
        1 => 'CKL',
        2 => 'รถประมูล',
        3 => 'รถยึด',
        4 => 'ฝากขาย',
      ];
      $arrayGearcar = [
        'MT' => 'MT',
        'AT' => 'AT',
      ];
      $arrayBrand = [
        'TOYOTA' => 'TOYOTA',
        'MAZDA' => 'MAZDA',
        'NISSAN' => 'NISSAN',
        'FORD' => 'FORD',
        'MITSUBISHI' => 'MITSUBISHI',
        'ISUZU' => 'ISUZU',
        'HONDA' => 'HONDA',
        'CHEVROLET' => 'CHEVROLET',
        'SUZUKI' => 'SUZUKI',
        'MG' => 'MG',
      ];
      $arrayModel = [
        'เก๋ง' => 'เก๋ง',
        'cab' => 'cab',
        'Hi 4Dr' => 'Hi 4Dr',
        'Hi Cab' => 'Hi Cab',
        'Hi 4WD' => 'Hi 4WD',
        'STD' => 'STD',
        '4DR' => '4DR',
        'Van' => 'Van',
        'Van 4WD' => 'Van 4WD',
      ];
      $arrayTypeSale = [
        'ประมูล' => 'ประมูล',
        'ขายตัด' => 'ขายตัด',
        'ขายสด' => 'ขายสด',
        'ขายผ่อน' => 'ขายผ่อน',
      ];
      $arrayTypeSale = [
        'ประมูล' => 'ประมูล',
        'ขายตัด' => 'ขายตัด',
        'ขายสด' => 'ขายสด',
        'ขายผ่อน' => 'ขายผ่อน',
      ];
      $arrayBorrowStatus = [
        NULL => '',
        1 => 'ยืม',
        2 => 'คืนแล้ว',
      ];
      // }
      $setcarType = $request->car_type;
      // dd($setcarType);
      if ($request->car_type == 6) {
        // dd('sdsad');
        return view('homecar.buyinfo',compact('datacar','id','arrayCarType','setcarType', 'arrayTypeSale','arrayBorrowStatus'));
      }else {
        // code...
        return view('homecar.edit',compact('datacar','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','arrayBorrowStatus'));
      }
    }
    public function viewsee(Request $request, $id)
    {
      //$datacar = data_car::find($id);
      // dd($id);
      $datacar = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.id',$id)->first();
      // dd($datacar);
      $title = '';
      $arrayCarType = [
        1 => 'รถยนต์นำเข้าใหม่',
        2 => 'รถยนต์ระหว่างทำสี',
        3 => 'รถยนต์รอซ่อม',
        4 => 'รถยนต์ระหว่างซ่อม',
        5 => 'รถยนต์พร้อมขาย',
        6 => 'รถยนต์ที่ขายแล้ว',
      ];
      $arrayOriginType = [
        1 => 'CKL',
        2 => 'รถประมูล',
        3 => 'รถยึด',
        4 => 'ฝากขาย',
      ];
      $arrayGearcar = [
        'MT' => 'MT',
        'AT' => 'AT',
      ];
      $arrayBrand = [
        'TOYOTA' => 'TOYOTA',
        'MAZDA' => 'MAZDA',
        'NISSAN' => 'NISSAN',
        'FORD' => 'FORD',
        'MITSUBISHI' => 'MITSUBISHI',
        'ISUZU' => 'ISUZU',
        'HONDA' => 'HONDA',
        'CHEVROLET' => 'CHEVROLET',
        'SUZUKI' => 'SUZUKI',
        'MG' => 'MG',
      ];
      $arrayModel = [
        'เก๋ง' => 'เก๋ง',
        'cab' => 'cab',
        'Hi 4Dr' => 'Hi 4Dr',
        'Hi Cab' => 'Hi Cab',
        'Hi 4WD' => 'Hi 4WD',
        'STD' => 'STD',
        '4DR' => '4DR',
        'Van' => 'Van',
        'Van 4WD' => 'Van 4WD',
      ];
      $arrayTypeSale = [
        'ประมูล' => 'ประมูล',
        'ขายตัด' => 'ขายตัด',
        'ขายสด' => 'ขายสด',
        'ขายผ่อน' => 'ขายผ่อน',
      ];
      $arrayTypeSale = [
        'ประมูล' => 'ประมูล',
        'ขายตัด' => 'ขายตัด',
        'ขายสด' => 'ขายสด',
        'ขายผ่อน' => 'ขายผ่อน',
      ];
      $arrayBorrowStatus = [
        NULL => '',
        1 => 'ยืม',
        2 => 'คืนแล้ว',
      ];
      $setcarType = $request->car_type;
      return view('homecar.viewsee',compact('datacar','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','setcarType', 'arrayTypeSale','arrayBorrowStatus'));
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
        $this->validate($request,[
        'DateCar' => 'required',
        'PriceCar' => 'required',
        'BrandCar' => 'required',
        'RegistCar' => 'required']);  /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */
      $user = data_car::find($id);
      // dd($id);
      $user->create_date = $request->get('DateCar');
      $user->Date_Status = $request->get('DateCar');
      $SetPriceStr = str_replace (",","",$request->get('PriceCar'));
      $user->Fisrt_Price = $SetPriceStr;
      $SetRepairStr = str_replace (",","",$request->get('RepairCar'));
      $user->Repair_Price = $SetRepairStr;
      $SetNetStr = str_replace (",","",$request->get('NetCar'));
      $user->Net_Price = $SetNetStr;
      $user->Brand_Car = $request->get('BrandCar');
      $user->Version_Car = $request->get('VersionCar');
      $user->Model_Car = $request->get('ModelCar');
      $user->Number_Miles = $request->get('MilesCar');
      $user->Color_Car = $request->get('ColorCar');
      $user->Gearcar = $request->get('Gearcar');
      $user->Year_Product = $request->get('YearCar');
      $user->Size_Car = $request->get('SizeCar');
      $user->Number_Regist = $request->get('RegistCar');
      $user->Job_Number = $request->get('JobCar');
      if($request->get('AccountingCost') != Null){
        $SetAccountingCost = str_replace (",","",$request->get('AccountingCost'));
      }else{
        $SetAccountingCost = Null;
      }
      $user->Accounting_Cost = $SetAccountingCost;
      $user->Name_Sale = $request->get('SaleCar');
      $user->Origin_Car = $request->get('OriginCar');
      $SetAddPriceStr = str_replace (",","",$request->get('AddPrice'));
      $user->Add_Price = $SetAddPriceStr;
      //$user->Add_Price = $request->get('AddPrice');
      $SetOfferStr = str_replace (",","",$request->get('OfferPrice'));
      $user->Offer_Price = $SetOfferStr;
      $SetColorStr = str_replace (",","",$request->get('ColorPrice'));

      $user->Date_Borrowcar = $request->get('DateBorrowcar');
      $user->Date_Returncar = $request->get('DateReturncar');
      $user->Name_Borrow = $request->get('NameBorrow');
      $user->Note_Borrow = $request->get('NoteBorrow');
      $user->BorrowStatus = $request->get('BorrowStatus');

      $user->Color_Price = $SetColorStr;
      if ($request->get('Cartype') != Null && $request->get('Cartype') != $user->Car_type ) {
           //$request->get('Cartype') มีค่า และไม่เท่ากับค่าเดิม
           date_default_timezone_set('Asia/Bangkok');
           $Y = date('Y') + 543;
           $m = date('m');
           $d = date('d');
           $date = $Y.'-'.$m.'-'.$d;
        if ($request->get('Cartype') == 2) {
          $user->Date_Color = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 3) {
          $user->Date_Wait = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 4) {
          $user->Date_Repair = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 5) {
          $user->Date_Sale = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 6) {
          $user->Date_Soldout = $date;
          $user->Date_Status = $date;
        }
      }
        $user->Car_type = $request->get('Cartype');
        $user->update();
        $type = $user->Car_type;  //Get ค่าใหม่
        $checkeditDoc = checkDocument::where('Datacar_id',$id)->first();
        // dd($checkeditDoc);
        $checkeditDoc->Contracts_Car = $request->get('ContractsCar');
        $checkeditDoc->Manual_Car = $request->get('ManualCar');
        $checkeditDoc->Act_Car = $request->get('ActCar');
        $checkeditDoc->Insurance_Car = $request->get('InsuranceCar');
        $checkeditDoc->Key_Reserve = $request->get('KeyReserve');
        $checkeditDoc->Check_Note = $request->get('CheckNote');
        if ($request->get('DateNumberUser') != "") {
          $SetDateNumberUser = $request->get('DateNumberUser');
        }elseif ($request->get('DateNumberUserHidden') != "") {
          $SetDateNumberUser = $request->get('DateNumberUserHidden');
        }
        else {
          $SetDateNumberUser = null;
        }
        if ($request->get('DateExpire') != "") {
          $SetDateExpire = $request->get('DateExpire');
        }elseif ($request->get('DateExpireHidden') != "") {
          $SetDateExpire = $request->get('DateExpireHidden');
        }
        else {
          $SetDateExpire = null;
        }
        $checkeditDoc->Date_NumberUser = $SetDateNumberUser;
        $checkeditDoc->Date_Expire = $SetDateExpire;
        $checkeditDoc->Expire_Tax = $request->get('ExpireTax');
        $checkeditDoc->update();

      return redirect()->Route('datacar',$type)->with('success','อัพเดตข้อมูลเรียบร้อย');
    }
    public function updateinfo(Request $request, $id)
    {
      /**required =ตรวจสอบ,จำเป็นต้องป้อนข้อมูล */
      // dd($id);
      $user = data_car::find($id);
      $user->Date_Soldout_plus = $request->get('DateSoldoutplus');
      $user->Date_Withdraw = $request->get('DateWithdraw');


      if($request->get('NetPriceplus') != "") {
        $SetNetPriceplus = str_replace (",","",$request->get('NetPriceplus'));
        $user->Net_Priceplus = $SetNetPriceplus;
      }
      else{
        $user->Net_Priceplus = Null;
      }

      if($request->get('AmountPrice') != "") {
          $SetAmountPrice = str_replace (",","",$request->get('AmountPrice'));
          $user->Amount_Price = $SetAmountPrice;
        }
      else{
        $user->Amount_Price = Null;
      }

      $user->Name_Saleplus = $request->get('NameSaleplus');
      $user->Type_Sale = $request->get('TypeSale');
      $user->Name_Agent = $request->get('NameAgent');
      $user->Name_Buyer = $request->get('NameBuyer');
      $user->update();
      $type = $user->Car_type;  //Get ค่าใหม่
      return redirect()->Route('datacar',$type)->with('success','อัพเดตข้อมูลเรียบร้อย');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = data_car::find($id);
      $item2 = checkDocument::where('Datacar_id',$id);
      $item->Delete();
      $item2->Delete();
      // $item = DB::table('data_cars')
      //               ->leftJoin('check_documents','data_cars.id','=','check_documents.Datacar_id')
      //               ->where('data_cars.id',$id)
      //               ->delete();
      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
    public function ReportPDFIndex(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y')+543;
      $m = date('m');
      $d = date('d');
      $date = $d.'-'.$m.'-'.$Y;

      $fdate = '';
      $tdate = '';
      $carType = '';

      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }
      if ($request->has('carType')) {
        $carType = $request->get('carType');
      }

      if ($request->id == 1) {
        if ($carType != Null) {
          $dataReport = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
          })
          ->when(!empty($carType), function($q) use($carType){
            return $q->where('data_cars.car_type',$carType);
          })
          ->orderBy('data_cars.create_date', 'ASC')
          ->get();
          dd($dataReport);
        }else {
          $dataReport = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
          })
          ->where('data_cars.car_type','<>',6)
          ->orderBy('data_cars.create_date', 'ASC')
          ->get();
        }

        $SetConn = "StockCAR ".$date;

        $ReportType = $request->id;
        if ($request->has('admin')) {
          $AdminType = $request->get('admin');
        }else{
          $AdminType = '0';
        }

        $ReportType = $request->id;
        $view = \View::make('homecar.export' ,compact(['dataReport','ReportType', 'AdminType']));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายการรถยนต์ทั้งหมด');
        $pdf::AddPage('L', 'A4');
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output($SetConn.'.pdf');
      }
      elseif ($request->id == 6) {
        $dataReport = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
                             })
                     ->where('data_cars.car_type','=',6)
                     ->orderBy('data_cars.Date_Soldout_plus', 'ASC')
                     ->get();

        $ReportType = $request->id;
        $view = \View::make('homecar.export' ,compact(['dataReport','ReportType']));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายการรถยนต์ที่ขายแล้ว');
        $pdf::AddPage('L', 'A4');
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
    }
    public function ReportPDF(Request $request)
    {
      $dataReport = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->where('data_cars.car_type','=',$request->id)
                    ->orderBy('data_cars.create_date', 'ASC')->get();
      $ReportType = $request->id;
      // dd($dataReport);
      $view = \View::make('homecar.export' ,compact(['dataReport','ReportType']));
      $html = $view->render();
      $pdf = new PDF();
      $pdf::SetTitle('รายการรถยนต์ พร้อมขาย');
      $pdf::AddPage('L', 'A4');
      $pdf::SetFont('freeserif');
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }
}
