<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Informations;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Informations::orderBy('Info_id', 'DESC')->get();

        return view('event-info.DetaInfo', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = Informations::all();
        return view('event-info.createInfo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $DateStart = '';
        $DateEnd = '';
        if ($request->get('DateRage') != NULL) {
            $DateStart = substr($request->get('DateRage'),0,10);
            $DateEnd = substr($request->get('DateRage'),13,19);
        }

        header ('X-XSS-Protection: 0') ;
        $detail = $request->messageInput;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);

        $detail = $dom->savehtml();
        $summernote = new Informations;
            $summernote->name_info = $request->nameContents;
            $summernote->SDate_info = $DateStart;
            $summernote->EDate_info = $DateEnd;
            $summernote->Notes_info = $request->get('Note');
            $summernote->content_info = $detail;
            $summernote->User_generate = auth()->user()->name;
            $summernote->Date_generate = date('Y-m-d');
        $summernote->save();

        // return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        return redirect()->Route('MasterEvents.index')->with('success','บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DB::table('informations')
            ->where('informations.Info_id',$id)
            ->first();

        return view('event-info.showInfo', compact('item'));
    }

    public function ShowInfo(Request $request, $type, $id)
    {
        $data = DB::table('informations')
            ->where('SDate_info','=',date('Y-m-d'))
            ->get();

        $countData = Count($data);
        if ($countData == 0) {
            $countData = NULL;
        }else {
            $countData = '<span class="badge badge-danger navbar-badge">'.$countData.'</span>';
        }
        
        echo $countData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        if ($request->type == 1) {
            $DateStart = '';
            $DateEnd = '';
            if ($request->get('dateRangInfo') != NULL) {
                $DateStart = substr($request->get('dateRangInfo'),0,10);
                $DateEnd = substr($request->get('dateRangInfo'),13,19);
            }

            // dd($request->get('messageInput'));

            $Info = Informations::find($id);
                $Info->name_info = $request->get('nameContents');
                $Info->SDate_info = $DateStart;
                $Info->EDate_info = $DateEnd;
                $Info->Notes_info = $request->get('Note');
                $Info->content_info = $request->get('messageInput');
            $Info->update();

            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
            // return redirect()->Route('MasterEvents.index')->with('success','บันทึกข้อมูลเรียบร้อย');
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
        $item1 = Informations::find($id);
        $item1->Delete();

        if ($request->type == 1) {
            return redirect()->Route('MasterEvents.index')->with('success','ลบข้อมูลเรียบร้อย');
        }else {
            return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
        }
    }
}
