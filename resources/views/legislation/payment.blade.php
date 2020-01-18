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

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

      <section class="content-header">
        <h1>
          ชั้นศาล
          <small>ประนอมหนี้ / เพิ่มข้อมูลชำระ</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-warning box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">เพิ่มข้อมูลชำระ</h4>
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
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 4]) }}">รายละเอียด</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 5]) }}">เพิ่มข้อมูลชำระ</a></li>
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

            <form name="form1" action="{{ route('legislation.store',[$id, $type]) }}" method="post" id="formimage" enctype="multipart/form-data">
              @csrf

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="form-inline" align="right">
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
                          function Comma(){
                            var num11 = document.getElementById('GoldPayment').value;
                            var num1 = num11.replace(",","");
                            document.form1.GoldPayment.value = addCommas(num1);
                          }
                      </script>

                      <div class="row">
                         <div class="col-md-9">
                           <div class="row">
                              <div class="col-md-5">
                                <div class="form-inline" align="right">
                                   <label>วันที่ : </label>
                                   <input type="date" name="DatePayment" class="form-control" value="{{ $date }}" min="{{ $date2 }}" style="width: 200px;"/>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                   <label>ยอดชำระ :</label>
                                   <input type="text" name="GoldPayment" id="GoldPayment" class="form-control" value="" style="width: 200px;"  oninput="Comma();"/>
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                             <div class="col-md-5">
                               <div class="form-inline" align="right">
                                  <label>ประเภทชำระ : </label>
                                  <select name="TypePayment" class="form-control" style="width: 200px;">
                                    <option value="" selected>--- ประเภทชำระ ---</option>
                                    <option value="ชำระเงินสด">ชำระเงินสด</option>
                                    <option value="ชำระผ่านโอน">ชำระผ่านโอน</option>
                                  </select>
                                </div>
                             </div>
                              <div class="col-md-6">
                                <div class="form-inline" align="right">
                                   <label>หมายเหตุ :</label>
                                   <input type="text" name="NotePayment" class="form-control" value="" style="width: 200px;"/>
                                   <input type="hidden" name="AdduserPayment" class="form-control" style="width: 200px;" value="{{ Auth::user()->name }}"/>
                                 </div>
                              </div>
                           </div>
                         </div>

                         <div class="col-md-3">
                          <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                            <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                          </button>
                          <a class="btn btn-app" href="{{ action('LegislationController@edit',[$id, 2]) }}" style="background-color:#DB0000; color:#FFFFFF;">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        </div>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>

              </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </form>

          </div>


      <!-- เวลาแจ้งเตือน -->
      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

    </section>
@endsection
