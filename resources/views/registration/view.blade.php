@extends('layouts.master')
@section('title','แผนกการเงิน')
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

  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $m = date('m');
    $d = date('d');
    $time = date('H:i');
    $date2 = $Y.'-'.$m.'-'.$d;
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
              <div class="card-header">
                <div class="row">
                  <div class="col-8">
                    <div class="form-inline">
                      <h4>
                        @if($type == 1)
                          รายการลิสซิ่ง
                        @elseif($type == 2)
                          รายการทะเบียนรถ (Registration Car)
                        @endif
                      </h4>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card-tools d-inline float-right">
                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ทะเบียน")
                        @if($type == 1)
                          <form method="get" action="{{ route('Register', 1) }}">
                            <div class="float-right form-inline">
                              <label>ป้ายทะเบียน : </label>
                              <input type="text" name="Regno" value="{{($RegisterNo != null)?$RegisterNo: ''}}" style="width:150px;" class="form-control"/>
                              <button type="submit" class="btn btn-warning">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </form>
                        @elseif($type == 2)
                          <a class="btn bg-success btn-sm" data-toggle="modal" data-target="#modal-new" data-backdrop="static" data-keyboard="false">
                            <span class="fas fa-plus"></span> เพิ่มใหม่
                          </a>
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="col-md-12">
                  @if($type == 1) {{-- รายการทะเบียนจากลิสซิ่ง --}}
                    <table class="table table-striped table-valign-middle" id="table1">
                        <thead>
                          <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">สาขา</th>
                            <th class="text-center">ยีห้อ</th>
                            <th class="text-center">ทะเบียน</th>
                            <th class="text-center">รุ่น</th>
                            <th class="text-center">ปี</th>
                            <th class="text-center">สถานะ</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key => $row)
                            @foreach($dataRegis as $key => $value)
                              @if($row->id== $value->Buyer_id)
                                @php
                                  $Flag = "Y";
                                @endphp
                              @else
                                @php
                                  $Flag = "N";
                                @endphp
                              @endif
                            @endforeach
                            <tr>
                              <td class="text-center"> {{ $key+1 }} </td>
                              <td class="text-center"> {{ $row->branch_car}} </td>
                              <td class="text-center"> {{ $row->Brand_car}} </td>
                              <td class="text-center"> {{ $row->License_car}} </td>
                              <td class="text-center"> {{ ($row->Model_car != null)?$row->Model_car: '-'}} </td>
                              <td class="text-center"> {{ $row->Year_car}} </td>
                              <td class="text-center">
                                @if($Flag != "Y") 
                                <a href="{{ route('MasterRegister.edit',[$row->id])}}?type={{1}}" class="btn btn-danger btn-sm" title="จัดเตรียมเอกสาร">
                                  <i class="fas fa-external-link-alt"></i> เลือก
                                </a>
                                @else 
                                <a href="{{ route('MasterRegister.edit',[$row->id])}}?type={{1}}" class="btn btn-success btn-sm" title="จัดเตรียมเอกสาร">
                                  <i class="fas fa-external-link-alt"></i> เลือก
                                </a>
                                @endif                          
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  @elseif($type == 2) {{-- รายการทะเบียน --}}
                    <form method="get" action="{{ route('Register',2) }}">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="float-right form-inline">
                            <!-- <a target="_blank" href="{{ route('MasterRegister.show',[0]) }}?type={{1}}&Fromdate={{$newfdate}}&Todate={{$newtdate}}" class="btn bg-primary btn-app" title="พิมพ์รายงาน">
                              <span class="fas fa-print"></span> Print
                            </a> -->
                            <button type="button" class="btn bg-primary btn-app" data-toggle="modal" data-target="#modal-default">
                              <span class="fas fa-print"></span> Report
                            </button>
                            <button type="submit" class="btn bg-warning btn-app">
                              <span class="fas fa-search"></span> Search
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="float-right form-inline">
                            <label>จากวันที่ : </label>
                            <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                            <label>ถึงวันที่ : </label>
                            <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                      <table class="table table-striped table-valign-middle table-bordered" id="table1">
                        <thead>
                          <tr>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">วันที่รับลูกค้า</th>
                            <th class="text-center">ป้ายทะเบียน</th>
                            <th class="text-center">ชื่อ-สกุล</th>
                            <th class="text-center">ป้ายใหม่</th>
                            <th class="text-center">ชนิดการโอน</th>
                            <th class="text-center">บริษัท</th>
                            <th class="text-center">คงเหลือ</th>
                            <th class="text-center">ตัวเลือก</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key => $row)
                            <tr>
                              <td class="text-center">{{$key+1}}</td>
                              <td class="text-center">{{DateThai($row->Date_regis)}}</td>
                              <td class="text-center">{{$row->Regno_regis}}</td>
                              <td class="text-left">{{$row->CustName_regis}}&nbsp;&nbsp;&nbsp;{{$row->CustSurN_regis}}</td>
                              <td class="text-center">{{($row->NewReg_regis != '')?$row->NewReg_regis:'-'}}</td>
                              <td class="text-center">{{($row->TypeofReg_regis != '')?$row->TypeofReg_regis:'-'}}</td>
                              <td class="text-center">{{($row->Comp_regis != '')?$row->Comp_regis:'-'}}</td>
                              <td class="text-center">{{number_format(($row->Remainfee_regis != '')?$row->Remainfee_regis:'0.00',2)}}</td>
                              <td class="text-center">
                                <a target="_blank" href="{{ route('MasterRegister.show',[$row->Reg_id]) }}?type={{2}}" class="btn btn-secondary btn-sm" title="พิมพ์ใบเสร็จ">
                                  <i class="fas fa-file-invoice-dollar"></i>
                                </a>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit" title="แก้ไขรายการ"
                                  data-backdrop="static" data-keyboard="false"
                                  data-link="{{ route('MasterRegister.edit',[$row->Reg_id]) }}?type={{2}}">
                                  <i class="far fa-edit"></i>
                                </button>
                                <form method="post" class="delete_form" action="{{ route('MasterRegister.destroy',[$row->Reg_id]) }}?type={{1}}" style="display:inline;">
                                  {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" data-name="" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @endif
                </div>
                <a id="button"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>

  <script>
    $(function () {
      $("#table1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": true,
        "order": [[ 0, "asc" ]],
      });
    });
  </script>

  <script>
    $(function () {
      $("#modal-view").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-view .modal-content").load(link, function(){
        });
      });

      $("#modal-edit").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-edit .modal-content").load(link, function(){
        });
      });

    });
  </script>

  <!-- Add new -->
  <form name="form3" action="{{ route('MasterRegister.store') }}" method="post" enctype="multipart/form-data">
    @csrf
      <input type="hidden" name="type" value="1"/>
      <div class="modal fade" id="modal-new" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-xl">
            <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
              <div class="modal-header" style="border-radius: 30px 30px 0px 0px;">
                <div class="col text-center">
                  <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มรายการใหม่</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>
              <div class="modal-body">
                
                <div class="card card-success card-tabs" style="margin-top:-20px;">
                  <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-1" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> ข้อมูลทั่วไป</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-2" data-toggle="pill" href="#tabs-2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ค่าใช้จ่าย</a>
                      </li>
                      </ul>
                  </div>
                  <div class="card-body">
                      <div class="tab-content" id="custom-tabs-one-tabContent">
                      <div class="tab-pane fade active show" id="tabs-1" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                          <div class="row">
                          <div class="col-md-6">
                              วันที่รับ
                              <input type="date" name="dateaccept" class="form-control"/>
                          </div>
                          <div class="col-md-3">
                              ป้ายทะเบียนเดิม
                              <input type="text" name="licensecar" class="form-control" placeholder="ป้อนป้ายทะเบียนเดิม"/>
                          </div>
                          <div class="col-md-3">
                              ป้ายทะเบียนใหม่
                              <input type="text" name="Newlicensecar" class="form-control" placeholder="ป้อนป้ายทะเบียนใหม่"/>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-3">
                              ชื่อ
                              <input type="text" name="Namebuyer" class="form-control" placeholder="ป้อนชื่อ"/>
                          </div>
                          <div class="col-md-3">
                              นามสกุล 
                              <input type="text" name="Lastbuyer" class="form-control" placeholder="ป้อนนามสกุล"/>
                          </div>
                          <div class="col-md-3">
                              ยี่ห้อรถ
                              <select name="Brandcar" class="form-control">
                              <option value="" selected>--- ยี่ห้อ ---</option>
                              <option value="MAZDA">MAZDA</option>
                              <option value="FORD">FORD</option>
                              <option value="ISUZU">ISUZU</option>
                              <option value="MITSUBISHI">MITSUBISHI</option>
                              <option value="TOYOTA">TOYOTA</option>
                              <option value="NISSAN">NISSAN</option>
                              <option value="HONDA">HONDA</option>
                              <option value="CHEVROLET">CHEVROLET</option>
                              <option value="MG">MG</option>
                              <option value="SUZUKI">SUZUKI</option>
                              </select>
                          </div>
                          <div class="col-md-3">
                              รุ่นรถ
                              <input type="text" name="Modelcar" class="form-control" placeholder="ป้อนรุ่นรถ"/>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-6">
                              ชนิดการโอน
                              <select name="Typetransfer" class="form-control" required>
                              <option value="">---เลือกชนิดการโอน---</option>
                              <option value="โอนจัดไฟแนนซ์">โอนจัดไฟแนนซ์</option>
                              <option value="โอนออก">โอนออก</option>
                              <option value="จดทะเบียนรถใหม่">จดทะเบียนรถใหม่</option>
                              <option value="อื่นๆ">อื่นๆ</option>
                              </select>
                              บริษัท
                              <select name="Companyown" class="form-control" required>
                              <option value="">---เลือกบริษัท---</option>
                              <option value="CKL">CKL - ชูเกียรติลิสซิ่ง</option>
                              <option value="CKY">CKY - ชูเกียรติยนต์</option>
                              <option value="CKC">CKC - ชูเกียรติคาร์</option>
                              </select>
                          </div>
                          <div class="col-md-6">
                              รายละเอียด
                              <textarea name="Describeregis" class="form-control" rows="4" placeholder="ป้อนรายละเอียด"></textarea>
                          </div>
                          </div>
                          <hr>
                          <div class="row">
                          <div class="col-md-3">
                              วันที่เบิกไปขนส่ง
                              <input type="date" name="Datetransport" class="form-control"/>
                          </div>
                          <div class="col-md-3">
                              วันที่รับเล่มจากขนส่ง
                              <input type="date" name="Dategetregis" class="form-control"/>
                          </div>
                          <div class="col-md-6">
                              <table class="table table-bordered" align="center">
                              <thead>
                                  <tr style="line-height:5px;">
                                  <th class="text-center">เช็คเล่ม</th>
                                  <th class="text-center">เช็คกุญแจ</th>
                                  <th class="text-center">เช็คใบเสร็จ</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                  <th class="text-center">
                                      <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" id="customCheckbox4" type="checkbox" name="Doccheck" value="check">
                                      <label class="custom-control-label" for="customCheckbox4"></label>
                                      </div>
                                  </th>
                                  <th class="text-center">
                                      <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" id="customCheckbox5" type="checkbox" name="Keycheck" value="check">
                                      <label class="custom-control-label" for="customCheckbox5"></label>
                                      </div>
                                  </th>
                                  <th class="text-center">
                                      <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" id="customCheckbox6" type="checkbox" name="Receiptcheck" value="check">
                                      <label class="custom-control-label" for="customCheckbox6"></label>
                                      </div>
                                  </th>
                                  </tr>
                              </tbody>
                              </table>
                          </div>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                          <div class="row">
                          <div class="col-md-4">
                              เงินที่รับจากลูกค้า/บริษัท
                              <input type="text" id="Budgetamount2" name="Budgetamount2" class="form-control" value="0" oninput="cal();"/>
                              ค่าช่าง
                              <input type="text" id="Budgettecnique2" name="Budgettecnique2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              เงินตามใบเสร็จ
                              <input type="text" id="Budgetreceipt2" name="Budgetreceipt2" class="form-control" value="0" oninput="cal();"/>
                              ค่าลอกลาย
                              <input type="text" id="Budgetcopy2" name="Budgetcopy2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              <div class="card">
                              <div class="card-header">
                                  <h3 class="card-title">คงเหลือ</h3>
                              </div>
                              <div class="card-body">
                                  <input type="text" id="Remainfee2" name="Remainfee2" class="form-control text-center text-red" value="0.00" style="border:none;"/>
                              </div>
                              </div>
                          </div>  
                          </div>
                          <hr>
                          <div class="row">
                          <div class="col-md-4">
                              ค่าพิเศษย้ายเข้า
                              <input type="text" id="TransferinExtra2" name="TransferinExtra2" class="form-control" value="0"  oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              ค่าพิเศษโอน
                              <input type="text" id="Transferextra2" name="Transferextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              ค่าพิเศษรถใหม่
                              <input type="text" id="Newcarextra2" name="Newcarextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-4">
                              ค่าพิเศษภาษี
                              <input type="text" id="Taxextra2" name="Taxextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              ค่าพิเศษป้าย
                              <input type="text" id="Regisextra2" name="Regisextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              ค่าพิเศษคู่มือ
                              <input type="text" id="Docextra2" name="Docextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-md-4">
                              ค่าพิเศษแก้ไข
                              <input type="text" id="Editextra2" name="Editextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-4">
                              ค่าพิเศษยกเลิก
                              <input type="text" id="Cancelextra2" name="Cancelextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-2">
                              ค่าพิเศษอื่น
                              <input type="text" id="Otherextra2" name="Otherextra2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          <div class="col-md-2">
                              ค่า EMS
                              <input type="text" id="EMSfee2" name="EMSfee2" class="form-control" value="0" oninput="cal();"/>
                          </div>
                          </div>
                      </div>
                      </div>
                  </div>
                </div>

                <input type="hidden" name="NameUser" value="{{auth::user()->name}}" class="form-control" placeholder="ป้อนชื่อ"/>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success text-center" style="border-radius: 50px;">บันทึก</button>
                    <button type="button" class="btn btn-danger" style="border-radius: 50px;" data-dismiss="modal">ยกเลิก</button>
                </div>
              </div>
            </div>
          </div>
      </div>
  </form>
  <script type="text/javascript">
    function addCommas2(nStr2){
        nStr2 += '';
        y = nStr2.split('.');
        y1 = y[0];
        y2 = y.length > 1 ? '.' + y[1] : '';
        var rgy2 = /(\d+)(\d{3})/;
        while (rgy2.test(y1)) {
          y1 = y1.replace(rgy2, '$1' + ',' + '$2');
        }
      return y1 + y2;
    }
    function cal(){
      var SetBudgetamount = document.getElementById('Budgetamount2').value;
      var Budgetamount = SetBudgetamount.replace(",","");
      var SetBudgettecnique = document.getElementById('Budgettecnique2').value;
      var Budgettecnique = SetBudgettecnique.replace(",","");
      var SetReceipt = document.getElementById('Budgetreceipt2').value;
      var Receipt = SetReceipt.replace(",","");
      var SetCopy = document.getElementById('Budgetcopy2').value;
      var Copy = SetCopy.replace(",","");
      var SetTransferinExtra = document.getElementById('TransferinExtra2').value;
      var TransferinExtra = SetTransferinExtra.replace(",","");
      var SetTransferextra = document.getElementById('Transferextra2').value;
      var Transferextra = SetTransferextra.replace(",","");
      var SetNewcarextra = document.getElementById('Newcarextra2').value;
      var Newcarextra = SetNewcarextra.replace(",","");
      var SetTaxextra = document.getElementById('Taxextra2').value;
      var Taxextra = SetTaxextra.replace(",","");
      var SetRegisextra = document.getElementById('Regisextra2').value;
      var Regisextra = SetRegisextra.replace(",","");
      var SetDocextra = document.getElementById('Docextra2').value;
      var Docextra = SetDocextra.replace(",","");
      var SetEditextra = document.getElementById('Editextra2').value;
      var Editextra = SetEditextra.replace(",","");
      var SetCancelextra = document.getElementById('Cancelextra2').value;
      var Cancelextra = SetCancelextra.replace(",","");
      var SetOtherextra = document.getElementById('Otherextra2').value;
      var Otherextra = SetOtherextra.replace(",","");
      var SetEMSfee = document.getElementById('EMSfee2').value;
      var EMSfee = SetEMSfee.replace(",","");

      var Remain2 = parseFloat(Budgetamount) - parseFloat(Budgettecnique) - parseFloat(Receipt) - parseFloat(Copy) -
                   parseFloat(TransferinExtra) - parseFloat(Transferextra) - parseFloat(Newcarextra) -
                   parseFloat(Taxextra) - parseFloat(Regisextra) - parseFloat(Docextra) - parseFloat(Editextra) -
                   parseFloat(Cancelextra) - parseFloat(Otherextra) - parseFloat(EMSfee);

      document.form3.Budgetamount2.value = addCommas2(Budgetamount);
      document.form3.Budgettecnique2.value = addCommas2(Budgettecnique);
      document.form3.Budgetreceipt2.value = addCommas2(Receipt);
      document.form3.Budgetcopy2.value = addCommas2(Copy);
      document.form3.TransferinExtra2.value = addCommas2(TransferinExtra);
      document.form3.Transferextra2.value = addCommas2(Transferextra);
      document.form3.Newcarextra2.value = addCommas2(Newcarextra);
      document.form3.Taxextra2.value = addCommas2(Taxextra);
      document.form3.Regisextra2.value = addCommas2(Regisextra);
      document.form3.Docextra2.value = addCommas2(Docextra);
      document.form3.Editextra2.value = addCommas2(Editextra);
      document.form3.Cancelextra2.value = addCommas2(Cancelextra);
      document.form3.Otherextra2.value = addCommas2(Otherextra);
      document.form3.EMSfee2.value = addCommas2(EMSfee);

      document.form3.Remainfee2.value = addCommas2(Remain2.toFixed(2));

    }
  </script>
  <!-- Add new -->

  <!-- Pop up ดูรายละเอียด -->
  <div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>

  <!-- Pop up แก้ไข -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>

  <!-- Pop up รายงาน -->
  @if($type == 2)
    <form name="form2" target="_blank" action="{{ route('MasterRegister.show',[0]) }}" method="get" enctype="multipart/form-data">
      <input type="hidden" name="type" value="1">
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
            <div class="modal-header bg-primary" style="border-radius: 30px 30px 0px 0px;">
              <div class="col text-center">
                <h5 class="modal-title"> รายงานทะเบียน</h5>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                จากวันที่ :
                <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />
                </div>
                <div class="col-md-6">
                  ถึงวันที่ : 
                  <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                  บริษัท
                  <select name="Companyown" class="form-control">
                    <option value="">---เลือกบริษัท---</option>
                    <option value="CKL">CKL - ชูเกียรติลิสซิ่ง</option>
                    <option value="CKY">CKY - ชูเกียรติยนต์</option>
                    <option value="CKC">CKC - ชูเกียรติคาร์</option>
                  </select>
                </div>
                <div class="col-md-6">
                  ต่อทะเบียน
                  <input type="text" name="RegisterAmount" class="form-control" placeholder="จำนวนต่อทะเบียน"/>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  ชนิดการโอน
                  <div class="form-inline" style="border: 1px solid #D0D0CB; border-radius: 5px; padding:10px;">
                    &nbsp;
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" id="customCheckbox10" type="checkbox" name="Typetransfer[]" value="โอนจัดไฟแนนซ์">
                      <label class="custom-control-label" for="customCheckbox10"></label> โอนจัดไฟแนนซ์
                    </div>
                    &nbsp;&nbsp;
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" id="customCheckbox11" type="checkbox" name="Typetransfer[]" value="โอนออก">
                      <label class="custom-control-label" for="customCheckbox11"></label> โอนออก
                    </div>
                    &nbsp;&nbsp;
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" id="customCheckbox12" type="checkbox" name="Typetransfer[]" value="จดทะเบียนรถใหม่">
                      <label class="custom-control-label" for="customCheckbox12"></label> จดทะเบียนรถใหม่
                    </div>
                    &nbsp;&nbsp;
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" id="customCheckbox13" type="checkbox" name="Typetransfer[]" value="อื่นๆ">
                      <label class="custom-control-label" for="customCheckbox13"></label> อื่นๆ
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            </div>
            <div class="text-center">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal"></button> -->
              <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> ปริ้น</button>
            </div>
            <br>
          </div>
        </div>
      </div>
    </form>
  @endif

@endsection
