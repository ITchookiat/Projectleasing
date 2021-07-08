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
    $TotalAllProduct = $SumMicroAll + $SumPloanAll + $SumLeasingAll + $SumStaffAll + $SumHomecarAll + $SumMotorAll;
    $TotalAllProduct2 = $SumTopcar_MicroAll + $SumTopcar_PloanAll + $SumTopcar_LeasingAll + $SumTopcar_HomecarAll + $SumTopcar_StaffAll + $SumTopcar_MotorAll;

    $Total_baabLeasing = $Total_PN + $Total_SB + $Total_KP + $Total_YL + $Total_BT + $Total_BNT + $Total_YH + $Total_NR + $Total_KOL + $Total_TM + $Total_RS;
    $Total_baabPloan = $Total_PN_Ploan + $Total_SB_Ploan + $Total_KP_Ploan + $Total_YL_Ploan + $Total_BT_Ploan + $Total_BNT_Ploan + $Total_YH_Ploan + $Total_NR_Ploan + $Total_KOL_Ploan + $Total_TM_Ploan + $Total_RS_Ploan;
    $Total_baabMicro = $Total_PN_Micro + $Total_SB_Micro + $Total_KP_Micro + $Total_YL_Micro + $Total_BT_Micro + $Total_BNT_Micro + $Total_YH_Micro + $Total_NR_Micro + $Total_KOL_Micro + $Total_TM_Micro + $Total_RS_Micro;
    $Total_baabMotor = $Total_PN_Motor + $Total_SB_Motor + $Total_KP_Motor + $Total_YL_Motor + $Total_BT_Motor + $Total_BNT_Motor + $Total_YH_Motor + $Total_NR_Motor + $Total_KOL_Motor + $Total_TM_Motor + $Total_RS_Motor;
  @endphp

  <div class="content-header">
    <div class="row justify-content-center">
      <div class="col-md-12 table-responsive">
      
            <div class="form-inline">
              <div class="col-sm-4">
                <h5 class="m-0 text-dark text-left">
                <i class="fa fa-dashboard"></i> 
                  <a class="text-dark" href="{{ route('index','home') }}">Dashboard</a> | <a class="text-dark" href="{{ route('index','home') }}?Dashboard={{2}}">Dashboard 2</a>
                </h5>
              </div>
              <div class="col-sm-8">
                @if($Allproducts == '')
                  <form method="get" action="#">
                    <div class="float-right">
                      <small class="badge" style="font-size: 12px;">
                        ข้อมูลวันที่ :
                        <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm pr-3" />
                        ถึงวันที่ :
                        <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />&nbsp;
                        <button type="submit" class="btn btn-sm btn-dark" title="ค้นหา">
                          <span class="fas fa-search"></span> ค้นหา
                        </button>
                        <input type="hidden" name="Dashboard" value="2"/>&nbsp;
                      </small>
                    </div>
                  </form>
                @endif
              </div>
            </div>

          <!-- <div class="card-body"> -->
            <div class="row">
              <div class="col-md-2">

                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">
                      <a href="{{ route('index','home') }}?Dashboard={{2}}" style="color:black;">
                        ยอดไฟแนนซ์และเงินกู้
                      </a>
                    </h3>
                  </div>
                  <div class="card-body p-0">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="vert-tabs-1-tab" data-toggle="pill" href="#vert-tabs-1" role="tab" aria-controls="vert-tabs-1" aria-selected="false">
                          <i class="fas fa-car"></i> ยอดคัน
                            <span class="badge bg-primary float-right">@if($Allproducts == '') {{number_format($TotalAllProduct)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-2-tab" data-toggle="pill" href="#vert-tabs-2" role="tab" aria-controls="vert-tabs-2" aria-selected="false">
                          <i class="fas fa-money"></i> ยอดเงิน
                            <span class="badge bg-primary float-right">@if($Allproducts == '') {{number_format($TotalAllProduct2)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-3-tab" data-toggle="pill" href="#vert-tabs-3" role="tab" aria-controls="vert-tabs-3" aria-selected="false">
                          <i class="fa fa-list-alt"></i> ยอดจัดเฉลี่ย
                            <span class="badge bg-primary float-right">@if($Allproducts == '') @if($TotalAllProduct != 0 ){{number_format($TotalAllProduct2 / $TotalAllProduct)}}@else 0 @endif @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-4-tab" data-toggle="pill" href="#vert-tabs-4" role="tab" aria-controls="vert-tabs-4" aria-selected="false">
                          <i class="far fa-dot-circle nav-icon text-success"></i> แบบจัด(เช่าซื้อ)
                            <span class="badge bg-success float-right">@if($Allproducts == '') {{number_format($Total_baabLeasing)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-5-tab" data-toggle="pill" href="#vert-tabs-5" role="tab" aria-controls="vert-tabs-5" aria-selected="false">
                          <i class="far fa-dot-circle nav-icon text-secondary"></i> แบบจัด(Ploan)
                            <span class="badge bg-success float-right">@if($Allproducts == '') {{number_format($Total_baabPloan)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-6-tab" data-toggle="pill" href="#vert-tabs-6" role="tab" aria-controls="vert-tabs-6" aria-selected="false">
                          <i class="far fa-dot-circle nav-icon text-warning"></i> แบบจัด(Micro)
                            <span class="badge bg-success float-right">@if($Allproducts == '') {{number_format($Total_baabMicro)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-7-tab" data-toggle="pill" href="#vert-tabs-7" role="tab" aria-controls="vert-tabs-7" aria-selected="false">
                          <i class="far fa-dot-circle nav-icon text-danger"></i> แบบจัด(มอไซค์)
                            <span class="badge bg-success float-right">@if($Allproducts == '') {{number_format($Total_baabMotor)}} @endif</span>
                        </a>
                        <a class="nav-link" id="vert-tabs-8-tab" data-toggle="pill" href="#vert-tabs-8" role="tab" aria-controls="vert-tabs-8" aria-selected="false">
                          <i class="far fa-dot-circle nav-icon text-primary"></i> พนักงาน & รถบ้าน
                            <span class="badge bg-success float-right">@if($Allproducts == '') {{number_format($SumStaffAll + $SumHomecarAll)}} @endif</span>
                        </a>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="card" style="background-color:#E2DEDF ;">
                    <a class="nav-link" href="{{ route('index','home') }}?all={{'Y'}}&Dashboard={{2}}">
                        ยอดจัด(All products)
                        <span class="badge bg-danger float-right">@if($Allproducts == 'Y'){{number_format($TotalAllProduct)}}@endif</span>
                    </a>
                </div>

              </div>

              <div class="col-md-10">
                <div class="card card-primary card-outline">
                  <div class="card-body p-0 text-sm">
                    <div class="row">
                      <div class="col-12 col-sm-12">
                        <div class="tab-content" id="vert-tabs-tabContent">

                          @if($Allproducts == '')
                            <div class="tab-pane fade active show" id="vert-tabs-1" role="tabpanel" aria-labelledby="vert-tabs-1-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">ยอดคัน</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="table1" style="border-radius : 20px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td style="width: 90px">สาขา</td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{5}}" style="color:#FFF;">Micro</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{1}}" style="color:#FFF;">P-Loan</a></td>
                                      <td><a href="{{ route('Analysis', 1) }}" style="color:#FFF;">เช่าซื้อ</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{4}}" style="color:#FFF;">พนักงาน</a></td>
                                      <td><a href="{{ route('Analysis',4) }}" style="color:#FFF;">รถบ้าน</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{3}}" style="color:#FFF;">มอเตอร์ไซค์</a></td>
                                      <td style="width: 90px">ผลรวมยอดคัน</td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ปัตตานี</b></td>
                                      <td>{{($Micro50 != 0) ?$Micro50: ''}}</td>
                                      <td>{{($Ploan50 != 0) ?$Ploan50: ''}}</td>
                                      <td>{{($Leasing01 != 0) ?$Leasing01: ''}}</td>
                                      <td>{{($Staff50 != 0) ?$Staff50: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor50 != 0) ?$Motor50: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro50 + $Ploan50 + $Leasing01 + $Staff50 + $Motor50}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะลา</b></td>
                                      <td>{{($Micro51 != 0) ?$Micro51: ''}}</td>
                                      <td>{{($Ploan51 != 0) ?$Ploan51: ''}}</td>
                                      <td>{{($Leasing03 != 0) ?$Leasing03: ''}}</td>
                                      <td>{{($Staff51 != 0) ?$Staff51: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor51 != 0) ?$Motor51: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro51 + $Ploan51 + $Leasing03 + $Staff51 + $Motor51}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>นราธิวาส</b></td>
                                      <td>{{($Micro52 != 0) ?$Micro52: ''}}</td>
                                      <td>{{($Ploan52 != 0) ?$Ploan52: ''}}</td>
                                      <td>{{($Leasing04 != 0) ?$Leasing04: ''}}</td>
                                      <td>{{($Staff52 != 0) ?$Staff52: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor52 != 0) ?$Motor52: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro52 + $Ploan52 + $Leasing04 + $Staff52 + $Motor52}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>สายบุรี</b></td>
                                      <td>{{($Micro53 != 0) ?$Micro53: ''}}</td>
                                      <td>{{($Ploan53 != 0) ?$Ploan53: ''}}</td>
                                      <td>{{($Leasing05 != 0) ?$Leasing05: ''}}</td>
                                      <td>{{($Staff53 != 0) ?$Staff53: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor53 != 0) ?$Motor53: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro53 + $Ploan53 + $Leasing05 + $Staff53 + $Motor53}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โกลก</b></td>
                                      <td>{{($Micro54 != 0) ?$Micro54: ''}}</td>
                                      <td>{{($Ploan54 != 0) ?$Ploan54: ''}}</td>
                                      <td>{{($Leasing06 != 0) ?$Leasing06: ''}}</td>
                                      <td>{{($Staff54 != 0) ?$Staff54: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor54 != 0) ?$Motor54: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro54 + $Ploan54 + $Leasing06 + $Staff54 + $Motor54}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>เบตง</b></td>
                                      <td>{{($Micro55 != 0) ?$Micro55: ''}}</td>
                                      <td>{{($Ploan55 != 0) ?$Ploan55: ''}}</td>
                                      <td>{{($Leasing07 != 0) ?$Leasing07: ''}}</td>
                                      <td>{{($Staff55 != 0) ?$Staff55: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor55 != 0) ?$Motor55: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro55 + $Ploan55 + $Leasing07 + $Staff55 + $Motor55}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โคกโพธิ์</b></td>
                                      <td>{{($Micro56 != 0) ?$Micro56: ''}}</td>
                                      <td>{{($Ploan56 != 0) ?$Ploan56: ''}}</td>
                                      <td>{{($Leasing08 != 0) ?$Leasing08: ''}}</td>
                                      <td>{{($Staff56 != 0) ?$Staff56: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor56 != 0) ?$Motor56: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro56 + $Ploan56 + $Leasing08 + $Staff56 + $Motor56}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ตันหยงมัส</b></td>
                                      <td>{{($Micro57 != 0) ?$Micro57: ''}}</td>
                                      <td>{{($Ploan57 != 0) ?$Ploan57: ''}}</td>
                                      <td>{{($Leasing09 != 0) ?$Leasing09: ''}}</td>
                                      <td>{{($Staff57 != 0) ?$Staff57: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor57 != 0) ?$Motor57: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro57 + $Ploan57 + $Leasing09 + $Staff57 + $Motor57}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รือเสาะ</b></td>
                                      <td>{{($Micro58 != 0) ?$Micro58: ''}}</td>
                                      <td>{{($Ploan58 != 0) ?$Ploan58: ''}}</td>
                                      <td>{{($Leasing12 != 0) ?$Leasing12: ''}}</td>
                                      <td>{{($Staff58 != 0) ?$Staff58: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor58 != 0) ?$Motor58: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro58 + $Ploan58 + $Leasing12 + $Staff58 + $Motor58}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>บันนังสตา</b></td>
                                      <td>{{($Micro59 != 0) ?$Micro59: ''}}</td>
                                      <td>{{($Ploan59 != 0) ?$Ploan59: ''}}</td>
                                      <td>{{($Leasing13 != 0) ?$Leasing13: ''}}</td>
                                      <td>{{($Staff59 != 0) ?$Staff59: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor59 != 0) ?$Motor59: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro59 + $Ploan59 + $Leasing13 + $Staff59 + $Motor59}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะหา</b></td>
                                      <td>{{($Micro60 != 0) ?$Micro60: ''}}</td>
                                      <td>{{($Ploan60 != 0) ?$Ploan60: ''}}</td>
                                      <td>{{($Leasing14 != 0) ?$Leasing14: ''}}</td>
                                      <td>{{($Staff60 != 0) ?$Staff60: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor60 != 0) ?$Motor60: ''}}</td>
                                      <td class="bg-warning"><b>{{$Micro60 + $Ploan60 + $Leasing14 + $Staff60 + $Motor60}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รถบ้าน</b></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>{{($SumHomecarAll != 0) ?$SumHomecarAll: ''}}</td>
                                      <td></td>
                                      <td class="bg-warning"><b>{{$SumHomecarAll}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left"><b>รวม</b></td>
                                      <td><b>{{$SumMicroAll}}</b></td>
                                      <td><b>{{$SumPloanAll}}</b></td>
                                      <td><b>{{$SumLeasingAll}}</b></td>
                                      <td><b>{{$SumStaffAll}}</b></td>
                                      <td><b>{{$SumHomecarAll}}</b></td>
                                      <td><b>{{$SumMotorAll}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{$TotalAllProduct}}</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-2" role="tabpanel" aria-labelledby="vert-tabs-2-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">ยอดเงิน</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td style="width: 90px">สาขา</td>
                                      <td>Micro</td>
                                      <td>P-Loan</td>
                                      <td>เช่าซื้อ</td>
                                      <td>พนักงาน</td>
                                      <td>รถบ้าน</td>
                                      <td>มอเตอร์ไซค์</td>
                                      <td style="width: 90px">ผลรวมยอดเงิน</td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ปัตตานี</b></td>
                                      <td>@if($Topcar_Micro50 != 0){{number_format($Topcar_Micro50)}}@endif</td>
                                      <td>@if($Topcar_Ploan50 != 0){{number_format($Topcar_Ploan50)}}@endif</td>
                                      <td>@if($Topcar_Leasing01 != 0){{number_format($Topcar_Leasing01)}}@endif</td>
                                      <td>@if($Topcar_Staff50 != 0){{number_format($Topcar_Staff50)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor50 != 0){{number_format($Topcar_Motor50)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro50 + $Topcar_Ploan50 + $Topcar_Leasing01 + $Topcar_Staff50 + $Topcar_Motor50)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะลา</b></td>
                                      <td>@if($Topcar_Micro51 != 0){{number_format($Topcar_Micro51)}}@endif</td>
                                      <td>@if($Topcar_Ploan51 != 0){{number_format($Topcar_Ploan51)}}@endif</td>
                                      <td>@if($Topcar_Leasing03 != 0){{number_format($Topcar_Leasing03)}}@endif</td>
                                      <td>@if($Topcar_Staff51 != 0){{number_format($Topcar_Staff51)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor51 != 0){{number_format($Topcar_Motor51)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro51 + $Topcar_Ploan51 + $Topcar_Leasing03 + $Topcar_Staff51 + $Topcar_Motor51)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>นราธิวาส</b></td>
                                      <td>@if($Topcar_Micro52 != 0){{number_format($Topcar_Micro52)}}@endif</td>
                                      <td>@if($Topcar_Ploan52 != 0){{number_format($Topcar_Ploan52)}}@endif</td>
                                      <td>@if($Topcar_Leasing04 != 0){{number_format($Topcar_Leasing04)}}@endif</td>
                                      <td>@if($Topcar_Staff52 != 0){{number_format($Topcar_Staff52)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor52 != 0){{number_format($Topcar_Motor52)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro52 + $Topcar_Ploan52 + $Topcar_Leasing04 + $Topcar_Staff52 + $Topcar_Motor52)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>สายบุรี</b></td>
                                      <td>@if($Topcar_Micro53 != 0){{number_format($Topcar_Micro53)}}@endif</td>
                                      <td>@if($Topcar_Ploan53 != 0){{number_format($Topcar_Ploan53)}}@endif</td>
                                      <td>@if($Topcar_Leasing05 != 0){{number_format($Topcar_Leasing05)}}@endif</td>
                                      <td>@if($Topcar_Staff53 != 0){{number_format($Topcar_Staff53)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor53 != 0){{number_format($Topcar_Motor53)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro53 + $Topcar_Ploan53 + $Topcar_Leasing05 + $Topcar_Staff53 + $Topcar_Motor53)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โกลก</b></td>
                                      <td>@if($Topcar_Micro54 != 0){{number_format($Topcar_Micro54)}}@endif</td>
                                      <td>@if($Topcar_Ploan54 != 0){{number_format($Topcar_Ploan54)}}@endif</td>
                                      <td>@if($Topcar_Leasing06 != 0){{number_format($Topcar_Leasing06)}}@endif</td>
                                      <td>@if($Topcar_Staff54 != 0){{number_format($Topcar_Staff54)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor54 != 0){{number_format($Topcar_Motor54)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro54 + $Topcar_Ploan54 + $Topcar_Leasing06 + $Topcar_Staff54 + $Topcar_Motor54)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>เบตง</b></td>
                                      <td>@if($Topcar_Micro55 != 0){{number_format($Topcar_Micro55)}}@endif</td>
                                      <td>@if($Topcar_Ploan55 != 0){{number_format($Topcar_Ploan55)}}@endif</td>
                                      <td>@if($Topcar_Leasing07 != 0){{number_format($Topcar_Leasing07)}}@endif</td>
                                      <td>@if($Topcar_Staff55 != 0){{number_format($Topcar_Staff55)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor55 != 0){{number_format($Topcar_Motor55)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro55 + $Topcar_Ploan55 + $Topcar_Leasing07 + $Topcar_Staff55 + $Topcar_Motor55)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โคกโพธิ์</b></td>
                                      <td>@if($Topcar_Micro56 != 0){{number_format($Topcar_Micro56)}}@endif</td>
                                      <td>@if($Topcar_Ploan56 != 0){{number_format($Topcar_Ploan56)}}@endif</td>
                                      <td>@if($Topcar_Leasing08 != 0){{number_format($Topcar_Leasing08)}}@endif</td>
                                      <td>@if($Topcar_Staff56 != 0){{number_format($Topcar_Staff56)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor56 != 0){{number_format($Topcar_Motor56)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro56 + $Topcar_Ploan56 + $Topcar_Leasing08 + $Topcar_Staff56 + $Topcar_Motor56)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ตันหยงมัส</b></td>
                                      <td>@if($Topcar_Micro57 != 0){{number_format($Topcar_Micro57)}}@endif</td>
                                      <td>@if($Topcar_Ploan57 != 0){{number_format($Topcar_Ploan57)}}@endif</td>
                                      <td>@if($Topcar_Leasing09 != 0){{number_format($Topcar_Leasing09)}}@endif</td>
                                      <td>@if($Topcar_Staff57 != 0){{number_format($Topcar_Staff57)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor57 != 0){{number_format($Topcar_Motor57)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro57 + $Topcar_Ploan57 + $Topcar_Leasing09 + $Topcar_Staff57 + $Topcar_Motor57)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รือเสาะ</b></td>
                                      <td>@if($Topcar_Micro58 != 0){{number_format($Topcar_Micro58)}}@endif</td>
                                      <td>@if($Topcar_Ploan58 != 0){{number_format($Topcar_Ploan58)}}@endif</td>
                                      <td>@if($Topcar_Leasing12 != 0){{number_format($Topcar_Leasing12)}}@endif</td>
                                      <td>@if($Topcar_Staff58 != 0){{number_format($Topcar_Staff58)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor58 != 0){{number_format($Topcar_Motor58)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro58 + $Topcar_Ploan58 + $Topcar_Leasing12 + $Topcar_Staff58 + $Topcar_Motor58)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>บันนังสตา</b></td>
                                      <td>@if($Topcar_Micro59 != 0){{number_format($Topcar_Micro59)}}@endif</td>
                                      <td>@if($Topcar_Ploan59 != 0){{number_format($Topcar_Ploan59)}}@endif</td>
                                      <td>@if($Topcar_Leasing13 != 0){{number_format($Topcar_Leasing13)}}@endif</td>
                                      <td>@if($Topcar_Staff59 != 0){{number_format($Topcar_Staff59)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor59 != 0){{number_format($Topcar_Motor59)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro59 + $Topcar_Ploan59 + $Topcar_Leasing13 + $Topcar_Staff59 + $Topcar_Motor59)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะหา</b></td>
                                      <td>@if($Topcar_Micro60 != 0){{number_format($Topcar_Micro60)}}@endif</td>
                                      <td>@if($Topcar_Ploan60 != 0){{number_format($Topcar_Ploan60)}}@endif</td>
                                      <td>@if($Topcar_Leasing14 != 0){{number_format($Topcar_Leasing14)}}@endif</td>
                                      <td>@if($Topcar_Staff60 != 0){{number_format($Topcar_Staff60)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor60 != 0){{number_format($Topcar_Motor60)}}@endif</td>
                                      <td class="bg-warning"><b>{{number_format($Topcar_Micro60 + $Topcar_Ploan60 + $Topcar_Leasing14 + $Topcar_Staff60 + $Topcar_Motor60)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รถบ้าน</b></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>{{number_format($SumTopcar_HomecarAll)}}</td>
                                      <td></td>
                                      <td class="bg-warning"><b>{{number_format($SumTopcar_HomecarAll)}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left"><b>รวม</b></td>
                                      <td><b>{{number_format($SumTopcar_MicroAll)}}</b></td>
                                      <td><b>{{number_format($SumTopcar_PloanAll)}}</b></td>
                                      <td><b>{{number_format($SumTopcar_LeasingAll)}}</b></td>
                                      <td><b>{{number_format($SumTopcar_StaffAll)}}</td>
                                      <td><b>{{number_format($SumTopcar_HomecarAll)}}</b></td>
                                      <td><b>{{number_format($SumTopcar_MotorAll)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{number_format($TotalAllProduct2)}}</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-3" role="tabpanel" aria-labelledby="vert-tabs-3-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">ยอดจัดเฉลี่ย</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td style="width: 90px">สาขา</td>
                                      <td>Micro</td>
                                      <td>P-Loan</td>
                                      <td>เช่าซื้อ</td>
                                      <td>พนักงาน</td>
                                      <td>รถบ้าน</td>
                                      <td>มอเตอร์ไซค์</td>
                                      <td style="width: 90px">ผลรวมเฉลี่ย</td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ปัตตานี</b></td>
                                      <td>@if($Topcar_Micro50 != 0){{number_format($Topcar_Micro50 / $Micro50)}}@endif</td>
                                      <td>@if($Topcar_Ploan50 != 0){{number_format($Topcar_Ploan50 / $Ploan50)}}@endif</td>
                                      <td>@if($Topcar_Leasing01 != 0){{number_format($Topcar_Leasing01 / $Leasing01)}}@endif</td>
                                      <td>@if($Topcar_Staff50 != 0){{number_format($Topcar_Staff50 / $Staff50)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor50 != 0){{number_format($Topcar_Motor50 / $Motor50)}}@endif</td>
                                      @php 
                                        $All50 = $Micro50 + $Ploan50 + $Leasing01 + $Staff50 + $Motor50;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All50 != 0){{number_format(($Topcar_Micro50 + $Topcar_Ploan50 + $Topcar_Leasing01 + $Topcar_Staff50 + $Topcar_Motor50) / ($Micro50 + $Ploan50 + $Leasing01 + $Staff50 + $Motor50))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะลา</b></td>
                                      <td>@if($Topcar_Micro51 != 0){{number_format($Topcar_Micro51 / $Micro51)}}@endif</td>
                                      <td>@if($Topcar_Ploan51 != 0){{number_format($Topcar_Ploan51 / $Ploan51)}}@endif</td>
                                      <td>@if($Topcar_Leasing03 != 0){{number_format($Topcar_Leasing03 / $Leasing03)}}@endif</td>
                                      <td>@if($Topcar_Staff51 != 0){{number_format($Topcar_Staff51 / $Staff51)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor51 != 0){{number_format($Topcar_Motor51 / $Motor51)}}@endif</td>
                                      @php 
                                        $All51 = $Micro51 + $Ploan51 + $Leasing03 + $Staff51 + $Motor51;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All51 != 0){{number_format(($Topcar_Micro51 + $Topcar_Ploan51 + $Topcar_Leasing03 + $Topcar_Staff51 + $Topcar_Motor51) / ($Micro51 + $Ploan51 + $Leasing03 + $Staff51 + $Motor51))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>นราธิวาส</b></td>
                                      <td>@if($Topcar_Micro52 != 0){{number_format($Topcar_Micro52 / $Micro52)}}@endif</td>
                                      <td>@if($Topcar_Ploan52 != 0){{number_format($Topcar_Ploan52 / $Ploan52)}}@endif</td>
                                      <td>@if($Topcar_Leasing04 != 0){{number_format($Topcar_Leasing04 / $Leasing04)}}@endif</td>
                                      <td>@if($Topcar_Staff52 != 0){{number_format($Topcar_Staff52 / $Staff52)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor52 != 0){{number_format($Topcar_Motor52 / $Motor52)}}@endif</td>
                                      @php 
                                        $All52 = $Micro52 + $Ploan52 + $Leasing04 + $Staff52 + $Motor52;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All52 != 0){{number_format(($Topcar_Micro52 + $Topcar_Ploan52 + $Topcar_Leasing04 + $Topcar_Staff52 + $Topcar_Motor52) / ($Micro52 + $Ploan52 + $Leasing04 + $Staff52 + $Motor52))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>สายบุรี</b></td>
                                      <td>@if($Topcar_Micro53 != 0){{number_format($Topcar_Micro53 / $Micro53)}}@endif</td>
                                      <td>@if($Topcar_Ploan53 != 0){{number_format($Topcar_Ploan53 / $Ploan53)}}@endif</td>
                                      <td>@if($Topcar_Leasing05 != 0){{number_format($Topcar_Leasing05 / $Leasing05)}}@endif</td>
                                      <td>@if($Topcar_Staff53 != 0){{number_format($Topcar_Staff53 / $Staff53)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor53 != 0){{number_format($Topcar_Motor53 / $Motor53)}}@endif</td>
                                      @php 
                                        $All53 = $Micro53 + $Ploan53 + $Leasing05 + $Staff53 + $Motor53;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All53 != 0){{number_format(($Topcar_Micro53 + $Topcar_Ploan53 + $Topcar_Leasing05 + $Topcar_Staff53 + $Topcar_Motor53) / ($Micro53 + $Ploan53 + $Leasing05 + $Staff53 + $Motor53))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โกลก</b></td>
                                      <td>@if($Topcar_Micro54 != 0){{number_format($Topcar_Micro54 / $Micro54)}}@endif</td>
                                      <td>@if($Topcar_Ploan54 != 0){{number_format($Topcar_Ploan54 / $Ploan54)}}@endif</td>
                                      <td>@if($Topcar_Leasing06 != 0){{number_format($Topcar_Leasing06 / $Leasing06)}}@endif</td>
                                      <td>@if($Topcar_Staff54 != 0){{number_format($Topcar_Staff54 / $Staff54)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor54 != 0){{number_format($Topcar_Motor54 / $Motor54)}}@endif</td>
                                      @php 
                                        $All54 = $Micro54 + $Ploan54 + $Leasing06 + $Staff54 + $Motor54;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All54 != 0){{number_format(($Topcar_Micro54 + $Topcar_Ploan54 + $Topcar_Leasing06 + $Topcar_Staff54 + $Topcar_Motor54) / ($Micro54 + $Ploan54 + $Leasing06 + $Staff54 + $Motor54))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>เบตง</b></td>
                                      <td>@if($Topcar_Micro55 != 0){{number_format($Topcar_Micro55 / $Micro55)}}@endif</td>
                                      <td>@if($Topcar_Ploan55 != 0){{number_format($Topcar_Ploan55 / $Ploan55)}}@endif</td>
                                      <td>@if($Topcar_Leasing07 != 0){{number_format($Topcar_Leasing07 / $Leasing07)}}@endif</td>
                                      <td>@if($Topcar_Staff55 != 0){{number_format($Topcar_Staff55 / $Staff55)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor55 != 0){{number_format($Topcar_Motor55 / $Motor55)}}@endif</td>
                                      @php 
                                        $All55 = $Micro55 + $Ploan55 + $Leasing07 + $Staff55 + $Motor55;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All55 != 0){{number_format(($Topcar_Micro55 + $Topcar_Ploan55 + $Topcar_Leasing07 + $Topcar_Staff55 + $Topcar_Motor55) / ($Micro55 + $Ploan55 + $Leasing07 + $Staff55 + $Motor55))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โคกโพธิ์</b></td>
                                      <td>@if($Topcar_Micro56 != 0){{number_format($Topcar_Micro56 / $Micro56)}}@endif</td>
                                      <td>@if($Topcar_Ploan56 != 0){{number_format($Topcar_Ploan56 / $Ploan56)}}@endif</td>
                                      <td>@if($Topcar_Leasing08 != 0){{number_format($Topcar_Leasing08 / $Leasing08)}}@endif</td>
                                      <td>@if($Topcar_Staff56 != 0){{number_format($Topcar_Staff56 / $Staff56)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor56 != 0){{number_format($Topcar_Motor56 / $Motor56)}}@endif</td>
                                      @php 
                                        $All56 = $Micro56 + $Ploan56 + $Leasing08 + $Staff56 + $Motor56;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All56 != 0){{number_format(($Topcar_Micro56 + $Topcar_Ploan56 + $Topcar_Leasing08 + $Topcar_Staff56 + $Topcar_Motor56) / ($Micro56 + $Ploan56 + $Leasing08 + $Staff56 + $Motor56))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ตันหยงมัส</b></td>
                                      <td>@if($Topcar_Micro57 != 0){{number_format($Topcar_Micro57 / $Micro57)}}@endif</td>
                                      <td>@if($Topcar_Ploan57 != 0){{number_format($Topcar_Ploan57 / $Ploan57)}}@endif</td>
                                      <td>@if($Topcar_Leasing09 != 0){{number_format($Topcar_Leasing09 / $Leasing09)}}@endif</td>
                                      <td>@if($Topcar_Staff57 != 0){{number_format($Topcar_Staff57 / $Staff57)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor57 != 0){{number_format($Topcar_Motor57 / $Motor57)}}@endif</td>
                                      @php 
                                        $All57 = $Micro57 + $Ploan57 + $Leasing09 + $Staff57 + $Motor57;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All57 != 0){{number_format(($Topcar_Micro57 + $Topcar_Ploan57 + $Topcar_Leasing09 + $Topcar_Staff57 + $Topcar_Motor57) / ($Micro57 + $Ploan57 + $Leasing09 + $Staff57 + $Motor57))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รือเสาะ</b></td>
                                      <td>@if($Topcar_Micro58 != 0){{number_format($Topcar_Micro58 / $Micro58)}}@endif</td>
                                      <td>@if($Topcar_Ploan58 != 0){{number_format($Topcar_Ploan58 / $Ploan58)}}@endif</td>
                                      <td>@if($Topcar_Leasing12 != 0){{number_format($Topcar_Leasing12 / $Leasing12)}}@endif</td>
                                      <td>@if($Topcar_Staff58 != 0){{number_format($Topcar_Staff58 / $Staff58)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor58 != 0){{number_format($Topcar_Motor58 / $Motor58)}}@endif</td>
                                      @php 
                                        $All58 = $Micro58 + $Ploan58 + $Leasing12 + $Staff58 + $Motor58;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All58 != 0){{number_format(($Topcar_Micro58 + $Topcar_Ploan58 + $Topcar_Leasing12 + $Topcar_Staff58 + $Topcar_Motor58) / ($Micro58 + $Ploan58 + $Leasing12 + $Staff58 + $Motor58))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>บันนังสตา</b></td>
                                      <td>@if($Topcar_Micro59 != 0){{number_format($Topcar_Micro59 / $Micro59)}}@endif</td>
                                      <td>@if($Topcar_Ploan59 != 0){{number_format($Topcar_Ploan59 / $Ploan59)}}@endif</td>
                                      <td>@if($Topcar_Leasing13 != 0){{number_format($Topcar_Leasing13 / $Leasing13)}}@endif</td>
                                      <td>@if($Topcar_Staff59 != 0){{number_format($Topcar_Staff59 / $Staff59)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor59 != 0){{number_format($Topcar_Motor59 / $Motor59)}}@endif</td>
                                      @php 
                                        $All59 = $Micro59 + $Ploan59 + $Leasing13 + $Staff59 + $Motor59;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All59 != 0){{number_format(($Topcar_Micro59 + $Topcar_Ploan59 + $Topcar_Leasing13 + $Topcar_Staff59 + $Topcar_Motor59) / ($Micro59 + $Ploan59 + $Leasing13 + $Staff59 + $Motor59))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะหา</b></td>
                                      <td>@if($Topcar_Micro60 != 0){{number_format($Topcar_Micro60 / $Micro60)}}@endif</td>
                                      <td>@if($Topcar_Ploan60 != 0){{number_format($Topcar_Ploan60 / $Ploan60)}}@endif</td>
                                      <td>@if($Topcar_Leasing14 != 0){{number_format($Topcar_Leasing14 / $Leasing14)}}@endif</td>
                                      <td>@if($Topcar_Staff60 != 0){{number_format($Topcar_Staff60 / $Staff60)}}@endif</td>
                                      <td></td>
                                      <td>@if($Topcar_Motor60 != 0){{number_format($Topcar_Motor60 / $Motor60)}}@endif</td>
                                      @php 
                                        $All60 = $Micro60 + $Ploan60 + $Leasing14 + $Staff60 + $Motor60;
                                      @endphp
                                      <td class="bg-warning"><b>@if($All60 != 0){{number_format(($Topcar_Micro60 + $Topcar_Ploan60 + $Topcar_Leasing14 + $Topcar_Staff60 + $Topcar_Motor60) / ($Micro60 + $Ploan60 + $Leasing14 + $Staff60 + $Motor60))}}@endif</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รถบ้าน</b></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>@if($SumHomecarAll != 0){{number_format($SumTopcar_HomecarAll / $SumHomecarAll)}}@endif</td>
                                      <td></td>
                                      <td class="bg-warning"><b>@if($SumHomecarAll != 0){{number_format($SumTopcar_HomecarAll / $SumHomecarAll)}}@else 0 @endif</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left"><b>รวม</b></td>
                                      <td><b>@if($SumMicroAll != 0 ){{number_format($SumTopcar_MicroAll / $SumMicroAll)}}@endif</b></td>
                                      <td><b>@if($SumPloanAll != 0 ){{number_format($SumTopcar_PloanAll / $SumPloanAll)}}@endif</b></td>
                                      <td><b>@if($SumLeasingAll != 0 ){{number_format($SumTopcar_LeasingAll / $SumLeasingAll)}}@endif</b></td>
                                      <td><b>@if($SumStaffAll != 0 ){{number_format($SumTopcar_StaffAll / $SumStaffAll)}}@endif</b></td>
                                      <td><b>@if($SumHomecarAll != 0 ){{number_format($SumTopcar_HomecarAll / $SumHomecarAll)}}@endif</b></td>
                                      <td><b>@if($SumMotorAll != 0 ){{number_format($SumTopcar_MotorAll / $SumMotorAll)}}@endif</b></td>
                                      <td style="background-color: red;color:white;"><b>@if($TotalAllProduct != 0 ){{number_format($TotalAllProduct2 / $TotalAllProduct)}}@endif</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-4" role="tabpanel" aria-labelledby="vert-tabs-4-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">แบบจัด(เช่าซื้อ)</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td width="90px">สาขา</td>
                                      <td>กส.ค้ำมีหลักทรัพย์</td>
                                      <td>กส.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>กส.ไม่ค้ำประกัน</td>
                                      <td>VIP กรรมสิทธิ์</td>
                                      <td>ซข.ค้ำมีหลักทรัพย์</td>
                                      <td>ซข.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>ซข.ไม่ค้ำประกัน</td>
                                      <td>VIP ซื้อขาย</td>
                                      <td>รวม</td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">ปัตตานี (01)</td>
                                      <td>{{($PN_HaveProperty != 0) ?$PN_HaveProperty: ''}}</td>
                                      <td>{{($PN_NoProperty != 0) ?$PN_NoProperty: ''}}</td>
                                      <td>{{($PN_NoWarranty != 0) ?$PN_NoWarranty: ''}}</td>
                                      <td>{{($PN_VIPowner != 0) ?$PN_VIPowner: ''}}</td>
                                      <td>{{($PN_BuyHaveProperty != 0) ?$PN_BuyHaveProperty: ''}}</td>
                                      <td>{{($PN_BuyNoHaveProperty != 0) ?$PN_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($PN_BuyNoWarranty != 0) ?$PN_BuyNoWarranty: ''}}</td>
                                      <td>{{($PN_VIPbuy != 0) ?$PN_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_PN}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">สายบุรี (05)</td>
                                      <td>{{($SB_HaveProperty != 0) ?$SB_HaveProperty: ''}}</td>
                                      <td>{{($SB_NoProperty != 0) ?$SB_NoProperty: ''}}</td>
                                      <td>{{($SB_NoWarranty != 0) ?$SB_NoWarranty: ''}}</td>
                                      <td>{{($SB_VIPowner != 0) ?$SB_VIPowner: ''}}</td>
                                      <td>{{($SB_BuyHaveProperty != 0) ?$SB_BuyHaveProperty: ''}}</td>
                                      <td>{{($SB_BuyNoHaveProperty != 0) ?$SB_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($SB_BuyNoWarranty != 0) ?$SB_BuyNoWarranty: ''}}</td>
                                      <td>{{($SB_VIPbuy != 0) ?$SB_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_SB}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">โคกโพธิ์ (08)</td>
                                      <td>{{($KP_HaveProperty != 0) ?$KP_HaveProperty: ''}}</td>
                                      <td>{{($KP_NoProperty != 0) ?$KP_NoProperty: ''}}</td>
                                      <td>{{($KP_NoWarranty != 0) ?$KP_NoWarranty: ''}}</td>
                                      <td>{{($KP_VIPowner != 0) ?$KP_VIPowner: ''}}</td>
                                      <td>{{($KP_BuyHaveProperty != 0) ?$KP_BuyHaveProperty: ''}}</td>
                                      <td>{{($KP_BuyNoHaveProperty != 0) ?$KP_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KP_BuyNoWarranty != 0) ?$KP_BuyNoWarranty: ''}}</td>
                                      <td>{{($KP_VIPbuy != 0) ?$KP_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KP}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะลา (03)</td>
                                      <td>{{($YL_HaveProperty != 0) ?$YL_HaveProperty: ''}}</td>
                                      <td>{{($YL_NoProperty != 0) ?$YL_NoProperty: ''}}</td>
                                      <td>{{($YL_NoWarranty != 0) ?$YL_NoWarranty: ''}}</td>
                                      <td>{{($YL_VIPowner != 0) ?$YL_VIPowner: ''}}</td>
                                      <td>{{($YL_BuyHaveProperty != 0) ?$YL_BuyHaveProperty: ''}}</td>
                                      <td>{{($YL_BuyNoHaveProperty != 0) ?$YL_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YL_BuyNoWarranty != 0) ?$YL_BuyNoWarranty: ''}}</td>
                                      <td>{{($YL_VIPbuy != 0) ?$YL_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YL}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">เบตง (07)</td>
                                      <td>{{($BT_HaveProperty != 0) ?$BT_HaveProperty: ''}}</td>
                                      <td>{{($BT_NoProperty != 0) ?$BT_NoProperty: ''}}</td>
                                      <td>{{($BT_NoWarranty != 0) ?$BT_NoWarranty: ''}}</td>
                                      <td>{{($BT_VIPowner != 0) ?$BT_VIPowner: ''}}</td>
                                      <td>{{($BT_BuyHaveProperty != 0) ?$BT_BuyHaveProperty: ''}}</td>
                                      <td>{{($BT_BuyNoHaveProperty != 0) ?$BT_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BT_BuyNoWarranty != 0) ?$BT_BuyNoWarranty: ''}}</td>
                                      <td>{{($BT_VIPbuy != 0) ?$BT_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BT}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">บันนังสตา (13)</td>
                                      <td>{{($BNT_HaveProperty != 0) ?$BNT_HaveProperty: ''}}</td>
                                      <td>{{($BNT_NoProperty != 0) ?$BNT_NoProperty: ''}}</td>
                                      <td>{{($BNT_NoWarranty != 0) ?$BNT_NoWarranty: ''}}</td>
                                      <td>{{($BNT_VIPowner != 0) ?$BNT_VIPowner: ''}}</td>
                                      <td>{{($BNT_BuyHaveProperty != 0) ?$BNT_BuyHaveProperty: ''}}</td>
                                      <td>{{($BNT_BuyNoHaveProperty != 0) ?$BNT_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BNT_BuyNoWarranty != 0) ?$BNT_BuyNoWarranty: ''}}</td>
                                      <td>{{($BNT_VIPbuy != 0) ?$BNT_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BNT}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะหา (14)</td>
                                      <td>{{($YH_HaveProperty != 0) ?$YH_HaveProperty: ''}}</td>
                                      <td>{{($YH_NoProperty != 0) ?$YH_NoProperty: ''}}</td>
                                      <td>{{($YH_NoWarranty != 0) ?$YH_NoWarranty: ''}}</td>
                                      <td>{{($YH_VIPowner != 0) ?$YH_VIPowner: ''}}</td>
                                      <td>{{($YH_BuyHaveProperty != 0) ?$YH_BuyHaveProperty: ''}}</td>
                                      <td>{{($YH_BuyNoHaveProperty != 0) ?$YH_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YH_BuyNoWarranty != 0) ?$YH_BuyNoWarranty: ''}}</td>
                                      <td>{{($YH_VIPbuy != 0) ?$YH_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YH}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">นราธิวาส (04)</td>
                                      <td>{{($NR_HaveProperty != 0) ?$NR_HaveProperty: ''}}</td>
                                      <td>{{($NR_NoProperty != 0) ?$NR_NoProperty: ''}}</td>
                                      <td>{{($NR_NoWarranty != 0) ?$NR_NoWarranty: ''}}</td>
                                      <td>{{($NR_VIPowner != 0) ?$NR_VIPowner: ''}}</td>
                                      <td>{{($NR_BuyHaveProperty != 0) ?$NR_BuyHaveProperty: ''}}</td>
                                      <td>{{($NR_BuyNoHaveProperty != 0) ?$NR_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($NR_BuyNoWarranty != 0) ?$NR_BuyNoWarranty: ''}}</td>
                                      <td>{{($NR_VIPbuy != 0) ?$NR_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_NR}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">โกลก (06)</td>
                                      <td>{{($KOL_HaveProperty != 0) ?$KOL_HaveProperty: ''}}</td>
                                      <td>{{($KOL_NoProperty != 0) ?$KOL_NoProperty: ''}}</td>
                                      <td>{{($KOL_NoWarranty != 0) ?$KOL_NoWarranty: ''}}</td>
                                      <td>{{($KOL_VIPowner != 0) ?$KOL_VIPowner: ''}}</td>
                                      <td>{{($KOL_BuyHaveProperty != 0) ?$KOL_BuyHaveProperty: ''}}</td>
                                      <td>{{($KOL_BuyNoHaveProperty != 0) ?$KOL_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KOL_BuyNoWarranty != 0) ?$KOL_BuyNoWarranty: ''}}</td>
                                      <td>{{($KOL_VIPbuy != 0) ?$KOL_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KOL}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">ตันหยงมัส (09)</td>
                                      <td>{{($TM_HaveProperty != 0) ?$TM_HaveProperty: ''}}</td>
                                      <td>{{($TM_NoProperty != 0) ?$TM_NoProperty: ''}}</td>
                                      <td>{{($TM_NoWarranty != 0) ?$TM_NoWarranty: ''}}</td>
                                      <td>{{($TM_VIPowner != 0) ?$TM_VIPowner: ''}}</td>
                                      <td>{{($TM_BuyHaveProperty != 0) ?$TM_BuyHaveProperty: ''}}</td>
                                      <td>{{($TM_BuyNoHaveProperty != 0) ?$TM_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($TM_BuyNoWarranty != 0) ?$TM_BuyNoWarranty: ''}}</td>
                                      <td>{{($TM_VIPbuy != 0) ?$TM_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_TM}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">รือเสาะ (12)</td>
                                      <td>{{($RS_HaveProperty != 0) ?$RS_HaveProperty: ''}}</td>
                                      <td>{{($RS_NoProperty != 0) ?$RS_NoProperty: ''}}</td>
                                      <td>{{($RS_NoWarranty != 0) ?$RS_NoWarranty: ''}}</td>
                                      <td>{{($RS_VIPowner != 0) ?$RS_VIPowner: ''}}</td>
                                      <td>{{($RS_BuyHaveProperty != 0) ?$RS_BuyHaveProperty: ''}}</td>
                                      <td>{{($RS_BuyNoHaveProperty != 0) ?$RS_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($RS_BuyNoWarranty != 0) ?$RS_BuyNoWarranty: ''}}</td>
                                      <td>{{($RS_VIPbuy != 0) ?$RS_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_RS}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">ยอดรวม</td>
                                      <td><b>{{($PN_HaveProperty + $SB_HaveProperty + $KP_HaveProperty + $YL_HaveProperty + $BT_HaveProperty + $BNT_HaveProperty + $YH_HaveProperty + $NR_HaveProperty + $KOL_HaveProperty + $TM_HaveProperty + $RS_HaveProperty)}}</b></td>
                                      <td><b>{{($PN_NoProperty + $SB_NoProperty + $KP_NoProperty + $YL_NoProperty + $BT_NoProperty + $BNT_NoProperty + $YH_NoProperty + $NR_NoProperty + $KOL_NoProperty + $TM_NoProperty + $RS_NoProperty)}}</b></td>
                                      <td><b>{{($PN_NoWarranty + $SB_NoWarranty + $KP_NoWarranty + $YL_NoWarranty + $BT_NoWarranty + $BNT_NoWarranty + $YH_NoWarranty + $NR_NoWarranty + $KOL_NoWarranty + $TM_NoWarranty + $RS_NoWarranty)}}</b></td>
                                      <td><b>{{($PN_VIPowner + $SB_VIPowner + $KP_VIPowner + $YL_VIPowner + $BT_VIPowner + $BNT_VIPowner + $YH_VIPowner + $NR_VIPowner + $KOL_VIPowner + $TM_VIPowner + $RS_VIPowner)}}</b></td>
                                      <td><b>{{($PN_BuyHaveProperty + $SB_BuyHaveProperty + $KP_BuyHaveProperty + $YL_BuyHaveProperty + $BT_BuyHaveProperty + $BNT_BuyHaveProperty + $YH_BuyHaveProperty + $NR_BuyHaveProperty + $KOL_BuyHaveProperty + $TM_BuyHaveProperty + $RS_BuyHaveProperty)}}</b></td>
                                      <td><b>{{($PN_BuyNoHaveProperty + $SB_BuyNoHaveProperty + $KP_BuyNoHaveProperty + $YL_BuyNoHaveProperty + $BT_BuyNoHaveProperty + $BNT_BuyNoHaveProperty + $YH_BuyNoHaveProperty + $NR_BuyNoHaveProperty + $KOL_BuyNoHaveProperty + $TM_BuyNoHaveProperty + $RS_BuyNoHaveProperty)}}</b></td>
                                      <td><b>{{($PN_BuyNoWarranty + $SB_BuyNoWarranty + $KP_BuyNoWarranty + $YL_BuyNoWarranty + $BT_BuyNoWarranty + $BNT_BuyNoWarranty + $YH_BuyNoWarranty + $NR_BuyNoWarranty + $KOL_BuyNoWarranty + $TM_BuyNoWarranty + $RS_BuyNoWarranty)}}</b></td>
                                      <td><b>{{($PN_VIPbuy + $SB_VIPbuy + $KP_VIPbuy + $YL_VIPbuy + $BT_VIPbuy + $BNT_VIPbuy + $YH_VIPbuy + $NR_VIPbuy + $KOL_VIPbuy + $TM_VIPbuy + $RS_VIPbuy)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{$Total_baabLeasing}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">% แบบ</td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_HaveProperty + $SB_HaveProperty + $KP_HaveProperty + $YL_HaveProperty + $BT_HaveProperty + $BNT_HaveProperty + $YH_HaveProperty + $NR_HaveProperty + $KOL_HaveProperty + $TM_HaveProperty + $RS_HaveProperty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_NoProperty + $SB_NoProperty + $KP_NoProperty + $YL_NoProperty + $BT_NoProperty + $BNT_NoProperty + $YH_NoProperty + $NR_NoProperty + $KOL_NoProperty + $TM_NoProperty + $RS_NoProperty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_NoWarranty + $SB_NoWarranty + $KP_NoWarranty + $YL_NoWarranty + $BT_NoWarranty + $BNT_NoWarranty + $YH_NoWarranty + $NR_NoWarranty + $KOL_NoWarranty + $TM_NoWarranty + $RS_NoWarranty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_VIPowner + $SB_VIPowner + $KP_VIPowner + $YL_VIPowner + $BT_VIPowner + $BNT_VIPowner + $YH_VIPowner + $NR_VIPowner + $KOL_VIPowner + $TM_VIPowner + $RS_VIPowner) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_BuyHaveProperty + $SB_BuyHaveProperty + $KP_BuyHaveProperty + $YL_BuyHaveProperty + $BT_BuyHaveProperty + $BNT_BuyHaveProperty + $YH_BuyHaveProperty + $NR_BuyHaveProperty + $KOL_BuyHaveProperty + $TM_BuyHaveProperty + $RS_BuyHaveProperty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_BuyNoHaveProperty + $SB_BuyNoHaveProperty + $KP_BuyNoHaveProperty + $YL_BuyNoHaveProperty + $BT_BuyNoHaveProperty + $BNT_BuyNoHaveProperty + $YH_BuyNoHaveProperty + $NR_BuyNoHaveProperty + $KOL_BuyNoHaveProperty + $TM_BuyNoHaveProperty + $RS_BuyNoHaveProperty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_BuyNoWarranty + $SB_BuyNoWarranty + $KP_BuyNoWarranty + $YL_BuyNoWarranty + $BT_BuyNoWarranty + $BNT_BuyNoWarranty + $YH_BuyNoWarranty + $NR_BuyNoWarranty + $KOL_BuyNoWarranty + $TM_BuyNoWarranty + $RS_BuyNoWarranty) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabLeasing != 0) {{round((($PN_VIPbuy + $SB_VIPbuy + $KP_VIPbuy + $YL_VIPbuy + $BT_VIPbuy + $BNT_VIPbuy + $YH_VIPbuy + $NR_VIPbuy + $KOL_VIPbuy + $TM_VIPbuy + $RS_VIPbuy) / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                      <td style="background-color: red;color:white;"><b>@if($Total_baabLeasing != 0) {{round(($Total_baabLeasing / $Total_baabLeasing) * 100)}} % @endif</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-5" role="tabpanel" aria-labelledby="vert-tabs-5-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">แบบจัด(Ploan)</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td width="90px">สาขา</td>
                                      <td>กส.ค้ำมีหลักทรัพย์</td>
                                      <td>กส.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>กส.ไม่ค้ำประกัน</td>
                                      <td>VIP กรรมสิทธิ์</td>
                                      <td>ซข.ค้ำมีหลักทรัพย์</td>
                                      <td>ซข.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>ซข.ไม่ค้ำประกัน</td>
                                      <td>VIP ซื้อขาย</td>
                                      <td>รวม</td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">ปัตตานี (01)</td>
                                      <td>{{($PN_Ploan_HaveProperty != 0) ?$PN_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($PN_Ploan_NoProperty != 0) ?$PN_Ploan_NoProperty: ''}}</td>
                                      <td>{{($PN_Ploan_NoWarranty != 0) ?$PN_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($PN_Ploan_VIPowner != 0) ?$PN_Ploan_VIPowner: ''}}</td>
                                      <td>{{($PN_Ploan_BuyHaveProperty != 0) ?$PN_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($PN_Ploan_BuyNoHaveProperty != 0) ?$PN_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($PN_Ploan_BuyNoWarranty != 0) ?$PN_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($PN_Ploan_VIPbuy != 0) ?$PN_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_PN_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">สายบุรี (05)</td>
                                      <td>{{($SB_Ploan_HaveProperty != 0) ?$SB_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($SB_Ploan_NoProperty != 0) ?$SB_Ploan_NoProperty: ''}}</td>
                                      <td>{{($SB_Ploan_NoWarranty != 0) ?$SB_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($SB_Ploan_VIPowner != 0) ?$SB_Ploan_VIPowner: ''}}</td>
                                      <td>{{($SB_Ploan_BuyHaveProperty != 0) ?$SB_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($SB_Ploan_BuyNoHaveProperty != 0) ?$SB_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($SB_Ploan_BuyNoWarranty != 0) ?$SB_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($SB_Ploan_VIPbuy != 0) ?$SB_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_SB_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">โคกโพธิ์ (08)</td>
                                      <td>{{($KP_Ploan_HaveProperty != 0) ?$KP_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($KP_Ploan_NoProperty != 0) ?$KP_Ploan_NoProperty: ''}}</td>
                                      <td>{{($KP_Ploan_NoWarranty != 0) ?$KP_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($KP_Ploan_VIPowner != 0) ?$KP_Ploan_VIPowner: ''}}</td>
                                      <td>{{($KP_Ploan_BuyHaveProperty != 0) ?$KP_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($KP_Ploan_BuyNoHaveProperty != 0) ?$KP_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KP_Ploan_BuyNoWarranty != 0) ?$KP_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($KP_Ploan_VIPbuy != 0) ?$KP_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KP_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะลา (03)</td>
                                      <td>{{($YL_Ploan_HaveProperty != 0) ?$YL_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($YL_Ploan_NoProperty != 0) ?$YL_Ploan_NoProperty: ''}}</td>
                                      <td>{{($YL_Ploan_NoWarranty != 0) ?$YL_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($YL_Ploan_VIPowner != 0) ?$YL_Ploan_VIPowner: ''}}</td>
                                      <td>{{($YL_Ploan_BuyHaveProperty != 0) ?$YL_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($YL_Ploan_BuyNoHaveProperty != 0) ?$YL_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YL_Ploan_BuyNoWarranty != 0) ?$YL_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($YL_Ploan_VIPbuy != 0) ?$YL_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YL_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">เบตง (07)</td>
                                      <td>{{($BT_Ploan_HaveProperty != 0) ?$BT_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($BT_Ploan_NoProperty != 0) ?$BT_Ploan_NoProperty: ''}}</td>
                                      <td>{{($BT_Ploan_NoWarranty != 0) ?$BT_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($BT_Ploan_VIPowner != 0) ?$BT_Ploan_VIPowner: ''}}</td>
                                      <td>{{($BT_Ploan_BuyHaveProperty != 0) ?$BT_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($BT_Ploan_BuyNoHaveProperty != 0) ?$BT_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BT_Ploan_BuyNoWarranty != 0) ?$BT_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($BT_Ploan_VIPbuy != 0) ?$BT_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BT_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">บันนังสตา (13)</td>
                                      <td>{{($BNT_Ploan_HaveProperty != 0) ?$BNT_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($BNT_Ploan_NoProperty != 0) ?$BNT_Ploan_NoProperty: ''}}</td>
                                      <td>{{($BNT_Ploan_NoWarranty != 0) ?$BNT_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($BNT_Ploan_VIPowner != 0) ?$BNT_Ploan_VIPowner: ''}}</td>
                                      <td>{{($BNT_Ploan_BuyHaveProperty != 0) ?$BNT_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($BNT_Ploan_BuyNoHaveProperty != 0) ?$BNT_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BNT_Ploan_BuyNoWarranty != 0) ?$BNT_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($BNT_Ploan_VIPbuy != 0) ?$BNT_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BNT_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะหา (14)</td>
                                      <td>{{($YH_Ploan_HaveProperty != 0) ?$YH_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($YH_Ploan_NoProperty != 0) ?$YH_Ploan_NoProperty: ''}}</td>
                                      <td>{{($YH_Ploan_NoWarranty != 0) ?$YH_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($YH_Ploan_VIPowner != 0) ?$YH_Ploan_VIPowner: ''}}</td>
                                      <td>{{($YH_Ploan_BuyHaveProperty != 0) ?$YH_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($YH_Ploan_BuyNoHaveProperty != 0) ?$YH_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YH_Ploan_BuyNoWarranty != 0) ?$YH_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($YH_Ploan_VIPbuy != 0) ?$YH_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YH_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">นราธิวาส (04)</td>
                                      <td>{{($NR_Ploan_HaveProperty != 0) ?$NR_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($NR_Ploan_NoProperty != 0) ?$NR_Ploan_NoProperty: ''}}</td>
                                      <td>{{($NR_Ploan_NoWarranty != 0) ?$NR_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($NR_Ploan_VIPowner != 0) ?$NR_Ploan_VIPowner: ''}}</td>
                                      <td>{{($NR_Ploan_BuyHaveProperty != 0) ?$NR_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($NR_Ploan_BuyNoHaveProperty != 0) ?$NR_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($NR_Ploan_BuyNoWarranty != 0) ?$NR_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($NR_Ploan_VIPbuy != 0) ?$NR_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_NR_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">โกลก (06)</td>
                                      <td>{{($KOL_Ploan_HaveProperty != 0) ?$KOL_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($KOL_Ploan_NoProperty != 0) ?$KOL_Ploan_NoProperty: ''}}</td>
                                      <td>{{($KOL_Ploan_NoWarranty != 0) ?$KOL_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($KOL_Ploan_VIPowner != 0) ?$KOL_Ploan_VIPowner: ''}}</td>
                                      <td>{{($KOL_Ploan_BuyHaveProperty != 0) ?$KOL_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($KOL_Ploan_BuyNoHaveProperty != 0) ?$KOL_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KOL_Ploan_BuyNoWarranty != 0) ?$KOL_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($KOL_Ploan_VIPbuy != 0) ?$KOL_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KOL_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">ตันหยงมัส (09)</td>
                                      <td>{{($TM_Ploan_HaveProperty != 0) ?$TM_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($TM_Ploan_NoProperty != 0) ?$TM_Ploan_NoProperty: ''}}</td>
                                      <td>{{($TM_Ploan_NoWarranty != 0) ?$TM_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($TM_Ploan_VIPowner != 0) ?$TM_Ploan_VIPowner: ''}}</td>
                                      <td>{{($TM_Ploan_BuyHaveProperty != 0) ?$TM_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($TM_Ploan_BuyNoHaveProperty != 0) ?$TM_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($TM_Ploan_BuyNoWarranty != 0) ?$TM_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($TM_Ploan_VIPbuy != 0) ?$TM_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_TM_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">รือเสาะ (12)</td>
                                      <td>{{($RS_Ploan_HaveProperty != 0) ?$RS_Ploan_HaveProperty: ''}}</td>
                                      <td>{{($RS_Ploan_NoProperty != 0) ?$RS_Ploan_NoProperty: ''}}</td>
                                      <td>{{($RS_Ploan_NoWarranty != 0) ?$RS_Ploan_NoWarranty: ''}}</td>
                                      <td>{{($RS_Ploan_VIPowner != 0) ?$RS_Ploan_VIPowner: ''}}</td>
                                      <td>{{($RS_Ploan_BuyHaveProperty != 0) ?$RS_Ploan_BuyHaveProperty: ''}}</td>
                                      <td>{{($RS_Ploan_BuyNoHaveProperty != 0) ?$RS_Ploan_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($RS_Ploan_BuyNoWarranty != 0) ?$RS_Ploan_BuyNoWarranty: ''}}</td>
                                      <td>{{($RS_Ploan_VIPbuy != 0) ?$RS_Ploan_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_RS_Ploan}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">ยอดรวม</td>
                                      <td><b>{{($PN_Ploan_HaveProperty + $SB_Ploan_HaveProperty + $KP_Ploan_HaveProperty + $YL_Ploan_HaveProperty + $BT_Ploan_HaveProperty + $BNT_Ploan_HaveProperty + $YH_Ploan_HaveProperty + $NR_Ploan_HaveProperty + $KOL_Ploan_HaveProperty + $TM_Ploan_HaveProperty + $RS_Ploan_HaveProperty)}}</b></td>
                                      <td><b>{{($PN_Ploan_NoProperty + $SB_Ploan_NoProperty + $KP_Ploan_NoProperty + $YL_Ploan_NoProperty + $BT_Ploan_NoProperty + $BNT_Ploan_NoProperty + $YH_Ploan_NoProperty + $NR_Ploan_NoProperty + $KOL_Ploan_NoProperty + $TM_Ploan_NoProperty + $RS_Ploan_NoProperty)}}</b></td>
                                      <td><b>{{($PN_Ploan_NoWarranty + $SB_Ploan_NoWarranty + $KP_Ploan_NoWarranty + $YL_Ploan_NoWarranty + $BT_Ploan_NoWarranty + $BNT_Ploan_NoWarranty + $YH_Ploan_NoWarranty + $NR_Ploan_NoWarranty + $KOL_Ploan_NoWarranty + $TM_Ploan_NoWarranty + $RS_Ploan_NoWarranty)}}</b></td>
                                      <td><b>{{($PN_Ploan_VIPowner + $SB_Ploan_VIPowner + $KP_Ploan_VIPowner + $YL_Ploan_VIPowner + $BT_Ploan_VIPowner + $BNT_Ploan_VIPowner + $YH_Ploan_VIPowner + $NR_Ploan_VIPowner + $KOL_Ploan_VIPowner + $TM_Ploan_VIPowner + $RS_Ploan_VIPowner)}}</b></td>
                                      <td><b>{{($PN_Ploan_BuyHaveProperty + $SB_Ploan_BuyHaveProperty + $KP_Ploan_BuyHaveProperty + $YL_Ploan_BuyHaveProperty + $BT_Ploan_BuyHaveProperty + $BNT_Ploan_BuyHaveProperty + $YH_Ploan_BuyHaveProperty + $NR_Ploan_BuyHaveProperty + $KOL_Ploan_BuyHaveProperty + $TM_Ploan_BuyHaveProperty + $RS_Ploan_BuyHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Ploan_BuyNoHaveProperty + $SB_Ploan_BuyNoHaveProperty + $KP_Ploan_BuyNoHaveProperty + $YL_Ploan_BuyNoHaveProperty + $BT_Ploan_BuyNoHaveProperty + $BNT_Ploan_BuyNoHaveProperty + $YH_Ploan_BuyNoHaveProperty + $NR_Ploan_BuyNoHaveProperty + $KOL_Ploan_BuyNoHaveProperty + $TM_Ploan_BuyNoHaveProperty + $RS_Ploan_BuyNoHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Ploan_BuyNoWarranty + $SB_Ploan_BuyNoWarranty + $KP_Ploan_BuyNoWarranty + $YL_Ploan_BuyNoWarranty + $BT_Ploan_BuyNoWarranty + $BNT_Ploan_BuyNoWarranty + $YH_Ploan_BuyNoWarranty + $NR_Ploan_BuyNoWarranty + $KOL_Ploan_BuyNoWarranty + $TM_Ploan_BuyNoWarranty + $RS_Ploan_BuyNoWarranty)}}</b></td>
                                      <td><b>{{($PN_Ploan_VIPbuy + $SB_Ploan_VIPbuy + $KP_Ploan_VIPbuy + $YL_Ploan_VIPbuy + $BT_Ploan_VIPbuy + $BNT_Ploan_VIPbuy + $YH_Ploan_VIPbuy + $NR_Ploan_VIPbuy + $KOL_Ploan_VIPbuy + $TM_Ploan_VIPbuy + $RS_Ploan_VIPbuy)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{$Total_baabPloan}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">% แบบ</td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_HaveProperty + $SB_Ploan_HaveProperty + $KP_Ploan_HaveProperty + $YL_Ploan_HaveProperty + $BT_Ploan_HaveProperty + $BNT_Ploan_HaveProperty + $YH_Ploan_HaveProperty + $NR_Ploan_HaveProperty + $KOL_Ploan_HaveProperty + $TM_Ploan_HaveProperty + $RS_Ploan_HaveProperty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_NoProperty + $SB_Ploan_NoProperty + $KP_Ploan_NoProperty + $YL_Ploan_NoProperty + $BT_Ploan_NoProperty + $BNT_Ploan_NoProperty + $YH_Ploan_NoProperty + $NR_Ploan_NoProperty + $KOL_Ploan_NoProperty + $TM_Ploan_NoProperty + $RS_Ploan_NoProperty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_NoWarranty + $SB_Ploan_NoWarranty + $KP_Ploan_NoWarranty + $YL_Ploan_NoWarranty + $BT_Ploan_NoWarranty + $BNT_Ploan_NoWarranty + $YH_Ploan_NoWarranty + $NR_Ploan_NoWarranty + $KOL_Ploan_NoWarranty + $TM_Ploan_NoWarranty + $RS_Ploan_NoWarranty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_VIPowner + $SB_Ploan_VIPowner + $KP_Ploan_VIPowner + $YL_Ploan_VIPowner + $BT_Ploan_VIPowner + $BNT_Ploan_VIPowner + $YH_Ploan_VIPowner + $NR_Ploan_VIPowner + $KOL_Ploan_VIPowner + $TM_Ploan_VIPowner + $RS_Ploan_VIPowner) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_BuyHaveProperty + $SB_Ploan_BuyHaveProperty + $KP_Ploan_BuyHaveProperty + $YL_Ploan_BuyHaveProperty + $BT_Ploan_BuyHaveProperty + $BNT_Ploan_BuyHaveProperty + $YH_Ploan_BuyHaveProperty + $NR_Ploan_BuyHaveProperty + $KOL_Ploan_BuyHaveProperty + $TM_Ploan_BuyHaveProperty + $RS_Ploan_BuyHaveProperty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_BuyNoHaveProperty + $SB_Ploan_BuyNoHaveProperty + $KP_Ploan_BuyNoHaveProperty + $YL_Ploan_BuyNoHaveProperty + $BT_Ploan_BuyNoHaveProperty + $BNT_Ploan_BuyNoHaveProperty + $YH_Ploan_BuyNoHaveProperty + $NR_Ploan_BuyNoHaveProperty + $KOL_Ploan_BuyNoHaveProperty + $TM_Ploan_BuyNoHaveProperty + $RS_Ploan_BuyNoHaveProperty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_BuyNoWarranty + $SB_Ploan_BuyNoWarranty + $KP_Ploan_BuyNoWarranty + $YL_Ploan_BuyNoWarranty + $BT_Ploan_BuyNoWarranty + $BNT_Ploan_BuyNoWarranty + $YH_Ploan_BuyNoWarranty + $NR_Ploan_BuyNoWarranty + $KOL_Ploan_BuyNoWarranty + $TM_Ploan_BuyNoWarranty + $RS_Ploan_BuyNoWarranty) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabPloan != 0) {{round((($PN_Ploan_VIPbuy + $SB_Ploan_VIPbuy + $KP_Ploan_VIPbuy + $YL_Ploan_VIPbuy + $BT_Ploan_VIPbuy + $BNT_Ploan_VIPbuy + $YH_Ploan_VIPbuy + $NR_Ploan_VIPbuy + $KOL_Ploan_VIPbuy + $TM_Ploan_VIPbuy + $RS_Ploan_VIPbuy) / $Total_baabPloan) * 100)}} % @endif</b></td>
                                      <td style="background-color: red;color:white;"><b>@if($Total_baabPloan != 0) {{round(($Total_baabPloan / $Total_baabPloan) * 100)}} % @endif</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-6" role="tabpanel" aria-labelledby="vert-tabs-6-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">แบบจัด(Micro)</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td width="90px">สาขา</td>
                                      <td>กส.ค้ำมีหลักทรัพย์</td>
                                      <td>กส.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>กส.ไม่ค้ำประกัน</td>
                                      <td>VIP กรรมสิทธิ์</td>
                                      <td>ซข.ค้ำมีหลักทรัพย์</td>
                                      <td>ซข.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>ซข.ไม่ค้ำประกัน</td>
                                      <td>VIP ซื้อขาย</td>
                                      <td>รวม</td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">ปัตตานี (01)</td>
                                      <td>{{($PN_Micro_HaveProperty != 0) ?$PN_Micro_HaveProperty: ''}}</td>
                                      <td>{{($PN_Micro_NoProperty != 0) ?$PN_Micro_NoProperty: ''}}</td>
                                      <td>{{($PN_Micro_NoWarranty != 0) ?$PN_Micro_NoWarranty: ''}}</td>
                                      <td>{{($PN_Micro_VIPowner != 0) ?$PN_Micro_VIPowner: ''}}</td>
                                      <td>{{($PN_Micro_BuyHaveProperty != 0) ?$PN_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($PN_Micro_BuyNoHaveProperty != 0) ?$PN_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($PN_Micro_BuyNoWarranty != 0) ?$PN_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($PN_Micro_VIPbuy != 0) ?$PN_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_PN_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">สายบุรี (05)</td>
                                      <td>{{($SB_Micro_HaveProperty != 0) ?$SB_Micro_HaveProperty: ''}}</td>
                                      <td>{{($SB_Micro_NoProperty != 0) ?$SB_Micro_NoProperty: ''}}</td>
                                      <td>{{($SB_Micro_NoWarranty != 0) ?$SB_Micro_NoWarranty: ''}}</td>
                                      <td>{{($SB_Micro_VIPowner != 0) ?$SB_Micro_VIPowner: ''}}</td>
                                      <td>{{($SB_Micro_BuyHaveProperty != 0) ?$SB_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($SB_Micro_BuyNoHaveProperty != 0) ?$SB_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($SB_Micro_BuyNoWarranty != 0) ?$SB_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($SB_Micro_VIPbuy != 0) ?$SB_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_SB_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">โคกโพธิ์ (08)</td>
                                      <td>{{($KP_Micro_HaveProperty != 0) ?$KP_Micro_HaveProperty: ''}}</td>
                                      <td>{{($KP_Micro_NoProperty != 0) ?$KP_Micro_NoProperty: ''}}</td>
                                      <td>{{($KP_Micro_NoWarranty != 0) ?$KP_Micro_NoWarranty: ''}}</td>
                                      <td>{{($KP_Micro_VIPowner != 0) ?$KP_Micro_VIPowner: ''}}</td>
                                      <td>{{($KP_Micro_BuyHaveProperty != 0) ?$KP_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($KP_Micro_BuyNoHaveProperty != 0) ?$KP_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KP_Micro_BuyNoWarranty != 0) ?$KP_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($KP_Micro_VIPbuy != 0) ?$KP_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KP_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะลา (03)</td>
                                      <td>{{($YL_Micro_HaveProperty != 0) ?$YL_Micro_HaveProperty: ''}}</td>
                                      <td>{{($YL_Micro_NoProperty != 0) ?$YL_Micro_NoProperty: ''}}</td>
                                      <td>{{($YL_Micro_NoWarranty != 0) ?$YL_Micro_NoWarranty: ''}}</td>
                                      <td>{{($YL_Micro_VIPowner != 0) ?$YL_Micro_VIPowner: ''}}</td>
                                      <td>{{($YL_Micro_BuyHaveProperty != 0) ?$YL_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($YL_Micro_BuyNoHaveProperty != 0) ?$YL_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YL_Micro_BuyNoWarranty != 0) ?$YL_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($YL_Micro_VIPbuy != 0) ?$YL_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YL_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">เบตง (07)</td>
                                      <td>{{($BT_Micro_HaveProperty != 0) ?$BT_Micro_HaveProperty: ''}}</td>
                                      <td>{{($BT_Micro_NoProperty != 0) ?$BT_Micro_NoProperty: ''}}</td>
                                      <td>{{($BT_Micro_NoWarranty != 0) ?$BT_Micro_NoWarranty: ''}}</td>
                                      <td>{{($BT_Micro_VIPowner != 0) ?$BT_Micro_VIPowner: ''}}</td>
                                      <td>{{($BT_Micro_BuyHaveProperty != 0) ?$BT_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($BT_Micro_BuyNoHaveProperty != 0) ?$BT_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BT_Micro_BuyNoWarranty != 0) ?$BT_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($BT_Micro_VIPbuy != 0) ?$BT_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BT_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">บันนังสตา (13)</td>
                                      <td>{{($BNT_Micro_HaveProperty != 0) ?$BNT_Micro_HaveProperty: ''}}</td>
                                      <td>{{($BNT_Micro_NoProperty != 0) ?$BNT_Micro_NoProperty: ''}}</td>
                                      <td>{{($BNT_Micro_NoWarranty != 0) ?$BNT_Micro_NoWarranty: ''}}</td>
                                      <td>{{($BNT_Micro_VIPowner != 0) ?$BNT_Micro_VIPowner: ''}}</td>
                                      <td>{{($BNT_Micro_BuyHaveProperty != 0) ?$BNT_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($BNT_Micro_BuyNoHaveProperty != 0) ?$BNT_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BNT_Micro_BuyNoWarranty != 0) ?$BNT_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($BNT_Micro_VIPbuy != 0) ?$BNT_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BNT_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะหา (14)</td>
                                      <td>{{($YH_Micro_HaveProperty != 0) ?$YH_Micro_HaveProperty: ''}}</td>
                                      <td>{{($YH_Micro_NoProperty != 0) ?$YH_Micro_NoProperty: ''}}</td>
                                      <td>{{($YH_Micro_NoWarranty != 0) ?$YH_Micro_NoWarranty: ''}}</td>
                                      <td>{{($YH_Micro_VIPowner != 0) ?$YH_Micro_VIPowner: ''}}</td>
                                      <td>{{($YH_Micro_BuyHaveProperty != 0) ?$YH_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($YH_Micro_BuyNoHaveProperty != 0) ?$YH_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YH_Micro_BuyNoWarranty != 0) ?$YH_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($YH_Micro_VIPbuy != 0) ?$YH_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YH_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">นราธิวาส (04)</td>
                                      <td>{{($NR_Micro_HaveProperty != 0) ?$NR_Micro_HaveProperty: ''}}</td>
                                      <td>{{($NR_Micro_NoProperty != 0) ?$NR_Micro_NoProperty: ''}}</td>
                                      <td>{{($NR_Micro_NoWarranty != 0) ?$NR_Micro_NoWarranty: ''}}</td>
                                      <td>{{($NR_Micro_VIPowner != 0) ?$NR_Micro_VIPowner: ''}}</td>
                                      <td>{{($NR_Micro_BuyHaveProperty != 0) ?$NR_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($NR_Micro_BuyNoHaveProperty != 0) ?$NR_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($NR_Micro_BuyNoWarranty != 0) ?$NR_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($NR_Micro_VIPbuy != 0) ?$NR_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_NR_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">โกลก (06)</td>
                                      <td>{{($KOL_Micro_HaveProperty != 0) ?$KOL_Micro_HaveProperty: ''}}</td>
                                      <td>{{($KOL_Micro_NoProperty != 0) ?$KOL_Micro_NoProperty: ''}}</td>
                                      <td>{{($KOL_Micro_NoWarranty != 0) ?$KOL_Micro_NoWarranty: ''}}</td>
                                      <td>{{($KOL_Micro_VIPowner != 0) ?$KOL_Micro_VIPowner: ''}}</td>
                                      <td>{{($KOL_Micro_BuyHaveProperty != 0) ?$KOL_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($KOL_Micro_BuyNoHaveProperty != 0) ?$KOL_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KOL_Micro_BuyNoWarranty != 0) ?$KOL_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($KOL_Micro_VIPbuy != 0) ?$KOL_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KOL_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">ตันหยงมัส (09)</td>
                                      <td>{{($TM_Micro_HaveProperty != 0) ?$TM_Micro_HaveProperty: ''}}</td>
                                      <td>{{($TM_Micro_NoProperty != 0) ?$TM_Micro_NoProperty: ''}}</td>
                                      <td>{{($TM_Micro_NoWarranty != 0) ?$TM_Micro_NoWarranty: ''}}</td>
                                      <td>{{($TM_Micro_VIPowner != 0) ?$TM_Micro_VIPowner: ''}}</td>
                                      <td>{{($TM_Micro_BuyHaveProperty != 0) ?$TM_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($TM_Micro_BuyNoHaveProperty != 0) ?$TM_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($TM_Micro_BuyNoWarranty != 0) ?$TM_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($TM_Micro_VIPbuy != 0) ?$TM_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_TM_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">รือเสาะ (12)</td>
                                      <td>{{($RS_Micro_HaveProperty != 0) ?$RS_Micro_HaveProperty: ''}}</td>
                                      <td>{{($RS_Micro_NoProperty != 0) ?$RS_Micro_NoProperty: ''}}</td>
                                      <td>{{($RS_Micro_NoWarranty != 0) ?$RS_Micro_NoWarranty: ''}}</td>
                                      <td>{{($RS_Micro_VIPowner != 0) ?$RS_Micro_VIPowner: ''}}</td>
                                      <td>{{($RS_Micro_BuyHaveProperty != 0) ?$RS_Micro_BuyHaveProperty: ''}}</td>
                                      <td>{{($RS_Micro_BuyNoHaveProperty != 0) ?$RS_Micro_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($RS_Micro_BuyNoWarranty != 0) ?$RS_Micro_BuyNoWarranty: ''}}</td>
                                      <td>{{($RS_Micro_VIPbuy != 0) ?$RS_Micro_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_RS_Micro}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">ยอดรวม</td>
                                      <td><b>{{($PN_Micro_HaveProperty + $SB_Micro_HaveProperty + $KP_Micro_HaveProperty + $YL_Micro_HaveProperty + $BT_Micro_HaveProperty + $BNT_Micro_HaveProperty + $YH_Micro_HaveProperty + $NR_Micro_HaveProperty + $KOL_Micro_HaveProperty + $TM_Micro_HaveProperty + $RS_Micro_HaveProperty)}}</b></td>
                                      <td><b>{{($PN_Micro_NoProperty + $SB_Micro_NoProperty + $KP_Micro_NoProperty + $YL_Micro_NoProperty + $BT_Micro_NoProperty + $BNT_Micro_NoProperty + $YH_Micro_NoProperty + $NR_Micro_NoProperty + $KOL_Micro_NoProperty + $TM_Micro_NoProperty + $RS_Micro_NoProperty)}}</b></td>
                                      <td><b>{{($PN_Micro_NoWarranty + $SB_Micro_NoWarranty + $KP_Micro_NoWarranty + $YL_Micro_NoWarranty + $BT_Micro_NoWarranty + $BNT_Micro_NoWarranty + $YH_Micro_NoWarranty + $NR_Micro_NoWarranty + $KOL_Micro_NoWarranty + $TM_Micro_NoWarranty + $RS_Micro_NoWarranty)}}</b></td>
                                      <td><b>{{($PN_Micro_VIPowner + $SB_Micro_VIPowner + $KP_Micro_VIPowner + $YL_Micro_VIPowner + $BT_Micro_VIPowner + $BNT_Micro_VIPowner + $YH_Micro_VIPowner + $NR_Micro_VIPowner + $KOL_Micro_VIPowner + $TM_Micro_VIPowner + $RS_Micro_VIPowner)}}</b></td>
                                      <td><b>{{($PN_Micro_BuyHaveProperty + $SB_Micro_BuyHaveProperty + $KP_Micro_BuyHaveProperty + $YL_Micro_BuyHaveProperty + $BT_Micro_BuyHaveProperty + $BNT_Micro_BuyHaveProperty + $YH_Micro_BuyHaveProperty + $NR_Micro_BuyHaveProperty + $KOL_Micro_BuyHaveProperty + $TM_Micro_BuyHaveProperty + $RS_Micro_BuyHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Micro_BuyNoHaveProperty + $SB_Micro_BuyNoHaveProperty + $KP_Micro_BuyNoHaveProperty + $YL_Micro_BuyNoHaveProperty + $BT_Micro_BuyNoHaveProperty + $BNT_Micro_BuyNoHaveProperty + $YH_Micro_BuyNoHaveProperty + $NR_Micro_BuyNoHaveProperty + $KOL_Micro_BuyNoHaveProperty + $TM_Micro_BuyNoHaveProperty + $RS_Micro_BuyNoHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Micro_BuyNoWarranty + $SB_Micro_BuyNoWarranty + $KP_Micro_BuyNoWarranty + $YL_Micro_BuyNoWarranty + $BT_Micro_BuyNoWarranty + $BNT_Micro_BuyNoWarranty + $YH_Micro_BuyNoWarranty + $NR_Micro_BuyNoWarranty + $KOL_Micro_BuyNoWarranty + $TM_Micro_BuyNoWarranty + $RS_Micro_BuyNoWarranty)}}</b></td>
                                      <td><b>{{($PN_Micro_VIPbuy + $SB_Micro_VIPbuy + $KP_Micro_VIPbuy + $YL_Micro_VIPbuy + $BT_Micro_VIPbuy + $BNT_Micro_VIPbuy + $YH_Micro_VIPbuy + $NR_Micro_VIPbuy + $KOL_Micro_VIPbuy + $TM_Micro_VIPbuy + $RS_Micro_VIPbuy)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{$Total_baabMicro}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">% แบบ</td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_HaveProperty + $SB_Micro_HaveProperty + $KP_Micro_HaveProperty + $YL_Micro_HaveProperty + $BT_Micro_HaveProperty + $BNT_Micro_HaveProperty + $YH_Micro_HaveProperty + $NR_Micro_HaveProperty + $KOL_Micro_HaveProperty + $TM_Micro_HaveProperty + $RS_Micro_HaveProperty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_NoProperty + $SB_Micro_NoProperty + $KP_Micro_NoProperty + $YL_Micro_NoProperty + $BT_Micro_NoProperty + $BNT_Micro_NoProperty + $YH_Micro_NoProperty + $NR_Micro_NoProperty + $KOL_Micro_NoProperty + $TM_Micro_NoProperty + $RS_Micro_NoProperty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_NoWarranty + $SB_Micro_NoWarranty + $KP_Micro_NoWarranty + $YL_Micro_NoWarranty + $BT_Micro_NoWarranty + $BNT_Micro_NoWarranty + $YH_Micro_NoWarranty + $NR_Micro_NoWarranty + $KOL_Micro_NoWarranty + $TM_Micro_NoWarranty + $RS_Micro_NoWarranty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_VIPowner + $SB_Micro_VIPowner + $KP_Micro_VIPowner + $YL_Micro_VIPowner + $BT_Micro_VIPowner + $BNT_Micro_VIPowner + $YH_Micro_VIPowner + $NR_Micro_VIPowner + $KOL_Micro_VIPowner + $TM_Micro_VIPowner + $RS_Micro_VIPowner) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_BuyHaveProperty + $SB_Micro_BuyHaveProperty + $KP_Micro_BuyHaveProperty + $YL_Micro_BuyHaveProperty + $BT_Micro_BuyHaveProperty + $BNT_Micro_BuyHaveProperty + $YH_Micro_BuyHaveProperty + $NR_Micro_BuyHaveProperty + $KOL_Micro_BuyHaveProperty + $TM_Micro_BuyHaveProperty + $RS_Micro_BuyHaveProperty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_BuyNoHaveProperty + $SB_Micro_BuyNoHaveProperty + $KP_Micro_BuyNoHaveProperty + $YL_Micro_BuyNoHaveProperty + $BT_Micro_BuyNoHaveProperty + $BNT_Micro_BuyNoHaveProperty + $YH_Micro_BuyNoHaveProperty + $NR_Micro_BuyNoHaveProperty + $KOL_Micro_BuyNoHaveProperty + $TM_Micro_BuyNoHaveProperty + $RS_Micro_BuyNoHaveProperty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_BuyNoWarranty + $SB_Micro_BuyNoWarranty + $KP_Micro_BuyNoWarranty + $YL_Micro_BuyNoWarranty + $BT_Micro_BuyNoWarranty + $BNT_Micro_BuyNoWarranty + $YH_Micro_BuyNoWarranty + $NR_Micro_BuyNoWarranty + $KOL_Micro_BuyNoWarranty + $TM_Micro_BuyNoWarranty + $RS_Micro_BuyNoWarranty) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMicro != 0) {{round((($PN_Micro_VIPbuy + $SB_Micro_VIPbuy + $KP_Micro_VIPbuy + $YL_Micro_VIPbuy + $BT_Micro_VIPbuy + $BNT_Micro_VIPbuy + $YH_Micro_VIPbuy + $NR_Micro_VIPbuy + $KOL_Micro_VIPbuy + $TM_Micro_VIPbuy + $RS_Micro_VIPbuy) / $Total_baabMicro) * 100)}} % @endif</b></td>
                                      <td style="background-color: red;color:white;"><b>@if($Total_baabMicro != 0) {{round(($Total_baabMicro / $Total_baabMicro) * 100)}} % @endif</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-7" role="tabpanel" aria-labelledby="vert-tabs-7-tab">
                              <div class="card-header">
                                <h3 class="card-title pr-2">แบบจัด(มอไซค์)</h3> ( วันที่ {{DateThai($newfdate)}} - {{DateThai($newtdate)}} )
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" style="border-radius: 10px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td width="90px">สาขา</td>
                                      <td>กส.ค้ำมีหลักทรัพย์</td>
                                      <td>กส.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>กส.ไม่ค้ำประกัน</td>
                                      <td>VIP กรรมสิทธิ์</td>
                                      <td>ซข.ค้ำมีหลักทรัพย์</td>
                                      <td>ซข.ค้ำไม่มีหลักทรัพย์</td>
                                      <td>ซข.ไม่ค้ำประกัน</td>
                                      <td>VIP ซื้อขาย</td>
                                      <td>รวม</td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">ปัตตานี (01)</td>
                                      <td>{{($PN_Motor_HaveProperty != 0) ?$PN_Motor_HaveProperty: ''}}</td>
                                      <td>{{($PN_Motor_NoProperty != 0) ?$PN_Motor_NoProperty: ''}}</td>
                                      <td>{{($PN_Motor_NoWarranty != 0) ?$PN_Motor_NoWarranty: ''}}</td>
                                      <td>{{($PN_Motor_VIPowner != 0) ?$PN_Motor_VIPowner: ''}}</td>
                                      <td>{{($PN_Motor_BuyHaveProperty != 0) ?$PN_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($PN_Motor_BuyNoHaveProperty != 0) ?$PN_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($PN_Motor_BuyNoWarranty != 0) ?$PN_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($PN_Motor_VIPbuy != 0) ?$PN_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_PN_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">สายบุรี (05)</td>
                                      <td>{{($SB_Motor_HaveProperty != 0) ?$SB_Motor_HaveProperty: ''}}</td>
                                      <td>{{($SB_Motor_NoProperty != 0) ?$SB_Motor_NoProperty: ''}}</td>
                                      <td>{{($SB_Motor_NoWarranty != 0) ?$SB_Motor_NoWarranty: ''}}</td>
                                      <td>{{($SB_Motor_VIPowner != 0) ?$SB_Motor_VIPowner: ''}}</td>
                                      <td>{{($SB_Motor_BuyHaveProperty != 0) ?$SB_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($SB_Motor_BuyNoHaveProperty != 0) ?$SB_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($SB_Motor_BuyNoWarranty != 0) ?$SB_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($SB_Motor_VIPbuy != 0) ?$SB_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_SB_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#FBFCA1;">
                                      <td class="text-left">โคกโพธิ์ (08)</td>
                                      <td>{{($KP_Motor_HaveProperty != 0) ?$KP_Motor_HaveProperty: ''}}</td>
                                      <td>{{($KP_Motor_NoProperty != 0) ?$KP_Motor_NoProperty: ''}}</td>
                                      <td>{{($KP_Motor_NoWarranty != 0) ?$KP_Motor_NoWarranty: ''}}</td>
                                      <td>{{($KP_Motor_VIPowner != 0) ?$KP_Motor_VIPowner: ''}}</td>
                                      <td>{{($KP_Motor_BuyHaveProperty != 0) ?$KP_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($KP_Motor_BuyNoHaveProperty != 0) ?$KP_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KP_Motor_BuyNoWarranty != 0) ?$KP_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($KP_Motor_VIPbuy != 0) ?$KP_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KP_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะลา (03)</td>
                                      <td>{{($YL_Motor_HaveProperty != 0) ?$YL_Motor_HaveProperty: ''}}</td>
                                      <td>{{($YL_Motor_NoProperty != 0) ?$YL_Motor_NoProperty: ''}}</td>
                                      <td>{{($YL_Motor_NoWarranty != 0) ?$YL_Motor_NoWarranty: ''}}</td>
                                      <td>{{($YL_Motor_VIPowner != 0) ?$YL_Motor_VIPowner: ''}}</td>
                                      <td>{{($YL_Motor_BuyHaveProperty != 0) ?$YL_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($YL_Motor_BuyNoHaveProperty != 0) ?$YL_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YL_Motor_BuyNoWarranty != 0) ?$YL_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($YL_Motor_VIPbuy != 0) ?$YL_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YL_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">เบตง (07)</td>
                                      <td>{{($BT_Motor_HaveProperty != 0) ?$BT_Motor_HaveProperty: ''}}</td>
                                      <td>{{($BT_Motor_NoProperty != 0) ?$BT_Motor_NoProperty: ''}}</td>
                                      <td>{{($BT_Motor_NoWarranty != 0) ?$BT_Motor_NoWarranty: ''}}</td>
                                      <td>{{($BT_Motor_VIPowner != 0) ?$BT_Motor_VIPowner: ''}}</td>
                                      <td>{{($BT_Motor_BuyHaveProperty != 0) ?$BT_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($BT_Motor_BuyNoHaveProperty != 0) ?$BT_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BT_Motor_BuyNoWarranty != 0) ?$BT_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($BT_Motor_VIPbuy != 0) ?$BT_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BT_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">บันนังสตา (13)</td>
                                      <td>{{($BNT_Motor_HaveProperty != 0) ?$BNT_Motor_HaveProperty: ''}}</td>
                                      <td>{{($BNT_Motor_NoProperty != 0) ?$BNT_Motor_NoProperty: ''}}</td>
                                      <td>{{($BNT_Motor_NoWarranty != 0) ?$BNT_Motor_NoWarranty: ''}}</td>
                                      <td>{{($BNT_Motor_VIPowner != 0) ?$BNT_Motor_VIPowner: ''}}</td>
                                      <td>{{($BNT_Motor_BuyHaveProperty != 0) ?$BNT_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($BNT_Motor_BuyNoHaveProperty != 0) ?$BNT_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($BNT_Motor_BuyNoWarranty != 0) ?$BNT_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($BNT_Motor_VIPbuy != 0) ?$BNT_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_BNT_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#DCFBBB;">
                                      <td class="text-left">ยะหา (14)</td>
                                      <td>{{($YH_Motor_HaveProperty != 0) ?$YH_Motor_HaveProperty: ''}}</td>
                                      <td>{{($YH_Motor_NoProperty != 0) ?$YH_Motor_NoProperty: ''}}</td>
                                      <td>{{($YH_Motor_NoWarranty != 0) ?$YH_Motor_NoWarranty: ''}}</td>
                                      <td>{{($YH_Motor_VIPowner != 0) ?$YH_Motor_VIPowner: ''}}</td>
                                      <td>{{($YH_Motor_BuyHaveProperty != 0) ?$YH_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($YH_Motor_BuyNoHaveProperty != 0) ?$YH_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($YH_Motor_BuyNoWarranty != 0) ?$YH_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($YH_Motor_VIPbuy != 0) ?$YH_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_YH_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">นราธิวาส (04)</td>
                                      <td>{{($NR_Motor_HaveProperty != 0) ?$NR_Motor_HaveProperty: ''}}</td>
                                      <td>{{($NR_Motor_NoProperty != 0) ?$NR_Motor_NoProperty: ''}}</td>
                                      <td>{{($NR_Motor_NoWarranty != 0) ?$NR_Motor_NoWarranty: ''}}</td>
                                      <td>{{($NR_Motor_VIPowner != 0) ?$NR_Motor_VIPowner: ''}}</td>
                                      <td>{{($NR_Motor_BuyHaveProperty != 0) ?$NR_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($NR_Motor_BuyNoHaveProperty != 0) ?$NR_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($NR_Motor_BuyNoWarranty != 0) ?$NR_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($NR_Motor_VIPbuy != 0) ?$NR_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_NR_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">โกลก (06)</td>
                                      <td>{{($KOL_Motor_HaveProperty != 0) ?$KOL_Motor_HaveProperty: ''}}</td>
                                      <td>{{($KOL_Motor_NoProperty != 0) ?$KOL_Motor_NoProperty: ''}}</td>
                                      <td>{{($KOL_Motor_NoWarranty != 0) ?$KOL_Motor_NoWarranty: ''}}</td>
                                      <td>{{($KOL_Motor_VIPowner != 0) ?$KOL_Motor_VIPowner: ''}}</td>
                                      <td>{{($KOL_Motor_BuyHaveProperty != 0) ?$KOL_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($KOL_Motor_BuyNoHaveProperty != 0) ?$KOL_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($KOL_Motor_BuyNoWarranty != 0) ?$KOL_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($KOL_Motor_VIPbuy != 0) ?$KOL_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_KOL_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">ตันหยงมัส (09)</td>
                                      <td>{{($TM_Motor_HaveProperty != 0) ?$TM_Motor_HaveProperty: ''}}</td>
                                      <td>{{($TM_Motor_NoProperty != 0) ?$TM_Motor_NoProperty: ''}}</td>
                                      <td>{{($TM_Motor_NoWarranty != 0) ?$TM_Motor_NoWarranty: ''}}</td>
                                      <td>{{($TM_Motor_VIPowner != 0) ?$TM_Motor_VIPowner: ''}}</td>
                                      <td>{{($TM_Motor_BuyHaveProperty != 0) ?$TM_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($TM_Motor_BuyNoHaveProperty != 0) ?$TM_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($TM_Motor_BuyNoWarranty != 0) ?$TM_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($TM_Motor_VIPbuy != 0) ?$TM_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_TM_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center" style="background-color:#ECD3FE;">
                                      <td class="text-left">รือเสาะ (12)</td>
                                      <td>{{($RS_Motor_HaveProperty != 0) ?$RS_Motor_HaveProperty: ''}}</td>
                                      <td>{{($RS_Motor_NoProperty != 0) ?$RS_Motor_NoProperty: ''}}</td>
                                      <td>{{($RS_Motor_NoWarranty != 0) ?$RS_Motor_NoWarranty: ''}}</td>
                                      <td>{{($RS_Motor_VIPowner != 0) ?$RS_Motor_VIPowner: ''}}</td>
                                      <td>{{($RS_Motor_BuyHaveProperty != 0) ?$RS_Motor_BuyHaveProperty: ''}}</td>
                                      <td>{{($RS_Motor_BuyNoHaveProperty != 0) ?$RS_Motor_BuyNoHaveProperty: ''}}</td>
                                      <td>{{($RS_Motor_BuyNoWarranty != 0) ?$RS_Motor_BuyNoWarranty: ''}}</td>
                                      <td>{{($RS_Motor_VIPbuy != 0) ?$RS_Motor_VIPbuy: ''}}</td>
                                      <td class="bg-warning"><b>{{$Total_RS_Motor}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">ยอดรวม</td>
                                      <td><b>{{($PN_Motor_HaveProperty + $SB_Motor_HaveProperty + $KP_Motor_HaveProperty + $YL_Motor_HaveProperty + $BT_Motor_HaveProperty + $BNT_Motor_HaveProperty + $YH_Motor_HaveProperty + $NR_Motor_HaveProperty + $KOL_Motor_HaveProperty + $TM_Motor_HaveProperty + $RS_Motor_HaveProperty)}}</b></td>
                                      <td><b>{{($PN_Motor_NoProperty + $SB_Motor_NoProperty + $KP_Motor_NoProperty + $YL_Motor_NoProperty + $BT_Motor_NoProperty + $BNT_Motor_NoProperty + $YH_Motor_NoProperty + $NR_Motor_NoProperty + $KOL_Motor_NoProperty + $TM_Motor_NoProperty + $RS_Motor_NoProperty)}}</b></td>
                                      <td><b>{{($PN_Motor_NoWarranty + $SB_Motor_NoWarranty + $KP_Motor_NoWarranty + $YL_Motor_NoWarranty + $BT_Motor_NoWarranty + $BNT_Motor_NoWarranty + $YH_Motor_NoWarranty + $NR_Motor_NoWarranty + $KOL_Motor_NoWarranty + $TM_Motor_NoWarranty + $RS_Motor_NoWarranty)}}</b></td>
                                      <td><b>{{($PN_Motor_VIPowner + $SB_Motor_VIPowner + $KP_Motor_VIPowner + $YL_Motor_VIPowner + $BT_Motor_VIPowner + $BNT_Motor_VIPowner + $YH_Motor_VIPowner + $NR_Motor_VIPowner + $KOL_Motor_VIPowner + $TM_Motor_VIPowner + $RS_Motor_VIPowner)}}</b></td>
                                      <td><b>{{($PN_Motor_BuyHaveProperty + $SB_Motor_BuyHaveProperty + $KP_Motor_BuyHaveProperty + $YL_Motor_BuyHaveProperty + $BT_Motor_BuyHaveProperty + $BNT_Motor_BuyHaveProperty + $YH_Motor_BuyHaveProperty + $NR_Motor_BuyHaveProperty + $KOL_Motor_BuyHaveProperty + $TM_Motor_BuyHaveProperty + $RS_Motor_BuyHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Motor_BuyNoHaveProperty + $SB_Motor_BuyNoHaveProperty + $KP_Motor_BuyNoHaveProperty + $YL_Motor_BuyNoHaveProperty + $BT_Motor_BuyNoHaveProperty + $BNT_Motor_BuyNoHaveProperty + $YH_Motor_BuyNoHaveProperty + $NR_Motor_BuyNoHaveProperty + $KOL_Motor_BuyNoHaveProperty + $TM_Motor_BuyNoHaveProperty + $RS_Motor_BuyNoHaveProperty)}}</b></td>
                                      <td><b>{{($PN_Motor_BuyNoWarranty + $SB_Motor_BuyNoWarranty + $KP_Motor_BuyNoWarranty + $YL_Motor_BuyNoWarranty + $BT_Motor_BuyNoWarranty + $BNT_Motor_BuyNoWarranty + $YH_Motor_BuyNoWarranty + $NR_Motor_BuyNoWarranty + $KOL_Motor_BuyNoWarranty + $TM_Motor_BuyNoWarranty + $RS_Motor_BuyNoWarranty)}}</b></td>
                                      <td><b>{{($PN_Motor_VIPbuy + $SB_Motor_VIPbuy + $KP_Motor_VIPbuy + $YL_Motor_VIPbuy + $BT_Motor_VIPbuy + $BNT_Motor_VIPbuy + $YH_Motor_VIPbuy + $NR_Motor_VIPbuy + $KOL_Motor_VIPbuy + $TM_Motor_VIPbuy + $RS_Motor_VIPbuy)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{$Total_baabMotor}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left">% แบบ</td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_HaveProperty + $SB_Motor_HaveProperty + $KP_Motor_HaveProperty + $YL_Motor_HaveProperty + $BT_Motor_HaveProperty + $BNT_Motor_HaveProperty + $YH_Motor_HaveProperty + $NR_Motor_HaveProperty + $KOL_Motor_HaveProperty + $TM_Motor_HaveProperty + $RS_Motor_HaveProperty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_NoProperty + $SB_Motor_NoProperty + $KP_Motor_NoProperty + $YL_Motor_NoProperty + $BT_Motor_NoProperty + $BNT_Motor_NoProperty + $YH_Motor_NoProperty + $NR_Motor_NoProperty + $KOL_Motor_NoProperty + $TM_Motor_NoProperty + $RS_Motor_NoProperty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_NoWarranty + $SB_Motor_NoWarranty + $KP_Motor_NoWarranty + $YL_Motor_NoWarranty + $BT_Motor_NoWarranty + $BNT_Motor_NoWarranty + $YH_Motor_NoWarranty + $NR_Motor_NoWarranty + $KOL_Motor_NoWarranty + $TM_Motor_NoWarranty + $RS_Motor_NoWarranty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_VIPowner + $SB_Motor_VIPowner + $KP_Motor_VIPowner + $YL_Motor_VIPowner + $BT_Motor_VIPowner + $BNT_Motor_VIPowner + $YH_Motor_VIPowner + $NR_Motor_VIPowner + $KOL_Motor_VIPowner + $TM_Motor_VIPowner + $RS_Motor_VIPowner) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_BuyHaveProperty + $SB_Motor_BuyHaveProperty + $KP_Motor_BuyHaveProperty + $YL_Motor_BuyHaveProperty + $BT_Motor_BuyHaveProperty + $BNT_Motor_BuyHaveProperty + $YH_Motor_BuyHaveProperty + $NR_Motor_BuyHaveProperty + $KOL_Motor_BuyHaveProperty + $TM_Motor_BuyHaveProperty + $RS_Motor_BuyHaveProperty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_BuyNoHaveProperty + $SB_Motor_BuyNoHaveProperty + $KP_Motor_BuyNoHaveProperty + $YL_Motor_BuyNoHaveProperty + $BT_Motor_BuyNoHaveProperty + $BNT_Motor_BuyNoHaveProperty + $YH_Motor_BuyNoHaveProperty + $NR_Motor_BuyNoHaveProperty + $KOL_Motor_BuyNoHaveProperty + $TM_Motor_BuyNoHaveProperty + $RS_Motor_BuyNoHaveProperty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_BuyNoWarranty + $SB_Motor_BuyNoWarranty + $KP_Motor_BuyNoWarranty + $YL_Motor_BuyNoWarranty + $BT_Motor_BuyNoWarranty + $BNT_Motor_BuyNoWarranty + $YH_Motor_BuyNoWarranty + $NR_Motor_BuyNoWarranty + $KOL_Motor_BuyNoWarranty + $TM_Motor_BuyNoWarranty + $RS_Motor_BuyNoWarranty) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td><b>@if($Total_baabMotor != 0) {{round((($PN_Motor_VIPbuy + $SB_Motor_VIPbuy + $KP_Motor_VIPbuy + $YL_Motor_VIPbuy + $BT_Motor_VIPbuy + $BNT_Motor_VIPbuy + $YH_Motor_VIPbuy + $NR_Motor_VIPbuy + $KOL_Motor_VIPbuy + $TM_Motor_VIPbuy + $RS_Motor_VIPbuy) / $Total_baabMotor) * 100)}} % @endif</b></td>
                                      <td style="background-color: red;color:white;"><b>@if($Total_baabMotor != 0) {{round(($Total_baabMotor / $Total_baabMotor) * 100)}} % @endif</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          @else
                            <div class="tab-pane fade active show" id="vert-tabs-9" role="tabpanel" aria-labelledby="vert-tabs-9-tab">
                              <div class="card-header" style="background-color:#E2DEDF ;">
                                <h3 class="card-title pr-2">ยอดจัด(All products)</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-12">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="table1" style="border-radius : 20px;line-height: 90%;">
                                  <tbody>
                                    <tr class="text-center bg-success">
                                      <td style="width: 90px">สาขา</td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{5}}" style="color:#FFF;">Micro</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{1}}" style="color:#FFF;">P-Loan</a></td>
                                      <td><a href="{{ route('Analysis', 1) }}" style="color:#FFF;">เช่าซื้อ</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{4}}" style="color:#FFF;">พนักงาน</a></td>
                                      <td><a href="{{ route('Analysis',4) }}" style="color:#FFF;">รถบ้าน</a></td>
                                      <td><a href="{{ route('MasterMicroPloan.index') }}?type={{3}}" style="color:#FFF;">มอเตอร์ไซค์</a></td>
                                      <td style="width: 90px">ผลรวมยอดคัน</td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ปัตตานี</b></td>
                                      <td>{{($Micro50 != 0) ?$Micro50: ''}}</td>
                                      <td>{{($Ploan50 != 0) ?$Ploan50: ''}}</td>
                                      <td>{{($Leasing01 != 0) ?$Leasing01: ''}}</td>
                                      <td>{{($Staff50 != 0) ?$Staff50: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor50 != 0) ?$Motor50: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro50 + $Ploan50 + $Leasing01 + $Staff50 + $Motor50)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะลา</b></td>
                                      <td>{{($Micro51 != 0) ?$Micro51: ''}}</td>
                                      <td>{{($Ploan51 != 0) ?$Ploan51: ''}}</td>
                                      <td>{{($Leasing03 != 0) ?$Leasing03: ''}}</td>
                                      <td>{{($Staff51 != 0) ?$Staff51: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor51 != 0) ?$Motor51: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro51 + $Ploan51 + $Leasing03 + $Staff51 + $Motor51)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>นราธิวาส</b></td>
                                      <td>{{($Micro52 != 0) ?$Micro52: ''}}</td>
                                      <td>{{($Ploan52 != 0) ?$Ploan52: ''}}</td>
                                      <td>{{($Leasing04 != 0) ?$Leasing04: ''}}</td>
                                      <td>{{($Staff52 != 0) ?$Staff52: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor52 != 0) ?$Motor52: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro52 + $Ploan52 + $Leasing04 + $Staff52 + $Motor52)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>สายบุรี</b></td>
                                      <td>{{($Micro53 != 0) ?$Micro53: ''}}</td>
                                      <td>{{($Ploan53 != 0) ?$Ploan53: ''}}</td>
                                      <td>{{($Leasing05 != 0) ?$Leasing05: ''}}</td>
                                      <td>{{($Staff53 != 0) ?$Staff53: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor53 != 0) ?$Motor53: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro53 + $Ploan53 + $Leasing05 + $Staff53 + $Motor53)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โกลก</b></td>
                                      <td>{{($Micro54 != 0) ?$Micro54: ''}}</td>
                                      <td>{{($Ploan54 != 0) ?$Ploan54: ''}}</td>
                                      <td>{{($Leasing06 != 0) ?$Leasing06: ''}}</td>
                                      <td>{{($Staff54 != 0) ?$Staff54: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor54 != 0) ?$Motor54: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro54 + $Ploan54 + $Leasing06 + $Staff54 + $Motor54)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>เบตง</b></td>
                                      <td>{{($Micro55 != 0) ?$Micro55: ''}}</td>
                                      <td>{{($Ploan55 != 0) ?$Ploan55: ''}}</td>
                                      <td>{{($Leasing07 != 0) ?$Leasing07: ''}}</td>
                                      <td>{{($Staff55 != 0) ?$Staff55: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor55 != 0) ?$Motor55: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro55 + $Ploan55 + $Leasing07 + $Staff55 + $Motor55)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>โคกโพธิ์</b></td>
                                      <td>{{($Micro56 != 0) ?$Micro56: ''}}</td>
                                      <td>{{($Ploan56 != 0) ?$Ploan56: ''}}</td>
                                      <td>{{($Leasing08 != 0) ?$Leasing08: ''}}</td>
                                      <td>{{($Staff56 != 0) ?$Staff56: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor56 != 0) ?$Motor56: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro56 + $Ploan56 + $Leasing08 + $Staff56 + $Motor56)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ตันหยงมัส</b></td>
                                      <td>{{($Micro57 != 0) ?$Micro57: ''}}</td>
                                      <td>{{($Ploan57 != 0) ?$Ploan57: ''}}</td>
                                      <td>{{($Leasing09 != 0) ?$Leasing09: ''}}</td>
                                      <td>{{($Staff57 != 0) ?$Staff57: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor57 != 0) ?$Motor57: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro57 + $Ploan57 + $Leasing09 + $Staff57 + $Motor57)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รือเสาะ</b></td>
                                      <td>{{($Micro58 != 0) ?$Micro58: ''}}</td>
                                      <td>{{($Ploan58 != 0) ?$Ploan58: ''}}</td>
                                      <td>{{($Leasing12 != 0) ?$Leasing12: ''}}</td>
                                      <td>{{($Staff58 != 0) ?$Staff58: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor58 != 0) ?$Motor58: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro58 + $Ploan58 + $Leasing12 + $Staff58 + $Motor58)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>บันนังสตา</b></td>
                                      <td>{{($Micro59 != 0) ?$Micro59: ''}}</td>
                                      <td>{{($Ploan59 != 0) ?$Ploan59: ''}}</td>
                                      <td>{{($Leasing13 != 0) ?$Leasing13: ''}}</td>
                                      <td>{{($Staff59 != 0) ?$Staff59: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor59 != 0) ?$Motor59: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro59 + $Ploan59 + $Leasing13 + $Staff59 + $Motor59)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>ยะหา</b></td>
                                      <td>{{($Micro60 != 0) ?$Micro60: ''}}</td>
                                      <td>{{($Ploan60 != 0) ?$Ploan60: ''}}</td>
                                      <td>{{($Leasing14 != 0) ?$Leasing14: ''}}</td>
                                      <td>{{($Staff60 != 0) ?$Staff60: ''}}</td>
                                      <td></td>
                                      <td>{{($Motor60 != 0) ?$Motor60: ''}}</td>
                                      <td class="bg-warning"><b>{{number_format($Micro60 + $Ploan60 + $Leasing14 + $Staff60 + $Motor60)}}</b></td>
                                    </tr>
                                    <tr class="text-center">
                                      <td class="text-left"><b>รถบ้าน</b></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td>{{($SumHomecarAll != 0) ?$SumHomecarAll: ''}}</td>
                                      <td></td>
                                      <td class="bg-warning"><b>{{number_format($SumHomecarAll)}}</b></td>
                                    </tr>
                                    <tr class="text-center bg-warning">
                                      <td class="text-left"><b>รวม</b></td>
                                      <td><b>{{number_format($SumMicroAll)}}</b></td>
                                      <td><b>{{number_format($SumPloanAll)}}</b></td>
                                      <td><b>{{number_format($SumLeasingAll)}}</b></td>
                                      <td><b>{{number_format($SumStaffAll)}}</b></td>
                                      <td><b>{{number_format($SumHomecarAll)}}</b></td>
                                      <td><b>{{number_format($SumMotorAll)}}</b></td>
                                      <td style="background-color: red;color:white;"><b>{{number_format($TotalAllProduct)}}</b></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          @endif
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
