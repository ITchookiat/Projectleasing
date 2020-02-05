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
  </style>

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
            <h4 class="card-title p-3" align="center">ข้อมูลงานฟ้อง</h4>
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
              <li class="nav-item"><a href="#tab_4">ของกลาง</a></li>
              <li class="nav-item"><a href="#tab_5">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
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
                          <span class="info-box-icon  bg-red"><i class="fa fa-user"></i></span>
                          <div class="info-box-content">
                              <div class="col-md-4">
                                <span class="info-box-number"><font style="font-size: 30px;">{{ $data->Contract_legis }}</font></span>
                                <span class="info-box-text"><font style="font-size: 20px;">{{ $data->Name_legis }}</font></span>
                              </div>
                              <div class="col-md-8">
                                <br>
                                <div class="form-inline" align="center">
                                  <label>
                                    <input type="checkbox" name="CAccountlegis" value="BC"/>
                                    <span><font color="red">ปิดบัญชี</font></span>
                                    <input type="text" name="txtCAccountlegis" class="form-control" style="width: 100px;">
                                  </label>
                                  <label>
                                    <input type="checkbox" name="OverDuelegis" value="BM"/>
                                    <span><font color="red">ชำระยอดค้าง</font></span>
                                    <input type="text" name="txtOverDuelegis" class="form-control" style="width: 100px;">
                                  </label>
                                  <label>
                                    <input type="checkbox" name="Holderlegis" value="BF"/>
                                    <span><font color="red">ยึดรถ</font></span>
                                  </label>
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

                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนชั้นบังคับคดี</b></h4>

                      <div class="box box-warning box-solid">
                        <div class="nav-tabs-custom" style="background-color : #f39c12;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab">เตรียมเอกสาร(30 วัน)</a></li>
                            <li class="nav-item"><a href="#tab_2" data-toggle="tab">ตั้งเรื่องยึดทรัพย์(180 วัน)</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    วันทีเตรียมเอกสาร
                                    <input type="date" id="datepreparedoc" name="datepreparedoc" class="form-control" value="" />
                                  </div>
                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="noteprepare" class="form-control" rows="2"></textarea>
                                  </div>
                                </div>

                              </div>
                            </div>

                            <div class="tab-pane" id="tab_2">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    วันที่ตั้งเรื่องยึดทรัพย์แรกเริ่ม
                                    <input type="date" id="DatesetSequester" name="DatesetSequester" class="form-control" value="{{ ($data->examiday_court) }}" />
                                  </div>
                                  <div class="col-md-6">
                                    <div class="row">
                                      <br>
                                      <div class="col-md-6" align="center">
                                        <input type="radio" id="test3" name="radio-receivedflag" value="Y" onclick="Functionhidden2()"/>
                                        <label for="test3">ขายได้</label>
                                      </div>
                                      <div class="col-md-6">
                                        <input type="radio" id="test4" name="radio-receivedflag" value="N" onclick="FunctionRadio2()"/>
                                        <label for="test4">ขายไม่ได้</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <script>
                                    $('#ResultSequester').change(function(){
                                      var value = document.getElementById('ResultSequester').value;
                                        if(value == 'ขายไม่ได้'){
                                          $('#ShowDetail1').show();
                                          $('#ShowDetail2').hide();
                                        }
                                        else if(value == 'ขายได้'){
                                          $('#ShowDetail2').show();
                                          $('#ShowDetail1').hide();
                                          $('#ShowSellDetail').hide();
                                        }
                                        else{
                                          $('#ShowDetail1').hide();
                                          $('#ShowDetail2').hide();
                                          $('#ShowSellDetail').hide();
                                        }
                                    });
                                </script>

                                <div class="row">
                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="noteprepare" class="form-control" rows="3"></textarea>
                                  </div>

                                    <div class="col-md-6">
                                      <div class="row">
                                        <br>
                                        <div class="col-md-6" align="center">
                                          <input type="radio" id="test3" name="radio-receivedflag" value="Y" onclick="Functionhidden2()"/>
                                          <label for="test3">เต็มจำนวน</label>
                                        </div>
                                        <div class="col-md-6">
                                          <input type="radio" id="test4" name="radio-receivedflag" value="N" onclick="FunctionRadio2()"/>
                                          <label for="test4">ไม่เต็มจำนวน</label>
                                        </div>
                                      </div>

                                        <div class="form-inline" align="right">
                                            <label>จำนวนเงิน : </label>
                                            <input type="text" name="Accountbrancecar" class="form-control" placeholder="เลขที่บัญชีผู้รับเงิน" maxlength="15" />
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>

                                    </div>
                                  </div>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนสืบทรัพย์ชั้นบังคับคดี</b></h4>
                      <div class="box box-primary box-solid">
                        <div class="nav-tabs-custom" style="background-color : #1E90FF;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab">สถานะทรัพย์</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  @if($data->propertied_court == "Y")
                                    <div class="col-md-6" align="center">
                                      <input type="radio" id="test1" name="radio-propertied" value="Y" onclick="Functionhidden()" checked/>
                                      <label for="test1">มีทรัพย์</label>
                                    </div>
                                    <div class="col-md-6">
                                      <input type="radio" id="test2" name="radio-propertied" value="N" onclick="FunctionRadio()"/>
                                      <label for="test2">ไม่มีทรัพย์</label>
                                    </div>
                                  @elseif($data->propertied_court == "N")
                                    <div class="col-md-6" align="center">
                                      <input type="radio" id="test1" name="radio-propertied" value="Y" onclick="Functionhidden()"/>
                                      <label for="test1">มีทรัพย์</label>
                                    </div>
                                    <div class="col-md-6">
                                      <input type="radio" id="test2" name="radio-propertied" value="N" onclick="FunctionRadio()" checked/>
                                      <label for="test2">ไม่มีทรัพย์</label>
                                    </div>
                                  @else
                                    <div class="col-md-6" align="center">
                                      <input type="radio" id="test1" name="radio-propertied" value="Y" onclick="Functionhidden()"/>
                                      <label for="test1">มีทรัพย์</label>
                                    </div>
                                    <div class="col-md-6">
                                      <input type="radio" id="test2" name="radio-propertied" value="N" onclick="FunctionRadio()"/>
                                      <label for="test2">ไม่มีทรัพย์</label>
                                    </div>
                                  @endif
                                </div>

                                @if($data->propertied_court == "Y" or $data->propertied_court == Null)
                                  <div id="ShowMe" style="display:none;">
                                @else
                                 <div id="ShowMe">
                                @endif
                                    <div class="row">
                                      <div class="col-md-6">

                                        วันสืบทรัพย์
                                        <input type="date" id="sequestercourt" name="sequestercourt" class="form-control" value="{{ $data->sequester_court }}"/>
                                        @if($data->sendsequester_court == Null)
                                          ผลสืบ :
                                          <select name="sendsequestercourt" class="form-control">
                                            <option value="" selected>--- เลือกผล ---</option>
                                            <option value="เจอ">เจอ</option>
                                            <option value="ไม่เจอ">ไม่เจอ</option>
                                          </select>
                                         @else
                                          <select id="sendsequestercourt" name="sendsequestercourt" class="form-control">
                                            <option value="" disabled selected>--- เลือกผล ---</option>
                                            @foreach ($Sendsequester as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->sendsequester_court) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                         @endif

                                        วันที่สืบทรัพย์ใหม่
                                        <input type="date" id="" name="NewpursueDatecourt" class="form-control" value="{{ $data->NewpursueDate_court }}"/>
                                        </div>
                                      <div class="col-md-6">
                                        หมายเหตุ
                                        <textarea name="Notepursuecourt" class="form-control" rows="10">{{ $data->Notepursue_court }}</textarea>
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
