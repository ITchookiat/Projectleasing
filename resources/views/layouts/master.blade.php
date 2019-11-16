<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
    border-radius: 25px;
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
    border-radius: 25px;
  }

  /* On mouse-over, add a grey background color */
  .con:hover input ~ .checkmark {
    background-color: #ccc;
    border-radius: 25px;
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
    border-radius: 25px;
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
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-gear bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">คั้งค่ายอดจัดไฟแนนซ์</h4>
                <!-- <p>Will be 23 on April 24th</p> -->
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="{{ route('Analysis',1) }}">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
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
        </ul>
      </div>
    </div>
  </aside>

  <div class="control-sidebar-bg"></div>
</div>

</body>
</html>
