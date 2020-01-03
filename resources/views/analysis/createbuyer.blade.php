@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date1 = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
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
      <h1>
        สินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link" href="{{ route('Analysis',1) }}" onclick="return confirm('คุณต้องการออกไปหน้าหลักหรือไม่ ? \n')">หน้าหลัก</a></li>
            <li class="nav-item active"><a class="nav-link" href="#tab_1" data-toggle="tab">แบบฟอร์มผู้เช่าซื้อ</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">แบบฟอร์มผู้ค้ำ</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">แบบฟอร์มรถยนต์</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">แบบฟอร์มค่าใช้จ่าย</a></li>
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

            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <form name="form1" action="{{ route('MasterAnalysis.store') }}" method="post" id="formimage" enctype="multipart/form-data">
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
                                        @if(auth::user()->type == 1 or auth::user()->type == 2)
                                          <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" required/>
                                        @else
                                          <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" required/>
                                        @endif
                                      </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                        <label><font color="red">วันที่ทำสัญญา : </font></label>
                                        <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                      </div>
                                   </div>
                                </div>

                                <hr />
                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อ : </label>
                                      <input type="text" name="Namebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>นามสกุล : </label>
                                      <input type="text" name="lastbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนนามสกุล" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อเล่น : </label>
                                      <input type="text" name="Nickbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานะ : </label>
                                      <select name="Statusbuyer" class="form-control" style="width: 250px;">
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
                                      <input type="text" name="Phonebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
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
                                      <input type="text" name="Matebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เลขบัตรประชาชน : </label>
                                      <input type="text" name="Idcardbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ที่อยู่ : </label>
                                      <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- เลือกที่อยู่ ---</option>
                                        <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                      <input type="text" name="AddNbuyer" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รายละเอียดที่อยู่ : </label>
                                      <input type="text" name="StatusAddbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานที่ทำงาน : </label>
                                      <input type="text" name="Workplacebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ลักษณะบ้าน : </label>
                                      <select name="Housebuyer" class="form-control" style="width: 250px;">
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

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประเภทหลักทรัพย์ : </label>
                                      <select name="securitiesbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        <option value="โฉนด">โฉนด</option>
                                        <option value="นส.3">นส.3</option>
                                        <option value="นส.3 ก">นส.3 ก</option>
                                        <option value="นส.4">นส.4</option>
                                        <option value="นส.4 จ">นส.4 จ</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>เลขที่โฉนด : </label>
                                      <input type="text" name="deednumberbuyer" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เนื่อที่ : </label>
                                      <input type="text" name="areabuyer" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประเภทบ้าน : </label>
                                      <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ประเภทบ้าน ---</option>
                                        <option value="ของตนเอง">ของตนเอง</option>
                                        <option value="อาศัยบิดา-มารดา">อาศัยบิดา-มารดา</option>
                                        <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                        <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                        <option value="บ้านเช่า">บ้านเช่า</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>อาชีพ : </label>
                                      <select name="Careerbuyer" class="form-control" style="width: 250px;">
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
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-inline" align="right">
                                         <label>รายได้ : </label>
                                         <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- รายได้ ---</option>
                                           <option value="5,000 - 10,000">5,000 - 10,000</option>
                                           <option value="10,000 - 15,000">10,000 - 15,000</option>
                                           <option value="15,000 - 20,000">15,000 - 20,000</option>
                                           <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                         </select>
                                       </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ใบขับขี่ : </label>
                                      <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- ใบขับขี่ ---</option>
                                        <option value="มี">มี</option>
                                        <option value="ไม่มี">ไม่มี</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>หักค่าใช้จ่าย : </label>
                                      <input type="text" id="Beforeincome" name="Beforeincome" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประวัติการซื้อ/ค้ำ : </label>
                                      <select name="Purchasebuyer" class="form-control" style="width: 108px;">
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
                                      <select name="Supportbuyer" class="form-control" style="width: 108px;">
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

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รายได้หลังหักค่าใช้จ่าย : </label>
                                      <input type="text" id="Afterincome" name="Afterincome" class="form-control" style="width: 250px;" placeholder="หลังหักค่าใช้จ่าย" oninput="income();" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานะผู้เช่าซื้อ : </label>
                                      <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                        <option value="ลูกค้าเก่าผ่อนดี">ลูกค้าเก่าผ่อนดี</option>
                                        <option value="ลูกค้ามีงานตาม">ลูกค้ามีงานตาม</option>
                                        <option value="ลูกค้าใหม่">ลูกค้าใหม่</option>
                                        <option value="ปิดจัดใหม่">ปิดจัดใหม่</option>
                                      </select>
                                   </div>
                                  </div>
                                </div>

                                <hr>
                                <div class="row">
                                  <div class="col-md-12">
                                    <h3 class="text-center">รูปภาพประกอบ</h3>
                                    <div class="form-group">
                                      <div class="file-loading">
                                        <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tab_2">
                                <a class="btn btn-default pull-right" title="เพิ่มข้อมูลผู้ค้ำที่ 2" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                                  <i class="fa fa-users fa-lg"></i>
                                </a>
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดผู้ค้ำ</h3>
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อ : </label>
                                       <input type="text" name="nameSP" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>นามสกุล : </label>
                                       <input type="text" name="lnameSP" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อเล่น : </label>
                                       <input type="text" name="niknameSP" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานะ : </label>
                                       <select name="statusSP" class="form-control" style="width: 250px;">
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
                                       <input type="text" name="telSP" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ความสัมพันธ์ : </label>
                                       <select name="relationSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ความสัมพันธ์ ---</option>
                                         <option value="พี่น้อง">พี่น้อง</option>
                                         <option value="ญาติ">ญาติ</option>
                                         <option value="เพื่อน">เพื่อน</option>
                                         <option value="บิดา">บิดา</option>
                                         <option value="มารดา">มารดา</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คู่สมรส : </label>
                                       <input type="text" name="mateSP" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขบัตรประชาชน : </label>
                                       <input type="text" name="idcardSP" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ที่อยู่ : </label>
                                         <select name="addSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ที่อยู่ ---</option>
                                           <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                         </select>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                         <input type="text" name="addnowSP" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                     </div>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>รายละเอียดที่อยู่ : </label>
                                       <input type="text" name="statusaddSP" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานที่ทำงาน : </label>
                                       <input type="text" name="workplaceSP" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ลักษณะบ้าน : </label>
                                         <select name="houseSP" class="form-control" style="width: 250px;">
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
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทหลักทรัพย์ : </label>
                                          <select name="securitiesSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                            <option value="โฉนด">โฉนด</option>
                                            <option value="นส.3">นส.3</option>
                                            <option value="นส.3 ก">นส.3 ก</option>
                                            <option value="นส.4">นส.4</option>
                                            <option value="นส.4 จ">นส.4 จ</option>
                                          </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>เลขที่โฉนด : </label>
                                          <input type="text" name="deednumberSP" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>เนื้อที่ : </label>
                                         <input type="text" name="areaSP" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทบ้าน : </label>
                                          <select name="housestyleSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            <option value="ของตนเอง">ของตนเอง</option>
                                            <option value="อาศัยบิดา">อาศัยบิดา-มารดา</option>
                                            <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                            <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                            <option value="บ้านเช่า">บ้านเช่า</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>อาชีพ : </label>
                                         <select name="careerSP" class="form-control" style="width: 250px;">
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
                                  </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                        <label>รายได้ : </label>
                                        <select name="incomeSP" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- รายได้ ---</option>
                                          <option value="5,000 - 10,000">5,000 - 10,000</option>
                                          <option value="10,000 - 15,000">10,000 - 15,000</option>
                                          <option value="15,000 - 20,000">15,000 - 20,000</option>
                                          <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                        </select>
                                    </div>
                                    </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ประวัติซื้อ/ค้ำ : </label>
                                       <select name="puchaseSP" class="form-control" style="width: 108px;">
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
                                       <select name="supportSP" class="form-control" style="width: 108px;">
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
                                       <select name="Brandcar" class="form-control" style="width: 250px;">
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
                                       <select name="Yearcar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกปี ---</option>
                                          @php
                                              $Year = date('Y');
                                          @endphp
                                          @for ($i = 0; $i < 20; $i++)
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
                                       <input type="text" name="Colourcar" class="form-control" style="width: 250px;" placeholder="สี" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ป้ายเดิม : </label>
                                       <input type="text" name="Licensecar" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม"/>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ป้ายใหม่ : </label>
                                       <input type="text" name="Nowlicensecar" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขไมล์ : </label>
                                       <input type="text" id="Milecar" name="Milecar" class="form-control" style="width: 250px;" placeholder="เลขไมล์" oninput="mile();" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>รุ่น : </label>
                                       <input type="text" name="Modelcar" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>ราคากลาง : </label>
                                        <input type="text" id="Midpricecar" name="Midpricecar" class="form-control" style="width: 250px;" placeholder="ราคากลาง" oninput="mile();percent();" />
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
                                    function income(){
                                      var num11 = document.getElementById('Beforeincome').value;
                                      var num1 = num11.replace(",","");
                                      var num22 = document.getElementById('Afterincome').value;
                                      var num2 = num22.replace(",","");
                                      document.form1.Beforeincome.value = addCommas(num1);
                                      document.form1.Afterincome.value = addCommas(num2);
                                    }
                                    function mile(){
                                      var num11 = document.getElementById('Milecar').value;
                                      var num1 = num11.replace(",","");
                                      var num22 = document.getElementById('Midpricecar').value;
                                      var num2 = num22.replace(",","");
                                      document.form1.Milecar.value = addCommas(num1);
                                      document.form1.Midpricecar.value = addCommas(num2);
                                    }
                                    function calculate(){
                                      var num11 = document.getElementById('Topcar').value;
                                      var num1 = num11.replace(",","");
                                      var num22 = document.getElementById('Interestcar').value;
                                      var num2 = num22.replace("%","");
                                      var num3 = document.getElementById('Vatcar').value;
                                      var num4 = document.getElementById('Timeslackencar').value;
                                      var num55 = document.getElementById('P2Price').value;
                                      var num5 = num55.replace(",","");
                                      var num66 = document.getElementById('P2PriceOri').value;
                                      var num6 = num66.replace(",","");
                                          if(num5 == ''){
                                            var num5 = 0;
                                          }else if (num5 == 0) {
                                            if (num6 > 6700) {
                                              var num1 = parseFloat(num1);
                                            }else {
                                              var num1 = parseFloat(num1) - parseFloat(num6);
                                            }
                                          }
                                         if(num5 > 6700){
                                           var totaltopcar = parseFloat(num1) - parseFloat(num6);
                                         }else {
                                           if (num5 == 0) {
                                             var totaltopcar = parseFloat(num1);
                                           }else {
                                             var totaltopcar = parseFloat(num1)+parseFloat(num5);
                                           }
                                         }
                                         console.log(num1);
                                         console.log(totaltopcar);
                                      var a = (num2*num4)+100;
                                      var b = (((totaltopcar*a)/100)*1.07)/num4;
                                      var result = Math.ceil(b/10)*10;
                                      var durate = result/1.07;
                                      var durate2 = durate.toFixed(2)*num4;
                                      var tax = result-durate;
                                      var tax2 = tax.toFixed(2)*num4;
                                      var total = result*num4;
                                      var total2 = durate2+tax2;
                                        if(!isNaN(result)){
                                            document.form1.Paycar.value = addCommas(result.toFixed(2));
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
                                    function commission(){
                                       var num11 = document.getElementById('Commissioncar').value;
                                       var num1 = num11.replace(",","");
                                       var input = document.getElementById('Agentcar').value;
                                       var Subtstr = input.split("");
                                      console.log(num1);
                                      console.log(Subtstr);
                                       var Setstr = Subtstr[0];
                                       if (Setstr[0] == "*") {
                                         var result = num1;
                                       }else {
                                         if(num1 > 999){
                                           if(num11 == ''){
                                             var num11 = 0;
                                           }
                                           else{
                                             var sumCom = (num1*0.03);
                                             var result = num1 - sumCom;
                                           }
                                         }else{
                                           var result = num1;
                                         }
                                       }
                                       if(!isNaN(num1)){
                                           document.form1.Commissioncar.value = addCommas(num1);
                                           document.form1.commitPrice.value =  addCommas(result);
                                      }
                                     }
                                     function balance(){
                                        var num11 = document.getElementById('tranPrice').value;
                                        var num1 = num11.replace(",","");
                                        var num22 = document.getElementById('otherPrice').value;
                                        var num2 = num22.replace(",","");
                                        var num33 = document.getElementById('evaluetionPrice').value;
                                        var num3 = num33.replace(",","");
                                        if(num33 == ''){
                                          var num3 = 0;
                                        }
                                        var num44 = document.getElementById('dutyPrice').value;
                                        var num4 = num44.replace(",","");
                                        var num55 = document.getElementById('marketingPrice').value;
                                        var num5 = num55.replace(",","");
                                        var num66 = document.getElementById('actPrice').value;
                                        var num6 = num66.replace(",","");
                                        var num77 = document.getElementById('closeAccountPrice').value;
                                        var num7 = num77.replace(",","");
                                        var num88 = document.getElementById('P2Price').value;
                                        var num8 = num88.replace(",","");
                                        var temp = document.getElementById('Topcar').value;
                                        var toptemp = temp.replace(",","");
                                        var ori = document.getElementById('Topcar').value;
                                        var Topori = ori.replace(",","");
                                        if(num8 > 6700){
                                        var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                                       }else{
                                         var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                                       }
                                        if(num8 > 6700){
                                        var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                                      }else {
                                        var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                                      }
                                        if(num88 == 0){
                                          var TotalBalance = parseFloat(toptemp)-result;
                                        }
                                        else if(num8 > 6700){
                                          var TotalBalance = parseFloat(toptemp)-result;
                                        }
                                        else{
                                          var TotalBalance = parseFloat(toptemp)-result;
                                        }
                                        if(!isNaN(result)){
                                            document.form1.totalkPrice.value = addCommas(tempresult);
                                            document.form1.temptotalkPrice.value = addCommas(result);
                                            document.form1.tranPrice.value = addCommas(num1);
                                            document.form1.otherPrice.value = addCommas(num2);
                                            document.form1.dutyPrice.value = addCommas(num4);
                                            document.form1.marketingPrice.value = addCommas(num5);
                                            document.form1.actPrice.value = addCommas(num6);
                                            document.form1.closeAccountPrice.value = addCommas(num7);
                                            document.form1.balancePrice.value = addCommas(TotalBalance);
                                        }
                                      }
                                        function percent(){
                                          var num11 = document.getElementById('Midpricecar').value;
                                          var num1 = num11.replace(",","");
                                          var num22 = document.getElementById('Topcar').value;
                                          var num2 = num22.replace(",","");
                                          var percent = (num2/num1) * 100;
                                          var result1 = percent;
                                            if(!isNaN(result1)){
                                                  document.form1.Percentcar.value = result1.toFixed(0);
                                                  document.form1.Topcar.value = addCommas(num2);
                                            }
                                          }
                                </script>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ยอดจัด : </label>
                                      <input type="text" id="Topcar" name="Topcar" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" />
                                      <input type="hidden" id="TopcarOri" name="TopcarOri" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="balance();" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>ชำระต่องวด : </label>
                                        <input type="text" id="Paycar" name="Paycar" class="form-control" style="width: 250px;" readonly onchange="calculate()" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                   <div class="form-inline" align="right">
                                       <label>VAT : </label>
                                       <input type="text" id="Vatcar" name="Vatcar" class="form-control" style="width: 250px;" value="7 %" readonly onchange="calculate()"/>
                                   </div>

                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>ภาษี / ระยะเวลาผ่อน : </label>
                                        <input type="text" id="Taxcar" name="Taxcar" class="form-control" style="width: 123px;" readonly />
                                        <input type="text" id="Taxpaycar" name="Taxpaycar" class="form-control" style="width: 123px;" readonly />
                                    </div>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ดอกเบี้ย : </label>
                                       <select id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" onchange="calculate()">
                                         <option value="" selected>--- ดอกเบี้ย ---</option>
                                         <option value="0.55">0.55</option>
                                         <option value="0.65">0.65</option>
                                         <option value="0.80">0.80</option>
                                         <option value="0.90">0.90</option>
                                         <option value="1.05">1.05</option>
                                         <option value="1.20">1.20</option>
                                         <option value="1.40">1.40</option>
                                         <option value="1.55">1.55</option>
                                         <option value="1.70">1.70</option>
                                       </select>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                       <input type="text" id="Paymemtcar" name="Paymemtcar" class="form-control" style="width: 123px;" readonly />
                                       <input type="text" id="Timepaymentcar" name="Timepaymentcar" class="form-control" style="width: 123px;" readonly />
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ระยะเวลาผ่อน : </label>
                                       <select id="Timeslackencar" name="Timeslackencar" class="form-control" style="width: 250px;" onchange="calculate()">
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
                                         <option value="78">78</option>
                                         <option value="84">84</option>
                                       </select>
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ยอดผ่อนชำระทั้งหมด : </label>
                                         <input type="text" id="Totalpay1car" name="Totalpay1car" class="form-control" style="width: 123px;" readonly />
                                         <input type="text" id="Totalpay2car" name="Totalpay2car" class="form-control" style="width: 123px;" readonly />
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>วันที่ชำระงวดแรก : </label>
                                       <input type="text" name="Dateduefirstcar" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ประกันภัย : </label>
                                       <select name="Insurancecar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ประกันภัย ---</option>
                                         <option value="แถม ป2+ 1ปี">แถม ป2+ 1ปี</option>
                                         <option value="ไม่แถม">ไม่แถม</option>
                                         <option value="ซื้อ ป2+ 1ป">ซื้อ ป2+ 1ปี</option>
                                         <option value="ซื้อ ป1 1ปี">ซื้อ ป1 1ปี</option>
                                         <option value="มี ป1 อยู่แล้ว">มี ป1 อยู่แล้ว</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>

                                <!-- <div class="row">
                                  <div class="col-md-5">

                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขกรมธรรม์ : </label>
                                       <input type="text" name="Insurancekey" class="form-control" style="width: 250px;" placeholder="เลขกรมธรรม์" />
                                   </div>
                                  </div>
                                </div> -->

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>แบบ : </label>
                                       <select name="statuscar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกแบบ ---</option>
                                         <option value="กส.ค้ำมีหลักทรัพย์">กส.ค้ำมีหลักทรัพย์</option>
                                         <option value="กส.ค้ำไม่มีหลักทรัพย์">กส.ค้ำไม่มีหลักทรัพย์</option>
                                         <option value="กส.ไม่ค้ำประกัน">กส.ไม่ค้ำประกัน</option>
                                         <option value="ซข.ค้ำมีหลักทรัพย์">ซข.ค้ำมีหลักทรัพย์</option>
                                         <option value="ซข.ค้ำไม่มีหลักทรัพย์">ซข.ค้ำไม่มีหลักทรัพย์</option>
                                         <option value="ซข.ไม่ค้ำประกัน">ซข.ไม่ค้ำประกัน</option>
                                         <option value="VIP1">VIP1</option>
                                       </select>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เปอร์เซ็นจัดไฟแนนซ์ : </label>
                                       <input type="text" id="Percentcar" name="Percentcar" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" />
                                   </div>
                                  </div>
                                </div>

                                <hr />
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ผู้รับเงิน : </label>
                                       <input type="text" name="Payeecar" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขที่บัญชี : </label>
                                       <input type="text" name="Accountbrancecar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีผู้รับเงิน" data-inputmask="&quot;mask&quot;:&quot;999-9-99999-9&quot;" data-mask="" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สาขา : </label>
                                      <input type="text" name="branchbrancecar" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      <input type="text" name="Tellbrancecar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <font color="red">(* กรณีเป็นพนักงาน) </font><label>แนะนำ/นายหน้า : </label>
                                       <input type="text" id="Agentcar" name="Agentcar" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" oninput="commission();"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขที่บัญชี : </label>
                                       <input type="text" name="Accountagentcar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีนายหน้า" data-inputmask="&quot;mask&quot;:&quot;999-9-99999-9&quot;" data-mask="" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ค่าคอม : </label>
                                      <input type="text" id="Commissioncar" name="Commissioncar" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission();"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สาขา : </label>
                                      <input type="text" name="branchAgentcar" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประวัติการซื้อ/ค้ำ : </label>
                                      <select name="Purchasehistorycar" class="form-control" style="width: 108px;">
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
                                      <select name="Supporthistorycar" class="form-control" style="width: 108px;">
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

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      <input type="text" name="Tellagentcar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>หมายเหตุ : </label>
                                      <input type="text" name="Notecar" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                  </div>
                                </div>

                                <hr />
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <!-- <label><font color="red">เจ้าหน้าที่สินเชื่อ : </font></label> -->
                                       <input type="hidden" name="Loanofficercar" class="form-control" style="width: 250px;" value="{{ Auth::user()->name }}" readonly />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <!-- <label><font color="red">สาขา : </font></label> -->
                                       @if(Auth::user()->branch == 99)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="Admin" readonly />
                                       @elseif(Auth::user()->branch == 01)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="ปัตตานี" readonly />
                                       @elseif(Auth::user()->branch == 03)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="ยะลา" readonly />
                                       @elseif(Auth::user()->branch == 04)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="นราธิวาส" readonly />
                                       @elseif(Auth::user()->branch == 05)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="สายบุรี" readonly />
                                       @elseif(Auth::user()->branch == 06)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="โกลก" readonly />
                                       @elseif(Auth::user()->branch == 07)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="เบตง" readonly />
                                       @endif
                                     </div>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tab_4">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดค่าใช้จ่าย</h3>
                                <br>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>พรบ. : </label>
                                       <input type="text" id="actPrice" name="actPrice" class="form-control" value="0" style="width: 250px;" placeholder="พรบ." oninput="balance()"/>
                                       <!-- <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="พรบ."/> -->
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เปอร์เซ็นต์ค่าคอม : </label>
                                       <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="รวมยอดจัด" oninput="balance()" readonly/>
                                       <input type="text" name="vatPrice" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ยอดปิดบัญชี : </label>
                                      <input type="text" id="closeAccountPrice" name="closeAccountPrice" class="form-control" value="0" style="width: 250px;" placeholder="ยอดปิดบัญชี" oninput="balance()"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ซื้อ ป2+ / ป1 : </label>
                                     <input type="text" id="P2Price" name="P2Price" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();"/>
                                     <input type="hidden" id="P2PriceOri" name="P2PriceOri" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate()"/>
                                   </div>
                                  </div>
                                </div>

                                <hr />
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ค่าใช้จ่ายขนส่ง : </label>
                                       <input type="text" id="tranPrice" name="tranPrice" class="form-control" value="0" style="width: 250px;" placeholder="ค่าใช้จ่ายขนส่ง" oninput="balance()"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>อื่นๆ : </label>
                                       <input type="text" id="otherPrice" name="otherPrice" class="form-control" value="0" style="width: 250px;" placeholder="อื่นๆ" oninput="balance()"/>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ค่าประเมิน : </label>
                                       <select id="evaluetionPrice" name="evaluetionPrice" class="form-control" style="width: 250px;" oninput="balance()">
                                         <option value="" selected>--- ค่าประเมิน ---</option>
                                         <option value="1,000">1,000</option>
                                         <option value="1,500">1,500</option>
                                         <option value="2,000">2,000</option>
                                         <option value="2,500">2,500</option>
                                       </select>

                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>อากร : </label>
                                     <input type="text" id="dutyPrice" name="dutyPrice" class="form-control" style="width: 250px;" placeholder="1,500" value="1,500" readonly oninput="balance()"/>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ค่าการตลาด : </label>
                                      <input type="text" id="marketingPrice" name="marketingPrice" class="form-control" style="width: 250px;"  placeholder="1,500" value="1,500" readonly oninput="balance()"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                       <label>รวม คชจ. : </label>
                                       <input type="text" id="totalkPrice" name="totalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance()" readonly/>
                                       <input type="hidden" id="temptotalkPrice" name="temptotalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance()"/>
                                     </div>
                                  </div>
                                </div>

                                <hr>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คงเหลือ : </label>
                                       <input type="text" id="balancePrice" name="balancePrice" class="form-control" style="width: 250px;" placeholder="คงเหลือ" readonly/>
                                     </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                        <label>ค่าคอมหลังหัก 3% : </label>
                                        <input type="text" id="commitPrice" name="commitPrice" class="form-control" style="width: 250px;" placeholder="ค่าคอมหลังหัก" readonly/>
                                      </div>
                                   </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>หมายเหตุ : </label>
                                       <input type="text" name="notePrice" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                     </div>
                                   </div>

                                   <div class="col-md-6">
                                   </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                      <input type="hidden" name="_token" value="{{csrf_token()}}" />
                      <br>

                      <table class="table table-bordered" id="table" border="3" align="center" style="width: 30%;" align="center">
                          <thead class="thead-dark">
                            <tr>
                              <th class="text-center"><font color="red"><h3>เอกสารครบ</h3></font></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th class="text-center">
                                <p></p>
                                <label class="con">
                                  <input type="checkbox" class="checkbox" name="doccomplete" id="" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                                <span class="checkmark"></span>
                                <p></p>
                                </label>
                              </th>
                            </tr>
                          </tbody>
                        </table>
                      <div class="form-group" align="center">
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',1) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      </div>

                      <!-- แบบฟอร์มผู้ค้ำ 2 -->
                      <div class="modal fade" id="modal-default">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" align="center">รายละเอียดผู้ค้ำที่ 2</h4>
                              </div>
                              <div class="modal-body">
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อ : </label>
                                       <input type="text" name="nameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>นามสกุล : </label>
                                       <input type="text" name="lnameSP2" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อเล่น : </label>
                                       <input type="text" name="niknameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>สถานะ : </label>
                                        <select name="statusSP2" class="form-control" style="width: 200px;">
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
                                       <input type="text" name="telSP2" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ความสัมพันธ์ : </label>
                                       <select name="relationSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- ความสัมพันธ์ ---</option>
                                         <option value="พี่น้อง">พี่น้อง</option>
                                         <option value="ญาติ">ญาติ</option>
                                         <option value="เพื่อน">เพื่อน</option>
                                         <option value="บิดา">บิดา</option>
                                         <option value="มารดา">มารดา</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คู่สมรส : </label>
                                       <input type="text" name="mateSP2" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขบัตรประชาชน : </label>
                                       <input type="text" name="idcardSP2" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ที่อยู่ : </label>
                                         <select name="addSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- ที่อยู่ ---</option>
                                           <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                         <input type="text" name="addnowSP2" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                     </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>รายละเอียดที่อยู่ : </label>
                                       <input type="text" name="statusaddSP2" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right"
                                   >
                                       <label>สถานที่ทำงาน : </label>
                                       <input type="text" name="workplaceSP2" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ลักษณะบ้าน : </label>
                                         <select name="houseSP2" class="form-control" style="width: 200px;">
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
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทหลักทรัพย์ : </label>
                                          <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                            <option value="โฉนด">โฉนด</option>
                                            <option value="นส.3">นส.3</option>
                                            <option value="นส.3 ก">นส.3 ก</option>
                                            <option value="นส.4">นส.4</option>
                                            <option value="นส.4 จ">นส.4 จ</option>
                                          </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>เลขที่โฉนด : </label>
                                          <input type="text" name="deednumberSP2" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>เนื้อที่ : </label>
                                         <input type="text" name="areaSP2" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทบ้าน : </label>
                                          <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            <option value="ของตนเอง">ของตนเอง</option>
                                            <option value="อาศัยบิดา">อาศัยบิดา-มารดา</option>
                                            <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                            <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                            <option value="บ้านเช่า">บ้านเช่า</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>อาชีพ : </label>
                                         <select name="careerSP2" class="form-control" style="width: 200px;">
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
                                  </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>รายได้ : </label>
                                          <select name="incomeSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- รายได้ ---</option>
                                            <option value="5,000 - 10,000">5,000 - 10,000</option>
                                            <option value="10,000 - 15,000">10,000 - 15,000</option>
                                            <option value="15,000 - 20,000">15,000 - 20,000</option>
                                            <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                          </select>
                                      </div>
                                      </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>ประวัติซื้อ : </label>
                                         <select name="puchaseSP2" class="form-control" style="width: 85px;">
                                           <option value="" selected>-ซื้อ-</option>
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
                                         <select name="supportSP2" class="form-control" style="width: 80px;">
                                            <option value="" selected>-ค้ำ-</option>
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
                              <hr>
                              <div class="footer" align="center">
                                <button type="button" class="btn btn-default" data-dismiss="modal">เสร็จ</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      <!-- แบบฟอร์มผู้ค้ำ 2 -->

                    </form>

                  </div>
                </div>

            </div>
          </div>

        </div>
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

      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

      <script>
        $(function () {
          $('[data-mask]').inputmask()
        })
      </script>

      <script>
          $(".float").on("keypress keyup blur",function (event) {
          //this.value = this.value.replace(/[^0-9\.]/g,'');
          $(this).val($(this).val().replace(/[^0-9\.]/g,''));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
          event.preventDefault();
          }
          });

          $(".int").on("keypress keyup blur",function (event) {
          $(this).val($(this).val().replace(/[^\d].+/, ""));
          if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
          }
          });

          $(function () {
          $('.cha').keydown(function (e) {
          if (e.shiftKey || e.ctrlKey || e.altKey) {
          e.preventDefault();
          } else {
          var key = e.keyCode;
          if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
          e.preventDefault();
          }
          }
          });
          });
      </script>

      {{csrf_field()}}
    </section>

@endsection
