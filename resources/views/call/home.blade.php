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
@endphp

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script src="src/jquery.tagsinput-revisited.js"></script>
<link rel="stylesheet" href="src/jquery.tagsinput-revisited.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('call',1) }}">งานโทรประจำวัน</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('call',2) }}">งานโทรประจำเดือน</a>
            </li>
            <li class="nav-item">
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

            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-success">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ยอดประจำวัน</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ทุกสาขา</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">สาขาปัตตานี (01) </a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">สาขายะลา (03)</a></li>
              <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">สาขานราธิวาส (04)</a></li>
              <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">สาขาสายบุรี (05)</a></li>
              <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">สาขาสุไงโกลก (06)</a></li>
              <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">สาขาเบตง (07)</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <!-- <b>How to use:</b> -->
                <br>
                <form>
                  <table class="table table-bordered" style="width: 60%" align="center">
                    <thead class="thead-light bg-gray-light">
                      <tr>
                        <th><center>ชื่อสาขา</center></th>
                        <th><center>ลูกค้าค้างค่างวด 1 - 1.49 งวด ดิววันที่ {{ DateThai($date)}} </center></th>
                        <th><center>คิดเป็น (%)</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><center>ปัตตานี (01)</center></td>
                        <td><center>{{ $sumpt }}</center></td>
                        <td><center>{{ number_format(($sumpt/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>ยะลา (03)</center></td>
                        <td><center>{{ $sumyl }}</center></td>
                        <td><center>{{ number_format(($sumyl/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>นราธิวาส (04)</center></td>
                        <td><center>{{ $sumnr }}</center></td>
                        <td><center>{{ number_format(($sumnr/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สายบุรี (05)</center></td>
                        <td><center>{{ $sumsb }}</center></td>
                        <td><center>{{ number_format(($sumsb/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สุไงโกลก (06)</center></td>
                        <td><center>{{ $sumkl }}</center></td>
                        <td><center>{{ number_format(($sumkl/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>เบตง (07)</center></td>
                        <td><center>{{ $sumbt }}</center></td>
                        <td><center>{{ number_format(($sumbt/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (02)</center></td>
                        <td><center>{{ $sum02 }}</center></td>
                        <td><center>{{ number_format(($sum02/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (10)</center></td>
                        <td><center>{{ $sum10 }}</center></td>
                        <td><center>{{ number_format(($sum10/$sumall)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center><b><font color="red">รวมทั้งหมด</font></b></center></td>
                        <td><center><b><font color="red">{{ $sumall }}</b></font></center></td>
                        <td><center><b><font color="red">{{ number_format(($sumall/$sumall)*100, 0).' %' }}</font></b></center></td>
                      </tr>
                    </tbody>
                  </table>
                </form>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">

                <!-- แสดงทุกสาขา -->
                    <div class="table-responsive">
                      <br>
                      <a class="btn btn-primary pull-right" href="{{ route('reportcall', 1) }}"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                      <!-- <a class="btn btn-info pull-right"><i class="fa fa-save fa-sm"></i> บันทึก </a> -->
                      <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}}</b></p>
                     <table class="table table-bordered" id="table1">
                       <thead class="thead-dark bg-gray-light" >
                         <tr>
                           <th class="text-center" style="width:50px">ลำดับ</th>
                           <th class="text-center">เลขสัญญา</th>
                           <th class="text-center">ชื่อลูกค้า</th>
                           <th class="text-center">วันดิวงวดแรก</th>
                           <th class="text-center">เบอร์โทร</th>
                           <th class="text-center">ค้างชำระ</th>
                           <th class="text-center" style="width:150px">หมายเหตุ</th>
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
                             <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                             <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                             <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                             <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                             <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                             <td class="text-right"> </td>
                           </tr>
                         @endforeach
                       </tbody>
                     </table>
                     </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">

                <!-- แสดงสาขา (ปัตตานี) -->
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ปัตตานี (01)</b></p>
                 <table class="table table-bordered" id="table2">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($ptbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (ปัตตานี) -->
                 <div class="table-responsive">
                   <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (ปัตตานี)</b></p>
                  <table class="table table-bordered" id="table22">
                    <thead class="thead-dark bg-gray-light" >
                      <tr>
                        <th class="text-center" style="width:50px">ลำดับ</th>
                        <th class="text-center">เลขสัญญา</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันดิวงวดแรก</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">ค้างชำระ</th>
                        <th class="text-center" style="width:150px">หมายเหตุ</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($count1 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">

                <!-- แสดงสาขา (ยะลา) -->
                 <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์ </a> -->
                  <p align="left"> <b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ยะลา (03)</b> </p>
                 <table class="table table-bordered" id="table3">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($ylbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (ยะลา) -->
                <div class="table-responsive">
                  <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (ยะลา)</b></p>
                  <table class="table table-bordered" id="table33">
                    <thead class="thead-dark bg-gray-light">
                      <tr>
                        <th class="text-center" style="width:50px">ลำดับ</th>
                        <th class="text-center">เลขสัญญา</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันดิวงวดแรก</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">ค้างชำระ</th>
                        <th class="text-center" style="width:150px">หมายเหตุ</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($count2 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_5">

                <!-- แสดงสาขา (นราธิวาส) -->
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา นราธิวาส (04)</b></p>
                 <table class="table table-bordered" id="table4">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($nrbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (นราธิวาส) -->
                 <div class="table-responsive">
                  <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (นราธิวาส)</b></p>
                  <table class="table table-bordered" id="table44">
                    <thead class="thead-dark bg-gray-light" >
                      <tr>
                        <th class="text-center" style="width:50px">ลำดับ</th>
                        <th class="text-center">เลขสัญญา</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันดิวงวดแรก</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">ค้างชำระ</th>
                        <th class="text-center" style="width:150px">หมายเหตุ</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($count3 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_6">

                <!-- แสดงสาขา (สายบุรี) -->
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สายบุรี (05)</b></p>
                 <table class="table table-bordered" id="table5">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($sbbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (สายบุรี) -->
                 <div class="table-responsive">
                  <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (สายบุรี)</b></p>
                  <table class="table table-bordered" id="table55">
                    <thead class="thead-dark bg-gray-light" >
                      <tr>
                        <th class="text-center" style="width:50px">ลำดับ</th>
                        <th class="text-center">เลขสัญญา</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันดิวงวดแรก</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">ค้างชำระ</th>
                        <th class="text-center" style="width:150px">หมายเหตุ</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($count4 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_7">

                <!-- แสดงสาขา สุไงโก-ลก -->
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สุไงโก-ลก (06)</b></p>
                 <table class="table table-bordered" id="table6">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($klbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (สุไงโก-ลก) -->
                 <div class="table-responsive">
                  <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (สุไงโก-ลก)</b></p>
                  <table class="table table-bordered" id="table66">
                    <thead class="thead-dark bg-gray-light" >
                      <tr>
                        <th class="text-center" style="width:50px">ลำดับ</th>
                        <th class="text-center">เลขสัญญา</th>
                        <th class="text-center">ชื่อลูกค้า</th>
                        <th class="text-center">วันดิวงวดแรก</th>
                        <th class="text-center">เบอร์โทร</th>
                        <th class="text-center">ค้างชำระ</th>
                        <th class="text-center" style="width:150px">หมายเหตุ</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($count5 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_8">

                <!-- แสดงสาขาเบตง -->
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา เบตง (07)</b></p>
                 <table class="table table-bordered" id="table7">
                   <thead class="thead-dark bg-gray-light" >
                     <tr>
                       <th class="text-center" style="width:50px">ลำดับ</th>
                       <th class="text-center">เลขสัญญา</th>
                       <th class="text-center">ชื่อลูกค้า</th>
                       <th class="text-center">วันดิวงวดแรก</th>
                       <th class="text-center">เบอร์โทร</th>
                       <th class="text-center">ค้างชำระ</th>
                       <th class="text-center" style="width:150px">หมายเหตุ</th>
                     </tr>
                   </thead>

                   <tbody>
                     @foreach($btbranch as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->CONTNO);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->FDATE);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                       <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                       <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                       <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                       <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                       <td class="text-right"> </td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
                 </div>

                 <hr>

                 <!-- แสดงงานโทรสาขา 02 และ 10 (เบตง) -->
                 <div class="table-responsive">
                   <p align="left"><b>งานโทรสาขา รหัส 02 และ 10 (เบตง)</b></p>
                   <table class="table table-bordered" id="table77">
                     <thead class="thead-dark bg-gray-light" >
                       <tr>
                         <th class="text-center" style="width:50px">ลำดับ</th>
                         <th class="text-center">เลขสัญญา</th>
                         <th class="text-center">ชื่อลูกค้า</th>
                         <th class="text-center">วันดิวงวดแรก</th>
                         <th class="text-center">เบอร์โทร</th>
                         <th class="text-center">ค้างชำระ</th>
                         <th class="text-center" style="width:150px">หมายเหตุ</th>
                       </tr>
                    </thead>

                    <tbody>
                      @foreach($count6 as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->CONTNO);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];

                           $fdate = date_create($row->FDATE);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->CONTNO}}</a></td>
                        <td>{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."   ".$row->NAME2)}}</td>
                        <td class="text-center">{{date_format($fdate, 'd-m-Y')}}</td>
                        <td>{{iconv('Tis-620','utf-8',$row->TELP)}}</td>
                        <td class="text-right">{{number_format($row->EXP_AMT, 2)}}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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
                 $('#table, #table1, #table2, #table22, #table3, #table33, #table4, #table44, #table5, #table55, #table6, #table6, #table7, #table77').DataTable(
                   {
                     "ordering" : false,
                     "lengthChange" : true,
                     // "pageLength": 25, //กำหนดแสดงข้อมูลเป็น 10 25 50 75 100
                     "paging" : false,
                     "searching" : false,
                     "info" : false,
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
