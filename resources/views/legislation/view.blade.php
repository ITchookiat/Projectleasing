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

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          @if($type == 1)
            <h4 class="card-title" align="center"><b>รายชื่อส่งฟ้อง</b></h4>
          @elseif($type == 2)
            <h4 class="card-title" align="center"><b>ลูกหนี้ฟ้อง</b></h4>
          @elseif($type == 6)
            <h4 class="card-title" align="center"><b>ลูกหนี้เตรียมฟ้อง</b></h4>
          @elseif($type == 7)
            <h4 class="card-title" align="center"><a href="{{ route('legislation',7) }}"><b>ลูกหนี้ประนอมหนี้</b></a></h4>
          @elseif($type == 8)
            <h4 class="card-title" align="center"><b>ลูกหนี้สืบทรัพย์</b></h4>
          @elseif($type == 10)
            <h4 class="card-title" align="center"><b><a href="{{ route('legislation',10) }}">ลูกหนี้ของกลาง</a></b></h4>
          @elseif($type == 12)
            <h4 class="card-title" align="center"><b>ลูกหนี้ขายฝาก</b></h4>
          @endif

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              @if($type == 1)   {{--รายชื่อ--}}
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="table">
                             <thead class="thead-dark bg-gray-light" >
                               <tr>
                                 <th class="text-center" style="width: 10px">ลำดับ</th>
                                 <th class="text-center">เลขที่สัญญา</th>
                                 <th class="text-center">ชื่อ-สกุล</th>
                                 <th class="text-center">วันที่ทำสัญญา</th>
                                 <th class="text-center">ยอดคงเหลือ</th>
                                 <th class="text-center">สถานะ</th>
                                 <th class="text-center">ค้างงวดจริง</th>
                                 <th class="text-center" style="width: 130px">ตัวเลือก</th>
                               </tr>
                             </thead>
                             <tbody>
                               @foreach($arrayMerge as $key => $row)
                                 <tr>
                                   <td class="text-center"> {{$key+1}} </td>
                                   <td class="text-center">
                                     {{$row->CONTNO}}
                                     @php
                                       $StatusCheck = (iconv('TIS-620', 'utf-8', str_replace(" ","",$row->CONTSTAT)));
                                     @endphp
                                     @if($StatusCheck == "ป")
                                       <span class="label label-warning">ประนอม</span>
                                     @endif
                                   </td>
                                   <td class="text-left">{{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}}</td>
                                   <td class="text-center"> {{ DateThai($row->FDATE) }} </td>
                                   <td class="text-center"> {{ number_format($row->BALANC - $row->SMPAY, 2) }} </td>
                                   <td class="text-center">
                                     @php
                                       $Flag = "N";
                                       $SetBaab = iconv('Tis-620','utf-8',str_replace(" ","",$row->BAAB));
                                     @endphp

                                     @foreach($result2 as $key => $value)
                                       @if($row->CONTNO == $value->CONTNO)
                                         มีหลักพรัทย์
                                         @php
                                           $Flag = "Y";
                                           $Realty = "มีหลักพรัทย์";
                                         @endphp
                                       @endif
                                     @endforeach

                                     @if($Flag == "N")
                                       @if($SetBaab == "มีหลักพรัทย์")
                                         มีหลักพรัทย์
                                         @php
                                           $Realty = "มีหลักพรัทย์";
                                         @endphp
                                       @else
                                         ไม่มีหลักพรัทย์
                                         @php
                                           $Realty = "ไม่มีหลักพรัทย์";
                                         @endphp
                                       @endif
                                     @endif
                                   </td>
                                   <td class="text-center"> {{$row->HLDNO}} </td>
                                   <td class="text-center">
                                     @php
                                        $StrCon = explode("/",$row->CONTNO);
                                        $SetStr1 = $StrCon[0];
                                        $SetStr2 = $StrCon[1];

                                        $Tax = "N";
                                        $TaxStat = "N";
                                     @endphp

                                     @foreach($dataDB as $key => $row1)
                                       @if($row->CONTNO == $row1->Contract_legis)
                                           @if($row1->Flag_status == 1)
                                             <button class="btn btn-warning btn-sm" title="จัดเตรียมฟ้อง">
                                               <span class="glyphicon glyphicon-time"></span> เตรียมฟ้อง
                                             </button>
                                           @elseif($row1->Flag_status == 3)
                                             <button class="btn btn-success btn-sm" title="ลูกหนี้ประนอมหนี้">
                                               <span class="glyphicon glyphicon-lock"></span> ประนอมหนี้
                                             </button>
                                           @else
                                             <button class="btn btn-success btn-sm" title="ขั้นตอนการฟ้อง">
                                               <span class="glyphicon glyphicon-lock"></span> ลูกหนี้ฟ้อง
                                             </button>
                                           @endif
                                         @php
                                           $Tax = "Y";
                                           $TaxStat = "Y";
                                         @endphp
                                       @endif
                                     @endforeach

                                     @if($StatusCheck != "ป")
                                       @if($Tax == "N")
                                         <a href="{{ route('legislation.Savestore', [$SetStr1,$SetStr2,$Realty,1]) }}" id="edit" class="btn btn-danger btn-sm" title="จัดเตรียมเอกสาร">
                                           <span class="glyphicon glyphicon-edit"></span> ส่งเอกสาร
                                         </a>
                                       @endif
                                     @else
                                       @if($TaxStat == "N")
                                         <a href="{{ route('legislation.Savestore', [$SetStr1,$SetStr2,$Realty,2]) }}" id="edit" class="btn btn-info btn-sm" title="ประนอมหนี้">
                                           <span class="glyphicon glyphicon-edit"></span> ส่งประนอม
                                         </a>
                                       @endif
                                     @endif
                                   </td>
                                 </tr>
                               @endforeach
                             </tbody>
                         </table>
                        </div>
                    </div>
                </div>
              @elseif($type == 2)  {{--ลูกหนี้ฟ้อง--}}
                <div class="col-md-12">
                  <form method="get" action="{{ route('legislation', 2) }}">
                      <div align="right" class="form-inline">
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-app dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          </button>
                           <ul class="dropdown-menu" role="menu">
                              <li><a target="_blank" href="{{ route('legislation', 17) }}" data-toggle="modal" data-target="#modal-4" data-backdrop="static" data-keyboard="false"> รายงานลูกหนี้ฟ้อง</a></li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-warning btn-app">
                          <span class="glyphicon glyphicon-search"></span> Search
                        </button>

                        <p></p>
                        <label for="text" class="mr-sm-2">สถานะปิดงาน : </label>
                        <select name="StateLegis" class="form-control mb-2 mr-sm-2" id="text" style="width: 150px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="จ่ายจบก่อนฟ้อง" {{ ($StateLegis == 'จ่ายจบก่อนฟ้อง') ? 'selected' : '' }}>จ่ายจบก่อนฟ้อง</otion>
                          <option value="ยึดรถก่อนฟ้อง" {{ ($StateLegis == 'ยึดรถก่อนฟ้อง') ? 'selected' : '' }}>ยึดรถก่อนฟ้อง</otion>
                          <option value="ปิดบัญชีประนอมหนี้" {{ ($StateLegis == 'ปิดบัญชีประนอมหนี้') ? 'selected' : '' }}>ปิดบัญชีประนอมหนี้</otion>
                          <option value="ยึดรถหลังฟ้อง" {{ ($StateLegis == 'ยึดรถหลังฟ้อง') ? 'selected' : '' }}>ยึดรถหลังฟ้อง</otion>
                          <option value="หมดอายุความคดี" {{ ($StateLegis == 'หมดอายุความคดี') ? 'selected' : '' }}>หมดอายุความคดี</otion>
                        </select>

                        <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="StateCourt" class="form-control mb-2 mr-sm-2" id="text" style="width: 150px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="ชั้นศาล" {{ ($StateCourt == 'ชั้นศาล') ? 'selected' : '' }}>ชั้นศาล</otion>
                          <option value="ชั้นบังคับคดี" {{ ($StateCourt == 'ชั้นบังคับคดี') ? 'selected' : '' }}>ชั้นบังคับคดี</otion>
                        </select>

                        <p></p>
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" style="width: 150px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" style="width: 150px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />
                      </div>
                    </form>
                  <hr>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">No.</th>
                          <th class="text-center">Job.</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">วันถืองาน</th>
                          <th class="text-center">วันส่งฟ้อง</th>
                          <th class="text-center" style="width: 70px">ระยะเวลา</th>
                          <th class="text-center" style="width: 80px">สถานะลูกหนี้</th>
                          <th class="text-center" style="width: 80px">สถานะทรัพย์</th>
                          <th class="text-center" style="width: 80px">สถานะประนอม</th>
                          <th class="text-center" style="width: 130px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <!-- <td class="text-center"><a href="#" data-toggle="modal" data-target="#modal_default" data-backdrop="static" data-keyboard="false">{{$row->Contract_legis}}</a></td> -->
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-left"> {{$row->Name_legis}} </td>
                            <td class="text-center">  <!-- วันถืองาน -->
                              @if($row->DateComplete_court == Null)
                                @php
                                  $Cldate = date_create($row->Datesend_Flag);
                                  $nowCldate = date_create($date);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="red">{{$duration}}</font>
                              @elseif($row->DateComplete_court != Null)
                                @php
                                  $Cldate = date_create($row->Datesend_Flag);
                                  $nowCldate = date_create($row->DateComplete_court);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="green">{{$duration}}</font>
                              @endif
                            </td>
                            <td class="text-center">  <!-- วันฟ้อง -->
                              @if($row->fillingdate_court != NUll)
                                {{ DateThai($row->fillingdate_court) }}
                              @endif
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
                                  <i class="fa fa-check-square-o prem"></i> {{ $row->Status_legis }}
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

                                  @if($row->fuzzy_court != Null)  <!-- วันที่ส่งจริง/ส่งคำบังคับ -->
                                    @php
                                      $Tab1 = date_create($row->fuzzy_court);
                                      $DateEx = date_diff($Newdate,$Tab1);
                                    @endphp
                                  @endif

                                  @if($row->ordersend_court != Null)  <!-- วันที่ตรวจผลหมายจริง -->
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

                                  @if($Newdate <= $Tab1)
                                    @if($DateEx->days <= 7)
                                      <button type="button" class="btn btn-danger btn-sm" title="วันสืบพยาน {{ DateThai($Tab1->format('Y-m-d')) }}">
                                        <span class="fa fa-bell text-white prem"> สืบพยาน {{ $DateEx->days }} วัน</span>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันสืบพยาน {{ DateThai($Tab1->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอสืบพยาน
                                      </button>
                                    @endif
                                  @elseif($Newdate <= $Tab2)
                                    @if($DateEx2->days <= 7)
                                      <button type="button" class="btn btn-danger btn-sm" title="วันส่งคำบังคับ {{ DateThai($Tab2->format('Y-m-d')) }}">
                                        <span class="fa fa-bell text-white prem"> ส่งคำบังคับ {{ $DateEx2->days }} วัน</span>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันส่งคำบังคับ {{ DateThai($Tab2->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอส่งคำบังคับ
                                      </button>
                                    @endif
                                  @elseif($Newdate <= $Tab3)
                                    @if($DateEx3->days <= 7)
                                      <button type="button" class="btn btn-danger btn-sm" title="วันตรวจผลหมาย {{ DateThai($Tab3->format('Y-m-d')) }}">
                                        <span class="fa fa-bell text-white prem"> ตรวจผลหมาย {{ $DateEx3->days }} วัน</span>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันตรวจผลหมาย {{ DateThai($Tab3->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอตรวจผลหมาย
                                      </button>
                                    @endif
                                  @elseif($Newdate <= $Tab4)
                                    @if($row->checksend_court != Null)
                                      @if($DateEx4->days <= 7)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                          <span class="fa fa-bello text-white prem"> ตั้งเจ้าพนักงาน {{ $DateEx4->days }} วัน</span>
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-warning btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                          <i class="fa fa-clock-o prem"></i> รอตั้งเจ้าพนักงาน
                                        </button>
                                      @endif
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอผลตรวจหมายจริง
                                      </button>
                                    @endif
                                  @elseif($Newdate <= $Tab5)
                                    @if($DateEx5->days <= 7)
                                      <button type="button" class="btn btn-danger btn-sm" title="วันตรวจผลหมายตั้ง {{ DateThai($Tab5->format('Y-m-d')) }}">
                                        <span class="fa fa-bell text-white prem"> ตรวจผลหมายตั้ง {{ $DateEx5->days }} วัน</span>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันตรวจผลหมายตั้ง {{ DateThai($Tab5->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอตรวจผลหมายตั้ง
                                      </button>
                                    @endif
                                  @else
                                    @if($Newdate <= $Tab6)  <!-- เตรียมเอกสาร/ชั้นบังคับคดี -->
                                      @if($DateEx6->days <= 7)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab6->format('Y-m-d')) }}">
                                          <span class="fa fa-bell text-white prem"> คัดฉโหนด {{ $DateEx6->days }} วัน</span>
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-warning btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab6->format('Y-m-d')) }}">
                                          <i class="fa fa-clock-o prem"></i> รอคัดฉโหนด
                                        </button>
                                      @endif
                                    @elseif($Newdate <= $Tab7)  <!-- ยึดทรัพย์/ชั้นบังคับคดี -->
                                      @if($DateEx7->days <= 7)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab7->format('Y-m-d')) }}">
                                          <span class="fa fa-bell text-white prem"> ตั้งเรื่องยึดทรัพย์ {{ $DateEx7->days }} วัน</span>
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-warning btn-sm" title="วันที่คัดฉโหนด {{ DateThai($Tab7->format('Y-m-d')) }}">
                                          <i class="fa fa-clock-o prem"></i> ตั้งเรื่องยึดทรัพย์
                                        </button>
                                      @endif
                                    @elseif($row->resultsequester_case != Null) <!-- ประกาศขาย/ชั้นบังคับคดี -->
                                      @if($row->resultsequester_case == "ขายไม่ได้")
                                        <button type="button" class="btn btn-danger btn-sm" title="บังคับคดี/ขายไม่ได้">
                                          <span class="fa fa-bell text-white prem"> บังคับคดี/ขายไม่ได้</span>
                                        </button>
                                      @else
                                        @if($row->resultsell_case == "เต็มจำนวน")
                                          <button type="button" class="btn btn-success btn-sm" title="ขายได้/เต็มจำนวน">
                                            <i class="fa fa-check-square-o prem"></i> ขายได้/เต็มจำนวน
                                          </button>
                                        @elseif($row->resultsell_case == "ไม่เต็มจำนวน")
                                          <button type="button" class="btn btn-danger btn-sm" title="ขายได้/เต็มจำนวน">
                                            <span class="fa fa-bell text-white prem"> ขายได้/ไม่เต็มจำนวน</span>
                                          </button>
                                        @else
                                        <button type="button" class="btn btn-warning btn-sm" title="รอผลจากการขาย">
                                          <i class="fa fa-clock-o prem"></i> รอผลจากการขาย
                                        </button>
                                        @endif
                                      @endif
                                    @elseif($Newdate <= $Tab8)  <!-- โกงเจ้าหนี้ -->
                                      @if($DateEx8->days <= 8)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันที่แจ้งความ {{ DateThai($Tab8->format('Y-m-d')) }}">
                                          <span class="fa fa-bell text-white prem"> โกงเจ้าหนี้ {{ $DateEx8->days }} วัน</span>
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-warning btn-sm" title="วันที่แจ้งความ {{ DateThai($Tab8->format('Y-m-d')) }}">
                                          <i class="fa fa-clock-o prem"></i> โกงเจ้าหนี้
                                        </button>
                                      @endif
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="รอขั้นตอนต่อไป">
                                        <i class="fa fa-clock-o prem"></i> รอขั้นตอนต่อไป
                                      </button>
                                    @endif
                                  @endif
                                @else
                                  @if($row->fillingdate_court == Null)
                                    <button type="button" class="btn btn-danger btn-sm" title="รอฟ้อง">
                                      <i class="fa fa-warning prem"></i> รอฟ้อง
                                    </button>
                                  @elseif($row->fillingdate_court != Null)
                                  <button type="button" class="btn btn-warning btn-sm" title="สถานะฟ้อง">
                                    <i class="fa fa-clock-o"></i> ฟ้อง
                                  </button>
                                  @endif
                                @endif
                              @endif
                            </td>
                            <td class="text-center">  <!-- สถานะทรัพย์ -->
                              @if($row->sequester_asset != Null)
                                @php
                                  $Getdate = date_create($row->sequester_asset);
                                  $Newdate = date_create($date);
                                  $DateEx = date_diff($Newdate,$Getdate);
                                @endphp

                                @if($row->sendsequester_asset == "ไม่เจอ")
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
                                @elseif($row->sendsequester_asset == "เจอ")
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
                              @else
                                <button type="button" class="btn btn-gray btn-sm" title="ไม่มีข้อมูล">
                                  <i class="fa fa-question-circle prem"></i> ไม่มีข้อมูล
                                </button>
                              @endif
                            </td>
                            <td class="text-center">  <!-- ประนอมหนี้ -->
                              @php
                                $lastday = date('Y-m-d', strtotime("-90 days"));
                              @endphp

                              @if($row->Status_Promise != NULL)
                                <button type="button" class="btn btn-success btn-sm" title="ปิดบัญชี">
                                  <span class="glyphicon glyphicon-ok prem"></span> ปิดบัญชี
                                </button>
                              @else
                                @if($row->KeyCompro_id != Null)
                                  @foreach($dataPay as $key => $value)
                                    @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                      @if($value->Date_Payment < $lastday)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                          <span class="glyphicon glyphicon-thumbs-down prem"></span> ขาดชำระ
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-info btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                          <span class="glyphicon glyphicon-thumbs-up prem"></span> ชำระปกติ
                                        </button>
                                      @endif
                                    @endif
                                  @endforeach
                                @else
                                  <button type="button" class="btn btn-gray btn-sm" title="ไม่มีข้อมูล">
                                    <i class="fa fa-question-circle prem"></i> ไม่มีข้อมูล
                                  </button>
                                @endif
                              @endif
                            </td>
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
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
              @elseif($type == 6)  {{--ลูกหนี้เตรียมฟ้อง--}}
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">วันทีส่งทนาย</th>
                          <th class="text-center">ค้างงวด</th>
                          <th class="text-center">ระยะเวลา</th>
                          <th class="text-center">หมายเหตุ</th>
                          <th class="text-center">สถานะ</th>
                          <th class="text-center" style="width: 150px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
                            <td class="text-center">
                              @if($row->Datesend_Flag != Null)
                                {{ DateThai($row->Datesend_Flag) }}
                              @endif
                            </td>
                            <td class="text-center">
                              @php
                                 $StrCon = explode("/",$row->Contract_legis);
                                 $SetStr1 = $StrCon[0];
                                 $SetStr2 = $StrCon[1];
                              @endphp

                              @foreach($result as $key => $row1)
                                @if($row->Contract_legis == $row1->CONTNO)
                                  @if($row->Realperiod_legis < $row1->HLDNO)
                                    {{$row1->HLDNO}}
                                  @else
                                    {{$row->Realperiod_legis}}
                                  @endif
                                @endif
                              @endforeach
                            </td>
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
                            <td class="text-left" style="width:200px;"> {{ $row->Noteby_legis }} </td>
                            <td class="text-center">
                              @if($row->Flag_status == '1')
                              <button type="button" class="btn btn-danger btn-sm" title="เตรียมเอกสาร">
                                <span class="glyphicon glyphicon-copy"></span> เตรียมเอกสาร
                              </button>
                              @else
                              <button type="button" class="btn btn-success btn-sm" title="ส่งเอกสารแล้ว">
                                <span class="glyphicon glyphicon-paste"></span> ส่งเอกสารแล้ว
                              </button>
                              @endif
                            </td>
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
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
              @elseif($type == 7)  {{--ลูกหนี้ประนอมหนี้--}}
                <div class="col-md-12">
                  <form method="get" >
                     <div class="form-inline" align=right>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-app dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          </button>
                           <ul class="dropdown-menu" role="menu">
                              <li><a target="_blank" href="{{ route('legislation', 9) }}" data-toggle="modal" data-target="#modal-1" data-backdrop="static" data-keyboard="false"> ใบเสร็จรับชำระ</a></li>
                              <li class="divider"></li>
                              <li><a target="_blank" href="{{ route('legislation', 15) }}" data-toggle="modal" data-target="#modal-2" data-backdrop="static" data-keyboard="false">รายงานบันทึกชำะค่างวด</a></li>
                              <li class="divider"></li>
                              <li><a target="_blank" href="{{ route('legislation', 16) }}" data-toggle="modal" data-target="#modal-3" data-backdrop="static" data-keyboard="false">รายงานลูกหนี้ประนอม</a></li>
                              <!-- <li class="divider"></li>
                              <li><a target="_blank" href="{{ route('legislation.report', [00,7]) }}?&Fromdate={{$newfdate}}&Todate={{$newtdate}}&status={{$status}}">รายงาน PDF</a></li> -->
                            </ul>
                        </div>

                       <button type="submit" class="btn btn-warning btn-app">
                         <span class="glyphicon glyphicon-search"></span> Search
                       </button>
                       <p></p>
                        <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="ชำระปกติ" {{($status == 'ชำระปกติ') ? 'selected' : '' }}>ชำระปกติ</otion>
                          <option value="ขาดชำระ" {{($status == 'ขาดชำระ') ? 'selected' : '' }}>ขาดชำระ</otion>
                          <option value="ปิดบัญชี" {{($status == 'ปิดบัญชี') ? 'selected' : '' }}>ปิดบัญชี</otion>
                        </select>
                        <br>
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: '' }}" style="width: 180px;" class="form-control" />

                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: '' }}" style="width: 180px;" class="form-control" />
                      </div>
                 </form>
                </div>

                <div class="col-md-12">
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">ประนอม</th>
                          <th class="text-center">ระยะเวลา</th>
                          <th class="text-center">ยอดประนอม</th>
                          <th class="text-center">ยอดคงเหลือ</th>
                          <th class="text-center">ชำระล่าสุด</th>
                          <th class="text-center">สถานะ</th>
                          <th class="text-center">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center">
                              {{$row->Contract_legis}}
                              @if($row->Flag == "C")
                                <span class="label label-warning">ประนอม</span>
                              @endif
                            </td>
                            <td class="text-left"> {{$row->Name_legis}} </td>
                            <td class="text-center"> {{DateThai($row->Date_Promise)}}</td>
                            <td class="text-center">
                              @if($row->Status_legis == "ปิดบัญชีประนอมหนี้" or $row->Status_legis == "ยึดรถหลังฟ้อง")
                                @php
                                  $Cldate = date_create($row->Date_Promise);
                                  $nowCldate = date_create($row->DateUpState_legis);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="green">{{$duration}}</font>
                              @else
                                @php
                                  $nowday = date('Y-m-d');
                                  $Cldate = date_create($row->Date_Promise);
                                  $nowCldate = date_create($nowday);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="red">{{$duration}}</font>
                              @endif
                            </td>
                            <td class="text-center"> {{number_format($row->Total_Promise,2)}}</a></td>
                            <td class="text-center"> {{number_format($row->Sum_Promise,2)}}</a></td>
                            <td class="text-center">
                              @foreach($dataPay as $key => $value)
                               @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                {{DateThai($value->Date_Payment)}}
                               @endif
                              @endforeach
                            </td>
                            <td class="text-center">
                              @php
                                $lastday = date('Y-m-d', strtotime("-90 days"));
                              @endphp

                              @if($row->Status_legis == "ปิดบัญชีประนอมหนี้" or $row->Status_legis == "ยึดรถหลังฟ้อง")
                                <button type="button" class="btn btn-success btn-sm" title="ปิดบัญชี">
                                  <span class="glyphicon glyphicon-ok prem"></span> ปิดบัญชี
                                </button>
                              @else
                                  @foreach($dataPay as $key => $value)
                                    @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                         @if($value->Date_Payment < $lastday)
                                           <button type="button" class="btn btn-danger btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                             <span class="glyphicon glyphicon-thumbs-down prem"></span> ขาดชำระ
                                           </button>
                                         @else
                                           <button type="button" class="btn btn-info btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                             <span class="glyphicon glyphicon-thumbs-up prem"></span> ชำระปกติ
                                           </button>
                                         @endif
                                       @endif
                                  @endforeach
                               @endif

                            </td>
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id, 4]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                @if($row->Flag == "C")
                                  <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
                                  {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                      <span class="glyphicon glyphicon-trash"></span> ลบ
                                    </button>
                                  </form>
                                @endif
                              </div>
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
                      <div align="right" class="form-inline">
                          <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', $type) }}" class="btn btn-primary btn-app">
                            <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          </a>
                        <button type="submit" class="btn btn-warning btn-app">
                          <span class="glyphicon glyphicon-search"></span> Search
                        </button>

                        <p></p>
                        <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 150px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="Y" {{ ($SetSelect == 'Y') ? 'selected' : '' }}>มีทรัพย์</otion>
                          <option value="N" {{ ($SetSelect == 'N') ? 'selected' : '' }}>ไม่มีทรัพย์</otion>
                          <option value="หมดอายุความ" {{ ($SetSelect == 'หมดอายุความ') ? 'selected' : '' }}>หมดอายุความ</otion>
                          <option value="จบงานสืบทรัพย์" {{ ($SetSelect == 'จบงานสืบทรัพย์') ? 'selected' : '' }}>จบงานสืบทรัพย์</otion>
                        </select>

                        <p></p>
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" style="width: 150px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" style="width: 150px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />
                      </div>
                    </form>
                  <hr>
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center" style="width: 40px">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">วันที่สืบทรัพย์</th>
                          <th class="text-center">ระยะเวลา</th>
                          <th class="text-center">สถานะทรัพย์</th>
                          <th class="text-center">สถานะแจ้งเตือน</th>
                          <th class="text-center" style="width: 150px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <!-- <td class="text-center"><a href="#" data-toggle="modal" data-target="#modal_default" data-backdrop="static" data-keyboard="false">{{$row->Contract_legis}}</a></td> -->
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
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
                              @if($row->sequester_asset != Null)
                                @php
                                  $Getdate = date_create($row->sequester_asset);
                                  $Newdate = date_create($date);
                                  $DateEx = date_diff($Newdate,$Getdate);
                                @endphp

                                @if($row->sendsequester_asset == "ไม่เจอ")
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
                                @elseif($row->sendsequester_asset == "เจอ")
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
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button disabled type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
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
              @elseif($type == 10) {{--ลูกหนี้ของกลาง--}}
                <div class="col-md-12">
                  <form method="get" action="{{ route('legislation', 10) }}">
                      <div align="right" class="form-inline">
                          <a href="{{ route('legislation', 11) }}" class="btn btn-success btn-app">
                            <span class="glyphicon glyphicon-plus"></span> เพิ่มข้อมูล
                          </a>
                          &nbsp;
                          <div class="btn-group">
                           <button type="button" class="btn btn-primary btn-app dropdown-toggle" data-toggle="dropdown">
                             <span class="glyphicon glyphicon-print"></span> ปริ้นรายงาน
                           </button>
                           <ul class="dropdown-menu" role="menu">
                             <li><a target="_blank" href="{{ route('legislation.report', [00,10]) }}?&Fromdate={{$fdate}}&Todate={{$tdate}}&TerminateExhibit={{$terminateexhibit}}&Typeexhibit={{$typeexhibit}}"><i class="fa fa-file-pdf-o text-red"></i>PDF </a></li>
                             <li class="divider"></li>
                            <li><a target="_blank" href="{{ route('legislation.report', [00,10]) }}?&Fromdate={{$fdate}}&Todate={{$tdate}}&TerminateExhibit={{$terminateexhibit}}&Typeexhibit={{$typeexhibit}}"><i class="fa fa-file-excel-o text-green"></i>Excel </a></li>
                           </ul>
                         </div>
                        <button type="submit" class="btn btn-warning btn-app">
                          <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                        <p></p>
                        <label for="text" class="mr-sm-2">บอกเลิกสัญญา : </label>
                        <select name="TerminateExhibit" class="form-control mb-2 mr-sm-2" id="text" style="width: 185px">
                          <option selected value="">--- เลือกสถานะ ---</option>
                          <option value="เร่งรัด" {{ ($terminateexhibit == 'เร่งรัด') ? 'selected' : '' }}>เร่งรัด</otion>
                          <option value="ทนาย" {{ ($terminateexhibit == 'ทนาย') ? 'selected' : '' }}>ทนาย</otion>
                        </select>
                        &nbsp;&nbsp;&nbsp;
                        <label for="text" class="mr-sm-2">ประเภท : </label>
                        <select name="Typeexhibit" class="form-control mb-2 mr-sm-2" id="text" style="width: 185px">
                          <option selected value="">---เลือกประเภท---</option>
                          <option value="ของกลาง" {{ ($typeexhibit == 'ของกลาง') ? 'selected' : '' }}>ของกลาง</otion>
                          <option value="ยึดตามมาตราการ(ปปส.)" {{ ($typeexhibit == 'ยึดตามมาตราการ(ปปส.)') ? 'selected' : '' }}>ยึดตามมาตราการ(ปปส.)</otion>
                        </select>
                        <div class="form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" style="width: 185px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" style="width: 185px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                        </div>
                      </div>
                    </form>
                  <hr>
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
                              <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                            </a>
                            <div class="form-inline form-group">
                              <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->Legisexhibit_id ,3]) }}">
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

            <!-- Pop up ปริ้นใบเสร็จ -->
            <div class="modal fade" id="modal-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pop up รายงานบันทึกชำะค่างวด -->
            <div class="modal fade" id="modal-2">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pop up รายงานลูกหนี้ประนอม -->
            <div class="modal fade" id="modal-3">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pop up รายงานลูกฟ้อง -->
            <div class="modal fade" id="modal-4">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ข้อมูลรายละเอียด</h4>
                  </div>
                </div>
              </div>
            </div>

          </div>

        <script type="text/javascript">
            $(document).ready(function() {
              $('#table,#table1').DataTable( {
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

        <script type="text/javascript">
          $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
          $(".alert").alert('close');
          });
        </script>

      </div>
    </section>

@endsection
