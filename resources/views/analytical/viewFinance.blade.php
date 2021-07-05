@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="{{ asset('css/pluginAnalytical.css') }}">

  <style>
    div {
      box-sizing: border-box;
      transition: all ease-in-out .5s;
      -moz-transition: all ease-in-out .5s;
      -webkit-transition: all ease-in-out .5s;
    }
    .icetab {
      border: 2px solid #ff9900;
      display: inline-block; 
      border-bottom: 0px;	
      margin: 0px;	
      color: #fff;
      cursor: pointer;
      border-right: 0px;
    }
    .icetab:last-child {
      border-right: 2px solid #ff9900;	
    }

    #icetab-content {
      overflow: hidden;
      position: relative;
      border-top: 0px solid #ff9900;
      box-shadow:0 3px 10px rgba(0,0,0,.3);
    }
    .box-shadow {
      padding: 10px;
      box-shadow:0 3px 10px rgba(0,0,0,.3);
    }
    .tabcontent {
      position: absolute;
      left: 0px;
      top: 0px;
      background: #fff;
      width: 100%;
      border-top: 0px;
      border: 2px solid #dad9d7;
      border-top: 0px;
      transform: translateY(-100%);
      -moz-transform: translateY(-100%);
      -webkit-transform: translateY(-100%);
    }

    .tabcontent:first-child {
      position: relative;	
    }
    .tabcontent.tab-active {
      border-top: 0px;
      display: block;
      transform: translateY(0%);
      -moz-transform: translateY(0%);
      -webkit-transform: translateY(0%);
    }


    /* A tiny wee bit of visual formating */
    .codepen-container {
      max-width: 100%;
      margin: 25px;
      /* margin-left: auto; */
      /* margin-right: auto; */
    }
    .title {
      color: #ff9900;
      text-align: center;
      letter-spacing: 14px;
      text-transform: uppercase;
      font-size: 17px;
      margin: 5px 0px;
      margin-bottom: 40px;
    }
    .tabcontent {
      padding: 20px;
    }
    .icetab {
      padding: 10px;
      text-transform: uppercase;
      letter-spacing: 2px;
      background-color:rgb(248, 221, 185);
      font-size: 12px;
    }
    .current-tab { 
      background: #ff9900;
    }
  </style>

  <!-- Main content -->
  <section class="content">
    <div class="content">
      <h1 class="title">Board Financings</h1>
      <div class="codepen-container row">
        <div class="col-12">
          <div class="float-right form-inline btn-page">
            <form method="get" action="{{ route('MasterAnalytical.index') }}">
              <div class="input-group form-inline">
                <select id="SearchMoth" name="SearchMoth" class="form-control form-control-sm">
                  <option value="">--- เลือกเดือน ---</option>
                  <option value="01" {{ ($SearchMoth === '01') ? 'selected' : '' }}>มกราคม</option>
                  <option value="02" {{ ($SearchMoth === '02') ? 'selected' : '' }}>กุมภาพันธ์</option>
                  <option value="03" {{ ($SearchMoth === '03') ? 'selected' : '' }}>มีนาคม</option>
                  <option value="04" {{ ($SearchMoth === '04') ? 'selected' : '' }}>เมษายน</option>
                  <option value="05" {{ ($SearchMoth === '05') ? 'selected' : '' }}>พฤษภาคม</option>
                  <option value="06" {{ ($SearchMoth === '06') ? 'selected' : '' }}>มิถุนายน</option>
                  <option value="07" {{ ($SearchMoth === '07') ? 'selected' : '' }}>กรกฎาคม</option>
                  <option value="08" {{ ($SearchMoth === '08') ? 'selected' : '' }}>สิงหาคม</option>
                  <option value="09" {{ ($SearchMoth === '09') ? 'selected' : '' }}>กันยายน</option>
                  <option value="10" {{ ($SearchMoth === '10') ? 'selected' : '' }}>ตุลาคม</option>
                  <option value="11" {{ ($SearchMoth === '11') ? 'selected' : '' }}>พฤศจิกายน</option>
                  <option value="12" {{ ($SearchMoth === '12') ? 'selected' : '' }}>ธันวาคม</option>
                </select>
                <span class="input-group-append">
                  <button type="submit" class="btn btn-warning btn-sm button-id mr-sm-1">
                    <i class="fas fa-search"></i>
                  </button>
                </span>
              </div>

              <input type="hidden" name="type" value="2">
            </form>
          </div>
        </div>
      </div>
      <div class="codepen-container row">
        <div class="col-md-12">
          <div class="box-shadow hover-up hover-line">
            <div id="BoardMain"></div>
          </div>
        </div>
      </div>

      <br>
      <h1 class="title">Total Financings</h1>
      <div class="codepen-container row">
        <div class="col-md-6">
          <div id="icetab-container">
            <div class="icetab current-tab">Leasing</div>
            <div class="icetab">Ploan-03</div>
            <div class="icetab">Ploan-04</div>       
            <div class="icetab">Micro-06</div>       
          </div>
          
          <div id="icetab-content">
            <div class="tabcontent tab-active">
              <div id="Leasing"></div>
            </div> 
              <div class="tabcontent">              
                <div id="Ploan_03"></div>
            </div>
              <div class="tabcontent">
                <div id="Ploan_04"></div>
              </div>
              <div class="tabcontent">
                <div id="Micro_06"></div>
              </div>
          </div> 
        </div>
        <div class="col-md-6">
          <div id="icetab-container">
            <div class="icetab current-tab">Total Financings</div>
          </div>
          <div id="icetab-content">
            <div class="tabcontent tab-active">
              <div id="Master01"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  {{-- BoardMain --}}
  <script>
    var options = {
        series: [{
        name: '% ลูกค้าชำระ',
        data: [{{($countPay1+$P03_Pay1+$P04_Pay1+$P06_Pay1)}}, 
                 {{($countPay3+$P03_Pay3+$P04_Pay3+$P06_Pay3)}},
                 {{($countPay4+$P03_Pay4+$P04_Pay4+$P06_Pay4)}}, 
                 {{($countPay5+$P03_Pay5+$P04_Pay5+$P06_Pay5)}}, 
                 {{($countPay6+$P03_Pay6+$P04_Pay6+$P06_Pay6)}}, 
                 {{($countPay7+$P03_Pay7+$P04_Pay7+$P06_Pay7)}},
                 {{($countPay8+$P03_Pay8+$P04_Pay8+$P06_Pay8)}},
                 {{($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9)}},
                 {{($countPay12+$P03_Pay12+$P04_Pay12+$P06_Pay12)}},
                 {{($countPay13+$P03_Pay13+$P04_Pay14+$P06_Pay13)}},
                 {{($countPay14+$P03_Pay14+$P04_Pay14+$P06_Pay14)}}]
      }, {
        name: '% ลูกค้าขาดชำระ',
        data: [{{((count($data1)+$P03_1+$P04_1+$P06_1)) - ($countPay1+$P03_Pay1+$P04_Pay1+$P06_Pay1)}}, 
                 {{((count($data3)+$P03_3+$P04_3+$P06_3)) - ($countPay3+$P03_Pay3+$P04_Pay3+$P06_Pay3)}}, 
                 {{((count($data4)+$P03_4+$P04_4+$P06_4)) - ($countPay4+$P03_Pay4+$P04_Pay4+$P06_Pay4)}}, 
                 {{((count($data5)+$P03_5+$P04_5+$P06_5)) - ($countPay5+$P03_Pay5+$P04_Pay5+$P06_Pay5)}}, 
                 {{((count($data6)+$P03_6+$P04_6+$P06_6)) - ($countPay6+$P03_Pay6+$P04_Pay6+$P06_Pay6)}}, 
                 {{((count($data7)+$P03_7+$P04_7+$P06_7)) - ($countPay7+$P03_Pay7+$P04_Pay7+$P06_Pay7)}},
                 {{((count($data8)+$P03_8+$P04_8+$P06_8)) - ($countPay8+$P03_Pay8+$P04_Pay8+$P06_Pay8)}},
                 {{((count($data9)+$P03_9+$P04_9+$P06_9)) - ($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9)}},
                 {{((count($data12)+$P03_12+$P04_12+$P06_12)) - ($countPay12+$P03_Pay12+$P04_Pay12+$P06_Pay12)}},
                 {{((count($data13)+$P03_13+$P04_13+$P06_13)) - ($countPay13+$P03_Pay13+$P04_Pay14+$P06_Pay13)}},
                 {{((count($data14)+$P03_14+$P04_14+$P06_14)) - ($countPay14+$P03_Pay14+$P04_Pay14+$P06_Pay14)}}]
      }],
      chart: {
        type: 'bar',
        height: 300,
        stacked: true,
        stackType: '100%'
      },
      title: {
        text: 'Board Resource Finances'
      },
      subtitle: {
        text: 'บอร์ดข้อมูลลูกค้าไฟแนนท์ (%)',
        align: 'left'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      responsive: [{
        breakpoint: 480,
        options: {
          legend: {
            position: 'bottom',
            offsetX: -10,
            offsetY: 0
          }
        }
      }],
      xaxis: {
        categories: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      },
      fill: {
        opacity: 1
      },
      colors: ['rgb(9, 209, 166)','rgb(238, 106, 54)'],
      legend: {
        position: 'right',
        offsetX: 0,
        offsetY: 50,
      },
    };

    var BoardMain = new ApexCharts(document.querySelector("#BoardMain"), options);
    BoardMain.render();
  </script>

  {{-- board Master --}}
  <script>
    var options = {
      series: [
        {
          name: 'รวมลูกค้าชำระ',
          type: "column",
          color: "rgb(9, 209, 166)",
          data: [{{($countPay1+$P03_Pay1+$P04_Pay1+$P06_Pay1)}}, 
                 {{($countPay3+$P03_Pay3+$P04_Pay3+$P06_Pay3)}},
                 {{($countPay4+$P03_Pay4+$P04_Pay4+$P06_Pay4)}}, 
                 {{($countPay5+$P03_Pay5+$P04_Pay5+$P06_Pay5)}}, 
                 {{($countPay6+$P03_Pay6+$P04_Pay6+$P06_Pay6)}}, 
                 {{($countPay7+$P03_Pay7+$P04_Pay7+$P06_Pay7)}},
                 {{($countPay8+$P03_Pay8+$P04_Pay8+$P06_Pay8)}},
                 {{($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9)}},
                 {{($countPay12+$P03_Pay12+$P04_Pay12+$P06_Pay12)}},
                 {{($countPay13+$P03_Pay13+$P04_Pay14+$P06_Pay13)}},
                 {{($countPay14+$P03_Pay14+$P04_Pay14+$P06_Pay14)}}]
        }, 
        {
          name: 'รวมลูกค้าค้างชำระ',
          type: "column",
          color: "rgb(238, 106, 54)",
          data: [{{((count($data1)+$P03_1+$P04_1+$P06_1)) - ($countPay1+$P03_Pay1+$P04_Pay1+$P06_Pay1)}}, 
                 {{((count($data3)+$P03_3+$P04_3+$P06_3)) - ($countPay3+$P03_Pay3+$P04_Pay3+$P06_Pay3)}}, 
                 {{((count($data4)+$P03_4+$P04_4+$P06_4)) - ($countPay4+$P03_Pay4+$P04_Pay4+$P06_Pay4)}}, 
                 {{((count($data5)+$P03_5+$P04_5+$P06_5)) - ($countPay5+$P03_Pay5+$P04_Pay5+$P06_Pay5)}}, 
                 {{((count($data6)+$P03_6+$P04_6+$P06_6)) - ($countPay6+$P03_Pay6+$P04_Pay6+$P06_Pay6)}}, 
                 {{((count($data7)+$P03_7+$P04_7+$P06_7)) - ($countPay7+$P03_Pay7+$P04_Pay7+$P06_Pay7)}},
                 {{((count($data8)+$P03_8+$P04_8+$P06_8)) - ($countPay8+$P03_Pay8+$P04_Pay8+$P06_Pay8)}},
                 {{((count($data9)+$P03_9+$P04_9+$P06_9)) - ($countPay9+$P03_Pay9+$P04_Pay9+$P06_Pay9)}},
                 {{((count($data12)+$P03_12+$P04_12+$P06_12)) - ($countPay12+$P03_Pay12+$P04_Pay12+$P06_Pay12)}},
                 {{((count($data13)+$P03_13+$P04_13+$P06_13)) - ($countPay13+$P03_Pay13+$P04_Pay14+$P06_Pay13)}},
                 {{((count($data14)+$P03_14+$P04_14+$P06_14)) - ($countPay14+$P03_Pay14+$P04_Pay14+$P06_Pay14)}}]
        }
      ],
      chart: {
        stacked: true,
        height: 300,
        type: "line"
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Total Product Finances'
      },
      subtitle: {
        text: 'ข้อมูลลูกค้าประจำสาขา (รวม)',
        align: 'left'
      },
      colors: ['rgb(9, 209, 166)','rgb(238, 106, 54)'],
      plotOptions: {
        bar: {
          columnWidth: '60%',
          dataLabels: {
            position: "bottom" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "9px",
        }
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      stroke: {
        width: 0
      },
      labels: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['ลูกค้าชำระ (ราย)', 'ลูกค้าต้องชำระ (ราย)'],
      }
    };

    var Master01 = new ApexCharts(document.querySelector("#Master01"), options);
    Master01.render();
  </script>

  {{-- leasing --}}
  <script>
    var options = {
      series: [
        {
          name: "ลูกค้าชำระ",
          type: "column",
          color: "#00E396",
          data: [
                  {{($countPay1)}},{{($countPay3)}},{{($countPay4)}},{{($countPay5)}},{{($countPay6)}},
                  {{($countPay7)}},{{($countPay8)}},{{($countPay9)}},{{($countPay12)}},{{($countPay13)}},{{($countPay14)}}
                ]
        },
        {
          name: "ลูกค้าต้องชำระ",
          type: "line",
          color: "#775DD0",
          data: [
                  {{(count($data1))}},{{(count($data3))}},{{(count($data4))}},{{(count($data5))}},
                  {{(count($data6))}},{{(count($data7))}},{{(count($data8))}},{{(count($data9))}},
                  {{(count($data12))}},{{(count($data13))}},{{(count($data14))}}
                ]
        }
      ],
      chart: {
        height: 300,
        type: "line"
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: "Board Finances Leasing"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '60%',
          dataLabels: {
            position: "bottom" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "9px",
        }
      },
      stroke: {
        width: 0
      },
      labels: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      legend: {
        position: 'bottom',
        horizontalAlign: 'center',
        offsetX: 40,
        customLegendItems: ['ลูกค้าชำระ (ราย)', 'ลูกค้าต้องชำระ (ราย)'],
        markers: {
          fillColors: ['rgb(9, 209, 166)','rgb(238, 106, 54)']
        }
      }
    };

    var Leasing = new ApexCharts(document.querySelector("#Leasing"), options);
    Leasing.render();
  </script>

  {{-- PLaon-P03 --}}
  <script>
    var options = {
      series: [
        {
          name: "ลูกค้าชำระ",
          type: "column",
          color: "#00E396",
          data: [
                  {{($P03_Pay1)}},{{($P03_Pay3)}},{{($P03_Pay4)}},{{($P03_Pay5)}},{{($P03_Pay6)}},
                  {{($P03_Pay7)}},{{($P03_Pay8)}},{{($P03_Pay9)}},{{($P03_Pay12)}},{{($P03_Pay13)}},{{($P03_Pay14)}}
                ]
        },
        {
          name: "ลูกค้าต้องชำระ",
          type: "line",
          color: "#775DD0",
          data: [
                  {{($P03_1)}},{{($P03_3)}},{{($P03_4)}},{{($P03_5)}},
                  {{($P03_6)}},{{($P03_7)}},{{($P03_8)}},{{($P03_9)}},
                  {{($P03_12)}},{{($P03_13)}},{{($P03_14)}}
                ]
        }
      ],
      chart: {
        height: 300,
        type: "line"
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: "Board Finances PLaon-P03"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '60%',
          dataLabels: {
            position: "bottom" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "9px",
        }
      },
      stroke: {
        width: 0
      },
      labels: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['ลูกค้าชำระ (ราย)', 'ลูกค้าต้องชำระ (ราย)'],
      }
    };

    var Ploan_03 = new ApexCharts(document.querySelector("#Ploan_03"), options);
    Ploan_03.render();
  </script>

  {{-- PLaon-P04 --}}
  <script>
    var options = {
      series: [
        {
          name: "ลูกค้าชำระ",
          type: "column",
          color: "#00E396",
          data: [
                  {{($P04_Pay1)}},{{($P04_Pay3)}},{{($P04_Pay4)}},{{($P04_Pay5)}},{{($P04_Pay6)}},
                  {{($P04_Pay7)}},{{($P04_Pay8)}},{{($P04_Pay9)}},{{($P04_Pay12)}},{{($P04_Pay13)}},{{($P04_Pay14)}}
                ]
        },
        {
          name: "ลูกค้าต้องชำระ",
          type: "line",
          color: "#775DD0",
          data: [
                  {{($P04_1)}},{{($P04_3)}},{{($P04_4)}},{{($P04_5)}},
                  {{($P04_6)}},{{($P04_7)}},{{($P04_8)}},{{($P04_9)}},
                  {{($P04_12)}},{{($P04_13)}},{{($P04_14)}}
                ]
        }
      ],
      chart: {
        height: 300,
        type: "line"
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: "Board Finances PLaon-P04"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '60%',
          dataLabels: {
            position: "bottom" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "9px",
        }
      },
      stroke: {
        width: 0
      },
      labels: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['ลูกค้าชำระ (ราย)', 'ลูกค้าต้องชำระ (ราย)'],
      }
    };

    var Ploan_04 = new ApexCharts(document.querySelector("#Ploan_04"), options);
    Ploan_04.render();
  </script>

  {{-- Micro-P06 --}}
  <script>
    var options = {
      series: [
        {
          name: "ลูกค้าชำระ",
          type: "column",
          color: "#00E396",
          data: [
                  {{($P06_Pay1)}},{{($P06_Pay3)}},{{($P06_Pay4)}},{{($P06_Pay5)}},{{($P06_Pay6)}},
                  {{($P06_Pay7)}},{{($P06_Pay8)}},{{($P06_Pay9)}},{{($P06_Pay12)}},{{($P06_Pay13)}},{{($P06_Pay14)}}
                ]
        },
        {
          name: "ลูกค้าต้องชำระ",
          type: "line",
          color: "#775DD0",
          data: [
                  {{($P06_1)}},{{($P06_3)}},{{($P06_4)}},{{($P06_5)}},
                  {{($P06_6)}},{{($P06_7)}},{{($P06_8)}},{{($P06_9)}},
                  {{($P06_12)}},{{($P06_13)}},{{($P06_14)}}
                ]
        }
      ],
      chart: {
        height: 300,
        type: "line"
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: "Board Finances Micro-P06"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " ราย"
          }
        }
      },
      plotOptions: {
        bar: {
          columnWidth: '60%',
          dataLabels: {
            position: "bottom" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "9px",
        }
      },
      stroke: {
        width: 0
      },
      labels: ['ปัตตานี', 'ยะลา', 'นราธิวาส','สายบุรี', 'โกลก','เบตง', 'โคกโพธิ์', 'ตันหยงมัส', 'รือเสาะ', 'บันนังสตา', 'ยะหา'],
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['ลูกค้าชำระ (ราย)', 'ลูกค้าต้องชำระ (ราย)'],
      }
    };

    var Micro_06 = new ApexCharts(document.querySelector("#Micro_06"), options);
    Micro_06.render();
  </script>

  {{-- Actives Tabs --}}
  <script>
    var tabs = document.getElementById('icetab-container').children;
    var tabcontents = document.getElementById('icetab-content').children;

    var myFunction = function() {
      var tabchange = this.mynum;
      for(var int=0;int<tabcontents.length;int++){
        tabcontents[int].className = ' tabcontent';
        tabs[int].className = ' icetab';
      }
      tabcontents[tabchange].classList.add('tab-active');
      this.classList.add('current-tab');
    }	

    for(var index=0;index<tabs.length;index++){
      tabs[index].mynum=index;
      tabs[index].addEventListener('click', myFunction, false);
    }
  </script>
@endsection
