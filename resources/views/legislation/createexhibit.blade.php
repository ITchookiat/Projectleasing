@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 542;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.$m.'-'.$d;
@endphp

<section class="content">
  <form name="form1" action="{{ route('MasterLegis.store') }}" method="post" id="formimage" enctype="multipart/form-data">
    @csrf
    <div class="card card-warning text-sm">
      <div class="card-header">
        <h5 class="card-title">เพิ่มข้อมูลของกลาง</h5>
        <div class="card-tools">
          <button type="submit" class="btn btn-success btn-tool">
            <i class="fas fa-save"></i> บันทึก
          </button>
          <a class="btn btn-danger btn-tool" href="{{ route('MasterLegis.index') }}?type={{10}}">
            <i class="far fa-window-close"></i> Close
          </a>
        </div>
      </div>

      <div class="card-body">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-9">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"><i class="fa fa-user"></i> ข้อมูลผู้เช่าซื้อ</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right"><font color="red">เลขที่สัญญา : </font></label>
                        <div class="col-sm-7">
                          <input type="text" name="ContractNo" class="form-control form-control-sm" maxlength="12" placeholder="ป้อนเลขที่สัญญา" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">วันที่รับเรื่อง :</label>
                        <div class="col-sm-7">
                          <input type="date" name="DateExhibit" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">ชื่อ-สกุลผู้เช่าซื้อ :</label>
                        <div class="col-sm-7">
                          <input type="text" name="NameContract" class="form-control form-control-sm" placeholder="ป้อนชื่อ-สกุลผู้เช่าซื้อ"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">สถานีตำรวจภูธร :</label>
                        <div class="col-sm-7">
                          <input type="text" name="PoliceStation" class="form-control form-control-sm" placeholder="ป้อนสถานีภูธร">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">ชื่อผู้ต้องหา :</label>
                        <div class="col-sm-7">
                          <input type="text" name="NameSuspect" class="form-control form-control-sm" placeholder="ป้อนชื่อผู้ต้องหา"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">ข้อหา :</label>
                        <div class="col-sm-7">
                          <select name="PlaintExhibit" class="form-control form-control-sm">
                            <option selected value="">---เลือกข้อหา---</option>
                            <option value="ยาบ้า">ยาบ้า</option>
                            <option value="พืชกระท่อม">พืชกระท่อม</option>
                            <option value="ศุลกากร">ศุลกากร</option>
                            <option value="จราจร">จราจร</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">พนักงานสอบสวน :</label>
                        <div class="col-sm-7">
                          <input type="text" name="InquiryOfficial" class="form-control form-control-sm" placeholder="ป้อนพนักงานสอบสวน"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">เบอร์โทรศัพท์ :</label>
                        <div class="col-sm-7">
                          <input type="text" name="InquiryOfficialtel" class="form-control form-control-sm" placeholder="ป้อนพนักงานสอบสวน"/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">บอกเลิกสัญญา :</label>
                        <div class="col-sm-7">
                          <select id="TerminateExhibit" name="TerminateExhibit" class="form-control form-control-sm">
                            <option selected value="">---เลือกบอกเลิกสัญญา---</option>
                            <option value="เร่งรัด">เร่งรัด</option>
                            <option value="ทนาย">ทนาย</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label text-right">ประเภทของกลาง :</label>
                        <div class="col-sm-7">
                          <select id="TypeExhibit" name="TypeExhibit" class="form-control form-control-sm">
                            <option selected value="">---เลือกประเภท---</option>
                            <option value="ของกลาง">ของกลาง</option>
                            <option value="ยึดตามมาตราการ(ปปส.)">ยึดตามมาตราการ(ปปส.)</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div id="ShowTerminate" style="display:none;">
                        <div class="form-group row mb-0">
                          <label class="col-sm-5 col-form-label text-right">วันที่ทนายส่งเรื่อง :</label>
                          <div class="col-sm-7">
                            <input type="date" name="DateLawyersend" class="form-control form-control-sm"/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"><i class="fa  fa-edit"></i> หมายเหตุ</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <textarea class="form-control" name="NoteExhibit" placeholder="ป้อนหมายเหตุ" style="width:100%;" rows="8"></textarea>
                </div>
              </div>
            </div>
          </div>

          <script>
              $('#TypeExhibit').change(function(){
                var value = document.getElementById('TypeExhibit').value;
                  if(value == 'ของกลาง'){
                    $('#ShowType1').show();
                    $('#ShowType2').hide();
                  }
                  else if(value == 'ยึดตามมาตราการ(ปปส.)'){
                    $('#ShowType1').hide();
                    $('#ShowType2').show();
                  }
                  else{
                    $('#ShowType1').hide();
                    $('#ShowType2').hide();
                  }
              });
              $('#TerminateExhibit').change(function(){
                var value = document.getElementById('TerminateExhibit').value;
                  if(value == 'ทนาย'){
                    $('#ShowTerminate').show();
                  }
                  else{
                    $('#ShowTerminate').hide();
                  }
              });
          </script>
          
          <div id="ShowType1" style="display:none;">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-arrows"></i> ประเภทของกลาง</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่สอบคำให้การ :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DateGiveword" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">ชั้นสำนวน :</label>
                      <div class="col-sm-7">
                        <select name="TypeGiveword" class="form-control form-control-sm">
                          <option selected value="">---เลือกคำให้การ---</option>
                          <option value="พนักงานสอบสวน">ชั้นพนักงานสอบสวน</option>
                          <option value="พนักงานอัยการ">ชั้นพนักงานอัยการ</option>
                          <option value="ชั้นศาล">ชั้นศาล</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">ผล :</label>
                      <div class="col-sm-7">
                        <select name="ResultExhibit1" class="form-control form-control-sm">
                          <option selected value="">---เลือกผล---</option>
                            <option value="คืน">คืน</option>
                            <option value="ไม่คืน">ไม่คืน</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่เช็คสำนวน :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DateCheckexhibit" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่เตรียมเอกสาร :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DatePreparedoc" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วิธีดำเนินการ :</label>
                      <div class="col-sm-7">
                        <select id="ProcessExhibit1" name="ProcessExhibit1" class="form-control form-control-sm">
                          <option selected value="">---เลือกวิธีดำเนินการ---</option>
                          <option value="รับคืน">รับคืน</otion>
                          <option value="ไม่รับคืน">ไม่รับคืน</otion>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                  $('#ProcessExhibit1').change(function(){
                    var value = document.getElementById('ProcessExhibit1').value;
                    var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");
                      if(value != ''){
                        $('#DategetResult1').val(date);
                      }
                      else{
                        $('#DategetResult1').val('');
                      }
                  });
                </script>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่ยื่นคำร้อง :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DateSendword" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันทีไต่สวน :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DateInvestigate" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่ดำเนินการ :</label>
                      <div class="col-sm-7">
                        <input type="date" id="DategetResult1" name="DategetResult1" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div id="ShowType2" style="display:none;">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-gg"></i> ประเภทยึดตามมาตราการ(ปปส.)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันทีส่งรายละเอียด :</label>
                      <div class="col-sm-7">
                        <input type="date" name="DateSenddetail" class="form-control form-control-sm"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">ผล :</label>
                      <div class="col-sm-7">
                        <select name="ResultExhibit2" class="form-control form-control-sm">
                          <option selected value="">---เลือกผล---</option>
                            <option value="รับเช็ค">รับเช็ค</option>
                            <option value="รับรถ">รับรถ</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วิธีดำเนินการ :</label>
                      <div class="col-sm-7">
                        <select id="ProcessExhibit2" name="ProcessExhibit2" class="form-control form-control-sm">
                          <option selected value="">---เลือกวิธีดำเนินการ---</option>
                          <option value="ไปรับเช็ค">ไปรับเช็ค</option>
                          <option value="ไปรับรถ">ไปรับรถ</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <script>
                    $('#ProcessExhibit2').change(function(){
                      var value = document.getElementById('ProcessExhibit2').value;
                      var today = new Date();
                      var date = today.getFullYear()+'-'+(today.getMonth()+1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");
                        if(value != ''){
                          $('#DategetResult2').val(date);
                        }
                        else{
                          $('#DategetResult2').val('');
                        }
                    });
                </script>

                <div class="row">
                  <div class="col-8">
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-5 col-form-label text-right">วันที่ดำเนินการ :</label>
                      <div class="col-sm-7">
                        <input type="date" id="DategetResult2" name="DategetResult2" class="form-control form-control-sm"/>
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
    <input type="hidden" name="type" value="10"/>
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
  </form>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>
