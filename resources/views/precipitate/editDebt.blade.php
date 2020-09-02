@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $Currdate = date('2020-06-02');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>
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
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>กรุณาลงชื่อ ผู้อนุมัติ {{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <section class="content">
        <form name="form1" action="{{ route('MasterPrecipitate.update',[$id]) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="type" value="11"/>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-inline">
                        @if($type == 11)
                          <h4>ข้อมูลสัญญา (ปรับโครงสร้างหนี้)</h4>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card-tools d-inline float-right">
                        @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                          <button type="submit" class="delete-modal btn btn-success">
                            <i class="fas fa-save"></i> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 11) }}">
                            <i class="far fa-window-close"></i> ยกเลิก
                          </a>
                        @else
                          @if($data->StatusApp_car != 'อนุมัติ')
                            <button type="submit" class="delete-modal btn btn-success">
                              <i class="fas fa-save"></i> อัพเดท
                            </button>
                            <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 11) }}">
                              <i class="far fa-window-close"></i> ยกเลิก
                            </a>
                          @else
                            <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                              <i class="fas fa-undo"></i> ย้อนกลับ
                            </a>
                          @endif
                        @endif
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
                          @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                            <div class="float-right form-inline">
                              <i class="fas fa-grip-vertical"></i>
                              <span class="todo-wrap">
                                <input type="checkbox" id="1" name="Approverscar" value="{{ auth::user()->name }}" {{ ($data->Approvers_car !== NULL) ? 'checked' : '' }}/>
                                <label for="1" class="todo">
                                  <i class="fa fa-check"></i>
                                  <font color="red">อนุมัติ &nbsp;&nbsp;</font>
                                </label>
                              </span>
                            </div>

                            <div class="float-right form-inline">
                              <i class="fas fa-grip-vertical"></i>
                              <span class="todo-wrap">
                                @if($data->Check_car != Null)
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="2" value="{{ $data->Check_car }}" checked="checked"> <!-- checked="checked"  -->
                                @else
                                  <input type="checkbox" class="checkbox" name="Checkcar" id="2" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                                @endif
                                <label for="2" class="todo">
                                  <i class="fa fa-check"></i>
                                  <font color="red">ตรวจสอบ &nbsp;&nbsp;</font>
                                </label>
                              </span>
                            </div>

                            <div class="float-right form-inline">
                              <i class="fas fa-grip-vertical"></i>
                              <span class="todo-wrap">
                                <input type="checkbox" class="checkbox" name="doccomplete" id="3" value="{{ $data->DocComplete_car }}" {{ ($data->DocComplete_car !== NULL) ? 'checked' : '' }}> <!-- checked="checked"  -->
                                <label for="3" class="todo">
                                  <i class="fa fa-check"></i>
                                  <font color="red">ปิดสิทธิ์แก้ไข &nbsp;&nbsp;</font>
                                </label>
                              </span>
                            </div>
                          @else
                            <div class="float-right form-inline">
                              <i class="fas fa-grip-vertical"></i>
                              @if ( $data->DocComplete_car != Null)
                                <span class="todo-wrap" style="pointer-events: none;">
                                    <input type="checkbox" id="5" class="checkbox" name="doccomplete" value="{{ $data->DocComplete_car }}" checked="checked" /> <!-- checked="checked"  -->
                                  <label for="5" class="todo">
                                    <i class="fa fa-check"></i>
                                    <font color="red">เอกสารครบ &nbsp;&nbsp;</font>
                                  </label>
                                </span>
                              @else
                                <span class="todo-wrap">
                                <input type="checkbox" id="5" class="checkbox" name="doccomplete" value="{{ auth::user()->name }}">
                                  <label for="5" class="todo">
                                    <i class="fa fa-check"></i>
                                    <font color="red">เอกสารครบ &nbsp;&nbsp;</font>
                                  </label>
                                </span> 
                              @endif
                            </div>
                          @endif
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
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Contract_buyer" class="form-control form-control-sm" maxlength="12"  value="{{ $data->Contract_buyer }}" />
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Contract_buyer" class="form-control form-control-sm" value="{{ $data->Contract_buyer }}" readonly/>
                                    @else
                                      @if($data->StatusApp_car == 'อนุมัติ')
                                        <input type="text" name="Contract_buyer" class="form-control form-control-sm" value="{{ $data->Contract_buyer }}"/>
                                      @else
                                        <input type="text" name="Contract_buyer" maxlength="8" class="form-control form-control-sm" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" value="{{ $data->Contract_buyer }}"/>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ทำสัญญา : </font></label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ $data->Date_Due }}">
                                  @else
                                    <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ $data->Date_Due }}" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                  @else
                                    <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนนามสกุล" />
                                  @else
                                    <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนนามสกุล" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                                  @else
                                    <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เลขบัตรประชาชน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เบอร์โทรอื่นๆ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                  @else
                                    <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" />
                                  @else
                                    <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="Addressbuyer" class="form-control" >
                                      <option value="" selected>--- เลือกที่อยู่ ---</option>
                                      <option value="ตามทะเบียนบ้าน" {{ ($data->Address_buyer === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Addressbuyer" value="{{ $data->Address_buyer }}" class="form-control form-control-sm" placeholder="เลือกที่อยู่" readonly/>
                                    @else
                                      <select name="Addressbuyer" class="form-control" >
                                        <option value="" selected>--- เลือกที่อยู่ ---</option>
                                        <option value="ตามทะเบียนบ้าน" {{ ($data->Address_buyer === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                                  @else
                                    <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                  @else
                                    <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="Careerbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- อาชีพ ---</option>
                                      <option value="ตำรวจ" {{ ($data->Career_buyer === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                      <option value="ทหาร" {{ ($data->Career_buyer === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                      <option value="ครู" {{ ($data->Career_buyer === 'ครู') ? 'selected' : '' }}>ครู</option>
                                      <option value="ข้าราชการอื่นๆ" {{ ($data->Career_buyer === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                      <option value="ลูกจ้างเทศบาล" {{ ($data->Career_buyer === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                      <option value="ลูกจ้างประจำ" {{ ($data->Career_buyer === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                      <option value="สมาชิก อบต." {{ ($data->Career_buyer === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                      <option value="ลูกจ้างชั่วคราว" {{ ($data->Career_buyer === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                      <option value="รับจ้าง" {{ ($data->Career_buyer === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                      <option value="พนักงานบริษัทเอกชน" {{ ($data->Career_buyer === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                      <option value="อาชีพอิสระ" {{ ($data->Career_buyer === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                      <option value="กำนัน" {{ ($data->Career_buyer === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                      <option value="ผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                      <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                      <option value="นักการภารโรง" {{ ($data->Career_buyer === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                      <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->Career_buyer === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                      <option value="ค้าขาย" {{ ($data->Career_buyer === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                      <option value="เจ้าของธุรกิจ" {{ ($data->Career_buyer === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                      <option value="เจ้าของอู่รถ" {{ ($data->Career_buyer === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                      <option value="ให้เช่ารถบรรทุก" {{ ($data->Career_buyer === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                      <option value="ช่างตัดผม" {{ ($data->Career_buyer === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                      <option value="ชาวนา" {{ ($data->Career_buyer === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                      <option value="ชาวไร่" {{ ($data->Career_buyer === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                      <option value="แม่บ้าน" {{ ($data->Career_buyer === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                      <option value="รับเหมาก่อสร้าง" {{ ($data->Career_buyer === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                      <option value="ประมง" {{ ($data->Career_buyer === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                      <option value="ทนายความ" {{ ($data->Career_buyer === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                      <option value="พระ" {{ ($data->Career_buyer === 'พระ') ? 'selected' : '' }}>พระ</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Careerbuyer" value="{{ $data->Career_buyer }}" class="form-control form-control-sm" placeholder="เลือกอาชีพ" readonly/>
                                    @else
                                      <select name="Careerbuyer" class="form-control form-control-sm">
                                        <option value="" selected>--- อาชีพ ---</option>
                                        <option value="ตำรวจ" {{ ($data->Career_buyer === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                        <option value="ทหาร" {{ ($data->Career_buyer === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                        <option value="ครู" {{ ($data->Career_buyer === 'ครู') ? 'selected' : '' }}>ครู</option>
                                        <option value="ข้าราชการอื่นๆ" {{ ($data->Career_buyer === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                        <option value="ลูกจ้างเทศบาล" {{ ($data->Career_buyer === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                        <option value="ลูกจ้างประจำ" {{ ($data->Career_buyer === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                        <option value="สมาชิก อบต." {{ ($data->Career_buyer === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                        <option value="ลูกจ้างชั่วคราว" {{ ($data->Career_buyer === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                        <option value="รับจ้าง" {{ ($data->Career_buyer === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                        <option value="พนักงานบริษัทเอกชน" {{ ($data->Career_buyer === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                        <option value="อาชีพอิสระ" {{ ($data->Career_buyer === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                        <option value="กำนัน" {{ ($data->Career_buyer === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                        <option value="ผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                        <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                        <option value="นักการภารโรง" {{ ($data->Career_buyer === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                        <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->Career_buyer === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                        <option value="ค้าขาย" {{ ($data->Career_buyer === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                        <option value="เจ้าของธุรกิจ" {{ ($data->Career_buyer === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                        <option value="เจ้าของอู่รถ" {{ ($data->Career_buyer === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                        <option value="ให้เช่ารถบรรทุก" {{ ($data->Career_buyer === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                        <option value="ช่างตัดผม" {{ ($data->Career_buyer === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                        <option value="ชาวนา" {{ ($data->Career_buyer === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                        <option value="ชาวไร่" {{ ($data->Career_buyer === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                        <option value="แม่บ้าน" {{ ($data->Career_buyer === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                        <option value="รับเหมาก่อสร้าง" {{ ($data->Career_buyer === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                        <option value="ประมง" {{ ($data->Career_buyer === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                        <option value="ทนายความ" {{ ($data->Career_buyer === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                        <option value="พระ" {{ ($data->Career_buyer === 'พระ') ? 'selected' : '' }}>พระ</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" />
                                  @else
                                    <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                                  @else
                                    <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์: </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="securitiesbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                      <option value="โฉนด" {{ ($data->securities_buyer === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                      <option value="นส.3" {{ ($data->securities_buyer === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                      <option value="นส.3 ก" {{ ($data->securities_buyer === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                      <option value="นส.4" {{ ($data->securities_buyer === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                      <option value="นส.4 จ" {{ ($data->securities_buyer === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="securitiesbuyer" value="{{ $data->securities_buyer }}" class="form-control form-control-sm" placeholder="ประเภทหลักทรัพย์" readonly/>
                                    @else
                                      <select name="securitiesbuyer" class="form-control form-control-sm">
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        <option value="โฉนด" {{ ($data->securities_buyer === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                        <option value="นส.3" {{ ($data->securities_buyer === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                        <option value="นส.3 ก" {{ ($data->securities_buyer === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                        <option value="นส.4" {{ ($data->securities_buyer === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                        <option value="นส.4 จ" {{ ($data->securities_buyer === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เนื้อที่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">วัตถุประสงค์ของสินเชื่อ: </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select id="objectivecar" name="objectivecar" class="form-control form-control-sm" oninput="calculate();">
                                      <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                      <option value="ลงทุนในธุรกิจ" {{ ($data->Objective_car === 'ลงทุนในธุรกิจ') ? 'selected' : '' }}>ลงทุนในธุรกิจ</option>
                                      <option value="ขยายกิจการ" {{ ($data->Objective_car === 'ขยายกิจการ') ? 'selected' : '' }}>ขยายกิจการ</option>
                                      <option value="ซื้อรถยนต์" {{ ($data->Objective_car === 'ซื้อรถยนต์') ? 'selected' : '' }}>ซื้อรถยนต์</option>
                                      <option value="ใช้หนี้นอกระบบ" {{ ($data->Objective_car === 'ใช้หนี้นอกระบบ') ? 'selected' : '' }}>ใช้หนี้นอกระบบ</option>
                                      <option value="จ่ายค่าเทอม" {{ ($data->Objective_car === 'จ่ายค่าเทอม') ? 'selected' : '' }}>จ่ายค่าเทอม</option>
                                      <option value="ซื้อของใช้ภายในบ้าน" {{ ($data->Objective_car === 'ซื้อของใช้ภายในบ้าน') ? 'selected' : '' }}>ซื้อของใช้ภายในบ้าน</option>
                                      <option value="ซื้อวัว" {{ ($data->Objective_car === 'ซื้อวัว') ? 'selected' : '' }}>ซื้อวัว</option>
                                      <option value="ซื้อที่ดิน" {{ ($data->Objective_car === 'ซื้อที่ดิน') ? 'selected' : '' }}>ซื้อที่ดิน</option>
                                      <option value="ซ่อมบ้าน" {{ ($data->Objective_car === 'ซ่อมบ้าน') ? 'selected' : '' }}>ซ่อมบ้าน</option>
                                      <option value="ลดค่าธรรมเนียม" {{ ($data->Objective_car === 'ลดค่าธรรมเนียม') ? 'selected' : '' }}>ลดค่าธรรมเนียม</option>
                                      <option value="ลดดอกเบี้ย สูงสุด 100 %" {{ ($data->Objective_car === 'ลดดอกเบี้ย สูงสุด 100 %') ? 'selected' : '' }}>ลดดอกเบี้ย สูงสุด 100 %</option>
                                      <option value="พักชำระเงินต้น 3 เดือน" {{ ($data->Objective_car === 'พักชำระเงินต้น 3 เดือน') ? 'selected' : '' }}>พักชำระเงินต้น 3 เดือน</option>
                                      <option value="พักชำระหนี้ 3 เดือน" {{ ($data->Objective_car === 'พักชำระหนี้ 3 เดือน') ? 'selected' : '' }}>พักชำระหนี้ 3 เดือน</option>
                                      <option value="ขยายระยะเวลาชำระหนี้" {{ ($data->Objective_car === 'ขยายระยะเวลาชำระหนี้') ? 'selected' : '' }}>ขยายระยะเวลาชำระหนี้</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input id="objectivecar" type="text" name="objectivecar" value="{{ $data->Objective_car }}" class="form-control form-control-sm" placeholder="เลือกวัตถุประสงค์ของสินเชื่อ" oninput="calculate();" readonly/>
                                    @else
                                      <select id="objectivecar" name="objectivecar" class="form-control form-control-sm" oninput="calculate();">
                                        <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                        <option value="ลงทุนในธุรกิจ" {{ ($data->Objective_car === 'ลงทุนในธุรกิจ') ? 'selected' : '' }}>ลงทุนในธุรกิจ</option>
                                        <option value="ขยายกิจการ" {{ ($data->Objective_car === 'ขยายกิจการ') ? 'selected' : '' }}>ขยายกิจการ</option>
                                        <option value="ซื้อรถยนต์" {{ ($data->Objective_car === 'ซื้อรถยนต์') ? 'selected' : '' }}>ซื้อรถยนต์</option>
                                        <option value="ใช้หนี้นอกระบบ" {{ ($data->Objective_car === 'ใช้หนี้นอกระบบ') ? 'selected' : '' }}>ใช้หนี้นอกระบบ</option>
                                        <option value="จ่ายค่าเทอม" {{ ($data->Objective_car === 'จ่ายค่าเทอม') ? 'selected' : '' }}>จ่ายค่าเทอม</option>
                                        <option value="ซื้อของใช้ภายในบ้าน" {{ ($data->Objective_car === 'ซื้อของใช้ภายในบ้าน') ? 'selected' : '' }}>ซื้อของใช้ภายในบ้าน</option>
                                        <option value="ซื้อวัว" {{ ($data->Objective_car === 'ซื้อวัว') ? 'selected' : '' }}>ซื้อวัว</option>
                                        <option value="ซื้อที่ดิน" {{ ($data->Objective_car === 'ซื้อที่ดิน') ? 'selected' : '' }}>ซื้อที่ดิน</option>
                                        <option value="ซ่อมบ้าน" {{ ($data->Objective_car === 'ซ่อมบ้าน') ? 'selected' : '' }}>ซ่อมบ้าน</option>
                                        <option value="ลดค่าธรรมเนียม" {{ ($data->Objective_car === 'ลดค่าธรรมเนียม') ? 'selected' : '' }}>ลดค่าธรรมเนียม</option>
                                        <option value="ลดดอกเบี้ย สูงสุด 100 %" {{ ($data->Objective_car === 'ลดดอกเบี้ย สูงสุด 100 %') ? 'selected' : '' }}>ลดดอกเบี้ย สูงสุด 100 %</option>
                                        <option value="พักชำระเงินต้น 3 เดือน" {{ ($data->Objective_car === 'พักชำระเงินต้น 3 เดือน') ? 'selected' : '' }}>พักชำระเงินต้น 3 เดือน</option>
                                        <option value="พักชำระหนี้ 3 เดือน" {{ ($data->Objective_car === 'พักชำระหนี้ 3 เดือน') ? 'selected' : '' }}>พักชำระหนี้ 3 เดือน</option>
                                        <option value="ขยายระยะเวลาชำระหนี้" {{ ($data->Objective_car === 'ขยายระยะเวลาชำระหนี้') ? 'selected' : '' }}>ขยายระยะเวลาชำระหนี้</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <hr>
                          <input type="hidden" name="fdate" value="{{ $fdate }}" />
                          <input type="hidden" name="tdate" value="{{ $tdate }}" />
                          <input type="hidden" name="branch" value="{{ $branch }}" />
                          <input type="hidden" name="status" value="{{ $status }}" />

                          <div class="row">
                            <div class="col-12">
                              <h5 class="text-center">รูปภาพประกอบ</h5>
                              <div class="form-group">
                                @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                  <div class="file-loading">
                                    <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                  </div>
                                @else
                                  @if($data->Approvers_car == Null)
                                    <div class="file-loading">
                                      <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  @endif
                                @endif

                                <p></p>
                                @if($countImage != 0)
                                  @php
                                    $path = $data->License_car;
                                  @endphp
                                <div class="form-group">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <a href="{{ action('AnalysController@deleteImageAll',[$data->id,$path]) }}" class="btn btn-danger pull-left DeleteImage" title="ลบรูปภาพทั้งหมด"> ลบรูปภาพทั้งหมด..</a>
                                    <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$branch,$status,$path]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                      <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                    </a>
                                  @else
                                    @if($data->Approvers_car == Null)
                                      @if($GetDocComplete == Null)
                                      <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$branch,$status,$path]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                        <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                      </a>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <p></p>

                          <div class="row">
                            <div class="col-12">
                              <div class="card card-primary">
                                <div class="card-header">
                                  <div class="card-title">
                                    รูปภาพทั้งหมด
                                  </div>
                                </div>
                                <div class="card-body">
                                  @if($data->License_car != NULL)
                                    @php
                                      $Setlisence = $data->License_car;
                                    @endphp
                                  @endif
                                  <div class="form-inline">
                                    @if(substr($data->createdBuyers_at,0,10) < $Currdate)
                                    @foreach($dataImage as $images)
                                      @if($images->Type_fileimage == "1")
                                        <div class="col-sm-3">
                                          <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                            <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}" style="width: 300px; height: 280px;">
                                          </a>
                                        </div>
                                      @endif
                                    @endforeach
                                  @else
                                    @foreach($dataImage as $images)
                                      @if($images->Type_fileimage == "1")
                                        <div class="col-sm-3">
                                          <a href="{{ asset('upload-image/'.$Setlisence .'/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                            <img src="{{ asset('upload-image/'.$Setlisence .'/'.$images->Name_fileimage) }}" style="width: 300px; height: 280px;">
                                          </a>
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
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
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control form-control-sm" placeholder="ชื่อ" />
                                  @else
                                    <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control form-control-sm" placeholder="ชื่อ" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control form-control-sm" placeholder="นามสกุล" />
                                  @else
                                    <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control form-control-sm" placeholder="นามสกุล" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                                  @else
                                    <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เลขบัตรประชาชน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เบอร์โทร : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ความสัมพันธ์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="relationSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ความสัมพันธ์ ---</option>
                                      <option value="พี่น้อง" {{ ($data->relation_SP === 'พี่น้อง') ? 'selected' : '' }}>พี่น้อง</option>
                                      <option value="ญาติ" {{ ($data->relation_SP === 'ญาติ') ? 'selected' : '' }}>ญาติ</option>
                                      <option value="เพื่อน" {{ ($data->relation_SP === 'เพื่อน') ? 'selected' : '' }}>เพื่อน</option>
                                      <option value="บิดา" {{ ($data->relation_SP === 'บิดา') ? 'selected' : '' }}>บิดา</option>
                                      <option value="มารดา" {{ ($data->relation_SP === 'มารดา') ? 'selected' : '' }}>มารดา</option>
                                      <option value="ตำบลเดี่ยวกัน" {{ ($data->relation_SP === 'ตำบลเดี่ยวกัน') ? 'selected' : '' }}>ตำบลเดี่ยวกัน</option>
                                      <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{ ($data->relation_SP === 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : '' }}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="relationSP" value="{{$data->relation_SP}}" class="form-control form-control-sm" placeholder="เลือกความสัมพันธ์" readonly/>
                                    @else
                                      <select name="relationSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ความสัมพันธ์ ---</option>
                                        <option value="พี่น้อง" {{ ($data->relation_SP === 'พี่น้อง') ? 'selected' : '' }}>พี่น้อง</option>
                                        <option value="ญาติ" {{ ($data->relation_SP === 'ญาติ') ? 'selected' : '' }}>ญาติ</option>
                                        <option value="เพื่อน" {{ ($data->relation_SP === 'เพื่อน') ? 'selected' : '' }}>เพื่อน</option>
                                        <option value="บิดา" {{ ($data->relation_SP === 'บิดา') ? 'selected' : '' }}>บิดา</option>
                                        <option value="มารดา" {{ ($data->relation_SP === 'มารดา') ? 'selected' : '' }}>มารดา</option>
                                        <option value="ตำบลเดี่ยวกัน" {{ ($data->relation_SP === 'ตำบลเดี่ยวกัน') ? 'selected' : '' }}>ตำบลเดี่ยวกัน</option>
                                        <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{ ($data->relation_SP === 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : '' }}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control form-control-sm" placeholder="คู่สมรส" />
                                  @else
                                    <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control form-control-sm" placeholder="คู่สมรส" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="addSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ที่อยู่ ---</option>
                                      <option value="ตามทะเบียนบ้าน" {{ ($data->add_SP === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                    <input type="text" name="addSP" value="{{$data->add_SP}}" class="form-control form-control-sm" placeholder="เลือกที่อยู่" readonly/>
                                    @else
                                      <select name="addSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ที่อยู่ ---</option>
                                        <option value="ตามทะเบียนบ้าน" {{ ($data->add_SP === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                  @else
                                    <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" />
                                  @else
                                    <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="careerSP" class="form-control form-control-sm">
                                      <option value="" selected>--- อาชีพ ---</option>
                                      <option value="ตำรวจ" {{ ($data->career_SP === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                      <option value="ทหาร" {{ ($data->career_SP === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                      <option value="ครู" {{ ($data->career_SP === 'ครู') ? 'selected' : '' }}>ครู</option>
                                      <option value="ข้าราชการอื่นๆ" {{ ($data->career_SP === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                      <option value="ลูกจ้างเทศบาล" {{ ($data->career_SP === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                      <option value="ลูกจ้างประจำ" {{ ($data->career_SP === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                      <option value="สมาชิก อบต." {{ ($data->career_SP === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                      <option value="ลูกจ้างชั่วคราว" {{ ($data->career_SP === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                      <option value="รับจ้าง" {{ ($data->career_SP === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                      <option value="พนักงานบริษัทเอกชน" {{ ($data->career_SP === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                      <option value="อาชีพอิสระ" {{ ($data->career_SP === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                      <option value="กำนัน" {{ ($data->career_SP === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                      <option value="ผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                      <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                      <option value="นักการภารโรง" {{ ($data->career_SP === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                      <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->career_SP === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                      <option value="ค้าขาย" {{ ($data->career_SP === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                      <option value="เจ้าของธุรกิจ" {{ ($data->career_SP === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                      <option value="เจ้าของอู่รถ" {{ ($data->career_SP === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                      <option value="ให้เช่ารถบรรทุก" {{ ($data->career_SP === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                      <option value="ช่างตัดผม" {{ ($data->career_SP === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                      <option value="ชาวนา" {{ ($data->career_SP === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                      <option value="ชาวไร่" {{ ($data->career_SP === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                      <option value="แม่บ้าน" {{ ($data->career_SP === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                      <option value="รับเหมาก่อสร้าง" {{ ($data->career_SP === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                      <option value="ประมง" {{ ($data->career_SP === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                      <option value="ทนายความ" {{ ($data->career_SP === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                      <option value="พระ" {{ ($data->career_SP === 'พระ') ? 'selected' : '' }}>พระ</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                        <input type="text" name="careerSP" value="{{$data->career_SP}}" class="form-control form-control-sm" placeholder="อาชีพ" readonly/>
                                    @else
                                      <select name="careerSP" class="form-control form-control-sm">
                                        <option value="" selected>--- อาชีพ ---</option>
                                        <option value="ตำรวจ" {{ ($data->career_SP === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                        <option value="ทหาร" {{ ($data->career_SP === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                        <option value="ครู" {{ ($data->career_SP === 'ครู') ? 'selected' : '' }}>ครู</option>
                                        <option value="ข้าราชการอื่นๆ" {{ ($data->career_SP === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                        <option value="ลูกจ้างเทศบาล" {{ ($data->career_SP === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                        <option value="ลูกจ้างประจำ" {{ ($data->career_SP === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                        <option value="สมาชิก อบต." {{ ($data->career_SP === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                        <option value="ลูกจ้างชั่วคราว" {{ ($data->career_SP === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                        <option value="รับจ้าง" {{ ($data->career_SP === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                        <option value="พนักงานบริษัทเอกชน" {{ ($data->career_SP === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                        <option value="อาชีพอิสระ" {{ ($data->career_SP === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                        <option value="กำนัน" {{ ($data->career_SP === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                        <option value="ผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                        <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                        <option value="นักการภารโรง" {{ ($data->career_SP === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                        <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->career_SP === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                        <option value="ค้าขาย" {{ ($data->career_SP === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                        <option value="เจ้าของธุรกิจ" {{ ($data->career_SP === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                        <option value="เจ้าของอู่รถ" {{ ($data->career_SP === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                        <option value="ให้เช่ารถบรรทุก" {{ ($data->career_SP === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                        <option value="ช่างตัดผม" {{ ($data->career_SP === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                        <option value="ชาวนา" {{ ($data->career_SP === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                        <option value="ชาวไร่" {{ ($data->career_SP === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                        <option value="แม่บ้าน" {{ ($data->career_SP === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                        <option value="รับเหมาก่อสร้าง" {{ ($data->career_SP === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                        <option value="ประมง" {{ ($data->career_SP === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                        <option value="ทนายความ" {{ ($data->career_SP === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                        <option value="พระ" {{ ($data->career_SP === 'พระ') ? 'selected' : '' }}>พระ</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="securitiesSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                      <option value="โฉนด" {{ ($data->securities_SP === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                      <option value="นส.3" {{ ($data->securities_SP === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                      <option value="นส.3 ก" {{ ($data->securities_SP === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                      <option value="นส.4" {{ ($data->securities_SP === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                      <option value="นส.4 จ" {{ ($data->securities_SP === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                    <input type="text" name="securitiesSP" value="{{$data->securities_SP}}" class="form-control form-control-sm" placeholder="ประเภทหลักทรัพย์" readonly/>
                                    @else
                                      <select name="securitiesSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        <option value="โฉนด" {{ ($data->securities_SP === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                        <option value="นส.3" {{ ($data->securities_SP === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                        <option value="นส.3 ก" {{ ($data->securities_SP === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                        <option value="นส.4" {{ ($data->securities_SP === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                        <option value="นส.4 จ" {{ ($data->securities_SP === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                                  @else
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เนื้อที่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
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
                                <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="Brandcar" class="form-control form-control-sm">
                                      <option value="" selected>--- ยี่ห้อ ---</option>
                                      <option value="ISUZU" {{ ($data->Brand_car === 'ISUZU') ? 'selected' : '' }}>ISUZU</option>
                                      <option value="MITSUBISHI" {{ ($data->Brand_car === 'MITSUBISHI') ? 'selected' : '' }}>MITSUBISHI</option>
                                      <option value="TOYOTA" {{ ($data->Brand_car === 'TOYOTA') ? 'selected' : '' }}>TOYOTA</option>
                                      <option value="MAZDA" {{ ($data->Brand_car === 'MAZDA') ? 'selected' : '' }}>MAZDA</option>
                                      <option value="FORD" {{ ($data->Brand_car === 'FORD') ? 'selected' : '' }}>FORD</option>
                                      <option value="NISSAN" {{ ($data->Brand_car === 'NISSAN') ? 'selected' : '' }}>NISSAN</option>
                                      <option value="HONDA" {{ ($data->Brand_car === 'HONDA') ? 'selected' : '' }}>HONDA</option>
                                      <option value="CHEVROLET" {{ ($data->Brand_car === 'CHEVROLET') ? 'selected' : '' }}>CHEVROLET</option>
                                      <option value="MG" {{ ($data->Brand_car === 'MG') ? 'selected' : '' }}>MG</option>
                                      <option value="SUZUKI" {{ ($data->Brand_car === 'SUZUKI') ? 'selected' : '' }}>SUZUKI</option>
                                    </select>
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Brandcar" value="{{$data->Brand_car}}" class="form-control form-control-sm" placeholder="ยี่ห้อ" readonly/>
                                    @else
                                      <select name="Brandcar" class="form-control form-control-sm">
                                        <option value="" selected>--- ยี่ห้อ ---</option>
                                        <option value="ISUZU" {{ ($data->Brand_car === 'ISUZU') ? 'selected' : '' }}>ISUZU</option>
                                        <option value="MITSUBISHI" {{ ($data->Brand_car === 'MITSUBISHI') ? 'selected' : '' }}>MITSUBISHI</option>
                                        <option value="TOYOTA" {{ ($data->Brand_car === 'TOYOTA') ? 'selected' : '' }}>TOYOTA</option>
                                        <option value="MAZDA" {{ ($data->Brand_car === 'MAZDA') ? 'selected' : '' }}>MAZDA</option>
                                        <option value="FORD" {{ ($data->Brand_car === 'FORD') ? 'selected' : '' }}>FORD</option>
                                        <option value="NISSAN" {{ ($data->Brand_car === 'NISSAN') ? 'selected' : '' }}>NISSAN</option>
                                        <option value="HONDA" {{ ($data->Brand_car === 'HONDA') ? 'selected' : '' }}>HONDA</option>
                                        <option value="CHEVROLET" {{ ($data->Brand_car === 'CHEVROLET') ? 'selected' : '' }}>CHEVROLET</option>
                                        <option value="MG" {{ ($data->Brand_car === 'MG') ? 'selected' : '' }}>MG</option>
                                        <option value="SUZUKI" {{ ($data->Brand_car === 'SUZUKI') ? 'selected' : '' }}>SUZUKI</option>
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ปี : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select id="Yearcar" name="Yearcar" class="form-control form-control-sm" onchange="calculate();">
                                      <option value="{{$data->Year_car}}" selected>{{$data->Year_car}}</option>
                                      <option value="">--------------------</option>
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
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Yearcar" value="{{$data->Year_car}}" class="form-control form-control-sm" placeholder="ปี" readonly/>
                                    @else
                                      <select id="Yearcar" name="Yearcar" class="form-control form-control-sm" onchange="calculate();">
                                        <option value="{{$data->Year_car}}" selected>{{$data->Year_car}}</option>
                                        <option value="">--------------------</option>
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
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">สี : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control form-control-sm" placeholder="สี" />
                                  @else
                                    <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control form-control-sm" placeholder="สี" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ป้ายทะเบียน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin")
                                    <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control form-control-sm" placeholder="ป้ายเดิม" />
                                  @else
                                    <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control form-control-sm" placeholder="ป้ายเดิม" readonly/>
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

                              function insurance(){
                                    var num1 = document.getElementById('Insurancecar').value;
                                    var num22 = document.getElementById('totalkPrice').value;
                                    var num2 = num22.replace(",","");
                                    var num33 = document.getElementById('balancePrice').value;
                                    var num3 = num33.replace(",","");
                                    var num44 = document.getElementById('Topcar').value;
                                    var num4 = num44.replace(",","");
                                    var num55 = document.getElementById('P2Price').value;
                                    var num5 = num55.replace(",","");

                                      if(num1 == 'มี ป2+ อยู่แล้ว' && num4 >= '200000'){
                                              var total1 = parseFloat(num2) - 6900;
                                              var total2 = parseFloat(num3) + 6900;
                                              document.form1.P2Price.value = 0;
                                              document.form1.totalkPrice.value = addCommas(total1);
                                              document.form1.balancePrice.value = addCommas(total2);
                                      }
                                      else if(num1 == 'มี ป1 อยู่แล้ว' && num4 >= '200000'){
                                              var total1 = parseFloat(num2) - 6900;
                                              var total2 = parseFloat(num3) + 6900;
                                              document.form1.P2Price.value = 0;
                                              document.form1.totalkPrice.value = addCommas(total1);
                                              document.form1.balancePrice.value = addCommas(total2);
                                      }
                                      else{
                                              document.form1.P2Price.value = addCommas(num5);
                                              document.form1.totalkPrice.value = addCommas(num2);
                                              document.form1.balancePrice.value = addCommas(num3);
                                      }

                                    }
                          </script>
                          @if($type == 11)
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
                          @endif

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ยอดจัด : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control form-control-sm" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" />
                                  @else
                                    <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control form-control-sm" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                  <input type="hidden" id="TopcarOri" name="TopcarOri" class="form-control form-control-sm" placeholder="กรอกยอดจัด" />
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชำระต่องวด : </label>
                                <div class="col-sm-8">
                                  <input type="text" id="Paycar" name="Paycar" value="{{$data->Pay_car}}" class="form-control form-control-sm" readonly onchange="calculate()" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" placeholder="ป้อนระยะเวลาผ่อน" class="form-control form-control-sm" oninput="calculate();" />
                                  @else
                                    <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" placeholder="ป้อนระยะเวลาผ่อน" class="form-control form-control-sm" oninput="calculate();" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ภาษี/ระยะเวลาผ่อน : </label>
                                <div class="col-sm-4">
                                  <input type="text" id="Taxcar" name="Taxcar" value="{{$data->Tax_car}}" class="form-control form-control-sm" readonly />
                                </div>
                                <div class="col-sm-4">
                                  <input type="text" id="Taxpaycar" name="Taxpaycar" value="{{$data->Taxpay_car}}" class="form-control form-control-sm" readonly />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Interestcar" name="Interestcar" class="form-control form-control-sm" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" oninput="calculate();"/>
                                  @else
                                    <input type="text" id="Interestcar" name="Interestcar" class="form-control form-control-sm" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" oninput="calculate();" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ค่างวด/ระยะเวลาผ่อน : </label>
                                <div class="col-sm-4">
                                  <input type="text" id="Paymemtcar" name="Paymemtcar" value="{{$data->Paymemt_car}}" class="form-control form-control-sm" readonly />
                                </div>
                                <div class="col-sm-4">
                                  <input type="text" id="Timepaymentcar" name="Timepaymentcar" value="{{$data->Timepayment_car}}" class="form-control form-control-sm" readonly />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">VAT : </label>
                                <div class="col-sm-8">
                                  <input type="text" id="Vatcar" name="Vatcar" value="{{$data->Vat_car}}" class="form-control form-control-sm" style="width: 250px;background-color: white;" onchange="calculate();"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ยอดผ่อนชำระทั้งหมด : </label>
                                <div class="col-sm-4">
                                  <input type="text" id="Totalpay1car" name="Totalpay1car" value="{{$data->Totalpay1_car}}" class="form-control form-control-sm" readonly />
                                </div>
                                <div class="col-sm-4">
                                  <input type="text" id="Totalpay2car" name="Totalpay2car" value="{{$data->Totalpay2_car}}" class="form-control form-control-sm" readonly />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control form-control-sm" placeholder="หมายเหตุ"/>
                                  @else
                                    <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control form-control-sm" placeholder="หมายเหตุ" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">วันที่ชำระงวดแรก : </label>
                                <div class="col-sm-8">
                                  <input type="date" name="Dateduefirstcar" value="{{$data->Dateduefirst_car}}" class="form-control form-control-sm" placeholder="วันที่ชำระงวดแรก" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">เจ้าหน้าที่รับลูกค้า : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <select name="Loanofficercar" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกเจ้าหน้า ---</option>
                                      <option value="มาซีเตาะห์ แวสือนิ" {{ ($data->Loanofficer_car === 'มาซีเตาะห์ แวสือนิ') ? 'selected' : '' }}>มาซีเตาะห์ แวสือนิ</option>
                                      <option value="ขวัญตา เหมือนพยอม" {{ ($data->Loanofficer_car === 'ขวัญตา เหมือนพยอม') ? 'selected' : '' }}>ขวัญตา เหมือนพยอม</option>
                                      <option value="เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์" {{ ($data->Loanofficer_car === 'เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์') ? 'selected' : '' }}>เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</option>
                                    </select>
                                  @else
                                    <input type="text" name="Loanofficercar" value="{{$data->Loanofficer_car}}" class="form-control form-control-sm" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
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

                          <hr>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ค่างวดเดิม : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                    <input type="text" name="otherPrice" value="{{number_format($data->other_Price,2)}}" class="form-control form-control-sm" />
                                  @else
                                    <input type="text" name="otherPrice" value="{{number_format($data->other_Price,2)}}" class="form-control form-control-sm" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อนเดิม : </label>
                                <div class="col-sm-8">
                                  <input type="text" name="notePrice" value="{{$data->note_Price}}" class="form-control form-control-sm" />
                                </div>
                              </div>
                            </div>
                          </div>

                          @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                            <input type="hidden" name="statuscar" value="{{$data->status_car}}" class="form-control" />
                          @else
                            <input type="hidden" name="statuscar" value="{{$data->status_car}}" class="form-control" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                          @endif
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="_method" value="PATCH"/>

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
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                    @else
                                        <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                      <label>นามสกุล : </label>
                                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                        <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                      @else
                                        <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                      @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ชื่อเล่น : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                    @else
                                      <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>สถานะ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="statusSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- สถานะ ---</option>
                                        <option value="โสด" {{ ($data->status_SP2 === 'โสด') ? 'selected' : '' }}>โสด</option>
                                        <option value="สมรส" {{ ($data->status_SP2 === 'สมรส') ? 'selected' : '' }}>สมรส</option>
                                        <option value="หย่าร้าง" {{ ($data->status_SP2 === 'หย่าร้าง') ? 'selected' : '' }}>หย่าร้าง</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="statusSP2" value="{{$data->status_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกสถานะ" readonly/>
                                      @else
                                        <select name="statusSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- สถานะ ---</option>
                                          <option value="โสด" {{ ($data->status_SP2 === 'โสด') ? 'selected' : '' }}>โสด</option>
                                          <option value="สมรส" {{ ($data->status_SP2 === 'สมรส') ? 'selected' : '' }}>สมรส</option>
                                          <option value="หย่าร้าง" {{ ($data->status_SP2 === 'หย่าร้าง') ? 'selected' : '' }}>หย่าร้าง</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เบอร์โทร : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ความสัมพันธ์ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="relationSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- ความสัมพันธ์ ---</option>
                                        <option value="พี่น้อง" {{ ($data->relation_SP2 === 'พี่น้อง') ? 'selected' : '' }}>พี่น้อง</option>
                                        <option value="ญาติ" {{ ($data->relation_SP2 === 'ญาติ') ? 'selected' : '' }}>ญาติ</option>
                                        <option value="เพื่อน" {{ ($data->relation_SP2 === 'เพื่อน') ? 'selected' : '' }}>เพื่อน</option>
                                        <option value="บิดา" {{ ($data->relation_SP2 === 'บิดา') ? 'selected' : '' }}>บิดา</option>
                                        <option value="มารดา" {{ ($data->relation_SP2 === 'มารดา') ? 'selected' : '' }}>มารดา</option>
                                        <option value="ตำบลเดี่ยวกัน" {{ ($data->relation_SP2 === 'ตำบลเดี่ยวกัน') ? 'selected' : '' }}>ตำบลเดี่ยวกัน</option>
                                        <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{ ($data->relation_SP2 === 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : '' }}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="relationSP2" value="{{$data->relation_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกความสัมพันธ์" readonly/>
                                      @else
                                        <select name="relationSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ความสัมพันธ์ ---</option>
                                          <option value="พี่น้อง" {{ ($data->relation_SP2 === 'พี่น้อง') ? 'selected' : '' }}>พี่น้อง</option>
                                          <option value="ญาติ" {{ ($data->relation_SP2 === 'ญาติ') ? 'selected' : '' }}>ญาติ</option>
                                          <option value="เพื่อน" {{ ($data->relation_SP2 === 'เพื่อน') ? 'selected' : '' }}>เพื่อน</option>
                                          <option value="บิดา" {{ ($data->relation_SP2 === 'บิดา') ? 'selected' : '' }}>บิดา</option>
                                          <option value="มารดา" {{ ($data->relation_SP2 === 'มารดา') ? 'selected' : '' }}>มารดา</option>
                                          <option value="ตำบลเดี่ยวกัน" {{ ($data->relation_SP2 === 'ตำบลเดี่ยวกัน') ? 'selected' : '' }}>ตำบลเดี่ยวกัน</option>
                                          <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{ ($data->relation_SP2 === 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : '' }}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>คู่สมรส : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                    @else
                                      <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขบัตรประชาชน : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="addSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- ที่อยู่ ---</option>
                                        <option value="ตามทะเบียนบ้าน" {{ ($data->add_SP2 === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                      <input type="text" name="addSP2" value="{{$data->add_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกที่อยู่" readonly/>
                                      @else
                                        <select name="addSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ที่อยู่ ---</option>
                                          <option value="ตามทะเบียนบ้าน" {{ ($data->add_SP2 === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                    @else
                                      <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>รายละเอียดที่อยู่ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                    @else
                                      <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>สถานที่ทำงาน : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                    @else
                                      <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ลักษณะบ้าน : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="houseSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                        <option value="บ้านตึก 1 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 1 ชั้น') ? 'selected' : '' }}>บ้านตึก 1 ชั้น</option>
                                        <option value="บ้านตึก 2 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                        <option value="บ้านไม้ 1 ชั้น" {{ ($data->house_SP2 === 'บ้านไม้ 1 ชั้น') ? 'selected' : '' }}>บ้านไม้ 1 ชั้น</option>
                                        <option value="บ้านตึก 2 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                        <option value="บ้านเดี่ยว" {{ ($data->house_SP2 === 'บ้านเดี่ยว') ? 'selected' : '' }}>บ้านเดี่ยว</option>
                                        <option value="แฟลต" {{ ($data->house_SP2 === 'แฟลต') ? 'selected' : '' }}>แฟลต</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                      <input type="text" name="houseSP2" value="{{$data->house_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกลักษณะบ้าน" readonly/>
                                      @else
                                        <select name="houseSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                          <option value="บ้านตึก 1 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 1 ชั้น') ? 'selected' : '' }}>บ้านตึก 1 ชั้น</option>
                                          <option value="บ้านตึก 2 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                          <option value="บ้านไม้ 1 ชั้น" {{ ($data->house_SP2 === 'บ้านไม้ 1 ชั้น') ? 'selected' : '' }}>บ้านไม้ 1 ชั้น</option>
                                          <option value="บ้านตึก 2 ชั้น" {{ ($data->house_SP2 === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                          <option value="บ้านเดี่ยว" {{ ($data->house_SP2 === 'บ้านเดี่ยว') ? 'selected' : '' }}>บ้านเดี่ยว</option>
                                          <option value="แฟลต" {{ ($data->house_SP2 === 'แฟลต') ? 'selected' : '' }}>แฟลต</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประเภทหลักทรัพย์ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        <option value="โฉนด" {{ ($data->securities_SP2 === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                        <option value="นส.3" {{ ($data->securities_SP2 === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                        <option value="นส.3 ก" {{ ($data->securities_SP2 === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                        <option value="นส.4" {{ ($data->securities_SP2 === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                        <option value="นส.4 จ" {{ ($data->securities_SP2 === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                      <input type="text" name="securitiesSP2" value="{{$data->securities_SP2}}" class="form-control" style="width: 200px;" placeholder="ประเภทหลักทรัพย์" readonly/>
                                      @else
                                        <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                          <option value="โฉนด" {{ ($data->securities_SP2 === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                          <option value="นส.3" {{ ($data->securities_SP2 === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                          <option value="นส.3 ก" {{ ($data->securities_SP2 === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                          <option value="นส.4" {{ ($data->securities_SP2 === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                          <option value="นส.4 จ" {{ ($data->securities_SP2 === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขที่โฉนด : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                    @else
                                      <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เนื้อที่ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" {{ ($GetDocComplete !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประเภทบ้าน : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- ประเภทบ้าน ---</option>
                                        <option value="ของตนเอง" {{ ($data->housestyle_SP2 === 'ของตนเอง') ? 'selected' : '' }}>ของตนเอง</option>
                                        <option value="อาศัยบิดา-มารดา" {{ ($data->housestyle_SP2 === 'อาศัยบิดา-มารดา') ? 'selected' : '' }}>อาศัยบิดา-มารดา</option>
                                        <option value="อาศัยผู้อื่น" {{ ($data->housestyle_SP2 === 'อาศัยผู้อื่น') ? 'selected' : '' }}>อาศัยผู้อื่น</option>
                                        <option value="บ้านพักราชการ" {{ ($data->housestyle_SP2 === 'บ้านพักราชการ') ? 'selected' : '' }}>บ้านพักราชการ</option>
                                        <option value="บ้านเช่า" {{ ($data->housestyle_SP2 === 'บ้านเช่า') ? 'selected' : '' }}>บ้านเช่า</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="housestyleSP2" value="{{$data->housestyle_SP2}}" class="form-control" style="width: 200px;" placeholder="ประเภทบ้าน" readonly/>
                                      @else
                                        <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          <option value="ของตนเอง" {{ ($data->housestyle_SP2 === 'ของตนเอง') ? 'selected' : '' }}>ของตนเอง</option>
                                          <option value="อาศัยบิดา-มารดา" {{ ($data->housestyle_SP2 === 'อาศัยบิดา-มารดา') ? 'selected' : '' }}>อาศัยบิดา-มารดา</option>
                                          <option value="อาศัยผู้อื่น" {{ ($data->housestyle_SP2 === 'อาศัยผู้อื่น') ? 'selected' : '' }}>อาศัยผู้อื่น</option>
                                          <option value="บ้านพักราชการ" {{ ($data->housestyle_SP2 === 'บ้านพักราชการ') ? 'selected' : '' }}>บ้านพักราชการ</option>
                                          <option value="บ้านเช่า" {{ ($data->housestyle_SP2 === 'บ้านเช่า') ? 'selected' : '' }}>บ้านเช่า</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>อาชีพ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="careerSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- อาชีพ ---</option>
                                        <option value="ตำรวจ" {{ ($data->career_SP2 === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                        <option value="ทหาร" {{ ($data->career_SP2 === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                        <option value="ครู" {{ ($data->career_SP2 === 'ครู') ? 'selected' : '' }}>ครู</option>
                                        <option value="ข้าราชการอื่นๆ" {{ ($data->career_SP2 === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                        <option value="ลูกจ้างเทศบาล" {{ ($data->career_SP2 === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                        <option value="ลูกจ้างประจำ" {{ ($data->career_SP2 === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                        <option value="สมาชิก อบต." {{ ($data->career_SP2 === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                        <option value="ลูกจ้างชั่วคราว" {{ ($data->career_SP2 === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                        <option value="รับจ้าง" {{ ($data->career_SP2 === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                        <option value="พนักงานบริษัทเอกชน" {{ ($data->career_SP2 === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                        <option value="อาชีพอิสระ" {{ ($data->career_SP2 === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                        <option value="กำนัน" {{ ($data->career_SP2 === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                        <option value="ผู้ใหญ่บ้าน" {{ ($data->career_SP2 === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                        <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->career_SP2 === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                        <option value="นักการภารโรง" {{ ($data->career_SP2 === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                        <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->career_SP2 === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                        <option value="ค้าขาย" {{ ($data->career_SP2 === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                        <option value="เจ้าของธุรกิจ" {{ ($data->career_SP2 === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                        <option value="เจ้าของอู่รถ" {{ ($data->career_SP2 === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                        <option value="ให้เช่ารถบรรทุก" {{ ($data->career_SP2 === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                        <option value="ช่างตัดผม" {{ ($data->career_SP2 === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                        <option value="ชาวนา" {{ ($data->career_SP2 === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                        <option value="ชาวไร่" {{ ($data->career_SP2 === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                        <option value="แม่บ้าน" {{ ($data->career_SP2 === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                        <option value="รับเหมาก่อสร้าง" {{ ($data->career_SP2 === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                        <option value="ประมง" {{ ($data->career_SP2 === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                        <option value="ทนายความ" {{ ($data->career_SP2 === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                        <option value="พระ" {{ ($data->career_SP2 === 'พระ') ? 'selected' : '' }}>พระ</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="careerSP2" value="{{$data->career_SP2}}" class="form-control" style="width: 200px;" placeholder="อาชีพ" readonly/>
                                      @else
                                        <select name="careerSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- อาชีพ ---</option>
                                          <option value="ตำรวจ" {{ ($data->career_SP2 === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                          <option value="ทหาร" {{ ($data->career_SP2 === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                          <option value="ครู" {{ ($data->career_SP2 === 'ครู') ? 'selected' : '' }}>ครู</option>
                                          <option value="ข้าราชการอื่นๆ" {{ ($data->career_SP2 === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                          <option value="ลูกจ้างเทศบาล" {{ ($data->career_SP2 === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                          <option value="ลูกจ้างประจำ" {{ ($data->career_SP2 === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                          <option value="สมาชิก อบต." {{ ($data->career_SP2 === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                          <option value="ลูกจ้างชั่วคราว" {{ ($data->career_SP2 === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                          <option value="รับจ้าง" {{ ($data->career_SP2 === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                          <option value="พนักงานบริษัทเอกชน" {{ ($data->career_SP2 === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                          <option value="อาชีพอิสระ" {{ ($data->career_SP2 === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                          <option value="กำนัน" {{ ($data->career_SP2 === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                          <option value="ผู้ใหญ่บ้าน" {{ ($data->career_SP2 === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                          <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->career_SP2 === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                          <option value="นักการภารโรง" {{ ($data->career_SP2 === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                          <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->career_SP2 === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                          <option value="ค้าขาย" {{ ($data->career_SP2 === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                          <option value="เจ้าของธุรกิจ" {{ ($data->career_SP2 === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                          <option value="เจ้าของอู่รถ" {{ ($data->career_SP2 === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                          <option value="ให้เช่ารถบรรทุก" {{ ($data->career_SP2 === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                          <option value="ช่างตัดผม" {{ ($data->career_SP2 === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                          <option value="ชาวนา" {{ ($data->career_SP2 === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                          <option value="ชาวไร่" {{ ($data->career_SP2 === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                          <option value="แม่บ้าน" {{ ($data->career_SP2 === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                          <option value="รับเหมาก่อสร้าง" {{ ($data->career_SP2 === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                          <option value="ประมง" {{ ($data->career_SP2 === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                          <option value="ทนายความ" {{ ($data->career_SP2 === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                          <option value="พระ" {{ ($data->career_SP2 === 'พระ') ? 'selected' : '' }}>พระ</option>
                                        </select>2
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>รายได้ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="incomeSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- รายได้ ---</option>
                                        <option value="5,000 - 10,000" {{ ($data->income_SP2 === '5,000 - 10,000') ? 'selected' : '' }}>5,000 - 10,000</option>
                                        <option value="10,000 - 15,000" {{ ($data->income_SP2 === '10,000 - 15,000') ? 'selected' : '' }}>10,000 - 15,000</option>
                                        <option value="15,000 - 20,000" {{ ($data->income_SP2 === '15,000 - 20,000') ? 'selected' : '' }}>15,000 - 20,000</option>
                                        <option value="มากกว่า 20,000" {{ ($data->income_SP2 === 'มากกว่า 20,000') ? 'selected' : '' }}>มากกว่า 20,000</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="incomeSP2" value="{{$data->income_SP2}}" class="form-control" style="width: 200px;" placeholder="รายได้" readonly/>
                                      @else
                                        <select name="incomeSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- รายได้ ---</option>
                                          <option value="5,000 - 10,000" {{ ($data->income_SP2 === '5,000 - 10,000') ? 'selected' : '' }}>5,000 - 10,000</option>
                                          <option value="10,000 - 15,000" {{ ($data->income_SP2 === '10,000 - 15,000') ? 'selected' : '' }}>10,000 - 15,000</option>
                                          <option value="15,000 - 20,000" {{ ($data->income_SP2 === '15,000 - 20,000') ? 'selected' : '' }}>15,000 - 20,000</option>
                                          <option value="มากกว่า 20,000" {{ ($data->income_SP2 === 'มากกว่า 20,000') ? 'selected' : '' }}>มากกว่า 20,000</option>
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประวัติซื้อ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="puchaseSP2" class="form-control" style="width: 88px;">
                                        <option value="" selected>--- ซื้อ ---</option>
                                        <option value="0 คัน" {{ ($data->puchase_SP2 === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                        <option value="1 คัน" {{ ($data->puchase_SP2 === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                        <option value="2 คัน" {{ ($data->puchase_SP2 === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                        <option value="3 คัน" {{ ($data->puchase_SP2 === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                        <option value="4 คัน" {{ ($data->puchase_SP2 === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                        <option value="5 คัน" {{ ($data->puchase_SP2 === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                        <option value="6 คัน" {{ ($data->puchase_SP2 === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                        <option value="7 คัน" {{ ($data->puchase_SP2 === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                        <option value="8 คัน" {{ ($data->puchase_SP2 === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                        <option value="9 คัน" {{ ($data->puchase_SP2 === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                        <option value="10 คัน" {{ ($data->puchase_SP2 === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                        <option value="11 คัน" {{ ($data->puchase_SP2 === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                        <option value="12 คัน" {{ ($data->puchase_SP2 === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                        <option value="13 คัน" {{ ($data->puchase_SP2 === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                        <option value="14 คัน" {{ ($data->puchase_SP2 === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                        <option value="15 คัน" {{ ($data->puchase_SP2 === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                        <option value="16 คัน" {{ ($data->puchase_SP2 === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                        <option value="17 คัน" {{ ($data->puchase_SP2 === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                        <option value="18 คัน" {{ ($data->puchase_SP2 === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                        <option value="19 คัน" {{ ($data->puchase_SP2 === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                        <option value="20 คัน" {{ ($data->puchase_SP2 === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="puchaseSP2" value="{{$data->puchase_SP2}}" class="form-control" style="width: 88px;" placeholder="ซื้อ" readonly/>
                                      @else
                                        <select name="puchaseSP2" class="form-control" style="width: 88px;">
                                          <option value="" selected>--- ซื้อ ---</option>
                                          <option value="0 คัน" {{ ($data->puchase_SP2 === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                          <option value="1 คัน" {{ ($data->puchase_SP2 === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                          <option value="2 คัน" {{ ($data->puchase_SP2 === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                          <option value="3 คัน" {{ ($data->puchase_SP2 === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                          <option value="4 คัน" {{ ($data->puchase_SP2 === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                          <option value="5 คัน" {{ ($data->puchase_SP2 === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                          <option value="6 คัน" {{ ($data->puchase_SP2 === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                          <option value="7 คัน" {{ ($data->puchase_SP2 === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                          <option value="8 คัน" {{ ($data->puchase_SP2 === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                          <option value="9 คัน" {{ ($data->puchase_SP2 === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                          <option value="10 คัน" {{ ($data->puchase_SP2 === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                          <option value="11 คัน" {{ ($data->puchase_SP2 === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                          <option value="12 คัน" {{ ($data->puchase_SP2 === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                          <option value="13 คัน" {{ ($data->puchase_SP2 === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                          <option value="14 คัน" {{ ($data->puchase_SP2 === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                          <option value="15 คัน" {{ ($data->puchase_SP2 === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                          <option value="16 คัน" {{ ($data->puchase_SP2 === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                          <option value="17 คัน" {{ ($data->puchase_SP2 === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                          <option value="18 คัน" {{ ($data->puchase_SP2 === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                          <option value="19 คัน" {{ ($data->puchase_SP2 === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                          <option value="20 คัน" {{ ($data->puchase_SP2 === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                        </select>
                                      @endif
                                    @endif

                                    <label>ค้ำ : </label>
                                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                                      <select name="supportSP2" class="form-control" style="width: 88px;">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        <option value="0 คัน" {{ ($data->support_SP2 === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                        <option value="1 คัน" {{ ($data->support_SP2 === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                        <option value="2 คัน" {{ ($data->support_SP2 === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                        <option value="3 คัน" {{ ($data->support_SP2 === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                        <option value="4 คัน" {{ ($data->support_SP2 === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                        <option value="5 คัน" {{ ($data->support_SP2 === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                        <option value="6 คัน" {{ ($data->support_SP2 === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                        <option value="7 คัน" {{ ($data->support_SP2 === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                        <option value="8 คัน" {{ ($data->support_SP2 === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                        <option value="9 คัน" {{ ($data->support_SP2 === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                        <option value="10 คัน" {{ ($data->support_SP2 === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                        <option value="11 คัน" {{ ($data->support_SP2 === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                        <option value="12 คัน" {{ ($data->support_SP2 === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                        <option value="13 คัน" {{ ($data->support_SP2 === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                        <option value="14 คัน" {{ ($data->support_SP2 === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                        <option value="15 คัน" {{ ($data->support_SP2 === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                        <option value="16 คัน" {{ ($data->support_SP2 === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                        <option value="17 คัน" {{ ($data->support_SP2 === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                        <option value="18 คัน" {{ ($data->support_SP2 === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                        <option value="19 คัน" {{ ($data->support_SP2 === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                        <option value="20 คัน" {{ ($data->support_SP2 === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="supportSP2" value="{{$data->support_SP2}}" class="form-control" style="width: 88px;" placeholder="ค้ำ" readonly/>
                                      @else
                                        <select name="supportSP2" class="form-control" style="width: 88px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          <option value="0 คัน" {{ ($data->support_SP2 === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                          <option value="1 คัน" {{ ($data->support_SP2 === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                          <option value="2 คัน" {{ ($data->support_SP2 === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                          <option value="3 คัน" {{ ($data->support_SP2 === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                          <option value="4 คัน" {{ ($data->support_SP2 === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                          <option value="5 คัน" {{ ($data->support_SP2 === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                          <option value="6 คัน" {{ ($data->support_SP2 === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                          <option value="7 คัน" {{ ($data->support_SP2 === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                          <option value="8 คัน" {{ ($data->support_SP2 === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                          <option value="9 คัน" {{ ($data->support_SP2 === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                          <option value="10 คัน" {{ ($data->support_SP2 === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                          <option value="11 คัน" {{ ($data->support_SP2 === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                          <option value="12 คัน" {{ ($data->support_SP2 === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                          <option value="13 คัน" {{ ($data->support_SP2 === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                          <option value="14 คัน" {{ ($data->support_SP2 === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                          <option value="15 คัน" {{ ($data->support_SP2 === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                          <option value="16 คัน" {{ ($data->support_SP2 === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                          <option value="17 คัน" {{ ($data->support_SP2 === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                          <option value="18 คัน" {{ ($data->support_SP2 === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                          <option value="19 คัน" {{ ($data->support_SP2 === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                          <option value="20 คัน" {{ ($data->support_SP2 === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                        </select>
                                      @endif
                                    @endif
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

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
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

@endsection
