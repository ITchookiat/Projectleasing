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
                            <th class="text-center">สาขา</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center">วันที่เข้า</th>
                            <th class="text-center">ป้ายทะเบียน</th>
                            <th class="text-center">ชื่อลูกค้า</th>
                            <th class="text-center">เบอร์ติดต่อ</th>
                            <th class="text-center">หมายเหตุ</th>
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
                              <td class="text-center">{{$row->Branch_car}}</td>
                              <td class="text-left">{{$row->Type_leasing}}</td>
                              <td class="text-center">{{DateThai(substr($row->created_at,0,10))}}</td>
                              <td class="text-center">{{$row->License_car}}</td>
                              <td class="text-left">{{($row->Name_buyer != Null) ? $row->Name_buyer : '-'}}   {{$row->Last_buyer}}</td>
                              <td class="text-center">{{($row->Phone_buyer != Null) ? $row->Phone_buyer : '-'}}</td>
                              <td class="text-left">
                                <span title="{{$row->Note_car}}">
                                  {{ str_limit($row->Note_car,20) }}
                                </span>  
                              </td>
                              <td class="text-right">
                                @if($row->Status_leasing == 1) 
                                  <a href="{{ route('DataCustomer.savestatus', [2, $row->Customer_id]) }}" class="btn btn-warning btn-sm" title="จัดไฟแนนท์">
                                    <i class="far fa-edit"></i>
                                  </a>
                                @else
                                  <a href="#" class="btn btn-success btn-sm" title="ส่งแล้ว">
                                    <i class="fas fa-check"></i>
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
                      <label class="col-sm-4 col-form-label text-right"><font color="red"> * ประเภทการจัด : </font></label>
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
                        <input type="text" id="Topcar" name="Topcar" class="form-control form-control-sm" placeholder="ป้อนยอดจัด" maxlength="9" />
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
                <hr>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ระยะเวลา : </label>
                      <div class="col-sm-8">
                        <input type="text" id="Timelack" name="Timelack" class="form-control form-control-sm" placeholder="ป้อนระยะเวลา" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ชำระต่องวด  : </label>
                      <div class="col-sm-7">
                        <input type="text" id="Period" name="Period" class="form-control form-control-sm" readonly/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label id="InterestText" class="col-sm-4 col-form-label text-right">ดอกเบี้ย :</label>
                      <div class="col-sm-8">
                        <input type="text" id="Interest" name="Interest" class="form-control form-control-sm" placeholder="ป้อนดอกเบี้ย" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right">ยอดชำระทั้งหมด  : </label>
                      <div class="col-sm-7">
                        <input type="text" id="TotalPeriod" name="TotalPeriod" class="form-control form-control-sm" readonly/>
                        <input type="hidden" id="TotalPeriod2" name="TotalPeriod2" class="form-control form-control-sm" readonly/>
                        <input type="hidden" id="Tax" name="Tax" class="form-control form-control-sm" readonly/>
                        <input type="hidden" id="Tax2" name="Tax2" class="form-control form-control-sm" readonly/>
                        <input type="hidden" id="Durate" name="Durate" class="form-control form-control-sm" readonly/>
                        <input type="hidden" id="Durate2" name="Durate2" class="form-control form-control-sm" readonly/>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right"><font color="red"> * </font> ชื่อลูกค้า :</label>
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
                    <label class="col-sm-4 col-form-label text-right"><font color="red"> * </font> เบอร์ลูกค้า :</label>
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

                      <!-- <br>
                      <label class="col-sm-4 col-form-label text-right">ประเภทการจัด :</label>
                      <div class="col-sm-8">
                        <select name="TypeLeasing" class="form-control form-control-sm" required>
                          <option value="" selected>--- เลือกประเภทจัดไฟแนนท์ ---</option>
                            <option value="F01">F01 - สัญญาเช่าซื้อ</option>
                            <option value="" style="color:red">---------------------------------------------------------</option>
                            <option value="P03">P03 - สัญญาเงินกู้รถยนต์</option>
                            <option value="P04">P04 - สัญญาเงินกู้รถจักรยานยนต์</option>
                            <option value="P06">P06 - สัญญาเงินกู้ส่วนบุคคล</option>
                            <option value="P07">P07 - สัญญาเงินกู้พนักงาน</option>
                        </select>
                      </div> -->
                      
                      <br>
                      <label class="col-sm-4 col-form-label text-right"><font color="red"> * </font> ที่มาของลูกค้า :</label>
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
                      <label class="col-sm-4 col-form-label text-right"><font color="red"> * </font> สาขา :</label>
                      <div class="col-sm-8">
                        <select id="branchcar" name="branchcar" class="form-control form-control-sm" required>
                          <option value="" selected>--- เลือกสาขา ---</option>
                          <option value="ปัตตานี" {{ (auth::user()->branch == 50) ? 'selected' : '' }} {{ (auth::user()->branch == '01') ? 'selected' : '' }}>ปัตตานี</option>
                          <option value="ยะลา" {{ (auth::user()->branch == 51) ? 'selected' : '' }} {{ (auth::user()->branch == '03') ? 'selected' : '' }}>ยะลา</option>
                          <option value="นราธิวาส" {{ (auth::user()->branch == 52) ? 'selected' : '' }} {{ (auth::user()->branch == '04') ? 'selected' : '' }}>นราธิวาส</option>
                          <option value="สายบุรี" {{ (auth::user()->branch == 53) ? 'selected' : '' }} {{ (auth::user()->branch == '05') ? 'selected' : '' }}>สายบุรี</option>
                          <option value="โกลก" {{ (auth::user()->branch == 54) ? 'selected' : '' }} {{ (auth::user()->branch == '06') ? 'selected' : '' }}>โกลก</option>
                          <option value="เบตง" {{ (auth::user()->branch == 55) ? 'selected' : '' }} {{ (auth::user()->branch == '07') ? 'selected' : '' }}>เบตง</option>
                          <option value="โคกโพธิ์" {{ (auth::user()->branch == 56) ? 'selected' : '' }} {{ (auth::user()->branch == '08') ? 'selected' : '' }}>โคกโพธิ์</option>
                          <option value="ตันหยงมัส" {{ (auth::user()->branch == 57) ? 'selected' : '' }} {{ (auth::user()->branch == '09') ? 'selected' : '' }}>ตันหยงมัส</option>
                          <option value="รือเสาะ" {{ (auth::user()->branch == 58) ? 'selected' : '' }} {{ (auth::user()->branch == '12') ? 'selected' : '' }}>รือเสาะ</option>
                          <option value="บันนังสตา" {{ (auth::user()->branch == 59) ? 'selected' : '' }} {{ (auth::user()->branch == '13') ? 'selected' : '' }}>บันนังสตา</option>
                          <option value="ยะหา" {{ (auth::user()->branch == 60) ? 'selected' : '' }} {{ (auth::user()->branch == '14') ? 'selected' : '' }}>ยะหา</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                    <label class="col-sm-4 col-form-label text-right"><font color="red"> * </font> หมายเหตุ :</label>
                      <div class="col-sm-7">
                        <textarea class="form-control" name="Notecar" rows="4" placeholder="ป้อนหมายเหตุ..." required></textarea>
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
    $('#TypeLeasing,#Topcar,#Timelack,#Interest').on("input" ,function() {
        var Gettype= document.getElementById('TypeLeasing').value;
        var Gettopcar = document.getElementById('Topcar').value;
        var Topcar = Gettopcar.replace(",","");
        var Gettimelack = document.getElementById('Timelack').value;
        var Getinterest = document.getElementById('Interest').value;
        $("#Topcar").val(addCommas(Topcar));

        if(Gettype == ""){
          $("#InterestText").text("ดอกเบี้ย :");
        }
        else if(Gettype == "F01"){
          if({{$SettingValue->Interesttype_set}} == '12'){
            $("#InterestText").text("ดอกเบี้ย/เดือน :");
          }else if({{$SettingValue->Interesttype_set}} == '1'){
            $("#InterestText").text("ดอกเบี้ย/ปี :");
          }
          if(Gettimelack == '12'){
             var Timelack = '1';
          }else if(Gettimelack == '18'){
             var Timelack = '1.5';
          }else if(Gettimelack == '24'){
             var Timelack = '2';
          }else if(Gettimelack == '30'){
             var Timelack = '2.5';
          }else if(Gettimelack == '36'){
             var Timelack = '3';
          }else if(Gettimelack == '42'){
             var Timelack = '3.5';
          }else if(Gettimelack == '48'){
            var Timelack = '4';
          }else if(Gettimelack == '54'){
             var Timelack = '4.5';
          }else if(Gettimelack == '60'){
             var Timelack = '5';
          }else if(Gettimelack == '66'){
             var Timelack = '5.5';
          }else if(Gettimelack == '72'){
             var Timelack = '6';
          }else if(Gettimelack == '78'){
             var Timelack = '6.5';
          }else if(Gettimelack == '84'){
             var Timelack = '7';
          }
          var Interest = Getinterest * {{$SettingValue->Interesttype_set}};
          var NewInterest = (Interest * Timelack) + 100;
          var Period = Math.ceil(((((Topcar * NewInterest) / 100) * 1.07) / Gettimelack) /10) * 10;
          var TotalPeriod = Period * Gettimelack;

          var Durate = Period / (({{$SettingValue->Taxvalue_set}}/100) + 1);
          var Durate2 = Durate.toFixed(2) * Gettimelack;
          var Tax = Period - Durate;
          var Tax2 = Tax.toFixed(2) * Gettimelack;

          if(Gettimelack != "" && Getinterest != ""){
            $("#Period").val(addCommas(Period.toFixed(2)));
            $("#TotalPeriod").val(addCommas(TotalPeriod.toFixed(2)));

            $("#TotalPeriod2").val(addCommas(TotalPeriod.toFixed(2)));
            $("#Tax").val(addCommas(Tax.toFixed(2)));
            $("#Tax2").val(addCommas(Tax2.toFixed(2)));
            $("#Durate").val(addCommas(Durate.toFixed(2)));
            $("#Durate2").val(addCommas(Durate2.toFixed(2)));
          }
        }
        else{
          if({{$SettingValue2->Interesttype_set}} == '12'){
            $("#InterestText").text("ดอกเบี้ย/เดือน :");
          }else if({{$SettingValue2->Interesttype_set}} == '1'){
            $("#InterestText").text("ดอกเบี้ย/ปี :");
          }
          var InterestP = ((Getinterest / 100) / 1) * {{$SettingValue2->Interesttype_set}};
          var ProcessP = (parseFloat(Topcar) + (parseFloat(Topcar) * parseFloat(InterestP) * (Gettimelack / 12))) / Gettimelack;
          var str = ProcessP.toString();
          var Setstring = parseInt(str.split(".", 1));
          var PeriodP = Math.ceil(Setstring/10)*10;
          var TotalPeriodP = PeriodP * Gettimelack;
          var Profit = TotalPeriodP - Topcar;

          if(Gettimelack != "" && Getinterest != ""){
            $("#Period").val(addCommas(PeriodP.toFixed(2)));
            $("#TotalPeriod").val(addCommas(TotalPeriodP.toFixed(2)));
            $("#Tax").val(addCommas(Profit.toFixed(2)));
          }
        }


    });
  </script>
@endsection
