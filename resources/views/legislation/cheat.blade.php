@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">ลูกหนี้โกงเจ้าหนี้</h4>
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
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 7]) }}">ชั้นบังคับคดี</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 13]) }}">โกงเจ้าหนี้</a></li>
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

                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนชั้นโกงเจ้าหนี้</b></h4>

                      <div class="box box-warning box-solid">
                        <div class="nav-tabs-custom" style="background-color : #f39c12;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-unsorted"></i> ขั้นตอนระบบ</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="col-md-6">
                                      วันที่แจ้งความ
                                      <input type="date" id="DateNoticeCheat" name="DateNoticeCheat" value="{{ ($data->DateNotice_cheat !== Null) ?$data->DateNotice_cheat : 'วว/ดด/ปปปป' }}" class="form-control" readonly/>
                                      วันที่อัยการยื่นคำฟ้อง
                                      <input type="date" id="DateindictmentCheat" name="DateindictmentCheat" value="{{ $data->Dateindictment_cheat }}" class="form-control"/>
                                      วันที่สืบพยาน
                                      <input type="date" id="DateExamineCheat" name="DateExamineCheat" value="{{ $data->DateExamine_cheat }}" class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                      วันที่นัดสอบคำให้การ
                                      <input type="date" id="DatedepositionCheat" name="DatedepositionCheat" value="{{ $data->Datedeposition_cheat }}" class="form-control"/>
                                      วันที่ยื่นคำร้องเป็นโจทก์ร่วม
                                      <input type="date" id="DateplantiffCheat" name="DateplantiffCheat" value="{{ $data->Dateplantiff_cheat }}" class="form-control"/>
                                      สถานะ
                                      <select id="StatusCheat" name="StatusCheat" class="form-control">
                                        <option value="" selected>--- เลือกสถานะ ---</option>
                                        <option value="ศาลพิพากษา" {{ ($data->Status_cheat === 'ศาลพิพากษา') ? 'selected' : '' }}>ศาลพิพากษา</option>
                                        <option value="ประนีประนอม(จำหน่ายคดี)" {{ ($data->Status_cheat === 'ประนีประนอม(จำหน่ายคดี)') ? 'selected' : '' }}>ประนีประนอม(จำหน่ายคดี)</option>
                                        <option value="ยื่นคำร้องให้ศาลพิพากษา" {{ ($data->Status_cheat === 'ยื่นคำร้องให้ศาลพิพากษา') ? 'selected' : '' }}>ยื่นคำร้องให้ศาลพิพากษา</option>
                                        <option value="ปิดบัญชีโกงเจ้าหนี้" {{ ($data->Status_cheat === 'ปิดบัญชีโกงเจ้าหนี้') ? 'selected' : '' }}>ปิดบัญชีโกงเจ้าหนี้</option>
                                        @if($data->Status_legis != Null)
                                          <option disabled>------------------------------</option>
                                          <option value="{{$data->Status_legis}}" style="color:red" {{ ($data->Status_legis === $data->Status_legis) ? 'selected' : '' }}>{{$data->Status_legis}}</option>
                                        @endif
                                      </select>
                                      วันที่เลือกสถานะ
                                      <input type="date" id="DateStatusCheat" name="DateStatusCheat" value="{{ $data->DateStatus_cheat }}" class="form-control" readonly/>
                                    </div>
                                  </div>

                                  <script>
                                    $('#StatusCheat').change(function(){
                                      var value = document.getElementById('StatusCheat').value;
                                      var today = new Date();
                                      var date = today.getFullYear()+'-'+(today.getMonth()+1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");
                                        if(value != ''){
                                          $('#DateStatusCheat').val(date);
                                        }
                                        else{
                                          $('#DateStatusCheat').val('');
                                        }
                                    });
                                  </script>

                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="noteCheat" class="form-control" rows="6">{{ $data->note_cheat }}</textarea>
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
                      <input type="date" id="DateCloseAccount" name="DateCloseAccount" class="form-control" style="width: 150px;" value="{{ (($data->DateStatus_legis !== Null) ?$data->DateStatus_legis: date('Y-m-d')) }}" />
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
