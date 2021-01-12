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
          <form name="form1" method="post" action="{{ route('MasterCompro.update',[$data->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
              <div class="card-header">
                <div class="row mb-1">
                  <div class="col-6">
                    <h5 class="">
                      @if ($data->Flag == "C")
                        ลูกหนี้ประนอมหนี้ (ประนอมเก่า)
                      @else
                        ลูกหนี้ประนอมหนี้ (Compounding Debt)
                      @endif
                    </h5>   
                  </div>
                  <div class="col-6">
                    <div class="card-tools d-inline float-right">
                      @if($dataPranom != 0)
                        <button type="button" class="delete-modal btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" data-link="{{ route('MasterCompro.edit',[$data->id]) }}?type={{5}}">
                          <i class="fas fa-plus"></i> New
                        </button>
                      @else
                        <a class="btn btn-info btn-sm" style="background-color:#CCCCCC; color:#FFFFFF;">
                          <i class="fas fa-plus"></i> เพิ่มชำระ
                        </a>
                      @endif
                      <button type="submit" class="delete-modal btn btn-success btn-sm">
                        <i class="fas fa-save"></i> Save
                      </button>
                      <a class="delete-modal btn btn-danger btn-sm" href="{{ route('MasterCompro.index') }}?type={{$type}}">
                        <i class="far fa-window-close"></i> Close
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-warning card-tabs text-sm">
                  <div class="card-header p-0 pt-1">
                    <div class="container-fluid">
                      <div class="row mb-1">
                        @if ($data->Flag == "C")
                          <div class="col-sm-6">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link" href="{{ route('MasterCompro.index') }}?type={{$type}}">หน้าหลัก</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" href="{{ route('MasterCompro.edit',[$id]) }}?type={{$type}}">ประนอมหนี้</a>
                              </li>
                            </ul>
                          </div>
                        @else
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
                                <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{13}}">โกงเจ้าหนี้</a>
                              </li>
                            </ul>
                          </div>
                          <div class="col-sm-6">
                            <div class="float-right form-inline">
                              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{8}}">สืบทรัพย์</a>
                                <a class="nav-link active" href="{{ route('MasterCompro.edit',[$id]) }}?type={{2}}">ประนอมหนี้</a>
                                <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{11}}">รูปและแผนที่</a>
                              </ul>
                            </div>
                          </div>
                        @endif
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
                            <select name="StatusCompro" class="form-control form-control-sm">
                              <option value="" selected>--------- status ---------</option>
                              <option value="ปิดบัญชีประนอมหนี้" {{ ($data->Status_Promise === 'ปิดบัญชีประนอมหนี้') ? 'selected' : '' }}>ปิดบัญชีประนอมหนี้</option>
                              <option value="จ่ายจบประนอมหนี้" {{ ($data->Status_Promise === 'จ่ายจบประนอมหนี้') ? 'selected' : '' }}>จ่ายจบประนอมหนี้</option>
                            </select>
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

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
                  function Comma(){
                    var num11 = document.getElementById('TotalPromise').value;
                    var num1 = num11.replace(",","");
                    var num22 = document.getElementById('PayallPromise').value;
                    var num2 = num22.replace(",","");
                    var num66 = document.getElementById('SumPromise').value;
                    var num6 = num66.replace(",","");
                    var num88 = document.getElementById('SumAllPromise').value;
                    var num8 = num88.replace(",","");

                    document.form1.TotalPromise.value = addCommas(num1);
                    document.form1.PayallPromise.value = addCommas(num2);
                    document.form1.SumPromise.value = addCommas(num6);
                    document.form1.SumAllPromise.value = addCommas(num8);
                  }
                  function Discount() {
                      var txtSum = document.getElementById('SumPromise').value;
                      var txtDis = document.getElementById('DiscountPromise').value;
                      var txtComma = txtDis.replace(",","");
                      var txtSumhide = document.getElementById('Sumhide').value;
                      var txtDishide = document.getElementById('Discounthide').value;

                      if (txtDis != txtDishide) {
                        var SetDiscount = parseFloat(txtDis) - parseFloat(txtDishide);
                        var result = parseFloat(txtSumhide) - parseFloat(SetDiscount);
                      }else if (txtDis == 0) {
                        console.log(txtDis);
                        var result = parseFloat(txtSumhide);
                      }

                      if (!isNaN(result)) {
                        document.form1.SumPromise.value = addCommas(result);
                      }
                  }
                  function DuePay() {
                      var SumPayAll = document.getElementById('SumPayAll').value;
                      var txtSumPayAll = SumPayAll.replace(",","");
                      var txtDuepay = document.getElementById('DuePayPromise').value;
                      var txtSetDue = txtDuepay.replace(",","");

                      var Sum = (parseFloat(txtSumPayAll) / parseFloat(txtSetDue));
                      var result = Math.floor(Sum);

                      if (txtSetDue == 0) {
                        var result = 0;
                      }
                        console.log(txtSumPayAll,txtSetDue);

                      if (!isNaN(result)) {
                        document.form1.DuePromise.value = result;
                        document.form1.DuePayPromise.value = numberWithCommas(txtSetDue);
                      }
                  }
                  function numberWithCommas(x) {
                      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                  }
                </script>

              <h5 align="left">รายละเอียดประนอมหนี้</h5>
              <div class="row">
                <div class="col-12">
                  <div class="card card-danger card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> ข้อมูลประนอมหนี้</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-2" data-toggle="pill" href="#tabs-2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ตารางผ่อนชำระ</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body text-sm">
                      <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                          <div class="row">
                            <div class="col-md-8">
                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right">ยอดประนอมหนี้ : </label>
                                    <div class="col-sm-8">
                                      <input type="text" name="TotalPromise" id="TotalPromise" value="{{ number_format($data->Total_Promise,0) }}" class="form-control form-control-sm" oninput="Comma();" required/>
                                    </div>
                                  </div>
                                </div>

                                <script>
                                  function income(){
                                    console.log(document.getElementById("TypePromise").value);
                                    var Getid = document.getElementById("TypePromise").value;
                                    if (Getid == "ประนอมหลังยึดทรัพย์") {
                                      $('#DateShow').show();
                                    }else {
                                      $('#DateShow').hide();
                                    }
                                  }
                                </script>

                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right">ประเภทประนอมหนี้ : </label>
                                    <div class="col-sm-8">
                                      <select id="TypePromise" name="TypePromise" class="form-control form-control-sm" onchange="income();" required>
                                        <option value="" selected>--- เลือกประนอม ---</option>
                                        <option value="ประนอมที่ศาล" {{ ($data->Type_Promise === 'ประนอมที่ศาล') ? 'selected' : '' }}>ประนอมที่ศาล</option>
                                        <option value="ประนอมที่บริษัท" {{ ($data->Type_Promise === 'ประนอมที่บริษัท') ? 'selected' : '' }}>ประนอมที่บริษัท</option>
                                        <option value="ประนอมหลังยึดทรัพย์" {{ ($data->Type_Promise === 'ประนอมหลังยึดทรัพย์') ? 'selected' : '' }}>ประนอมหลังยึดทรัพย์</option>
                                        <option value="ประนอมโกงเจ้าหนี้" {{ ($data->Type_Promise === 'ประนอมโกงเจ้าหนี้') ? 'selected' : '' }}>ประนอมโกงเจ้าหนี้</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group row mb-3">
                                    <label class="col-sm-4 col-form-label text-right">ยอดเงินก้อนแรก : </label>
                                    <div class="col-sm-8">
                                      <input type="text" name="PayallPromise" id="PayallPromise" value="{{ number_format($data->Payall_Promise,2) }}" class="form-control form-control-sm" oninput="Comma();"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group row mb-3">
                                    <label class="col-sm-4 col-form-label text-right">นัดชำระก้อนแรก : </label>
                                    <div class="col-sm-8">
                                      <input type="date" name="DateFirstPromise" value="{{ $data->DateFirst_Promise }}" class="form-control form-control-sm"/>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              @if($data->Type_Promise != "ประนอมหลังยึดทรัพย์")
                                <div id="DateShow" style="display:none">
                              @else
                                <div id="DateShow">
                              @endif
                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">วันงดขายเข้าตลาด : </label>
                                      <div class="col-sm-8">
                                        <input type="date" name="DateNsalePromise" value="{{ $data->DateNsale_Promise }}" class="form-control form-control-sm"/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-6">
                                    <div class="form-group row mb-0">
                                      <label class="col-sm-4 col-form-label text-right">วันครบกำหนด : </label>
                                      <div class="col-sm-8">
                                        <input type="date" name="DatesetPromise" value="{{ $data->Dateset_Promise }}" class="form-control form-control-sm"/>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right">จำนวนงวด : </label>
                                    <div class="col-sm-8">
                                      <input type="text" name="DuePromise" id="DuePromise" value="{{ $data->Due_Promise }}" class="form-control form-control-sm" readonly/>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right">งวดละ : </label>
                                    <div class="col-sm-8">
                                      <input type="text" name="DuePayPromise" id="DuePayPromise" value="{{ number_format(($data->DuePay_Promise != '') ?$data->DuePay_Promise: 0) }}" class="form-control form-control-sm" oninput="DuePay();"/>
                                    </div>
                                  </div>
                                </div>                  
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right">ส่วนลด : </label>
                                    <div class="col-sm-8">
                                      <input type="text" id="DiscountPromise" name="DiscountPromise" value="{{ number_format(($data->Discount_Promise != '') ?$data->Discount_Promise: 0) }}" class="form-control form-control-sm" onkeyup="Discount();" />
                                      <input type="hidden" id="Discounthide" name="Discounthide" value="{{ $data->Discount_Promise }}" class="form-control form-control-sm"/>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right"><font color="red">ยอดคงเหลือ : </font></label>
                                    <div class="col-sm-8">
                                      <input type="text" id="SumPromise" name="SumPromise" value="{{ number_format($SumPay, 0) }}" class="form-control form-control-sm" readonly/>
                                      <input type="hidden" id="Sumhide" name="Sumhide" value="{{ $SumPay }}" class="form-control form-control-sm"/>
                                      <input type="hidden" id="SumPayAll" name="SumPayAll" value="{{ $SumPay }}" class="form-control form-control-sm"/>
                                    </div>
                                  </div>                              
                                </div>
                              </div>

                              <hr>
                              <div class="row">
                                @if($data->Status_Promise == NULL)
                                  @if($data->Date_Payment != Null)
                                    @if($data->Type_Payment != "เงินก้อนแรก(เงินสด)" and $data->Type_Payment != "เงินก้อนแรก(เงินโอน)")
                                      <div class="col-6">
                                        <div class="form-group row mb-0">
                                          <label class="col-sm-4 col-form-label text-right"><font color="red">วันดิวงวดถัดไป : </font></label>
                                          <div class="col-sm-8">
                                            <input type="text" value="{{ DateThai($data->Date_Payment) }}" class="form-control form-control-sm" readonly/>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                                    <input type="hidden" name="DatehidePayment" value="{{ $data->Date_Payment }}"/>
                                  @endif
                                @endif
                                <div class="col-6">
                                  @php
                                    $DateDue = date_create($data->Date_Payment);
                                    $DateNew = date_create(date('Y-m-d'));
                                    $Datediff = date_diff($DateDue,$DateNew);
                                    // dump($DateDue,$DateNew,$Datediff);
                                  @endphp
                                  @if($data->Status_Promise == NULL)
                                    @if($data->Type_Payment != "เงินก้อนแรก(เงินสด)" and $data->Type_Payment != "เงินก้อนแรก(เงินโอน)")
                                      @if($DateDue < $DateNew)
                                        <div class="form-group row mb-0">
                                          <label class="col-sm-4 col-form-label text-right"><font color="red">ขาดชำระดิว/งวด : </font></label>
                                          <div class="col-sm-8">
                                            <input type="text" value="{{ $Datediff->m }}" class="form-control form-control-sm" readonly/>
                                          </div>
                                        </div>
                                      @endif
                                    @endif
                                  @endif
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right"><font color="red">วันที่ชำระล่าสุด : </font></label>
                                    <div class="col-sm-8">
                                      @if($data->Date_Payment != Null)
                                        <input type="text" name="DatePayment" value="{{ DateThai(substr($data->created_at,0,10)) }}" class="form-control form-control-sm" readonly/>
                                      @else
                                        <input type="text" name="DatePayment" class="form-control form-control-sm" readonly/>
                                      @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group row mb-0">
                                    <label class="col-sm-4 col-form-label text-right"><font color="red">ยอดชำระล่าสุด : </font></label>
                                    <div class="col-sm-8">
                                      <input type="text" name="SumAllPromise" id="SumAllPromise" value="{{ number_format($data->Gold_Payment, 2) }}" class="form-control form-control-sm" oninput="Comma();" readonly/>
                                      <input type="hidden" name="GoldPayment" value="{{ $data->Gold_Payment }}"/>
                                    </div>
                                  </div>
                                </div>                  
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-inline" align="right">
                                <label>หมายเหตุ : </label>
                                <textarea name="NotePromise" rows="10" class="form-control form-control-sm" style="width: 100%">{{$data->Note_Promise}}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>

            <input type="hidden" name="SumFirst" value="{{$SumFirst}}"/>
            <input type="hidden" name="SumPayDue" value="{{$SumPayDue}}"/>
            
            <input type="hidden" name="_method" value="PATCH"/>
          </form>
                      <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <div class="table-responsive">
                          <table class="table table-striped" id="table">
                            <thead class="thead-dark bg-gray-light" >
                              <tr>
                                <th class="text-center" style="width:40px">ลำดับ</th>
                                <th class="text-center">วันที่รับชำระ</th>
                                <th class="text-center">ยอดชำระ</th>
                                <th class="text-center">ประเภท</th>
                                <th class="text-center">เลขที่ใบเสร็จ</th>
                                <th class="text-center">วันที่ดิวถัดไป</th>
                                <th class="text-center">พนักงานรับเงิน</th>
                                <th class="text-center" style="width:50px"></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($dataPay as $key => $row)
                                <tr>
                                  <td class="text-center"> {{$key+1}} </td>
                                  <td class="text-center"> {{ DateThai(substr($row->created_at,0,10)) }}</td>
                                  <td class="text-center"> 
                                    {{ number_format($row->Gold_Payment, 2) }} 
                                    @if($row->Gold_Payment < $data->DuePay_Promise)
                                      <span class="badge bg-danger prem">ต่ำกว่าค่างวด</span>
                                    @endif
                                  </td>
                                  <td class="text-center"> {{$row->Type_Payment}} </td>
                                  <td class="text-left"> {{$row->Jobnumber_Payment}} </td>
                                  <td class="text-center"> {{ DateThai($row->Date_Payment) }}</td>
                                  <td class="text-center"> {{$row->Adduser_Payment}} </td>
                                  <td class="text-center">
                                    <a target="_blank" href="{{ route('legislation.report' ,[$row->Payment_id, 2]) }}" class="btn btn-warning btn-sm" title="ปริ้นใบเสร็จ">
                                      <i class="fas fa-print"></i>
                                    </a>
                                    <form method="post" class="delete_form" action="{{ route('MasterCompro.destroy',[$row->Payment_id]) }}?type={{2}}" style="display:inline;">
                                    {{csrf_field()}}
                                      <input type="hidden" name="_method" value="DELETE" />
                                      <button type="submit" data-name="{{ $row->Jobnumber_Payment }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                        <i class="far fa-trash-alt"></i>
                                      </button>
                                    </form>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                          <div class="form-inline" align="center">
                            <label><font color="red">ค่างวดทั้งหมด : </font></label>
                            <input type="text" value="{{ number_format($data->Total_Promise, 2) }}" class="form-control" style="width: 100px;" readonly/>

                            <label><font color="red">ยอดชำระ : </font></label>
                            <input type="text" value="{{ number_format($data->Sum_FirstPromise + $data->Sum_DuePayPromise, 2) }}" class="form-control" style="width: 100px;" readonly/>

                            <label><font color="red">ส่วนลด : </font></label>
                            <input type="text" value="{{ number_format($data->Discount_Promise, 2) }}" class="form-control" style="width: 100px;" readonly/>

                            <label><font color="red">ยอดคงเหลือ : </font></label>
                            <input type="text" value="{{ number_format($SumPay, 2) }}" class="form-control" style="width: 100px;" readonly/>
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
      </section>
    </div>
  </section>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer">
        <!-- <p align="right" class="text-sm text-gray">*** วันที่ดิวถัดไป : {{DateThai($data->Date_Payment)}}</p> -->
        </div>
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-default").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-default .modal-body").load(link, function(){
        });
      });
    });
  </script>
  
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable( {
        "searching" : false,
        "lengthChange" : false,
        "info" : false,
        "pageLength": 5,
      } );
    } );
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(1500);
    $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script>
@endsection
