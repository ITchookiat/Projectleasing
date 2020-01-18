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

      <section class="content-header">
        <h1>
          ชั้นศาล
          <small>ประนอมหนี้</small>
        </h1>
      </section>

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
            <ul class="nav nav-tabs bg-warning">
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">หน้าหลัก</a></li>
              <li class="nav-item active"><a href="{{ action('LegislationController@edit',[$id, 4]) }}">รายละเอียด</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 5]) }}">เพิ่มข้อมูลชำระ</a></li>
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

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <div class="form-inline" align="right">
                        <div class="row">
                           <div class="col-md-9">
                             <div class="row">
                                <div class="col-md-4">
                                  <div class="form-inline" align="right">
                                     <label>เลขที่สัญญา : </label>
                                     <input type="text" name="ContractPromise" class="form-control" value="{{ $data->Contract_legis }}" style="width: 150px;" readonly/>
                                   </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-inline" align="right">
                                     <label>ชื่อ - นามสกุล :</label>
                                     <input type="text" name="NamePromise" class="form-control" value="{{ $data->Name_legis }}" style="width: 77%;" readonly/>
                                   </div>
                                </div>
                             </div>

                             <div class="row">
                               <div class="col-md-4">
                                 <div class="form-inline" align="right">
                                    <label>ป้ายทะเบียน : </label>
                                    <input type="text" name="RigisPromise" class="form-control" value="{{ $data->register_legis }}" style="width: 150px;" readonly/>
                                  </div>
                               </div>
                                <div class="col-md-4">
                                  <div class="form-inline" align="right">
                                     <label>ยี่ห้อ :</label>
                                     <input type="text" name="BrandPromise" class="form-control" value="{{ $data->BrandCar_legis }}" style="width: 150px;" readonly/>
                                   </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-inline" align="right">
                                     <label>ปีรถ :</label>
                                     <input type="text" name="YearcarPromise" class="form-control" value="{{ $data->YearCar_legis }}" style="width: 150px;" readonly/>
                                   </div>
                                </div>
                             </div>
                           </div>

                           <div class="col-md-3">
                            <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                            </button>
                            <a class="btn btn-app" href="{{ action('LegislationController@edit',[$id, 2]) }}" style="background-color:#DB0000; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                            </a>
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

                          function Discount(){
                            var num11 = document.getElementById('DiscountPromise').value;
                            var num1 = num11.replace(",","");
                            var num22 = document.getElementById('SumPromise').value;
                            var num2 = num22.replace(",","");
                            var num33 = document.getElementById('SumPromise2').value;
                            var num3 = num33.replace(",","");


                            if (num2 != num3) {
                              console.log(num2);
                              console.log(num3);
                              var SumCount = parseFloat(num3);
                            }else {
                              var SumCount = parseFloat(num2) - parseFloat(num1);
                            }

                            if (!isNaN(SumCount)) {
                              document.form1.SumPromise.value = addCommas(SumCount);
                              document.form1.DiscountPromise.value = addCommas(num1);
                            }
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
                                        <input type="text" name="TotalPromise" id="TotalPromise" value="{{ $data->Total_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
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
                                   </div>
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                        <label>งวดที่ 1 :</label>
                                        <input type="text" name="Pay1Promise" id="Pay1Promise" value="{{ $data->Pay1_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                        <br>
                                        <label>งวดที่ 2 :</label>
                                        <input type="text" name="Pay2Promise" id="Pay2Promise" value="{{ $data->Pay2_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                        <br>
                                        <label>งวดที่ 3 :</label>
                                        <input type="text" name="Pay3Promise" id="Pay3Promise" value="{{ $data->Pay3_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                      </div>
                                      <br>
                                   </div>
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                        <label>ยอดคงเหลือ : </label>
                                        <input type="text" id="SumPromise" name="SumPromise" value="{{ number_format($SumPay, 2) }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                        <input type="hidden" id="SumPromise2" name="SumPromise2" value="{{ number_format($SumPay, 2) }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                        <label>ส่วนลด :</label>
                                        <input type="text" id="DiscountPromise" name="DiscountPromise" value="{{ $data->Discount_Promise }}" class="form-control" style="width: 200px;" oninput="Discount();"/>
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                        <label>จำนวนงวด :</label>
                                        <input type="text" name="DuePromise" value="{{ $data->Due_Promise }}" class="form-control" style="width: 200px;"/>
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                     <div class="form-inline" align="right">
                                       <label>งวดละ :</label>
                                       <input type="text" name="DuePayPromise" id="DuePayPromise" value="{{ $data->DuePay_Promise }}" class="form-control" style="width: 200px;" oninput="Comma();"/>
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
                                        <input type="text" name="SumAllPromise" id="SumAllPromise" value="{{ $data->Gold_Payment }}" class="form-control" style="width: 200px;" oninput="Comma();" readonly/>
                                     </div>
                                   </div>
                                 </div>

                                 <div class="col-md-4">
                                    <div class="form-inline" align="right">
                                      <label style="vertical-align: top">หมายเหตุ : </label>
                                      <textarea name="NotePromise" rows="12" cols="40"></textarea>
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
                                        <td class="text-center"> {{$row->Date_Payment}}</td>
                                        <td class="text-center"> {{$row->Gold_Payment}} </td>
                                        <td class="text-center"> {{$row->Type_Payment}} </td>
                                        <td class="text-center"> {{$row->Adduser_Payment}} </td>
                                        <td class="text-center">
                                          <!-- <span class="label label-success">Approved</span> -->
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
                               </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $('#table').DataTable( {
              "searching" : false,
              "lengthChange" : false,
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
