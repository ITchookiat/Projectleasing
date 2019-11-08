@extends('layouts.master')
@section('title','แผนกเร่งรัดหนี้สิน')
@section('content')

@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }
@endphp

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<style>
  #todo-list{
  width:100%;
  margin:0 auto 0px auto;
  padding:5px;
  background:white;
  position:relative;
  /*box-shadow*/
  -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
   -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  /*border-radius*/
  -webkit-border-radius:5px;
   -moz-border-radius:5px;
        border-radius:5px;
  }
  #todo-list:before{
  content:"";
  position:absolute;
  z-index:-1;
  /*box-shadow*/
  -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
        box-shadow:0 0 20px rgba(0,0,0,0.4);
  top:50%;
  bottom:0;
  left:10px;
  right:10px;
  /*border-radius*/
  -webkit-border-radius:100px / 10px;
   -moz-border-radius:100px / 10px;
        border-radius:100px / 10px;
  }
  .todo-wrap{
  display:block;
  position:relative;
  padding-left:35px;
  /*box-shadow*/
  -webkit-box-shadow:0 2px 0 -1px #ebebeb;
   -moz-box-shadow:0 2px 0 -1px #ebebeb;
        box-shadow:0 2px 0 -1px #ebebeb;
  }
  .todo-wrap:last-of-type{
  /*box-shadow*/
  -webkit-box-shadow:none;
   -moz-box-shadow:none;
        box-shadow:none;
  }
  input[type="checkbox"]{
  position:absolute;
  height:0;
  width:0;
  opacity:0;
  /* top:-600px; */
  }
  .todo{
  display:inline-block;
  font-weight:200;
  padding:10px 5px;
  height:37px;
  position:relative;
  }
  .todo:before{
  content:'';
  display:block;
  position:absolute;
  top:calc(50% + 2px);
  left:0;
  width:0%;
  height:1px;
  background:#cd4400;
  /*transition*/
  -webkit-transition:.25s ease-in-out;
   -moz-transition:.25s ease-in-out;
     -o-transition:.25s ease-in-out;
        transition:.25s ease-in-out;
  }
  .todo:after{
  content:'';
  display:block;
  position:absolute;
  z-index:0;
  height:18px;
  width:18px;
  top:9px;
  left:-25px;
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
   -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
        box-shadow:inset 0 0 0 2px #d8d8d8;
  /*transition*/
  -webkit-transition:.25s ease-in-out;
   -moz-transition:.25s ease-in-out;
     -o-transition:.25s ease-in-out;
        transition:.25s ease-in-out;
  /*border-radius*/
  -webkit-border-radius:4px;
   -moz-border-radius:4px;
        border-radius:4px;
  }
  .todo:hover:after{
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #949494;
   -moz-box-shadow:inset 0 0 0 2px #949494;
        box-shadow:inset 0 0 0 2px #949494;
  }
  .todo .fa-check{
  position:absolute;
  z-index:1;
  left:-31px;
  top:0;
  font-size:1px;
  line-height:36px;
  width:36px;
  height:36px;
  text-align:center;
  color:transparent;
  text-shadow:1px 1px 0 white, -1px -1px 0 white;
  }
  :checked + .todo{
  color:#717171;
  }
  :checked + .todo:before{
  width:100%;
  }
  :checked + .todo:after{
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
   -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
        box-shadow:inset 0 0 0 2px #0eb0b7;
  }
  :checked + .todo .fa-check{
  font-size:20px;
  line-height:35px;
  color:#0eb0b7;
  }
  /* Delete Items */

  .delete-item{
  display:block;
  position:absolute;
  height:36px;
  width:36px;
  line-height:36px;
  right:0;
  top:0;
  text-align:center;
  color:#d8d8d8;
  opacity:0;
  }
  .todo-wrap:hover .delete-item{
  opacity:1;
  }
  .delete-item:hover{
  color:#cd4400;
  }
</style>

    <section class="content-header">
      <h1>
        เร่งรัดหนี้สิน
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-warning box-solid" style="Background-color:#F5F5DC;">
        <div class="box-body">
          @if($type == 7)
            <form method="get" action="{{ route('Precipitate', 7) }}">
              <div align="right" class="form-inline">
                  <a href="{{ action('PrecController@excel') }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{1}}" class="btn btn-success btn-app">
                    <span class="fa fa-file-excel-o"></span> Excel
                  </a>
                <button type="submit" class="btn btn-warning btn-app">
                  <span class="glyphicon glyphicon-search"></span> Search
                </button >
                <p></p>
                <label>จากวันที่ : </label>
                <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                <label>ถึงวันที่ : </label>
                <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
              </div>
            </form>
          @elseif($type == 8)
            <form method="get" action="{{ route('Precipitate', 8) }}">
              <div align="right" class="form-inline">
                <a target="_blank" id="SendData" href="{{ action('PrecController@ReportPrecDue',[00,00]) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{8}}&DataOffice={{$Office}}" class="btn btn-danger btn-app">
                  <span class="fa fa-file-pdf-o"></span> PDF
                </a>
                <button type="submit" class="btn btn-warning btn-app">
                  <span class="glyphicon glyphicon-search"></span> Search
                </button >
                <p></p>
                <label>จากวันที่ : </label>
                <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                <label>ถึงวันที่ : </label>
                <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />

                <div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-6"></div>
                      <div class="col-md-6">
                        <div class="" id="todo-list">
                          <div class="form-inline" align="left">
                            <span class="todo-wrap">
                              @if($Office != Null)
                                <input type="checkbox" id="1" name="DataOffice" value="{{ $Office }}" checked="checked"/ >
                              @else
                                <input type="checkbox" id="1" name="DataOffice" value="Y"/ >
                              @endif
                              <label for="1" class="todo">
                                <i class="fa fa-check"></i>
                                แสดงข้อมูลบริษัท
                              </label>
                              <!-- <span class="delete-item" title="remove">
                                <i class="fa fa-times-circle"></i>
                              </span> -->
                            </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </form>
          @elseif($type == 9)
            <form method="get" action="{{ route('Precipitate', 9) }}">
              <div align="right" class="form-inline">
                <a href="{{ action('PrecController@excel') }}?SelectDate={{$newdate}}&type={{9}}" class="btn btn-success btn-app">
                  <span class="fa fa-file-excel-o"></span> Excel
                </a>
                <button type="submit" class="btn btn-warning btn-app">
                  <span class="glyphicon glyphicon-search"></span> Search
                </button >
                <p></p>
                <label>ดิววันที่ : </label>
                <input type="date" name="SelectDate" style="width: 180px;" value="{{ ($newdate != '') ?$newdate: '' }}" class="form-control" />
              </div>
            </form>
          @endif
          <hr />
          @if($type == 7)
            <div class="row">
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>

                  <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                      <p><i class="fa fa-user-circle-o fa-5x"></i></p>
                    </div>
                    <h3 class="widget-user-username">ปล่อยงานตาม</h3>
                    <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-12 border-center">
                        <div class="table-responsive">
                         <table class="table table-bordered" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">เลขที่สัญญา</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">พนง</th>
                                <th class="text-center">สถานะ</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataFollow as $key => $row)
                                <tr>
                                  <td class="text-center"> {{$key+1}} </td>
                                  <td class="text-center"> {{$row->CONTNO}}</td>
                                  <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                                  <td class="text-center"> {{$row->BILLCOLL}} </td>
                                  <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>

                  <div class="widget-user-header bg-red">
                    <div class="widget-user-image">
                      <p class=""><i class="fa fa-user-times fa-5x"></i></p>
                    </div>
                    <h3 class="widget-user-username">ปล่อยงานโนติส</h3>
                    <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                  </div>

                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-12 border-center">
                        <div class="table-responsive">
                         <table class="table table-bordered" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">เลขที่สัญญา</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">พนง</th>
                                <th class="text-center">สถานะ</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataNotice as $key => $row)
                                <tr>
                                  <td class="text-center"> {{$key+1}} </td>
                                  <td class="text-center"> {{$row->CONTNO}}</td>
                                  <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                                  <td class="text-center"> {{$row->BILLCOLL}} </td>
                                  <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @elseif($type == 8)
            <div class="row" align="left">
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">ทีมแบเลาะ (102)</h3>
                    <h5 class="widget-user-desc">2.5 - 4.67</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/102.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary102 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 102)
                              @php
                                $summary102 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary102, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">ทีมแบฮะ (104)</h3>
                    <h5 class="widget-user-desc">2.5 - 4.67</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/104.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary104 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 104)
                              @php
                                $summary104 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary104, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">ทีมพี่เบร์ (105)</h3>
                    <h5 class="widget-user-desc">2.5 - 4.67</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/105.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary105 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 105)
                              @php
                                $summary105 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary105, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" align="left">
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">ทีมแบยี (113)</h3>
                    <h5 class="widget-user-desc">2.5 - 4.67</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/113.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary113 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 113)
                              @php
                                $summary113 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary113, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-red-active">
                    <h3 class="widget-user-username">ทีมแบลัง (112)</h3>
                    <h5 class="widget-user-desc">4.7 - 5.69</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/112.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary112 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 112)
                              @php
                                $summary112 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary112, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-red-active">
                    <h3 class="widget-user-username">ทีมแบนัน (114)</h3>
                    <h5 class="widget-user-desc">4.7 - 5.69</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/114.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary114 = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == 114)
                              @php
                                $summary114 += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summary114, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" align="left">
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-yellow-active">
                    <h3 class="widget-user-username">CKL</h3>
                    <h5 class="widget-user-desc">Founder & CEO</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/leasingLogo1.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summaryCKL = 0;
                          @endphp
                          @foreach($data as $key => $value)
                            @if($value->BILLCOLL == "CKL   ")
                              @php
                                $summaryCKL += $value->TOTAMT;
                              @endphp
                            @endif
                          @endforeach
                          <h5 class="description-header">{{number_format($summaryCKL, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-yellow-active">
                    <h3 class="widget-user-username">ผลรวม</h3>
                    <h5 class="widget-user-desc">Founder & CEO</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('/dist/img/sum.png') }}" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($fdate)}}</h5>
                          <span class="description-text">จากวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">{{DateThai($tdate)}}</h5>
                          <span class="description-text">ถึงวันที่</span>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="description-block">
                          @php
                            $summary = 0;
                          @endphp
                              @php
                                $summary = $summary102 + $summary104 + $summary105 + $summary113 + $summary112 + $summary114 + $summaryCKL;
                              @endphp
                          <h5 class="description-header">{{number_format($summary, 2)}}</h5>
                          <span class="description-text">รวม</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @elseif($type == 9)
            <div class="row">
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>

                  <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                      <p><i class="fa fa-user-circle-o fa-5x"></i></p>
                    </div>
                    <h3 class="widget-user-username">รายชื่อผู้ค้ำ</h3>
                    <h5 class="widget-user-desc">2 - 2.99</h5>
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-12 border-center">
                        <div class="table-responsive">
                         <table class="table table-bordered" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">เลขที่สัญญา</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataSup as $key => $row)
                                <tr>
                                  <td class="text-center"> {{$key+1}} </td>
                                  <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->NAME))}} </td>
                                  <td class="text-center"> {{$row->CONTNO}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box box-widget widget-user">
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>

                  <div class="widget-user-header bg-red">
                    <div class="widget-user-image">
                      <p class=""><i class="fa fa-user-times fa-5x"></i></p>
                    </div>
                    <h3 class="widget-user-username">รายชื่อผู้ซื้อและผู้ค้ำ</h3>
                    <h5 class="widget-user-desc">3 - 4.69</h5>
                  </div>

                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-12 border-center">
                        <div class="table-responsive">
                         <table class="table table-bordered" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center">ลำดับ</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">เลขที่สัญญา</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataUseSup as $key => $row)
                                <tr>
                                  <td class="text-center"> {{$key+1}} </td>
                                  <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                                  <td class="text-center"> {{$row->CONTNO}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#SendData').click(function() {
              var Getflag = $('#1').val();
              // console.log(Getflag);

            $.ajax({
              methods:'POST',
              url:"{{ route('Precipitate', 8) }}",
              data:Getflag,
              success:function(data){
                 // alert(data.success);
              }
            });
          });
        });
      </script>

@endsection
