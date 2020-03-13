@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <style>
    input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
    input[type="checkbox"]+span { font: 14pt sans-serif; color: #000; }
    input[type="checkbox"]+span:before { font: 14pt FontAwesome; content: '\00f096'; display: inline-block; width: 14pt; padding: 2px 0 0 3px; margin-right: 0.5em; }
    input[type="checkbox"]:checked+span:before { content: '\00f046'; }
    input[type="checkbox"]:focus+span:before { outline: 1px dotted #aaa; }
  </style>

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
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">ข้อมูลผู้เช่าซื้อ</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 7]) }}">ชั้นบังคับคดี</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 13]) }}">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 4]) }}">ประนอมหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 8]) }}">สืบทรัพย์</a></li>
            </ul>
          </div>

          <div class="box-body">
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
                          <span class="info-box-icon bg-red"><i class="fa fa-id-badge fa-lg"></i></span>
                          <div class="info-box-content">
                            <div class="col-md-4">
                              <span class="info-box-number"><font style="font-size: 30px;">{{ $data->Contract_legis }}</font></span>
                              <span class="info-box-text"><font style="font-size: 20px;">{{ $data->Name_legis }}</font></span>
                            </div>
                            <div class="col-md-8">
                              <div class="form-inline">
                                <p></p>
                                <div align="left">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <small class="label label-success" style="font-size: 25px;">
                                  <i class="fa fa-expeditedssl"></i>&nbsp; สถานะ : 
                                    @if($data->Status_legis != Null)
                                        {{$data->Status_legis}}
                                    @endif
                                  </small>
                                </div>
                                <p></p>
                                <label>สถานะ : </label>
                                <select name="" class="form-control" style="width: 170px;" disabled>
                                  <option value="" selected>--- status ---</option>
                                </select>
                                <input type="date" name="" class="form-control" style="width: 170px;" value="" disabled>
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

                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนชั้นบังคับคดี</b></h4>

                      <div class="box box-warning box-solid">
                        <div class="nav-tabs-custom" style="background-color : #f39c12;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-unsorted"></i> เตรียมเอกสาร(30 วัน)</a></li>
                            <li class="nav-item"><a href="#tab_2" data-toggle="tab"><i class="fa fa-unsorted"></i> ตั้งเรื่องยึดทรัพย์(180 วัน)</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    วันที่คัดฉโหนด
                                    <input type="date" id="datepreparedoc" name="datepreparedoc" class="form-control" value="{{$data->datepreparedoc_case}}" onchange="CourtcaseDate();" />
                                    <br>
                                    <label>
                                      <input type="checkbox" name="Flagcase" value="Y" {{ ($data->Flag_case === 'Y') ? 'checked' : '' }}/>
                                      <span><font color="red">โกงเจ้าหนี้</font></span>
                                    </label>
                                  </div>
                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="noteprepare" class="form-control" rows="3">{{$data->noteprepare_case}}</textarea>
                                  </div>
                                </div>

                              </div>
                            </div>

                            <div class="tab-pane" id="tab_2">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    วันที่ตั้งเรื่องยึดทรัพย์แรกเริ่ม
                                    <input type="date" id="DatesetSequester" name="DatesetSequester" class="form-control" value="{{ $data->datesetsequester_case }}" />
                                  </div>
                                  
                                  <div class="col-md-6">
                                    ประกาศขาย
                                    <select id="ResultSequester" name="ResultSequester" class="form-control">
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
                                    <select id="StatusCase" name="StatusCase" class="form-control">
                                      <option value="" selected>--- สถานะ ---</option>
                                      <option value="ถอนบังคับคดีปิดบัญชี" {{ ($data->Status_case === 'ถอนบังคับคดีปิดบัญชี') ? 'selected' : '' }}>ถอนบังคับคดีปิดบัญชี</option>
                                      <option value="ถอนบังคับคดียึดรถ" {{ ($data->Status_case === 'ถอนบังคับคดียึดรถ') ? 'selected' : '' }}>ถอนบังคับคดียึดรถ</option>
                                      <option value="ประนอมหลังยึดทรัพย์" {{ ($data->Status_case === 'ประนอมหลังยึดทรัพย์') ? 'selected' : '' }}>ประนอมหลังยึดทรัพย์</option>
                                      <option value="ถอนบังคับคดียอดเหลือน้อย" {{ ($data->Status_case === 'ถอนบังคับคดียอดเหลือน้อย') ? 'selected' : '' }}>ถอนบังคับคดียอดเหลือน้อย</option>
                                      <option value="ถอนบังคับคดีขายเต็มจำนวน" {{ ($data->Status_case === 'ถอนบังคับคดีขายเต็มจำนวน') ? 'selected' : '' }}>ถอนบังคับคดีขายเต็มจำนวน</option>
                                    </select>
                                  
                                    @if($data->Status_case == 'ถอนบังคับคดีปิดบัญชี')
                                    <div id="StatusShow1">
                                    @else
                                    <div id="StatusShow1" style="display:none;">
                                    @endif
                                      <div class="form-inline">
                                        <br>
                                        <div class="col-md-7">
                                          วันที่เลือกสถานะ
                                          <input type="date" id="DateStatusCase1" name="DateStatusCase1" class="form-control" value="{{ $data->DateStatus_case }}" readonly/> 
                                        </div>
                                        <div class="col-md-5">
                                          ยอดพิพากษา
                                          <input type="text" id="txtStatusCase1" name="txtStatusCase1" class="form-control" style="width: 130px;" value="{{ $data->txtStatus_case }}" />
                                        </div>
                                      </div>
                                    </div>

                                    @if($data->Status_case == 'ถอนบังคับคดียึดรถ')
                                    <div id="StatusShow2">
                                    @else
                                    <div id="StatusShow2" style="display:none;">
                                    @endif
                                      <div class="form-inline">
                                        <br>
                                        <div class="col-md-7">
                                          วันที่เลือกสถานะ
                                          <input type="date" id="DateStatusCase2" name="DateStatusCase2" class="form-control" value="{{ $data->DateStatus_case }}" readonly/> 
                                        </div>
                                        <div class="col-md-5">
                                          วันที่ยึดรถ
                                          <input type="date" id="txtStatusCase2" name="txtStatusCase2" class="form-control" style="width: 150px;" value="{{ $data->txtStatus_case }}" />
                                        </div>
                                      </div>
                                    </div>

                                    @if($data->Status_case == 'ถอนบังคับคดียอดเหลือน้อย')
                                    <div id="StatusShow3">
                                    @else
                                    <div id="StatusShow3" style="display:none;">
                                    @endif
                                      <div class="form-inline">
                                        <br>
                                        <div class="col-md-7">
                                          วันที่เลือกสถานะ
                                          <input type="date" id="DateStatusCase3" name="DateStatusCase3" class="form-control" value="{{ $data->DateStatus_case }}" readonly/> 
                                        </div>
                                        <div class="col-md-5">
                                          ยอดเหลือน้อย
                                          <input type="text" id="txtStatusCase3" name="txtStatusCase3" class="form-control" style="width: 120px;" value="{{ $data->txtStatus_case }}" />
                                        </div>
                                      </div>
                                    </div>

                                    หมายเหตุ
                                    <textarea name="Notesequester" class="form-control" rows="3">{{$data->notesequester_case}}</textarea>
                                  </div>

                                  @if($data->resultsequester_case == 'ขายไม่ได้')
                                  <div id="ShowDetail1">
                                  @else
                                  <div id="ShowDetail1" style="display:none;">
                                  @endif
                                    <div class="col-md-6">
                                      วันที่จ่ายเงิน
                                      <input type="date" id="DatenextSequester" name="DatenextSequester" class="form-control" value="{{$data->datenextsequester_case}}" />
                                      <br>
                                      <div class="form-inline">
                                        <div class="col-md-7">
                                          จำนวนครั้งประกาศขาย
                                          <input type="number" id="CountSeliing" name="CountSeliing" class="form-control" min="1" style="width: 130px;" value="{{ $data->NumAmount_case }}" />
                                        </div>
                                        <div class="col-md-5">
                                          เงินค่าใช้จ่าย
                                          <input type="text" id="Paidseguester" name="Paidseguester" class="form-control" style="width: 130px;" value="{{number_format($data->paidsequester_case,0)}}" />
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  @if($data->resultsequester_case == 'ขายได้')
                                  <div id="ShowDetail2">
                                  @else
                                  <div id="ShowDetail2" style="display:none;">
                                  @endif
                                    <div class="col-md-6">
                                      <!-- <font color="#FFFFFF">ขายได้</font> -->
                                      ผลจากการขาย
                                      <select id="ResultSell" name="ResultSell" class="form-control">
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
                                      <input type="date" id="Datesoldout" name="Datesoldout" class="form-control" value="{{$data->datesoldout_case}}" />
                                    </div>
                                  </div>

                                  @if($data->resultsell_case == 'ไม่เต็มจำนวน')
                                  <div id="ShowSellDetail2">
                                  @else
                                  <div id="ShowSellDetail2" style="display:none;">
                                  @endif
                                    <div class="col-md-6">
                                      จำนวนเงิน
                                      <input type="text" id="Amountsequester" name="Amountsequester" class="form-control" value="{{number_format($data->amountsequester_case,0)}}" />
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

    <!-- เวลาแจ้งเตือน -->
    <script type="text/javascript">
      $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
      $(".alert").alert('close');
      });
    </script>

    </section>
@endsection
