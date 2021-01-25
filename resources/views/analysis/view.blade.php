@extends('layouts.master')
@section('title','สินเชื่อ')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d', strtotime('-1 days'));
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date2 = $Y.'-'.$m.'-'.$d;
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
          <div class="col-sm-6">
            <h4>
              @if($type == 1)
                สินเชื่อ (Instalment contracts)
              @elseif($type == 4)
                สินเชื่อรถบ้าน
              @elseif($type == 12)
                มาตรการ COVID-19
              @endif
            </h4>
          </div>
          <div class="col-sm-6">
            @if($type == 1)
              @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์' or auth::user()->type == 'แผนก การเงินใน')
                <button class="btn btn-gray float-right">
                  ค่าคอม: <font color="red">{{ number_format($SumCommitprice) }}</font> บาท
                </button>
                <button class="btn btn-warning btn-xs float-right"></button>
                <button class="btn btn-gray float-right">
                  ยอดจัด: <font color="red">{{ number_format($SumTopcar) }}</font> บาท
                </button>
                <button class="btn btn-warning btn-xs float-right"></button>
                <button class="btn btn-gray float-right">
                    <i class="fa fa-calendar"></i>
                  @php
                    $dateStart = substr($newfdate, 8, 9);
                    $dateEnd = substr($newtdate, 8, 9);
                  @endphp
                    วันที่ {{ $dateStart }} ถึง {{ $dateEnd }}
                </button>
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        @if($type == 1)
          @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์')
            <a href="{{ route('Analysis', 2) }}" class="btn btn-success btn-block mb-3">Compose</a>
            <a href="{{ route('DataCustomer', 1) }}" class="btn btn-danger btn-block mb-3">New Walk-in</a>
          @else
            <a href="{{ route('DataCustomer', 1) }}" class="btn btn-danger btn-block mb-3">New Walk-in</a>
          @endif
        @elseif($type == 4)   <!-- รถบ้าน -->
          <a href="{{ route('Analysis', 5) }}" class="btn btn-success btn-block mb-3">Compose</a>
        @elseif($type == 12)  <!-- โควิด 19 -->
          <a href="{{ route('Analysis', 13) }}" class="btn btn-success btn-block mb-3">Compose</a>
        @endif

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List</h3>
            <div class="card-tools">
              <b><font color="red">ยอดรวม {{$SumAll}} คัน</font></b>
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
              @if($type == 1)
                <a class="nav-link active" id="vert-tabs-01-tab" data-toggle="pill" href="#vert-tabs-01" role="tab" aria-controls="vert-tabs-01" aria-selected="true">
                  <i class="fas fa-hdd"></i> สาขาปัตตานี (01)
                  @if($Count01 != 0)
                    <span class="badge bg-primary float-right">{{$Count01}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-03-tab" data-toggle="pill" href="#vert-tabs-03" role="tab" aria-controls="vert-tabs-03" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขายะลา (03)
                  @if($Count03 != 0)
                    <span class="badge bg-primary float-right">{{$Count03}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-04-tab" data-toggle="pill" href="#vert-tabs-04" role="tab" aria-controls="vert-tabs-04" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขานราธิวาส (04)
                  @if($Count04 != 0)
                    <span class="badge bg-primary float-right">{{$Count04}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-05-tab" data-toggle="pill" href="#vert-tabs-05" role="tab" aria-controls="vert-tabs-05" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขาสายบุรี (05)
                  @if($Count05 != 0)
                    <span class="badge bg-primary float-right">{{$Count05}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-06-tab" data-toggle="pill" href="#vert-tabs-06" role="tab" aria-controls="vert-tabs-06" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขาโกลก (06)
                  @if($Count06 != 0)
                    <span class="badge bg-primary float-right">{{$Count06}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-07-tab" data-toggle="pill" href="#vert-tabs-07" role="tab" aria-controls="vert-tabs-07" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขาเบตง (07)
                  @if($Count07 != 0)
                    <span class="badge bg-primary float-right">{{$Count07}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-08-tab" data-toggle="pill" href="#vert-tabs-08" role="tab" aria-controls="vert-tabs-08" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขาโคกโพธิ์ (08)
                  @if($Count08 != 0)
                    <span class="badge bg-primary float-right">{{$Count08}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-09-tab" data-toggle="pill" href="#vert-tabs-09" role="tab" aria-controls="vert-tabs-09" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขาตันหยงมัส (09)
                  @if($Count09 != 0)
                    <span class="badge bg-primary float-right">{{$Count09}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-12-tab" data-toggle="pill" href="#vert-tabs-12" role="tab" aria-controls="vert-tabs-12" aria-selected="false">
                  <i class="fas fa-hdd"></i> สาขารือเสาะ (12)
                  @if($Count12 != 0)
                    <span class="badge bg-primary float-right">{{$Count12}}</span>
                  @endif
                </a>
              @elseif($type == 4)
                <a class="nav-link active" id="vert-tabs-10-tab" data-toggle="pill" href="#vert-tabs-10" role="tab" aria-controls="vert-tabs-10" aria-selected="true">
                  <i class="fas fa-hdd"></i> รถบ้าน (10)
                  @if($Count10 != 0)
                    <span class="badge bg-primary float-right">{{$Count10}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-11-tab" data-toggle="pill" href="#vert-tabs-11" role="tab" aria-controls="vert-tabs-11" aria-selected="false">
                  <i class="fas fa-hdd"></i> รถยึดขายผ่อน (11)
                  @if($Count11 != 0)
                    <span class="badge bg-primary float-right">{{$Count11}}</span>
                  @endif
                </a>
              @elseif($type == 12)
                <a class="nav-link" id="vert-tabs-33-tab" data-toggle="pill" href="#vert-tabs-33" role="tab" aria-controls="vert-tabs-33" aria-selected="false">
                  <i class="fas fa-hdd"></i> พักชำระหนี้ (33)
                  @if($SumAll != 0)
                    <span class="badge bg-primary float-right">{{$SumAll}}</span>
                  @endif
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-body text-sm">
            @if($type == 1)
              <form method="get" action="{{ route('Analysis',1) }}">
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                    {{-- <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', $type) }}" class="btn bg-primary btn-app">
                      <span class="fas fa-print"></span> ปริ้นรายการ
                    </a> --}}
                    <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                      <span class="fas fa-print"></span> ปริ้นรายงาน
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a target="_blank" class="dropdown-item" href="{{ action('ReportAnalysController@ReportDueDate', 8) }}"> รายงานขอเบิกเงินประจำวัน</a></li>
                      <li class="dropdown-divider"></li>
                      <li><a target="_blank" class="dropdown-item" href="{{ action('ReportAnalysController@ReportDueDate', 1) }}"> รายงานขออนุมัติประจำวัน</a></li>
                    </ul>
                  @endif
                  
                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                </div>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">เลขที่สัญญา : </label>
                  <input type="type" name="Contno" value="{{$contno}}" maxlength="12" class="form-control form-control-sm"/>

                  <label for="text" class="mr-sm-2">สถานะ : </label>
                  <select name="status" class="form-control form-control-sm">
                    <option selected value="">---------สถานะ--------</option>
                    <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</option>
                    <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</option>
                  </select>
                </div>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                  <label class="mr-sm-2">ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                </div>
              </form>
            @elseif($type == 4)
              <form method="get" action="{{ route('Analysis',4) }}">
                <div class="float-right form-inline">
                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                </div>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">เลขที่สัญญา : </label>
                  <input type="type" name="Contno" value="{{$contno}}" maxlength="12" class="form-control form-control-sm"/>

                  <label for="text" class="mr-sm-1">สถานะ : </label>
                  <select name="status" class="form-control form-control-sm" id="text" >
                    <option selected disabled value="">--------สถานะ---------</option>
                    <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</option>
                    <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</option>
                  </select>
                </div>
                <br>
                <br>
                <div class="float-right form-inline">
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                </div>
              </form>
            @elseif($type == 12)
              <form method="get" action="{{ route('Analysis',12) }}">
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                    <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', 3) }}" class="btn bg-primary btn-app">
                      <span class="fas fa-print"></span> ปริ้นรายการ
                    </a>
                  @endif

                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                </div>
                <div class="float-right form-inline">
                  <label>เลขที่สัญญา : </label>
                  <input type="type" name="Contno" value="{{$contno}}" maxlength="12" class="form-control form-control-lg"/>

                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                  <label for="text" class="mr-sm-2">สถานะ : </label>
                  <select name="status" class="form-control" id="text">
                    <option selected value="">-------สถานะ-------</option>
                    <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                    <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                  </select>
                </div>
              </form>
            @endif
          </div>
        </div>

        <div class="card card-primary card-outline">
          <div class="card-body p-0 text-sm">
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="tab-content" id="vert-tabs-tabContent">
                  @if($type == 1)
                    <div class="tab-pane text-left fade active show" id="vert-tabs-01" role="tabpanel" aria-labelledby="vert-tabs-01-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาปัตตานี (01)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <!-- <th class="text-left">แบบ</th> -->
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ปัตตานี')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <!-- <td class="text-left"> {{ $row->status_car}} </td> -->
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
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
                        <h3 class="card-title">สาขายะลา (03)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table3">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <!-- <th class="text-left">แบบ</th> -->
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ยะลา')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <!-- <td class="text-left"> {{ $row->status_car}} </td> -->
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
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
                        <h3 class="card-title">สาขานราธิวาส (04)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table4">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'นราธิวาส')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
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
                        <h3 class="card-title">สาขาสายบุรี (05)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table5">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'สายบุรี')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
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
                        <h3 class="card-title">สาขาโกลก (06)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table6">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'โกลก')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
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
                        <h3 class="card-title">สาขาเบตง (07)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table7">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'เบตง')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-08" role="tabpanel" aria-labelledby="vert-tabs-08-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาโคกโพธิ์ (08)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table08">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'โคกโพธิ์')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>
                                    
                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-09" role="tabpanel" aria-labelledby="vert-tabs-09-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาตันหยงมัส (09)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table09">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ตันหยงมัส')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-12" role="tabpanel" aria-labelledby="vert-tabs-12-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขารือเสาะ (12)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table12">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">% ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'รือเสาะ')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branch_car}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 4)
                    <div class="tab-pane text-left fade active show" id="vert-tabs-10" role="tabpanel" aria-labelledby="vert-tabs-10-tab">
                      <div class="card-header">
                        <h3 class="card-title">รถบ้าน (10)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-center">ยีห้อ</th>
                              <th class="text-center">ทะเบียนเดิม</th>
                              <th class="text-center">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-right" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branchUS_HC == 'รถบ้าน')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branchUS_HC}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-center"> {{ $row->baab_HC}} </td>
                                  <td class="text-left"> {{ $row->brand_HC}} </td>
                                  <td class="text-center"> {{ $row->oldplate_HC}} </td>
                                  <td class="text-right"> {{ $row->year_HC}} </td>
                                  <td class="text-right">
                                    @if($row->price_HC != Null)
                                      {{ $row->topprice_HC }}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if ( $row->approvers_HC != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i> Active
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i> รออนุมัติ
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportHomecar',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์' or auth::user()->position == 'MANAGER')
                                      @if($status == "")
                                        @php $status = 'Null'; @endphp
                                      @endif
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @else
                                      @if($row->approvers_HC == Null)
                                        @if($status == "")
                                          @php $status = 'Null'; @endphp
                                        @endif
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์' or auth::user()->position == 'MANAGER')
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @else
                                      @if($row->approvers_HC == Null)
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-11" role="tabpanel" aria-labelledby="vert-tabs-11-tab">
                      <div class="card-header">
                        <h3 class="card-title">รถยืดขายผ่อน (11)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              {{-- <th class="text-center">สาขา</th> --}}
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-center">ยีห้อ</th>
                              <th class="text-center">ทะเบียนเดิม</th>
                              <th class="text-center">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-right" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branchUS_HC == 'รถยืดขายผ่อน')
                                <tr>
                                  {{-- <td class="text-center"> {{ $row->branchUS_HC}} </td> --}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-center"> {{ $row->baab_HC}} </td>
                                  <td class="text-left"> {{ $row->brand_HC}} </td>
                                  <td class="text-center"> {{ $row->oldplate_HC}} </td>
                                  <td class="text-right"> {{ $row->year_HC}} </td>
                                  <td class="text-right">
                                    @if($row->price_HC != Null)
                                      {{ $row->topprice_HC }}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    @if ( $row->approvers_HC != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i> Active
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i> รออนุมัติ
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportHomecar',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์' or auth::user()->position == 'MANAGER')
                                      @if($status == "")
                                        @php $status = 'Null'; @endphp
                                      @endif
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @else
                                      @if($row->approvers_HC == Null)
                                        @if($status == "")
                                          @php $status = 'Null'; @endphp
                                        @endif
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์' or auth::user()->position == 'MANAGER')
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @else
                                      @if($row->approvers_HC == Null)
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 12)
                    <div class="tab-pane fade active show" id="vert-tabs-33" role="tabpanel" aria-labelledby="vert-tabs-33-tab">
                      <div class="card-header">
                        <h3 class="card-title">มาตรการช่วยเหลือ (33)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table33">
                          <thead>
                            <tr>
                              {{--<th class="text-center">สาขา</th>--}}
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">แบบ</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                                <tr>
                                  {{--<td class="text-center"> {{ $row->branch_car}} </td>--}}
                                  <td class="text-left"> {{ $row->Contract_buyer}} </td>
                                  <td class="text-left"> {{ $row->status_car}} </td>
                                  <td class="text-left"> {{ $row->Brand_car}} </td>
                                  <td class="text-left"> {{ $row->License_car}} </td>
                                  <td class="text-left"> {{ $row->Year_car}} </td>
                                  <td class="text-right">
                                    @if($row->Top_car != Null)
                                      {{ number_format($row->Top_car)}}
                                    @else
                                      0
                                    @endif
                                  </td>
                                  <td class="text-center">
                                    <div class="float-right form-inline">
                                      @if ( $row->DocComplete_car != Null)
                                        <h5><span class="badge badge-danger">
                                          <i class="fas fa-clipboard-check"></i>
                                        </span></h5>&nbsp;
                                      @endif

                                      @if ( $row->tran_Price != 0)
                                        <h5><span class="badge badge-info">
                                            <i class="fas fa-spell-check"></i>
                                        </span></h5>
                                      @endif
                                    </div>
                                  </td>
                                  <td class="text-left">
                                    @if ( $row->Check_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-check prem"></i>
                                      </button>
                                    @endif

                                    @if ( $row->Approvers_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-tie prem"></i>
                                      </button>
                                    @endif

                                    @if ($row->ManagerApp_car != Null)
                                      <button type="button" class="btn btn-success btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @else
                                      <button type="button" class="btn btn-warning btn-xs">
                                        <i class="fas fa-user-lock prem"></i>
                                      </button>
                                    @endif
                                  </td>
                                  <td class="text-right">
                                    <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',[$row->id,$type]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_buyer }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                  @endif
                </div>
              </div>
            </div>     
          </div>
        </div>
      </div>
    </div>

    <a id="button"></a>
  </section>


  <form action="{{ route('MasterAnalysis.store') }}" method="post">
    <div class="modal fade" id="modal-lg" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">เพิ่มรายการ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ป้ายทะเบียน :</label>
                      <div class="col-sm-8">
                        <input type="text" name="RegCar" class="form-control" placeholder="ป้อนป้ายทะเบียน" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">เบอร์ลูกค้า :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Phone_buyer" class="form-control" placeholder="ป้อนเบอร์ลูกค้า"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">เบอร์นายหน้า :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Phone_agen" class="form-control" placeholder="ป้อนเบอร์นายหน้า"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" name="Note_buyer" rows="3" placeholder="ป้อนหมายเหตุ..."></textarea>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-primary text-center">บันทึก</button>
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
      $("#table1,#table3,#table4,#table5,#table6,#table7,#table08,#table09,#table12,#table33").DataTable({
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

<script>
    $(function () {
      $("#table").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 0, "asc" ]],
        "pageLength": 5,
      });
    });
  </script>

@endsection
