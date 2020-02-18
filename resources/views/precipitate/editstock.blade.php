@extends('layouts.master')
@section('title','ร้อมูลรถยนต์มือ 2')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 542;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.$m.'-'.$d;
@endphp

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        เร่งรัดหนี้สิน
        <small>ระบบสต็อกรถเร่งรัด</small>
      </h1>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>แก้ไขข้อมูลรถยึด</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          {{-- เช็คการกรอกข้อมูล --}}
          @if (count($errors) > 0)
            <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>กรุณากรอกข้อมูลอีกครั้ง ({{$error}}) </li>
                @endforeach
            </ul>
            </div>
          @endif

        <div class="row">
          <div class="col-md-12"> <br />
            <form name="form1" action="{{ action('PrecController@update',[$id,$type]) }}" method="post" id="formimage" enctype="multipart/form-data">
            @csrf

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

                  function comma(){
                  var num11 = document.getElementById('Pricehold').value;
                  var num1 = num11.replace(",","");
                  document.form1.Pricehold.value = addCommas(num1);

                  var num22 = document.getElementById('Amounthold').value;
                  var num2 = num22.replace(",","");
                  document.form1.Amounthold.value = addCommas(num2);

                  var num33 = document.getElementById('Payhold').value;
                  var num3 = num33.replace(",","");
                  document.form1.Payhold.value = addCommas(num3);

                  var num44 = document.getElementById('CapitalAccount').value;
                  var num4 = num44.replace(",","");
                  document.form1.CapitalAccount.value = addCommas(num4);

                  var num55 = document.getElementById('CapitalTopprice').value;
                  var num5 = num55.replace(",","");
                  document.form1.CapitalTopprice.value = addCommas(num5);

                  }
              </script>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-inline" align="right">
                  <label>เลขที่สัญญา : </label>
                  <input type="text" name="Contno" class="form-control" style="width: 250px;" value="{{ $data->Contno_hold }}" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline" align="right">
                  <label>ชื่อ - สกุล : </label>
                  <input type="text" name="NameCustomer" class="form-control" style="width: 250px;" value="{{ $data->Name_hold }}" >
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-inline" align="right">
                  <label>ยี่ห้อ : </label>
                  <select name="Brandcar" class="form-control" style="width: 250px;">
                    <option value="" disabled selected>--- ยี่ห้อ ---</option>
                    @foreach ($Brandcarr as $key => $value)
                      <option value="{{$key}}" {{ ($key == $data->Brandcar_hold) ? 'selected' : '' }}>{{$value}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline" align="right">
                  <label>ทะเบียน : </label>
                  <input type="text" name="Number_Regist" class="form-control" style="width: 250px;" value="{{ $data->Number_Regist }}" >
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-inline" align="right">
                  <label>ปี : </label>
                  <select name="Yearcar" class="form-control" style="width: 250px;">
                    <option value="{{ $data->Year_Product }}" selected>{{ $data->Year_Product }}</option>
                    <option value="" disabled>--------------------</option>
                     @php
                         $Year = date('Y');
                     @endphp
                     @for ($i = 0; $i < 30; $i++)
                         <option value="{{ $Year }}">{{ $Year }}</option>
                         @php
                             $Year -= 1;
                         @endphp
                     @endfor
                  </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline" align="right">
                  <label>วันที่ยึด : </label>
                  <input type="date" name="Datehold" class="form-control" style="width: 250px;" value="{{ $data->Date_hold }}">
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-inline" align="right">
                  <label>ทีมยึด : </label>
                  <select name="Teamhold" class="form-control" style="width: 250px">
                    <option selected disabled value="">---เลือกทีมยึด---</option>
                    @foreach ($Teamhold as $key => $value)
                      <option value="{{$key}}" {{ ($key == $data->Team_hold) ? 'selected' : '' }}>{{$value}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline" align="right">
                  <label>ค่ายึด : </label>
                  @if($data->Price_hold == Null)
                  <input type="text" id="Pricehold" name="Pricehold" class="form-control" style="width: 250px;" placeholder="ป้อนค่ายึด" oninput="comma();">
                  @else
                  <input type="text" id="Pricehold" name="Pricehold" class="form-control" style="width: 250px;" value="{{ number_format($data->Price_hold) }}" oninput="comma();">
                  @endif
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-5">
                  <div class="form-inline" align="right">
                  <label>สถานะรถ : </label>
                  <select name="Statuscar" class="form-control" style="width: 250px">
                    <option selected disabled value="">---เลือกสถานะ---</option>
                    @foreach ($Statuscar as $key => $value)
                      <option value="{{$key}}" {{ ($key == $data->Statuscar) ? 'selected' : '' }}>{{$value}}</option>
                    @endforeach
                  </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline" align="right">
                  <label>รายละเอียด : </label>
                  <textarea name="Note" class="form-control" placeholder="ป้อนรายละเอียด" rows="2" style="width: 250px;">{{ $data->Note_hold }}</textarea>
                  </div>
                </div>

              </div>

                <hr>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>วันที่มารับรถคืน : </label>
                    <input type="date" name="Datecame" class="form-control" style="width: 250px;" value="{{ $data->Date_came }}" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>ค่างวดยึดค้าง : </label>
                    @if($data->Amount_hold == Null)
                    <input type="text" id="Amounthold" name="Amounthold" class="form-control" style="width: 250px;" placeholder="ป้อนค่างวดยึดค้าง" oninput="comma();">
                    @else
                    <input type="text" id="Amounthold" name="Amounthold" class="form-control" style="width: 250px;" placeholder="ป้อนค่างวดยึดค้าง" oninput="comma();" value="{{ number_format($data->Amount_hold) }}" >
                    @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>ชำระค่างวดยึด : </label>
                    @if($data->Pay_hold == Null)
                    <input type="text" id="Payhold" name="Payhold" class="form-control" style="width: 250px;" placeholder="ป้อนชำระค่างวดยึด" oninput="comma();">
                    @else
                    <input type="text" id="Payhold" name="Payhold" class="form-control" style="width: 250px;" placeholder="ป้อนชำระค่างวดยึด" oninput="comma();" value="{{ number_format($data->Pay_hold) }}">
                    @endif
                    </div>
                  </div>

                </div>

                <hr>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>วันที่เช็คต้นทุน : </label>
                    <input type="date" name="DatecheckCapital" class="form-control" style="width: 250px;" value="{{ $data->Datecheck_Capital }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>วันที่ส่งรถบ้าน : </label>
                    <input type="date" name="DatesendStockhome" class="form-control" style="width: 250px;" value="{{ $data->Datesend_Stockhome }}">
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>วันที่ส่งจดหมาย : </label>
                    <input type="date" name="DatesendLetter" class="form-control" style="width: 250px;" value="{{ $data->Datesend_Letter }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>เลขบาร์โค๊ด : </label>
                    <input type="text" name="BarcodeNo" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบาร์โค๊ด" value="{{ $data->Barcode_No }}">
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>ต้นทุนบัญชี : </label>
                    @if($data->Capital_Account == Null)
                    <input type="text" id="CapitalAccount" name="CapitalAccount" class="form-control" style="width: 250px;" placeholder="ป้อนต้นทุนบัญชี" oninput="comma();">
                    @else
                    <input type="text" id="CapitalAccount" name="CapitalAccount" class="form-control" style="width: 250px;" oninput="comma();" value="{{ number_format($data->Capital_Account,2) }}">
                    @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>ต้นทุนยอดจัด : </label>
                    @if($data->Capital_Topprice == Null)
                    <input type="text" id="CapitalTopprice" name="CapitalTopprice" class="form-control" style="width: 250px;" placeholder="ป้อนต้นทุนยอดจัด" oninput="comma();">
                    @else
                    <input type="text" id="CapitalTopprice" name="CapitalTopprice" class="form-control" style="width: 250px;" oninput="comma();" value="{{ number_format($data->Capital_Topprice,2) }}">
                    @endif
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>หมายเหตุ : </label>
                    <textarea name="Note2" class="form-control" placeholder="ป้อนหมายเหตุ" rows="2" style="width: 250px;">{{ $data->Note2_hold }}</textarea>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>จดหมาย : </label>
                    <input type="text" name="Letter" class="form-control" style="width: 250px;" placeholder="ป้อนจดหมาย" value="{{ $data->Letter_hold }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                      <label>วันส่ง : </label>
                      <input type="date" name="Datesend" class="form-control" style="width: 250px;" value="{{ $data->Date_send }}">
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>บาร์โค๊ดผู้ค้ำ : </label>
                    <input type="text" name="Barcode2" class="form-control" style="width: 250px;" placeholder="ป้อนบาร์โค๊ด" value="{{ $data->Barcode2 }}">
                    </div>
                  </div>
                  @if($data->Accept_hold == 'ได้รับ')
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>วันที่จะขายได้ : </label>
                    <input type="date" name="sell" class="form-control" style="width: 250px;" value="{{ $data->Date_accept_hold }}" readonly>
                    </div>
                  </div>
                  @endif

                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                    <label>รับ : </label>
                    <select name="Accept" class="form-control" style="width: 250px">
                      <option selected disabled value="">---เลือกสถานะ---</option>
                      @foreach ($Accept as $key => $value)
                        <option value="{{$key}}" {{ ($key == $data->Accept_hold) ? 'selected' : '' }}>{{$value}}</option>
                      @endforeach
                    </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                    <label>ขายได้ : </label>
                    <input type="text" name="Soldout" class="form-control" style="width: 250px;" placeholder="ป้อนข้อมูล" value="{{ $data->Soldout_hold }}">
                    </div>
                  </div>

                </div>

                <hr>

                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="type" value="6" />

                <div class="form-group">
                <input type="hidden" readonly name="Cartype" value="{{ $type }}" class="form-control" />
                </div>
                <div class="form-group" align="center">
                <button type="submit" class="delete-modal btn btn-success">
                <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                </button>
                <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 5) }}">
                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                </a>
              </div>
              <input type="hidden" name="_method" value="PATCH"/>
            </form>

          </div>
        </div>



        </div>

        <div class="box-footer">

        </div>
      </div>

      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

    </section>

@endsection
