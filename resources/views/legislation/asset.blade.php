@extends('layouts.master')
@section('title','กฏหมาย/ลูกหนี้สืบทรัพย์')
@section('content')

  <style>
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }
    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label
    {
        position: relative;
        padding-left: 28px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
    }
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 20px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }
    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 12px;
        height: 12px;
        background: #F87DA9;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }
    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
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
            <input type="hidden" name="type" value="8"/>

              <div class="card-header">
                <div class="row mb-1">
                  <div class="col-6">
                    <h5>ลูกหนี้สืบทรัพย์</h5>   
                  </div>
                  <div class="col-6">
                    <div class="card-tools d-inline float-right">
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
                              <a class="nav-link " href="{{ route('MasterLegis.edit',[$id]) }}?type={{3}}">ชั้นศาล</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{7}}">ชั้นบังคับคดี</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " href="{{ route('MasterLegis.edit',[$id]) }}?type={{13}}">โกงเจ้าหนี้</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-sm-6">
                          <div class="float-right form-inline">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                              <a class="nav-link active" href="{{ route('MasterLegis.edit',[$id]) }}?type={{8}}">สืบทรัพย์</a>
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

              <script>
                function adds(nStr){
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
                function Comma(){
                  var num11 = document.getElementById('Priceasset').value;
                  var num1 = num11.replace(",","");

                  document.form1.Priceasset.value = adds(num1);
                }
              </script>

              <h5 class="" align="left">ขั้นตอนสืบทรัพย์</h5>
              <div class="row">
                <div class="col-12">
                  <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> สถานะทรัพย์</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">สถานะทรัพย์ : </label>
                                <div class="col-sm-9">
                                  <input type="radio" id="test1" name="radio_propertied" value="Y" {{ ($data->propertied_asset === 'Y') ? 'checked' : '' }} />
                                  <label for="test1" class="mr-sm-5">มีทรัพย์</label>
                                  <input type="radio" id="test2" name="radio_propertied" value="N" {{ ($data->propertied_asset === 'N') ? 'checked' : '' }}/>
                                  <label for="test2" class="mr-sm-5">ไม่มีทรัพย์</label>
                                </div>
                              </div>
                              
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันสืบทรัพย์ : </label>
                                <div class="col-sm-9">
                                  <input type="date" id="Dateasset" name="Dateasset" class="form-control form-control-sm" value="{{ ($data->Date_asset != Null) ? $data->Date_asset : date('Y-m-d') }}" readonly/>
                                </div>
                              </div>

                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันสืบทรัพย์ครั้งแรก : </label>
                                <div class="col-sm-9">
                                  <input type="date" id="sequesterasset" name="sequesterasset" class="form-control form-control-sm" value="{{ $data->sequester_asset }}"/>
                                </div>
                              </div>

                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ผลสืบ : </label>
                                <div class="col-sm-9">
                                  <select id="sendsequesterasset" name="sendsequesterasset" class="form-control form-control-sm">
                                    <option value="" selected>--- เลือกผล ---</option>
                                    <option value="สืบทรัพย์เจอ" {{ ($data->sendsequester_asset === 'สืบทรัพย์เจอ') ? 'selected' : '' }}>สืบทรัพย์เจอ</option>
                                    <option value="สืบทรัพย์ไม่เจอ" {{ ($data->sendsequester_asset === 'สืบทรัพย์ไม่เจอ') ? 'selected' : '' }}>สืบทรัพย์ไม่เจอ</option>
                                    <option value="หมดอายุความคดี" {{ ($data->sendsequester_asset === 'หมดอายุความคดี') ? 'selected' : '' }}>หมดอายุความคดี</option>
                                    <option value="จบงานสืบทรัพย์" {{ ($data->sendsequester_asset === 'จบงานสืบทรัพย์') ? 'selected' : '' }}>จบงานสืบทรัพย์</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">ค่าใช้จ่าย : </label>
                                <div class="col-sm-9">
                                  <input type="text" id="Priceasset" name="Priceasset" class="form-control form-control-sm" value="{{ number_format($data->Price_asset) }}" oninput="Comma();"/>
                                </div>
                              </div>

                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">วันที่สืบทรัพย์ใหม่ : </label>
                                <div class="col-sm-9">
                                  <input type="date" id="NewpursueDateasset" name="NewpursueDateasset" class="form-control form-control-sm" value="{{ $data->NewpursueDate_asset }}"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-2 col-form-label text-right">สถานะสืบ : </label>
                                <div class="col-sm-10">
                                  <select id="statusasset" name="statusasset" class="form-control form-control-sm">
                                    <option value="" selected>--- สถานะสืบ ---</option>
                                    <option value="สืบทรัพย์ชั้นศาล" {{ ($data->Status_asset === 'สืบทรัพย์ชั้นศาล') ? 'selected' : '' }}>สืบทรัพย์ชั้นศาล</option>
                                    <option value="สืบทรัพย์ชั้นบังคับคดี" {{ ($data->Status_asset === 'สืบทรัพย์ชั้นบังคับคดี') ? 'selected' : '' }}>สืบทรัพย์ชั้นบังคับคดี</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row mb-0">
                                <label class="col-sm-2 col-form-label text-right">หมายเหตุ : </label>
                                <div class="col-sm-10">
                                  <textarea name="Notepursueasset" class="form-control form-control-sm" rows="8">{{ $data->Notepursue_asset }}</textarea>
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
          </form>
        </div>
      </section>
    </div>
  </section>

  <script>
    function FunctionRadio2() {
      var x = document.getElementById("myDIV");
      if (x.style.display === "none") {
      x.style.display = "block";
      } else {
      x.style.display = "none";
      }
    }

    function Functionhidden2() {
      var x = document.getElementById("myDIV");
      x.style.display = "none";
    }
  </script>

  <script>
    function FunctionRadio() {
      var x = document.getElementById("ShowMe");
      if (x.style.display === "none") {
      x.style.display = "block";
      } else {
      x.style.display = "none";
      }
    }

    function Functionhidden() {
      var x = document.getElementById("ShowMe");
      x.style.display = "none";
    }
  </script>
@endsection
