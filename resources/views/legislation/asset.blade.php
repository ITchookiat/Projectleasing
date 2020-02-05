@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

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

      <!-- <section class="content-header">
      </section> -->

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">ลูกหนี้สืบทรัพย์</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-warning">
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">หน้าหลัก</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 8]) }}">สืบทรัพย์</a></li>
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

                function CourtDate(){
                  //---------- วันสืบพยาน
                  var date1 = document.getElementById('examidaycourt').value;
                  var fannydate = document.getElementById('fuzzycourt').value;
                  var orderdaycourt = document.getElementById('orderdaycourt').value;
                  var ordersenddate = document.getElementById('ordersendcourt').value;

                  if (ordersenddate == '') { // แสดงผลลัพธิ์ วันทีดึงจากระบบ
                    if (date1 != '') {
                      var Setdate = new Date(date1);
                      var newdate = new Date(Setdate);
                      if (fannydate != '') {
                        var Setdate = new Date(fannydate);
                        var newdate = new Date(Setdate);
                      }
                    }else if (fannydate != '') {
                      var Setdate = new Date(fannydate);
                      var newdate = new Date(Setdate);
                    }

                    newdate.setDate(newdate.getDate() + 30);
                    var dd = newdate.getDate();
                    var mm = newdate.getMonth() + 1;
                    var yyyy = newdate.getFullYear();

                    if (dd < 10) {
                      var Newdd = '0' + dd;
                    }else {
                      var Newdd = dd;
                    }
                    if (mm < 10) {
                      var Newmm = '0' + mm;
                    }else {
                      var Newmm = mm;
                    }
                    var result = yyyy + '-' + Newmm + '-' + Newdd;
                    document.getElementById('orderdaycourt').value = result;
                  }
                  //---------- end ---------//

                  //---------- วันส่งคำบังคับ
                  var date2 = document.getElementById('orderdaycourt').value;
                  var ordersenddate = document.getElementById('ordersendcourt').value;
                    if (date2 != '') {
                      var Setdate = new Date(date2);
                      var newdate = new Date(Setdate);
                      if (ordersenddate != '') {
                        var Setdate = new Date(ordersenddate);
                        var newdate = new Date(Setdate);
                      }
                    }else if (ordersenddate != '') {
                      var Setdate = new Date(ordersenddate);
                      var newdate = new Date(Setdate);
                    }

                    newdate.setDate(newdate.getDate() + 45);
                    var dd = newdate.getDate();
                    var mm = newdate.getMonth() + 1;
                    var yyyy = newdate.getFullYear();

                    if (dd < 10) {
                      var Newdd = '0' + dd;
                    }else {
                      var Newdd = dd;
                    }
                    if (mm < 10) {
                      var Newmm = '0' + mm;
                    }else {
                      var Newmm = mm;
                    }
                    var result = yyyy + '-' + Newmm + '-' + Newdd;
                    document.getElementById('checkdaycourt').value = result;
                  //---------- end ---------//
                }
                // ฟังชันคำนวณ วันที่จาก การเลือก checkbox
                function CourtDate2(){
                  var date = document.getElementById('checkdaycourt').value;
                  var checksenddate = document.getElementById('checksendcourt').value;

                  var checkFlag = document.getElementById("1").checked;
                  var messageFlag = document.getElementById("4").checked;
                  // console.log(checkFlag);
                  // console.log(messageFlag);

                  if (messageFlag == false) {
                    if (checkFlag == false) {
                      var Setdate = new Date(checksenddate);
                      var newdate = new Date(Setdate);

                      newdate.setDate(newdate.getDate() + 15);
                      var dd = newdate.getDate();
                      var mm = newdate.getMonth() + 1;
                      var yyyy = newdate.getFullYear();

                      if (dd < 10) {
                        var Newdd = '0' + dd;
                      }else {
                        var Newdd = dd;
                      }
                      if (mm < 10) {
                        var Newmm = '0' + mm;
                      }else {
                        var Newmm = mm;
                      }
                      var result = yyyy + '-' + Newmm + '-' + Newdd;
                      document.getElementById('orderdaycourt').value = result;
                    }
                    else {
                      var Setdate = new Date(checksenddate);
                      var newdate = new Date(Setdate);

                      newdate.setDate(newdate.getDate() + 45);
                      var dd = newdate.getDate();
                      var mm = newdate.getMonth() + 1;
                      var yyyy = newdate.getFullYear();

                      if (dd < 10) {
                        var Newdd = '0' + dd;
                      }else {
                        var Newdd = dd;
                      }
                      if (mm < 10) {
                        var Newmm = '0' + mm;
                      }else {
                        var Newmm = mm;
                      }
                      var resultcheck = yyyy + '-' + Newmm + '-' + Newdd;
                      document.getElementById('setofficecourt').value = resultcheck;

                      var sendoffice = document.getElementById('sendofficecourt').value;
                      var Setdate = new Date(resultcheck);
                      var newdate = new Date(Setdate);

                      if (Setdate != '') {
                        var Setdate = new Date(resultcheck);
                        var newdate = new Date(Setdate);
                        if (sendoffice != '') {
                          var Setdate = new Date(sendoffice);
                          var newdate = new Date(Setdate);
                        }
                      }else if (sendoffice != '') {
                        var Setdate = new Date(sendoffice);
                        var newdate = new Date(Setdate);
                      }

                      newdate.setDate(newdate.getDate() + 45);
                      var dd = newdate.getDate();
                      var mm = newdate.getMonth() + 1;
                      var yyyy = newdate.getFullYear();

                      if (dd < 10) {
                        var Newdd = '0' + dd;
                      }else {
                        var Newdd = dd;
                      }
                      if (mm < 10) {
                        var Newmm = '0' + mm;
                      }else {
                        var Newmm = mm;
                      }
                      var result = yyyy + '-' + Newmm + '-' + Newdd;
                      document.getElementById('checkresultscourt').value = result;
                    }
                  }
                }
                // ฟังชันคำนวณ วันที่จาก ผู้เช่าซื้อกับผู้ค้ำ
                function CheckMessege(){
                  var buyer = document.getElementById('buyercourt').value;
                  var Setbuyer = buyer.substring(8);
                  var support = document.getElementById('supportcourt').value;
                  var Setsupport = support.substring(8);

                  if (Setbuyer != '' && Setsupport != '') {
                    if (Setbuyer == Setsupport) {
                        var Setdate = new Date(buyer);
                        var newdate = new Date(Setdate);

                        newdate.setDate(newdate.getDate() + 45);
                        var dd = newdate.getDate();
                        var mm = newdate.getMonth() + 1;
                        var yyyy = newdate.getFullYear();

                        if (dd < 10) {
                          var Newdd = '0' + dd;
                        }else {
                          var Newdd = dd;
                        }
                        if (mm < 10) {
                          var Newmm = '0' + mm;
                        }else {
                          var Newmm = mm;
                        }
                        var result = yyyy + '-' + Newmm + '-' + Newdd;
                        document.getElementById('setofficecourt').value = result;
                    }
                    else if (Setbuyer > Setsupport) {
                      var Setdate = new Date(buyer);
                      var newdate = new Date(Setdate);

                      newdate.setDate(newdate.getDate() + 45);
                      var dd = newdate.getDate();
                      var mm = newdate.getMonth() + 1;
                      var yyyy = newdate.getFullYear();

                      if (dd < 10) {
                        var Newdd = '0' + dd;
                      }else {
                        var Newdd = dd;
                      }
                      if (mm < 10) {
                        var Newmm = '0' + mm;
                      }else {
                        var Newmm = mm;
                      }
                      var result = yyyy + '-' + Newmm + '-' + Newdd;
                      document.getElementById('setofficecourt').value = result;

                    }
                    else if (Setbuyer < Setsupport) {
                      var Setdate = new Date(support);
                      var newdate = new Date(Setdate);

                      newdate.setDate(newdate.getDate() + 45);
                      var dd = newdate.getDate();
                      var mm = newdate.getMonth() + 1;
                      var yyyy = newdate.getFullYear();

                      if (dd < 10) {
                        var Newdd = '0' + dd;
                      }else {
                        var Newdd = dd;
                      }
                      if (mm < 10) {
                        var Newmm = '0' + mm;
                      }else {
                        var Newmm = mm;
                      }
                      var result = yyyy + '-' + Newmm + '-' + Newdd;
                      document.getElementById('setofficecourt').value = result;
                    }

                    var sendoffice = document.getElementById('sendofficecourt').value;
                    var checkresults = new Date(result);
                    var newdate = new Date(checkresults);

                    if (checkresults != '') {
                      var Setdate = new Date(checkresults);
                      var newdate = new Date(Setdate);
                      if (sendoffice != '') {
                        var Setdate = new Date(sendoffice);
                        var newdate = new Date(Setdate);
                      }
                    }else if (sendoffice != '') {
                      var Setdate = new Date(sendoffice);
                      var newdate = new Date(Setdate);
                    }

                    newdate.setDate(newdate.getDate() + 45);
                    var dd = newdate.getDate();
                    var mm = newdate.getMonth() + 1;
                    var yyyy = newdate.getFullYear();

                    if (dd < 10) {
                      var Newdd = '0' + dd;
                    }else {
                      var Newdd = dd;
                    }
                    if (mm < 10) {
                      var Newmm = '0' + mm;
                    }else {
                      var Newmm = mm;
                    }
                    var resultcheck = yyyy + '-' + Newmm + '-' + Newdd;
                    document.getElementById('checkresultscourt').value = resultcheck;
                  }
                }
                // ฟังชันคำนวณ วันที่ได้รับและไมไ่ด้รับ
                // function Datesuccess(){
                //   var sendcheckresult = document.getElementById('sendcheckresultscourt').value;
                //   var dayresults = document.getElementById('dayresultscourt').value;
                //
                //   var Setdate = new Date(sendcheckresult);
                //   var newdate = new Date(Setdate);
                //
                //   newdate.setDate(newdate.getDate() + 45);
                //   var dd = newdate.getDate();
                //   var mm = newdate.getMonth() + 1;
                //   var yyyy = newdate.getFullYear();
                //
                //   if (dd < 10) {
                //     var Newdd = '0' + dd;
                //   }else {
                //     var Newdd = dd;
                //   }
                //   if (mm < 10) {
                //     var Newmm = '0' + mm;
                //   }else {
                //     var Newmm = mm;
                //   }
                //   var resultcheck = yyyy + '-' + Newmm + '-' + Newdd;
                //   document.getElementById('sequestercourt').value = resultcheck;
                //
                //   console.log(dayresults);
                //   if (dayresults != '') {
                //     var Setdate = new Date(dayresults);
                //     var newdate = new Date(Setdate);
                //
                //     newdate.setDate(newdate.getDate() + 45);
                //     var dd = newdate.getDate();
                //     var mm = newdate.getMonth() + 1;
                //     var yyyy = newdate.getFullYear();
                //
                //     if (dd < 10) {
                //       var Newdd = '0' + dd;
                //     }else {
                //       var Newdd = dd;
                //     }
                //     if (mm < 10) {
                //       var Newmm = '0' + mm;
                //     }else {
                //       var Newmm = mm;
                //     }
                //     var result = yyyy + '-' + Newmm + '-' + Newdd;
                //     document.getElementById('sequestercourt').value = result;
                //   }
                //
                // }

                // ฟังชันคำนวณ ค่าทนาย
                function CalculateCap(){
                    var cap = document.getElementById('capitalcourt').value;
                    var Setcap = cap.replace(",","");
                    var ind = document.getElementById('indictmentcourt').value;
                    var Setind = ind.replace(",","");

                    var Sumcap = (Setcap * 0.1);

                    if(!isNaN(Setcap)){
                        document.form1.capitalcourt.value = addCommas(Setcap);
                        document.form1.pricelawyercourt.value = addCommas(Sumcap.toFixed(2));
                   }
                    if(!isNaN(Setind)){
                        document.form1.indictmentcourt.value = addCommas(Setind);
                   }
                }

              </script>

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
                                  <div class=""  align="center">
                                    <small class="label label-success" style="font-size: 25px;">
                                      <i class="fa fa-expeditedssl"></i>
                                      @if($data->Status_legis == "ปิดบัญชีก่อนฟ้อง")
                                        ปิดบัญชีก่อนฟ้อง
                                      @elseif($data->Status_legis == "ชำระยอดค้างก่อนฟ้อง")
                                        ชำระยอดค้างก่อนฟ้อง
                                      @elseif($data->Status_legis == "ยึดรถก่อนฟ้อง")
                                        ยึดรถก่อนฟ้อง
                                      @elseif($data->Status_legis == "ปิดบัญชีหลังฟ้อง")
                                        ปิดบัญชีหลังฟ้อง
                                      @elseif($data->Status_legis == "ยึดรถหลังฟ้อง")
                                        ยึดรถหลังฟ้อง
                                      @elseif($data->Status_legis == "หมดอายุความ")
                                        หมดอายุความ
                                      @endif
                                    </small>
                                  </div>
                                  <p></p>
                                  <label>สถานะ : </label>
                                  <select name="Statuslegis" class="form-control" style="width: 110px;">
                                    <option value="" selected>--- status ---</option>
                                    <option value="ปิดบัญชีก่อนฟ้อง" {{ ($data->Status_legis === 'ปิดบัญชีก่อนฟ้อง') ? 'selected' : '' }}>ปิดบัญชีก่อนฟ้อง</option>
                                    <option value="ชำระยอดค้างก่อนฟ้อง" {{ ($data->Status_legis === 'ชำระยอดค้างก่อนฟ้อง') ? 'selected' : '' }}>ชำระยอดค้างก่อนฟ้อง</option>
                                    <option value="ยึดรถก่อนฟ้อง" {{ ($data->Status_legis === 'ยึดรถก่อนฟ้อง') ? 'selected' : '' }}>ยึดรถก่อนฟ้อง</option>
                                    <option value="ปิดบัญชีหลังฟ้อง" {{ ($data->Status_legis === 'ปิดบัญชีหลังฟ้อง') ? 'selected' : '' }}>ปิดบัญชีหลังฟ้อง</option>
                                    <option value="ยึดรถหลังฟ้อง" {{ ($data->Status_legis === 'ยึดรถหลังฟ้อง') ? 'selected' : '' }}>ยึดรถหลังฟ้อง</option>
                                    <option value="ปิดบัญชีประนอมหลังฟ้อง" {{ ($data->Status_legis === 'ปิดบัญชีประนอมหลังฟ้อง') ? 'selected' : '' }}>ปิดบัญชีประนอมหลังฟ้อง</option>
                                    <option value="จ่ายตามจำนวนหลังฟ้อง" {{ ($data->Status_legis === 'จ่ายตามจำนวนหลังฟ้อง') ? 'selected' : '' }}>จ่ายตามจำนวนหลังฟ้อง</option>
                                    <option value="ปิดบัญชีประนอมหลังยึดทรัพย์" {{ ($data->Status_legis === 'ปิดบัญชีประนอมหลังยึดทรัพย์') ? 'selected' : '' }}>ปิดบัญชีประนอมหลังยึดทรัพย์</option>
                                    <option value="จ่ายตามจำนวนหลังยึดทรัพย์" {{ ($data->Status_legis === 'จ่ายตามจำนวนหลังยึดทรัพย์') ? 'selected' : '' }}>จ่ายตามจำนวนหลังยึดทรัพย์</option>
                                    <option value="ปิดบัญชีหลังยึดทรัพย์" {{ ($data->Status_legis === 'ปิดบัญชีหลังยึดทรัพย์') ? 'selected' : '' }}>ปิดบัญชีหลังยึดทรัพย์</option>
                                    <option value="ยึดรถหลังยึดทรัพย์" {{ ($data->Status_legis === 'ยึดรถหลังยึดทรัพย์') ? 'selected' : '' }}>ยึดรถหลังยึดทรัพย์</option>
                                  </select>
                                  <input type="text" id="txtStatuslegis" name="txtStatuslegis" class="form-control" style="width: 100px;" oninput="AddComma();">
                                  <input type="date" name="DateStatuslegis" class="form-control" style="width: 152px;" value="{{ $data->DateStatus_legis }}">
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <br>
                          <div class="form-inline" align="right">
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

                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนสืบทรัพย์</b></h4>
                      <div class="box box-primary box-solid">
                        <div class="nav-tabs-custom" style="background-color : #1E90FF;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab">สถานะทรัพย์</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-3" align="center">
                                    <input type="radio" id="test1" name="radio_propertied" value="Y" {{ ($data->propertied_asset === 'Y') ? 'checked' : '' }} />
                                    <label for="test1">มีทรัพย์</label>
                                  </div>
                                  <div class="col-md-3" align="center">
                                    <input type="radio" id="test2" name="radio_propertied" value="N" {{ ($data->propertied_asset === 'N') ? 'checked' : '' }}/>
                                    <label for="test2">ไม่มีทรัพย์</label>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline">
                                    <label>สถานะสืบ : </label>
                                      <select id="statusasset" name="statusasset" class="form-control" style="width: 85%">
                                        <option value="" selected>--- สถานะสืบ ---</option>
                                        <option value="สืบทรัพย์ชั้นศาล" {{ ($data->Status_asset === 'สืบทรัพย์ชั้นศาล') ? 'selected' : '' }}>สืบทรัพย์ชั้นศาล</option>
                                        <option value="สืบทรัพย์ชั้นบังคับคดี" {{ ($data->Status_asset === 'สืบทรัพย์ชั้นบังคับคดี') ? 'selected' : '' }}>สืบทรัพย์ชั้นบังคับคดี</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    วันสืบทรัพย์
                                    <input type="date" id="sequesterasset" name="sequesterasset" class="form-control" value="{{ $data->sequester_asset }}"/>
                                    ผลสืบ :
                                    <select id="sendsequesterasset" name="sendsequesterasset" class="form-control">
                                      <option value="" selected>--- เลือกผล ---</option>
                                      <option value="เจอ" {{ ($data->sendsequester_asset === 'เจอ') ? 'selected' : '' }}>เจอ</option>
                                      <option value="ไม่เจอ" {{ ($data->sendsequester_asset === 'ไม่เจอ') ? 'selected' : '' }}>ไม่เจอ</option>
                                      <option value="หมดอายุความ" {{ ($data->sendsequester_asset === 'หมดอายุความ') ? 'selected' : '' }}>หมดอายุความ</option>
                                    </select>
                                    วันที่สืบทรัพย์ใหม่
                                    <input type="date" id="NewpursueDateasset" name="NewpursueDateasset" class="form-control" value="{{ $data->NewpursueDate_asset }}"/>
                                  </div>
                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="Notepursueasset" class="form-control" rows="10">{{ $data->Notepursue_asset }}</textarea>
                                  </div>
                                </div>


                                <!-- @if($data->propertied_asset == "Y" or $data->propertied_asset == Null)
                                  <div id="ShowMe" style="display:none;">
                                @else
                                 <div id="ShowMe">
                                @endif
                                    <div class="row">
                                      <div class="col-md-6">
                                        วันสืบทรัพย์
                                        <input type="date" id="sequesterasset" name="sequesterasset" class="form-control" value="{{ $data->sequester_asset }}"/>
                                        ผลสืบ :
                                        <select id="sendsequesterasset" name="sendsequesterasset" class="form-control">
                                          <option value="" selected>--- เลือกผล ---</option>
                                          <option value="เจอ" {{ ($data->sendsequester_asset === 'เจอ') ? 'selected' : '' }}>เจอ</option>
                                          <option value="ไม่เจอ" {{ ($data->sendsequester_asset === 'ไม่เจอ') ? 'selected' : '' }}>ไม่เจอ</option>
                                        </select>
                                        วันที่สืบทรัพย์ใหม่
                                        <input type="date" id="" name="NewpursueDateasset" class="form-control" value="{{ $data->NewpursueDate_asset }}"/>
                                      </div>
                                      <div class="col-md-6">
                                        หมายเหตุ
                                        <textarea name="Notepursueasset" class="form-control" rows="10">{{ $data->Notepursue_asset }}</textarea>
                                      </div>
                                    </div>
                                  </div> -->

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


      <!-- เวลาแจ้งเตือน -->
      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

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

    </section>
@endsection
