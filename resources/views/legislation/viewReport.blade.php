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

<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        @if($type == 1)
          รายงาน ลูกหนี้ประนอมหนี้
        @elseif($type == 2)
          รายงาน การชำระค่างวด(บุคคล)
        @elseif($type == 17)
          รายงาน ลูกหนี้
        @elseif($type == 18)
          รายงาน ลูกหนี้สืบพยาน
        @elseif($type == 19)
          รายงาน ลูกหนี้สืบทรัพย์
        @elseif($type == 3)
          รายงาน ตรวจสอบการรับชำระ
        @elseif($type == 4)
          รายงาน ลูกหนี้ประนอมหนี้
        @endif
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="card-body text-sm">
      @if($type == 2)   {{--การชำระค่างวด(บุคคล)--}}
        <form name="form1" action="{{ route('LegisCompro.ReportCompro',[5]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          @csrf
          
          <div class="row">
            <div class="col-md-6">
                <p class="text-center font-weight-bold"><font color="red">เลขที่สัญญา :</font></p>
                <input type="text" name="Contract" class="form-control text-center" style="padding:5px; width:200px; border-radius: 5px 0 5px 5px; font-size:24px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
            </div>
            <div class="col-md-6">
              <br>
              <button type="submit" class="btn bg-primary btn-app">
                <i class="fas fa-print"></i> ปริ้น
              </button>
              <a class="btn btn-app bg-danger" href="{{ route('MasterCompro.index') }}?type={{1}}">
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </form>
      @elseif($type == 1)  {{--รายงานประนอมหนี้--}}
        <form name="form1" action="{{ route('legislation.report' ,[00, 16]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>จากวันที่</label>
              <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">ถึงวันที่</label>
              <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
            </div>
          </div>

          <p></p>
          <div class="row">
            <div class="col-md-2">
              <div align="center">
                <label>สถานะ : </label>
              </div>
            </div>
            <div class="col-md-10">
              <div class="form-check form-check-inline">
                <label>
                  <input type="checkbox" id="test3" name="status" value="ชำระปกติ"/>
                  <span>ชำระปกติ</span>
                </label>
              </div>
              <div class="form-check form-check-inline">
                <label>
                  <input type="checkbox" id="test4" name="status" value="ขาดชำระ"/>
                  <span>ขาดชำระเกิน 3 งวด</span>
                </label>
              </div>
              <div class="form-check form-check-inline">
                <label>
                  <input type="checkbox" id="test5" name="status" value="ปิดบัญชี"/>
                  <span>ปิดบัญชี</span>
                </label>
              </div>
            </div>
          </div>

          <div class="card-footer text-center">
            <button type="submit" class="btn bg-danger btn-app">
              <span class="fa fa-file-pdf-o"></span> PDF
            </button>
            <a class="btn btn-app bg-danger" href="{{ route('MasterCompro.index') }}?type={{1}}">
              <i class="fas fa-times"></i> ยกเลิก
            </a>
          </div>
        </form>
      @elseif($type == 17)  {{--รายงานลูกหนี้--}}
        <form name="form1" action="{{ route('legislation.report' ,[00, 17]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>จากวันที่</label>
              <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">ถึงวันที่</label>
              <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="" align="left">
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
                  <input type="checkbox" id="test2" name="status" value="ลูกหนี้รอฟ้อง"/>
                  <span>ลูกหนี้รอฟ้อง</span>
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
          <div class="card-footer text-center">
            <button type="submit" class="btn bg-success btn-app">
              <i class="far fa-file-excel"></i> Excel
            </button>
            <a class="btn btn-app bg-danger" href="{{ route('legislation',2) }}">
              <i class="fas fa-times"></i> ยกเลิก
            </a>
          </div>
        </form>
      @elseif($type == 18)  {{--รายงานลูกหนี้สืบพยาน--}}
        <form name="form1" action="{{ route('legislation.report' ,[00, 18]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>จากวันที่</label>
              <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">ถึงวันที่</label>
              <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
          </div>

          <p></p>
          <div class="card-footer text-center">
            <button type="submit" class="btn bg-primary btn-app">
              <i class="fas fa-print"></i> ปริ้น
            </button>
            <a class="btn btn-app bg-danger" href="{{ route('legislation',2) }}">
              <i class="fas fa-times"></i> ยกเลิก
            </a>
          </div>
        </form>
      @elseif($type == 19)  {{--รายงานลูกหนี้สืบทรัพย์--}}
        <form name="form1" action="{{ route('legislation.report' ,[00, 19]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>จากวันที่</label>
              <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">ถึงวันที่</label>
              <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control"/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="" align="left">
                <label>สถานะ : </label>
              </div>
            </div>
            <div class="col-md-4">
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
          <div class="card-footer text-center">
            <button type="submit" class="btn bg-primary btn-app">
              <i class="fas fa-print"></i> ปริ้น
            </button>
            <a class="btn btn-app bg-danger" href="{{ route('legislation', 8) }}">
              <i class="fas fa-times"></i> ยกเลิก
            </a>
          </div>
        </form>
      @elseif($type == 3) {{--ตรวจสอบการรับชำระ--}}
        <form name="form1" action="{{ route('LegisCompro.ReportCompro',[4]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>จากวันที่</label>
              <input type="date" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">ถึงวันที่</label>
              <input type="date" name="Todate" value="{{ date('Y-m-d') }}" class="form-control form-control-sm"/>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>ผู้รับชำระ : </label>
              <select name="CashReceiver" class="form-control form-control-sm" style="width: 100%;">
                <option value="" selected>--- เลือกผู้รับชำระ ---</option>
                @foreach ($dataDB as $key => $value)
                  <option value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="card-footer text-center">
            <button type="submit" class="btn bg-primary btn-app">
              <i class="fas fa-print"></i> ปริ้น
            </button>
            <a class="btn btn-app bg-danger" href="{{ route('MasterCompro.index') }}?type={{1}}">
              <i class="fas fa-times"></i> ยกเลิก
            </a>
          </div>
        </form>
      @endif
    </div>
  </div>
</section>

<script>
  $(function () {
      $('[data-mask]').inputmask()
  })
</script>