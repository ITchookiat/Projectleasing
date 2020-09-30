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

      <section class="content">
        <form name="form1" method="post" action="{{ action('AnalysController@updatehomecar',[$id,$Gettype]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-inline">
                        <h4>แก้ไขรายการสินเชื่อรถบ้าน</h4>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="card-tools d-inline float-right">
                        <button type="submit" class="delete-modal btn btn-success">
                          <i class="fas fa-save"></i> อัพเดต
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',4) }}?Fromdate={{$fdate}}&Todate={{$tdate}}&status={{$status}}">
                          <i class="far fa-window-close"></i> ยกเลิก
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-3"></div>
                      <div class="col-sm-9">
                        <ol class="breadcrumb float-sm-right">
                          @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MANAGER")
                            <div class="float-right form-inline">
                              <i class="fas fa-grip-vertical"></i>
                              <span class="todo-wrap">
                                <input type="checkbox" id="1" class="checkbox" name="approversHC" value="{{ auth::user()->name }}" {{ ($data->approvers_HC !== NULL) ? 'checked' : '' }}> <!-- checked="checked"  -->
                                <label for="1" class="todo">
                                  <i class="fa fa-check"></i>
                                  <span class="text"><font color="red">อนุมัติ</font></span>
                                </label>
                              </span>
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
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Contract_buyer" class="form-control form-control-sm" value="{{ $data->Contract_buyer }}" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ทำสัญญา : </font></label>
                                  <div class="col-sm-8">
                                    <input type="date" name="DateDue" class="form-control form-control-sm" value="{{ $newDateDue }}">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อ :</label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">นามสกุล :</label>
                                  <div class="col-sm-8">
                                    <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control form-control-sm"  placeholder="ป้อนนามสกุล" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น :</label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control form-control-sm" placeholder="ป้อนชื่อเล่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะ :</label>
                                  <div class="col-sm-8">
                                    <select name="Statusbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกสถานะ ---</option>
                                      @foreach ($Statusby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6"> 
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรอื่นๆ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">คู่สมรส : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control form-control-sm" placeholder="ป้อนคู่สมรส" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ซื้อ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
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
                                      @foreach ($Addby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control form-control-sm" placeholder="ป้อนสถานที่ทำงาน" />
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
                                      @foreach ($Houseby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ใบขับขี่ : </label>
                                  <div class="col-sm-8">
                                    <select name="Driverbuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                      @foreach ($Driverby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Careerby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Incomeby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Income_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติการซื้อ/ค้ำ : </label>
                                  <div class="col-sm-4">
                                    <select name="Purchasebuyer" class="form-control form-control-sm" style="width: 108px;">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="Supportbuyer" class="form-control form-control-sm" style="width: 108px;">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="Beforeincome" name="Beforeincome" class="form-control form-control-sm" value="{{number_format($data->BeforeIncome_buyer,0)}}" placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะผู้เช่าซื้อ : </label>
                                  <div class="col-sm-8">
                                    <select name="Gradebuyer" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                      @foreach ($GradeBuyer as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="Afterincome" name="Afterincome" class="form-control form-control-sm" value="{{number_format($data->AfterIncome_buyer,0)}}" placeholder="หลังหักค่าใช้จ่าย" onchange="income();" />
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
                                  @if($countImage != 0)
                                    @php
                                      $path = $data->oldplate_HC;
                                    @endphp
                                  <br/>
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <a href="{{ action('AnalysController@deleteImageAll',[$data->id,$path]) }}" class="btn btn-danger pull-left DeleteImage" title="ลบรูปภาพทั้งหมด"> ลบรูปภาพทั้งหมด..</a>
                                  @endif
                                    <a href="{{ action('AnalysController@deleteImageEach',[$Gettype,$data->id,$fdate,$tdate,$status,$path]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                    <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                    </a>
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
                                    @if($data->oldplate_HC != NULL)
                                      @php
                                        $Setlisence = $data->oldplate_HC;
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
                                    <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control form-control-sm" placeholder="ชื่อ" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">นามสกุล : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control form-control-sm" placeholder="นามสกุล" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control form-control-sm" placeholder="ชื่อเล่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานะ : </label>
                                  <div class="col-sm-8">
                                    <select name="statusSP" class="form-control form-control-sm">
                                      <option value="" selected>--- สถานะ ---</option>
                                      @foreach ($Statusby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control form-control-sm" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ความสัมพันธ์ : </label>
                                  <div class="col-sm-8">
                                    <select name="relationSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ความสัมพันธ์ ---</option>
                                      @foreach ($relationSP as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control form-control-sm" placeholder="คู่สมรส" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขบัตรปชช.ผู้ค่ำ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
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
                                      @foreach ($Addby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control form-control-sm" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รายละเอียดที่อยู่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">สถานที่ทำงาน : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control form-control-sm" placeholder="สถาที่ทำงาน" />
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
                                      @foreach ($Houseby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($securitiesSPp as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control form-control-sm" placeholder="เลขที่โฉนด" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เนื้อที่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control form-control-sm" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
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
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Careerby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <select name="incomeSP" class="form-control form-control-sm">
                                      <option value="" selected>--- รายได้ ---</option>
                                      @foreach ($Incomeby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->income_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="supportSP" class="form-control form-control-sm">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Brandcarr as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->brand_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ปี : </label>
                                  <div class="col-sm-8">
                                    <select name="yearHC" class="form-control form-control-sm">
                                      <option value="{{$data->year_HC}}" selected>{{$data->year_HC}}</option>
                                      <option value="">--------------------</option>
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
                                    <input type="text" name="colourHC" value="{{ $data->colour_HC }}" class="form-control form-control-sm" placeholder="สี" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ป้ายเดิม : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="oldplateHC"  value="{{ $data->oldplate_HC}}" class="form-control form-control-sm" readonly/>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ป้ายใหม่ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="newplateHC" value="{{$data->newplate_HC}}" class="form-control form-control-sm" placeholder="ป้ายใหม่" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เลขไมล์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="mileHC" value="{{$data->mile_HC}}" class="form-control form-control-sm" placeholder="เลขไมล์" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รุ่น : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="modelHC" value="{{$data->model_HC}}" class="form-control form-control-sm" placeholder="รุ่น" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประเภทรถ : </label>
                                  <div class="col-sm-8">
                                    <select name="typeHC" class="form-control form-control-sm">
                                      <option value="" selected>--- ประเภทรถ ---</option>
                                      @foreach ($GetypeHC as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->type_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="priceHC" name="priceHC" value="{{$data->price_HC}}" class="form-control form-control-sm" placeholder="ราคารถ" oninput="priceHomecar()"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เงินดาวน์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="downpayHC" name="downpayHC" value="{{$data->downpay_HC}}" class="form-control form-control-sm" placeholder="เงินดาวน์" oninput="priceHomecar()"/>
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
                                      @foreach ($Getinsurance as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->insurancefee_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Gettransfer as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->transfer_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="toppriceHC" name="toppriceHC" value="{{$data->topprice_HC}}" class="form-control form-control-sm" placeholder="กรอกยอดจัด" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย : </label>
                                  <div class="col-sm-8">
                                    <select id="interestHC" name="interestHC" class="form-control form-control-sm" oninput="priceHomecar()">
                                      <option value="" selected>--- ดอกเบี้ย ---</option>
                                      @foreach ($Getinterest as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->interest_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="vatHC" name="vatHC" value="{{$data->vat_HC}}" class="form-control form-control-sm" value="7 %" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-8">
                                    <select id="periodHC" name="periodHC" class="form-control form-control-sm" oninput="priceHomecar()">
                                      <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                                      @foreach ($Timeslackencarr as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->period_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" id="payporHC" name="payporHC" value="{{$data->paypor_HC}}" class="form-control form-control-sm" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่างวด/ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="paymentHC" name="paymentHC" value="{{$data->payment_HC}}" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="payperriodHC" name="payperriodHC" value="{{$data->payperriod_HC}}" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ภาษี/ระยะเวลาผ่อน : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="taxHC" name="taxHC" value="{{$data->tax_HC}}" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="taxperriodHC" name="taxperriodHC" value="{{$data->taxperriod_HC}}" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ยอดผ่อนชำระทั้งหมด : </label>
                                  <div class="col-sm-4">
                                    <input type="text" id="totalinstalmentsHC" name="totalinstalmentsHC" value="{{$data->totalinstalments_HC}}" class="form-control form-control-sm" readonly />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" id="totalinstalments1HC" name="totalinstalments1HC" value="{{$data->totalinstalments1_HC}}" class="form-control form-control-sm" readonly />
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
                                      @foreach ($GetbaabHC as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->baab_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($GetguaranteeHC as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->guarantee_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="firstpayHC" value="{{$data->firstpay_HC}}" class="form-control form-control-sm" readonly placeholder="วันที่ชำระงวดแรก" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประกันภัย : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="insuranceHC" value="{{$data->insurance_HC}}" class="form-control form-control-sm" placeholder="ประกันภัย" />
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
                                    <input type="text" name="agentHC" value="{{$data->agent_HC}}" class="form-control form-control-sm" placeholder="แนะนำ/นายหน้า" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เบอร์โทรศัพท์ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="telHC" value="{{$data->tel_HC}}" class="form-control form-control-sm" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ค่าคอม : </label>
                                  <div class="col-sm-8">
                                    <input type="text" id="commitHC" name="commitHC" value="{{$data->commit_HC}}" class="form-control form-control-sm" placeholder="ค่าคอม"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ประวัติการซื้อ/ค้ำ : </label>
                                  <div class="col-sm-4">
                                    <select name="purchhisHC" class="form-control form-control-sm">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->purchhis_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-sm-4">
                                    <select name="supporthisHC" class="form-control form-control-sm">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->supporthis_HC) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                    <input type="text" name="otherHC" value="{{$data->other_HC}}" class="form-control form-control-sm" placeholder="หมายเหตุ"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">พนักงานขาย : </label>
                                  <div class="col-sm-8">
                                    <select name="saleHC" class="form-control form-control-sm">
                                      <option value="" selected>--- พนักงานขาย ---</option>
                                      <option value="มารุวัน หะยีเจะแม" {{ ($data->sale_HC === 'มารุวัน หะยีเจะแม') ? 'selected' : '' }}>มารุวัน หะยีเจะแม</option>
                                      <option value="แวยูคิมสี อาแว" {{ ($data->sale_HC === 'แวยูคิมสี อาแว') ? 'selected' : '' }}>แวยูคิมสี อาแว</option>
                                      <option value="จิราวรรณ คงพัฒน์" {{ ($data->sale_HC === 'จิราวรรณ คงพัฒน์') ? 'selected' : '' }}>จิราวรรณ คงพัฒน์</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="fdate" value="{{ $fdate }}" />
                    <input type="hidden" name="tdate" value="{{ $tdate }}" />
                    <input type="hidden" name="branch" value="{{ $data->branchUS_HC }}" />
                    <input type="hidden" name="status" value="{{ $status }}" />
                    
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
                                    <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>นามสกุล : </label>
                                    <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ชื่อเล่น : </label>
                                    <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>สถานะ : </label>
                                    <select name="statusSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- สถานะ ---</option>
                                      @foreach ($Statusby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->status_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เบอร์โทร : </label>
                                    <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ความสัมพันธ์ : </label>
                                    <select name="relationSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ความสัมพันธ์ ---</option>
                                      @foreach ($relationSPp as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->relation_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>คู่สมรส : </label>
                                    <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขบัตรประชาชน : </label>
                                    <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ : </label>
                                    <select name="addSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ที่อยู่ ---</option>
                                      @foreach ($Addby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->add_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                    <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>รายละเอียดที่อยู่ : </label>
                                    <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>สถานที่ทำงาน : </label>
                                    <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ลักษณะบ้าน : </label>
                                    <select name="houseSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                      @foreach ($Houseby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->house_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประเภทหลักทรัพย์ : </label>
                                    <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                      @foreach ($securitiesSPp as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->securities_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เลขที่โฉนด : </label>
                                    <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>เนื้อที่ : </label>
                                    <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประเภทบ้าน : </label>
                                    <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- ประเภทบ้าน ---</option>
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->housestyle_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>อาชีพ : </label>
                                    <select name="careerSP2" class="form-control" style="width: 200px;">
                                      <option value="" selected>--- อาชีพ ---</option>
                                      @foreach ($Careerby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->career_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
                                      @foreach ($Incomeby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->income_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-5">
                                  <div class="float-right form-inline">
                                    <label>ประวัติซื้อ : </label>
                                    <select name="puchaseSP2" class="form-control" style="width: 85px;">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->puchase_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>

                                    <label>ค้ำ : </label>
                                    <select name="supportSP2" class="form-control" style="width: 80px;">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->support_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
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
      </section>
    </div>
  </section>

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
