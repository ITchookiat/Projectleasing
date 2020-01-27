@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d', strtotime('-1 days'));
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y');
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date = $Y2.'-'.$m.'-'.$d;
  $date2 = $Y.'-'.$m.'-'.$d;
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

    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        กฏหมาย
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          @if($type == 1)
            <h4 class="card-title" align="center"><b>รายชื่อส่งฟ้อง</b></h4>
          @elseif($type == 2)
            <h4 class="card-title" align="center"><b>งานฟ้อง</b></h4>
          @elseif($type == 6)
            <h4 class="card-title" align="center"><b>งานเตรียมเอกสาร</b></h4>
          @elseif($type == 7)
            <h4 class="card-title" align="center"><b>งานเประนอมหนี้</b></h4>
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

            <div class="row">
              @if($type == 1)
                <div class="col-md-12">
                   <hr>
                   <div class="table-responsive">
                     <table class="table table-bordered" id="table">
                        <thead class="thead-dark bg-gray-light" >
                          <tr>
                            <th class="text-center" style="width: 10px">ลำดับ</th>
                            <th class="text-center">เลขที่สัญญา</th>
                            <th class="text-center">ชื่อ-สกุล</th>
                            <th class="text-center">บัตรประชาชน</th>
                            <th class="text-center">วันที่ทำสัญญา</th>
                            <th class="text-center">ยี่ห้อ</th>
                            <th class="text-center">ปีรถ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ค้างงวดจริง</th>
                            <th class="text-center" style="width: 100px">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($result as $key => $row)
                            <tr>
                              <td class="text-center"> {{$key+1}} </td>
                              <td class="text-center">{{$row->CONTNO}}</td>
                              <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                              <td class="text-center"> {{str_replace(" ","",$row->IDNO)}} </td>
                              <td class="text-center"> {{$row->FDATE}} </td>
                              <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->TYPE)) }} </td>
                              <td class="text-center"> {{$row->MANUYR}} </td>
                              <td class="text-center">
                                @php
                                  $Flag = "N";
                                  $SetBaab = iconv('Tis-620','utf-8',str_replace(" ","",$row->BAAB));
                                @endphp

                                @foreach($result2 as $key => $value)
                                  @if($row->CONTNO == $value->CONTNO)
                                    มีหลักพรัทย์
                                    @php
                                      $Flag = "Y";
                                      $Realty = "มีหลักพรัทย์";
                                    @endphp
                                  @endif
                                @endforeach

                                @if($Flag == "N")
                                  @if($SetBaab == "มีหลักพรัทย์")
                                    มีหลักพรัทย์
                                    @php
                                      $Realty = "มีหลักพรัทย์";
                                    @endphp
                                  @else
                                    ไม่มีหลักพรัทย์
                                    @php
                                      $Realty = "ไม่มีหลักพรัทย์";
                                    @endphp
                                  @endif
                                @endif
                              </td>
                              <td class="text-center"> {{$row->HLDNO}} </td>
                              <td class="text-center">
                                @php
                                   $StrCon = explode("/",$row->CONTNO);
                                   $SetStr1 = $StrCon[0];
                                   $SetStr2 = $StrCon[1];

                                   $Tax = "N";
                                @endphp

                                @foreach($data as $key => $row1)
                                  @if($row->CONTNO == $row1->Contract_legis)
                                    <button class="btn btn-success btn-sm" title="เตรียมเรียบร้อย">
                                      <span class="glyphicon glyphicon-lock"></span> เตรียมเรียบร้อย
                                    </button>
                                    @php
                                      $Tax = "Y";
                                    @endphp
                                  @endif
                                @endforeach

                                @if($Tax == "N")
                                  <a href="{{ route('legislation.Savestore', [$SetStr1,$SetStr2,$Realty,1]) }}" id="edit" class="btn btn-danger btn-sm" title="เตรียมเอกสาร">
                                    <span class="glyphicon glyphicon-edit"></span> เตรียมเอกสาร
                                  </a>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                   </div>
                </div>
              @elseif($type == 2)
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">แจ้งเตือน</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">บัตรประชาชน</th>
                          <th class="text-center">วันที่ทำสัญญา</th>
                          <th class="text-center" style="width: 200px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center">
                              @if($row->examiday_court != Null)
                                @php
                                  $examidaydate = date_create($row->examiday_court);
                                  $Newdate = date_create($date);
                                  $DateEx = date_diff($Newdate,$examidaydate);
                                @endphp
                                @php
                                  $orderdaydate = date_create($row->orderday_court);
                                  $DateEx2 = date_diff($Newdate,$orderdaydate);
                                @endphp
                                @php
                                  $checkdaydate = date_create($row->checkday_court);
                                  $DateEx3 = date_diff($Newdate,$checkdaydate);
                                @endphp
                                @php
                                  $setofficedate = date_create($row->setoffice_court);
                                  $DateEx4 = date_diff($Newdate,$setofficedate);
                                @endphp
                                @php
                                  $checkresultsdate = date_create($row->checkresults_court);
                                  $DateEx5 = date_diff($Newdate,$checkresultsdate);
                                @endphp
                                @php
                                  $sequesterdate = date_create($row->sequester_court);
                                  $DateEx6 = date_diff($Newdate,$sequesterdate);
                                @endphp

                                @if($Newdate <= $examidaydate)
                                  @if($DateEx->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> สืบพยาน {{ $DateEx->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $orderdaydate)
                                  @if($DateEx2->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ส่งคำบังคับ {{ $DateEx2->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $checkdaydate)
                                  @if($DateEx3->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมาย {{ $DateEx3->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $setofficedate)
                                  @if($DateEx4->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตั้งเจ้าพนักงาน {{ $DateEx4->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $checkresultsdate)
                                  @if($DateEx5->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมายตั้ง {{ $DateEx5->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $sequesterdate)
                                  @if($DateEx6->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมายตั้ง {{ $DateEx6->d }} วัน</span>
                                  @endif
                                @endif
                              @endif
                            </td>
                            <!-- <td class="text-center"><a href="#" data-toggle="modal" data-target="#modal_default" data-backdrop="static" data-keyboard="false">{{$row->Contract_legis}}</a></td> -->
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
                            <td class="text-center"> {{$row->Idcard_legis}} </td>
                            <td class="text-center"> {{ DateThai($row->DateDue_legis) }} </td>
                            <td class="text-center">

                              <!-- <a href="#" class="btn btn-info btn-sm" title="ดูรายการ" data-toggle="modal" data-target="#modal-default">
                              <span class="glyphicon glyphicon-eye-open"></span> ดู
                              </a> -->

                              <!-- <a href="#" class="btn btn-info btn-sm" title="พิมพ์">
                                <span class="glyphicon glyphicon-eye-open"></span> พิมพ์
                              </a> -->
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </form>
                              </div>
                            </td>
                          </tr>

                          <!-- Popup -->
                          <!-- <div class="modal fade" id="modal_default" style="display: none;">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >×</span></button>
                                  <h4 class="modal-title" align="center">Default Modal</h4>
                                </div>
                                <div class="nav-tabs-custom">
                                  <ul class="nav nav-tabs bg-success">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">รายละเอียด</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ตารางผ่อนชำระ</a></li>
                                  </ul>
                                  <div class="modal-body">
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="tab_1">

                                        <form name="form1" id="sample_tab1" enctype="multipart/form-data">
                                          @csrf
                                          <div class="tab-content">
                                            <div class="form-inline" align="right">
                                              <div class="row">
                                                 <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>เลขที่สัญญา : </label>
                                                           <input type="text" name="ContractPromise" class="form-control" value="{{ $row->Contract_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ชื่อ - นามสกุล :</label>
                                                           <input type="text" name="NamePromise" class="form-control" value="{{ $row->Name_legis }}" style="width: 200px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                          <label>ป้ายทะเบียน : </label>
                                                          <input type="text" name="RigisPromise" class="form-control" value="{{ $row->register_legis }}" style="width: 150px;" readonly/>
                                                        </div>
                                                     </div>
                                                      <div class="col-md-5">
                                                        <div class="form-inline" align="right">
                                                           <label>ยี่ห้อ :</label>
                                                           <input type="text" name="BrandPromise" class="form-control" value="{{ $row->BrandCar_legis }}" style="width: 150px;" readonly/>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="row">
                                                     <div class="col-md-5">
                                                       <div class="form-inline" align="right">
                                                        <label>ปีรถ :</label>
                                                        <input type="text" name="YearcarPromise" class="form-control" value="{{ $row->YearCar_legis }}" style="width: 150px;" readonly/>
                                                      </div>
                                                    </div>
                                                   </div>
                                                 </div>
                                              </div>
                                            </div>
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
                                                  var num11 = document.getElementById('TotalPromise').value;
                                                  var num1 = num11.replace(",","");
                                                  var num22 = document.getElementById('PayallPromise').value;
                                                  var num2 = num22.replace(",","");
                                                  var num33 = document.getElementById('Pay1Promise').value;
                                                  var num3 = num33.replace(",","");
                                                  var num44 = document.getElementById('Pay2Promise').value;
                                                  var num4 = num44.replace(",","");
                                                  var num55 = document.getElementById('Pay3Promise').value;
                                                  var num5 = num55.replace(",","");
                                                  var num66 = document.getElementById('SumPromise').value;
                                                  var num6 = num66.replace(",","");
                                                  var num77 = document.getElementById('DuePayPromise').value;
                                                  var num7 = num77.replace(",","");
                                                  var num88 = document.getElementById('SumAllPromise').value;
                                                  var num8 = num88.replace(",","");
                                                  document.form1.TotalPromise.value = addCommas(num1);
                                                  document.form1.PayallPromise.value = addCommas(num2);
                                                  document.form1.Pay1Promise.value = addCommas(num3);
                                                  document.form1.Pay2Promise.value = addCommas(num4);
                                                  document.form1.Pay3Promise.value = addCommas(num5);
                                                  document.form1.SumPromise.value = addCommas(num6);
                                                  document.form1.DuePayPromise.value = addCommas(num7);
                                                  document.form1.SumAllPromise.value = addCommas(num8);
                                                }
                                            </script>

                                            <hr>
                                            <h4 class="card-title p-3" align="left"><b>รายละเอียดประนอมหนี้</b></h4>
                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดประนอมหนี้ : </label>
                                                       @if($row->Total_Promise == Null)
                                                          <input type="text" name="TotalPromise" id="TotalPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @else
                                                          <input type="text" name="TotalPromise" id="TotalPromise" value="{{ $row->Total_Promise }}" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       @endif
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ประเภทประนอมหนี้ :</label>
                                                         <select name="TypePromise" class="form-control" style="width: 150px;">
                                                           <option value="" selected>--- เลือกประนอม ---</option>
                                                           <option value="ประนอมที่ศาล">ประนอมที่ศาล</option>
                                                           <option value="ประนอมที่บริษัท">ประนอมที่บริษัท</option>
                                                           <option value="หลังยึดทรัพย์">หลังยึดทรัพย์</option>
                                                         </select>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดที่ต้องชำระ :</label>
                                                       <input type="text" name="PayallPromise" id="PayallPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>1 :</label>
                                                       <input type="text" name="Pay1Promise" id="Pay1Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>2 :</label>
                                                       <input type="text" name="Pay2Promise" id="Pay2Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                       <br>
                                                       <label>3 :</label>
                                                       <input type="text" name="Pay3Promise" id="Pay3Promise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือ : </label>
                                                       <input type="text" name="SumPromise" id="SumPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>จำนวนงวด :</label>
                                                       <input type="text" name="DuePromise" class="form-control" style="width: 150px;"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                      <label>งวดละ :</label>
                                                      <input type="text" name="DuePayPromise" id="DuePayPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                     </div>
                                                  </div>
                                                </div>

                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>วันที่วันที่ชำระล่าสุด : </label>
                                                       <input type="date" name="DatelastPromise" class="form-control" style="width: 150px;"/>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-5">
                                                    <div class="form-inline" align="right">
                                                       <label>ยอดคงเหลือล่าสุด : </label>
                                                       <input type="text" name="SumAllPromise" id="SumAllPromise" class="form-control" style="width: 150px;" oninput="Comma();"/>
                                                    </div>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-inline" align="right">
                                              <input type="hidden" name="Getid" class="form-control" value="{{ $row->id }}" style="width: 150px;" readonly/>
                                              <button class="btn btn-success btn-submit">Submit</button>
                                          </div>
                                        </form>
                                      </div>

                                      <div class="tab-pane" id="tab_2">

                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div> -->
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @elseif($type == 6)
                <div class="col-md-12">
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">ระยะเวลา</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">บัตรประชาชน</th>
                          <th class="text-center">วันที่ทำสัญญา</th>
                          <th class="text-center">สถานะ</th>
                          <th class="text-center" style="width: 150px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center">
                              @if($row->Datesend_Flag == null)
                                  @php
                                    $nowday = date('Y-m-d');
                                    $Cldate = date_create($row->Date_legis);
                                    $nowCldate = date_create($nowday);
                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                    $duration = $ClDateDiff->format("%a วัน")
                                  @endphp
                                  <font color="red">{{$duration}}</font>
                              @else
                                  @php
                                    $Cldate = date_create($row->Date_legis);
                                    $nowCldate = date_create($row->Datesend_Flag);
                                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                                    $duration = $ClDateDiff->format("%a วัน")
                                  @endphp
                                  <font color="blue">{{$duration}}</font>
                                @endif
                            </td>
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
                            <td class="text-center"> {{$row->Idcard_legis}} </td>
                            <td class="text-center"> {{ DateThai($row->DateDue_legis) }} </td>
                            <td class="text-center">
                              @if($row->Flag == '1')
                              <button type="button" class="btn btn-info btn-sm" title="เตรียมเอกสาร">
                                <span class="glyphicon glyphicon-copy"></span> เตรียมเอกสาร
                              </button>
                              @else
                              <button type="button" class="btn btn-success btn-sm" title="ส่งเอกสารแล้ว">
                                <span class="glyphicon glyphicon-paste"></span> ส่งเอกสารแล้ว
                              </button>
                              @endif
                            </td>
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </form>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @elseif($type == 7)
                <div class="col-md-12">
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">แจ้งเตือน</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          <th class="text-center">บัตรประชาชน</th>
                          <th class="text-center">วันที่ทำสัญญา</th>
                          <th class="text-center" style="width: 200px">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center"> {{$key+1}} </td>
                            <td class="text-center">
                              @if($row->examiday_court != Null)
                                @php
                                  $examidaydate = date_create($row->examiday_court);
                                  $Newdate = date_create($date);
                                  $DateEx = date_diff($Newdate,$examidaydate);
                                @endphp
                                @php
                                  $orderdaydate = date_create($row->orderday_court);
                                  $DateEx2 = date_diff($Newdate,$orderdaydate);
                                @endphp
                                @php
                                  $checkdaydate = date_create($row->checkday_court);
                                  $DateEx3 = date_diff($Newdate,$checkdaydate);
                                @endphp
                                @php
                                  $setofficedate = date_create($row->setoffice_court);
                                  $DateEx4 = date_diff($Newdate,$setofficedate);
                                @endphp
                                @php
                                  $checkresultsdate = date_create($row->checkresults_court);
                                  $DateEx5 = date_diff($Newdate,$checkresultsdate);
                                @endphp
                                @php
                                  $sequesterdate = date_create($row->sequester_court);
                                  $DateEx6 = date_diff($Newdate,$sequesterdate);
                                @endphp

                                @if($Newdate <= $examidaydate)
                                  @if($DateEx->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> สืบพยาน {{ $DateEx->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $orderdaydate)
                                  @if($DateEx2->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ส่งคำบังคับ {{ $DateEx2->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $checkdaydate)
                                  @if($DateEx3->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมาย {{ $DateEx3->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $setofficedate)
                                  @if($DateEx4->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตั้งเจ้าพนักงาน {{ $DateEx4->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $checkresultsdate)
                                  @if($DateEx5->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมายตั้ง {{ $DateEx5->d }} วัน</span>
                                  @endif
                                @elseif($Newdate <= $sequesterdate)
                                  @if($DateEx6->d <= 7)
                                    <span class="fa fa-warning text-danger prem" title="มีแจ้งเตือน"> ตรวจผลหมายตั้ง {{ $DateEx6->d }} วัน</span>
                                  @endif
                                @endif
                              @endif
                            </td>
                            <td class="text-center"> {{$row->Contract_legis}}</a></td>
                            <td class="text-center"> {{$row->Name_legis}} </td>
                            <td class="text-center"> {{$row->Idcard_legis}} </td>
                            <td class="text-center"> {{ DateThai($row->DateDue_legis) }} </td>
                            <td class="text-center">
                              <a href="{{ action('LegislationController@edit',[$row->id,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                              </a>
                              <div class="form-inline form-group">
                                <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->id ,1]) }}">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </form>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @endif
           </div>

           <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">ข้อมูลรายละเอียด...</h4>
                </div>
                <div class="modal-body">
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Popup -->
          <!-- <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".btn-submit").click(function(e){
                e.preventDefault();
                // var name = $("input[name=name]").val();
                // var password = $("input[name=password]").val();
                // var Getid = $("input[Getid=Getid]").val();

                $.ajax({
                   type:'POST',
                   url:"{{ route('legislation.update',[00, 4]) }}",
                   data: $("form#sample_tab1").serialize(),
                   // data:{name:name, password:password, email:email},
                   success:function(data){
                      $('#TotalPromise').val(data.Total_Promise);
                      $('#PayallPromise').val(data.Payall_Promise);
                      console.log(data.success);
                   }
                });
      	     });
          </script> -->

          @if($type == 1 or $type == 6 or $type == 7)
            <script type="text/javascript">
               $(document).ready(function() {
                 $('#table').DataTable( {
                   "order": [[ 0, "asc" ]]
                 });
               });
            </script>
          @elseif($type == 2)
            <script type="text/javascript">
            $(document).ready(function() {
              $('#table').DataTable( {
                "order": [[ 1, "asc" ]]
              });
            });
            </script>
          @endif

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>
        </div>

        <script>
          function blinker() {
          $('.prem').fadeOut(1500);
          $('.prem').fadeIn(1500);
          }
          setInterval(blinker, 1500);
        </script>

      </div>
    </section>

@endsection
