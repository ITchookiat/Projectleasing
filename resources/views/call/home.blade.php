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
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">สาขาปัตตานี (01) </a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">สาขายะลา (03)</a></li>
              <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">สาขานราธิวาส (04)</a></li>
              <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">สาขาสายบุรี (05)</a></li>
              <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">สาขาสุไหงโก-ลก (06)</a></li>
              <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">สาขาเบตง (07)</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">รวมทุกสาขา(ทุกรหัส)</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <!-- <b>How to use:</b> -->

                @if($check == 0)
                <br>
                <form name="form1" action="{{ route('ReportCall.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div align = "center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                  </div>
                      @foreach($allbranch as $key => $row)
                      <input type="hidden" name="contno[]" value="{{$row->CONTNO}}"/>
                      <input type="hidden" name="name[]" value="{{iconv('Tis-620','utf-8',$row->SNAM.$row->NAME1."     ".str_replace(" ", "", $row->NAME2))}}" />
                      <input type="hidden" name="fdate[]" value="{{$row->FDATE}}" />
                      <input type="hidden" name="tel[]" value="{{iconv('Tis-620','utf-8',str_replace(" ", "", $row->TELP))}}"/>
                      <input type="hidden" name="exp_amt[]" value="{{number_format($row->EXP_AMT, 2)}}" />
                      <input type="hidden" name="exp_frm[]" value="{{$row->EXP_FRM}}"/>
                      <input type="hidden" name="exp_to[]" value="{{$row->EXP_TO}}"/>
                      <input type="hidden" name="exp_prd[]" value="{{number_format($row->EXP_PRD, 2)}}"/>
                      <input type="hidden" name="hldno[]" value="{{number_format($row->HLDNO, 2)}}"/>
                      @endforeach
                      <input type="hidden" name="_token" value="{{csrf_token()}}" />

                </form>
                @endif
                  <br>
              @if($check != 0)
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
                        <td><center>{{ $sum_data_pt }}</center></td>
                        <td><center>{{ number_format(($sum_data_pt/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>ยะลา (03)</center></td>
                        <td><center>{{ $sum_data_yl }}</center></td>
                        <td><center>{{ number_format(($sum_data_yl/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>นราธิวาส (04)</center></td>
                        <td><center>{{ $sum_data_nr }}</center></td>
                        <td><center>{{ number_format(($sumnr/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สายบุรี (05)</center></td>
                        <td><center>{{ $sum_data_sb }}</center></td>
                        <td><center>{{ number_format(($sumsb/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>สุไหงโก-ลก (06)</center></td>
                        <td><center>{{ $sum_data_kl }}</center></td>
                        <td><center>{{ number_format(($sumkl/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>เบตง (07)</center></td>
                        <td><center>{{ $sum_data_bt }}</center></td>
                        <td><center>{{ number_format(($sumbt/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (02)</center></td>
                        <td><center>{{ $sum_data_02 }}</center></td>
                        <td><center>{{ number_format(($sum02/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center>รวม (10)</center></td>
                        <td><center>{{ $sum_data_10 }}</center></td>
                        <td><center>{{ number_format(($sum10/$sum_data_today)*100, 0).' %' }}</center></td>
                      </tr>
                      <tr>
                        <td><center><b><font color="red">รวมทั้งหมด</font></b></center></td>
                        <td><center><b><font color="red">{{ $sum_data_today }}</b></font></center></td>
                        <td><center><b><font color="red">{{ number_format(($sum_data_today/$sum_data_today)*100, 0).' %' }}</font></b></center></td>
                      </tr>
                    </tbody>
                  </table>
                  @endif

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">

                <!-- แสดงทุกสาขา -->
                    <div class="table-responsive">
                      <br>
                      <!-- <a class="btn btn-info pull-right"><i class="fa fa-save fa-sm"></i> บันทึก </a> -->
                      <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}}</b> <a class="btn btn-primary pull-right" href="{{ route('reportcall', 1) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a></p>
                      <br>
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
                         @foreach($data_all as $key => $row)
                           <tr>
                             <td class="text-center">{{$key+1}}</td>
                             @php
                                $StrCon = explode("/",$row->contno);
                                $SetStr1 = $StrCon[0];
                                $SetStr2 = $StrCon[1];
                                $fdate = date_create($row->fdate);
                             @endphp
                             <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                             <td>{{ $row->name }}</td>
                             <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                             <td>{{ $row->tel }}</td>
                             <td class="text-right">{{ $row->exp_amt }}</td>
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
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                <div class="table-responsive">
                  <br>
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ปัตตานี (01)</b>
                    @if($group01 == 0)
                    <input type="hidden" name="group" value="01" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                    <a class="btn btn-primary pull-right" href="{{ route('reportcall', 2) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>&nbsp;
                    @endif
                  </p>
                  <br>
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
                      @foreach($data_pt as $key => $row)
                        <tr>
                          <td class="text-center">{{$key+1}}</td>
                          @php
                             $StrCon = explode("/",$row->contno);
                             $SetStr1 = $StrCon[0];
                             $SetStr2 = $StrCon[1];
                             $fdate = date_create($row->fdate);
                          @endphp
                          <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                          <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                          <td>{{ $row->name }}</td>
                          <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                          <td>{{ $row->tel }}</td>
                          <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($pattani as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </form>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">
                <!-- แสดงสาขา (ยะลา) -->
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                 <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์ </a> -->
                  <p align="left"> <b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ยะลา (03)</b>
                    @if($group03 == 0)
                    <input type="hidden" name="group" value="03" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                     <a class="btn btn-primary pull-right" href="{{ route('reportcall', 3) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                    @endif
                   </p>
                  <br>
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
                     @foreach($data_yl as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->contno);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->fdate);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                       <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                       <td>{{ $row->name }}</td>
                       <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                       <td>{{ $row->tel }}</td>
                       <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($yala as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_5">
                <!-- แสดงสาขา (นราธิวาส) -->
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา นราธิวาส (04)</b>
                    @if($group04 == 0)
                    <input type="hidden" name="group" value="04" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                     <a class="btn btn-primary pull-right" href="{{ route('reportcall', 4) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                    @endif
                   </p>
                 <br>
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
                     @foreach($data_nr as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->contno);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];
                          $fdate = date_create($row->fdate);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                       <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                       <td>{{ $row->name }}</td>
                       <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                       <td>{{ $row->tel }}</td>
                       <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($nara as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_6">
                <!-- แสดงสาขา (สายบุรี) -->
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สายบุรี (05)</b>
                    @if($group05 == 0)
                    <input type="hidden" name="group" value="05" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                     <a class="btn btn-primary pull-right" href="{{ route('reportcall', 5) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                    @endif
                   </p>
                  <br>
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
                     @foreach($data_sb as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->contno);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];
                          $fdate = date_create($row->fdate);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                       <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                       <td>{{ $row->name }}</td>
                       <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                       <td>{{ $row->tel }}</td>
                       <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($saiburi as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_7">
                <!-- แสดงสาขา สุไงโก-ลก -->
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สุไงโก-ลก (06)</b>
                    @if($group06 == 0)
                    <input type="hidden" name="group" value="06" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                    <a class="btn btn-primary pull-right" href="{{ route('reportcall', 6) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                    @endif
                  </p>
                  <br>
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
                     @foreach($data_kl as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->contno);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];
                          $fdate = date_create($row->fdate);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                       <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                       <td>{{ $row->name }}</td>
                       <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                       <td>{{ $row->tel }}</td>
                       <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($kolok as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_8">
                <!-- แสดงสาขาเบตง -->
                <form name="form1" action="{{ route('updategroup', 1) }}" enctype="multipart/form-data">
                <div class="table-responsive">
                  <br>
                  <!-- <a class="btn btn-primary pull-right"><i class="fa fa-print fa-sm"></i> พิมพ์</a> -->
                  <p align="left"><b>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา เบตง (07)</b>
                    @if($group07 == 0)
                    <input type="hidden" name="group" value="07" />
                    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exclamation fa-sm"></i> จัดกลุ่ม </button>
                    @else
                    <a class="btn btn-primary pull-right" href="{{ route('reportcall', 7) }}" target="_blank"><i class="fa fa-print fa-sm"></i> พิมพ์ </a>
                    @endif
                  </p>
                  <br>
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
                     @foreach($data_bt as $key => $row)
                     <tr>
                       <td class="text-center">{{$key+1}}</td>
                       @php
                          $StrCon = explode("/",$row->contno);
                          $SetStr1 = $StrCon[0];
                          $SetStr2 = $StrCon[1];

                          $fdate = date_create($row->fdate);
                       @endphp
                       <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                       <input type="hidden" name="contno1[]" value="{{$row->contno}}" />
                       <td>{{ $row->name }}</td>
                       <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                       <td>{{ $row->tel }}</td>
                       <td class="text-right">{{ $row->exp_amt }}</td>
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
                      @foreach($betong as $key => $row)
                      <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @php
                           $StrCon = explode("/",$row->contno);
                           $SetStr1 = $StrCon[0];
                           $SetStr2 = $StrCon[1];
                           $fdate = date_create($row->fdate);
                        @endphp
                        <td class="text-center"><a href="{{ route('callDetail.viewdetail', [$SetStr1,$SetStr2]) }}" data-toggle="modal" data-target="#modal-default">{{$row->contno}}</a></td>
                        <input type="hidden" name="contno2[]" value="{{$row->contno}}" />
                        <td>{{ $row->name }}</td>
                        <td class="text-center">{{ date_format($fdate, 'd-m-Y') }}</td>
                        <td>{{ $row->tel }}</td>
                        <td class="text-right">{{ $row->exp_amt }}</td>
                        <td class="text-right"> </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

                  <!-- <div class="form-group" align="center">
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
                 $('#table1, #table2, #table22, #table3, #table33, #table4, #table44, #table5, #table55, #table6, #table66, #table7, #table77').DataTable(
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
