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
              <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">แบบฟอร์มค่าใช้จ่าย</a></li>
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
                <form name="form1" method="post" action="{{ action('AnalysController@update',$id) }}" enctype="multipart/form-data">
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
                                <!-- <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-options="zoomMode: magnifier">
                                <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}"></a> -->

                                <!-- <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" ata-gallery="gallery" data-options="zoomPosition: inner">
                                <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}"></a> -->

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
                                     <label>เลขที่โฉนด : </label>
                                     <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                 </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                     <label>เนื้อที่ : </label>
                                     <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;9-9-99&quot;" data-mask=""/>
                                   </div>
                                </div>

                                <div class="col-md-6">
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
                            </div>

                            <div class="row">
                                <div class="col-md-5">
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

                                <div class="col-md-6">
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
                              </div>

                            <div class="row">
                              <div class="col-md-5">
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

                              <div class="col-md-6">
                               </div>
                            </div>
                          </div>
                        <div class="tab-pane" id="tab_3">
                          <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ยี่ห้อ : </label>
                                   <select name="Brandcar" class="form-control" style="width: 250px;">
                                     <option value="" disabled selected>--- ยี่ห้อ ---</option>
                                     @foreach ($Brandcarr as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->Brand_car) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                   <label>ปี : </label>
                                   <select name="Yearcar" class="form-control" style="width: 250px;">

                                     <option value="{{$data->Year_car}}" selected>{{$data->Year_car}}</option>
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
                                 <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control" style="width: 250px;" placeholder="สี" />
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>ป้ายเดิม : </label>
                                 <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" />
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ป้ายใหม่ : </label>
                                 <input type="text" name="Nowlicensecar" value="{{$data->Nowlicense_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เลขไมล์ : </label>
                                 <input type="text" name="Milecar" value="{{$data->Mile_car}}" class="form-control" style="width: 250px;" placeholder="เลขไมล์" />
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>รุ่น : </label>
                                 <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                               </div>
                            </div>

                            <div class="col-md-6">
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

                                    if(num55 == ''){
                                      var num5 = 0;
                                    }else if (num5 == 0) {
                                      var num1 = parseFloat(num1) - parseFloat(num6);
                                    }
                              console.log(num1);

                                   if(num5 > 6700){
                                     var totaltopcar = parseFloat(num1) - parseFloat(num6);
                                   }else {
                                     if (num5 == 0) {
                                       var totaltopcar = parseFloat(num1);
                                     }else {
                                       var totaltopcar = parseFloat(num1)+parseFloat(num5);
                                     }
                                   }

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
                                 if(num1 > 1000){
                                     if(num11 == ''){
                                       var num11 = 0;
                                     }
                                     else{
                                       var sumCom = (num11*0.03);
                                       var result = num11 - sumCom;
                                     }
                                 }else{
                                   var result = num1;
                                 }
                                 if(!isNaN(num11)){
                                     document.form1.Commissioncar.value = addCommas(num1);
                                     document.form1.commitPrice.value = addCommas(result);
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

                                  var temp = document.getElementById('tempTopcar').value;
                                  var toptemp = temp.replace(",","");

                                  var ori = document.getElementById('TopcarOri').value;
                                  var Topori = ori.replace(",","");

                                  if(num8 > 6700){
                                  var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                                 }else{
                                   var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6);
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
                                    var TotalBalance = parseFloat(Topori)-result;
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
                          </script>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ยอดจัด : </label>
                                <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" onchange="calculate()" />
                                <input type="hidden" id="TopcarOri" name="TopcarOri" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" />
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ชำระต่องวด : </label>
                                <input type="text" id="Paycar" name="Paycar" value="{{$data->Pay_car}}" class="form-control" style="width: 250px;" readonly onchange="calculate()" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                             <div class="form-inline" align="right">
                               <label>VAT : </label>
                               <input type="text" id="Vatcar" name="Vatcar" value="{{$data->Vat_car}}" class="form-control" style="width: 250px;" placeholder="7 %" value="7 %" readonly onchange="calculate()"/>
                             </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ภาษี / ระยะเวลาผ่อน : </label>
                                <input type="text" id="Taxcar" name="Taxcar" value="{{$data->Tax_car}}" class="form-control" style="width: 123px;" readonly />
                                <input type="text" id="Taxpaycar" name="Taxpaycar" value="{{$data->Taxpay_car}}" class="form-control" style="width: 123px;" readonly />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ดอกเบี้ย : </label>
                                 <select id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;">
                                   <option value="" disabled selected>--- ดอกเบี้ย ---</option>
                                   @foreach ($Interestcarr as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $data->Interest_car) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                                 </select>
                               </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                 <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                 <input type="text" id="Paymemtcar" name="Paymemtcar" value="{{$data->Paymemt_car}}" class="form-control" style="width: 123px;" readonly />
                                 <input type="text" id="Timepaymentcar" name="Timepaymentcar" value="{{$data->Timepayment_car}}" class="form-control" style="width: 123px;" readonly />
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ระยะเวลาผ่อน : </label>
                                 <select id="Timeslackencar" name="Timeslackencar" class="form-control" style="width: 250px;" onchange="calculate()">
                                   <option value="" disabled selected>--- ระยะเวลาผ่อน ---</option>
                                   @foreach ($Timeslackencarr as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Timeslacken_car) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>ยอดผ่อนชำระทั้งหมด : </label>
                                 <input type="text" id="Totalpay1car" name="Totalpay1car" value="{{$data->Totalpay1_car}}" class="form-control" style="width: 123px;" readonly />
                                 <input type="text" id="Totalpay2car" name="Totalpay2car" value="{{$data->Totalpay2_car}}" class="form-control" style="width: 123px;" readonly />
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>วันที่ชำระงวดแรก : </label>
                                 <input type="text" name="Dateduefirstcar" value="{{$data->Dateduefirst_car}}" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>ประกันภัย : </label>
                                 <select name="Insurancecar" class="form-control" style="width: 250px;">
                                   <option value="" disabled selected>--- ประกันภัย ---</option>
                                   @foreach ($Insurancecarr as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Insurance_car) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>สถานะ : </label>
                                 <select name="statuscar" class="form-control" style="width: 250px;">
                                   <option value="" disabled selected>--- สถานะ ---</option>
                                   @foreach ($statuscarr as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $data->status_car) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                                 </select>
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เปอร์เซ็นจัดไฟแนนซ์ : </label>
                                 <input type="text" name="Percentcar" value="{{$data->Percent_car}}" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" />
                             </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ผู้รับเงิน : </label>
                                 <input type="text" name="Payeecar" value="{{$data->Payee_car}}" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เลขที่บัญชี : </label>
                                 <input type="text" name="Accountbrancecar" value="{{$data->Accountbrance_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" data-inputmask="&quot;mask&quot;:&quot;999-9-99999-9&quot;" data-mask=""/>
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สาขา : </label>
                                <input type="text" name="branchbrancecar" value="{{$data->branchbrance_car}}" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="Tellbrancecar" value="{{$data->Tellbrance_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>แนะนำ/นายหน้า : </label>
                                 <input type="text" name="Agentcar" value="{{$data->Agent_car}}" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" />
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เลขที่บัญชี : </label>
                                 <input type="text" name="Accountagentcar" value="{{$data->Accountagent_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" data-inputmask="&quot;mask&quot;:&quot;999-9-99999-9&quot;" data-mask=""/>
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ค่าคอม : </label>
                                <input type="text" id="Commissioncar" name="Commissioncar" value="{{number_format($data->Commission_car, 2)}}" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission()"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สาขา : </label>
                                <input type="text" name="branchAgentcar" value="{{$data->branchAgent_car}}" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า"/>
                              </div>
                            </div>
                          </div>

                         <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                <select name="Purchasehistorycar" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ซื้อ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Purchasehistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>

                                <label>ค้ำ : </label>
                                <select name="Supporthistorycar" class="form-control" style="width: 108px;">
                                  <option value="" disabled selected>--- ค้ำ ---</option>
                                  @foreach ($HisCarby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Supporthistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                           </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                <input type="text" name="Tellagentcar" value="{{$data->Tellagent_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>หมายเหตุ : </label>
                                <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                            </div>
                          </div>

{{--
                          <!-- <hr /> -->
                          <!-- <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label><font color="red">เจ้าหน้าที่สินเชื่อ : </font></label>
                                 <select name="Loanofficercar" class="form-control" style="width: 250px;" required>
                                   <option value="" disabled selected>--- เจ้าหน้าที่สินเชื่อ ---</option>
                                   @foreach ($Loanofficercarr as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->Loanofficer_car) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                 <label><font color="red">สาขา : </font></label>
                                 <select name="branchcar" class="form-control" style="width: 250px;" required>
                                   <option value="" disabled selected>--- เลือกสาขา ---</option>
                                   @foreach ($branchcarr as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->branch_car) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               </div>
                            </div>
                           </div> -->
--}}
                        </div>
                        <div class="tab-pane" id="tab_4">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>พรบ. : </label>
                                 <input type="text" id="actPrice" name="actPrice" value="{{number_format($data->act_Price)}}" class="form-control" style="width: 250px;" placeholder="พรบ." onchange="balance()"/>
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เปอร์เซ็นต์ค่าคอม : </label>
                                 <input type="hidden" id="tempTopcar" value="{{$data->Top_car}}" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="รวมยอดจัด" readonly/>
                                 <input type="text" name="vatPrice" value="{{$data->vat_Price}}" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ยอดปิดบัญชี : </label>
                                <input type="text" id="closeAccountPrice" name="closeAccountPrice" value="{{number_format($data->closeAccount_Price)}}" class="form-control" style="width: 250px;" placeholder="ยอดปิดบัญชี" onchange="balance()"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                               <label>ซื้อ ป2+ : </label>
                               <input type="text" id="P2Price" name="P2Price" value="{{number_format($data->P2_Price)}}" class="form-control" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate()"/>
                               <input type="hidden" id="P2PriceOri" name="P2PriceOri" class="form-control" value="{{number_format($data->P2_Price)}}" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate()"/>
                             </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ค่าใช้จ่ายขนส่ง : </label>
                                 <input type="text" id="tranPrice" name="tranPrice" value="{{number_format($data->tran_Price)}}" class="form-control" style="width: 250px;" placeholder="ค่าใช้จ่ายขนส่ง" onchange="balance()"/>
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>อื่นๆ : </label>
                                 <input type="text" id="otherPrice" name="otherPrice" value="{{number_format($data->other_Price)}}" class="form-control" style="width: 250px;" placeholder="อื่นๆ" onchange="balance()"/>
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ค่าประเมิน : </label>
                                 <select id="evaluetionPrice" name="evaluetionPrice" class="form-control" style="width: 250px;" onchange="balance()">
                                   <option value="" disabled selected>--- ค่าประเมิน ---</option>
                                   @foreach ($evaluetionPricee as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->evaluetion_Price) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                               <label>อากร : </label>
                               <input type="text" id="dutyPrice" name="dutyPrice" value="{{$data->duty_Price}}" class="form-control" style="width: 250px;" placeholder="อากร" onchange="balance()" readonly />
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ค่าการตลาด : </label>
                                <input type="text" id="marketingPrice" name="marketingPrice" value="{{ $data->marketing_Price }}" class="form-control" style="width: 250px;" placeholder="การตลาด" onchange="balance()" readonly />
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>รวม คชจ. : </label>
                                 <input type="text" id="totalkPrice" name="totalkPrice" value="{{number_format($data->totalk_Price, 2)}}" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance()" readonly/>
                                 <input type="hidden" id="temptotalkPrice" name="temptotalkPrice" value="{{number_format($data->totalk_Price, 2)}}" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance()"/>
                               </div>
                            </div>
                          </div>

                          <hr>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>คงเหลือ : </label>
                                 <input type="text" id="balancePrice" name="balancePrice" value="{{number_format($data->balance_Price)}}" class="form-control" style="width: 250px;" placeholder="คงเหลือ" readonly/>
                               </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-inline" align="right">
                                  <label>ค่าคอมหลังหัก 3% : </label>
                                  <input type="text" id="commitPrice" name="commitPrice" value="{{number_format($data->commit_Price, 2)}}" class="form-control" style="width: 250px;" placeholder="ค่าคอมหลังหัก" readonly/>
                                </div>
                             </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <br/>
                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                    <table class="table table-bordered" id="table" border="3" align="center" style="width: 30%;" align="center">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center"><font color="red"><h3>ลงชื่อ ผู้อนุมัติ</h3></font></th>
                          <th class="text-center"><font color="red"><h3>ลงชื่อ ตรวจสอบ</h3></font></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="text-center">
                            <p></p>
                            <label class="con">
                            @if($data->Approvers_car != Null)
                              <input type="checkbox" class="checkbox" name="Approverscar" id="" value="{{ auth::user()->name }}" checked="checked"> <!-- checked="checked"  -->
                            @else
                              <input type="checkbox" class="checkbox" name="Approverscar" id="" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                            @endif
                            <span class="checkmark"></span>
                            <p></p>
                            </label>
                          </th>
                          <th class="text-center">
                            <p></p>
                            <label class="con">
                            @if($data->Check_car != Null)
                              <input type="checkbox" class="checkbox" name="Checkcar" id="" value="{{ $data->Check_car }}" checked="checked"> <!-- checked="checked"  -->
                            @else
                              <input type="checkbox" class="checkbox" name="Checkcar" id="" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                            @endif
                            <span class="checkmark"></span>
                            <p></p>
                            </label>
                          </th>

                          @if ( $data->DocComplete_car != Null)
                            <input type="hidden" class="checkbox" name="doccomplete" id="" value="{{ $data->DocComplete_car }}" checked="checked"> <!-- checked="checked"  -->
                          @else
                            <input type="hidden" class="checkbox" name="doccomplete" id="" value="">
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  @else
                    <table class="table table-bordered" id="table" border="3" align="center" style="width: 30%;" align="center">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center"><font color="red"><h3>ตรวจสอบเอกสาร</h3></font></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="text-center">
                            <p></p>
                            <label class="con">
                              @if ( $data->DocComplete_car != Null)
                                <input type="checkbox" class="checkbox" name="doccomplete" id="" value="{{ auth::user()->name }}" checked="checked"> <!-- checked="checked"  -->
                              @else
                                <input type="checkbox" class="checkbox" name="doccomplete" id="" value="{{ auth::user()->name }}">
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
