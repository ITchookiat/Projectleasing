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
                      <div class="row">
                        <div class="col-md-9">
                          <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">ข้อมูลผู้เช่าซื้อ</h3>
                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div class="row">
                                 <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    เลขที่สัญญา
                                    <input type="text" name="Contract_legis" class="form-control" style="width: 200px;" value="{{ $data->Contract_legis }}" readonly/>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ชื่อ - นามสกุล
                                    <input type="text" name="Namelegis" class="form-control" style="width: 200px;" value="{{ $data->Name_legis }}" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    เลขบัตรประชาชน
                                    <input type="text" name="Idcardlegis" class="form-control" style="width: 200px;" value="{{ $data->Idcard_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                 <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ป้ายทะเบียน
                                    <input type="text" name="registerlegis" class="form-control" style="width: 200px;" value="{{ $data->register_legis }}"/>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ยี่ห้อ
                                    <input type="text" name="BrandCarlegis" class="form-control" style="width: 200px;" value="{{ $data->BrandCar_legis }}" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ปีรถ
                                    <input type="text" name="YearCarlegis" class="form-control" style="width: 200px;" value="{{ $data->YearCar_legis }}" />
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                 <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ประเภทรถ
                                    <input type="text" name="Categorylegis" class="form-control" style="width: 200px;" value="{{ $data->Category_legis }}"/>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    วันที่ทำสัญญา
                                    <input type="text" name="DateDuelegis" class="form-control" style="width: 200px;" value="{{ DateThai($data->DateDue_legis) }}" />
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    วันที่หยุด Vat
                                    <input type="text" name="DateVATlegis" class="form-control" style="width: 200px;" value="{{ DateThai($data->DateVAT_legis) }}" />
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ยอดจัด
                                    <input type="text" name="Paylegis" class="form-control" style="width: 200px;" value="{{ number_format($data->Pay_legis ,2) }}" />
                                  </div>
                                </div>
                                 <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ยอดรวมทั้งหมด
                                    <input type="text" name="BalancePricelegis" class="form-control" style="width: 200px;" value="{{ number_format($data->BalancePrice_legis, 2) }}"/>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    ชื่อผู้ค้ำ
                                    <input type="text" name="NameGTlegis" class="form-control" style="width: 200px;" value="{{ $data->NameGT_legis }}" />
                                  </div>
                                </div>

                                 <div class="col-md-3">
                                  <div class="form-inline" align="left">
                                    เลขบัตรประชาชน
                                    <input type="text" name="IdcardGTlegis" class="form-control" style="width: 200px;" value="{{ $data->IdcardGT_legis }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="form-group" align="center">
                          <button type="submit" class="delete-modal btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger" href="#">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3">
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
                              <input type="date" name="Contract_legis" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}" />
                              เลขคดีดำ
                              <input type="text" name="Contract_legis" class="form-control" style="width: 250px;" value="" />
                              ทุนทรัพย์
                              <input type="text" name="Contract_legis" class="form-control" style="width: 250px;" value="" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title"> สืบพยาน</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body">
                              เลขคดีแดง
                              <input type="text" name="Contract_legis" class="form-control" style="width: 250px;" value="" />
                              วันที่เลือน
                              <input type="date" name="Contract_legis" class="form-control" style="width: 250px;" value="" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title"> ส่งคำบังคับ</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="box-body">
                              The body of the box
                              <input type="text" name="Contract_legis" class="form-control" style="width: 250px;" value="" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <br />
                <input type="hidden" name="_method" value="PATCH"/>
              </form>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>

      <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
      </script>

      <script type="text/javascript">
          $("#image-file").fileinput({
            uploadUrl:"{{ route('MasterAnalysis.store') }}",
            theme:'fa',
            uploadExtraData:function(){
              return{
                _token:"{{csrf_token()}}",
              }
            },
            allowedFileExtensions:['jpg','png','gif'],
            maxFileSize:10240
          })
      </script>

<!-- เวลาแจ้งเตือน -->
      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

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
