<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;

use App\Buyer;
use App\Sponsor;
use App\Cardetail;
use App\Expenses;

class ReportAnalysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('sdfdsfd');
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
        //
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
        //
    }

    public function ReportPDFIndex(Request $request, $id)
    {
      $dataReport = DB::table('buyers')
                      ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                      ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                      ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                      ->where('buyers.id',$id)->first();

      // $newDateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543 ."-". \Carbon\Carbon::parse($dataReport->Date_Due)->format('m')."-". \Carbon\Carbon::parse($dataReport->Date_Due)->format('d');
      $DateDue = \Carbon\Carbon::parse($dataReport->Date_Due)->format('d')."-".\Carbon\Carbon::parse($dataReport->Date_Due)->format('m');
      $DateDueYear = \Carbon\Carbon::parse($dataReport->Date_Due)->format('Y')+543;

      $newDateDue = $DateDue."-".$DateDueYear;
      // dd($newDateDue);
      $now = Carbon::now();
      $date = Carbon::parse($now)->format('d-m-Y');
      // dd($date);

      $view = \View::make('analysis.ReportAnalys' ,compact('dataReport','newDateDue','date'));
      $html = $view->render();
      // $title = '<h2>รายการรถยนต์ พร้อมขาย</h2>';
      $pdf = new PDF();
      $pdf::SetTitle('แบบฟอร์มขออนุมัติเช่าซื้อรถยนต์');
      $pdf::AddPage('P', 'A4');
      $pdf::SetFont('freeserif');
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }

    public function ReportDueDate(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $Y2 = date('Y') +543;
      $m = date('m');
      $d = date('d');
      $date = $Y.'-'.$m.'-'.$d;
      $date2 = $d.'-'.$m.'-'.$Y2;

      $dataReport = DB::table('buyers')
                      ->join('sponsors','buyers.id','=','sponsors.Buyer_id')
                      ->join('cardetails','Buyers.id','=','cardetails.Buyercar_id')
                      ->join('Expenses','Buyers.id','=','Expenses.Buyerexpenses_id')
                      ->where('cardetails.Date_Appcar',$date)
                      ->where('cardetails.Approvers_car','<>','')
                      ->get();

      // dd($dataReport);
      $view = \View::make('analysis.ReportDueDate' ,compact('dataReport','date2'));
      $html = $view->render();
      $pdf = new PDF();
      $pdf::SetTitle('รายงานนำเสนอ');
      $pdf::AddPage('L', 'A4');
      $pdf::SetFont('freeserif','',8,'false');
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }
}
