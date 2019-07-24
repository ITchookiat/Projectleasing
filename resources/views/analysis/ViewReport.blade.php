@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
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
        รายงานสินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="card-title p-3" align="center">รายงานสินเชื่อ</h3>
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
                <form method="get" action="{{ route('Analysis',3) }}">

                    <div align="right" class="form-inline">
                      <a target="_blank" href="#" class="btn btn-primary btn-app">
                        <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                      </a>
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
                    <label for="text" class="mr-sm-2">นายหน้า : </label>
                      <select name="agen" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                        <option selected disabled value="">---เลือกนายหน้า---</option>
                        @foreach($datadrop as $row)
                          <option value="{{ $row->Agent_car }}" {{ ($agen == $row->Agent_car) ? 'selected' : '' }}>{{ $row->Agent_car }}</otion>
                        @endforeach
                      </select>

                    <label for="text" class="mr-sm-2">ปี : </label>
                      <select name="yearcar" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                        <option selected disabled value="">---เลือกปี---</option>
                        @foreach($datadrop as $row)
                          <option value="{{ $row->Agent_car }}" {{ ($agen == $row->Agent_car) ? 'selected' : '' }}>{{ $row->Agent_car }}</otion>
                        @endforeach
                      </select>
                    &nbsp;&nbsp;&nbsp;
                    <label for="text" class="mr-sm-2">แบบ : </label>
                      <select name="typecar" class="form-control mb-2 mr-sm-2" id="text" style="width: 180px">
                        <option selected disabled value="">---เลือกแบบ---</option>
                        @foreach($datadrop as $row)
                          <option value="{{ $row->Agent_car }}" {{ ($agen == $row->Agent_car) ? 'selected' : '' }}>{{ $row->Agent_car }}</otion>
                        @endforeach
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
                           <th class="text-center">วันที่</th>
                           <th class="text-center">สถานะ</th>
                           <th class="text-center">ยีห้อ</th>
                           <th class="text-center">ทะเบียนเดิม</th>
                           <th class="text-center">ปี</th>
                           <th class="text-center">ยอดจัด</th>
                           <th class="text-center">สถานะอนุมัติ</th>
                         </tr>
                       </thead>
                       <tbody>
                         @foreach($data as $row)
                           <tr>
                             <td class="text-center"> {{ $row->branch_car}} </td>
                             <td class="text-center"> {{ $row->Contract_buyer}} </td>
                             <td class="text-center">{{ DateThai($row->Date_Due)}}</td>
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
                               @if ( $row->Approvers_car != Null)
                                   {{ $row->Approvers_car }}
                               @else
                                   <font color="red">รออนุมัติ</font>
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
            $(function() {
               $('#table').DataTable();
            });
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
