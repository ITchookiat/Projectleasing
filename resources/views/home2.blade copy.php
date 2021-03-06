@extends('layouts.master')
@section('title','Home')
@section('content')
  <style>
    i:hover {
      color: blue;
    }
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    body {
      font-family: Roboto, sans-serif;
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

    $TargetPattani = round(($Leasing01 / $dataLeasing->Target_Pattani) * 100);
    $TargetSaiburi = round(($Leasing05 / $dataLeasing->Target_Saiburi) * 100);
    $TargetKophor = round(($Leasing08 / $dataLeasing->Target_Kophor) * 100);
    $TargetYala = round(($Leasing03 / $dataLeasing->Target_Yala) * 100);
    $TargetBetong = round(($Leasing07 / $dataLeasing->Target_Betong) * 100);
    $TargetBannangsta = round(($Leasing13 / $dataLeasing->Target_Bannangsta) * 100);
    $TargetYaha = round(($Leasing14 / $dataLeasing->Target_Yaha) * 100);
    $TargetNara = round(($Leasing04 / $dataLeasing->Target_Narathiwat) * 100);
    $TargetKolok = round(($Leasing06 / $dataLeasing->Target_Kolok) * 100);
    $TargetTanyongmas = round(($Leasing09/ $dataLeasing->Target_Tanyongmas) * 100);
    $TargetRosok = round(($Leasing12 / $dataLeasing->Target_Rosok) * 100);
    $TargetHomecar = round(($SumHomecarAll / $SumHomecarAll) * 100);
  @endphp

  <div class="content-header text-sm" style="padding:15px;">
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
                      <small class="badge" style="font-size: 14px;">
                        ข้อมูลวันที่ :
                        <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control pr-3"/>
                        ถึงวันที่ :
                        <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control"/>&nbsp;
                        <button type="submit" class="btn btn-info" title="ค้นหา">
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
              <div class="col-md-12">
                <div class="col-12 col-sm-12">
                  <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-leasing-tab" data-toggle="pill" href="#custom-tabs-leasing" role="tab" aria-controls="custom-tabs-leasing" aria-selected="false">
                            เช่าซื้อ&nbsp;
                            <!-- <span class="badge bg-primary float-right">@if($Allproducts == '') {{number_format($SumLeasingAll)}} @endif</span> -->
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-ploan-tab" data-toggle="pill" href="#custom-tabs-ploan" role="tab" aria-controls="custom-tabs-ploan" aria-selected="false">
                          Ploan&nbsp;
                          <!-- <span class="badge bg-primary float-right">@if($Allproducts == '') {{number_format($SumPloanAll)}} @endif</span> -->
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-micro-tab" data-toggle="pill" href="#custom-tabs-micro" role="tab" aria-controls="custom-tabs-micro" aria-selected="false">Micro</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-motor-tab" data-toggle="pill" href="#custom-tabs-motor" role="tab" aria-controls="custom-tabs-motor" aria-selected="true">มอเตอร์ไซค์</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-staff-tab" data-toggle="pill" href="#custom-tabs-staff" role="tab" aria-controls="custom-tabs-staff" aria-selected="true">พนักงาน</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-leasing" role="tabpanel" aria-labelledby="custom-tabs-leasing-tab">
                          <div class="row mb-1">
                            <section class="col-lg-8 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <!-- <div id="chartLeasing"></div> -->
                                <div id="chartLeasingPercent"></div>
                              </div>
                            </section>
                            <section class="col-lg-4 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <div id="chartLeasing"></div>
                              </div>
                            </section>
                          </div>
                          <div class="row mb-1">
                            <section class="col-lg-12 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <div id="chartLeasingCash"></div>
                              </div>
                            </section>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-ploan" role="tabpanel" aria-labelledby="custom-tabs-ploan-tab">
                          <div class="row mb-1">
                            <section class="col-lg-7 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <div id="chartPloan"></div>
                              </div>
                            </section>
                            <section class="col-lg-5 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <div id="chartPloanPercent"></div>
                              </div>
                            </section>
                          </div>
                          <div class="row mb-1">
                            <section class="col-lg-12 connectedSortable ui-sortable">
                              <div class="col-md-12 card">
                                <div id="chartPloanCash"></div>
                              </div>
                            </section>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-micro" role="tabpanel" aria-labelledby="custom-tabs-micro-tab">
                          Micro Coming soon...
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-motor" role="tabpanel" aria-labelledby="custom-tabs-motor-tab">
                          Motor Coming soon...
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-staff" role="tabpanel" aria-labelledby="custom-tabs-staff-tab">
                          Staff Coming soon...
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
            </div>
          <!-- </div> -->

      </div>
    </div>
  </div>

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

  {{-- ยอดจัด เช่าซื้อ --}}
  <script>
    var Totalprice = addCommas({{$TotalAllProduct2}});
    var options = {
      series: [{
        data: [0,{{$Topcar_Leasing01}}, {{$Topcar_Leasing03}}, {{$Topcar_Leasing04}}, {{$Topcar_Leasing05}}, {{$Topcar_Leasing06}}, {{$Topcar_Leasing07}}, {{$Topcar_Leasing08}}, {{$Topcar_Leasing09}}, {{$Topcar_Leasing12}}, {{$Topcar_Leasing13}}, {{$Topcar_Leasing14}},{{$SumTopcar_HomecarAll}}]
    }],
      chart: {
      type: 'line',
      height: 250,
      zoom: {
          enabled: false
        }
    },
    title: {
      text: 'ยอดจัด ' + '( ' +  Totalprice + ' บาท' + ' )',
    },
    colors: ['#F5E30F'],
    plotOptions: {
      bar: {
        borderRadius: 4,
        horizontal: true,
        dataLabels: {
          position: 'top', // top, center, bottom
        },
        // distributed: true,
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return addCommas(val);
      },
      offsetX: -6,
      style: {
        fontSize: '10px',
        colors: ["#304758"]
      }
    },
    xaxis: {
      categories: ["","ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา", "รถบ้าน"],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartLeasingCash"), options);
    chart.render();
  </script>

  {{-- ยอดคัน(เป้า)) เช่าซื้อ --}}
  <script>
      var TotalCon = addCommas({{$SumLeasingAll}});
      var options = {
      series: [
        {
          name: "ยอดคัน",
          type: "column",
          color: "#3EA513",
          data: [{{$Leasing01}}, {{$Leasing03}}, {{$Leasing04}}, {{$Leasing05}}, {{$Leasing06}}, {{$Leasing07}}, {{$Leasing08}}, {{$Leasing09}}, {{$Leasing12}}, {{$Leasing13}}, {{$Leasing14}},{{$SumHomecarAll}}]
        },
        {
          name: "ยอดเป้า",
          type: "line",
          color: "#FB2108",
          data: [{{($dataLeasing->Target_Pattani != '') ?$dataLeasing->Target_Pattani: 0 }},
                 {{($dataLeasing->Target_Yala != '') ?$dataLeasing->Target_Yala: 0 }}, 
                 {{($dataLeasing->Target_Narathiwat != '') ?$dataLeasing->Target_Narathiwat: 0 }}, 
                 {{($dataLeasing->Target_Saiburi != '') ?$dataLeasing->Target_Saiburi: 0 }}, 
                 {{($dataLeasing->Target_Kolok != '') ?$dataLeasing->Target_Kolok: 0 }}, 
                 {{($dataLeasing->Target_Betong != '') ?$dataLeasing->Target_Betong: 0 }}, 
                 {{($dataLeasing->Target_Kophor != '') ?$dataLeasing->Target_Kophor: 0 }}, 
                 {{($dataLeasing->Target_Tanyongmas != '') ?$dataLeasing->Target_Tanyongmas: 0 }}, 
                 {{($dataLeasing->Target_Rosok != '') ?$dataLeasing->Target_Rosok: 0 }}, 
                 {{($dataLeasing->Target_Bannangsta != '') ?$dataLeasing->Target_Bannangsta: 0 }}, 
                 {{($dataLeasing->Target_Yaha != '') ?$dataLeasing->Target_Yaha: 0 }}, 
                 {{$SumHomecarAll}}]
        }
      ],
      chart: {
        height: 250,
        type: "line",
        zoom: {
          enabled: false
        }
      },
      title: {
        text: 'ยอดคัน ' + '( ' + TotalCon + ' คัน' + ' )',
      },
      stroke: {
        width: [1, 1],
        dashArray: [0,5]
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "bottom" // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "10px",
          colors: ["#3EA513","#FB2108"]
        }
      },
      labels: [
        "ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา", "รถบ้าน"
      ],
      xaxis: {
        type: "text"
      },
    };

    var chart = new ApexCharts(document.querySelector("#chartLeasingPercent"), options);
    chart.render();

  </script>

  {{-- ยอดคัน % เช่าซื้อ --}}
  <script>
    var TotalCon = addCommas({{$SumLeasingAll}});
    var options = {
      series: [{
      name: 'ผลงาน',
      data: [{{$TargetPattani}}, {{$TargetYala}}, {{$TargetNara}}, {{$TargetSaiburi}}, {{$TargetKolok}}, {{$TargetBetong}}, {{$TargetKophor}}, {{$TargetTanyongmas}}, {{$TargetRosok}}, {{$TargetBannangsta}}, {{$TargetYaha}}]
    }],
      chart: {
      height: 250,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        // borderRadius: 2,
        dataLabels: {
          position: 'top', // top, center, bottom
        },
        // distributed: true,
      },
    },
    legend: {
      show: false
    },
    colors: ['#FC471B'],
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val + " %";
      },
      offsetY: -20,
      style: {
        fontSize: '10px',
        colors: ["#304758"]
      },
    },
    title: {
        text: 'เปอร์เซ็นต์ผลงาน ',
        fontSize: '12px',
      },
    xaxis: {
      categories: ["ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
      position: 'bottom',
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        fill: {
          type: 'gradient',
          gradient: {
            colorFrom: '#D8E3F0',
            colorTo: '#BED1E6',
            stops: [0, 100],
            opacityFrom: 0.4,
            opacityTo: 0.5,
          }
        }
      },
      tooltip: {
        enabled: true,
      },
    },
    yaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
        formatter: function (val) {
          return val + "%";
        }
      },
    
    }
    };

    var chart = new ApexCharts(document.querySelector("#chartLeasing"), options);
    chart.render();
  </script>

  {{-- ยอดจัด Ploan --}}
  <script>
    var options = {
      series: [{
        data: [{{$Topcar_Ploan50}}, {{$Topcar_Ploan51}}, {{$Topcar_Ploan52}}, {{$Topcar_Ploan53}}, {{$Topcar_Ploan54}}, {{$Topcar_Ploan55}}, {{$Topcar_Ploan56}}, {{$Topcar_Ploan57}}, {{$Topcar_Ploan58}}, {{$Topcar_Ploan59}}, {{$Topcar_Ploan60}}]
    }],
      chart: {
      type: 'bar',
      height: 300,
    },
    colors: ['#64B10B'],
    plotOptions: {
      bar: {
        borderRadius: 4,
        horizontal: true,
        dataLabels: {
          position: 'top', // top, center, bottom
        },
        // distributed: true,
      }
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return addCommas(val);
      },
      offsetX: -6,
      style: {
        fontSize: '12px',
        colors: ["#304758"]
      }
    },
    xaxis: {
      categories: ["ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    },
    yaxis: {
      title: {
        text: 'ยอดจัด',
      },
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartPloanCash"), options);
    chart.render();
  </script>

  {{-- ยอดคัน Ploan --}}
  <script>
    var options = {
      series: [{
      name: 'ยอดคัน',
      data: [{{$Ploan50}}, {{$Ploan51}}, {{$Ploan52}}, {{$Ploan53}}, {{$Ploan54}}, {{$Ploan55}}, {{$Ploan56}}, {{$Ploan57}}, {{$Ploan58}}, {{$Ploan59}}, {{$Ploan60}}]
    }],
      chart: {
      height: 250,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        dataLabels: {
          position: 'top', // top, center, bottom
        },
        distributed: true,
      },
    },
    legend: {
      show: false
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val + " คัน";
      },
      offsetY: -20,
      style: {
        fontSize: '12px',
        colors: ["#304758"]
      },
    },
    
    xaxis: {
      categories: ["ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
      position: 'bottom',
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        fill: {
          type: 'gradient',
          gradient: {
            colorFrom: '#D8E3F0',
            colorTo: '#BED1E6',
            stops: [0, 100],
            opacityFrom: 0.4,
            opacityTo: 0.5,
          }
        }
      },
      tooltip: {
        enabled: true,
      },
    },
    yaxis: {
      axisBorder: {
        show: false
      },
      title: {
        text: 'ยอดคัน',
        fontSize: '12px',
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
        formatter: function (val) {
          return val + "คัน";
        }
      },
    
    }
    };

    var chart = new ApexCharts(document.querySelector("#chartPloan"), options);
    chart.render();
  </script>

  {{-- ยอดคัน(%) Ploan --}}
  <script>
    var options = {
      series: [{{$Ploan50}}, {{$Ploan51}}, {{$Ploan52}}, {{$Ploan53}}, {{$Ploan54}}, {{$Ploan55}}, {{$Ploan56}}, {{$Ploan57}}, {{$Ploan58}}, {{$Ploan59}}, {{$Ploan60}}],
      chart: {
      width: 380,
      type: 'pie',
    },
    title: {
      text: 'ยอดคัน(%)',
    },
    labels: ["ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    responsive: [{
      breakpoint: 500,
      options: {
        chart: {
          width: 300
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
    };

    var chart = new ApexCharts(document.querySelector("#chartPloanPercent"), options);
    chart.render();
  </script>


@endsection
