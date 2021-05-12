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


  <div class="content-header">
    <div class="row justify-content-center">
      <div class="col-md-12 table-responsive">
        <div class="card">
      
          {{--<div class="card-header mb-1">
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
          </div>--}}

          <!-- <div class="card-body"> -->

            <div class="row" style="padding: 15px;">
              <div class="col-md-3">

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-calculator"></i> โปรแกรมคำนวณค่างวด</h3>
                  </div>
                  <div class="card-body p-0">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="vert-tabs-1-tab" data-toggle="pill" href="#vert-tabs-1" role="tab" aria-controls="vert-tabs-1" aria-selected="false">
                          <img class="img-responsive" src="{{ asset('dist/img/leasing02.png') }}" alt="User Image" style = "width: 10%"> 
                          คำนวณค่างวดเช่าซื้อ
                          <span class="badge bg-primary float-right"></span>
                        </a>
                        <a class="nav-link" id="vert-tabs-2-tab" data-toggle="pill" href="#vert-tabs-2" role="tab" aria-controls="vert-tabs-2" aria-selected="false">
                          <img class="img-responsive" src="{{ asset('dist/img/leasing03.png') }}" alt="User Image" style = "width: 10%">
                          คำนวณค่างวดเงินกู้
                          <span class="badge bg-primary float-right"></span>
                        </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card card-outline">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade active show" id="vert-tabs-1" role="tabpanel" aria-labelledby="vert-tabs-1-tab">
                              <div class="card-header bg-warning">
                                <h3 class="card-title">คำนวณค่างวดเช่าซื้อ</h3>
                                <div class="card-tools">
                                  <button type="button" id="LS" class="btn btn-tool"><i class="fas fa-image"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <br>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดจัด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TopcarLS" name="TopcarLS" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ระยะเวลา :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TimelackLS" name="TimelackLS" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="InterestLS" name="InterestLS" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ค่างวดละ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="DueLS" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดทั้งหมด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TotalLS" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <br>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-2" role="tabpanel" aria-labelledby="vert-tabs-2-tab">
                              <div class="card-header bg-danger">
                                <h3 class="card-title">คำนวณค่างวดเงินกู้</h3>
                                <div class="card-tools">
                                  <button type="button" id="PL" class="btn btn-tool"><i class="fas fa-image"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <br>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">กรรมสิทธิ์ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <select id="OwnerLoan" name="OwnerLoan" class="form-control form-control-sm" required>
                                            <option value="" selected style="color:red">--- กรรมสิทธิ์รถ ---</option>
                                            <option value="ถือกรรมสิทธิ์">ถือกรรมสิทธิ์</option>
                                            <option value="ไม่ถือกรรมสิทธิ์">ไม่ถือกรรมสิทธิ์</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดกู้ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TopcarPL" name="TopcarPL" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ระยะเวลา :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TimelackPL" name="TimelackPL" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="InterestPL" name="InterestPL" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ค่างวดละ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="DuePL" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดทั้งหมด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TotalPL" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <br>
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>     
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="card" id="LS-TAB">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                          <div class="tab-pane fade active show mb-3" role="tabpanel">
                            <div class="card-header bg-warning">
                              <h3 class="card-title"></h3>
                              <div class="card-tools">
                                <button type="button" id="LS-close" class="btn btn-tool"><i class="fas fa-times-circle"></i>
                                </button>
                              </div>
                            </div>
                            <div class="col-12">
                              <img class="img-responsive mb-1" src="{{ asset('dist/img/programs/LS-krabat.png') }}" alt="User Image" style = "width: 100%">
                              <img class="img-responsive mb-1" src="{{ asset('dist/img/programs/LS-sevenseat.png') }}" alt="User Image" style = "width: 100%">
                              <img class="img-responsive mb-1" src="{{ asset('dist/img/programs/LS-oneton.png') }}" alt="User Image" style = "width: 100%">
                            </div>
                          </div>
                      </div>
                    </div>     
                  </div>
                </div>
                <div class="card" id="PL-TAB">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                          <div class="tab-pane fade active show" role="tabpanel">
                            <div class="card-header bg-danger">
                              <h3 class="card-title"></h3>
                              <div class="card-tools">
                                <button type="button" id="PL-close" class="btn btn-tool"><i class="fas fa-times-circle"></i>
                                </button>
                              </div>
                            </div>
                            <div class="col-12">
                              <br>
                              <img class="img-responsive mb-1" src="{{ asset('dist/img/programs/PL-all.png') }}" alt="User Image" style = "width: 100%">
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

  <script>
  $("#LS-TAB").hide();
  $("#PL-TAB").hide();
    $('#LS').on("click" ,function() {
      $("#LS-TAB").show();
      $("#PL-TAB").hide();
    });
      $('#LS-close').on("click" ,function() {
        $("#LS-TAB").hide();
      });

    $('#PL').on("click" ,function() {
      $("#PL-TAB").show();
      $("#LS-TAB").hide();
    });
      $('#PL-close').on("click" ,function() {
        $("#PL-TAB").hide();
      });
  </script>
@endsection