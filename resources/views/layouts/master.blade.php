<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="icon" href="{{ asset('dist/img/homecar.png') }}" type="image/ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <style>
      .a1 {color: #E6E6FA;}
      .a2 {color: #4A0B52;}
      .a3 {color: #262A5E;}
      .a4 {color: #B1692E;}
      .a5 {color: #207B15;}
      .a6 {color: #E7071E;}


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

  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <script src="{{ asset('dist/js/demo.js') }}"></script>

  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.extentionsjs') }}"></script>
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

  <div class="control-sidebar-bg"></div>
</div>

</body>
</html>
