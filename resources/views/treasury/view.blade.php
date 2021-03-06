@extends('layouts.master')
@section('title','แผนกการเงิน')
@section('content')

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
            <h5>รายการอนุมัติโอนเงิน (Approving transfers)</h5>
          </div>
          <div class="col-sm-6">
            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก การเงินใน")
              @if($Flag != NULL)
                <button class="btn btn-gray float-right">
                  @if($Flag == '2')
                    ค่าคอม: <font color="red">{{ number_format($SumCommitprice) }}</font> บาท
                  @elseif($Flag == '3')
                    ค่าคอม: <font color="red">{{ number_format($SumCommitpriceP) }}</font> บาท
                  @elseif($Flag == '4')
                    ค่าคอม: <font color="red">{{ number_format($SumCommitpriceM) }}</font> บาท
                  @endif
                </button>
                <button class="btn btn-warning btn-xs float-right"></button>
                <button class="btn btn-gray float-right">
                  @if($Flag == '2')
                    ยอดจัด: <font color="red">{{ number_format($SumTopcar) }}</font> บาท
                  @elseif($Flag == '3')
                    ยอดจัด: <font color="red">{{ number_format($SumTopcarP) }}</font> บาท
                  @elseif($Flag == '4')
                    ยอดจัด: <font color="red">{{ number_format($SumTopcarM) }}</font> บาท
                  @endif
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
        <a href="#" class="btn btn-primary btn-block mb-3">Compose</a>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link {{ (request()->is($Flag === '2')) ? 'active' : '' }}" name="F01" href="{{ route('MasterTreasury.index') }}?type={{2}}&Flag={{2}}">
                <i class="fas fa-hdd"></i> สัญญาเงินกู้ เช่าซื้อ
                @if($CountData != 0)
                  <span class="badge bg-danger float-right prem">{{$CountData}}</span>
                @endif
              </a>
              <a class="nav-link {{ (request()->is($Flag === '3')) ? 'active' : '' }}" name="PLoan" href="{{ route('MasterTreasury.index') }}?type={{2}}&Flag={{3}}">
                <i class="fas fa-hdd"></i> สัญญาเงินกู้ PLoan
                @if($CountPloan != 0)
                  <span class="badge bg-danger float-right prem">{{$CountPloan}}</span>
                @endif
              </a>
              <a class="nav-link {{ (request()->is($Flag === '4')) ? 'active' : '' }}" name="Micro" href="{{ route('MasterTreasury.index') }}?type={{2}}&Flag={{4}}">
                <i class="fas fa-hdd"></i> สัญญาเงินกู้ Micro
                @if($CountMicro != 0)
                  <span class="badge bg-danger float-right prem">{{$CountMicro}}</span>
                @endif
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-body text-sm">
            <form method="get" action="{{ route('MasterTreasury.index') }}">
              <input type="hidden" name="type" value="2">
              <input type="hidden" name="Flag" value="{{$Flag}}">

              <div class="float-right form-inline">
                <div class="btn-group">
                  <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                    <span class="fas fa-print"></span> ปริ้นรายงาน
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-6" data-link="{{ route('MasterTreasury.index') }}?type={{1}}&Flag={{1}}"> รายงานขออนุมัติ เช่าซื้อ (F01)</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-6" data-link="{{ route('MasterTreasury.index') }}?type={{1}}&Flag={{2}}"> รายงานขออนุมัติ Ploan (P03-P04)</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-6" data-link="{{ route('MasterTreasury.index') }}?type={{1}}&Flag={{3}}"> รายงานขออนุมัติ Micro (P06-P07)</a></li>
                  </ul>
                </div>
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
        </div>

        <div class="card card-primary card-outline">
          <div class="card-body p-0 text-sm">
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="tab-content" id="vert-tabs-tabContent">
                  @if($Flag === '2')
                    <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs-F01-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการอนุมัติเช่าซื้อ (Instalment contracts)</h3>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 50px">No.</th>
                              <th class="text-left">สาขา</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ยอดจัด</th>
                              <th class="text-left">ผู้อนุมัติ</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-left"> {{$row->branch_car}} </td>
                                <td class="text-left" data-toggle="modal" data-target="#modal-4" data-link="{{ route('SearchData', [1, $row->id]) }}" style="cursor: pointer;"> 
                                  <span>{{$row->License_car}}</span>
                                  @if ($row->Date_Appcar == date('Y-m-d'))
                                    <span class="badge bg-danger prem">NEW</span>
                                  @endif
                                  <i class="float-right fas fa-search-dollar"></i>
                                </td>
                                <td class="text-left"> {{number_format($row->Top_car)}} </td>
                                <td class="text-left">
                                  @if ($row->ManagerApp_car != NULL)
                                    {{$row->ManagerApp_car}} 
                                  @else
                                    {{$row->Approvers_car}} 
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if ($row->UserCheckAc_car != NULL)
                                    <button type="button" class="btn btn-success btn-sm" title="{{ DateThai($row->DateCheckAc_car) }}">
                                      <i class="far fa-calendar-check"></i>&nbsp; โอนเงินเรียบร้อย
                                    </button>
                                  @else
                                    <button type="button" class="btn btn-danger btn-sm" title="รอตรวจสอบ">
                                      <i class="fas fa-exclamation-circle prem"></i>&nbsp; รอตรวจสอบ
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a data-toggle="modal" data-target="#modal-5" data-link="{{ route('SearchData', [2, $row->id]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"> ตรวจสอบบัญชี</i>
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($Flag === '3')
                  <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs-PLoan-tab">
                    <div class="card-header">
                      <h3 class="card-title">รายการอนุมัติเงินกู้ PLoan (Instalment contracts)</h3>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-valign-middle" id="table1">
                        <thead>
                          <tr>
                            <th class="text-center" style="width: 50px">No.</th>
                            <th class="text-left">สาขา</th>
                            <th class="text-left">ทะเบียน</th>
                            <th class="text-left">ยอดจัด</th>
                            <th class="text-left">ผู้อนุมัติ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($dataP as $key => $row)
                            <tr>
                              <td class="text-center"> {{$key+1}} </td>
                              <td class="text-left"> {{$row->branch_car}} </td>
                              <td class="text-left" data-toggle="modal" data-target="#modal-4" data-link="{{ route('SearchData', [1, $row->id]) }}" style="cursor: pointer;"> 
                                <span>{{$row->License_car}}</span>
                                @if ($row->Date_Appcar == date('Y-m-d'))
                                  <span class="badge bg-danger prem">NEW</span>
                                @endif
                                <i class="float-right fas fa-search-dollar"></i>
                              </td>
                              <td class="text-left"> {{number_format($row->Top_car)}} </td>
                              <td class="text-left">
                                @if ($row->ManagerApp_car != NULL)
                                  {{$row->ManagerApp_car}} 
                                @else
                                  {{$row->Approvers_car}} 
                                @endif
                              </td>
                              <td class="text-center">
                                @if ($row->UserCheckAc_car != NULL)
                                  <button type="button" class="btn btn-success btn-sm" title="{{ DateThai($row->DateCheckAc_car) }}">
                                    <i class="far fa-calendar-check"></i>&nbsp; โอนเงินเรียบร้อย
                                  </button>
                                @else
                                  <button type="button" class="btn btn-danger btn-sm" title="รอตรวจสอบ">
                                    <i class="fas fa-exclamation-circle prem"></i>&nbsp; รอตรวจสอบ
                                  </button>
                                @endif
                              </td>
                              <td class="text-center">
                                <a data-toggle="modal" data-target="#modal-5" data-link="{{ route('SearchData', [2, $row->id]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"> ตรวจสอบบัญชี</i>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @elseif($Flag === '4')
                    <div class="tab-pane text-left fade active show" role="tabpanel" aria-labelledby="vert-tabs-Micro-tab">
                      <div class="card-header">
                        <h3 class="card-title">รายการอนุมัติเงินกู้ Micro (Instalment contracts)</h3>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-center" style="width: 50px">No.</th>
                              <th class="text-left">สาขา</th>
                              <th class="text-left">ทะเบียน</th>
                              <th class="text-left">ยอดจัด</th>
                              <th class="text-left">ผู้อนุมัติ</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-center">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dataM as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-left"> {{$row->branch_car}} </td>
                                <td class="text-left" data-toggle="modal" data-target="#modal-4" data-link="{{ route('SearchData', [1, $row->id]) }}" style="cursor: pointer;"> 
                                  <span>{{$row->License_car}}</span>
                                  @if ($row->Date_Appcar == date('Y-m-d'))
                                    <span class="badge bg-danger prem">NEW</span>
                                  @endif
                                  <i class="float-right fas fa-search-dollar"></i>
                                </td>
                                <td class="text-left"> {{number_format($row->Top_car)}} </td>
                                <td class="text-left">
                                  @if ($row->ManagerApp_car != NULL)
                                    {{$row->ManagerApp_car}} 
                                  @else
                                    {{$row->Approvers_car}} 
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if ($row->UserCheckAc_car != NULL)
                                    <button type="button" class="btn btn-success btn-sm" title="{{ DateThai($row->DateCheckAc_car) }}">
                                      <i class="far fa-calendar-check"></i>&nbsp; โอนเงินเรียบร้อย
                                    </button>
                                  @else
                                    <button type="button" class="btn btn-danger btn-sm" title="รอตรวจสอบ">
                                      <i class="fas fa-exclamation-circle prem"></i>&nbsp; รอตรวจสอบ
                                    </button>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a data-toggle="modal" data-target="#modal-5" data-link="{{ route('SearchData', [2, $row->id]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"> ตรวจสอบบัญชี</i>
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @else
                    <div class="error-page">
                      <h3 class=" text-danger">โปรดเลือกรายการ ทางด้านซ้ายมือ. !!</h3>
                      <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-danger prem"></i> Oops! Something went wrong.</h3>
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
    </div>
  </section>

  <!-- Pop up ทะเบียน -->
  <div class="modal fade" id="modal-4">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <!-- Pop up ตรวจสอบบัญชี -->
  <div class="modal fade" id="modal-5">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <!-- Pop up รายงานอนุมัติประจำวัน -->
  <div class="modal fade" id="modal-6">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p>One fine body…</p>
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

  <script>
    $(function () {
      $("#table1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": false,
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "order": [[ 1, "asc" ]],
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
