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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

  <style>
    #todo-list{
    width:100%;
    margin:0 auto 50px auto;
    padding:5px;
    background:white;
    position:relative;
    /*box-shadow*/
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
          box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    /*border-radius*/
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
          border-radius:5px;
    }
    #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
          box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
    -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
    }
    .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
    -moz-box-shadow:0 2px 0 -1px #ebebeb;
          box-shadow:0 2px 0 -1px #ebebeb;
    }
    .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
          box-shadow:none;
    }
    input[type="checkbox"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
    }
    .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 2px);
    left:0;
    width:0%;
    height:1px;
    background:#cd4400;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    }
    .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
    -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
          box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
          border-radius:4px;
    }
    .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
    -moz-box-shadow:inset 0 0 0 2px #949494;
          box-shadow:inset 0 0 0 2px #949494;
    }
    .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
    }
    :checked + .todo{
    color:#717171;
    }
    :checked + .todo:before{
    width:100%;
    }
    :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
    -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
          box-shadow:inset 0 0 0 2px #0eb0b7;
    }
    :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
    }
    /* Delete Items */

    .delete-item{
    display:block;
    position:absolute;
    height:36px;
    width:36px;
    line-height:36px;
    right:0;
    top:0;
    text-align:center;
    color:#d8d8d8;
    opacity:0;
    }
    .todo-wrap:hover .delete-item{
    opacity:1;
    }
    .delete-item:hover{
    color:#cd4400;
    }
  </style>

  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <strong>สำเร็จ!</strong> {{ session()->get('success') }}
        </div>
      @endif

      <section class="content">
        <form name="form1" action="{{ route('MasterAnalysis.store') }}" method="post" id="formimage" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-inline">
                        <h4>เพิ่มข้อมูลสินเชื่อ...</h4>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                          <div class="float-right form-inline">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" id="1" class="checkbox" name="doccomplete" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                              <label for="1" class="todo">
                                <i class="fa fa-check"></i>
                                <span class="text"><font color="red">เอกสารครบ</font></span>
                              </label>
                            </span>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="card-tools d-inline float-right">
                            <button type="submit" class="delete-modal btn btn-success">
                              <i class="fas fa-save"></i> บันทึก
                            </button>
                            <a class="delete-modal btn btn-danger" href="{{ route('Analysis',1) }}">
                              <i class="far fa-window-close"></i> ยกเลิก
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('Analysis',1) }}" onclick="return confirm('คุณต้องการออกไปหน้าหลักหรือไม่ ? \n')">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" id="Sub-custom-tab1" data-toggle="pill" href="#Sub-tab1" role="tab" aria-controls="Sub-tab1" aria-selected="false">แบบฟอร์มผู้เช่าซื้อ</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab2" data-toggle="pill" href="#Sub-tab2" role="tab" aria-controls="Sub-tab2" aria-selected="false">แบบฟอร์มผู้ค้ำ</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab3" data-toggle="pill" href="#Sub-tab3" role="tab" aria-controls="Sub-tab3" aria-selected="false">แบบฟอร์มรถยนต์</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab4" data-toggle="pill" href="#Sub-tab4" role="tab" aria-controls="Sub-tab4" aria-selected="false">แบบฟอร์มค่าใช้จ่าย</a>
                        </li>
                      </ul>
                    </div>
                    {{-- เนื้อหา --}}
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดผู้เช่าซื้อ</h5>
                          <p></p>
                          <div>
                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label><font color="red">เลขที่สัญญา : </font></label>
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" required/>
                                  @else
                                    <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" required/>
                                  @endif
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label><font color="red">วันที่ทำสัญญา : </font></label>
                                  <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>ชื่อ : </label>
                                  <input type="text" name="Namebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>นามสกุล : </label>
                                  <input type="text" name="lastbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนนามสกุล" />
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>ชื่อเล่น : </label>
                                  <input type="text" name="Nickbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>เบอร์โทรศัพท์ : </label>
                                  <input type="text" name="Phonebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>เบอร์โทรอื่นๆ : </label>
                                  <input type="text" name="Phone2buyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>คู่สมรส : </label>
                                  <input type="text" name="Matebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>เลขบัตรประชาชน : </label>
                                  <input type="text" name="Idcardbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>ที่อยู่ : </label>
                                  <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- เลือกที่อยู่ ---</option>
                                    <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                  <input type="text" name="AddNbuyer" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>รายละเอียดที่อยู่ : </label>
                                  <input type="text" name="StatusAddbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>สถานที่ทำงาน : </label>
                                  <input type="text" name="Workplacebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>เลขที่โฉนด : </label>
                                  <input type="text" name="deednumberbuyer" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>เนื่อที่ : </label>
                                  <input type="text" name="areabuyer" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>หักค่าใช้จ่าย : </label>
                                  <input type="text" id="Beforeincome" name="Beforeincome" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>ประวัติการซื้อ/ค้ำ : </label>
                                  <select name="Purchasebuyer" class="form-control" style="width: 113px;">
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
                                  <select name="Supportbuyer" class="form-control" style="width: 113px;">
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
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>รายได้หลังหักค่าใช้จ่าย : </label>
                                  <input type="text" id="Afterincome" name="Afterincome" class="form-control" style="width: 250px;" placeholder="หลังหักค่าใช้จ่าย" oninput="income();" />
                                </div>
                              </div>
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>สถานะผู้เช่าซื้อ : </label>
                                  <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                    <option value="ลูกค้าเก่าผ่อนดี">ลูกค้าเก่าผ่อนดี</option>
                                    <option value="ลูกค้ามีงานตาม">ลูกค้ามีงานตาม</option>
                                    <option value="ลูกค้าใหม่">ลูกค้าใหม่</option>
                                    <option value="ลูกค้าใหม่(ปิดธนาคาร)">ลูกค้าใหม่(ปิดธนาคาร)</option>
                                    <option value="ปิดจัดใหม่(งานตาม)">ปิดจัดใหม่(งานตาม)</option>
                                    <option value="ปิดจัดใหม่(ผ่อนดี)">ปิดจัดใหม่(ผ่อนดี)</option>
                                  </select>
                              </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-5">
                                <div class="float-right form-inline">
                                  <label>วัตถุประสงค์ของสินเชื่อ : </label>
                                  <select name="objectivecar" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                    <option value="ลงทุนในธุรกิจ">ลงทุนในธุรกิจ</option>
                                    <option value="ขยายกิจการ">ขยายกิจการ</option>
                                    <option value="ซื้อรถยนต์">ซื้อรถยนต์</option>
                                    <option value="ใช้หนี้นอกระบบ">ใช้หนี้นอกระบบ</option>
                                    <option value="จ่ายค่าเทอม">จ่ายค่าเทอม</option>
                                    <option value="ซื้อของใช้ภายในบ้าน">ซื้อของใช้ภายในบ้าน</option>
                                    <option value="ซื้อวัว">ซื้อวัว</option>
                                    <option value="ซื้อที่ดิน">ซื้อที่ดิน</option>
                                    <option value="ซ่อมบ้าน">ซ่อมบ้าน</option>
                                  </select>
                              </div>
                              </div>
                            </div>

                            <hr>
                            <div class="row">
                              <div class="col-md-12">
                                <h5 class="text-center">รูปภาพประกอบ</h5>
                                <div class="form-group">
                                  <div class="file-loading">
                                    <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดผู้ค้ำ</h5>
                          <div class="float-right form-inline">
                            <a class="btn btn-default" title="เพิ่มข้อมูลผู้ค้ำที่ 2" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                              <i class="fa fa-users fa-lg"></i>
                            </a>
                          </div>
                          <br><br>
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ชื่อ : </label>
                                <input type="text" name="nameSP" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>นามสกุล : </label>
                                <input type="text" name="lnameSP" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ชื่อเล่น : </label>
                                <input type="text" name="niknameSP" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เบอร์โทร : </label>
                                <input type="text" name="telSP" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ความสัมพันธ์ : </label>
                                <select name="relationSP" class="form-control" style="width: 250px;">
                                  <option value="" selected>--- ความสัมพันธ์ ---</option>
                                  <option value="พี่น้อง">พี่น้อง</option>
                                  <option value="ญาติ">ญาติ</option>
                                  <option value="เพื่อน">เพื่อน</option>
                                  <option value="บิดา">บิดา</option>
                                  <option value="มารดา">มารดา</option>
                                  <option value="ตำบลเดี่ยวกัน">ตำบลเดี่ยวกัน</option>
                                  <option value="จ้างค้ำ(ไม่รู้จักกัน)">จ้างค้ำ(ไม่รู้จักกัน)</option>
                                </select>
                            </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>คู่สมรส : </label>
                                <input type="text" name="mateSP" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เลขบัตรประชาชน : </label>
                                <input type="text" name="idcardSP" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                            </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ที่อยู่ : </label>
                                <select name="addSP" class="form-control" style="width: 250px;">
                                  <option value="" selected>--- ที่อยู่ ---</option>
                                  <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                <input type="text" name="addnowSP" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>รายละเอียดที่อยู่ : </label>
                                <input type="text" name="statusaddSP" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>สถานที่ทำงาน : </label>
                                <input type="text" name="workplaceSP" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เลขที่โฉนด : </label>
                                <input type="text" name="deednumberSP" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เนื้อที่ : </label>
                                <input type="text" name="areaSP" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ประวัติซื้อ/ค้ำ : </label>
                                <select name="puchaseSP" class="form-control" style="width: 113px;">
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
                                <select name="supportSP" class="form-control" style="width: 113px;">
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
                        <div class="tab-pane fade" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดรถยนต์</h5>
                          <p></p>
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
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

                            <div class="col-5">
                              <div class="float-right form-inline">
                              <label>ประเภทรถ : </label>
                              <select id="Typecardetail" name="Typecardetail" class="form-control" style="width: 250px;" onchange="calculate();">
                                <option value="" selected>--- ประเภทรถ ---</option>
                                <option value="รถกระบะ">รถกระบะ</option>
                                <option value="รถตอนเดียว">รถตอนเดียว</option>
                                <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                              </select>
                            </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>สี : </label>
                                <input type="text" name="Colourcar" class="form-control" style="width: 250px;" placeholder="สี" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ปี : </label>
                                <select id="Yearcar" name="Yearcar" class="form-control" style="width: 250px;" onchange="calculate();">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ป้ายเดิม : </label>
                                <input type="text" name="Licensecar" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                              <label>กลุ่มปีรถยนต์ : </label>
                              <input type="text" id="Groupyearcar" name="Groupyearcar" class="form-control" style="width: 250px;" onchange="calculate();"/>
                            </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ป้ายใหม่ : </label>
                                <input type="text" name="Nowlicensecar" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เลขไมล์ : </label>
                                <input type="text" id="Milecar" name="Milecar" class="form-control" style="width: 250px;" placeholder="เลขไมล์" oninput="mile();" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>รุ่น : </label>
                                <input type="text" name="Modelcar" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ราคากลาง : </label>
                                <input type="text" id="Midpricecar" name="Midpricecar" class="form-control" style="width: 250px;" maxlength="9" placeholder="ราคากลาง" oninput="mile();percent();" />
                              </div>
                            </div>
                          </div>

                          <hr />
                          @include('analysis.script')

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ยอดจัด : </label>
                                <input type="text" id="Topcar" name="Topcar" class="form-control" style="width: 250px;" maxlength="9" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" />
                                <input type="hidden" id="TopcarOri" name="TopcarOri" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="balance();" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                  <label>ชำระต่องวด : </label>
                                  <input type="text" id="Paycar" name="Paycar" class="form-control" style="width: 250px;" readonly onchange="calculate()" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ระยะเวลาผ่อน : </label>
                                <input type="text" id="Year" class="form-control" style="width: 250px;" readonly />
                                <select id="Timeslackencar" name="Timeslackencar" class="form-control" style="width: 250px;display:none;" onchange="calculate();">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ภาษี / ระยะเวลาผ่อน : </label>
                                <input type="text" id="Taxcar" name="Taxcar" class="form-control" style="width: 125px;" readonly />
                                <input type="text" id="Taxpaycar" name="Taxpaycar" class="form-control" style="width: 125px;" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ดอกเบี้ย / ปี : </label>
                                <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" placeholder="ดอกเบี้ย" readonly onchange="calculate();"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                <input type="text" id="Paymemtcar" name="Paymemtcar" class="form-control" style="width: 125px;" readonly />
                                <input type="text" id="Timepaymentcar" name="Timepaymentcar" class="form-control" style="width: 125px;" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>VAT : </label>
                                <input type="text" id="Vatcar" name="Vatcar" class="form-control" style="width: 250px;" value="7 %" readonly onchange="calculate()"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ยอดผ่อนชำระทั้งหมด : </label>
                                <input type="text" id="Totalpay1car" name="Totalpay1car" class="form-control" style="width: 125px;" readonly />
                                <input type="text" id="Totalpay2car" name="Totalpay2car" class="form-control" style="width: 125px;" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ประกันภัย : </label>
                                <select id="Insurancecar" name="Insurancecar" class="form-control" style="width: 250px;" onchange="insurance();">
                                  <option value="" selected>--- ประกันภัย ---</option>
                                  <option value="มี ป2+ อยู่แล้ว">มี ป2+ อยู่แล้ว</option>
                                  <option value="ไม่ซื้อ">ไม่ซื้อ</option>
                                  <option value="ซื้อ ป2+ 1ป">ซื้อ ป2+ 1ปี</option>
                                  <option value="ซื้อ ป1 1ปี">ซื้อ ป1 1ปี</option>
                                  <option value="มี ป1 อยู่แล้ว">มี ป1 อยู่แล้ว</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เปอร์เซ็นจัดไฟแนนซ์ : </label>
                                <input type="text" id="Percentcar" name="Percentcar" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>วันที่ชำระงวดแรก : </label>
                                <input type="text" name="Dateduefirstcar" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <span class="todo-wrap">
                                    <input type="checkbox" id="2" name="Salemethod" value="on"/>
                                    <label for="2" class="todo">
                                      <i class="fa fa-check"></i>
                                      กรรมสิทธิ์ในแบบซื้อขาย
                                    </label>
                                </span>
                              </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ผู้รับเงิน : </label>
                                <input type="text" name="Payeecar" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เลขที่บัญชี : </label>
                                <input type="text" name="Accountbrancecar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีผู้รับเงิน" maxlength="15" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>สาขา : </label>
                                <input type="text" name="branchbrancecar" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="Tellbrancecar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <font color="red">(* กรณีเป็นพนักงาน) </font><label>แนะนำ/นายหน้า : </label>
                                <input type="text" id="Agentcar" name="Agentcar" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" oninput="commission();"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เลขที่บัญชี : </label>
                                <input type="text" name="Accountagentcar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีนายหน้า" maxlength="15" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ค่าคอม : </label>
                                <input type="text" id="Commissioncar" name="Commissioncar" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission();"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>สาขา : </label>
                                <input type="text" name="branchAgentcar" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                <select name="Purchasehistorycar" class="form-control" style="width: 113px;">
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
                                <select name="Supporthistorycar" class="form-control" style="width: 113px;">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="Tellagentcar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>หมายเหตุ : </label>
                                <input type="text" name="Notecar" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <!-- <label><font color="red">เจ้าหน้าที่สินเชื่อ : </font></label> -->
                                <input type="hidden" name="Loanofficercar" class="form-control" style="width: 250px;" value="{{ Auth::user()->name }}" readonly />
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                        <div class="tab-pane fade" id="Sub-tab4" role="tabpanel" aria-labelledby="Sub-custom-tab4">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดค่าใช้จ่าย</h5>
                          <p></p>
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>พรบ. : </label>
                                <input type="text" id="actPrice" name="actPrice" class="form-control" value="0" style="width: 250px;" placeholder="พรบ." oninput="balance()"/>
                                <!-- <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="พรบ."/> -->
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>เปอร์เซ็นต์ค่าคอม : </label>
                                <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="รวมยอดจัด" oninput="balance()" readonly/>
                                <input type="text" name="vatPrice" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ยอดปิดบัญชี : </label>
                                <input type="text" id="closeAccountPrice" name="closeAccountPrice" class="form-control" value="0" style="width: 250px;" placeholder="ยอดปิดบัญชี" oninput="balance()"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ซื้อ ป2+ / ป1 : </label>
                                <input type="text" id="P2Price" name="P2Price" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" oninput="balance();"/>
                                <input type="hidden" id="P2PriceOri" name="P2PriceOri" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();"/>
                              </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ค่าใช้จ่ายขนส่ง : </label>
                                <input type="text" id="tranPrice" name="tranPrice" class="form-control" value="0" style="width: 250px;" placeholder="ค่าใช้จ่ายขนส่ง" oninput="balance()"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>อื่นๆ : </label>
                                <input type="text" id="otherPrice" name="otherPrice" class="form-control" value="0" style="width: 250px;" placeholder="อื่นๆ" oninput="balance()"/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
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
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>อากร : </label>
                                <input type="text" id="dutyPrice" name="dutyPrice" class="form-control" style="width: 250px;" placeholder="1,500" value="1,500" readonly oninput="balance()"/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>ค่าการตลาด : </label>
                                <input type="text" id="marketingPrice" name="marketingPrice" class="form-control" style="width: 250px;"  placeholder="1,500" value="1,500" readonly oninput="balance()"/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>รวม คชจ. : </label>
                                <input type="text" id="totalkPrice" name="totalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance();" readonly/>
                                <input type="hidden" id="temptotalkPrice" name="temptotalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance();"/>
                              </div>
                            </div>
                          </div>

                          <hr>
                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>คงเหลือ : </label>
                                <input type="text" id="balancePrice" name="balancePrice" class="form-control" style="width: 250px;" placeholder="คงเหลือ" readonly/>
                              </div>
                            </div>
                            <div class="col-5">
                              <div class="float-right form-inline">
                                  <label>ค่าคอมหลังหัก 3% : </label>
                                  <input type="text" id="commitPrice" name="commitPrice" class="form-control" style="width: 250px;" placeholder="ค่าคอมหลังหัก" readonly/>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-5">
                              <div class="float-right form-inline">
                                <label>หมายเหตุ : </label>
                                <input type="text" name="notePrice" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <input type="hidden" name="patch_type" value="1">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />

                    <!-- แบบฟอร์มผู้ค้ำ 2 -->
                    <div class="modal fade" id="modal-default">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="card card-warning">
                              <div class="card-header">
                                <h4 class="card-title"><b>รายละเอียดผู้ค้ำที่ 2</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                            </div>

                            <div class="card-body">
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ชื่อ : </label>
                                    <input type="text" name="nameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>นามสกุล : </label>
                                    <input type="text" name="lnameSP2" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ชื่อเล่น : </label>
                                    <input type="text" name="niknameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เบอร์โทร : </label>
                                    <input type="text" name="telSP2" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ความสัมพันธ์ : </label>
                                    <select name="relationSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ความสัมพันธ์ ---</option>
                                      <option value="พี่น้อง">พี่น้อง</option>
                                      <option value="ญาติ">ญาติ</option>
                                      <option value="เพื่อน">เพื่อน</option>
                                      <option value="บิดา">บิดา</option>
                                      <option value="มารดา">มารดา</option>
                                      <option value="ตำบลเดี่ยวกัน">ตำบลเดี่ยวกัน</option>
                                      <option value="จ้างค้ำ(ไม่รู้จักกัน)">จ้างค้ำ(ไม่รู้จักกัน)</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>คู่สมรส : </label>
                                    <input type="text" name="mateSP2" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขบัตรประชาชน : </label>
                                    <input type="text" name="idcardSP2" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ : </label>
                                    <select name="addSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ที่อยู่ ---</option>
                                      <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                    <input type="text" name="addnowSP2" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>รายละเอียดที่อยู่ : </label>
                                    <input type="text" name="statusaddSP2" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>สถานที่ทำงาน : </label>
                                    <input type="text" name="workplaceSP2" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขที่โฉนด : </label>
                                    <input type="text" name="deednumberSP2" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เนื้อที่ : </label>
                                    <input type="text" name="areaSP2" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
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
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประวัติซื้อ : </label>
                                    <select name="puchaseSP2" class="form-control" style="width: 88px;">
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
                                    <select name="supportSP2" class="form-control" style="width: 88px;">
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
                            </div>
                            <div class="modal-footer justify-content-between float-right">
                              <button type="button" class="btn btn-success" data-dismiss="modal">บันทึก</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <a id="button"></a>
      </section>
    </div>
  </section>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>

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

@endsection
