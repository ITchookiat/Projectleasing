@extends('layouts.master')
@section('title','แผนกกฏหมาย')
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

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))     
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-3 col-12">
            <h4>
              @if($type == 5)
                ระบบสต็อกรถเร่งรัด
              @endif
            </h4>
          </div>
          <div class="col-sm-9 col-12">
              <form method="get" action="{{ route('Precipitate', 5) }}">
                <div class="float-right form-inline">
                    <!-- <button type="submit" title="ค้นหา" class="btn bg-warning">
                      <span class="fas fa-search"></span>
                    </button> -->
                    <button type="button" title="ค้นหา" class="btn bg-warning" data-toggle="modal" data-target="#modal-search">
                      <span class="fas fa-search"></span>
                    </button>
                    &nbsp;
                    <button type="button" title="ปริ้นรายงาน" class="btn bg-primary" data-toggle="modal" data-target="#modal-report">
                      <span class="fas fa-print"></span>
                    </button>
                </div>
                <!-- <div class="float-right form-inline">
                  <label class="mr-sm-2">จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />&nbsp;

                  <label class="mr-sm-2">ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />&nbsp;
                </div> -->
              </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-2 col-12">

        <!-- <a href="{{ route('Precipitate', 6) }}" data-target="#modal-AddStock" class="btn btn-success btn-block mb-3"><i class="fas fa-plus-circle fa-xs"></i> เพิ่มข้อมูล</a> -->
        <a data-toggle="modal" data-target="#modal-AddStock" class="btn btn-success btn-block mb-3"><i class="fas fa-plus-circle fa-xs"></i> เพิ่มข้อมูล</a>

        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-center">ยอดรวม <b><font color="red">{{$CountStock}} คัน</font></b> </h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                  <i class="fas fa-car"></i> รถยึด
                  @if($Count1 != null)
                    <span class="badge bg-primary float-right">{{$Count1}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-03-tab" data-toggle="pill" href="#vert-tabs-03" role="tab" aria-controls="vert-tabs-03" aria-selected="false">
                  <i class="fas fa-car"></i> รถยึด (Ploan)
                  @if($Count3 != null)
                    <span class="badge bg-primary float-right">{{$Count3}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-04-tab" data-toggle="pill" href="#vert-tabs-04" role="tab" aria-controls="vert-tabs-04" aria-selected="false">
                  <i class="fas fa-car"></i> ลูกค้ารับรถคืน
                  @if($Count2 != null)
                    <span class="badge bg-primary float-right">{{$Count2}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-05-tab" data-toggle="pill" href="#vert-tabs-05" role="tab" aria-controls="vert-tabs-05" aria-selected="false">
                  <i class="fas fa-car"></i> รถของกลาง
                  @if($Count4 != null)
                    <span class="badge bg-primary float-right">{{$Count4}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-06-tab" data-toggle="pill" href="#vert-tabs-06" role="tab" aria-controls="vert-tabs-06" aria-selected="false">
                  <i class="fas fa-car"></i> ส่งรถบ้าน
                  @if($Count5 != null)
                    <span class="badge bg-primary float-right">{{$Count5}}</span>
                  @endif
                </a>
                <div id="showDetail" style="display:none;">
                  <!-- <a class="nav-link text-xs" id="vert-tabs-06-tab" data-toggle="pill">
                    <i class="fas fa-minus"></i> อยู่สต๊อกรถบ้าน
                      <span class="badge bg-success float-right">{{$Count51 + $Count53}}</span>
                  </a>
                  <a class="nav-link text-xs" id="vert-tabs-06-tab" data-toggle="pill">
                    <i class="fas fa-minus"></i> รถบ้านขายได้
                      <span class="badge bg-danger float-right">{{$Count52}}</span>
                  </a> -->
                  <!-- <a class="nav-link text-xs" id="vert-tabs-06-tab" data-toggle="pill">
                    <i class="fas fa-minus"></i> อื่นๆ
                      <span class="badge bg-danger float-right">{{$Count53}}</span>
                  </a> -->
                </div>
                <a class="nav-link" id="vert-tabs-07-tab" data-toggle="pill" href="#vert-tabs-07" role="tab" aria-controls="vert-tabs-07" aria-selected="false">
                  <i class="fas fa-car"></i> ลูกค้าส่งรถคืน
                  @if($Count6 != null)
                    <span class="badge bg-primary float-right">{{$Count6}}</span>
                  @endif
                </a>
              
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-10 col-12">
        {{--<div class="card">
          <div class="card-body text-sm">
              <form method="get" action="{{ route('Analysis',1) }}">
                <div class="float-right form-inline">
                    <button type="submit" class="btn bg-warning btn-app">
                      <span class="fas fa-search"></span> Search
                    </button>
                    <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                      <span class="fas fa-print"></span> ปริ้นรายงาน
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a target="_blank" class="dropdown-item" href="{{ action('ReportAnalysController@ReportDueDate', 1) }}?Flag={{1}}"> รายงานขออนุมัติประจำวัน</a></li>
                      <li class="dropdown-divider"></li>
                      <li><a class="dropdown-item" data-toggle="modal" data-target="#modal-leasing"> รายงาน สินเชื่อเช่าซื้อ</a></li>
                    </ul>
                </div>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">เลขที่สัญญา : </label>
                  <input type="text" name="Contno" value="" maxlength="12" class="form-control"/>&nbsp;
                  <label for="text" class="mr-sm-2">สถานะ : </label>
                  <select name="Statuscar" class="form-control" id="text">
                    <option selected value="">----- เลือกสถานะ ----</option>
                    <option value="1" {{ ($Statuscar == '1') ? 'selected' : '' }}> รถยึด</otion>
                    <option value="3" {{ ($Statuscar == '3') ? 'selected' : '' }}> รถยึด (Ploan)</otion>
                    <option value="2" {{ ($Statuscar == '2') ? 'selected' : '' }}> ลูกค้ามารับรถคืน</otion>
                    <option value="4" {{ ($Statuscar == '4') ? 'selected' : '' }}> รับรถจากของกลาง</otion>
                    <option value="5" {{ ($Statuscar == '5') ? 'selected' : '' }}> ส่งรถบ้าน</otion>
                    <option value="6" {{ ($Statuscar == '6') ? 'selected' : '' }}> ลูกค้าส่งรถคืน</otion>
                    <!-- <option value="7" {{ ($Statuscar == '7') ? 'selected' : '' }}> รถยึดที่ถือครอง</otion> -->
                  </select>
                </div><br><br>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />&nbsp;

                  <label class="mr-sm-2">ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
              </form>
          </div>
        </div>--}}

        <div class="card card-primary card-outline">
          <div class="card-body p-1 text-sm">
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ รถยึด</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 1)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> {{ $row->Contno_hold }} </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-03" role="tabpanel" aria-labelledby="vert-tabs-03-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ รถยึด (Ploan)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 3)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> {{ $row->Contno_hold }} </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-04" role="tabpanel" aria-labelledby="vert-tabs-04-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ ลูกค้ารับรถคืน</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 2)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> {{ $row->Contno_hold }} </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-05" role="tabpanel" aria-labelledby="vert-tabs-05-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ รถของกลาง</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 4)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> {{ $row->Contno_hold }} </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-06" role="tabpanel" aria-labelledby="vert-tabs-06-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ รถส่งรถบ้าน</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 5)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> 
                                    {{ $row->Contno_hold }}
                                    @if($row->StatSold_Homecar != NULL)
                                    <i class="fas fa-info-circle fa-sm text-info prem" title="รถบ้านตัดขายแล้ว"></i>
                                    @endif 
                                    </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-07" role="tabpanel" aria-labelledby="vert-tabs-07-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการ ลูกค้าส่งรถคืน</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <!-- <th class="text-center">ลำดับ</th> -->
                              <th class="text-center" width="70px">วันที่ยึด</th>
                              <th class="text-center" width="70px">ระยะเวลา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center" width="70px">ทะเบียน</th>
                              <th class="text-center">ทีมยึด</th>
                              <th class="text-center">ค่ายึด</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                @if($row->Statuscar == 6)
                                  <tr>
                                    <!-- <td class="text-center"> {{ $key+1 }} </td> -->
                                    <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                                    <td class="text-center">
                                      @if($row->Statuscar == 1 or $row->Statuscar == 3 or $row->Statuscar == 7)
                                        @php
                                          $nowday = date('Y-m-d');
                                          $Cldate = date_create($row->Date_hold);
                                          $nowCldate = date_create($nowday);
                                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                                          $duration = $ClDateDiff->format("%a วัน")
                                        @endphp
                                        <font color="red">{{$duration}}</font>
                                      @else
                                        @if($row->Datesend_Stockhome != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Datesend_Stockhome);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="green" title="วันที่ส่งรถบ้าน {{DateThai($row->Datesend_Stockhome)}}">{{$duration}}</font>
                                        @elseif($row->Date_came != null)
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Date_came);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue" title="วันที่มารับคืน {{DateThai($row->Date_came)}}">{{$duration}}</font>
                                        @else
                                          @php
                                            $Cldate = date_create($row->Date_hold);
                                            $nowCldate = date_create($row->Dateupdate_hold);
                                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                                            $duration = $ClDateDiff->format("%a วัน")
                                          @endphp
                                          <font color="blue">{{$duration}}</font>
                                        @endif
                                      @endif
                                    </td>
                                    <td class="text-center"> {{ $row->Contno_hold }} </td>
                                    <td class="text-left"> {{ $row->Name_hold }} </td>
                                    <td class="text-center"> {{ $row->Number_Regist }} </td>
                                    <td class="text-center"> {{ $row->Team_hold }} </td>
                                    <td class="text-right">
                                      @if($row->Price_hold == Null)
                                        {{ $row->Price_hold }}
                                      @else
                                        {{ number_format($row->Price_hold, 2) }}
                                      @endif
                                    </td>
                                    <td class="text-center">
                                      <a href="{{ route('MasterPrecipitate.edit',[$row->Hold_id]) }}?type={{5}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                      <form method="post" class="delete_form" action="{{ route('MasterPrecipitate.destroy',[$row->Hold_id]) }}?type={{5}}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contno_hold }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endif
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
      </div>
    </div>

    <a id="button"></a>
  </section>

  {{-- popup report --}}
  <form target="_blank" action="{{ action('PrecController@excel')}}" method="get">
    @csrf
    <input type="hidden" name="type" value="5">
    <div class="modal fade show" id="modal-report" style="display: none;" aria-modal="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
              <h3 class="modal-title">Report Holdcar</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-sm">
              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">จากวันที่ :</label>
                    <div class="col-sm-7">
                      <input type="date" name="Fromdate" value="" class="form-control form-control-sm"/>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ถึงวันที่ :</label>
                    <div class="col-sm-7">
                      <input type="date" name="Todate" value="" class="form-control form-control-sm"/>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">สถานะ :</label>
                    <div class="col-sm-7">
                      <select name="Statuscar" class="form-control form-control-sm" id="text">
                        <option selected value="">----- เลือกสถานะ ----</option>
                        <option value="1"> รถยึด</otion>
                        <option value="3"> รถยึด (Ploan)</otion>
                        <option value="2"> ลูกค้ามารับรถคืน</otion>
                        <option value="4"> รับรถจากของกลาง</otion>
                        <option value="5"> ส่งรถบ้าน</otion>
                        <option value="6"> ลูกค้าส่งรถคืน</otion>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right text-danger">* รูปแบบ :</label>
                    <div class="col-sm-7">
                      <select name="Typereport" class="form-control form-control-sm" required>
                        <option selected value="">----- เลือกรูปแบบ ----</option>
                        <option value="pdf"> .PDF</otion>
                        <option value="excel" > .Excel</otion>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <div class="text-center">
              <button type="submit" class="btn btn-primary text-center"><i class="fas fa-print"></i> ปริ้น</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>  ยกเลิก</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  {{-- popup search --}}
  <form action="{{ route('Precipitate', 5) }}" method="get">
    @csrf
    <div class="modal fade show" id="modal-search" style="display: none;" aria-modal="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
              <h3 class="modal-title">Search Data</h3>
          </div>
          <div class="modal-body text-sm">
              <div class="row">
                <div class="col-12">

                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">เลขที่สัญญา :</label>
                    <div class="col-sm-7">
                      <input type="text" name="Contract" value="" class="form-control"/>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">จากวันที่ :</label>
                    <div class="col-sm-7">
                      <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control"/>
                    </div>
                  </div>

                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ถึงวันที่ :</label>
                    <div class="col-sm-7">
                      <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control"/>
                    </div>
                  </div>

                </div>
              </div>
            <hr>
            <div class="text-center">
              <button type="submit" class="btn btn-primary text-center"><i class="fas fa-search"></i> ค้นหา</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>  ยกเลิก</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  {{-- pop up add stock --}}
  <form name="form1" action="{{ route('MasterPrecipitate.create') }}" method="get" id="formimage" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="1"/>
    <div class="modal fade" id="modal-AddStock" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-center">
                      <b><font color="1e77fd">Add Stock</font></b>
                  </h4>
                </div>
                <div class="card-body text-sm" style="background-color:#E9E9E8;">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <div class="row">
                    <div class="col-12">
                      <div class="card-tools d-inline float-right">
                        <div class="input-group form-inline">
                          <select name="DB_type" class="form-control" required>
                            <option selected value="">---เลือกฐานข้อมูล---</option>
                            <option value="1">ฐานข้อมูล SMART</otion>
                            <option value="2">ฐานข้อมูล SMART PSL</otion>
                          </select>
                          <!-- <label class="pr-2">เลขที่สัญญา : </label> -->
                          <input type="type" name="Contno" maxlength="12" class="Contno2 form-control" required/>
                          <span class="input-group-append">
                            <button type="submit" class="btn btn-warning btn-sm button-id">
                              <i class="fas fa-search"></i>
                            </button>
                          </span>
                        </div>
                      </div>      
                    </div>   
                  </div>
                </div>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  </form>

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

  <script>
    $(function () {
      $("#table,#table1,#table3,#table4,#table5,#table6,#table7,#table08,#table09,#table12,#table33").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 0, "asc" ]],
        "pageLength": 5,
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
    $(document).ready(function () {
        $('.Recontract').click(function (evt) {
          var Contract_buyer = $(this).data("name");
          // var form = $(this).closest("form");
          var _this = $(this)
          
          evt.preventDefault();
          swal({
              title: `${Contract_buyer}`,
              icon: "warning",
              text: "ยืนยันเปลี่ยนแปลงสัญญานี้หรือไม่",
              buttons: true,
              dangerMode: true,
          }).then((isConfirm)=>{
              if (isConfirm) {
                  window.location.href = _this.attr('href')
              }
          });
        });
    });
  </script>

  <script type="text/javascript">

    $('#vert-tabs-01-tab').on("click" ,function() {
      $('#showDetail').hide();
    });
    $('#vert-tabs-03-tab').on("click" ,function() {
      $('#showDetail').hide();
    });
    $('#vert-tabs-04-tab').on("click" ,function() {
      $('#showDetail').hide();
    });
    $('#vert-tabs-05-tab').on("click" ,function() {
      $('#showDetail').hide();
    });
    $('#vert-tabs-06-tab').on("click" ,function() {
      $('#showDetail').show();
    });
    $('#vert-tabs-07-tab').on("click" ,function() {
      $('#showDetail').hide();
    });
  </script>
@endsection
