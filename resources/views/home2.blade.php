@extends('layouts.master')
@section('title','Home')
@section('content')
  <style>
    @import url('https://fonts.googleapis.com/css?family=Arimo:400,700&display=swap');
    body{
      font-family: 'Arimo', sans-serif;
    }
    h2{
      color:#000;
      text-align:center;
      font-size:2em;
    }
    .warpper{
      display:flex;
      flex-direction: column;
      align-items: center;
    }
    .tab{
      cursor: pointer;
      padding:10px 20px;
      margin:0px 2px;
      background:#C6BDBA;
      display:inline-block;
      color:#fff;
      border-radius:3px 3px 0px 0px;
      box-shadow: 0 0.5rem 0.8rem #00000080;
    }
    .panels{
      background:#fffffff6;
      box-shadow: 0 2rem 2rem #00000080;
      min-height:200px;
      width:100%;
      border-radius:3px;
      overflow:hidden;
      padding:20px;  
    }
    .panel{
      display:none;
      animation: fadein .8s;
    }
    @keyframes fadein {
        from {
            opacity:0;
        }
        to {
            opacity:1;
        }
    }
    .panel-title{
      font-size:1.5em;
      font-weight:bold
    }
    .radio{
      display:none;
    }
    #one:checked ~ .panels #one-panel,
    #two:checked ~ .panels #two-panel,
    #three:checked ~ .panels #three-panel,
    #four:checked ~ .panels #four-panel,
    #five:checked ~ .panels #five-panel,
    #six:checked ~ .panels #six-panel{
      display:block
    }
    #one:checked ~ .tabs #one-tab,
    #two:checked ~ .tabs #two-tab,
    #three:checked ~ .tabs #three-tab,
    #four:checked ~ .tabs #four-tab,
    #five:checked ~ .tabs #five-tab,
    #six:checked ~ .tabs #six-tab{
      background:#fffffff6;
      color:#000;
      border-top: 3px solid #000;
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

  @if($dataLeasing != null)
    @php 
      $TargetPattani_LS = round(($Leasing01 / $dataLeasing->Target_Pattani) * 100);
      $TargetYala_LS = round(($Leasing03 / $dataLeasing->Target_Yala) * 100);
      $TargetNara_LS = round(($Leasing04 / $dataLeasing->Target_Narathiwat) * 100);
      $TargetSaiburi_LS = round(($Leasing05 / $dataLeasing->Target_Saiburi) * 100);
      $TargetKolok_LS = round(($Leasing06 / $dataLeasing->Target_Kolok) * 100);
      $TargetBetong_LS = round(($Leasing07 / $dataLeasing->Target_Betong) * 100);
      $TargetKophor_LS = round(($Leasing08 / $dataLeasing->Target_Kophor) * 100);
      $TargetTanyongmas_LS = round(($Leasing09/ $dataLeasing->Target_Tanyongmas) * 100);
      $TargetRosok_LS = round(($Leasing12 / $dataLeasing->Target_Rosok) * 100);
      $TargetBannangsta_LS = round(($Leasing13 / $dataLeasing->Target_Bannangsta) * 100);
      $TargetYaha_LS = round(($Leasing14 / $dataLeasing->Target_Yaha) * 100);
      $TargetHomecar_LS = round(($SumHomecarAll / $SumHomecarAll) * 100);
    @endphp
  @endif

  @if($dataPloan != null)
    @php 
      $TargetPattani_PL = round(($Ploan50 / $dataPloan->Target_Pattani) * 100);
      $TargetYala_PL = round(($Ploan51 / $dataPloan->Target_Yala) * 100);
      $TargetNara_PL = round(($Ploan52 / $dataPloan->Target_Narathiwat) * 100);
      $TargetSaiburi_PL = round(($Ploan53 / $dataPloan->Target_Saiburi) * 100);
      $TargetKolok_PL = round(($Ploan54 / $dataPloan->Target_Kolok) * 100);
      $TargetBetong_PL = round(($Ploan55 / $dataPloan->Target_Betong) * 100);
      $TargetKophor_PL = round(($Ploan56 / $dataPloan->Target_Kophor) * 100);
      $TargetTanyongmas_PL = round(($Ploan57 / $dataPloan->Target_Tanyongmas) * 100);
      $TargetRosok_PL = round(($Ploan58 / $dataPloan->Target_Rosok) * 100);
      $TargetBannangsta_PL = round(($Ploan59 / $dataPloan->Target_Bannangsta) * 100);
      $TargetYaha_PL = round(($Ploan60 / $dataPloan->Target_Yaha) * 100);
    @endphp
  @endif

  @if($dataMicro != null)
    @php 
      $TargetPattani_MC = round(($Micro50 / $dataMicro->Target_Pattani) * 100);
      $TargetYala_MC = round(($Micro51 / $dataMicro->Target_Yala) * 100);
      $TargetNara_MC = round(($Micro52 / $dataMicro->Target_Narathiwat) * 100);
      $TargetSaiburi_MC = round(($Micro53 / $dataMicro->Target_Saiburi) * 100);
      $TargetKolok_MC = round(($Micro54 / $dataMicro->Target_Kolok) * 100);
      $TargetBetong_MC = round(($Micro55 / $dataMicro->Target_Betong) * 100);
      $TargetKophor_MC = round(($Micro56 / $dataMicro->Target_Kophor) * 100);
      $TargetTanyongmas_MC = round(($Micro57 / $dataMicro->Target_Tanyongmas) * 100);
      $TargetRosok_MC = round(($Micro58 / $dataMicro->Target_Rosok) * 100);
      $TargetBannangsta_MC = round(($Micro59 / $dataMicro->Target_Bannangsta) * 100);
      $TargetYaha_MC = round(($Micro60 / $dataMicro->Target_Yaha) * 100);
    @endphp
  @endif

  @if($dataMotor != null)
    @php 
      $TargetPattani_MT = round(($Motor50 / $dataMotor->Target_Pattani) * 100);
      $TargetYala_MT = round(($Motor51 / $dataMotor->Target_Yala) * 100);
      $TargetNara_MT = round(($Motor52 / $dataMotor->Target_Narathiwat) * 100);
      $TargetSaiburi_MT = round(($Motor53 / $dataMotor->Target_Saiburi) * 100);
      $TargetKolok_MT = round(($Motor54 / $dataMotor->Target_Kolok) * 100);
      $TargetBetong_MT = round(($Motor55 / $dataMotor->Target_Betong) * 100);
      $TargetKophor_MT = round(($Motor56 / $dataMotor->Target_Kophor) * 100);
      $TargetTanyongmas_MT = round(($Motor57 / $dataMotor->Target_Tanyongmas) * 100);
      $TargetRosok_MT = round(($Motor58 / $dataMotor->Target_Rosok) * 100);
      $TargetBannangsta_MT = round(($Motor59 / $dataMotor->Target_Bannangsta) * 100);
      $TargetYaha_MT = round(($Motor60 / $dataMotor->Target_Yaha) * 100);
    @endphp
  @endif

  <div class="content-header text-xs">
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
                        <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm pr-3"/>
                        ถึงวันที่ :
                        <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm"/>&nbsp;
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
              <div class="col-md-12">
                <div class="warpper">
                  <input class="radio" id="one" name="group" type="radio" checked>
                  <input class="radio" id="two" name="group" type="radio">
                  <input class="radio" id="three" name="group" type="radio">
                  <input class="radio" id="four" name="group" type="radio">
                  <input class="radio" id="five" name="group" type="radio">
                  <input class="radio" id="six" name="group" type="radio">
                  <div class="tabs">
                    <label class="tab" id="one-tab" for="one"> เช่าซื้อ </label>
                    <label class="tab" id="two-tab" for="two"> Ploan </label>
                    <label class="tab" id="three-tab" for="three"> Micro </label>
                    <label class="tab" id="four-tab" for="four"> มอเตอร์ไซค์ </label>
                    <label class="tab" id="five-tab" for="five"> พนักงาน </label>
                    <label class="tab" id="six-tab" for="six"> รถบ้าน </label>
                  </div>
                  <div class="panels">
                    <div class="panel" id="one-panel">
                      <div class="row mb-1">
                        <section class="col-lg-8 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartLeasingPercent"></div>
                          </div>
                        </section>
                        <section class="col-lg-4 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartLeasingTarget"></div>
                          </div>
                        </section>
                        <section class="col-lg-12 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartLeasingCash"></div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="panel" id="two-panel">
                      <div class="row mb-1">
                        <section class="col-lg-8 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartPloanPercent"></div>
                          </div>
                        </section>
                        <section class="col-lg-4 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartPloanTarget"></div>
                          </div>
                        </section>
                        <section class="col-lg-12 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartPloanCash"></div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="panel" id="three-panel">
                      <div class="row mb-1">
                        <section class="col-lg-8 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMicroPercent"></div>
                          </div>
                        </section>
                        <section class="col-lg-4 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMicroTarget"></div>
                          </div>
                        </section>
                        <section class="col-lg-12 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMicroCash"></div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="panel" id="four-panel">
                      <div class="row mb-1">
                        <section class="col-lg-8 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMotorPercent"></div>
                          </div>
                        </section>
                        <section class="col-lg-4 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMotorTarget"></div>
                          </div>
                        </section>
                        <section class="col-lg-12 connectedSortable ui-sortable">
                          <div class="col-md-12 card">
                            <div id="chartMotorCash"></div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="panel" id="five-panel">
                      <div class="panel-title">Staff Coming Soon...</div>
                    </div>
                    <div class="panel" id="six-panel">
                      <div class="panel-title">Homecar Coming Soon...</div>
                    </div>
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

  {{-- เช่าซื้อ ยอดจัด --}}
  <script>
    var Totalprice = addCommas({{$SumTopcar_LeasingAll}});
    var options = {
      series: [{
        data: [0,{{$Topcar_Leasing01}}, {{$Topcar_Leasing03}}, {{$Topcar_Leasing04}}, {{$Topcar_Leasing05}}, {{$Topcar_Leasing06}}, {{$Topcar_Leasing07}}, {{$Topcar_Leasing08}}, {{$Topcar_Leasing09}}, {{$Topcar_Leasing12}}, {{$Topcar_Leasing13}}, {{$Topcar_Leasing14}}]
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
      categories: ["","ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartLeasingCash"), options);
    chart.render();
  </script>

  {{-- เช่าซื้อ ยอดคัน(เป้า)) --}}
  <script>
      var TotalCon = addCommas({{$SumLeasingAll}});
      var options = {
      series: [
        {
          name: "ยอดคัน",
          type: "column",
          color: "#3EA513",
          data: [{{$Leasing01}}, {{$Leasing03}}, {{$Leasing04}}, {{$Leasing05}}, {{$Leasing06}}, {{$Leasing07}}, {{$Leasing08}}, {{$Leasing09}}, {{$Leasing12}}, {{$Leasing13}}, {{$Leasing14}}]
        },
        {
          name: "ยอดเป้า",
          type: "line",
          color: "#FB2108",
          data: [
                 {{($dataLeasing != '') ?$dataLeasing->Target_Pattani: 0 }},
                 {{($dataLeasing != '') ?$dataLeasing->Target_Yala: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Narathiwat: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Saiburi: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Kolok: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Betong: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Kophor: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Tanyongmas: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Rosok: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Bannangsta: 0 }}, 
                 {{($dataLeasing != '') ?$dataLeasing->Target_Yaha: 0 }},
                 ]
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
        "ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"
      ],
      xaxis: {
        type: "text"
      },
    };

    var chart = new ApexCharts(document.querySelector("#chartLeasingPercent"), options);
    chart.render();

  </script>

  {{-- เช่าซื้อ ยอดคัน(%) --}}
  <script>
    var TotalCon = addCommas({{$SumLeasingAll}});
    var options = {
      series: [{
      name: 'ผลงาน',
      data: [
              {{(@$TargetPattani_LS != '') ?$TargetPattani_LS: 0 }},
              {{(@$TargetYala_LS != '') ?$TargetYala_LS: 0 }},
              {{(@$TargetNara_LS != '') ?$TargetNara_LS: 0 }},
              {{(@$TargetSaiburi_LS != '') ?$TargetSaiburi_LS: 0 }},
              {{(@$TargetKolok_LS != '') ?$TargetKolok_LS: 0 }},
              {{(@$TargetBetong_LS != '') ?$TargetBetong_LS: 0 }},
              {{(@$TargetKophor_LS != '') ?$TargetKophor_LS: 0 }},
              {{(@$TargetTanyongmas_LS != '') ?$TargetTanyongmas_LS: 0 }},
              {{(@$TargetRosok_LS != '') ?$TargetRosok_LS: 0 }},
              {{(@$TargetBannangsta_LS != '') ?$TargetBannangsta_LS: 0 }},
              {{(@$TargetYaha_LS != '') ?$TargetYaha_LS: 0 }}
            ]
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
        distributed: true,
      },
    },
    legend: {
      show: false
    },
    colors: ['#FF3200'],
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

    var chart = new ApexCharts(document.querySelector("#chartLeasingTarget"), options);
    chart.render();
  </script>

  {{-- Ploan ยอดจัด --}}
  <script>
    var Totalprice = addCommas({{$SumTopcar_PloanAll}});
    var options = {
      series: [{
        data: [0,{{$Topcar_Ploan50}}, {{$Topcar_Ploan51}}, {{$Topcar_Ploan52}}, {{$Topcar_Ploan53}}, {{$Topcar_Ploan54}}, {{$Topcar_Ploan55}}, {{$Topcar_Ploan56}}, {{$Topcar_Ploan57}}, {{$Topcar_Ploan58}}, {{$Topcar_Ploan59}}, {{$Topcar_Ploan60}}]
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
      categories: ["","ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartPloanCash"), options);
    chart.render();
  </script>

  {{-- Ploan ยอดคัน(เป้า)) --}}
  <script>
      var TotalCon = addCommas({{$SumPloanAll}});
      var options = {
      series: [
        {
          name: "ยอดคัน",
          type: "column",
          color: "#3EA513",
          data: [{{$Ploan50}}, {{$Ploan51}}, {{$Ploan52}}, {{$Ploan53}}, {{$Ploan54}}, {{$Ploan55}}, {{$Ploan56}}, {{$Ploan57}}, {{$Ploan58}}, {{$Ploan59}}, {{$Ploan60}}]
        },
        {
          name: "ยอดเป้า",
          type: "line",
          color: "#FB2108",
          data: [
                 {{($dataPloan != '') ?$dataPloan->Target_Pattani: 0 }},
                 {{($dataPloan != '') ?$dataPloan->Target_Yala: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Narathiwat: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Saiburi: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Kolok: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Betong: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Kophor: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Tanyongmas: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Rosok: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Bannangsta: 0 }}, 
                 {{($dataPloan != '') ?$dataPloan->Target_Yaha: 0 }},
                 ]
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
        "ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"
      ],
      xaxis: {
        type: "text"
      },
    };

    var chart = new ApexCharts(document.querySelector("#chartPloanPercent"), options);
    chart.render();

  </script>

  {{-- Ploan ยอดคัน(%) --}}
  <script>
    var TotalCon = addCommas({{$SumPloanAll}});
    var options = {
      series: [{
      name: 'ผลงาน',
      data: [
              {{(@$TargetPattani_PL != '') ?$TargetPattani_PL: 0 }},
              {{(@$TargetYala_PL != '') ?$TargetYala_PL: 0 }},
              {{(@$TargetNara_PL != '') ?$TargetNara_PL: 0 }},
              {{(@$TargetSaiburi_PL != '') ?$TargetSaiburi_PL: 0 }},
              {{(@$TargetKolok_PL != '') ?$TargetKolok_PL: 0 }},
              {{(@$TargetBetong_PL != '') ?$TargetBetong_PL: 0 }},
              {{(@$TargetKophor_PL != '') ?$TargetKophor_PL: 0 }},
              {{(@$TargetTanyongmas_PL != '') ?$TargetTanyongmas_PL: 0 }},
              {{(@$TargetRosok_PL != '') ?$TargetRosok_PL: 0 }},
              {{(@$TargetBannangsta_PL != '') ?$TargetBannangsta_PL: 0 }},
              {{(@$TargetYaha_PL != '') ?$TargetYaha_PL: 0 }}
            ]
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
        distributed: true,
      },
    },
    legend: {
      show: false
    },
    colors: ['#FF3200'],
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

    var chart = new ApexCharts(document.querySelector("#chartPloanTarget"), options);
    chart.render();
  </script>

  {{-- Micro ยอดจัด --}}
  <script>
    var Totalprice = addCommas({{$SumTopcar_MicroAll}});
    var options = {
      series: [{
        data: [0,{{$Topcar_Micro50}}, {{$Topcar_Micro51}}, {{$Topcar_Micro52}}, {{$Topcar_Micro53}}, {{$Topcar_Micro54}}, {{$Topcar_Micro55}}, {{$Topcar_Micro56}}, {{$Topcar_Micro57}}, {{$Topcar_Micro58}}, {{$Topcar_Micro59}}, {{$Topcar_Micro60}}]
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
      categories: ["","ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartMicroCash"), options);
    chart.render();
  </script>

  {{-- Micro ยอดคัน(เป้า)) --}}
  <script>
      var TotalCon = addCommas({{$SumMicroAll}});
      var options = {
      series: [
        {
          name: "ยอดคัน",
          type: "column",
          color: "#3EA513",
          data: [{{$Micro50}}, {{$Micro51}}, {{$Micro52}}, {{$Micro53}}, {{$Micro54}}, {{$Micro55}}, {{$Micro56}}, {{$Micro57}}, {{$Micro58}}, {{$Micro59}}, {{$Micro60}}]
        },
        {
          name: "ยอดเป้า",
          type: "line",
          color: "#FB2108",
          data: [
                 {{($dataMicro != '') ?$dataMicro->Target_Pattani: 0 }},
                 {{($dataMicro != '') ?$dataMicro->Target_Yala: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Narathiwat: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Saiburi: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Kolok: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Betong: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Kophor: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Tanyongmas: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Rosok: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Bannangsta: 0 }}, 
                 {{($dataMicro != '') ?$dataMicro->Target_Yaha: 0 }},
                 ]
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
        "ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"
      ],
      xaxis: {
        type: "text"
      },
    };

    var chart = new ApexCharts(document.querySelector("#chartMicroPercent"), options);
    chart.render();

  </script>

  {{-- Micro ยอดคัน(%) --}}
  <script>
    var TotalCon = addCommas({{$SumMicroAll}});
    var options = {
      series: [{
      name: 'ผลงาน',
      data: [
              {{(@$TargetPattani_MC != '') ?$TargetPattani_MC: 0 }},
              {{(@$TargetYala_MC != '') ?$TargetYala_MC: 0 }},
              {{(@$TargetNara_MC != '') ?$TargetNara_MC: 0 }},
              {{(@$TargetSaiburi_MC != '') ?$TargetSaiburi_MC: 0 }},
              {{(@$TargetKolok_MC != '') ?$TargetKolok_MC: 0 }},
              {{(@$TargetBetong_MC != '') ?$TargetBetong_MC: 0 }},
              {{(@$TargetKophor_MC != '') ?$TargetKophor_MC: 0 }},
              {{(@$TargetTanyongmas_MC != '') ?$TargetTanyongmas_MC: 0 }},
              {{(@$TargetRosok_MC != '') ?$TargetRosok_MC: 0 }},
              {{(@$TargetBannangsta_MC != '') ?$TargetBannangsta_MC: 0 }},
              {{(@$TargetYaha_MC != '') ?$TargetYaha_MC: 0 }}
            ]
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
        distributed: true,
      },
    },
    legend: {
      show: false
    },
    colors: ['#FF3200'],
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

    var chart = new ApexCharts(document.querySelector("#chartMicroTarget"), options);
    chart.render();
  </script>

  {{-- Motor ยอดจัด --}}
  <script>
    var Totalprice = addCommas({{$SumTopcar_MotorAll}});
    var options = {
      series: [{
        data: [0,{{$Topcar_Motor50}}, {{$Topcar_Motor51}}, {{$Topcar_Motor52}}, {{$Topcar_Motor53}}, {{$Topcar_Motor54}}, {{$Topcar_Motor55}}, {{$Topcar_Motor56}}, {{$Topcar_Motor57}}, {{$Topcar_Motor58}}, {{$Topcar_Motor59}}, {{$Topcar_Motor60}}]
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
      categories: ["","ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"],
    },
    };

    var chart = new ApexCharts(document.querySelector("#chartMotorCash"), options);
    chart.render();
  </script>

  {{-- Motor ยอดคัน(เป้า)) --}}
  <script>
      var TotalCon = addCommas({{$SumMotorAll}});
      var options = {
      series: [
        {
          name: "ยอดคัน",
          type: "column",
          color: "#3EA513",
          data: [{{$Motor50}}, {{$Motor51}}, {{$Motor52}}, {{$Motor53}}, {{$Motor54}}, {{$Motor55}}, {{$Motor56}}, {{$Motor57}}, {{$Motor58}}, {{$Motor59}}, {{$Motor60}}]
        },
        {
          name: "ยอดเป้า",
          type: "line",
          color: "#FB2108",
          data: [
                 {{($dataMotor != '') ?$dataMotor->Target_Pattani: 0 }},
                 {{($dataMotor != '') ?$dataMotor->Target_Yala: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Narathiwat: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Saiburi: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Kolok: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Betong: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Kophor: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Tanyongmas: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Rosok: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Bannangsta: 0 }}, 
                 {{($dataMotor != '') ?$dataMotor->Target_Yaha: 0 }},
                 ]
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
        "ปัตตานี", "ยะลา", "นราธิวาส", "สายบุรี", "โกลก", "เบตง", "โคกโพธิ์", "ตันหยงมัส", "รือเสาะ", "บันนังสตา", "ยะหา"
      ],
      xaxis: {
        type: "text"
      },
    };

    var chart = new ApexCharts(document.querySelector("#chartMotorPercent"), options);
    chart.render();

  </script>

  {{-- Motor ยอดคัน(%) --}}
  <script>
    var TotalCon = addCommas({{$SumMotorAll}});
    var options = {
      series: [{
      name: 'ผลงาน',
      data: [
              {{(@$TargetPattani_MT != '') ?$TargetPattani_MT: 0 }},
              {{(@$TargetYala_MT != '') ?$TargetYala_MT: 0 }},
              {{(@$TargetNara_MT != '') ?$TargetNara_MT: 0 }},
              {{(@$TargetSaiburi_MT != '') ?$TargetSaiburi_MT: 0 }},
              {{(@$TargetKolok_MT != '') ?$TargetKolok_MT: 0 }},
              {{(@$TargetBetong_MT != '') ?$TargetBetong_MT: 0 }},
              {{(@$TargetKophor_MT != '') ?$TargetKophor_MT: 0 }},
              {{(@$TargetTanyongmas_MT != '') ?$TargetTanyongmas_MT: 0 }},
              {{(@$TargetRosok_MT != '') ?$TargetRosok_MT: 0 }},
              {{(@$TargetBannangsta_MT != '') ?$TargetBannangsta_MT: 0 }},
              {{(@$TargetYaha_MT != '') ?$TargetYaha_MT: 0 }}
            ]
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
        distributed: true,
      },
    },
    legend: {
      show: false
    },
    colors: ['#FF3200'],
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

    var chart = new ApexCharts(document.querySelector("#chartMotorTarget"), options);
    chart.render();
  </script>


@endsection
