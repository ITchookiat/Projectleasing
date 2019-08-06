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
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
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

  <style>
   readonly{
     background-color: #FFFFFF;
   }
  </style>

  <style>
    body {
      font-family: Arial;
      margin: 0;
    }
    * {
      box-sizing: border-box;
    }
    img {
      vertical-align: middle;
    }
    .container {
      position: relative;
    }
    .mySlides {
      display: none;
    }
    .cursor {
      cursor: pointer;
    }
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 40%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    .caption-container {
      text-align: center;
      background-color: #222;
      padding: 2px 16px;
      color: white;
    }
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    .column {
      float: left;
      width: 16.66%;
    }
    .demo {
      opacity: 0.6;
    }
    .active,
    .demo:hover {
      opacity: 1;
    }
  </style>


    <section class="content-header">
      <h1>
        สินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="card-title p-3" align="center">แก้ไขข้อมูลสัญญา</h3>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-success">
              <li class="nav-item active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">แบบฟอร์มผู้เช่าซื้อ</a></li>
              <li class="nav-item"><a href="#tab_2" data-toggle="tab" aria-expanded="false">แบบฟอร์มผู้ค้ำ</a></li>
              <li class="nav-item"><a href="#tab_3" data-toggle="tab" aria-expanded="false">แบบฟอร์มรถยนต์</a></li>
            </ul>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                <li>กรุณาลงชื่อ ผู้อนุมัติ {{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif

            <div class="row">
              <div class="col-md-12"> <br />
                <form name="form1" method="post" action="{{ action('AnalysController@update',[$id,$Gettype]) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                          <div class="row">
                             <div class="col-md-5">
                               <div class="form-inline" align="right">
                                  <label><font color="red">เลขที่สัญญา : </font></label>
                                  <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" value="{{ $data->Contract_buyer }}" />
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-inline" align="right">
                                  <label><font color="red">วันที่ทำสัญญา : </font></label>
                                  <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ $newDateDue }}" min="{{ $date2 }}">
                                </div>
                             </div>
                          </div>

                          <hr />
                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ชื่อ : </label>
                                <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>นามสกุล : </label>
                                <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control" style="width: 250px;"  placeholder="ป้อนนามสกุล" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ชื่อเล่น : </label>
                                <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สถานะ : </label>
                                <select name="Statusbuyer" class="form-control" style="width: 250px;">
                                    <option value="" disabled selected>--- เลือกสถานะ ---</option>
                                    @foreach ($Statusby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรอื่นๆ : </label>
                                <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>คู่สมรส : </label>
                                <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เลขบัตรประชาชน : </label>
                                <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ที่อยู่ : </label>
                                <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- เลือกที่อยู่ ---</option>
                                  @foreach ($Addby as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>รายละเอียดที่อยู่ : </label>
                                <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สถานที่ทำงาน : </label>
                                <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ลักษณะบ้าน : </label>
                                <select name="Housebuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- เลือกลักษณะบ้าน ---</option>
                                  @foreach ($Houseby as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ใบขับขี่ : </label>
                                <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- เลือกใบขับขี่ ---</option>
                                  @foreach ($Driverby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ประเภทบ้าน : </label>
                                <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- ประเภทบ้าน ---</option>
                                  @foreach ($HouseStyleby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>อาชีพ : </label>
                                <select name="Careerbuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- อาชีพ ---</option>
                                  @foreach ($Careerby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>รายได้ : </label>
                                <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- รายได้ ---</option>
                                  @foreach ($Incomeby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Income_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                <select name="Purchasebuyer" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ซื้อ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>

                                <label>ค้ำ : </label>
                                <select name="Supportbuyer" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ค้ำ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
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
                                  <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              @foreach($dataImage as $images)
                                <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true" style="width: 300px; height: auto;">
                                  <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}">
                                </a>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ชื่อ : </label>
                                   <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>นามสกุล : </label>
                                   <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                 </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                  <label>ชื่อเล่น : </label>
                                  <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>สถานะ : </label>
                                   <select name="statusSP" class="form-control" style="width: 250px;">
                                     <option value="" disabled selected>--- สถานะ ---</option>
                                     @foreach ($Statusby as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                  </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>เบอร์โทร : </label>
                                   <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                  <label>ความสัมพันธ์ : </label>
                                   <select name="relationSP" class="form-control" style="width: 250px;">
                                     <option value="" disabled selected>--- ความสัมพันธ์ ---</option>
                                     @foreach ($relationSPp as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>คู่สมรส : </label>
                                   <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>เลขบัตรประชาชน : </label>
                                   <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                 </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                     <label>ที่อยู่ : </label>
                                     <select name="addSP" class="form-control" style="width: 250px;">
                                       <option value="" disabled selected>--- ที่อยู่ ---</option>
                                       @foreach ($Addby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   </div>
                                </div>

                                <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                     <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>รายละเอียดที่อยู่ : </label>
                                   <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>สถาที่ทำงาน : </label>
                                   <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control" style="width: 250px;" placeholder="สถาที่ทำงาน" />
                                 </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                     <label>ลักษณะบ้าน : </label>
                                     <select name="houseSP" class="form-control" style="width: 250px;">
                                       <option value="" disabled selected>--- เลือกลักษณะบ้าน ---</option>
                                       @foreach ($Houseby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>ประเภทหลักทรัพย์ : </label>
                                     <select name="securitiesSP" class="form-control" style="width: 250px;">
                                       <option value="" disabled selected>--- ประเภทหลักทรัพย์ ---</option>
                                       @foreach ($securitiesSPp as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                    <label>เลขที่โฉนด : </label>
                                    <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>เนื้อที่ : </label>
                                     <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;9-9-99&quot;" data-mask=""/>
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                    <label>ประเภทบ้าน : </label>
                                    <select name="housestyleSP" class="form-control" style="width: 250px;">
                                      <option value="" disabled selected>--- ประเภทบ้าน ---</option>
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>อาชีพ : </label>
                                     <select name="careerSP" class="form-control" style="width: 250px;">
                                       <option value="" disabled selected>--- อาชีพ ---</option>
                                       @foreach ($Careerby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   </div>
                                </div>
                              </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                  <label>รายได้ : </label>
                                  <select name="incomeSP" class="form-control" style="width: 250px;">
                                    <option value="" disabled selected>--- รายได้ ---</option>
                                    @foreach ($Incomeby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->income_SP) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                   <label>ประวัติซื้อ/ค้ำ : </label>
                                   <select name="puchaseSP" class="form-control" style="width: 108px;">
                                     <option value="" disabled selected>--- ซื้อ ---</option>
                                     @foreach ($HisCarby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>

                                   <label>ค้ำ : </label>
                                   <select name="supportSP" class="form-control" style="width: 108px;">
                                      <option value="" disabled selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                   </select>
                                 </div>
                               </div>
                            </div>
                          </div>
                        <div class="tab-pane" id="tab_3">
                          <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ยี่ห้อ : </label>
                                   <select name="brandHC" class="form-control" style="width: 250px;">
                                     <option value="" disabled selected>--- ยี่ห้อ ---</option>
                                     @foreach ($Brandcarr as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->brand_HC) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>ปี : </label>
                                   <select name="yearHC" class="form-control" style="width: 250px;">
                                     <option value="{{$data->year_HC}}" selected>{{$data->year_HC}}</option>
                                     <option value="" disabled>--------------------</option>
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
                                 <input type="text" name="colourHC" value="{{ $data->colour_HC }}" class="form-control" style="width: 250px;" placeholder="สี" />
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>ป้ายเดิม : </label>
                                 <input type="text" name="oldplateHC"  value="{{ $data->oldplate_HC}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" />
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ป้ายใหม่ : </label>
                                 <input type="text" name="newplateHC" value="{{$data->newplate_HC}}" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>เลขไมล์ : </label>
                                 <input type="text" name="mileHC" value="{{$data->mile_HC}}" class="form-control" style="width: 250px;" placeholder="เลขไมล์" />
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>รุ่น : </label>
                                 <input type="text" name="modelHC" value="{{$data->model_HC}}" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                               </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                 <label>ประเภทรถ : </label>
                                 <input type="text" name="typeHC" value="{{$data->type_HC}}" class="form-control" style="width: 250px;" placeholder="ประเภทรถ" />
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
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ราคารถ : </label>
                                <input type="text" id="priceHC" name="priceHC" value="{{$data->price_HC}}" class="form-control" style="width: 250px;" placeholder="ราคารถ" oninput="priceHomecar()"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เงินดาวน์ : </label>
                                <input type="text" id="downpayHC" name="downpayHC" value="{{$data->downpay_HC}}" class="form-control" style="width: 250px;" placeholder="เงินดาวน์" oninput="priceHomecar()"/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ค่าประกัน : </label>
                                <select id="insurancefeeHC" name="insurancefeeHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                  <option value="" disabled selected>--- ค่าประกัน ---</option>
                                  @foreach ($Getinsurance as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->insurancefee_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ค่าโอน : </label>
                                <select id="transferHC" name="transferHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                  <option value="" disabled selected>--- ค่าโอน ---</option>
                                  @foreach ($Gettransfer as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->transfer_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ยอดจัด : </label>
                                <input type="text" id="toppriceHC" name="toppriceHC" value="{{$data->topprice_HC}}" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ดอกเบี้ย : </label>
                                <select id="interestHC" name="interestHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                  <option value="" disabled selected>--- ดอกเบี้ย ---</option>
                                  @foreach ($Getinterest as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->interest_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>VAT : </label>
                                <input type="text" id="vatHC" name="vatHC" value="{{$data->vat_HC}}" class="form-control" style="width: 250px;" value="7 %" readonly/>
                              </div>

                            </div>
                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ระยะเวลาผ่อน : </label>
                                <select id="periodHC" name="periodHC" class="form-control" style="width: 250px;" oninput="priceHomecar()">
                                  <option value="" disabled selected>--- ระยะเวลาผ่อน ---</option>
                                  @foreach ($Timeslackencarr as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->period_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ชำระต่องวด : </label>
                                <input type="text" id="payporHC" name="payporHC" value="{{$data->paypor_HC}}" class="form-control" style="width: 250px;" readonly/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                <input type="text" id="paymentHC" name="paymentHC" value="{{$data->payment_HC}}" class="form-control" style="width: 123px;" readonly />
                                <input type="text" id="payperriodHC" name="payperriodHC" value="{{$data->payperriod_HC}}" class="form-control" style="width: 123px;" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ภาษี / ระยะเวลาผ่อน : </label>
                                <input type="text" id="taxHC" name="taxHC" value="{{$data->tax_HC}}" class="form-control" style="width: 123px;" readonly />
                                <input type="text" id="taxperriodHC" name="taxperriodHC" value="{{$data->taxperriod_HC}}" class="form-control" style="width: 123px;" readonly />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ยอดผ่อนชำระทั้งหมด : </label>
                                <input type="text" id="totalinstalmentsHC" name="totalinstalmentsHC" value="{{$data->totalinstalments_HC}}" class="form-control" style="width: 123px;" readonly />
                                <input type="text" id="totalinstalments1HC" name="totalinstalments1HC" value="{{$data->totalinstalments1_HC}}" class="form-control" style="width: 123px;" readonly />
                              </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>แบบ : </label>
                                <select name="baabHC" class="form-control" style="width: 250px;">
                                  <option value="" disabled selected>--- สถานะ ---</option>
                                  @foreach ($statuscarr as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->baab_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ค้ำประกัน : </label>
                                <input type="text" name="guaranteeHC" value="{{$data->guarantee_HC}}" class="form-control" style="width: 250px;" placeholder="ค้ำประกัน" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>วันที่ชำระงวดแรก : </label>
                                <input type="text" name="firstpayHC" value="{{$data->firstpay_HC}}" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ประกันภัย : </label>
                                <input type="text" name="insuranceHC" value="{{$data->insurance_HC}}" class="form-control" style="width: 250px;" placeholder="ประกันภัย" />
                              </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>แนะนำ/นายหน้า : </label>
                                <input type="text" name="agentHC" value="{{$data->agent_HC}}" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="telHC" value="{{$data->tel_HC}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ค่าคอม : </label>
                                <input type="text" id="commitHC" name="commitHC" value="{{$data->commit_HC}}" class="form-control" style="width: 250px;" placeholder="ค่าคอม"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                <select name="purchhisHC" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ซื้อ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->purchhis_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                                <label>ค้ำ : </label>
                                <select name="supporthisHC" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ค้ำ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->supporthis_HC) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>หมายเหตุ : </label>
                                <input type="text" name="otherHC" value="{{$data->other_HC}}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>พนักงานขาย : </label>
                                <input type="text" name="saleHC" value="{{$data->sale_HC}}" class="form-control" style="width: 250px;" placeholder="พนักงานขาย"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="fdate" value="{{ $fdate }}" />
                  <input type="hidden" name="tdate" value="{{ $tdate }}" />
                  <input type="hidden" name="branch" value="{{ $branch }}" />
                  <input type="hidden" name="status" value="{{ $status }}" />
                  <br/>
                   @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4)
                    <table class="table table-bordered" id="table" border="3" align="center" style="width: 50%;" align="center">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center"><font color="red"><h3 class="card-title p-3">อนุมัติ</h3></font></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="text-center">
                            <p></p>
                            <label class="con">
                            @if($data->approvers_HC != Null)
                              <input type="checkbox" class="checkbox" name="approversHC" id="" value="{{ auth::user()->name }}" checked="checked"> <!-- checked="checked"  -->
                            @else
                              <input type="checkbox" class="checkbox" name="approversHC" id="" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                            @endif
                            <span class="checkmark"></span>
                            <p></p>
                            </label>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  @endif

                  <br>
                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div>
                  <input type="hidden" name="_method" value="PATCH"/>
                </form>

              </div>
            </div>

        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>

      <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
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

<!-- เวลาแจ้งเตือน -->
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

    </section>
@endsection
