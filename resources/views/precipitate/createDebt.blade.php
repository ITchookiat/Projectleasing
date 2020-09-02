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
    #mydiv {
      position: absolute;
      z-index: 9;
      text-align: center;
      width:300px;
      right: 500px;
      top: 10px;
    }
    #mydivheader {
      /* padding: 10px; */
      cursor: move;
      z-index: 10;
    }
  </style>

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
          border-radius:5px;}
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
    top:calc(50% + 10px);
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
        <div class="card">
          <div class="card-header">
            @if($data != null)
              <div id="mydiv">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">ข้อมูลเพิ่มเติม</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="card-body" style="display: none;">
                    <div class="float-right form-inline">
                      <label><font color="red">อายุ</font> : </label>
                      <input type="text" value="{{$data->AGE}}" class="form-control" style="width: 110px;background-color:white;"/>
                    </div>
                    <br><p></p>
                    <div class="float-right form-inline">
                      <label>เงินลงทุน : </label>
                      <input type="text" value="{{number_format($data->NCARCST,2)}}" class="form-control" style="width: 110px;background-color:white;" readonly/>
                    </div>
                    <br><p></p>
                    <div class="float-right form-inline">
                      <label><font color="red">ค่างวดละ</font> : </label>
                      <input type="text" value="{{number_format($data->DAMT,2)}}" class="form-control" style="width: 110px;background-color:white;" readonly/>
                    </div>
                    <br><p></p>
                    <div class="float-right form-inline">
                      <label>ชำระแล้ว : </label>
                      <input type="text" value="{{number_format($data->SMPAY,2)}}" class="form-control" style="width: 110px;background-color:white;" readonly/>
                    </div>
                    <br><p></p>
                    <div class="float-right form-inline">
                      <label>คงเหลือ : </label>
                      <input type="text" value="{{number_format($data->BALANC - $data->SMPAY,2)}}" class="form-control" style="width: 110px;background-color:white;" readonly/>
                    </div>
                    <br><br><p></p>
                    <div class="form-inline text-center">
                      <table class="table" id="table">
                        <tr align="center" style="background-color:#E7E9EC;">
                          <td>งวดที่</td>
                          <td>เงินต้น</td>
                          <td>ดอกเบี้ย</td>
                        </tr>
                      @foreach($dataPay as $row)
                        @if($row->DATE1 != null)
                        <tr>
                          <td align="center">{{$row->NOPAY}}</td>
                          <td>{{number_format($row->TONEFFR,2)}}</td>
                          <td>{{number_format($row->INTEFFR,2)}}</td>
                        </tr>
                        @else
                        <tr style="color:red;">
                          <td align="center">{{$row->NOPAY}}</td>
                          <td>{{number_format($row->TONEFFR,2)}}</td>
                          <td>{{number_format($row->INTEFFR,2)}}</td>
                        </tr>
                        @endif
                      @endforeach
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-4">
                <div class="form-inline">
                  <h4>
                    @if($type == 12 or $type == 13)
                      ปรับโครงสร้างหนี้
                    @endif
                  </h4>
                </div>
              </div>
              <div class="col-8">
                <div class="card-tools d-inline float-right">
                  <form method="get" action="{{ route('Precipitate',13) }}">
                    <div class="float-right form-inline">
                      <label>เลขที่สัญญา : </label>
                      @if($data == null)
                        <input type="type" name="Contno" maxlength="12" style="width:120px;" class="form-control"/>
                      @else
                        <input type="type" name="Contno" value="{{$data->CONTNO}}" maxlength="12" style="width:120px;" class="form-control"/>
                      @endif
                      <button type="submit" class="btn btn-warning">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <form name="form1" action="{{ route('MasterPrecipitate.store') }}" method="post" id="formimage" enctype="multipart/form-data">
            @csrf
            <div class="card-body text-sm">
              <div class="container-fluid">
                <div class="row mb-1">
                  <div class="col-sm-3">
                    {{-- <h1 class="m-0 text-dark">Dashboard v2</h1> --}}
                  </div>
                  <div class="col-sm-9">
                    <ol class="breadcrumb float-sm-right">
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

                      <div class="float-right form-inline">
                        <button type="submit" class="delete-modal btn btn-success">
                          <i class="fas fa-save"></i> บันทึก
                        </button>
                        &nbsp;
                        <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 11) }}">
                          <i class="far fa-window-close"></i> ยกเลิก
                        </a>
                        <input type="hidden" name="type" value="12" />
                      </div>
                    </ol>
                  </div>
                </div>
              </div>
              
              <div class="card card-warning card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link MainPage" href="{{ route('Precipitate', 11) }}">หน้าหลัก</a>
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

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                            <div class="col-sm-8">
                              @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก เร่งรัด")
                                <input type="text" name="Contract_buyer" class="form-control form-control-sm " value="22-{{$Y}}/" required/>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ทำสัญญา : </font></label>
                            <div class="col-sm-8">
                              <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Namebuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                              @else
                                <input type="text" name="Namebuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->SNAM))}}{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->NAME1))}}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">นามสกุล :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="lastbuyer" class="form-control form-control-sm" placeholder="ป้อนนามสกุล" />
                              @else
                                <input type="text" name="lastbuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->NAME2))}}" class="form-control form-control-sm"  placeholder="ป้อนนามสกุล" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อเล่น :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Nickbuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                              @else
                                <input type="text" name="Nickbuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->NICKNM))}}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เลขบัตรประชาชน :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Idcardbuyer" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                              @else
                                <input type="text" name="Idcardbuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->IDNO))}}" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Phonebuyer" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                              @else
                                <input type="text" name="Phonebuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TELP))}}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เบอร์โทรอื่นๆ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Phone2buyer" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                              @else
                                <input type="text" name="Phone2buyer" value="" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">คู่สมรส :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Matebuyer" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" />
                              @else
                                <input type="text" name="Matebuyer" value="{{iconv('TIS-620', 'utf-8', $data->PARTNERNAME)}}" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ที่อยู่ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <select name="Addressbuyer" class="form-control form-control-sm">
                                  <option value="" selected>--- เลือกที่อยู่ ---</option>
                                  <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                </select>
                              @else
                                <select name="Addressbuyer" class="form-control form-control-sm">
                                  <option value="" selected>--- เลือกที่อยู่ ---</option>
                                  <option value="ตามทะเบียนบ้าน" selected>ตามทะเบียนบ้าน</option>
                                </select>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="StatusAddbuyer" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                              @else
                                <input type="text" name="StatusAddbuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->ADDRES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->PROVDES))}}" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="AddNbuyer" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                              @else
                                <input type="text" name="AddNbuyer" value="{{iconv('TIS-620', 'utf-8',$data->ADDRES)}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->PROVDES))}}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">อาชีพ :</label>
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
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Workplacebuyer" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" />
                              @else
                                <input type="text" name="Workplacebuyer" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->OFFIC))}}" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="deednumberbuyer" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                              @else
                                <input type="text" name="deednumberbuyer" value="" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ :</label>
                            <div class="col-sm-8">
                              <select name="securitiesbuyer" class="form-control form-control-sm">
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
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เนื่อที่ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="areabuyer" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                              @else
                                <input type="text" name="areabuyer" value="" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            @if($type == 12 or $type == 13)
                              <label class="col-sm-3 col-form-label text-right">วัตถุประสงค์ของสินเชื่อ :</label>
                              <div class="col-sm-8">
                                <select id="objectivecar" name="objectivecar" class="form-control form-control-sm" oninput="calculate();">
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
                                  <option value="ขยายระยะเวลาชำระหนี้">ขยายระยะเวลาชำระหนี้</option>
                                </select>
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-12">
                          <h5 class="text-center">รูปภาพประกอบ</h5>
                          <div class="form-group">
                            <div class="file-loading">
                              <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
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
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อ :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="nameSP" class="form-control form-control-sm" placeholder="ชื่อ" />
                              @else
                                @php
                                $StrCon = explode(" ",$dataGT->NAME);
                                $Firstname = $StrCon[0];
                              @endphp
                                <input type="text" name="nameSP" value="{{iconv('TIS-620', 'utf-8',$Firstname)}}" class="form-control form-control-sm" placeholder="ชื่อ" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">นามสกุล :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="lnameSP" class="form-control form-control-sm" placeholder="นามสกุล" />
                              @else
                              @php
                                $StrCon = explode("  ",$dataGT->NAME);
                                $Lastname = $StrCon[1];
                              @endphp
                                <input type="text" name="lnameSP" value="{{iconv('TIS-620', 'utf-8',$Lastname)}}" class="form-control form-control-sm" placeholder="นามสกุล" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อเล่น :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="niknameSP" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                              @else
                                <input type="text" name="niknameSP" value="{{iconv('TIS-620', 'utf-8',$dataGT->NICKNM)}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เลขบัตรประชาชน :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="idcardSP" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                              @else
                                <input type="text" name="idcardSP" value="{{iconv('TIS-620', 'utf-8',$dataGT->IDNO)}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อเล่น :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="niknameSP" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                              @else
                                <input type="text" name="niknameSP" value="{{iconv('TIS-620', 'utf-8',$dataGT->NICKNM)}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ความสัมพันธ์ :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <select name="relationSP" class="form-control form-control-sm">
                                  <option value="" selected>--- ความสัมพันธ์ ---</option>
                                  <option value="พี่น้อง">พี่น้อง</option>
                                  <option value="ญาติ">ญาติ</option>
                                  <option value="เพื่อน">เพื่อน</option>
                                  <option value="บิดา">บิดา</option>
                                  <option value="มารดา">มารดา</option>
                                  <option value="ตำบลเดี่ยวกัน">ตำบลเดี่ยวกัน</option>
                                  <option value="จ้างค้ำ(ไม่รู้จักกัน)">จ้างค้ำ(ไม่รู้จักกัน)</option>
                                </select>
                              @else
                                <select name="relationSP" class="form-control form-control-sm">
                                  <option value="" selected>--- ความสัมพันธ์ ---</option>
                                  <option value="พี่น้อง" {{($NewRelate == 'พี่น้อง') ? 'selected' : ''}}>พี่น้อง</option>
                                  <option value="ญาติ" {{($NewRelate == 'ญาติ') ? 'selected' : ''}}>ญาติ</option>
                                  <option value="เพื่อน" {{($NewRelate == 'เพื่อน') ? 'selected' : ''}}>เพื่อน</option>
                                  <option value="บิดา" {{($NewRelate == 'บิดา') ? 'selected' : ''}}>บิดา</option>
                                  <option value="มารดา" {{($NewRelate == 'มารดา') ? 'selected' : ''}}>มารดา</option>
                                  <option value="ตำบลเดี่ยวกัน" {{($NewRelate == 'ตำบลเดี่ยวกัน') ? 'selected' : ''}}>ตำบลเดี่ยวกัน</option>
                                  <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{($NewRelate == 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : ''}}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                </select>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">คู่สมรส :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="mateSP" class="form-control form-control-sm" placeholder="คู่สมรส" />
                              @else
                                <input type="text" name="mateSP" value="" class="form-control form-control-sm" placeholder="คู่สมรส" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ที่อยู่ :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <select name="addSP" class="form-control form-control-sm">
                                  <option value="" selected>--- ที่อยู่ ---</option>
                                  <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                </select>
                              @else
                                <select name="addSP" class="form-control form-control-sm">
                                  <option value="" selected>--- ที่อยู่ ---</option>
                                  <option value="ตามทะเบียนบ้าน" selected>ตามทะเบียนบ้าน</option>
                                </select>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="statusaddSP" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                              @else
                                <input type="text" name="statusaddSP" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->ADDRES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->PROVDES))}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน :</label>
                            <div class="col-sm-8">
                              @if($dataGT == null)
                                <input type="text" name="workplaceSP" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" />
                              @else
                                <input type="text" name="workplaceSP" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->OFFIC))}}" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">อาชีพ :</label>
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
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ :</label>
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
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด :</label>
                            <div class="col-sm-8">
                              <input type="text" name="deednumberSP" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">เนื้อที่ :</label>
                            <div class="col-sm-8">
                              <input type="text" name="areaSP" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                      <h5 class="text-center">แบบฟอร์มรายละเอียดรถยนต์</h5>
                      <p></p>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ยี่ห้อ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <select name="Brandcar" class="form-control form-control-sm">
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
                              @else
                                <select name="Brandcar" class="form-control form-control-sm">
                                  <option value="" selected>--- ยี่ห้อ ---</option>
                                  <option value="ISUZU" {{($NewBrand == 'อีซูซุ') ? 'selected' : ''}}>ISUZU</option>
                                  <option value="MITSUBISHI" {{($NewBrand == 'มิตซูบิชิ') ? 'selected' : ''}}>MITSUBISHI</option>
                                  <option value="TOYOTA" {{($NewBrand == 'โตโยต้า') ? 'selected' : ''}}>TOYOTA</option>
                                  <option value="MAZDA" {{($NewBrand == 'มาสด้า') ? 'selected' : ''}}>MAZDA</option>
                                  <option value="FORD" {{($NewBrand == 'ฟอร์ด') ? 'selected' : ''}}>FORD</option>
                                  <option value="NISSAN" {{($NewBrand == 'นิสสัน') ? 'selected' : ''}}>NISSAN</option>
                                  <option value="HONDA" {{($NewBrand == 'ฮอนด้า') ? 'selected' : ''}}>HONDA</option>
                                  <option value="CHEVROLET" {{($NewBrand == 'เชฟโรเล๊ต') ? 'selected' : ''}}>CHEVROLET</option>
                                  <option value="MG" {{($NewBrand == 'เอ็มจี') ? 'selected' : ''}}>MG</option>
                                  <option value="SUZUKI" {{($NewBrand == 'ซูซูกิ') ? 'selected' : ''}}>SUZUKI</option>
                                </select>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ปี :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <select id="Yearcar" name="Yearcar" class="form-control form-control-sm">
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
                              @else
                                <input type="text" name="Yearcar" value="{{iconv('Tis-620','utf-8',str_replace(" ","",$data->MANUYR))}}" class="form-control form-control-sm" placeholder="ปี" />
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สี :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Colourcar" class="form-control form-control-sm" placeholder="สี" />
                              @else
                                <input type="text" name="Colourcar" value="{{iconv('Tis-620','utf-8',str_replace(" ","",$data->COLOR))}}" class="form-control form-control-sm" placeholder="สี" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ป้ายทะเบียน :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Licensecar" class="form-control form-control-sm" placeholder="ป้ายเดิม" required/>
                              @else
                                <input type="text" name="Licensecar"  value="{{iconv('Tis-620','utf-8',$data->REGNO)}}" class="form-control form-control-sm" placeholder="ป้ายเดิม" />
                              @endif
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

                        function mile(){
                          var num11 = document.getElementById('Milecar').value;
                          var num1 = num11.replace(",","");
                          document.form1.Milecar.value = addCommas(num1);
                        }

                        function commission(){
                          var num11 = document.getElementById('Commissioncar').value;
                          var num1 = num11.replace(",","");
                          var input = document.getElementById('Agentcar').value;
                          var Subtstr = input.split("");
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

                          if(num8 > 6900){
                            var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                          }else{
                            var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                          }

                          if(num8 > 6900){
                            var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                          }else {
                            var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                          }

                          if(num88 == 0){
                            var TotalBalance = parseFloat(toptemp)-result;
                          }
                          else if(num8 > 6900){
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
                          document.form1.P2Price.value = addCommas(num8);
                          }
                        }
                      </script>

                      <script>
                        function calculate(){
                          var num11 = document.getElementById('Topcar').value;
                          var num1 = num11.replace(",","");
                          var num4 = document.getElementById('Timeslackencar').value;
                          var num2 = document.getElementById('Interestcar').value;
                          var num3 = document.getElementById('Vatcar').value;

                            if(num4 == '12'){
                            var period = '1';
                            }else if(num4 == '18'){
                            var period = '1.5';
                            }else if(num4 == '24'){
                            var period = '2';
                            }else if(num4 == '30'){
                            var period = '2.5';
                            }else if(num4 == '36'){
                            var period = '3';
                            }else if(num4 == '42'){
                            var period = '3.5';
                            }else if(num4 == '48'){
                            var period = '4';
                            }else if(num4 == '54'){
                            var period = '4.5';
                            }else if(num4 == '60'){
                            var period = '5';
                            }else if(num4 == '66'){
                            var period = '5.5';
                            }else if(num4 == '72'){
                            var period = '6';
                            }else if(num4 == '78'){
                            var period = '6.5';
                            }else if(num4 == '84'){
                            var period = '7';
                            }else if(num4 == '90'){
                            var period = '7.5';
                            }else if(num4 == '96'){
                            var period = '8';
                            }

                          var totaltopcar = parseFloat(num1);
                          var vat = (100+parseFloat(num3))/100;
                          var a = (num2*period)+100;
                          var b = (((totaltopcar*a)/100)*vat)/num4;
                          var result = Math.ceil(b/10)*10;
                          var durate = result/vat;
                          var durate2 = durate.toFixed(2)*num4;
                          var tax = result-durate;
                          var tax2 = tax.toFixed(2)*num4;
                          var total = result*num4;
                          var total2 = durate2+tax2;

                          document.form1.Topcar.value = addCommas(totaltopcar);

                          if(!isNaN(result) && num2 != ''){
                            document.form1.Paycar.value = addCommas(result.toFixed(2));
                            document.form1.Paymemtcar.value = addCommas(durate.toFixed(2));
                            document.form1.Timepaymentcar.value = addCommas(durate2.toFixed(2));
                            document.form1.Taxcar.value = addCommas(tax.toFixed(2));
                            document.form1.Taxpaycar.value = addCommas(tax2.toFixed(2));
                            document.form1.Totalpay1car.value = addCommas(total.toFixed(2));
                            document.form1.Totalpay2car.value = addCommas(total2.toFixed(2));
                          }
                        }
                      </script>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ยอดจัด :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Topcar" name="Topcar" class="form-control form-control-sm" maxlength="9" placeholder="กรอกยอดจัด" oninput="calculate();" />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชำระต่องวด :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Paycar" name="Paycar" class="form-control form-control-sm" readonly oninput="calculate();" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อน :</label>
                            <div class="col-sm-8">
                              @if($type == 12 or $type == 13)
                                <input type="text" id="Timeslackencar" name="Timeslackencar" class="form-control form-control-sm" oninput="calculate();" />
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ภาษี/ระยะเวลาผ่อน :</label>
                            <div class="col-sm-4">
                              <input type="text" id="Taxcar" name="Taxcar" class="form-control form-control-sm" readonly />
                            </div>
                            <div class="col-sm-4">
                              <input type="text" id="Taxpaycar" name="Taxpaycar" class="form-control form-control-sm" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย/ปี :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" id="Interestcar" name="Interestcar" class="form-control form-control-sm" oninput="calculate();"/>
                              @else
                                <input type="text" id="Interestcar" name="Interestcar" value="{{iconv('Tis-620','utf-8',str_replace(" ","",$data->EFRATE))}}" class="form-control form-control-sm" placeholder="ดอกเบี้ย" oninput="calculate();"/>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ค่างวด/ระยะเวลาผ่อน :</label>
                            <div class="col-sm-4">
                              <input type="text" id="Paymemtcar" name="Paymemtcar" class="form-control form-control-sm" readonly />
                            </div>
                            <div class="col-sm-4">
                              <input type="text" id="Timepaymentcar" name="Timepaymentcar" class="form-control form-control-sm" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">VAT :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Vatcar" name="Vatcar" value="7" class="form-control form-control-sm" style="background-color: white;" oninput="calculate()"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ยอดผ่อนชำระทั้งหมด :</label>
                            <div class="col-sm-4">
                              <input type="text" id="Totalpay1car" name="Totalpay1car" class="form-control form-control-sm" readonly />
                            </div>
                            <div class="col-sm-4">
                              <input type="text" id="Totalpay2car" name="Totalpay2car" class="form-control form-control-sm" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-8">
                              @if($data == null)
                                <input type="text" name="Notecar" class="form-control form-control-sm" placeholder="หมายเหตุ"/>
                              @else
                                <input type="text" name="Notecar" value="{{$data->CONTNO}}" class="form-control form-control-sm" placeholder="หมายเหตุ"/>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่ชำระงวดแรก :</label>
                            <div class="col-sm-8">
                              <input type="text" name="Dateduefirstcar" class="form-control form-control-sm" readonly placeholder="วันที่ชำระงวดแรก" />
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      @if($data == null)
                        <input type="hidden" name="statuscar" class="form-control form-control-sm"/>
                      @else
                        <input type="hidden" name="statuscar" value="{{iconv('Tis-620','utf-8',$data->BAAB)}}" class="form-control form-control-sm" />
                      @endif

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">เจ้าหน้าที่รับลูกค้า : </font></label>
                            <div class="col-sm-8">
                              <select name="Loanofficercar" class="form-control form-control-sm" required>
                                <option value="" selected>--- เลือกเจ้าหน้า ---</option>
                                <option value="มาซีเตาะห์ แวสือนิ">มาซีเตาะห์ แวสือนิ</option>
                                <option value="ขวัญตา เหมือนพยอม">ขวัญตา เหมือนพยอม</option>
                                <option value="เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์">เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ค่าดำเนินการ :</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control form-control-sm" value="2,500" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-5">
                          <div class="float-right form-inline">
                            <!-- <label><font color="red">สาขา : </font></label> -->
                            @if(Auth::user()->branch == 99)
                              <input type="hidden" name="branchcar" class="form-control" value="Admin" readonly />
                            @elseif(Auth::user()->branch == 01)
                              <input type="hidden" name="branchcar" class="form-control" value="ปัตตานี" readonly />
                            @elseif(Auth::user()->branch == 03)
                              <input type="hidden" name="branchcar" class="form-control" value="ยะลา" readonly />
                            @elseif(Auth::user()->branch == 04)
                              <input type="hidden" name="branchcar" class="form-control" value="นราธิวาส" readonly />
                            @elseif(Auth::user()->branch == 05)
                              <input type="hidden" name="branchcar" class="form-control" value="สายบุรี" readonly />
                            @elseif(Auth::user()->branch == 06)
                              <input type="hidden" name="branchcar" class="form-control" value="โกลก" readonly />
                            @elseif(Auth::user()->branch == 07)
                              <input type="hidden" name="branchcar" class="form-control" value="เบตง" readonly />
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
          
            @if($data != null)
              <input type="hidden" name="otherPrice" value="{{number_format($data->DAMT,2)}}" />
              <input type="hidden" name="notePrice" value="{{$data->T_NOPAY}}" />
            @endif
          </form>
          <a id="button"></a>
        </div>
      </section>
    </div>
  </section>
  {{csrf_field()}}

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

  @if($data != null)
    <script>
      //Make the DIV element draggagle:
      dragElement(document.getElementById("mydiv"));

      function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
          /* if present, the header is where you move the DIV from:*/
          document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
          /* otherwise, move the DIV from anywhere inside the DIV:*/
          elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
          e = e || window.event;
          e.preventDefault();
          // get the mouse cursor position at startup:
          pos3 = e.clientX;
          pos4 = e.clientY;
          document.onmouseup = closeDragElement;
          // call a function whenever the cursor moves:
          document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
          e = e || window.event;
          e.preventDefault();
          // calculate the new cursor position:
          pos1 = pos3 - e.clientX;
          pos2 = pos4 - e.clientY;
          pos3 = e.clientX;
          pos4 = e.clientY;
          // set the element's new position:
          elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
          elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
          /* stop moving when mouse button is released:*/
          document.onmouseup = null;
          document.onmousemove = null;
        }
      }
    </script>
  @endif

@endsection
