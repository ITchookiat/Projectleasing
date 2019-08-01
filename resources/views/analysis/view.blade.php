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
        สินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('Analysis',1) }}">หน้าหลัก</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('Analysis',2) }}">แบบฟอร์มผู้เช่าซื้อ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">แบบฟอร์มผู้ค้ำ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">แบบฟอร์มรถยนต์</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">แบบฟอร์มค่าใช้จ่าย</a>
            </li>
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
              <div class="col-md-12">
                <form method="get" action="{{ route('Analysis',1) }}">
                    <div align="right" class="form-inline">
                      @if(auth::user()->branch != 10 and auth::user()->branch != 11)
                        <a target="_blank" href="{{ action('ReportAnalysController@ReportDueDate') }}" class="btn btn-primary btn-app">
                          <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                        </a>
                      @endif

                      <button type="submit" class="btn btn-warning btn-app">
                        <span class="glyphicon glyphicon-search"></span> Search
                      </button>
                      <p></p>
                      <label>จากวันที่ : </label>
                      <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($newfdate != '') ?$newfdate: $date2 }}" class="form-control" />

                      <label>ถึงวันที่ : </label>
                      <input type="date" name="Todate" style="width: 180px;" value="{{ ($newtdate != '') ?$newtdate: $date2 }}" class="form-control" />

                    </div>
                    <div align="right" class="form-inline">
                    @if(auth::user()->branch != 10 and auth::user()->branch != 11)
                      <label for="text" class="mr-sm-2">สาขา : </label>
                        <select name="branch" class="form-control mb-2 mr-sm-2" id="text" style="width: 182px">
                          <option selected disabled value="">---เลือกสาขา---</option>
                          <option value="ปัตตานี" {{ ($branch == 'ปัตตานี') ? 'selected' : '' }}>ปัตตานี</otion>
                          <option value="ยะลา" {{ ($branch == 'ยะลา') ? 'selected' : '' }}>ยะลา</otion>
                          <option value="นราธิวาส" {{ ($branch == 'นราธิวาส') ? 'selected' : '' }}>นราธิวาส</otion>
                          <option value="สายบุรี" {{ ($branch == 'สายบุรี') ? 'selected' : '' }}>สายบุรี</otion>
                          <option value="สุไหงโก-ลก" {{ ($branch == 'สุไหงโก-ลก') ? 'selected' : '' }}>สุไหงโก-ลก</otion>
                          <option value="เบตง" {{ ($branch == 'เบตง') ? 'selected' : '' }}>เบตง</otion>
                        </select>
                    @endif

                    <label for="text" class="mr-sm-2">สถานะ : </label>
                      <select name="status" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                        <option selected disabled value="">---สถานะ---</option>
                        <option value="อนุมัติ"{{ ($status == 'อนุมัติ') ? 'selected' : '' }}>อนุมัติ</otion>
                        <option value="รออนุมัติ"{{ ($status == 'รออนุมัติ') ? 'selected' : '' }}>รออนุมัติ</otion>
                      </select>

                    </div>
                  </form>
                <hr>
{{--
            <!-- <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-success">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ยอดประจำวัน</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ทุกสาขา</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">ปัตตานี (01) </a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">ยะลา (03)</a></li>
              <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">นราธิวาส (04)</a></li>
              <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">สายบุรี (05)</a></li>
              <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">สุไงโกลก (06)</a></li>
              <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">เบตง (07)</a></li>
              <li class=""><a href="#tab_9" data-toggle="tab" aria-expanded="false">รวม (02)</a></li>
              <li class=""><a href="#tab_10" data-toggle="tab" aria-expanded="false">รถบ้าน (10)</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                a
              </div>
              <div class="tab-pane" id="tab_2">
                b
              </div>
              <div class="tab-pane" id="tab_3">
                c
              </div>
              <div class="tab-pane" id="tab_4">
                d
              </div>
              <div class="tab-pane" id="tab_5">
                e
              </div>
              <div class="tab-pane" id="tab_6">
                f
              </div>
              <div class="tab-pane" id="tab_7">
                g
              </div>
              <div class="tab-pane" id="tab_8">
                h
              </div>
              <div class="tab-pane" id="tab_9">
                i
              </div>
              <div class="tab-pane" id="tab_10">
                j
              </div>
            </div>
           </div> -->
--}}
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
                          <th class="text-center">เอกสาร</th>
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
                              <a href="{{ action('ReportAnalysController@ReportPDFIndex',[$row->id]) }}" class="btn btn-info btn-sm" title="พิมพ์">
                                <span class="glyphicon glyphicon-eye-open"></span> พิมพ์
                              </a>

                              @if(auth::user()->type == 1 or auth::user()->type == 2)
                                <a href="{{ action('AnalysController@edit',[$row->id]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                </a>
                              @else
                                @if($row->Approvers_car == Null)
                                  <a href="{{ action('AnalysController@edit',[$row->id]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
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
