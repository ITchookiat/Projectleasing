@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d', strtotime('-1 days'));

  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date2 = $Y.'-'.$m.'-'.$d;

  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay/$strMonthThai/$strYear";
  }
  function DateThai1($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }
@endphp

<link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
<script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- <section class="content-header">
      <h1>
        ปรับโครงสร้างหนี้
        <small>it all starts here</small>
      </h1>
    </section> -->
<style>
  input:read-only {
  background-color: yellow;
  }
</style>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4 align="center"><b>เช็คข้อมูลลูกค้าปรับโครงสร้างหนี้</b></h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12">
                <form method="get" action="{{ route('Analysis',10) }}">
                  <div align="right" class="form-inline">
                    <label>เลขที่สัญญา : </label>
                    @if($data == null)
                      <input type="type" name="Contno" maxlength="12" style="padding:5px;width:250px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                    @else
                      <input type="type" name="Contno" value="{{$Contno}}" maxlength="12" style="padding:5px;width:250px;border-radius: 5px 0 5px 5px; font-size:24px;"/>
                    @endif
                    <button type="submit" class="btn btn-warning btn-app">
                      <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                  </div>
                </form>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>เลขที่สัญญา : </label>
                        @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                        <input type="text" value="{{$data[0]->CONTNO}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ชื่อลูกค้า : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->SNAM))}}{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->NAME1))}}   {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->NAME2))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>

                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label><font color="red">อายุ</font> : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{$data[0]->AGE}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>วันทำสัญญา : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{DateThai1($data[0]->ISSUDT)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                    </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ที่อยู่ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',$data[0]->ADDRES)}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->PROVDES))}} {{$data[0]->ZIP}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>

                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>เบอร์โทร : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->TELP))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>เงินลงทุน : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{number_format($data[0]->NCARCST,2)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>จำนวดงวด : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{$data[0]->T_NOPAY}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ดอกเบี้ย : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 118px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{$data[0]->EFRATE}}" class="form-control" style="width: 118px;background-color:white;" readonly/>
                      @endif
                      <label>ต่อปี</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label><font color="red">ค่างวดละ</font> : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{number_format($data[0]->DAMT,2)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ชำระแล้ว : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{number_format($data[0]->SMPAY,2)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>คงเหลือ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{number_format($data[0]->BALANC - $data[0]->SMPAY,2)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>ผ่อนมาแล้ว : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 120px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{$dataPAYcount}}" class="form-control" style="width: 120px;background-color:white;" readonly/>
                        @endif
                        <label>งวด</label>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ผ่อนคงเหลือ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 120px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{$dataNOPAYcount}}" class="form-control" style="width: 120px;background-color:white;" readonly/>
                      @endif
                      <label>งวด</label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <!-- <label>เงินต้นใหม่ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{number_format(round(($data[0]->NCARCST / $data[0]->T_NOPAY)*$dataNOPAYcount),2)}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif -->
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>ยี่ห้อรถ : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->TYPE))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>รุ่นรถ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->MODEL))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>สีรถ : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->COLOR))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-inline" align="right">
                        <label>ทะเบียนรถ : </label>
                        @if($data == null)
                          <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @else
                          <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->REGNO))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                        @endif
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label><font color="red">ปีรถ</font> : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->MANUYR))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-inline" align="right">
                      <label>ขนาด cc : </label>
                      @if($data == null)
                        <input type="text" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @else
                        <input type="text" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data[0]->CC))}}" class="form-control" style="width: 150px;background-color:white;" readonly/>
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
                @if($data != null)
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <p><b>ตารางผ่อนชำระ</b></p>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table" align="center">
                           <thead class="thead-dark bg-gray-light" >
                             <tr>
                               <th class="text-center">งวดที่</th>
                               <th class="text-center">วันที่ดิว</th>
                               <th class="text-center">ค่างวด</th>
                               <th class="text-center">วันที่ชำระ</th>
                               <th class="text-center">ยอดชำระ</th>
                               <th class="text-center">เลขที่ใบกำกับ</th>
                               <th class="text-center">วันที่ใบกำกับ</th>
                               <th class="text-center">เงินต้น</th>
                               <th class="text-center">ดอกเบี้ย</th>
                             </tr>
                           </thead>
                           <tbody>
                             @foreach($data as $key => $row)
                                @if($row->DATE1 != null)
                                 <tr>
                                   <td class="text-center">{{$row->NOPAY}}</td>
                                   <td class="text-center">{{DateThai($row->DDATE)}}</td>
                                   <td class="text-center">{{number_format($row->DAMT,2)}}</td>
                                   @if($row->DATE1 != null)
                                     <td class="text-center">{{DateThai($row->DATE1)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   @if($row->PAYMENT != 0)
                                     <td class="text-center">{{number_format($row->PAYMENT,2)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   <td class="text-center">{{$row->TAXINV}}</td>
                                   @if($row->TAXDT != null)
                                     <td class="text-center">{{DateThai($row->TAXDT)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   <td class="text-center">{{number_format($row->TONEFFR,2)}}</td>
                                   <td class="text-center">{{number_format($row->INTEFFR,2)}}</td>
                                 </tr>
                                @else
                                 <tr style="color:red;">
                                   <td class="text-center">{{$row->NOPAY}}</td>
                                   <td class="text-center">{{DateThai($row->DDATE)}}</td>
                                   <td class="text-center">{{number_format($row->DAMT,2)}}</td>
                                   @if($row->DATE1 != null)
                                     <td class="text-center">{{DateThai($row->DATE1)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   @if($row->PAYMENT != 0)
                                     <td class="text-center">{{number_format($row->PAYMENT,2)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   <td class="text-center">{{$row->TAXINV}}</td>
                                   @if($row->TAXDT != null)
                                     <td class="text-center">{{DateThai($row->TAXDT)}}</td>
                                   @else
                                     <td class="text-center"></td>
                                   @endif
                                   <td class="text-center">{{number_format($row->TONEFFR,2)}}</td>
                                   <td class="text-center">{{number_format($row->INTEFFR,2)}}</td>
                                 </tr>
                                @endif
                              @endforeach
                           </tbody>
                         </table>
                    </div>
                  </div>
                @endif
              </div>
           </div>

        </div>

      </div>
    </section>

@endsection
