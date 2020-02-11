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

    <!-- <section class="content-header">
      <h1>
        กฏหมาย
        <small>it all starts here</small>
      </h1>
    </section> -->

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
            <h4 class="card-title" align="center"><b>ลูกหนี้ประนอมหนี้</b></h4>
          @elseif($type == 8)
            <h4 class="card-title" align="center"><b>ลูกหนี้สืบทรัพย์</b></h4>
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
              @if($type == 1)
                <div class="col-md-12">
                   <hr>
                   <div class="table-responsive">
                     <table class="table table-bordered" id="table">
                        <thead class="thead-dark bg-gray-light" >
                          <tr>
                            <th class="text-center" style="width: 10px">ลำดับ</th>
                            <th class="text-center">เลขที่สัญญา</th>
                            <th class="text-center">ชื่อ-สกุล</th>
                            <th class="text-center">บัตรประชาชน</th>
                            <th class="text-center">วันที่ทำสัญญา</th>
                            <th class="text-center">ยอดคงเหลือ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ค้างงวดจริง</th>
                            <th class="text-center" style="width: 100px">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($result as $key => $row)
                            <tr>
                              <td class="text-center"> {{$key+1}} </td>
                              <td class="text-center"> {{$row->CONTNO}}</td>
                              <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                              <td class="text-center"> {{str_replace(" ","",$row->IDNO)}} </td>
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
                                @endphp

                                @foreach($data as $key => $row1)
                                  @if($row->CONTNO == $row1->Contract_legis)
                                      @if($row1->Flag_status == 1)
                                      <button class="btn btn-warning btn-sm" title="ขั้นตอนจัดเตรียม">
                                        <span class="glyphicon glyphicon-time"></span> ขั้นตอนจัดเตรียม
                                      </button>
                                      @else
                                      <button class="btn btn-success btn-sm" title="ขั้นตอนการฟ้อง">
                                        <span class="glyphicon glyphicon-lock"></span> ขั้นตอนการฟ้อง
                                      </button>
                                      @endif
                                    @php
                                      $Tax = "Y";
                                    @endphp
                                  @endif
                                @endforeach

                                @if($Tax == "N")
                                  <a href="{{ route('legislation.Savestore', [$SetStr1,$SetStr2,$Realty,1]) }}" id="edit" class="btn btn-danger btn-sm" title="เตรียมเอกสาร">
                                    <span class="glyphicon glyphicon-edit"></span> เตรียมเอกสาร
                                  </a>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                   </div>
                </div>
              @elseif($type == 2)
                <div class="col-md-12">
                  <form method="get" action="{{ route('legislation', 2) }}">
                      <div align="right" class="form-inline">
                          <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', $type) }}" class="btn btn-primary btn-app">
                            <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          </a>
                        <button type="submit" class="btn btn-warning btn-app">
                          <span class="glyphicon glyphicon-search"></span> Search
                        </button>

                        <p></p>
                        <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="StateCourt" class="form-control mb-2 mr-sm-2" id="text" style="width: 150px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="ชั้นศาล" {{ ($SetSelect == 'ชั้นศาล') ? 'selected' : '' }}>ชั้นศาล</otion>
                          <option value="ชั้นบังคับคดี">ชั้นบังคับคดี</otion>
                        </select>
                        
                        <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="StateCourt" class="form-control mb-2 mr-sm-2" id="text" style="width: 150px">
                          <option selected value="">--- สถานะ ---</option>
                          <option value="ชั้นศาล" {{ ($SetSelect == 'ชั้นศาล') ? 'selected' : '' }}>ชั้นศาล</otion>
                          <option value="ชั้นบังคับคดี">ชั้นบังคับคดี</otion>
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
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">วันที่ส่งฟ้อง</th>
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
                            <td class="text-center"> {{$row->Name_legis}} </td>
                            <td class="text-center"> {{ DateThai($row->Datesend_Flag) }} </td>
                            <td class="text-center">
                              @if($row->Status_legis == "จ่ายจบก่อนฟ้อง" or $row->Status_legis == "ยึดรถก่อนฟ้อง" or $row->Status_legis == "ปิดบัญชีประนอมหนี้" or $row->Status_legis == "ยึดรถหลังฟ้อง" or $row->Status_legis == "หมดอายุความคดี")
                                @php
                                  $Cldate = date_create($row->Datesend_Flag);
                                  $nowCldate = date_create($row->DateUpState_legis);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="green">{{$duration}}</font>
                              @elseif($row->sendsequester_asset == "หมดอายุความ")
                                @php
                                  $Cldate = date_create($row->Datesend_Flag);
                                  $nowCldate = date_create($row->Dateresult_asset);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="green">{{$duration}}</font>
                              @else
                                @php
                                  $Cldate = date_create($row->Datesend_Flag);
                                  $nowCldate = date_create($date);
                                  $ClDateDiff = date_diff($Cldate,$nowCldate);
                                  $duration = $ClDateDiff->format("%a วัน")
                                @endphp
                                <font color="red">{{$duration}}</font>
                              @endif
                            </td>
                            <td class="text-center">
                              @if($row->Status_legis == "จ่ายจบก่อนฟ้อง")
                                <button type="button" class="btn btn-success btn-sm" title="จ่ายจบก่อนฟ้อง">
                                  <i class="fa fa-check prem"></i> จ่ายจบก่อนฟ้อง
                                </button>
                              @elseif($row->Status_legis == "ยึดรถก่อนฟ้อง")
                                <button type="button" class="btn btn-success btn-sm" title="ยึดรถก่อนฟ้อง">
                                  <i class="fa fa-check prem"></i> ยึดรถก่อนฟ้อง
                                </button>
                              @elseif($row->Status_legis == "ปิดบัญชีประนอมหนี้")
                                <button type="button" class="btn btn-success btn-sm" title="ปิดบัญชีประนอมหนี้">
                                  <i class="fa fa-check prem"></i> ปิดบัญชีประนอมหนี้
                                </button>
                              @elseif($row->Status_legis == "ยึดรถหลังฟ้อง")
                                <button type="button" class="btn btn-success btn-sm" title="ยึดรถหลังฟ้อง">
                                  <i class="fa fa-check prem"></i> ยึดรถหลังฟ้อง
                                </button>
                              @elseif($row->Status_legis == "หมดอายุความคดี")
                                <button type="button" class="btn btn-primary btn-sm" title="ยึดรถหลังฟ้อง">
                                  <i class="fa fa-gavel prem"></i> หมดอายุความคดี
                                </button>
                              @else
                                <!-- ชั้นศาล -->

                                @php
                                  $SetText = 'รอฟ้อง';
                                  $Newdate = date_create($date);
                                @endphp

                                @if($row->examiday_court != Null)
                                  @php
                                    $Tab1 = date_create($row->examiday_court);
                                    $DateEx = date_diff($Newdate,$Tab1);
                                  @endphp
                                  @if($row->fuzzy_court != Null)
                                    @php
                                      $Tab1 = date_create($row->fuzzy_court);
                                      $DateEx = date_diff($Newdate,$Tab1);
                                    @endphp
                                  @endif

                                  @if($row->ordersend_court != Null)
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

                                  @if($row->checkday_court != Null)
                                    @php
                                      $Tab3 = date_create($row->checkday_court);
                                      $DateEx3 = date_diff($Newdate,$Tab3);
                                    @endphp
                                  @endif

                                  @if($row->sendoffice_court != Null)
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

                                  @if($row->sendcheckresults_court != Null)
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
                                    @if($DateEx4->days <= 7)
                                      <button type="button" class="btn btn-danger btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                        <span class="fa fa-bello text-white prem"> ตั้งเจ้าพนักงาน {{ $DateEx4->days }} วัน</span>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-sm" title="วันตั้งเจ้าพนักงาน {{ DateThai($Tab4->format('Y-m-d')) }}">
                                        <i class="fa fa-clock-o prem"></i> รอตั้งเจ้าพนักงาน
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
                                  @endif
                                @else
                                  @if($row->fillingdate_court == Null)
                                    <button type="button" class="btn btn-danger btn-sm" title="รอฟ้อง">
                                      <i class="fa fa-warning"></i> รอฟ้อง
                                    </button>
                                  @elseif($row->fillingdate_court != Null)
                                  <button type="button" class="btn btn-warning btn-sm" title="สถานะฟ้อง">
                                    <i class="fa fa-clock-o"></i> ฟ้อง
                                  </button>
                                  @endif
                                @endif
                              @endif
                            </td>
                            <td class="text-center">
                              @if($row->propertied_asset == "Y")
                                  <button type="button" class="btn btn-success btn-sm" title="มีทรัพย์">
                                    <i class="fa fa-check-square-o prem"></i> มีทรัพย์
                                  </button>
                              @elseif($row->propertied_asset == "N")
                                  @if($row->sendsequester_asset == "เจอ")
                                    <button type="button" class="btn btn-success btn-sm" title="สืบทรัพย์เจอ">
                                      <i class="fa fa-check-square-o prem"></i> สืบทรัพย์เจอ
                                    </button>
                                  @elseif($row->sendsequester_asset == "ไม่เจอ")
                                    @php
                                      $Getdate = date_create($row->NewpursueDate_asset);
                                      $Newdate = date_create($date);
                                      $DateEx = date_diff($Newdate,$Getdate);
                                    @endphp

                                    @if($Newdate <= $Getdate)
                                      @if($DateEx->d <= 7)
                                        <button type="button" class="btn btn-danger btn-sm" title="วันสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                          <span class="fa fa-bell text-white prem"> สืบทรัพย์ใหม่ {{ $DateEx->d }} วัน</span>
                                        </button>
                                      @else
                                        <button type="button" class="btn btn-warning btn-sm" title="รอสืบทรัพย์ {{DateThai($row->NewpursueDate_asset)}}">
                                          <i class="fa fa-clock-o prem"></i> รอสืบทรัพย์
                                        </button>
                                      @endif
                                    @endif
                                  @elseif($row->sendsequester_asset == "หมดอายุความ")
                                    <button type="button" class="btn btn-primary btn-sm" title="หมดอายุความ {{DateThai($row->NewpursueDate_asset)}}">
                                      <i class="fa fa-gavel prem"></i> หมดอายุความ
                                    </button>
                                  @else
                                    <button type="button" class="btn btn-danger btn-sm" title="ไม่มีทรัพย์">
                                      <i class="fa fa-times prem"></i> ไม่มีทรัพย์
                                    </button>
                                  @endif
                              @else
                                <button type="button" class="btn btn-gray btn-sm" title="ไม่มีข้อมูล">
                                  <i class="fa fa-question-circle prem"></i> ไม่มีข้อมูล
                                </button>
                              @endif
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
                                @if($row->KeyCompro_id != Null)
                                  @foreach($ResultPay as $key => $value)
                                    @if($row->legisPromise_id == $value->legis_Com_Payment_id)
                                       @if($value->Date_Payment < $lastday)
                                         <button type="button" class="btn btn-danger btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
                                           <span class="glyphicon glyphicon-thumbs-down prem"></span> ขาดชำระ
                                         </button>
                                       @else
                                         <button type="button" class="btn btn-success btn-sm" title="วันชำระล่าสุด {{DateThai($value->Date_Payment)}}">
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

                          <!-- Popup -->
                          <!-- <div class="modal fade" id="modal_default" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >×</span></button>
                                  <h4 class="modal-title" align="center">Default Modal</h4>
                                </div>
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs bg-success">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">รายละเอียด</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ตารางผ่อนชำระ</a></li>
                                  </ul>
                                  <div class="modal-body">
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="tab_1">

                                        <form name="form1" id="sample_tab1" enctype="multipart/form-data">
                                          @csrf
                                          <div class="tab-content">
                                            <div class="form-inline" align="right">
                                              <div class="row">
                                                 <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>เลขที่สัญญา : </label>
                                                           <input type="text" name="ContractPromise" class="form-control" value="{{ $row->Contract_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ชื่อ - นามสกุล :</label>
                                                           <input type="text" name="NamePromise" class="form-control" value="{{ $row->Name_legis }}" style="width: 200px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                          <label>ป้ายทะเบียน : </label>
                                                          <input type="text" name="RigisPromise" class="form-control" value="{{ $row->register_legis }}" style="width: 150px;" readonly/>
                                                        </div>
                                                     </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ยี่ห้อ :</label>
                                                           <input type="text" name="BrandPromise" class="form-control" value="{{ $row->BrandCar_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                        <label>ปีรถ :</label>
                                                        <input type="text" name="YearcarPromise" class="form-control" value="{{ $row->YearCar_legis }}" style="width: 150px;" readonly/>
                                                      </div>
                                                    </div>
                                                   </div>
                                                 </div>
                                              </div>
                                            </div>
                                            <script>
                                                function addCommas(nStr){
                                                   nStr += '';
                                                   x = nStr.split('.');
                                                   x1 = x[0];
                                                   x2 = x.length > 1 ? '.' + x[1] : '';
                                                   var rgx = /(\d+)(\d{3})/;
                                                   while (rgx.test(x1)) {
                                                     x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                                    }
                                                  return x1 + x2;
                                                }
                                                function Comma(){
                                                  var num11 = document.getElementById('TotalPromise').value;
                                                  var num1 = num11.replace(",","");
                                                  var num22 = document.getElementById('PayallPromise').value;
                                                  var num2 = num22.replace(",","");
                                                  var num33 = document.getElementById('Pay1Promise').value;
                                                  var num3 = num33.replace(",","");
                                                  var num44 = document.getElementById('Pay2Promise').value;
                                                  var num4 = num44.replace(",","");
                                                  var num55 = document.getElementById('Pay3Promise').value;
                                                  var num5 = num55.replace(",","");
                                                  var num66 = document.getElementById('SumPromise').value;
                                                  var num6 = num66.replace(",","");
                                                  var num77 = document.getElementById('DuePayPromise').value;
                                                  var num7 = num77.replace(",","");
                                                  var num88 = document.getElementById('SumAllPromise').value;
                                                  var num8 = num88.replace(",","");
                                                  document.form1.TotalPromise.value = addCommas(num1);
                                                  document.form1.PayallPromise.value = addCommas(num2);
                                                  document.form1.Pay1Promise.value = addCommas(num3);
                                                  document.form1.Pay2Promise.value = addCommas(num4);
                                                  document.form1.Pay3Promise.value = addCommas(num5);
                                                  document.form1.SumPromise.value = addCommas(num6);
                                                  document.form1.DuePayPromise.value = addCommas(num7);
                                                  document.form1.SumAllPromise.value = addCommas(num8);
                                                }
                                            </script>

                                            <hr>
                                            <h4 class="card-title p-3" align="left"><b>รายละเอียดประนอมหนี้</b></h4>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดประนอมหนี้ : </label>
                                                       @if($row->Total_Promise == Null)
                                                          <input type="text" name="TotalPromise" id="TotalPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @else
                                                          <input type="text" name="TotalPromise" id="TotalPromise" value="{{ $row->Total_Promise }}" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @endif
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ประเภทประนอมหนี้ :</label>
                                                         <select name="TypePromise" class="form-control" style="width: 150px;">
                                                           <option value="" selected>--- เลือกประนอม ---</option>
                                                           <option value="ประนอมที่ศาล">ประนอมที่ศาล</option>
                                                           <option value="ประนอมที่บริษัท">ประนอมที่บริษัท</option>
                                                           <option value="หลังยึดทรัพย์">หลังยึดทรัพย์</option>
                                                         </select>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดที่ต้องชำระ :</label>
                                                       <input type="text" name="PayallPromise" id="PayallPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>1 :</label>
                                                       <input type="text" name="Pay1Promise" id="Pay1Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>2 :</label>
                                                       <input type="text" name="Pay2Promise" id="Pay2Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>3 :</label>
                                                       <input type="text" name="Pay3Promise" id="Pay3Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือ : </label>
                                                       <input type="text" name="SumPromise" id="SumPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>จำนวนงวด :</label>
                                                       <input type="text" name="DuePromise" class="form-control" style="width: 150px;"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                      <label>งวดละ :</label>
                                                      <input type="text" name="DuePayPromise" id="DuePayPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>วันที่วันที่ชำระล่าสุด : </label>
                                                       <input type="date" name="DatelastPromise" class="form-control" style="width: 150px;"/>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือล่าสุด : </label>
                                                       <input type="text" name="SumAllPromise" id="SumAllPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                    </div>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-inline" align="right">
                                              <input type="hidden" name="Getid" class="form-control" value="{{ $row->id }}" style="width: 150px;" readonly/>
                                              <button class="btn btn-success btn-submit">Submit</button>
                                          </div>
                                        </form>
                                      </div>

                                      <div class="tab-pane" id="tab_2">

                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div> -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @elseif($type == 6)
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">วันที่ทำสัญญา</th>
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
                            <td class="text-center"> {{ DateThai($row->DateDue_legis) }} </td>
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
              @elseif($type == 7)
                <div class="col-md-12">
                  <form method="get" >

                     <div class="form-inline" align=right>

                       <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', $type) }}" class="btn btn-primary btn-app">
                         <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                       </a>
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
                        <input type="date" name="Fromdate" value="{{$newfdate}}" style="width: 180px;" value="" class="form-control" />

                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" value="{{$newtdate}}" style="width: 180px;" value="" class="form-control" />
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
                          <th class="text-center">วันเริ่มประนอม</th>
                          <th class="text-center">ระยะเวลา</th>
                          <th class="text-center">ยอดประนอมหนี้</th>
                          <th class="text-center">ยอดคงเหลือ</th>
                          <th class="text-center" style="width: 100px">สถานะ</th>
                          <th class="text-center" style="width: 150px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
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
                              @php
                                $lastday = date('Y-m-d', strtotime("-90 days"));
                              @endphp

                              @if($row->Status_legis == "ปิดบัญชีประนอมหนี้" or $row->Status_legis == "ยึดรถหลังฟ้อง")
                                <button type="button" class="btn btn-success btn-sm" title="ปิดบัญชี">
                                  <span class="glyphicon glyphicon-ok prem"></span> ปิดบัญชี
                                </button>
                              @else
                                @foreach($ResultPay as $key => $value)
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
              @elseif($type == 8)
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
                            <td class="text-center">
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
                            <td class="text-center">
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
                            <td class="text-center">
                               @if($row->sequester_asset != Null)
                                 @php
                                   $Getdate = date_create($row->sequester_asset);
                                   $Newdate = date_create($date);
                                   $DateEx = date_diff($Newdate,$Getdate);
                                 @endphp

                                 @if($row->NewpursueDate_asset != Null)
                                   @php
                                     $Getdate = date_create($row->NewpursueDate_asset);
                                     $DateEx = date_diff($Newdate,$Getdate);
                                   @endphp
                                   @if($row->sendsequester_asset == "ไม่เจอ")
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
                                     @endif
                                   @elseif($row->sendsequester_asset == "เจอ")
                                     <button type="button" class="btn btn-success btn-sm" title="สืบทรัพย์เจอ">
                                       <i class="fa fa-check-square-o prem"></i> สืบทรัพย์เจอ
                                     </button>
                                   @elseif($row->sendsequester_asset == "หมดอายุความ")
                                     <button type="button" class="btn btn-primary btn-sm" title="หมดอายุความ">
                                       <i class="fa fa-gavel prem"></i> หมดอายุความ
                                     </button>
                                   @endif
                                 @else
                                    @if($row->propertied_asset == "Y")
                                     <button type="button" class="btn btn-success btn-sm" title="มีทรัพย์">
                                       <i class="fa fa-check-square-o prem"></i> มีทรัพย์
                                     </button>
                                    @elseif($row->propertied_asset == "N")
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

                          {{--
                          <!-- Popup -->
                          <!-- <div class="modal fade" id="modal_default" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >×</span></button>
                                  <h4 class="modal-title" align="center">Default Modal</h4>
                                </div>
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs bg-success">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">รายละเอียด</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ตารางผ่อนชำระ</a></li>
                                  </ul>
                                  <div class="modal-body">
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="tab_1">

                                        <form name="form1" id="sample_tab1" enctype="multipart/form-data">
                                          @csrf
                                          <div class="tab-content">
                                            <div class="form-inline" align="right">
                                              <div class="row">
                                                 <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>เลขที่สัญญา : </label>
                                                           <input type="text" name="ContractPromise" class="form-control" value="{{ $row->Contract_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ชื่อ - นามสกุล :</label>
                                                           <input type="text" name="NamePromise" class="form-control" value="{{ $row->Name_legis }}" style="width: 200px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                          <label>ป้ายทะเบียน : </label>
                                                          <input type="text" name="RigisPromise" class="form-control" value="{{ $row->register_legis }}" style="width: 150px;" readonly/>
                                                        </div>
                                                     </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ยี่ห้อ :</label>
                                                           <input type="text" name="BrandPromise" class="form-control" value="{{ $row->BrandCar_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                        <label>ปีรถ :</label>
                                                        <input type="text" name="YearcarPromise" class="form-control" value="{{ $row->YearCar_legis }}" style="width: 150px;" readonly/>
                                                      </div>
                                                    </div>
                                                   </div>
                                                 </div>
                                              </div>
                                            </div>
                                            <script>
                                                function addCommas(nStr){
                                                   nStr += '';
                                                   x = nStr.split('.');
                                                   x1 = x[0];
                                                   x2 = x.length > 1 ? '.' + x[1] : '';
                                                   var rgx = /(\d+)(\d{3})/;
                                                   while (rgx.test(x1)) {
                                                     x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                                    }
                                                  return x1 + x2;
                                                }
                                                function Comma(){
                                                  var num11 = document.getElementById('TotalPromise').value;
                                                  var num1 = num11.replace(",","");
                                                  var num22 = document.getElementById('PayallPromise').value;
                                                  var num2 = num22.replace(",","");
                                                  var num33 = document.getElementById('Pay1Promise').value;
                                                  var num3 = num33.replace(",","");
                                                  var num44 = document.getElementById('Pay2Promise').value;
                                                  var num4 = num44.replace(",","");
                                                  var num55 = document.getElementById('Pay3Promise').value;
                                                  var num5 = num55.replace(",","");
                                                  var num66 = document.getElementById('SumPromise').value;
                                                  var num6 = num66.replace(",","");
                                                  var num77 = document.getElementById('DuePayPromise').value;
                                                  var num7 = num77.replace(",","");
                                                  var num88 = document.getElementById('SumAllPromise').value;
                                                  var num8 = num88.replace(",","");
                                                  document.form1.TotalPromise.value = addCommas(num1);
                                                  document.form1.PayallPromise.value = addCommas(num2);
                                                  document.form1.Pay1Promise.value = addCommas(num3);
                                                  document.form1.Pay2Promise.value = addCommas(num4);
                                                  document.form1.Pay3Promise.value = addCommas(num5);
                                                  document.form1.SumPromise.value = addCommas(num6);
                                                  document.form1.DuePayPromise.value = addCommas(num7);
                                                  document.form1.SumAllPromise.value = addCommas(num8);
                                                }
                                            </script>

                                            <hr>
                                            <h4 class="card-title p-3" align="left"><b>รายละเอียดประนอมหนี้</b></h4>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดประนอมหนี้ : </label>
                                                       @if($row->Total_Promise == Null)
                                                          <input type="text" name="TotalPromise" id="TotalPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @else
                                                          <input type="text" name="TotalPromise" id="TotalPromise" value="{{ $row->Total_Promise }}" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @endif
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ประเภทประนอมหนี้ :</label>
                                                         <select name="TypePromise" class="form-control" style="width: 150px;">
                                                           <option value="" selected>--- เลือกประนอม ---</option>
                                                           <option value="ประนอมที่ศาล">ประนอมที่ศาล</option>
                                                           <option value="ประนอมที่บริษัท">ประนอมที่บริษัท</option>
                                                           <option value="หลังยึดทรัพย์">หลังยึดทรัพย์</option>
                                                         </select>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดที่ต้องชำระ :</label>
                                                       <input type="text" name="PayallPromise" id="PayallPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>1 :</label>
                                                       <input type="text" name="Pay1Promise" id="Pay1Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>2 :</label>
                                                       <input type="text" name="Pay2Promise" id="Pay2Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>3 :</label>
                                                       <input type="text" name="Pay3Promise" id="Pay3Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือ : </label>
                                                       <input type="text" name="SumPromise" id="SumPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>จำนวนงวด :</label>
                                                       <input type="text" name="DuePromise" class="form-control" style="width: 150px;"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                      <label>งวดละ :</label>
                                                      <input type="text" name="DuePayPromise" id="DuePayPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>วันที่วันที่ชำระล่าสุด : </label>
                                                       <input type="date" name="DatelastPromise" class="form-control" style="width: 150px;"/>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือล่าสุด : </label>
                                                       <input type="text" name="SumAllPromise" id="SumAllPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                    </div>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-inline" align="right">
                                              <input type="hidden" name="Getid" class="form-control" value="{{ $row->id }}" style="width: 150px;" readonly/>
                                              <button class="btn btn-success btn-submit">Submit</button>
                                          </div>
                                        </form>
                                      </div>

                                      <div class="tab-pane" id="tab_2">

                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div> -->
                          --}}

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @endif
           </div>

           <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">ข้อมูลรายละเอียด...</h4>
                </div>
                <div class="modal-body">
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Popup -->
          <!-- <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".btn-submit").click(function(e){
                e.preventDefault();
                // var name = $("input[name=name]").val();
                // var password = $("input[name=password]").val();
                // var Getid = $("input[Getid=Getid]").val();

                $.ajax({
                   type:'POST',
                   url:"{{ route('legislation.update',[00, 4]) }}",
                   data: $("form#sample_tab1").serialize(),
                   // data:{name:name, password:password, email:email},
                   success:function(data){
                      $('#TotalPromise').val(data.Total_Promise);
                      $('#PayallPromise').val(data.Payall_Promise);
                      console.log(data.success);
                   }
                });
      	     });
          </script> -->

          @if($type == 1 or $type == 6 or $type == 7 or $type == 8)
            <script type="text/javascript">
               $(document).ready(function() {
                 $('#table').DataTable( {
                   "order": [[ 0, "asc" ]]
                 });
               });
            </script>
          @elseif($type == 2)
            <script type="text/javascript">
            $(document).ready(function() {
              $('#table').DataTable( {
                "order": [[ 0, "asc" ]]
              });
            });
            </script>
          @endif

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>
        </div>

        <script>
          function blinker() {
          $('.prem').fadeOut(1500);
          $('.prem').fadeIn(1500);
          }
          setInterval(blinker, 1500);
        </script>

      </div>
    </section>

@endsection
