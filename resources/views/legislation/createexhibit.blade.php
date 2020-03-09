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
          @if($type == 11)
            <h4 align="center"><b>เพิ่มข้อมูลของกลาง</b></h3>
          @endif
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">
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

            @if($type == 11)
            <form name="form1" action="{{ route('legislation.store',[00, $type]) }}" method="post" id="formimage" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-12">
                        @csrf
                        <div class="card">
                          <div class="card-body">
                            <div class="tab-content">

                              <div class="row">
                                <div class="col-md-9">
                                  <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                      <h4 class="box-title"><i class="fa fa-user"></i> ข้อมูลผู้เช่าซื้อ</h4>
                                    </div>
                                    <div class="box-body">

                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font color="red">เลขที่สัญญา : </font></label>
                                              <input type="text" name="ContractNo" class="form-control" style="width: 250px;" maxlength="12" placeholder="ป้อนเลขที่สัญญา" required/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>วันที่รับเรื่อง : </font></label>
                                              <input type="date" name="DateExhibit" class="form-control" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>ชื่อ-สกุลผู้เช่าซื้อ : </font></label>
                                              <input type="text" name="NameContract" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อ-สกุลผู้เช่าซื้อ"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>สถานีตำรวจภูธร : </font></label>
                                              <input type="text" name="PoliceStation" class="form-control" style="width: 250px;" placeholder="ป้อนสถานีภูธร">
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>ชื่อผู้ต้องหา : </font></label>
                                              <input type="text" name="NameSuspect" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อผู้ต้องหา"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                            <div class="form-inline" align="right">
                                              <label><font>ข้อหา : </font></label>
                                              <select name="PlaintExhibit" class="form-control" style="width: 250px">
                                                <option selected value="">---เลือกข้อหา---</option>
                                                  <option value="ยาบ้า">ยาบ้า</otion>
                                                  <option value="พืชกระท่อม">พืชกระท่อม</otion>
                                                  <option value="ศุลกากร">ศุลกากร</otion>
                                                  <option value="จราจร">จราจร</otion>
                                              </select>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>พนักงานสอบสวน : </font></label>
                                              <input type="text" name="InquiryOfficial" class="form-control" style="width: 250px;" placeholder="ป้อนพนักงานสอบสวน"/>
                                            </div>
                                         </div>

                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                              <label><font>เบอร์โทรศัพท์ : </font></label>
                                              <input type="text" name="InquiryOfficialtel" class="form-control" style="width: 250px;" placeholder="ป้อนพนักงานสอบสวน"/>
                                            </div>
                                         </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-inline" align="right">
                                             <label><font>บอกเลิกสัญญา : </font></label>
                                             <select id="TerminateExhibit" name="TerminateExhibit" class="form-control" style="width: 250px">
                                               <option selected value="">---เลือกบอกเลิกสัญญา---</option>
                                                 <option value="เร่งรัด">เร่งรัด</otion>
                                                 <option value="ทนาย">ทนาย</otion>
                                             </select>
                                           </div>
                                        </div>
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                             <label><font>ประเภทของกลาง : </font></label>
                                             <select id="TypeExhibit" name="TypeExhibit" class="form-control" style="width: 250px">
                                               <option selected value="">---เลือกประเภท---</option>
                                               <option value="ของกลาง">ของกลาง</otion>
                                               <option value="ยึดตามมาตราการ(ปปส.)">ยึดตามมาตราการ(ปปส.)</otion>
                                             </select>
                                           </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6" id="ShowTerminate" style="display:none;">
                                          <div class="form-inline" align="right">
                                            <label><font>วันที่ทนายส่งเรื่อง : </font></label>
                                            <input type="date" name="DateLawyersend" class="form-control" style="width: 250px;"/>
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
                                              <textarea class="form-control" name="NoteExhibit" placeholder="ป้อนหมายเหตุ" style="width:100%;" rows="9"></textarea>
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
                                <div id="ShowType1" style="display:none;">
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
                                                <input type="date" name="DateGiveword" class="form-control" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>ชั้นสำนวน : </font></label>
                                               <select name="TypeGiveword" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกคำให้การ---</option>
                                                 <option value="พนักงานสอบสวน">ชั้นพนักงานสอบสวน</otion>
                                                 <option value="พนักงานอัยการ">ชั้นพนักงานอัยการ</otion>
                                                 <option value="ชั้นศาล">ชั้นศาล</otion>
                                               </select>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>ผล : </font></label>
                                               <select name="ResultExhibit1" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกผล---</option>
                                                   <option value="คืน">คืน</otion>
                                                   <option value="ไม่คืน">ไม่คืน</otion>
                                               </select>
                                             </div>
                                           </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่เช็คสำนวน : </font></label>
                                               <input type="date" name="DateCheckexhibit" class="form-control" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่เตรียมเอกสาร : </font></label>
                                               <input type="date" name="DatePreparedoc" class="form-control" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วิธีดำเนินการ : </font></label>
                                               <select id="ProcessExhibit1" name="ProcessExhibit1" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกวิธีดำเนินการ---</option>
                                                   <option value="รับคืน">รับคืน</otion>
                                                   <option value="ไม่รับคืน">ไม่รับคืน</otion>
                                               </select>
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
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ยื่นคำร้อง : </font></label>
                                               <input type="date" name="DateSendword" class="form-control" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันทีไต่สวน : </font></label>
                                               <input type="date" name="DateInvestigate" class="form-control" style="width: 250px"/>
                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ดำเนินการ : </font></label>
                                               <input type="date" id="DategetResult1" name="DategetResult1" class="form-control" style="width: 250px"/>
                                              </div>
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
                                <div id="ShowType2" style="display:none;">
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
                                                <input type="date" name="DateSenddetail" class="form-control" style="width: 250px"/>
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>ผล : </font></label>
                                               <select name="ResultExhibit2" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกผล---</option>
                                                   <option value="รับเช็ค">รับเช็ค</otion>
                                                   <option value="รับรถ">รับรถ</otion>
                                               </select>
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วิธีดำเนินการ : </font></label>
                                               <select id="ProcessExhibit2" name="ProcessExhibit2" class="form-control" style="width: 250px">
                                                 <option selected value="">---เลือกวิธีดำเนินการ---</option>
                                                   <option value="ไปรับเช็ค">ไปรับเช็ค</otion>
                                                   <option value="ไปรับรถ">ไปรับรถ</otion>
                                               </select>
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
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">

                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">

                                             </div>
                                           </div>
                                           <div class="col-md-4">
                                             <div class="form-inline" align="right">
                                               <label><font>วันที่ดำเนินการ : </font></label>
                                               <input type="date" id="DategetResult2" name="DategetResult2" class="form-control" style="width: 250px"/>
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

                      <input type="hidden" name="_token" value="{{csrf_token()}}" />
                      <input type="hidden" name="type" value="12" />
                      <br>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ route('legislation', 10) }}">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div>
                </div>

              </form>
            @endif

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
