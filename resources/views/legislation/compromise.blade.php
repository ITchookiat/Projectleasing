@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

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

    <style>
      input[type="checkbox"] { position: absolute; opacity: 5; z-index: -5; }
      input[type="checkbox"]+span { font: 14pt sans-serif; color: #000; }
      input[type="checkbox"]+span:before { font: 14pt FontAwesome; content: '\00f096'; display: inline-block; width: 14pt; padding: 5px 5 5 5px; margin-right: 0.3em; }
      input[type="checkbox"]:checked+span:before { content: '\00f046'; }
      input[type="checkbox"]:focus+span:before { outline: 2px dotted #aaa; }
    </style>

      <!-- <section class="content-header">
        <h1>
          ชั้นศาล
          <small>ประนอมหนี้</small>
        </h1>
      </section> -->

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-warning box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">ประนอมหนี้</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="nav-tabs-custom">
            <!-- <ul class="nav nav-tabs bg-warning">
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">หน้าหลัก</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 4]) }}">รายละเอียด</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 5]) }}">เพิ่มข้อมูลชำระ</a></li>
            </ul> -->
          </div>

          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="form-inline" align="right">
                        <div class="row">

                          <div class="col-md-3">
                            <div class="info-box">
                              <span class="info-box-icon" style="height: 95px;background-color:red;color:#FFF;"><i class="fa fa-user"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-number text-left">
                                  <font style="font-size:28px;">{{ $data->Contract_legis }}</font>
                                </span>

                                <!-- <div class="progress">
                                  <div class="progress-bar" style="width: 100%;background-color:grey;"></div>
                                </div> -->
                                <span class="progress-description text-left">
                                  <font style="font-size:24px;">{{ $data->Name_legis }}</font>
                                </span>

                              </div>
                              <!-- /.info-box-content -->
                            </div>
                          </div>

                           <div class="col-md-6" align="center">

                             <label>
                               @if($data->CAccount_legis != Null)
                               <input type="checkbox" name="CAccountlegis" value="{{ $data->CAccount_legis }}" checked="checked"/>
                               @else
                               <input type="checkbox" name="CAccountlegis" value="Y"/>
                               @endif
                               <span><font color="red">ปิดบัญชี :</font></span>
                               <input type="text" name="txtCAccountlegis" class="form-control" style="width: 120px;">
                             </label>
                             <label>
                               @if($data->OverDue_legis != Null)
                               <input type="checkbox" name="OverDuelegis" value="{{ $data->OverDue_legis }}" checked="checked"/>
                               @else
                               <input type="checkbox" name="OverDuelegis" value="BF"/>
                               @endif
                               <span><font color="red">จ่ายตามจำนวนงวด :</font></span>
                               <input type="text" name="txtOverDuelegis" class="form-control" style="width: 120px;">
                             </label>
                             <!-- <label>
                               <input type="checkbox" name="Holderlegis" value="BK"/>
                               <span><font color="red">ยึดรถ</font></span>
                             </label> -->

                           </div>

                          <div class="col-md-3" align="center">
                             <a class="btn btn-app" href="{{ action('LegislationController@edit',[$id, 5]) }}" style="background-color:blue; color:#FFFFFF;" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                               <span class="glyphicon glyphicon-plus"></span> เพิ่มชำระ
                             </a>
                            <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                            </button>
                            <a class="btn btn-app" href="{{ route('legislation',7) }}" style="background-color:#DB0000; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                            </a>

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
                            var num66 = document.getElementById('SumPromise').value;
                            var num6 = num66.replace(",","");
                            var num88 = document.getElementById('SumAllPromise').value;
                            var num8 = num88.replace(",","");

                            document.form1.TotalPromise.value = addCommas(num1);
                            document.form1.PayallPromise.value = addCommas(num2);
                            document.form1.SumPromise.value = addCommas(num6);
                            document.form1.SumAllPromise.value = addCommas(num8);
                          }

                          function Discount() {
                              var txtSum = document.getElementById('SumPromise').value;
                              var txtDis = document.getElementById('DiscountPromise').value;
                              var txtComma = txtDis.replace(",","");
                              var txtSumhide = document.getElementById('Sumhide').value;
                              var txtDishide = document.getElementById('Discounthide').value;

                              // if (txtSetPay1 != 0 || txtSetPay2 != 0 || txtSetPay3 != 0) {
                              //   var result = parseFloat(txtSumhide) - parseFloat(txtSetPay1) - parseFloat(txtSetPay2) - parseFloat(txtSetPay3);
                              //   console.log(result);

                              if (txtDis != txtDishide) {
                                var SetDiscount = parseFloat(txtDis) - parseFloat(txtDishide);
                                // var result = parseFloat(result) - parseFloat(SetDiscount);
                                var result = parseFloat(txtSumhide) - parseFloat(SetDiscount);
                              }else if (txtDis == 0) {
                                console.log(txtDis);
                                var result = parseFloat(txtSumhide);
                              }

                              if (!isNaN(result)) {
                                document.form1.SumPromise.value = addCommas(result);
                              }
                          }

                          function DuePay() {
                              var SumPayAll = document.getElementById('SumPayAll').value;
                              var txtSumPayAll = SumPayAll.replace(",","");
                              var txtDuepay = document.getElementById('DuePayPromise').value;
                              var txtSetDue = txtDuepay.replace(",","");

                              var Sum = (parseFloat(txtSumPayAll) / parseFloat(txtSetDue));
                              var result = Math.floor(Sum);

                              if (txtSetDue == 0) {
                                console.log(txtSetDue);
                                var result = 0;
                              }

                              if (!isNaN(result)) {
                                document.form1.DuePromise.value = result;
                                document.form1.DuePayPromise.value = numberWithCommas(txtSetDue);
                              }
                          }
                          function numberWithCommas(x) {
                              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                          }
                      </script>

                      <hr>
                      <h4 class="card-title p-3" align="left"><b>รายละเอียดประนอมหนี้</b></h4>

                      <div class="box box-success box-solid">
                        <div class="nav-tabs-custom" style="background-color : #66FF66;">
                          <ul class="nav nav-tabs">
                            <li class="nav-item active"><a href="#tab_1" data-toggle="tab">ข้อมูลประนอมหนี้</a></li>
                            <li class="nav-item"><a href="#tab_2" data-toggle="tab">ตารางผ่อนชำระ</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                              <div class="row">
                                 <div class="col-md-8">
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                        <label>ยอดประนอมหนี้ : </label>
                                        <input type="text" name="TotalPromise" id="TotalPromise" value="{{ number_format($data->Total_Promise,0) }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                     <script>
                                       function income(){
                                         console.log(document.getElementById("TypePromise").value);
                                           var Getid = document.getElementById("TypePromise").value;
                                           if (Getid == "ประนอมหลังยึดทรัพย์") {
                                             $('#DateShow').show();
                                           }else {
                                             $('#DateShow').hide();
                                           }
                                       }
                                     </script>

                                     <div class="form-inline" align="right">
                                        <label>ประเภทประนอมหนี้ :</label>
                                        @if($data->Type_Promise == Null)
                                          <select id="TypePromise" name="TypePromise" class="form-control" style="width: 200px;" onchange="income();">
                                            <option value="" selected>--- เลือกประนอม ---</option>
                                            <option value="ประนอมที่ศาล">ประนอมที่ศาล</option>
                                            <option value="ประนอมที่บริษัท">ประนอมที่บริษัท</option>
                                            <option value="ประนอมหลังยึดทรัพย์">ประนอมหลังยึดทรัพย์</option>
                                          </select>
                                         @else
                                          <select id="TypePromise" name="TypePromise" class="form-control" style="width: 200px;" onchange="income();">
                                            <option value="" disabled selected>--- เลือกประนอม ---</option>
                                            @foreach ($Typecom as $key => $value)
                                              <option value="{{$key}}" {{ ($key == $data->Type_Promise) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                          </select>
                                         @endif
                                      </div>
                                      <hr>
                                   </div>


                                   @if($data->Type_Promise != "ประนอมหลังยึดทรัพย์")
                                      <div id="DateShow" style="display:none">
                                  @else
                                      <div id="DateShow">
                                  @endif
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                             <label>วันงดขายเข้าตลาด :</label>
                                             <input type="date" name="DateNsalePromise" value="{{ $data->DateNsale_Promise }}" class="form-control" style="width: 200px;"/>
                                           </div>
                                         </div>
                                         <div class="col-md-6">
                                           <div class="form-inline" align="right">
                                             <label>วันครบกำหนด :</label>
                                             <input type="date" name="DatesetPromise" value="{{ $data->Dateset_Promise }}" class="form-control" style="width: 200px;"/>
                                           </div>
                                         </div>
                                       </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ยอดที่ต้องชำระ :</label>
                                      <input type="text" name="PayallPromise" id="PayallPromise" value="{{ $data->Payall_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                    </div>
                                    <br>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ยอดคงเหลือ : </label>
                                      <input type="text" id="SumPromise" name="SumPromise" value="{{ number_format($SumPay, 0) }}" class="form-control" style="width: 200px;" readonly/>
                                      <input type="hidden" id="Sumhide" name="Sumhide" value="{{ $SumPay }}" class="form-control" style="width: 200px;"/>
                                      <input type="hidden" id="SumPayAll" name="SumPayAll" value="{{ $SumAllPAy }}" class="form-control" style="width: 200px;"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>ส่วนลด :</label>
                                      <input type="text" id="DiscountPromise" name="DiscountPromise" value="{{ number_format(($data->Discount_Promise != '') ?$data->Discount_Promise: 0) }}" class="form-control" style="width: 200px;" onkeyup="Discount();" />
                                      <input type="hidden" id="Discounthide" name="Discounthide" value="{{ $data->Discount_Promise }}" class="form-control" style="width: 200px;" />
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>จำนวนงวด :</label>
                                      <input type="text" name="DuePromise" id="DuePromise" value="{{ $data->Due_Promise }}" class="form-control" style="width: 200px;" readonly/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label>งวดละ :</label>
                                      <input type="text" name="DuePayPromise" id="DuePayPromise" value="{{ number_format(($data->DuePay_Promise != '') ?$data->DuePay_Promise: 0) }}" class="form-control" style="width: 200px;" oninput="DuePay();"/>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label><font color="red">วันที่ชำระล่าสุด : </font></label>
                                      @if($data->Date_Payment != Null)
                                        <input type="text" name="DatelastPromise" value="{{ DateThai($data->Date_Payment) }}" class="form-control" style="width: 200px;" readonly/>
                                      @else
                                        <input type="text" name="DatelastPromise" class="form-control" style="width: 200px;" readonly/>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-inline" align="right">
                                      <label><font color="red">ยอดชำระล่าสุด : </font></label>
                                      <input type="text" name="SumAllPromise" id="SumAllPromise" value="{{ number_format($data->Gold_Payment, 2) }}" class="form-control" style="width: 200px;" oninput="Comma();" readonly/>
                                    </div>
                                  </div>
                                 </div>

                                 <div class="col-md-4">
                                    <div class="form-inline" align="right">
                                      <label style="vertical-align: top">หมายเหตุ : </label>
                                      <textarea name="NotePromise" rows="12" class="form-control" style="width: 80%">{{$data->Note_Promise}}</textarea>
                                    </div>
                                 </div>
                              </div>
                            </div>

                            <input type="hidden" name="_method" value="PATCH"/>
                    </form>

                            <div class="tab-pane" id="tab_2">
                              <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                   <thead class="thead-dark bg-gray-light" >
                                     <tr>
                                       <th class="text-center" style="width:100px">ลำดับ</th>
                                       <th class="text-center">วันที่</th>
                                       <th class="text-center">ยอดชำระ</th>
                                       <th class="text-center">ประเภท</th>
                                       <th class="text-center">ลงชื่อ</th>
                                       <th class="text-center" style="width:150px">action</th>
                                     </tr>
                                   </thead>
                                   <tbody>
                                      @foreach($dataPay as $key => $row)
                                      <tr>
                                        <td class="text-center"> {{$key+1}} </td>
                                        <td class="text-center"> {{ DateThai($row->Date_Payment) }}</td>
                                        <td class="text-center"> {{ number_format($row->Gold_Payment, 2) }} </td>
                                        <td class="text-center"> {{$row->Type_Payment}} </td>
                                        <td class="text-center"> {{$row->Adduser_Payment}} </td>
                                        <td class="text-center">
                                          <form method="post" class="delete_form" action="{{ action('LegislationController@destroy',[$row->Payment_id, 2]) }}">
                                          {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                              <span class="glyphicon glyphicon-trash"></span> ลบ
                                            </button>
                                          </form>
                                        </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>

                                <div class="form-inline" align="left">
                                  <label><font color="red">ค่างวดทั้งหมด : </font></label>
                                  <input type="text" value="{{ number_format($Getdata, 2) }}" class="form-control" style="width: 150px;" readonly/>

                                  <label><font color="red">ยอดชำระ : </font></label>
                                  <input type="text" value="{{ number_format($SumCount, 2) }}" class="form-control" style="width: 150px;" readonly/>
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

        <div class="modal fade" id="modal-default">

          <div class="modal-dialog">

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
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

        <script type="text/javascript">
          $(document).ready(function() {
            $('#table').DataTable( {
              "searching" : false,
              "lengthChange" : false,
              "info" : false,
              "pageLength": 5,
            } );
          } );
        </script>

      <!-- เวลาแจ้งเตือน -->
      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
      </script>

    </section>


@endsection
