<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Connectdb2;
use App\DataIBM;
use DB;

use App\Buyer;
use App\Sponsor;
use App\Cardetail;
use App\homecardetail;
use App\Expenses;
use App\Holdcar;
use App\data_car;
use App\checkDocument;

use App\Micro_Ploan;
use App\MP_Datacar;
use App\MP_Sponsor;
use App\MP_Sponsor2;
use App\MP_Expense;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($name, Request $request)
    {
        // dump($request->Dashboard);
        // dd($request);

        if($request->all == 'Y'){
            $newfdate = '';
            $newtdate = '';
        }else{
            $newfdate = date('Y-m-01');
            $newtdate = date('Y-m-d');
        }

        if ($request->has('Fromdate')) {
         $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
         $newtdate = $request->get('Todate');
        }

        //ข้อมูลเช่าซื้อ
        $data = DB::table('buyers')
              ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
              ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
              ->join('expenses','buyers.id','=','expenses.Buyerexpenses_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('cardetails.StatusApp_car','=', 'อนุมัติ')
              ->where('buyers.Contract_buyer','not like', '22%')
              ->where('buyers.Contract_buyer','not like', '33%')
              ->get();

        //ข้อมูลรถบ้าน
        $dataHomecar = DB::table('buyers')
              ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
              ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('buyers.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('homecardetails.statusapp_HC', '=', 'อนุมัติ')
              ->get();

        //ข้อมูลเงินกู้ ploan
        $dataPloan = DB::table('MP_Datas')
              ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datacars.StatusApp_car','=', 'อนุมัติ')
              ->where('MP_Datas.Type_Con','=','P03')
              ->get();

        //ข้อมูลเงินกู้ Motor
        $dataMotor = DB::table('MP_Datas')
              ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datacars.StatusApp_car','=', 'อนุมัติ')
              ->where('MP_Datas.Type_Con','=','P04')
              ->get();

        //ข้อมูลเงินกู้ Micro
        $dataMicro = DB::table('MP_Datas')
              ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datacars.StatusApp_car','=', 'อนุมัติ')
              ->where('MP_Datas.Type_Con','=','P06')
              ->get();

        //ข้อมูลเงินกู้ พนักงาน
        $dataStaff = DB::table('MP_Datas')
              ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datacars.StatusApp_car','=', 'อนุมัติ')
              ->where('MP_Datas.Type_Con','=','P07')
              ->get();

        
        if ($data != NULL) {
            $Leasing01 = 0;
            $Leasing03 = 0;
            $Leasing04 = 0;
            $Leasing05 = 0;
            $Leasing06 = 0;
            $Leasing07 = 0;
            $Leasing08 = 0;
            $Leasing09 = 0;
            $Leasing12 = 0;
            $Leasing13 = 0;
            $Leasing14 = 0;
            $SumLeasingAll = 0;
            $Topcar_Leasing01 = 0;
            $Topcar_Leasing03 = 0;
            $Topcar_Leasing04 = 0;
            $Topcar_Leasing05 = 0;
            $Topcar_Leasing06 = 0;
            $Topcar_Leasing07 = 0;
            $Topcar_Leasing08 = 0;
            $Topcar_Leasing09 = 0;
            $Topcar_Leasing12 = 0;
            $Topcar_Leasing13 = 0;
            $Topcar_Leasing14 = 0;
            $SumTopcar_LeasingAll = 0;
            foreach ($data as $key => $value) {
                if ($value->branch_car == 'ปัตตานี') {
                    $Leasing01 += 1;
                    $Topcar_Leasing01 += $value->Top_car;
                }elseif ($value->branch_car == 'ยะลา') {
                    $Leasing03 += 1;
                    $Topcar_Leasing03 += $value->Top_car;
                }elseif ($value->branch_car == 'นราธิวาส') {
                    $Leasing04 += 1;
                    $Topcar_Leasing04 += $value->Top_car;
                }elseif ($value->branch_car == 'สายบุรี') {
                    $Leasing05 += 1;
                    $Topcar_Leasing05 += $value->Top_car;
                }elseif ($value->branch_car == 'โกลก') {
                    $Leasing06 += 1;
                    $Topcar_Leasing06 += $value->Top_car;
                }elseif ($value->branch_car == 'เบตง') {
                    $Leasing07 += 1;
                    $Topcar_Leasing07 += $value->Top_car;
                }elseif ($value->branch_car == 'โคกโพธิ์') {
                    $Leasing08 += 1;
                    $Topcar_Leasing08 = $value->Top_car;
                }elseif ($value->branch_car == 'ตันหยงมัส') {
                    $Leasing09 += 1;
                    $Topcar_Leasing09 += $value->Top_car;
                }elseif ($value->branch_car == 'รือเสาะ') {
                    $Leasing12 += 1;
                    $Topcar_Leasing12 += $value->Top_car;
                }elseif ($value->branch_car == 'บันนังสตา') {
                    $Leasing13 += 1;
                    $Topcar_Leasing13 += $value->Top_car;
                }elseif ($value->branch_car == 'ยะหา') {
                    $Leasing14 += 1;
                    $Topcar_Leasing14 += $value->Top_car;
                }
            }
            $SumLeasingAll = $Leasing01 + $Leasing03 + $Leasing04 + $Leasing05 + $Leasing06 + $Leasing07 + $Leasing08 + $Leasing09 + $Leasing12 + $Leasing13 + $Leasing14;
            $SumTopcar_LeasingAll = $Topcar_Leasing01 + $Topcar_Leasing03 + $Topcar_Leasing04 + $Topcar_Leasing05 + $Topcar_Leasing06 + $Topcar_Leasing07 + $Topcar_Leasing08 + $Topcar_Leasing09 + $Topcar_Leasing12 + $Topcar_Leasing13 + $Topcar_Leasing14;
        }

        if ($dataHomecar != NULL) {
            $Homecar10 = 0;
            $Homecar11 = 0;
            $SumHomecarAll = 0;
            $Topcar_Homecar10 = 0;
            $Topcar_Homecar11 = 0;
            $SumTopcar_HomecarAll = 0;
            foreach ($dataHomecar as $key => $value1) {
                if ($value1->branchUS_HC == 'รถบ้าน') {
                    $Homecar10 += 1;
                    $Topcar_Homecar10 += str_replace(",","",$value1->topprice_HC);
                }elseif ($value1->branchUS_HC == 'รถยืดขายผ่อน') {
                    $Homecar11 += 1;
                    $Topcar_Homecar11 += str_replace(",","",$value1->topprice_HC);
                }
            }
            $SumHomecarAll = $Homecar10 + $Homecar11;
            $SumTopcar_HomecarAll = $Topcar_Homecar10 + $Topcar_Homecar11;
        }

        if ($dataPloan != NULL) {
            $Ploan50 = 0;
            $Ploan51 = 0;
            $Ploan52 = 0;
            $Ploan53 = 0;
            $Ploan54 = 0;
            $Ploan55 = 0;
            $Ploan56 = 0;
            $Ploan57 = 0;
            $Ploan58 = 0;
            $Ploan59 = 0;
            $Ploan60 = 0;
            $SumPloanAll = 0;
            $Topcar_Ploan50 = 0;
            $Topcar_Ploan51 = 0;
            $Topcar_Ploan52 = 0;
            $Topcar_Ploan53 = 0;
            $Topcar_Ploan54 = 0;
            $Topcar_Ploan55 = 0;
            $Topcar_Ploan56 = 0;
            $Topcar_Ploan57 = 0;
            $Topcar_Ploan58 = 0;
            $Topcar_Ploan59 = 0;
            $Topcar_Ploan60 = 0;
            $SumTopcar_PloanAll = 0;
            foreach ($dataPloan as $key => $value2) {
                if ($value2->branch_car == 'ปัตตานี') {
                    $Ploan50 += 1;
                    $Topcar_Ploan50 += $value2->Top_car;
                }elseif ($value2->branch_car == 'ยะลา') {
                    $Ploan51 += 1;
                    $Topcar_Ploan51 += $value2->Top_car;
                }elseif ($value2->branch_car == 'นราธิวาส') {
                    $Ploan52 += 1;
                    $Topcar_Ploan52 += $value2->Top_car;
                }elseif ($value2->branch_car == 'สายบุรี') {
                    $Ploan53 += 1;
                    $Topcar_Ploan53 += $value2->Top_car;
                }elseif ($value2->branch_car == 'โกลก') {
                    $Ploan54 += 1;
                    $Topcar_Ploan54 += $value2->Top_car;
                }elseif ($value2->branch_car == 'เบตง') {
                    $Ploan55 += 1;
                    $Topcar_Ploan55 += $value2->Top_car;
                }elseif ($value2->branch_car == 'โคกโพธิ์') {
                    $Ploan56 += 1;
                    $Topcar_Ploan56 += $value2->Top_car;
                }elseif ($value2->branch_car == 'ตันหยงมัส') {
                    $Ploan57 += 1;
                    $Topcar_Ploan57 += $value2->Top_car;
                }elseif ($value2->branch_car == 'รือเสาะ') {
                    $Ploan58 += 1;
                    $Topcar_Ploan58 += $value2->Top_car;
                }elseif ($value2->branch_car == 'บันนังสตา') {
                    $Ploan59 += 1;
                    $Topcar_Ploan59 += $value2->Top_car;
                }elseif ($value2->branch_car == 'ยะหา') {
                    $Ploan60 += 1;
                    $Topcar_Ploan60 += $value2->Top_car;
                }
            }
            $SumPloanAll = $Ploan50 + $Ploan51 + $Ploan52 + $Ploan53 + $Ploan54 + $Ploan55 + $Ploan56 + $Ploan57 + $Ploan58 + $Ploan59 + $Ploan60;
            $SumTopcar_PloanAll = $Topcar_Ploan50 + $Topcar_Ploan51 + $Topcar_Ploan52 + $Topcar_Ploan53 + $Topcar_Ploan54 + $Topcar_Ploan55 + $Topcar_Ploan56 + $Topcar_Ploan57 + $Topcar_Ploan58 + $Topcar_Ploan59 + $Topcar_Ploan60;
        }

        if ($dataMotor != NULL) {
            $Motor50 = 0;
            $Motor51 = 0;
            $Motor52 = 0;
            $Motor53 = 0;
            $Motor54 = 0;
            $Motor55 = 0;
            $Motor56 = 0;
            $Motor57 = 0;
            $Motor58 = 0;
            $Motor59 = 0;
            $Motor60 = 0;
            $SumMotorAll = 0;
            $Topcar_Motor50 = 0;
            $Topcar_Motor51 = 0;
            $Topcar_Motor52 = 0;
            $Topcar_Motor53 = 0;
            $Topcar_Motor54 = 0;
            $Topcar_Motor55 = 0;
            $Topcar_Motor56 = 0;
            $Topcar_Motor57 = 0;
            $Topcar_Motor58 = 0;
            $Topcar_Motor59 = 0;
            $Topcar_Motor60 = 0;
            $SumTopcar_MotorAll = 0;
            foreach ($dataMotor as $key => $value3) {
            if ($value3->branch_car == 'ปัตตานี') {
                $Motor50 += 1;
                $Topcar_Motor50 += $value3->Top_car;
            }elseif ($value3->branch_car == 'ยะลา') {
                $Motor51 += 1;
                $Topcar_Motor51 += $value3->Top_car;
            }elseif ($value3->branch_car == 'นราธิวาส') {
                $Motor52 += 1;
                $Topcar_Motor52 += $value3->Top_car;
            }elseif ($value3->branch_car == 'สายบุรี') {
                $Motor53 += 1;
                $Topcar_Motor53 += $value3->Top_car;
            }elseif ($value3->branch_car == 'โกลก') {
                $Motor54 += 1;
                $Topcar_Motor54 += $value3->Top_car;
            }elseif ($value3->branch_car == 'เบตง') {
                $Motor55 += 1;
                $Topcar_Motor55 += $value3->Top_car;
            }elseif ($value3->branch_car == 'โคกโพธิ์') {
                $Motor56 += 1;
                $Topcar_Motor56 += $value3->Top_car;
            }elseif ($value3->branch_car == 'ตันหยงมัส') {
                $Motor57 += 1;
                $Topcar_Motor57 += $value3->Top_car;
            }elseif ($value3->branch_car == 'รือเสาะ') {
                $Motor58 += 1;
                $Topcar_Motor58 += $value3->Top_car;
            }elseif ($value3->branch_car == 'บันนังสตา') {
                $Motor59 += 1;
                $Topcar_Motor59 += $value3->Top_car;
            }elseif ($value3->branch_car == 'ยะหา') {
                $Motor60 += 1;
                $Topcar_Motor60 += $value3->Top_car;
            }
            }
            $SumMotorAll = $Motor50 + $Motor51 + $Motor52 + $Motor53 + $Motor54 + $Motor55 + $Motor56 + $Motor57 + $Motor58 + $Motor59 + $Motor60;
            $SumTopcar_MotorAll = $Topcar_Motor50 + $Topcar_Motor51 + $Topcar_Motor52 + $Topcar_Motor53 + $Topcar_Motor54 + $Topcar_Motor55 + $Topcar_Motor56 + $Topcar_Motor57 + $Topcar_Motor58 + $Topcar_Motor59 + $Topcar_Motor60;
        }

        if ($dataMicro != NULL) {
            $Micro50 = 0;
            $Micro51 = 0;
            $Micro52 = 0;
            $Micro53 = 0;
            $Micro54 = 0;
            $Micro55 = 0;
            $Micro56 = 0;
            $Micro57 = 0;
            $Micro58 = 0;
            $Micro59 = 0;
            $Micro60 = 0;
            $SumMicroAll = 0;
            $Topcar_Micro50 = 0;
            $Topcar_Micro51 = 0;
            $Topcar_Micro52 = 0;
            $Topcar_Micro53 = 0;
            $Topcar_Micro54 = 0;
            $Topcar_Micro55 = 0;
            $Topcar_Micro56 = 0;
            $Topcar_Micro57 = 0;
            $Topcar_Micro58 = 0;
            $Topcar_Micro59 = 0;
            $Topcar_Micro60 = 0;
            $SumTopcar_MicroAll = 0;
            foreach ($dataMicro as $key => $value4) {
            if ($value4->branch_car == 'ปัตตานี') {
                $Micro50 += 1;
                $Topcar_Micro50 += $value4->Top_car;
            }elseif ($value4->branch_car == 'ยะลา') {
                $Micro51 += 1;
                $Topcar_Micro51 += $value4->Top_car;
            }elseif ($value4->branch_car == 'นราธิวาส') {
                $Micro52 += 1;
                $Topcar_Micro52 += $value4->Top_car;
            }elseif ($value4->branch_car == 'สายบุรี') {
                $Micro53 += 1;
                $Topcar_Micro53 += $value4->Top_car;
            }elseif ($value4->branch_car == 'โกลก') {
                $Micro54 += 1;
                $Topcar_Micro54 += $value4->Top_car;
            }elseif ($value4->branch_car == 'เบตง') {
                $Micro55 += 1;
                $Topcar_Micro55 += $value4->Top_car;
            }elseif ($value4->branch_car == 'โคกโพธิ์') {
                $Micro56 += 1;
                $Topcar_Micro56 += $value4->Top_car;
            }elseif ($value4->branch_car == 'ตันหยงมัส') {
                $Micro57 += 1;
                $Topcar_Micro57 += $value4->Top_car;
            }elseif ($value4->branch_car == 'รือเสาะ') {
                $Micro58 += 1;
                $Topcar_Micro58 += $value4->Top_car;
            }elseif ($value4->branch_car == 'บันนังสตา') {
                $Micro59 += 1;
                $Topcar_Micro59 += $value4->Top_car;
            }elseif ($value4->branch_car == 'ยะหา') {
                $Micro60 += 1;
                $Topcar_Micro60 += $value4->Top_car;
            }
            }
            $SumMicroAll = $Micro50 + $Micro51 + $Micro52 + $Micro53 + $Micro54 + $Micro55 + $Micro56 + $Micro57 + $Micro58 + $Micro59 + $Micro60;
            $SumTopcar_MicroAll = $Topcar_Micro50 + $Topcar_Micro51 + $Topcar_Micro52 + $Topcar_Micro53 + $Topcar_Micro54 + $Topcar_Micro55 + $Topcar_Micro56 + $Topcar_Micro57 + $Topcar_Micro58 + $Topcar_Micro59 + $Topcar_Micro60;
        }

        if ($dataStaff != NULL) {
            $Staff50 = 0;
            $Staff51 = 0;
            $Staff52 = 0;
            $Staff53 = 0;
            $Staff54 = 0;
            $Staff55 = 0;
            $Staff56 = 0;
            $Staff57 = 0;
            $Staff58 = 0;
            $Staff59 = 0;
            $Staff60 = 0;
            $SumStaffAll = 0;
            $Topcar_Staff50 = 0;
            $Topcar_Staff51 = 0;
            $Topcar_Staff52 = 0;
            $Topcar_Staff53 = 0;
            $Topcar_Staff54 = 0;
            $Topcar_Staff55 = 0;
            $Topcar_Staff56 = 0;
            $Topcar_Staff57 = 0;
            $Topcar_Staff58 = 0;
            $Topcar_Staff59 = 0;
            $Topcar_Staff60 = 0;
            $SumTopcar_StaffAll = 0;
            foreach ($dataStaff as $key => $value5) {
            if ($value5->branch_car == 'ปัตตานี') {
                $Staff50 += 1;
                $Topcar_Staff50 += $value5->Top_car;
            }elseif ($value5->branch_car == 'ยะลา') {
                $Staff51 += 1;
                $Topcar_Staff51 += $value5->Top_car;
            }elseif ($value5->branch_car == 'นราธิวาส') {
                $Staff52 += 1;
                $Topcar_Staff52 += $value5->Top_car;
            }elseif ($value5->branch_car == 'สายบุรี') {
                $Staff53 += 1;
                $Topcar_Staff53 += $value5->Top_car;
            }elseif ($value5->branch_car == 'โกลก') {
                $Staff54 += 1;
                $Topcar_Staff54 += $value5->Top_car;
            }elseif ($value5->branch_car == 'เบตง') {
                $Staff55 += 1;
                $Topcar_Staff55 += $value5->Top_car;
            }elseif ($value5->branch_car == 'โคกโพธิ์') {
                $Staff56 += 1;
                $Topcar_Staff56 += $value5->Top_car;
            }elseif ($value5->branch_car == 'ตันหยงมัส') {
                $Staff57 += 1;
                $Topcar_Staff57 += $value5->Top_car;
            }elseif ($value5->branch_car == 'รือเสาะ') {
                $Staff58 += 1;
                $Topcar_Staff58 += $value5->Top_car;
            }elseif ($value5->branch_car == 'บันนังสตา') {
                $Staff59 += 1;
                $Topcar_Staff59 += $value5->Top_car;
            }elseif ($value5->branch_car == 'ยะหา') {
                $Staff60 += 1;
                $Topcar_Staff60 += $value5->Top_car;
            }
            }
            $SumStaffAll = $Staff50 + $Staff51 + $Staff52 + $Staff53 + $Staff54 + $Staff55 + $Staff56 + $Staff57 + $Staff58 + $Staff59 + $Staff60;
            $SumTopcar_StaffAll = $Topcar_Staff50 + $Topcar_Staff51 + $Topcar_Staff52 + $Topcar_Staff53 + $Topcar_Staff54 + $Topcar_Staff55 + $Topcar_Staff56 + $Topcar_Staff57 + $Topcar_Staff58 + $Topcar_Staff59 + $Topcar_Staff60;
        }

        //แบบจัดต่างๆ
        
        if ($data != NULL) {
            $PN_HaveProperty = 0;
            $PN_NoProperty = 0;
            $PN_NoWarranty = 0;
            $PN_BuyHaveProperty = 0;
            $PN_BuyNoHaveProperty = 0;
            $PN_BuyNoWarranty = 0;
            $PN_VIPowner = 0;
            $PN_VIPbuy = 0;
            $Total_PN = 0;

            $YL_HaveProperty = 0;
            $YL_NoProperty = 0;
            $YL_NoWarranty = 0;
            $YL_BuyHaveProperty = 0;
            $YL_BuyNoHaveProperty = 0;
            $YL_BuyNoWarranty = 0;
            $YL_VIPowner = 0;
            $YL_VIPbuy = 0;
            $Total_YL = 0;

            $NR_HaveProperty = 0;
            $NR_NoProperty = 0;
            $NR_NoWarranty = 0;
            $NR_BuyHaveProperty = 0;
            $NR_BuyNoHaveProperty = 0;
            $NR_BuyNoWarranty = 0;
            $NR_VIPowner = 0;
            $NR_VIPbuy = 0;
            $Total_NR = 0;

            $SB_HaveProperty = 0;
            $SB_NoProperty = 0;
            $SB_NoWarranty = 0;
            $SB_BuyHaveProperty = 0;
            $SB_BuyNoHaveProperty = 0;
            $SB_BuyNoWarranty = 0;
            $SB_VIPowner = 0;
            $SB_VIPbuy = 0;
            $Total_SB = 0;

            $KOL_HaveProperty = 0;
            $KOL_NoProperty = 0;
            $KOL_NoWarranty = 0;
            $KOL_BuyHaveProperty = 0;
            $KOL_BuyNoHaveProperty = 0;
            $KOL_BuyNoWarranty = 0;
            $KOL_VIPowner = 0;
            $KOL_VIPbuy = 0;
            $Total_KOL = 0;

            $BT_HaveProperty = 0;
            $BT_NoProperty = 0;
            $BT_NoWarranty = 0;
            $BT_BuyHaveProperty = 0;
            $BT_BuyNoHaveProperty = 0;
            $BT_BuyNoWarranty = 0;
            $BT_VIPowner = 0;
            $BT_VIPbuy = 0;
            $Total_BT = 0;

            $KP_HaveProperty = 0;
            $KP_NoProperty = 0;
            $KP_NoWarranty = 0;
            $KP_BuyHaveProperty = 0;
            $KP_BuyNoHaveProperty = 0;
            $KP_BuyNoWarranty = 0;
            $KP_VIPowner = 0;
            $KP_VIPbuy = 0;
            $Total_KP = 0;

            $TM_HaveProperty = 0;
            $TM_NoProperty = 0;
            $TM_NoWarranty = 0;
            $TM_BuyHaveProperty = 0;
            $TM_BuyNoHaveProperty = 0;
            $TM_BuyNoWarranty = 0;
            $TM_VIPowner = 0;
            $TM_VIPbuy = 0;
            $Total_TM = 0;

            $RS_HaveProperty = 0;
            $RS_NoProperty = 0;
            $RS_NoWarranty = 0;
            $RS_BuyHaveProperty = 0;
            $RS_BuyNoHaveProperty = 0;
            $RS_BuyNoWarranty = 0;
            $RS_VIPowner = 0;
            $RS_VIPbuy = 0;
            $Total_RS = 0;

            $BNT_HaveProperty = 0;
            $BNT_NoProperty = 0;
            $BNT_NoWarranty = 0;
            $BNT_BuyHaveProperty = 0;
            $BNT_BuyNoHaveProperty = 0;
            $BNT_BuyNoWarranty = 0;
            $BNT_VIPowner = 0;
            $BNT_VIPbuy = 0;
            $Total_BNT = 0;

            $YH_HaveProperty = 0;
            $YH_NoProperty = 0;
            $YH_NoWarranty = 0;
            $YH_BuyHaveProperty = 0;
            $YH_BuyNoHaveProperty = 0;
            $YH_BuyNoWarranty = 0;
            $YH_VIPowner = 0;
            $YH_VIPbuy = 0;
            $Total_YH = 0;

            foreach ($data as $key => $value6) {
                if ($value6->branch_car == 'ปัตตานี') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $PN_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $PN_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $PN_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $PN_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $PN_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $PN_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $PN_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $PN_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'ยะลา') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YL_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YL_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YL_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YL_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YL_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YL_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $YL_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $YL_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'นราธิวาส') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $NR_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $NR_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $NR_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $NR_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $NR_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $NR_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $NR_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $NR_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'สายบุรี') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $SB_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $SB_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $SB_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $SB_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $SB_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $SB_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $SB_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $SB_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'โกลก') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KOL_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KOL_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KOL_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KOL_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $KOL_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $KOL_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'เบตง') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BT_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BT_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BT_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BT_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BT_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BT_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $BT_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $BT_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'โคกโพธิ์') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KP_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KP_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KP_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KP_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KP_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KP_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $KP_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $KP_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'ตันหยงมัส') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $TM_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $TM_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $TM_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $TM_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $TM_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $TM_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $TM_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $TM_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'รือเสาะ') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $RS_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $RS_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $RS_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $RS_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $RS_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $RS_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $RS_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $RS_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'บันนังสตา') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BNT_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BNT_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BNT_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BNT_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $BNT_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $BNT_VIPbuy += 1;
                    }
                }else if ($value6->branch_car == 'ยะหา') {
                    if ($value6->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YH_HaveProperty += 1;
                    }elseif ($value6->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YH_NoProperty += 1;
                    }elseif ($value6->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YH_NoWarranty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YH_BuyHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YH_BuyNoHaveProperty += 1;
                    }elseif ($value6->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YH_BuyNoWarranty += 1;
                    }elseif ($value6->status_car == 'VIP.กรรมสิทธิ์') {
                        $YH_VIPowner += 1;
                    }elseif ($value6->status_car == 'VIP.ซื้อขาย') {
                        $YH_VIPbuy += 1;
                    }
                }
            }

            $Total_PN = $PN_HaveProperty+$PN_NoProperty+$PN_NoWarranty+$PN_BuyHaveProperty+$PN_BuyNoHaveProperty+$PN_BuyNoWarranty+$PN_VIPowner+$PN_VIPbuy;
            $Total_YL = $YL_HaveProperty+$YL_NoProperty+$YL_NoWarranty+$YL_BuyHaveProperty+$YL_BuyNoHaveProperty+$YL_BuyNoWarranty+$YL_VIPowner+$YL_VIPbuy;
            $Total_NR = $NR_HaveProperty+$NR_NoProperty+$NR_NoWarranty+$NR_BuyHaveProperty+$NR_BuyNoHaveProperty+$NR_BuyNoWarranty+$NR_VIPowner+$NR_VIPbuy;
            $Total_SB = $SB_HaveProperty+$SB_NoProperty+$SB_NoWarranty+$SB_BuyHaveProperty+$SB_BuyNoHaveProperty+$SB_BuyNoWarranty+$SB_VIPowner+$SB_VIPbuy;
            $Total_KOL = $KOL_HaveProperty+$KOL_NoProperty+$KOL_NoWarranty+$KOL_BuyHaveProperty+$KOL_BuyNoHaveProperty+$KOL_BuyNoWarranty+$KOL_VIPowner+$KOL_VIPbuy;
            $Total_BT = $BT_HaveProperty+$BT_NoProperty+$BT_NoWarranty+$BT_BuyHaveProperty+$BT_BuyNoHaveProperty+$BT_BuyNoWarranty+$BT_VIPowner+$BT_VIPbuy;
            $Total_KP = $KP_HaveProperty+$KP_NoProperty+$KP_NoWarranty+$KP_BuyHaveProperty+$KP_BuyNoHaveProperty+$KP_BuyNoWarranty+$KP_VIPowner+$KP_VIPbuy;
            $Total_TM = $TM_HaveProperty+$TM_NoProperty+$TM_NoWarranty+$TM_BuyHaveProperty+$TM_BuyNoHaveProperty+$TM_BuyNoWarranty+$TM_VIPowner+$TM_VIPbuy;
            $Total_RS = $RS_HaveProperty+$RS_NoProperty+$RS_NoWarranty+$RS_BuyHaveProperty+$RS_BuyNoHaveProperty+$RS_BuyNoWarranty+$RS_VIPowner+$RS_VIPbuy;
            $Total_BNT = $BNT_HaveProperty+$BNT_NoProperty+$BNT_NoWarranty+$BNT_BuyHaveProperty+$BNT_BuyNoHaveProperty+$BNT_BuyNoWarranty+$BNT_VIPowner+$BNT_VIPbuy;
            $Total_YH = $YH_HaveProperty+$YH_NoProperty+$YH_NoWarranty+$YH_BuyHaveProperty+$YH_BuyNoHaveProperty+$YH_BuyNoWarranty+$YH_VIPowner+$YH_VIPbuy;
        }

        if ($dataPloan != NULL) {
            $PN_Ploan_HaveProperty = 0;
            $PN_Ploan_NoProperty = 0;
            $PN_Ploan_NoWarranty = 0;
            $PN_Ploan_BuyHaveProperty = 0;
            $PN_Ploan_BuyNoHaveProperty = 0;
            $PN_Ploan_BuyNoWarranty = 0;
            $PN_Ploan_VIPowner = 0;
            $PN_Ploan_VIPbuy = 0;
            $Total_PN_Ploan = 0;

            $YL_Ploan_HaveProperty = 0;
            $YL_Ploan_NoProperty = 0;
            $YL_Ploan_NoWarranty = 0;
            $YL_Ploan_BuyHaveProperty = 0;
            $YL_Ploan_BuyNoHaveProperty = 0;
            $YL_Ploan_BuyNoWarranty = 0;
            $YL_Ploan_VIPowner = 0;
            $YL_Ploan_VIPbuy = 0;
            $Total_YL_Ploan = 0;

            $NR_Ploan_HaveProperty = 0;
            $NR_Ploan_NoProperty = 0;
            $NR_Ploan_NoWarranty = 0;
            $NR_Ploan_BuyHaveProperty = 0;
            $NR_Ploan_BuyNoHaveProperty = 0;
            $NR_Ploan_BuyNoWarranty = 0;
            $NR_Ploan_VIPowner = 0;
            $NR_Ploan_VIPbuy = 0;
            $Total_NR_Ploan = 0;

            $SB_Ploan_HaveProperty = 0;
            $SB_Ploan_NoProperty = 0;
            $SB_Ploan_NoWarranty = 0;
            $SB_Ploan_BuyHaveProperty = 0;
            $SB_Ploan_BuyNoHaveProperty = 0;
            $SB_Ploan_BuyNoWarranty = 0;
            $SB_Ploan_VIPowner = 0;
            $SB_Ploan_VIPbuy = 0;
            $Total_SB_Ploan = 0;

            $KOL_Ploan_HaveProperty = 0;
            $KOL_Ploan_NoProperty = 0;
            $KOL_Ploan_NoWarranty = 0;
            $KOL_Ploan_BuyHaveProperty = 0;
            $KOL_Ploan_BuyNoHaveProperty = 0;
            $KOL_Ploan_BuyNoWarranty = 0;
            $KOL_Ploan_VIPowner = 0;
            $KOL_Ploan_VIPbuy = 0;
            $Total_KOL_Ploan = 0;

            $BT_Ploan_HaveProperty = 0;
            $BT_Ploan_NoProperty = 0;
            $BT_Ploan_NoWarranty = 0;
            $BT_Ploan_BuyHaveProperty = 0;
            $BT_Ploan_BuyNoHaveProperty = 0;
            $BT_Ploan_BuyNoWarranty = 0;
            $BT_Ploan_VIPowner = 0;
            $BT_Ploan_VIPbuy = 0;
            $Total_BT_Ploan = 0;

            $KP_Ploan_HaveProperty = 0;
            $KP_Ploan_NoProperty = 0;
            $KP_Ploan_NoWarranty = 0;
            $KP_Ploan_BuyHaveProperty = 0;
            $KP_Ploan_BuyNoHaveProperty = 0;
            $KP_Ploan_BuyNoWarranty = 0;
            $KP_Ploan_VIPowner = 0;
            $KP_Ploan_VIPbuy = 0;
            $Total_KP_Ploan = 0;

            $TM_Ploan_HaveProperty = 0;
            $TM_Ploan_NoProperty = 0;
            $TM_Ploan_NoWarranty = 0;
            $TM_Ploan_BuyHaveProperty = 0;
            $TM_Ploan_BuyNoHaveProperty = 0;
            $TM_Ploan_BuyNoWarranty = 0;
            $TM_Ploan_VIPowner = 0;
            $TM_Ploan_VIPbuy = 0;
            $Total_TM_Ploan = 0;

            $RS_Ploan_HaveProperty = 0;
            $RS_Ploan_NoProperty = 0;
            $RS_Ploan_NoWarranty = 0;
            $RS_Ploan_BuyHaveProperty = 0;
            $RS_Ploan_BuyNoHaveProperty = 0;
            $RS_Ploan_BuyNoWarranty = 0;
            $RS_Ploan_VIPowner = 0;
            $RS_Ploan_VIPbuy = 0;
            $Total_RS_Ploan = 0;

            $BNT_Ploan_HaveProperty = 0;
            $BNT_Ploan_NoProperty = 0;
            $BNT_Ploan_NoWarranty = 0;
            $BNT_Ploan_BuyHaveProperty = 0;
            $BNT_Ploan_BuyNoHaveProperty = 0;
            $BNT_Ploan_BuyNoWarranty = 0;
            $BNT_Ploan_VIPowner = 0;
            $BNT_Ploan_VIPbuy = 0;
            $Total_BNT_Ploan = 0;

            $YH_Ploan_HaveProperty = 0;
            $YH_Ploan_NoProperty = 0;
            $YH_Ploan_NoWarranty = 0;
            $YH_Ploan_BuyHaveProperty = 0;
            $YH_Ploan_BuyNoHaveProperty = 0;
            $YH_Ploan_BuyNoWarranty = 0;
            $YH_Ploan_VIPowner = 0;
            $YH_Ploan_VIPbuy = 0;
            $Total_YH_Ploan = 0;

            foreach ($dataPloan as $key => $value7) {
                if ($value7->branch_car == 'ปัตตานี') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $PN_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $PN_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $PN_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $PN_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $PN_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $PN_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'ยะลา') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YL_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YL_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YL_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YL_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $YL_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $YL_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'นราธิวาส') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $NR_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $NR_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $NR_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $NR_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $NR_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $NR_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'สายบุรี') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $SB_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $SB_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $SB_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $SB_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $SB_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $SB_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'โกลก') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KOL_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KOL_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KOL_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KOL_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $KOL_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $KOL_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'เบตง') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BT_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BT_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BT_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BT_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $BT_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $BT_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'โคกโพธิ์') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KP_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KP_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KP_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KP_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $KP_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $KP_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'ตันหยงมัส') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $TM_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $TM_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $TM_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $TM_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $TM_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $TM_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'รือเสาะ') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $RS_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $RS_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $RS_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $RS_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $RS_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $RS_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'บันนังสตา') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BNT_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BNT_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BNT_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BNT_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $BNT_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $BNT_Ploan_VIPbuy += 1;
                    }
                }else if ($value7->branch_car == 'ยะหา') {
                    if ($value7->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YH_Ploan_HaveProperty += 1;
                    }elseif ($value7->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Ploan_NoProperty += 1;
                    }elseif ($value7->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YH_Ploan_NoWarranty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YH_Ploan_BuyHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Ploan_BuyNoHaveProperty += 1;
                    }elseif ($value7->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YH_Ploan_BuyNoWarranty += 1;
                    }elseif ($value7->status_car == 'VIP.กรรมสิทธิ์') {
                        $YH_Ploan_VIPowner += 1;
                    }elseif ($value7->status_car == 'VIP.ซื้อขาย') {
                        $YH_Ploan_VIPbuy += 1;
                    }
                }
            }

            $Total_PN_Ploan = $PN_Ploan_HaveProperty+$PN_Ploan_NoProperty+$PN_Ploan_NoWarranty+$PN_Ploan_BuyHaveProperty+$PN_Ploan_BuyNoHaveProperty+$PN_Ploan_BuyNoWarranty+$PN_Ploan_VIPowner+$PN_Ploan_VIPbuy;
            $Total_YL_Ploan = $YL_Ploan_HaveProperty+$YL_Ploan_NoProperty+$YL_Ploan_NoWarranty+$YL_Ploan_BuyHaveProperty+$YL_Ploan_BuyNoHaveProperty+$YL_Ploan_BuyNoWarranty+$YL_Ploan_VIPowner+$YL_Ploan_VIPbuy;
            $Total_NR_Ploan = $NR_Ploan_HaveProperty+$NR_Ploan_NoProperty+$NR_Ploan_NoWarranty+$NR_Ploan_BuyHaveProperty+$NR_Ploan_BuyNoHaveProperty+$NR_Ploan_BuyNoWarranty+$NR_Ploan_VIPowner+$NR_Ploan_VIPbuy;
            $Total_SB_Ploan = $SB_Ploan_HaveProperty+$SB_Ploan_NoProperty+$SB_Ploan_NoWarranty+$SB_Ploan_BuyHaveProperty+$SB_Ploan_BuyNoHaveProperty+$SB_Ploan_BuyNoWarranty+$SB_Ploan_VIPowner+$SB_Ploan_VIPbuy;
            $Total_KOL_Ploan = $KOL_Ploan_HaveProperty+$KOL_Ploan_NoProperty+$KOL_Ploan_NoWarranty+$KOL_Ploan_BuyHaveProperty+$KOL_Ploan_BuyNoHaveProperty+$KOL_Ploan_BuyNoWarranty+$KOL_Ploan_VIPowner+$KOL_Ploan_VIPbuy;
            $Total_BT_Ploan = $BT_Ploan_HaveProperty+$BT_Ploan_NoProperty+$BT_Ploan_NoWarranty+$BT_Ploan_BuyHaveProperty+$BT_Ploan_BuyNoHaveProperty+$BT_Ploan_BuyNoWarranty+$BT_Ploan_VIPowner+$BT_Ploan_VIPbuy;
            $Total_KP_Ploan = $KP_Ploan_HaveProperty+$KP_Ploan_NoProperty+$KP_Ploan_NoWarranty+$KP_Ploan_BuyHaveProperty+$KP_Ploan_BuyNoHaveProperty+$KP_Ploan_BuyNoWarranty+$KP_Ploan_VIPowner+$KP_Ploan_VIPbuy;
            $Total_TM_Ploan = $TM_Ploan_HaveProperty+$TM_Ploan_NoProperty+$TM_Ploan_NoWarranty+$TM_Ploan_BuyHaveProperty+$TM_Ploan_BuyNoHaveProperty+$TM_Ploan_BuyNoWarranty+$TM_Ploan_VIPowner+$TM_Ploan_VIPbuy;
            $Total_RS_Ploan = $RS_Ploan_HaveProperty+$RS_Ploan_NoProperty+$RS_Ploan_NoWarranty+$RS_Ploan_BuyHaveProperty+$RS_Ploan_BuyNoHaveProperty+$RS_Ploan_BuyNoWarranty+$RS_Ploan_VIPowner+$RS_Ploan_VIPbuy;
            $Total_BNT_Ploan = $BNT_Ploan_HaveProperty+$BNT_Ploan_NoProperty+$BNT_Ploan_NoWarranty+$BNT_Ploan_BuyHaveProperty+$BNT_Ploan_BuyNoHaveProperty+$BNT_Ploan_BuyNoWarranty+$BNT_Ploan_VIPowner+$BNT_Ploan_VIPbuy;
            $Total_YH_Ploan = $YH_Ploan_HaveProperty+$YH_Ploan_NoProperty+$YH_Ploan_NoWarranty+$YH_Ploan_BuyHaveProperty+$YH_Ploan_BuyNoHaveProperty+$YH_Ploan_BuyNoWarranty+$YH_Ploan_VIPowner+$YH_Ploan_VIPbuy;
        }

        if ($dataMicro != NULL) {
            $PN_Micro_HaveProperty = 0;
            $PN_Micro_NoProperty = 0;
            $PN_Micro_NoWarranty = 0;
            $PN_Micro_BuyHaveProperty = 0;
            $PN_Micro_BuyNoHaveProperty = 0;
            $PN_Micro_BuyNoWarranty = 0;
            $PN_Micro_VIPowner = 0;
            $PN_Micro_VIPbuy = 0;
            $Total_PN_Micro = 0;

            $YL_Micro_HaveProperty = 0;
            $YL_Micro_NoProperty = 0;
            $YL_Micro_NoWarranty = 0;
            $YL_Micro_BuyHaveProperty = 0;
            $YL_Micro_BuyNoHaveProperty = 0;
            $YL_Micro_BuyNoWarranty = 0;
            $YL_Micro_VIPowner = 0;
            $YL_Micro_VIPbuy = 0;
            $Total_YL_Micro = 0;

            $NR_Micro_HaveProperty = 0;
            $NR_Micro_NoProperty = 0;
            $NR_Micro_NoWarranty = 0;
            $NR_Micro_BuyHaveProperty = 0;
            $NR_Micro_BuyNoHaveProperty = 0;
            $NR_Micro_BuyNoWarranty = 0;
            $NR_Micro_VIPowner = 0;
            $NR_Micro_VIPbuy = 0;
            $Total_NR_Micro = 0;

            $SB_Micro_HaveProperty = 0;
            $SB_Micro_NoProperty = 0;
            $SB_Micro_NoWarranty = 0;
            $SB_Micro_BuyHaveProperty = 0;
            $SB_Micro_BuyNoHaveProperty = 0;
            $SB_Micro_BuyNoWarranty = 0;
            $SB_Micro_VIPowner = 0;
            $SB_Micro_VIPbuy = 0;
            $Total_SB_Micro = 0;

            $KOL_Micro_HaveProperty = 0;
            $KOL_Micro_NoProperty = 0;
            $KOL_Micro_NoWarranty = 0;
            $KOL_Micro_BuyHaveProperty = 0;
            $KOL_Micro_BuyNoHaveProperty = 0;
            $KOL_Micro_BuyNoWarranty = 0;
            $KOL_Micro_VIPowner = 0;
            $KOL_Micro_VIPbuy = 0;
            $Total_KOL_Micro = 0;

            $BT_Micro_HaveProperty = 0;
            $BT_Micro_NoProperty = 0;
            $BT_Micro_NoWarranty = 0;
            $BT_Micro_BuyHaveProperty = 0;
            $BT_Micro_BuyNoHaveProperty = 0;
            $BT_Micro_BuyNoWarranty = 0;
            $BT_Micro_VIPowner = 0;
            $BT_Micro_VIPbuy = 0;
            $Total_BT_Micro = 0;

            $KP_Micro_HaveProperty = 0;
            $KP_Micro_NoProperty = 0;
            $KP_Micro_NoWarranty = 0;
            $KP_Micro_BuyHaveProperty = 0;
            $KP_Micro_BuyNoHaveProperty = 0;
            $KP_Micro_BuyNoWarranty = 0;
            $KP_Micro_VIPowner = 0;
            $KP_Micro_VIPbuy = 0;
            $Total_KP_Micro = 0;

            $TM_Micro_HaveProperty = 0;
            $TM_Micro_NoProperty = 0;
            $TM_Micro_NoWarranty = 0;
            $TM_Micro_BuyHaveProperty = 0;
            $TM_Micro_BuyNoHaveProperty = 0;
            $TM_Micro_BuyNoWarranty = 0;
            $TM_Micro_VIPowner = 0;
            $TM_Micro_VIPbuy = 0;
            $Total_TM_Micro = 0;

            $RS_Micro_HaveProperty = 0;
            $RS_Micro_NoProperty = 0;
            $RS_Micro_NoWarranty = 0;
            $RS_Micro_BuyHaveProperty = 0;
            $RS_Micro_BuyNoHaveProperty = 0;
            $RS_Micro_BuyNoWarranty = 0;
            $RS_Micro_VIPowner = 0;
            $RS_Micro_VIPbuy = 0;
            $Total_RS_Micro = 0;

            $BNT_Micro_HaveProperty = 0;
            $BNT_Micro_NoProperty = 0;
            $BNT_Micro_NoWarranty = 0;
            $BNT_Micro_BuyHaveProperty = 0;
            $BNT_Micro_BuyNoHaveProperty = 0;
            $BNT_Micro_BuyNoWarranty = 0;
            $BNT_Micro_VIPowner = 0;
            $BNT_Micro_VIPbuy = 0;
            $Total_BNT_Micro = 0;

            $YH_Micro_HaveProperty = 0;
            $YH_Micro_NoProperty = 0;
            $YH_Micro_NoWarranty = 0;
            $YH_Micro_BuyHaveProperty = 0;
            $YH_Micro_BuyNoHaveProperty = 0;
            $YH_Micro_BuyNoWarranty = 0;
            $YH_Micro_VIPowner = 0;
            $YH_Micro_VIPbuy = 0;
            $Total_YH_Micro = 0;

            foreach ($dataMicro as $key => $value8) {
                if ($value8->branch_car == 'ปัตตานี') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $PN_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $PN_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $PN_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $PN_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $PN_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $PN_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'ยะลา') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YL_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YL_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YL_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YL_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $YL_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $YL_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'นราธิวาส') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $NR_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $NR_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $NR_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $NR_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $NR_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $NR_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'สายบุรี') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $SB_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $SB_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $SB_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $SB_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $SB_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $SB_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'โกลก') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KOL_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KOL_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KOL_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KOL_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $KOL_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $KOL_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'เบตง') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BT_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BT_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BT_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BT_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $BT_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $BT_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'โคกโพธิ์') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KP_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KP_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KP_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KP_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $KP_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $KP_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'ตันหยงมัส') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $TM_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $TM_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $TM_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $TM_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $TM_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $TM_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'รือเสาะ') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $RS_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $RS_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $RS_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $RS_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $RS_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $RS_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'บันนังสตา') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BNT_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BNT_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BNT_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BNT_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $BNT_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $BNT_Micro_VIPbuy += 1;
                    }
                }else if ($value8->branch_car == 'ยะหา') {
                    if ($value8->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YH_Micro_HaveProperty += 1;
                    }elseif ($value8->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Micro_NoProperty += 1;
                    }elseif ($value8->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YH_Micro_NoWarranty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YH_Micro_BuyHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Micro_BuyNoHaveProperty += 1;
                    }elseif ($value8->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YH_Micro_BuyNoWarranty += 1;
                    }elseif ($value8->status_car == 'VIP.กรรมสิทธิ์') {
                        $YH_Micro_VIPowner += 1;
                    }elseif ($value8->status_car == 'VIP.ซื้อขาย') {
                        $YH_Micro_VIPbuy += 1;
                    }
                }
            }

            $Total_PN_Micro = $PN_Micro_HaveProperty+$PN_Micro_NoProperty+$PN_Micro_NoWarranty+$PN_Micro_BuyHaveProperty+$PN_Micro_BuyNoHaveProperty+$PN_Micro_BuyNoWarranty+$PN_Micro_VIPowner+$PN_Micro_VIPbuy;
            $Total_YL_Micro = $YL_Micro_HaveProperty+$YL_Micro_NoProperty+$YL_Micro_NoWarranty+$YL_Micro_BuyHaveProperty+$YL_Micro_BuyNoHaveProperty+$YL_Micro_BuyNoWarranty+$YL_Micro_VIPowner+$YL_Micro_VIPbuy;
            $Total_NR_Micro = $NR_Micro_HaveProperty+$NR_Micro_NoProperty+$NR_Micro_NoWarranty+$NR_Micro_BuyHaveProperty+$NR_Micro_BuyNoHaveProperty+$NR_Micro_BuyNoWarranty+$NR_Micro_VIPowner+$NR_Micro_VIPbuy;
            $Total_SB_Micro = $SB_Micro_HaveProperty+$SB_Micro_NoProperty+$SB_Micro_NoWarranty+$SB_Micro_BuyHaveProperty+$SB_Micro_BuyNoHaveProperty+$SB_Micro_BuyNoWarranty+$SB_Micro_VIPowner+$SB_Micro_VIPbuy;
            $Total_KOL_Micro = $KOL_Micro_HaveProperty+$KOL_Micro_NoProperty+$KOL_Micro_NoWarranty+$KOL_Micro_BuyHaveProperty+$KOL_Micro_BuyNoHaveProperty+$KOL_Micro_BuyNoWarranty+$KOL_Micro_VIPowner+$KOL_Micro_VIPbuy;
            $Total_BT_Micro = $BT_Micro_HaveProperty+$BT_Micro_NoProperty+$BT_Micro_NoWarranty+$BT_Micro_BuyHaveProperty+$BT_Micro_BuyNoHaveProperty+$BT_Micro_BuyNoWarranty+$BT_Micro_VIPowner+$BT_Micro_VIPbuy;
            $Total_KP_Micro = $KP_Micro_HaveProperty+$KP_Micro_NoProperty+$KP_Micro_NoWarranty+$KP_Micro_BuyHaveProperty+$KP_Micro_BuyNoHaveProperty+$KP_Micro_BuyNoWarranty+$KP_Micro_VIPowner+$KP_Micro_VIPbuy;
            $Total_TM_Micro = $TM_Micro_HaveProperty+$TM_Micro_NoProperty+$TM_Micro_NoWarranty+$TM_Micro_BuyHaveProperty+$TM_Micro_BuyNoHaveProperty+$TM_Micro_BuyNoWarranty+$TM_Micro_VIPowner+$TM_Micro_VIPbuy;
            $Total_RS_Micro = $RS_Micro_HaveProperty+$RS_Micro_NoProperty+$RS_Micro_NoWarranty+$RS_Micro_BuyHaveProperty+$RS_Micro_BuyNoHaveProperty+$RS_Micro_BuyNoWarranty+$RS_Micro_VIPowner+$RS_Micro_VIPbuy;
            $Total_BNT_Micro = $BNT_Micro_HaveProperty+$BNT_Micro_NoProperty+$BNT_Micro_NoWarranty+$BNT_Micro_BuyHaveProperty+$BNT_Micro_BuyNoHaveProperty+$BNT_Micro_BuyNoWarranty+$BNT_Micro_VIPowner+$BNT_Micro_VIPbuy;
            $Total_YH_Micro = $YH_Micro_HaveProperty+$YH_Micro_NoProperty+$YH_Micro_NoWarranty+$YH_Micro_BuyHaveProperty+$YH_Micro_BuyNoHaveProperty+$YH_Micro_BuyNoWarranty+$YH_Micro_VIPowner+$YH_Micro_VIPbuy;
        }

        if ($dataMotor != NULL) {
            $PN_Motor_HaveProperty = 0;
            $PN_Motor_NoProperty = 0;
            $PN_Motor_NoWarranty = 0;
            $PN_Motor_BuyHaveProperty = 0;
            $PN_Motor_BuyNoHaveProperty = 0;
            $PN_Motor_BuyNoWarranty = 0;
            $PN_Motor_VIPowner = 0;
            $PN_Motor_VIPbuy = 0;
            $Total_PN_Motor = 0;

            $YL_Motor_HaveProperty = 0;
            $YL_Motor_NoProperty = 0;
            $YL_Motor_NoWarranty = 0;
            $YL_Motor_BuyHaveProperty = 0;
            $YL_Motor_BuyNoHaveProperty = 0;
            $YL_Motor_BuyNoWarranty = 0;
            $YL_Motor_VIPowner = 0;
            $YL_Motor_VIPbuy = 0;
            $Total_YL_Motor = 0;

            $NR_Motor_HaveProperty = 0;
            $NR_Motor_NoProperty = 0;
            $NR_Motor_NoWarranty = 0;
            $NR_Motor_BuyHaveProperty = 0;
            $NR_Motor_BuyNoHaveProperty = 0;
            $NR_Motor_BuyNoWarranty = 0;
            $NR_Motor_VIPowner = 0;
            $NR_Motor_VIPbuy = 0;
            $Total_NR_Motor = 0;

            $SB_Motor_HaveProperty = 0;
            $SB_Motor_NoProperty = 0;
            $SB_Motor_NoWarranty = 0;
            $SB_Motor_BuyHaveProperty = 0;
            $SB_Motor_BuyNoHaveProperty = 0;
            $SB_Motor_BuyNoWarranty = 0;
            $SB_Motor_VIPowner = 0;
            $SB_Motor_VIPbuy = 0;
            $Total_SB_Motor = 0;

            $KOL_Motor_HaveProperty = 0;
            $KOL_Motor_NoProperty = 0;
            $KOL_Motor_NoWarranty = 0;
            $KOL_Motor_BuyHaveProperty = 0;
            $KOL_Motor_BuyNoHaveProperty = 0;
            $KOL_Motor_BuyNoWarranty = 0;
            $KOL_Motor_VIPowner = 0;
            $KOL_Motor_VIPbuy = 0;
            $Total_KOL_Motor = 0;

            $BT_Motor_HaveProperty = 0;
            $BT_Motor_NoProperty = 0;
            $BT_Motor_NoWarranty = 0;
            $BT_Motor_BuyHaveProperty = 0;
            $BT_Motor_BuyNoHaveProperty = 0;
            $BT_Motor_BuyNoWarranty = 0;
            $BT_Motor_VIPowner = 0;
            $BT_Motor_VIPbuy = 0;
            $Total_BT_Motor = 0;

            $KP_Motor_HaveProperty = 0;
            $KP_Motor_NoProperty = 0;
            $KP_Motor_NoWarranty = 0;
            $KP_Motor_BuyHaveProperty = 0;
            $KP_Motor_BuyNoHaveProperty = 0;
            $KP_Motor_BuyNoWarranty = 0;
            $KP_Motor_VIPowner = 0;
            $KP_Motor_VIPbuy = 0;
            $Total_KP_Motor = 0;

            $TM_Motor_HaveProperty = 0;
            $TM_Motor_NoProperty = 0;
            $TM_Motor_NoWarranty = 0;
            $TM_Motor_BuyHaveProperty = 0;
            $TM_Motor_BuyNoHaveProperty = 0;
            $TM_Motor_BuyNoWarranty = 0;
            $TM_Motor_VIPowner = 0;
            $TM_Motor_VIPbuy = 0;
            $Total_TM_Motor = 0;

            $RS_Motor_HaveProperty = 0;
            $RS_Motor_NoProperty = 0;
            $RS_Motor_NoWarranty = 0;
            $RS_Motor_BuyHaveProperty = 0;
            $RS_Motor_BuyNoHaveProperty = 0;
            $RS_Motor_BuyNoWarranty = 0;
            $RS_Motor_VIPowner = 0;
            $RS_Motor_VIPbuy = 0;
            $Total_RS_Motor = 0;

            $BNT_Motor_HaveProperty = 0;
            $BNT_Motor_NoProperty = 0;
            $BNT_Motor_NoWarranty = 0;
            $BNT_Motor_BuyHaveProperty = 0;
            $BNT_Motor_BuyNoHaveProperty = 0;
            $BNT_Motor_BuyNoWarranty = 0;
            $BNT_Motor_VIPowner = 0;
            $BNT_Motor_VIPbuy = 0;
            $Total_BNT_Motor = 0;

            $YH_Motor_HaveProperty = 0;
            $YH_Motor_NoProperty = 0;
            $YH_Motor_NoWarranty = 0;
            $YH_Motor_BuyHaveProperty = 0;
            $YH_Motor_BuyNoHaveProperty = 0;
            $YH_Motor_BuyNoWarranty = 0;
            $YH_Motor_VIPowner = 0;
            $YH_Motor_VIPbuy = 0;
            $Total_YH_Motor = 0;

            foreach ($dataMotor as $key => $value9) {
                if ($value9->branch_car == 'ปัตตานี') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $PN_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $PN_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $PN_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $PN_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $PN_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $PN_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $PN_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'ยะลา') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YL_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YL_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YL_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YL_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YL_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $YL_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $YL_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'นราธิวาส') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $NR_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $NR_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $NR_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $NR_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $NR_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $NR_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $NR_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'สายบุรี') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $SB_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $SB_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $SB_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $SB_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $SB_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $SB_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $SB_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'โกลก') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KOL_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KOL_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KOL_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KOL_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KOL_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $KOL_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $KOL_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'เบตง') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BT_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BT_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BT_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BT_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BT_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $BT_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $BT_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'โคกโพธิ์') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $KP_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $KP_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $KP_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $KP_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $KP_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $KP_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $KP_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'ตันหยงมัส') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $TM_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $TM_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $TM_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $TM_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $TM_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $TM_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $TM_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'รือเสาะ') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $RS_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $RS_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $RS_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $RS_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $RS_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $RS_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $RS_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'บันนังสตา') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $BNT_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $BNT_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $BNT_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $BNT_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $BNT_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $BNT_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $BNT_Motor_VIPbuy += 1;
                    }
                }else if ($value9->branch_car == 'ยะหา') {
                    if ($value9->status_car == 'กส.ค้ำมีหลักทรัพย์') {
                        $YH_Motor_HaveProperty += 1;
                    }elseif ($value9->status_car == 'กส.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Motor_NoProperty += 1;
                    }elseif ($value9->status_car == 'กส.ไม่ค้ำประกัน') {
                        $YH_Motor_NoWarranty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำมีหลักทรัพย์') {
                        $YH_Motor_BuyHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ค้ำไม่มีหลักทรัพย์') {
                        $YH_Motor_BuyNoHaveProperty += 1;
                    }elseif ($value9->status_car == 'ซข.ไม่ค้ำประกัน') {
                        $YH_Motor_BuyNoWarranty += 1;
                    }elseif ($value9->status_car == 'VIP.กรรมสิทธิ์') {
                        $YH_Motor_VIPowner += 1;
                    }elseif ($value9->status_car == 'VIP.ซื้อขาย') {
                        $YH_Motor_VIPbuy += 1;
                    }
                }
            }

            $Total_PN_Motor = $PN_Motor_HaveProperty+$PN_Motor_NoProperty+$PN_Motor_NoWarranty+$PN_Motor_BuyHaveProperty+$PN_Motor_BuyNoHaveProperty+$PN_Motor_BuyNoWarranty+$PN_Motor_VIPowner+$PN_Motor_VIPbuy;
            $Total_YL_Motor = $YL_Motor_HaveProperty+$YL_Motor_NoProperty+$YL_Motor_NoWarranty+$YL_Motor_BuyHaveProperty+$YL_Motor_BuyNoHaveProperty+$YL_Motor_BuyNoWarranty+$YL_Motor_VIPowner+$YL_Motor_VIPbuy;
            $Total_NR_Motor = $NR_Motor_HaveProperty+$NR_Motor_NoProperty+$NR_Motor_NoWarranty+$NR_Motor_BuyHaveProperty+$NR_Motor_BuyNoHaveProperty+$NR_Motor_BuyNoWarranty+$NR_Motor_VIPowner+$NR_Motor_VIPbuy;
            $Total_SB_Motor = $SB_Motor_HaveProperty+$SB_Motor_NoProperty+$SB_Motor_NoWarranty+$SB_Motor_BuyHaveProperty+$SB_Motor_BuyNoHaveProperty+$SB_Motor_BuyNoWarranty+$SB_Motor_VIPowner+$SB_Motor_VIPbuy;
            $Total_KOL_Motor = $KOL_Motor_HaveProperty+$KOL_Motor_NoProperty+$KOL_Motor_NoWarranty+$KOL_Motor_BuyHaveProperty+$KOL_Motor_BuyNoHaveProperty+$KOL_Motor_BuyNoWarranty+$KOL_Motor_VIPowner+$KOL_Motor_VIPbuy;
            $Total_BT_Motor = $BT_Motor_HaveProperty+$BT_Motor_NoProperty+$BT_Motor_NoWarranty+$BT_Motor_BuyHaveProperty+$BT_Motor_BuyNoHaveProperty+$BT_Motor_BuyNoWarranty+$BT_Motor_VIPowner+$BT_Motor_VIPbuy;
            $Total_KP_Motor = $KP_Motor_HaveProperty+$KP_Motor_NoProperty+$KP_Motor_NoWarranty+$KP_Motor_BuyHaveProperty+$KP_Motor_BuyNoHaveProperty+$KP_Motor_BuyNoWarranty+$KP_Motor_VIPowner+$KP_Motor_VIPbuy;
            $Total_TM_Motor = $TM_Motor_HaveProperty+$TM_Motor_NoProperty+$TM_Motor_NoWarranty+$TM_Motor_BuyHaveProperty+$TM_Motor_BuyNoHaveProperty+$TM_Motor_BuyNoWarranty+$TM_Motor_VIPowner+$TM_Motor_VIPbuy;
            $Total_RS_Motor = $RS_Motor_HaveProperty+$RS_Motor_NoProperty+$RS_Motor_NoWarranty+$RS_Motor_BuyHaveProperty+$RS_Motor_BuyNoHaveProperty+$RS_Motor_BuyNoWarranty+$RS_Motor_VIPowner+$RS_Motor_VIPbuy;
            $Total_BNT_Motor = $BNT_Motor_HaveProperty+$BNT_Motor_NoProperty+$BNT_Motor_NoWarranty+$BNT_Motor_BuyHaveProperty+$BNT_Motor_BuyNoHaveProperty+$BNT_Motor_BuyNoWarranty+$BNT_Motor_VIPowner+$BNT_Motor_VIPbuy;
            $Total_YH_Motor = $YH_Motor_HaveProperty+$YH_Motor_NoProperty+$YH_Motor_NoWarranty+$YH_Motor_BuyHaveProperty+$YH_Motor_BuyNoHaveProperty+$YH_Motor_BuyNoWarranty+$YH_Motor_VIPowner+$YH_Motor_VIPbuy;
        }

        $Allproducts = $request->all;

        $dataLeasing = DB::table('targets')
                ->where('Target_Type','=','Leasing')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

        $dataPloan = DB::table('targets')
                ->where('Target_Type','=','Ploan')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

        $dataMicro = DB::table('targets')
                ->where('Target_Type','=','Micro')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

        $dataMotor = DB::table('targets')
                ->where('Target_Type','=','Motor')
                ->where('Target_Month','=',date('m'))
                ->where('Target_Year','=',date('Y'))
                ->first();

        if($request->Dashboard == 2){
            return view('home2', compact('newfdate','newtdate','Allproducts',
            'SumLeasingAll','Leasing01','Leasing03','Leasing04','Leasing05','Leasing06','Leasing07','Leasing08','Leasing09','Leasing12','Leasing13','Leasing14',
            'SumTopcar_LeasingAll','Topcar_Leasing01','Topcar_Leasing03','Topcar_Leasing04','Topcar_Leasing05','Topcar_Leasing06','Topcar_Leasing07','Topcar_Leasing08','Topcar_Leasing09','Topcar_Leasing12','Topcar_Leasing13','Topcar_Leasing14',
            'SumHomecarAll','Homecar10','Homecar11',
            'SumTopcar_HomecarAll','Topcar_Homecar10','Topcar_Homecar11',
            'SumPloanAll','Ploan50','Ploan51','Ploan52','Ploan53','Ploan54','Ploan55','Ploan56','Ploan57','Ploan58','Ploan59','Ploan60',
            'SumTopcar_PloanAll','Topcar_Ploan50','Topcar_Ploan51','Topcar_Ploan52','Topcar_Ploan53','Topcar_Ploan54','Topcar_Ploan55','Topcar_Ploan56','Topcar_Ploan57','Topcar_Ploan58','Topcar_Ploan59','Topcar_Ploan60',
            'SumMotorAll','Motor50','Motor51','Motor52','Motor53','Motor54','Motor55','Motor56','Motor57','Motor58','Motor59','Motor60',
            'SumTopcar_MotorAll','Topcar_Motor50','Topcar_Motor51','Topcar_Motor52','Topcar_Motor53','Topcar_Motor54','Topcar_Motor55','Topcar_Motor56','Topcar_Motor57','Topcar_Motor58','Topcar_Motor59','Topcar_Motor60',
            'SumMicroAll','Micro50','Micro51','Micro52','Micro53','Micro54','Micro55','Micro56','Micro57','Micro58','Micro59','Micro60',
            'SumTopcar_MicroAll','Topcar_Micro50','Topcar_Micro51','Topcar_Micro52','Topcar_Micro53','Topcar_Micro54','Topcar_Micro55','Topcar_Micro56','Topcar_Micro57','Topcar_Micro58','Topcar_Micro59','Topcar_Micro60',
            'SumStaffAll','Staff50','Staff51','Staff52','Staff53','Staff54','Staff55','Staff56','Staff57','Staff58','Staff59','Staff60',
            'SumTopcar_StaffAll','Topcar_Staff50','Topcar_Staff51','Topcar_Staff52','Topcar_Staff53','Topcar_Staff54','Topcar_Staff55','Topcar_Staff56','Topcar_Staff57','Topcar_Staff58','Topcar_Staff59','Topcar_Staff60',
            'Total_PN','PN_HaveProperty','PN_NoProperty','PN_NoWarranty','PN_BuyHaveProperty','PN_BuyNoHaveProperty','PN_BuyNoWarranty','PN_VIPowner','PN_VIPbuy',
            'Total_YL','YL_HaveProperty','YL_NoProperty','YL_NoWarranty','YL_BuyHaveProperty','YL_BuyNoHaveProperty','YL_BuyNoWarranty','YL_VIPowner','YL_VIPbuy',
            'Total_NR','NR_HaveProperty','NR_NoProperty','NR_NoWarranty','NR_BuyHaveProperty','NR_BuyNoHaveProperty','NR_BuyNoWarranty','NR_VIPowner','NR_VIPbuy',
            'Total_SB','SB_HaveProperty','SB_NoProperty','SB_NoWarranty','SB_BuyHaveProperty','SB_BuyNoHaveProperty','SB_BuyNoWarranty','SB_VIPowner','SB_VIPbuy',
            'Total_KOL','KOL_HaveProperty','KOL_NoProperty','KOL_NoWarranty','KOL_BuyHaveProperty','KOL_BuyNoHaveProperty','KOL_BuyNoWarranty','KOL_VIPowner','KOL_VIPbuy',
            'Total_BT','BT_HaveProperty','BT_NoProperty','BT_NoWarranty','BT_BuyHaveProperty','BT_BuyNoHaveProperty','BT_BuyNoWarranty','BT_VIPowner','BT_VIPbuy',
            'Total_KP','KP_HaveProperty','KP_NoProperty','KP_NoWarranty','KP_BuyHaveProperty','KP_BuyNoHaveProperty','KP_BuyNoWarranty','KP_VIPowner','KP_VIPbuy',
            'Total_TM','TM_HaveProperty','TM_NoProperty','TM_NoWarranty','TM_BuyHaveProperty','TM_BuyNoHaveProperty','TM_BuyNoWarranty','TM_VIPowner','TM_VIPbuy',
            'Total_RS','RS_HaveProperty','RS_NoProperty','RS_NoWarranty','RS_BuyHaveProperty','RS_BuyNoHaveProperty','RS_BuyNoWarranty','RS_VIPowner','RS_VIPbuy',
            'Total_BNT','BNT_HaveProperty','BNT_NoProperty','BNT_NoWarranty','BNT_BuyHaveProperty','BNT_BuyNoHaveProperty','BNT_BuyNoWarranty','BNT_VIPowner','BNT_VIPbuy',
            'Total_YH','YH_HaveProperty','YH_NoProperty','YH_NoWarranty','YH_BuyHaveProperty','YH_BuyNoHaveProperty','YH_BuyNoWarranty','YH_VIPowner','YH_VIPbuy',
            'Total_PN_Ploan','PN_Ploan_HaveProperty','PN_Ploan_NoProperty','PN_Ploan_NoWarranty','PN_Ploan_BuyHaveProperty','PN_Ploan_BuyNoHaveProperty','PN_Ploan_BuyNoWarranty','PN_Ploan_VIPowner','PN_Ploan_VIPbuy',
            'Total_YL_Ploan','YL_Ploan_HaveProperty','YL_Ploan_NoProperty','YL_Ploan_NoWarranty','YL_Ploan_BuyHaveProperty','YL_Ploan_BuyNoHaveProperty','YL_Ploan_BuyNoWarranty','YL_Ploan_VIPowner','YL_Ploan_VIPbuy',
            'Total_NR_Ploan','NR_Ploan_HaveProperty','NR_Ploan_NoProperty','NR_Ploan_NoWarranty','NR_Ploan_BuyHaveProperty','NR_Ploan_BuyNoHaveProperty','NR_Ploan_BuyNoWarranty','NR_Ploan_VIPowner','NR_Ploan_VIPbuy',
            'Total_SB_Ploan','SB_Ploan_HaveProperty','SB_Ploan_NoProperty','SB_Ploan_NoWarranty','SB_Ploan_BuyHaveProperty','SB_Ploan_BuyNoHaveProperty','SB_Ploan_BuyNoWarranty','SB_Ploan_VIPowner','SB_Ploan_VIPbuy',
            'Total_KOL_Ploan','KOL_Ploan_HaveProperty','KOL_Ploan_NoProperty','KOL_Ploan_NoWarranty','KOL_Ploan_BuyHaveProperty','KOL_Ploan_BuyNoHaveProperty','KOL_Ploan_BuyNoWarranty','KOL_Ploan_VIPowner','KOL_Ploan_VIPbuy',
            'Total_BT_Ploan','BT_Ploan_HaveProperty','BT_Ploan_NoProperty','BT_Ploan_NoWarranty','BT_Ploan_BuyHaveProperty','BT_Ploan_BuyNoHaveProperty','BT_Ploan_BuyNoWarranty','BT_Ploan_VIPowner','BT_Ploan_VIPbuy',
            'Total_KP_Ploan','KP_Ploan_HaveProperty','KP_Ploan_NoProperty','KP_Ploan_NoWarranty','KP_Ploan_BuyHaveProperty','KP_Ploan_BuyNoHaveProperty','KP_Ploan_BuyNoWarranty','KP_Ploan_VIPowner','KP_Ploan_VIPbuy',
            'Total_TM_Ploan','TM_Ploan_HaveProperty','TM_Ploan_NoProperty','TM_Ploan_NoWarranty','TM_Ploan_BuyHaveProperty','TM_Ploan_BuyNoHaveProperty','TM_Ploan_BuyNoWarranty','TM_Ploan_VIPowner','TM_Ploan_VIPbuy',
            'Total_RS_Ploan','RS_Ploan_HaveProperty','RS_Ploan_NoProperty','RS_Ploan_NoWarranty','RS_Ploan_BuyHaveProperty','RS_Ploan_BuyNoHaveProperty','RS_Ploan_BuyNoWarranty','RS_Ploan_VIPowner','RS_Ploan_VIPbuy',
            'Total_BNT_Ploan','BNT_Ploan_HaveProperty','BNT_Ploan_NoProperty','BNT_Ploan_NoWarranty','BNT_Ploan_BuyHaveProperty','BNT_Ploan_BuyNoHaveProperty','BNT_Ploan_BuyNoWarranty','BNT_Ploan_VIPowner','BNT_Ploan_VIPbuy',
            'Total_YH_Ploan','YH_Ploan_HaveProperty','YH_Ploan_NoProperty','YH_Ploan_NoWarranty','YH_Ploan_BuyHaveProperty','YH_Ploan_BuyNoHaveProperty','YH_Ploan_BuyNoWarranty','YH_Ploan_VIPowner','YH_Ploan_VIPbuy',
            'Total_PN_Micro','PN_Micro_HaveProperty','PN_Micro_NoProperty','PN_Micro_NoWarranty','PN_Micro_BuyHaveProperty','PN_Micro_BuyNoHaveProperty','PN_Micro_BuyNoWarranty','PN_Micro_VIPowner','PN_Micro_VIPbuy',
            'Total_YL_Micro','YL_Micro_HaveProperty','YL_Micro_NoProperty','YL_Micro_NoWarranty','YL_Micro_BuyHaveProperty','YL_Micro_BuyNoHaveProperty','YL_Micro_BuyNoWarranty','YL_Micro_VIPowner','YL_Micro_VIPbuy',
            'Total_NR_Micro','NR_Micro_HaveProperty','NR_Micro_NoProperty','NR_Micro_NoWarranty','NR_Micro_BuyHaveProperty','NR_Micro_BuyNoHaveProperty','NR_Micro_BuyNoWarranty','NR_Micro_VIPowner','NR_Micro_VIPbuy',
            'Total_SB_Micro','SB_Micro_HaveProperty','SB_Micro_NoProperty','SB_Micro_NoWarranty','SB_Micro_BuyHaveProperty','SB_Micro_BuyNoHaveProperty','SB_Micro_BuyNoWarranty','SB_Micro_VIPowner','SB_Micro_VIPbuy',
            'Total_KOL_Micro','KOL_Micro_HaveProperty','KOL_Micro_NoProperty','KOL_Micro_NoWarranty','KOL_Micro_BuyHaveProperty','KOL_Micro_BuyNoHaveProperty','KOL_Micro_BuyNoWarranty','KOL_Micro_VIPowner','KOL_Micro_VIPbuy',
            'Total_BT_Micro','BT_Micro_HaveProperty','BT_Micro_NoProperty','BT_Micro_NoWarranty','BT_Micro_BuyHaveProperty','BT_Micro_BuyNoHaveProperty','BT_Micro_BuyNoWarranty','BT_Micro_VIPowner','BT_Micro_VIPbuy',
            'Total_KP_Micro','KP_Micro_HaveProperty','KP_Micro_NoProperty','KP_Micro_NoWarranty','KP_Micro_BuyHaveProperty','KP_Micro_BuyNoHaveProperty','KP_Micro_BuyNoWarranty','KP_Micro_VIPowner','KP_Micro_VIPbuy',
            'Total_TM_Micro','TM_Micro_HaveProperty','TM_Micro_NoProperty','TM_Micro_NoWarranty','TM_Micro_BuyHaveProperty','TM_Micro_BuyNoHaveProperty','TM_Micro_BuyNoWarranty','TM_Micro_VIPowner','TM_Micro_VIPbuy',
            'Total_RS_Micro','RS_Micro_HaveProperty','RS_Micro_NoProperty','RS_Micro_NoWarranty','RS_Micro_BuyHaveProperty','RS_Micro_BuyNoHaveProperty','RS_Micro_BuyNoWarranty','RS_Micro_VIPowner','RS_Micro_VIPbuy',
            'Total_BNT_Micro','BNT_Micro_HaveProperty','BNT_Micro_NoProperty','BNT_Micro_NoWarranty','BNT_Micro_BuyHaveProperty','BNT_Micro_BuyNoHaveProperty','BNT_Micro_BuyNoWarranty','BNT_Micro_VIPowner','BNT_Micro_VIPbuy',
            'Total_YH_Micro','YH_Micro_HaveProperty','YH_Micro_NoProperty','YH_Micro_NoWarranty','YH_Micro_BuyHaveProperty','YH_Micro_BuyNoHaveProperty','YH_Micro_BuyNoWarranty','YH_Micro_VIPowner','YH_Micro_VIPbuy',
            'Total_PN_Motor','PN_Motor_HaveProperty','PN_Motor_NoProperty','PN_Motor_NoWarranty','PN_Motor_BuyHaveProperty','PN_Motor_BuyNoHaveProperty','PN_Motor_BuyNoWarranty','PN_Motor_VIPowner','PN_Motor_VIPbuy',
            'Total_YL_Motor','YL_Motor_HaveProperty','YL_Motor_NoProperty','YL_Motor_NoWarranty','YL_Motor_BuyHaveProperty','YL_Motor_BuyNoHaveProperty','YL_Motor_BuyNoWarranty','YL_Motor_VIPowner','YL_Motor_VIPbuy',
            'Total_NR_Motor','NR_Motor_HaveProperty','NR_Motor_NoProperty','NR_Motor_NoWarranty','NR_Motor_BuyHaveProperty','NR_Motor_BuyNoHaveProperty','NR_Motor_BuyNoWarranty','NR_Motor_VIPowner','NR_Motor_VIPbuy',
            'Total_SB_Motor','SB_Motor_HaveProperty','SB_Motor_NoProperty','SB_Motor_NoWarranty','SB_Motor_BuyHaveProperty','SB_Motor_BuyNoHaveProperty','SB_Motor_BuyNoWarranty','SB_Motor_VIPowner','SB_Motor_VIPbuy',
            'Total_KOL_Motor','KOL_Motor_HaveProperty','KOL_Motor_NoProperty','KOL_Motor_NoWarranty','KOL_Motor_BuyHaveProperty','KOL_Motor_BuyNoHaveProperty','KOL_Motor_BuyNoWarranty','KOL_Motor_VIPowner','KOL_Motor_VIPbuy',
            'Total_BT_Motor','BT_Motor_HaveProperty','BT_Motor_NoProperty','BT_Motor_NoWarranty','BT_Motor_BuyHaveProperty','BT_Motor_BuyNoHaveProperty','BT_Motor_BuyNoWarranty','BT_Motor_VIPowner','BT_Motor_VIPbuy',
            'Total_KP_Motor','KP_Motor_HaveProperty','KP_Motor_NoProperty','KP_Motor_NoWarranty','KP_Motor_BuyHaveProperty','KP_Motor_BuyNoHaveProperty','KP_Motor_BuyNoWarranty','KP_Motor_VIPowner','KP_Motor_VIPbuy',
            'Total_TM_Motor','TM_Motor_HaveProperty','TM_Motor_NoProperty','TM_Motor_NoWarranty','TM_Motor_BuyHaveProperty','TM_Motor_BuyNoHaveProperty','TM_Motor_BuyNoWarranty','TM_Motor_VIPowner','TM_Motor_VIPbuy',
            'Total_RS_Motor','RS_Motor_HaveProperty','RS_Motor_NoProperty','RS_Motor_NoWarranty','RS_Motor_BuyHaveProperty','RS_Motor_BuyNoHaveProperty','RS_Motor_BuyNoWarranty','RS_Motor_VIPowner','RS_Motor_VIPbuy',
            'Total_BNT_Motor','BNT_Motor_HaveProperty','BNT_Motor_NoProperty','BNT_Motor_NoWarranty','BNT_Motor_BuyHaveProperty','BNT_Motor_BuyNoHaveProperty','BNT_Motor_BuyNoWarranty','BNT_Motor_VIPowner','BNT_Motor_VIPbuy',
            'Total_YH_Motor','YH_Motor_HaveProperty','YH_Motor_NoProperty','YH_Motor_NoWarranty','YH_Motor_BuyHaveProperty','YH_Motor_BuyNoHaveProperty','YH_Motor_BuyNoWarranty','YH_Motor_VIPowner','YH_Motor_VIPbuy',
            'dataLeasing','dataPlaon','dataMicro','dataMotor'
        ));
        }else{
            return view($name, compact('newfdate','newtdate','Allproducts',
            'SumLeasingAll','Leasing01','Leasing03','Leasing04','Leasing05','Leasing06','Leasing07','Leasing08','Leasing09','Leasing12','Leasing13','Leasing14',
            'SumTopcar_LeasingAll','Topcar_Leasing01','Topcar_Leasing03','Topcar_Leasing04','Topcar_Leasing05','Topcar_Leasing06','Topcar_Leasing07','Topcar_Leasing08','Topcar_Leasing09','Topcar_Leasing12','Topcar_Leasing13','Topcar_Leasing14',
            'SumHomecarAll','Homecar10','Homecar11',
            'SumTopcar_HomecarAll','Topcar_Homecar10','Topcar_Homecar11',
            'SumPloanAll','Ploan50','Ploan51','Ploan52','Ploan53','Ploan54','Ploan55','Ploan56','Ploan57','Ploan58','Ploan59','Ploan60',
            'SumTopcar_PloanAll','Topcar_Ploan50','Topcar_Ploan51','Topcar_Ploan52','Topcar_Ploan53','Topcar_Ploan54','Topcar_Ploan55','Topcar_Ploan56','Topcar_Ploan57','Topcar_Ploan58','Topcar_Ploan59','Topcar_Ploan60',
            'SumMotorAll','Motor50','Motor51','Motor52','Motor53','Motor54','Motor55','Motor56','Motor57','Motor58','Motor59','Motor60',
            'SumTopcar_MotorAll','Topcar_Motor50','Topcar_Motor51','Topcar_Motor52','Topcar_Motor53','Topcar_Motor54','Topcar_Motor55','Topcar_Motor56','Topcar_Motor57','Topcar_Motor58','Topcar_Motor59','Topcar_Motor60',
            'SumMicroAll','Micro50','Micro51','Micro52','Micro53','Micro54','Micro55','Micro56','Micro57','Micro58','Micro59','Micro60',
            'SumTopcar_MicroAll','Topcar_Micro50','Topcar_Micro51','Topcar_Micro52','Topcar_Micro53','Topcar_Micro54','Topcar_Micro55','Topcar_Micro56','Topcar_Micro57','Topcar_Micro58','Topcar_Micro59','Topcar_Micro60',
            'SumStaffAll','Staff50','Staff51','Staff52','Staff53','Staff54','Staff55','Staff56','Staff57','Staff58','Staff59','Staff60',
            'SumTopcar_StaffAll','Topcar_Staff50','Topcar_Staff51','Topcar_Staff52','Topcar_Staff53','Topcar_Staff54','Topcar_Staff55','Topcar_Staff56','Topcar_Staff57','Topcar_Staff58','Topcar_Staff59','Topcar_Staff60',
            'Total_PN','PN_HaveProperty','PN_NoProperty','PN_NoWarranty','PN_BuyHaveProperty','PN_BuyNoHaveProperty','PN_BuyNoWarranty','PN_VIPowner','PN_VIPbuy',
            'Total_YL','YL_HaveProperty','YL_NoProperty','YL_NoWarranty','YL_BuyHaveProperty','YL_BuyNoHaveProperty','YL_BuyNoWarranty','YL_VIPowner','YL_VIPbuy',
            'Total_NR','NR_HaveProperty','NR_NoProperty','NR_NoWarranty','NR_BuyHaveProperty','NR_BuyNoHaveProperty','NR_BuyNoWarranty','NR_VIPowner','NR_VIPbuy',
            'Total_SB','SB_HaveProperty','SB_NoProperty','SB_NoWarranty','SB_BuyHaveProperty','SB_BuyNoHaveProperty','SB_BuyNoWarranty','SB_VIPowner','SB_VIPbuy',
            'Total_KOL','KOL_HaveProperty','KOL_NoProperty','KOL_NoWarranty','KOL_BuyHaveProperty','KOL_BuyNoHaveProperty','KOL_BuyNoWarranty','KOL_VIPowner','KOL_VIPbuy',
            'Total_BT','BT_HaveProperty','BT_NoProperty','BT_NoWarranty','BT_BuyHaveProperty','BT_BuyNoHaveProperty','BT_BuyNoWarranty','BT_VIPowner','BT_VIPbuy',
            'Total_KP','KP_HaveProperty','KP_NoProperty','KP_NoWarranty','KP_BuyHaveProperty','KP_BuyNoHaveProperty','KP_BuyNoWarranty','KP_VIPowner','KP_VIPbuy',
            'Total_TM','TM_HaveProperty','TM_NoProperty','TM_NoWarranty','TM_BuyHaveProperty','TM_BuyNoHaveProperty','TM_BuyNoWarranty','TM_VIPowner','TM_VIPbuy',
            'Total_RS','RS_HaveProperty','RS_NoProperty','RS_NoWarranty','RS_BuyHaveProperty','RS_BuyNoHaveProperty','RS_BuyNoWarranty','RS_VIPowner','RS_VIPbuy',
            'Total_BNT','BNT_HaveProperty','BNT_NoProperty','BNT_NoWarranty','BNT_BuyHaveProperty','BNT_BuyNoHaveProperty','BNT_BuyNoWarranty','BNT_VIPowner','BNT_VIPbuy',
            'Total_YH','YH_HaveProperty','YH_NoProperty','YH_NoWarranty','YH_BuyHaveProperty','YH_BuyNoHaveProperty','YH_BuyNoWarranty','YH_VIPowner','YH_VIPbuy',
            'Total_PN_Ploan','PN_Ploan_HaveProperty','PN_Ploan_NoProperty','PN_Ploan_NoWarranty','PN_Ploan_BuyHaveProperty','PN_Ploan_BuyNoHaveProperty','PN_Ploan_BuyNoWarranty','PN_Ploan_VIPowner','PN_Ploan_VIPbuy',
            'Total_YL_Ploan','YL_Ploan_HaveProperty','YL_Ploan_NoProperty','YL_Ploan_NoWarranty','YL_Ploan_BuyHaveProperty','YL_Ploan_BuyNoHaveProperty','YL_Ploan_BuyNoWarranty','YL_Ploan_VIPowner','YL_Ploan_VIPbuy',
            'Total_NR_Ploan','NR_Ploan_HaveProperty','NR_Ploan_NoProperty','NR_Ploan_NoWarranty','NR_Ploan_BuyHaveProperty','NR_Ploan_BuyNoHaveProperty','NR_Ploan_BuyNoWarranty','NR_Ploan_VIPowner','NR_Ploan_VIPbuy',
            'Total_SB_Ploan','SB_Ploan_HaveProperty','SB_Ploan_NoProperty','SB_Ploan_NoWarranty','SB_Ploan_BuyHaveProperty','SB_Ploan_BuyNoHaveProperty','SB_Ploan_BuyNoWarranty','SB_Ploan_VIPowner','SB_Ploan_VIPbuy',
            'Total_KOL_Ploan','KOL_Ploan_HaveProperty','KOL_Ploan_NoProperty','KOL_Ploan_NoWarranty','KOL_Ploan_BuyHaveProperty','KOL_Ploan_BuyNoHaveProperty','KOL_Ploan_BuyNoWarranty','KOL_Ploan_VIPowner','KOL_Ploan_VIPbuy',
            'Total_BT_Ploan','BT_Ploan_HaveProperty','BT_Ploan_NoProperty','BT_Ploan_NoWarranty','BT_Ploan_BuyHaveProperty','BT_Ploan_BuyNoHaveProperty','BT_Ploan_BuyNoWarranty','BT_Ploan_VIPowner','BT_Ploan_VIPbuy',
            'Total_KP_Ploan','KP_Ploan_HaveProperty','KP_Ploan_NoProperty','KP_Ploan_NoWarranty','KP_Ploan_BuyHaveProperty','KP_Ploan_BuyNoHaveProperty','KP_Ploan_BuyNoWarranty','KP_Ploan_VIPowner','KP_Ploan_VIPbuy',
            'Total_TM_Ploan','TM_Ploan_HaveProperty','TM_Ploan_NoProperty','TM_Ploan_NoWarranty','TM_Ploan_BuyHaveProperty','TM_Ploan_BuyNoHaveProperty','TM_Ploan_BuyNoWarranty','TM_Ploan_VIPowner','TM_Ploan_VIPbuy',
            'Total_RS_Ploan','RS_Ploan_HaveProperty','RS_Ploan_NoProperty','RS_Ploan_NoWarranty','RS_Ploan_BuyHaveProperty','RS_Ploan_BuyNoHaveProperty','RS_Ploan_BuyNoWarranty','RS_Ploan_VIPowner','RS_Ploan_VIPbuy',
            'Total_BNT_Ploan','BNT_Ploan_HaveProperty','BNT_Ploan_NoProperty','BNT_Ploan_NoWarranty','BNT_Ploan_BuyHaveProperty','BNT_Ploan_BuyNoHaveProperty','BNT_Ploan_BuyNoWarranty','BNT_Ploan_VIPowner','BNT_Ploan_VIPbuy',
            'Total_YH_Ploan','YH_Ploan_HaveProperty','YH_Ploan_NoProperty','YH_Ploan_NoWarranty','YH_Ploan_BuyHaveProperty','YH_Ploan_BuyNoHaveProperty','YH_Ploan_BuyNoWarranty','YH_Ploan_VIPowner','YH_Ploan_VIPbuy',
            'Total_PN_Micro','PN_Micro_HaveProperty','PN_Micro_NoProperty','PN_Micro_NoWarranty','PN_Micro_BuyHaveProperty','PN_Micro_BuyNoHaveProperty','PN_Micro_BuyNoWarranty','PN_Micro_VIPowner','PN_Micro_VIPbuy',
            'Total_YL_Micro','YL_Micro_HaveProperty','YL_Micro_NoProperty','YL_Micro_NoWarranty','YL_Micro_BuyHaveProperty','YL_Micro_BuyNoHaveProperty','YL_Micro_BuyNoWarranty','YL_Micro_VIPowner','YL_Micro_VIPbuy',
            'Total_NR_Micro','NR_Micro_HaveProperty','NR_Micro_NoProperty','NR_Micro_NoWarranty','NR_Micro_BuyHaveProperty','NR_Micro_BuyNoHaveProperty','NR_Micro_BuyNoWarranty','NR_Micro_VIPowner','NR_Micro_VIPbuy',
            'Total_SB_Micro','SB_Micro_HaveProperty','SB_Micro_NoProperty','SB_Micro_NoWarranty','SB_Micro_BuyHaveProperty','SB_Micro_BuyNoHaveProperty','SB_Micro_BuyNoWarranty','SB_Micro_VIPowner','SB_Micro_VIPbuy',
            'Total_KOL_Micro','KOL_Micro_HaveProperty','KOL_Micro_NoProperty','KOL_Micro_NoWarranty','KOL_Micro_BuyHaveProperty','KOL_Micro_BuyNoHaveProperty','KOL_Micro_BuyNoWarranty','KOL_Micro_VIPowner','KOL_Micro_VIPbuy',
            'Total_BT_Micro','BT_Micro_HaveProperty','BT_Micro_NoProperty','BT_Micro_NoWarranty','BT_Micro_BuyHaveProperty','BT_Micro_BuyNoHaveProperty','BT_Micro_BuyNoWarranty','BT_Micro_VIPowner','BT_Micro_VIPbuy',
            'Total_KP_Micro','KP_Micro_HaveProperty','KP_Micro_NoProperty','KP_Micro_NoWarranty','KP_Micro_BuyHaveProperty','KP_Micro_BuyNoHaveProperty','KP_Micro_BuyNoWarranty','KP_Micro_VIPowner','KP_Micro_VIPbuy',
            'Total_TM_Micro','TM_Micro_HaveProperty','TM_Micro_NoProperty','TM_Micro_NoWarranty','TM_Micro_BuyHaveProperty','TM_Micro_BuyNoHaveProperty','TM_Micro_BuyNoWarranty','TM_Micro_VIPowner','TM_Micro_VIPbuy',
            'Total_RS_Micro','RS_Micro_HaveProperty','RS_Micro_NoProperty','RS_Micro_NoWarranty','RS_Micro_BuyHaveProperty','RS_Micro_BuyNoHaveProperty','RS_Micro_BuyNoWarranty','RS_Micro_VIPowner','RS_Micro_VIPbuy',
            'Total_BNT_Micro','BNT_Micro_HaveProperty','BNT_Micro_NoProperty','BNT_Micro_NoWarranty','BNT_Micro_BuyHaveProperty','BNT_Micro_BuyNoHaveProperty','BNT_Micro_BuyNoWarranty','BNT_Micro_VIPowner','BNT_Micro_VIPbuy',
            'Total_YH_Micro','YH_Micro_HaveProperty','YH_Micro_NoProperty','YH_Micro_NoWarranty','YH_Micro_BuyHaveProperty','YH_Micro_BuyNoHaveProperty','YH_Micro_BuyNoWarranty','YH_Micro_VIPowner','YH_Micro_VIPbuy',
            'Total_PN_Motor','PN_Motor_HaveProperty','PN_Motor_NoProperty','PN_Motor_NoWarranty','PN_Motor_BuyHaveProperty','PN_Motor_BuyNoHaveProperty','PN_Motor_BuyNoWarranty','PN_Motor_VIPowner','PN_Motor_VIPbuy',
            'Total_YL_Motor','YL_Motor_HaveProperty','YL_Motor_NoProperty','YL_Motor_NoWarranty','YL_Motor_BuyHaveProperty','YL_Motor_BuyNoHaveProperty','YL_Motor_BuyNoWarranty','YL_Motor_VIPowner','YL_Motor_VIPbuy',
            'Total_NR_Motor','NR_Motor_HaveProperty','NR_Motor_NoProperty','NR_Motor_NoWarranty','NR_Motor_BuyHaveProperty','NR_Motor_BuyNoHaveProperty','NR_Motor_BuyNoWarranty','NR_Motor_VIPowner','NR_Motor_VIPbuy',
            'Total_SB_Motor','SB_Motor_HaveProperty','SB_Motor_NoProperty','SB_Motor_NoWarranty','SB_Motor_BuyHaveProperty','SB_Motor_BuyNoHaveProperty','SB_Motor_BuyNoWarranty','SB_Motor_VIPowner','SB_Motor_VIPbuy',
            'Total_KOL_Motor','KOL_Motor_HaveProperty','KOL_Motor_NoProperty','KOL_Motor_NoWarranty','KOL_Motor_BuyHaveProperty','KOL_Motor_BuyNoHaveProperty','KOL_Motor_BuyNoWarranty','KOL_Motor_VIPowner','KOL_Motor_VIPbuy',
            'Total_BT_Motor','BT_Motor_HaveProperty','BT_Motor_NoProperty','BT_Motor_NoWarranty','BT_Motor_BuyHaveProperty','BT_Motor_BuyNoHaveProperty','BT_Motor_BuyNoWarranty','BT_Motor_VIPowner','BT_Motor_VIPbuy',
            'Total_KP_Motor','KP_Motor_HaveProperty','KP_Motor_NoProperty','KP_Motor_NoWarranty','KP_Motor_BuyHaveProperty','KP_Motor_BuyNoHaveProperty','KP_Motor_BuyNoWarranty','KP_Motor_VIPowner','KP_Motor_VIPbuy',
            'Total_TM_Motor','TM_Motor_HaveProperty','TM_Motor_NoProperty','TM_Motor_NoWarranty','TM_Motor_BuyHaveProperty','TM_Motor_BuyNoHaveProperty','TM_Motor_BuyNoWarranty','TM_Motor_VIPowner','TM_Motor_VIPbuy',
            'Total_RS_Motor','RS_Motor_HaveProperty','RS_Motor_NoProperty','RS_Motor_NoWarranty','RS_Motor_BuyHaveProperty','RS_Motor_BuyNoHaveProperty','RS_Motor_BuyNoWarranty','RS_Motor_VIPowner','RS_Motor_VIPbuy',
            'Total_BNT_Motor','BNT_Motor_HaveProperty','BNT_Motor_NoProperty','BNT_Motor_NoWarranty','BNT_Motor_BuyHaveProperty','BNT_Motor_BuyNoHaveProperty','BNT_Motor_BuyNoWarranty','BNT_Motor_VIPowner','BNT_Motor_VIPbuy',
            'Total_YH_Motor','YH_Motor_HaveProperty','YH_Motor_NoProperty','YH_Motor_NoWarranty','YH_Motor_BuyHaveProperty','YH_Motor_BuyNoHaveProperty','YH_Motor_BuyNoWarranty','YH_Motor_VIPowner','YH_Motor_VIPbuy'
        ));

        }
        
    }

    public function get_json(Request $request)
    {
        $data = '{
            "1":{
                "2015-2019":[12,18,24,30,36,42,48,54,60,66,72,78,84],
                "2012-2014":[12,18,24,30,36,42,48,54,60,66,72],
                "2010-2011":[12,18,24,30,36,42,48,54,60,66,72],
                "2009":[12,18,24,30,36,42,48,54,60,66,72],
                "2008":[12,18,24,30,36,42,48,54,60,66,72],
                "2007":[12,18,24,30,36,42,48,54,60],
                "2006":[12,18,24,30,36,42,48,54,60],
                "2005-2003":[12,18,24,30,36,42,48]
            },
            "2":{
                "2015-2019":[12,18,24,30,36,42,48,54,60,66,72,78,84],
                "2012-2014":[12,18,24,30,36,42,48,54,60,66,72],
                "2010-2011":[12,18,24,30,36,42,48,54,60,66,72],
                "2009":[12,18,24,30,36,42,48,54,60,66,72],
                "2008":[12,18,24,30,36,42,48,54,60,66,72],
                "2007":[12,18,24,30,36,42,48,54,60],
                "2006":[12,18,24,30,36,42,48,54,60],
                "2005-2003":[12,18,24,30,36,42,48]
            },
            "3":{
                "2015-2020":[12,18,24,30,36,42,48,54,60],
                "2013-2014":[12,18,24,30,36,42,48,54,60],
                "2010-2012":[12,18,24,30,36,42,48,54,60],
                "2008-2009":[12,18,24,30,36,42,48],
                "2006-2007":[12,18,24,30,36,42,48],
                "2004-2005":[12,18,24,30,36]
            }
        }';

        $json_data = json_decode($data);
        // dd($json_data);
        $type = $request->type;
        $year = $request->year;
        $showtext = $request->showtext;

        switch ($request->action) {
            case 'type':
                echo "<option value='0'>- เลือกปี -</option>";
                foreach ($json_data->$type as $year => $value) {
                    echo "<option value='$year' >$year</option>" ;
                }
                break;
            case 'year':
                foreach ($json_data->$type->$year as $value) {
                    echo "<option value='$value' >$value</option>" ;
                }
                break;
            case 'showtext':
                foreach ($json_data->$type->$year as $value) {
                    echo "<option value='$value' >$value</option>" ;
                }
                break;

            default:
                # code...
                break;
        }
    }
}
