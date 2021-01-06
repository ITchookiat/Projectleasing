@extends('layouts.master')
@section('title','กฏหมาย/ชั้นบังคับคดี')
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

  <style>
    input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
    input[type="checkbox"]+span { font: 14pt sans-serif; color: #000; }
    input[type="checkbox"]+span:before { font: 14pt FontAwesome; content: '\00f096'; display: inline-block; width: 14pt; padding: 2px 0 0 3px; margin-right: 0.5em; }
    input[type="checkbox"]:checked+span:before { content: '\00f046'; }
    input[type="checkbox"]:focus+span:before { outline: 1px dotted #aaa; }
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
            <input type="hidden" name="type" value="7"/>

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
                              <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{2}}">ข้อมูลลูกหนี้</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{3}}">ชั้นศาล</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href="{{ route('MasterLegis.edit',[$id]) }}?type={{7}}">ชั้นบังคับคดี</a>
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
                            @if($data->Status_legis != Null)
                              <input type="text" name="StatusCase" class="form-control form-control-sm" value="{{$data->Status_legis}}" readonly>
                              <input type="date" name="DateStatuslegis" class="form-control form-control-sm" value="{{ $data->DateUpState_legis }}" readonly>
                            @else
                              <input type="text" class="form-control form-control-sm" value="--------- status ----------" readonly>
                              <input type="date" class="form-control form-control-sm" readonly>
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="" align="left">ขั้นตอนชั้นบังคับคดี</h5>
                <div class="row">
                  <div class="col-12 col-md-7">
                    <div class="card card-primary card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> เตรียมเอกสาร(30 วัน)</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-2" data-toggle="pill" href="#tabs-2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ตั้งเรื่องยึดทรัพย์(180 วัน)</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                          <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="row">
                              <div class="col-md-7">
                                <div class="row">
                                  วันที่คัดฉโหนด
                                  <input type="date" id="datepreparedoc" name="datepreparedoc" class="form-control form-control-sm" value="{{$data->datepreparedoc_case}}" onchange="CourtcaseDate();" />
                                  หมายเหตุ
                                  <textarea name="noteprepare" class="form-control form-control-sm" rows="3">{{$data->noteprepare_case}}</textarea>
                                </div>
                              </div>

                              <div class="col-md-5">
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-tasks"></i> สถานะ</h3>
                                  </div>
                                  <div class="card-body">
                                    <div class="col-md-12">
                                      <div class="" id="todo-list">
                                        <span class="todo-wrap">
                                          <input type="checkbox" id="12" name="FlagClass" value="สถานะส่งยึดทรัพย์" {{ ($data->Flag_Class === 'สถานะส่งยึดทรัพย์') ? 'checked' : '' }}/>
                                          <label for="12" class="todo">
                                            <i class="fa fa-check"></i>
                                            Prosecute (สถานะส่งยึดทรัพย์)
                                          </label>
                                        </span>
                                        <span class="todo-wrap">
                                          <input type="checkbox" id="13" name="Flagcase" value="Y" {{ ($data->Flag_case === 'Y') ? 'checked' : '' }}/>
                                          <label for="13" class="todo">
                                            <i class="fa fa-check"></i>
                                            โกงเจ้าหนี้
                                          </label>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="row">
                              {{-- <div class="col-md-6">
                                <div class="" id="todo-list">
                                  <span class="todo-wrap">
                                    <input type="checkbox" id="14" name="FlagClass" value="สถานะยึดทรัพย์" {{ ($data->Flag_Class === 'สถานะยึดทรัพย์') ? 'checked' : '' }}/>
                                    <label for="14" class="todo">
                                      <i class="fa fa-check"></i>
                                      Prosecute 
                                    </label>
                                  </span>
                                </div>
                              </div> --}}
                              <div class="col-md-6">
                                วันที่ตั้งเรื่องยึดทรัพย์แรกเริ่ม
                                <input type="date" id="DatesetSequester" name="DatesetSequester" class="form-control form-control-sm" value="{{ $data->datesetsequester_case }}" />
                              </div>
                              
                              <div class="col-md-6">
                                ประกาศขาย
                                <select id="ResultSequester" name="ResultSequester" class="form-control form-control-sm">
                                  <option value="" selected>--- เลือกผลการประกาศขาย ---</option>
                                  <option value="ขายได้" {{ ($data->resultsequester_case === 'ขายได้') ? 'selected' : '' }}>ขายได้</option>
                                  <option value="ขายไม่ได้" {{ ($data->resultsequester_case === 'ขายไม่ได้') ? 'selected' : '' }}>ขายไม่ได้</option>
                                </select>
                              </div>
                            </div>

                            <script>
                                $('#ResultSequester').change(function(){
                                  var value = document.getElementById('ResultSequester').value;
                                    if(value == 'ขายไม่ได้'){
                                      $('#ShowDetail1').show();
                                      $('#ShowDetail2').hide();
                                      $('#ShowSellDetail1').hide();
                                      $('#ShowSellDetail2').hide();
                                    }
                                    else if(value == 'ขายได้'){
                                      $('#ShowDetail2').show();
                                      $('#ShowDetail1').hide();
                                      $('#ShowSellDetail1').hide();
                                      $('#ShowSellDetail2').hide();
                                    }
                                    else{
                                      $('#ShowDetail1').hide();
                                      $('#ShowDetail2').hide();
                                      $('#ShowSellDetail1').hide();
                                      $('#ShowSellDetail2').hide();
                                    }
                                });

                            </script>

                            <div class="row">
                              <div class="col-md-6">
                                สถานะบังคับคดี
                                <select id="StatusCase" name="StatusCase" class="form-control form-control-sm">
                                  <option value="" selected>--- สถานะ ---</option>
                                  <option value="ถอนบังคับคดีปิดบัญชี" {{ ($data->Status_legis === 'ถอนบังคับคดีปิดบัญชี') ? 'selected' : '' }}>ถอนบังคับคดีปิดบัญชี</option>
                                  <option value="ถอนบังคับคดียึดรถ" {{ ($data->Status_legis === 'ถอนบังคับคดียึดรถ') ? 'selected' : '' }}>ถอนบังคับคดียึดรถ</option>
                                  <option value="ประนอมหลังยึดทรัพย์" {{ ($data->Status_legis === 'ประนอมหลังยึดทรัพย์') ? 'selected' : '' }}>ประนอมหลังยึดทรัพย์</option>
                                  <option value="ถอนบังคับคดียอดเหลือน้อย" {{ ($data->Status_legis === 'ถอนบังคับคดียอดเหลือน้อย') ? 'selected' : '' }}>ถอนบังคับคดียอดเหลือน้อย</option>
                                  <option value="ถอนบังคับคดีขายเต็มจำนวน" {{ ($data->Status_legis === 'ถอนบังคับคดีขายเต็มจำนวน') ? 'selected' : '' }}>ถอนบังคับคดีขายเต็มจำนวน</option>
                                  @if($data->Status_legis != Null)
                                    <option disabled>------------------------------</option>
                                    <option value="{{$data->Status_legis}}" style="color:red" {{ ($data->Status_legis === $data->Status_legis) ? 'selected' : '' }}>{{$data->Status_legis}}</option>
                                  @endif
                                </select>
                              
                                @if($data->Status_legis == 'ถอนบังคับคดีปิดบัญชี')
                                <div id="StatusShow1">
                                @else
                                <div id="StatusShow1" style="display:none;">
                                @endif
                                  <div class="form-inline">
                                    <br><br><br>
                                    <div class="col-md-7">
                                      วันที่เลือกสถานะ
                                      <input type="date" id="DateStatusCase1" name="DateStatusCase1" class="form-control form-control-sm" value="{{ $data->DateStatus_case }}" readonly/> 
                                    </div>
                                    <div class="col-md-5">
                                      ยอดพิพากษา
                                      <input type="text" id="txtStatusCase1" name="txtStatusCase1" class="form-control form-control-sm" style="width: 130px;" value="{{ $data->txtStatus_case }}" />
                                    </div>
                                  </div>
                                </div>

                                @if($data->Status_legis == 'ถอนบังคับคดียึดรถ')
                                <div id="StatusShow2">
                                @else
                                <div id="StatusShow2" style="display:none;">
                                @endif
                                  <div class="form-inline">
                                    <br><br><br>
                                    <div class="col-md-7">
                                      วันที่เลือกสถานะ
                                      <input type="date" id="DateStatusCase2" name="DateStatusCase2" class="form-control form-control-sm" value="{{ $data->DateStatus_case }}" readonly/> 
                                    </div>
                                    <div class="col-md-5">
                                      วันที่ยึดรถ
                                      <input type="date" id="txtStatusCase2" name="txtStatusCase2" class="form-control form-control-sm" style="width: 150px;" value="{{ $data->txtStatus_case }}" />
                                    </div>
                                  </div>
                                </div>

                                @if($data->Status_legis == 'ถอนบังคับคดียอดเหลือน้อย')
                                <div id="StatusShow3">
                                @else
                                <div id="StatusShow3" style="display:none;">
                                @endif
                                  <div class="form-inline">
                                    <br><br><br>
                                    <div class="col-md-7">
                                      วันที่เลือกสถานะ
                                      <input type="date" id="DateStatusCase3" name="DateStatusCase3" class="form-control form-control-sm" value="{{ $data->DateStatus_case }}" readonly/> 
                                    </div>
                                    <div class="col-md-5">
                                      ยอดเหลือน้อย
                                      <input type="text" id="txtStatusCase3" name="txtStatusCase3" class="form-control form-control-sm" style="width: 120px;" value="{{ $data->txtStatus_case }}" />
                                    </div>
                                  </div>
                                </div>

                                หมายเหตุ
                                <textarea name="Notesequester" class="form-control" rows="3">{{$data->notesequester_case}}</textarea>
                              </div>

                              <div class="col-md-6">
                                @if($data->resultsequester_case == 'ขายไม่ได้')
                                <div id="ShowDetail1">
                                @else
                                <div id="ShowDetail1" style="display:none;">
                                @endif
                                  <div class="col-md-12">
                                    วันที่จ่ายเงิน
                                    <input type="date" id="DatenextSequester" name="DatenextSequester" class="form-control form-control-sm" value="{{$data->datenextsequester_case}}" />
                                    <br>
                                    <div class="form-inline">
                                      <div class="col-md-7">
                                        จำนวนครั้งประกาศขาย
                                        <input type="number" id="CountSeliing" name="CountSeliing" class="form-control form-control-sm" min="1" style="width: 130px;" value="{{ $data->NumAmount_case }}" />
                                      </div>
                                      <div class="col-md-5">
                                        เงินค่าใช้จ่าย
                                        <input type="text" id="Paidseguester" name="Paidseguester" class="form-control form-control-sm" style="width: 130px;" value="{{number_format($data->paidsequester_case,0)}}" />
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                @if($data->resultsequester_case == 'ขายได้')
                                <div id="ShowDetail2">
                                @else
                                <div id="ShowDetail2" style="display:none;">
                                @endif
                                  <div class="col-md-12">
                                    ผลจากการขาย
                                    <select id="ResultSell" name="ResultSell" class="form-control form-control-sm">
                                      <option value="" selected>--- เลือกผลจากการขาย ---</option>
                                      <option value="เต็มจำนวน" {{ ($data->resultsell_case === 'เต็มจำนวน') ? 'selected' : '' }}>เต็มจำนวน</option>
                                      <option value="ไม่เต็มจำนวน" {{ ($data->resultsell_case === 'ไม่เต็มจำนวน') ? 'selected' : '' }}>ไม่เต็มจำนวน</option>
                                    </select>
                                  </div>
                                </div>

                                <script>
                                  $('#ResultSell').change(function(){
                                    var value = document.getElementById('ResultSell').value;
                                      if(value == 'เต็มจำนวน'){
                                        $('#ShowSellDetail1').show();
                                        $('#ShowSellDetail2').hide();
                                      }
                                      else if(value == 'ไม่เต็มจำนวน'){
                                        $('#ShowSellDetail1').hide();
                                        $('#ShowSellDetail2').show();
                                      }
                                      else{
                                        $('#ShowSellDetail1').hide();
                                        $('#ShowSellDetail2').hide();
                                      }
                                  });

                                  $('#StatusCase').change(function(){
                                    var value = document.getElementById('StatusCase').value;
                                    var today = new Date();
                                    var date = today.getFullYear()+'-'+(today.getMonth()+1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");

                                    if(value == 'ถอนบังคับคดีปิดบัญชี'){
                                      $('#StatusShow1').show();
                                      $('#StatusShow2').hide();
                                      $('#StatusShow3').hide();

                                      if(value != ''){
                                        $('#DateStatusCase1').val(date);
                                      }
                                      else{
                                        $('#DateStatusCase1').val('');
                                      }
                                    }
                                    else if(value == 'ถอนบังคับคดียึดรถ'){
                                      $('#StatusShow2').show();
                                      $('#StatusShow1').hide();
                                      $('#StatusShow3').hide();

                                      if(value != ''){
                                        $('#DateStatusCase2').val(date);
                                      }
                                      else{
                                        $('#DateStatusCase2').val('');
                                      }
                                    }
                                    else if(value == 'ถอนบังคับคดียอดเหลือน้อย'){
                                      $('#StatusShow3').show();
                                      $('#StatusShow1').hide();
                                      $('#StatusShow2').hide();

                                      if(value != ''){
                                        $('#DateStatusCase3').val(date);
                                      }
                                      else{
                                        $('#DateStatusCase3').val('');
                                      }
                                    }
                                    else{
                                      $('#StatusShow1').hide();
                                      $('#StatusShow2').hide();
                                      $('#StatusShow3').hide();

                                      if(value != ''){
                                        $('#DateStatusCase3').val(date);
                                      }
                                      else{
                                        $('#DateStatusCase3').val('');
                                      }
                                    }
                                  });
                                </script>

                                @if($data->resultsell_case == 'เต็มจำนวน')
                                <div id="ShowSellDetail1">
                                @else
                                <div id="ShowSellDetail1" style="display:none;">
                                @endif
                                  <div class="col-md-6">
                                    วันที่ขายได้
                                    <input type="date" id="Datesoldout" name="Datesoldout" class="form-control form-control-sm" value="{{$data->datesoldout_case}}" />
                                  </div>
                                </div>

                                @if($data->resultsell_case == 'ไม่เต็มจำนวน')
                                <div id="ShowSellDetail2">
                                @else
                                <div id="ShowSellDetail2" style="display:none;">
                                @endif
                                  <div class="col-md-6">
                                    จำนวนเงิน
                                    <input type="text" id="Amountsequester" name="Amountsequester" class="form-control form-control-sm" value="{{number_format($data->amountsequester_case,0)}}" />
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
          </form>

                <div class="col-12 col-md-5">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-archive"></i> อัพโหลดเอกสาร</h3>

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
                                        <a target="_blank" href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{$type}}&preview={{2}}&file_id={{$row->image_id}}" class="btn btn-warning btn-xs" title="ดูไฟล์">
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
              <!-- <input type="hidden" name="_method" value="PATCH"/>
            </form> -->
          </div>
        </div>
      </section>
    </div>
  </section>

  <div class="modal fade" id="modal-printinfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form name="form2" method="post" action="{{ route('MasterLegis.store') }}" target="_blank" id="formimage" enctype="multipart/form-data">
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
              <button id="submit" type="submit" class="btn btn-primary"><span class="fa fa-id-card-o"></span> พิมพ์</button>
            </div>
            <br>
          </div>

      </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-preview">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

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
