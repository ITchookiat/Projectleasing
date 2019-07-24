@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d', strtotime('-1 days'));
@endphp
@php
function DateThai($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("j",strtotime($strDate));

$strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay $strMonthThai $strYear";

}
function DateThai2($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("j",strtotime($strDate));

$strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay/$strMonthThai/$strYear";

}
@endphp

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        งานโทร
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 align="center"><b></b></h3> -->
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('call',1) }}">งานโทรประจำวัน</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('call',2) }}">งานโทรประจำเดือน</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('call',3) }}">ตรวจงานโทร</a>
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

              <form method="get" action="{{ route('call', 3) }}">
                <div align="right" class="form-inline">

                  <button type="submit" class="btn btn-warning btn-app">
                  <span class="glyphicon glyphicon-search"></span> Search
                  </button>
                  <p>
                  </p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: $date }}" class="form-control" />

                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: $date }}" class="form-control" />
                </div>
              </form>

              <hr>

            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-success pull-right">
              <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="true">ยอดประจำวัน</a></li>
              <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="false">ตรวจสอบ</a></li>
              <li class="pull-left header"><i class="fa fa-calendar"></i> วันที่ {{ DateThai($fdate) }}</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1">
                <!-- <b>How to use:</b> -->

                  <br>

                  <p align="center">ข้อมูลวันที่ {{DateThai2($fdate)}} ถึงวันที่ {{DateThai2($tdate)}}</p>
                  <br>
                  <table class="table table-bordered" style="width: 60%" align="center">
                    <thead class="thead-light bg-gray-light">
                      <tr>
                        <th><center>ชื่อสาขา</center></th>
                        <th><center>ข้อมูลที่บันทึก </center></th>
                        <th><center>ข้อมูลจาก SMART</center></th>
                        <th><center>มาชำระ</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><center>ปัตตานี (01)</center></td>
                        <td><center>{{ $sum_data_pt }}</center></td>
                        <td><center>{{ $sumpt }}</center></td>
                        <td><center>{{ $sum_data_pt - $sumpt }}</center></td>
                      </tr>
                      <tr>
                        <td><center>ยะลา (03)</center></td>
                        <td><center>{{ $sum_data_yl }}</center></td>
                        <td><center>{{ $sumyl }}</center></td>
                        <td><center>{{ $sum_data_yl - $sumyl }}</center></td>
                      </tr>
                      <tr>
                        <td><center>นราธิวาส (04)</center></td>
                        <td><center>{{ $sum_data_nr }}</center></td>
                        <td><center>{{ $sumnr }}</center></td>
                        <td><center>{{ $sum_data_nr - $sumnr }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สายบุรี (05)</center></td>
                        <td><center>{{ $sum_data_sb }}</center></td>
                        <td><center>{{ $sumsb }}</center></td>
                        <td><center>{{ $sum_data_sb - $sumsb }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สุไหงโก-ลก (06)</center></td>
                        <td><center>{{ $sum_data_kl }}</center></td>
                        <td><center>{{ $sumkl }}</center></td>
                        <td><center>{{ $sum_data_kl - $sumkl }}</center></td>
                      </tr>
                      <tr>
                        <td><center>เบตง (07)</center></td>
                        <td><center>{{ $sum_data_bt }}</center></td>
                        <td><center>{{ $sumbt }}</center></td>
                        <td><center>{{ $sum_data_bt - $sumbt }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (02)</center></td>
                        <td><center>{{ $sum_data_02 }}</center></td>
                        <td><center>{{ $sum02 }}</center></td>
                        <td><center>{{ $sum_data_02 - $sum02 }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (10)</center></td>
                        <td><center>{{ $sum_data_10 }}</center></td>
                        <td><center>{{ $sum10 }}</center></td>
                        <td><center>{{ $sum_data_10 - $sum10 }}</center></td>
                      </tr>
                      <tr>
                        <td><center><b><font color="red">รวมทั้งหมด</font></b></center></td>
                        <td><center><b><font color="red">{{ $sum_data_today }}</b></font></center></td>
                        <td><center><b><font color="red">{{ $sumall }}</b></font></center></td>
                        <td><center><b><font color="red">{{ $sum_data_today - $sumall }}</font></b></center></td>
                      </tr>
                    </tbody>
                  </table>


              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_2">
                <div class="row">
                  <div class="col-md-3">
                    <!-- แสดงทุกสาขา -->
                        <div class="table-responsive">
                          <br>
                          <!-- <a class="btn btn-info pull-right"><i class="fa fa-save fa-sm"></i> บันทึก </a> -->
                          <p align="left"><b>ข้อมูลที่บันทึก</b></p>
                         <table class="table table-bordered" id="table1">
                           <thead class="thead-dark" >
                             <tr>
                               <th class="text-center" style="width:50px">ลำดับ</th>
                               <th class="text-center">เลขสัญญา</th>
                               <!-- <th class="text-center">จ่าย</th> -->
                             </tr>
                           </thead>

                           <tbody>
                             @foreach($sum_for_all1 as $key => $row)
                               <tr>
                                 <td class="text-center">{{$key+1}}</td>
                                 <td class="text-center">{{$row->CONTNO}}</td>
                                 <!-- <td class="text-center">
                                   <input type="checkbox" value="1" />
                                 </td> -->
                               </tr>
                             @endforeach
                           </tbody>
                         </table>
                         </div>
                  </div>

                  <div class="col-md-5">
                        <div class="table-responsive">
                          <br>
                          <!-- <a class="btn btn-info pull-right"><i class="fa fa-save fa-sm"></i> บันทึก </a> -->

                          <form name="form1" action="{{ route('ReportCall.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                          <p align="left"><b>ข้อมูลจาก SMART</b>
                          <!-- @if($count_update_all2 != 0)
                          <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-refresh"></i> อัพเดทข้อมูล </button>
                          @endif
                          @foreach($sum_update_all2 as $key => $row)
                          <input type="hidden" name="" value="{{$key+1}}"/>
                          <input type="hidden" name="contno[]" value="{{$row->CONTNO}}"/>
                          <input type="hidden" name="date" value="{{ $fdate }}"/>
                          @endforeach -->
                          <input type="hidden" name="_token" value="{{csrf_token()}}" />
                          </p>
                        </form>

                         <table class="table table-bordered" id="table11">
                           <thead class="thead-dark" >
                             <tr>
                               <th class="text-center" style="width:50px">ลำดับ</th>
                               <th class="text-center">เลขสัญญา</th>
                               <th class="text-center">ชื่อลูกค้า</th>
                               <th class="text-center">วันดิวงวดแรก</th>
                               <!-- <th class="text-center">ค้างจริง</th> -->
                             </tr>
                           </thead>

                           <tbody>
                             @foreach($allbranch as $key => $row)
                               <tr>
                                 <td class="text-center">{{$key+1}}</td>
                                 @php
                                    $StrCon = explode("/",$row->CONTNO);
                                    $SetStr1 = $StrCon[0];
                                    $SetStr2 = $StrCon[1];

                                    $fdate = date_create($row->FDATE);
                                 @endphp
                                 <td class="text-center">{{$row->CONTNO}}</td>
                                 <td>{{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}}</td>
                                 <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                                 <!-- <td class="text-center">{{number_format($row->HLDNO,2)}}</td> -->
                               </tr>
                             @endforeach
                           </tbody>
                         </table>
                         </div>
                   </div>

                  <div class="col-md-4">

                    <form name="form1" action="{{ route('ReportCall.update', 3) }}" enctype="multipart/form-data">
                      @csrf
                    <!-- แสดงทุกสาขา -->
                        <div class="table-responsive">
                          <br>
                          <!-- <a class="btn btn-info pull-right"><i class="fa fa-save fa-sm"></i> บันทึก </a> -->
                          <p align="left"><b>มาชำระ</b>
                          @if($num2 != $count_ch_update)
                          <button class="btn btn-success btn-sm pull-right"><i class="fa fa-refresh"></i> อัพเดทข้อมูล </button>
                          @endif
                          </p>
                         <table class="table table-bordered" id="table111">
                           <thead class="thead-dark" >
                             <tr>
                               <th class="text-center" style="width:50px">ลำดับ</th>
                               <th class="text-center">เลขสัญญา</th>
                               <th class="text-center">ค้างจริง</th>
                               <th class="text-center">การชำระ</th>
                             </tr>
                           </thead>

                           <tbody>

                             @foreach($sum_for_all2 as $key => $row)
                               <tr>
                                 <td class="text-center">{{$key+1}}</td>
                                 @php
                                    $StrCon = explode("/",$row->CONTNO);
                                    $SetStr1 = $StrCon[0];
                                    $SetStr2 = $StrCon[1];
                                 @endphp
                                 <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                                 <input type="hidden" name="contno[]" value="{{$row->CONTNO}}" />

                                 @forelse ($datas as $data)
                                <td align="center"><input type="text" name="l_hldno[]" value="{{$data->HLDNO}}" style="width: 70px; border: none; text-align: center;" /></td>
                                @empty
                                <p> </p>
                                @endforelse
                                 <td class="text-center">
                                   <label class="con">
                                   <input type="checkbox" name="paid[]" value="1" checked>
                                   <span class="checkmark"></span>
                                   </label>
                                 </td>
                               </tr>
                             @endforeach
                           </tbody>
                         </table>
                         </div>

                       </form>
                  </div>
                </div>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>


                  <!-- <input type="hidden" name="_token" value="{{csrf_token()}}" />

                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                    <a class="delete-modal btn btn-danger">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div> -->

            </div>
            <!-- <div class="row"> -->
          </div>
            <!-- <div class="col-md-12"> -->

            <script type="text/javascript">
              $(function() {
                 $('#table1, #table11, #table111').DataTable(
                   {
                     "ordering" : false,
                     "lengthChange" : false,
                     "paging" : false,
                     "searching" : false,
                     "info" : true,
                     "autoWidth" : true,
                      "oLanguage": {
                      "sLengthMenu": "แสดง _MENU_ รายการ ต่อหนึ่งหน้า",
                      "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                      "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                      "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                      "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ รายการ)",
                      "oPaginate": {
                      "sFirst": "หน้าแรก",
                      "sPrevious": "ก่อนหน้า",
                      "sNext": "ถัดไป",
                      "sLast": "หน้าสุดท้าย"
                      },
                      "sSearch": "ค้นหา :"
                      }
                      } );
                      }
                 );
            </script>

            <script>
              $(".alert").fadeTo(3000, 500).slideUp(500, function(){
              $(".alert").alert('close');
              });
            </script>

        </div>

      </div>
    </section>

    <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <!-- send link to viewdetail page -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

@endsection
