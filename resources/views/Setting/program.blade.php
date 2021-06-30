@extends('layouts.master')
@section('title','Home')
@section('content')
  <style>
    i:hover {
      color: blue;
    }
    select,option:disabled {
      color:red;
    }
  </style>
  <style>
    #todo-list{
    width:100%;
    /* margin:0 auto 190px auto; */
    padding:5px;
    background:white;
    position:relative;
    /*box-shadow*/
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
          box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    /*border-radius*/
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
          border-radius:5px;}
    #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
          box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
    -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
    }
    .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
    -moz-box-shadow:0 2px 0 -1px #ebebeb;
          box-shadow:0 2px 0 -1px #ebebeb;
    }
    .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
          box-shadow:none;
    }
    input[type="checkbox"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
    }
    .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 10px);
    left:0;
    width:0%;
    height:1px;
    /* background:#cd4400; */
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    }
    .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
    -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
          box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
          border-radius:4px;
    }
    .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
    -moz-box-shadow:inset 0 0 0 2px #949494;
          box-shadow:inset 0 0 0 2px #949494;
    }
    .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
    }
    :checked + .todo{
    color:#717171;
    }
    :checked + .todo:before{
    width:100%;
    }
    :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
    -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
          box-shadow:inset 0 0 0 2px #0eb0b7;
    }
    :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
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
          @if($type == 3)
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
                                        <input type="text" id="TopcarLeasing" name="TopcarLeasing" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ระยะเวลา :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TimelackLeasing" name="TimelackLeasing" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="InterestLeasing" name="InterestLeasing" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ค่างวดละ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="DueLeasing" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดทั้งหมด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TotalLeasing" class="form-control form-control" readonly/>
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
                                <!-- <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">กรรมสิทธิ์ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <select id="OwnerPLoan" name="OwnerPLoan" class="form-control form-control-sm" required>
                                            <option value="" selected style="color:red">--- กรรมสิทธิ์รถ ---</option>
                                            <option value="ถือกรรมสิทธิ์">ถือกรรมสิทธิ์</option>
                                            <option value="ไม่ถือกรรมสิทธิ์">ไม่ถือกรรมสิทธิ์</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดกู้ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TopcarPLoan" name="TopcarPLoan" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ระยะเวลา :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TimelackPLoan" name="TimelackPLoan" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ดอกเบี้ย :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="InterestPLoan" name="InterestPLoan" maxlength="7" class="form-control form-control" required/>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ค่างวดละ :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="DuePLoan" class="form-control form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-3 col-form-label text-right">ยอดทั้งหมด :</label>
                                    <div class="col-sm-7 mb-1">
                                        <input type="text" id="TotalPLoan" class="form-control form-control" readonly/>
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
          @elseif($type == 4)
          <form name="form1" action="{{ route('MasterSetting.store') }}" method="post" id="formimage" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="type" value="1" />
              <div class="row" style="padding: 15px;">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-tasks"></i> เป้าประจำเดือน {{date('m')}}</h3>
                    </div>
                      <div class="text-sm" id="todo-list">
                        <table>
                          <tr>
                            <td width="3px">
                              <span class="todo-wrap">
                                <input type="checkbox" id="1" name="ContractsCar" value="complete" {{ ($dataLeasing !== null) ? 'checked' : '' }} disabled/>
                                <label for="1" class="todo">
                                  <i class="fa fa-check"></i>
                                </label>
                              </span>
                            </td>
                            <td width="150px"><b class="text-gray">Leasing</b></td>
                            <td width="60px">
                              @if($dataLeasing != null)
                                <div class="form-inline">
                                  <a href="#" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-editlist" data-backdrop="static"
                                    data-link="{{ route('MasterSetting.show',[$dataLeasing->Target_id]) }}?type={{3}}">
                                    <i class="fa fa-edit text-warning pr-2"></i>
                                  </a>
                                  <!-- <a href="#"><i class="fa fa-trash text-danger"></i></a> -->
                                </div>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td width="3px">
                              <span class="todo-wrap">
                                <input type="checkbox" id="2" name="ContractsCar" value="complete" {{ ($dataPloan !== null) ? 'checked' : '' }} disabled/>
                                <label for="2" class="todo">
                                  <i class="fa fa-check"></i>
                                </label>
                              </span>
                            </td>
                            <td width="150px"><b class="text-gray">Ploan</b></td>
                            <td width="60px">
                              @if($dataPloan != null)
                                <div class="form-inline">
                                  <a href="#"><i class="fa fa-edit text-warning pr-2"></i></a>
                                  <!-- <a href="#"><i class="fa fa-trash text-danger"></i></a> -->
                                </div>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td width="3px">
                              <span class="todo-wrap">
                                <input type="checkbox" id="3" name="ContractsCar" value="complete" {{ ($dataMicro !== null) ? 'checked' : '' }} disabled/>
                                <label for="3" class="todo">
                                  <i class="fa fa-check"></i>
                                </label>
                              </span>
                            </td>
                            <td width="150px"><b class="text-gray">Micro</b></td>
                            <td width="60px">
                              @if($dataMicro != null)
                                <div class="form-inline">
                                  <a href="#"><i class="fa fa-edit text-warning pr-2"></i></a>
                                  <!-- <a href="#"><i class="fa fa-trash text-danger"></i></a> -->
                                </div>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td width="3px">
                              <span class="todo-wrap">
                                <input type="checkbox" id="4" name="ContractsCar" value="complete" {{ ($dataMotor !== null) ? 'checked' : '' }} disabled/>
                                <label for="4" class="todo">
                                  <i class="fa fa-check"></i>
                                </label>
                              </span>
                            </td>
                            <td width="150px"><b class="text-gray">มอเตอร์ไซค์</b></td>
                            <td width="60px">
                              @if($dataMotor != null)
                                <div class="form-inline">
                                  <a href="#"><i class="fa fa-edit text-warning pr-2"></i></a>
                                  <!-- <a href="#"><i class="fa fa-trash text-danger"></i></a> -->
                                </div>
                              @endif
                            </td>
                          </tr>
                        </table>
                      </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card card-outline">
                    <div class="card-body p-0 text-sm">
                      <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="tab-content" id="vert-tabs-tabContent">
                              <div class="tab-pane fade active show" id="vert-tabs-1" role="tabpanel" aria-labelledby="vert-tabs-1-tab">
                                <div class="card-header bg-warning">
                                  <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> เพิ่มเป้าผลิตภัณฑ์</h3>
                                  <div class="card-tools">
                                    <button type="submit" class="delete-modal btn-xs btn btn-success">
                                      <i class="fas fa-save"></i> บันทึก
                                    </button>
                                    <a href="{{ route('index','home') }}" class="btn btn-xs btn btn-danger">
                                      <i class="fas fa-close"></i> ยกเลิก
                                    </a>
                                  </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                  <br>
                                  <div class="card">
                                      <div class="card-body" style="display: block;">
                                        <div class="row">
                                          <div class="col-4">
                                            <label class="text-right">ประเภท :</label>
                                            <div class="mb-1">
                                                <select name="TargetType" class="form-control" required>
                                                  <option value="" selected>---- เลือกประเภท ----</option>
                                                  <option value="Leasing" {{ ($dataLeasing !== null) ? 'disabled' : '' }}>Leasing</option>
                                                  <option value="Ploan" {{ ($dataPloan !== null) ? 'disabled' : '' }}>Ploan</option>
                                                  <option value="Micro" {{ ($dataMicro !== null) ? 'disabled' : '' }}>Micro</option>
                                                  <option value="Motor" {{ ($dataMotor !== null) ? 'disabled' : '' }}>มอเตอร์ไซค์</option>
                                                </select>
                                              </div>
                                          </div>
                                          <div class="col-4">
                                                <label class="text-right">เดือน :</label>
                                                <div class="mb-1">
                                                  <select name="TargetMonth" class="form-control" required>
                                                    <option value="" selected>--- เลือกเดือน ---</option>
                                                    <option value="01" {{ (date('m') == '01') ? 'selected' : '' }}>มกราคม</option>
                                                    <option value="02" {{ (date('m') == '02') ? 'selected' : '' }}>กุมภาพันธ์</option>
                                                    <option value="03" {{ (date('m') == '03') ? 'selected' : '' }}>มีนาคม</option>
                                                    <option value="04" {{ (date('m') == '04') ? 'selected' : '' }}>เมษายน</option>
                                                    <option value="05" {{ (date('m') == '05') ? 'selected' : '' }}>พฤษภาคม</option>
                                                    <option value="06" {{ (date('m') == '06') ? 'selected' : '' }}>มิถุนายน</option>
                                                    <option value="07" {{ (date('m') == '07') ? 'selected' : '' }}>กรกฎาคม</option>
                                                    <option value="08" {{ (date('m') == '08') ? 'selected' : '' }}>สิงหาคม</option>
                                                    <option value="09" {{ (date('m') == '09') ? 'selected' : '' }}>กันยายน</option>
                                                    <option value="10" {{ (date('m') == '10') ? 'selected' : '' }}>ตุลาคม</option>
                                                    <option value="11" {{ (date('m') == '11') ? 'selected' : '' }}>พฤศจิกายน</option>
                                                    <option value="12" {{ (date('m') == '12') ? 'selected' : '' }}>ธันวาคม</option>
                                                  </select>
                                                </div>
                                          </div>
                                          <div class="col-4">
                                            <label class="text-right">ปี :</label>
                                            <div class="mb-1">
                                              <select name="TargetYear" class="form-control" required>
                                                <option value="" selected>--- เลือกปี ---</option>
                                              @php
                                                  $Year = date('Y');
                                              @endphp
                                              @for ($i = 0; $i < 10; $i++)
                                                <option value="{{ $Year }}" {{ (date('Y') == $Year) ? 'selected' : '' }}>{{ $Year }}</option>
                                                @php
                                                    $Year -= 1;
                                                @endphp
                                              @endfor
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-4">
                                      <div class="card">
                                        <div class="card-header" style="background-color:#E9E9E8;">
                                          <h5 class="card-title text-sm">จังหวัดปัตตานี</h5>
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                          <label class="text-right">01 - ปัตตานี :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetPattani" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">05 - สายบุรี :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetSaiburi" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">08 - โคกโพธิ์ :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetKhopor" maxlength="7" class="form-control"/>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-4">
                                      <div class="card">
                                        <div class="card-header" style="background-color:#E9E9E8;">
                                          <h5 class="card-title text-sm">จังหวัดยะลา</h5>
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                          <label class="text-right">03 - ยะลา :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetYala" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">07 - เบตง :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetBetong" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">13 - บันนังสตา :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetBangnansta" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">14 - ยะหา :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetYaha" maxlength="7" class="form-control"/>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-4">
                                      <div class="card">
                                        <div class="card-header" style="background-color:#E9E9E8;">
                                          <h5 class="card-title text-sm">จังหวัดนราธิวาส</h5>
                                          <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="card-body" style="display: block;">
                                          <label class="text-right">04 - นราธิวาส :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetNara" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">06 - โกลก :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetKolok" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">09 - ตันหยงมัส :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetTangyongmas" maxlength="7" class="form-control"/>
                                          </div>
                                          <label class="text-right">12 - รือเสาะ :</label>
                                          <div class="mb-1">
                                              <input type="number" name="TargetRosok" maxlength="7" class="form-control"/>
                                          </div>
                                        </div>
                                      </div>
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

                <div class="col-md-2">
                </div>
              </div>
          </form>
          @endif
      </div>
    </div>
  </div>

  {{-- popup แก้ไขรายการซ่อม --}}
  <div class="modal fade" id="modal-editlist">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function () {
      $("#modal-editlist").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-editlist .modal-dialog").load(link, function(){
        });
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
    $('#TopcarLeasing,#TimelackLeasing,#InterestLeasing').on("input" ,function() {
        var GetTopcarLS = document.getElementById('TopcarLeasing').value;
        var GetTimelackLS = document.getElementById('TimelackLeasing').value;
        var GetInterestLS = document.getElementById('InterestLeasing').value;
        var TopcarLS = GetTopcarLS.replace(",","");
        $("#TopcarLeasing").val(addCommas(TopcarLS));

        if(GetTopcarLS != '' && GetTimelackLS != '' && GetInterestLS != ''){

          var setInterest = GetInterestLS * 12;
          var Newinterest = (setInterest * (GetTimelackLS / 12)) + 100;
          var ResultperiodLS = Math.ceil(((((TopcarLS * Newinterest) / 100) * 1.07) / GetTimelackLS) /10) * 10;
          var ResulttotalLS = ResultperiodLS * GetTimelackLS;

          $("#DueLeasing").val(addCommas(ResultperiodLS.toFixed(2)));
          $("#TotalLeasing").val(addCommas(ResulttotalLS.toFixed(2)));

        }


    });

    $('#TopcarPLoan,#TimelackPLoan,#InterestPLoan').on("input" ,function() {
        // var GetOwnPL = document.getElementById('OwnerPLoan').value;
        var GetTopcarPL = document.getElementById('TopcarPLoan').value;
        var GetTimelackPL = document.getElementById('TimelackPLoan').value;
        var GetInterestPL = document.getElementById('InterestPLoan').value;
        var TopcarPL = GetTopcarPL.replace(",","");
        $("#TopcarPLoan").val(addCommas(TopcarPL));

        if(GetTopcarPL != '' && GetTimelackPL != '' && GetInterestPL != ''){

            // if (GetOwnPL == 'ไม่ถือกรรมสิทธิ์') {
            //     var Extrainterest = '0.2';
            // } else{
            //     var Extrainterest = '0.0';
            // }
            
            var interestPL = parseFloat(GetInterestPL);
            var SetInterestPL = ((interestPL/100)/1) * 12;
            var ProcessPL = (parseFloat(TopcarPL) + (parseFloat(TopcarPL) * parseFloat(SetInterestPL) * (GetTimelackPL / 12))) / GetTimelackPL;      
            
            var strPL = ProcessPL.toString();
            var setstringPL = parseInt(strPL.split(".", 1));
            var ResultperiodPL = Math.ceil(setstringPL/10)*10;
            var ResulttotalPL = ResultperiodPL * GetTimelackPL;
            
            $("#DuePLoan").val(addCommas(ResultperiodPL.toFixed(2)));
            $("#TotalPLoan").val(addCommas(ResulttotalPL.toFixed(2)));

        }
    });
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
      $('#vert-tabs-1-tab').on("click" ,function() {
        $("#PL-TAB").hide();
      });
      

    $('#PL').on("click" ,function() {
      $("#PL-TAB").show();
      $("#LS-TAB").hide();
    });
      $('#PL-close').on("click" ,function() {
        $("#PL-TAB").hide();
      });
      $('#vert-tabs-2-tab').on("click" ,function() {
        $("#LS-TAB").hide();
      });
  </script>
@endsection
