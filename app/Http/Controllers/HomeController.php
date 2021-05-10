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
        $newfdate = date('Y-m-01');
        $newtdate = date('Y-m-d');

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
// dd($data, $dataHomecar);
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
                }elseif ($value->branch_car == 'บังนังสตา') {
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
        
        return view($name, compact('newfdate','newtdate',
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
        'SumTopcar_StaffAll','Topcar_Staff50','Topcar_Staff51','Topcar_Staff52','Topcar_Staff53','Topcar_Staff54','Topcar_Staff55','Topcar_Staff56','Topcar_Staff57','Topcar_Staff58','Topcar_Staff59','Topcar_Staff60'
    ));
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
