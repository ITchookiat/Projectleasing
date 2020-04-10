@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
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

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        @if($type == 1)
          สินเชื่อ
          @if(auth::user()->type == 1 or auth::user()->type == 2)
          <button class="btn btn-gray pull-right">
            ค่าคอม: <font color="red">{{ number_format($SumCommitprice) }}</font> บาท
          </button>
          <button class="btn btn-warning btn-xs pull-right"></button>
          <button class="btn btn-gray pull-right">
            ยอดจัด: <font color="red">{{ number_format($SumTopcar) }}</font> บาท
          </button>
          <button class="btn btn-warning btn-xs pull-right"></button>
          <button class="btn btn-gray pull-right">
            <i class="fa fa-calendar"></i>
            @php
            $dateStart = substr($newfdate, 8, 9);
            $dateEnd = substr($newtdate, 8, 9);
            @endphp
            วันที่ {{ $dateStart }} ถึง {{ $dateEnd }}
          </button>
          @endif
        @elseif($type == 8)
          ปรับโครงสร้างหนี้
        @elseif($type == 12)
          มาตรการ COVID-19
        @endif
        <!-- <small>it all starts here</small> -->


      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <ul class="nav nav-pills ml-auto p-2">
            @if(auth::user()->branch == 10 or auth::user()->branch == 11 or auth::user()->type == 4)
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('Analysis',4) }}">หน้าหลัก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('Analysis',5) }}">แบบฟอร์มผู้เช่าซื้อ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">แบบฟอร์มผู้ค้ำ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">แบบฟอร์มรถยนต์</a>
              </li>
            @else
              @if($type == 1)
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('Analysis',1) }}">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('Analysis',2) }}">แบบฟอร์มผู้เช่าซื้อ</a>
                </li>
              @elseif($type == 8)
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('Analysis',8) }}">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('Analysis',9) }}">แบบฟอร์มผู้เช่าซื้อ</a>
                </li>
              @elseif($type == 12)
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('Analysis',12) }}">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('Analysis',13) }}">แบบฟอร์มผู้เช่าซื้อ</a>
                </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" href="#">แบบฟอร์มผู้ค้ำ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">แบบฟอร์มรถยนต์</a>
              </li>
              @if($type < 8)
              <li class="nav-item">
                <a class="nav-link" href="#">แบบฟอร์มค่าใช้จ่าย</a>
              </li>
              @endif
            @endif
          </ul>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              @if($type == 1)
                <div class="col-md-12">
                  <form method="get" action="{{ route('Analysis',1) }}">
                      <div align="right" class="form-inline">


                        @if(auth::user()->type == 1 or auth::user()->type == 2)
                        <label>เลขที่สัญญา : </label>
                        <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:180px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', $type) }}" class="btn btn-primary btn-app">
                            <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          </a>
                        @else
                        <label>เลขที่สัญญา : </label>
                        <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:330px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                        @endif

                        <button type="submit" class="btn btn-warning btn-app">
                          <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                        <p></p>
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                      </div>
                      <div align="right" class="form-inline">
                        <label for="text" class="mr-sm-2">สาขา : </label>
                          <select name="branch" class="form-control mb-2 mr-sm-2" id="text" style="width: 182px">
                            <option selected value="">---เลือกสาขา---</option>
                            <option value="ปัตตานี" {{ ($branch == 'ปัตตานี') ? 'selected' : '' }}>ปัตตานี</otion>
                            <option value="ยะลา" {{ ($branch == 'ยะลา') ? 'selected' : '' }}>ยะลา</otion>
                            <option value="นราธิวาส" {{ ($branch == 'นราธิวาส') ? 'selected' : '' }}>นราธิวาส</otion>
                            <option value="สายบุรี" {{ ($branch == 'สายบุรี') ? 'selected' : '' }}>สายบุรี</otion>
                            <option value="โกลก" {{ ($branch == 'โกลก') ? 'selected' : '' }}>โกลก</otion>
                            <option value="เบตง" {{ ($branch == 'เบตง') ? 'selected' : '' }}>เบตง</otion>
                          </select>

                      <label for="text" class="mr-sm-2">สถานะ : </label>
                        <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                          <option selected value="">---สถานะ---</option>
                          <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                          <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                        </select>
                      </div>
                    </form>
                  <hr>
                   <div class="table-responsive">
                     <table class="table table-bordered" id="table">
                        <thead class="thead-dark bg-gray-light" >
                          <tr>
                            <th class="text-center">สาขา</th>
                            <th class="text-center">เลขที่สัญญา</th>
                            <th class="text-center">แบบ</th>
                            <th class="text-center">ยีห้อ</th>
                            <th class="text-center">ทะเบียนเดิม</th>
                            <th class="text-center">ปี</th>
                            <th class="text-center">ยอดจัด</th>
                            <th class="text-center">เอกสาร/แก้ไข</th>
                            <th class="text-center">ตรวจสอบ</th>
                            <th class="text-center">สถานะอนุมัติ</th>
                            <th class="text-center" style="width: 200px">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $row)
                            <tr>
                              <td class="text-center"> {{ $row->branch_car}} </td>
                              <td class="text-center"> {{ $row->Contract_buyer}} </td>
                              <td class="text-center"> {{ $row->status_car}} </td>
                              <td class="text-center"> {{ $row->Brand_car}} </td>
                              <td class="text-center"> {{ $row->License_car}} </td>
                              <td class="text-center"> {{ $row->Year_car}} </td>
                              <td class="text-center">
                                @if($row->Top_car != Null)
                                  {{ number_format($row->Top_car)}}
                                @else
                                  0
                                @endif
                              </td>
                              <td class="text-center">
                                <label class="con">
                                @if ( $row->DocComplete_car != Null)
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                @else
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                @endif
                                <span class="checkmark"></span>
                                </label>

                                <label class="con2">
                                @if ( $row->tran_Price != 0)
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                @else
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                @endif
                                <span class="checkmark"></span>
                                </label>
                              </td>
                              <td class="text-center">
                                @if ( $row->Check_car != Null)
                                    {{ $row->Check_car }}
                                @else
                                    <font color="red">รอตรวจสอบ</font>
                                @endif
                              </td>
                              <td class="text-center">
                                @if ( $row->Approvers_car != Null)
                                    {{ $row->Approvers_car }}
                                @else
                                    <font color="red">รออนุมัติ</font>
                                @endif
                              </td>
                              <td class="text-center">
                                <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                  <span class="glyphicon glyphicon-print"></span> พิมพ์
                                </a>
                                @if(auth::user()->type == 3 and $row->StatusApp_car == 'อนุมัติ')
                                    @php $branch = 'Null'; @endphp
                                    @php $status = 'Null'; @endphp
                                <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                  <span class="glyphicon glyphicon-eye-open"></span> ดู
                                </a>
                                @endif

                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  @if($branch == "")
                                    @php $branch = 'Null'; @endphp
                                  @endif
                                  @if($status == "")
                                    @php $status = 'Null'; @endphp
                                  @endif
                                  <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                  </a>
                                @else
                                  @if($row->Approvers_car == Null)
                                    @if($branch == "")
                                      @php $branch = 'Null'; @endphp
                                    @endif
                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif
                                    <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                      <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                    </a>
                                  @endif
                                @endif

                              @if(auth::user()->type == 1 or auth::user()->type == 2)
                                <div class="form-inline form-group">
                                  <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                  {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                      <span class="glyphicon glyphicon-trash"></span> ลบ
                                    </button>
                                  </form>
                                </div>
                              @else
                                @if($row->DocComplete_car == Null)
                                 @if($row->StatusApp_car != 'อนุมัติ')
                                  <div class="form-inline form-group">
                                    <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                    {{csrf_field()}}
                                      <input type="hidden" name="_method" value="DELETE" />
                                      <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                        <span class="glyphicon glyphicon-trash"></span> ลบ
                                      </button>
                                    </form>
                                  </div>
                                  @endif
                                @endif
                              @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              @elseif($type == 4)
                <div class="col-md-12">
                  <form method="get" action="{{ route('Analysis',4) }}">
                    <div align="right" class="form-inline">

                      <button type="submit" class="btn btn-warning btn-app">
                        <span class="glyphicon glyphicon-search"></span> Search
                      </button>
                      <p></p>
                      <label>จากวันที่ : </label>
                      <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                      <label>ถึงวันที่ : </label>
                      <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                    </div>
                    <div align="right" class="form-inline">
                      <label for="text" class="mr-sm-2">สถานะ : </label>
                      <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                        <option selected disabled value="">---สถานะ---</option>
                        <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                        <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                      </select>
                    </div>
                  </form>
                  <hr>
                 <div class="table-responsive">
                   <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">สาขา</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">สถานะ</th>
                          <th class="text-center">ยีห้อ</th>
                          <th class="text-center">ทะเบียนเดิม</th>
                          <th class="text-center">ปี</th>
                          <th class="text-center">ยอดจัด</th>
                          <th class="text-center">สถานะอนุมัติ</th>
                          <th class="text-center" style="width: 200px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $row)
                          <tr>
                            <td class="text-center"> {{ $row->branchUS_HC}} </td>
                            <td class="text-center"> {{ $row->Contract_buyer}} </td>
                            <td class="text-center"> {{ $row->baab_HC}} </td>
                            <td class="text-center"> {{ $row->brand_HC}} </td>
                            <td class="text-center"> {{ $row->oldplate_HC}} </td>
                            <td class="text-center"> {{ $row->year_HC}} </td>
                            <td class="text-center">
                              @if($row->price_HC != Null)
                                {{ $row->topprice_HC }}
                              @else
                                0
                              @endif
                            </td>
                            <td class="text-center">
                              @if ( $row->approvers_HC != Null)
                                  {{ $row->approvers_HC }}
                              @else
                                  <font color="red">รออนุมัติ</font>
                              @endif
                            </td>
                            <td class="text-center">
                              <a target="_blank" href="{{ action('ReportAnalysController@ReportHomecar',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                <span class="glyphicon glyphicon-eye-open"></span> พิมพ์
                              </a>

                              @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4)
                                @php $branch = 'Null'; @endphp
                                @if($status == "")
                                  @php $status = 'Null'; @endphp
                                @endif
                                <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                </a>
                              @else
                                @if($row->approvers_HC == Null)
                                  @php $branch = 'Null'; @endphp
                                  @if($status == "")
                                    @php $status = 'Null'; @endphp
                                  @endif
                                  <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                  </a>
                                @endif
                              @endif

                            @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4)
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </form>
                              </div>
                            @else
                              @if($row->approvers_HC == Null)
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </form>
                              </div>
                              @endif
                            @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @elseif($type == 8) {{-- ปรับโครงสร้างหนี้ --}}
                  <div class="col-md-12">
                    <form method="get" action="{{ route('Analysis',8) }}">
                        <div align="right" class="form-inline">


                          @if(auth::user()->type == 1 or auth::user()->type == 2)
                          <label>เลขที่สัญญา : </label>
                          <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:180px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', 2) }}" class="btn btn-primary btn-app">
                              <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                            </a>
                          @else
                          <label>เลขที่สัญญา : </label>
                          <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:330px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                          @endif

                          <button type="submit" class="btn btn-warning btn-app">
                            <span class="glyphicon glyphicon-search"></span> Search
                          </button>
                          <p></p>
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                        </div>
                        <div align="right" class="form-inline">
                          <!-- <label for="text" class="mr-sm-2">สาขา : </label>
                            <select name="branch" class="form-control mb-2 mr-sm-2" id="text" style="width: 182px">
                              <option selected value="">---เลือกสาขา---</option>
                              <option value="ปัตตานี" {{ ($branch == 'ปัตตานี') ? 'selected' : '' }}>ปัตตานี</otion>
                              <option value="ยะลา" {{ ($branch == 'ยะลา') ? 'selected' : '' }}>ยะลา</otion>
                              <option value="นราธิวาส" {{ ($branch == 'นราธิวาส') ? 'selected' : '' }}>นราธิวาส</otion>
                              <option value="สายบุรี" {{ ($branch == 'สายบุรี') ? 'selected' : '' }}>สายบุรี</otion>
                              <option value="โกลก" {{ ($branch == 'โกลก') ? 'selected' : '' }}>โกลก</otion>
                              <option value="เบตง" {{ ($branch == 'เบตง') ? 'selected' : '' }}>เบตง</otion>
                            </select> -->

                        <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                            <option selected value="">---สถานะ---</option>
                            <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                            <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                          </select>
                        </div>
                      </form>
                    <hr>
                     <div class="table-responsive">
                       <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center">สาขา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">แบบ</th>
                              <th class="text-center">ยีห้อ</th>
                              <th class="text-center">ทะเบียนเดิม</th>
                              <th class="text-center">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">เอกสาร/แก้ไข</th>
                              <th class="text-center">ตรวจสอบ</th>
                              <th class="text-center">สถานะอนุมัติ</th>
                              <th class="text-center" style="width: 200px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              <tr>
                                <td class="text-center"> {{ $row->branch_car}} </td>
                                <td class="text-center"> {{ $row->Contract_buyer}} </td>
                                <td class="text-center"> {{ $row->status_car}} </td>
                                <td class="text-center"> {{ $row->Brand_car}} </td>
                                <td class="text-center"> {{ $row->License_car}} </td>
                                <td class="text-center"> {{ $row->Year_car}} </td>
                                <td class="text-center">
                                  @if($row->Top_car != Null)
                                    {{ number_format($row->Top_car)}}
                                  @else
                                    0
                                  @endif
                                </td>
                                <td class="text-center">
                                  <label class="con">
                                  @if ( $row->DocComplete_car != Null)
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                  @else
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                  @endif
                                  <span class="checkmark"></span>
                                  </label>

                                  <label class="con2">
                                  @if ( $row->tran_Price != 0)
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                  @else
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                  @endif
                                  <span class="checkmark"></span>
                                  </label>
                                </td>
                                <td class="text-center">
                                  @if ( $row->Check_car != Null)
                                      {{ $row->Check_car }}
                                  @else
                                      <font color="red">รอตรวจสอบ</font>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if ( $row->Approvers_car != Null)
                                      {{ $row->Approvers_car }}
                                  @else
                                      <font color="red">รออนุมัติ</font>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                    <span class="glyphicon glyphicon-print"></span> พิมพ์
                                  </a>
                                  @if(auth::user()->type == 3 and $row->StatusApp_car == 'อนุมัติ')
                                      @php $branch = 'Null'; @endphp
                                      @php $status = 'Null'; @endphp
                                      @if($newfdate == "")
                                        @php $newfdate = date('Y-m-d'); @endphp
                                      @endif
                                      @if($newtdate == "")
                                        @php $newtdate = date('Y-m-d'); @endphp
                                      @endif
                                  <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                    <span class="glyphicon glyphicon-eye-open"></span> ดู
                                  </a>
                                  @endif

                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    @if($branch == "")
                                      @php $branch = 'Null'; @endphp
                                    @endif
                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif
                                    @if($newfdate == "")
                                      @php $newfdate = date('Y-m-d'); @endphp
                                    @endif
                                    @if($newtdate == "")
                                      @php $newtdate = date('Y-m-d'); @endphp
                                    @endif
                                    <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                      <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                    </a>
                                  @else
                                    @if($row->Approvers_car == Null)
                                      @if($branch == "")
                                        @php $branch = 'Null'; @endphp
                                      @endif
                                      @if($status == "")
                                        @php $status = 'Null'; @endphp
                                      @endif
                                      @if($newfdate == "")
                                        @php $newfdate = date('Y-m-d'); @endphp
                                      @endif
                                      @if($newtdate == "")
                                        @php $newtdate = date('Y-m-d'); @endphp
                                      @endif
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                      </a>
                                    @endif
                                  @endif

                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <div class="form-inline form-group">
                                    <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                    {{csrf_field()}}
                                      <input type="hidden" name="_method" value="DELETE" />
                                      <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                        <span class="glyphicon glyphicon-trash"></span> ลบ
                                      </button>
                                    </form>
                                  </div>
                                @else
                                  @if($row->DocComplete_car == Null)
                                   @if($row->StatusApp_car != 'อนุมัติ')
                                    <div class="form-inline form-group">
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                          <span class="glyphicon glyphicon-trash"></span> ลบ
                                        </button>
                                      </form>
                                    </div>
                                    @endif
                                  @endif
                                @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
              @elseif($type == 12) {{-- มาตรการช่วยเหลือ --}}
                  <div class="col-md-12">
                    <form method="get" action="{{ route('Analysis',12) }}">
                        <div align="right" class="form-inline">


                          @if(auth::user()->type == 1 or auth::user()->type == 2)
                          <label>เลขที่สัญญา : </label>
                          <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:180px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate', 3) }}" class="btn btn-primary btn-app">
                              <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                            </a>
                          @else
                          <label>เลขที่สัญญา : </label>
                          <input type="type" name="Contno" value="{{$contno}}" maxlength="12" style="padding:5px;width:330px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                          @endif

                          <button type="submit" class="btn btn-warning btn-app">
                            <span class="glyphicon glyphicon-search"></span> Search
                          </button>
                          <p></p>
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                        </div>
                        <div align="right" class="form-inline">
                          <!-- <label for="text" class="mr-sm-2">สาขา : </label>
                            <select name="branch" class="form-control mb-2 mr-sm-2" id="text" style="width: 182px">
                              <option selected value="">---เลือกสาขา---</option>
                              <option value="ปัตตานี" {{ ($branch == 'ปัตตานี') ? 'selected' : '' }}>ปัตตานี</otion>
                              <option value="ยะลา" {{ ($branch == 'ยะลา') ? 'selected' : '' }}>ยะลา</otion>
                              <option value="นราธิวาส" {{ ($branch == 'นราธิวาส') ? 'selected' : '' }}>นราธิวาส</otion>
                              <option value="สายบุรี" {{ ($branch == 'สายบุรี') ? 'selected' : '' }}>สายบุรี</otion>
                              <option value="โกลก" {{ ($branch == 'โกลก') ? 'selected' : '' }}>โกลก</otion>
                              <option value="เบตง" {{ ($branch == 'เบตง') ? 'selected' : '' }}>เบตง</otion>
                            </select> -->

                        <label for="text" class="mr-sm-2">สถานะ : </label>
                          <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                            <option selected value="">---สถานะ---</option>
                            <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                            <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                          </select>
                        </div>
                      </form>
                    <hr>
                     <div class="table-responsive">
                       <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center" style="width:100px;">สาขา</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">สัญญาเดิม</th>
                              <!-- <th class="text-center">แบบ</th> -->
                              <th class="text-center">ยีห้อ</th>
                              <th class="text-center">ทะเบียน</th>
                              <th class="text-center">ปี</th>
                              <th class="text-center">ยอดจัด</th>
                              <th class="text-center">เอกสาร/แก้ไข</th>
                              <th class="text-center">ตรวจสอบ</th>
                              <th class="text-center">สถานะอนุมัติ</th>
                              <th class="text-center" style="width: 90px">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              <tr>
                                <td class="text-center">
                                  @if($row->Loanofficer_car == 'นายต่วนมุหยีดีน ลอจิ' or $row->Loanofficer_car == 'นางวิธุกร ณ พิชัย' or $row->Loanofficer_car == 'นางวุฐิกุล ศุกลรัตน์')
                                    ปัตตานี
                                  @elseif($row->Loanofficer_car == 'นายเดะมะ มะ' or $row->Loanofficer_car == 'นายมะยูโซะ อามะ' or $row->Loanofficer_car == 'นายฤทธิพร ดือราแม')
                                    ยะลา
                                  @elseif($row->Loanofficer_car == 'น.ส.ฮายาตี นิบง' or $row->Loanofficer_car == 'นายซุลกิฟลี แมเราะ' or $row->Loanofficer_car == 'นายมัซวัน มะสาแม')
                                    นราธิวาส
                                  @elseif($row->Loanofficer_car == 'นายฟิกรีย์ บาราเต๊ะ' or $row->Loanofficer_car == 'น.ส สาลีละห์ เจะโซะ')
                                    สายบุรี
                                  @elseif($row->Loanofficer_car == 'นายฟาอีส อูมา' or $row->Loanofficer_car == 'สุภาพร สุขแดง')
                                    โกลก
                                  @elseif($row->Loanofficer_car == 'น.ส.เพ็ญทิพย์ หนูบุญล้อม' or $row->Loanofficer_car == 'น.ส สาลีละห์ เจะโซะ')
                                    เบตง
                                  @endif
                                  <br/>
                                  (<font color="blue" size="1px">{{ $row->Objective_car}}</font>)
                                </td>
                                <td class="text-center"> {{ $row->Contract_buyer}} </td>
                                <td class="text-center"> {{ $row->Note_car}} </td>
                                <!-- <td class="text-center"> {{ $row->status_car}} </td> -->
                                <td class="text-center"> {{ $row->Brand_car}} </td>
                                <td class="text-center"> {{ $row->License_car}} </td>
                                <td class="text-center"> {{ $row->Year_car}} </td>
                                <td class="text-center">
                                  @if($row->Top_car != Null)
                                    {{ number_format($row->Top_car)}}
                                  @else
                                    0
                                  @endif
                                </td>
                                <td class="text-center">
                                  <label class="con">
                                  @if ( $row->DocComplete_car != Null)
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                  @else
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                  @endif
                                  <span class="checkmark"></span>
                                  </label>

                                  <label class="con2">
                                  @if ( $row->tran_Price != 0)
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" checked="checked" disabled>
                                  @else
                                    <input type="checkbox" class="checkbox" name="Checkcar" id="" disabled>
                                  @endif
                                  <span class="checkmark"></span>
                                  </label>
                                </td>
                                <td class="text-center">
                                  @if ( $row->Check_car != Null)
                                      {{ $row->Check_car }}
                                  @else
                                      <font color="red">รอตรวจสอบ</font>
                                  @endif
                                </td>
                                <td class="text-center">
                                  @if ( $row->Approvers_car != Null)
                                      {{ $row->Approvers_car }}
                                  @else
                                      <font color="red">รออนุมัติ</font>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a target="_blank" href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id,$type]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                    <span class="glyphicon glyphicon-print"></span>
                                  </a>
                                  @if(auth::user()->type == 3 and $row->StatusApp_car == 'อนุมัติ')
                                      @php $branch = 'Null'; @endphp
                                      @php $status = 'Null'; @endphp
                                      @if($newfdate == "")
                                        @php $newfdate = date('Y-m-d'); @endphp
                                      @endif
                                      @if($newtdate == "")
                                        @php $newtdate = date('Y-m-d'); @endphp
                                      @endif
                                  <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-success btn-sm" title="ดูรายการ">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                  </a>
                                  @endif

                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    @if($branch == "")
                                      @php $branch = 'Null'; @endphp
                                    @endif
                                    @if($status == "")
                                      @php $status = 'Null'; @endphp
                                    @endif
                                    @if($newfdate == "")
                                      @php $newfdate = date('Y-m-d'); @endphp
                                    @endif
                                    @if($newtdate == "")
                                      @php $newtdate = date('Y-m-d'); @endphp
                                    @endif
                                    <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                      <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                  @else
                                    @if($row->Approvers_car == Null)
                                      @if($branch == "")
                                        @php $branch = 'Null'; @endphp
                                      @endif
                                      @if($status == "")
                                        @php $status = 'Null'; @endphp
                                      @endif
                                      @if($newfdate == "")
                                        @php $newfdate = date('Y-m-d'); @endphp
                                      @endif
                                      @if($newtdate == "")
                                        @php $newtdate = date('Y-m-d'); @endphp
                                      @endif
                                      <a href="{{ action('AnalysController@edit',[$type,$row->id,$newfdate,$newtdate,$branch,$status]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                      </a>
                                    @endif
                                  @endif

                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <div class="form-inline form-group">
                                    <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                    {{csrf_field()}}
                                      <input type="hidden" name="_method" value="DELETE" />
                                      <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                        <span class="glyphicon glyphicon-trash"></span>
                                      </button>
                                    </form>
                                  </div>
                                @else
                                  @if($row->DocComplete_car == Null)
                                   @if($row->StatusApp_car != 'อนุมัติ')
                                    <div class="form-inline form-group">
                                      <form method="post" class="delete_form" action="{{ action('AnalysController@destroy',$row->id) }}">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                          <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                      </form>
                                    </div>
                                    @endif
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
           <script type="text/javascript">
             $(document).ready(function() {
               $('#table').DataTable( {
                 "order": [[ 1, "asc" ]]
               } );
             } );
           </script>

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>
        </div>

      </div>
    </section>

@endsection
