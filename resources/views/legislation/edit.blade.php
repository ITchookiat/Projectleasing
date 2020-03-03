@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

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

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

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

      <!-- <section class="content-header">
      </section> -->

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">ลูกหนี้งานฟ้อง</h4>
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
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 7]) }}">ชั้นบังคับคดี</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 13]) }}">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 4]) }}">ประนอมหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 8]) }}">สืบทรัพย์</a></li>
            </ul>
          </div>

          <div class="box-body" style="background-color:#F1F1F1">

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
              @csrf
              @method('put')

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="info-box">
                      <div class="row">
                        <div class="col-md-9">
                          <span class="info-box-icon  bg-red"><i class="fa fa-id-badge fa-lg"></i></span>
                          <div class="info-box-content">
                              <div class="col-md-4">
                                <span class="info-box-number"><font style="font-size: 30px;">{{ $data->Contract_legis }}</font></span>
                                <span class="info-box-text"><font style="font-size: 20px;">{{ $data->Name_legis }}</font></span>
                              </div>
                              <div class="col-md-8">
                                <div class="form-inline">
                                  <p></p>
                                  <div class="" align="center">
                                    <small class="label label-success" style="font-size: 25px;">
                                      <i class="fa fa-expeditedssl"></i>
                                      @if($data->Status_legis == "จ่ายจบก่อนฟ้อง")
                                        จ่ายจบก่อนฟ้อง
                                      @elseif($data->Status_legis == "ยึดรถก่อนฟ้อง")
                                        ยึดรถก่อนฟ้อง
                                      @elseif($data->Status_legis == "ปิดบัญชีประนอมหนี้")
                                        ปิดบัญชีประนอมหนี้
                                      @elseif($data->Status_legis == "ปิดบัญชีหลังฟ้อง")
                                        ปิดบัญชีหลังฟ้อง
                                      @elseif($data->Status_legis == "ยึดรถหลังฟ้อง")
                                        ยึดรถหลังฟ้อง
                                      @elseif($data->Status_legis == "หมดอายุความคดี")
                                        หมดอายุความคดี
                                      @endif
                                    </small>
                                  </div>
                                  <p></p>
                                  <label>สถานะ : </label>
                                  <select name="Statuslegis" class="form-control" style="width: 170px;">
                                    <option value="" selected>--- status ---</option>
                                    <option value="จ่ายจบก่อนฟ้อง" {{ ($data->Status_legis === 'จ่ายจบก่อนฟ้อง') ? 'selected' : '' }}>จ่ายจบก่อนฟ้อง</option>
                                    <option value="ยึดรถก่อนฟ้อง" {{ ($data->Status_legis === 'ยึดรถก่อนฟ้อง') ? 'selected' : '' }}>ยึดรถก่อนฟ้อง</option>
                                    <option value="ปิดบัญชีประนอมหนี้" {{ ($data->Status_legis === 'ปิดบัญชีประนอมหนี้') ? 'selected' : '' }}>ปิดบัญชีประนอมหนี้</option>
                                    <option value="ปิดบัญชีหลังฟ้อง" {{ ($data->Status_legis === 'ปิดบัญชีหลังฟ้อง') ? 'selected' : '' }}>ปิดบัญชีหลังฟ้อง</option>
                                    <option value="ยึดรถหลังฟ้อง" {{ ($data->Status_legis === 'ยึดรถหลังฟ้อง') ? 'selected' : '' }}>ยึดรถหลังฟ้อง</option>
                                    <option value="หมดอายุความคดี" {{ ($data->Status_legis === 'หมดอายุความคดี') ? 'selected' : '' }}>หมดอายุความคดี</option>
                                  </select>

                                  <!-- <input type="text" id="txtStatuslegis" name="txtStatuslegis" class="form-control" style="width: 100px;" oninput="AddComma();"> -->
                                  <input type="date" name="DateStatuslegis" class="form-control" style="width: 170px;" value="{{ $data->DateStatus_legis }}">
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <br>
                          <div class="form-inline" align="right">
                            <a class="btn btn-app" data-toggle="modal" data-target="#modal-printinfo" data-backdrop="static" data-keyboard="false" style="background-color:blue; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-print"></span> ใบเสร็จ
                            </a>
                            <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                            </button>
                            <a class="btn btn-app" href="{{ route('legislation',2) }}" style="background-color:#DB0000; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                            </a>
                          </div>
                        </div>
                      </div>

                      <div class="info-box-content">
                        <div class="progress">
                          <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                        </span>
                      </div>

                      <script>
                        function comma(val){
                          while (/(\d+)(\d{3})/.test(val.toString())){
                            val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
                          }
                          return val;
                        }

                        function AddComma(){
                            var price = document.getElementById('txtStatuslegis').value;
                            var Setprice = price.replace(",","");

                            document.form1.txtStatuslegis.value = comma(Setprice);
                        }
                      </script>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title"><i class="fa fa-user"></i> ข้อมูลผู้เช่าซื้อ</h3>
                              <div class="box-tools pull-center">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-4">
                                  เลขบัตรประชาชน
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Idcardlegis" class="form-control" style="width: 100%;" value="{{ $data->Idcard_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                                  </div>
                                </div>
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
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  ปีรถ
                                  <div class="form-inline" align="left">
                                    <input type="text" name="YearCarlegis" class="form-control" style="width: 100%;" value="{{ $data->YearCar_legis }}" readonly/>
                                  </div>
                                </div>
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
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  วันที่ทำสัญญา
                                  <div class="form-inline" align="left">
                                    <input type="text" name="DateDuelegis" class="form-control" style="width: 100%;" value="{{ DateThai($data->DateDue_legis) }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ยอดจัด
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Paylegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->NCARCST ,2) }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ค่าผ่อน
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Periodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->TOT_UPAY, 2) }}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  จำนวนงวดทั้งหมด
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Countperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->T_NOPAY }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ค้างจากงวดที่
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ $data1->EXP_FRM }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ถึงงวดที่
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{ $data1->EXP_TO }}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  ชำระแล้ว
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Beforemoeylegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->SMPAY, 2) }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ค้าง
                                  <div class="form-inline" align="left">
                                    <input type="text" class="form-control" style="width: 100%;" value="{{ number_format($data1->EXP_PRD, 0) }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ค้างงวดจริง
                                  <div class="form-inline" align="left">
                                    <input type="text" class="form-control" style="width: 100%;" value="{{ number_format($data1->HLDNO, 2) }}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  ลูกหนี้คงเหลือ
                                  <div class="form-inline" align="left">
                                    <input type="text" name="Sumperiodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->BALANC - $data1->SMPAY, 2) }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  วันที่หยุด Vat
                                  <div class="form-inline" align="left">
                                    @if($data->DateVAT_legis == Null)
                                    <input type="text" name="DateVATlegis" class="form-control" style="width: 100%;" value="{{ $data1->DTSTOPV }}" readonly/>
                                    @else
                                    <input type="text" name="DateVATlegis" class="form-control" style="width: 100%;" value="{{ DateThai($data1->DTSTOPV) }}" readonly/>
                                    @endif
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  ชื่อผู้ค้ำ
                                  <div class="form-inline" align="left">
                                    <input type="text" name="NameGTlegis" class="form-control" style="width: 100%;" value="{{ $data->NameGT_legis }}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
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
                              <h3 class="box-title"><i class="fa fa-check-square-o"></i> เอกสาร</h3>
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
                </div>

                <input type="hidden" name="_method" value="PATCH"/>
              </div>
            </form>
          </div>
        </div>

      <div class="modal fade" id="modal-printinfo">
        <div class="modal-dialog">
          <div class="modal-content">
            <form name="form2" method="post" action="{{ route('legislation.store',[$id, 2]) }}" target="_blank" id="formimage" enctype="multipart/form-data">
              @csrf
              <div class="box box-warning box-solid ">
                <div class="box-header with-border">
                  <h4 class="card-title p-3" align="center">ป้อนข้อมูลปิดบัญชี</h4>
                  <div class="box-tools pull-right">
                    <button type="button" data-dismiss="modal" class="close" >
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                </div>

                <script type="text/javascript">
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
                  function addcomma(){
                    var num11 = document.getElementById('TopCloseAccount').value;
                    var num1 = num11.replace(",","");
                    var num22 = document.getElementById('PriceAccount').value;
                    var num2 = num22.replace(",","");
                    var num33 = document.getElementById('DiscountAccount').value;
                    var num3 = num33.replace(",","");

                    document.form2.TopCloseAccount.value = addCommas(num1);
                    document.form2.PriceAccount.value = addCommas(num2);
                    document.form2.DiscountAccount.value = addCommas(num3);
                  }
                </script>

                <div class="modal-body">
                  <div class="form-inline" align="right">
                    <div class="row">
                      <div class="col-md-6">
                        <label>วันที่ปิดบัญชี</label>
                        <input type="date" name="DateCloseAccount" class="form-control" style="width: 150px;" value="{{ (($data->DateStatus_legis !== Null) ?$data->DateStatus_legis: date('Y-m-d')) }}" />
                      </div>
                      <div class="col-md-6">
                        <label>ยอดปิดบัญชี</label>
                          <input type="text" id="PriceAccount" name="PriceAccount" class="form-control" style="width: 150px;" placeholder="ป้อนยอดตั้งต้น" value="{{ number_format(($data->PriceStatus_legis !== Null) ?$data->PriceStatus_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                      </div>
                    </div>
                  </div>

                  <div class="form-inline" align="right">
                    <div class="row">
                      <div class="col-md-6">
                        <label>ยอดชำระ</label>
                        <input type="text" id="TopCloseAccount" name="TopCloseAccount" class="form-control" style="width: 150px;" placeholder="ป้อนยอดชำระ" value="{{ number_format(($data->txtStatus_legis !== Null) ?$data->txtStatus_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                        <input type="hidden" name="ContractNo" class="form-control" value="{{$data->Contract_legis}}"/>
                      </div>
                      <div class="col-md-6">
                        <label>ยอดส่วนลด</label>
                        <input type="text" id="DiscountAccount" name="DiscountAccount" class="form-control" style="width: 150px;" placeholder="ป้อนยอดส่วนลด" value="{{ number_format(($data->Discount_legis !== Null) ?$data->Discount_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                      </div>
                    </div>
                  </div>
                </div>
                <div align="center">
                  <button id="submit" type="submit" class="btn btn-primary"><span class="fa fa-id-card-o"></span> พิมพ์</button>
                </div>
                <br>
              </div>

          </form>
          </div>
        </div>
      </div>

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

      <script type="text/javascript">
        $("#submit").click(function () {
          $("#modal-printinfo").modal('toggle');
          location.reload(true);
        });
      </script>

    </section>
@endsection
