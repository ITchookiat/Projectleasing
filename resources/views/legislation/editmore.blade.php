@extends('layouts.master')
@section('title','ลูกหนี้ของกลาง')
@section('content')

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

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
  
  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <form name="form1" action="{{ route('MasterLegis.update',[$id]) }}" method="post" id="formimage" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="type" value="10"/>

                <div class="card-header">
                  <h5 class="card-title">เพิ่มข้อมูลของกลาง</h5>
                  <div class="card-tools">
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fas fa-save"></i> บันทึก
                    </button>
                    <a class="btn btn-danger btn-sm" href="{{ route('MasterLegis.index') }}?type={{10}}">
                      <i class="far fa-window-close"></i> Close
                    </a>
                  </div>
                </div>

                <div class="card-body text-sm">
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
                                  <input type="text" name="ContractNo" class="form-control form-control-sm" maxlength="12" value="{{$data->Contract_legis}}" placeholder="ป้อนเลขที่สัญญา" required/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">วันที่รับเรื่อง :</label>
                                <div class="col-sm-7">
                                  <input type="date" name="DateExhibit" class="form-control form-control-sm" value="{{$data->Dateaccept_legis}}">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">ชื่อ-สกุลผู้เช่าซื้อ :</label>
                                <div class="col-sm-7">
                                  <input type="text" name="NameContract" class="form-control form-control-sm" value="{{$data->Name_legis}}" placeholder="ป้อนชื่อ-สกุลผู้เช่าซื้อ"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">สถานีตำรวจภูธร :</label>
                                <div class="col-sm-7">
                                  <input type="text" name="PoliceStation" class="form-control form-control-sm" value="{{$data->Policestation_legis}}" placeholder="ป้อนสถานีภูธร">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">ชื่อผู้ต้องหา :</label>
                                <div class="col-sm-7">
                                  <input type="text" name="NameSuspect" class="form-control form-control-sm" value="{{$data->Suspect_legis}}" placeholder="ป้อนชื่อผู้ต้องหา"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">ข้อหา :</label>
                                <div class="col-sm-7">
                                  <select name="PlaintExhibit" class="form-control form-control-sm">
                                    <option selected value="">---เลือกข้อหา---</option>
                                    <option value="ยาบ้า" {{($data->Plaint_legis === 'ยาบ้า') ? 'selected' : '' }}>ยาบ้า</option>
                                    <option value="พืชกระท่อม" {{($data->Plaint_legis === 'พืชกระท่อม') ? 'selected' : '' }}>พืชกระท่อม</option>
                                    <option value="ศุลกากร" {{($data->Plaint_legis === 'ศุลกากร') ? 'selected' : '' }}>ศุลกากร</option>
                                    <option value="จราจร" {{($data->Plaint_legis === 'จราจร') ? 'selected' : '' }}>จราจร</option>
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
                                  <input type="text" name="InquiryOfficial" class="form-control form-control-sm" value="{{$data->Inquiryofficial_legis}}" placeholder="ป้อนพนักงานสอบสวน"/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-5 col-form-label text-right">เบอร์โทรศัพท์ :</label>
                                <div class="col-sm-7">
                                  <input type="text" name="InquiryOfficialtel" class="form-control form-control-sm" value="{{$data->Inquiryofficialtel_legis}}" placeholder="ป้อนพนักงานสอบสวน"/>
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
                                    <option value="เร่งรัด" {{($data->Terminate_legis === 'เร่งรัด') ? 'selected' : '' }}>เร่งรัด</option>
                                    <option value="ทนาย" {{($data->Terminate_legis === 'ทนาย') ? 'selected' : '' }}>ทนาย</option>
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
                                    <option value="ของกลาง" {{($data->Typeexhibit_legis === 'ของกลาง') ? 'selected' : '' }}>ของกลาง</option>
                                    <option value="ยึดตามมาตราการ(ปปส.)" {{($data->Typeexhibit_legis === 'ยึดตามมาตราการ(ปปส.)') ? 'selected' : '' }}>ยึดตามมาตราการ(ปปส.)</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                              @if($data->Terminate_legis === 'ทนาย')
                                <div id="ShowTerminate">
                              @else
                                <div id="ShowTerminate" style="display:none;">
                              @endif
                                <div class="form-group row mb-0">
                                  <label class="col-sm-5 col-form-label text-right">วันที่ทนายส่งเรื่อง :</label>
                                  <div class="col-sm-7">
                                    <input type="date" name="DateLawyersend" class="form-control form-control-sm" value="{{$data->DateLawyersend_legis}}"/>
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
                          <textarea class="form-control" name="NoteExhibit" placeholder="ป้อนหมายเหตุ" style="width:100%;" rows="9">{{$data->Noteexhibit_legis}}</textarea>
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
                    
                  @if($data->Typeexhibit_legis == 'ของกลาง')
                    <div id="ShowType1">
                  @else
                    <div id="ShowType1" style="display:none;">
                  @endif
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
                                <input type="date" name="DateGiveword" value="{{$data->Dategiveword_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">ชั้นสำนวน :</label>
                              <div class="col-sm-7">
                                <select name="TypeGiveword" class="form-control form-control-sm">
                                  <option selected value="">---เลือกคำให้การ---</option>
                                  <option value="ชั้นพนักงานสอบสวน" {{($data->Typegiveword_legis === 'ชั้นพนักงานสอบสวน') ? 'selected' : '' }}>ชั้นพนักงานสอบสวน</otion>
                                  <option value="ชั้นพนักงานอัยการ" {{($data->Typegiveword_legis === 'ชั้นพนักงานอัยการ') ? 'selected' : '' }}>ชั้นพนักงานอัยการ</otion>
                                  <option value="ชั้นศาล" {{($data->Typegiveword_legis === 'ชั้นศาล') ? 'selected' : '' }}>ชั้นศาล</otion>
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
                                  <option value="คืน" {{($data->Resultexhibit1_legis === 'คืน') ? 'selected' : '' }}>คืน</otion>
                                  <option value="ไม่คืน" {{($data->Resultexhibit1_legis === 'ไม่คืน') ? 'selected' : '' }}>ไม่คืน</otion>
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
                                <input type="date" name="DateCheckexhibit" value="{{$data->Datecheckexhibit_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">วันที่เตรียมเอกสาร :</label>
                              <div class="col-sm-7">
                                <input type="date" name="DatePreparedoc" value="{{$data->Datepreparedoc_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">วิธีดำเนินการ :</label>
                              <div class="col-sm-7">
                                <select id="ProcessExhibit1" name="ProcessExhibit1" class="form-control form-control-sm">
                                  <option selected value="">---เลือกผล---</option>
                                  <option value="รับคืน" {{($data->Processexhibit1_legis === 'รับคืน') ? 'selected' : '' }}>รับคืน</otion>
                                  <option value="ไม่รับคืน" {{($data->Processexhibit1_legis === 'ไม่รับคืน') ? 'selected' : '' }}>ไม่รับคืน</otion>
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
                                <input type="date" name="DateSendword" value="{{$data->Datesendword_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">วันทีไต่สวน :</label>
                              <div class="col-sm-7">
                                <input type="date" name="DateInvestigate" value="{{$data->Dateinvestigate_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">วันที่ดำเนินการ :</label>
                              <div class="col-sm-7">
                                <input type="date" id="DategetResult1" name="DategetResult1" value="{{$data->Dategetresult_legis}}" class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  @if($data->Typeexhibit_legis == 'ยึดตามมาตราการ(ปปส.)')
                    <div id="ShowType2">
                  @else
                    <div id="ShowType2" style="display:none;">
                  @endif
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
                                <input type="date" name="DateSenddetail" value="{{$data->Datesenddetail_legis}}"  class="form-control form-control-sm"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">ผล :</label>
                              <div class="col-sm-7">
                                <select name="ResultExhibit2" class="form-control form-control-sm">
                                  <option selected value="">---เลือกผล---</option>
                                  <option value="รับเช็ค" {{($data->Resultexhibit2_legis === 'รับเช็ค') ? 'selected' : '' }}>รับเช็ค</otion>
                                  <option value="รับรถ" {{($data->Resultexhibit2_legis === 'รับรถ') ? 'selected' : '' }}>รับรถ</otion>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="form-group row mb-0">
                              <label class="col-sm-5 col-form-label text-right">วิธีดำเนินการ :</label>
                              <div class="col-sm-7">
                                <select id="ProcessExhibit2" name="ProcessExhibit2" class="form-control form-control-sm">
                                  <option selected value="">---เลือกผล---</option>
                                  <option value="ไปรับเช็ค" {{($data->Processexhibit2_legis === 'ไปรับเช็ค') ? 'selected' : '' }}>ไปรับเช็ค</otion>
                                  <option value="ไปรับรถ" {{($data->Processexhibit2_legis === 'ไปรับรถ') ? 'selected' : '' }}>ไปรับรถ</otion>
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
                                <input type="date" id="DategetResult2" name="DategetResult2" value="{{$data->Dategetresult_legis}}" class="form-control form-control-sm"/>
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
      </section>
    </div>
  </section>
  
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

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
