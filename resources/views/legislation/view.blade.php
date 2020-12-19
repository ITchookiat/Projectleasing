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
                  <div class="col-6">
                    <div class="form-inline">
                      <h4 class="">
                        @if($type == 2)
                          ลูกหนี้ฟ้อง (Debtor Sued)
                        @elseif($type == 6)
                          ลูกหนี้เตรียมฟ้อง
                        @elseif($type == 7)
                          ลูกหนี้ประนอมหนี้ (Compounding Debt)
                        @elseif($type == 8)
                          ลูกหนี้สืบทรัพย์
                        @elseif($type == 10)
                          ลูกหนี้ของกลาง
                        @elseif($type == 12)
                          ลูกหนี้ขายฝาก
                        @endif
                      </h4>
                    </div>
                  </div>
                  <div class="col-6"></div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="row">
                  @if($type == 2)  {{--ลูกหนี้ฟ้อง--}}
                    <div class="col-md-12">
                      <form method="get" action="{{ route('legislation', 2) }}">
                        <div class="float-right form-inline">
                          <div class="btn-group">
                            <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                              <span class="fas fa-print"></span> ปริ้นรายงาน
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-4" data-link="{{ route('legislation', 17) }}"> รายงานลูกหนี้</a></li>
                              <li class="dropdown-divider"></li>
                              <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-5" data-link="{{ route('legislation', 18) }}"> รายงานลูกหนี้สืบพยาน</a></li>
                            </ul>
                          </div>
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label for="text" class="mr-sm-2">สถานะปิดงาน : </label>
                          <select name="StateLegis" class="form-control form-control-sm" id="text">
                            <option selected value="">------ สถานะ ------</option>
                            <option value="ปิดจบงานฟ้อง" {{ ($StateLegis == 'ปิดจบงานฟ้อง') ? 'selected' : '' }}>ปิดจบงานฟ้อง</option>
                            <option value="ปิดจบงานประนอมหนี้" {{ ($StateLegis == 'ปิดจบงานประนอมหนี้') ? 'selected' : '' }}>ปิดจบงานประนอมหนี้</option>
                            <option value="ลูกหนี้รอฟ้อง" {{ ($StateLegis == 'ลูกหนี้รอฟ้อง') ? 'selected' : '' }}>ลูกหนี้รอฟ้อง</option>
                          </select>
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />
  
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12 text-sm">
                      <div class="table-responsive">
                        <table class="table table-hover" id="table">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 70px">Job.</th>
                              <th class="text-center" style="width: 120px">ชื่อ-สกุล</th>
                              <th class="text-center" style="width: 40px">ถืองาน</th>
                              <th class="text-center" style="width: 60px">วันฟ้อง</th>
                              <th class="text-center" style="width: 50px">ระยะเวลา</th>
                              <th class="text-center" style="width: 100px">สถานะลูกหนี้</th>
                              <th class="text-center" style="width: 90px">สถานะทรัพย์</th>
                              <th class="text-center" style="width: 100px">สถานะประนอม</th>
                              <th class="text-center" style="width: 70px">ผู้ส่งฟ้อง</th>
                              <th class="text-center" style="width: 50px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}} </td>
                                <td class="text-center">  <!-- วันถืองาน -->
                                  @if($row->DateComplete_court != Null)
                                    @php
                                      $Cldate = date_create($row->Datesend_Flag);
                                      $nowCldate = date_create($row->DateComplete_court);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @elseif($row->DateUpState_legis != Null)
                                    @php
                                      $Cldate = date_create($row->Datesend_Flag);
                                      $nowCldate = date_create($row->DateUpState_legis);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @elseif($row->DateComplete_court == Null)
                                    @php
                                      $Cldate = date_create($row->Datesend_Flag);
                                      $nowCldate = date_create($date);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="red">{{$duration}}</font>
                                  @endif
                                </td>
                                <td class="text-center">  <!-- วันฟ้อง -->
                                  {{ DateThai($row->fillingdate_court) }}
                                </td>
                                <td class="text-center">  <!-- ระยะเวลา -->
                                  @if($row->Status_legis != Null)
                                    @php
                                      $Cldate = date_create($row->DateComplete_court);
                                      $nowCldate = date_create($row->DateUpState_legis);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="green">{{$duration}}</font>
                                  @else
                                    @php
                                      $Cldate = date_create($row->fillingdate_court);
                                      $nowCldate = date_create($date);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <font color="red">{{$duration}}</font>
                                  @endif
                                </td>
                                <td class="text-center">  <!-- สถานะลูกหนี้ -->
                                  @if($row->Status_legis != NULL)
                                    <button type="button" class="btn btn-success btn-sm" title="{{ $row->Status_legis }}">
                                      <i class="fas fa-check-square prem"></i> {{ $row->Status_legis }}
                                    </button>
                                  @else   <!-- ชั้นศาล -->
                                    @php
                                      $SetText = 'รอฟ้อง';
                                      $Newdate = date_create($date);
                                    @endphp
    
                                    @if($row->examiday_court != Null) <!-- วันที่สืบพยาน -->
                                      @php
                                        $Tab1 = date_create($row->examiday_court);
                                        $DateEx = date_diff($Newdate,$Tab1);
                                      @endphp
    
                                      @if($row->fuzzy_court != Null)  <!-- วันที่เลือน/สืบพยาน -->
                                        @php
                                          $Tab1 = date_create($row->fuzzy_court);
                                          $DateEx = date_diff($Newdate,$Tab1);
                                        @endphp
                                      @endif
    
                                      @if($row->ordersend_court != Null)  <!-- วันที่ส่งจริง/ส่งคำบังคับ -->
                                        @php
                                          $Tab2 = date_create($row->ordersend_court);
                                          $DateEx2 = date_diff($Newdate,$Tab2);
                                        @endphp
                                      @elseif($row->ordersend_court == Null)
                                        @php
                                          $Tab2 = date_create($row->orderday_court);
                                          $DateEx2 = date_diff($Newdate,$Tab2);
                                        @endphp
                                      @endif
    
                                      @if($row->checkday_court != Null) <!-- วันที่ตรวจผลหมาย -->
                                        @php
                                          $Tab3 = date_create($row->checkday_court);
                                          $DateEx3 = date_diff($Newdate,$Tab3);
                                        @endphp
                                      @endif
    
                                      @if($row->sendoffice_court != Null) <!-- วันที่ตั้งเจ้าพนักงาน -->
                                        @php
                                          $Tab4 = date_create($row->sendoffice_court);
                                          $DateEx4 = date_diff($Newdate,$Tab4);
                                        @endphp
                                      @elseif($row->sendoffice_court == Null)
                                        @php
                                          $Tab4 = date_create($row->setoffice_court);
                                          $DateEx4 = date_diff($Newdate,$Tab4);
                                        @endphp
                                      @endif
    
                                      @if($row->sendcheckresults_court != Null) <!-- วันที่ตรวจผลหมายตั้ง -->
                                        @php
                                          $Tab5 = date_create($row->sendcheckresults_court);
                                          $DateEx5 = date_diff($Newdate,$Tab5);
                                        @endphp
                                      @elseif($row->sendcheckresults_court == Null)
                                        @php
                                          $Tab5 = date_create($row->checkresults_court);
                                          $DateEx5 = date_diff($Newdate,$Tab5);
                                        @endphp
                                      @endif
    
                                      @if($row->datepreparedoc_case != Null) <!-- เตรียมเอกสาร/ชั้นบังคับคดี -->
                                        @php
                                          $Tab6 = date_create($row->datepreparedoc_case);
                                          $DateEx6 = date_diff($Newdate,$Tab6);
                                        @endphp
                                      @else
                                        @php
                                          $Tab6 = date_create("0000-00-00");
                                          $DateEx6 = date_diff($Newdate,$Tab6);
                                        @endphp
                                      @endif
    
                                      @if($row->datesetsequester_case != Null)  <!-- ยึดทรัพย์/ชั้นบังคับคดี -->
                                        @php
                                          $Tab7 = date_create($row->datesetsequester_case);
                                          $DateEx7 = date_diff($Newdate,$Tab7);
                                        @endphp
                                      @else
                                        @php
                                          $Tab7 = date_create("0000-00-00");
                                          $DateEx7 = date_diff($Newdate,$Tab7);
                                        @endphp
                                      @endif
    
                                      @if($row->DateNotice_cheat != Null) <!-- วันที่แจ้งความ/โกงเจ้าหนี้ -->
                                        @php
                                          $Tab8 = date_create($row->DateNotice_cheat);
                                          $DateEx8 = date_diff($Newdate,$Tab8);
                                        @endphp
                                      @else
                                        @php
                                          $Tab8 = date_create("0000-00-00");
                                          $DateEx8 = date_diff($Newdate,$Tab8);
                                        @endphp
                                      @endif
    
                                      {{-- แสดงสถานะ --}}
                                      @if($Newdate <= $Tab1)
                                        @if($DateEx->days <= 7)
                                          <button type="button" class="btn btn-danger btn-sm prem" title="วันสืบพยาน {{ DateThai($Tab1->format('Y-m-d')) }}">
                                            <i class="fas fa-bell"></i> สืบพยาน {{ $DateEx->days }} วัน</span>
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="วันสืบพยาน {{ DateThai($Tab1->format('Y-m-d')) }}">
                                            <i class="fas fa-clock prem"></i> รอสืบพยาน
                                          </button>
                                        @endif
                                      @elseif($Newdate <= $Tab2)  {{-- ส่งคำบังคับ --}}
                                        @if($DateEx2->days <= 7)
                                          <button type="button" class="btn btn-danger btn-sm prem" title="วันส่งคำบังคับ {{ DateThai($Tab2->format('Y-m-d')) }}">
                                            <i class="fas fa-bell"></i> ส่งคำบังคับ {{ $DateEx2->days }} วัน</span>
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="วันส่งคำบังคับ {{ DateThai($Tab2->format('Y-m-d')) }}">
                                            <i class="fas fa-clock prem"></i> รอส่งคำบังคับ
                                          </button>
                                        @endif
                                      @elseif($row->ordersend_court == Null)  {{-- เช็ควันส่งคำบังคับจริง --}}
                                        <button type="button" class="btn btn-warning btn-sm" title="รอลงวันที่ส่งคำบังคับจริง">
                                          <i class="fas fa-clock prem"></i> รอส่งคำบังคับจริง
                                        </button>
                                      @elseif($Newdate <= $Tab3)  {{-- ตรวจผลหมาย --}}
                                        @if($DateEx3->days <= 7)
                                          <button type="button" class="btn btn-danger btn-sm prem" title="วันตรวจผลหมาย {{ DateThai($Tab3->format('Y-m-d')) }}">
                                            <i class="fas fa-bell"></i> ตรวจผลหมาย {{ $DateEx3->days }} วัน</span>
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="วันตรวจผลหมาย {{ DateThai($Tab3->format('Y-m-d')) }}">
                                            <i class="fas fa-clock prem"></i> รอตรวจผลหมาย
                                          </button>
                                        @endif
                                      @elseif($Newdate <= $Tab4)  {{-- ตั้งเจ้าพนักงาน --}}
                                        @if($row->checksend_court != Null)
                                          @if($DateEx4->days <= 7)
                                            <button type="button" class="btn btn-danger btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                              <span class="fa fa-bello text-white prem"> ตั้งเจ้าพนักงาน {{ $DateEx4->days }} วัน</span>
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-warning btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                              <i class="fas fa-clock prem"></i> รอตั้งเจ้าพนักงาน
                                            </button>
                                          @endif
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="รอลงวันที่ผลตรวจหมายจริง">
                                            <i class="fas fa-clock prem"></i> รอผลตรวจหมายจริง
                                          </button>
                                        @endif
                                      @elseif($Newdate <= $Tab5)
                                        @if($DateEx5->days <= 7)
                                          <button type="button" class="btn btn-danger btn-sm prem" title="วันตรวจผลหมายตั้ง {{ DateThai($Tab5->format('Y-m-d')) }}">
                                            <i class="fas fa-bell"></i> ตรวจผลหมายตั้ง {{ $DateEx5->days }} วัน</span>
                                          </button>
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="วันตรวจผลหมายตั้ง {{ DateThai($Tab5->format('Y-m-d')) }}">
                                            <i class="fas fa-clock prem"></i> รอตรวจผลหมายตั้ง
                                          </button>
                                        @endif
                                      @else
                                        @if($Newdate <= $Tab6)  <!-- เตรียมเอกสาร/ชั้นบังคับคดี -->
                                          @if($DateEx6->days <= 7)
                                            <button type="button" class="btn btn-danger btn-sm prem" title="วันที่คัดฉโหนด {{ DateThai($Tab6->format('Y-m-d')) }}">
                                              <i class="fas fa-bell"></i> คัดโฉนด {{ $DateEx6->days }} วัน</span>
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-warning btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab6->format('Y-m-d')) }}">
                                              <i class="fas fa-clock prem"></i> รอคัดโฉนด
                                            </button>
                                          @endif
                                        @elseif($Newdate <= $Tab7)  <!-- ยึดทรัพย์/ชั้นบังคับคดี -->
                                          @if($DateEx7->days <= 7)
                                            <button type="button" class="btn btn-danger btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab7->format('Y-m-d')) }}">
                                              <span class="fas fa-bell text-white prem"> ตั้งเรื่องยึดทรัพย์ {{ $DateEx7->days }} วัน</span>
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-warning btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab7->format('Y-m-d')) }}">
                                              <i class="fa fa-clock-o prem"></i> ตั้งเรื่องยึดทรัพย์
                                            </button>
                                          @endif
                                        @elseif($row->resultsequester_case != Null) <!-- ประกาศขาย/ชั้นบังคับคดี -->
                                          @if($row->resultsequester_case == "ขายไม่ได้")
                                            <button type="button" class="btn btn-danger btn-sm prem" title="บังคับคดี/ขายไม่ได้">
                                              <i class="fas fa-bell"></i> บังคับคดี/ขายไม่ได้</span>
                                            </button>
                                          @else
                                            @if($row->resultsell_case == "เต็มจำนวน")
                                              <button type="button" class="btn btn-success btn-sm" title="ขายได้/เต็มจำนวน">
                                                <i class="fa fa-check-square-o prem"></i> ขายได้/เต็มจำนวน
                                              </button>
                                            @elseif($row->resultsell_case == "ไม่เต็มจำนวน")
                                              <button type="button" class="btn btn-danger btn-sm" title="ขายได้/เต็มจำนวน">
                                                <span class="fas fa-bell text-white prem"> ขายได้/ไม่เต็มจำนวน</span>
                                              </button>
                                            @else
                                            <button type="button" class="btn btn-warning btn-sm" title="รอผลจากการขาย">
                                              <i class="fas fa-clock prem"></i> รอผลจากการขาย
                                            </button>
                                            @endif
                                          @endif
                                        @elseif($Newdate <= $Tab8)  <!-- โกงเจ้าหนี้ -->
                                          @if($DateEx8->days <= 7)
                                            <button type="button" class="btn btn-danger btn-sm prem" title="วันที่แจ้งความ {{ DateThai($Tab8->format('Y-m-d')) }}">
                                              <i class="fas fa-bell"></i> โกงเจ้าหนี้ {{ $DateEx8->days }} วัน</span>
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-warning btn-sm" title="วันที่แจ้งความ {{ DateThai($Tab8->format('Y-m-d')) }}">
                                              <i class="fas fa-clock prem"></i> โกงเจ้าหนี้
                                            </button>
                                          @endif
                                        @else
                                          <button type="button" class="btn btn-warning btn-sm" title="รอขั้นตอนต่อไป">
                                            <i class="fas fa-clock prem"></i> รอขั้นตอนต่อไป
                                          </button>
                                        @endif
                                      @endif
                                    @else
                                      @if($row->fillingdate_court == Null)
                                        <button type="button" class="btn btn-danger btn-sm" title="รอฟ้อง">
                                          <i class="fas fa-exclamation-triangle prem"></i> รอฟ้อง
                                        </button>
                                      @elseif($row->fillingdate_court != Null)
                                      <button type="button" class="btn btn-warning btn-sm" title="สถานะฟ้อง">
                                        <i class="fas fa-clock"></i> ฟ้อง
                                      </button>
                                      @endif
                                    @endif
                                  @endif
                                </td>
                                <td class="text-center">  <!-- สถานะทรัพย์ -->
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
                                            <button type="button" class="btn btn-danger btn-sm prem" title="วันสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                              <i class="fas fa-bell"></i> สืบทรัพย์ใหม่ {{ $DateEx->days }} วัน</span>
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-warning btn-sm" title="รอสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                              <i class="fas fa-clock prem"></i> รอสืบทรัพย์
                                            </button>
                                          @endif
                                        @else
                                          <button type="button" class="btn btn-gray btn-sm prem" title="วันสืบทรัพย์ล่าสุด {{DateThai($row->NewpursueDate_asset)}}">
                                            <i class="fas fa-hourglass-half"></i> ไม่มีการอัพเดต </span>
                                          </button>
                                        @endif
                                    @elseif($row->sendsequester_asset == "สืบทรัพย์เจอ")
                                      <button type="button" class="btn btn-success btn-sm" title="สืบทรัพย์เจอ">
                                        <i class="fas fa-clipboard-check prem"></i> สืบทรัพย์เจอ
                                      </button>
                                    @elseif($row->sendsequester_asset == "หมดอายุความคดี")
                                      <button type="button" class="btn btn-primary btn-sm" title="หมดอายุความ">
                                        <i class="fas fa-gavel prem"></i> หมดอายุความคดี
                                      </button>
                                    @elseif($row->sendsequester_asset == "จบงานสืบทรัพย์")
                                      <button type="button" class="btn btn-success btn-sm" title="จบงานสืบทรัพย์">
                                        <i class="fas fa-gavel prem"></i> จบงานสืบทรัพย์
                                      </button>
                                    @else
                                      @if($row->propertied_asset == "Y")
                                        <button type="button" class="btn btn-success btn-sm" title="มีทรัพย์">
                                          <i class="fas fa-map-marked-alt prem"></i> มีทรัพย์
                                        </button>
                                      @elseif($row->propertied_asset == "N")
                                        @if($row->NewpursueDate_asset != Null)
                                          @php
                                            $Getdate = date_create($row->NewpursueDate_asset);
                                            $DateEx = date_diff($Newdate,$Getdate);
                                          @endphp
    
                                          @if($Newdate <= $Getdate)
                                            @if($DateEx->days <= 7)
                                              <button type="button" class="btn btn-danger btn-sm prem" title="สืบทรัพย์ {{DateThai($row->sequester_asset)}}">
                                                <span class="fa fa-bell text-white"> สืบทรัพย์ {{ $DateEx->days }} วัน</span>
                                              </button>
                                            @else
                                              <button type="button" class="btn btn-warning btn-sm" title="รอสืบทรัพย์ {{DateThai($row->sequester_asset)}}">
                                                <i class="fa fa-clock-o text-white prem"></i> รอสืบทรัพย์
                                              </button>
                                            @endif
                                          @endif
                                        @else
                                          <button type="button" class="btn btn-gray btn-sm" title="รอผลสืบทรัพย์">
                                            <i class="fas fa-hourglass-half prem"></i> รอผลสืบทรัพย์
                                          </button>
                                        @endif
                                      @endif
                                    @endif
                                  @else
                                    <button type="button" class="btn btn-gray btn-sm" title="ไม่มีข้อมูล">
                                      <i class="far fa-question-circle prem"></i> ไม่มีข้อมูล
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">  <!-- ประนอมหนี้ -->
                                  @php
                                    $lastday = date('Y-m-d', strtotime("-90 days"));
                                  @endphp
    
                                  @if($row->Status_Promise != NULL)
                                    <button type="button" class="btn btn-success btn-sm" title="ปิดบัญชี">
                                      <i class="fas fa-user-check prem"></i> ปิดบัญชี
                                    </button>
                                  @else
                                    @if($row->KeyCompro_id != Null)
                                      @foreach($dataPay as $key => $value)
                                        @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                          @if($value->Date_Payment < $lastday)
                                            <button type="button" class="btn btn-danger btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                              <i class="far fa-thumbs-down prem"></i> ขาดชำระ
                                            </button>
                                          @else
                                            <button type="button" class="btn btn-info btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                              <i class="far fa-thumbs-up prem"></i> ชำระปกติ
                                            </button>
                                          @endif
                                        @endif
                                      @endforeach
                                    @else
                                      <button type="button" class="btn btn-gray btn-sm" title="ไม่มีข้อมูล">
                                        <i class="far fa-question-circle prem"></i> ไม่มีข้อมูล
                                      </button>
                                    @endif
                                  @endif
                                </td>
                                <td class="text-center"> {{$row->User_court}} </td>
                                <td class="text-center">
                                  <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}" style="display:inline;">
                                  {{csrf_field()}}
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
                  @elseif($type == 6)  {{--ลูกหนี้เตรียมฟ้อง--}}
                    <div class="col-md-12">
                      <form method="get" action="{{ route('legislation', 6) }}">
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
                            <option value="1" {{ ($FlagStatus == '1') ? 'selected' : '' }}>ลูกหนี้ส่งฟ้อง</option>
                            <option value="2" {{ ($FlagStatus == '2') ? 'selected' : '' }}>ลูกหนี้เตรียมฟ้อง</option>
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
                                  <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}" style="display:inline;">
                                  {{csrf_field()}}
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
                  @elseif($type == 7)  {{--ลูกหนี้ประนอมหนี้--}}
                    <div class="col-md-12">
                      <form method="get" >
                        <div class="float-right form-inline">
                          <div class="btn-group">
                            <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                              <span class="fas fa-print"></span> ปริ้นรายงาน
                            </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-1" data-link="{{ route('legislation', 9) }}"> ใบเสร็จรับชำระ</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-2" data-link="{{ route('legislation', 15) }}"> รายงานบันทึกชำะค่างวด</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-3" data-link="{{ route('legislation', 16) }}"> รายงานลูกหนี้ประนอมหนี้</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-6" data-link="{{ route('legislation', 20) }}"> รายงานตรวจสอบยอดรับเงิน</a></li>
                              </ul>
                          </div>
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline">
                          <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="status" class="form-control form-control-sm" id="text">
                            <option selected value="">------ สถานะ ------</option>
                            <option value="ชำระปกติ" {{($status == 'ชำระปกติ') ? 'selected' : '' }}>ลูกหนี้ชำระปกติ</option>
                            <option value="ขาดชำระ" {{($status == 'ขาดชำระ') ? 'selected' : '' }}>ลูกหนี้ขาดชำระ</option>
                            <option value="ปิดบัญชี" {{($status == 'ปิดบัญชี') ? 'selected' : '' }}>ลูกหนี้ปิดบัญชี</option>
                          </select>

                          <label class="mr-sm-2">จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />
  
                          <label class="mr-sm-2">ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
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
                              <th class="text-center">เริ่มประนอม</th>
                              {{-- <th class="text-center">ระยะเวลา</th> --}}
                              <th class="text-center">ยอดประนอม</th>
                              <th class="text-center">ยอดคงเหลือ</th>
                              {{-- <th class="text-center">ผู้ส่งประนอม</th> --}}
                              <th class="text-center">สถานะ</th>
                              <th class="text-left" style="width: 50px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-left">
                                  {{$row->Contract_legis}}
                                  @if($row->Flag == "C")
                                    <span class="badge bg-warning prem">ประนอม</span>
                                  @endif
                                </td>
                                <td class="text-left"> {{$row->Name_legis}} </td>
                                <td class="text-center"> {{DateThai($row->Date_Promise)}}</td>
                                {{-- <td class="text-center">
                                  @if($row->Status_Promise == "ปิดบัญชีประนอมหนี้" or $row->Status_Promise == "จ่ายจบประนอมหนี้")
                                    @php
                                      $Cldate = date_create($row->Date_Promise);
                                      $nowCldate = date_create($row->DateStatus_Promise);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <span data-toggle="tooltip" title="{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน"><font color="green" title="test">{{$duration}}</font></span>
                                  @else
                                    @php
                                      $nowday = date('Y-m-d');
                                      $Cldate = date_create($row->Date_Promise);
                                      $nowCldate = date_create($nowday);
                                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                                      $duration = $ClDateDiff->format("%a วัน")
                                    @endphp
                                    <span data-toggle="tooltip" title="{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน"><font color="red">{{$duration}}</font></span>
                                  @endif
                                </td> --}}
                                <td class="text-right"> {{number_format($row->Total_Promise, 2)}}</td>
                                <td class="text-right"> {{number_format($row->Sum_Promise, 2)}}</td>
                                {{-- <td class="text-center"> {{ $row->User_Promise }}</td> --}}
                                <td class="text-right">
                                  @php
                                    $lastday = date('Y-m-d', strtotime("-90 days"));
                                    $SetPayAll = str_replace (",","",$row->Payall_Promise);
                                  @endphp

                                  @if($row->Payall_Promise != NULL)
                                    @foreach($dataType as $key => $value)
                                      @if($row->legisPromise_id == $value->id)
                                        @if($SetPayAll == $value->total)
                                          <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="ครบชำระเงินก้อนแรก">
                                            <i class="fas fa-hands-helping prem"></i>
                                          </button>
                                        @else
                                          <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="นัดชำระก้อนแรกทุกๆวัน {{date('d', strtotime($value->DateFirst_Promise))}}">
                                            <i class="fas fa-hand-holding-usd prem"></i>
                                          </button>
                                        @endif
                                      @endif
                                    @endforeach
                                  @endif
    
                                  @if($row->Status_Promise == "ปิดบัญชีประนอมหนี้" or $row->Status_Promise == "จ่ายจบประนอมหนี้")
                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{ $row->Status_Promise }}">
                                      <i class="fas fa-user-check prem"></i>
                                    </button>
                                  @else
                                    @foreach($dataPay as $key => $value)
                                      @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                        @if($value->Date_Payment < $lastday)
                                          <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="วันดิวงวดถัดไป {{DateThai($value->Date_Payment)}}">
                                            <i class="far fa-thumbs-down prem"></i> 
                                          </button>
                                        @else
                                          <button data-toggle="tooltip" type="button" class="btn btn-info btn-sm" title="วันดิวงวดถัดไป {{DateThai($value->Date_Payment)}}">
                                            <i class="far fa-thumbs-up prem"></i>
                                          </button>
                                        @endif
                                      @endif
                                    @endforeach
                                  @endif
                                </td>
                                <td class="text-left">
                                  <a href="{{ action('LegislationController@edit',[$row->id, 4]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  @if($row->Flag == "C")
                                    @if(auth::user()->type != "แผนก การเงินนอก")
                                      <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_legis }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @endif
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 8)  {{--ลูกหนี้สืบทรัพย์--}}
                    <div class="col-md-12">
                      <form method="get" action="{{ route('legislation', 8) }}">
                        <div class="float-right form-inline">
                          <div class="btn-group">
                            <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                              <span class="fas fa-print"></span> ปริ้นรายงาน
                            </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-4" data-link="{{ route('legislation', 19) }}"> รายงานสืบทรัพย์</a></li>
                              </ul>
                          </div>
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <br><br><br><p></p>
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />
  
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />
                        
                          <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="status" class="form-control" id="text" style="width: 177px">
                            <option selected value="">--- สถานะ ---</option>
                            <option value="Y" {{ ($SetSelect == 'Y') ? 'selected' : '' }}>มีทรัพย์</otion>
                            <option value="N" {{ ($SetSelect == 'N') ? 'selected' : '' }}>ไม่มีทรัพย์</otion>
                            <option value="หมดอายุความ" {{ ($SetSelect == 'หมดอายุความ') ? 'selected' : '' }}>หมดอายุความ</otion>
                            <option value="จบงานสืบทรัพย์" {{ ($SetSelect == 'จบงานสืบทรัพย์') ? 'selected' : '' }}>จบงานสืบทรัพย์</otion>
                          </select>
                        </div>
                      </form>
                      <br><br>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center" style="width: 30px">No.</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">วันที่สืบทรัพย์</th>
                              <th class="text-center">ระยะเวลา</th>
                              <th class="text-center">สถานะทรัพย์</th>
                              <th class="text-center">สถานะแจ้งเตือน</th>
                              <th class="text-center">ผู้สืบทรัพย์</th>
                              <th class="text-center" style="width: 100px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <!-- <td class="text-center"><a href="#" data-toggle="modal" data-target="#modal_default" data-backdrop="static" data-keyboard="false">{{$row->Contract_legis}}</a></td> -->
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
                                <td class="text-center">
                                  <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}"  style="display:inline;">
                                  {{csrf_field()}}
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
                      <form method="get" action="{{ route('legislation', 10) }}">
                        <div class="float-right form-inline">
                            <a href="{{ route('legislation', 11) }}" class="btn bg-success btn-app">
                              <i class="fas fa-plus"></i> เพิ่มข้อมูล
                            </a>
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
                                <a href="{{ action('LegislationController@edit',[$row->Legisexhibit_id, 10]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"></i>
                                </a>
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->Legisexhibit_id ,3]) }}"  style="display:inline;">
                                {{csrf_field()}}
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
                              <!-- <th class="text-center">ยอดชำระล่าสุด</th> -->
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

  <!-- Pop up ปริ้นใบเสร็จ -->
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <!-- Pop up รายงานบันทึกชำะค่างวด -->
  <div class="modal fade" id="modal-2">
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

  <!-- Pop up รายงานลูกหนี้ประนอม -->
  <div class="modal fade" id="modal-3">
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

  <!-- Pop up รายงานตรวจสอบยอดชำระ -->
  <div class="modal fade" id="modal-6">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
      </div>
    </div>
  </div>

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

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-1").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-1 .modal-body").load(link, function(){
        });
      });
      $("#modal-2").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-2 .modal-body").load(link, function(){
        });
      });
      $("#modal-3").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-3 .modal-body").load(link, function(){
        });
      });
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

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table,#table1').DataTable( {
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
