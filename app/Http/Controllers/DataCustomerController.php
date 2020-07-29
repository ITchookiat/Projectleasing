<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data_customer;

class DataCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->get('Topcar') != Null) {
            $SetTopcar = str_replace (",","",$request->get('Topcar'));
        }else {
            $SetTopcar = 0;
        }
        $Customerdb = new Data_customer([
            'License_car' => $request->get('Licensecar'),
            'Brand_car' => $request->get('Brandcar'),
            'Model_car' => $request->get('Modelcar'),
            'Typecardetails' => $request->get('Typecardetail'),
            'Top_car' => $SetTopcar,
            'Year_car' => $request->get('Yearcar'),
            'Phone_buyer' => $request->get('Phonebuyer'),
            'Phone_agent' => $request->get('Phoneagent'),
            'Resource_news' => $request->get('News'),
            'Branch_car' => $request->get('branchcar'),
            'Note_car' => $request->get('Notecar'),
            'Type_leasing' => $request->get('TypeLeasing'),
            // 'Status_leasing' => $request->get('Status_leasing'),
          ]);
          $Customerdb->save();
          return redirect()->back()->with('success','บันทึกเรียบร้อยแล้ว');
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
}
