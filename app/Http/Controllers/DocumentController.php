<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use DB;
use File;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('documents')->get();
        return view('document.view', compact('data','newfdate','newtdate'));
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
        // dd($request);
        $data = new Document;
        if($request->file('file')){
            $file = $request->file('file');
            $filesize = $file->getClientSize();
            $filename = $request->title.time(). '.' .$file->getClientOriginalExtension();
            // $filename = time().'.'.$file->getClientOriginalExtension();
            $destination_path = public_path('/file-documents');
            // $request->file->move($destination_path.'/'.$filename);
            $request->file->move($destination_path, $filename);
            $data->file_name = $filename;
            $data->file_size = $filesize;
        }
        $data->file_title = $request->title;
        $data->file_description = $request->description;
        $data->file_uploader = $request->uploader;
        $data->save();

        return redirect()->back()->with('success','ข้อมูลเรียบร้อย');
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
        // dd($id);
        $data = Document::find($id);
        return view('document.preview',compact('data'));
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
        $item1 = Document::find($id);
        $itemPath = public_path().'/file-documents/'.$item1->file_name;
        File::delete($itemPath);
        $item1->Delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }
    public function download($file)
    {   
        // dd($file);
        $destination_path = public_path('/file-documents');
        return response()->download($destination_path. '/' .$file);
    }
}
