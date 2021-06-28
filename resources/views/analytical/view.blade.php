@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="{{ asset('css/pluginHome.css') }}">

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
      <div class="row">
        <div class="col-md-6">
          <div id="Master01"></div>
        </div>
        <div class="col-md-6">
          <div id="Master02"></div>
        </div>
      </div>

      <h1 class="title">FanTabulous</h1>
      <div class="codepen-container">
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
    </div>
  </section>

  <script>
    var options = {
        series: [
        {
          name: 'Actual',
          data: [
            {
              x: '2011',
              y: 12,
              goals: [
                {
                  name: 'Expected',
                  value: 14,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            },
            {
              x: '2012',
              y: 44,
              goals: [
                {
                  name: 'Expected',
                  value: 54,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            },
            {
              x: '2013',
              y: 54,
              goals: [
                {
                  name: 'Expected',
                  value: 52,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            },
            {
              x: '2014',
              y: 66,
              goals: [
                {
                  name: 'Expected',
                  value: 65,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            },
            {
              x: '2015',
              y: 81,
              goals: [
                {
                  name: 'Expected',
                  value: 66,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            },
            {
              x: '2016',
              y: 67,
              goals: [
                {
                  name: 'Expected',
                  value: 70,
                  strokeWidth: 5,
                  strokeColor: '#775DD0'
                }
              ]
            }
          ]
        }
      ],
        chart: {
        height: 350,
        stacked: true,
        type: 'bar'
      },
      plotOptions: {
        bar: {
          horizontal: true,
        }
      },
      colors: ['#00E396'],
      dataLabels: {
        formatter: function(val, opt) {
          const goals =
            opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
              .goals
      
          if (goals && goals.length) {
            return `${val} / ${goals[0].value}`
          }
          return val
        }
      },
      legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: ['Actual', 'Expected'],
        markers: {
          fillColors: ['#00E396', '#775DD0']
        }
      }
    };

    var Master01 = new ApexCharts(document.querySelector("#Master01"), options);
    Master01.render();
  </script>

  <script>
      var options = {
        series: [{
          name: 'LEASING',
          data: [{{$SumF01}}, 55, 41, 67, 22, 43]
        }, {
          name: 'PLOAN-03',
          data: [13, 23, 20, 8, 13, 27]
        }, {
          name: 'PLOAN-04',
          data: [11, 17, 15, 15, 21, 14]
        }, {
          name: 'MICRO-06',
          data: [21, 7, 25, 13, 22, 8]
        }],
        chart: {
          type: 'bar',
          height: 300,
          stacked: true,
          toolbar: {
            show: true
          },
          zoom: {
            enabled: true
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
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 5
          },
        },
        xaxis: {
          // type: 'datetime',
          categories: ['Master PN', 'Master YL', 'Master NW'],
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
      };

      var Master02 = new ApexCharts(document.querySelector("#Master02"), options);
      Master02.render();
  </script>


  {{-- leasing --}}
  <script>
    var options = {
      series: [
        {
          // ข้อมูล
          name: "ลูกค้ามาชำระ (ราย)",
          type: "column",
          color: "#00E396",
          data: [{{$countPay1}}, {{$countPay3}}, {{$countPay4}}, {{$countPay5}}, {{$countPay6}}, {{$countPay7}}, {{$countPay8}}, {{$countPay9}}, {{$countPay12}}, {{$countPay13}}, {{$countPay14}}]
        },
        {
          // เป้าหมาย
          name: "ลูกค้าต้องมาชำระ (ราย)",
          type: "line",
          color: "#775DD0",
          offsetY: 100,
          data: [{{count($data1)}}, {{count($data3)}}, {{count($data4)}}, {{count($data5)}}, {{count($data6)}}, {{count($data7)}}, {{count($data8)}}, {{count($data9)}}, {{count($data12)}}, {{count($data13)}}, {{count($data14)}}]
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
        text: "Board Cases Leasing"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "center" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "10px",
        }
      },
      stroke: {
            width: 0
          },
      labels: [
        "ปัตตานี",
        "ยะลา",
        "นราธิวาส",
        "สายบุรี",
        "โกลก",
        "เบตง",
        "โคกโพธิ์",
        "ตันหยงมัส",
        "รือเสาะ",
        "บันนังสตา",
        "ยะหา",
      ],
      // xaxis: {
      //   type: "datetime"
      // },
      // yaxis: [
      //   {
      //     title: {
      //       text: "Website Blog"
      //     }
      //   },
      //   {
      //     opposite: true,
      //     title: {
      //       text: "Social Media"
      //     }
      //   }
      // ]
    };

    var Leasing = new ApexCharts(document.querySelector("#Leasing"), options);
    Leasing.render();
  </script>

  {{-- PLaon-P03 --}}
  <script>
    var options = {
      series: [
        {
          // ข้อมูล
          name: "ลูกค้ามาชำระ (ราย)",
          type: "column",
          color: "#00E396",
          data: [{{$P03_Pay1}}, {{$P03_Pay3}}, {{$P03_Pay4}}, {{$P03_Pay5}}, {{$P03_Pay6}}, {{$P03_Pay7}}, {{$P03_Pay8}}, {{$P03_Pay9}}, {{$P03_Pay12}}, {{$P03_Pay13}}, {{$P03_Pay14}}]
        },
        {
          // เป้าหมาย
          name: "ลูกค้าต้องมาชำระ (ราย)",
          type: "line",
          color: "#775DD0",
          offsetY: 100,
          data: [{{($P03_1)}}, {{($P03_3)}}, {{($P03_4)}}, {{($P03_5)}}, {{($P03_6)}}, {{($P03_7)}}, {{($P03_8)}}, {{($P03_9)}}, {{($P03_12)}}, {{($P03_13)}}, {{($P03_14)}}]
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
        text: "Board Cases Ploan-P03"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "center" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "10px",
        }
      },
      stroke: {
            width: 0
          },
      labels: [
        "ปัตตานี",
        "ยะลา",
        "นราธิวาส",
        "สายบุรี",
        "โกลก",
        "เบตง",
        "โคกโพธิ์",
        "ตันหยงมัส",
        "รือเสาะ",
        "บันนังสตา",
        "ยะหา",
      ],
    };

    var Ploan_03 = new ApexCharts(document.querySelector("#Ploan_03"), options);
    Ploan_03.render();
  </script>

  {{-- PLaon-P04 --}}
  <script>
    var options = {
      series: [
        {
          // ข้อมูล
          name: "ลูกค้ามาชำระ (ราย)",
          type: "column",
          color: "#00E396",
          data: [{{$P04_Pay1}}, {{$P04_Pay3}}, {{$P04_Pay4}}, {{$P04_Pay5}}, {{$P04_Pay6}}, {{$P04_Pay7}}, {{$P04_Pay8}}, {{$P04_Pay9}}, {{$P04_Pay12}}, {{$P04_Pay13}}, {{$P04_Pay14}}]
        },
        {
          // เป้าหมาย
          name: "ลูกค้าต้องมาชำระ (ราย)",
          type: "line",
          color: "#775DD0",
          offsetY: 100,
          data: [{{($P04_1)}}, {{($P04_3)}}, {{($P04_4)}}, {{($P04_5)}}, {{($P04_6)}}, {{($P04_7)}}, {{($P04_8)}}, {{($P04_9)}}, {{($P04_12)}}, {{($P04_13)}}, {{($P04_14)}}]
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
        text: "Board Cases Ploan-P04"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "center" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "10px",
        }
      },
      stroke: {
            width: 0
          },
      labels: [
        "ปัตตานี",
        "ยะลา",
        "นราธิวาส",
        "สายบุรี",
        "โกลก",
        "เบตง",
        "โคกโพธิ์",
        "ตันหยงมัส",
        "รือเสาะ",
        "บันนังสตา",
        "ยะหา",
      ],
    };

    var Ploan_04 = new ApexCharts(document.querySelector("#Ploan_04"), options);
    Ploan_04.render();
  </script>

  {{-- Micro-P06 --}}
  <script>
    var options = {
      series: [
        {
          // ข้อมูล
          name: "ลูกค้ามาชำระ (ราย)",
          type: "column",
          color: "#00E396",
          data: [{{$P06_Pay1}}, {{$P06_Pay3}}, {{$P06_Pay4}}, {{$P06_Pay5}}, {{$P06_Pay6}}, {{$P06_Pay7}}, {{$P06_Pay8}}, {{$P06_Pay9}}, {{$P06_Pay12}}, {{$P06_Pay13}}, {{$P06_Pay14}}]
        },
        {
          // เป้าหมาย
          name: "ลูกค้าต้องมาชำระ (ราย)",
          type: "line",
          color: "#775DD0",
          offsetY: 100,
          data: [{{($P06_1)}}, {{($P06_3)}}, {{($P06_4)}}, {{($P06_5)}}, {{($P06_6)}}, {{($P06_7)}}, {{($P06_8)}}, {{($P06_9)}}, {{($P06_12)}}, {{($P06_13)}}, {{($P06_14)}}]
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
        text: "Board Cases Micro-P06"
      },
      subtitle: {
        text: 'Cases Movements',
        align: 'left'
      },
      plotOptions: {
        bar: {
          dataLabels: {
            position: "center" // top, center, bottom
          }
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return val;
        },
        style: {
          fontSize: "10px",
        }
      },
      stroke: {
            width: 0
          },
      labels: [
        "ปัตตานี",
        "ยะลา",
        "นราธิวาส",
        "สายบุรี",
        "โกลก",
        "เบตง",
        "โคกโพธิ์",
        "ตันหยงมัส",
        "รือเสาะ",
        "บันนังสตา",
        "ยะหา",
      ],
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
