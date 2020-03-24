@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date1 = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
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
      <form method="get" action="{{ route('Analysis',9) }}">
        <div align="right" class="form-inline pull-right">
          <label>เลขที่สัญญา : </label>
          @if($data == null)
            <input type="type" name="Contno" maxlength="12" style="width:100px;"/>
          @else
            <input type="type" name="Contno" value="{{$data->Contract_buyer}}" maxlength="12" style="width:100px;"/>
          @endif
          <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </div>
      </form>
      <h1>
        ปรับโครงสร้างหนี้
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">
        <div class="box-header with-border">
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link" href="{{ route('Analysis',8) }}" onclick="return confirm('คุณต้องการออกไปหน้าหลักหรือไม่ ? \n')">หน้าหลัก</a></li>
            <li class="nav-item active"><a class="nav-link" href="#tab_1" data-toggle="tab">แบบฟอร์มผู้เช่าซื้อ</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">แบบฟอร์มผู้ค้ำ</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">แบบฟอร์มรถยนต์</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">แบบฟอร์มค่าใช้จ่าย</a></li> -->
          </ul>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

          <div class="box-body">

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

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
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <form name="form1" action="{{ route('MasterAnalysis.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดผู้เช่าซื้อ</h3>
                                <br>
                                <div class="row">
                                   <div class="col-md-5">
                                     <div class="form-inline" align="right">
                                        <label><font color="red">เลขที่สัญญา : </font></label>
                                        @if(auth::user()->type == 1 or auth::user()->type == 2)
                                          <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" value="22-{{$Y}}/" required/>
                                        @else
                                          <input type="text" name="Contract_buyer" class="form-control" style="width: 250px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/&quot;" data-mask="" value="22-{{$Y}}/" readonly required/>
                                        @endif
                                      </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                        <label><font color="red">วันที่ทำสัญญา : </font></label>
                                        <input type="date" name="DateDue" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                      </div>
                                   </div>
                                </div>

                                <hr />
                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อ : </label>
                                      @if($data == null)
                                        <input type="text" name="Namebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                      @else
                                        <input type="text" name="Namebuyer" value="{{ $data->Name_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>นามสกุล : </label>
                                      @if($data == null)
                                        <input type="text" name="lastbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนนามสกุล" />
                                      @else
                                        <input type="text" name="lastbuyer" value="{{ $data->last_buyer }}" class="form-control" style="width: 250px;"  placeholder="ป้อนนามสกุล" />
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ชื่อเล่น : </label>
                                      @if($data == null)
                                        <input type="text" name="Nickbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                      @else
                                        <input type="text" name="Nickbuyer" value="{{ $data->Nick_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อเล่น" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานะ : </label>
                                      @if($data == null)
                                        <select name="Statusbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- เลือกสถานะ ---</option>
                                          <option value="โสด">โสด</option>
                                          <option value="สมรส">สมรส</option>
                                          <option value="หย่าร้าง">หย่าร้าง</option>
                                        </select>
                                      @else
                                        <select name="Statusbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- เลือกสถานะ ---</option>
                                          <option value="โสด" {{ ($data->Status_buyer === 'โสด') ? 'selected' : '' }}>โสด</option>
                                          <option value="สมรส" {{ ($data->Status_buyer === 'สมรส') ? 'selected' : '' }}>สมรส</option>
                                          <option value="หย่าร้าง" {{ ($data->Status_buyer === 'หย่าร้าง') ? 'selected' : '' }}>หย่าร้าง</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      @if($data == null)
                                        <input type="text" name="Phonebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                      @else
                                        <input type="text" name="Phonebuyer" value="{{ $data->Phone_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                      @endif
                                    </div>
                                  </div>


                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรอื่นๆ : </label>
                                      @if($data == null)
                                        <input type="text" name="Phone2buyer" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                      @else
                                        <input type="text" name="Phone2buyer" value="{{ $data->Phone2_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเบอร์โทรอื่นๆ" />
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>คู่สมรส : </label>
                                      @if($data == null)
                                        <input type="text" name="Matebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                      @else
                                        <input type="text" name="Matebuyer" value="{{ $data->Mate_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนคู่สมรส" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เลขบัตรประชาชน : </label>
                                      @if($data == null)
                                        <input type="text" name="Idcardbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                      @else
                                        <input type="text" name="Idcardbuyer" value="{{ $data->Idcard_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ที่อยู่ : </label>
                                      @if($data == null)
                                        <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- เลือกที่อยู่ ---</option>
                                          <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                        </select>
                                      @else
                                      <select name="Addressbuyer" class="form-control" style="width: 250px;">
                                        <option value="" selected>--- เลือกที่อยู่ ---</option>
                                        <option value="ตามทะเบียนบ้าน" {{ ($data->Address_buyer === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                      </select>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </label>
                                      @if($data == null)
                                        <input type="text" name="AddNbuyer" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                      @else
                                        <input type="text" name="AddNbuyer" value="{{ $data->AddN_buyer }}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/ส่งเอกสาร" />
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รายละเอียดที่อยู่ : </label>
                                      @if($data == null)
                                        <input type="text" name="StatusAddbuyer" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                      @else
                                        <input type="text" name="StatusAddbuyer" value="{{ $data->StatusAdd_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนรายละเอียดที่อยู่" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานที่ทำงาน : </label>
                                      @if($data == null)
                                        <input type="text" name="Workplacebuyer" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                      @else
                                        <input type="text" name="Workplacebuyer" value="{{ $data->Workplace_buyer }}" class="form-control" style="width: 250px;" placeholder="ป้อนสถานที่ทำงาน" />
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ลักษณะบ้าน : </label>
                                      @if($data == null)
                                        <select name="Housebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                          <option value="บ้านตึก 1 ชั้น">บ้านตึก 1 ชั้น</option>
                                          <option value="บ้านตึก 2 ชั้น">บ้านตึก 2 ชั้น</option>
                                          <option value="บ้านไม้ 1 ชั้น">บ้านไม้ 1 ชั้น</option>
                                          <option value="บ้านไม้ 2 ชั้น">บ้านไม้ 2 ชั้น</option>
                                          <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                          <option value="แฟลต">แฟลต</option>
                                        </select>
                                      @else
                                        <select name="Housebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                          <option value="บ้านตึก 1 ชั้น" {{ ($data->House_buyer === 'บ้านตึก 1 ชั้น') ? 'selected' : '' }}>บ้านตึก 1 ชั้น</option>
                                          <option value="บ้านตึก 2 ชั้น" {{ ($data->House_buyer === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                          <option value="บ้านไม้ 1 ชั้น" {{ ($data->House_buyer === 'บ้านไม้ 1 ชั้น') ? 'selected' : '' }}>บ้านไม้ 1 ชั้น</option>
                                          <option value="บ้านไม้ 2 ชั้น" {{ ($data->House_buyer === 'บ้านไม้ 2 ชั้น') ? 'selected' : '' }}>บ้านไม้ 2 ชั้น</option>
                                          <option value="บ้านเดี่ยว" {{ ($data->House_buyer === 'บ้านเดี่ยว') ? 'selected' : '' }}>บ้านเดี่ยว</option>
                                          <option value="แฟลต" {{ ($data->House_buyer === 'แฟลต') ? 'selected' : '' }}>แฟลต</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประเภทหลักทรัพย์ : </label>
                                      @if($data == null)
                                        <select name="securitiesbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                          <option value="โฉนด">โฉนด</option>
                                          <option value="นส.3">นส.3</option>
                                          <option value="นส.3 ก">นส.3 ก</option>
                                          <option value="นส.4">นส.4</option>
                                          <option value="นส.4 จ">นส.4 จ</option>
                                        </select>
                                      @else
                                        <select name="securitiesbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                          <option value="โฉนด" {{ ($data->securities_buyer === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                          <option value="นส.3" {{ ($data->securities_buyer === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                          <option value="นส.3 ก" {{ ($data->securities_buyer === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                          <option value="นส.4" {{ ($data->securities_buyer === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                          <option value="นส.4 จ" {{ ($data->securities_buyer === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>เลขที่โฉนด : </label>
                                      @if($data == null)
                                        <input type="text" name="deednumberbuyer" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                      @else
                                        <input type="text" name="deednumberbuyer" value="{{$data->deednumber_buyer}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เนื่อที่ : </label>
                                      @if($data == null)
                                        <input type="text" name="areabuyer" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                      @else
                                        <input type="text" name="areabuyer" value="{{$data->area_buyer}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประเภทบ้าน : </label>
                                      @if($data == null)
                                        <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          <option value="ของตนเอง">ของตนเอง</option>
                                          <option value="อาศัยบิดา-มารดา">อาศัยบิดา-มารดา</option>
                                          <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                          <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                          <option value="บ้านเช่า">บ้านเช่า</option>
                                        </select>
                                      @else
                                        <select name="HouseStylebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ประเภทบ้าน ---</option>
                                          <option value="ของตนเอง" {{ ($data->HouseStyle_buyer === 'ของตนเอง') ? 'selected' : '' }}>ของตนเอง</option>
                                          <option value="อาศัยบิดา-มารดา" {{ ($data->HouseStyle_buyer === 'อาศัยบิดา-มารดา') ? 'selected' : '' }}>อาศัยบิดา-มารดา</option>
                                          <option value="อาศัยผู้อื่น" {{ ($data->HouseStyle_buyer === 'อาศัยผู้อื่น') ? 'selected' : '' }}>อาศัยผู้อื่น</option>
                                          <option value="บ้านพักราชการ" {{ ($data->HouseStyle_buyer === 'บ้านพักราชการ') ? 'selected' : '' }}>บ้านพักราชการ</option>
                                          <option value="บ้านเช่า" {{ ($data->HouseStyle_buyer === 'บ้านเช่า') ? 'selected' : '' }}>บ้านเช่า</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>อาชีพ : </label>
                                      @if($data == null)
                                        <select name="Careerbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- อาชีพ ---</option>
                                          <option value="ตำรวจ">ตำรวจ</option>
                                          <option value="ทหาร">ทหาร</option>
                                          <option value="ครู">ครู</option>
                                          <option value="ข้าราชการอื่นๆ">ข้าราชการอื่นๆ</option>
                                          <option value="ลูกจ้างเทศบาล">ลูกจ้างเทศบาล</option>
                                          <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                          <option value="สมาชิก อบต.">สมาชิก อบต.</option>
                                          <option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
                                          <option value="รับจ้าง">รับจ้าง</option>
                                          <option value="พนักงานบริษัทเอกชน">พนักงานบริษัทเอกชน</option>
                                          <option value="อาชีพอิสระ">อาชีพอิสระ</option>
                                          <option value="กำนัน">กำนัน</option>
                                          <option value="ผู้ใหญ่บ้าน">ผู้ใหญ่บ้าน</option>
                                          <option value="ผู้ช่วยผู้ใหญ่บ้าน">ผู้ช่วยผู้ใหญ่บ้าน</option>
                                          <option value="นักการภารโรง">นักการภารโรง</option>
                                          <option value="มอเตอร์ไซร์รับจ้าง">มอเตอร์ไซร์รับจ้าง</option>
                                          <option value="ค้าขาย">ค้าขาย</option>
                                          <option value="เจ้าของธุรกิจ">เจ้าของธุรกิจ</option>
                                          <option value="เจ้าของอู่รถ">เจ้าของอู่รถ</option>
                                          <option value="ให้เช่ารถบรรทุก">ให้เช่ารถบรรทุก</option>
                                          <option value="ช่างตัดผม">ช่างตัดผม</option>
                                          <option value="ชาวนา">ชาวนา</option>
                                          <option value="ชาวไร่">ชาวไร่</option>
                                          <option value="แม่บ้าน">แม่บ้าน</option>
                                          <option value="รับเหมาก่อสร้าง">รับเหมาก่อสร้าง</option>
                                          <option value="ประมง">ประมง</option>
                                          <option value="ทนายความ">ทนายความ</option>
                                          <option value="พระ">พระ</option>
                                        </select>
                                      @else
                                        <select name="Careerbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- อาชีพ ---</option>
                                          <option value="ตำรวจ" {{ ($data->Career_buyer === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                          <option value="ทหาร" {{ ($data->Career_buyer === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                          <option value="ครู" {{ ($data->Career_buyer === 'ครู') ? 'selected' : '' }}>ครู</option>
                                          <option value="ข้าราชการอื่นๆ" {{ ($data->Career_buyer === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                          <option value="ลูกจ้างเทศบาล" {{ ($data->Career_buyer === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                          <option value="ลูกจ้างประจำ" {{ ($data->Career_buyer === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                          <option value="สมาชิก อบต." {{ ($data->Career_buyer === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                          <option value="ลูกจ้างชั่วคราว" {{ ($data->Career_buyer === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                          <option value="รับจ้าง" {{ ($data->Career_buyer === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                          <option value="พนักงานบริษัทเอกชน" {{ ($data->Career_buyer === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                          <option value="อาชีพอิสระ" {{ ($data->Career_buyer === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                          <option value="กำนัน" {{ ($data->Career_buyer === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                          <option value="ผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                          <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->Career_buyer === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                          <option value="นักการภารโรง" {{ ($data->Career_buyer === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                          <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->Career_buyer === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                          <option value="ค้าขาย" {{ ($data->Career_buyer === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                          <option value="เจ้าของธุรกิจ" {{ ($data->Career_buyer === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                          <option value="เจ้าของอู่รถ" {{ ($data->Career_buyer === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                          <option value="ให้เช่ารถบรรทุก" {{ ($data->Career_buyer === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                          <option value="ช่างตัดผม" {{ ($data->Career_buyer === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                          <option value="ชาวนา" {{ ($data->Career_buyer === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                          <option value="ชาวไร่" {{ ($data->Career_buyer === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                          <option value="แม่บ้าน" {{ ($data->Career_buyer === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                          <option value="รับเหมาก่อสร้าง" {{ ($data->Career_buyer === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                          <option value="ประมง" {{ ($data->Career_buyer === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                          <option value="ทนายความ" {{ ($data->Career_buyer === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                          <option value="พระ" {{ ($data->Career_buyer === 'พระ') ? 'selected' : '' }}>พระ</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-inline" align="right">
                                         <label>รายได้ : </label>
                                         @if($data == null)
                                           <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- รายได้ ---</option>
                                             <option value="5,000 - 10,000">5,000 - 10,000</option>
                                             <option value="10,000 - 15,000">10,000 - 15,000</option>
                                             <option value="15,000 - 20,000">15,000 - 20,000</option>
                                             <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                           </select>
                                         @else
                                           <select name="Incomebuyer" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- รายได้ ---</option>
                                             <option value="5,000 - 10,000" {{ ($data->Income_buyer === '5,000 - 10,000') ? 'selected' : '' }}>5,000 - 10,000</option>
                                             <option value="10,000 - 15,000" {{ ($data->Income_buyer === '10,000 - 15,000') ? 'selected' : '' }}>10,000 - 15,000</option>
                                             <option value="15,000 - 20,000" {{ ($data->Income_buyer === '15,000 - 20,000') ? 'selected' : '' }}>15,000 - 20,000</option>
                                             <option value="มากกว่า 20,000" {{ ($data->Income_buyer === 'มากกว่า 20,000') ? 'selected' : '' }}>มากกว่า 20,000</option>
                                           </select>
                                         @endif
                                       </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ใบขับขี่ : </label>
                                      @if($data == null)
                                        <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ใบขับขี่ ---</option>
                                          <option value="มี">มี</option>
                                          <option value="ไม่มี">ไม่มี</option>
                                        </select>
                                      @else
                                        <select name="Driverbuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- ใบขับขี่ ---</option>
                                          <option value="มี" {{ ($data->Driver_buyer === 'มี') ? 'selected' : '' }}>มี</option>
                                          <option value="ไม่มี" {{ ($data->Driver_buyer === 'ไม่มี') ? 'selected' : '' }}>ไม่มี</option>
                                        </select>
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>หักค่าใช้จ่าย : </label>
                                      @if($data == null)
                                        <input type="text" id="Beforeincome" name="Beforeincome" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" maxlength="9" />
                                      @else
                                        <input type="text" id="Beforeincome" name="Beforeincome" value="{{ number_format($data->BeforeIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" maxlength="9" />
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ประวัติการซื้อ/ค้ำ : </label>
                                      @if($data == null)
                                        <select name="Purchasebuyer" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ซื้อ ---</option>
                                          <option value="0 คัน">0 คัน</option>
                                          <option value="1 คัน">1 คัน</option>
                                          <option value="2 คัน">2 คัน</option>
                                          <option value="3 คัน">3 คัน</option>
                                          <option value="4 คัน">4 คัน</option>
                                          <option value="5 คัน">5 คัน</option>
                                          <option value="6 คัน">6 คัน</option>
                                          <option value="7 คัน">7 คัน</option>
                                          <option value="8 คัน">8 คัน</option>
                                          <option value="9 คัน">9 คัน</option>
                                          <option value="10 คัน">10 คัน</option>
                                          <option value="11 คัน">11 คัน</option>
                                          <option value="12 คัน">12 คัน</option>
                                          <option value="13 คัน">13 คัน</option>
                                          <option value="14 คัน">14 คัน</option>
                                          <option value="15 คัน">15 คัน</option>
                                          <option value="16 คัน">16 คัน</option>
                                          <option value="17 คัน">17 คัน</option>
                                          <option value="18 คัน">18 คัน</option>
                                          <option value="19 คัน">19 คัน</option>
                                          <option value="20 คัน">20 คัน</option>
                                        </select>
                                        <label>ค้ำ : </label>
                                        <select name="Supportbuyer" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          <option value="0 คัน">0 คัน</option>
                                          <option value="1 คัน">1 คัน</option>
                                          <option value="2 คัน">2 คัน</option>
                                          <option value="3 คัน">3 คัน</option>
                                          <option value="4 คัน">4 คัน</option>
                                          <option value="5 คัน">5 คัน</option>
                                          <option value="6 คัน">6 คัน</option>
                                          <option value="7 คัน">7 คัน</option>
                                          <option value="8 คัน">8 คัน</option>
                                          <option value="9 คัน">9 คัน</option>
                                          <option value="10 คัน">10 คัน</option>
                                          <option value="11 คัน">11 คัน</option>
                                          <option value="12 คัน">12 คัน</option>
                                          <option value="13 คัน">13 คัน</option>
                                          <option value="14 คัน">14 คัน</option>
                                          <option value="15 คัน">15 คัน</option>
                                          <option value="16 คัน">16 คัน</option>
                                          <option value="17 คัน">17 คัน</option>
                                          <option value="18 คัน">18 คัน</option>
                                          <option value="19 คัน">19 คัน</option>
                                          <option value="20 คัน">20 คัน</option>
                                        </select>
                                      @else
                                        <select name="Purchasebuyer" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ซื้อ ---</option>
                                          <option value="0 คัน" {{ ($data->Purchase_buyer === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                          <option value="1 คัน" {{ ($data->Purchase_buyer === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                          <option value="2 คัน" {{ ($data->Purchase_buyer === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                          <option value="3 คัน" {{ ($data->Purchase_buyer === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                          <option value="4 คัน" {{ ($data->Purchase_buyer === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                          <option value="5 คัน" {{ ($data->Purchase_buyer === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                          <option value="6 คัน" {{ ($data->Purchase_buyer === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                          <option value="7 คัน" {{ ($data->Purchase_buyer === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                          <option value="8 คัน" {{ ($data->Purchase_buyer === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                          <option value="9 คัน" {{ ($data->Purchase_buyer === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                          <option value="10 คัน" {{ ($data->Purchase_buyer === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                          <option value="11 คัน" {{ ($data->Purchase_buyer === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                          <option value="12 คัน" {{ ($data->Purchase_buyer === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                          <option value="13 คัน" {{ ($data->Purchase_buyer === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                          <option value="14 คัน" {{ ($data->Purchase_buyer === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                          <option value="15 คัน" {{ ($data->Purchase_buyer === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                          <option value="16 คัน" {{ ($data->Purchase_buyer === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                          <option value="17 คัน" {{ ($data->Purchase_buyer === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                          <option value="18 คัน" {{ ($data->Purchase_buyer === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                          <option value="19 คัน" {{ ($data->Purchase_buyer === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                          <option value="20 คัน" {{ ($data->Purchase_buyer === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                        </select>
                                        <label>ค้ำ : </label>
                                        <select name="Supportbuyer" class="form-control" style="width: 108px;">
                                          <option value="" selected>--- ค้ำ ---</option>
                                          <option value="0 คัน" {{ ($data->Support_buyer === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                          <option value="1 คัน" {{ ($data->Support_buyer === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                          <option value="2 คัน" {{ ($data->Support_buyer === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                          <option value="3 คัน" {{ ($data->Support_buyer === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                          <option value="4 คัน" {{ ($data->Support_buyer === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                          <option value="5 คัน" {{ ($data->Support_buyer === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                          <option value="6 คัน" {{ ($data->Support_buyer === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                          <option value="7 คัน" {{ ($data->Support_buyer === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                          <option value="8 คัน" {{ ($data->Support_buyer === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                          <option value="9 คัน" {{ ($data->Support_buyer === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                          <option value="10 คัน" {{ ($data->Support_buyer === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                          <option value="11 คัน" {{ ($data->Support_buyer === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                          <option value="12 คัน" {{ ($data->Support_buyer === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                          <option value="13 คัน" {{ ($data->Support_buyer === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                          <option value="14 คัน" {{ ($data->Support_buyer === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                          <option value="15 คัน" {{ ($data->Support_buyer === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                          <option value="16 คัน" {{ ($data->Support_buyer === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                          <option value="17 คัน" {{ ($data->Support_buyer === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                          <option value="18 คัน" {{ ($data->Support_buyer === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                          <option value="19 คัน" {{ ($data->Support_buyer === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                          <option value="20 คัน" {{ ($data->Support_buyer === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                        </select>
                                      @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รายได้หลังหักค่าใช้จ่าย : </label>
                                      @if($data == null)
                                        <input type="text" id="Afterincome" name="Afterincome" class="form-control" style="width: 250px;" placeholder="หลังหักค่าใช้จ่าย" oninput="income();" maxlength="9" />
                                      @else
                                        <input type="text" id="Afterincome" name="Afterincome" value="{{ number_format($data->AfterIncome_buyer,0) }}" class="form-control" style="width: 250px;" placeholder="ก่อนหักค่าใช้จ่าย" oninput="income();" maxlength="9"/>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สถานะผู้เช่าซื้อ : </label>
                                      @if($data == null)
                                        <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                          <option value="ลูกค้าเก่าผ่อนดี">ลูกค้าเก่าผ่อนดี</option>
                                          <option value="ลูกค้ามีงานตาม">ลูกค้ามีงานตาม</option>
                                          <option value="ลูกค้าใหม่">ลูกค้าใหม่</option>
                                          <option value="ลูกค้าใหม่(ปิดธนาคาร)">ลูกค้าใหม่(ปิดธนาคาร)</option>
                                          <option value="ปิดจัดใหม่(งานตาม)">ปิดจัดใหม่(งานตาม)</option>
                                          <option value="ปิดจัดใหม่(ผ่อนดี)">ปิดจัดใหม่(ผ่อนดี)</option>
                                        </select>
                                      @else
                                        <select name="Gradebuyer" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- สถานะผู้เช่าซื้อ ---</option>
                                          <option value="ลูกค้าเก่าผ่อนดี" {{ ($data->Gradebuyer_car === 'ลูกค้าเก่าผ่อนดี') ? 'selected' : '' }}>ลูกค้าเก่าผ่อนดี</option>
                                          <option value="ลูกค้ามีงานตาม" {{ ($data->Gradebuyer_car === 'ลูกค้ามีงานตาม') ? 'selected' : '' }}>ลูกค้ามีงานตาม</option>
                                          <option value="ลูกค้าใหม่" {{ ($data->Gradebuyer_car === 'ลูกค้าใหม่') ? 'selected' : '' }}>ลูกค้าใหม่</option>
                                          <option value="ลูกค้าใหม่(ปิดธนาคาร)" {{ ($data->Gradebuyer_car === 'ลูกค้าใหม่(ปิดธนาคาร)') ? 'selected' : '' }}>ลูกค้าใหม่(ปิดธนาคาร)</option>
                                          <option value="ปิดจัดใหม่(งานตาม)" {{ ($data->Gradebuyer_car === 'ปิดจัดใหม่(งานตาม)') ? 'selected' : '' }}>ปิดจัดใหม่(งานตาม)</option>
                                          <option value="ปิดจัดใหม่(ผ่อนดี)" {{ ($data->Gradebuyer_car === 'ปิดจัดใหม่(ผ่อนดี)') ? 'selected' : '' }}>ปิดจัดใหม่(ผ่อนดี)</option>
                                        </select>
                                      @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>วัตถุประสงค์ของสินเชื่อ : </label>
                                      @if($data == null)
                                        <select name="objectivecar" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                          <option value="ลงทุนในธุรกิจ">ลงทุนในธุรกิจ</option>
                                          <option value="ขยายกิจการ">ขยายกิจการ</option>
                                          <option value="ซื้อรถยนต์">ซื้อรถยนต์</option>
                                          <option value="ใช้หนี้นอกระบบ">ใช้หนี้นอกระบบ</option>
                                          <option value="จ่ายค่าเทอม">จ่ายค่าเทอม</option>
                                          <option value="ซื้อของใช้ภายในบ้าน">ซื้อของใช้ภายในบ้าน</option>
                                          <option value="ซื้อวัว">ซื้อวัว</option>
                                          <option value="ซื้อที่ดิน">ซื้อที่ดิน</option>
                                          <option value="ซ่อมบ้าน">ซ่อมบ้าน</option>
                                        </select>
                                      @else
                                        <select name="objectivecar" class="form-control" style="width: 250px;">
                                          <option value="" selected>--- วัตถุประสงค์ของสินเชื่อ ---</option>
                                          <option value="ลงทุนในธุรกิจ" {{ ($data->Objective_car === 'ลงทุนในธุรกิจ') ? 'selected' : '' }}>ลงทุนในธุรกิจ</option>
                                          <option value="ขยายกิจการ" {{ ($data->Objective_car === 'ขยายกิจการ') ? 'selected' : '' }}>ขยายกิจการ</option>
                                          <option value="ซื้อรถยนต์" {{ ($data->Objective_car === 'ซื้อรถยนต์') ? 'selected' : '' }}>ซื้อรถยนต์</option>
                                          <option value="ใช้หนี้นอกระบบ" {{ ($data->Objective_car === 'ใช้หนี้นอกระบบ') ? 'selected' : '' }}>ใช้หนี้นอกระบบ</option>
                                          <option value="จ่ายค่าเทอม" {{ ($data->Objective_car === 'จ่ายค่าเทอม') ? 'selected' : '' }}>จ่ายค่าเทอม</option>
                                          <option value="ซื้อของใช้ภายในบ้าน" {{ ($data->Objective_car === 'ซื้อของใช้ภายในบ้าน') ? 'selected' : '' }}>ซื้อของใช้ภายในบ้าน</option>
                                          <option value="ซื้อวัว" {{ ($data->Objective_car === 'ซื้อวัว') ? 'selected' : '' }}>ซื้อวัว</option>
                                          <option value="ซื้อที่ดิน" {{ ($data->Objective_car === 'ซื้อที่ดิน') ? 'selected' : '' }}>ซื้อที่ดิน</option>
                                          <option value="ซ่อมบ้าน" {{ ($data->Objective_car === 'ซ่อมบ้าน') ? 'selected' : '' }}>ซ่อมบ้าน</option>
                                        </select>
                                      @endif
                                   </div>
                                  </div>
                                </div>

                                <hr>
                                <div class="row">
                                  <div class="col-md-12">
                                    <h3 class="text-center">รูปภาพประกอบ</h3>
                                    <div class="form-group">
                                      <div class="file-loading">
                                        <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                {{--
                                  @if($dataImage != null)
                                    <br/>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        @foreach($dataImage as $images)
                                        <div class="col-sm-3">
                                          <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier; variableZoom: true" style="width: 300px; height: auto;">
                                            <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}">
                                          </a>
                                        </div>
                                        @endforeach
                                      </div>
                                    </div>
                                  @endif
                                --}}

                              </div>
                              <div class="tab-pane" id="tab_2">
                                <a class="btn btn-default pull-right" title="เพิ่มข้อมูลผู้ค้ำที่ 2" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                                  <i class="fa fa-users fa-lg"></i>
                                </a>
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดผู้ค้ำ</h3>
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อ : </label>
                                       @if($data == null)
                                         <input type="text" name="nameSP" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                       @else
                                         <input type="text" name="nameSP" value="{{$data->name_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อ" />
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>นามสกุล : </label>
                                       @if($data == null)
                                         <input type="text" name="lnameSP" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                       @else
                                         <input type="text" name="lnameSP" value="{{$data->lname_SP}}" class="form-control" style="width: 250px;" placeholder="นามสกุล" />
                                       @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อเล่น : </label>
                                       @if($data == null)
                                         <input type="text" name="niknameSP" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                       @else
                                         <input type="text" name="niknameSP" value="{{$data->nikname_SP}}" class="form-control" style="width: 250px;" placeholder="ชื่อเล่น" />
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานะ : </label>
                                       @if($data == null)
                                         <select name="statusSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- สถานะ ---</option>
                                           <option value="โสด">โสด</option>
                                           <option value="สมรส">สมรส</option>
                                           <option value="หย่าร้าง">หย่าร้าง</option>
                                           <option value="เสียชีวิต">เสียชีวิต</option>
                                         </select>
                                       @else
                                         <select name="statusSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- สถานะ ---</option>
                                           <option value="โสด" {{ ($data->status_SP === 'โสด') ? 'selected' : '' }}>โสด</option>
                                           <option value="สมรส" {{ ($data->status_SP === 'สมรส') ? 'selected' : '' }}>สมรส</option>
                                           <option value="หย่าร้าง" {{ ($data->status_SP === 'หย่าร้าง') ? 'selected' : '' }}>หย่าร้าง</option>
                                           <option value="เสียชีวิต" {{ ($data->status_SP === 'เสียชีวิต') ? 'selected' : '' }}>เสียชีวิต</option>
                                         </select>
                                       @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>เบอร์โทร : </label>
                                       @if($data == null)
                                         <input type="text" name="telSP" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                       @else
                                         <input type="text" name="telSP" value="{{$data->tel_SP}}" class="form-control" style="width: 250px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ความสัมพันธ์ : </label>
                                       @if($data == null)
                                         <select name="relationSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ความสัมพันธ์ ---</option>
                                           <option value="พี่น้อง">พี่น้อง</option>
                                           <option value="ญาติ">ญาติ</option>
                                           <option value="เพื่อน">เพื่อน</option>
                                           <option value="บิดา">บิดา</option>
                                           <option value="มารดา">มารดา</option>
                                           <option value="ตำบลเดี่ยวกัน">ตำบลเดี่ยวกัน</option>
                                           <option value="จ้างค้ำ(ไม่รู้จักกัน)">จ้างค้ำ(ไม่รู้จักกัน)</option>
                                         </select>
                                       @else
                                         <select name="relationSP" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ความสัมพันธ์ ---</option>
                                           <option value="พี่น้อง" {{ ($data->relation_SP === 'พี่น้อง') ? 'selected' : '' }}>พี่น้อง</option>
                                           <option value="ญาติ" {{ ($data->relation_SP === 'ญาติ') ? 'selected' : '' }}>ญาติ</option>
                                           <option value="เพื่อน" {{ ($data->relation_SP === 'เพื่อน') ? 'selected' : '' }}>เพื่อน</option>
                                           <option value="บิดา" {{ ($data->relation_SP === 'บิดา') ? 'selected' : '' }}>บิดา</option>
                                           <option value="มารดา" {{ ($data->relation_SP === 'มารดา') ? 'selected' : '' }}>มารดา</option>
                                           <option value="ตำบลเดี่ยวกัน" {{ ($data->relation_SP === 'ตำบลเดี่ยวกัน') ? 'selected' : '' }}>ตำบลเดี่ยวกัน</option>
                                           <option value="จ้างค้ำ(ไม่รู้จักกัน)" {{ ($data->relation_SP === 'จ้างค้ำ(ไม่รู้จักกัน)') ? 'selected' : '' }}>จ้างค้ำ(ไม่รู้จักกัน)</option>
                                         </select>
                                       @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คู่สมรส : </label>
                                       @if($data == null)
                                         <input type="text" name="mateSP" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                       @else
                                         <input type="text" name="mateSP" value="{{$data->mate_SP}}" class="form-control" style="width: 250px;" placeholder="คู่สมรส" />
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขบัตรประชาชน : </label>
                                       @if($data == null)
                                         <input type="text" name="idcardSP" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                       @else
                                         <input type="text" name="idcardSP" value="{{$data->idcard_SP}}" class="form-control" style="width: 250px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask=""/>
                                       @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ที่อยู่ : </label>
                                         @if($data == null)
                                           <select name="addSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- ที่อยู่ ---</option>
                                             <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                           </select>
                                         @else
                                           <select name="addSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- ที่อยู่ ---</option>
                                             <option value="ตามทะเบียนบ้าน" {{ ($data->add_SP === 'ตามทะเบียนบ้าน') ? 'selected' : '' }}>ตามทะเบียนบ้าน</option>
                                           </select>
                                         @endif
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                         @if($data == null)
                                           <input type="text" name="addnowSP" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                         @else
                                           <input type="text" name="addnowSP" value="{{$data->addnow_SP}}" class="form-control" style="width: 250px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                         @endif
                                     </div>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>รายละเอียดที่อยู่ : </label>
                                       @if($data == null)
                                         <input type="text" name="statusaddSP" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                       @else
                                         <input type="text" name="statusaddSP" value="{{$data->statusadd_SP}}" class="form-control" style="width: 250px;" placeholder="รายละเอียดที่อยู่" />
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานที่ทำงาน : </label>
                                       @if($data == null)
                                         <input type="text" name="workplaceSP" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                                       @else
                                         <input type="text" name="workplaceSP" value="{{$data->workplace_SP}}" class="form-control" style="width: 250px;" placeholder="สถานที่ทำงาน" />
                                       @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ลักษณะบ้าน : </label>
                                         @if($data == null)
                                           <select name="houseSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                             <option value="บ้านตึก 1 ชั้น">บ้านตึก 1 ชั้น</option>
                                             <option value="บ้านตึก 2 ชั้น">บ้านตึก 2 ชั้น</option>
                                             <option value="บ้านไม้ 1 ชั้น">บ้านไม้ 1 ชั้น</option>
                                             <option value="บ้านไม้ 2 ชั้น">บ้านไม้ 2 ชั้น</option>
                                             <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                             <option value="แฟลต">แฟลต</option>
                                           </select>
                                         @else
                                           <select name="houseSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                             <option value="บ้านตึก 1 ชั้น" {{ ($data->house_SP === 'บ้านตึก 1 ชั้น') ? 'selected' : '' }}>บ้านตึก 1 ชั้น</option>
                                             <option value="บ้านตึก 2 ชั้น" {{ ($data->house_SP === 'บ้านตึก 2 ชั้น') ? 'selected' : '' }}>บ้านตึก 2 ชั้น</option>
                                             <option value="บ้านไม้ 1 ชั้น" {{ ($data->house_SP === 'บ้านไม้ 1 ชั้น') ? 'selected' : '' }}>บ้านไม้ 1 ชั้น</option>
                                             <option value="บ้านไม้ 2 ชั้น" {{ ($data->house_SP === 'บ้านไม้ 2 ชั้น') ? 'selected' : '' }}>บ้านไม้ 2 ชั้น</option>
                                             <option value="บ้านเดี่ยว" {{ ($data->house_SP === 'บ้านเดี่ยว') ? 'selected' : '' }}>บ้านเดี่ยว</option>
                                             <option value="แฟลต" {{ ($data->house_SP === 'แฟลต') ? 'selected' : '' }}>แฟลต</option>
                                           </select>
                                         @endif
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทหลักทรัพย์ : </label>
                                          @if($data == null)
                                            <select name="securitiesSP" class="form-control" style="width: 250px;">
                                              <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                              <option value="โฉนด">โฉนด</option>
                                              <option value="นส.3">นส.3</option>
                                              <option value="นส.3 ก">นส.3 ก</option>
                                              <option value="นส.4">นส.4</option>
                                              <option value="นส.4 จ">นส.4 จ</option>
                                            </select>
                                          @else
                                            <select name="securitiesSP" class="form-control" style="width: 250px;">
                                              <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                              <option value="โฉนด" {{ ($data->securities_SP === 'โฉนด') ? 'selected' : '' }}>โฉนด</option>
                                              <option value="นส.3" {{ ($data->securities_SP === 'นส.3') ? 'selected' : '' }}>นส.3</option>
                                              <option value="นส.3 ก" {{ ($data->securities_SP === 'นส.3 ก') ? 'selected' : '' }}>นส.3 ก</option>
                                              <option value="นส.4" {{ ($data->securities_SP === 'นส.4') ? 'selected' : '' }}>นส.4</option>
                                              <option value="นส.4 จ" {{ ($data->securities_SP === 'นส.4 จ') ? 'selected' : '' }}>นส.4 จ</option>
                                            </select>
                                          @endif
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>เลขที่โฉนด : </label>
                                          @if($data == null)
                                            <input type="text" name="deednumberSP" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                          @else
                                            <input type="text" name="deednumberSP" value="{{$data->deednumber_SP}}" class="form-control" style="width: 250px;" placeholder="เลขที่โฉนด" />
                                          @endif
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>เนื้อที่ : </label>
                                         @if($data == null)
                                           <input type="text" name="areaSP" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                         @else
                                           <input type="text" name="areaSP" value="{{$data->area_SP}}" class="form-control" style="width: 250px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                         @endif
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทบ้าน : </label>
                                          @if($data == null)
                                            <select name="housestyleSP" class="form-control" style="width: 250px;">
                                              <option value="" selected>--- ประเภทบ้าน ---</option>
                                              <option value="ของตนเอง">ของตนเอง</option>
                                              <option value="อาศัยบิดา">อาศัยบิดา-มารดา</option>
                                              <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                              <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                              <option value="บ้านเช่า">บ้านเช่า</option>
                                            </select>
                                          @else
                                            <select name="housestyleSP" class="form-control" style="width: 250px;">
                                              <option value="" selected>--- ประเภทบ้าน ---</option>
                                              <option value="ของตนเอง" {{ ($data->housestyle_SP === 'ของตนเอง') ? 'selected' : '' }}>ของตนเอง</option>
                                              <option value="อาศัยบิดา-มารดา" {{ ($data->housestyle_SP === 'อาศัยบิดา-มารดา') ? 'selected' : '' }}>อาศัยบิดา-มารดา</option>
                                              <option value="อาศัยผู้อื่น" {{ ($data->housestyle_SP === 'อาศัยผู้อื่น') ? 'selected' : '' }}>อาศัยผู้อื่น</option>
                                              <option value="บ้านพักราชการ" {{ ($data->housestyle_SP === 'บ้านพักราชการ') ? 'selected' : '' }}>บ้านพักราชการ</option>
                                              <option value="บ้านเช่า" {{ ($data->housestyle_SP === 'บ้านเช่า') ? 'selected' : '' }}>บ้านเช่า</option>
                                            </select>
                                          @endif
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>อาชีพ : </label>
                                         @if($data == null)
                                           <select name="careerSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- อาชีพ ---</option>
                                             <option value="ตำรวจ">ตำรวจ</option>
                                             <option value="ทหาร">ทหาร</option>
                                             <option value="ครู">ครู</option>
                                             <option value="ข้าราชการอื่น">ข้าราชการอื่น</option>
                                             <option value="ลูกจ้างเทศบาล">ลูกจ้างเทศบาล</option>
                                             <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                             <option value="สมาชิก อบต.">สมาชิก อบต.</option>
                                             <option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
                                             <option value="รับจ้าง">รับจ้าง</option>
                                             <option value="พนักงานบริษัทเอกชน">พนักงานบริษัทเอกชน</option>
                                             <option value="อาชีพอิสระ">อาชีพอิสระ</option>
                                             <option value="กำนัน">กำนัน</option>
                                             <option value="ผู้ใหญ่บ้าน">ผู้ใหญ่บ้าน</option>
                                             <option value="ผู้ช่วยผู้ใหญ่บ้าน">ผู้ช่วยผู้ใหญ่บ้าน</option>
                                             <option value="นักการภารโรง">นักการภารโรง</option>
                                             <option value="มอเตอร์ไซร์รับจ้าง">มอเตอร์ไซร์รับจ้าง</option>
                                             <option value="ค้าขาย">ค้าขาย</option>
                                             <option value="เจ้าของธุรกิจ">เจ้าของธุรกิจ</option>
                                             <option value="เจ้าของอู่รถ">เจ้าของอู่รถ</option>
                                             <option value="ให้เช่ารถบรรทุก">ให้เช่ารถบรรทุก</option>
                                             <option value="ช่างตัดผม">ช่างตัดผม</option>
                                             <option value="ชาวนา">ชาวนา</option>
                                             <option value="ชาวไร่">ชาวไร่</option>
                                             <option value="แม่บ้าน">แม่บ้าน</option>
                                             <option value="รับเหมาก่อสร้าง">รับเหมาก่อสร้าง</option>
                                             <option value="ประมง">ประมง</option>
                                             <option value="ทนายความ">ทนายความ</option>
                                             <option value="พระ">พระ</option>
                                           </select>
                                         @else
                                           <select name="careerSP" class="form-control" style="width: 250px;">
                                             <option value="" selected>--- อาชีพ ---</option>
                                             <option value="ตำรวจ" {{ ($data->career_SP === 'ตำรวจ') ? 'selected' : '' }}>ตำรวจ</option>
                                             <option value="ทหาร" {{ ($data->career_SP === 'ทหาร') ? 'selected' : '' }}>ทหาร</option>
                                             <option value="ครู" {{ ($data->career_SP === 'ครู') ? 'selected' : '' }}>ครู</option>
                                             <option value="ข้าราชการอื่นๆ" {{ ($data->career_SP === 'ข้าราชการอื่นๆ') ? 'selected' : '' }}>ข้าราชการอื่นๆ</option>
                                             <option value="ลูกจ้างเทศบาล" {{ ($data->career_SP === 'ลูกจ้างเทศบาล') ? 'selected' : '' }}>ลูกจ้างเทศบาล</option>
                                             <option value="ลูกจ้างประจำ" {{ ($data->career_SP === 'ลูกจ้างประจำ') ? 'selected' : '' }}>ลูกจ้างประจำ</option>
                                             <option value="สมาชิก อบต." {{ ($data->career_SP === 'สมาชิก อบต.') ? 'selected' : '' }}>สมาชิก อบต.</option>
                                             <option value="ลูกจ้างชั่วคราว" {{ ($data->career_SP === 'ลูกจ้างชั่วคราว') ? 'selected' : '' }}>ลูกจ้างชั่วคราว</option>
                                             <option value="รับจ้าง" {{ ($data->career_SP === 'รับจ้าง') ? 'selected' : '' }}>รับจ้าง</option>
                                             <option value="พนักงานบริษัทเอกชน" {{ ($data->career_SP === 'พนักงานบริษัทเอกชน') ? 'selected' : '' }}>พนักงานบริษัทเอกชน</option>
                                             <option value="อาชีพอิสระ" {{ ($data->career_SP === 'อาชีพอิสระ') ? 'selected' : '' }}>อาชีพอิสระ</option>
                                             <option value="กำนัน" {{ ($data->career_SP === 'กำนัน') ? 'selected' : '' }}>กำนัน</option>
                                             <option value="ผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ใหญ่บ้าน</option>
                                             <option value="ผู้ช่วยผู้ใหญ่บ้าน" {{ ($data->career_SP === 'ผู้ช่วยผู้ใหญ่บ้าน') ? 'selected' : '' }}>ผู้ช่วยผู้ใหญ่บ้าน</option>
                                             <option value="นักการภารโรง" {{ ($data->career_SP === 'นักการภารโรง') ? 'selected' : '' }}>นักการภารโรง</option>
                                             <option value="มอเตอร์ไซร์รับจ้าง" {{ ($data->career_SP === 'มอเตอร์ไซร์รับจ้าง') ? 'selected' : '' }}>มอเตอร์ไซร์รับจ้าง</option>
                                             <option value="ค้าขาย" {{ ($data->career_SP === 'ค้าขาย') ? 'selected' : '' }}>ค้าขาย</option>
                                             <option value="เจ้าของธุรกิจ" {{ ($data->career_SP === 'เจ้าของธุรกิจ') ? 'selected' : '' }}>เจ้าของธุรกิจ</option>
                                             <option value="เจ้าของอู่รถ" {{ ($data->career_SP === 'เจ้าของอู่รถ') ? 'selected' : '' }}>เจ้าของอู่รถ</option>
                                             <option value="ให้เช่ารถบรรทุก" {{ ($data->career_SP === 'ให้เช่ารถบรรทุก') ? 'selected' : '' }}>ให้เช่ารถบรรทุก</option>
                                             <option value="ช่างตัดผม" {{ ($data->career_SP === 'ช่างตัดผม') ? 'selected' : '' }}>ช่างตัดผม</option>
                                             <option value="ชาวนา" {{ ($data->career_SP === 'ชาวนา') ? 'selected' : '' }}>ชาวนา</option>
                                             <option value="ชาวไร่" {{ ($data->career_SP === 'ชาวไร่') ? 'selected' : '' }}>ชาวไร่</option>
                                             <option value="แม่บ้าน" {{ ($data->career_SP === 'แม่บ้าน') ? 'selected' : '' }}>แม่บ้าน</option>
                                             <option value="รับเหมาก่อสร้าง" {{ ($data->career_SP === 'รับเหมาก่อสร้าง') ? 'selected' : '' }}>รับเหมาก่อสร้าง</option>
                                             <option value="ประมง" {{ ($data->career_SP === 'ประมง') ? 'selected' : '' }}>ประมง</option>
                                             <option value="ทนายความ" {{ ($data->career_SP === 'ทนายความ') ? 'selected' : '' }}>ทนายความ</option>
                                             <option value="พระ" {{ ($data->career_SP === 'พระ') ? 'selected' : '' }}>พระ</option>
                                           </select>
                                         @endif
                                       </div>
                                    </div>
                                  </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                        <label>รายได้ : </label>
                                        @if($data == null)
                                          <select name="incomeSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- รายได้ ---</option>
                                            <option value="5,000 - 10,000">5,000 - 10,000</option>
                                            <option value="10,000 - 15,000">10,000 - 15,000</option>
                                            <option value="15,000 - 20,000">15,000 - 20,000</option>
                                            <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                          </select>
                                        @else
                                          <select name="incomeSP" class="form-control" style="width: 250px;">
                                            <option value="" selected>--- รายได้ ---</option>
                                            <option value="5,000 - 10,000" {{ ($data->income_SP === '5,000 - 10,000') ? 'selected' : '' }}>5,000 - 10,000</option>
                                            <option value="10,000 - 15,000" {{ ($data->income_SP === '10,000 - 15,000') ? 'selected' : '' }}>10,000 - 15,000</option>
                                            <option value="15,000 - 20,000" {{ ($data->income_SP === '15,000 - 20,000') ? 'selected' : '' }}>15,000 - 20,000</option>
                                            <option value="มากกว่า 20,000" {{ ($data->income_SP === 'มากกว่า 20,000') ? 'selected' : '' }}>มากกว่า 20,000</option>
                                          </select>
                                        @endif
                                    </div>
                                    </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ประวัติซื้อ/ค้ำ : </label>
                                       @if($data == null)
                                         <select name="puchaseSP" class="form-control" style="width: 108px;">
                                           <option value="" selected>--- ซื้อ ---</option>
                                           <option value="0 คัน">0 คัน</option>
                                           <option value="1 คัน">1 คัน</option>
                                           <option value="2 คัน">2 คัน</option>
                                           <option value="3 คัน">3 คัน</option>
                                           <option value="4 คัน">4 คัน</option>
                                           <option value="5 คัน">5 คัน</option>
                                           <option value="6 คัน">6 คัน</option>
                                           <option value="7 คัน">7 คัน</option>
                                           <option value="8 คัน">8 คัน</option>
                                           <option value="9 คัน">9 คัน</option>
                                           <option value="10 คัน">10 คัน</option>
                                           <option value="11 คัน">11 คัน</option>
                                           <option value="12 คัน">12 คัน</option>
                                           <option value="13 คัน">13 คัน</option>
                                           <option value="14 คัน">14 คัน</option>
                                           <option value="15 คัน">15 คัน</option>
                                           <option value="16 คัน">16 คัน</option>
                                           <option value="17 คัน">17 คัน</option>
                                           <option value="18 คัน">18 คัน</option>
                                           <option value="19 คัน">19 คัน</option>
                                           <option value="20 คัน">20 คัน</option>
                                         </select>
                                         <label>ค้ำ : </label>
                                         <select name="supportSP" class="form-control" style="width: 108px;">
                                            <option value="" selected>--- ค้ำ ---</option>
                                            <option value="0 คัน">0 คัน</option>
                                            <option value="1 คัน">1 คัน</option>
                                            <option value="2 คัน">2 คัน</option>
                                            <option value="3 คัน">3 คัน</option>
                                            <option value="4 คัน">4 คัน</option>
                                            <option value="5 คัน">5 คัน</option>
                                            <option value="6 คัน">6 คัน</option>
                                            <option value="7 คัน">7 คัน</option>
                                            <option value="8 คัน">8 คัน</option>
                                            <option value="9 คัน">9 คัน</option>
                                            <option value="10 คัน">10 คัน</option>
                                            <option value="11 คัน">11 คัน</option>
                                            <option value="12 คัน">12 คัน</option>
                                            <option value="13 คัน">13 คัน</option>
                                            <option value="14 คัน">14 คัน</option>
                                            <option value="15 คัน">15 คัน</option>
                                            <option value="16 คัน">16 คัน</option>
                                            <option value="17 คัน">17 คัน</option>
                                            <option value="18 คัน">18 คัน</option>
                                            <option value="19 คัน">19 คัน</option>
                                            <option value="20 คัน">20 คัน</option>
                                         </select>
                                       @else
                                         <select name="puchaseSP" class="form-control" style="width: 108px;">
                                           <option value="" selected>--- ซื้อ ---</option>
                                           <option value="0 คัน" {{ ($data->puchase_SP === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                           <option value="1 คัน" {{ ($data->puchase_SP === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                           <option value="2 คัน" {{ ($data->puchase_SP === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                           <option value="3 คัน" {{ ($data->puchase_SP === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                           <option value="4 คัน" {{ ($data->puchase_SP === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                           <option value="5 คัน" {{ ($data->puchase_SP === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                           <option value="6 คัน" {{ ($data->puchase_SP === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                           <option value="7 คัน" {{ ($data->puchase_SP === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                           <option value="8 คัน" {{ ($data->puchase_SP === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                           <option value="9 คัน" {{ ($data->puchase_SP === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                           <option value="10 คัน" {{ ($data->puchase_SP === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                           <option value="11 คัน" {{ ($data->puchase_SP === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                           <option value="12 คัน" {{ ($data->puchase_SP === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                           <option value="13 คัน" {{ ($data->puchase_SP === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                           <option value="14 คัน" {{ ($data->puchase_SP === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                           <option value="15 คัน" {{ ($data->puchase_SP === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                           <option value="16 คัน" {{ ($data->puchase_SP === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                           <option value="17 คัน" {{ ($data->puchase_SP === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                           <option value="18 คัน" {{ ($data->puchase_SP === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                           <option value="19 คัน" {{ ($data->puchase_SP === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                           <option value="20 คัน" {{ ($data->puchase_SP === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                         </select>
                                         <label>ค้ำ : </label>
                                         <select name="supportSP" class="form-control" style="width: 108px;">
                                            <option value="" selected>--- ค้ำ ---</option>
                                            <option value="0 คัน" {{ ($data->support_SP === '0 คัน') ? 'selected' : '' }}>0 คัน</option>
                                            <option value="1 คัน" {{ ($data->support_SP === '1 คัน') ? 'selected' : '' }}>1 คัน</option>
                                            <option value="2 คัน" {{ ($data->support_SP === '2 คัน') ? 'selected' : '' }}>2 คัน</option>
                                            <option value="3 คัน" {{ ($data->support_SP === '3 คัน') ? 'selected' : '' }}>3 คัน</option>
                                            <option value="4 คัน" {{ ($data->support_SP === '4 คัน') ? 'selected' : '' }}>4 คัน</option>
                                            <option value="5 คัน" {{ ($data->support_SP === '5 คัน') ? 'selected' : '' }}>5 คัน</option>
                                            <option value="6 คัน" {{ ($data->support_SP === '6 คัน') ? 'selected' : '' }}>6 คัน</option>
                                            <option value="7 คัน" {{ ($data->support_SP === '7 คัน') ? 'selected' : '' }}>7 คัน</option>
                                            <option value="8 คัน" {{ ($data->support_SP === '8 คัน') ? 'selected' : '' }}>8 คัน</option>
                                            <option value="9 คัน" {{ ($data->support_SP === '9 คัน') ? 'selected' : '' }}>9 คัน</option>
                                            <option value="10 คัน" {{ ($data->support_SP === '10 คัน') ? 'selected' : '' }}>10 คัน</option>
                                            <option value="11 คัน" {{ ($data->support_SP === '11 คัน') ? 'selected' : '' }}>11 คัน</option>
                                            <option value="12 คัน" {{ ($data->support_SP === '12 คัน') ? 'selected' : '' }}>12 คัน</option>
                                            <option value="13 คัน" {{ ($data->support_SP === '13 คัน') ? 'selected' : '' }}>13 คัน</option>
                                            <option value="14 คัน" {{ ($data->support_SP === '14 คัน') ? 'selected' : '' }}>14 คัน</option>
                                            <option value="15 คัน" {{ ($data->support_SP === '15 คัน') ? 'selected' : '' }}>15 คัน</option>
                                            <option value="16 คัน" {{ ($data->support_SP === '16 คัน') ? 'selected' : '' }}>16 คัน</option>
                                            <option value="17 คัน" {{ ($data->support_SP === '17 คัน') ? 'selected' : '' }}>17 คัน</option>
                                            <option value="18 คัน" {{ ($data->support_SP === '18 คัน') ? 'selected' : '' }}>18 คัน</option>
                                            <option value="19 คัน" {{ ($data->support_SP === '19 คัน') ? 'selected' : '' }}>19 คัน</option>
                                            <option value="20 คัน" {{ ($data->support_SP === '20 คัน') ? 'selected' : '' }}>20 คัน</option>
                                         </select>
                                       @endif
                                     </div>
                                   </div>
                                </div>
                              </div>
                              <div class="tab-pane" id="tab_3">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดรถยนต์</h3>
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ยี่ห้อ : </label>
                                       @if($data == null)
                                         <select name="Brandcar" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ยี่ห้อ ---</option>
                                           <option value="ISUZU">ISUZU</option>
                                           <option value="MITSUBISHI">MITSUBISHI</option>
                                           <option value="TOYOTA">TOYOTA</option>
                                           <option value="MAZDA">MAZDA</option>
                                           <option value="FORD">FORD</option>
                                           <option value="NISSAN">NISSAN</option>
                                           <option value="HONDA">HONDA</option>
                                           <option value="CHEVROLET">CHEVROLET</option>
                                           <option value="MG">MG</option>
                                           <option value="SUZUKI">SUZUKI</option>
                                         </select>
                                       @else
                                         <select name="Brandcar" class="form-control" style="width: 250px;">
                                           <option value="" selected>--- ยี่ห้อ ---</option>
                                           <option value="ISUZU" {{ ($data->Brand_car === 'ISUZU') ? 'selected' : '' }}>ISUZU</option>
                                           <option value="MITSUBISHI" {{ ($data->Brand_car === 'MITSUBISHI') ? 'selected' : '' }}>MITSUBISHI</option>
                                           <option value="TOYOTA" {{ ($data->Brand_car === 'TOYOTA') ? 'selected' : '' }}>TOYOTA</option>
                                           <option value="MAZDA" {{ ($data->Brand_car === 'MAZDA') ? 'selected' : '' }}>MAZDA</option>
                                           <option value="FORD" {{ ($data->Brand_car === 'FORD') ? 'selected' : '' }}>FORD</option>
                                           <option value="NISSAN" {{ ($data->Brand_car === 'NISSAN') ? 'selected' : '' }}>NISSAN</option>
                                           <option value="HONDA" {{ ($data->Brand_car === 'HONDA') ? 'selected' : '' }}>HONDA</option>
                                           <option value="CHEVROLET" {{ ($data->Brand_car === 'CHEVROLET') ? 'selected' : '' }}>CHEVROLET</option>
                                           <option value="MG" {{ ($data->Brand_car === 'MG') ? 'selected' : '' }}>MG</option>
                                           <option value="SUZUKI" {{ ($data->Brand_car === 'SUZUKI') ? 'selected' : '' }}>SUZUKI</option>
                                         </select>
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ประเภทรถ : </label>
                                     @if($data == null)
                                       <select id="Typecardetail" name="Typecardetail" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ประเภทรถ ---</option>
                                         <option value="รถกระบะ">รถกระบะ</option>
                                         <option value="รถตอนเดียว">รถตอนเดียว</option>
                                         <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                                       </select>
                                     @else
                                       <select id="Typecardetail" name="Typecardetail" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- ประเภทรถ ---</option>
                                         <option value="รถกระบะ" {{ ($data->Typecardetails === 'รถกระบะ') ? 'selected' : '' }}>รถกระบะ</option>
                                         <option value="รถตอนเดียว" {{ ($data->Typecardetails === 'รถตอนเดียว') ? 'selected' : '' }}>รถตอนเดียว</option>
                                         <option value="รถเก๋ง/7ที่นั่ง" {{ ($data->Typecardetails === 'รถเก๋ง/7ที่นั่ง') ? 'selected' : '' }}>รถเก๋ง/7ที่นั่ง</option>
                                       </select>
                                     @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>สี : </label>
                                       @if($data == null)
                                         <input type="text" name="Colourcar" class="form-control" style="width: 250px;" placeholder="สี" />
                                       @else
                                         <input type="text" name="Colourcar" value="{{ $data->Colour_car }}" class="form-control" style="width: 250px;" placeholder="สี" />
                                       @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ปี : </label>
                                     @if($data == null)
                                       <select id="Yearcar" name="Yearcar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกปี ---</option>
                                          @php
                                              $Year = date('Y');
                                          @endphp
                                          @for ($i = 0; $i < 20; $i++)
                                              <option value="{{ $Year }}">{{ $Year }}</option>
                                              @php
                                                  $Year -= 1;
                                              @endphp
                                          @endfor
                                       </select>
                                     @else
                                       <select id="Yearcar" name="Yearcar" class="form-control" style="width: 250px;" onchange="calculate();">
                                         <option value="{{$data->Year_car}}" selected>{{$data->Year_car}}</option>
                                         <option value="">--------------------</option>
                                          @php
                                              $Year = date('Y');
                                          @endphp
                                          @for ($i = 0; $i < 20; $i++)
                                              <option value="{{ $Year }}">{{ $Year }}</option>
                                              @php
                                                  $Year -= 1;
                                              @endphp
                                          @endfor
                                       </select>
                                     @endif
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ป้ายเดิม : </label>
                                      @if($data == null)
                                        <input type="text" name="Licensecar" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม"/>
                                      @else
                                        <input type="text" name="Licensecar"  value="{{ $data->License_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายเดิม" />
                                      @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <!-- <div class="form-inline" align="right">
                                     <label>กลุ่มปีรถยนต์ : </label>
                                     <input type="text" id="Groupyearcar" name="Groupyearcar" class="form-control" style="width: 250px;" onchange="calculate();"/>
                                   </div> -->
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ป้ายใหม่ : </label>
                                      @if($data == null)
                                        <input type="text" name="Nowlicensecar" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                                      @else
                                        <input type="text" name="Nowlicensecar" value="{{$data->Nowlicense_car}}" class="form-control" style="width: 250px;" placeholder="ป้ายใหม่" />
                                      @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เลขไมล์ : </label>
                                      <input type="text" id="Milecar" name="Milecar" class="form-control" style="width: 250px;" placeholder="เลขไมล์" oninput="mile();" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>รุ่น : </label>
                                      @if($data == null)
                                        <input type="text" name="Modelcar" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                      @else
                                        <input type="text" name="Modelcar" value="{{$data->Model_car}}" class="form-control" style="width: 250px;" placeholder="รุ่น" />
                                      @endif
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ราคากลาง : </label>
                                      <input type="text" id="Midpricecar" name="Midpricecar" class="form-control" style="width: 250px;" maxlength="9" placeholder="ราคากลาง" oninput="percent();" />
                                    </div>
                                  </div>
                                </div>

                                <hr />
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

                                    function income(){
                                      var num11 = document.getElementById('Beforeincome').value;
                                      var num1 = num11.replace(",","");
                                      var num22 = document.getElementById('Afterincome').value;
                                      var num2 = num22.replace(",","");
                                      document.form1.Beforeincome.value = addCommas(num1);
                                      document.form1.Afterincome.value = addCommas(num2);
                                    }

                                    function percent(){
                                      var num11 = document.getElementById('Midpricecar').value;
                                      var num1 = num11.replace(",","").replace(",","");
                                      var num22 = document.getElementById('Topcar').value;
                                      var num2 = num22.replace(",","");
                                      var percent = (num2/num1) * 100;
                                      if(!isNaN(percent) && num1 != ''){
                                        document.form1.Percentcar.value = percent.toFixed(0);
                                        document.form1.Midpricecar.value = addCommas(num1);
                                        document.form1.Topcar.value = addCommas(num2);
                                      }
                                    }

                                    function mile(){
                                      var num11 = document.getElementById('Milecar').value;
                                      var num1 = num11.replace(",","");
                                      document.form1.Milecar.value = addCommas(num1);
                                    }

                                    function calculate(){
                                      var num11 = document.getElementById('Topcar').value;
                                      var num1 = num11.replace(",","");
                                      var num4 = document.getElementById('Timeslackencar').value;
                                      var num2 = document.getElementById('Interestcar').value;
                                      var num3 = document.getElementById('Vatcar').value;

                                        if(num4 == '12'){
                                        var period = '1';
                                        }else if(num4 == '18'){
                                        var period = '1.5';
                                        }else if(num4 == '24'){
                                        var period = '2';
                                        }else if(num4 == '30'){
                                        var period = '2.5';
                                        }else if(num4 == '36'){
                                        var period = '3';
                                        }else if(num4 == '42'){
                                        var period = '3.5';
                                        }else if(num4 == '48'){
                                        var period = '4';
                                        }else if(num4 == '54'){
                                        var period = '4.5';
                                        }else if(num4 == '60'){
                                        var period = '5';
                                        }else if(num4 == '66'){
                                        var period = '5.5';
                                        }else if(num4 == '72'){
                                        var period = '6';
                                        }else if(num4 == '78'){
                                        var period = '6.5';
                                        }else if(num4 == '84'){
                                        var period = '7';
                                        }else if(num4 == '90'){
                                        var period = '7.5';
                                        }else if(num4 == '96'){
                                        var period = '8';
                                        }

                                      var totaltopcar = parseFloat(num1);
                                      var a = (num2*period)+100;
                                      var b = (((totaltopcar*a)/100)*1.07)/num4;
                                      var result = Math.ceil(b/10)*10;
                                      var durate = result/1.07;
                                      var durate2 = durate.toFixed(2)*num4;
                                      var tax = result-durate;
                                      var tax2 = tax.toFixed(2)*num4;
                                      var total = result*num4;
                                      var total2 = durate2+tax2;

                                      document.form1.Topcar.value = addCommas(totaltopcar);

                                      if(!isNaN(result) && num2 != ''){
                                        document.form1.Paycar.value = addCommas(result.toFixed(2));
                                        document.form1.Paymemtcar.value = addCommas(durate.toFixed(2));
                                        document.form1.Timepaymentcar.value = addCommas(durate2.toFixed(2));
                                        document.form1.Taxcar.value = addCommas(tax.toFixed(2));
                                        document.form1.Taxpaycar.value = addCommas(tax2.toFixed(2));
                                        document.form1.Totalpay1car.value = addCommas(total.toFixed(2));
                                        document.form1.Totalpay2car.value = addCommas(total2.toFixed(2));
                                      }
                                    }

                                    function commission(){
                                          var num11 = document.getElementById('Commissioncar').value;
                                          var num1 = num11.replace(",","");
                                          var input = document.getElementById('Agentcar').value;
                                          var Subtstr = input.split("");
                                          var Setstr = Subtstr[0];
                                          if (Setstr[0] == "*") {
                                          var result = num1;
                                          }else {
                                          if(num1 > 999){
                                          if(num11 == ''){
                                          var num11 = 0;
                                          }
                                          else{
                                          var sumCom = (num1*0.03);
                                          var result = num1 - sumCom;
                                          }
                                          }else{
                                          var result = num1;
                                          }
                                          }
                                          if(!isNaN(num1)){
                                          document.form1.Commissioncar.value = addCommas(num1);
                                          document.form1.commitPrice.value =  addCommas(result);
                                          }
                                        }

                                    function balance(){
                                          var num11 = document.getElementById('tranPrice').value;
                                          var num1 = num11.replace(",","");
                                          var num22 = document.getElementById('otherPrice').value;
                                          var num2 = num22.replace(",","");
                                          var num33 = document.getElementById('evaluetionPrice').value;
                                          var num3 = num33.replace(",","");
                                          if(num33 == ''){
                                          var num3 = 0;
                                          }
                                          var num44 = document.getElementById('dutyPrice').value;
                                          var num4 = num44.replace(",","");
                                          var num55 = document.getElementById('marketingPrice').value;
                                          var num5 = num55.replace(",","");
                                          var num66 = document.getElementById('actPrice').value;
                                          var num6 = num66.replace(",","");
                                          var num77 = document.getElementById('closeAccountPrice').value;
                                          var num7 = num77.replace(",","");
                                          var num88 = document.getElementById('P2Price').value;
                                          var num8 = num88.replace(",","");
                                          var temp = document.getElementById('Topcar').value;
                                          var toptemp = temp.replace(",","");
                                          var ori = document.getElementById('Topcar').value;
                                          var Topori = ori.replace(",","");

                                          if(num8 > 6900){
                                          var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                                          }else{
                                          var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
                                          }

                                          if(num8 > 6900){
                                          var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                                          }else {
                                          var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
                                          }

                                          if(num88 == 0){
                                          var TotalBalance = parseFloat(toptemp)-result;
                                          }
                                          else if(num8 > 6900){
                                          var TotalBalance = parseFloat(toptemp)-result;
                                          }
                                          else{
                                          var TotalBalance = parseFloat(toptemp)-result;
                                          }

                                          if(!isNaN(result)){
                                          document.form1.totalkPrice.value = addCommas(tempresult);
                                          document.form1.temptotalkPrice.value = addCommas(result);
                                          document.form1.tranPrice.value = addCommas(num1);
                                          document.form1.otherPrice.value = addCommas(num2);
                                          document.form1.dutyPrice.value = addCommas(num4);
                                          document.form1.marketingPrice.value = addCommas(num5);
                                          document.form1.actPrice.value = addCommas(num6);
                                          document.form1.closeAccountPrice.value = addCommas(num7);
                                          document.form1.balancePrice.value = addCommas(TotalBalance);
                                          document.form1.P2Price.value = addCommas(num8);
                                          }
                                      }

                                    function insurance(){

                                          var num1 = document.getElementById('Insurancecar').value;
                                          var num22 = document.getElementById('totalkPrice').value;
                                          var num2 = num22.replace(",","");
                                          var num33 = document.getElementById('balancePrice').value;
                                          var num3 = num33.replace(",","");
                                          var num44 = document.getElementById('Topcar').value;
                                          var num4 = num44.replace(",","");
                                          var num55 = document.getElementById('P2Price').value;
                                          var num5 = num55.replace(",","");

                                            if(num1 == 'มี ป2+ อยู่แล้ว' && num4 >= '200000'){
                                                    var total1 = parseFloat(num2) - 6900;
                                                    var total2 = parseFloat(num3) + 6900;
                                                    document.form1.P2Price.value = 0;
                                                    document.form1.totalkPrice.value = addCommas(total1);
                                                    document.form1.balancePrice.value = addCommas(total2);
                                            }
                                            else if(num1 == 'มี ป1 อยู่แล้ว' && num4 >= '200000'){
                                                    var total1 = parseFloat(num2) - 6900;
                                                    var total2 = parseFloat(num3) + 6900;
                                                    document.form1.P2Price.value = 0;
                                                    document.form1.totalkPrice.value = addCommas(total1);
                                                    document.form1.balancePrice.value = addCommas(total2);
                                            }
                                            else{
                                                    document.form1.P2Price.value = addCommas(num5);
                                                    document.form1.totalkPrice.value = addCommas(num2);
                                                    document.form1.balancePrice.value = addCommas(num3);
                                            }

                                          }
                                </script>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ยอดจัด : </label>
                                      <input type="text" id="Topcar" name="Topcar" class="form-control" style="width: 250px;" maxlength="9" placeholder="กรอกยอดจัด" oninput="calculate();percent();balance();" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>ชำระต่องวด : </label>
                                        <input type="text" id="Paycar" name="Paycar" class="form-control" style="width: 250px;" readonly onchange="calculate();" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                   <div class="form-inline" align="right">
                                     <label>ระยะเวลาผ่อน : </label>
                                     <input type="text" id="Timeslackencar" name="Timeslackencar" placeholder="ป้อนระยะเวลาผ่อน" class="form-control" style="width: 250px;" onchange="calculate();" />
                                   </div>

                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>ภาษี / ระยะเวลาผ่อน : </label>
                                        <input type="text" id="Taxcar" name="Taxcar" class="form-control" style="width: 123px;" readonly />
                                        <input type="text" id="Taxpaycar" name="Taxpaycar" class="form-control" style="width: 123px;" readonly />
                                    </div>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ดอกเบี้ย / ปี : </label>
                                       <input type="text" id="Interestcar" name="Interestcar" class="form-control" style="width: 250px;" placeholder="ดอกเบี้ย" oninput="calculate();"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <label>ค่างวด / ระยะเวลาผ่อน : </label>
                                       <input type="text" id="Paymemtcar" name="Paymemtcar" class="form-control" style="width: 123px;" readonly />
                                       <input type="text" id="Timepaymentcar" name="Timepaymentcar" class="form-control" style="width: 123px;" readonly />
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>VAT : </label>
                                      <input type="text" id="Vatcar" name="Vatcar" class="form-control" style="width: 250px;" value="7 %" readonly onchange="calculate()"/>
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ยอดผ่อนชำระทั้งหมด : </label>
                                         <input type="text" id="Totalpay1car" name="Totalpay1car" class="form-control" style="width: 123px;" readonly />
                                         <input type="text" id="Totalpay2car" name="Totalpay2car" class="form-control" style="width: 123px;" readonly />
                                     </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประกันภัย : </label>
                                      <select id="Insurancecar" name="Insurancecar" class="form-control" style="width: 250px;" onchange="insurance();">
                                        <option value="" selected>--- ประกันภัย ---</option>
                                        <option value="มี ป2+ อยู่แล้ว">มี ป2+ อยู่แล้ว</option>
                                        <option value="ไม่ซื้อ">ไม่ซื้อ</option>
                                        <option value="ซื้อ ป2+ 1ป">ซื้อ ป2+ 1ปี</option>
                                        <option value="ซื้อ ป1 1ปี">ซื้อ ป1 1ปี</option>
                                        <option value="มี ป1 อยู่แล้ว">มี ป1 อยู่แล้ว</option>
                                      </select>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>เปอร์เซ็นจัดไฟแนนซ์ : </label>
                                     <input type="text" id="Percentcar" name="Percentcar" class="form-control int" style="width: 250px;" placeholder="เปอร์เซ็นจัดไฟแนนซ์" readonly />
                                   </div>
                                  </div>
                                </div>

                                <!-- <div class="row">
                                  <div class="col-md-5">

                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขกรมธรรม์ : </label>
                                       <input type="text" name="Insurancekey" class="form-control" style="width: 250px;" placeholder="เลขกรมธรรม์" />
                                   </div>
                                  </div>
                                </div> -->

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>แบบ : </label>
                                       <select name="statuscar" class="form-control" style="width: 250px;">
                                         <option value="" selected>--- เลือกแบบ ---</option>
                                         <option value="กส.ค้ำมีหลักทรัพย์">กส.ค้ำมีหลักทรัพย์</option>
                                         <option value="กส.ค้ำไม่มีหลักทรัพย์">กส.ค้ำไม่มีหลักทรัพย์</option>
                                         <option value="กส.ไม่ค้ำประกัน">กส.ไม่ค้ำประกัน</option>
                                         <option value="ซข.ค้ำมีหลักทรัพย์">ซข.ค้ำมีหลักทรัพย์</option>
                                         <option value="ซข.ค้ำไม่มีหลักทรัพย์">ซข.ค้ำไม่มีหลักทรัพย์</option>
                                         <option value="ซข.ไม่ค้ำประกัน">ซข.ไม่ค้ำประกัน</option>
                                         <option value="VIP1">VIP1</option>
                                       </select>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>วันที่ชำระงวดแรก : </label>
                                     <input type="text" name="Dateduefirstcar" class="form-control" style="width: 250px;" readonly placeholder="วันที่ชำระงวดแรก" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <span class="todo-wrap">
                                          <input type="checkbox" id="1" name="Salemethod" value="on"/>
                                          <label for="1" class="todo">
                                            <i class="fa fa-check"></i>
                                            กรรมสิทธิ์ในแบบซื้อขาย
                                          </label>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      </span>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>หมายเหตุ : </label>
                                     <input type="text" name="Notecar" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                   </div>
                                  </div>
                                </div>

                                {{--
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ผู้รับเงิน : </label>
                                       <input type="text" name="Payeecar" class="form-control" style="width: 250px;" placeholder="ผู้รับเงิน" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขที่บัญชี : </label>
                                       <input type="text" name="Accountbrancecar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีผู้รับเงิน" maxlength="15" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สาขา : </label>
                                      <input type="text" name="branchbrancecar" class="form-control" style="width: 250px;" placeholder="สาขาผู้รับเงิน" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      <input type="text" name="Tellbrancecar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <font color="red">(* กรณีเป็นพนักงาน) </font><label>แนะนำ/นายหน้า : </label>
                                       <input type="text" id="Agentcar" name="Agentcar" class="form-control" style="width: 250px;" placeholder="แนะนำ/นายหน้า" oninput="commission();"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขที่บัญชี : </label>
                                       <input type="text" name="Accountagentcar" class="form-control" style="width: 250px;" placeholder="เลขที่บัญชีนายหน้า" maxlength="15" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ค่าคอม : </label>
                                      <input type="text" id="Commissioncar" name="Commissioncar" class="form-control" style="width: 250px;" placeholder="ค่าคอม" oninput="commission();"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>สาขา : </label>
                                      <input type="text" name="branchAgentcar" class="form-control" style="width: 250px;" placeholder="สาขานายหน้า" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ประวัติการซื้อ/ค้ำ : </label>
                                      <select name="Purchasehistorycar" class="form-control" style="width: 108px;">
                                        <option value="" selected>--- ซื้อ ---</option>
                                        <option value="0 คัน">0 คัน</option>
                                        <option value="1 คัน">1 คัน</option>
                                        <option value="2 คัน">2 คัน</option>
                                        <option value="3 คัน">3 คัน</option>
                                        <option value="4 คัน">4 คัน</option>
                                        <option value="5 คัน">5 คัน</option>
                                        <option value="6 คัน">6 คัน</option>
                                        <option value="7 คัน">7 คัน</option>
                                        <option value="8 คัน">8 คัน</option>
                                        <option value="9 คัน">9 คัน</option>
                                        <option value="10 คัน">10 คัน</option>
                                        <option value="11 คัน">11 คัน</option>
                                        <option value="12 คัน">12 คัน</option>
                                        <option value="13 คัน">13 คัน</option>
                                        <option value="14 คัน">14 คัน</option>
                                        <option value="15 คัน">15 คัน</option>
                                        <option value="16 คัน">16 คัน</option>
                                        <option value="17 คัน">17 คัน</option>
                                        <option value="18 คัน">18 คัน</option>
                                        <option value="19 คัน">19 คัน</option>
                                        <option value="20 คัน">20 คัน</option>
                                      </select>
                                      <label>ค้ำ : </label>
                                      <select name="Supporthistorycar" class="form-control" style="width: 108px;">
                                        <option value="" selected>--- ค้ำ ---</option>
                                        <option value="0 คัน">0 คัน</option>
                                        <option value="1 คัน">1 คัน</option>
                                        <option value="2 คัน">2 คัน</option>
                                        <option value="3 คัน">3 คัน</option>
                                        <option value="4 คัน">4 คัน</option>
                                        <option value="5 คัน">5 คัน</option>
                                        <option value="6 คัน">6 คัน</option>
                                        <option value="7 คัน">7 คัน</option>
                                        <option value="8 คัน">8 คัน</option>
                                        <option value="9 คัน">9 คัน</option>
                                        <option value="10 คัน">10 คัน</option>
                                        <option value="11 คัน">11 คัน</option>
                                        <option value="12 คัน">12 คัน</option>
                                        <option value="13 คัน">13 คัน</option>
                                        <option value="14 คัน">14 คัน</option>
                                        <option value="15 คัน">15 คัน</option>
                                        <option value="16 คัน">16 คัน</option>
                                        <option value="17 คัน">17 คัน</option>
                                        <option value="18 คัน">18 คัน</option>
                                        <option value="19 คัน">19 คัน</option>
                                        <option value="20 คัน">20 คัน</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>เบอร์โทรศัพท์ : </label>
                                      <input type="text" name="Tellagentcar" class="form-control" style="width: 250px;" placeholder="เบอร์โทรศัพท์" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask="" />
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>หมายเหตุ : </label>
                                      <input type="text" name="Notecar" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                  </div>
                                </div>
                                --}}
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <!-- <label><font color="red">เจ้าหน้าที่สินเชื่อ : </font></label> -->
                                       <input type="hidden" name="Loanofficercar" class="form-control" style="width: 250px;" value="{{ Auth::user()->name }}" readonly />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                       <!-- <label><font color="red">สาขา : </font></label> -->
                                       @if(Auth::user()->branch == 99)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="Admin" readonly />
                                       @elseif(Auth::user()->branch == 01)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="ปัตตานี" readonly />
                                       @elseif(Auth::user()->branch == 03)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="ยะลา" readonly />
                                       @elseif(Auth::user()->branch == 04)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="นราธิวาส" readonly />
                                       @elseif(Auth::user()->branch == 05)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="สายบุรี" readonly />
                                       @elseif(Auth::user()->branch == 06)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="โกลก" readonly />
                                       @elseif(Auth::user()->branch == 07)
                                          <input type="hidden" name="branchcar" class="form-control" style="width: 250px;" value="เบตง" readonly />
                                       @endif
                                     </div>
                                  </div>
                                </div>

                              </div>
                              <div class="tab-pane" id="tab_4" style="display:none;">
                                <h3 class="card-title p-3" align="center">แบบฟอร์มรายละเอียดค่าใช้จ่าย</h3>
                                <br>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>พรบ. : </label>
                                       <input type="text" id="actPrice" name="actPrice" class="form-control" value="0" style="width: 250px;" placeholder="พรบ." oninput="balance()"/>
                                       <!-- <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="พรบ."/> -->
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เปอร์เซ็นต์ค่าคอม : </label>
                                       <input type="hidden" id="tempTopcar" name="tempTopcar" class="form-control" style="width: 250px;" placeholder="รวมยอดจัด" oninput="balance()" readonly/>
                                       <input type="text" name="vatPrice" class="form-control" style="width: 250px;" placeholder="เปอร์เซ็นต์ค่าคอม" />
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ยอดปิดบัญชี : </label>
                                      <input type="text" id="closeAccountPrice" name="closeAccountPrice" class="form-control" value="0" style="width: 250px;" placeholder="ยอดปิดบัญชี" oninput="balance()"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>ซื้อ ป2+ / ป1 : </label>
                                     <input type="text" id="P2Price" name="P2Price" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" oninput="balance();"/>
                                     <input type="hidden" id="P2PriceOri" name="P2PriceOri" class="form-control" value="0" style="width: 250px;" placeholder="ซื้อ ป2+" onchange="calculate();balance();"/>
                                   </div>
                                  </div>
                                </div>

                                <hr />
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ค่าใช้จ่ายขนส่ง : </label>
                                       <input type="text" id="tranPrice" name="tranPrice" class="form-control" value="0" style="width: 250px;" placeholder="ค่าใช้จ่ายขนส่ง" oninput="balance()"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>อื่นๆ : </label>
                                       <input type="text" id="otherPrice" name="otherPrice" class="form-control" value="0" style="width: 250px;" placeholder="อื่นๆ" oninput="balance()"/>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ค่าประเมิน : </label>
                                       <input type="text" id="evaluetionPrice" name="evaluetionPrice" class="form-control" value="0" style="width: 250px;" placeholder="อื่นๆ" oninput="balance()"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                     <label>อากร : </label>
                                     <input type="text" id="dutyPrice" name="dutyPrice" class="form-control" style="width: 250px;" placeholder="0" value="0" readonly oninput="balance()"/>
                                   </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                      <label>ค่าการตลาด : </label>
                                      <input type="text" id="marketingPrice" name="marketingPrice" class="form-control" style="width: 250px;"  placeholder="0" value="0" readonly oninput="balance()"/>
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                       <label>รวม คชจ. : </label>
                                       <input type="text" id="totalkPrice" name="totalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance();" readonly/>
                                       <input type="hidden" id="temptotalkPrice" name="temptotalkPrice" class="form-control" style="width: 250px;" placeholder="รวม คชจ." onchange="balance();"/>
                                     </div>
                                  </div>
                                </div>

                                <hr>

                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คงเหลือ : </label>
                                       <input type="text" id="balancePrice" name="balancePrice" class="form-control" style="width: 250px;" placeholder="คงเหลือ" readonly/>
                                     </div>
                                   </div>

                                   <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                        <label>ค่าคอมหลังหัก 3% : </label>
                                        <input type="text" id="commitPrice" name="commitPrice" class="form-control" style="width: 250px;" placeholder="ค่าคอมหลังหัก" readonly/>
                                      </div>
                                   </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>หมายเหตุ : </label>
                                       <input type="text" name="notePrice" class="form-control" style="width: 250px;" placeholder="หมายเหตุ"/>
                                     </div>
                                   </div>

                                   <div class="col-md-6">
                                   </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>

                      <input type="hidden" name="_token" value="{{csrf_token()}}" />
                      <input type="hidden" name="type" value="8" />
                      <br>
                      <hr />
                      <table class="table table-bordered" id="table" border="3" align="center" style="width: 30%;" align="center">
                          <thead class="thead-dark">
                            <tr>
                              <th class="text-center"><font color="red"><h3>เอกสารครบ</h3></font></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th class="text-center">
                                <p></p>
                                <label class="con">
                                  <input type="checkbox" class="checkbox" name="doccomplete" id="" value="{{ auth::user()->name }}"> <!-- checked="checked"  -->
                                <span class="checkmark"></span>
                                <p></p>
                                </label>
                              </th>
                            </tr>
                          </tbody>
                        </table>
                      <div class="form-group" align="center">
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('Analysis',1) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      </div>

                      <!-- แบบฟอร์มผู้ค้ำ 2 -->
                      <div class="modal fade" id="modal-default">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" align="center">รายละเอียดผู้ค้ำที่ 2</h4>
                              </div>
                              <div class="modal-body">
                                <br>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อ : </label>
                                       <input type="text" name="nameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อ" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>นามสกุล : </label>
                                       <input type="text" name="lnameSP2" class="form-control" style="width: 200px;" placeholder="นามสกุล" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>ชื่อเล่น : </label>
                                       <input type="text" name="niknameSP2" class="form-control" style="width: 200px;" placeholder="ชื่อเล่น" />
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                        <label>สถานะ : </label>
                                        <select name="statusSP2" class="form-control" style="width: 200px;">
                                          <option value="" selected>--- สถานะ ---</option>
                                          <option value="โสด">โสด</option>
                                          <option value="สมรส">สมรส</option>
                                          <option value="หย่าร้าง">หย่าร้าง</option>
                                          <option value="เสียชีวิต">เสียชีวิต</option>
                                        </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>เบอร์โทร : </label>
                                       <input type="text" name="telSP2" class="form-control" style="width: 200px;" placeholder="เบอร์โทร" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>ความสัมพันธ์ : </label>
                                       <select name="relationSP2" class="form-control" style="width: 200px;">
                                         <option value="" selected>--- ความสัมพันธ์ ---</option>
                                         <option value="พี่น้อง">พี่น้อง</option>
                                         <option value="ญาติ">ญาติ</option>
                                         <option value="เพื่อน">เพื่อน</option>
                                         <option value="บิดา">บิดา</option>
                                         <option value="มารดา">มารดา</option>
                                         <option value="ตำบลเดี่ยวกัน">ตำบลเดี่ยวกัน</option>
                                         <option value="จ้างค้ำ(ไม่รู้จักกัน)">จ้างค้ำ(ไม่รู้จักกัน)</option>
                                       </select>
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>คู่สมรส : </label>
                                       <input type="text" name="mateSP2" class="form-control" style="width: 200px;" placeholder="คู่สมรส" />
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>เลขบัตรประชาชน : </label>
                                       <input type="text" name="idcardSP2" class="form-control" style="width: 200px;" placeholder="เลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ที่อยู่ : </label>
                                         <select name="addSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- ที่อยู่ ---</option>
                                           <option value="ตามทะเบียนบ้าน">ตามทะเบียนบ้าน</option>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                         <label>ที่อยู่ปัจจุบัน/จัดส่งเอกสาร : </label>
                                         <input type="text" name="addnowSP2" class="form-control" style="width: 200px;" placeholder="ที่อยู่ปัจจุบัน/จัดส่งเอกสาร" />
                                     </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-inline" align="right">
                                       <label>รายละเอียดที่อยู่ : </label>
                                       <input type="text" name="statusaddSP2" class="form-control" style="width: 200px;" placeholder="รายละเอียดที่อยู่" />
                                     </div>
                                  </div>

                                  <div class="col-md-6">
                                   <div class="form-inline" align="right">
                                       <label>สถานที่ทำงาน : </label>
                                       <input type="text" name="workplaceSP2" class="form-control" style="width: 200px;" placeholder="สถานที่ทำงาน" />
                                   </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                         <label>ลักษณะบ้าน : </label>
                                         <select name="houseSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- เลือกลักษณะบ้าน ---</option>
                                           <option value="บ้านตึก 1 ชั้น">บ้านตึก 1 ชั้น</option>
                                           <option value="บ้านตึก 2 ชั้น">บ้านตึก 2 ชั้น</option>
                                           <option value="บ้านไม้ 1 ชั้น">บ้านไม้ 1 ชั้น</option>
                                           <option value="บ้านไม้ 2 ชั้น">บ้านไม้ 2 ชั้น</option>
                                           <option value="บ้านเดี่ยว">บ้านเดี่ยว</option>
                                           <option value="แฟลต">แฟลต</option>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทหลักทรัพย์ : </label>
                                          <select name="securitiesSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- ประเภทหลักทรัพย์ ---</option>
                                            <option value="โฉนด">โฉนด</option>
                                            <option value="นส.3">นส.3</option>
                                            <option value="นส.3 ก">นส.3 ก</option>
                                            <option value="นส.4">นส.4</option>
                                            <option value="นส.4 จ">นส.4 จ</option>
                                          </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>เลขที่โฉนด : </label>
                                          <input type="text" name="deednumberSP2" class="form-control" style="width: 200px;" placeholder="เลขที่โฉนด" />
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>เนื้อที่ : </label>
                                         <input type="text" name="areaSP2" class="form-control" style="width: 200px;" placeholder="เนื้อที่" data-inputmask="&quot;mask&quot;:&quot;99-9-99&quot;" data-mask=""/>
                                       </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>ประเภทบ้าน : </label>
                                          <select name="housestyleSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- ประเภทบ้าน ---</option>
                                            <option value="ของตนเอง">ของตนเอง</option>
                                            <option value="อาศัยบิดา">อาศัยบิดา-มารดา</option>
                                            <option value="อาศัยผู้อื่น">อาศัยผู้อื่น</option>
                                            <option value="บ้านพักราชการ">บ้านพักราชการ</option>
                                            <option value="บ้านเช่า">บ้านเช่า</option>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>อาชีพ : </label>
                                         <select name="careerSP2" class="form-control" style="width: 200px;">
                                           <option value="" selected>--- อาชีพ ---</option>
                                           <option value="ตำรวจ">ตำรวจ</option>
                                           <option value="ทหาร">ทหาร</option>
                                           <option value="ครู">ครู</option>
                                           <option value="ข้าราชการอื่น">ข้าราชการอื่น</option>
                                           <option value="ลูกจ้างเทศบาล">ลูกจ้างเทศบาล</option>
                                           <option value="ลูกจ้างประจำ">ลูกจ้างประจำ</option>
                                           <option value="สมาชิก อบต.">สมาชิก อบต.</option>
                                           <option value="ลูกจ้างชั่วคราว">ลูกจ้างชั่วคราว</option>
                                           <option value="รับจ้าง">รับจ้าง</option>
                                           <option value="พนักงานบริษัทเอกชน">พนักงานบริษัทเอกชน</option>
                                           <option value="อาชีพอิสระ">อาชีพอิสระ</option>
                                           <option value="กำนัน">กำนัน</option>
                                           <option value="ผู้ใหญ่บ้าน">ผู้ใหญ่บ้าน</option>
                                           <option value="ผู้ช่วยผู้ใหญ่บ้าน">ผู้ช่วยผู้ใหญ่บ้าน</option>
                                           <option value="นักการภารโรง">นักการภารโรง</option>
                                           <option value="มอเตอร์ไซร์รับจ้าง">มอเตอร์ไซร์รับจ้าง</option>
                                           <option value="ค้าขาย">ค้าขาย</option>
                                           <option value="เจ้าของธุรกิจ">เจ้าของธุรกิจ</option>
                                           <option value="เจ้าของอู่รถ">เจ้าของอู่รถ</option>
                                           <option value="ให้เช่ารถบรรทุก">ให้เช่ารถบรรทุก</option>
                                           <option value="ช่างตัดผม">ช่างตัดผม</option>
                                           <option value="ชาวนา">ชาวนา</option>
                                           <option value="ชาวไร่">ชาวไร่</option>
                                           <option value="แม่บ้าน">แม่บ้าน</option>
                                           <option value="รับเหมาก่อสร้าง">รับเหมาก่อสร้าง</option>
                                           <option value="ประมง">ประมง</option>
                                           <option value="ทนายความ">ทนายความ</option>
                                           <option value="พระ">พระ</option>
                                         </select>
                                       </div>
                                    </div>
                                  </div>
                                <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-inline" align="right">
                                          <label>รายได้ : </label>
                                          <select name="incomeSP2" class="form-control" style="width: 200px;">
                                            <option value="" selected>--- รายได้ ---</option>
                                            <option value="5,000 - 10,000">5,000 - 10,000</option>
                                            <option value="10,000 - 15,000">10,000 - 15,000</option>
                                            <option value="15,000 - 20,000">15,000 - 20,000</option>
                                            <option value="มากกว่า 20,000">มากกว่า 20,000</option>
                                          </select>
                                      </div>
                                      </div>
                                    <div class="col-md-6">
                                      <div class="form-inline" align="right">
                                         <label>ประวัติซื้อ : </label>
                                         <select name="puchaseSP2" class="form-control" style="width: 85px;">
                                           <option value="" selected>-ซื้อ-</option>
                                           <option value="0 คัน">0 คัน</option>
                                           <option value="1 คัน">1 คัน</option>
                                           <option value="2 คัน">2 คัน</option>
                                           <option value="3 คัน">3 คัน</option>
                                           <option value="4 คัน">4 คัน</option>
                                           <option value="5 คัน">5 คัน</option>
                                           <option value="6 คัน">6 คัน</option>
                                           <option value="7 คัน">7 คัน</option>
                                           <option value="8 คัน">8 คัน</option>
                                           <option value="9 คัน">9 คัน</option>
                                           <option value="10 คัน">10 คัน</option>
                                           <option value="11 คัน">11 คัน</option>
                                           <option value="12 คัน">12 คัน</option>
                                           <option value="13 คัน">13 คัน</option>
                                           <option value="14 คัน">14 คัน</option>
                                           <option value="15 คัน">15 คัน</option>
                                           <option value="16 คัน">16 คัน</option>
                                           <option value="17 คัน">17 คัน</option>
                                           <option value="18 คัน">18 คัน</option>
                                           <option value="19 คัน">19 คัน</option>
                                           <option value="20 คัน">20 คัน</option>
                                         </select>

                                         <label>ค้ำ : </label>
                                         <select name="supportSP2" class="form-control" style="width: 80px;">
                                            <option value="" selected>-ค้ำ-</option>
                                            <option value="0 คัน">0 คัน</option>
                                            <option value="1 คัน">1 คัน</option>
                                            <option value="2 คัน">2 คัน</option>
                                            <option value="3 คัน">3 คัน</option>
                                            <option value="4 คัน">4 คัน</option>
                                            <option value="5 คัน">5 คัน</option>
                                            <option value="6 คัน">6 คัน</option>
                                            <option value="7 คัน">7 คัน</option>
                                            <option value="8 คัน">8 คัน</option>
                                            <option value="9 คัน">9 คัน</option>
                                            <option value="10 คัน">10 คัน</option>
                                            <option value="11 คัน">11 คัน</option>
                                            <option value="12 คัน">12 คัน</option>
                                            <option value="13 คัน">13 คัน</option>
                                            <option value="14 คัน">14 คัน</option>
                                            <option value="15 คัน">15 คัน</option>
                                            <option value="16 คัน">16 คัน</option>
                                            <option value="17 คัน">17 คัน</option>
                                            <option value="18 คัน">18 คัน</option>
                                            <option value="19 คัน">19 คัน</option>
                                            <option value="20 คัน">20 คัน</option>
                                         </select>
                                    </div>
                                </div>
                              </div>
                              <hr>
                              <div class="footer" align="center">
                                <button type="button" class="btn btn-default" data-dismiss="modal">เสร็จ</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      <!-- แบบฟอร์มผู้ค้ำ 2 -->

                    </form>

                  </div>
                </div>

            </div>
          </div>

        </div>
      </div>

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

    </section>
    {{csrf_field()}}

@endsection
