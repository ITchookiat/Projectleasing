@extends('layouts.master')
@section('title','Home')
@section('content')
  <style>
    i:hover {
      color: blue;
    }
  </style>

  @if(session()->has('success'))
    <script type="text/javascript">
      toastr.success('{{ session()->get('success') }}')
    </script>
  @endif


  <div class="content-header" style="padding: 50px;">
    <div class="row justify-content-center">
      <div class="col-md-12 table-responsive">
        <div class="card">
      
          <div class="card-header mb-1">
            <div class="form-inline">
              <div class="col-sm-4">
                <h4 class="m-0 text-dark text-left"><i class="fa fa-calculator"></i> Programs</h4>
              </div>
              <div class="col-sm-8">
                @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก รถบ้าน")
                  <!-- <form method="get" action="#">
                    <div class="float-right">
                      <small class="badge" style="font-size: 14px;">
                        <i class="fas fa-sign"></i> วันที่ :
                        <input type="date" name="Fromdate" value="" class="form-control pr-3" />
                        ถึงวันที่ :
                        <input type="date" name="Todate" value="" class="form-control" />&nbsp;
                        <button type="submit" class="btn btn-info" title="ค้นหา">
                          <span class="fas fa-search"></span> ค้นหา
                        </button>
                      </small>
                    </div>
                  </form> -->
                @endif
              </div>
            </div>
          </div>

          <!-- <div class="card-body"> -->

            <div class="row" style="padding: 15px;">
              <div class="col-md-3">

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <!-- <h3 class="card-title">โปรแกรมคำนวณค่างวด</h3> -->
                  </div>
                  <div class="card-body p-0">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="vert-tabs-1-tab" data-toggle="pill" href="#vert-tabs-1" role="tab" aria-controls="vert-tabs-1" aria-selected="false">
                          <i class="fas fa-car"></i> คำนวณค่างวดเช่าซื้อ

                            <span class="badge bg-primary float-right"></span>
                        </a>
                        <a class="nav-link" id="vert-tabs-2-tab" data-toggle="pill" href="#vert-tabs-2" role="tab" aria-controls="vert-tabs-2" aria-selected="false">
                          <i class="fas fa-money"></i> คำนวณค่างวดเงินกู้

                            <span class="badge bg-primary float-right"></span>
                        </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="card card-outline">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade active show" id="vert-tabs-1" role="tabpanel" aria-labelledby="vert-tabs-1-tab">
                              <div class="card-header">
                                <h3 class="card-title">คำนวณค่างวดเช่าซื้อ</h3>
                              </div>
                              <div class="col-12">
                                <br>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดจัด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="demotopcar" name="demotopcar" maxlength="7" class="form-control form-control" placeholder="ป้อนยอดจัด" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดจัด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="demotopcar" name="demotopcar" maxlength="7" class="form-control form-control" placeholder="ป้อนยอดจัด" required/>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-2" role="tabpanel" aria-labelledby="vert-tabs-2-tab">
                              <div class="card-header">
                                <h3 class="card-title">คำนวณค่างวดเงินกู้</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                1111111111111111111111111111111111111
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>     
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade active show" id="vert-tabs-1" role="tabpanel" aria-labelledby="vert-tabs-1-tab">
                              <div class="card-header">
                                <h3 class="card-title">ผลลัพธ์</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                555555555555555555555555555555
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>     
                  </div>
                </div>
              </div>
            </div>
          <!-- </div> -->

        </div>
      </div>
    </div>
  </div>

  <!-- Walkin modal -->
  <form name="form2" action="{{ route('MasterDataCustomer.store') }}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="modal fade" id="modal-walkin" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
              <div class="modal-header bg-warning" style="border-radius: 30px 30px 30px 30px;">
                <div class="col text-center">
                  <h5 class="modal-title"><i class="fas fa-users"></i> ลูกค้า WALK IN</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label text-right"><font color="red">*** ป้ายทะเบียน :</font> </label>
                        <div class="col-sm-7">
                          <input type="text" name="Licensecar" class="form-control" placeholder="ป้อนป้ายทะเบียน" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ยี่ห้อรถ : </label>
                        <div class="col-sm-7">
                          <select name="Brandcar" class="form-control">
                            <option value="" selected>--- ยี่ห้อ ---</option>
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
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">รุ่นรถ : </label>
                        <div class="col-sm-7">
                          <input type="text" name="Modelcar" class="form-control" placeholder="ป้อนรุ่นรถ" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ประเภทรถ : </label>
                        <div class="col-sm-7">
                          <select id="Typecardetail" name="Typecardetail" class="form-control">
                            <option value="" selected>--- ประเภทรถ ---</option>
                            <option value="รถกระบะ">รถกระบะ</option>
                            <option value="รถตอนเดียว">รถตอนเดียว</option>
                            <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right"><font color="red"> ยอดจัด : </font> </label>
                        <div class="col-sm-7">
                          <input type="text" id="topcar" name="Topcar" class="form-control" placeholder="ป้อนยอดจัด" oninput="addcomma();" maxlength="9" required/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ปีรถ : </label>
                        <div class="col-sm-7">
                          <select id="Yearcar" name="Yearcar" class="form-control">
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
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">ชื่อลูกค้า :</label>
                        <div class="col-sm-4">
                          <input type="text" name="Namebuyer" class="form-control" placeholder="ชื่อลูกค้า"/>
                        </div>
                        <div class="col-sm-3">
                          <input type="text" name="Lastbuyer" class="form-control" placeholder="นามสกุล"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">ชื่อนายหน้า :</label>
                        <div class="col-sm-7">
                          <input type="text" name="Nameagent" class="form-control" placeholder="ป้อนชื่อนายหน้า"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">เบอร์ลูกค้า :</label>
                        <div class="col-sm-7">
                          <input type="text" name="Phonebuyer" class="form-control" placeholder="ป้อนเบอร์ลูกค้า"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">เบอร์นายหน้า :</label>
                        <div class="col-sm-7">
                          <input type="text" name="Phoneagent" class="form-control" placeholder="ป้อนเบอร์นายหน้า"/>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-5 col-form-label text-right">เลขบัตร ปชช :</label>
                        <div class="col-sm-7">
                          <input type="text" name="IDCardbuyer" class="form-control" placeholder="ป้อนเลขบัตร ปชช" maxlength="13"/>
                        </div>
                        <br><br>
                        <label class="col-sm-5 col-form-label text-right"><font color="red">ที่มาของลูกค้า :</font></label>
                        <div class="col-sm-7">
                        <!-- <select id="TypeLeasing" name="TypeLeasing" class="form-control" required>
                            <option value="" selected>--- เลือกประเภทสินเชื่อ ---</option>
                            <option value="เช่าซื้อ">เช่าซื้อ</option>
                            <option value="เงินกู้">เงินกู้</option>
                        </select> -->
                        <select id="News" name="News" class="form-control" required>
                            <option value="" selected>--- เลือกแหล่งที่มา ---</option>
                            <option value="นายหน้าแนะนำ">นายหน้าแนะนำ</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Line">Line</option>
                            <option value="ป้ายโฆษณา">ป้ายโฆษณา</option>
                            <option value="วิทยุ">วิทยุ</option>
                            <option value="เพื่อนแนะนำ">เพื่อนแนะนำ</option>
                            <option value="Websites">Websites</option>
                          </select>
                        </div>
                        <br><br>
                        <label class="col-sm-5 col-form-label text-right">สาขา :</label>
                        <div class="col-sm-7">
                          <select id="branchcar" name="branchcar" class="form-control" required>
                                <option value="" selected>--- เลือกสาขา ---</option>
                                <option value="ปัตตานี" {{ (auth::user()->branch == '01') ? 'selected' : '' }}>ปัตตานี</option>
                                <option value="ยะลา" {{ (auth::user()->branch == '03') ? 'selected' : '' }}>ยะลา</option>
                                <option value="นราธิวาส" {{ (auth::user()->branch == '04') ? 'selected' : '' }}>นราธิวาส</option>
                                <option value="สายบุรี" {{ (auth::user()->branch == '05') ? 'selected' : '' }}>สายบุรี</option>
                                <option value="โกลก" {{ (auth::user()->branch == '06') ? 'selected' : '' }}>โกลก</option>
                                <option value="เบตง" {{ (auth::user()->branch == '07') ? 'selected' : '' }}>เบตง</option>
                                <option value="โคกโพธิ์" {{ (auth::user()->branch == '08') ? 'selected' : '' }}>โคกโพธิ์</option>
                                <option value="ตันหยงมัส" {{ (auth::user()->branch == '09') ? 'selected' : '' }}>ตันหยงมัส</option>
                                <option value="รือเสาะ" {{ (auth::user()->branch == '12') ? 'selected' : '' }}>รือเสาะ</option>
                                <option value="บังนังสตา" {{ (auth::user()->branch == '13') ? 'selected' : '' }}>บังนังสตา</option>
                                <option value="ยะหา" {{ (auth::user()->branch == '14') ? 'selected' : '' }}>ยะหา</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                        <div class="col-sm-7">
                          <textarea class="form-control" name="Notecar" rows="5" placeholder="ป้อนหมายเหตุ..."></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
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

  <script>
      function blinker() {
      $('.prem').fadeOut(1500);
      $('.prem').fadeIn(1500);
      }
      setInterval(blinker, 1500);
  </script>

<script>
    $(function () {
      $("#table1,#table2").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "searching": false,
        "lengthChange": false,
        "order": [[ 0, "asc" ]],
        "pageLength": 25,
      });
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
