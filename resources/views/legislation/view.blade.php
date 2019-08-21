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
          <h3 class="card-title p-3" align="center">รายชื่อส่งฟ้อง</h3>
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
                {{--
                <!-- <form name="form1" action="{{ route('Legislation.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                    @csrf
                  <div align="right" class="form-inline">
                    <a href="#" class="btn btn-primary btn-app">
                      <span class="glyphicon glyphicon-save"></span> Update
                    </a>
                  </div>
                </form> -->
                --}}

                 <hr>
                 <div class="table-responsive">
                   <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">บัตรประชาชน</th>
                          <th class="text-center">วันที่ทำสัญญา</th>
                          <th class="text-center">ยี่ห้อ</th>
                          <th class="text-center">ปีรถ</th>
                          <th class="text-center" style="width: 100px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($result as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center"> {{$row->CONTNO}} </td>
                            <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                            <td class="text-center"> {{str_replace(" ","",$row->IDNO)}} </td>
                            <td class="text-center"> {{$row->FDATE}} </td>
                            <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->TYPE)) }} </td>
                            <td class="text-center"> {{$row->MANUYR}} </td>
                            <td class="text-center">
                              @php
                                 $StrCon = explode("/",$row->CONTNO);
                                 $SetStr1 = $StrCon[0];
                                 $SetStr2 = $StrCon[1];
                              @endphp
                              <a href="{{ route('legislation.store', [$SetStr1,$SetStr2]) }}" id="edit" class="btn btn-danger btn-sm" title="ส่งฟ้อง">
                                <span class="glyphicon glyphicon-edit"></span> ส่งฟ้อง
                              </a>
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
