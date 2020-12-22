@extends('layouts.master')
@section('title','กฏหมาย/ลูกหนี้โกงเจ้าหนี้')
@section('content')

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
          <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                      <a class="btn btn-danger btn-sm" href="{{ route('legislation',2) }}">
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
                              <a class="nav-link" href="{{ action('LegislationController@edit',[$id, 2]) }}">ข้อมูลลูกหนี้</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ action('LegislationController@edit',[$id, 7]) }}">ชั้นบังคับคดี</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active" href="{{ action('LegislationController@edit',[$id, 13]) }}">โกงเจ้าหนี้</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-sm-6">
                          <div class="float-right form-inline">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                              <a class="nav-link" href="{{ action('LegislationController@edit',[$id, 8]) }}">สืบทรัพย์</a>
                              <a class="nav-link" href="{{ route('MasterCompro.edit',[$id]) }}?type={{2}}}">ประนอมหนี้</a>
                              <a class="nav-link" href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a>
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

                <h5 class="" align="left"><b>ขั้นตอนชั้นโกงเจ้าหนี้</b></h5>
                <div class="row">
                  <div class="col-12">
                    <div class="card card-primary card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> ขั้นตอนระบบ</a>
                          </li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                          <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-inline">
                                  <div class="col-md-6">
                                    วันที่แจ้งความ <br>
                                    <input type="date" id="DateNoticeCheat" name="DateNoticeCheat" style="width: 250px;" value="{{ ($data->DateNotice_cheat !== Null) ?$data->DateNotice_cheat : 'วว/ดด/ปปปป' }}" class="form-control" readonly/> <br>
                                    วันที่อัยการยื่นคำฟ้อง <br>
                                    <input type="date" id="DateindictmentCheat" name="DateindictmentCheat" style="width: 250px;" value="{{ $data->Dateindictment_cheat }}" class="form-control form-control-sm"/> <br>
                                    วันที่สืบพยาน <br>
                                    <input type="date" id="DateExamineCheat" name="DateExamineCheat" style="width: 250px;" value="{{ $data->DateExamine_cheat }}" class="form-control form-control-sm"/> <br>
                                    <input type="text" name="" id="" style="border: none; padding: 20px;">
                                  </div>
                                  <div class="col-md-6"> 
                                    วันที่นัดสอบคำให้การ <br>
                                    <input type="date" id="DatedepositionCheat" name="DatedepositionCheat" style="width: 250px;" value="{{ $data->Datedeposition_cheat }}" class="form-control form-control-sm"/> <br>
                                    วันที่ยื่นคำร้องเป็นโจทก์ร่วม <br>
                                    <input type="date" id="DateplantiffCheat" name="DateplantiffCheat" style="width: 250px;" value="{{ $data->Dateplantiff_cheat }}" class="form-control form-control-sm"/> <br>
                                    สถานะ <br>
                                    <select id="StatusCheat" name="StatusCheat" class="form-control form-control-sm" style="width: 250px;">
                                      <option value="" selected>--- เลือกสถานะ ---</option>
                                      <option value="ศาลพิพากษา" {{ ($data->Status_legis === 'ศาลพิพากษา') ? 'selected' : '' }}>ศาลพิพากษา</option>
                                      <option value="ประนีประนอม(จำหน่ายคดี)" {{ ($data->Status_legis === 'ประนีประนอม(จำหน่ายคดี)') ? 'selected' : '' }}>ประนีประนอม(จำหน่ายคดี)</option>
                                      <option value="ยื่นคำร้องให้ศาลพิพากษา" {{ ($data->Status_legis === 'ยื่นคำร้องให้ศาลพิพากษา') ? 'selected' : '' }}>ยื่นคำร้องให้ศาลพิพากษา</option>
                                      <option value="ปิดบัญชีโกงเจ้าหนี้" {{ ($data->Status_legis === 'ปิดบัญชีโกงเจ้าหนี้') ? 'selected' : '' }}>ปิดบัญชีโกงเจ้าหนี้</option>
                                      @if($data->Status_legis != Null)
                                        <option disabled>------------------------------</option>
                                        <option value="{{$data->Status_legis}}" style="color:red" {{ ($data->Status_legis === $data->Status_legis) ? 'selected' : '' }}>{{$data->Status_legis}}</option>
                                      @endif
                                    </select>
                                    <br> วันที่เลือกสถานะ <br>
                                    <input type="date" id="DateStatusCheat" name="DateStatusCheat" style="width: 250px;" value="{{ $data->DateUpState_legis }}" class="form-control form-control-sm" readonly/>
                                  </div>
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
                                <textarea name="noteCheat" class="form-control form-control-sm" rows="6">{{ $data->note_cheat }}</textarea>
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
        </div>
      </section>
    </div>
  </section>

  <div class="modal fade" id="modal-printinfo">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form name="form2" method="post" action="{{ route('legislation.store',[$id, 2]) }}" target="_blank" id="formimage" enctype="multipart/form-data">
          @csrf
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
@endsection
