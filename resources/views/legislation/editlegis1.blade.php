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
                <form name="form1" method="post" action="#" enctype="multipart/form-data">
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
                          function CourtDate(){
                            var num11 = document.getElementById('fillingdatecourt').value;
                            console.log(num11);

                            var Setdate = new Date(num11);
                            var newdate = new Date(Setdate);

                            newdate.setDate(newdate.getDate() + 60);
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
                            document.getElementById('Examinedaycourt').value = result;

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
                            document.getElementById('Orderdaycourt').value = result;

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
                            document.getElementById('Checkdaycourt').value = result;
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
                                    <input type="date" id="fillingdatecourt" name="fillingdatecourt" class="form-control" value="{{ date('Y-m-d') }}" oninput="CourtDate();" />
                                    <div class="row">
                                      <div class="col-md-6">
                                        ศาล
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                      <div class="col-md-6">
                                        เลขคดีดำ
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        เลขคดีแดง
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                      <div class="col-md-6">
                                        ทุนทรัพย์
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        ค่าฟ้อง
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                      <div class="col-md-6">
                                        ค่าทนาย
                                        <input type="text" name="Contract_legis" class="form-control" value="" />
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
                                    <input type="date" id="Examinedaycourt" name="Examinedaycourt" class="form-control" readonly/>
                                    วันที่เลือน
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    หมายเหตุ
                                    <textarea name="Contract_legis" class="form-control" value="" rows="3"></textarea>
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
                                    <input type="date" id="Orderdaycourt" name="Orderdaycourt" class="form-control" value="" readonly/>
                                    วันที่ส่งจริง
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> ตรวจผลหมาย</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    <div class="row">
                                      <div class="col-md-3">
                                        วันที่ตรวจผลหมาย
                                        <input type="date" id="Checkdaycourt" name="Checkdaycourt" class="form-control" value="" readonly/>
                                      </div>
                                      <div class="col-md-3">
                                        วันที่ตรวจผลหมายจริง
                                        <input type="date" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                      <div class="col-md-3">
                                        วันทีผู้เช่าซื้อได้รับ
                                        <input type="date" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                      <div class="col-md-3">
                                        วันทีผู้ค้ำได้รับ
                                        <input type="date" name="Contract_legis" class="form-control" value="" />
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-9">
                                        หมายเหตุ
                                        <textarea name="Contract_legis" class="form-control" value="" rows="4" ></textarea>
                                      </div>
                                      <div class="col-md-3">
                                        <p></p>
                                        <span class="todo-wrap">
                                          <input type="checkbox" id="1" name="Acceptlist" value="on"/>
                                          <label for="1" class="todo">
                                            <i class="fa fa-check"></i>
                                            ประกาศสื่ออิเล็กทรอนิกส์
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
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    วันที่ส่งจริง
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
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
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    วันที่ส่งจริง
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    <div class="row">
                                      <div class="col-md-4">
                                        <p></p>
                                        <span class="todo-wrap">
                                          <input type="checkbox" id="2" name="Acceptlist" value="on"/>
                                          <label for="2" class="todo">
                                            <i class="fa fa-check"></i>
                                            ได้รับ
                                          </label>
                                        </span>
                                      </div>
                                      <div class="col-md-6">
                                        <p></p>
                                        <span class="todo-wrap">
                                          <input type="checkbox" id="3" name="Acceptlist" value="on"/>
                                          <label for="3" class="todo">
                                            <i class="fa fa-check"></i>
                                            ไม่ได้รับ
                                          </label>
                                        </span>
                                      </div>
                                    </div>
                                    วันทีโทร
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    วันทีไปรับ
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
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
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
                                    วันที่ยึดทรัพย์จริง
                                    <input type="date" name="Contract_legis" class="form-control" value="" />
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

    </section>
@endsection
