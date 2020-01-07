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
    public function index($name)
    {
        // $conn = Connectdb2::where('CUSCOD','=','AHI-00000001')->get();
        // echo $conn[0]->NAME1;
        // echo iconv('Tis-620','utf-8',$conn[0]->NAME1).'<br>';
        // $data = DB::select("SELECT * FROM [IBM].[DATASF].[SFHP].[INVTRAN] WHERE [RECVNO] = 'AOC-03040001'");
        // dd($data);

        // $conn = DataIBM::where('RECVNO','=','AOC-03040001')->get();
        // dd($conn);

        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;
        $newdate = date('Y-m-d', strtotime('+3 days'));


        $datafinance = DB::table('buyers')
                  ->join('cardetails','buyers.id','=','cardetails.Buyercar_id')
                  ->where('cardetails.Approvers_car','<>',Null)
                  ->count();

        $datahomecar = DB::table('buyers')
                  ->join('homecardetails','buyers.id','=','homecardetails.Buyerhomecar_id')
                  ->where('homecardetails.dateapp_HC','<>',Null)
                  ->count();

        $datalegis = DB::table('legislations')
                  ->join('legiscourts','legislations.id','=','legiscourts.legislation_id')
                  ->count();

        $datamassage = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                  ->whereBetween('SFHP.ARPAY.DDATE',[$newdate,$newdate])
                  ->whereBetween('SFHP.ARMAST.HLDNO',[1.5,3.69])
                  ->where('SFHP.ARMAST.BILLCOLL','=',99)
                  ->count();

        $datafollow = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                  ->where('SFHP.ARMAST.BILLCOLL','=',99)
                  ->whereBetween('SFHP.ARMAST.HLDNO',[2.5,4.69])
                  ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
                  ->count();

        $datanotice = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  ->join('SFHP.ARPAY','SFHP.ARMAST.CONTNO','=','SFHP.ARPAY.CONTNO')
                  ->whereBetween('SFHP.ARPAY.DDATE',[$date,$date])
                  ->whereBetween('SFHP.ARMAST.HLDNO',[4.7,5.69])
                  ->count();

        $datastock = DB::table('holdcars')
                  // ->whereBetween('holdcars.Date_hold',[$date,$date])
                  ->count();


        return view($name, compact('datafinance','datahomecar','datalegis','datafollow','datamassage','datanotice','datastock'));
    }
}
