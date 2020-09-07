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
                        <a class="btn bg-success btn-sm" data-toggle="modal" data-target="#modal-new" data-backdrop="static" data-keyboard="false" style="border-radius: 40px;">
                          <span class="fas fa-plus"></span> เพิ่มรายการใหม่
                        </a>
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
                          @foreach($data as $row)
                            <tr>
                              <td class="text-center"> {{ $row->id}} </td>
                              <td class="text-center"> {{ $row->branch_car}} </td>
                              <td class="text-center"> {{ $row->Brand_car}} </td>
                              <td class="text-center"> {{ $row->License_car}} </td>
                              <td class="text-center"> {{ ($row->Model_car != null)?$row->Model_car: '-'}} </td>
                              <td class="text-center"> {{ $row->Year_car}} </td>
                              <td class="text-center"> 
                                <a href="{{ route('MasterRegister.edit',[$row->id])}}?type={{1}}" class="btn btn-danger btn-sm" title="จัดเตรียมเอกสาร">
                                  <i class="fas fa-external-link-alt"></i> เลือก
                                </a>                          
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  @elseif($type == 2)
                  <form method="get" action="{{ route('Register',2) }}">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="float-right form-inline">
                          <button type="button" class="btn bg-primary btn-app">
                            <span class="fas fa-print"></span> Print
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
                            <td class="text-center">{{($row->Remainfee_regis != '')?$row->Remainfee_regis:'0.00'}}</td>
                            <td class="text-center">
                              <a target="_blank" href="{{ route('MasterRegister.show',[$row->Reg_id]) }}?type={{1}}" class="btn btn-secondary btn-sm" title="พิมพ์ใบเสร็จ">
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
  <form name="form2" action="{{ route('MasterRegister.store') }}" method="post" enctype="multipart/form-data">
    @csrf
      <input type="hidden" name="type" value="1"/>
      <div class="modal fade" id="modal-new" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
              <div class="modal-header bg-success" style="border-radius: 30px 30px 0px 0px;">
                <div class="col text-center">
                  <h5 class="modal-title"><i class="fas fa-plus"></i> เพิ่มรายการใหม่</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>
              <div class="modal-body">
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
                        <option value="">---เลือกยี่ห้อรถ---</option>
                        <option value="MAZDA">MAZDA</option>
                        <option value="FORD">FORD</option>
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
                      <select name="Typetransfer" class="form-control">
                        <option value="">---เลือกชนิดการโอน---</option>
                        <option value="โอนจัดไฟแนนซ์">โอนจัดไฟแนนซ์</option>
                        <option value="โอนออก">โอนออก</option>
                        <option value="จดทะเบียนรถใหม่">จดทะเบียนรถใหม่</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                      </select>
                      บริษัท
                      <select name="Companyown" class="form-control">
                        <option value="">---เลือกบริษัท---</option>
                        <option value="CKL">CKL - ชูเกียรติลิสซิ่ง</option>
                        <option value="CKY">CKY - ชูเกียรติยนต์</option>
                        <option value="CKC">CKC - ชูเกียรติคาร์</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      รายละเอียด
                      <textarea name="Describeregis" class="form-control" rows="4"></textarea>
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
              <hr>
              </div>

              <input type="hidden" name="NameUser" value="{{auth::user()->name}}" class="form-control" placeholder="ป้อนชื่อ"/>
              <div style="text-align: center;">
                  <button type="submit" class="btn btn-success text-center" style="border-radius: 50px;">บันทึก</button>
                  <button type="button" class="btn btn-danger" style="border-radius: 50px;" data-dismiss="modal">ยกเลิก</button>
              </div>
              <br>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
  </form>

  <!-- Pop up ดูรายละเอียด -->
  <div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>

  <!-- Pop up แก้ไข -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>


@endsection
