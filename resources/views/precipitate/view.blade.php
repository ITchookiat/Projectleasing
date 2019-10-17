@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        เร่งรัดหนี้สิน
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          <h4 class="card-title" align="center"><b>ระบบข้อมูลติดตาม</b></h4>

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
                 <hr>
                 <div class="table-responsive">
                   <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">ชำระล่าสุด</th>
                          <th class="text-center">งวดละ</th>
                          <th class="text-center">ค้างชำระ</th>
                          <th class="text-center">งวดจริง</th>
                          <th class="text-center">คงเหลือ</th>
                          <th class="text-center">เลขทะเบียน</th>
                          <th class="text-center">พนง</th>
                          <th class="text-center">สถานะ</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center"> {{$row->CONTNO}}</td>
                            <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                            <td class="text-center"> {{$row->LPAYD}} </td>
                            <td class="text-center"> {{$row->DAMT}} </td>
                            <td class="text-center"> {{$row->EXP_AMT}} </td>
                            <td class="text-center"> {{$row->HLDNO}} </td>
                            <td class="text-center"> {{$row->BALANC - $row->SMPAY}} </td>
                            <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->REGNO)) }} </td>
                            <td class="text-center"> {{$row->BILLCOLL}} </td>
                            <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
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
