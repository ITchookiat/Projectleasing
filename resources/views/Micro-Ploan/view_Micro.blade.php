@extends('layouts.master')
@section('title','Micro')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date2 = $Y.'-'.$m.'-'.$d;
  $date = date('Y-m-d', strtotime('-1 days'));
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
            @if($type == 5)
              <h5><i class="fas fa-car pr-1"></i>สัญญาเงินกู้รถยนต์ (P06 Micro Agreement)</h5>
            @elseif($type == 4)
              <h5><i class="fas fa-user pr-1"></i> สัญญาเงินกู้พนักงาน (P07 Micro Agreement)</h5>
            @endif
          </div>
          <div class="col-sm-6">
            @if($type == 5 or $type == 4)
              @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก การเงินใน")
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
        @if(auth::user()->type == 'Admin' or auth::user()->type == 'แผนก วิเคราะห์')
          <div class="row">
            <div class="col-md-6">
              <button type="button" class="btn btn-success btn-block mb-3" data-toggle="modal" data-target="#modal-primary">Compose</button>
            </div>
            <div class="col-md-6">
              <a href="{{ route('DataCustomer', 1) }}" class="btn btn-danger btn-block mb-3">New Walk-in</a>
            </div>
          </div>
        @else
          <a href="{{ route('DataCustomer', 1) }}" class="btn btn-danger btn-block mb-3">New Walk-in</a>
        @endif

        @if($type == 5 or $type == 4)
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
                <a class="nav-link active" id="vert-tabs-50-tab" data-toggle="pill" href="#vert-tabs-50" role="tab" aria-controls="vert-tabs-50" aria-selected="true">
                  <i class="fas fa-hdd pr-1"></i> สาขาปัตตานี (50)
                  @if($Count50 != 0)
                    <span class="badge bg-primary float-right">{{$Count50}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-51-tab" data-toggle="pill" href="#vert-tabs-51" role="tab" aria-controls="vert-tabs-51" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขายะลา (51)
                  @if($Count51 != 0)
                    <span class="badge bg-primary float-right">{{$Count51}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-52-tab" data-toggle="pill" href="#vert-tabs-52" role="tab" aria-controls="vert-tabs-52" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขานราธิวาส (52)
                  @if($Count52 != 0)
                    <span class="badge bg-primary float-right">{{$Count52}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-53-tab" data-toggle="pill" href="#vert-tabs-53" role="tab" aria-controls="vert-tabs-53" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาสายบุรี (53)
                  @if($Count53 != 0)
                    <span class="badge bg-primary float-right">{{$Count53}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-54-tab" data-toggle="pill" href="#vert-tabs-54" role="tab" aria-controls="vert-tabs-54" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาโกลก (54)
                  @if($Count54 != 0)
                    <span class="badge bg-primary float-right">{{$Count54}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-55-tab" data-toggle="pill" href="#vert-tabs-55" role="tab" aria-controls="vert-tabs-55" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาเบตง (55)
                  @if($Count55 != 0)
                    <span class="badge bg-primary float-right">{{$Count55}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-56-tab" data-toggle="pill" href="#vert-tabs-56" role="tab" aria-controls="vert-tabs-56" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาโคกโพธิ์ (56)
                  @if($Count56 != 0)
                    <span class="badge bg-primary float-right">{{$Count56}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-57-tab" data-toggle="pill" href="#vert-tabs-57" role="tab" aria-controls="vert-tabs-57" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาตันหยงมัส (57)
                  @if($Count57 != 0)
                    <span class="badge bg-primary float-right">{{$Count57}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-58-tab" data-toggle="pill" href="#vert-tabs-58" role="tab" aria-controls="vert-tabs-58" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขารือเสาะ (58)
                  @if($Count58 != 0)
                    <span class="badge bg-primary float-right">{{$Count58}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-59-tab" data-toggle="pill" href="#vert-tabs-59" role="tab" aria-controls="vert-tabs-59" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขาบังนังสตา (59)
                  @if($Count59 != 0)
                    <span class="badge bg-primary float-right">{{$Count59}}</span>
                  @endif
                </a>
                <a class="nav-link" id="vert-tabs-60-tab" data-toggle="pill" href="#vert-tabs-60" role="tab" aria-controls="vert-tabs-60" aria-selected="false">
                  <i class="fas fa-hdd pr-1"></i> สาขายะหา (60)
                  @if($Count60 != 0)
                    <span class="badge bg-primary float-right">{{$Count60}}</span>
                  @endif
                </a>
              </div>
            </div>
          </div>
        @endif
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-body text-sm">
            @if($type == 5)
              <form method="get" action="{{ route('MasterMicroPloan.index') }}">
                <input type="hidden" name="type" value="5">
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                    <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                      <span class="fas fa-print"></span> ปริ้นรายงาน
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a target="_blank" class="dropdown-item" href="{{ action('MPController@ReportPDFIndex',[00]) }}?type={{2}}&Flagtype={{1}}&Flag={{3}}"> รายงาน ขออนุมัติประจำวัน (P06)</a></li>
                      <li class="dropdown-divider"></li>
                      <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-report"> รายงาน เงินกู้รถยนต์ (P06)</a></li>
                    </ul>
                  @endif
                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                </div>
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                    <label class="mr-sm-2">เลขที่สัญญา : </label>
                    <input type="type" name="Contno" value="{{$contno}}" maxlength="13" class="form-control form-control-sm"/>
                  @else
                    <label class="mr-sm-2">เลขที่สัญญา : </label>
                    <input type="type" name="Contno" value="{{$contno}}" maxlength="13" class="form-control form-control-sm"/>
                  @endif

                  <label for="text" class="mr-sm-2">สถานะ : </label>
                  <select name="status" class="form-control form-control-sm">
                    <option selected value="">---------สถานะ--------</option>
                    <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</option>
                    <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</option>
                  </select>
                </div>
                <br><br>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                  <label class="mr-sm-2">ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                </div>
              </form>
            @elseif($type == 4)
              <form method="get" action="{{ route('MasterMicroPloan.index') }}">
                <input type="hidden" name="type" value="4">
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                    <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                      <span class="fas fa-print"></span> ปริ้นรายงาน
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a target="_blank" class="dropdown-item" href="{{ action('MPController@ReportPDFIndex',[00]) }}?type={{2}}&Flagtype={{1}}&Flag={{4}}"> รายงาน ขออนุมัติประจำวัน (P07)</a></li>
                      <li class="dropdown-divider"></li>
                      <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-report"> รายงาน เงินกู้พนักงาน (P07)</a></li>
                    </ul>
                  @endif
                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                </div>
                <div class="float-right form-inline">
                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MASTER")
                    <label class="mr-sm-2">เลขที่สัญญา : </label>
                    <input type="type" name="Contno" value="{{$contno}}" maxlength="13" class="form-control form-control-sm"/>
                  @else
                    <label class="mr-sm-2">เลขที่สัญญา : </label>
                    <input type="type" name="Contno" value="{{$contno}}" maxlength="13" class="form-control form-control-sm"/>
                  @endif

                  <label for="text" class="mr-sm-2">สถานะ : </label>
                  <select name="status" class="form-control form-control-sm">
                    <option selected value="">---------สถานะ--------</option>
                    <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</option>
                    <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</option>
                  </select>
                </div>
                <br><br>
                <div class="float-right form-inline">
                  <label class="mr-sm-2">จากวันที่ : </label>
                  <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                  <label class="mr-sm-2">ถึงวันที่ : </label>
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                </div>
              </form>
            @endif
          </div>
        </div>

        <div class="card card-primary card-outline">
          @if($type == 5 or $type == 4)
            <div class="card-body p-0 text-sm">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left fade active show" id="vert-tabs-50" role="tabpanel" aria-labelledby="vert-tabs-50-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาปัตตานี (50)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ปัตตานี')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-51" role="tabpanel" aria-labelledby="vert-tabs-51-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขายะลา (51)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ยะลา')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-52" role="tabpanel" aria-labelledby="vert-tabs-52-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขานราธิวาส (52)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'นราธิวาส')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-53" role="tabpanel" aria-labelledby="vert-tabs-53-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาสายบุรี (53)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'สายบุรี')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-54" role="tabpanel" aria-labelledby="vert-tabs-54-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาโกลก (54)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'โกลก')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-55" role="tabpanel" aria-labelledby="vert-tabs-55-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาเบตง (55)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'เบตง')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-56" role="tabpanel" aria-labelledby="vert-tabs-56-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาโคกโพธิ์ (56)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'โคกโพธิ์')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-57" role="tabpanel" aria-labelledby="vert-tabs-57-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาตันหยงมัส (57)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ตันหยงมัส')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-58" role="tabpanel" aria-labelledby="vert-tabs-58-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขารือเสาะ (58)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'รือเสาะ')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-59" role="tabpanel" aria-labelledby="vert-tabs-59-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขาบันนังสตา (59)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'บันนังสตา')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                    <div class="tab-pane fade" id="vert-tabs-60" role="tabpanel" aria-labelledby="vert-tabs-60-tab">
                      <div class="card-header">
                        <h3 class="card-title">สาขายะหา (60)</h3>
                      </div>
                      <div class="col-12">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">เลขที่สัญญา</th>
                              <th class="text-left">ยีห้อ</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              @if($type == 5)
                                <th class="text-center">% ยอดจัด</th>
                              @endif
                              <th class="text-center"></th>
                              <th class="text-left" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 105px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              @if($row->branch_car == 'ยะหา')
                                <tr>
                                  <td class="text-left"> {{ $row->Contract_MP}} </td>
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
                                  @if($type == 5)
                                    <td class="text-center">{{ ($row->Percent_car != Null) ? $row->Percent_car.'%' : ' ' }}</td>
                                  @endif
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
                                    <a target="_blank" href="{{ action('MPController@ReportPDFIndex',[$row->id]) }}?type={{1}}" class="btn btn-info btn-sm" title="พิมพ์">
                                      <i class="fas fa-print"></i>
                                    </a>

                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif

                                    {{-- แก้ไข / ดูรายการ --}}
                                    @if(auth::user()->type == "Admin")
                                      <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <i class="far fa-edit"></i>
                                      </a>
                                    @elseif(auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car == 'อนุมัติ')
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-success btn-sm" title="ดูรายการ">
                                          <i class="fas fa-eye"></i>
                                        </a>
                                      @else
                                        <a href="{{ route('MasterMicroPloan.edit',$row->id) }}?type={{$type}}&newfdate={{$newfdate}}&newtdate={{$newtdate}}&status={{$status}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                          <i class="far fa-edit"></i>
                                        </a>
                                      @endif
                                    @endif

                                    @if(auth::user()->type == "Admin") 
                                      <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                          <i class="far fa-trash-alt"></i>
                                        </button>
                                      </form>
                                    @elseif(auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      @if($row->StatusApp_car != 'อนุมัติ')
                                        <form method="post" class="delete_form" action="{{ route('MasterMicroPloan.destroy',[$row->id]) }}" style="display:inline;">
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{ $row->Contract_MP }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
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
                  </div>
                </div>
              </div>     
            </div>
          @endif
        </div>
      </div>
    </div>

    <a id="button"></a>
  </section>

  {{-- Modal รายงาน --}}
  <form action="{{ action('MPController@ReportPDFIndex',[00]) }}" method="get">
    @csrf
    <input type="hidden" name="type" value="2">
    <input type="hidden" name="Flagtype" value="2">
    
    @if($type == 5)
      <input type="hidden" name="Flag" value="3">
    @elseif($type == 4)
      <input type="hidden" name="Flag" value="4">
    @endif
    <div class="modal fade show" id="modal-report" style="display: none;" aria-modal="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            @if($type == 5)
              <h5 class="modal-title">รายงาน สัญญาเงินกู้รถยนต์ (P06)</h5>
            @elseif($type == 4)
              <h5 class="modal-title">รายงาน สัญญาเงินกู้พนักงาน (P07)</h5>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-sm">
            <div class="row">
              <div class="col-12">
                <div class="form-group row mb-1">
                  <label class="col-sm-4 col-form-label text-right">จากวันที่ :</label>
                  <div class="col-sm-8">
                    <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group row mb-1">
                  <label class="col-sm-4 col-form-label text-right">ถึงวันที่ :</label>
                  <div class="col-sm-8">
                    <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary text-center">ปริ้น</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  {{-- เปิดเลขที่สัญญา --}}
  <form action="{{ route('MasterMicroPloan.store') }}" method="post">
    @csrf
    <div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-sm bg-primary">
            <h5 class="modal-title"><i class="fas fa-id-card-alt pr-2"></i>เปิดเลขที่สัญญา (New Contract)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body text-sm">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-4 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                  <div class="col-sm-7">
                    <input type="text" name="Contract_MP" class="form-control form-control-sm" placeholder="ป้อนเลขที่สัญญา" required/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-4 col-form-label text-right"><font color="red">วันที่ : </font></label>
                  <div class="col-sm-7">
                    <input type="date" name="DateDue" class="form-control form-control-sm"  value="{{ date('Y-m-d') }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-4 col-form-label text-right"><font color="red">ประเภทสัญญา : </font></label>
                  <div class="col-sm-7">
                    <select name="TypeContract" class="form-control form-control-sm" required>
                      <option value="" selected>--- เลือกสัญญา ---</option>
                      <option value="P03">เงินกู้รถยนต์ (P03)</option>
                      <option value="P04">เงินกู้รถจักรยานยนต์ (P04)</option>
                      <option value="P06">เงินกู้ส่วนบุคคล (P06)</option>
                      <option value="P07">เงินกู้พนักงาน (P07)</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-4 col-form-label text-right"><font color="red">สาขา : </font></label>
                  <div class="col-sm-7">
                    <select name="BrachUser" class="form-control form-control-sm" required>
                      <option value="" selected>--- เลือกสาขา ---</option>
                      <option value="ปัตตานี">ปัตตานี (50)</option>
                      <option value="ยะลา">ยะลา (51)</option>
                      <option value="นราธิวาส">นราธิวาส (52)</option>
                      <option value="สายบุรี">สายบุรี (53)</option>
                      <option value="โกลก">โกลก (54)</option>
                      <option value="เบตง">เบตง (55)</option>
                      <option value="โคกโพธิ์">โคกโพธิ์ (56)</option>
                      <option value="ตันหยงมัส">ตันหยงมัส (57)</option>
                      <option value="รือเสาะ">รือเสาะ (58)</option>
                      <option value="บันนังสตา">บันนังสตา (59)</option>
                      <option value="ยะหา">ยะหา (60)</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-sm">Save</button>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" name="_token" value="{{csrf_token()}}" />
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
      $("#table1,#table2").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 1, "asc" ]],
      });
    });
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(2000);
    $('.prem').fadeIn(2000);
    }
    setInterval(blinker, 2000);
  </script>
@endsection
