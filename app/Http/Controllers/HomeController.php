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
        
        return view($name);
    }

    public function get_json(Request $request)
    {
        $data = '{
            "1":{
                "2015-2019":[12,18,24,30,36,42,48,54,60,66,72,78,84],
                "2012-2014":[12,18,24,30,36,42,48,54,60,66,72],
                "2010-2011":[12,18,24,30,36,42,48,54,60,66,72],
                "2009":[12,18,24,30,36,42,48,54,60,66,72],
                "2008":[12,18,24,30,36,42,48,54,60,66,72],
                "2007":[12,18,24,30,36,42,48,54,60],
                "2006":[12,18,24,30,36,42,48,54,60],
                "2005-2003":[12,18,24,30,36,42,48]
            },
            "2":{
                "2015-2019":[12,18,24,30,36,42,48,54,60,66,72,78,84],
                "2012-2014":[12,18,24,30,36,42,48,54,60,66,72],
                "2010-2011":[12,18,24,30,36,42,48,54,60,66,72],
                "2009":[12,18,24,30,36,42,48,54,60,66,72],
                "2008":[12,18,24,30,36,42,48,54,60,66,72],
                "2007":[12,18,24,30,36,42,48,54,60],
                "2006":[12,18,24,30,36,42,48,54,60],
                "2005-2003":[12,18,24,30,36,42,48]
            },
            "3":{
                "2015-2020":[12,18,24,30,36,42,48,54,60],
                "2013-2014":[12,18,24,30,36,42,48,54,60],
                "2010-2012":[12,18,24,30,36,42,48,54,60],
                "2008-2009":[12,18,24,30,36,42,48],
                "2006-2007":[12,18,24,30,36,42,48],
                "2004-2005":[12,18,24,30,36]
            }
        }';

        $json_data = json_decode($data);
        // dd($json_data);
        $type = $request->type;
        $year = $request->year;
        $showtext = $request->showtext;

        switch ($request->action) {
            case 'type':
                echo "<option value='0'>- เลือกปี -</option>";
                foreach ($json_data->$type as $year => $value) {
                    echo "<option value='$year' >$year</option>" ;
                }
                break;
            case 'year':
                foreach ($json_data->$type->$year as $value) {
                    echo "<option value='$value' >$value</option>" ;
                }
                break;
            case 'showtext':
                foreach ($json_data->$type->$year as $value) {
                    echo "<option value='$value' >$value</option>" ;
                }
                break;

            default:
                # code...
                break;
        }
    }
}
