<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AnalyticalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == 1) {
            $newfdate = '2021-05-01';
            $newtdate = '2021-05-31';

            //ลค.ต้องชำระ
            $data = DB::connection('ibmi')
                ->table('SFHP.ARPAY')
                ->where('SFHP.ARPAY.NOPAY','<=', 6)
                ->whereBetween('SFHP.ARPAY.DDATE',[$newfdate,$newtdate])
                ->get();

            $count1 = 0;
            $count3 = 0;
            $count4 = 0;
            $count5 = 0;
            $count6 = 0;
            $count7 = 0;
            $count8 = 0;
            $count9 = 0;
            $count12 = 0;
            $count13 = 0;
            $count14 = 0;
            foreach ($data as $key => $value){
                $StrConn = substr($value->CONTNO,0,3);
                if($StrConn == '01-'){
                    $count1 += 1;
                }
                elseif($StrConn == '03-'){
                    $count3 += 1;
                }
                elseif($StrConn == '04-'){
                    $count4 += 1;
                }
                elseif($StrConn == '05-'){
                    $count5 += 1;
                }
                elseif($StrConn == '06-'){
                    $count6 += 1;
                }
                elseif($StrConn == '07-'){
                    $count7 += 1;
                }
                elseif($StrConn == '08-'){
                    $count8 += 1;
                }
                elseif($StrConn == '09-'){
                    $count9 += 1;
                }
                elseif($StrConn == '12-'){
                    $count12 += 1;
                }
                elseif($StrConn == '13-'){
                    $count13 += 1;
                }
                elseif($StrConn == '14-'){
                    $count14 += 1;
                }
            }

            //ลค.มาชำระ
            $datapPay = DB::connection('ibmi')
                ->table('SFHP.ARMAST')
                ->where('SFHP.ARMAST.ISSUDT','>', '2020-06-01')
                ->whereBetween('SFHP.ARMAST.LPAYD', [ $newfdate,$newtdate])
                ->where('SFHP.ARMAST.EXP_TO','<=', 6)
                // ->where('SFHP.ARMAST.HLDNO', 0)
                ->get();

                dd($datapPay);

            return view('analytical.view', compact('type', 'data','datapPay'));
        }
    }
}
