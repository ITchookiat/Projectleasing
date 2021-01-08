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
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-8">
                    <div class="form-inline">
                      <h4 class="">
                        @if($type == 1)
                          ลูกหนี้ประนอมหนี้ (Compounding Debt)
                        @elseif($type == 2)
                          ลูกหนี้ประนอมหนี้ใหม่ (New Compounding Debt)
                        @elseif($type == 3)
                          ลูกหนี้ประนอมหนี้เก่า (Old Compounding Debt)
                        @endif
                      </h4>
                    </div>
                  </div>
                  <div class="col-4">
                    @if($type == 2 or $type == 3)
                      <div class="card-tools">
                        <div class="float-right form-inline">
                          <a class="btn btn-primary btn-sm" href="{{ route('MasterCompro.index') }}?type={{1}}">
                            <i class="fas fa-caret-square-left"></i> Back
                          </a>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="row">
                  @if($type == 1)
                    <div class="container-fluid">
                      <div class="row mb-0">
                        <div class="col-sm-12">
                          <div class="card-tools d-inline float-right">
                            <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                              <span class="fas fa-print"></span> ปริ้นรายงาน
                            </button>
                              <ul class="dropdown-menu" role="menu">
                                {{-- <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-1" data-link="{{ route('MasterCompro.show', 1) }}"> รายงาน ติดตามประนอมหนี้</a></li>
                                <li class="dropdown-divider"></li> --}}
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-2" data-link="{{ route('MasterCompro.show', 2) }}"> รายงาน การชำระค่างวด(บุคคล)</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-3" data-link="{{ route('MasterCompro.show', 3) }}"> รายงาน ตรวจสอบการรับชำระ</a></li>
                              </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-6">
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{$data1}}</h3>
          
                          <p>ลูกหนี้ประนอมใหม่ (New Compounding Debt)</p>
                          <a href="{{ route('LegisCompro.ReportCompro',[2]) }}" class="btn btn-outline-success btn-sm float-left"><i class="fas fa-file-excel pr-1"></i> Download</a>
                        </div>
                        <div class="icon p-3">
                          <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="icon p-3">
                          <div class="row">
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: black">ยอดประนอมรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($Sum1, 2)}}"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: black">ยอดชำระรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($SumPrice1, 2)}}"/>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: black">ยอดส่วนลดรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($SumDiscount1, 2)}}"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: black">ยอดคงเหลือรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($Sum2, 2)}}"/>
                            </div>
                          </div>
                        </div>
                        <a href="{{ route('MasterCompro.index') }}?type={{2}}" class="small-box-footer">เพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>

                    <div class="col-lg-6 col-6">
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{$data2}}</h3>
          
                          <p>ลูกหนี้ประนอมเก่า (Compounding Debt)</p>
                          <a href="{{ route('LegisCompro.ReportCompro',[3]) }}" class="btn btn-outline-warning btn-sm float-left"><i class="fas fa-file-excel pr-1"></i> Download</a>

                        </div>
                        <div class="icon p-3">
                          <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="icon p-3">
                          <div class="row">
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: white">ยอดประนอมรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($Sum3, 2)}}"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: white">ยอดชำระรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($SumPrice2, 2)}}"/>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: white">ยอดส่วนลดรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($SumDiscount2, 2)}}"/>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <h6 style="color: white">ยอดคงเหลือรวม :</h6>
                              <input type="text" class="form-control form-control-sm" style="text-align:right;" value="{{ number_format($Sum4, 2)}}"/>
                            </div>
                          </div>
                        </div>
                        <a href="{{ route('MasterCompro.index') }}?type={{3}}" class="small-box-footer">เพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                  @elseif($type == 2)
                    <div class="col-md-12">
                      {{-- <form method="get">
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
                      </form> --}}
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
                              <th class="text-center">ยอดประนอม</th>
                              <th class="text-center">ยอดคงเหลือ</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-right" style="width: 30px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}} </td>
                                <td class="text-center"> {{DateThai($row->Date_Promise)}}</td>
                                <td class="text-right"> {{number_format($row->Total_Promise, 2)}}</td>
                                <td class="text-right"> {{number_format($row->Sum_Promise, 2)}}</td>
                                <td class="text-right">
                                  @php
                                    $lastday = date('Y-m-d', strtotime("-90 days"));
                                    $SetPayAll = str_replace (",","",$row->Payall_Promise);
                                  @endphp

                                  @if($row->DateFirst_Promise != NULL)
                                    @if($row->Sum_FirstPromise == $SetPayAll)
                                      <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="ครบชำระเงินก้อนแรก">
                                        <i class="fas fa-hands-helping prem"></i>
                                      </button>
                                    @else
                                      <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="ขาดชำระเงินก้อนแรก">
                                        <i class="fas fa-hand-holding-usd prem"></i>
                                      </button>
                                    @endif
                                  @else
                                    <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="ยังไม่คีย์เงินก้อนแรก">
                                      <i class="fas fa-comment-dollar prem"></i>
                                    </button>
                                  @endif

                                  @if($row->Status_Promise == "ปิดบัญชีประนอมหนี้" or $row->Status_Promise == "จ่ายจบประนอมหนี้")
                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{ $row->Status_Promise }}">
                                      <i class="fas fa-user-check prem"></i>
                                    </button>
                                  @else
                                    @if($row->DatePayment_Promise != NULL)
                                      @if($row->DatePayment_Promise < $lastday)
                                        <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="วันดิวงวดถัดไป {{DateThai($row->DatePayment_Promise)}}">
                                          <i class="far fa-thumbs-down prem"></i> 
                                        </button>
                                      @else
                                        <button data-toggle="tooltip" type="button" class="btn btn-info btn-sm" title="วันดิวงวดถัดไป {{DateThai($row->DatePayment_Promise)}}">
                                          <i class="far fa-thumbs-up prem"></i>
                                        </button>
                                      @endif
                                    @else
                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="ยังไม่มีการชำระค่างวด">
                                        <i class="far fa-thumbs-down prem"></i> 
                                      </button>
                                    @endif
                                  @endif
                                </td>
                                <td class="text-right">
                                  <a href="{{ route('MasterCompro.edit',[$row->id]) }}?type={{2}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @elseif($type == 3)
                    <div class="col-md-12">
                      {{-- <form method="get" >
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
                      </form> --}}
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
                              <th class="text-center">ยอดประนอม</th>
                              <th class="text-center">ยอดคงเหลือ</th>
                              <th class="text-center">สถานะ</th>
                              <th class="text-right" style="width: 50px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-left"> {{$row->Contract_legis}}</td>
                                <td class="text-left"> {{$row->Name_legis}} </td>
                                <td class="text-center"> {{DateThai($row->Date_Promise)}}</td>
                                <td class="text-right"> {{number_format($row->Total_Promise, 2)}}</td>
                                <td class="text-right"> {{number_format($row->Sum_Promise, 2)}}</td>
                                <td class="text-right">
                                  @php
                                    $lastday = date('Y-m-d', strtotime("-90 days"));
                                    $SetPayAll = str_replace (",","",$row->Payall_Promise);
                                  @endphp

                                  @if($row->DateFirst_Promise != NULL)
                                    @if($row->Sum_FirstPromise == $SetPayAll)
                                      <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="ครบชำระเงินก้อนแรก">
                                        <i class="fas fa-hands-helping prem"></i>
                                      </button>
                                    @else
                                      <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="ขาดชำระเงินก้อนแรก">
                                        <i class="fas fa-hand-holding-usd prem"></i>
                                      </button>
                                    @endif
                                  @else
                                    <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="ยังไม่คีย์เงินก้อนแรก">
                                      <i class="fas fa-comment-dollar prem"></i>
                                    </button>
                                  @endif

                                  @if($row->Status_Promise == "ปิดบัญชีประนอมหนี้" or $row->Status_Promise == "จ่ายจบประนอมหนี้")
                                    <button data-toggle="tooltip" type="button" class="btn btn-success btn-sm" title="{{ $row->Status_Promise }}">
                                      <i class="fas fa-user-check prem"></i>
                                    </button>
                                  @else
                                    @if($row->DatePayment_Promise != NULL)
                                      @if($row->DatePayment_Promise < $lastday)
                                        <button data-toggle="tooltip" type="button" class="btn btn-danger btn-sm" title="วันดิวงวดถัดไป {{DateThai($row->DatePayment_Promise)}}">
                                          <i class="far fa-thumbs-down prem"></i> 
                                        </button>
                                      @else
                                        <button data-toggle="tooltip" type="button" class="btn btn-info btn-sm" title="วันดิวงวดถัดไป {{DateThai($row->DatePayment_Promise)}}">
                                          <i class="far fa-thumbs-up prem"></i>
                                        </button>
                                      @endif
                                    @else
                                      <button data-toggle="tooltip" type="button" class="btn btn-warning btn-sm" title="ยังไม่มีการชำระค่างวด">
                                        <i class="far fa-thumbs-down prem"></i> 
                                      </button>
                                    @endif
                                  @endif
                                </td>
                                <td class="text-right">
                                  <a href="{{ route('MasterCompro.edit',[$row->id]) }}?type={{3}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i>
                                  </a>
                                  <form method="post" class="delete_form" action="{{ route('MasterCompro.destroy',[$row->id]) }}?type={{1}}" style="display:inline;">
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
                  @endif

                  <a id="button"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Pop up รายงานลูกหนี้ประนอมหนี้ -->
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

    <!-- Pop up รายงานติดตามประนอมหนี้ -->
    <div class="modal fade" id="modal-1">
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

    <!-- Pop up รายงานชำะค่างวด -->
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

    <!-- Pop up รายงานตรวจสอบยอดชำระ -->
    <div class="modal fade" id="modal-3">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            {{-- <p>One fine body…</p> --}}
          </div>
        </div>
      </div>
    </div>
  </section>

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
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable( {
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
@endsection
