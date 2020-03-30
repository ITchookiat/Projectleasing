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

<style>
  input[type="checkbox"] { position: absolute; opacity: 0; z-index: -1; }
  input[type="checkbox"]+span { font: 12pt sans-serif; color: #000; }
  input[type="checkbox"]+span:before { font: 12pt FontAwesome; content: '\00f096'; display: inline-block; width: 12pt; padding: 2px 0 0 3px; margin-right: 0.5em; }
  input[type="checkbox"]:checked+span:before { content: '\00f046'; }
  input[type="checkbox"]:focus+span:before { outline: 1px dotted #aaa; }
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
      padding-left: 22px;
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

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-warning box-solid">
          <div class="box-header with-border">
          @if($type == 9)
            <h4 class="card-title p-3" align="center">ใบเสร็จชำระค่างวด</h4>
          @elseif($type == 15)
            <h4 class="card-title p-3" align="center">รายงานบันทึกชำะค่างวด</h4>
          @elseif($type == 16)
          <h4 class="card-title p-3" align="center">รายงานลูกหนี้ประนอม</h4>
          @elseif($type == 17)
          <h4 class="card-title p-3" align="center">รายงานลูกหนี้</h4>
          @elseif($type == 18)
          <h4 class="card-title p-3" align="center">รายงานลูกหนี้สืบพยาน</h4>
          @elseif($type == 19)
          <h4 class="card-title p-3" align="center">รายงานลูกหนี้สืบทรัพย์</h4>
          @endif
            <div class="box-tools pull-right">
              <button type="button" data-dismiss="modal" class="close" >
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>

          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            @if($type == 9)
              <form name="form1" action="{{ route('legislation.report' ,[00, 1]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="form-inline" align="right">
                        <div class="row">
                          <div class="col-md-7">
                            <div class="row">
                                  <div class="" align="right">
                                    <label><font color="red">เลขที่สัญญา :</font></label>
                                    <input type="text" name="Contract" class="form-control" style="width: 200px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
                                  </div>
                                  <div class="" align="right">
                                    <label>เลขที่ใบเสร็จ :</label>
                                    <input type="text" name="NumberBill" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <br>
                                  <div class="" align="right">
                                    <label>จากวันที่ : </label>
                                    <input type="date" name="Fdate" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <div class="" align="right">
                                    <label>ถึงวันที่ : </label>
                                    <input type="date" name="Tdate" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <br>
                              </div>
                            </div>

                          <div class="col-md-5">
                            <div class="form-inline" align="center">
                            <br><br>
                              <button type="submit" class="btn btn-primary btn-app">
                                <span class="glyphicon glyphicon-print"></span> ปริ้น
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',7) }}" style="background-color:#E7910F; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>

                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
              </form>
            @elseif($type == 15)
              <form name="form1" action="{{ route('legislation.report' ,[00, 15]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                        <div class="form-inline" align="center">
                          <div class="row">
                            <div class="col-md-7">
                              <label><font color="red">เลขที่สัญญา :</font></label>
                              <input type="text" name="Contract" class="form-control text-center" style="padding:5px; width:250px; border-radius: 5px 0 5px 5px; font-size:24px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
                            </div>
                            <div class="col-md-5">
                              <br>
                              <button type="submit" class="btn btn-primary btn-app">
                                <span class="glyphicon glyphicon-print"></span> ปริ้น
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',7) }}" style="background-color:#E7910F; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                              <br><br>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="_token" value="{{csrf_token()}}" />
              </form>
            @elseif($type == 16)
              <form name="form1" action="{{ route('legislation.report' ,[00, 16]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="form-inline" align="right">
                        <div class="row">
                          <div class="col-md-7">
                            <div class="" align="right">
                              <label>วันที่ : </label>
                              <input type="date" name="Fromdate" class="form-control" style="width: 200px;"/>
                            </div>
                            <div class="" align="right">
                              <label>ถึงวันที่ : </label>
                              <input type="date" name="Todate" class="form-control" style="width: 200px;"/>
                            </div>
                            <br>
                          </div>

                          <div class="col-md-5">
                            <div class="form-inline" align="center">
                              <button type="submit" class="btn btn-danger btn-app">
                                <span class="fa fa-file-pdf-o"></span> PDF
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',7) }}" style="background-color:#E7910F ; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                              <label>สถานะ : &nbsp;&nbsp;</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test3" name="status" value="ชำระปกติ"/>
                                <span>ชำระปกติ</span>
                              </label>
                            <p></p>
                              <label>
                                <input type="checkbox" id="test4" name="status" value="ขาดชำระ"/>
                                <span>ขาดชำระเกิน 3 งวด</span>
                              </label>
                            <p></p>
                              <label>
                                <input type="checkbox" id="test5" name="status" value="ปิดบัญชี"/>
                                <span>ปิดบัญชี</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      <br>
                    </div>
                  </div>

                </div>
              </form>
            @elseif($type == 17)
              <form name="form1" action="{{ route('legislation.report' ,[00, 17]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-inline" align="center">
                              <label>วันที่ : </label>
                              <input type="date" name="Fromdate" class="form-control" style="width: 180px;"/>
                              <label>ถึงวันที่ : </label>
                              <input type="date" name="Todate" class="form-control" style="width: 180px;"/>
                            </div>
                          </div>
                        </div>
                        <p></p>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                              <label>สถานะ : </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test1" name="status" value="ลูกหนี้ฟ้อง"/>
                                <span>ลูกหนี้ฟ้อง</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test2" name="status" value="ลูกหนี้ยังไม่ฟ้อง"/>
                                <span>ลูกหนี้ยังไม่ฟ้อง</span>
                              </label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test3" name="status" value="ลูกหนี้ปิดจบงาน"/>
                                <span>ลูกหนี้ปิดจบงาน</span>
                              </label>
                            </div>
                          </div>
                        </div>

                        <p></p>
                        <!-- <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                              <label>สถานะทรัพย์ : </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-inline" align="left">
                              <select name="StateLegis" class="form-control" style="width: 200px">
                                <option selected value="">--- สถานะทรัพย์ ---</option>
                                <option value="มีทรัพย์">มีทรัพย์</otion>
                                <option value="ไม่มีทรัพย์">ไม่มีทรัพย์</otion>
                              </select>
                            </div>
                          </div>
                        </div>
                        <p></p> -->

                        <!-- <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                              <label>สถานะปิดงาน : </label>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="form-inline" align="left">
                              <select name="StateLegis" class="form-control" style="width: 200px">
                                <option selected value="">--- สถานะปิดงาน ---</option>
                                <option value="จ่ายจบก่อนฟ้อง">จ่ายจบก่อนฟ้อง</otion>
                                <option value="ยึดรถก่อนฟ้อง">ยึดรถก่อนฟ้อง</otion>
                                <option value="หมดอายุความคดี">หมดอายุความคดี</otion>
                                <option value="ปิดบัญชีชั้นศาล">ปิดบัญชีชั้นศาล</otion>
                                <option value="ยึดรถชั้นศาล">ยึดรถชั้นศาล</otion>
                                <option value="ถอนบังคับคดีปิดบัญชี">ถอนบังคับคดีปิดบัญชี</otion>
                                <option value="ถอนบังคับคดียึดรถ">ถอนบังคับคดียึดรถ</otion>
                                <option value="ประนอมหลังยึดทรัพย์">ประนอมหลังยึดทรัพย์</otion>
                                <option value="ถอนบังคับคดียอดเหลือน้อย">ถอนบังคับคดียอดเหลือน้อย</otion>
                                <option value="ถอนบังคับคดีขายเต็มจำนวน">ถอนบังคับคดีขายเต็มจำนวน</otion>
                                <option value="ศาลพิพากษา">ศาลพิพากษา</otion>
                                <option value="ประนีประนอม(จำหน่ายคดี)">ประนีประนอม(จำหน่ายคดี)</otion>
                                <option value="ยื่นคำร้องให้ศาลพิพากษา">ยื่นคำร้องให้ศาลพิพากษา</otion>
                                <option value="ปิดบัญชีโกงเจ้าหนี้">ปิดบัญชีโกงเจ้าหนี้</otion>
                              </select>
                            </div>
                          </div>
                        </div> -->

                        <p></p>
                        <br>
                        <div class="row">
                          <div class="col-md-12>
                            <div class="form-inline" align="center">
                              <button type="submit" class="btn btn-success btn-app">
                                <span class="fa fa-file-excel-o"></span> Excel
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',2) }}" style="background-color:#E7910F; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
              </form>
            @elseif($type == 18)
              <form name="form1" action="{{ route('legislation.report' ,[00, 18]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-inline" align="center">
                              <label>วันที่ : </label>
                              <input type="date" name="Fromdate" class="form-control" style="width: 180px;" required/>
                              <label>ถึงวันที่ : </label>
                              <input type="date" name="Todate" class="form-control" style="width: 180px;" required/>
                            </div>
                          </div>
                        </div>

                        <p></p>
                        <br>
                        <div class="row">
                          <div class="col-md-12>
                            <div class="form-inline" align="center">
                              <button type="submit" class="btn btn-primary btn-app">
                                <span class="glyphicon glyphicon-print"></span> ปริ้น
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',2) }}" style="background-color:#DB0000; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
              </form>
            @elseif($type == 19)
              <form name="form1" action="{{ route('legislation.report' ,[00, 19]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-inline" align="center">
                              <label>วันที่ : </label>
                              <input type="date" name="Fromdate" class="form-control" style="width: 180px;"/>
                              <label>ถึงวันที่ : </label>
                              <input type="date" name="Todate" class="form-control" style="width: 180px;"/>
                            </div>
                          </div>
                        </div>
                        <br>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="" align="right">
                              <label>สถานะ : </label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test1" name="status" value="Y"/>
                                <span>ลูกหนี้มีทรัพย์</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="" align="left">
                              <label>
                                <input type="checkbox" id="test2" name="status" value="N"/>
                                <span>ลูกหนี้ไม่มีทรัพย์</span>
                              </label>
                            </div>
                          </div>
                        </div>

                        <p></p>
                        <br>
                        <div class="row">
                          <div class="col-md-12>
                            <div class="form-inline" align="center">
                              <button type="submit" class="btn btn-primary btn-app">
                                <span class="glyphicon glyphicon-print"></span> ปริ้น
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',8) }}" style="background-color:#DB0000; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                              </a>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
              </form>
            @endif

          </div>

    <script>
        $(function () {
            $('[data-mask]').inputmask()
        })
    </script>

    </section>
