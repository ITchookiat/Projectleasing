@extends('layouts.master')
@section('title','walk-in')
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
                    <div class="col-6">
                      <div class="form-inline">
                        <h5>
                          @if($type == 1)
                            ลูกค้า walk-in (Customer walk-in)
                          @elseif($type == 2)
                            รายงาน walk-in (Report Customer walk-in)
                          @endif
                        </h5>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card-tools d-inline float-right">
                          <a class="btn bg-warning btn-sm" data-toggle="modal" data-target="#modal-walkin" data-backdrop="static" data-keyboard="false" style="border-radius: 40px;">
                            <span class="fas fa-users"></span> Add New
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <form method="get" action="{{ route('DataCustomer',1) }}">
                    <div class="float-right form-inline">
                      <div class="btn-group">
                        <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                          <span class="fas fa-print"></span> Print
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a target="_blank" class="dropdown-item" href="{{ route('MasterDataCustomer.show',[0]) }}?Fromdate={{$newfdate}}&Todate={{$newtdate}}&Status={{$status}}&Type={{1}}"> 
                              <i class="fas fa-file-pdf text-red"></i> Print PDF
                            </a>
                          </li>
                          <li class="dropdown-divider"></li>
                          <li>
                            <a target="_blank" class="dropdown-item" href="{{ route('MasterDataCustomer.show',[0]) }}?Fromdate={{$newfdate}}&Todate={{$newtdate}}&Status={{$status}}&Type={{2}}"> 
                              <i class="fas fa-file-excel text-green"></i> Print Excel
                            </a>
                          </li>
                        </ul>
                      </div>
                      <button type="submit" class="btn bg-warning btn-app">
                        <span class="fas fa-search"></span> Search
                      </button>
                    </div>
                    <div class="float-right form-inline">
                      <label class="mr-sm-2">จากวันที่ : </label>
                      <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />

                      <label class="mr-sm-2">ถึงวันที่ : </label>
                      <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                    </div>
                    <br><br>
                    <div class="float-right form-inline">
                      <label class="mr-sm-2">สถานะ : </label>
                      <select name="Status" class="form-control form-control-sm">
                        <option selected value="">--- เลือกสถานะ ---</option>
                        <option value="ลูกค้าสอบถาม"{{ ($status == '1') ? 'selected' : '' }}>ลูกค้าสอบถาม</option>
                        <option value="ลูกค้าจัดไฟแนนท์"{{ ($status == '2') ? 'selected' : '' }}>ลูกค้าจัดไฟแนนท์</option>
                      </select>

                      <label class="mr-sm-2">ประเภท : </label>
                      <select name="Typelab" class="form-control form-control-sm">
                        <option selected value="">--- เลือกประเภท ----</option>
                        <option value="เช่าซื้อ">เช่าซื้อ</option>
                        <option value="PLoan">PLoan</option>
                        <option value="Micro">Micro</option>
                      </select>
                    </div>
                  </form>
                  <br>

                  <hr>
                  @if($type == 1)
                    <div class="table-responsive">
                      <table class="table table-striped table-valign-middle" id="table1">
                        <thead>
                          <tr>
                            <th class="text-center" style="width:10px;">#</th>
                            <th class="text-center">ลำดับ</th>
                            <th class="text-center">สาขา</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">วันที่เข้า</th>
                            <th class="text-center">ป้ายทะเบียน</th>
                            <th class="text-center">ยอดจัด</th>
                            <th class="text-center">ชื่อลูกค้า</th>
                            <th class="text-center">เบอร์ติดต่อ</th>
                            <th class="text-center">เลขบัตร ปชช</th>
                            <th class="text-center" style="width:110px;"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key => $row)
                            <tr>
                              <td class="text-center">
                              @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                                <form method="post" class="delete_form" action="{{ route('MasterDataCustomer.destroy',[$row->Customer_id]) }}" style="display:inline;">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" data-name="" class="delete-modal btn btn-xs AlertForm text-red" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                              @endif
                              </td>
                              <td class="text-center">{{$key+1}}</td>
                              <td class="text-center">{{$row->Branch_car}}</td>
                              <td class="text-center">{{$row->Type_leasing}}</td>
                              <td class="text-center">{{DateThai(substr($row->created_at,0,10))}}</td>
                              <td class="text-center">{{$row->License_car}}</td>
                              <td class="text-center">{{number_format($row->Top_car,2)}}</td>
                              <td class="text-center">{{($row->Name_buyer != Null) ? $row->Name_buyer : '-'}}   {{$row->Last_buyer}}</td>
                              <td class="text-center">{{($row->Phone_buyer != Null) ? $row->Phone_buyer : '-'}}</td>
                              <td class="text-center">{{($row->IDCard_buyer != Null) ? $row->IDCard_buyer : '-'}}</td>
                              <td class="text-right">
                                @if($row->Status_leasing == 1) 
                                  <a href="{{ route('DataCustomer.savestatus', [2, $row->Customer_id]) }}" class="btn btn-warning btn-sm" title="จัดไฟแนนท์">
                                    <i class="far fa-edit"></i> จัดไฟแนนท์
                                  </a>
                                @else
                                  <a href="#" class="btn btn-success btn-sm" title="ส่งแล้ว">
                                    <i class="fas fa-check"></i> ส่งแล้ว
                                  </a> 
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @elseif($type == 2)
                    wait
                  @endif
                  <a id="button"></a>
                </div>
              </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <!-- Walkin modal -->
  <form name="form2" action="{{ route('MasterDataCustomer.store') }}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="modal fade" id="modal-walkin" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 20px 20px 20px 20px;">
              <div class="modal-header bg-warning" style="border-radius: 20px 20px 20px 20px;">
                <div class="col text-center">
                  <h6 class="modal-title"><i class="fas fa-users"></i> ข้อมูลลูกค้า WALK IN</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>
              <div class="modal-body text-sm">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ประเภทการจัด :</label>
                      <div class="col-sm-8">
                        <select id="TypeLeasing" name="TypeLeasing" class="form-control form-control-sm" required>
                          <option value="" selected>--- เลือกประเภทจัดไฟแนนท์ ---</option>
                            <option value="F01">F01 - สัญญาเช่าซื้อ</option>
                            <option value="" style="color:red">---------------------------------------------------</option>
                            <option value="P03">P03 - สัญญาเงินกู้รถยนต์</option>
                            <option value="P04">P04 - สัญญาเงินกู้รถจักรยานยนต์</option>
                            <option value="P06">P06 - สัญญาเงินกู้ส่วนบุคคล</option>
                            <option value="P07">P07 - สัญญาเงินกู้พนักงาน</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ป้ายทะเบียน :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Licensecar" class="form-control form-control-sm" placeholder="ป้อนป้ายทะเบียน"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยี่ห้อรถ : </label>
                      <div class="col-sm-7">
                        <select name="Brandcar" class="form-control form-control-sm">
                          <option value="" selected style="color:red">--- ยี่ห้อรถยนต์ ------</option>
                          <option value="ISUZU">ISUZU</option>
                          <option value="MITSUBISHI">MITSUBISHI</option>
                          <option value="TOYOTA">TOYOTA</option>
                          <option value="MAZDA">MAZDA</option>
                          <option value="FORD">FORD</option>
                          <option value="NISSAN">NISSAN</option>
                          <option value="HONDA">HONDA</option>
                          <option value="CHEVROLET">CHEVROLET</option>
                          <option value="MG">MG</option>
                          <option value="SUZUKI">SUZUKI</option>
                          <option value="" style="color:red">--- ยี่ห้อรถจักรยานยนต์ ------</option>
                          <option value="HONDA">HONDA</option>
                          <option value="YAMAHA">YAMAHA</option>
                          <option value="KAWASAKI">KAWASAKI</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">รุ่นรถ : </label>
                      <div class="col-sm-8">
                        <input type="text" name="Modelcar" class="form-control form-control-sm" placeholder="ป้อนรุ่นรถ" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ประเภทรถ : </label>
                      <div class="col-sm-7">
                        <select id="Typecardetail" name="Typecardetail" class="form-control form-control-sm">
                          <option value="" selected style="color:red">--- ประเภทรถรถยนต์ ---</option>
                          <option value="รถกระบะ">รถกระบะ</option>
                          <option value="รถตอนเดียว">รถตอนเดียว</option>
                          <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                          <option value="" style="color:red">--- ประเภทรถจักรยานยนต์ ------</option>
                          <option value="เกียร์ธรรมดา">เกียร์ธรรมดา</option>
                          <option value="รถออโตเมติก">รถออโตเมติก</option>
                          <option value="BigBike">BigBike</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดจัด :</label>
                      <div class="col-sm-8">
                        <input type="text" id="topcar" name="Topcar" class="form-control form-control-sm" placeholder="ป้อนยอดจัด" oninput="addcomma();" maxlength="9" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ปีรถ : </label>
                      <div class="col-sm-7">
                        <select id="Yearcar" name="Yearcar" class="form-control form-control-sm">
                          <option value="" selected>--- เลือกปี ---</option>
                            @php
                                $Year = date('Y');
                            @endphp
                            @for ($i = 0; $i < 20; $i++)
                              <option value="{{ $Year }}">{{ $Year }}</option>
                              @php
                                  $Year -= 1;
                              @endphp
                            @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right"> ระยะเวลา :</label>
                      <div class="col-sm-8">
                        <input type="text" id="topcar" name="Topcar" class="form-control form-control-sm" placeholder="ป้อนระยะเวลา" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ชำระต่องวด  : </label>
                      <div class="col-sm-7">
                        <input type="text" id="topcar" name="Topcar" class="form-control form-control-sm" readonly/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ดอกเบี้ย/ปี :</label>
                      <div class="col-sm-8">
                        <input type="text" id="topcar" name="Topcar" class="form-control form-control-sm" placeholder="ป้อนดอกเบี้ย/ปี" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดชำระทั้งหมด  : </label>
                      <div class="col-sm-7">
                        <input type="text" id="topcar" name="Topcar" class="form-control form-control-sm" readonly/>
                      </div>
                    </div>
                  </div>
                </div>
                  <hr>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ชื่อลูกค้า :</label>
                      <div class="col-sm-4">
                        <input type="text" name="Namebuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อ" required/>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="Lastbuyer" class="form-control form-control-sm" placeholder="นามสกุล" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ชื่อนายหน้า :</label>
                      <div class="col-sm-7">
                        <input type="text" name="Nameagent" class="form-control form-control-sm" placeholder="ป้อนชื่อนายหน้า"/>
                      </div>
                      <!-- <div class="col-sm-3">
                        <input type="text" name="Lastagent" class="form-control form-control-sm" placeholder="ป้อนสกุล"/>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">เบอร์ลูกค้า :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Phonebuyer" class="form-control form-control-sm" placeholder="ป้อนเบอร์ลูกค้า" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">เบอร์นายหน้า :</label>
                      <div class="col-sm-7">
                        <input type="text" name="Phoneagent" class="form-control form-control-sm" placeholder="ป้อนเบอร์นายหน้า"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">เลขบัตร ปชช :</label>
                      <div class="col-sm-8">
                        <input type="text" name="IDCardbuyer" class="form-control form-control-sm" placeholder="ป้อนเลขบัตร ปชช" maxlength="13"/>
                      </div>
                      <br>
                      <label class="col-sm-4 col-form-label text-right">ที่มาของลูกค้า :</label>
                      <div class="col-sm-8">
                      <select id="News" name="News" class="form-control form-control-sm" required>
                          <option value="" selected>--- เลือกแหล่งที่มา ---</option>
                          <option value="นายหน้าแนะนำ">นายหน้าแนะนำ</option>
                          <option value="Facebook">Facebook</option>
                          <option value="Line">Line</option>
                          <option value="ป้ายโฆษณา">ป้ายโฆษณา</option>
                          <option value="วิทยุ">วิทยุ</option>
                          <option value="เพื่อนแนะนำ">เพื่อนแนะนำ</option>
                        </select>
                      </div>
                      <br>
                      <label class="col-sm-4 col-form-label text-right">สาขา :</label>
                      <div class="col-sm-8">
                        <select id="branchcar" name="branchcar" class="form-control form-control-sm" required>
                          <option value="" selected>--- เลือกสาขา ---</option>
                          <option value="ปัตตานี" {{ (auth::user()->branch == 50) ? 'selected' : '' }}>ปัตตานี</option>
                          <option value="ยะลา" {{ (auth::user()->branch == 51) ? 'selected' : '' }}>ยะลา</option>
                          <option value="นราธิวาส" {{ (auth::user()->branch == 52) ? 'selected' : '' }}>นราธิวาส</option>
                          <option value="สายบุรี" {{ (auth::user()->branch == 53) ? 'selected' : '' }}>สายบุรี</option>
                          <option value="โกลก" {{ (auth::user()->branch == 54) ? 'selected' : '' }}>โกลก</option>
                          <option value="เบตง" {{ (auth::user()->branch == 55) ? 'selected' : '' }}>เบตง</option>
                          <option value="โคกโพธิ์" {{ (auth::user()->branch == 56) ? 'selected' : '' }}>โคกโพธิ์</option>
                          <option value="ตันหยงมัส" {{ (auth::user()->branch == 57) ? 'selected' : '' }}>ตันหยงมัส</option>
                          <option value="รือเสาะ" {{ (auth::user()->branch == 58) ? 'selected' : '' }}>รือเสาะ</option>
                          <option value="บันนังสตา" {{ (auth::user()->branch == 59) ? 'selected' : '' }}>บันนังสตา</option>
                          <option value="ยะหา" {{ (auth::user()->branch == 60) ? 'selected' : '' }}>ยะหา</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                      <div class="col-sm-7">
                        <textarea class="form-control" name="Notecar" rows="7" placeholder="ป้อนหมายเหตุ..."></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              <hr>
              </div>
              <input type="hidden" name="NameUser" value="{{auth::user()->name}}"/>

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
        "ordering": false,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "order": [[ 1, "asc" ]],
      });
    });
  </script>

  <script>
    function blinker() {
      $('.prem').fadeOut(1500);
      $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>

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
    function addcomma(){
      var num11 = document.getElementById('topcar').value;
      var num1 = num11.replace(",","");
      document.form2.topcar.value = addCommas(num1);
    }
  </script>
@endsection
