<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LegislationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
               // $pt[] = (iconv('TIS-620', 'utf-8', str_replace(" ","",$pt_stat[$i]->BAAB)));

      $data = DB::connection('ibmi')
            ->table('SFHP.ARMAST')
            // ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
            ->where('SFHP.ARMAST.HLDNO', '=', '7')
            // ->where('SFHP.ARMAST.CONTSTAT', 'like', "¶")
            ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
            ->get();

            $test = iconv('TIS-620', 'utf-8',$data[0]->CONTSTAT);
            dump($test);

            $data1 = DB::connection('ibmi')
                  ->table('SFHP.ARMAST')
                  // ->join('SFHP.INVTRAN','SFHP.ARMAST.CONTNO','=','SFHP.INVTRAN.CONTNO')
                  ->where('SFHP.ARMAST.HLDNO', '=', '7')
                  ->where('SFHP.ARMAST.CONTSTAT', 'like', $test)
                  ->orderBy('SFHP.ARMAST.CONTNO', 'ASC')
                  ->get();

                  dd($data1);
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
}
