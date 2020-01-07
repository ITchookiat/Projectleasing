@extends('layouts.master')
@section('title','ร้อมูลรถยนต์มือ 2')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 542;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.$m.'-'.$d;
@endphp

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      @if($type == 6)
        <h1>
          เร่งรัดหนี้สิน
          <small>ระบบสต็อกรถเร่งรัด</small>
        </h1>
      @elseif($type == 12)
        <h1>
          เร่งรัดหนี้สิน
          <small>ระบบปรับโครงสร้างหนี้</small>
        </h1>
      @endif
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          @if($type == 6)
            <h3 align="center"><b>เพิ่มข้อมูลรถยึด</b></h3>
          @elseif($type == 12)
            <ul class="nav nav-pills ml-auto p-2">
              <li class="nav-item"><a class="nav-link" href="{{ route('Precipitate',11) }}" onclick="return confirm('คุณต้องการออกไปหน้าหลักหรือไม่ ? \n')">หน้าหลัก</a></li>
              <li class="nav-item active"><a class="nav-link" href="#tab_1" data-toggle="tab">แบบฟอร์มผู้เช่าซื้อ</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">แบบฟอร์มผู้ค้ำ</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">แบบฟอร์มรถยนต์</a></li>
            </ul>
          @endif
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
          {{-- เช็คการกรอกข้อมูล --}}
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>กรุณากรอกข้อมูลอีกครั้ง ({{$error}}) </li>
                @endforeach
              </ul>
            </div>
          @endif

          @if($type == 6)
            <div class="row">
              <div class="col-md-12"> <br />
                <form name="form1" action="{{ route('MasterPrecipitate.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                  @csrf
                  <script>
                    function addCommas(nStr){
                    nStr += '';
                    x = nStr.split('.');
                    x1 = x[0];
                    x2 = x.length > 1 ? '.' + x[1] : '';
                    var rgx = /(\d+)(\d{3})/;
                    while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                    }
                    return x1 + x2;
                    }

                    function comma(){
                    var num11 = document.getElementById('Pricehold').value;
                    var num1 = num11.replace(",","");
                    document.form1.Pricehold.value = addCommas(num1);

                    var num22 = document.getElementById('Amounthold').value;
                    var num2 = num22.replace(",","");
                    document.form1.Amounthold.value = addCommas(num2);

                    var num33 = document.getElementById('Payhold').value;
                    var num3 = num33.replace(",","");
                    document.form1.Payhold.value = addCommas(num3);

                    var num44 = document.getElementById('CapitalAccount').value;
                    var num4 = num44.replace(",","");
                    document.form1.CapitalAccount.value = addCommas(num4);

                    var num55 = document.getElementById('CapitalTopprice').value;
                    var num5 = num55.replace(",","");
                    document.form1.CapitalTopprice.value = addCommas(num5);
                    }
                  </script>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>เลขที่สัญญา : </label>
                      <input type="text" name="Contno" class="form-control" style="width: 250px;" placeholder="ป้อนเลขที่สัญญา" required/>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ชื่อ - สกุล : </label>
                      <input type="text" name="NameCustomer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ - สกุล" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ยี่ห้อ : </label>
                      <select name="Brandcar" class="form-control" style="width: 250px;">
                        <option value="" disabled selected>--- เลือกยี่ห้อ ---</option>
                        <option value="ISUZU">ISUZU</option>
                        <option value="MITSUBISHI">MITSUBISHI</option>
                        <option value="TOYOTA">TOYOTA</option>
                        <option value="MAZDA">MAZDA</option>
                        <option value="FORD">FORD</option>
                        <option value="NISSAN">NISSAN</option>
                        <option value="HONDA">HONDA</option>
                        <option value="CHEVROLET">CHEVROLET</option>
                        <option value="MG">MG</option>
                        <option value="SUZUKI">SUZUKI</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ทะเบียน : </label>
                      <input type="text" name="Number_Regist" class="form-control" style="width: 250px;" placeholder="ป้อนทะเบียน" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ปี : </label>
                      <select name="Yearcar" class="form-control" style="width: 250px;">
                        <option value="" disabled selected>--- เลือกปี ---</option>
                         @php
                             $Year = date('Y');
                         @endphp
                         @for ($i = 0; $i < 30; $i++)
                             <option value="{{ $Year }}">{{ $Year }}</option>
                             @php
                                 $Year -= 1;
                             @endphp
                         @endfor
                      </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>วันที่ยึด : </label>
                      <input type="date" name="Datehold" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ทีมยึด : </label>
                      <select name="Teamhold" class="form-control" style="width: 250px">
                        <option selected disabled value="">---เลือกทีมยึด---</option>
                          <option value="102">102 - นายอับดุลเล๊าะ กาซอ</otion>
                          <option value="104">104 - นายอนุวัฒน์ อับดุลรานี</otion>
                          <option value="105">105 - นายธีรวัฒน์ เจ๊ะกา</otion>
                          <option value="112">112 - นายราชัน เจ๊ะกา</otion>
                          <option value="113">113 - นายฟิฏตรี วิชา</otion>
                          <option value="114">114 - นายอานันท์ กาซอ</otion>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ค่ายึด : </label>
                      <input type="text" id="Pricehold" name="Pricehold" class="form-control" style="width: 250px;" placeholder="ป้อนค่ายึด" oninput="comma();">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label><font color="red">สถานะรถ : </font></label>
                      <select name="Statuscar" class="form-control" style="width: 250px">
                        <option selected disabled value="">---เลือกสถานะ---</option>
                          <option value="1">ยึดจากลูกค้าครั้งแรก</otion>
                          <option value="2">ลูกค้ามารับรถคืน</otion>
                          <option value="3">ยึดจากลูกค้าครั้งที่สอง</otion>
                          <option value="4">รับรถจากของกลาง</otion>
                          <option value="5">ส่งรถบ้าน</otion>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>รายละเอียด : </label>
                      <textarea name="Note" class="form-control" placeholder="ป้อนรายละเอียด" rows="2" style="width: 250px;"></textarea>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>วันที่มารับรถคืน : </label>
                      <input type="date" name="Datecame" class="form-control" style="width: 250px;">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ค่างวดยึดค้าง : </label>
                      <input type="text" id="Amounthold" name="Amounthold" class="form-control" style="width: 250px;" placeholder="ป้อนค่างวดยึดค้าง" oninput="comma();" >
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ชำระค่างวดยึด : </label>
                      <input type="text" id="Payhold" name="Payhold" class="form-control" style="width: 250px;" placeholder="ป้อนชำระค่างวดยึด" oninput="comma();">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>วันที่เช็คต้นทุน : </label>
                      <input type="date" name="DatecheckCapital" class="form-control" style="width: 250px;">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>วันที่ส่งรถบ้าน : </label>
                      <input type="date" name="DatesendStockhome" class="form-control" style="width: 250px;">
                      </div>
                    </div>
                  </div>

                  <hr>
                  <h3 align="center"><b>ส่วนผู้เช่าซื้อ</b></h3>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>วันที่ส่งจดหมาย : </label>
                      <input type="date" name="DatesendLetter" class="form-control" style="width: 250px;">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>เลขบาร์โค๊ด : </label>
                      <input type="text" name="BarcodeNo" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบาร์โค๊ด">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ต้นทุนบัญชี : </label>
                      <input type="text" id="CapitalAccount" name="CapitalAccount" class="form-control" style="width: 250px;" placeholder="ป้อนต้นทุนบัญชี" oninput="comma();">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ต้นทุนยอดจัด : </label>
                      <input type="text" id="CapitalTopprice" name="CapitalTopprice" class="form-control" style="width: 250px;" placeholder="ป้อนต้นทุนยอดจัด" oninput="comma();">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>หมายเหตุ : </label>
                      <textarea name="Note2" class="form-control" placeholder="ป้อนหมายเหตุ" rows="2" style="width: 250px;"></textarea>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <h3 align="center"><b>ส่วนผู้ค้ำ</b></h3>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>จดหมาย : </label>
                      <input type="text" name="Letter" class="form-control" style="width: 250px;" placeholder="ป้อนจดหมาย">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                        <label>วันส่ง : </label>
                        <input type="date" name="Datesend" class="form-control" style="width: 250px;">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>บาร์โค๊ดผู้ค้ำ : </label>
                      <input type="text" name="Barcode2" class="form-control" style="width: 250px;" placeholder="ป้อนบาร์โค๊ด">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>รับ : </label>
                      <!-- <input type="text" name="Accept" class="form-control" style="width: 250px;" placeholder="ป้อนข้อมูล"> -->
                      <select name="Accept" class="form-control" style="width: 250px">
                        <option selected disabled value="">---เลือก---</option>
                          <option value="ได้รับ">ได้รับ</otion>
                          <option value="รอส่ง">รอส่ง</otion>
                          <option value="ส่งใหม่">ส่งใหม่</otion>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-inline" align="right">
                      <label>ขายได้ : </label>
                      <input type="text" name="Soldout" class="form-control" style="width: 250px;" readonly>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <input type="hidden" name="_token" value="{{csrf_token()}}" />
                  <input type="hidden" name="type" value="6" />

                  <div class="form-group">
                    <input type="hidden" readonly name="Cartype" value="{{ $type }}" class="form-control" />
                  </div>
                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 5) }}">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div>
                </form>
              </div>
            </div>
          @elseif($type == 12)
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <form name="form1" action="{{ route('MasterPrecipitate.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดผู้เช่าซื้อ</h3>
                                <br>
                                <div class="row">
                                   <div class="col-md-5">
                                     <div class="form-inline" align="right">
                                        <label><font color="red">เลขที่สัญญา : </font></label>
                                        <input type="text" name="Duebuyer" class="form-control" style="width: 250px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
                                      </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                        <label><font color="red">วันที่ทำสัญญา : </font></label>
                                        <input type="date" name="DueDate" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                      </div>
                                   </div>
                                </div>

                                <hr />
                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อ : </label>
                                      <input type="text" name="DueNamebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>นามสกุล : </label>
                                      <input type="text" name="Duelastbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนนามสกุล" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อเล่น : </label>
                                      <input type="text" name="DueNickbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานะ : </label>
                                      <select name="DueStatusbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- เลือกสถานะ ---</option>
                                        <option value="โสด">โสด</option>
                                        <option value="สมรส">สมรส</option>
                                        <option value="หย่าร้าง">หย่าร้าง</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      <input type="text" name="DuePhonebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                    </div>
                                  </div>


                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรอื่นๆ : </label>
                                      <input type="text" name="Phone2buyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>คู่สมรส : </label>
                                      <input type="text" name="DueMatebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ที่อยู่ : </label>
                                     <select name="DueAddressbuyer" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- เลือกที่อยู่ ---</option>
                                       <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                     </select>
                                   </div>
                                 </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                      <input type="text" name="DueAddNbuyer" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>รายละเอียดที่อยู่ : </label>
                                     <input type="text" name="DueStatusAddbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                   </div>
                                 </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>สถานที่ทำงาน : </label>
                                      <input type="text" name="DueWorkplacebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ลักษณะบ้าน : </label>
                                     <select name="DueHousebuyer" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                       <option value="บ้านตึก 1 ชั้น">บ้านตึก 1 ชั้น</option>
                                       <option value="บ้านตึก 2 ชั้น">บ้านตึก 2 ชั้น</option>
                                       <option value="บ้านไม้ 1 ชั้น">บ้านไม้ 1 ชั้น</option>
                                       <option value="บ้านไม้ 2 ชั้น">บ้านไม้ 2 ชั้น</option>
                                       <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                       <option value="แฟลต">แฟลต</option>
                                     </select>
                                   </div>
                                 </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>อาชีพ : </label>
                                      <select name="DueCareerbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- อาชีพ ---</option>
                                        <option value="ตำรวจ">ตำรวจ</option>
                                        <option value="ทหาร">ทหาร</option>
                                        <option value="ครู">ครู</option>
                                        <option value="ข้าราชการอื่นๆ">ข้าราชการอื่นๆ</option>
                                        <option value="ลูกจ้างเทศบาล">ลูกจ้างเทศบาล</option>
                                        <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                        <option value="สมาชิก อบต.">สมาชิก อบต.</option>
                                        <option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
                                        <option value="รับจ้าง">รับจ้าง</option>
                                        <option value="พนักงานบริษัทเอกชน">พนักงานบริษัทเอกชน</option>
                                        <option value="อาชีพอิสระ">อาชีพอิสระ</option>
                                        <option value="กำนัน">กำนัน</option>
                                        <option value="ผู้ใหญ่บ้าน">ผู้ใหญ่บ้าน</option>
                                        <option value="ผู้ช่วยผู้ใหญ่บ้าน">ผู้ช่วยผู้ใหญ่บ้าน</option>
                                        <option value="นักการภารโรง">นักการภารโรง</option>
                                        <option value="มอเตอร์ไซร์รับจ้าง">มอเตอร์ไซร์รับจ้าง</option>
                                        <option value="ค้าขาย">ค้าขาย</option>
                                        <option value="เจ้าของธุรกิจ">เจ้าของธุรกิจ</option>
                                        <option value="เจ้าของอู่รถ">เจ้าของอู่รถ</option>
                                        <option value="ให้เช่ารถบรรทุก">ให้เช่ารถบรรทุก</option>
                                        <option value="ช่างตัดผม">ช่างตัดผม</option>
                                        <option value="ชาวนา">ชาวนา</option>
                                        <option value="ชาวไร่">ชาวไร่</option>
                                        <option value="แม่บ้าน">แม่บ้าน</option>
                                        <option value="รับเหมาก่อสร้าง">รับเหมาก่อสร้าง</option>
                                        <option value="ประมง">ประมง</option>
                                        <option value="ทนายความ">ทนายความ</option>
                                        <option value="พระ">พระ</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>รายได้ : </label>
                                     <select name="DueIncomebuyer" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- รายได้ ---</option>
                                       <option value="5,000 - 10,000">5,000 - 10,000</option>
                                       <option value="10,000 - 15,000">10,000 - 15,000</option>
                                       <option value="15,000 - 20,000">15,000 - 20,000</option>
                                       <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                     </select>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประวัติการซื้อ/ค้ำ : </label>
                                      <select name="DuePurchasebuyer" class="form-control" style="width: 108px;">
                                        <option value="" selected>--- ซื้อ ---</option>
                                        <option value="0 คัน">0 คัน</option>
                                        <option value="1 คัน">1 คัน</option>
                                        <option value="2 คัน">2 คัน</option>
                                        <option value="3 คัน">3 คัน</option>
                                        <option value="4 คัน">4 คัน</option>
                                        <option value="5 คัน">5 คัน</option>
                                        <option value="6 คัน">6 คัน</option>
                                        <option value="7 คัน">7 คัน</option>
                                        <option value="8 คัน">8 คัน</option>
                                        <option value="9 คัน">9 คัน</option>
                                        <option value="10 คัน">10 คัน</option>
                                        <option value="11 คัน">11 คัน</option>
                                        <option value="12 คัน">12 คัน</option>
                                        <option value="13 คัน">13 คัน</option>
                                        <option value="14 คัน">14 คัน</option>
                                        <option value="15 คัน">15 คัน</option>
                                        <option value="16 คัน">16 คัน</option>
                                        <option value="17 คัน">17 คัน</option>
                                        <option value="18 คัน">18 คัน</option>
                                        <option value="19 คัน">19 คัน</option>
                                        <option value="20 คัน">20 คัน</option>
                                      </select>
                                      <label>ค้ำ : </label>
                                      <select name="DueSupportbuyer" class="form-control" style="width: 108px;">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        <option value="0 คัน">0 คัน</option>
                                        <option value="1 คัน">1 คัน</option>
                                        <option value="2 คัน">2 คัน</option>
                                        <option value="3 คัน">3 คัน</option>
                                        <option value="4 คัน">4 คัน</option>
                                        <option value="5 คัน">5 คัน</option>
                                        <option value="6 คัน">6 คัน</option>
                                        <option value="7 คัน">7 คัน</option>
                                        <option value="8 คัน">8 คัน</option>
                                        <option value="9 คัน">9 คัน</option>
                                        <option value="10 คัน">10 คัน</option>
                                        <option value="11 คัน">11 คัน</option>
                                        <option value="12 คัน">12 คัน</option>
                                        <option value="13 คัน">13 คัน</option>
                                        <option value="14 คัน">14 คัน</option>
                                        <option value="15 คัน">15 คัน</option>
                                        <option value="16 คัน">16 คัน</option>
                                        <option value="17 คัน">17 คัน</option>
                                        <option value="18 คัน">18 คัน</option>
                                        <option value="19 คัน">19 คัน</option>
                                        <option value="20 คัน">20 คัน</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <br>
                                <div class="row">
                                  <div class="col-md-12">
                                    <h3 class="text-center">รูปภาพประกอบ</h3>
                                    <div class="form-group">
                                      <div class="file-loading">
                                        <input id="image-file" type="file" name="Duefile_image[]" accept="image/*" data-min-file-count="1" multiple>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tab_2">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดผู้ค้ำ</h3>
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อ : </label>
                                       <input type="text" name="DuenameSP" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>นามสกุล : </label>
                                       <input type="text" name="DuelnameSP" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อเล่น : </label>
                                       <input type="text" name="DueniknameSP" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานะ : </label>
                                       <select name="DuestatusSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- สถานะ ---</option>
                                         <option value="โสด">โสด</option>
                                         <option value="สมรส">สมรส</option>
                                         <option value="หย่าร้าง">หย่าร้าง</option>
                                         <option value="เสียชีวิต">เสียชีวิต</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>เบอร์โทร : </label>
                                       <input type="text" name="DuetelSP" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ความสัมพันธ์ : </label>
                                       <select name="DuerelationSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ความสัมพันธ์ ---</option>
                                         <option value="พี่น้อง">พี่น้อง</option>
                                         <option value="ญาติ">ญาติ</option>
                                         <option value="เพื่อน">เพื่อน</option>
                                         <option value="บิดา">บิดา</option>
                                         <option value="มารดา">มารดา</option>
                                         <option value="บุตร">บุตร</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คู่สมรส : </label>
                                       <input type="text" name="DuemateSP" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ที่อยู่ : </label>
                                       <select name="DueaddSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ที่อยู่ ---</option>
                                         <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                       </select>
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                   <div class="form-inline" align="right">
                                       <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                       <input type="text" name="DueaddnowSP" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                   </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>รายละเอียดที่อยู่ : </label>
                                       <input type="text" name="DuestatusaddSP" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                   <div class="form-inline" align="right">
                                       <label>สถาที่ทำงาน : </label>
                                       <input type="text" name="DueworkplaceSP" class="form-control" style="width: 250px;" placeholder="สถาที่ทำงาน" />
                                   </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ลักษณะบ้าน : </label>
                                       <select name="DuehouseSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                         <option value="บ้านตึก 1 ชั้น">บ้านตึก 1 ชั้น</option>
                                         <option value="บ้านตึก 2 ชั้น">บ้านตึก 2 ชั้น</option>
                                         <option value="บ้านไม้ 1 ชั้น">บ้านไม้ 1 ชั้น</option>
                                         <option value="บ้านไม้ 2 ชั้น">บ้านไม้ 2 ชั้น</option>
                                         <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                         <option value="แฟลต">แฟลต</option>
                                       </select>
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>อาชีพ : </label>
                                         <select name="DuecareerSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- อาชีพ ---</option>
                                           <option value="ตำรวจ">ตำรวจ</option>
                                           <option value="ทหาร">ทหาร</option>
                                           <option value="ครู">ครู</option>
                                           <option value="ข้าราชการอื่น">ข้าราชการอื่น</option>
                                           <option value="ลูกจ้างเทศบาล">ลูกจ้างเทศบาล</option>
                                           <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                           <option value="สมาชิก อบต.">สมาชิก อบต.</option>
                                           <option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
                                           <option value="รับจ้าง">รับจ้าง</option>
                                           <option value="พนักงานบริษัทเอกชน">พนักงานบริษัทเอกชน</option>
                                           <option value="อาชีพอิสระ">อาชีพอิสระ</option>
                                           <option value="กำนัน">กำนัน</option>
                                           <option value="ผู้ใหญ่บ้าน">ผู้ใหญ่บ้าน</option>
                                           <option value="ผู้ช่วยผู้ใหญ่บ้าน">ผู้ช่วยผู้ใหญ่บ้าน</option>
                                           <option value="นักการภารโรง">นักการภารโรง</option>
                                           <option value="มอเตอร์ไซร์รับจ้าง">มอเตอร์ไซร์รับจ้าง</option>
                                           <option value="ค้าขาย">ค้าขาย</option>
                                           <option value="เจ้าของธุรกิจ">เจ้าของธุรกิจ</option>
                                           <option value="เจ้าของอู่รถ">เจ้าของอู่รถ</option>
                                           <option value="ให้เช่ารถบรรทุก">ให้เช่ารถบรรทุก</option>
                                           <option value="ช่างตัดผม">ช่างตัดผม</option>
                                           <option value="ชาวนา">ชาวนา</option>
                                           <option value="ชาวไร่">ชาวไร่</option>
                                           <option value="แม่บ้าน">แม่บ้าน</option>
                                           <option value="รับเหมาก่อสร้าง">รับเหมาก่อสร้าง</option>
                                           <option value="ประมง">ประมง</option>
                                           <option value="ทนายความ">ทนายความ</option>
                                           <option value="พระ">พระ</option>
                                         </select>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                          <label>รายได้ : </label>
                                          <select name="DueincomeSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- รายได้ ---</option>
                                            <option value="5,000 - 10,000">5,000 - 10,000</option>
                                            <option value="10,000 - 15,000">10,000 - 15,000</option>
                                            <option value="15,000 - 20,000">15,000 - 20,000</option>
                                            <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                          </select>
                                      </div>
                                    </div>
                                  </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ประวัติซื้อ/ค้ำ : </label>
                                       <select name="DuepuchaseSP" class="form-control" style="width: 108px;">
                                         <option value="" selected>--- ซื้อ ---</option>
                                         <option value="0 คัน">0 คัน</option>
                                         <option value="1 คัน">1 คัน</option>
                                         <option value="2 คัน">2 คัน</option>
                                         <option value="3 คัน">3 คัน</option>
                                         <option value="4 คัน">4 คัน</option>
                                         <option value="5 คัน">5 คัน</option>
                                         <option value="6 คัน">6 คัน</option>
                                         <option value="7 คัน">7 คัน</option>
                                         <option value="8 คัน">8 คัน</option>
                                         <option value="9 คัน">9 คัน</option>
                                         <option value="10 คัน">10 คัน</option>
                                         <option value="11 คัน">11 คัน</option>
                                         <option value="12 คัน">12 คัน</option>
                                         <option value="13 คัน">13 คัน</option>
                                         <option value="14 คัน">14 คัน</option>
                                         <option value="15 คัน">15 คัน</option>
                                         <option value="16 คัน">16 คัน</option>
                                         <option value="17 คัน">17 คัน</option>
                                         <option value="18 คัน">18 คัน</option>
                                         <option value="19 คัน">19 คัน</option>
                                         <option value="20 คัน">20 คัน</option>
                                       </select>
                                       <label>ค้ำ : </label>
                                       <select name="DuesupportSP" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          <option value="0 คัน">0 คัน</option>
                                          <option value="1 คัน">1 คัน</option>
                                          <option value="2 คัน">2 คัน</option>
                                          <option value="3 คัน">3 คัน</option>
                                          <option value="4 คัน">4 คัน</option>
                                          <option value="5 คัน">5 คัน</option>
                                          <option value="6 คัน">6 คัน</option>
                                          <option value="7 คัน">7 คัน</option>
                                          <option value="8 คัน">8 คัน</option>
                                          <option value="9 คัน">9 คัน</option>
                                          <option value="10 คัน">10 คัน</option>
                                          <option value="11 คัน">11 คัน</option>
                                          <option value="12 คัน">12 คัน</option>
                                          <option value="13 คัน">13 คัน</option>
                                          <option value="14 คัน">14 คัน</option>
                                          <option value="15 คัน">15 คัน</option>
                                          <option value="16 คัน">16 คัน</option>
                                          <option value="17 คัน">17 คัน</option>
                                          <option value="18 คัน">18 คัน</option>
                                          <option value="19 คัน">19 คัน</option>
                                          <option value="20 คัน">20 คัน</option>
                                       </select>
                                     </div>
                                   </div>
                                </div>
                              </div>
                              <div class="tab-pane" id="tab_3">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดรถยนต์</h3>
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ยี่ห้อ : </label>
                                      <select name="DuebrandHC" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ยี่ห้อ ---</option>
                                        <option value="ISUZU">ISUZU</option>
                                        <option value="MITSUBISHI">MITSUBISHI</option>
                                        <option value="TOYOTA">TOYOTA</option>
                                        <option value="MAZDA">MAZDA</option>
                                        <option value="FORD">FORD</option>
                                        <option value="NISSAN">NISSAN</option>
                                        <option value="HONDA">HONDA</option>
                                        <option value="CHEVROLET">CHEVROLET</option>
                                        <option value="MG">MG</option>
                                        <option value="SUZUKI">SUZUKI</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ปี : </label>
                                      <select name="DueyearHC" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- เลือกปี ---</option>
                                        @php
                                        $Year = date('Y');
                                        @endphp
                                        @for ($i = 0; $i < 25; $i++)
                                        <option value="{{ $Year }}">{{ $Year }}</option>
                                        @php
                                        $Year -= 1;
                                        @endphp
                                        @endfor
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>สี : </label>
                                      <input type="text" name="DuecolourHC" class="form-control" style="width: 250px;" placeholder="สี" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ป้ายเดิม : </label>
                                      <input type="text" name="DueoldplateHC" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม"/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ป้ายใหม่ : </label>
                                      <input type="text" name="DuenewplateHC" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เลขไมล์ : </label>
                                      <input type="text" name="DuemileHC" class="form-control" style="width: 250px;" placeholder="เลขไมล์" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รุ่น : </label>
                                      <input type="text" name="DuemodelHC" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประเภทรถ : </label>
                                      <select name="DuetypeHC" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ประเภทรถ ---</option>
                                        <option value="รถเทิร์น">รถเทิร์น</option>
                                        <option value="รถยึด">รถยึด</option>
                                        <option value="รถฝากขาย">รถฝากขาย</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <hr />
                                <script>
                                  function addCommas(nStr){
                                    nStr += '';
                                    x = nStr.split('.');
                                    x1 = x[0];
                                    x2 = x.length > 1 ? '.' + x[1] : '';
                                    var rgx = /(\d+)(\d{3})/;
                                    while (rgx.test(x1)) {
                                      x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                    }
                                    return x1 + x2;
                                  }

                                  function priceHomecar(){

                                    var num11 = document.getElementById('DuepriceHC').value;
                                    var num1 = num11.replace(",","");
                                    var num22 = document.getElementById('DuevatHC').value;
                                    var num2 = num22.replace(",","");
                                    var num33 = document.getElementById('DueinterestHC').value;
                                    var num3 = num33.replace(",","");
                                    var num44 = document.getElementById('DueperiodHC').value;
                                    var num4 = num44.replace(",","");


                                     var a = (num3*num4)+100;
                                     var b = (((num1*a)/100)*1.07)/num4; //ชำระต่องวด
                                     console.log(num1);
                                     console.log(b);

                                     var result = Math.ceil(b/10)*10;
                                     var durate = result/1.07;
                                     var durate2 = durate.toFixed(2)*num4;
                                     var tax = result-durate;
                                     var tax2 = tax.toFixed(2)*num4;
                                     var total = result*num4;
                                     var total2 = durate2+tax2;

                                     if(!isNaN(result)){
                                         document.form1.DuepayporHC.value = addCommas(result.toFixed(2));
                                         document.form1.Topcar.value = addCommas(totaltopcar);
                                         document.form1.TopcarOri.value = addCommas(num1);
                                         document.form1.Paymemtcar.value = addCommas(durate.toFixed(2));
                                         document.form1.Timepaymentcar.value = addCommas(durate2.toFixed(2));
                                         document.form1.Taxcar.value = addCommas(tax.toFixed(2));
                                         document.form1.Taxpaycar.value = addCommas(tax2.toFixed(2));
                                         document.form1.Totalpay1car.value = addCommas(total.toFixed(2));
                                         document.form1.Totalpay2car.value = addCommas(total2.toFixed(2));
                                         document.form1.P2Price.value = addCommas(num5);
                                         document.form1.tempTopcar.value = addCommas(totaltopcar);
                                         document.form1.P2PriceOri.value = addCommas(num5);
                                     }
                                  }
                                </script>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ราคารถ : </label>
                                      <input type="text" id="DuepriceHC" name="DuepriceHC" class="form-control" style="width: 250px;" placeholder="ราคารถ" oninput="priceHomecar()"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>VAT : </label>
                                      <input type="text" id="DuevatHC" name="DuevatHC" class="form-control" style="width: 250px;" value="7 %" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ดอกเบี้ยต่อเดือน : </label>
                                      <select id="DueinterestHC" name="DueinterestHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                        <option value="" selected>--- ดอกเบี้ย ---</option>
                                        <option value="0.55">0.55</option>
                                        <option value="0.65">0.65</option>
                                        <option value="0.70">0.70</option>
                                        <option value="0.75">0.75</option>
                                        <option value="0.85">0.85</option>
                                        <option value="1.00">1.00</option>
                                        <option value="1.20">1.20</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ระยะเวลาผ่อน : </label>
                                      <select id="DueperiodHC" name="DueperiodHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                        <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                                        <option value="12">12</option>
                                        <option value="18">18</option>
                                        <option value="24">24</option>
                                        <option value="30">30</option>
                                        <option value="36">36</option>
                                        <option value="42">42</option>
                                        <option value="48">48</option>
                                        <option value="54">54</option>
                                        <option value="60">60</option>
                                        <option value="66">66</option>
                                        <option value="72">72</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชำระต่องวด : </label>
                                      <input type="text" id="DuepayporHC" name="DuepayporHC" class="form-control" style="width: 250px;" readonly/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                      <input type="text" id="DuepaymentHC" name="DuepaymentHC" class="form-control" style="width: 123px;" readonly />
                                      <input type="text" id="DuepayperriodHC" name="DuepayperriodHC" class="form-control" style="width: 123px;" readonly />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ภาษี / ระยะเวลาผ่อน : </label>
                                      <input type="text" id="DuetaxHC" name="DuetaxHC" class="form-control" style="width: 123px;" readonly />
                                      <input type="text" id="DuetaxperriodHC" name="DuetaxperriodHC" class="form-control" style="width: 123px;" readonly />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ยอดผ่อนชำระทั้งหมด : </label>
                                      <input type="text" id="DuetotalinstalmentsHC" name="DuetotalinstalmentsHC" class="form-control" style="width: 123px;" readonly />
                                      <input type="text" id="Duetotalinstalments1HC" name="Duetotalinstalments1HC" class="form-control" style="width: 123px;" readonly />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>วันที่ชำระงวดแรก : </label>
                                      <input type="text" name="DuefirstpayHC" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประกันภัย : </label>
                                      <input type="text" name="DueinsuranceHC" class="form-control" style="width: 250px;" placeholder="ประกันภัย" />
                                    </div>
                                  </div>
                                </div>

                                <hr />
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-inline" align="center">
                                      <label>หมายเหตุ : </label>
                                      <textarea name="DuenotherHC" rows="3" cols="110"></textarea>
                                      <!-- <input type="text" name="otherHC" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/> -->
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>พนักงานขาย : </label>
                                      <select name="DuesaleHC" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- พนักงานขาย ---</option>
                                        <option value="เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์">เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</option>
                                        <option value="มาซีเตาะห์ แวสือนิ">มาซีเตาะห์ แวสือนิ</option>
                                        <option value="ขวัญตา เหมือนพยอม">ขวัญตา เหมือนพยอม</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ผู้ทำสัญญา : </label>
                                      <select name="DueMakerHC" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ผู้ทำสัญญา ---</option>
                                        <option value="เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์">เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</option>
                                        <option value="มาซีเตาะห์ แวสือนิ">มาซีเตาะห์ แวสือนิ</option>
                                        <option value="ขวัญตา เหมือนพยอม">ขวัญตา เหมือนพยอม</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                      <input type="hidden" name="_token" value="{{csrf_token()}}" />
                      <input type="hidden" name="type" value="12" />

                      <br>

                      <div class="form-group" align="center">
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',1) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      </div>
                    </form>

                  </div>
                </div>
            </div>
          @endif
        </div>

        <div class="box-footer"></div>
      </div>

      <script type="text/javascript">
          $("#image-file").fileinput({
            uploadUrl:"{{ route('MasterAnalysis.store') }}",
            theme:'fa',
            uploadExtraData:function(){
              return{
                _token:"{{csrf_token()}}",
              }
            },
            allowedFileExtensions:['jpg','png','gif'],
            maxFileSize:10240
          })
      </script>

      <script>
        $(function () {
          $('[data-mask]').inputmask()
        })
      </script>

      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

    </section>

@endsection
