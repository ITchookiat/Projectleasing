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
    $date = $Y.'-'.$m.'-'.$d;
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
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <form name="form1" action="{{ route('MasterAnalysis.store') }}" method="post" id="formimage" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-inline">
                        <h4>เพิ่มรายการสินเชื่อรถบ้าน</h4>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card-tools d-inline float-right">
                        <button type="submit" class="delete-modal btn btn-success">
                          <i class="fas fa-save"></i> บันทึก
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',4) }}">
                          <i class="far fa-window-close"></i> ยกเลิก
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-3">
                        {{-- <h1 class="m-0 text-dark">Dashboard v2</h1> --}}
                      </div>
                      <div class="col-sm-9">
                        <ol class="breadcrumb float-sm-right">
                          {{-- ปิดสิทธ์แก้ไข / เอกสารครบ --}}
                          <div class="float-right form-inline">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" class="checkbox" id="1" name="branchUSHC" value="รถบ้าน"/>
                              <label for="1" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="red">รถบ้าน</font>
                              </label>
                            </span>
                          </div>
                          <div class="float-right form-inline">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" class="checkbox" id="2" name="branchUSHC" value="รถยืดขายผ่อน"/>
                              <label for="2" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="red">รถยึดขายผ่อน</font>
                              </label>
                            </span>
                          </div>
                        </ol>
                      </div>
                    </div>
                  </div>

                  <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link MainPage" href="{{ route('Analysis',4) }}">หน้าหลัก</a>
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
                              <div class="col-md-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Contract_buyer" class="form-control form-control-sm" required/>
                                    @else
                                      <input type="text" name="Contract_buyer" class="form-control form-control-sm" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" required/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ทำสัญญา : </font></label>
                                  <div class="col-sm-8">
                                    <input type="date" name="DateDue" class="form-control form-control-sm"  value="{{ date('Y-m-d') }}">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Namebuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="lastbuyer" class="form-control form-control-sm" placeholder="ป้อนนามสกุล" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Nickbuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                                  <div class="col-sm-8">
                                    <select name="Statusbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกสถานะ ---</option>
                                      <option value="โสด">โสด</option>
                                      <option value="สมรส">สมรส</option>
                                      <option value="หย่าร้าง">หย่าร้าง</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Phonebuyer" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6"> 
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรอื่นๆ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Phone2buyer" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Matebuyer" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ซื้อ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Idcardbuyer" class="form-control form-control-sm" placeholder="ป้อนเลขประชาชนผู้ซื้อ" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <select name="Addressbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกที่อยู่ ---</option>
                                      <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="AddNbuyer" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="StatusAddbuyer" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Workplacebuyer" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ลักษณะบ้าน : </label>
                                  <div class="col-sm-8">
                                    <select name="Housebuyer" class="form-control form-control-sm">
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
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ใบขับขี่ : </label>
                                  <div class="col-sm-8">
                                    <select name="Driverbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- ใบขับขี่ ---</option>
                                      <option value="มี">มี</option>
                                      <option value="ไม่มี">ไม่มี</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทบ้าน : </label>
                                  <div class="col-sm-8">
                                    <select name="HouseStylebuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทบ้าน ---</option>
                                      <option value="ของตนเอง">ของตนเอง</option>
                                      <option value="อาศัยบิดา-มารดา">อาศัยบิดา-มารดา</option>
                                      <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                      <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                      <option value="บ้านเช่า">บ้านเช่า</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                                  <div class="col-sm-8">
                                    <select name="Careerbuyer" class="form-control form-control-sm">
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
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายได้ : </label>
                                  <div class="col-sm-8">
                                    <select name="Incomebuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- รายได้ ---</option>
                                      <option value="5,000 - 10,000">5,000 - 10,000</option>
                                      <option value="10,000 - 15,000">10,000 - 15,000</option>
                                      <option value="15,000 - 20,000">15,000 - 20,000</option>
                                      <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติการซื้อ/ค้ำ : </label>
                                  <div class="col-sm-4">
                                    <select name="Purchasebuyer" class="form-control form-control-sm">
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
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="Supportbuyer" class="form-control form-control-sm">
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

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">หักค่าใช้จ่าย : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="Beforeincome" name="Beforeincome" class="form-control form-control-sm" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะผู้เช่าซื้อ : </label>
                                  <div class="col-sm-8">
                                    <select id="Gradebuyer" name="Gradebuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                      <option value="ลูกค้าเก่าผ่อนดี">ลูกค้าเก่าผ่อนดี</option>
                                      <option value="ลูกค้ามีงานตาม">ลูกค้ามีงานตาม</option>
                                      <option value="ลูกค้าใหม่">ลูกค้าใหม่</option>
                                      <option value="ปิดจัดใหม่">ปิดจัดใหม่</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายได้หลังหักค่าใช้จ่าย : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="Afterincome" name="Afterincome" class="form-control form-control-sm" placeholder="หลังหักค่าใช้จ่าย" oninput="income();" />
                                  </div>
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
                        </div>
                        <div class="tab-pane fade" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดผู้ค้ำ</h5>
                          <div class="float-right form-inline">
                            <a class="btn btn-default" title="เพิ่มข้อมูลผู้ค้ำที่ 2" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                              <i class="fa fa-users fa-lg"></i>
                            </a>
                          </div>
                          <br><br>
                          <div>
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="nameSP" class="form-control form-control-sm" placeholder="ชื่อ" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="lnameSP" class="form-control form-control-sm" placeholder="นามสกุล" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="niknameSP" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                                  <div class="col-sm-8">
                                    <select name="statusSP" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะ ---</option>
                                      <option value="โสด">โสด</option>
                                      <option value="สมรส">สมรส</option>
                                      <option value="หย่าร้าง">หย่าร้าง</option>
                                      <option value="เสียชีวิต">เสียชีวิต</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทร : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="telSP" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ความสัมพันธ์ : </label>
                                  <div class="col-sm-8">
                                    <select name="relationSP" class="form-control form-control-sm">
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
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="mateSP" class="form-control form-control-sm" placeholder="คู่สมรส" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ค่ำ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="idcardSP" class="form-control form-control-sm" placeholder="เลขบัตรประชาชนผู้ค่ำ" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <select name="addSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ที่อยู่ ---</option>
                                      <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="addnowSP" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="statusaddSP" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="workplaceSP" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ลักษณะบ้าน : </label>
                                  <div class="col-sm-8">
                                    <select name="houseSP" class="form-control form-control-sm">
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
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ : </label>
                                  <div class="col-sm-8">
                                    <select name="securitiesSP" class="form-control form-control-sm">
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
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="deednumberSP" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เนื้อที่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="areaSP" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทบ้าน : </label>
                                  <div class="col-sm-8">
                                    <select name="housestyleSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทบ้าน ---</option>
                                      <option value="ของตนเอง">ของตนเอง</option>
                                      <option value="อาศัยบิดา">อาศัยบิดา-มารดา</option>
                                      <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                      <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                      <option value="บ้านเช่า">บ้านเช่า</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                                  <div class="col-sm-8">
                                    <select name="careerSP" class="form-control form-control-sm">
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
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายได้ : </label>
                                  <div class="col-sm-8">
                                    <select name="incomeSP" class="form-control">
                                      <option value="" selected>--- รายได้ ---</option>
                                      <option value="5,000 - 10,000">5,000 - 10,000</option>
                                      <option value="10,000 - 15,000">10,000 - 15,000</option>
                                      <option value="15,000 - 20,000">15,000 - 20,000</option>
                                      <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติซื้อ/ค้ำ  : </label>
                                  <div class="col-sm-4">
                                    <select name="puchaseSP" class="form-control form-control-sm">
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
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="supportSP" class="form-control form-control-sm">
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
                          </div>
                        </div>
                        <div class="tab-pane fade" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                          <h5 class="text-center">แบบฟอร์มรายละเอียดรถยนต์</h5>
                          <p></p>
                          <div>
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                  <div class="col-sm-8">
                                    <select name="brandHC" class="form-control form-control-sm">
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
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ปี : </label>
                                  <div class="col-sm-8">
                                    <select name="yearHC" class="form-control form-control-sm">
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
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สี : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="colourHC" class="form-control form-control-sm" placeholder="สี" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ป้ายเดิม : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="oldplateHC" class="form-control form-control-sm" placeholder="ป้ายเดิม" required/>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ป้ายใหม่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="newplateHC" class="form-control form-control-sm" placeholder="ป้ายใหม่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขไมล์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="mileHC" class="form-control form-control-sm" placeholder="เลขไมล์" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รุ่น : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="modelHC" class="form-control form-control-sm" placeholder="รุ่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทรถ : </label>
                                  <div class="col-sm-8">
                                    <select name="typeHC" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทรถ ---</option>
                                      <option value="รถเทิร์น">รถเทิร์น</option>
                                      <option value="รถยึด">รถยึด</option>
                                      <option value="รถฝากขาย">รถฝากขาย</option>
                                      <option value="รถโมบายบริษัท">รถโมบายบริษัท</option>
                                    </select>
                                  </div>
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

                              function priceHomecar(){
                                var num11 = document.getElementById('priceHC').value;
                                var num1 = num11.replace(",","");
                                var num22 = document.getElementById('downpayHC').value;
                                var num2 = num22.replace(",","");
                                var num33 = document.getElementById('insurancefeeHC').value;
                                var num3 = num33.replace(",","");
                                var num44 = document.getElementById('transferHC').value;
                                var num4 = num44.replace(",","");
                                var num55 = document.getElementById('interestHC').value;
                                var num5 = num55.replace(",","");
                                var num66 = document.getElementById('periodHC').value;
                                var num6 = num66.replace(",","");

                                var price = parseFloat(num1) - parseFloat(num2);
                                var topprice = parseFloat(price) + parseFloat(num3) + parseFloat(num4);

                                var a = (num5*num6)+100;
                                var b = (((topprice*a)/100)*1.07)/num6;
                                var result = Math.ceil(b/10)*10;

                                var durate = result/1.07;
                                var durate2 = durate.toFixed(2)*num6;

                                var tax = result-durate;
                                var tax2 = tax.toFixed(2)*num6;

                                var total = result*num6;
                                var total2 = durate2+tax2;

                                document.form1.priceHC.value = addCommas(num1);
                                document.form1.downpayHC.value = addCommas(num2);

                                if(!isNaN(result)){
                                  document.form1.toppriceHC.value = addCommas(topprice);
                                  document.form1.payporHC.value = addCommas(result.toFixed(2));
                                  document.form1.paymentHC.value = addCommas(durate.toFixed(2));
                                  document.form1.payperriodHC.value = addCommas(durate2.toFixed(2));
                                  document.form1.taxHC.value = addCommas(tax.toFixed(2));
                                  document.form1.taxperriodHC.value = addCommas(tax2.toFixed(2));
                                  document.form1.totalinstalmentsHC.value = addCommas(total.toFixed(2));
                                  document.form1.totalinstalments1HC.value = addCommas(total2.toFixed(2));
                                }
                              }
                            </script>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ราคารถ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="priceHC" name="priceHC" class="form-control form-control-sm" placeholder="ราคารถ" oninput="priceHomecar()"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เงินดาวน์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="downpayHC" name="downpayHC" class="form-control form-control-sm" placeholder="เงินดาวน์" oninput="priceHomecar()"/>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่าประกัน : </label>
                                  <div class="col-sm-8">
                                    <select id="insurancefeeHC" name="insurancefeeHC" class="form-control form-control-sm" oninput="priceHomecar()">
                                      <option value="" selected>--- ค่าประกัน ---</option>
                                      <option value="0">ลูกค้าโอนเอง</option>
                                      <option value="7700">7,700</option>
                                      <option value="20000">20,000</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่าโอน : </label>
                                  <div class="col-sm-8">
                                    <select id="transferHC" name="transferHC" class="form-control form-control-sm" oninput="priceHomecar()">
                                      <option value="" selected>--- ค่าโอน ---</option>
                                      <option value="0">ลูกค้าโอนเอง</option>
                                      <option value="3950">3,950</option>
                                      <option value="4950">4,950</option>
                                      <option value="6590">6,590</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ยอดจัด : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="toppriceHC" name="toppriceHC" class="form-control form-control-sm" placeholder="กรอกยอดจัด" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย : </label>
                                  <div class="col-sm-8">
                                    <select id="interestHC" name="interestHC" class="form-control form-control-sm" oninput="priceHomecar()">
                                      <option value="" selected>--- ดอกเบี้ย ---</option>
                                      <option value="0.40">0.40</option>
                                      <option value="0.40">0.42</option>
                                      <option value="0.45">0.45</option>
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
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">VAT : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="vatHC" name="vatHC" class="form-control form-control-sm" value="7 %" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-8">
                                    <select id="periodHC" name="periodHC" class="form-control form-control-sm" oninput="priceHomecar()">
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
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชำระต่องวด : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="payporHC" name="payporHC" class="form-control form-control-sm" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่างวด/ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="paymentHC" name="paymentHC" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="payperriodHC" name="payperriodHC" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ภาษี/ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="taxHC" name="taxHC" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="taxperriodHC" name="taxperriodHC" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ยอดผ่อนชำระทั้งหมด : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="totalinstalmentsHC" name="totalinstalmentsHC" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="totalinstalments1HC" name="totalinstalments1HC" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <hr />
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">แบบ : </label>
                                  <div class="col-sm-8">
                                    <select name="baabHC" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะ ---</option>
                                      <option value="ซข.ค้ำมีหลักทรัพย์">ซข.ค้ำมีหลักทรัพย์</option>
                                      <option value="ซข.ค้ำไม่มีหลักทรัพย์">ซข.ค้ำไม่มีหลักทรัพย์</option>
                                      <option value="ซข.ไม่ค้ำประกัน">ซข.ไม่ค้ำประกัน</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค้ำประกัน : </label>
                                  <div class="col-sm-8">
                                    <select name="guaranteeHC" class="form-control form-control-sm">
                                      <option value="" selected>--- ค้ำประกัน ---</option>
                                      <option value="โฉนด">โฉนด</option>
                                      <option value="ข้าราชการ">ข้าราชการ</option>
                                      <option value="เจ้าบ้าน">เจ้าบ้าน</option>
                                      <option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
                                      <option value="ไม่ค้ำ">ไม่ค้ำ</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">วันที่ชำระงวดแรก : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="firstpayHC" class="form-control form-control-sm" readonly placeholder="วันที่ชำระงวดแรก" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประกันภัย : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="insuranceHC" class="form-control form-control-sm" placeholder="ประกันภัย" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <hr />
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">แนะนำ/นายหน้า : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="agentHC" class="form-control form-control-sm" placeholder="แนะนำ/นายหน้า" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="telHC" class="form-control form-control-sm" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่าคอม : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="commitHC" name="commitHC" class="form-control form-control-sm" placeholder="ค่าคอม"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติการซื้อ/ค้ำ : </label>
                                  <div class="col-sm-4">
                                    <select name="purchhisHC" class="form-control form-control-sm">
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
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="supporthisHC" class="form-control form-control-sm">
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

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="otherHC" class="form-control form-control-sm" placeholder="หมายเหตุ"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">พนักงานขาย : </label>
                                  <div class="col-sm-8">
                                    <select name="saleHC" class="form-control form-control-sm">
                                      <option value="" selected>--- พนักงานขาย ---</option>
                                      <option value="มารุวัน หะยีเจะแม">มารูวัน หะยีเจะแม</option>
                                      <option value="แวยูคิมสี อาแว">แวยูคิมสี อาแว</option>
                                      <option value="จิราวรรณ คงพัฒน์">จิราวรรณ คงพัฒน์</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <!-- <label>ผู้ทำสัญญา : </label> -->
                            <input type="hidden" name="contracHC" class="form-control form-control-sm" value="{{ Auth::user()->name }}" placeholder="ผู้ทำสัญญา" />

                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="patch_type" value="4">
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

                  <a id="button"></a>
                </div>
              </div>
            </div>
          </div>
        </form>
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

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>

@endsection
