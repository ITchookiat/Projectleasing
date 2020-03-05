@extends('layouts.master')
@section('title','ร้อมูลรถยนต์มือ 2')
@section('content')

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

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- <section class="content-header">
        <h1>
          เร่งรัดหนี้สิน
          <small>ระบบสต็อกรถเร่งรัด</small>
        </h1>
    </section> -->

    <section class="content">
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          @if($type == 10)
          <h4 align="center"><b>แก้ไขข้อมูลของกลาง</b></h3>
          @elseif($type == 12)
          <h4 align="center"><b>แก้ไขข้อมูลขายฝาก</b></h3>
          @endif
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
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

          @if($type == 10)
            <form name="form1" action="{{ action('LegislationController@update',[$id,$type]) }}" method="post" id="formimage" enctype="multipart/form-data">
              @csrf
              @method('put')
               <div class="row">
                  <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="tab-content">

                              <div class="row">
                                <div class="col-md-9">
                                  <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                      <h4 class="box-title"><i class="fa fa-user"></i> ข้อมูลผู้เช่าซื้อ</h4>
                                      <a href="#" data-toggle="modal" data-target="#modal-default" title="ข้อมูลรถยนต์" data-backdrop="static" data-keyboard="false">
                                        <i class="fa fa-car pull-right"></i>
                                      </a>
                                    </div>
                                    <div class="box-body">

                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font color="red">เลขที่สัญญา : </font></label>
                                              <input type="text" name="ContractNo" class="form-control" value="{{$data->Contract_legis}}" style="width: 250px;" maxlength="12" placeholder="ป้อนเลขที่สัญญา"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>วันที่รับเรื่อง : </font></label>
                                              <input type="date" name="DateExhibit" class="form-control" style="width: 250px;" value="{{$data->Dateaccept_legis}}">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>ชื่อ-สกุลผู้เช่าซื้อ : </font></label>
                                              <input type="text" name="NameContract" class="form-control" value="{{$data->Name_legis}}" style="width: 250px;" placeholder="ป้อนชื่อ-สกุลผู้เช่าซื้อ"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>สถานีตำรวจภูธร : </font></label>
                                              <input type="text" name="PoliceStation" class="form-control" value="{{$data->Policestation_legis}}" style="width: 250px;" placeholder="ป้อนสถานีภูธร">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>ชื่อผู้ต้องหา : </font></label>
                                              <input type="text" name="NameSuspect" class="form-control" value="{{$data->Suspect_legis}}" style="width: 250px;" placeholder="ป้อนชื่อผู้ต้องหา"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>ข้อหา : </font></label>
                                              <select name="PlaintExhibit" class="form-control" style="width: 250px">
                                                <option selected value="">---เลือกข้อหา---</option>
                                                  <option value="ยาบ้า" {{($data->Plaint_legis === 'ยาบ้า') ? 'selected' : '' }}>ยาบ้า</otion>
                                                  <option value="พืชกระท่อม" {{($data->Plaint_legis === 'พืชกระท่อม') ? 'selected' : '' }}>พืชกระท่อม</otion>
                                                  <option value="ศุลกากร" {{($data->Plaint_legis === 'ศุลกากร') ? 'selected' : '' }}>ศุลกากร</otion>
                                                  <option value="จราจร" {{($data->Plaint_legis === 'จราจร') ? 'selected' : '' }}>จราจร</otion>
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>พนักงานสอบสวน : </font></label>
                                              <input type="text" name="InquiryOfficial" class="form-control" value="{{$data->Inquiryofficial_legis}}" style="width: 250px;" placeholder="ป้อนพนักงานสอบสวน"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>เบอร์โทรศัพท์ : </font></label>
                                              <input type="text" name="InquiryOfficialtel" class="form-control" value="{{$data->Inquiryofficialtel_legis}}" style="width: 250px;" placeholder="ป้อนพนักงานสอบสวน"/>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-inline" align="right">
                                             <label><font>บอกเลิกสัญญา : </font></label>
                                             <select id="TerminateExhibit" name="TerminateExhibit" class="form-control" style="width: 250px">
                                               <option selected value="">---เลือกบอกเลิกสัญญา---</option>
                                                 <option value="เร่งรัด" {{($data->Terminate_legis === 'เร่งรัด') ? 'selected' : '' }}>เร่งรัด</otion>
                                                 <option value="ทนาย" {{($data->Terminate_legis === 'ทนาย') ? 'selected' : '' }}>ทนาย</otion>
                                             </select>
                                           </div>
                                        </div>
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                             <label><font>ประเภทของกลาง : </font></label>
                                             <select id="TypeExhibit" name="TypeExhibit" class="form-control" style="width: 250px">
                                               <option selected value="">---เลือกประเภท---</option>
                                               <option value="ของกลาง" {{($data->Typeexhibit_legis === 'ของกลาง') ? 'selected' : '' }}>ของกลาง</otion>
                                               <option value="ยึดตามมาตราการ(ปปส.)" {{($data->Typeexhibit_legis === 'ยึดตามมาตราการ(ปปส.)') ? 'selected' : '' }}>ยึดตามมาตราการ(ปปส.)</otion>
                                             </select>
                                           </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        @if($data->Terminate_legis === 'ทนาย')
                                        <div class="col-md-6" id="ShowTerminate">
                                        @else
                                        <div class="col-md-6" id="ShowTerminate" style="display:none;">
                                        @endif
                                          <div class="form-inline" align="right">
                                            <label><font>วันที่ทนายส่งเรื่อง : </font></label>
                                            <input type="date" name="DateLawyersend" class="form-control" value="{{$data->DateLawyersend_legis}}" style="width: 250px;"/>
                                          </div>
                                        </div>
                                      </div>
                                      <br>
                                      {{--
                                      <!-- สถานะงาน -->
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>สถานะปัจจุบัน : </font></label>
                                              <select name="Currentstatus" class="form-control" style="width: 250px;background-color: #9CFD91;">
                                                <option selected value="">---เลือกสถานะ---</option>
                                                  <option value="ยื่นคำร้อง">ยื่นคำร้อง</otion>
                                                  <option value="นัดไต่สวน">นัดไต่สวน</otion>
                                                  <option value="นัดฟังคำสั่ง">นัดฟังคำสั่ง</otion>
                                                  <!-- <option value="ตรวจขยายอุทธรณ์">ตรวจขยายอุทธรณ์</otion>
                                                  <option value="รอหนังสือ ปปส">รอหนังสือ ปปส</otion> -->
                                                  <option value="แจ้งยอด ปปส">แจ้งยอด ปปส</otion>
                                                  <option value="นัดรับของกลาง">นัดรับของกลาง</otion>
                                                  <option value="รับของกลาง">รับของกลาง</otion>
                                                  <option value="ส่งหนังสือแจ้งขาย">ส่งหนังสือแจ้งขาย</otion>
                                                  <option value="ตั้งขาย">ตั้งขาย</otion>
                                                  <option value="ปิดงาน">ปิดงาน</otion>
                                                  <!-- <option value="ขายขาดทุนลูกหนี้งานฟ้อง">ขายขาดทุนลูกหนี้งานฟ้อง</otion> -->
                                                  <option value="รอรับเช็ค">รอรับเช็ค</otion>
                                                  <!-- <option value="รอคำสั่งเลขาฯ">รอคำสั่งเลขาฯ</otion> -->
                                              </select>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>สถานะต่อไป : </font></label>
                                              <select name="Nextstatus" class="form-control" style="width: 250px;background-color: #91ABFD;">
                                                <option selected value="">---เลือกสถานะ---</option>
                                                  <option value="ยื่นคำร้อง">ยื่นคำร้อง</otion>
                                                  <option value="นัดไต่สวน">นัดไต่สวน</otion>
                                                  <option value="นัดฟังคำสั่ง">นัดฟังคำสั่ง</otion>
                                                  <!-- <option value="ตรวจขยายอุทธรณ์">ตรวจขยายอุทธรณ์</otion>
                                                  <option value="รอหนังสือ ปปส">รอหนังสือ ปปส</otion> -->
                                                  <option value="แจ้งยอด ปปส">แจ้งยอด ปปส</otion>
                                                  <option value="นัดรับของกลาง">นัดรับของกลาง</otion>
                                                  <option value="รับของกลาง">รับของกลาง</otion>
                                                  <option value="ส่งหนังแจ้งขาย">ส่งหนังสือแจ้งขาย</otion>
                                                  <option value="ตั้งขาย">ตั้งขาย</otion>
                                                  <option value="ปิดงาน">ปิดงาน</otion>
                                                  <!-- <option value="ขายขาดทุนลูกหนี้งานฟ้อง">ขายขาดทุนลูกหนี้งานฟ้อง</otion> -->
                                                  <option value="รอรับเช็ค">รอรับเช็ค</otion>
                                                  <!-- <option value="รอคำสั่งเลขาฯ">รอคำสั่งเลขาฯ</otion> -->
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                      --}}

                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                      <h4 class="box-title"><i class="fa  fa-edit"></i> หมายเหตุ</h4>
                                    </div>
                                    <div class="box-body">
                                      <div class="row">
                                         <div class="col-md-12">
                                           <div class="form-inline" align="right">
                                              <textarea class="form-control" name="NoteExhibit" placeholder="ป้อนหมายเหตุ" style="width:100%;" rows="9">{{$data->Noteexhibit_legis}}</textarea>
                                            </div>
                                         </div>
                                      </div>
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
                              <div class="row">
                                @if($data->Typeexhibit_legis == 'ของกลาง')
                                <div id="ShowType1">
                                @else
                                <div id="ShowType1" style="display:none;">
                                @endif
                                  <div class="col-md-12">
                                    <div class="box box-default box-solid">
                                      <div class="box-header with-border">
                                        <h5 class="box-title">
                                          <i class="fa fa-arrows"></i>
                                          ประเภทของกลาง
                                        </h5>
                                        <div class="box-tools pull-center">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="box-body">

                                        <div class="row">
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                                <label><font>วันที่สอบคำให้การ : </font></label>
                                                <input type="date" name="DateGiveword" class="form-control" value="{{$data->Dategiveword_legis}}" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>คำให้การ : </font></label>
                                               <select name="TypeGiveword" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกคำให้การ---</option>
                                                 <option value="พนักงานสอบสวน" {{($data->Typegiveword_legis === 'พนักงานสอบสวน') ? 'selected' : '' }}>พนักงานสอบสวน</otion>
                                                 <option value="พนักงานอัยการ" {{($data->Typegiveword_legis === 'พนักงานอัยการ') ? 'selected' : '' }}>พนักงานอัยการ</otion>
                                                 <option value="ชั้นศาล" {{($data->Typegiveword_legis === 'ชั้นศาล') ? 'selected' : '' }}>ชั้นศาล</otion>
                                               </select>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>ผล : </font></label>
                                               <select name="ResultExhibit1" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกผล---</option>
                                                   <option value="คืน" {{($data->Resultexhibit1_legis === 'คืน') ? 'selected' : '' }}>คืน</otion>
                                                   <option value="ไม่คืน" {{($data->Resultexhibit1_legis === 'ไม่คืน') ? 'selected' : '' }}>ไม่คืน</otion>
                                               </select>
                                             </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่เช็คสำนวน : </font></label>
                                               <input type="date" name="DateCheckexhibit" class="form-control" value="{{$data->Datecheckexhibit_legis}}" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่เตรียมเอกสาร : </font></label>
                                               <input type="date" name="DatePreparedoc" class="form-control" value="{{$data->Datepreparedoc_legis}}" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ทราบผล : </font></label>
                                               <input type="date" name="DategetResult1" class="form-control" value="{{$data->Dategetresult_legis}}" style="width: 250px"/>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ยื่นคำร้อง : </font></label>
                                               <input type="date" name="DateSendword" class="form-control" value="{{$data->Datesendword_legis}}" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันทีไต่สวน : </font></label>
                                               <input type="date" name="DateInvestigate" class="form-control" value="{{$data->Dateinvestigate_legis}}" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">

                                             </div>
                                           </div>
                                        </div>

                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="col-md-3">
                                    <div style="border-radius: 25px; background: #73AD21;padding: 20px;width: 280px;height: 120px;">
                                      Alert
                                    </div>
                                  </div> -->
                                </div>
                                @if($data->Typeexhibit_legis == 'ยึดตามมาตราการ(ปปส.)')
                                <div id="ShowType2">
                                @else
                                <div id="ShowType2" style="display:none;">
                                @endif
                                  <div class="col-md-12">
                                    <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                      <h4 class="box-title">
                                        <i class="fa fa-gg"></i>
                                        ประเภทยึดตามมาตราการ(ปปส.)
                                      </h4>
                                      <div class="box-tools pull-center">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="box-body">

                                      <div class="row">
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                                <label><font>วันทีส่งรายละเอียด : </font></label>
                                                <input type="date" name="DateSenddetail" class="form-control" value="{{$data->Datesenddetail_legis}}" style="width: 250px"/>
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>ผล : </font></label>
                                               <select name="ResultExhibit2" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกผล---</option>
                                                   <option value="รับเช็ค" {{($data->Resultexhibit2_legis === 'รับเช็ค') ? 'selected' : '' }}>รับเช็ค</otion>
                                                   <option value="รับรถ" {{($data->Resultexhibit2_legis === 'รับรถ') ? 'selected' : '' }}>รับรถ</otion>
                                               </select>
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ทราบผล : </font></label>
                                               <input type="date" name="DategetResult2" class="form-control" value="{{$data->Dategetresult_legis}}" style="width: 250px"/>
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
                      <br>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ route('legislation', 10) }}">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div>
                </div>

              </form>
          @elseif($type == 12)
            <form name="form1" action="{{ action('LegislationController@update',[$id,$type]) }}" method="post" id="formimage" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div class="info-box">
                    <div class="row">
                      <div class="col-md-9">
                        <span class="info-box-icon  bg-red"><i class="fa fa-id-badge fa-lg"></i></span>
                        <div class="info-box-content">
                            <div class="col-md-4">
                              <span class="info-box-number"><font style="font-size: 30px;">{{ $data->ContractNo_legis }}</font></span>
                              <span class="info-box-text"><font style="font-size: 20px;">{{ $data->Name_legis }}</font></span>
                            </div>
                            <div class="col-md-8">
                              <div class="form-inline">
                                <p></p>
                                <div class="" align="center">
                                  <small class="label label-success" style="font-size: 25px;">
                                    <i class="fa fa-expeditedssl"></i>
                                      @if($data->Statusland_legis == "ไม่จบงาน")
                                        ไม่จบงาน
                                      @elseif($data->Statusland_legis == "จบงาน")
                                        จบงาน
                                      @elseif($data->Statusland_legis == "ปิดบัญชี")
                                        ปิดบัญชี
                                      @endif
                                  </small>
                                </div>
                                <p></p>
                                <label>สถานะ : </label>
                                <select id="Statuslandlegis" name="Statuslandlegis" class="form-control" style="width: 170px;">
                                  <option selected value="">---เลือกสถานะ---</option>
                                  <!-- <option value="ไม่จบงาน" {{($data->Statusland_legis === 'ไม่จบงาน') ? 'selected' : '' }}>ไม่จบงาน</otion> -->
                                  <option value="จบงาน" {{($data->Statusland_legis === 'จบงาน') ? 'selected' : '' }}>จบงาน</otion>
                                  <option value="ปิดบัญชี" {{($data->Statusland_legis === 'ปิดบัญชี') ? 'selected' : '' }}>ปิดบัญชี</otion>
                                </select>
                                <script>
                                    $('#Statuslandlegis').change(function(){
                                      var today = new Date();
                                      var date = today.getFullYear()+'-'+(today.getMonth()+1).toString().padStart(2, "0")+'-'+today.getDate().toString().padStart(2, "0");
                                      var value = document.getElementById('Statuslandlegis').value;
                                        if(value != ''){
                                          $('#DateStatuslandlegis').val(date);
                                        }
                                        else{
                                          $('#DateStatuslandlegis').val('');
                                        }
                                    });
                                </script>
                                <input type="date" id="DateStatuslandlegis" name="DateStatuslandlegis" value="{{$data->Datestatusland_legis}}" class="form-control" style="width: 170px;">
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
                          <a class="btn btn-app" href="{{ route('legislation',12) }}" style="background-color:#DB0000; color:#FFFFFF;">
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

                    <script>
                      function comma(val){
                        while (/(\d+)(\d{3})/.test(val.toString())){
                          val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
                        }
                        return val;
                      }

                      function AddComma(){
                          var price = document.getElementById('txtStatuslegis').value;
                          var Setprice = price.replace(",","");

                          document.form1.txtStatuslegis.value = comma(Setprice);
                      }
                    </script>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="box box-warning box-solid">
                          <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user"></i> ข้อมูลผู้เช่าซื้อ</h3>
                            <div class="box-tools pull-center">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-4">
                                วันที่ทำสัญญา
                                <div class="form-inline" align="left">
                                  <input type="text" name="DateDuelegis" class="form-control" style="width: 100%;" value="{{ DateThai($data1->SDATE) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ยอดจัด
                                <div class="form-inline" align="left">
                                  <input type="text" name="Paylegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->STDPRC ,2) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ดอกเบี้ย
                                <div class="form-inline" align="left">
                                  <input type="text" name="InterestRate" class="form-control" style="width: 100%;" value="{{ $data1->EFRATE }}%" readonly/> {{--({{number_format($data1->NPROFIT,2)}})--}}
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                ยอดที่ต้องชำระ
                                <div class="form-inline" align="left">
                                  <input type="text" name="Paylegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->KEYINPRC ,2) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ชำระแล้ว
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforemoneylegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->SMPAY, 2) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ลูกหนี้คงเหลือ
                                <div class="form-inline" align="left">
                                  <input type="text" name="Sumperiodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->NPRICE - $data1->SMPAY, 2) }}" readonly/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                ผ่อนงวดละ
                                <div class="form-inline" align="left">
                                  <input type="text" name="PayAmount" class="form-control" style="width: 100%;" value="{{number_format($data1->KEYINFUPAY,2) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                จำนวนงวดทั้งหมด
                                <div class="form-inline" align="left">
                                  <input type="text" name="Countperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->T_NOPAY }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ค้างงวดจริง
                                <div class="form-inline" align="left">
                                  <input type="text" name="Realperiodlegis" class="form-control" style="width: 100%;" value="{{ number_format($data1->HLDNO, 2) }}" readonly/>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-4">
                                ที่อยู่
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8', $data1->ADDRES) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ซอย
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{(iconv('Tis-620','utf-8',$data1->SOI == ''))?$data1->SOI: '-' }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                หมู่
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{(iconv('Tis-620','utf-8',$data1->MOOBAN == ''))?$data1->MOOBAN: '-' }}" readonly/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                ตำบล
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8', $data1->TUMB) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                อำเภอ
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8',str_replace(" ","",$data1->AUMPDES)) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                จังหวัด
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8',str_replace(" ","",$data1->PROVDES)) }}" readonly/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                รหัสไปรษณีย์
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8', $data1->ZIP) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-8">
                                เบอร์ติดต่อ
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8',str_replace(" ","",$data1->TELP)) }}" readonly/>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-4">
                                เนื้อที่
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->MANUYR}}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                ไร่
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->REGNO}}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                งาน
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{str_replace(" ","",$data1->DORECV)}} ตารางวา" readonly/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                ทรัพย์สิน
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8', $data1->COLOR) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-2">
                                กลุ่ม
                                <div class="form-inline" align="left">
                                  <input type="text" name="Beforeperiodlegis" class="form-control" style="width: 100%;" value="{{ iconv('Tis-620','utf-8', $data1->GCODE) }}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                เลขที่โฉนด
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->STRNO}}" readonly/>
                                </div>
                              </div>
                              <div class="col-md-4">
                                เล่ม/หน้า
                                <div class="form-inline" align="left">
                                  <input type="text" name="Remainperiodlegis" class="form-control" style="width: 100%;" value="{{$data1->ENGNO}}" readonly/>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="box box-warning box-solid">
                          <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-random"></i> ขั้นตอนดำเนินงาน</h3>
                            <div class="box-tools pull-center">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="box-body">

                            <div class="row">
                              <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-6">
                                    (1)วันที่ส่งโนติส
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateNotice" class="form-control" style="width: 100%;" value="{{$data->Datenotice_legis}}" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    (1.1)วันที่ได้รับใบตอบรับ
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateGetNotice" class="form-control" style="width: 100%;" value="{{$data->Dategetnotice_legis}}" />
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-6">
                                    (2)วันที่ยื่นคำร้อง
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DatePetition" class="form-control" style="width: 100%;" value="{{$data->Datepetition_legis}}" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    (3)วันที่สืบ
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateInvestigate" class="form-control" style="width: 100%;" value="{{$data->Dateinvestigate_legis}}" />
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-6">
                                    (4)วันที่พิพากษา
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateAdjudicate" class="form-control" style="width: 100%;" value="{{$data->Dateadjudicate_legis}}" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    (5)วันที่ทำเรื่องขับไล่
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateEviction" class="form-control" style="width: 100%;" value="{{$data->Dateeviction_legis}}" />
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-6">
                                    (5.1)วันทีติดประกาศ
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DatePost" class="form-control" style="width: 100%;" value="{{$data->Datepost_legis}}" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    (5.2)วันที่ไปตรวจทรัพย์
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateCheckAsset" class="form-control" style="width: 100%;" value="{{$data->Datecheckasset_legis}}" />
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-6">
                                    (5.3)ผลตรวจ
                                    <div class="form-inline" align="left">
                                      <select id="ResultCheck" name="ResultCheck" class="form-control" style="width: 100%">
                                        <option selected value="">---เลือกผลตรวจ---</option>
                                          <option value="ลูกหนี้อยู่" {{($data->Resultcheck_legis === 'ลูกหนี้อยู่') ? 'selected' : '' }}>ลูกหนี้อยู่</otion>
                                          <option value="ลูกหนี้ไม่อยู่" {{($data->Resultcheck_legis === 'ลูกหนี้ไม่อยู่') ? 'selected' : '' }}>ลูกหนี้ไม่อยู่</otion>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <script>
                                    $('#ResultCheck').change(function(){
                                      var value = document.getElementById('ResultCheck').value;
                                        if(value == 'ลูกหนี้อยู่'){
                                          $('#Showlive').show();
                                        }
                                        else{
                                          $('#Showlive').hide();
                                        }
                                    });
                                </script>
                                @if($data->Resultcheck_legis == 'ลูกหนี้อยู่')
                                <div class="row" id="Showlive">
                                @else
                                <div class="row" id="Showlive" style="display:none;">
                                @endif
                                  <div class="col-md-6">
                                    (5.3.1)วันที่นำหมายจับ
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateArrest" class="form-control" style="width: 100%;" value="{{$data->Datearrest_legis}}" />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    (5.3.2)วันที่ พนง. นำจับ
                                    <div class="form-inline" align="left">
                                      <input type="date" name="DateStaffArrest" class="form-control" style="width: 100%;" value="{{$data->Datestaffarrest_legis}}" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                หมายเหตุ
                                <div class="form-inline" align="left">
                                  <textarea class="form-control" name="NoteLand" placeholder="ป้อนหมายเหตุ" style="width:100%;" rows="15">{{$data->Noteland_legis}}</textarea>
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
          @endif
        </div>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" align="center">ทะเบียน {{iconv('Tis-620','utf-8',$data1->REGNO)}}</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                       <label>ยี่ห้อรถ : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->TYPE)}}" style="width: 200px;"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>แบบรถ : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->BAAB)}}" style="width: 200px;"/>
                     </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                       <label>รุ่นรถ : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->MODEL)}}" style="width: 200px;"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>สีรถ : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->COLOR)}}" style="width: 200px;"/>
                     </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                       <label>ขนาด : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->CC)}}" style="width: 200px;"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>ปีผลิต : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->MANUYR)}}" style="width: 200px;"/>
                     </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                       <label>เลขตัวถัง : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->STRNO)}}" style="width: 200px;"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>เลขเครื่อง : </label>
                       <input type="text" name="ContractNo" class="form-control" value="{{iconv('Tis-620','utf-8',$data1->ENGNO)}}" style="width: 200px;"/>
                     </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                       <label>จดทะเบียน : </label>
                       <input type="text" name="ContractNo" class="form-control" value="" style="width: 200px;"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>หมดทะเบียน : </label>
                       <input type="text" name="ContractNo" class="form-control" value="" style="width: 200px;"/>
                     </div>
                  </div>
                </div> -->
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                <center><button type="button" class="btn btn-danger" data-dismiss="modal">ปิดเมนู</button></center>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
