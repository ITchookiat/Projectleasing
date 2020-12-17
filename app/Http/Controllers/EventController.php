<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use DB;
use File;
use App\Event;
use App\UploadfileImage;
use App\Informations;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->type == 1) {
            $events = Event::selectRaw('title, start_date AS start, end_date AS [end], color, events_id')
                    ->get();

            foreach ($events as $key => $value) {
                $value->end = date('Y-m-d', strtotime("+1 day", strtotime($value->end)));
            }

            $Info = DB::table('informations')
                ->where('informations.Status_info','=','Public')
                ->orderBy('informations.Info_id', 'DESC')
                ->get();

            return view('event-info.view', compact('calendar','events','Info'));
        }
        elseif ($request->type == 2) {
            $data = Informations::orderBy('Info_id', 'DESC')->get();
        
            return view('event-info.DetaInfo', compact('data'));
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
        $DateStart = '';
        $DateEnd = '';
        if ($request->get('DateRage') != NULL) {
            $DateStart = substr($request->get('DateRage'),0,10);
            $DateEnd = substr($request->get('DateRage'),13,19);
        }

        $Events = new Event([
            'title' => $request->get('title'),
            'color' => $request->get('color'),
            'start_date' => $DateStart,
            'end_date' => $DateEnd,
            'Note_events' => $request->get('Note'),
            'User_generate' => auth()->user()->name,
            'Date_generate' => date('Y-m-d'),
            'Branch_user' => auth()->user()->branch,
          ]);
        $Events->save();

        if ($request->hasFile('image_Event')) {
            $image_array = $request->file('image_Event');
            $array_len = count($image_array);

            for ($i=0; $i < $array_len; $i++) {
                $image_size = $image_array[$i]->getClientSize();
                $image_lastname = $image_array[$i]->getClientOriginalExtension();
                $image_new_name = $image_array[$i]->getClientOriginalName();

                $destination_path = public_path().'/upload-Events/'.$request->get('title');
                $image_array[$i]->move($destination_path,$image_new_name);

                $SetType = "Events"; //ประเภทรูปภาพ รูปประกอบ
                $Uploaddb = new UploadfileImage([
                    'Buyerfileimage_id' => $Events->events_id,
                    'Type_fileimage' => $SetType,
                    'Name_fileimage' => $image_new_name,
                    'Size_fileimage' => $image_size,
                ]);
                $Uploaddb ->save();
            }
        }

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function ShowEvent(Request $request, $type){
        if ($type == 1) {
            $GeteventID = $request->id;
            
            $data = DB::table('events')
                ->where('events.events_id','=', $GeteventID)
                ->first();

            if ($data != NULL) {
                $image = DB::table('uploadfile_images')
                    ->where('uploadfile_images.Buyerfileimage_id','=', $GeteventID)
                    ->get();
            }

            return response()->view('event-info.editEvents', compact('data','image'));
            // return view('event-info.view', compact('data','image','events'));
        }
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
            if ($request->get('DateRage') != NULL) {
                $DateStart = substr($request->get('DateRage'),0,10);
                $DateEnd = substr($request->get('DateRage'),13,19);
            }

            $Events = Event::find($id);
                $Events->title = $request->get('title');
                $Events->color = $request->get('color');
                $Events->start_date = $DateStart;
                $Events->end_date = $DateEnd;
                $Events->Note_events = $request->get('Note');
            $Events->update();

            if ($request->hasFile('image_Event')) {
                $image_array = $request->file('image_Event');
                $array_len = count($image_array);

                for ($i=0; $i < $array_len; $i++) {
                    $image_size = $image_array[$i]->getClientSize();
                    $image_lastname = $image_array[$i]->getClientOriginalExtension();
                    $image_new_name = $image_array[$i]->getClientOriginalName();

                    $destination_path = public_path().'/upload-Events/'.$request->get('title');
                    $image_array[$i]->move($destination_path,$image_new_name);

                    $SetType = "Events"; //ประเภทรูปภาพ รูปประกอบ
                    $Uploaddb = new UploadfileImage([
                        'Buyerfileimage_id' => $Events->events_id,
                        'Type_fileimage' => $SetType,
                        'Name_fileimage' => $image_new_name,
                        'Size_fileimage' => $image_size,
                    ]);
                    $Uploaddb ->save();
                }
            }

            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
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

    public function DeleteEvents($id, $path, $type)
    {
        if ($type == 1) {
            $item1 = Event::find($id);
            $image = UploadfileImage::where('Buyerfileimage_id','=',$id)->get();

            if ($image != NULL) {
                foreach ($image as $key => $value) {
                    $itemID = $value->Buyerfileimage_id;
                    $itemPath = public_path().'/upload-Events/'.$path;
                    File::deleteDirectory($itemPath);

                    $deleteItem = UploadfileImage::where('fileimage_id',$value->fileimage_id);
                    $deleteItem->Delete();
                }
            }
            $item1->Delete();

            return redirect()->Route('MasterEvents.index',['type' => 1])->with('success','ลบข้อมูลเรียบร้อย');
        }
        elseif ($type == 2) {
            $item = UploadfileImage::where('Buyerfileimage_id','=',$id)->get();
            if ($item != NULL) {
                foreach ($item as $key => $value) {
                  $itemPath = public_path().'/upload-Events/'.$path.'/'.$value->Name_fileimage;
                  File::delete($itemPath);
      
                  $deleteItem = UploadfileImage::where('fileimage_id',$value->fileimage_id);
                  $deleteItem->Delete();
                }
              }
      
            return redirect()->route('MasterEvents.index',['type' => 1])->with('success','ลบรูปทั้งหมดเรียบร้อยแล้ว');
        }
    }
}
