@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">ลูกหนี้โกงเจ้าหนี้</h4>
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
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 7]) }}">ชั้นบังคับคดี</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 13]) }}">โกงเจ้าหนี้</a></li>
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

            <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
              @csrf
              @method('put')

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="info-box">
                      <div class="row">
                        <div class="col-md-9">
                          <span class="info-box-icon bg-red"><i class="fa fa-id-badge fa-lg"></i></span>
                          <div class="info-box-content">
                              <div class="col-md-4">
                                <span class="info-box-number"><font style="font-size: 30px;">{{ $data->Contract_legis }}</font></span>
                                <span class="info-box-text"><font style="font-size: 20px;">{{ $data->Name_legis }}</font></span>
                              </div>
                              <div class="col-md-8">
                                <div class="form-inline">
                                  <p></p>
                                  <div class="" align="center">
                                    <small class="label label-success" style="font-size: 25px;">
                                      <i class="fa fa-expeditedssl"></i>
                                      @if($data->Status_legis == "จ่ายจบก่อนฟ้อง")
                                        จ่ายจบก่อนฟ้อง
                                      @elseif($data->Status_legis == "ยึดรถก่อนฟ้อง")
                                        ยึดรถก่อนฟ้อง
                                      @elseif($data->Status_legis == "ปิดบัญชีประนอมหนี้")
                                        ปิดบัญชีประนอมหนี้
                                      @elseif($data->Status_legis == "ยึดรถหลังฟ้อง")
                                        ยึดรถหลังฟ้อง
                                      @elseif($data->Status_legis == "หมดอายุความคดี")
                                        หมดอายุความคดี
                                      @endif
                                    </small>
                                  </div>
                                  <p></p>
                                  <label>สถานะ : </label>
                                  <select name="Statuslegis" class="form-control" style="width: 170px;">
                                    <option value="" selected>--- status ---</option>
                                    <option value="จ่ายจบก่อนฟ้อง" {{ ($data->Status_legis === 'จ่ายจบก่อนฟ้อง') ? 'selected' : '' }}>จ่ายจบก่อนฟ้อง</option>
                                    <option value="ยึดรถก่อนฟ้อง" {{ ($data->Status_legis === 'ยึดรถก่อนฟ้อง') ? 'selected' : '' }}>ยึดรถก่อนฟ้อง</option>
                                    <option value="ปิดบัญชีประนอมหนี้" {{ ($data->Status_legis === 'ปิดบัญชีประนอมหนี้') ? 'selected' : '' }}>ปิดบัญชีประนอมหนี้</option>
                                    <option value="ยึดรถหลังฟ้อง" {{ ($data->Status_legis === 'ยึดรถหลังฟ้อง') ? 'selected' : '' }}>ยึดรถหลังฟ้อง</option>
                                    <option value="หมดอายุความคดี" {{ ($data->Status_legis === 'หมดอายุความคดี') ? 'selected' : '' }}>หมดอายุความคดี</option>
                                  </select>

                                  <!-- <input type="text" id="txtStatuslegis" name="txtStatuslegis" class="form-control" style="width: 100px;" oninput="AddComma();"> -->
                                  <input type="date" name="DateStatuslegis" class="form-control" style="width: 170px;" value="{{ $data->DateStatus_legis }}">
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <br>
                          <div class="form-inline" align="right">
                            <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                            </button>
                            <a class="btn btn-app" href="{{ route('legislation',2) }}" style="background-color:#DB0000; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                            </a>
                          </div>
                        </div>
                      </div>

                      <div class="info-box-content">
                        <div class="progress">
                          <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                        </span>
                      </div>

                      <h4 class="card-title p-3" align="left"><b>ขั้นตอนชั้นโกงเจ้าหนี้</b></h4>

                      <div class="box box-warning box-solid">
                        <div class="nav-tabs-custom" style="background-color : #f39c12;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-unsorted"></i> ขั้นตอนระบบ</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="col-md-6">
                                      วันที่แจ้งความ
                                      <input type="date" id="DateNoticeCheat" name="DateNoticeCheat" value="{{ ($data->DateNotice_cheat !== Null) ?$data->DateNotice_cheat : 'วว/ดด/ปปปป' }}" class="form-control" readonly/>
                                      วันที่อัยการยื่นคำฟ้อง
                                      <input type="date" id="DateindictmentCheat" name="DateindictmentCheat" value="{{ $data->Dateindictment_cheat }}" class="form-control"/>
                                      วันที่สืบพยาน
                                      <input type="date" id="DateExamineCheat" name="DateExamineCheat" value="{{ $data->DateExamine_cheat }}" class="form-control"/>
                                    </div>
                                    <div class="col-md-6">
                                      วันที่นัดสอบคำให้การ
                                      <input type="date" id="DatedepositionCheat" name="DatedepositionCheat" value="{{ $data->Datedeposition_cheat }}" class="form-control"/>
                                      วันที่ยื่นคำร้องเป็นโจทก์ร่วม
                                      <input type="date" id="DateplantiffCheat" name="DateplantiffCheat" value="{{ $data->Dateplantiff_cheat }}" class="form-control"/>
                                      สถานะ
                                      <select id="StatusCheat" name="StatusCheat" class="form-control">
                                        <option value="" selected>--- เลือกสถานะ ---</option>
                                        <option value="ศาลพิพากษา" {{ ($data->Status_cheat === 'ศาลพิพากษา') ? 'selected' : '' }}>ศาลพิพากษา</option>
                                        <option value="ประนีประนอม(ศาลจำหน่ายคดี)" {{ ($data->Status_cheat === 'ประนีประนอม(ศาลจำหน่ายคดี)') ? 'selected' : '' }}>ประนีประนอม(ศาลจำหน่ายคดี)</option>
                                        <option value="ยื่นคำร้องให้ศาลพิพากษา" {{ ($data->Status_cheat === 'ยื่นคำร้องให้ศาลพิพากษา') ? 'selected' : '' }}>ยื่นคำร้องให้ศาลพิพากษา</option>
                                        <option value="ปิดบัญชี" {{ ($data->Status_cheat === 'ปิดบัญชี') ? 'selected' : '' }}>ปิดบัญชี</option>
                                    </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    หมายเหตุ
                                    <textarea name="noteCheat" class="form-control" rows="6">{{ $data->note_cheat }}</textarea>
                                  </div>
                                </div>

                              </div>
                            </div>
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


      <!-- เวลาแจ้งเตือน -->
      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>


    </section>
@endsection
