@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
@endphp


  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 align="center"><b>รายการ {{ $title }}</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12">

                <form method="get" action="{{ route('report',$type) }}">
                  <div align="right" class="form-inline">
                    @if($type != 3)
                      <button type="submit" class="btn btn-warning btn-app">
                      <span class="glyphicon glyphicon-search"></span> Search
                      </button>
                    @endif
                    <a target="_blank" href="{{ action('ReportController@ReportStockcar') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}" class="btn btn-primary btn-app">
                    <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                    </a>
                  </div>

                  @if($type != 3)
                  <br />
                  <div align="right" class="form-inline">
                    <label>จากวันที่ : </label>
                    <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: $date }}" class="form-control" />

                    <label>ถึงวันที่ : </label>
                    <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: $date }}" class="form-control" />
                  </div>
                  @endif
                </form>

              <div class="table-responsive">
                <table class="table table-bordered" id="table">
                  @if($type == 3)
                    <thead class="thead-dark bg-gray-light" >
                      <br>
                      <tr>
                        <th class="text-center" style="width: 120px">วันที่ซื้อ</th>
                        <th class="text-center" style="width: 220px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 150px">ยี่ห้อ</th>
                        <th class="text-center" style="width: 150px">รุ่น</th>
                        <th class="text-center" style="width: 150px">ลักษณะ</th>
                        <th class="text-center" style="width: 150px">ที่มา</th>
                        <th class="text-center" style="width: 150px">สถานะ</th>
                      </tr>
                    </thead>
                  @endif

                  @if($type == 4)
                    <thead class="thead-dark bg-gray-light" >
                      <br>
                      <tr>
                        <th class="text-center" style="width: 120px">วันทีหมดอายุบัตร</th>
                        <th class="text-center" style="width: 220px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 150px">ยี่ห้อ</th>
                        <th class="text-center" style="width: 150px">รุ่น</th>
                        <th class="text-center" style="width: 150px">ลักษณะ</th>
                        <th class="text-center" style="width: 150px">ที่มา</th>
                        <th class="text-center" style="width: 150px">สถานะ</th>
                      </tr>
                    </thead>
                  @endif

                  @if($type == 5)
                    <thead class="thead-dark bg-gray-light" >
                      <br>
                      <tr>
                        <th class="text-center" style="width: 120px">วันที่ซื้อ</th>
                        <th class="text-center" style="width: 150px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 150px">ยี่ห้อ</th>
                        <th class="text-center" style="width: 150px">รุ่น</th>
                        <th class="text-center" style="width: 150px">ลักษณะ</th>
                        <th class="text-center" style="width: 150px">สี</th>
                        <th class="text-center" style="width: 50px">ซีซี</th>
                        <th class="text-center" style="width: 150px">ราคาซื้อ</th>
                        <th class="text-center" style="width: 100px">ต้นทุนบัญชี</th>
                        <th class="text-center" style="width: 150px">สถานะ</th>

                      </tr>
                    </thead>
                  @endif

                  @if($type == 6)
                    <thead class="thead-dark bg-gray-light" >
                      <br>
                      <tr>
                        <th class="text-center" style="width: 120px">วันที่ขาย</th>
                        <th class="text-center" style="width: 150px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 150px">ยี่ห้อ</th>
                        <th class="text-center" style="width: 150px">รุ่น</th>
                        <th class="text-center" style="width: 130px">ราคาซื้อ</th>
                        <th class="text-center" style="width: 130px">ราคาต้นทุน</th>
                        <th class="text-center" style="width: 130px">ราคาขาย</th>
                        <th class="text-center" style="width: 130px">ราคาหัก VAT</th>
                        <th class="text-center" style="width: 130px">กำไรขาดทุน</th>
                        <th class="text-center" style="width: 100px">ประเภท</th>
                        <th class="text-center" style="width: 100px">สถานะ</th>

                      </tr>
                    </thead>
                  @endif

                  @if($type == 3)
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          <td class="text-center">
                            @php
                              $create_date = date_create($row->create_date);
                            @endphp
                            {{ date_format($create_date, 'd-m-Y')}}
                          </td>
                          <td class="text-center">{{$row->Number_Regist}}</td>
                          <td class="text-center">{{$row->Brand_Car}}</td>
                          <td class="text-center">{{$row->Version_Car}}</td>
                          <td class="text-center">{{$row->Model_Car}}</td>
                          <td class="text-center">
                            @if($row->Origin_Car == 1 )
                              CKL
                            @elseif($row->Origin_Car == 2 )
                              รถประมูล
                            @elseif($row->Origin_Car == 3 )
                              รถยึด
                            @elseif($row->Origin_Car == 4 )
                              รถฝากขาย
                            @endif
                          </td>

                          <td class="text-center">
                            @if($row->Car_type == 1)
                              นำเข้าใหม่
                            @elseif ($row->Car_type  == 2)
                              ระหว่างทำสี
                            @elseif ($row->Car_type  == 3)
                              รอซ่อม
                            @elseif ($row->Car_type  == 4)
                              ระหว่างซ่อม
                            @elseif ($row->Car_type  == 5)
                              พร้อมขาย
                            @elseif ($row->Car_type  == 6)
                              ขายแล้ว
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  @endif

                  @if($type == 4)
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          <td class="text-center">
                            @php
                              $Date_Num = date_create($row->Date_NumberUser);
                            @endphp
                            {{ date_format($Date_Num, 'd-m-Y')}}
                          </td>
                          <td class="text-center">{{$row->Number_Regist}}</td>
                          <td class="text-center">{{$row->Brand_Car}}</td>
                          <td class="text-center">{{$row->Version_Car}}</td>
                          <td class="text-center">{{$row->Model_Car}}</td>
                          <td class="text-center">
                            @if($row->Origin_Car == 1 )
                              CKL
                            @elseif($row->Origin_Car == 2 )
                              รถประมูล
                            @elseif($row->Origin_Car == 3 )
                              รถยึด
                            @elseif($row->Origin_Car == 4 )
                              รถฝากขาย
                            @endif
                          </td>
                          <td class="text-center">
                            @if($row->Car_type == 1)
                              นำเข้าใหม่
                            @elseif ($row->Car_type  == 2)
                              ระหว่างทำสี
                            @elseif ($row->Car_type  == 3)
                              รอซ่อม
                            @elseif ($row->Car_type  == 4)
                              ระหว่างซ่อม
                            @elseif ($row->Car_type  == 5)
                              พร้อมขาย
                            @elseif ($row->Car_type  == 6)
                              ขายแล้ว
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  @endif

                  @if($type == 5)
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          <td class="text-center">
                            @php
                              $create_date = date_create($row->create_date);
                            @endphp
                            {{ date_format($create_date, 'd-m-Y')}}
                          </td>
                          <td class="text-center">{{$row->Number_Regist}}</td>
                          <td class="text-center">{{$row->Brand_Car}}</td>
                          <td class="text-center">{{$row->Version_Car}}</td>
                          <td class="text-center">{{$row->Model_Car}}</td>
                          <td class="text-center">{{$row->Color_Car}}</td>
                          <td class="text-center">{{$row->Size_Car}}</td>
                          <!-- <td class="text-center">{{$row->Fisrt_Price}}</td> -->

                          @if($row->Fisrt_Price == null)
                          <td class="text-center">{{$row->Fisrt_Price}}</td>
                          @else
                          <td class="text-center">{{number_format($row->Fisrt_Price, 2)}}</td>
                          @endif

                          @if($row->Accounting_Cost == null)
                          <td class="text-center">{{$row->Accounting_Cost}}</td>
                          @else
                          <td class="text-center">{{number_format($row->Accounting_Cost, 2)}}</td>
                          @endif

                          <td class="text-center">
                            @if($row->Car_type == 1)
                              นำเข้าใหม่
                            @elseif ($row->Car_type  == 2)
                              ระหว่างทำสี
                            @elseif ($row->Car_type  == 3)
                              รอซ่อม
                            @elseif ($row->Car_type  == 4)
                              ระหว่างซ่อม
                            @elseif ($row->Car_type  == 5)
                              พร้อมขาย
                            @elseif ($row->Car_type  == 6)
                              ขายแล้ว
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  @endif

                  @if($type == 6)
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          <td class="text-center">
                            @php
                              $DateSoldout = date_create($row->Date_Soldout_plus);
                            @endphp
                            {{ date_format($DateSoldout, 'd-m-Y')}}
                          </td>
                          <td class="text-center">{{$row->Number_Regist}}</td>
                          <td class="text-center">{{$row->Brand_Car}}</td>
                          <td class="text-center">{{$row->Version_Car}}</td>
                          <td class="text-center">{{number_format($row->Fisrt_Price, 2)}}</td>
                          <td class="text-center">
                            @php
                              $SumAmount = $row->Fisrt_Price + $row->Repair_Price + $row->Offer_Price + $row->Color_Price + $row->Add_Price;
                            @endphp
                            {{number_format($SumAmount, 2)}}
                          </td>
                          <td class="text-center">
                            {{number_format($row->Net_Priceplus, 2)}}
                          </td>
                          <td class="text-center">
                            @php
                              $SumPrice = 0;
                              $SumPrice = (($row->Net_Priceplus * 100)/107);
                            @endphp
                            {{number_format($SumPrice, 2)}}
                          </td>
                          <td class="text-center">
                            {{number_format($SumPrice - $SumAmount, 2)}}
                          </td>
                          <td class="text-center">
                            @if($row->Origin_Car == 1)
                              CKL
                            @elseif ($row->Origin_Car  == 2)
                              รถประมูล
                            @elseif ($row->Origin_Car  == 3)
                              รถยึด
                            @elseif ($row->Origin_Car  == 4)
                              ฝากขาย
                            @endif
                          </td>
                          <td class="text-center">
                            @if($row->Car_type == 1)
                              นำเข้าใหม่
                            @elseif ($row->Car_type  == 2)
                              ระหว่างทำสี
                            @elseif ($row->Car_type  == 3)
                              รอซ่อม
                            @elseif ($row->Car_type  == 4)
                              ระหว่างซ่อม
                            @elseif ($row->Car_type  == 5)
                              พร้อมขาย
                            @elseif ($row->Car_type  == 6)
                              ขายแล้ว
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  @endif
                </table>
              </div>
            </div>
          </div>

        <script type="text/javascript">
            $(function() {
               $('#table').DataTable({
                 "ordering" : false,
                 "oLanguage": {
                 "sLengthMenu": "แสดง _MENU_ รายการ ต่อหนึ่งหน้า",
                 "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                 "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                 "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                 "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ รายการ)",
                 "oPaginate": {
                 "sFirst":    "หน้าแรก",
                 "sPrevious": "ก่อนหน้า",
                 "sNext":     "ถัดไป",
                 "sLast":     "หน้าสุดท้าย"
                 },
                 "sSearch": "ค้นหา :"
                 }
                 } );
            });
        </script>

        <script type="text/javascript">
          $(document).ready(function(){
            $('.delete_form').on('submit',function(){
              if (confirm("คุณต้องการลบข้อมูลหรือไม่")) {
                return true;
              }
              else {
                return false;
              }
              });
            });
        </script>

        <script>
            $(".alert").fadeTo(3000, 500).slideUp(500, function(){
            $(".alert").alert('close');
            });;
          </script>

          <script>
          function blinker() {
          	$('.prem').fadeOut(1000);
          	$('.prem').fadeIn(1000);
          }
          setInterval(blinker, 1000);
        </script>

        </div>
      </div>
    </section>

@endsection
