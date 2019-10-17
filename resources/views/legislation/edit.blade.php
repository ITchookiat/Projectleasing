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

@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    //return "$strDay-$strMonthThai-$strYear";
  }
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


      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">แก้ไขข้อมูงานฟ้อง</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-warning">
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">ข้อมูลผู้เช่าซื้อ</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a></li>
              <li class="nav-item"><a href="#tab_3" data-toggle="tab" aria-expanded="false">ชั้นบังคับคดี</a></li>
              <li class="nav-item"><a href="#tab_4" data-toggle="tab" aria-expanded="false">ของกลาง</a></li>
              <li class="nav-item"><a href="#tab_5" data-toggle="tab" aria-expanded="false">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
            </ul>
          </div>

          <div class="box-body" style="background-color:#F1F1F1">

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
                <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="form-group" align="right">
                          <button type="submit" class="delete-modal btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger" href="{{ route('legislation',2) }}">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="box box-warning box-solid">
                              <div class="box-header with-border">
                                <h3 class="box-title">ข้อมูลผู้เช่าซื้อ</h3>
                                <div class="box-tools pull-center">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="box-body">
                                <div class="row">
                                   <div class="col-md-4">
                                     เลขที่สัญญา
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Contract_legis" class="form-control" style="width: 100%;" value="{{ $data->Contract_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ชื่อ - นามสกุล
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Namelegis" class="form-control" style="width: 100%;" value="{{ $data->Name_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    เลขบัตรประชาชน
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Idcardlegis" class="form-control" style="width: 100%;" value="{{ $data->Idcard_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-4">
                                     ป้ายทะเบียน
                                    <div class="form-inline" align="left">
                                      <input type="text" name="registerlegis" class="form-control" style="width: 100%;" value="{{ $data->register_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ยี่ห้อ
                                    <div class="form-inline" align="left">
                                      <input type="text" name="BrandCarlegis" class="form-control" style="width: 100%;" value="{{ $data->BrandCar_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ปีรถ
                                    <div class="form-inline" align="left">
                                      <input type="text" name="YearCarlegis" class="form-control" style="width: 100%;" value="{{ $data->YearCar_legis }}" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-4">
                                     ประเภทรถ
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Categorylegis" class="form-control" style="width: 100%;" value="{{ $data->Category_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    เลขไมล์
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Milelegis" class="form-control" style="width: 100%;" value="{{ number_format($data->Mile_legis, 2) }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    วันที่ทำสัญญา
                                    <div class="form-inline" align="left">
                                      <input type="text" name="DateDuelegis" class="form-control" style="width: 100%;" value="{{ DateThai($data->DateDue_legis) }}" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    ยอดจัด
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Paylegis" class="form-control" style="width: 100%;" value="{{ number_format($data->Pay_legis ,2) }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ค่าผ่อน
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Periodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data->Period_legis, 2) }}" readonly/>
                                    </div>
                                  </div>
                                   <div class="col-md-4">
                                     จำนวนงวดทั้งหมด
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Countperiodlegis" class="form-control" style="width: 100%;" value="{{$data->Countperiod_legis }}" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    ค้างจากงวด
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ $data->Beforeperiod_legis }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ชำระแล้ว
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Beforemoeylegis" class="form-control" style="width: 100%;" value="{{ number_format($data->Beforemoey_legis, 2) }}" readonly/>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    จำนวนงวดที่ค้าง
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{ $data->Remainperiod_legis }}" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    ลูกหนี้คงเหลือ
                                    <div class="form-inline" align="left">
                                      <input type="text" name="Sumperiodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data->Sumperiod_legis, 2) }}" readonly/>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    วันที่หยุด Vat
                                    <div class="form-inline" align="left">
                                      @if($data->DateVAT_legis == Null)
                                        <input type="text" name="DateVATlegis" class="form-control" style="width: 100%;" value="{{ $data->DateVAT_legis }}" readonly/>
                                      @else
                                        <input type="text" name="DateVATlegis" class="form-control" style="width: 100%;" value="{{ DateThai($data->DateVAT_legis) }}" readonly/>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    ชื่อผู้ค้ำ
                                    <div class="form-inline" align="left">
                                      <input type="text" name="NameGTlegis" class="form-control" style="width: 100%;" value="{{ $data->NameGT_legis }}" readonly/>
                                    </div>
                                  </div>
                                   <div class="col-md-4">
                                     เลขบัตรประชาชน
                                    <div class="form-inline" align="left">
                                      <input type="text" name="IdcardGTlegis" class="form-control" style="width: 100%;" value="{{ $data->IdcardGT_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="box box-warning">
                              <div class="box-header with-border">
                                <h3 class="box-title">เอกสาร</h3>
                                <div class="box-tools pull-right">
                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="box-body">
                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="" id="todo-list">
                                        <div class="form-inline" align="left">
                                          <span class="todo-wrap">
                                            @if($data->Certificate_list != Null)
                                              <input type="checkbox" id="1" name="Certificatelist" value="{{ $data->Certificate_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="1" name="Certificatelist" value="on"/>
                                            @endif
                                            <label for="1" class="todo">
                                              <i class="fa fa-check"></i>
                                              หนังสือรับรอง
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Authorize_list != Null)
                                              <input type="checkbox" id="2" name="Authorizelist" value="{{ $data->Authorize_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="2" name="Authorizelist" value="on"/>
                                            @endif
                                            <label for="2" class="todo">
                                              <i class="fa fa-check"></i>
                                              หนังสือมอบอำนาจ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Authorizecase_list != Null)
                                              <input type="checkbox" id="3" name="Authorizecaselist" value="{{ $data->Authorizecase_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="3" name="Authorizecaselist" value="on"/>
                                            @endif
                                            <label for="3" class="todo">
                                              <i class="fa fa-check"></i>
                                              หนังสือมอบอำนาจช่วงคดี
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Purchase_list != Null)
                                              <input type="checkbox" id="4" name="Purchaselist" value="{{ $data->Purchase_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="4" name="Purchaselist" value="on"/>
                                            @endif
                                            <label for="4" class="todo">
                                              <i class="fa fa-check"></i>
                                              สัญญาเช่าซื้อ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Promise_list != Null)
                                              <input type="checkbox" id="5" name="Promiselist" value="{{ $data->Promise_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="5" name="Promiselist" value="on"/>
                                            @endif
                                            <label for="5" class="todo">
                                              <i class="fa fa-check"></i>
                                              สัญญาค่ำ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Titledeed_list != Null)
                                              <input type="checkbox" id="6" name="Titledeedlist" value="{{ $data->Titledeed_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="6" name="Titledeedlist" value="on"/>
                                            @endif
                                            <label for="6" class="todo">
                                              <i class="fa fa-check"></i>
                                              โฉนดที่ดิน
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-inline" align="left">
                                        <div class="" id="todo-list">
                                          <span class="todo-wrap">
                                            @if($data->Terminatebuyer_list != Null)
                                              <input type="checkbox" id="7" name="Terminatebuyerlist" value="{{ $data->Terminatebuyer_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="7" name="Terminatebuyerlist" value="on"/>
                                            @endif
                                            <label for="7" class="todo">
                                              <i class="fa fa-check"></i>
                                              สัญญาบอกเลิกผู้ซื้อ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Terminatesupport_list != Null)
                                              <input type="checkbox" id="8" name="Terminatesupportlist" value="{{ $data->Terminatesupport_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="8" name="Terminatesupportlist" value="on"/>
                                            @endif
                                            <label for="8" class="todo">
                                              <i class="fa fa-check"></i>
                                              สัญญาบอกเลิกผู้ค่ำ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Acceptbuyerandsup_list != Null)
                                              <input type="checkbox" id="9" name="Acceptbuyerandsuplist" value="{{ $data->Acceptbuyerandsup_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="9" name="Acceptbuyerandsuplist" value="on"/>
                                            @endif
                                            <label for="9" class="todo">
                                              <i class="fa fa-check"></i>
                                              ใบตอบรับผู้ซื้อ - ผู้ค่ำ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Twodue_list != Null)
                                              <input type="checkbox" id="10" name="Twoduelist" value="{{ $data->Twodue_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="10" name="Twoduelist" value="on"/>
                                            @endif
                                            <label for="10" class="todo">
                                              <i class="fa fa-check"></i>
                                              หนังสือ 2 งวด
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->AcceptTwodue_list != Null)
                                              <input type="checkbox" id="11" name="AcceptTwoduelist" value="{{ $data->AcceptTwodue_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="11" name="AcceptTwoduelist" value="on"/>
                                            @endif
                                            <label for="11" class="todo">
                                              <i class="fa fa-check"></i>
                                              ใบตอบรับหนังสือ 2 งวด
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Confirm_list != Null)
                                              <input type="checkbox" id="12" name="Confirmlist" value="{{ $data->Confirm_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="12" name="Confirmlist" value="on"/>
                                            @endif
                                            <label for="12" class="todo">
                                              <i class="fa fa-check"></i>
                                              หนังสือยืนยันการบอกเลิก
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
                                          <span class="todo-wrap">
                                            @if($data->Accept_list != Null)
                                              <input type="checkbox" id="13" name="Acceptlist" value="{{ $data->Accept_list }}" checked="checked"/>
                                            @else
                                              <input type="checkbox" id="13" name="Acceptlist" value="on"/>
                                            @endif
                                            <label for="13" class="todo">
                                              <i class="fa fa-check"></i>
                                              ใบตอบรับ
                                            </label>
                                            <span class="delete-item" title="remove">
                                              <i class="fa fa-times-circle"></i>
                                            </span>
                                          </span>
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
                    </div>

                    <input type="hidden" name="_method" value="PATCH"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

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
