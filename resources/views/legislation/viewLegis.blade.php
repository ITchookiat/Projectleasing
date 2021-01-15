@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d', strtotime('-1 days'));
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y');
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date = $Y2.'-'.$m.'-'.$d;
  $date2 = $Y.'-'.$m.'-'.$d;
@endphp

@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    //return "$strDay-$strMonthThai-$strYear";
  }
@endphp

<style>
  #todo-list{
  width:100%;
  margin:0 auto 50px auto;
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
  height:3px;
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
</style>

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-8">
                    <div class="form-inline">
                      <h4 class="">
                        @if($type == 2)
                          ลูกหนี้ฟ้อง (Debtor Sued)
                        @elseif($type == 6)
                          ลูกหนี้เตรียมฟ้อง
                        @elseif($type == 8)
                          ลูกหนี้สืบทรัพย์
                        @elseif($type == 10)
                          ลูกหนี้ของกลาง
                        @elseif($type == 12)
                          ลูกหนี้ขายฝาก
                        @elseif($type == 21)
                          ลูกหนี้รอฟ้อง
                        @elseif($type == 22)
                          ลูกหนี้ชั้นศาล
                        @elseif($type == 23)
                          ลูกหนี้ชั้นบังคับคดี
                        @elseif($type == 24)
                          ลูกหนี้ชั้นโกงเจ้าหนี้
                        @endif
                      </h4>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card-tools">
                      <div class="float-right form-inline">
                        <a class="btn btn-primary btn-sm" href="{{ route('MasterLegis.index') }}?type={{20}}">
                          <i class="fas fa-caret-square-left"></i> Back
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="row">
                  @if($type == 6)  <!--Main ลูกหนี้เตรียมฟ้อง-->
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterLegis.index') }}">
                        <input type="hidden" name="type" value="6" />
                        <div class="float-right form-inline">
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />
  
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                          
                          <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="FlagStatus" class="form-control form-control-sm" id="text">
                            <option selected value="">------ สถานะ ------</option>
                            <option value="1" {{ ($FlagStatus == '1') ? 'selected' : '' }}>ลูกหนี้เตรียมฟ้อง</option>
                            <option value="2" {{ ($FlagStatus == '2') ? 'selected' : '' }}>ลูกหนี้ส่งฟ้อง</option>
                          </select>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table">
                          <thead>
                            <tr>
                              <th class="text-center">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">งวด</th>
                              <th class="text-center">วันรับงาน</th>
                              <th class="text-center">ระยะเวลา</th>
                              <th class="text-center">ผู้จัดเตรียม</th>
                              <th class="text-center">หมายเหตุ</th>
                              <th class="text-center" style="width: 80px">สถานะ</th>
                              <th class="text-center" style="width: 80px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}}</td>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}}</td>
                                <td class="text-center">
                                  @php
                                     $StrCon = explode("/",$row->Contract_legis);
                                     $SetStr1 = $StrCon[0];
                                     $SetStr2 = $StrCon[1];
                                  @endphp
                                  {{$row->Realperiod_legis}}
                                </td>
                                <td class="text-center"> {{ DateThai($row->Date_legis) }}</td>
                                <td class="text-center">
                                  @if($row->Datesend_Flag == null)
                                    @php
                                      $nowday = date('Y-m-d');
                                      $Cldate = date_create($row->Date_legis);
                                      $nowCldate = date_create($nowday);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="red">{{$duration}}</font>
                                  @else
                                    @php
                                      $Cldate = date_create($row->Date_legis);
                                      $nowCldate = date_create($row->Datesend_Flag);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @endif
                                </td>
                                <td class="text-center"> {{ $row->UserSend2_legis }}</td>
                                <td class="text-left" style="width: 200px;"> {{ $row->Noteby_legis }} </td>
                                <td class="text-center">
                                  @if($row->Flag_status == '1')
                                    <button type="button" class="btn btn-danger btn-sm" title="เตรียมเอกสาร">
                                      <i class="far fa-calendar-check"></i> เตรียม
                                    </button>
                                  @else
                                    <button type="button" class="btn btn-success btn-sm" title="วันส่งทนาย {{ DateThai($row->Datesend_Flag) }}">
                                      <i class="far fa-calendar-check"></i> ส่งทนาย
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{6}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                    <input type="hidden" name="type" value="1" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 8)  <!--Main ลูกหนี้สืบทรัพย์-->
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterLegis.index') }}">
                        <input type="hidden" name="type" value="8" />
                        <div class="float-right form-inline">
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />
  
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        
                          <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="status" class="form-control form-control-sm" id="text" style="width: 177px">
                            <option selected value="">--- สถานะ ---</option>
                            <option value="Y" {{ ($SetSelect == 'Y') ? 'selected' : '' }}>ลูกหนี้มีทรัพย์</otion>
                            <option value="N" {{ ($SetSelect == 'N') ? 'selected' : '' }}>ลูกหนี้ไม่มีทรัพย์</otion>
                            {{-- <option value="หมดอายุความ" {{ ($SetSelect == 'หมดอายุความ') ? 'selected' : '' }}>หมดอายุความ</otion>
                            <option value="จบงานสืบทรัพย์" {{ ($SetSelect == 'จบงานสืบทรัพย์') ? 'selected' : '' }}>จบงานสืบทรัพย์</otion> --}}
                          </select>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 30px">No.</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">วันที่สืบทรัพย์</th>
                              <th class="text-center">ระยะเวลา</th>
                              <th class="text-center">สถานะทรัพย์</th>
                              <th class="text-center">สถานะแจ้งเตือน</th>
                              <th class="text-center">ผู้สืบทรัพย์</th>
                              <th class="text-center" style="width: 80px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}} </td>
                                <td class="text-center"> {{ DateThai($row->Date_asset) }}</td>
                                <td class="text-center">  <!-- ระยะเวลา -->
                                  @if($row->Dateresult_asset != Null)
                                    @php
                                      $Cldate = date_create($row->Date_asset);
                                      $nowCldate = date_create($row->Dateresult_asset);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @else
                                    @if($row->propertied_asset == "Y")
                                      @php
                                        $Cldate = date_create($row->Date_asset);
                                        $nowCldate = date_create($row->Dateresult_asset);
                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                        $duration = $ClDateDiff->format("%a วัน")
                                      @endphp
                                      <font color="green">{{$duration}}</font>
                                    @elseif($row->propertied_asset == "N")
                                      @php
                                        $Cldate = date_create($date);
                                        $nowCldate = date_create($row->Date_asset);
                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                        $duration = $ClDateDiff->format("%a วัน")
                                      @endphp
                                      <font color="red">{{$duration}}</font>
                                    @endif
                                  @endif
                                </td>
                                <td class="text-center">  <!-- สถานะทรัพย์ -->
                                  @if($row->propertied_asset == "Y")
                                    <button type="button" class="btn btn-success btn-sm" title="มีทรัพย์">
                                      <i class="fa fa-map prem"></i> มีทรัพย์
                                    </button>
                                  @elseif($row->propertied_asset == "N")
                                    <button type="button" class="btn btn-danger btn-sm" title="ไม่มีทรัพย์">
                                      <i class="fa fa-map prem"></i> ไม่มีทรัพย์
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">  <!-- สถานะแจ้งเตือน -->
                                  @if($row->Date_asset != Null)
                                    @php
                                      $Getdate = date_create($row->sequester_asset);
                                      $Newdate = date_create($date);
                                      $DateEx = date_diff($Newdate,$Getdate);
                                    @endphp
    
                                    @if($row->sendsequester_asset == "สืบทรัพย์ไม่เจอ")
                                      @php
                                        $Getdate = date_create($row->NewpursueDate_asset);
                                        $DateEx = date_diff($Newdate,$Getdate);
                                      @endphp
  
                                      @if($Newdate <= $Getdate)
                                        @if($DateEx->days <= 7)
                                          <button type="button" class="btn btn-danger btn-sm" title="วันสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                            <span class="fa fa-bell prem"> สืบทรัพย์ใหม่ {{ $DateEx->days }} วัน</span>
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="รอสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                            <i class="fa fa-clock-o prem"></i> รอสืบทรัพย์
                                          </button>
                                        @endif
                                      @else
                                        <button type="button" class="btn btn-gray btn-sm prem" title="วันสืบทรัพย์ล่าสุด {{DateThai($row->NewpursueDate_asset)}}">
                                          <span class="fa fa-hourglass-half active"> ไม่มีการอัพเดต </span>
                                        </button>
                                      @endif
                                    @elseif($row->sendsequester_asset == "สืบทรัพย์เจอ")
                                      <button type="button" class="btn btn-success btn-sm" title="สืบทรัพย์เจอ">
                                        <i class="fa fa-check-square-o prem"></i> สืบทรัพย์เจอ
                                      </button>
                                    @elseif($row->sendsequester_asset == "หมดอายุความคดี")
                                      <button type="button" class="btn btn-primary btn-sm" title="หมดอายุความ">
                                        <i class="fa fa-gavel prem"></i> หมดอายุความคดี
                                      </button>
                                    @elseif($row->sendsequester_asset == "จบงานสืบทรัพย์")
                                      <button type="button" class="btn btn-success btn-sm" title="จบงานสืบทรัพย์">
                                        <i class="fa fa-gavel prem"></i> จบงานสืบทรัพย์
                                      </button>
                                    @else
                                      @if($row->propertied_asset == "Y")
                                        <button type="button" class="btn btn-success btn-sm" title="มีทรัพย์">
                                          <i class="fa fa-check-square-o prem"></i> มีทรัพย์
                                        </button>
                                      @elseif($row->propertied_asset == "N")
                                        @if($row->NewpursueDate_asset != Null)
                                          @php
                                            $Getdate = date_create($row->NewpursueDate_asset);
                                            $DateEx = date_diff($Newdate,$Getdate);
                                          @endphp
    
                                          @if($Newdate <= $Getdate)
                                            @if($DateEx->days <= 7)
                                              <button type="button" class="btn btn-danger btn-sm" title="สืบทรัพย์ {{DateThai($row->sequester_asset)}}">
                                                <span class="fa fa-bell text-white prem"> สืบทรัพย์ {{ $DateEx->days }} วัน</span>
                                              </button>
                                            @else
                                              <button type="button" class="btn btn-warning btn-sm" title="รอสืบทรัพย์ {{DateThai($row->sequester_asset)}}">
                                                <i class="fa fa-clock-o text-white prem"></i> รอสืบทรัพย์
                                              </button>
                                            @endif
                                          @endif
                                        @else
                                          <button type="button" class="btn btn-gray btn-sm" title="รอผลสืบทรัพย์">
                                            <i class="fa fa-hourglass-half active prem"></i> รอผลสืบทรัพย์
                                          </button>
                                        @endif
                                      @endif
                                    @endif
                                  @endif
                                </td>
                                <td class="text-center"> {{ $row->User_asset }}</td>
                                <td class="text-right">
                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{8}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}"  style="display:inline;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="type" value="1" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button disabled type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 10) {{--ลูกหนี้ของกลาง--}}
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterLegis.index') }}">
                        <input type="hidden" name="type" value="10" />
                        <div class="float-right form-inline">
                            <button type="button" class="btn bg-success btn-app" data-toggle="modal" data-target="#modal-6" data-link="{{ route('MasterLegis.show', 0) }}?&type={{11}}">
                              <i class="fas fa-plus"></i> New
                            </button>
                            <div class="btn-group">
                              <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                                <span class="fas fa-print"></span> ปริ้นรายงาน
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" class="dropdown-item" href="{{ route('legislation.report', [00,10]) }}?&Fromdate={{$fdate}}&Todate={{$tdate}}&TerminateExhibit={{$terminateexhibit}}&Typeexhibit={{$typeexhibit}}">
                                  <i class="fa fa-file-pdf-o text-red"></i> &nbsp;&nbsp; PDF</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a target="_blank" class="dropdown-item" href="{{ route('legislation.report', [00,10]) }}?&Fromdate={{$fdate}}&Todate={{$tdate}}&TerminateExhibit={{$terminateexhibit}}&Typeexhibit={{$typeexhibit}}">
                                  <i class="fa fa-file-excel-o text-green"></i> &nbsp;&nbsp; Excel</a>
                                </li>
                              </ul>
                            </div>
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label for="text" class="mr-sm-2">จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control form-control-sm" />
                          <label for="text" class="mr-sm-2">ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control form-control-sm" />
                        </div>
                        <br><br>
                        <div class="float-right form-inline">
                          <label for="text" class="mr-sm-2">บอกเลิกสัญญา : </label>
                          <select name="TerminateExhibit" class="form-control form-control-sm" id="text">
                            <option selected value="">--- เลือกสถานะ ---</option>
                            <option value="เร่งรัด" {{ ($terminateexhibit == 'เร่งรัด') ? 'selected' : '' }}>เร่งรัด</option>
                            <option value="ทนาย" {{ ($terminateexhibit == 'ทนาย') ? 'selected' : '' }}>ทนาย</option>
                          </select>
                          <label for="text" class="mr-sm-2">&nbsp;ประเภท : </label>
                          <select name="Typeexhibit" class="form-control form-control-sm" id="text">
                            <option selected value="">--- เลือกประเภท ---</option>
                            <option value="ของกลาง" {{ ($typeexhibit == 'ของกลาง') ? 'selected' : '' }}>ของกลาง</option>
                            <option value="ยึดตามมาตราการ(ปปส.)" {{ ($typeexhibit == 'ยึดตามมาตราการ(ปปส.)') ? 'selected' : '' }}>ยึดตามมาตราการ(ปปส.)</option>
                          </select>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center" style="width: 40px">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุลผู้เช่าซื้อ</th>
                              <th class="text-center">ชื่อผู้ต้องหา</th>
                              <th class="text-center">ข้อหา</th>
                              <th class="text-center">บอกเลิก</th>
                              <th class="text-center">ประเภท</th>
                              <th class="text-center">สถานะแจ้งเตือน</th>
                              <th class="text-center" style="width: 150px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                            <tr>
                              <td class="text-center">{{$key+1}}</td>
                              <td class="text-center">{{$row->Contract_legis}}</td>
                              <td class="text-left"> {{$row->Name_legis}}</td>
                              <td class="text-left"> {{$row->Suspect_legis}}</td>
                              <td class="text-center"> {{$row->Plaint_legis}}</td>
                              <td class="text-center"> {{$row->Terminate_legis}}</td>
                              <td class="text-center"> {{$row->Typeexhibit_legis}}</td>
                              <td class="text-center">
                                @if($row->Typeexhibit_legis == 'ของกลาง')
                                  @if($row->Dategetresult_legis != null)
                                  <button type="button" class="btn btn-success btn-sm" title="{{DateThai($row->Dategetresult_legis)}}">
                                    <i class="fa fa-check-circle prem"></i> จบงาน
                                  </button>
                                  @elseif($row->Dateinvestigate_legis != null)
                                      @php
                                        $datecheck = date('Y-m-d');
                                        $Cldate = date_create($row->Dateinvestigate_legis);
                                        $nowCldate = date_create($datecheck);
                                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                                        // $duration = $ClDateDiff->format("อีก %a วัน");
                                      @endphp
                                      @if($datecheck > $row->Dateinvestigate_legis)
                                        <button type="button" class="btn btn-warning btn-sm" title="{{DateThai($row->Dateinvestigate_legis)}}">
                                         <i class="fa fa-question-circle prem"></i> เลยไต่สวนแล้ว
                                        </button>
                                      @elseif($ClDateDiff->days <= 7)
                                        <button type="button" class="btn btn-danger btn-sm prem" title="{{DateThai($row->Dateinvestigate_legis)}}">
                                         <i class="fa fa-question-circle"></i> ไต่สวนอีก {{$ClDateDiff->days}} วัน
                                        </button>
                                      @endif
                                  @elseif($row->Datesendword_legis != null)
                                      <button type="button" class="btn btn-warning btn-sm" title="{{DateThai($row->Datesendword_legis)}}">
                                       <i class="fa fa-question-circle prem"></i> ยื่นคำร้อง
                                      </button>
                                  @elseif($row->Datepreparedoc_legis != null)
                                      <button type="button" class="btn btn-primary btn-sm" title="{{DateThai($row->Datepreparedoc_legis)}}">
                                       <i class="fa fa-question-circle prem"></i> เตรียมเอกสาร
                                      </button>
                                  @elseif($row->Datecheckexhibit_legis != null)
                                      <button type="button" class="btn btn-primary btn-sm" title="{{DateThai($row->Datecheckexhibit_legis)}}">
                                       <i class="fa fa-question-circle prem"></i> เช็คสำนวน
                                      </button>
                                  @elseif($row->Dategiveword_legis != null)
                                      <button type="button" class="btn btn-primary btn-sm" title="{{DateThai($row->Dategiveword_legis)}}">
                                       <i class="fa fa-question-circle prem"></i> สอบคำให้การ
                                      </button>
                                  @else
                                    <button type="button" class="btn btn-gray btn-sm" title="ยังไม่มีแจ้งเตือน">
                                     <i class="fa fa-question-circle prem"></i> ยังไม่มีแจ้งเตือน
                                    </button>
                                  @endif
                                @endif
                                @if($row->Typeexhibit_legis == 'ยึดตามมาตราการ(ปปส.)')
                                  @if($row->Dategetresult_legis != null)
                                  <button type="button" class="btn btn-success btn-sm" title="{{DateThai($row->Dategetresult_legis)}}">
                                    <i class="fa fa-check-circle prem"></i> จบงาน
                                  </button>
                                  @elseif($row->Datesenddetail_legis != null)
                                    <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Datesenddetail_legis)}}">
                                     <i class="fa fa-question-circle prem"></i> ส่งรายละเอียด
                                    </button>
                                  @else
                                      <button type="button" class="btn btn-gray btn-sm" title="ยังไม่มีแจ้งเตือน">
                                       <i class="fa fa-question-circle prem"></i> ยังไม่มีแจ้งเตือน
                                      </button>
                                    @endif
                                @endif
                              </td>
                              <td class="text-center">
                                <a href="{{ route('MasterLegis.edit',$row->Legisexhibit_id) }}?type={{10}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"></i>
                                </a>
                                <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->Legisexhibit_id]) }}"  style="display:inline;">
                                {{csrf_field()}}
                                  <input type="hidden" name="type" value="3" />
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 12) {{--ลูกหนี้ขายฝาก--}}
                    <div class="col-md-12">
                      <hr>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center" style="width: 10px">ลำดับ</th>
                                <th class="text-center">เลขที่สัญญา</th>
                                <th class="text-center">ชื่อ-สกุล</th>
                                <th class="text-center">วันที่ทำสัญญา</th>
                                <th class="text-center">ยอดคงเหลือ</th>
                                <th class="text-center">ค้างงวดจริง</th>
                                <th class="text-center">ระยะเวลา</th>
                                <th class="text-center">แจ้งเตือนสถานะ</th>
                                <th class="text-center">ตัวเลือก</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataLand as $key => $row)
                              <tr>
                                <td class="text-center" style="widtd: 10px">{{$key+1}}</td>
                                <td class="text-center">{{$row->ContractNo_legis}}</td>
                                <td class="text-left">{{$row->Name_legis}}</td>
                                <td class="text-center">{{ DateThai($row->DateDue_legis) }} </td>
                                <td class="text-center">{{ number_format($row->Sumperiod_legis, 2) }} </td>
                                <!-- <td class="text-center">{{ number_format($row->Beforemoney_legis, 2) }} </td> -->
                                <td class="text-center">{{$row->Realperiod_legis}}</td>
                                <td class="text-center">
                                  @if($row->Datestatusland_legis == null or $row->Statusland_legis == 'ไม่จบงาน')
                                    @php
                                      $nowday = date('Y-m-d');
                                      $Cldate = date_create($row->Date_legis);
                                      $nowCldate = date_create($nowday);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="red">{{$duration}}</font>
                                  @else
                                    @php
                                      $Cldate = date_create($row->Date_legis);
                                      $nowCldate = date_create($row->Datestatusland_legis);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if($row->Datestatusland_legis != null)
                                  <button type="button" class="btn btn-success btn-sm" title="{{DateThai($row->Datestatusland_legis)}}">
                                    @if($row->Statusland_legis == "จบงาน")
                                    <i class="fa fa-check-circle prem"></i> จบงาน
                                    @elseif($row->Statusland_legis == "ปิดบัญชี")
                                    <i class="fa fa-check-circle prem"></i> ปิดบัญชี
                                    @endif
                                  </button>
                                  @elseif($row->Datecheckasset_legis != null)
                                    <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Datecheckasset_legis)}}">
                                    <i class="fa fa-question-circle prem"></i> ไปตรวจทรัพย์{{$row->Resultcheck_legis}}
                                    </button>
                                  @elseif($row->Datepost_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Datepost_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> ติดประกาศ
                                      </button>
                                  @elseif($row->Dateeviction_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Dateeviction_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> ทำเรื่องขับไล่
                                      </button>
                                  @elseif($row->Dateadjudicate_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Dateadjudicate_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> พิพากษา
                                      </button>
                                  @elseif($row->Dateinvestigate_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Dateinvestigate_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> สืบสวน
                                      </button>
                                  @elseif($row->Datepetition_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Datepetition_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> ยื่นคำร้อง
                                      </button>
                                  @elseif($row->Dategetnotice_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Dategetnotice_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> รับใบตอบรับ
                                      </button>
                                  @elseif($row->Datenotice_legis != null)
                                      <button type="button" class="btn btn-danger btn-sm" title="{{DateThai($row->Datenotice_legis)}}">
                                      <i class="fa fa-question-circle prem"></i> ส่งโนติส
                                      </button>
                                  @else
                                    <button type="button" class="btn btn-gray btn-sm" title="ยังไม่มีแจ้งเตือน">
                                    <i class="fa fa-question-circle prem"></i> ยังไม่มีแจ้งเตือน
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a href="{{ action('LegislationController@edit',[$row->Legisland_id, 12]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                  </a>
                                  <div class="form-inline form-group">
                                    <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->Legisland_id ,4]) }}">
                                    {{csrf_field()}}
                                      <input type="hidden" name="_method" value="DELETE" />
                                      <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                        <span class="glyphicon glyphicon-trash"></span> ลบ
                                      </button>
                                    </form>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 21)  <!-- Main ลูกหนี้รอฟ้อง -->
                    <div class="col-md-12">
                      <form method="get" action="{{ route('MasterLegis.index') }}">
                        <input type="hidden" name="type" value="21" />
                        <div class="float-right form-inline">
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table21">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 50px">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">วันที่ส่งทนาย</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-left" style="width: 50px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}}</td>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}}</td>
                                <td class="text-center"> {{ DateThai($row->Datesend_Flag) }}</td>
                                <td class="text-center">
                                  <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="รอฟ้องจากทนาย">
                                    <i class="fab fa-algolia fa-lg pr-1 prem"></i>รอฟ้อง
                                  </button>
                                </td>
                                <td class="text-left">
                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                    <input type="hidden" name="type" value="1" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 22)  <!-- Main ลูกหนี้ชั้นศาล -->
                    <div class="col-md-3">
                      <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">List</h3>
                          <div class="card-tools">
                            <b><font color="red">ฟ้องรวม {{$data}} ราย</font></b>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body p-0">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ (request()->is($Flag === '1')) ? 'active' : '' }}" name="test1" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{1}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะส่งฟ้อง
                              @if($Count1 != 0)
                                <span class="badge bg-danger float-right">{{$Count1}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '2')) ? 'active' : '' }}" name="test2" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{2}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะสืบพยาน
                              @if($Count2 != 0)
                                <span class="badge bg-danger float-right">{{$Count2}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '3')) ? 'active' : '' }}" name="test3" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{3}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะส่งคำบังคับ
                              @if($Count3 != 0)
                                <span class="badge bg-danger float-right">{{$Count3}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '4')) ? 'active' : '' }}" name="test4" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{4}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะตรวจผลหมาย
                              @if($Count4 != 0)
                                <span class="badge bg-danger float-right">{{$Count4}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '5')) ? 'active' : '' }}" name="test5" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{5}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะตั้งเจ้าพนักงาน
                              @if($Count5 != 0)
                                <span class="badge bg-danger float-right">{{$Count5}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '6')) ? 'active' : '' }}" name="test6" href="{{ route('MasterLegis.index') }}?type={{22}}&Flag={{6}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ สถานะตรวจผลหมายตั้ง
                              @if($Count6 != 0)
                                <span class="badge bg-danger float-right">{{$Count6}}</span>
                              @endif
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9">
                      <div class="card card-primary card-outline">
                        <div class="card-body p-0 text-sm">
                          <div class="row">
                            <div class="col-12 col-sm-12">
                              <div class="tab-content" id="vert-tabs-tabContent">
                                @if($Flag === '1')
                                <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs1-tab">
                                  <div class="card-header">
                                    <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้ส่งฟ้อง</h3>
                                  </div>
                                  <div class="col-12">
                                    <div class="table-responsive">
                                      <table class="table table-hover" id="table1">
                                        <thead>
                                          <tr>
                                            <th class="text-center">เลขที่สัญญา</th>
                                            <th class="text-center">ชื่อ-สกุล</th>
                                            <th class="text-center">วันฟ้อง</th>
                                            <th class="text-center">ผู้ส่งฟ้อง</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center" style="width: 70px"></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($data1 as $key => $row)
                                            <tr>
                                              <td class="text-left"> {{$row->Contract_legis}}</td>
                                              <td class="text-left"> {{$row->Name_legis}} </td>
                                              <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                              <td class="text-left"> {{$row->User_court}} </td>
                                              <td class="text-center">
                                                @if($row->Status_Promise != NULL)
                                                  <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                    <i class="fas fa-user-check pr-1 prem"></i>{{$row->Status_Promise}}
                                                  </button>
                                                @else
                                                  @if($row->Date_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                      <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                    </button>
                                                  @endif
                                                @endif
                                              </td>
                                              <td class="text-right">
                                                <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                  <i class="far fa-edit"></i>
                                                </a>
                                                <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                {{csrf_field()}}
                                                  <input type="hidden" name="type" value="1" />
                                                  <input type="hidden" name="_method" value="DELETE" />
                                                  <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                    <i class="far fa-trash-alt"></i>
                                                  </button>
                                                </form>
                                              </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                @elseif($Flag === '2')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs2-tab">
                                    <div class="card-header">
                                      <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้สืบพยาน</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center">สถานะ</th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data2 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                                <td class="text-left"> {{$row->User_court}} </td>
                                                <td class="text-center">
                                                  @if($row->Status_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                      <i class="fas fa-user-check pr-1 prem"></i>{{$row->Status_Promise}}
                                                    </button>
                                                  @else
                                                    @if($row->Date_Promise != NULL)
                                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                        <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                      </button>
                                                    @endif
                                                  @endif
                                                </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($Flag === '3')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs3-tab">
                                    <div class="card-header">                                      
                                      <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้ส่งคำบังคับ</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center">สถานะ</th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data3 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                                <td class="text-left"> {{$row->User_court}} </td>
                                                <td class="text-center">  
                                                  @if($row->Status_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                      <i class="fas fa-user-check pr-1 prem"></i>
                                                    </button>
                                                  @else
                                                    @if($row->Date_Promise != NULL)
                                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                        <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                      </button>
                                                    @endif
                                                  @endif
                                                </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($Flag === '4')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs4-tab">
                                    <div class="card-header">                                      
                                      <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้ตรวจผลหมาย</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center">สถานะ</th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data4 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                                <td class="text-left"> {{$row->User_court}} </td>
                                                <td class="text-center">  
                                                  @if($row->Status_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                      <i class="fas fa-user-check pr-1 prem"></i>
                                                    </button>
                                                  @else
                                                    @if($row->Date_Promise != NULL)
                                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                        <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                      </button>
                                                    @endif
                                                  @endif
                                                </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($Flag === '5')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs5-tab">
                                    <div class="card-header">                                      
                                      <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้ตั้งเจ้าพนักงาน</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center">สถานะ</th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data5 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                                <td class="text-left"> {{$row->User_court}} </td>
                                                <td class="text-center"> 
                                                  @if($row->Status_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                      <i class="fas fa-user-check pr-1 prem"></i>
                                                    </button>
                                                  @else
                                                    @if($row->Date_Promise != NULL)
                                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                        <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                      </button>
                                                    @endif
                                                  @endif
                                                </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($Flag === '6')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs6-tab">
                                    <div class="card-header">                                      
                                      <h3 class="card-title">ลูกหนี้ชั้นศาล - ลูกหนี้ตรวจผลหมายตั้ง</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center">สถานะ</th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data6 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> {{ DateThai($row->fillingdate_court) }} </td>
                                                <td class="text-left"> {{$row->User_court}} </td>
                                                <td class="text-center"> 
                                                  @if($row->Status_Promise != NULL)
                                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{$row->Status_Promise}}">
                                                      <i class="fas fa-user-check pr-1 prem"></i>
                                                    </button>
                                                  @else
                                                    @if($row->Date_Promise != NULL)
                                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="อยู่ระหว่างประนอมหนี้">
                                                        <i class="fas fa-hand-holding-usd pr-1 prem"></i>ประนอมหนี้
                                                      </button>
                                                    @endif
                                                  @endif
                                                </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @else
                                  <div class="error-page">
                                    <h3 class=" text-danger">โปรดเลือกรายการ ทางด้านซ้ายมือ. !!</h3>
                                    <div class="error-content">
                                      <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>
                                      <p>
                                        หากมีข้อส่งสัยหรือเกิดข้อผิดพลาด โปรดติดต่อแผนกไอที (Dear Programmer) เบอร์ภายใน 240
                                      </p>
                                      <p>
                                      </p>
                                    </div>
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>     
                        </div>
                      </div>
                    </div>
                  @elseif($type == 23)   <!-- Main ลูกหนี้ชั้นบังคับคดี -->
                    <div class="col-md-3">
                      <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">List</h3>
                          <div class="card-tools">
                            <b><font color="red">รวม {{$Count1 + $Count2}} ราย</font></b>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body p-0">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ (request()->is($Flag === '1')) ? 'active' : '' }}" name="test1" href="{{ route('MasterLegis.index') }}?type={{23}}&Flag={{1}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ คัดฉโหนด(เตรียมเอกสาร)
                              @if($Count1 != 0)
                                <span class="badge bg-danger float-right">{{$Count1}}</span>
                              @endif
                            </a>
                            <a class="nav-link {{ (request()->is($Flag === '2')) ? 'active' : '' }}" name="test2" href="{{ route('MasterLegis.index') }}?type={{23}}&Flag={{2}}">
                              <i class="fas fa-hdd"></i> ลูกหนี้ ตั้งเรื่องยึดทรัพย์
                              @if($Count2 != 0)
                                <span class="badge bg-danger float-right">{{$Count2}}</span>
                              @endif
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9">
                      <div class="card card-primary card-outline">
                        <div class="card-body p-0 text-sm">
                          <div class="row">
                            <div class="col-12 col-sm-12">
                              <div class="tab-content" id="vert-tabs-tabContent">
                                @if($Flag === '1')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs1-tab">
                                    <div class="card-header">
                                      <h3 class="card-title">ลูกหนี้ชั้นบังคับคดี - คัดฉโหนด(เตรียมเอกสาร)</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center"></th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data1 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> </td>
                                                <td class="text-left">  </td>
                                                <td class="text-left">  </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{7}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($Flag === '2')
                                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs2-tab">
                                    <div class="card-header">
                                      <h3 class="card-title">ลูกหนี้ชั้นบังคับคดี - ตั้งเรื่องยึดทรัพย์</h3>
                                    </div>
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover" id="table1">
                                          <thead>
                                            <tr>
                                              <th class="text-center">เลขที่สัญญา</th>
                                              <th class="text-center">ชื่อ-สกุล</th>
                                              <th class="text-center">วันฟ้อง</th>
                                              <th class="text-center">ผู้ส่งฟ้อง</th>
                                              <th class="text-center"></th>
                                              <th class="text-center" style="width: 70px"></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($data2 as $key => $row)
                                              <tr>
                                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                                <td class="text-left"> {{$row->Name_legis}} </td>
                                                <td class="text-center"> </td>
                                                <td class="text-left">  </td>
                                                <td class="text-left">  </td>
                                                <td class="text-right">
                                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                    <i class="far fa-edit"></i>
                                                  </a>
                                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                                  {{csrf_field()}}
                                                    <input type="hidden" name="type" value="1" />
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                                      <i class="far fa-trash-alt"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                @else
                                  <div class="error-page">
                                    <h3 class=" text-danger">โปรดเลือกรายการ ทางด้านซ้ายมือ. !!</h3>
                                    <div class="error-content">
                                      <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>
                                      <p>
                                        หากมีข้อส่งสัยหรือเกิดข้อผิดพลาด โปรดติดต่อแผนกไอที (Dear Programmer) เบอร์ภายใน 240
                                      </p>
                                      <p>
                                      </p>
                                    </div>
                                  </div>
                                @endif
                              </div>
                            </div>
                          </div>     
                        </div>
                      </div>
                    </div>
                  @elseif($type == 24)   <!-- Main ลูกหนี้ชั้นโกงเจ้าหนี้ -->
                    <div class="col-md-12">
                      {{-- <form method="get" action="{{ route('MasterLegis.index') }}">
                        <input type="hidden" name="type" value="21" />
                        <div class="float-right form-inline">
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        </div>
                      </form> --}}
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table21">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 50px">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-left" style="width: 50px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}}</td>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}}</td>
                                <td class="text-center">
                                  <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="โกงเจ้าหนี้">
                                    <i class="fab fa-algolia fa-lg pr-1 prem"></i>โกงเจ้าหนี้
                                  </button>
                                </td>
                                <td class="text-left">
                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{13}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  {{-- <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                    <input type="hidden" name="type" value="1" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form> --}}
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 25)   <!-- Main ลูกหนี้ปิดจบงาน -->
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table21">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 50px">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-center">วันที่ปิดงาน</th>
                              <th class="text-left" style="width: 50px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}}</td>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}}</td>
                                <td class="text-center">
                                  <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="{{$row->Status_legis}}">
                                    <i class="fas fa-user-check pr-1 prem"></i>{{$row->Status_legis}}
                                  </button>
                                </td>
                                <td class="text-center"> {{DateThai($row->DateUpState_legis)}}</td>
                                <td class="text-left">
                                  <a href="{{ route('MasterLegis.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',[$row->id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                    <input type="hidden" name="type" value="1" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit"  data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                </div>

                <a id="button"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <!-- Pop up รายงานลูกหนี้ -->
  <div class="modal fade" id="modal-4">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <!-- Pop up รายงานลูกหนี้สืบพยาน -->
  <div class="modal fade" id="modal-5">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <!-- Pop up เพิ่มรายการของกลาง -->
  <div class="modal fade" id="modal-6">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-4").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-4 .modal-body").load(link, function(){
        });
      });
      $("#modal-5").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-5 .modal-body").load(link, function(){
        });
      });
      $("#modal-6").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-6 .modal-body").load(link, function(){
        });
      });
    });
  </script>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table,#table1,#table21').DataTable( {
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 0, "asc" ]]
      });
    });
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(1500);
    $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script>
@endsection
