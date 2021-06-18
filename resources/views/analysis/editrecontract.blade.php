@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  $Currdate = date('2021-01-01');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';

  $SetTDate = date('Y-m-d', strtotime('+ 5year'));
  $SetFDate = date('Y-m-d', strtotime('- 2year'));

@endphp

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>
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

  <style>
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      width: 150px;
      height: 200px;
    }
    #myImg:hover {opacity: 0.7;}
  </style>

  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <form name="form1" method="post" action="{{ action('AnalysController@update',[$id,$Gettype]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-inline">
                        @if($data->StatusApp_car != 'อนุมัติ')
                          <h5>แก้ไขข้อมูลสัญญา...</h5>
                        @else
                          <h5>รายละเอียดข้อมูลสัญญา...</h5>
                        @endif
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="card-tools d-inline float-right">
                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                          <div class="form-inline float-right">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                                <input type="checkbox" class="checkbox" id="11" name="approveRecontract" value="{{ auth::user()->name }}" {{ ($data->UserApp_Contract !== NULL) ? 'checked' : '' }}>
                              <label for="11" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="green">Approve &nbsp;</font>
                              </label>
                            </span> 
                            <div class="info-box-content pr-2">
                                <small class="badge badge-secondary" style="font-size: 16px;">
                                  <i class="fas fa-sign"></i>&nbsp; สถานะสัญญา :
                                  <select name="StatusContract" class="form-control form-control-sm">
                                    <option value="" selected>--------- status ----------</option>
                                    <option value="เปลี่ยนสัญญา" {{ ($data->Status_Contract === 'เปลี่ยนสัญญา') ? 'selected' : '' }}>เปลี่ยนสัญญา</option>
                                  </select>
                                </small>
                            </div>
                            <button type="submit" class="delete-modal btn btn-success">
                              <i class="fas fa-save"></i> อัพเดท
                            </button>
                            <a class="delete-modal btn btn-danger" href="{{ route('Analysis',$type) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&status={{$status}}">
                              <i class="far fa-window-close"></i> ยกเลิก
                            </a>
                          </div>
                        @else
                            <div class="form-inline float-right">
                            <i class="fas fa-grip-vertical"></i>
                            <span class="todo-wrap">
                              <input type="checkbox" class="checkbox" name="approveRecontract" {{ ($data->UserApp_Contract !== NULL) ? 'checked' : '' }}>
                              <label for="11" class="todo">
                                <i class="fa fa-check"></i>
                                <font color="green">Approve &nbsp;</font>
                              </label>
                            </span> 
                            <div class="info-box-content pr-2">
                              <div class="form-inline float-right">
                                <small class="badge badge-secondary" style="font-size: 16px;">
                                  <i class="fas fa-sign"></i>&nbsp; สถานะสัญญา :
                                  <select id="StatusContract" name="StatusContract" class="form-control form-control-sm">
                                    <option value="" selected>---------- status ----------</option>
                                    <option value="เปลี่ยนสัญญา" {{ ($data->Status_Contract === 'เปลี่ยนสัญญา') ? 'selected' : '' }}>เปลี่ยนสัญญา</option>
                                  </select>
                                </small>
                              </div>
                            </div>
                            <button id="UpdateCont" type="submit" class="delete-modal btn btn-success" >
                              <i class="fas fa-save"></i> อัพเดท
                            </button>
                            <a class="delete-modal btn btn-danger" href="{{ route('Analysis',$type) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&status={{$status}}">
                              <i class="far fa-window-close"></i> ยกเลิก
                            </a>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link MainPage" href="{{ route('Analysis',$type) }}">หน้าหลัก</a>
                        </li>
                        @if($SettingValue->Tabbuyer_set == 'on')
                        <li class="nav-item">
                          <a class="nav-link active" id="Sub-custom-tab1" data-toggle="pill" href="#Sub-tab1" role="tab" aria-controls="Sub-tab1" aria-selected="false">แบบฟอร์มผู้เช่าซื้อ</a>
                        </li>
                        @endif 
                        @if($SettingValue->Tabsponser_set == 'on')
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab2" data-toggle="pill" href="#Sub-tab2" role="tab" aria-controls="Sub-tab2" aria-selected="false">แบบฟอร์มผู้ค้ำ</a>
                        </li>
                        @endif 
                        @if($SettingValue->Tabcardetail_set == 'on')
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab3" data-toggle="pill" href="#Sub-tab3" role="tab" aria-controls="Sub-tab3" aria-selected="false">แบบฟอร์มรถยนต์</a>
                        </li>
                        @endif 
                        @if($SettingValue->Tabchecker_set == 'on')
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab5" data-toggle="pill" href="#Sub-tab5" role="tab" aria-controls="Sub-tab5" aria-selected="false">Checker</a>
                        </li>
                        @endif
                        @if($SettingValue->Tabincome_set == 'on')
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab6" data-toggle="pill" href="#Sub-tab6" role="tab" aria-controls="Sub-tab6" aria-selected="false">ที่มารายได้</a>
                        </li>
                        @endif
                      </ul>
                    </div>

                    {{-- เนื้อหา --}}
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
                          <h5 class="text-center"><b>แบบฟอร์มรายละเอียดผู้เช่าซื้อ</b></h5>
                          <p></p>
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                                  <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Contract_buyer" class="form-control form-control-sm" maxlength="12" value="{{ $data->Contract_buyer }}" />
                                  @else
                                    <input type="text" name="Contract_buyer" class="form-control form-control-sm" maxlength="12" value="{{ $data->Contract_buyer }}" readonly/>
                                  @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ทำสัญญา : </font></label>
                                  <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ $data->Date_Due }}">
                                  @else
                                    <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ $data->Date_Due }}" readonly>
                                  @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                    @else
                                      <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control form-control-sm" placeholder="ป้อนนามสกุล" />
                                    @else
                                      <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control form-control-sm" placeholder="ป้อนนามสกุล" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                                    @else
                                      <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Statusbuyer" class="form-control form-control-sm">
                                        <option value="" selected>--- เลือกสถานะ ---</option>
                                        @foreach ($Statusby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Statusbuyer" class="form-control form-control-sm">
                                          <option value="" disabled selected>--- เลือกสถานะ ---</option>
                                          @foreach ($Statusby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Statusbuyer" value="{{ $data->Status_buyer }}" class="form-control form-control-sm" readonly/>
                                        @else
                                          <select name="Statusbuyer" class="form-control form-control-sm">
                                            <option value="" disabled selected>--- เลือกสถานะ ---</option>
                                            @foreach ($Statusby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6"> 
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรอื่นๆ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                    @else
                                      <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเบอร์โทรอื่นๆ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ซื้อ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนคู่สมรส" />
                                    @else
                                      <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนคู่สมรส" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Addressbuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- เลือกที่อยู่ ---</option>
                                        @foreach ($Addby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Addressbuyer" class="form-control form-control-sm" >
                                          <option value=""  selected>--- เลือกที่อยู่ ---</option>
                                          @foreach ($Addby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Addressbuyer" value="{{ $data->Address_buyer }}" class="form-control form-control-sm"  placeholder="เลือกที่อยู่" readonly/>
                                        @else
                                          <select name="Addressbuyer" class="form-control form-control-sm" >
                                            <option value=""  selected>--- เลือกที่อยู่ ---</option>
                                            @foreach ($Addby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control form-control-sm"  placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                    @else
                                      <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control form-control-sm"  placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนรายละเอียดที่อยู่" />
                                    @else
                                      <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนรายละเอียดที่อยู่" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนสถานที่ทำงาน" />
                                    @else
                                      <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนสถานที่ทำงาน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ลักษณะบ้าน : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Housebuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                        @foreach ($Houseby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Housebuyer" class="form-control form-control-sm" >
                                          <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                          @foreach ($Houseby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Housebuyer" value="{{ $data->House_buyer }}" class="form-control form-control-sm"  placeholder="เลือกลักษณะบ้าน" readonly/>
                                        @else
                                          <select name="Housebuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                            @foreach ($Houseby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="securitiesbuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        @foreach ($securitiesSPp as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->securities_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="securitiesbuyer" class="form-control form-control-sm" >
                                          <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                          @foreach ($securitiesSPp as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->securities_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="securitiesbuyer" value="{{ $data->securities_buyer }}" class="form-control form-control-sm"  placeholder="ประเภทหลักทรัพย์" readonly/>
                                        @else
                                          <select name="securitiesbuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                            @foreach ($securitiesSPp as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->securities_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control form-control-sm"  placeholder="เลขที่โฉนด" />
                                    @else
                                      <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control form-control-sm"  placeholder="เลขที่โฉนด" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เนื่อที่ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control form-control-sm"  placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                    @else
                                      <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control form-control-sm"  placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทบ้าน : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="HouseStylebuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- ประเภทบ้าน ---</option>
                                        @foreach ($HouseStyleby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="HouseStylebuyer" class="form-control form-control-sm" >
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          @foreach ($HouseStyleby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="HouseStylebuyer" value="{{ $data->HouseStyle_buyer }}" class="form-control form-control-sm"  placeholder="เลือกประเภทบ้าน" readonly/>
                                        @else
                                          <select name="HouseStylebuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            @foreach ($HouseStyleby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ใบขับขี่ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Driverbuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                        @foreach ($Driverby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y') 
                                        <select name="Driverbuyer" class="form-control form-control-sm" >
                                          <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                          @foreach ($Driverby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Driverbuyer" value="{{ $data->Driver_buyer }}" class="form-control form-control-sm"  placeholder="เลือกใบขับขี่" readonly/>
                                        @else
                                          <select name="Driverbuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                            @foreach ($Driverby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติการซื้อ/ค้ำ : </label>
                                  <div class="col-sm-4">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Purchasebuyer" class="form-control form-control-sm">
                                        <option value="" selected>--- ซื้อ ---</option>
                                        @foreach ($HisCarby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Purchasebuyer" class="form-control form-control-sm">
                                          <option value="" selected>--- ซื้อ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Purchasebuyer" value="{{ $data->Purchase_buyer }}" class="form-control form-control-sm" placeholder="ซื้อ" readonly/>
                                        @else
                                          <select name="Purchasebuyer" class="form-control form-control-sm">
                                            <option value="" selected>--- ซื้อ ---</option>
                                            @foreach ($HisCarby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                  <div class="col-sm-4">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Supportbuyer" class="form-control form-control-sm">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        @foreach ($HisCarby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Supportbuyer" class="form-control form-control-sm">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Supportbuyer" value="{{ $data->Support_buyer }}" class="form-control form-control-sm" placeholder="ค้ำ" readonly/>
                                        @else
                                          <select name="Supportbuyer" class="form-control form-control-sm">
                                            <option value="" selected>--- ค้ำ ---</option>
                                            @foreach ($HisCarby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะผู้เช่าซื้อ : </label>
                                  <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <select name="Gradebuyer" class="form-control form-control-sm" >
                                        <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                        @foreach ($GradeBuyer as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($Recontract == 'Y')
                                        <select name="Gradebuyer" class="form-control form-control-sm" >
                                          <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                          @foreach ($GradeBuyer as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else 
                                        @if($data->UserApp_Contract != Null)
                                          <input type="text" name="Gradebuyer" value="{{ $data->Gradebuyer_car }}" class="form-control form-control-sm"  placeholder="เลือกสถานะผู้เช่าซื้อ" readonly/>
                                        @else
                                          <select name="Gradebuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                            @foreach ($GradeBuyer as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>

                            <hr>
                            <input type="hidden" name="fdate" value="{{ $fdate }}" />
                            <input type="hidden" name="tdate" value="{{ $tdate }}" />
                            <input type="hidden" name="branch" value="{{ $data->branch_car }}" />
                            <input type="hidden" name="status" value="{{ $status }}" />

                            <div class="row">
                              <div class="col-md-4">
                                <h5 class="text-center"><b>รูปภาพประกอบ</b></h5>
                                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                  @if($data->License_car != '')
                                    <div class="file-loading">
                                      <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  @endif
                                @else
                                  @if($data->License_car != '')
                                    <div class="file-loading">
                                      <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  @endif
                                @endif
                              </div>
                              <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-6">
                                    <h5 class="text-center"><b>รายละเอียดอาชีพ</b></h5>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <textarea class="form-control" name="CareerDetail" rows="5" placeholder="ป้อนรายละเอียด">{{$data->CareerDetail_buyer}}</textarea>
                                    @else
                                      <textarea class="form-control" name="CareerDetail" rows="5" placeholder="ป้อนรายละเอียด" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->CareerDetail_buyer}}</textarea>
                                    @endif
                                    <h5 class="text-center"><b>วัตถุประสงค์สินเชื่อ</b></h5>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                        <textarea class="form-control" name="objectivecar" rows="5" placeholder="ป้อนวัตถุประสงค์สินเชื่อ">{{$data->Objective_car}}</textarea>
                                    @else
                                        <textarea class="form-control" name="objectivecar" rows="5" placeholder="ป้อนวัตถุประสงค์สินเชื่อ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Objective_car}}</textarea>
                                    @endif
                                  </div>
                                  <div class="col-md-6">
                                    <h5 class="text-center"><b>ผลการประเมินลูกค้า</b></h5>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <textarea class="form-control" name="ApproveDetail" rows="5" placeholder="ป้อนเหตุผล">{{$data->ApproveDetail_buyer}}</textarea>
                                    @else
                                      <textarea class="form-control" name="ApproveDetail" rows="5" placeholder="ป้อนเหตุผล" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->ApproveDetail_buyer}}</textarea>
                                    @endif
                                    <h5 class="text-center text-red"><b>หมายเหตุ / กรณีพิเศษ</b></h5>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                        <textarea class="form-control" name="Notecar" rows="5" placeholder="ป้อนหมายเหตุ">{{$data->Note_car}}</textarea>
                                    @else
                                        <textarea class="form-control" name="Notecar" rows="5" placeholder="ป้อนหมายเหตุ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Note_car}}</textarea>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                            <div class="row">
                              <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <h5 class="text-center"><b>ผลการตรวจสอบลูกค้า</b></h5>
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                                    <textarea class="form-control mb-3" name="Memo" rows="3" placeholder="ป้อนเหตุผล">{{$data->Memo_buyer}}</textarea>
                                  @else
                                      <textarea class="form-control mb-3" name="Memo" rows="3" placeholder="ป้อนเหตุผล" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Memo_buyer}}</textarea>
                                  @endif
                                  <div class="card">
                                    <h5 class="text-center"><b>ความพึงพอใจลูกค้า</b></h5>
                                    <div class="form-group clearfix">
                                      &nbsp;
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary1" name="Buyerprefer" value="ปรับปรุง" {{ ($data->Prefer_buyer == 'ปรับปรุง') ? 'checked' : '' }}>
                                        <label for="radioPrimary1" style="font-size: 10px;">
                                        ปรับปรุง
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary2" name="Buyerprefer" value="พอใช้" {{ ($data->Prefer_buyer == 'พอใช้') ? 'checked' : '' }}>
                                        <label for="radioPrimary2" style="font-size: 10px;">
                                        พอใช้
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary3" name="Buyerprefer" value="ปานกลาง" {{ ($data->Prefer_buyer == 'ปานกลาง') ? 'checked' : '' }}>
                                        <label for="radioPrimary3" style="font-size: 10px;">
                                        ปานกลาง
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary4" name="Buyerprefer" value="ดี" {{ ($data->Prefer_buyer == 'ดี') ? 'checked' : '' }}>
                                        <label for="radioPrimary4" style="font-size: 10px;">
                                        ดี
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary5" name="Buyerprefer" value="ดีมาก" {{ ($data->Prefer_buyer == 'ดีมาก') ? 'checked' : '' }}>
                                        <label for="radioPrimary5" style="font-size: 10px;">
                                        ดีมาก
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <h5 class="text-center"><b>ผลการตรวจสอบนายหน้า</b></h5>
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                                    <textarea class="form-control mb-3" name="Memobroker" rows="3" placeholder="ป้อนเหตุผล">{{$data->Memo_broker}}</textarea>
                                  @else
                                    <textarea class="form-control mb-3" name="Memobroker" rows="3" placeholder="ป้อนเหตุผล" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Memo_broker}}</textarea>
                                  @endif
                                  <div class="card">
                                    <h5 class="text-center"><b>ความพึงพอใจนายหน้า</b></h5>
                                    <div class="form-group clearfix">
                                      &nbsp;
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary11" name="Brokerprefer" value="ปรับปรุง" {{ ($data->Prefer_broker == 'ปรับปรุง') ? 'checked' : '' }}>
                                        <label for="radioPrimary11" style="font-size: 10px;">
                                        ปรับปรุง
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary22" name="Brokerprefer" value="พอใช้" {{ ($data->Prefer_broker == 'พอใช้') ? 'checked' : '' }}>
                                        <label for="radioPrimary22" style="font-size: 10px;">
                                        พอใช้
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary33" name="Brokerprefer" value="ปานกลาง" {{ ($data->Prefer_broker == 'ปานกลาง') ? 'checked' : '' }}>
                                        <label for="radioPrimary33" style="font-size: 10px;">
                                        ปานกลาง
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary44" name="Brokerprefer" value="ดี" {{ ($data->Prefer_broker == 'ดี') ? 'checked' : '' }}>
                                        <label for="radioPrimary44" style="font-size: 10px;">
                                        ดี
                                        </label>
                                      </div>
                                      <div class="icheck-primary d-inline pr-3">
                                        <input type="radio" id="radioPrimary55" name="Brokerprefer" value="ดีมาก" {{ ($data->Prefer_broker == 'ดีมาก') ? 'checked' : '' }}>
                                        <label for="radioPrimary55" style="font-size: 10px;">
                                        ดีมาก
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          @else
                            <input type="hidden" name="Memo" value="{{$data->Memo_buyer}}" />
                            <input type="hidden" name="Buyerprefer" value="{{$data->Prefer_buyer}}" />
                            <input type="hidden" name="Memobroker" value="{{$data->Memo_broker}}" />
                            <input type="hidden" name="Brokerprefer" value="{{$data->Prefer_broker}}" />
                          @endif
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  @if($countImage != 0)
                                    @php
                                      $path = $data->License_car;
                                    @endphp
                                    <p></p>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "MASTER" or auth::user()->position == "STAFF")
                                      <a href="{{ action('AnalysController@deleteImageAll',[$data->id,$path]) }}" class="btn btn-danger pull-left DeleteImage" title="ลบรูปภาพทั้งหมด"> ลบรูปภาพทั้งหมด..</a>
                                      <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$status,$path]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                        <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                      </a>
                                    @else
                                      @if($data->Approvers_car == Null)
                                        @if($data->UserApp_Contract == Null)
                                        <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$status,$path]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                          <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                        </a>
                                        @endif
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <br/>

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
                                    @else 
                                      @php
                                        $Setlisence = '';
                                      @endphp
                                    @endif
                                    <div class="form-inline">
                                      @if(substr($data->createdBuyers_at,0,10) < $Currdate)
                                        @foreach($dataImage as $images)
                                          @if($images->Type_fileimage == "1")
                                            <div class="col-sm-3">
                                              <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                                <img id="myImg" src="{{ asset('upload-image/'.$images->Name_fileimage) }}">
                                              </a>
                                            </div>
                                          @endif
                                        @endforeach
                                      @else
                                        @foreach($dataImage as $images)
                                          @if($images->Type_fileimage == "1")
                                            <div class="col-sm-3">
                                              <a href="{{ asset('upload-image/'.$Setlisence .'/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                                <img id="myImg" src="{{ asset('upload-image/'.$Setlisence .'/'.$images->Name_fileimage) }}">
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
                          <h5 class="text-center"><b>แบบฟอร์มรายละเอียดผู้ค้ำ</b></h5>
                          <p></p>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ชื่อ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control form-control-sm" placeholder="ชื่อ" />
                                  @else
                                    <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control form-control-sm" placeholder="ชื่อ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control form-control-sm" placeholder="นามสกุล" />
                                  @else
                                    <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control form-control-sm" placeholder="นามสกุล" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                                  @else
                                    <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="statusSP" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะ ---</option>
                                      @foreach ($Statusby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="statusSP" class="form-control form-control-sm">
                                        <option value="" selected>--- สถานะ ---</option>
                                          @foreach ($Statusby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="statusSP" value="{{$data->status_SP}}" class="form-control form-control-sm" placeholder="เลือกสถานะ" readonly/>
                                      @else
                                        <select name="statusSP" class="form-control form-control-sm">
                                          <option value="" selected>--- สถานะ ---</option>
                                            @foreach ($Statusby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เบอร์โทร : </label>
                                <div class="col-sm-8">
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ความสัมพันธ์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="relationSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ความสัมพันธ์ ---</option>
                                        @foreach ($relationSPp as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="relationSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ความสัมพันธ์ ---</option>
                                        @foreach ($relationSPp as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="relationSP" value="{{$data->relation_SP}}" class="form-control form-control-sm" placeholder="เลือกความสัมพันธ์" readonly/>
                                      @else
                                        <select name="relationSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ความสัมพันธ์ ---</option>
                                          @foreach ($relationSPp as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ค้ำ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control form-control-sm" placeholder="คู่สมรส" />
                                  @else
                                    <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control form-control-sm" placeholder="คู่สมรส" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="addSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ที่อยู่ ---</option>
                                        @foreach ($Addby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="addSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ที่อยู่ ---</option>
                                          @foreach ($Addby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                      <input type="text" name="addSP" value="{{$data->add_SP}}" class="form-control form-control-sm" placeholder="เลือกที่อยู่" readonly/>
                                      @else
                                        <select name="addSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ที่อยู่ ---</option>
                                            @foreach ($Addby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                  @else
                                    <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                  @else
                                    <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" />
                                  @else
                                    <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control form-control-sm" placeholder="สถานที่ทำงาน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ลักษณะบ้าน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="houseSP" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                        @foreach ($Houseby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="houseSP" class="form-control form-control-sm">
                                        <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                          @foreach ($Houseby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="houseSP" value="{{$data->house_SP}}" class="form-control form-control-sm" placeholder="เลือกลักษณะบ้าน" readonly/>
                                      @else
                                        <select name="houseSP" class="form-control form-control-sm">
                                          <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                            @foreach ($Houseby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ประเภทหลักทรัพย์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="securitiesSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                        @foreach ($securitiesSPp as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="securitiesSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                          @foreach ($securitiesSPp as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="securitiesSP" value="{{$data->securities_SP}}" class="form-control form-control-sm" placeholder="ประเภทหลักทรัพย์" readonly/>
                                      @else
                                        <select name="securitiesSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                            @foreach ($securitiesSPp as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เลขที่โฉนด : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                                  @else
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เนื้อที่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  @else
                                    <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ประเภทบ้าน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="housestyleSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทบ้าน ---</option>
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="housestyleSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ประเภทบ้าน ---</option>
                                        @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                          <input type="text" name="housestyleSP" value="{{$data->housestyle_SP}}" class="form-control form-control-sm" placeholder="ประเภทบ้าน" readonly/>
                                      @else
                                        <select name="housestyleSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          @foreach ($HouseStyleby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ประวัติซื้อ/ค้ำ  : </label>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="puchaseSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="puchaseSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ซื้อ ---</option>
                                        @foreach ($HisCarby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="puchaseSP" value="{{$data->puchase_SP}}" class="form-control form-control-sm" placeholder="ซื้อ" readonly/>
                                      @else
                                        <select name="puchaseSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ซื้อ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="supportSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($Recontract == 'Y')
                                      <select name="supportSP" class="form-control form-control-sm">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        @foreach ($HisCarby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else 
                                      @if($data->UserApp_Contract != Null)
                                        <input type="text" name="supportSP" value="{{$data->support_SP}}" class="form-control form-control-sm" placeholder="ค้ำ" readonly/>
                                      @else
                                        <select name="supportSP" class="form-control form-control-sm">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="tab-pane fade" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                          <h5 class="text-center"><b>แบบฟอร์มรายละเอียดรถยนต์</b></h5>
                          <p></p>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select name="Brandcar" class="form-control form-control-sm" >
                                      <option value="" selected>--- ยี่ห้อ ---</option>
                                      @foreach ($Brandcarr as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Brand_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($data->UserApp_Contract != Null)
                                      <input type="text" name="Brandcar" value="{{$data->Brand_car}}" class="form-control form-control-sm"  placeholder="ยี่ห้อ" readonly/>
                                    @else
                                      <select name="Brandcar" class="form-control form-control-sm" >
                                        <option value="" selected>--- ยี่ห้อ ---</option>
                                        @foreach ($Brandcarr as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Brand_car) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ประเภทรถ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select id="Typecardetail" name="Typecardetail" class="form-control form-control-sm"  onchange="calculate();">
                                      <option value="" selected>--- ประเภทรถ ---</option>
                                      @foreach ($Typecardetail as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Typecardetails) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($data->UserApp_Contract != Null)
                                      <input type="text" id="Typecardetail" name="Typecardetail" value="{{$data->Typecardetails}}" class="form-control form-control-sm"  placeholder="ปี" readonly/>
                                    @else
                                    <select id="Typecardetail" name="Typecardetail" class="form-control form-control-sm"  onchange="calculate();">
                                      <option value="" selected>--- ประเภทรถ ---</option>
                                      @foreach ($Typecardetail as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Typecardetails) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">สี : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control form-control-sm"  placeholder="สี" />
                                  @else
                                    <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control form-control-sm"  placeholder="สี" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ปี : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select id="Yearcar" name="Yearcar" class="form-control form-control-sm"  onchange="calculate();">
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
                                    @if($data->UserApp_Contract != Null)
                                      <input type="text" name="Yearcar" value="{{$data->Year_car}}" class="form-control form-control-sm"  placeholder="ปี" readonly/>
                                    @else
                                      <select id="Yearcar" name="Yearcar" class="form-control form-control-sm"  onchange="calculate();">
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
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ป้ายเดิม : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control form-control-sm"  placeholder="ป้ายเดิม" required/>
                                  @else
                                    @if($countImage == 0)
                                      <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control form-control-sm"/>
                                    @else
                                      <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control form-control-sm"  {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">กลุ่มปีรถยนต์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Groupyearcar" name="Groupyearcar" class="form-control form-control-sm"  value="{{ $data->Groupyear_car}}" onchange="newformula();"/>
                                  @else
                                    <input type="text" id="Groupyearcar" name="Groupyearcar" class="form-control form-control-sm"  value="{{ $data->Groupyear_car}}" onchange="newformula();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ป้ายใหม่ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Nowlicensecar" value="{{$data->Nowlicense_car}}" class="form-control form-control-sm"  placeholder="ป้ายใหม่"/>
                                  @else
                                    <input type="text" name="Nowlicensecar" value="{{$data->Nowlicense_car}}" class="form-control form-control-sm"  placeholder="ป้ายใหม่" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เลขไมล์ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Milecar" name="Milecar" value="{{$data->Mile_car}}" class="form-control form-control-sm"  placeholder="เลขไมล์" onchange="mile();" />
                                  @else
                                    <input type="text" id="Milecar" name="Milecar" value="{{$data->Mile_car}}" class="form-control form-control-sm"  placeholder="เลขไมล์" onchange="mile();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">รุ่น : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control form-control-sm"  placeholder="รุ่น" />
                                  @else
                                    <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control form-control-sm"  placeholder="รุ่น" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ราคากลาง : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Midpricecar" name="Midpricecar" value="{{$data->Midprice_car}}" class="form-control form-control-sm"  placeholder="ราคากลาง" maxlength="7" oninput="mile();percent();"/>
                                  @else
                                    <input type="text" id="Midpricecar" name="Midpricecar" value="{{$data->Midprice_car}}" class="form-control form-control-sm"  placeholder="ราคากลาง" maxlength="7" oninput="mile();percent();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่ทำประกัน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateFInsurance" value="{{$data->DateFInsurance_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำประกัน" />
                                  @else
                                    <input type="date" name="DateFInsurance" value="{{$data->DateFInsurance_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำประกัน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่หมดประกัน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateLInsurance" value="{{$data->DateLInsurance_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมดประกัน"/>
                                  @else
                                    <input type="date" name="DateLInsurance" value="{{$data->DateLInsurance_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมดประกัน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่ทำ พ.ร.บ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateFAct" value="{{$data->DateFAct_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำ พ.ร.บ" />
                                  @else
                                    <input type="date" name="DateFAct" value="{{$data->DateFAct_car}}"  min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำ พ.ร.บ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่หมด พ.ร.บ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateLAct" value="{{$data->DateLAct_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมด พ.ร.บ"/>
                                  @else
                                    <input type="date" name="DateLAct" value="{{$data->DateLAct_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมด พ.ร.บ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่ทำต่อทะเบียน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateFRegister" value="{{$data->DateFRegister_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำต่อทะเบียน" />
                                  @else
                                    <input type="date" name="DateFRegister" value="{{$data->DateFRegister_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่ทำต่อทะเบียน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่หมดทะเบียน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="date" name="DateLRegister" value="{{$data->DateLRegister_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมดทะเบียน"/>
                                  @else
                                    <input type="date" name="DateLRegister" value="{{$data->DateLRegister_car}}" min="{{$SetFDate}}" max="{{$SetTDate}}" class="form-control form-control-sm"  placeholder="วันที่หมดทะเบียน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <hr />
                          @include('analysis.script')

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ราคารถ : </label> 
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control form-control-sm"  placeholder="กรอกยอดจัด" oninput="percent();" />
                                  @else
                                    <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control form-control-sm"  placeholder="กรอกยอดจัด" oninput="percent();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                  <input type="hidden" id="TopcarOri" name="TopcarOri" class="form-control form-control-sm"  placeholder="กรอกยอดจัด" />
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ชำระต่องวด : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Paycar" name="Paycar" value="{{$data->Pay_car}}" class="form-control form-control-sm"/>
                                  @else
                                    <input type="text" id="Paycar" name="Paycar" value="{{$data->Pay_car}}" class="form-control form-control-sm" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อน : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" class="form-control form-control-sm"  placeholder="ระยะเวลาผ่อน"/>
                                  @else
                                    <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" class="form-control form-control-sm"  placeholder="ระยะเวลาผ่อน" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ภาษี x ระยะเวลาผ่อน : </label>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Taxcar" name="Taxcar" value="{{$data->Tax_car}}" class="form-control form-control-sm"/>
                                  @else
                                    <input type="text" id="Taxcar" name="Taxcar" value="{{$data->Tax_car}}" class="form-control form-control-sm" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Taxpaycar" name="Taxpaycar" value="{{$data->Taxpay_car}}" class="form-control form-control-sm" />
                                  @else
                                    <input type="text" id="Taxpaycar" name="Taxpaycar" value="{{$data->Taxpay_car}}" class="form-control form-control-sm" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }} />
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">
                                      ดอกเบี้ย :
                                </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="NewInterestcar" name="Interestcar" class="form-control form-control-sm"  value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" />
                                  @else
                                    <input type="text" id="NewInterestcar" name="Interestcar" class="form-control form-control-sm"  value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ค่างวด x ระยะเวลาผ่อน : </label>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Paymemtcar" name="Paymemtcar" value="{{$data->Paymemt_car}}" class="form-control form-control-sm" />
                                  @else
                                    <input type="text" id="Paymemtcar" name="Paymemtcar" value="{{$data->Paymemt_car}}" class="form-control form-control-sm" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }} />
                                  @endif
                                </div>
                                <div class="col-sm-4">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" id="Timepaymentcar" name="Timepaymentcar" value="{{$data->Timepayment_car}}" class="form-control form-control-sm"/>
                                  @else
                                    <input type="text" id="Timepaymentcar" name="Timepaymentcar" value="{{$data->Timepayment_car}}" class="form-control form-control-sm" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }} />
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">VAT : </label>
                                <div class="col-sm-8">
                                  <input type="text" id="Vatcar" name="Vatcar" value="{{$SettingValue->Taxvalue_set}} %" class="form-control form-control-sm" readonly />
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
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
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">แบบ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <select id="statuscar" name="statuscar" class="form-control form-control-sm" >
                                      <option value="" selected>--- เลือกแบบ ---</option>
                                      @foreach ($statuscarr as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->status_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @else
                                    @if($data->UserApp_Contract != Null)
                                      <input type="text" id="statuscar" name="statuscar" value="{{$data->status_car}}" class="form-control form-control-sm"  placeholder="สถานะ" readonly />
                                    @else
                                      <select id="statuscar" name="statuscar" class="form-control form-control-sm" >
                                        <option value="" selected>--- เลือกแบบ ---</option>
                                        @foreach ($statuscarr as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->status_car) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @endif
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่ชำระงวดแรก : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Dateduefirstcar" value="{{$data->Dateduefirst_car}}" class="form-control form-control-sm" placeholder="วันที่ชำระงวดแรก"/>
                                  @else
                                    <input type="text" name="Dateduefirstcar" value="{{$data->Dateduefirst_car}}" class="form-control form-control-sm" placeholder="วันที่ชำระงวดแรก" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                                <div class="col-sm-8">
                                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                    <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control form-control-sm"  placeholder="หมายเหตุ"/>
                                  @else
                                    <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control form-control-sm" placeholder="หมายเหตุ" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ค่าเปลี่ยนสัญญา : </label>
                                <div class="col-sm-8">
                                    <input type="text" value="2,500" class="form-control form-control-sm" readonly/>
                                </div>
                              </div>
                            </div>
                          </div>
                          <input type="hidden" name="MANAGER" value="{{ $data->ManagerApp_car }}" >
                          <input type="hidden" name="AUDIT" value="{{ $data->Approvers_car }}" />
                          <input type="hidden" name="MASTER" value="{{ $data->Check_car }}" >
                          <input type="hidden" name="doccomplete" value="{{ $data->DocComplete_car }}" >
                        
                        </div>
                        <div class="tab-pane fade" id="Sub-tab5" role="tabpanel" aria-labelledby="Sub-custom-tab5">
                          <h5 class="text-center"><b>ข้อมูลลงพื้นที ตรวจสอบ</b></h5>
                          <p></p>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title">รูปภาพผู้เช่าซื้อ</h3>
                  
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <div class="file-loading">
                                      <input id="image_checker_1" type="file" name="image_checker_1[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="card-title">
                                        รูปภาพผู้เช่าซื้อ
                                      </div>
                                      <div class="card-tools">
                                        <a href="{{ action('AnalysController@deleteImageAll',[$id,$Setlisence]) }}?type=2" class="pull-left DeleteImage">
                                          <i class="far fa-trash-alt"></i>
                                        </a>
                                      </div>
                                    </div>
                                    
                                    <div class="card-body">
                                      <div class="row">
                                        @foreach($dataImage as $key => $images)
                                          @if($images->Type_fileimage == "2")
                                            <div class="col-sm-2">
                                              <a href="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" data-toggle="lightbox" data-title="ภาพผู้เช่าซื้อ">
                                                <img src="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" class="img-fluid mb-2" alt="white sample">
                                              </a>
                                            </div>
                                          @endif
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card card-danger">
                                    <div class="card-header">
                                      <h3 class="card-title">หมายเหตุผู้เช่าซื้อ</h3>
                      
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                      </div>
                                    </div>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <textarea class="form-control form-control-sm" name="BuyerNote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->Buyer_note}}</textarea>
                                    @else
                                        <textarea class="form-control form-control-sm" name="BuyerNote" rows="3" placeholder="ป้อนหมายเหตุ..." {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Buyer_note}}</textarea>
                                    @endif
                                  </div>

                                </div> 
                                 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title">รูปภาพผู้ค้ำ</h3>
                  
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <div class="file-loading">
                                      <input id="image_checker_2" type="file" name="image_checker_2[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="card-title">
                                        รูปภาพผู้ค้ำ
                                      </div>
                                      <div class="card-tools">
                                        <a href="{{ action('AnalysController@deleteImageAll',[$id,$Setlisence]) }}?type=3" class="pull-left DeleteImage">
                                          <i class="far fa-trash-alt"></i>
                                        </a>
                                      </div>
                                    </div>
                                    
                                    <div class="card-body">
                                      <div class="row">
                                        @foreach($dataImage as $key => $images)
                                          @if($images->Type_fileimage == "3")
                                            <div class="col-sm-2">
                                              <a href="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" data-toggle="lightbox" data-title="ภาพผู้ค้ำ">
                                                <img src="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" class="img-fluid mb-2" alt="white sample">
                                              </a>
                                            </div>
                                          @endif
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card card-danger">
                                    <div class="card-header">
                                      <h3 class="card-title">หมายเหตุผู้ค้ำ</h3>
                      
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                      </div>
                                    </div>
                                    @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                      <textarea class="form-control form-control-sm" name="SupportNote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->Support_note}}</textarea>
                                    @else
                                        <textarea class="form-control form-control-sm" name="SupportNote" rows="3" placeholder="ป้อนหมายเหตุ..." {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->Support_note}}</textarea>
                                    @endif
                                  </div>

                                </div>  
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title">แผนที่</h3>
                  
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="myLat" style="">
                                          <div class="form-inline float-left">
                                            <label>ตำแหน่งที่ตั้งผู้เช่าซื้อ (A) : </label>
                                          </div>
                                            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                              <input type="text" id="Buyer_latlong" name="Buyer_latlong" class="form-control form-control-sm" value="{{ $data->Buyer_latlong }}"/>
                                            @else
                                                <input type="text" id="Buyer_latlong" name="Buyer_latlong" class="form-control form-control-sm" value="{{ $data->Buyer_latlong }}" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                            @endif
                                            <br>
                                          <div class="form-inline float-left">
                                            <label>ตำแหน่งที่ตั้งผู้ค้ำ (B): </label>
                                          </div>
                                            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                               <input type="text" id="Support_latlong" name="Support_latlong" class="form-control form-control-sm" value="{{ $data->Support_latlong }}"/>
                                            @else
                                                 <input type="text" id="Support_latlong" name="Support_latlong" class="form-control form-control-sm" value="{{ $data->Support_latlong }}" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                            @endif
                                      </div>
                                    </div>
                                  </div>
                                    <hr>
                                    <div id="map" style="width:100%;height:50vh"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="Sub-tab6" role="tabpanel" aria-labelledby="Sub-custom-tab6">
                           <h5 class="text-center"><b>ที่มาของรายได้</b></h5>
                           <p></p>
                           <div class="row">
                            <div class="col-md-6">
                              <div class="card card-info">
                                <div class="card-header">
                                  <h3 class="card-title">รายได้ผู้เช่าซื้อ</h3>
                  
                                  <div class="card-tools">
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button> -->
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">อาชีพ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <select name="Careerbuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- อาชีพ ---</option>
                                            @foreach ($Careerby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @else
                                        @if($Recontract == 'Y')
                                          <select name="Careerbuyer" class="form-control form-control-sm" >
                                            <option value="" selected>--- อาชีพ ---</option>
                                            @foreach ($Careerby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @else 
                                          @if($data->UserApp_Contract != Null)
                                            <input type="text" name="Careerbuyer" value="{{ $data->Career_buyer }}" class="form-control form-control-sm"  placeholder="เลือกอาชีพ" readonly/>
                                          @else
                                            <select name="Careerbuyer" class="form-control form-control-sm" >
                                              <option value="" selected>--- อาชีพ ---</option>
                                              @foreach ($Careerby as $key => $value)
                                                <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                              @endforeach
                                            </select>
                                          @endif
                                        @endif
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">รายได้ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <input type="text" id="Incomebuyer" name="Incomebuyer" value="{{ $data->Income_buyer }}" class="form-control form-control-sm" oninput="income();"/>
                                        @else
                                          <input type="text" id="Incomebuyer" name="Incomebuyer" value="{{ $data->Income_buyer }}" class="form-control form-control-sm" oninput="income();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">หักค่าใช้จ่าย : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control form-control-sm"  placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                        @else
                                          <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control form-control-sm"  placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }} />
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">รายได้หลังหักค่าใช้จ่าย : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control form-control-sm"  placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                        @else
                                          <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control form-control-sm"  placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }} />
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <textarea class="form-control form-control-sm" name="BuyerIncomeNote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->MemoIncome_buyer}}</textarea>
                                        @else
                                            <textarea class="form-control form-control-sm" name="BuyerIncomeNote" rows="3" placeholder="ป้อนหมายเหตุ..." {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->MemoIncome_buyer}}</textarea>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="file-loading">
                                      <input id="image_income_1" type="file" name="image_income_1[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <div class="card card-primary">
                                    <div class="card-header">
                                      <div class="card-title">
                                        รูปภาพรายได้ผู้เช่าซื้อ
                                      </div>
                                      <div class="card-tools">
                                        <a href="{{ action('AnalysController@deleteImageAll',[$id,$Setlisence]) }}?type=4" class="pull-left DeleteImage">
                                          <i class="far fa-trash-alt"></i>
                                        </a>
                                      </div>
                                    </div>
                                    
                                    <div class="card-body">
                                      <div class="row">
                                        @foreach($dataImage as $key => $images)
                                          @if($images->Type_fileimage == "4")
                                            <div class="col-sm-4">
                                              <a href="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                                <img id="ImgIncomeBuyer" src="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}">
                                              </a>
                                            </div>
                                          @endif
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>

                                </div> 
                                 
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="card card-danger">
                                <div class="card-header">
                                  <h3 class="card-title">รายได้ผู้ค้ำ</h3>
                  
                                  <div class="card-tools">
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button> -->
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">อาชีพ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <select name="careerSP" class="form-control form-control-sm">
                                            <option value="" selected>--- อาชีพ ---</option>
                                            @foreach ($Careerby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @else
                                          @if($Recontract == 'Y')
                                            <select name="careerSP" class="form-control form-control-sm">
                                              <option value="" selected>--- อาชีพ ---</option>
                                              @foreach ($Careerby as $key => $value)
                                                <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                              @endforeach
                                            </select>
                                          @else 
                                            @if($data->UserApp_Contract != Null)
                                              <input type="text" name="careerSP" value="{{$data->career_SP}}" class="form-control form-control-sm" placeholder="อาชีพ" readonly/>
                                            @else
                                              <select name="careerSP" class="form-control form-control-sm">
                                                <option value="" selected>--- อาชีพ ---</option>
                                                @foreach ($Careerby as $key => $value)
                                                  <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                                @endforeach
                                              </select>
                                            @endif
                                          @endif
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">รายได้ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <input type="text" id="incomeSP" name="incomeSP" value="{{$data->income_SP}}" class="form-control form-control-sm" oninput="income();"/>
                                        @else
                                          <input type="text" id="incomeSP" name="incomeSP" value="{{$data->income_SP}}" class="form-control form-control-sm" oninput="income();" {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}/>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ : </label>
                                      <div class="col-sm-8">
                                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                                          <textarea class="form-control form-control-sm" name="SupportIncomeNote" rows="3" placeholder="ป้อนหมายเหตุ...">{{$data->MemoIncome_SP}}</textarea>
                                        @else
                                          <textarea class="form-control form-control-sm" name="SupportIncomeNote" rows="3" placeholder="ป้อนหมายเหตุ..." {{ ($data->UserApp_Contract !== NULL) ? 'readonly' : '' }}>{{$data->MemoIncome_SP}}</textarea>
                                        @endif
                                      </div>
                                    </div>
                                    <br><br><br>
                                    <div class="file-loading">
                                      <input id="image_income_2" type="file" name="image_income_2[]" accept="image/*" data-min-file-count="1" multiple>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <div class="card card-danger">
                                    <div class="card-header">
                                      <div class="card-title">
                                        รูปภาพรายได้ผู้ค้ำ
                                      </div>
                                      <div class="card-tools">
                                        <a href="{{ action('AnalysController@deleteImageAll',[$id,$Setlisence]) }}?type=5" class="pull-left DeleteImage">
                                          <i class="far fa-trash-alt"></i>
                                        </a>
                                      </div>
                                    </div>
                                    
                                    <div class="card-body">
                                      <div class="row">
                                        @foreach($dataImage as $key => $images)
                                          @if($images->Type_fileimage == "5")
                                            <div class="col-sm-4">
                                              <a href="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true">
                                                <img id="ImgIncomeSupport" src="{{ asset('upload-image/'.$Setlisence.'/'.$images->Name_fileimage) }}">
                                              </a>
                                            </div>
                                          @endif
                                        @endforeach
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

                    <input type="hidden" name="_method" value="PATCH"/>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </section>

  <script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
  </script>

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>

  {{-- image --}}
  <script type="text/javascript">
    $("#image-file,#Account_image,#image_checker_1,#image_checker_2,#image_income_1,#image_income_2").fileinput({
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

  @if($data->Buyer_latlong != NULL)
    @php
      @$SetBuyerlatlong = explode(",",$data->Buyer_latlong);
      @$Buyerlat = $SetBuyerlatlong[0];
      @$Buyerlong = $SetBuyerlatlong[1];
    @endphp
  @else 
    @php
      $Buyerlat = 0;
      $Buyerlong = 0;
    @endphp
  @endif

  @if($data->Support_latlong != NULL)
   @php
      @$SetSupportlatlong = explode(",",$data->Support_latlong);
      @$Supportlat = $SetSupportlatlong[0];
      @$Supportlong = $SetSupportlatlong[1];
    @endphp
  @else 
    @php
      $Supportlat = 0;
      $Supportlong = 0;
    @endphp
  @endif

  <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
          center: {lat: 6.6637053, lng: 101.2183787}
        });
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // var labels = 'BA';

        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i],
            // title: 'ตำแหน่งที่ตั้ง'
          });
        });
        

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        var locations = [
        {lat: {{ $Buyerlat }}, lng: {{ $Buyerlong }} },
        {lat: {{ $Supportlat }}, lng: {{ $Supportlong }} }
        ]
  </script>

  <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHvHdio8MNE9aqZZmfvd49zHgLbixudMs&callback=initMap&language=th">
  </script>

  <script>
    $('#StatusContract').on("change" ,function() {
      var GetStatus = document.getElementById('StatusContract').value;
      if(GetStatus == 'เปลี่ยนสัญญา'){
        $("#UpdateCont").removeAttr('disabled', true);
      }
      else{
        $("#UpdateCont").attr('disabled', true);
      }
    });
  </script>

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

    $('#Topcar,#Paycar,#Timeslackencar').on("input" ,function() {
        var GetTopcar = document.getElementById('Topcar').value;
        var Topcar = GetTopcar.replace(",","");
        $("#Topcar").val(addCommas(Topcar));

        var GetPaycar = document.getElementById('Paycar').value;
        var GetTimeslack = document.getElementById('Timeslackencar').value;
        var Paycar = GetPaycar.replace(",","");
        var GetPaymemtcar = Paycar / 1.07;
        var GetTimepaymentcar = GetPaymemtcar * GetTimeslack;
        var GetTaxcar = Paycar - GetPaymemtcar;
        var GetTaxpaycar = GetTaxcar * GetTimeslack;
        var GetTotal1 = Paycar * GetTimeslack;
        var GetTotal2 = GetTimepaymentcar + GetTaxpaycar;
        
        
        $("#Paycar").val(addCommas(Paycar));
        $("#Paymemtcar").val(addCommas(GetPaymemtcar.toFixed(2)));
        $("#Timepaymentcar").val(addCommas(GetTimepaymentcar.toFixed(2)));
        $("#Taxcar").val(addCommas(GetTaxcar.toFixed(2)));
        $("#Taxpaycar").val(addCommas(GetTaxpaycar.toFixed(2)));
        $("#Totalpay1car").val(addCommas(GetTotal1.toFixed(2)));
        $("#Totalpay2car").val(addCommas(GetTotal2.toFixed(2)));

    });
  </script>
@endsection
