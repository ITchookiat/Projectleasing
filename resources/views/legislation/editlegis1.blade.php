@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

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

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <style>
   readonly{
     background-color: #FFFFFF;
   }
  </style>

  <style>
    body {
      font-family: Arial;
      margin: 0;
    }
    * {
      box-sizing: border-box;
    }
    img {
      vertical-align: middle;
    }
    .container {
      position: relative;
    }
    .mySlides {
      display: none;
    }
    .cursor {
      cursor: pointer;
    }
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 40%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    .caption-container {
      text-align: center;
      background-color: #222;
      padding: 2px 16px;
      color: white;
    }
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    .column {
      float: left;
      width: 16.66%;
    }
    .demo {
      opacity: 0.6;
    }
    .active,
    .demo:hover {
      opacity: 1;
    }
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


      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">แก้ไขข้อมูงานฟ้อง</h4>
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
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a></li>
              <li class="nav-item"><a href="#tab_3">ชั้นบังคับคดี</a></li>
              <li class="nav-item"><a href="#tab_4">ของกลาง</a></li>
              <li class="nav-item"><a href="#tab_5">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
            </ul>
          </div>

          <div class="box-body">

            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                  <li>กรุณาลงชื่อ ผู้อนุมัติ {{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12"> <br />
                <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="form-group" align="right">
                          <button type="submit" class="delete-modal btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger" href="{{ route('legislation',2) }}">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
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

                                var sendcheckresults = document.getElementById('sendcheckresultscourt').value;
                                var dayresults = document.getElementById('dayresultscourt').value;
                                var Setdate = new Date(result);
                                var newdate = new Date(Setdate);

                                if (Setdate != '') {
                                  var Setdate = new Date(result);
                                  var newdate = new Date(Setdate);

                                  if (sendcheckresults != '') {
                                    var Setdate = new Date(sendcheckresults);
                                    var newdate = new Date(Setdate);
                                  }

                                }else if (sendcheckresults != '') {
                                  var Setdate = new Date(sendcheckresults);
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
                                document.getElementById('sequestercourt').value = result;
                              }
                            }
                          }

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

                              var sendcheckresults = document.getElementById('sendcheckresultscourt').value;
                              var sequesters = new Date(resultcheck);
                              var newdate = new Date(sequesters);

                              if (sequesters != '') {
                                var Setdate = new Date(sequesters);
                                var newdate = new Date(Setdate);
                                if (sendcheckresults != '') {
                                  var Setdate = new Date(sendcheckresults);
                                  var newdate = new Date(Setdate);
                                }
                              }else if (sendcheckresults != '') {
                                var Setdate = new Date(sendcheckresults);
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
                              document.getElementById('sequestercourt').value = result;
                            }
                          }

                          function CalculateCap(){
                              var cap = document.getElementById('capitalcourt').value;
                              var Setcap = cap.replace(",","");
                              var ind = document.getElementById('indictmentcourt').value;
                              var Setind = ind.replace(",","");

                              var Sumcap = (Setcap * 0.01);

                              if(!isNaN(Setcap)){
                                  document.form1.capitalcourt.value = addCommas(Setcap);
                                  document.form1.pricelawyercourt.value = addCommas(Sumcap.toFixed(2));
                             }
                              if(!isNaN(Setind)){
                                  document.form1.indictmentcourt.value = addCommas(Setind);
                             }
                          }

                        </script>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> วันฟ้อง (45-60 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันที่ฟ้อง
                                    <input type="date" id="fillingdatecourt" name="fillingdatecourt" class="form-control" value="{{ ($data->fillingdate_court) }}" />
                                    <div class="row">
                                      <div class="col-md-6">
                                        ศาล
                                        <input type="text" name="lawcourt" class="form-control" value="{{ ($data->law_court) }}" />
                                      </div>
                                      <div class="col-md-6">
                                        เลขคดีดำ
                                        <input type="text" name="bnumbercourt" class="form-control" value="{{ ($data->bnumber_court) }}" />
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        เลขคดีแดง
                                        <input type="text" name="rnumbercourt" class="form-control" value="{{ ($data->rnumber_court) }}"  />
                                      </div>
                                      <div class="col-md-6">
                                        ทุนทรัพย์
                                        <input type="text" id="capitalcourt" name="capitalcourt" class="form-control" value="{{ ($data->capital_court) }}" oninput="CalculateCap();"/>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        ค่าฟ้อง
                                        <input type="text" id="indictmentcourt" name="indictmentcourt" class="form-control" value="{{ ($data->indictment_court) }}" oninput="CalculateCap();"/>
                                      </div>
                                      <div class="col-md-6">
                                        ค่าทนาย
                                        <input type="text" id="pricelawyercourt" name="pricelawyercourt" class="form-control" value="{{ ($data->pricelawyer_court) }}" readonly/>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> สืบพยาน (30 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันที่สืบพยาน
                                    <input type="date" id="examidaycourt" name="examidaycourt" class="form-control" value="{{ ($data->examiday_court) }}" oninput="CourtDate();" />
                                    วันที่เลือน
                                    <input type="date" id="fuzzycourt" name="fuzzycourt" class="form-control" value="{{ ($data->fuzzy_court) }}" oninput="CourtDate();" />
                                    หมายเหตุ
                                    <textarea name="examinotecourt" class="form-control" rows="3">{{ ($data->examinote_court) }}</textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ส่งคำบังคับ (45 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันที่ดึงจากระบบ
                                    <input type="date" id="orderdaycourt" name="orderdaycourt" class="form-control" value="{{ ($data->orderday_court) }}" readonly/>
                                    วันที่ส่งจริง
                                    <input type="date" id="ordersendcourt" name="ordersendcourt" class="form-control" value="{{ ($data->ordersend_court) }}" oninput="CourtDate();" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ตรวจผลหมาย (45 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    <div class="row">
                                      <div class="col-md-3">
                                        วันที่ตรวจผลหมาย
                                        <input type="date" id="checkdaycourt" name="checkdaycourt" class="form-control" value="{{ ($data->checkday_court) }}" oninput="CourtDate2();" readonly/>
                                      </div>
                                      <div class="col-md-3">
                                        วันที่ตรวจผลหมายจริง
                                        <input type="date" id="checksendcourt" name="checksendcourt" class="form-control" value="{{ ($data->checksend_court) }}" onchange="CourtDate2();" />
                                      </div>
                                      <div class="col-md-3">
                                        วันทีผู้เช่าซื้อได้รับ
                                        <input type="date" id="buyercourt" name="buyercourt" class="form-control" value="{{ ($data->buyer_court) }}" oninput="CheckMessege();"/>
                                      </div>
                                      <div class="col-md-3">
                                        วันทีผู้ค้ำได้รับ
                                        <input type="date" id="supportcourt" name="supportcourt" class="form-control" value="{{ ($data->support_court) }}" oninput="CheckMessege();"/>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-9">
                                        หมายเหตุ
                                        <textarea name="notecourt" class="form-control" value="" rows="4" >{{ ($data->note_court) }}</textarea>
                                      </div>
                                      <div class="col-md-3">
                                        <p></p>
                                        <span class="todo-wrap">
                                          @if($data->social_flag == "infomation")
                                            <input type="checkbox" id="1" name="socialflag" value="{{ $data->social_flag }}" checked="checked"/>
                                          @else
                                            <input type="checkbox" id="1" name="socialflag" value="infomation" onclick="CourtDate2()"/>
                                          @endif
                                          <label for="1" class="todo">
                                            <i class="fa fa-check"></i>
                                            ประกาศสื่ออิเล็กทรอนิกส์
                                          </label>
                                        </span>
                                      </div>
                                      <div class="col-md-3">
                                        <span class="todo-wrap">
                                          @if($data->social_flag == "success")
                                            <input type="checkbox" id="4" name="socialflag" value="{{ $data->social_flag }}" checked="checked"/>
                                          @else
                                            <input type="checkbox" id="4" name="socialflag" value="success" onclick="CourtDate2()"/>
                                          @endif
                                          <label for="4" class="todo">
                                            <i class="fa fa-check"></i>
                                            ได้รับผลหมายทั้งคู่
                                          </label>
                                        </span>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ตั้งเจ้าพนักงาน (45 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันทีตั้งเจ้าพนักงาน
                                    <input type="date" id="setofficecourt" name="setofficecourt" class="form-control" value="{{ $data->setoffice_court }}" readonly/>
                                    วันที่ส่งจริง
                                    <input type="date" id="sendofficecourt" name="sendofficecourt" class="form-control" value="{{ $data->sendoffice_court }}" oninput="CheckMessege();CourtDate2();"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ตรวจผลหมายตั้ง (45 วัน)</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันที่ตรวจผลหมายตั้ง
                                    <input type="date" id="checkresultscourt" name="checkresultscourt" class="form-control" value="{{ $data->checkresults_court }}" readonly/>
                                    วันที่ส่งจริง
                                    <input type="date" id="sendcheckresultscourt" name="sendcheckresultscourt" class="form-control" value="{{ $data->sendcheckresults_court }}" oninput="CheckMessege();CourtDate2();"/>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <p></p>
                                        <span class="todo-wrap">
                                          @if($data->received_flag != Null)
                                            <input type="checkbox" id="2" name="receivedflag" value="{{ $data->received_flag }}" checked="checked"/>
                                          @else
                                            <input type="checkbox" id="2" name="receivedflag" value="on"/>
                                          @endif
                                          <label for="2" class="todo">
                                            <i class="fa fa-check"></i>
                                            ได้รับ
                                          </label>
                                        </span>
                                      </div>
                                      <div class="col-md-6">
                                        <p></p>
                                        <span class="todo-wrap">
                                          @if($data->noreceived_flag != Null)
                                            <input type="checkbox" id="3" name="noreceivedflag" value="{{ $data->noreceived_flag }}" checked="checked"/>
                                          @else
                                            <input type="checkbox" id="3" name="noreceivedflag" value="on" onclick="myFunction()"/>
                                          @endif
                                          <label for="3" class="todo">
                                            <i class="fa fa-check"></i>
                                            ไม่ได้รับ
                                          </label>
                                        </span>
                                      </div>
                                    </div>
                                     <!-- test -->
                                     @if($data->noreceived_flag == Null)
                                       <div id="myDIV" style="display:none;">
                                     @else
                                      <div id="myDIV">
                                     @endif
                                          วันทีโทร
                                          <input type="date" id="telresultscourt" name="telresultscourt" class="form-control" value="{{ $data->telresults_court }}" />
                                          วันทีไปรับ
                                          <input type="date" id="dayresultscourt" name="dayresultscourt" class="form-control" value="{{ $data->dayresults_court }}" />
                                       </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ยึดทรัพย์</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    วันที่ยึดทรัพย์
                                    <input type="date" id="sequestercourt" name="sequestercourt" class="form-control" value="{{ $data->sequester_court }}" readonly/>
                                    วันที่ยึดทรัพย์จริง
                                    <input type="date" id="sendsequestercourt" name="sendsequestercourt" class="form-control" value="{{ $data->sendsequester_court }}" />
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
          </div>
        </div>

<!-- เวลาแจ้งเตือน -->

      <script>
      $(function () {
        $('[data-mask]').inputmask()
      })
      </script>

      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

      <script>
          function myFunction() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
          x.style.display = "block";
          } else {
          x.style.display = "none";
          }
          }
      </script>

    </section>
@endsection
