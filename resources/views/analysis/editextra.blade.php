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

  </style>

    <section class="content-header">
      <h1>
        @if($type == 8)
          ปรับโครงสร้างหนี้
        @elseif($type == 12)
          มาตรการ COVID-19
        @endif
        <!-- <small>it all starts here</small> -->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          @if($data->StatusApp_car != 'อนุมัติ')
            @if($type == 8)
              <h4 class="card-title p-3" align="center">แก้ไขข้อมูลสัญญา (ปรับโครงสร้างหนี้)</h4>
            @elseif($type == 12)
              <h4 class="card-title p-3" align="center">แก้ไขข้อมูลสัญญา (มาตรการช่วยเหลือ)</h4>
            @endif
          @else
            @if($type == 8)
              <h4 class="card-title p-3" align="center">รายละเอียดข้อมูลสัญญา (ปรับโครงสร้างหนี้)</h4>
            @elseif($type == 12)
              <h4 class="card-title p-3" align="center">รายละเอียดข้อมูลสัญญา (มาตรการช่วยเหลือ)</h4>
            @endif
          @endif
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs bg-danger">
            <li class="nav-item active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">แบบฟอร์มผู้เช่าซื้อ</a></li>
            <li class="nav-item"><a href="#tab_2" data-toggle="tab" aria-expanded="false">แบบฟอร์มผู้ค้ำ</a></li>
            <li class="nav-item"><a href="#tab_3" data-toggle="tab" aria-expanded="false">แบบฟอร์มรถยนต์</a></li>
            <!-- <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">แบบฟอร์มค่าใช้จ่าย</a></li> -->
          </ul>
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

          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <strong>สำเร็จ!</strong> {{ session()->get('success') }}
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
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Contract_buyer" class="form-control" maxlength="12"  style="width: 250px;" value="{{ $data->Contract_buyer }}" />
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" value="{{ $data->Contract_buyer }}" readonly/>
                                    @else
                                        @if($data->StatusApp_car == 'อนุมัติ')
                                          <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" value="{{ $data->Contract_buyer }}"/>
                                        @else
                                          <input type="text" name="Contract_buyer" maxlength="8" class="form-control" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" style="width: 250px;" value="{{ $data->Contract_buyer }}"/>
                                        @endif
                                    @endif
                                  @endif
                                </div>
                             </div>

                             <div class="col-md-6">
                                <div class="form-inline" align="right">
                                  <label><font color="red">วันที่ทำสัญญา : </font></label>
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ $newDateDue }}">
                                  @else
                                    @if($GetDocComplete != Null)
                                      <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ $newDateDue }}" readonly>
                                    @else
                                      <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ $newDateDue }}">
                                    @endif
                                  @endif
                                </div>
                             </div>
                          </div>

                          <hr />
                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ชื่อ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" readonly/>
                                  @else
                                    <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>นามสกุล : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control" style="width: 250px;"  placeholder="ป้อนนามสกุล" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control" style="width: 250px;"  placeholder="ป้อนนามสกุล" readonly/>
                                  @else
                                    <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control" style="width: 250px;"  placeholder="ป้อนนามสกุล" />
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ชื่อเล่น : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" readonly/>
                                  @else
                                    <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เลขบัตรประชาชน : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                  @else
                                    <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" readonly/>
                                  @else
                                    <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรอื่นๆ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" readonly/>
                                  @else
                                    <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>คู่สมรส : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" readonly/>
                                  @else
                                    <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ที่อยู่ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- เลือกที่อยู่ ---</option>
                                    @foreach ($Addby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Addressbuyer" value="{{ $data->Address_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกที่อยู่" readonly/>
                                  @else
                                    <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                      <option value=""  selected>--- เลือกที่อยู่ ---</option>
                                      @foreach ($Addby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Address_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>รายละเอียดที่อยู่ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" readonly/>
                                  @else
                                    <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" readonly/>
                                  @else
                                    <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>อาชีพ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Careerbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- อาชีพ ---</option>
                                    @foreach ($Careerby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Careerbuyer" value="{{ $data->Career_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกอาชีพ" readonly/>
                                  @else
                                    <select name="Careerbuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- อาชีพ ---</option>
                                      @foreach ($Careerby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Career_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สถานที่ทำงาน : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" readonly/>
                                  @else
                                    <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>เลขที่โฉนด : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" readonly/>
                                  @else
                                    <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ประเภทหลักทรัพย์ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="securitiesbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                    @foreach ($securitiesSPp as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->securities_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="securitiesbuyer" value="{{ $data->securities_buyer }}" class="form-control" style="width: 250px;" placeholder="ประเภทหลักทรัพย์" readonly/>
                                  @else
                                    <select name="securitiesbuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                      @foreach ($securitiesSPp as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->securities_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>เนื้อที่ : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" readonly/>
                                   @else
                                      <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                   @endif
                                 @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>วัตถุประสงค์ของสินเชื่อ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <!-- <select name="objectivecar" class="form-control" style="width: 250px;"> -->
                                  <select id="objectivecar" name="objectivecar" class="form-control" style="width: 250px;" oninput="calculate();">
                                    <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                    @foreach ($objectivecar as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Objective_car) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" id="objectivecar" name="objectivecar" value="{{ $data->Objective_car }}" class="form-control" style="width: 250px;" placeholder="เลือกวัตถุประสงค์ของสินเชื่อ" readonly/>
                                  @else
                                    <select id="objectivecar" name="objectivecar" class="form-control" style="width: 250px;" oninput="calculate();">
                                      <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                      @foreach ($objectivecar as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Objective_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <hr>
                          <input type="hidden" name="fdate" value="{{ $fdate }}" />
                          <input type="hidden" name="tdate" value="{{ $tdate }}" />
                          <input type="hidden" name="branch" value="{{ $branch }}" />
                          <input type="hidden" name="status" value="{{ $status }}" />

                          <div class="row">
                            <div class="col-md-12">
                              <h3 class="text-center">รูปภาพประกอบ</h3>

                                <div class="form-group">
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
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

                                    @if($countImage != 0)
                                      <br/>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <a href="{{ action('AnalysController@deleteImageAll',$data->id) }}" class="btn btn-danger pull-left" title="ลบรูปทั้งหมด" onclick="return confirm('คุณต้องการลบรูปทั้งหมดหรือไม่?')"> ลบรูปทั้งหมด..</a>
                                        <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                          <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                        </a>
                                      @else
                                        @if($data->Approvers_car == Null)
                                          @if($GetDocComplete == Null)
                                          <a href="{{ action('AnalysController@deleteImageEach',[$type,$data->id,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
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
                          <div class="col-md-12">
                            <div class="form-group">
                              @foreach($dataImage as $images)
                              <div class="col-sm-3">
                                <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true" style="width: 300px; height: auto;">
                                  <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}">
                                </a>
                              </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                          <a class="btn btn-default pull-right" title="แก้ไขข้อมูลผู้ค้ำที่ 2" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                            <i class="fa fa-users fa-lg"></i>
                          </a>
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ชื่อ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อ" readonly/>
                                     @else
                                        <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                   <label>นามสกุล : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control" style="width: 250px;" placeholder="นามสกุล" readonly/>
                                     @else
                                        <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                     @endif
                                   @endif
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ชื่อเล่น : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" readonly/>
                                     @else
                                        <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>เลขบัตรประชาชน : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                   @else
                                      <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                   @endif
                                 @endif
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>เบอร์โทร : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" readonly/>
                                     @else
                                        <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                   <label>ความสัมพันธ์ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select name="relationSP" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- ความสัมพันธ์ ---</option>
                                       @foreach ($relationSPp as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @else
                                     @if($GetDocComplete != Null)
                                       <input type="text" name="relationSP" value="{{$data->relation_SP}}" class="form-control" style="width: 250px;" placeholder="เลือกความสัมพันธ์" readonly/>
                                     @else
                                       <select name="relationSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ความสัมพันธ์ ---</option>
                                         @foreach ($relationSPp as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->relation_SP) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @endif
                                   @endif
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>คู่สมรส : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control" style="width: 250px;" placeholder="คู่สมรส" readonly/>
                                     @else
                                        <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>ที่อยู่ : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                   <select name="addSP" class="form-control" style="width: 250px;">
                                     <option value="" selected>--- ที่อยู่ ---</option>
                                     @foreach ($Addby as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 @else
                                   @if($GetDocComplete != Null)
                                   <input type="text" name="addSP" value="{{$data->add_SP}}" class="form-control" style="width: 250px;" placeholder="เลือกที่อยู่" readonly/>
                                   @else
                                     <select name="addSP" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- ที่อยู่ ---</option>
                                       @foreach ($Addby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->add_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @endif
                                 @endif
                               </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>รายละเอียดที่อยู่ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" readonly/>
                                     @else
                                        <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                               <div class="form-inline" align="right">
                                   <label>สถานที่ทำงาน : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" readonly/>
                                     @else
                                        <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                                     @endif
                                   @endif
                               </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                    <label>อาชีพ : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <select name="careerSP" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- อาชีพ ---</option>
                                        @foreach ($Careerby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="careerSP" value="{{$data->career_SP}}" class="form-control" style="width: 250px;" placeholder="อาชีพ" readonly/>
                                      @else
                                        <select name="careerSP" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- อาชีพ ---</option>
                                          @foreach ($Careerby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->career_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                   </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>ประเภทหลักทรัพย์ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="securitiesSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                         @foreach ($securitiesSPp as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                       <input type="text" name="securitiesSP" value="{{$data->securities_SP}}" class="form-control" style="width: 250px;" placeholder="ประเภทหลักทรัพย์" readonly/>
                                       @else
                                         <select name="securitiesSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                           @foreach ($securitiesSPp as $key => $value)
                                             <option value="{{$key}}" {{ ($key == $data->securities_SP) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif
                                   </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                      <label>เลขที่โฉนด : </label>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                      @else
                                        @if($GetDocComplete != Null)
                                          <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" readonly/>
                                        @else
                                          <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                        @endif
                                      @endif
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>เนื้อที่ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" readonly/>
                                       @else
                                          <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                       @endif
                                     @endif
                                   </div>

                                </div>
                            </div>
                          </div>
                        <div class="tab-pane" id="tab_3">
                          <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ยี่ห้อ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select name="Brandcar" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- ยี่ห้อ ---</option>
                                       @foreach ($Brandcarr as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->Brand_car) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="Brandcar" value="{{$data->Brand_car}}" class="form-control" style="width: 250px;" placeholder="ยี่ห้อ" readonly/>
                                     @else
                                       <select name="Brandcar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ยี่ห้อ ---</option>
                                         @foreach ($Brandcarr as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->Brand_car) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @endif
                                   @endif
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                   <label>ปี : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select id="Yearcar" name="Yearcar" class="form-control" style="width: 250px;" onchange="calculate();">
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
                                        <input type="text" name="Yearcar" value="{{$data->Year_car}}" class="form-control" style="width: 250px;" placeholder="ปี" readonly/>
                                     @else
                                       <select id="Yearcar" name="Yearcar" class="form-control" style="width: 250px;" onchange="calculate();">
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

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                    <label>สี : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control" style="width: 250px;" placeholder="สี" />
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control" style="width: 250px;" placeholder="สี" readonly/>
                                      @else
                                         <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control" style="width: 250px;" placeholder="สี" />
                                      @endif
                                    @endif
                                   </div>
                                </div>

                                <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ป้ายทะเบียน : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" />
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" readonly/>
                                       @else
                                          <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" />
                                       @endif
                                     @endif
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

                              function percent(){
                                var num11 = document.getElementById('Midpricecar').value;
                                var num1 = num11.replace(",","").replace(",","");
                                var num22 = document.getElementById('Topcar').value;
                                var num2 = num22.replace(",","");
                                var percent = (num2/num1) * 100;
                                if(!isNaN(percent) && num1 != ''){
                                  document.form1.Percentcar.value = percent.toFixed(0);
                                  document.form1.Midpricecar.value = addCommas(num1);
                                  document.form1.Topcar.value = addCommas(num2);
                                }
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
                          @if($type == 8)
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
                          @elseif($type == 12)
                            <script>
                              function calculate(){
                                var num11 = document.getElementById('Topcar').value;
                                var num1 = num11.replace(",","");
                                var num33 = document.getElementById('Vatcar').value;
                                var num3 = num33.replace(",","");
                                var num2 = document.getElementById('Interestcar').value;
                                var num4 = document.getElementById('Timeslackencar').value;
                                var num5 = document.getElementById('objectivecar').value;

                                if(num5 == 'พักชำระหนี้ 3 เดือน'){
                                  var vatTop = 0;
                                }else{
                                  var vatTop = parseFloat(num1)*0.07;
                                }
                                // var vatTop = parseFloat(num1)*0.07;
                                var newTop = parseFloat(num1)+vatTop;
                                var vat = (100+parseFloat(num2))/100;
                                var result = Math.round((newTop*vat)/12);
                                var tax = vatTop/num4;
                                var tax2 = tax.toFixed(2)*num4;
                                var durate = result-tax;
                                var durate2 = durate.toFixed(2)*num4;
                                var total = result*num4;
                                var total2 = durate2+tax2;

                                if(!isNaN(result)){
                                  document.form1.Topcar.value = addCommas(num1);
                                  document.form1.Vatcar.value = addCommas(vatTop.toFixed(0));
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
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ยอดจัด : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" />
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" readonly/>
                                  @else
                                      <input type="text" id="Topcar" name="Topcar" value="{{number_format($data->Top_car)}}" class="form-control" style="width: 250px;" placeholder="กรอกยอดจัด" oninput="calculate();balance();percent();" />
                                  @endif
                                @endif
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
                               <label>ระยะเวลาผ่อน : </label>
                               @if(auth::user()->type == 1 or auth::user()->type == 2)
                                <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" placeholder="ป้อนระยะเวลาผ่อน" class="form-control" style="width: 250px;" onchange="calculate();" />
                               @else
                                 @if($GetDocComplete != Null)
                                   <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" class="form-control" style="width: 250px;" placeholder="ระยะเวลาผ่อน" readonly />
                                 @else
                                   <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" placeholder="ป้อนระยะเวลาผ่อน" class="form-control" style="width: 250px;" onchange="calculate();" />
                                 @endif
                               @endif
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
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" onchange="calculate();"/>
                                 @else
                                   @if($GetDocComplete != Null)
                                     <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" onchange="calculate();" readonly/>
                                   @else
                                     <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" onchange="calculate();"/>
                                   @endif
                                 @endif
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
                                <label>VAT : </label>
                                <input type="text" id="Vatcar" name="Vatcar" value="{{$data->Vat_car}}" class="form-control" style="width: 250px;background-color: white;" onchange="calculate();"/>
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
                                <label>หมายเหตุ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ" readonly/>
                                  @else
                                      <input type="text" name="Notecar" value="{{$data->Note_car}}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                  @endif
                                @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>วันที่ชำระงวดแรก : </label>
                                 @php
                                  $a = date_create($data->Dateduefirst_car);
                                  $Dateduefirs = date_format($a, 'Y-m-d');
                                 @endphp
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                 <input type="date" name="Dateduefirstcar" value="{{$Dateduefirs}}" class="form-control" style="width: 250px;" placeholder="วันที่ชำระงวดแรก" />
                                 @else
                                 <input type="date" name="Dateduefirstcar" value="{{$Dateduefirs}}" class="form-control" style="width: 250px;" placeholder="วันที่ชำระงวดแรก" readonly/>
                                 @endif
                               </div>
                            </div>
                          </div>
                          @if(auth::user()->type == 1 or auth::user()->type == 2)
                              <input type="hidden" name="statuscar" value="{{$data->status_car}}" class="form-control" style="width: 250px;" />
                          @else
                            @if($GetDocComplete != Null)
                                <input type="hidden" name="statuscar" value="{{$data->status_car}}" class="form-control" style="width: 250px;" readonly/>
                            @else
                                <input type="hidden" name="statuscar" value="{{$data->status_car}}" class="form-control" style="width: 250px;" />
                            @endif
                          @endif

                        </div>
                        <div class="tab-pane" id="tab_4" style="display:none;">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>พรบ. : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" id="actPrice" name="actPrice" value="{{number_format($data->act_Price)}}" class="form-control" style="width: 250px;" placeholder="พรบ." onchange="balance();"/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" id="actPrice" name="actPrice" value="{{number_format($data->act_Price)}}" class="form-control" style="width: 250px;" placeholder="พรบ." onchange="balance();" readonly/>
                                   @else
                                      <input type="text" id="actPrice" name="actPrice" value="{{number_format($data->act_Price)}}" class="form-control" style="width: 250px;" placeholder="พรบ." onchange="balance();"/>
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เปอร์เซ็นต์ค่าคอม : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="vatPrice" value="{{$data->vat_Price}}" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="vatPrice" value="{{$data->vat_Price}}" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" readonly/>
                                   @else
                                      <input type="text" name="vatPrice" value="{{$data->vat_Price}}" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                                   @endif
                                 @endif
                                 <input type="hidden" id="tempTopcar" value="{{$data->Top_car}}" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="รวมยอดจัด" readonly/>
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ยอดปิดบัญชี : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" id="closeAccountPrice" name="closeAccountPrice" value="{{number_format($data->closeAccount_Price)}}" class="form-control" style="width: 250px;" placeholder="ยอดปิดบัญชี" onchange="balance()"/>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" id="closeAccountPrice" name="closeAccountPrice" value="{{number_format($data->closeAccount_Price)}}" class="form-control" style="width: 250px;" placeholder="ยอดปิดบัญชี" onchange="balance()" readonly/>
                                  @else
                                    <input type="text" id="closeAccountPrice" name="closeAccountPrice" value="{{number_format($data->closeAccount_Price)}}" class="form-control" style="width: 250px;" placeholder="ยอดปิดบัญชี" onchange="balance()"/>
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                               <label>ซื้อ ป2+ / ป1 : </label>
                               @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" id="P2Price" name="P2Price" value="{{number_format($data->P2_Price)}}" class="form-control" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();"/>
                               @else
                                 @if($GetDocComplete != Null)
                                    <input type="text" id="P2Price" name="P2Price" value="{{number_format($data->P2_Price)}}" class="form-control" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();" readonly/>
                                 @else
                                    <input type="text" id="P2Price" name="P2Price" value="{{number_format($data->P2_Price)}}" class="form-control" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();"/>
                                 @endif
                               @endif
                               <input type="hidden" id="P2PriceOri" name="P2PriceOri" class="form-control" value="{{number_format($data->P2_Price)}}" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();" readonly/>
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
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                   <select id="evaluetionPrice" name="evaluetionPrice" class="form-control" style="width: 250px;" onchange="balance()">
                                     <option value="" selected>--- ค่าประเมิน ---</option>
                                     @foreach ($evaluetionPricee as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->evaluetion_Price) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 @else
                                   @if($GetDocComplete != Null)
                                     <input type="text" id="evaluetionPrice" name="evaluetionPrice" value="{{ $data->evaluetion_Price }}" class="form-control" style="width: 250px;" placeholder="พรบ." onchange="balance()" readonly/>
                                   @else
                                     <select id="evaluetionPrice" name="evaluetionPrice" class="form-control" style="width: 250px;" onchange="balance()">
                                       <option value="" selected>--- ค่าประเมิน ---</option>
                                       @foreach ($evaluetionPricee as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->evaluetion_Price) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @endif
                                 @endif
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
                                 <input type="hidden" id="temptotalkPrice" name="temptotalkPrice" value="{{number_format($data->totalk_Price, 2)}}" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance()" readonly/>
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

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>หมายเหตุ : </label>
                                 <input type="text" name="notePrice" value="{{ $data->note_Price }}" class="form-control" style="width: 250px;" placeholder="หมายเหตุ" />
                               </div>
                             </div>

                             <div class="col-md-6">
                             </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <br>
                  <hr />
                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                    <table class="table table-bordered" id="table" border="3" align="center" style="width: 50%;" align="center">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center"><font color="red"><h3 class="card-title p-3">อนุมัติ</h3></font></th>
                          <th class="text-center"><font color="red"><h3 class="card-title p-3">ตรวจสอบ</h3></font></th>
                          <th class="text-center"><font color="red"><h3 class="card-title p-3">ปิดสิทธิ์แก้ไข</h3></font></th>
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

                          <th class="text-center">
                            <p></p>
                            <label class="con">
                              @if ( $data->DocComplete_car != Null)
                                <input type="checkbox" class="checkbox" name="doccomplete" id="" value="{{ $data->DocComplete_car }}" checked="checked"> <!-- checked="checked"  -->
                              @else
                                <input type="checkbox" class="checkbox" name="doccomplete" id="" value="">
                              @endif
                            <span class="checkmark"></span>
                            <p></p>
                            </label>
                          </th>


                        </tr>
                      </tbody>
                    </table>
                    @else
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
                                @if ( $data->DocComplete_car != Null)
                                  <input type="checkbox" class="checkbox" checked="checked" disabled> <!-- checked="checked"  -->
                                  <input type="hidden" class="checkbox" name="doccomplete" id="" value="{{ $data->DocComplete_car }}"> <!-- checked="checked"  -->
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
                    @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4)
                      <button type="submit" class="delete-modal btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                      </button>
                      @if($type == 8)
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',8) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      @elseif($type == 12)
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',12) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      @endif
                    @else
                      @if($data->StatusApp_car != 'อนุมัติ')
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                        </button>
                        @if($type == 8)
                          <a class="delete-modal btn btn-danger" href="{{ route('Analysis',8) }}">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        @elseif($type == 12)
                          <a class="delete-modal btn btn-danger" href="{{ route('Analysis',12) }}">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        @endif
                      @else
                        <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                          <span class="glyphicon glyphicon-arrow-left"></span> ย้อนกลับ
                        </a>
                      @endif
                    @endif

                  </div>
                  <input type="hidden" name="_method" value="PATCH"/>

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
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" readonly/>
                                     @else
                                        <input type="text" name="nameSP2" value="{{$data->name_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                     @endif
                                   @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                    <label>นามสกุล : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" readonly/>
                                      @else
                                         <input type="text" name="lnameSP2" value="{{$data->lname_SP2}}" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                      @endif
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>ชื่อเล่น : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" readonly/>
                                     @else
                                        <input type="text" name="niknameSP2" value="{{$data->nikname_SP2}}" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                     @endif
                                   @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                    <label>สถานะ : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <select name="statusSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- สถานะ ---</option>
                                        @foreach ($Statusby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->status_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="statusSP2" value="{{$data->status_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกสถานะ" readonly/>
                                      @else
                                        <select name="statusSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- สถานะ ---</option>
                                          @foreach ($Statusby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->status_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>เบอร์โทร : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask="" readonly/>
                                     @else
                                        <input type="text" name="telSP2" value="{{$data->tel_SP2}}" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     @endif
                                   @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                    <label>ความสัมพันธ์ : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <select name="relationSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- ความสัมพันธ์ ---</option>
                                        @foreach ($relationSPp as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->relation_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                        <input type="text" name="relationSP2" value="{{$data->relation_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกความสัมพันธ์" readonly/>
                                      @else
                                        <select name="relationSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ความสัมพันธ์ ---</option>
                                          @foreach ($relationSPp as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->relation_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>คู่สมรส : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" readonly/>
                                     @else
                                        <input type="text" name="mateSP2" value="{{$data->mate_SP2}}" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                     @endif
                                   @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                    <label>เลขบัตรประชาชน : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                      @else
                                         <input type="text" name="idcardSP2" value="{{$data->idcard_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                      @endif
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                     <label>ที่อยู่ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="addSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- ที่อยู่ ---</option>
                                         @foreach ($Addby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->add_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                       <input type="text" name="addSP2" value="{{$data->add_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกที่อยู่" readonly/>
                                       @else
                                         <select name="addSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- ที่อยู่ ---</option>
                                           @foreach ($Addby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->add_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif
                                   </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                      <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                         <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                      @else
                                        @if($GetDocComplete != Null)
                                           <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" readonly/>
                                        @else
                                           <input type="text" name="addnowSP2" value="{{$data->addnow_SP2}}" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                        @endif
                                      @endif
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>รายละเอียดที่อยู่ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" readonly/>
                                     @else
                                        <input type="text" name="statusaddSP2" value="{{$data->statusadd_SP2}}" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                     @endif
                                   @endif
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                    <label>สถานที่ทำงาน : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" readonly/>
                                      @else
                                         <input type="text" name="workplaceSP2" value="{{$data->workplace_SP2}}" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                      @endif
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                     <label>ลักษณะบ้าน : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="houseSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                         @foreach ($Houseby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->house_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                       <input type="text" name="houseSP2" value="{{$data->house_SP2}}" class="form-control" style="width: 200px;" placeholder="เลือกลักษณะบ้าน" readonly/>
                                       @else
                                         <select name="houseSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                           @foreach ($Houseby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->house_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif
                                   </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>ประเภทหลักทรัพย์ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                         @foreach ($securitiesSPp as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->securities_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                       <input type="text" name="securitiesSP2" value="{{$data->securities_SP2}}" class="form-control" style="width: 200px;" placeholder="ประเภทหลักทรัพย์" readonly/>
                                       @else
                                         <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                           @foreach ($securitiesSPp as $key => $value)
                                             <option value="{{$key}}" {{ ($key == $data->securities_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                      <label>เลขที่โฉนด : </label>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                      @else
                                        @if($GetDocComplete != Null)
                                          <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" readonly/>
                                        @else
                                          <input type="text" name="deednumberSP2" value="{{$data->deednumber_SP2}}" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                        @endif
                                      @endif
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>เนื้อที่ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask="" readonly/>
                                       @else
                                          <input type="text" name="areaSP2" value="{{$data->area_SP2}}" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                       @endif
                                     @endif
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                      <label>ประเภทบ้าน : </label>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          @foreach ($HouseStyleby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->housestyle_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else
                                        @if($GetDocComplete != Null)
                                           <input type="text" name="housestyleSP2" value="{{$data->housestyle_SP2}}" class="form-control" style="width: 200px;" placeholder="ประเภทบ้าน" readonly/>
                                        @else
                                          <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            @foreach ($HouseStyleby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->housestyle_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                        @endif
                                      @endif
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>อาชีพ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="careerSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- อาชีพ ---</option>
                                         @foreach ($Careerby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->career_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="careerSP2" value="{{$data->career_SP2}}" class="form-control" style="width: 200px;" placeholder="อาชีพ" readonly/>
                                       @else
                                         <select name="careerSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- อาชีพ ---</option>
                                           @foreach ($Careerby as $key => $value)
                                             <option value="{{$key}}" {{ ($key == $data->career_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif
                                   </div>
                                </div>
                              </div>
                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                    <label>รายได้ : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <select name="incomeSP2" class="form-control" style="width: 200px;">
                                        <option value="" selected>--- รายได้ ---</option>
                                        @foreach ($Incomeby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->income_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="incomeSP2" value="{{$data->income_SP2}}" class="form-control" style="width: 200px;" placeholder="รายได้" readonly/>
                                      @else
                                        <select name="incomeSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- รายได้ ---</option>
                                          @foreach ($Incomeby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->income_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                  </div>
                                  </div>
                                <div class="col-md-6">
                                  <div class="form-inline" align="right">
                                     <label>ประวัติซื้อ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="puchaseSP2" class="form-control" style="width: 85px;">
                                         <option value="" selected>--- ซื้อ ---</option>
                                         @foreach ($HisCarby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->puchase_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="puchaseSP2" value="{{$data->puchase_SP2}}" class="form-control" style="width: 85px;" placeholder="ซื้อ" readonly/>
                                       @else
                                         <select name="puchaseSP2" class="form-control" style="width: 85px;">
                                           <option value="" selected>--- ซื้อ ---</option>
                                           @foreach ($HisCarby as $key => $value)
                                             <option value="{{$key}}" {{ ($key == $data->puchase_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                           @endforeach
                                         </select>
                                       @endif
                                     @endif

                                     <label>ค้ำ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="supportSP2" class="form-control" style="width: 80px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->support_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="supportSP2" value="{{$data->support_SP2}}" class="form-control" style="width: 80px;" placeholder="ค้ำ" readonly/>
                                       @else
                                         <select name="supportSP2" class="form-control" style="width: 80px;">
                                            <option value="" selected>--- ค้ำ ---</option>
                                            @foreach ($HisCarby as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->support_SP2) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                         </select>
                                       @endif
                                     @endif
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
