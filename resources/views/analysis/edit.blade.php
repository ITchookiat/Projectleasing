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
        สินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h4 class="card-title p-3" align="center">แก้ไขข้อมูลสัญญา</h4>
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
            <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">แบบฟอร์มค่าใช้จ่าย</a></li>
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
                                      <input type="text" name="Contract_buyer" maxlength="8" class="form-control" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" style="width: 250px;" value="{{ $data->Contract_buyer }}" readonly/>
                                    @else
                                      <input type="text" name="Contract_buyer" maxlength="8" class="form-control" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" style="width: 250px;" value="{{ $data->Contract_buyer }}"/>
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
                                <label>สถานะ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                <select name="Statusbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- เลือกสถานะ ---</option>
                                    @foreach ($Statusby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Statusbuyer" value="{{ $data->Status_buyer }}" class="form-control" style="width: 250px;" readonly/>
                                  @else
                                    <select name="Statusbuyer" class="form-control" style="width: 250px;">
                                        <option value="" disabled selected>--- เลือกสถานะ ---</option>
                                        @foreach ($Statusby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->Status_buyer) ? 'selected' : '' }}>{{$value}}</option>
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
                                <label>ลักษณะบ้าน : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Housebuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                    @foreach ($Houseby as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Housebuyer" value="{{ $data->House_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกลักษณะบ้าน" readonly/>
                                  @else
                                    <select name="Housebuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                      @foreach ($Houseby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->House_buyer) ? 'selected' : '' }}>{{$value}}</option>
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
                          </div>

                          <div class="row">
                             <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ประเภทบ้าน : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- ประเภทบ้าน ---</option>
                                    @foreach ($HouseStyleby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="HouseStylebuyer" value="{{ $data->HouseStyle_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกประเภทบ้าน" readonly/>
                                  @else
                                    <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- ประเภทบ้าน ---</option>
                                      @foreach ($HouseStyleby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->HouseStyle_buyer) ? 'selected' : '' }}>{{$value}}</option>
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
                          </div>
                          <div class="row">
                             <div class="col-md-5">
                               <div class="form-inline" align="right">
                                 <label>รายได้ : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                   <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                     <option value="" selected>--- รายได้ ---</option>
                                     @foreach ($Incomeby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->Income_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 @else
                                   @if($GetDocComplete != Null)
                                     <input type="text" name="Incomebuyer" value="{{ $data->Income_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกรายได้" readonly/>
                                   @else
                                     <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- รายได้ ---</option>
                                       @foreach ($Incomeby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->Income_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ใบขับขี่ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                    @foreach ($Driverby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Driverbuyer" value="{{ $data->Driver_buyer }}" class="form-control" style="width: 250px;" placeholder="เลือกใบขับขี่" readonly/>
                                  @else
                                    <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- เลือกใบขับขี่ ---</option>
                                      @foreach ($Driverby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Driver_buyer) ? 'selected' : '' }}>{{$value}}</option>
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
                                 <label>หักค่าใช้จ่าย : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                   <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                 @else
                                   @if($GetDocComplete != Null)
                                   <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" readonly />
                                   @else
                                     <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                   @endif
                                 @endif
                               </div>

                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Purchasebuyer" class="form-control" style="width: 108px;">
                                    <option value="" selected>--- ซื้อ ---</option>
                                    @foreach ($HisCarby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Purchasebuyer" value="{{ $data->Purchase_buyer }}" class="form-control" style="width: 108px;" placeholder="ซื้อ" readonly/>
                                  @else
                                    <select name="Purchasebuyer" class="form-control" style="width: 108px;">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Purchase_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif

                                <label>ค้ำ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Supportbuyer" class="form-control" style="width: 108px;">
                                    <option value="" selected>--- ค้ำ ---</option>
                                    @foreach ($HisCarby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Supportbuyer" value="{{ $data->Support_buyer }}" class="form-control" style="width: 108px;" placeholder="ค้ำ" readonly/>
                                  @else
                                    <select name="Supportbuyer" class="form-control" style="width: 108px;">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Support_buyer) ? 'selected' : '' }}>{{$value}}</option>
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
                                <label>รายได้หลังหักค่าใช้จ่าย : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                @else
                                  @if($GetDocComplete != Null)
                                  <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" readonly />
                                  @else
                                    <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" onchange="income();" />
                                  @endif
                                @endif
                              </div>

                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สถานะผู้เช่าซื้อ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                    <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                    @foreach ($GradeBuyer as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Gradebuyer" value="{{ $data->Gradebuyer_car }}" class="form-control" style="width: 250px;" placeholder="เลือกสถานะผู้เช่าซื้อ" readonly/>
                                  @else
                                    <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                      <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                      @foreach ($GradeBuyer as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Gradebuyer_car) ? 'selected' : '' }}>{{$value}}</option>
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
                                <div class="file-loading">
                                  <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                </div>
                                @if($countImage != 0)
                                <br/>
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <a href="{{ action('AnalysController@deleteImageAll',$data->id) }}" class="btn btn-danger pull-left" title="ลบรูปทั้งหมด" onclick="return confirm('คุณต้องการลบรูปทั้งหมดหรือไม่?')"> ลบรูปทั้งหมด..</a>
                                  <a href="{{ action('AnalysController@deleteImageEach',[$data->id,$type,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                  <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                  </a>
                                  @else

                                  @if($GetDocComplete != Null)
                                  <a href="{{ action('AnalysController@deleteImageEach',[$data->id,$type,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger pull-right disabled" title="การจัดการรูป">
                                  <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                  </a>
                                  @else
                                  <a href="{{ action('AnalysController@deleteImageEach',[$data->id,$type,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger pull-right" title="การจัดการรูป">
                                  <span class="glyphicon glyphicon-picture"></span> ลบรูปภาพ..
                                  </a>
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
                                   <label>สถานะ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select name="statusSP" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- สถานะ ---</option>
                                       @foreach ($Statusby as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @else
                                     @if($GetDocComplete != Null)
                                       <input type="text" name="statusSP" value="{{$data->status_SP}}" class="form-control" style="width: 250px;" placeholder="เลือกสถานะ" readonly/>
                                     @else
                                       <select name="statusSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- สถานะ ---</option>
                                         @foreach ($Statusby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->status_SP) ? 'selected' : '' }}>{{$value}}</option>
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

                                <div class="col-md-6">
                                 <div class="form-inline" align="right">
                                     <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" readonly/>
                                       @else
                                          <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
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
                                     <label>ลักษณะบ้าน : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                       <select name="houseSP" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                         @foreach ($Houseby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                       <input type="text" name="houseSP" value="{{$data->house_SP}}" class="form-control" style="width: 250px;" placeholder="เลือกลักษณะบ้าน" readonly/>
                                       @else
                                         <select name="houseSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                           @foreach ($Houseby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->house_SP) ? 'selected' : '' }}>{{$value}}</option>
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

                            <div class="row">
                                <div class="col-md-5">
                                  <div class="form-inline" align="right">
                                      <label>ประเภทบ้าน : </label>
                                      @if(auth::user()->type == 1 or auth::user()->type == 2)
                                        <select name="housestyleSP" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          @foreach ($HouseStyleby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @else
                                        @if($GetDocComplete != Null)
                                           <input type="text" name="housestyleSP" value="{{$data->housestyle_SP}}" class="form-control" style="width: 250px;" placeholder="ประเภทบ้าน" readonly/>
                                        @else
                                          <select name="housestyleSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            @foreach ($HouseStyleby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->housestyle_SP) ? 'selected' : '' }}>{{$value}}</option>
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
                              </div>

                            <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                    <label>รายได้ : </label>
                                    @if(auth::user()->type == 1 or auth::user()->type == 2)
                                      <select name="incomeSP" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- รายได้ ---</option>
                                        @foreach ($Incomeby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->income_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                      </select>
                                    @else
                                      @if($GetDocComplete != Null)
                                         <input type="text" name="incomeSP" value="{{$data->income_SP}}" class="form-control" style="width: 250px;" placeholder="รายได้" readonly/>
                                      @else
                                        <select name="incomeSP" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- รายได้ ---</option>
                                          @foreach ($Incomeby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->income_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                        </select>
                                      @endif
                                    @endif
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                   <label>ประวัติซื้อ/ค้ำ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select name="puchaseSP" class="form-control" style="width: 108px;">
                                       <option value="" selected>--- ซื้อ ---</option>
                                       @foreach ($HisCarby as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="puchaseSP" value="{{$data->puchase_SP}}" class="form-control" style="width: 108px;" placeholder="ซื้อ" readonly/>
                                     @else
                                       <select name="puchaseSP" class="form-control" style="width: 108px;">
                                         <option value="" selected>--- ซื้อ ---</option>
                                         @foreach ($HisCarby as $key => $value)
                                           <option value="{{$key}}" {{ ($key == $data->puchase_SP) ? 'selected' : '' }}>{{$value}}</option>
                                         @endforeach
                                       </select>
                                     @endif
                                   @endif

                                   <label>ค้ำ : </label>
                                   @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select name="supportSP" class="form-control" style="width: 108px;">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        @foreach ($HisCarby as $key => $value)
                                          <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                        @endforeach
                                     </select>
                                   @else
                                     @if($GetDocComplete != Null)
                                        <input type="text" name="supportSP" value="{{$data->support_SP}}" class="form-control" style="width: 108px;" placeholder="ค้ำ" readonly/>
                                     @else
                                       <select name="supportSP" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          @foreach ($HisCarby as $key => $value)
                                            <option value="{{$key}}" {{ ($key == $data->support_SP) ? 'selected' : '' }}>{{$value}}</option>
                                          @endforeach
                                       </select>
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
                                     <label>ประเภทรถ : </label>
                                     @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <select id="Typecardetail" name="Typecardetail" class="form-control" style="width: 250px;" onchange="calculate();">
                                       <option value="" selected>--- ประเภทรถ ---</option>
                                       @foreach ($Typecardetail as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->Typecardetails) ? 'selected' : '' }}>{{$value}}</option>
                                       @endforeach
                                     </select>
                                     @else
                                       @if($GetDocComplete != Null)
                                          <input type="text" id="Typecardetail" name="Typecardetail" value="{{$data->Typecardetails}}" class="form-control" style="width: 250px;" placeholder="ปี" readonly/>
                                       @else
                                       <select id="Typecardetail" name="Typecardetail" class="form-control" style="width: 250px;" onchange="calculate();">
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
                                <label>ป้ายเดิม : </label>
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

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>กลุ่มปีรถยนต์ : </label>
                                 <input type="text" id="Groupyearcar" name="Groupyearcar" class="form-control" style="width: 250px;" value="{{ $data->Groupyear_car}}" readonly onchange="newformula();"/>
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
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" id="Milecar" name="Milecar" value="{{$data->Mile_car}}" class="form-control" style="width: 250px;" placeholder="เลขไมล์" onchange="mile();" />
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Milecar" value="{{$data->Mile_car}}" class="form-control" style="width: 250px;" placeholder="เลขไมล์" readonly/>
                                   @else
                                      <input type="text" id="Milecar" name="Milecar" value="{{$data->Mile_car}}" class="form-control" style="width: 250px;" placeholder="เลขไมล์" onchange="mile();" />
                                   @endif
                                 @endif
                               </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>รุ่น : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control" style="width: 250px;" placeholder="รุ่น" readonly/>
                                   @else
                                      <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                 <label>ราคากลาง : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" id="Midpricecar" name="Midpricecar" value="{{$data->Midprice_car}}" class="form-control" style="width: 250px;" placeholder="ราคากลาง" oninput="mile();percent();"/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" id="Midpricecar" name="Midpricecar" value="{{$data->Midprice_car}}" class="form-control" style="width: 250px;" placeholder="ราคากลาง" readonly/>
                                   @else
                                      <input type="text" id="Midpricecar" name="Midpricecar" value="{{$data->Midprice_car}}" class="form-control" style="width: 250px;" placeholder="ราคากลาง" oninput="mile();percent();" />
                                   @endif
                                 @endif
                               </div>
                            </div>
                          </div>

                          <hr />
                          @include('analysis.script')

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
                                 <select id="Timeslackencar" name="Timeslackencar" class="form-control" style="width: 250px;" onchange="calculate();">
                                   <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                                   @foreach ($Timeslackencarr as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Timeslacken_car) ? 'selected' : '' }}>{{$value}}</option>
                                   @endforeach
                                 </select>
                               @else
                                 @if($GetDocComplete != Null)
                                   <input type="text" id="Timeslackencar" name="Timeslackencar" value="{{$data->Timeslacken_car}}" class="form-control" style="width: 250px;" placeholder="ระยะเวลาผ่อน" readonly />
                                 @else
                                   <select id="Timeslackencar" name="Timeslackencar" class="form-control" style="width: 250px;" onchange="calculate();">
                                     <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                                     @foreach ($Timeslackencarr as $key => $value)
                                     <option value="{{$key}}" {{ ($key == $data->Timeslacken_car) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
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
                                 <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" value="{{$data->Interest_car}}" placeholder="ดอกเบี้ย" readonly onchange="calculate();"/>
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
                                <input type="text" id="Vatcar" name="Vatcar" value="{{$data->Vat_car}}" class="form-control" style="width: 250px;" placeholder="7 %" value="7 %" readonly onchange="calculate()"/>
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
                                <label>ประกันภัย : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select id="Insurancecar" name="Insurancecar" class="form-control" style="width: 250px;" onchange="insurance();">
                                    <option value="" selected>--- ประกันภัย ---</option>
                                    @foreach ($Insurancecarr as $key => $value)
                                       <option value="{{$key}}" {{ ($key == $data->Insurance_car) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" id="Insurancecar" name="Insurancecar" value="{{$data->Insurance_car}}" class="form-control" style="width: 250px;" placeholder="ประกันภัย" readonly />
                                  @else
                                    <select id="Insurancecar" name="Insurancecar" class="form-control" style="width: 250px;" onchange="insurance();">
                                      <option value="" selected>--- ประกันภัย ---</option>
                                      @foreach ($Insurancecarr as $key => $value)
                                         <option value="{{$key}}" {{ ($key == $data->Insurance_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-inline" align="right">
                                 <label>เปอร์เซ็นจัดไฟแนนซ์ : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Percentcar" value="{{$data->Percent_car}}" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" readonly/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Percentcar" value="{{$data->Percent_car}}" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" readonly/>
                                   @else
                                      <input type="text" name="Percentcar" value="{{$data->Percent_car}}" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" readonly/>
                                   @endif
                                 @endif
                               </div>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-md-5">

                            </div>
                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                  <label>เลขกรมธรรม์ : </label>
                                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                                     <input type="text" name="Insurancekey" value="{{$data->Insurance_key}}" class="form-control" style="width: 250px;" placeholder="เลขกรมธรรม์" />
                                  @else
                                    @if($GetDocComplete != Null)
                                       <input type="text" name="Insurancekey" value="{{$data->Insurance_key}}" class="form-control" style="width: 250px;" placeholder="เลขกรมธรรม์" readonly/>
                                    @else
                                       <input type="text" name="Insurancekey" value="{{$data->Insurance_key}}" class="form-control" style="width: 250px;" placeholder="เลขกรมธรรม์" />
                                    @endif
                                  @endif
                              </div>
                            </div>
                          </div> -->

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>แบบ : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                   <select name="statuscar" class="form-control" style="width: 250px;">
                                     <option value="" selected>--- เลือกแบบ ---</option>
                                     @foreach ($statuscarr as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->status_car) ? 'selected' : '' }}>{{$value}}</option>
                                     @endforeach
                                   </select>
                                 @else
                                   @if($GetDocComplete != Null)
                                     <input type="text" id="statuscar" name="statuscar" value="{{$data->status_car}}" class="form-control" style="width: 250px;" placeholder="สถานะ" readonly />
                                   @else
                                     <select name="statuscar" class="form-control" style="width: 250px;">
                                       <option value="" selected>--- เลือกแบบ ---</option>
                                       @foreach ($statuscarr as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->status_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                     </select>
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                               <label>วันที่ชำระงวดแรก : </label>
                               <input type="text" name="Dateduefirstcar" value="{{$data->Dateduefirst_car}}" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <span class="todo-wrap">
                                  @if($data->Salemethod_car != Null)
                                    <input type="checkbox" id="1" name="Salemethod" value="{{ $data->Salemethod_car }}" checked="checked"/>
                                  @else
                                    <input type="checkbox" id="1" name="Salemethod" value="on"/>
                                  @endif
                                    <label for="1" class="todo">
                                      <i class="fa fa-check"></i>
                                      กรรมสิทธิ์ในแบบซื้อขาย
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">

                             </div>
                            </div>
                          </div>

                          <hr />
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <label>ผู้รับเงิน : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Payeecar" value="{{$data->Payee_car}}" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Payeecar" value="{{$data->Payee_car}}" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" readonly/>
                                   @else
                                      <input type="text" name="Payeecar" value="{{$data->Payee_car}}" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เลขที่บัญชี : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Accountbrancecar" value="{{$data->Accountbrance_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15"/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Accountbrancecar" value="{{$data->Accountbrance_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15" readonly/>
                                   @else
                                      <input type="text" name="Accountbrancecar" value="{{$data->Accountbrance_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15"/>
                                   @endif
                                 @endif
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สาขา : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="branchbrancecar" value="{{$data->branchbrance_car}}" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" name="branchbrancecar" value="{{$data->branchbrance_car}}" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" readonly/>
                                  @else
                                      <input type="text" name="branchbrancecar" value="{{$data->branchbrance_car}}" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Tellbrancecar" value="{{$data->Tellbrance_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" name="Tellbrancecar" value="{{$data->Tellbrance_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" readonly/>
                                  @else
                                      <input type="text" name="Tellbrancecar" value="{{$data->Tellbrance_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                 <font color="red">(* กรณีเป็นพนักงาน) </font><label>แนะนำ/นายหน้า : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" id="Agentcar" name="Agentcar" value="{{$data->Agent_car}}" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" />
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" id="Agentcar" name="Agentcar" value="{{$data->Agent_car}}" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" readonly/>
                                   @else
                                      <input type="text" id="Agentcar" name="Agentcar" value="{{$data->Agent_car}}" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" />
                                   @endif
                                 @endif
                               </div>
                            </div>

                            <div class="col-md-6">
                             <div class="form-inline" align="right">
                                 <label>เลขที่บัญชี : </label>
                                 @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Accountagentcar" value="{{$data->Accountagent_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15"/>
                                 @else
                                   @if($GetDocComplete != Null)
                                      <input type="text" name="Accountagentcar" value="{{$data->Accountagent_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15" readonly/>
                                   @else
                                      <input type="text" name="Accountagentcar" value="{{$data->Accountagent_car}}" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชี" maxlength="15"/>
                                   @endif
                                 @endif
                             </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ค่าคอม : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <input type="text" id="Commissioncar" name="Commissioncar" value="{{number_format($data->Commission_car, 2)}}" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission()"/>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" id="Commissioncar" name="Commissioncar" value="{{number_format($data->Commission_car, 2)}}" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission()" readonly/>
                                  @else
                                    <input type="text" id="Commissioncar" name="Commissioncar" value="{{number_format($data->Commission_car, 2)}}" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission()"/>
                                  @endif
                                @endif
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>สาขา : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="branchAgentcar" value="{{$data->branchAgent_car}}" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า"/>
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" name="branchAgentcar" value="{{$data->branchAgent_car}}" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า" readonly/>
                                  @else
                                      <input type="text" name="branchAgentcar" value="{{$data->branchAgent_car}}" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า"/>
                                  @endif
                                @endif
                              </div>
                            </div>
                          </div>

                         <div class="row">
                            <div class="col-md-5">
                              <div class="form-inline" align="right">
                                <label>ประวัติการซื้อ/ค้ำ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Purchasehistorycar" class="form-control" style="width: 108px;">
                                    <option value="" selected>--- ซื้อ ---</option>
                                    @foreach ($HisCarby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Purchasehistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Purchasehistorycar" value="{{$data->Purchasehistory_car}}" class="form-control" style="width: 108px;" placeholder="ซื้อ" readonly/>
                                  @else
                                    <select name="Purchasehistorycar" class="form-control" style="width: 108px;">
                                      <option value="" selected>--- ซื้อ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Purchasehistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif

                                <label>ค้ำ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                  <select name="Supporthistorycar" class="form-control" style="width: 108px;">
                                    <option value="" selected>--- ค้ำ ---</option>
                                    @foreach ($HisCarby as $key => $value)
                                      <option value="{{$key}}" {{ ($key == $data->Supporthistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                @else
                                  @if($GetDocComplete != Null)
                                    <input type="text" name="Supporthistorycar" value="{{$data->Purchasehistory_car}}" class="form-control" style="width: 108px;" placeholder="ค้ำ" readonly/>
                                  @else
                                    <select name="Supporthistorycar" class="form-control" style="width: 108px;">
                                      <option value="" selected>--- ค้ำ ---</option>
                                      @foreach ($HisCarby as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $data->Supporthistory_car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  @endif
                                @endif
                              </div>
                           </div>

                            <div class="col-md-6">
                              <div class="form-inline" align="right">
                                <label>เบอร์โทรศัพท์ : </label>
                                @if(auth::user()->type == 1 or auth::user()->type == 2)
                                    <input type="text" name="Tellagentcar" value="{{$data->Tellagent_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                                @else
                                  @if($GetDocComplete != Null)
                                      <input type="text" name="Tellagentcar" value="{{$data->Tellagent_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" readonly/>
                                  @else
                                      <input type="text" name="Tellagentcar" value="{{$data->Tellagent_car}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                                  @endif
                                @endif
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
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_4">
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
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                    </button>
                    <!-- <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}"> -->
                    <a class="delete-modal btn btn-danger" href="{{ route('Analysis',1) }}">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
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


    </section>
@endsection
