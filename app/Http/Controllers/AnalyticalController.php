<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DBSmartLeasing\S_ARMAST;
use App\DBSmartLeasing\S_ARPAY;
use App\DBSmartPloan\P_ARMAST;
use App\DBSmartPloan\P_ARPAY;


class AnalyticalController extends Controller
{
    public function index(Request $request)
    {
        $SearchMoth = NULL;
        if ($request->has('SearchMoth')) {
            $SearchMoth = $request->SearchMoth;
        }else {
            $SearchMoth = date('m');
        }

        // $User = S_ARMAST::where('CONTNO','01-2562/0002')->first();
        //     $User->MEMO1 = iconv('UTF-8','TIS-620//TRANSLIT', "ทดสอบครั้งที่ 1");
        //     // ขาเข้าแปล้ง uft เป็น tis
        //     // ตอนselect แปลงเป็น utf iconv('TIS-620','UTF-8//TRANSLIT', "ทดสอบนะครับ")
        // $User->update();

        if ($request->type == 1 or $request->type == 2) {
            //ลค.เช้าซื้อ
                $data1 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', ['2021-06-01','2021-06-30'])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '01-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay1 = 0;
                foreach ($data1 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay1 += 1;
                    }
                }

                $data3 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '03-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay3 = 0;
                foreach ($data3 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay3 += 1;
                    }
                }

                $data4 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '04-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay4 = 0;
                foreach ($data4 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay4 += 1;
                    }
                }

                $data5 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '05-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay5 = 0;
                foreach ($data5 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay5 += 1;
                    }
                }

                $data6 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '06-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay6 = 0;
                foreach ($data6 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay6 += 1;
                    }
                }

                $data7 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '07-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay7 = 0;
                foreach ($data7 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay7 += 1;
                    }
                }

                $data8 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '08-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay8 = 0;
                foreach ($data8 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay8 += 1;
                    }
                }

                $data9 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '09-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay9 = 0;
                foreach ($data9 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay9 += 1;
                    }
                }

                $data12 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '12-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay12 = 0;
                foreach ($data12 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay12 += 1;
                    }
                }

                $data13 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '13-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay13 = 0;
                foreach ($data13 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay13 += 1;
                    }
                }

                $data14 = S_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('CONTNO','like', '14-%')
                    ->Wherehas('S_ARPAYtoS_ARMAST',function ($query) {
                        return $query->where('ISSUDT', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $countPay14 = 0;
                foreach ($data14 as $key => $value) {
                    $sumbalance = ($value->DAMT - $value->PAYMENT);
                    if ($sumbalance == 0) {
                        $countPay14 += 1;
                    }
                }
            /**********************/

            //ลค.PLoan-Micro
                $Ploan_1 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNHQ')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();

                $P03_1 = 0;
                $P03_Pay1 = 0;
                $P04_1 = 0;
                $P04_Pay1 = 0;
                $P06_1 = 0;
                $P06_Pay1 = 0;
                foreach ($Ploan_1 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay1 += 1;
                       }
                        $P03_1 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay1 += 1;
                       }
                        $P04_1 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay1 += 1;
                       }
                        $P06_1 += 1;
                    }
                }

                $Ploan_3 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNYL')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_3 = 0;
                $P03_Pay3 = 0;
                $P04_3 = 0;
                $P04_Pay3 = 0;
                $P06_3 = 0;
                $P06_Pay3 = 0;

                foreach ($Ploan_3 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay3 += 1;
                       }
                        $P03_3 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay3 += 1;
                       }
                        $P04_3 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay3 += 1;
                       }
                        $P06_3 += 1;
                    }
                }

                $Ploan_4 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNNW')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_4 = 0;
                $P03_Pay4 = 0;
                $P04_4 = 0;
                $P04_Pay4 = 0;
                $P06_4 = 0;
                $P06_Pay4 = 0;
                foreach ($Ploan_4 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay4 += 1;
                       }
                        $P03_4 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay4 += 1;
                       }
                        $P04_4 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay4 += 1;
                       }
                        $P06_4 += 1;
                    }
                }

                $Ploan_5 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNSB')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_5 = 0;
                $P03_Pay5 = 0;
                $P04_5 = 0;
                $P04_Pay5 = 0;
                $P06_5 = 0;
                $P06_Pay5 = 0;
                foreach ($Ploan_5 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay5 += 1;
                       }
                        $P03_5 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay5 += 1;
                       }
                        $P04_5 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay5 += 1;
                       }
                        $P06_5 += 1;
                    }
                }

                $Ploan_6 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNSKL')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_6 = 0;
                $P03_Pay6 = 0;
                $P04_6 = 0;
                $P04_Pay6 = 0;
                $P06_6 = 0;
                $P06_Pay6 = 0;
                foreach ($Ploan_6 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay6 += 1;
                       }
                        $P03_6 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay6 += 1;
                       }
                        $P04_6 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay6 += 1;
                       }
                        $P06_6 += 1;
                    }
                }

                $Ploan_7 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNBT')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_7 = 0;
                $P03_Pay7 = 0;
                $P04_7 = 0;
                $P04_Pay7 = 0;
                $P06_7 = 0;
                $P06_Pay7 = 0;
                foreach ($Ploan_7 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay7 += 1;
                       }
                        $P03_7 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay7 += 1;
                       }
                        $P04_7 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay7 += 1;
                       }
                        $P06_7 += 1;
                    }
                }

                $Ploan_7 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNBT')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_7 = 0;
                $P03_Pay7 = 0;
                $P04_7 = 0;
                $P04_Pay7 = 0;
                $P06_7 = 0;
                $P06_Pay7 = 0;
                foreach ($Ploan_7 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay7 += 1;
                       }
                        $P03_7 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay7 += 1;
                       }
                        $P04_7 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay7 += 1;
                       }
                        $P06_7 += 1;
                    }
                }

                $Ploan_8 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNKP')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_8 = 0;
                $P03_Pay8 = 0;
                $P04_8 = 0;
                $P04_Pay8 = 0;
                $P06_8 = 0;
                $P06_Pay8 = 0;
                foreach ($Ploan_8 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay8 += 1;
                       }
                        $P03_8 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay8 += 1;
                       }
                        $P04_8 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay8 += 1;
                       }
                        $P06_8 += 1;
                    }
                }


                $Ploan_9 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNRNG')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();

                $P03_9 = 0;
                $P03_Pay9 = 0;
                $P04_9 = 0;
                $P04_Pay9 = 0;
                $P06_9 = 0;
                $P06_Pay9 = 0;
                foreach ($Ploan_9 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                       if($sumbalance == 0){
                           $P03_Pay9 += 1;
                       }
                        $P03_9 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                       if($sumbalance == 0){
                           $P04_Pay9 += 1;
                       }
                        $P04_9 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                       if($sumbalance == 0){
                           $P06_Pay9 += 1;
                       }
                        $P06_9 += 1;
                    }
                }

                $Ploan_12 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNREU')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_12 = 0;
                $P03_Pay12 = 0;
                $P04_12 = 0;
                $P04_Pay12 = 0;
                $P06_12 = 0;
                $P06_Pay12 = 0;
                foreach ($Ploan_12 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                        if($sumbalance == 0){
                            $P03_Pay12 += 1;
                        }
                        $P03_12 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                        if($sumbalance == 0){
                            $P04_Pay12 += 1;
                        }
                        $P04_12 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                        if($sumbalance == 0){
                            $P06_Pay12 += 1;
                        }
                        $P06_12 += 1;
                    }
                }

                $Ploan_13 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNBNT')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_13 = 0;
                $P03_Pay13 = 0;
                $P04_13 = 0;
                $P04_Pay13 = 0;
                $P06_13 = 0;
                $P06_Pay13 = 0;
                foreach ($Ploan_13 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                        if($sumbalance == 0){
                            $P03_Pay13 += 1;
                        }
                        $P03_13 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                        if($sumbalance == 0){
                            $P04_Pay13 += 1;
                        }
                        $P04_13 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                        if($sumbalance == 0){
                            $P06_Pay13 += 1;
                        }
                        $P06_13 += 1;
                    }
                }

                $Ploan_14 = P_ARPAY::where('NOPAY','<=', 6)
                    // ->whereBetween('DDATE', [$newfdate,$newtdate])
                    ->whereMonth('DDATE', $SearchMoth)
                    ->where('LOCAT','PNYH')
                    ->where('CONTNO','not like', 'P07-%')
                    ->Wherehas('P_ARPAYtoP_ARMAST',function ($query) {
                        return $query->where('SDATE', '>=', '2020-12-01');
                    })
                    ->orderBy('CONTNO', 'ASC')
                    ->get();
                $P03_14 = 0;
                $P03_Pay14 = 0;
                $P04_14 = 0;
                $P04_Pay14 = 0;
                $P06_14 = 0;
                $P06_Pay14 = 0;
                foreach ($Ploan_14 as $key => $value) {
                    $StrConn = substr($value->CONTNO,0,3);
                    $sumbalance = ($value->N_DAMT - $value->PAYMENT);
                    if ($StrConn == 'P03') {
                        if($sumbalance == 0){
                            $P03_Pay14 += 1;
                        }
                        $P03_14 += 1;
                    }
                    elseif ($StrConn == 'P04') {
                        if($sumbalance == 0){
                            $P04_Pay14 += 1;
                        }
                        $P04_14 += 1;
                    }
                    elseif ($StrConn == 'P06') {
                        if($sumbalance == 0){
                            $P06_Pay14 += 1;
                        }
                        $P06_14 += 1;
                    }
                }
            /**********************/

            // dump(((count($data9)+$P03_9+$P04_9+$P06_9)) - ($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9));
            // dd(($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9));

            $financePN =((count($data1)+$P03_1+$P04_1+$P06_1)) - ($countPay1+$P03_Pay1+$P04_Pay1+$P06_Pay1);

            $AllMasterPN = count($data1)+count($data5)+count($data8)+$P03_1+$P03_5+$P03_8+$P04_1+$P04_5+$P04_8+$P06_1+$P06_5+$P06_8;
            $PayMasterPN = $countPay1+$countPay5+$countPay8+$P03_Pay1+$P03_Pay5+$P03_Pay8+$P04_Pay1+$P04_Pay5+$P04_Pay8+$P06_Pay1+$P06_Pay5+$P06_Pay8;

            $AllMasterYL = count($data3)+count($data7)+count($data13)+count($data14)+$P03_3+$P03_7+$P03_13+$P03_14+$P04_3+$P04_7+$P04_13+$P04_14+$P06_3+$P06_7+$P06_13+$P06_14;
            $PayMasterYL = $countPay3+$countPay7+$countPay13+$countPay14+$P03_Pay3+$P03_Pay7+$P03_Pay13+$P03_Pay14+$P04_Pay3+$P04_Pay7+$P04_Pay13+$P04_Pay14+$P06_Pay3+$P06_Pay7+$P06_Pay13+$P06_Pay14;

            $AllMasterNW = count($data4)+count($data6)+count($data9)+count($data12)+$P03_4+$P03_6+$P03_9+$P03_12+$P04_4+$P04_6+$P04_9+$P04_12+$P06_4+$P06_6+$P06_9+$P06_12;
            $PayMasterNW = $countPay4+$countPay6+$countPay9+$countPay12+$P03_Pay4+$P03_Pay6+$P03_Pay9+$P03_Pay12+$P04_Pay4+$P04_Pay6+$P04_Pay9+$P04_Pay12+$P06_Pay4+$P06_Pay6+$P06_Pay9+$P06_Pay12;

            if ($request->type == 1) {
                return view('analytical.viewMaster', compact('type','SearchMoth',
                    'AllMasterPN','PayMasterPN','AllMasterYL','PayMasterYL','AllMasterNW','PayMasterNW',
                    'data1','data3','data4','data5','data6','data7','data8','data9','data12','data13','data14',
                    'countPay1','countPay3','countPay4','countPay5','countPay6','countPay7','countPay8','countPay9','countPay12','countPay13','countPay14',
                    'P03_1','P03_3','P03_4','P03_5','P03_6','P03_7','P03_8','P03_9','P03_12','P03_13','P03_14',
                    'P03_Pay1','P03_Pay3','P03_Pay4','P03_Pay5','P03_Pay6','P03_Pay7','P03_Pay8','P03_Pay9','P03_Pay12','P03_Pay13','P03_Pay14',
                    'P04_1','P04_3','P04_4','P04_5','P04_6','P04_7','P04_8','P04_9','P04_12','P04_13','P04_14',
                    'P04_Pay1','P04_Pay3','P04_Pay4','P04_Pay5','P04_Pay6','P04_Pay7','P04_Pay8','P04_Pay9','P04_Pay12','P04_Pay13','P04_Pay14',
                    'P06_1','P06_3','P06_4','P06_5','P06_6','P06_7','P06_8','P06_9','P06_12','P06_13','P06_14',
                    'P06_Pay1','P06_Pay3','P06_Pay4','P06_Pay5','P06_Pay6','P06_Pay7','P06_Pay8','P06_Pay9','P06_Pay12','P06_Pay13','P06_Pay14'
                ));
            }
            elseif ($request->type == 2) {
                return view('analytical.viewFinance', compact('type','SearchMoth',
                    'AllMasterPN','PayMasterPN','AllMasterYL','PayMasterYL','AllMasterNW','PayMasterNW',
                    'data1','data3','data4','data5','data6','data7','data8','data9','data12','data13','data14',
                    'countPay1','countPay3','countPay4','countPay5','countPay6','countPay7','countPay8','countPay9','countPay12','countPay13','countPay14',
                    'P03_1','P03_3','P03_4','P03_5','P03_6','P03_7','P03_8','P03_9','P03_12','P03_13','P03_14',
                    'P03_Pay1','P03_Pay3','P03_Pay4','P03_Pay5','P03_Pay6','P03_Pay7','P03_Pay8','P03_Pay9','P03_Pay12','P03_Pay13','P03_Pay14',
                    'P04_1','P04_3','P04_4','P04_5','P04_6','P04_7','P04_8','P04_9','P04_12','P04_13','P04_14',
                    'P04_Pay1','P04_Pay3','P04_Pay4','P04_Pay5','P04_Pay6','P04_Pay7','P04_Pay8','P04_Pay9','P04_Pay12','P04_Pay13','P04_Pay14',
                    'P06_1','P06_3','P06_4','P06_5','P06_6','P06_7','P06_8','P06_9','P06_12','P06_13','P06_14',
                    'P06_Pay1','P06_Pay3','P06_Pay4','P06_Pay5','P06_Pay6','P06_Pay7','P06_Pay8','P06_Pay9','P06_Pay12','P06_Pay13','P06_Pay14'
                ));

            }
        }
        elseif ($request->type == 3){

            // $data1 = DB::connection('ibmi')
            //     ->table('SFHP.ARPAY')
            //     ->join('SFHP.ARMAST','SFHP.ARPAY.CONTNO','=','SFHP.ARMAST.CONTNO')
            //     // ->whereRaw('CASE WHEN SFHP.ARMAST.BALANC-SFHP.ARMAST.SMPAY=0 THEN 1 ELSE 0 END = 1')
            //     ->whereBetween('SFHP.ARPAY.DDATE', ['2021-05-01','2021-05-31'])
            //     ->whereBetween('SFHP.ARPAY.DATE1', ['2021-05-01','2021-05-31'])
            //     ->whereRaw('SFHP.ARMAST.BALANC-SFHP.ARMAST.SMPAY=0')
            //     ->get();

            // $data2 = DB::connection('ibmi')
            //     ->table('SFHP.ARPAY')
            //     ->join('SFHP.ARMAST','SFHP.ARPAY.CONTNO','=','SFHP.ARMAST.CONTNO')
            //     ->whereBetween('SFHP.ARPAY.DDATE', ['2021-05-01','2021-05-31'])
            //     ->whereBetween('SFHP.ARPAY.DATE1', ['2021-05-01','2021-05-31'])
            //     ->whereRaw('SFHP.ARPAY.DAMT-SFHP.ARPAY.PAYMENT=0')
            //     ->get();

            $data3 = DB::connection('ibmi')
                ->table('SFHP.CHQTRAN')
                ->join('SFHP.ARMAST','SFHP.ARMAST.CONTNO','=','SFHP.CHQTRAN.CONTNO')
                ->whereBetween('SFHP.CHQTRAN.TMBILDT', ['2021-05-01','2021-05-31'])
                ->whereRaw('SFHP.ARMAST.KEYINFUPAY<SFHP.CHQTRAN.PAYAMT')
                ->get();

                dd($data3);


            // $data4 = DB::connection('ibmi')
            //     ->table('SFHP.ARPAY')
            //     ->join('SFHP.ARMAST','SFHP.ARPAY.CONTNO','=','SFHP.ARMAST.CONTNO')
            //     // ->whereRaw('SFHP.ARMAST.LPAYA>SFHP.ARPAY.DAMT')
            //     ->whereBetween('SFHP.ARPAY.DDATE', ['2021-05-01','2021-05-31'])
            //     ->where('SFHP.ARPAY.PAYMENT', 0)
            //     ->get();



            // $DataPay2 = S_ARPAY::whereBetween('DDATE', ['2021-05-01','2021-05-31'])
            //     ->whereBetween('DATE1', ['2021-05-01','2021-05-31'])
            //     ->count();

            //     dd($countPay1,$DataPay2);
        }
    }
}
