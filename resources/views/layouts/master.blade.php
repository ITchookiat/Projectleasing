<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ชูเกียรติลิสซิ่ง</title>
  <link rel="icon" href="{{ asset('dist/img/leasingLogo.png') }}" type="image/ico" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>


  <style>
    .a1 {color: #E6E6FA;}
    .a2 {color: #4A0B52;}
    .a3 {color: #262A5E;}
    .a4 {color: #B1692E;}
    .a5 {color: #207B15;}
    .a6 {color: #E6E6FA;}

    /* The container */
    .con {
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 25px;
      -webkit-user-select: 10px;
      -moz-user-select: 10px;
      -ms-user-select: 10px;
      user-select: 10px;
    }

    /* Hide the browser's default checkbox */
    .con input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;

    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #999;
    }

    /* On mouse-over, add a grey background color */
    .con:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .con input:checked ~ .checkmark {
      background-color: #008000;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .con input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .con .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
  </style>
  <style>
    .con2 {
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 25px;
      -webkit-user-select: 10px;
      -moz-user-select: 10px;
      -ms-user-select: 10px;
      user-select: 10px;
    }

    .con2 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #999;
    }

    .con2:hover input ~ .checkmark {
      background-color: #ccc;
    }

    .con2 input:checked ~ .checkmark {
      background-color: red;
    }

    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    .con2 input:checked ~ .checkmark:after {
      display: block;
    }

    .con2 .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
  </style>
  <style>
    .con3 {
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 25px;
      -webkit-user-select: 10px;
      -moz-user-select: 10px;
      -ms-user-select: 10px;
      user-select: 10px;
      border-radius: 25px;
    }

    .con3 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
      border-radius: 25px;
    }

    .checkmark3 {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #999;
      border-radius: 25px;
    }

    .con3:hover input ~ .checkmark3 {
      background-color: #ccc;
    }

    .con3 input:checked ~ .checkmark3 {
      background-color: blue;
    }

    .checkmark3:after {
      content: "";
      position: absolute;
      display: none;
      border-radius: 25px;
    }

    .con3 input:checked ~ .checkmark3:after {
      display: block;
    }

    .con3 .checkmark3:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
  </style>
  <style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
  </style>

  <script src="{{ asset('js/function.js') }}"></script>
  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>

</head>

<!-- <body class="hold-transition skin-yellow {{ (request()->is('home')) ? 'sidebar-collapse' : '' }}" style="height: auto; min-height: 100%;"> -->
<body class="hold-transition skin-blue" style="height: auto; min-height: 100%;">

<!-- Site wrapper -->
<div class="wrapper">

  <!-- =============================================== -->

  @include('layouts.header')
  @include('layouts.sidebar')

  <!-- =============================================== -->

  <div class="content-wrapper">

    @yield('content')

  </div>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul> -->
    <div class="tab-content">
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h5 class="control-sidebar-heading">ตัวเลือกเพิ่มเติม</h5>
        <ul class="control-sidebar-menu">
          <li>
            <a href="#" data-toggle="modal" data-target="#modal-program" data-backdrop="static" data-keyboard="false">

              <i class="menu-icon fa fa-calculator bg-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">โปรแกรมคำนวณค่างวด</h4>
                <!-- <p>Will be 23 on April 24th</p> -->
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-gear bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">คั้งค่ายอดจัดไฟแนนซ์</h4>
                <!-- <p>Will be 23 on April 24th</p> -->
              </div>
            </a>
          </li>
          <!-- <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li> -->
          <!-- <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li> -->
          <!-- <li>
            <a href="{{ route('Analysis',1) }}">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li> -->
        </ul>
        <!-- <h3 class="control-sidebar-heading">Tasks Progress</h3> -->
        <!-- <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul> -->
      </div>
    </div>
  </aside>

  <div class="control-sidebar-bg"></div>

  <!-- โปรแกรมคำนวณค่างวด -->
  <form name="form">
    <div class="modal fade" id="modal-program">

      <script>
          function commas(nStr){
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
          function goProcess(){
            var Getyear = document.getElementById('Caryear').value;
            if(Getyear >= 2015 && Getyear <= 2020){
              var Getgroup = '2015 - 2020';
            }else if(Getyear >= 2012 && Getyear <= 2014){
              var Getgroup = '2012 - 2014';
            }else if(Getyear >= 2010 && Getyear <= 2011){
              var Getgroup = '2010 - 2011';
              }else if(Getyear >= 2009){
              var Getgroup = '2009';
              }else if(Getyear >= 2008){
              var Getgroup = '2008';
              }else if(Getyear >= 2007){
              var Getgroup = '2007';
              }else if(Getyear >= 2006){
              var Getgroup = '2006';
              }else if(Getyear >= 2005){
              var Getgroup = '2005';
              }else if(Getyear >= 2004){
              var Getgroup = '2004';
              }else if(Getyear >= 2003){
              var Getgroup = '2003';
              }else{
              Getgroup = '-';
            }
            document.form.Cargroup.value = Getgroup;
            var typedetail = document.getElementById('Cartype').value;
            var timelack = document.getElementById('Timelenght').value;
            if(typedetail == 'รถกระบะ' && Getgroup == '2015 - 2020'){
              // $("#Timelenght").append("<option value='1'>12</option><option value='1.5'>18</option><option value='2'>24</option><option value='2.5'>30</option><option value='3'>36</option><option value='3.5'>42</option><option value='4'>48</option><option value='4.5'>54</option><option value='5'>60</option><option value='5.5'>66</option><option value='6'>72</option><option value='6.5'>78</option><option value='7'>84</option>");
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '5.55';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '6.00';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '6.45';
              }else{
              document.form.Carinterest.value = '7.15';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2012 - 2014'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '9.45';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '9.55';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '9.65';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2010 - 2011'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '10.80';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '10.90';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '11';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2009'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '12.45';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '12.55';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '12.65';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2008'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.35';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.45';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '14.55';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2007'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.45';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.55';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2006'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.55';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.75';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2005'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '18.65';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2004'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '18.65';
              }else{
              document.form.Carinterest.value = '';
              }
              }
            else if(typedetail == 'รถกระบะ' && Getgroup == '2003'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '18.65';
              }else{
              document.form.Carinterest.value = '';
              }
            }

            if(typedetail == 'รถตอนเดียว' && Getyear > 2014 && Getyear <= 2020){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 5){
                document.form1.Interestcar.value = '10.80';
              }else{
                document.form1.Interestcar.value = '';
              }
            }
            else if(typedetail == 'รถตอนเดียว' && Getyear > 2012 && Getyear <= 2014){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 5){
                document.form1.Interestcar.value = '12.60';
              }else{
                document.form1.Interestcar.value = '';
              }
            }
            else if(typedetail == 'รถตอนเดียว' && Getyear > 2009 && Getyear <= 2012){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 5){
                document.form1.Interestcar.value = '14.40';
              }else{
                document.form1.Interestcar.value = '';
              }
            }
            else if(typedetail == 'รถตอนเดียว' && Getyear > 2007 && Getyear <= 2009){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 4){
                document.form1.Interestcar.value = '16.80';
              }else{
                document.form1.Interestcar.value = '';
              }
            }
            else if(typedetail == 'รถตอนเดียว' && Getyear > 2005 && Getyear <= 2007){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 4){
                document.form1.Interestcar.value = '18.60';
              }else{
                document.form1.Interestcar.value = '';
              }
            }
            else if(typedetail == 'รถตอนเดียว' && Getyear > 2003 && Getyear <= 2005){
              if(timelack == ''){
                document.form1.Interestcar.value = '';
              }else if(timelack <= 3){
                document.form1.Interestcar.value = '20.40';
              }else{
                document.form1.Interestcar.value = '';
              }
            }

            if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2015 - 2020'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '6.05';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '6.50';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '6.95';
              }else{
              document.form.Carinterest.value = '7.65';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2012 - 2014'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '9.60';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '9.70';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '9.80';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2010 - 2011'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '10.95';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '11.05';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '11.15';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2009'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '12.60';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '12.70';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '12.80';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2008'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.50';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.60';
              }else if(timelack > 5 && timelack <= 6){
              document.form.Carinterest.value = '14.70';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2007'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.60';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.70';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2006'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '14.70';
              }else if(timelack > 4 && timelack <= 5){
              document.form.Carinterest.value = '14.90';
              }else{
              document.form.Carinterest.value = '';
              }
            }
            else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && Getgroup == '2005'){
              if(timelack == ''){
              document.form.Carinterest.value = '';
              }else if(timelack <= 4){
              document.form.Carinterest.value = '19.00';
              }else{
              document.form.Carinterest.value = '';
              }
            }

            var num11 = document.getElementById('Cartop').value;
            var num1 = num11.replace(",","");
            var num4 = document.getElementById('Timelenght').value;
            var num2 = document.getElementById('Carinterest').value;
            document.form.Cartop.value = commas(num1);

            $('#Cartype,#Caryear').change(function(){
              $('#Guestyear').hide();
              $('#Timelenght').show();
              if(Getyear > 2014 && Getyear <= 2020 ){
                if(typedetail == 'รถตอนเดียว'){
                  $("#Timelenght option[value='1']").show();
                  $("#Timelenght option[value='1.5']").show();
                  $("#Timelenght option[value='2']").show();
                  $("#Timelenght option[value='2.5']").show();
                  $("#Timelenght option[value='3']").show();
                  $("#Timelenght option[value='3.5']").show();
                  $("#Timelenght option[value='4']").show();
                  $("#Timelenght option[value='4.5']").show();
                  $("#Timelenght option[value='5']").show();
                  $("#Timelenght option[value='5.5']").hide();
                  $("#Timelenght option[value='6']").hide();
                  $("#Timelenght option[value='6.5']").hide();
                  $("#Timelenght option[value='7']").hide();
                }else{
                  $("#Timelenght option[value='1']").show();
                  $("#Timelenght option[value='1.5']").show();
                  $("#Timelenght option[value='2']").show();
                  $("#Timelenght option[value='2.5']").show();
                  $("#Timelenght option[value='3']").show();
                  $("#Timelenght option[value='3.5']").show();
                  $("#Timelenght option[value='4']").show();
                  $("#Timelenght option[value='4.5']").show();
                  $("#Timelenght option[value='5']").show();
                  $("#Timelenght option[value='5.5']").show();
                  $("#Timelenght option[value='6']").show();
                  $("#Timelenght option[value='6.5']").show();
                  $("#Timelenght option[value='7']").show();
                }
               }
              else if(Getyear > 2009 && Getyear <= 2014 ){
                if(typedetail == 'รถตอนเดียว'){
                  $("#Timelenght option[value='1']").show();
                  $("#Timelenght option[value='1.5']").show();
                  $("#Timelenght option[value='2']").show();
                  $("#Timelenght option[value='2.5']").show();
                  $("#Timelenght option[value='3']").show();
                  $("#Timelenght option[value='3.5']").show();
                  $("#Timelenght option[value='4']").show();
                  $("#Timelenght option[value='4.5']").show();
                  $("#Timelenght option[value='5']").show();
                  $("#Timelenght option[value='5.5']").hide();
                  $("#Timelenght option[value='6']").hide();
                  $("#Timelenght option[value='6.5']").hide();
                  $("#Timelenght option[value='7']").hide();
                }else{
                  $("#Timelenght option[value='1']").show();
                  $("#Timelenght option[value='1.5']").show();
                  $("#Timelenght option[value='2']").show();
                  $("#Timelenght option[value='2.5']").show();
                  $("#Timelenght option[value='3']").show();
                  $("#Timelenght option[value='3.5']").show();
                  $("#Timelenght option[value='4']").show();
                  $("#Timelenght option[value='4.5']").show();
                  $("#Timelenght option[value='5']").show();
                  $("#Timelenght option[value='5.5']").show();
                  $("#Timelenght option[value='6']").show();
                  $("#Timelenght option[value='6.5']").hide();
                  $("#Timelenght option[value='7']").hide();
                }
               }
              else if(Getyear > 2007 && Getyear <= 2009 ){
                 if(typedetail == 'รถตอนเดียว'){
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }else{
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").show();
                   $("#Timelenght option[value='5']").show();
                   $("#Timelenght option[value='5.5']").show();
                   $("#Timelenght option[value='6']").show();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }
                }
              else if(Getyear > 2005 && Getyear <= 2007 ){
                 if(typedetail == 'รถตอนเดียว'){
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }else{
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").show();
                   $("#Timelenght option[value='5']").show();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }
                }
              else if(Getyear > 2003 && Getyear <= 2005 ){
                 if(typedetail == 'รถตอนเดียว'){
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").hide();
                   $("#Timelenght option[value='4']").hide();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }else{
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }
                }
              else if(Getyear > 2003 && Getyear <= 2005 ){
                 if(typedetail == 'รถตอนเดียว'){
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").hide();
                   $("#Timelenght option[value='4']").hide();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }else{
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }
                }
              else if(Getyear > 2002 && Getyear <= 2003 ){
                 if(typedetail == 'รถตอนเดียว'){
                   $("#Timelenght option[value='1']").hide();
                   $("#Timelenght option[value='1.5']").hide();
                   $("#Timelenght option[value='2']").hide();
                   $("#Timelenght option[value='2.5']").hide();
                   $("#Timelenght option[value='3']").hide();
                   $("#Timelenght option[value='3.5']").hide();
                   $("#Timelenght option[value='4']").hide();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }else{
                   $("#Timelenght option[value='1']").show();
                   $("#Timelenght option[value='1.5']").show();
                   $("#Timelenght option[value='2']").show();
                   $("#Timelenght option[value='2.5']").show();
                   $("#Timelenght option[value='3']").show();
                   $("#Timelenght option[value='3.5']").show();
                   $("#Timelenght option[value='4']").show();
                   $("#Timelenght option[value='4.5']").hide();
                   $("#Timelenght option[value='5']").hide();
                   $("#Timelenght option[value='5.5']").hide();
                   $("#Timelenght option[value='6']").hide();
                   $("#Timelenght option[value='6.5']").hide();
                   $("#Timelenght option[value='7']").hide();
                 }
                }
              else{
                $("#Timelenght option[value='1']").hide();
                $("#Timelenght option[value='1.5']").hide();
                $("#Timelenght option[value='2']").hide();
                $("#Timelenght option[value='2.5']").hide();
                $("#Timelenght option[value='3']").hide();
                $("#Timelenght option[value='3.5']").hide();
                $("#Timelenght option[value='4']").hide();
                $("#Timelenght option[value='4.5']").hide();
                $("#Timelenght option[value='5']").hide();
                $("#Timelenght option[value='5.5']").hide();
                $("#Timelenght option[value='6']").hide();
                $("#Timelenght option[value='6.5']").hide();
                $("#Timelenght option[value='7']").hide();
              }
            });

            if(num4 == '1'){
              var period = '12';
              }else if(num4 == '1.5'){
              var period = '18';
              }else if(num4 == '2'){
              var period = '24';
              }else if(num4 == '2.5'){
              var period = '30';
              }else if(num4 == '3'){
              var period = '36';
              }else if(num4 == '3.5'){
              var period = '42';
              }else if(num4 == '4'){
              var period = '48';
              }else if(num4 == '4.5'){
              var period = '54';
              }else if(num4 == '5'){
              var period = '60';
              }else if(num4 == '5.5'){
              var period = '66';
              }else if(num4 == '6'){
              var period = '72';
              }else if(num4 == '6.5'){
              var period = '78';
              }else if(num4 == '7'){
              var period = '84';
            }

            var totaltopcar = parseFloat(num1);
            var a = (num2*num4)+100;
            var b = (((totaltopcar*a)/100)*1.07)/period;
            var result = Math.ceil(b/10)*10;
            var durate = result/1.07;
            var durate2 = durate.toFixed(2)*period;
            var tax = result-durate;
            var tax2 = tax.toFixed(2)*period;
            var total = result*period;
            var total2 = durate2+tax2;

            if(!isNaN(result)){
              document.form.Carpay.value = commas(result.toFixed(0));
              document.form.Cartop.value = commas(totaltopcar);
            }
          }
      </script>

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title" align="center">โปรแกรมคำนวณค่างวด</h4>
          </div>
          <div class="modal-body">
            <br>
            <div class="row">
                <div class="col-md-10">
                  <div class="form-inline" align="right">
                    <label>ยอดจัด : </label>
                    <input type="text" id="Cartop" name="Cartop" class="form-control" style="width: 250px;" maxlength="9" placeholder="กรอกยอดจัด" oninput="goProcess();" />
                   </div>
                </div>
                <div class="col-md-2">
                 <div class="form-inline" align="right">

                 </div>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-10">
                <div class="form-inline" align="right">
                   <label>ประเภทรถ : </label>
                   <select id="Cartype" name="Cartype" class="form-control" style="width: 250px;" onchange="goProcess();">
                     <option value="" selected>--- ประเภทรถ ---</option>
                     <option value="รถกระบะ">รถกระบะ</option>
                     <option value="รถตอนเดียว">รถตอนเดียว</option>
                     <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                   </select>
                 </div>
              </div>

              <div class="col-md-2">
               <div class="form-inline" align="right">
               </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-10">
                <div class="form-inline" align="right">
                  <label>ปี : </label>
                  <select id="Caryear" name="Caryear" class="form-control" style="width: 250px;" onchange="goProcess();">
                    <option value="" selected>--- เลือกปี ---</option>
                     @php
                         $Tempyear = date('Y');
                     @endphp
                     @for ($i = 0; $i < 20; $i++)
                         <option value="{{ $Tempyear }}">{{ $Tempyear }}</option>
                         @php
                             $Tempyear -= 1;
                         @endphp
                     @endfor
                  </select>
                 </div>
              </div>
              <div class="col-md-2">
                <div class="form-inline" align="right">
                  <input type="text" id="Cargroup" name="Cargroup" class="form-control" style="width: 120px;display:none;" onchange="goProcess();"/>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-10">
                <div class="form-inline" align="right">
                  <label>ระยะเวลาผ่อน : </label>
                  <input type="text" id="Guestyear" class="form-control" style="width: 250px;" readonly />
                  <select id="Timelenght" name="Timelenght" class="form-control" style="width: 250px;display:none;" onchange="goProcess();">
                    <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                    <option value="1">12</option>
                    <option value="1.5">18</option>
                    <option value="2">24</option>
                    <option value="2.5">30</option>
                    <option value="3">36</option>
                    <option value="3.5">42</option>
                    <option value="4">48</option>
                    <option value="4.5">54</option>
                    <option value="5">60</option>
                    <option value="5.5">66</option>
                    <option value="6">72</option>
                    <option value="6.5">78</option>
                    <option value="7">84</option>
                  </select>
                 </div>
              </div>
              <div class="col-md-2">
               <div class="form-inline" align="right">

               </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-10">
                <div class="form-inline" align="right">
                  <label>ดอกเบี้ย: </label>
                  <input type="text" id="Carinterest" name="Carinterest" class="form-control" style="width: 250px;" placeholder="ดอกเบี้ย" readonly onchange="goProcess();"/>
                 </div>
              </div>
              <div class="col-md-2">
               <div class="form-inline" align="right">

               </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-10">
                <div class="form-inline" align="right">
                  <label>ชำระต่องวด : </label>
                  <input type="text" id="Carpay" name="Carpay" class="form-control" style="width: 220px;padding:40px;font-size:40px;" readonly onchange="goProcess();" />
                  <label>บาท</label>
                 </div>
              </div>

              <div class="col-md-2">
               <div class="form-inline" align="right">

               </div>
              </div>
            </div>
            <hr>
          <div class="footer" align="center">
            <button type="button" class="btn btn-danger" data-dismiss="modal"> ปิด <i class="fa fa-times-circle"></i> </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </form>
  <!-- โปรแกรมคำนวณค่างวด -->

</div>

</body>
</html>
