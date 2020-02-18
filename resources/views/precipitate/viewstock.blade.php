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

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      @if($type == 5)
        <h1>
          เร่งรัดหนี้สิน
          <small>ระบบสต็อกรถเร่งรัด</small>
        </h1>
      @elseif($type == 11)
        <h1>
          เร่งรัดหนี้สิน
          <small>ระบบปรับโครงสร้างหนี้</small>
        </h1>
      @endif
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          @if($type == 5)
            <h4 class="card-title" align="center"><b>ระบบสต็อกรถเร่งรัด</b></h4>
          @elseif($type == 11)
            <h4 class="card-title" align="center"><b>ระบบปรับโครงสร้างหนี้</b></h4>
          @endif
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

            @if($type == 5)
              <form method="get" action="{{ route('Precipitate', 5) }}">
                <div align="right" class="form-inline">
                  <a href="{{ route('Precipitate', 6) }}" class="btn btn-primary btn-app">
                    <span class="fa fa-plus"></span> เพิ่มข้อมูล
                  </a>
                  <a target="_blank" href="{{ action('PrecController@excel') }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{5}}" class="btn btn-success btn-app">
                    <span class="fa fa-file-excel-o"></span> Excel
                  </a>
                  <a target="_blank" href="{{ action('PrecController@ReportPrecDue',[00,00]) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{5}}&Statuscar={{$Statuscar}}" class="btn btn-danger btn-app">
                    <span class="fa fa-file-pdf-o"></span> PDF
                  </a>
                  <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button >
                  <p></p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 150px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 150px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
                <div align="right" class="form-inline">
                  <label for="text" class="mr-sm-2">สถานะรถ : </label>
                  <select name="Statuscar" class="form-control mb-2 mr-sm-2" id="text" style="width: 360px">
                    <option selected disabled value="">---เลือกสถานะ---</option>
                      <option value="1" {{ ($Statuscar == '1') ? 'selected' : '' }}> ยึดจากลูกค้าครั้งแรก</otion>
                      <option value="2" {{ ($Statuscar == '2') ? 'selected' : '' }}> ลูกค้ามารับรถคืน</otion>
                      <option value="3" {{ ($Statuscar == '3') ? 'selected' : '' }}> ยึดจากลูกค้าครั้งที่สอง</otion>
                      <option value="4" {{ ($Statuscar == '4') ? 'selected' : '' }}> รับรถจากของกลาง</otion>
                      <option value="5" {{ ($Statuscar == '5') ? 'selected' : '' }}> ส่งรถบ้าน</otion>
                  </select>
                </div>
              </form>

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
                            <!-- <th class="text-center">ยี่ห้อ</th> -->
                            <th class="text-center" width="70px">ทะเบียน</th>
                            <!-- <th class="text-center">ปีรถ</th> -->
                            <th class="text-center" width="70px">วันที่ยึด</th>
                            <th class="text-center">ทีมยึด</th>
                            <th class="text-center">ค่ายึด</th>
                            <th class="text-center" width="150px">รายละเอียด</th>
                            <th class="text-center" width="110px">สถานะ</th>
                            <th class="text-center" width="100px">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key => $row)
                            <tr>
                              <td class="text-center"> {{ $key+1 }} </td>
                              <td class="text-center"> {{ $row->Contno_hold }} </td>
                              <td class="text-left"> {{ $row->Name_hold }} </td>
                              <!-- <td class="text-center"> {{ $row->Brandcar_hold }} </td> -->
                              <td class="text-center"> {{ $row->Number_Regist }} </td>
                              <!-- <td class="text-center"> {{ $row->Year_Product }} </td> -->
                              <td class="text-center"> {{ DateThai($row->Date_hold) }} </td>
                              <td class="text-center"> {{ $row->Team_hold }} </td>
                              <td class="text-right">
                                @if($row->Price_hold == Null)
                                 {{ $row->Price_hold }}
                                 @else
                                 {{ number_format($row->Price_hold, 2) }}
                                 @endif
                               </td>
                              <td class="text-left"> {{ $row->Note_hold }} </td>
                              <td class="text-center">
                                @if($row->Statuscar == 1)
                                ยึดจากลูกค้าครั้งแรก
                                @elseif($row->Statuscar == 2)
                                <font color="#FF33C1">ลูกค้ามารับรถคืน</font>
                                @elseif($row->Statuscar == 3)
                                <font color="#FF8B00">ยึดจากลูกค้าครั้งที่สอง</font>
                                @elseif($row->Statuscar == 4)
                                <font color="#001BFF">รับรถจากของกลาง</font>
                                @elseif($row->Statuscar == 5)
                                <font color="#046817">ส่งรถบ้าน</font>
                                @endif
                              </td>
                              <td class="text-center">
                                <!-- <a target="_blank" href="#" class="btn btn-info btn-sm" title="พิมพ์">
                                  <span class="glyphicon glyphicon-eye-open"></span> พิมพ์
                                </a> -->
                                <a href="{{ action('PrecController@edit',[$row->Hold_id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                                </a>
                                <div class="form-inline form-group">
                                  <form method="post" class="delete_form" action="{{ action('PrecController@destroy',[$row->Hold_id,$type]) }}">
                                  {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                      <span class="glyphicon glyphicon-trash"></span> ลบ
                                    </button>
                                  </form>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
             </div>
            @elseif($type == 11)
              <form method="get" action="{{ route('Precipitate', 11) }}">
                <div align="right" class="form-inline">
                  <a href="{{ route('Precipitate', 12) }}" class="btn btn-primary btn-app">
                    <span class="fa fa-plus"></span> เพิ่มข้อมูล
                  </a>
                  <!-- <a target="_blank" href="{{ action('PrecController@excel') }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{5}}" class="btn btn-success btn-app">
                    <span class="fa fa-file-excel-o"></span> Excel
                  </a>
                  <a target="_blank" href="{{ action('PrecController@ReportPrecDue',[00,00]) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{5}}&Statuscar={{$Statuscar}}" class="btn btn-danger btn-app">
                    <span class="fa fa-file-pdf-o"></span> PDF
                  </a> -->
                  <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button >
                  <p></p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 150px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 150px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
              </form>
            @endif

             <script type="text/javascript">
               $(document).ready(function() {
                 $('#table').DataTable();
               } );
             </script>

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>

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
