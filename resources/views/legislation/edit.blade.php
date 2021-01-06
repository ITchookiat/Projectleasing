@extends('layouts.master')
@section('title','กฏหมาย/ข้อมูลผู้เช่าซื้อ')
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

  <style>
    #todo-list{
    width:100%;
    /* margin:0 auto 50px auto; */
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

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="card">
          <form name="form1" method="post" action="{{ route('MasterLegis.update',[$id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="type" value="2"/>

            <div class="card-header">
              <div class="row mb-1">
                <div class="col-6">
                  <h5>ลูกหนี้งานฟ้อง (Debtor Sued)</h5>   
                </div>
                <div class="col-6">
                  <div class="card-tools d-inline float-right">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-printinfo" data-backdrop="static" data-keyboard="false">
                      <i class="fas fa-print"></i> ปิดบัญชี
                    </button>
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fas fa-save"></i> Save
                    </button>
                    <a class="btn btn-danger btn-sm" href="{{ route('MasterLegis.index') }}?type={{20}}">
                      <i class="far fa-window-close"></i> Close
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-warning card-tabs text-sm">
                <div class="card-header p-0 pt-1">
                  <div class="container-fluid">
                    <div class="row mb-1">
                      <div class="col-sm-6">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" href="{{ route('MasterLegis.edit',[$id]) }}?type={{2}}">ข้อมูลลูกหนี้</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{3}}">ชั้นศาล</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{7}}">ชั้นบังคับคดี</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{13}}">โกงเจ้าหนี้</a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-sm-6">
                        <div class="float-right form-inline">
                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{8}}">สืบทรัพย์</a>
                            <a class="nav-link" href="{{ route('MasterCompro.edit',[$id]) }}?type={{2}}">ประนอมหนี้</a>
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{11}}">รูปและแผนที่</a>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body text-sm">
              <div class="row">
                <div class="col-md-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-id-badge fa-2x"></i></span>
                    <div class="info-box-content">
                      <h5>{{ $data->Contract_legis }}</h5>
                      <span class="info-box-number" style="font-size: 20px;">{{ $data->Name_legis }}</span>
                    </div>

                    <div class="info-box-content">
                      <div class="form-inline float-right">
                        <small class="badge badge-danger" style="font-size: 18px;">
                          <i class="fas fa-sign"></i>&nbsp; สถานะ :
                          <select name="Statuslegis" class="form-control form-control-sm">
                            <option value="" selected>--------- status ----------</option>
                            <option value="จ่ายจบก่อนฟ้อง" {{ ($data->Status_legis === 'จ่ายจบก่อนฟ้อง') ? 'selected' : '' }}>จ่ายจบก่อนฟ้อง</option>
                            <option value="ยึดรถก่อนฟ้อง" {{ ($data->Status_legis === 'ยึดรถก่อนฟ้อง') ? 'selected' : '' }}>ยึดรถก่อนฟ้อง</option>
                            <option value="หมดอายุความคดี" {{ ($data->Status_legis === 'หมดอายุความคดี') ? 'selected' : '' }}>หมดอายุความคดี</option>
                            @if($data->Status_legis != Null)
                              <option disabled>------------------------------</option>
                              <option value="{{$data->Status_legis}}" style="color:red" {{ ($data->Status_legis === $data->Status_legis) ? 'selected' : '' }}>{{$data->Status_legis}}</option>
                            @endif
                          </select>

                          <input type="date" name="DateStatuslegis" class="form-control form-control-sm" value="{{ $data->DateUpState_legis }}">
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
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
                <div class="col-md-8">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-user-tag"></i> ข้อมูลผู้เช่าซื้อ</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          เลขบัตรประชาชน
                          <div class="form-inline" align="left">
                            <input type="text" name="Idcardlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->Idcard_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ป้ายทะเบียน
                          <div class="form-inline" align="left">
                            <input type="text" name="registerlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->register_legis }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ยี่ห้อ
                          <div class="form-inline" align="left">
                            <input type="text" name="BrandCarlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->BrandCar_legis }}" readonly/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          ปีรถ
                          <div class="form-inline" align="left">
                            <input type="text" name="YearCarlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->YearCar_legis }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ประเภทรถ
                          <div class="form-inline" align="left">
                            <input type="text" name="Categorylegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->Category_legis }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          เลขไมล์
                          <div class="form-inline" align="left">
                            <input type="text" name="Milelegis" class="form-control form-control-sm" style="width: 100%;" value="{{ number_format($data->Mile_legis, 2) }}" readonly/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          วันที่ทำสัญญา
                          <div class="form-inline" align="left">
                            <input type="text" name="DateDuelegis" class="form-control form-control-sm" style="width: 100%;" value="{{ DateThai($data->DateDue_legis) }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ยอดจัด
                          <div class="form-inline" align="left">
                            <input type="text" name="Paylegis" class="form-control form-control-sm" style="width: 100%;" value="{{ number_format(($data1 == null)?$data1:$data->Pay_legis,2) }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ค่าผ่อน
                          <div class="form-inline" align="left">
                            <input type="text" name="Periodlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ number_format(($data1 == null)?$data1:$data->Period_legis,2) }}" readonly/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          จำนวนงวดทั้งหมด
                          <div class="form-inline" align="left">
                            <input type="text" name="Countperiodlegis" class="form-control form-control-sm" style="width: 100%;" value="{{($data1 == null)?$data1:$data->Countperiod_legis}}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ค้างจากงวดที่
                          <div class="form-inline" align="left">
                            <input type="text" name="Beforeperiodlegis" class="form-control form-control-sm" style="width: 100%;" value="{{($data1 == null)?$data1:$data->Beforeperiod_legis}}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ถึงงวดที่
                          <div class="form-inline" align="left">
                            <input type="text" name="Remainperiodlegis" class="form-control form-control-sm" style="width: 100%;" value="{{($data1 == null)?$data1:$data->Remainperiod_legis }}" readonly/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          ชำระแล้ว
                          <div class="form-inline" align="left">
                            <input type="text" name="Beforemoeylegis" class="form-control form-control-sm" style="width: 100%;" value="{{ number_format(($data1 == null)?$data1:$data->Beforemoey_legis, 2) }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ค้าง
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          ค้างงวดจริง
                          <div class="form-inline" align="left">
                            <input type="text" class="form-control form-control-sm" style="width: 47%;" value="{{ number_format(($data1 == null)?$data1:$data->Remainperiod_legis, 0) }}" readonly/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" class="form-control form-control-sm" style="width: 47%;" value="{{ ($data1 == null)?$data1:$data->Realperiod_legis }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          ลูกหนี้คงเหลือ
                          <div class="form-inline" align="left">
                            <input type="text" name="Sumperiodlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ number_format(($data1 == null)?$data1:$data->Sumperiod_legis, 2) }}" readonly/>
                          </div>
                        </div>
                      </div>

                      @if($data1 != null)
                        <input type="hidden" name="Phonelegis" class="form-control form-control-sm" style="width: 100%;" value="{{ (iconv('TIS-620', 'utf-8',$data1->TELP)) }}" readonly/>
                      @else
                        <input type="hidden" name="Phonelegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->Phone_legis }}" readonly/>
                      @endif

                      <div class="row">
                        <div class="col-md-4">
                          วันที่หยุด Vat
                          <div class="form-inline" align="left">
                            @if($data->DateVAT_legis == Null)
                            <input type="text" name="DateVATlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ ($data1 == null)?$data1:$data->DateVAT_legis }}" readonly/>
                            @else
                            <input type="text" name="DateVATlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ DateThai(($data1 == null)?$data1:$data->DateVAT_legis) }}" readonly/>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4">
                          ชื่อผู้ค้ำ
                          <div class="form-inline" align="left">
                            <input type="text" name="NameGTlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->NameGT_legis }}" readonly/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          เลขบัตรประชาชน
                          <div class="form-inline" align="left">
                            <input type="text" name="IdcardGTlegis" class="form-control form-control-sm" style="width: 100%;" value="{{ $data->IdcardGT_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" readonly/>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-tasks"></i> เอกสาร</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
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

              <div class="row">
                <div class="col-md-6">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-marker"></i> หมายเหตุ</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-inline" align="left">
                            <textarea style="width:100%" name="Legisnote" class="form-control form-control-sm" rows="5">{{ ($data->Note) }}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @if($data1 != null)
                  <input type="hidden" name="Adreeslegis" class="form-control form-control-sm"  value="{{ iconv('TIS-620', 'utf-8', str_replace(" ","",$data1->ADDRES))." ต.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data1->TUMB))." อ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data1->AUMPDES))." จ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$data1->PROVDES))."  ".iconv('TIS-620', 'utf-8', str_replace(" ","",$data1->ZIP)) }}"/>
                @endif

                @if($dataGT != Null)
                  <input type="hidden" name="AdreesGTlegis" class="form-control form-control-sm"  value="{{ iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->ADDRES))." ต.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->TUMB))." อ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->AUMPDES))." จ.".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->PROVDES))."  ".iconv('TIS-620', 'utf-8', str_replace(" ","",$dataGT->ZIP)) }}"/>
                @endif

            <input type="hidden" name="_method" value="PATCH"/>
          </form>

                <div class="col-12 col-md-6">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-archive"></i> อัพโหลดเอกสาร</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          เลือกไฟล์ :
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="filePDF" class="custom-file-input" id="exampleInputFile" value="">
                              <label class="custom-file-label" for="exampleInputFile">เลือกไฟล์อัพโหลด</label>
                            </div>
                          </div>
                          <input type="hidden" name="contract" value="{{ $data->Contract_legis }}">                              
                        </div>
                      </div>

                      @if($countDataImages != 0)
                        <hr>
                        <div class="row">
                          <div class="table-responsive">
                            <table class="table table-striped table-valign-middle" id="table1">
                              <thead>
                                <tr>
                                  <th class="text-center"  style="width: 50px;">No.</th>
                                  <th class="text-center">File Name</th>
                                  <th class="text-center">Date Upload</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach($dataImages as $key => $row)
                                  <tr>
                                    <td class="text-center"> {{$key+1}}</td>
                                    <td class="text-left"> 
                                        <i class="fas fa-file-pdf-o text-red"></i>
                                      &nbsp;{{$row->name_image}}
                                    </td>
                                    <td class="text-left">{{DateThai(substr($row->created_at,0,10))}}</td>
                                    <td class="text-right">
                                        <a target="_blank" href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{$type}}&preview={{1}}&file_id={{$row->image_id}}" class="btn btn-warning btn-xs" title="ดูไฟล์">
                                          <i class="far fa-eye"></i>
                                        </a>
                                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก กฎหมาย")
                                        <form method="post" class="delete_form" action="{{ route('MasterLegis.destroy',$data->id) }}" style="display:inline;">
                                        {{csrf_field()}}
                                          <input type="hidden" name="type" value="5" />
                                          <input type="hidden" name="file_id" value="{{$row->image_id}}" />
                                          <input type="hidden" name="contract" value="{{ $data->Contract_legis }}"> 

                                          <input type="hidden" name="_method" value="DELETE" />
                                          <button type="submit" data-name="{{$row->name_image}}" class="delete-modal btn btn-danger btn-xs AlertForm" title="ลบไฟล์">
                                            <i class="far fa-trash-alt"></i>
                                          </button>
                                        </form>
                                      @endif
                                    </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <a id="button"></a>
        </div>
      </section>
    </div>
  </section>

  <div class="modal fade" id="modal-printinfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form name="form2" method="post" action="{{ route('MasterLegis.store') }}" id="formimage" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$id}}"/>
          <input type="hidden" name="type" value="2"/>

          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">ป้อนข้อมูลปิดบัญชี</h4>
              <div class="card-tools">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
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
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">วันที่ปิดบัญชี : </label>
                    <div class="col-sm-8">
                      <input type="date" name="DateCloseAccount" class="form-control form-control-sm" value="{{ (($data->DateStatus_legis !== Null) ?$data->DateStatus_legis: date('Y-m-d')) }}" />
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดปิดบัญชี : </label>
                    <div class="col-sm-8">
                      <input type="text" id="PriceAccount" name="PriceAccount" class="form-control form-control-sm" placeholder="ป้อนยอดตั้งต้น" value="{{ number_format(($data->PriceStatus_legis !== Null) ?$data->PriceStatus_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดชำระ : </label>
                    <div class="col-sm-8">
                      <input type="text" id="TopCloseAccount" name="TopCloseAccount" class="form-control form-control-sm" placeholder="ป้อนยอดชำระ" value="{{ number_format(($data->txtStatus_legis !== Null) ?$data->txtStatus_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                      <input type="hidden" name="ContractNo" class="form-control form-control-sm" value="{{$data->Contract_legis}}"/>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดส่วนลด : </label>
                    <div class="col-sm-8">
                      <input type="text" id="DiscountAccount" name="DiscountAccount" class="form-control form-control-sm" placeholder="ป้อนยอดส่วนลด" value="{{ number_format(($data->Discount_legis !== Null) ?$data->Discount_legis: 0) }}" oninput="addcomma();" maxlength="8" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div align="center">
              <button id="submit" type="submit" class="btn btn-primary">
                <span class="fa fa-id-card-o"></span> พิมพ์
              </button>
            </div>
            <br>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- back-to-top --}}
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
    $("#submit").click(function () {
      $("#modal-printinfo").modal('toggle');
      location.reload(true);
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>

  <script>
    $(function () {
      $("#modal-preview").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-preview .modal-body").load(link, function(){
        });
      });
    });
  </script>
@endsection
