<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use File;
use Image;
use PDF;
use Excel;

use App\Micro_Ploan;
use App\MP_Datacar;
use App\MP_Sponsor;
use App\MP_Sponsor2;
use App\MP_Expense;
use App\MP_upload_lat_long;
use App\MP_uploadfile_image;
use App\Data_customer;
use Carbon\Carbon;
use Helper;

class MPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = date('Y-m-d');
  
        $contno = '';
        $newfdate = '';
        $newtdate = '';
        $status = '';
        $typeCon = '';
  
        $Count50 = 0;
        $Count51 = 0;
        $Count52 = 0;
        $Count53 = 0;
        $Count54 = 0;
        $Count55 = 0;
        $Count56 = 0;
        $Count57 = 0;
        $Count58 = 0;
        $Count59 = 0;
        $Count60 = 0;
        $SumAll = 0;
  
        if ($request->has('Fromdate')) {
          $newfdate = $request->get('Fromdate');
        }elseif (session()->has('newfdate')) {
          $newfdate = session('newfdate');
        }
        if ($request->has('Todate')) {
          $newtdate = $request->get('Todate');
        }elseif (session()->has('newtdate')) {
          $newtdate = session('newtdate');
        }
        if ($request->has('status')) {
          $status = $request->get('status');
        }elseif (session()->has('status')) {
          $status = session('status');
        }
        if ($request->has('Contno')) {
          $contno = $request->get('Contno');
        }elseif (session()->has('Contno')) {
          $contno = session('Contno');
        }
        if ($status == 'Null') {
          $status = NULL;
        }
  
        if ($request->type == 1){       //PLoan P03
          if ($newfdate == '' and $newtdate == '') {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datacars.Date_Appcar','=',Null)
              ->where('MP_Datas.Type_Con','=','P03')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }else {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->when(!empty($status), function($q) use($status){
                return $q->where('MP_Datacars.StatusApp_car','=',$status);
              })
              ->when(!empty($contno), function($q) use($contno){
                return $q->where('MP_Datas.Contract_MP','=',$contno);
              })
              ->where('MP_Datas.Type_Con','=','P03')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }
  
          $type = $request->type;
          $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
          $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
  
          if ($data != NULL) {
            foreach ($data as $key => $value) {
              if ($value->branch_car == 'ปัตตานี') {
                $Count50 += 1;
              }elseif ($value->branch_car == 'ยะลา') {
                $Count51 += 1;
              }elseif ($value->branch_car == 'นราธิวาส') {
                $Count52 += 1;
              }elseif ($value->branch_car == 'สายบุรี') {
                $Count53 += 1;
              }elseif ($value->branch_car == 'โกลก') {
                $Count54 += 1;
              }elseif ($value->branch_car == 'เบตง') {
                $Count55 += 1;
              }elseif ($value->branch_car == 'โคกโพธิ์') {
                $Count56 += 1;
              }elseif ($value->branch_car == 'ตันหยงมัส') {
                $Count57 += 1;
              }elseif ($value->branch_car == 'รือเสาะ') {
                $Count58 += 1;
              }elseif ($value->branch_car == 'บันนังสตา') {
                $Count59 += 1;
              }elseif ($value->branch_car == 'ยะหา') {
                $Count60 += 1;
              }
            }
            $SumAll = $Count50 + $Count51 + $Count52 + $Count53 + $Count54 + $Count55 + $Count56 + $Count57 + $Count58 + $Count59 + $Count60;
          }
  
          $topcar = DB::table('MP_Datas')
            ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
            ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
            ->where('MP_Datas.Type_Con','=','P03')
            ->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate])
            ->get();
          $count = count($topcar);
          
  
          if($count != 0){
            for ($i=0; $i < $count; $i++) {
              @$SumTopcar += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
              @$SumCommissioncar += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
              @$SumCommitprice += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
            }
          }else{
            $SumTopcar = 0;
            $SumCommissioncar = 0;
            $SumCommitprice = 0;
          }
  
          return view('Micro-Ploan.view_PLoan', compact('type', 'data','newfdate','newtdate','status','Setdate','SumTopcar','SumCommissioncar',
                                               'SumCommitprice','SumAll','contno','SetStrConn','SetStr1','SetStr2','Count50','Count51','Count52',
                                               'Count53','Count54','Count55','Count56','Count57','Count58','Count59','Count60'));
        }
        elseif ($request->type == 3) {  //PLoan P04
            if ($newfdate == '' and $newtdate == '') {
              $data = DB::table('MP_Datas')
                ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->where('MP_Datacars.Date_Appcar','=',Null)
                ->where('MP_Datas.Type_Con','=','P04')
                ->orderBy('MP_Datas.Contract_MP', 'ASC')
                ->get();
            }else {
              $data = DB::table('MP_Datas')
                ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
                })
                ->when(!empty($status), function($q) use($status){
                return $q->where('MP_Datacars.StatusApp_car','=',$status);
                })
                ->when(!empty($contno), function($q) use($contno){
                return $q->where('MP_Datas.Contract_MP','=',$contno);
                })
                ->where('MP_Datas.Type_Con','=','P04')
                ->orderBy('MP_Datas.Contract_MP', 'ASC')
                ->get();
            }

            $type = $request->type;
            $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
            $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
  
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                if ($value->branch_car == 'ปัตตานี') {
                    $Count50 += 1;
                }elseif ($value->branch_car == 'ยะลา') {
                    $Count51 += 1;
                }elseif ($value->branch_car == 'นราธิวาส') {
                    $Count52 += 1;
                }elseif ($value->branch_car == 'สายบุรี') {
                    $Count53 += 1;
                }elseif ($value->branch_car == 'โกลก') {
                    $Count54 += 1;
                }elseif ($value->branch_car == 'เบตง') {
                    $Count55 += 1;
                }elseif ($value->branch_car == 'โคกโพธิ์') {
                    $Count56 += 1;
                }elseif ($value->branch_car == 'ตันหยงมัส') {
                    $Count57 += 1;
                }elseif ($value->branch_car == 'รือเสาะ') {
                    $Count58 += 1;
                }elseif ($value->branch_car == 'บันนังสตา') {
                    $Count59 += 1;
                }elseif ($value->branch_car == 'ยะหา') {
                    $Count60 += 1;
                }
                }
                $SumAll = $Count50 + $Count51 + $Count52 + $Count53 + $Count54 + $Count55 + $Count56 + $Count57 + $Count58 + $Count59 + $Count60;
            }
  
            $topcar = DB::table('MP_Datas')
                ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->where('MP_Datas.Type_Con','=','P04')
                ->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate])
                ->get();
            $count = count($topcar);
  
            if($count != 0){
                for ($i=0; $i < $count; $i++) {
                @$SumTopcar += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                @$SumCommissioncar += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                @$SumCommitprice += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                }
            }else{
                $SumTopcar = 0;
                $SumCommissioncar = 0;
                $SumCommitprice = 0;
            }
  
          return view('Micro-Ploan.view_PLoan', compact('type', 'data','newfdate','newtdate','status','Setdate','SumTopcar','SumCommissioncar',
                                               'SumCommitprice','SumAll','contno','SetStrConn','SetStr1','SetStr2','Count50','Count51','Count52',
                                               'Count53','Count54','Count55','Count56','Count57','Count58','Count59','Count60'));
        }
        elseif ($request->type == 4) {  //Micro P07  (พนักงาน)
          if ($newfdate == '' and $newtdate == '') {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datacars.Date_Appcar','=',Null)
              ->where('MP_Datas.Type_Con','=','P07')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }else {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->when(!empty($status), function($q) use($status){
              return $q->where('MP_Datacars.StatusApp_car','=',$status);
              })
              ->when(!empty($contno), function($q) use($contno){
              return $q->where('MP_Datas.Contract_MP','=',$contno);
              })
              ->where('MP_Datas.Type_Con','=','P07')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }
  
            $type = $request->type;
            $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
            $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
    
            if ($data != NULL) {
              foreach ($data as $key => $value) {
                if ($value->branch_car == 'ปัตตานี') {
                    $Count50 += 1;
                }elseif ($value->branch_car == 'ยะลา') {
                    $Count51 += 1;
                }elseif ($value->branch_car == 'นราธิวาส') {
                    $Count52 += 1;
                }elseif ($value->branch_car == 'สายบุรี') {
                    $Count53 += 1;
                }elseif ($value->branch_car == 'โกลก') {
                    $Count54 += 1;
                }elseif ($value->branch_car == 'เบตง') {
                    $Count55 += 1;
                }elseif ($value->branch_car == 'โคกโพธิ์') {
                    $Count56 += 1;
                }elseif ($value->branch_car == 'ตันหยงมัส') {
                    $Count57 += 1;
                }elseif ($value->branch_car == 'รือเสาะ') {
                    $Count58 += 1;
                }elseif ($value->branch_car == 'บันนังสตา') {
                    $Count59 += 1;
                }elseif ($value->branch_car == 'ยะหา') {
                    $Count60 += 1;
                }
              }
              $SumAll = $Count50 + $Count51 + $Count52 + $Count53 + $Count54 + $Count55 + $Count56 + $Count57 + $Count58 + $Count59 + $Count60;
            }
    
            $topcar = DB::table('MP_Datas')
                ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->where('MP_Datas.Type_Con','=','P07')
                ->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate])
                ->get();
            $count = count($topcar);
    
            if($count != 0){
                for ($i=0; $i < $count; $i++) {
                @$SumTopcar += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                @$SumCommissioncar += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                @$SumCommitprice += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                }
            }else{
                $SumTopcar = 0;
                $SumCommissioncar = 0;
                $SumCommitprice = 0;
            }
  
          return view('Micro-Ploan.view_Micro', compact('type', 'data','newfdate','newtdate','status','Setdate','SumTopcar','SumCommissioncar',
                                               'SumCommitprice','SumAll','contno','SetStrConn','SetStr1','SetStr2','Count50','Count51','Count52',
                                               'Count53','Count54','Count55','Count56','Count57','Count58','Count59','Count60'));
        }
        elseif ($request->type == 5) {  //Micro P06
          if ($newfdate == '' and $newtdate == '') {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datacars.Date_Appcar','=',Null)
              ->where('MP_Datas.Type_Con','=','P06')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }else {
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->when(!empty($status), function($q) use($status){
              return $q->where('MP_Datacars.StatusApp_car','=',$status);
              })
              ->when(!empty($contno), function($q) use($contno){
              return $q->where('MP_Datas.Contract_MP','=',$contno);
              })
              ->where('MP_Datas.Type_Con','=','P06')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
          }
  
            $type = $request->type;
            $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
            $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
    
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                if ($value->branch_car == 'ปัตตานี') {
                    $Count50 += 1;
                }elseif ($value->branch_car == 'ยะลา') {
                    $Count51 += 1;
                }elseif ($value->branch_car == 'นราธิวาส') {
                    $Count52 += 1;
                }elseif ($value->branch_car == 'สายบุรี') {
                    $Count53 += 1;
                }elseif ($value->branch_car == 'โกลก') {
                    $Count54 += 1;
                }elseif ($value->branch_car == 'เบตง') {
                    $Count55 += 1;
                }elseif ($value->branch_car == 'โคกโพธิ์') {
                    $Count56 += 1;
                }elseif ($value->branch_car == 'ตันหยงมัส') {
                    $Count57 += 1;
                }elseif ($value->branch_car == 'รือเสาะ') {
                    $Count58 += 1;
                }elseif ($value->branch_car == 'บันนังสตา') {
                    $Count59 += 1;
                }elseif ($value->branch_car == 'ยะหา') {
                    $Count60 += 1;
                }
                }
                $SumAll = $Count50 + $Count51 + $Count52 + $Count53 + $Count54 + $Count55 + $Count56 + $Count57 + $Count58 + $Count59 + $Count60;
            }
  
            $topcar = DB::table('MP_Datas')
                ->join('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->join('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
                ->where('MP_Datas.Type_Con','=','P06')
                ->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate])
                ->get();
            $count = count($topcar);
  
            if($count != 0){
                for ($i=0; $i < $count; $i++) {
                @$SumTopcar += $topcar[$i]->Top_car; //รวมยอดจัดวันปัจจุบัน
                @$SumCommissioncar += $topcar[$i]->Commission_car; //รวมค่าคอมก่อนหักวันปัจจุบัน
                @$SumCommitprice += $topcar[$i]->commit_Price; //รวมค่าคอมหลังหักวันปัจจุบัน
                }
            }else{
                $SumTopcar = 0;
                $SumCommissioncar = 0;
                $SumCommitprice = 0;
            }
    
          return view('Micro-Ploan.view_Micro', compact('type', 'data','newfdate','newtdate','status','Setdate','SumTopcar','SumCommissioncar',
                                               'SumCommitprice','SumAll','contno','SetStrConn','SetStr1','SetStr2','Count50','Count51','Count52',
                                               'Count53','Count54','Count55','Count56','Count57','Count58','Count59','Count60'));
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
    public function store(Request $request)
    {
      $Micro_Ploan = new Micro_Ploan([
        'Contract_MP' => $request->get('Contract_MP'),
        'Flag' => $request->get('TypeContract'),
        'Type_Con' => $request->get('TypeContract'),
        'Date_Due' => $request->get('DateDue'),
      ]);
      $Micro_Ploan->save();

      $MP_Datacar = new MP_Datacar([
        'MP_id' => $Micro_Ploan->id,
        'StatusApp_car' => 'รออนุมัติ',
        'branch_car' => $request->get('BrachUser'),
        'Note_car' => 'เปิดเลขที่สัญญา',
      ]);
      $MP_Datacar ->save();

      return redirect()->back()->with('success','บันทึกเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $type = $request->type;
      $fdate = $request->fdate;
      $tdate = $request->tdate;
      $status = $request->status;
      $path = $request->path;
      $created_at = '';

      $data = MP_uploadfile_image::where('MP_id','=',$id)
          ->where('Type_fileimage','=','1')
          ->get();

      $countData = count($data);
      if($countData != 0){
        $dataold = Micro_Ploan::where('id','=',$id)->first();
        $created_at = substr($dataold->created_at,0,10);
      }

      return view('Micro-Ploan.viewimage', 
             compact('data','countData','id','type','fdate','tdate','status','path','created_at','dataold'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $fdate = $request->newfdate;
      $tdate = $request->newtdate;
      $type = $request->type;
      $status = $request->status;

      if ($type == 1 or $type == 3 or $type == 4 or $type == 5) {
        $data = DB::table('MP_Datas')
          ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
          ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
          ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
          ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
          ->leftJoin('MP_Upload_lat_longs','MP_Datas.id','=','MP_Upload_lat_longs.MP_id')
          ->leftJoin('data_customers','MP_Datas.Walkin_id','=','data_customers.Customer_id')
          ->select('MP_Datas.*','MP_Sponsors.*','MP_Sponsors2.*','MP_Datacars.*','MP_Expenses.*','MP_Upload_lat_longs.*','data_customers.Customer_id','data_customers.Resource_news','MP_Datas.created_at AS createdBuyers_at')
          ->where('MP_Datas.id',$id)
          ->first();

        $GetDocComplete = $data->DocComplete_car;
        $SubStr = substr($data->Contract_MP,0,3);
      }

      $dataImage = DB::table('MP_Uploadfile_images')->where('MP_id',$data->id)->get();
      $countImage = count($dataImage);

      $SettingValue = DB::table('mainsettings')
            ->where('Settype_set','=','เงินกู้')
            ->first();

      if ($type == 1 or $type == 4 or $type == 5) {   //P03-P06-P07
        return view('Micro-Ploan.edit',
          compact('data','id','dataImage','GetDocComplete','fdate','tdate','status','type','countImage','SubStr','SettingValue'));
      }elseif ($type == 3) {  //P04 (จักรยานยนต์)
        return view('Micro-Ploan.edit_Ploan',
          compact('data','id','dataImage','GetDocComplete','fdate','tdate','status','type','countImage','SubStr','SettingValue'));
      }
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
      $GetMP_Datacar = MP_Datacar::where('MP_id',$id)->first();
      //สร้างเลขที่สัญญา
      if ($request->get('BrachUser') == "50" or $request->get('BrachUser') == "ปัตตานี") {
        $NumBranch = "50";
      }elseif ($request->get('BrachUser') == "51" or $request->get('BrachUser') == "ยะลา") {
        $NumBranch = "51";
      }elseif ($request->get('BrachUser') == "52" or $request->get('BrachUser') == "นราธิวาส") {
        $NumBranch = "52";
      }elseif ($request->get('BrachUser') == "53" or $request->get('BrachUser') == "สายบุรี") {
        $NumBranch = "53";
      }elseif ($request->get('BrachUser') == "54" or $request->get('BrachUser') == "โกลก") {
        $NumBranch = "54";
      }elseif ($request->get('BrachUser') == "55" or $request->get('BrachUser') == "เบตง") {
        $NumBranch = "55";
      }elseif ($request->get('BrachUser') == "56" or $request->get('BrachUser') == "โคกโพธิ์") {
        $NumBranch = "56";
      }elseif ($request->get('BrachUser') == "57" or $request->get('BrachUser') == "ตันหยงมัส") {
        $NumBranch = "57";
      }elseif ($request->get('BrachUser') == "58" or $request->get('BrachUser') == "รือเสาะ") {
        $NumBranch = "58";
      }elseif ($request->get('BrachUser') == "59" or $request->get('BrachUser') == "บันนังสตา") {
        $NumBranch = "59";
      }elseif ($request->get('BrachUser') == "60" or $request->get('BrachUser') == "ยะหา") {
        $NumBranch = "60";
      }

      $GetYear = substr(date('Y')+543, 2,4);  //ดึงปี พ.ศ.
      $NewContract = $request->get('TypeContract').'-'.$GetYear.$NumBranch;

      if ($request->get('Topcar') != Null) {
        $SetTopcar = str_replace (",","",$request->get('Topcar'));
      }else {
        $SetTopcar = 0;
      }
      if ($request->get('Commissioncar') != Null) {
        $SetCommissioncar = str_replace (",","",$request->get('Commissioncar'));
      }else {
        $SetCommissioncar = 0;
      }
      $SetLicense = "";
      if ($request->get('Licensecar') != NULL) {
        $SetLicense = $request->get('Licensecar');
      }

      // กำหนด วันอนุมัติสัญญา
      $StatusApp = "รออนุมัติ";
      $newDateDue = $request->get('DateDue');
      if ($request->get('MANAGER') != Null) {
        if ($GetMP_Datacar->Date_Appcar == Null) {
          $newDateDue = date('Y-m-d');
        }
        $StatusApp = "อนุมัติ";
        if ($request->get('TypeContract') == "P03") {
          $SetFlag = "P03";
        }elseif ($request->get('TypeContract') == "P04") {
          $SetFlag = "P04";
        }elseif ($request->get('TypeContract') == "P06") {
          $SetFlag = "P06";
        }elseif ($request->get('TypeContract') == "P07") {
          $SetFlag = "P07";
        }
      }else {
        $newDateDue = $request->get('DateDue');
        $StatusApp = "รออนุมัติ";
        if ($request->get('TypeContract') == "P03") {
          $SetFlag = NULL;
        }elseif ($request->get('TypeContract') == "P04") {
          $SetFlag = NULL;
        }elseif ($request->get('TypeContract') == "P06") {
          $SetFlag = NULL;
        }elseif ($request->get('TypeContract') == "P07") {
          $SetFlag = NULL;
        }
      }

      if ($request->get('doccomplete') != Null) {
        $SetDocComplete = $request->get('doccomplete');
      }else {
        $SetDocComplete = NULL;
      }

      $user = Micro_Ploan::find($id);
        if ($GetMP_Datacar->Date_Appcar == NULL) { //เช็คอนุมัติ
          $user->Contract_MP = $NewContract;
          $user->Type_Con = $request->get('TypeContract');
          $user->Date_Due = $newDateDue;
        }
        $user->Name_MP = $request->get('NameMP');
        $user->last_MP = $request->get('lastMP');
        $user->Nick_MP = $request->get('NickMP');
        $user->Status_MP = $request->get('StatusMP');
        $user->Phone_MP = $request->get('PhoneMP');
        $user->Phone2_MP = $request->get('Phone2MP');
        $user->Mate_MP = $request->get('MateMP');
        $user->Idcard_MP = $request->get('IdcardMP');
        $user->Address_MP = $request->get('AddressMP');
        $user->AddN_MP = $request->get('AddNMP');
        $user->StatusAdd_MP = $request->get('StatusAddMP');
        $user->Workplace_MP = $request->get('WorkplaceMP');
        $user->House_MP = $request->get('HouseMP');
        $user->Driver_MP = $request->get('DriverMP');
        $user->HouseStyle_MP = $request->get('HouseStyleMP');
        $user->Career_MP = $request->get('CareerMP');
        $user->CareerDetail_MP = $request->get('CareerDetail');
        $user->ApproveDetail_MP = $request->get('ApproveDetail');
        $user->Income_MP = $request->get('IncomeMP');
        $user->Purchase_MP = $request->get('PurchaseMP');
        $user->Support_MP = $request->get('SupportMP');
        $user->securities_MP = $request->get('securitiesMP');
        $user->deednumber_MP = $request->get('deednumberMP');
        $user->area_MP = $request->get('areaMP');
        $user->BeforeIncome_MP = str_replace(",","",$request->get('Beforeincome'));
        $user->AfterIncome_MP = str_replace(",","",$request->get('Afterincome'));
        $user->GradeMP_car = $request->get('GradeMP');
        $user->Objective_car = $request->get('objectivecar');
        $user->Memo_MP = $request->get('Memo');
        $user->Prefer_MP = $request->get('MPprefer');
        $user->Memo_broker = $request->get('Memobroker');
        $user->Prefer_broker = $request->get('Brokerprefer');
        $user->Prefer_broker = $request->get('Brokerprefer');
        $user->MemoIncome_MP = $request->get('MPIncomeNote');
      $user->update();

      $sponsor = MP_Sponsor::where('MP_id',$id)->first();
        $sponsor->name_SP = $request->get('nameSP');
        $sponsor->lname_SP = $request->get('lnameSP');
        $sponsor->nikname_SP = $request->get('niknameSP');
        $sponsor->status_SP = $request->get('statusSP');
        $sponsor->tel_SP = str_replace ("_","",$request->get('telSP'));
        $sponsor->relation_SP = $request->get('relationSP');
        $sponsor->mate_SP = $request->get('mateSP');
        $sponsor->idcard_SP = $request->get('idcardSP');
        $sponsor->add_SP = $request->get('addSP');
        $sponsor->addnow_SP = $request->get('addnowSP');
        $sponsor->statusadd_SP = $request->get('statusaddSP');
        $sponsor->workplace_SP = $request->get('workplaceSP');
        $sponsor->house_SP = $request->get('houseSP');
        $sponsor->deednumber_SP = $request->get('deednumberSP');
        $sponsor->area_SP = $request->get('areaSP');
        $sponsor->housestyle_SP = $request->get('housestyleSP');
        $sponsor->career_SP = $request->get('careerSP');
        $sponsor->income_SP = $request->get('incomeSP');
        $sponsor->puchase_SP = $request->get('puchaseSP');
        $sponsor->support_SP = $request->get('supportSP');
        $sponsor->securities_SP = $request->get('securitiesSP');
        $sponsor->MemoIncome_SP = $request->get('SupportIncomeNote');
      $sponsor->update();

      $sponsor2 = MP_Sponsor2::where('MP_id',$id)->first();
      if ($sponsor2 != Null) {
          $sponsor2->name_SP2 = $request->get('nameSP2');
          $sponsor2->lname_SP2 = $request->get('lnameSP2');
          $sponsor2->nikname_SP2 = $request->get('niknameSP2');
          $sponsor2->status_SP2 = $request->get('statusSP2');
          $sponsor2->tel_SP2 = str_replace ("_","",$request->get('telSP2'));
          $sponsor2->relation_SP2 = $request->get('relationSP2');
          $sponsor2->mate_SP2 = $request->get('mateSP2');
          $sponsor2->idcard_SP2 = $request->get('idcardSP2');
          $sponsor2->add_SP2 = $request->get('addSP2');
          $sponsor2->addnow_SP2 = $request->get('addnowSP2');
          $sponsor2->statusadd_SP2 = $request->get('statusaddSP2');
          $sponsor2->workplace_SP2 = $request->get('workplaceSP2');
          $sponsor2->house_SP2 = $request->get('houseSP2');
          $sponsor2->deednumber_SP2 = $request->get('deednumberSP2');
          $sponsor2->area_SP2 = $request->get('areaSP2');
          $sponsor2->housestyle_SP2 = $request->get('housestyleSP2');
          $sponsor2->career_SP2 = $request->get('careerSP2');
          $sponsor2->income_SP2 = $request->get('incomeSP2');
          $sponsor2->puchase_SP2 = $request->get('puchaseSP2');
          $sponsor2->support_SP2 = $request->get('supportSP2');
          $sponsor2->securities_SP2 = $request->get('securitiesSP2');
        $sponsor2->update();
      }else {
        $SettelSP2 = str_replace ("_","",$request->get('telSP2'));
        $Sponsor2db = new MP_Sponsor2([
          'MP_id' => $id,
          'name_SP2' => $request->get('nameSP2'),
          'lname_SP2' => $request->get('lnameSP2'),
          'nikname_SP2' => $request->get('niknameSP2'),
          'status_SP2' => $request->get('statusSP2'),
          'tel_SP2' => $SettelSP2,
          'relation_SP2' => $request->get('relationSP2'),
          'mate_SP2' => $request->get('mateSP2'),
          'idcard_SP2' => $request->get('idcardSP2'),
          'add_SP2' => $request->get('addSP2'),
          'addnow_SP2' => $request->get('addnowSP2'),
          'statusadd_SP2' => $request->get('statusaddSP2'),
          'workplace_SP2' => $request->get('workplaceSP2'),
          'house_SP2' => $request->get('houseSP2'),
          'deednumber_SP2' => $request->get('deednumberSP2'),
          'area_SP2' => $request->get('areaSP2'),
          'housestyle_SP2' => $request->get('housestyleSP2'),
          'career_SP2' => $request->get('careerSP2'),
          'income_SP2' => $request->get('incomeSP2'),
          'puchase_SP2' => $request->get('puchaseSP2'),
          'support_SP2' => $request->get('supportSP2'),
          'securities_SP2' => $request->get('securitiesSP2'),
        ]);
        $Sponsor2db->save();
      }

      if ($request->type == 1 or $request->type == 3 or $request->type == 4 or $request->type == 5) {   //P03-P04-P07
        $cardetail = MP_Datacar::where('MP_id',$id)->first();
          $cardetail->Brand_car = $request->get('Brandcar');
          $cardetail->Year_car = $request->get('Yearcar');
          $cardetail->Typecardetails = $request->get('Typecardetail');
          $cardetail->Groupyear_car = $request->get('Groupyearcar');
          $cardetail->Colour_car = $request->get('Colourcar');
          $cardetail->IDTank_car = $request->get('IDTankcar');
          $cardetail->IDMachine_car = $request->get('IDMachinecar');
          $cardetail->License_car = $request->get('Licensecar');
          $cardetail->Nowlicense_car = $request->get('Nowlicensecar');
          $cardetail->Mile_car = $request->get('Milecar');
          $cardetail->Midprice_car = $request->get('Midpricecar');
          $cardetail->Model_car = $request->get('Modelcar');
          $cardetail->Top_car = $SetTopcar;
          $cardetail->Interest_car = $request->get('Interestcar');
          $cardetail->Vat_car = $request->get('Vatcar');
          $cardetail->Timeslacken_car = $request->get('Timeslackencar');
          $cardetail->Pay_car = $request->get('Paycar');
          $cardetail->Paymemt_car = $request->get('Paymemtcar');
          $cardetail->Timepayment_car = $request->get('Timepaymentcar');
          $cardetail->Tax_car = $request->get('Taxcar');
          $cardetail->Taxpay_car = $request->get('Taxpaycar');
          $cardetail->Totalpay1_car = $request->get('Totalpay1car');
          $cardetail->Totalpay2_car = $request->get('Totalpay2car');
          $cardetail->Insurance_key = $request->get('Insurancekey');

          // รูปภาพหน้าบัญชี
          if ($request->hasFile('Account_image')) {
            $AccountImage = $request->file('Account_image');
            $NameImage = $AccountImage->getClientOriginalName();
            
            //resize Image
            $Currdate = date('2021-01-01');
            $image_resize = Image::make($AccountImage->getRealPath());
            // $image_resize->resize(1500, 1000);
            $image_resize->resize(1200, null, function ($constraint) {
              $constraint->aspectRatio();
            });

            // $destination_path = public_path().'/upload-image/'.$SetLicense;
            // Storage::makeDirectory($destination_path, 0777, true, true);
            // $AccountImage->move($destination_path,$NameImage);
            // $cardetail->AccountImage_car = $NameImage;

            if(substr($user->created_at,0,10) < $Currdate){              
              $path = public_path().'/upload-image-MP/'.$SetLicense;
              File::makeDirectory($path, $mode = 0777, true, true);
              $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'. $NameImage);
              $cardetail->AccountImage_car = $NameImage;
            }
            else{
              $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
              File::makeDirectory($path, $mode = 0777, true, true);
              $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$NameImage);
              $cardetail->AccountImage_car = $NameImage;
            }
          }

          if ($request->get('BrachUser') == "50" or $request->get('BrachUser') == "ปัตตานี") {
            $SetBranch = "ปัตตานี";
          }elseif ($request->get('BrachUser') == "51" or $request->get('BrachUser') == "ยะลา") {
            $SetBranch = "ยะลา";
          }elseif ($request->get('BrachUser') == "52" or $request->get('BrachUser') == "นราธิวาส") {
            $SetBranch = "นราธิวาส";
          }elseif ($request->get('BrachUser') == "53" or $request->get('BrachUser') == "สายบุรี") {
            $SetBranch = "สายบุรี";
          }elseif ($request->get('BrachUser') == "54" or $request->get('BrachUser') == "โกลก") {
            $SetBranch = "โกลก";
          }elseif ($request->get('BrachUser') == "55" or $request->get('BrachUser') == "เบตง") {
            $SetBranch = "เบตง";
          }elseif ($request->get('BrachUser') == "56" or $request->get('BrachUser') == "โคกโพธิ์") {
            $SetBranch = "โคกโพธิ์";
          }elseif ($request->get('BrachUser') == "57" or $request->get('BrachUser') == "ตันหยงมัส") {
            $SetBranch = "ตันหยงมัส";
          }elseif ($request->get('BrachUser') == "58" or $request->get('BrachUser') == "รือเสาะ") {
            $SetBranch = "รือเสาะ";
          }elseif ($request->get('BrachUser') == "59" or $request->get('BrachUser') == "บันนังสตา") {
            $SetBranch = "บันนังสตา";
          }elseif ($request->get('BrachUser') == "60" or $request->get('BrachUser') == "ยะหา") {
            $SetBranch = "ยะหา";
          }

          // สถานะ อนุมัติสัญญา
          if ($StatusApp == "อนุมัติ") {
            if ($cardetail->StatusApp_car == "รออนุมัติ") {
              $Date = date('d-m-Y', strtotime('+1 month'));
              $SetDate = \Carbon\Carbon::parse($Date)->format('Y')+543 ."-". \Carbon\Carbon::parse($Date)->format('m')."-". \Carbon\Carbon::parse($Date)->format('d');
              $datedueBF = date_create($SetDate);
              $DateDue = date_format($datedueBF, 'd-m-Y');

              $Flag = $request->get('TypeContract');
              $connect = DB::table('MP_Datas')
                ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
                ->where('MP_Datas.Flag', '=' , $Flag)
                ->where('MP_Datacars.Branch_car' ,$cardetail->branch_car)
                ->orderBy('Contract_MP', 'desc')->limit(1)
                ->first();

              $SetStr = explode("-",$connect->Contract_MP);
              $StrNum = $SetStr[1] + 1;
              $StrConn = $SetStr[0]."-".$StrNum;
              
              $GetIdConn = Micro_Ploan::where('id',$id)->first();
                $GetIdConn->Contract_MP = $StrConn;
                $GetIdConn->Flag = $SetFlag;
              $GetIdConn->update();
            }
          }
          else { //รออนุมัติ
            if ($GetMP_Datacar->Date_Appcar == NULL) { //เช็คอนุมัติ
              $DateDue = NULL;      //วันดิวงวดแรก
              $newDateDue = NULL;   //วันอนุมัติ
              $StatusApp = "รออนุมัติ";
            } 
          }

          if ($GetMP_Datacar->Date_Appcar == NULL) { //เช็คอนุมัติ
            $cardetail->Dateduefirst_car = $DateDue;     //วันที่ ดิวงวดแรก
            $cardetail->Date_Appcar = $newDateDue;       //วันที่ อนุมัติ
            $cardetail->StatusApp_car = $StatusApp;      //สถานะ อนุมัติ
          }

          $cardetail->Insurance_car = $request->get('Insurancecar');
          $cardetail->status_car = $request->get('statuscar');
          $cardetail->Percent_car = $request->get('Percentcar');
          $cardetail->Payee_car = $request->get('Payeecar');
          $cardetail->IDcardPayee_car = $request->get('IDcardPayeecar');
          $cardetail->Accountbrance_car = $request->get('Accountbrancecar');
          $cardetail->Tellbrance_car = $request->get('Tellbrancecar');
          $cardetail->Agent_car = $request->get('Agentcar');
          $cardetail->IDcardAgent_car = $request->get('IDAgentcar');
          $cardetail->Accountagent_car = $request->get('Accountagentcar');
          $cardetail->Commission_car = $SetCommissioncar;
          $cardetail->Tellagent_car = $request->get('Tellagentcar');
          $cardetail->Purchasehistory_car = $request->get('Purchasehistorycar');
          $cardetail->Supporthistory_car = $request->get('Supporthistorycar');
          if ($GetMP_Datacar->Date_Appcar == NULL) { //เช็คอนุมัติ
            $cardetail->branch_car = $SetBranch;                       //สาขา   
          }
          $cardetail->DocComplete_car = $SetDocComplete;             //เอกสารครบ
          $cardetail->Check_car = $request->get('MASTER');           //หัวหน้า
          $cardetail->Approvers_car = $request->get('AUDIT');        //audit
          $cardetail->ManagerApp_car = $request->get('MANAGER');     //ผู้จัดการ
          $cardetail->branchbrance_car = $request->get('branchbrancecar');
          $cardetail->branchAgent_car = $request->get('branchAgentcar');
          $cardetail->Note_car = $request->get('Notecar');
        $cardetail->update();

        if ($request->get('totalkPrice') != Null) {
          $SettotalkPrice = str_replace (",","",$request->get('totalkPrice'));
        }else {
          $SettotalkPrice = 0;
        }
        if ($request->get('balancePrice') != Null) {
          $SetbalancePrice = str_replace (",","",$request->get('balancePrice'));
        }else {
          $SetbalancePrice = 0;
        }
        if ($request->get('commitPrice') != Null) {
          $SetcommitPrice = str_replace (",","",$request->get('commitPrice'));
        }else {
          $SetcommitPrice = 0;
        }
        if ($request->get('actPrice') != Null) {
          $SetactPrice = str_replace (",","",$request->get('actPrice'));
        }else {
          $SetactPrice = 0;
        }
        if ($request->get('closeAccountPrice') != Null) {
          $SetcloseAccountPrice = str_replace (",","",$request->get('closeAccountPrice'));
        }else {
          $SetcloseAccountPrice = 0;
        }
        if ($request->get('P2Price') != Null) {
          $SetP2Price = str_replace (",","",$request->get('P2Price'));
        }else {
          $SetP2Price = 0;
        }

        $expenses = MP_Expense::where('MP_id',$id)->first();
          $expenses->act_Price = $SetactPrice;
          $expenses->closeAccount_Price = $SetcloseAccountPrice;
          $expenses->P2_Price = $SetP2Price;
          $expenses->totalk_Price = $SettotalkPrice;
          $expenses->balance_Price = $SetbalancePrice;
          $expenses->commit_Price = $SetcommitPrice;
          $expenses->note_Price = $request->get('notePrice');
        $expenses->update();
      }

      // รูปภาพผู้เช่าซื้อและผู้ค่ำ
      if ($request->hasFile('file_image')) {
        $image_array = $request->file('file_image');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          //resize Image
          $image_resize = Image::make($image_array[$i]->getRealPath());
          // $image_resize->resize(1500, 1000);
          $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
          });

          $Currdate = date('2021-01-01');
          if(substr($user->created_at,0,10) < $Currdate){
            $path = public_path().'/upload-image-MP/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'.$image_new_name);
          }
          else{
            $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$image_new_name);
          }

          $Uploaddb = new MP_uploadfile_image([
            'MP_id' => $id,
            'Type_fileimage' => 1,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }
      // รูปภาพ Checker ผู้เช่าซื้อ
      if ($request->hasFile('image_checker_1')) {
        $image_array = $request->file('image_checker_1');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          //resize Image
          $image_resize = Image::make($image_array[$i]->getRealPath());
          // $image_resize->resize(1500, 1000);
          $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
          });

          $Currdate = date('2021-01-01');
          if(substr($user->created_at,0,10) < $Currdate){
            $path = public_path().'/upload-image-MP/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'.$image_new_name);
          }
          else{
            $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$image_new_name);
          }

          $Uploaddb = new MP_uploadfile_image([
            'MP_id' => $id,
            'Type_fileimage' => 2,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }
      // รูปภาพ Checker ผู้ค่ำ
      if ($request->hasFile('image_checker_2')) {
        $image_array = $request->file('image_checker_2');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          //resize Image
          $image_resize = Image::make($image_array[$i]->getRealPath());
          // $image_resize->resize(1500, 1000);
          $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
          });

          $Currdate = date('2021-01-01');
          // dd($user->created_at);
          if(substr($user->created_at,0,10) < $Currdate){
            $path = public_path().'/upload-image-MP/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'.$image_new_name);
          }
          else{
            $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$image_new_name);
          }

          $Uploaddb = new MP_uploadfile_image([
            'MP_id' => $id,
            'Type_fileimage' => 3,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }
      // รูปภาพ รายได้ ผู้เช่าซื้อ
      if ($request->hasFile('image_income_1')) {
        $image_array = $request->file('image_income_1');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          //resize Image
          $image_resize = Image::make($image_array[$i]->getRealPath());
          // $image_resize->resize(1500, 1000);
          $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
          });

          $Currdate = date('2021-01-01');
          // dd($user->created_at);
          if(substr($user->created_at,0,10) < $Currdate){
            $path = public_path().'/upload-image-MP/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'.$image_new_name);
          }
          else{
            $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$image_new_name);
          }

          $Uploaddb = new MP_uploadfile_image([
            'MP_id' => $id,
            'Type_fileimage' => 4,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }
      // รูปภาพ รายได้ ผู้ค้ำ
      if ($request->hasFile('image_income_2')) {
        $image_array = $request->file('image_income_2');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_lastname = $image_array[$i]->getClientOriginalExtension();
          $image_new_name = str_random(10).time(). '.' .$image_array[$i]->getClientOriginalExtension();

          //resize Image
          $image_resize = Image::make($image_array[$i]->getRealPath());
          // $image_resize->resize(1500, 1000);
          $image_resize->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
          });

          $Currdate = date('2021-01-01');
          if(substr($user->created_at,0,10) < $Currdate){
            $path = public_path().'/upload-image-MP/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$SetLicense.'/'.$image_new_name);
          }
          else{
            $path = public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense;
            File::makeDirectory($path, $mode = 0777, true, true);
            $image_resize->save(public_path().'/upload-image-MP/'.$request->TypeContract.'/'.$SetLicense.'/'.$image_new_name);
          }

          $Uploaddb = new MP_uploadfile_image([
            'MP_id' => $id,
            'Type_fileimage' => 5,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
        }
      }
      // ตำแหน่งที่ตั้ง ผู้เช่าซื้อ ผู้ค้ำ
      if($request->get('Buyer_latlong') != NULL){
        $StrBuyerLatlong = $request->get('Buyer_latlong');
      }else{
        $StrBuyerLatlong = NULL;
      }

      if($request->get('Support_latlong') != NULL){
        $StrSupporterlatLong = $request->get('Support_latlong');
      }else{
        $StrSupporterlatLong = NULL;
      }
      $Location = MP_upload_lat_long::where('MP_id',$id)->first();
      if($Location != null){
        $Location->Buyer_latlong = $StrBuyerLatlong;
        $Location->Support_latlong = $StrSupporterlatLong;
        $Location->Buyer_note = $request->get('BuyerNote');
        $Location->Support_note = $request->get('SupportNote');
        $Location->update();
      }else{
        $locationDB = new MP_upload_lat_long([
          'MP_id' => $user->id,
          'Buyer_latlong' => $request->get('Buyer_latlong'),
          'Support_latlong' => $request->get('Support_latlong'),
          'Buyer_note' => $request->get('BuyerNote'),
          'Support_note' => $request->get('SupportNote'),
        ]);
        $locationDB ->save();
      }

      $fdate = $request->fdate;
      $tdate = $request->tdate;
      $branch = $request->branch;
      $status = $request->status;

      if ($request->type == 1 or $request->type == 3 or $request->type == 4 or $request->type == 5) {
        return redirect()->back()->with(['newfdate' => $fdate,'newtdate' => $tdate,'status' => $status,'success' => 'อัพเดตข้อมูลเรียบร้อย']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $item1 = Micro_Ploan::find($id);
      $item2 = MP_Datacar::where('MP_id',$id);
      $item3 = MP_Sponsor::where('MP_id',$id);
      $item4 = MP_Sponsor2::where('MP_id',$id);
      $item5 = MP_Expense::where('MP_id',$id);
      $item6 = MP_upload_lat_long::where('MP_id',$id);

      $item7 = MP_uploadfile_image::where('MP_id','=',$id)->get();
      $countData = count($item7);

      if($countData != 0){
        $datacarold = MP_Datacar::where('MP_id',$id)->first();
        $path = $datacarold->License_car;
      }

      foreach ($item7 as $key => $value) {
        $itemID = $value->Buyerfileimage_id;
        $itemPath = public_path().'/upload-image-MP/'.$path;
        File::deleteDirectory($itemPath);
      }

      if ($countData != 0) {
        $deleteItem = MP_uploadfile_image::where('MP_id',$itemID);
        $deleteItem->Delete();
      }  

      // เปลี่ยนสถานะลูกค้า
      $UserCus = Data_customer::where('Customer_id',$item1->Walkin_id)->first();
      if ($UserCus != NULL) {
        $UserCus->Status_leasing = 1;
        $UserCus->update();
      }

      $item1->Delete();
      $item2->Delete();
      $item3->Delete();
      $item4->Delete();
      $item5->Delete();
      $item6->Delete();

      return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function destroyImage(Request $request, $id)
    {
      $mainid = $request->mainid;
      $path = $request->path;
      $typeCon = $request->TypeContract;
      $created_at = '';
      $Currdate = date('2021-01-01');

      if ($request->type == 1) {    //ลบที่ละรูป
        $item1 = MP_uploadfile_image::where('fileimage_id',$id);
        $data = MP_uploadfile_image::where('fileimage_id','=',$id)->get();
  
        $countData = count($data);
        if($countData != 0){
          $dataold = Micro_Ploan::where('id','=',$mainid)->first();
          $created_at = substr($dataold->created_at,0,10);
        }
  
        foreach ($data as $key => $value) {
          if($created_at < $Currdate){
            $itemPath = public_path().'/upload-image-MP/'.$path.'/'.$value->Name_fileimage;
          }
          else{
            $itemPath = public_path().'/upload-image-MP/'.$typeCon.'/'.$path.'/'.$value->Name_fileimage;
          }
          File::delete($itemPath);
        }
        
        $item1->Delete();
        return redirect()->back()->with('success','ลบรูปสำเร็จ');
      }
      else {
        $Currdate = date('2021-01-01');
        $data = Micro_Ploan::find($id);
        $created_at = substr($data->created_at,0,10);

        if ($request->Flag == 1) {      //ลบรูปทั้งหมด
          $item = MP_uploadfile_image::where('MP_id','=',$id)->get();
          $countData = count($item);
          if($countData != 0){
            $dataold = Micro_Ploan::where('id','=',$id)->first();
            $created_at = substr($dataold->created_at,0,10);
          }
  
          foreach ($item as $key => $value) {
            $itemID = $value->MP_id;
            if($created_at < $Currdate){
              $itemPath = public_path().'/upload-image-MP/'.$path;
            }
            else{
              $itemPath = public_path().'/upload-image-MP/'.$request->Typecon.'/'.$path;
            }
            File::deleteDirectory($itemPath);
          }

          $deleteItem = MP_uploadfile_image::where('MP_id',$itemID);
          $deleteItem->Delete();
        }
        elseif ($request->Flag == 2) {  //ลบรูป checker
          $item = DB::table('MP_Uploadfile_images')
                ->where('MP_id','=',$id)
                ->where('Type_fileimage','=', '2')
                ->get();
  
          if ($item != NULL) {
            foreach ($item as $key => $value) {
              if($created_at < $Currdate){
                $itemPath = public_path().'/upload-image-MP/'.$path.'/'.$value->Name_fileimage;
              }
              else{
                $itemPath = public_path().'/upload-image-MP/'.$request->Typecon.'/'.$path.'/'.$value->Name_fileimage;
              }

              File::delete($itemPath);
              $deleteItem = MP_uploadfile_image::where('fileimage_id',$value->fileimage_id);
              $deleteItem->Delete();
            }
  
          }
        }
        elseif ($request->Flag == 3) {  //ลบรูป checker
          $item = DB::table('MP_Uploadfile_images')
              ->where('MP_id','=',$id)
              ->where('Type_fileimage','=', '3')
              ->get();
  
          if ($item != NULL) {
            foreach ($item as $key => $value) {
              if($created_at < $Currdate){
                $itemPath = public_path().'/upload-image-MP/'.$path.'/'.$value->Name_fileimage;
              }
              else{
                $itemPath = public_path().'/upload-image-MP/'.$request->Typecon.'/'.$path.'/'.$value->Name_fileimage;
              }

              File::delete($itemPath);
              $deleteItem = MP_uploadfile_image::where('fileimage_id',$value->fileimage_id);
              $deleteItem->Delete();
            }
          }
        }
        elseif ($request->Flag == 4) {  //ลบรูป ที่มารายได้
          $item = DB::table('MP_Uploadfile_images')
              ->where('MP_id','=',$id)
              ->where('Type_fileimage','=', '4')
              ->get();
  
          if ($item != NULL) {
            foreach ($item as $key => $value) {
              if($created_at < $Currdate){
                $itemPath = public_path().'/upload-image-MP/'.$path.'/'.$value->Name_fileimage;
              }
              else{
                $itemPath = public_path().'/upload-image-MP/'.$request->Typecon.'/'.$path.'/'.$value->Name_fileimage;
              }

              File::delete($itemPath);
              $deleteItem = MP_uploadfile_image::where('fileimage_id',$value->fileimage_id);
              $deleteItem->Delete();;
            }
          }
        }
        elseif ($request->Flag == 5) {  //ลบรูป ที่มารายได้
          $item = DB::table('MP_Uploadfile_images')
              ->where('MP_id','=',$id)
              ->where('Type_fileimage','=', '5')
              ->get();
  
          if ($item != NULL) {
            foreach ($item as $key => $value) {
              if($created_at < $Currdate){
                $itemPath = public_path().'/upload-image-MP/'.$path.'/'.$value->Name_fileimage;
              }
              else{
                $itemPath = public_path().'/upload-image-MP/'.$request->Typecon.'/'.$path.'/'.$value->Name_fileimage;
              }

              File::delete($itemPath);
              $deleteItem = MP_uploadfile_image::where('fileimage_id',$value->fileimage_id);
              $deleteItem->Delete();;
            }
  
          }
        }

        return redirect()->back()->with('success','ลบรูปทั้งหมดเรียบร้อย');
      }
    }

    public function ReportPDFIndex(Request $request, $id)
    {
      if ($request->type == 1) {      //ใบเหลือง
        $dataReport = DB::table('MP_Datas')
          ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
          ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
          ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
          ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
          ->leftJoin('data_customers','MP_Datas.Walkin_id','=','data_customers.Customer_id')
          ->select('MP_Datas.*','MP_Sponsors.*','MP_Sponsors2.*','MP_Datacars.*','MP_Expenses.*','data_customers.Customer_id','data_customers.Resource_news','MP_Datas.created_at AS createdBuyers_at')
          ->where('MP_Datas.id',$id)
          ->first();

        $DateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('d')."-".\Carbon\Carbon::parse($dataReport->Date_Due)->format('m');
        $DateDueYear = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543;
  
        $newDateDue = $DateDue."-".$DateDueYear;
        $now = Carbon::now();
        $date = Carbon::parse($now)->format('d-m-Y');
  
        $view = \View::make('Micro-Ploan.ReportMP' ,compact('dataReport','newDateDue','date'));
        $html = $view->render();
  
        $pdf = new PDF();
        $pdf::SetTitle('แบบฟอร์มขออนุมัติเงินกู้');
        $pdf::AddPage('P', 'A4');
        $pdf::SetMargins(10, 5, 5, 5);
        $pdf::SetFont('freeserif', '', 11, '', true);
        $pdf::SetAutoPageBreak(TRUE, 5);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
      }
      elseif ($request->type == 2) {
        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $Y2 = date('Y') +543;
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;
        $date2 = $d.'-'.$m.'-'.$Y2;
        
        $newfdate = date('Y-m-d');
        $newtdate = date('Y-m-d');
        if($request->Flagtype == 1){   //รายงานขออนุมัติประจำวัน

          if ($request->Flag == 1) {       //P03
            $dataReport = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datas.Date_Due', $date)
              ->where('MP_Datas.Type_Con','=','P03')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
  
            $type = 1;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานขออนุมัติประจำวัน P03');
          }
          elseif ($request->Flag == 2) {   //P04
            $dataReport = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datas.Date_Due', $date)
              ->where('MP_Datas.Type_Con','=','P04')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
  
            $type = 2;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานขออนุมัติประจำวัน P04');
          }
          elseif ($request->Flag == 3) {   //P06
            $dataReport = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datas.Date_Due', $date)
              ->where('MP_Datas.Type_Con','=','P06')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
  
            $type = 3;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานขออนุมัติประจำวัน P06');
          }
          elseif ($request->Flag == 4) {   //P07
            $dataReport = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Sponsors2','MP_Datas.id','=','MP_Sponsors2.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->where('MP_Datas.Date_Due', $date)
              ->where('MP_Datas.Type_Con','=','P07')
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
  
            $type = 4;
            $view = \View::make('Micro-Ploan.ReportDueDate' ,compact('dataReport','date2','type','newfdate','newtdate'));
            $html = $view->render();
            $pdf = new PDF();
            $pdf::SetTitle('รายงานขออนุมัติประจำวัน P07');
          }
          
          $pdf::AddPage('L', 'A4');
          $pdf::SetMargins(5, 5, 5, 0);
          $pdf::SetFont('freeserif', '', 8, '', true);
          $pdf::SetAutoPageBreak(TRUE, 25);
    
          $pdf::WriteHTML($html,true,false,true,false,'');
          $pdf::Output('report.pdf');
        }
        elseif ($request->Flagtype == 2) {  //รายงาน สัญญาเงินกู้
          $newfdate = '';
          $newtdate = '';
  
          if ($request->has('Fromdate')){
              $newfdate = $request->get('Fromdate');
          }
          if ($request->has('Todate')){
              $newtdate = $request->get('Todate');
          }

          if ($request->Flag == 1) {      //P03
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->leftJoin('MP_Upload_lat_longs','MP_Datas.id','=','MP_Upload_lat_longs.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datas.Type_Con','=','P03')
              ->where('MP_Datacars.Approvers_car','!=',Null)
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();
  
            $status = 'สัญญาเงินกู้รถยนต์ P03';
          }
          elseif ($request->Flag == 2) {  //P04
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->leftJoin('MP_Upload_lat_longs','MP_Datas.id','=','MP_Upload_lat_longs.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datas.Type_Con','=','P04')
              ->where('MP_Datacars.Approvers_car','!=',Null)
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();

            $status = 'สัญญาเงินกู้รถจักรยานยนต์ P04';
          }
          elseif ($request->Flag == 3) {  //P06
            $data = DB::table('MP_Datas')
              ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
              ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
              ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
              ->leftJoin('MP_Upload_lat_longs','MP_Datas.id','=','MP_Upload_lat_longs.MP_id')
              ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
              })
              ->where('MP_Datas.Type_Con','=','P06')
              ->where('MP_Datacars.Approvers_car','!=',Null)
              ->orderBy('MP_Datas.Contract_MP', 'ASC')
              ->get();

            $status = 'สัญญาเงินกู้รถยนต์ P06';
          }
          elseif ($request->Flag == 4) {  //P07
            $data = DB::table('MP_Datas')
            ->leftJoin('MP_Datacars','MP_Datas.id','=','MP_Datacars.MP_id')
            ->leftJoin('MP_Sponsors','MP_Datas.id','=','MP_Sponsors.MP_id')
            ->leftJoin('MP_Expenses','MP_Datas.id','=','MP_Expenses.MP_id')
            ->leftJoin('MP_Upload_lat_longs','MP_Datas.id','=','MP_Upload_lat_longs.MP_id')
            ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
              return $q->whereBetween('MP_Datas.Date_Due',[$newfdate,$newtdate]);
            })
            ->where('MP_Datas.Type_Con','=','P07')
            ->where('MP_Datacars.Approvers_car','!=',Null)
            ->orderBy('MP_Datas.Contract_MP', 'ASC')
            ->get();

            $status = 'สัญญาเงินกู้พนักงาน P07';
          }
  
          Excel::create('รายการสัญญาเงินกู้ (PLoan - Micro)', function ($excel) use($data,$status) {
            $excel->sheet($status, function ($sheet) use($data,$status) {
                $sheet->prependRow(1, array("บริษัท ชูเกียรติลิสซิ่ง จำกัด"));
                $sheet->prependRow(2, array($status));
                $sheet->cells('A3:AR3', function($cells) {
                  $cells->setBackground('#FFCC00');
                });
                $row = 3;
                $sheet->row($row, array('ลำดับ','ประเภท','เลขที่สัญญา', 'ชื่อ-สกุล','สาขา', 'วันที่โอน', 'สถานะ',
                  'ยี่ห้อ','รุ่น','ปี', 'ทะเบียนเดิม','ทะเบียนใหม่', 'ยอดจัด', 'ค่าดำเนินการ', 'ชำระต่องวด', 'กำไรดอกเบี้ย','ดอกเบี้ย/เดือน','งวดผ่อน(เดือน)',
                  'พรบ.','ยอดปิดบัญชี','ซื้อประกัน', '% ยอดจัด','ค่าใช้จ่ายขนส่ง','อื่นๆ','ค่าประเมิน','ค่าการตลาด','อากร',
                  'รวม คชจ', 'คงเหลือ', 'ค่าคอมก่อนหัก 3%', 'ค่าคอมหลังหัก 3%', 
                  'เลขที่โฉนดผู้ค่ำ', 'ผู้รับเงิน','เลขบัญชี','เบอร์โทรผู้รับเงิน', 'ผู้รับค่าคอม','เลขบัญชี','เบอร์โทรผู้แนะนำ', 
                  'ใบขับขี่','ประกันภัย','สถานะผู้เช่าซื้อ','ตำแหน่งที่อยู่ผู้เช่าซื้อ', 'ตำแหน่งที่อยู่ผู้ค่ำ','รายละเอียดอาชีพ','ผลการประเมินลูกค้า', 'ผลการตรวจสอบลูกค้า','ความพึงพอใจลูกค้า','ผลการตรวจสอบนายหน้า','ความพึงพอใจนายหน้า'));
  
                foreach ($data as $key => $value) {
  
                  $sheet->row(++$row, array(
                    $key+1,
                    $value->Type_Con,
                    $value->Contract_MP,
                    $value->Name_MP.' '.$value->last_MP,
                    $value->branch_car,
                    $value->Date_Due,
                    $value->status_car,
                    $value->Brand_car,
                    $value->Model_car,
                    $value->Year_car,
                    $value->License_car,
                    $value->Nowlicense_car,
                    number_format($value->Top_car, 2),
                    $value->Vat_car,
                    $value->Pay_car,
                    $value->Tax_car,
                    $value->Interest_car,
                    $value->Timeslacken_car,
                    $value->act_Price,
                    $value->closeAccount_Price,
                    $value->P2_Price,
                    $value->Percent_car,
                    'NULL',
                    'NULL',
                    'NULL',
                    'NULL',
                    'NULL',
                    $value->totalk_Price,
                    $value->balance_Price,
                    $value->Commission_car,
                    $value->commit_Price,
                    $value->deednumber_SP,
                    $value->Payee_car,
                    $value->Accountbrance_car,
                    $value->Tellbrance_car,
                    $value->Agent_car,
                    $value->Accountagent_car,
                    $value->Tellagent_car,
                    $value->Driver_MP,
                    $value->Insurance_car,
                    $value->GradeMP_car,
                    $value->Buyer_latlong,
                    $value->Support_latlong,
                    $value->CareerDetail_MP,
                    $value->ApproveDetail_MP,
                    $value->Memo_MP,
                    $value->Prefer_MP,
                    $value->Memo_broker,
                    $value->Prefer_broker,
                  ));
  
                }
            });
          })->export('xlsx');
        }
      }
    }
}
