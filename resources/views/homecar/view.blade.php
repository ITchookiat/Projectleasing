@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

@php
  function DateThai($strDate)
      {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));
      $strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
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
          <h3 align="center"><b>รายการ{{ $title }}</b></h3>
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

              @if($type == 1 or $type == 6)
                <form method="get" action="{{ route('datacar',$type) }}">
                  <div align="right" class="form-inline">
                    @if($type == 1)
                      <a href="{{ route('datacar.create',1) }}" class="btn btn-success btn-app">
                      <span class="glyphicon glyphicon-plus"></span> เพิ่มข้อมูล
                      </a>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-app dropdown-toggle" data-toggle="dropdown">
                          <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a target="_blank" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}}&carType={{$carType}}">สำหรับพนักงาน</a></li>
                          <li class="divider"></li>
                          <li><a target="_blank" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}}&carType={{$carType}}&admin={{1}}">สำหรับผู้บริหาร</a></li>
                        </ul>
                      </div>
                      @elseif($type == 6)
                      <a target="_blank" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}}&carType={{$carType}}" class="btn btn-primary btn-app">
                      <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                      </a>
                      @endif

                    <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                    <p>
                    </p>
                    <label>จากวันที่ : </label>
                    <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: $date }}" class="form-control" />

                    <label>ถึงวันที่ : </label>
                    <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: $date }}" class="form-control" />
                    @if($type != 6)
                      <label for="text" class="mr-sm-2">ประเภทรถ : </label>
                        <select name="carType" class="form-control mb-2 mr-sm-2" id="text" style="width: 170px">
                          <option selected disabled value="">---เลือกประเภทรถ---</option>
                          <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>นำเข้าใหม่</otion>
                          <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>ระหว่างทำสี</otion>
                          <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รอซ่อม</otion>
                          <option value="4" {{ ($carType == '4') ? 'selected' : '' }}>ระหว่างซ่อม</otion>
                        </select>
                    @endif
                </div>
                </form>
              @endif

              @if($type == 5)
                <div align="right" class="form-inline">
                  <a target="_blank" href="{{ action('DatacarController@ReportPDF') }}?id={{$type}}" class="btn btn-primary btn-app">
                  <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                  </a>
                </div>
              @endif

            <div class="table-responsive">
              <table class="table table-bordered" id="table">
                <thead class="thead-dark bg-gray-light" >
                  <br>
                  <tr>
                    @if($type != 6)
                    <th class="text-center" style="width: 100px">วันที่รับ</th>
                    <th class="text-center" style="width: 120px">วันที่เปลี่ยนสถานะ</th>
                    @endif
                    @if($type == 5)
                      <th class="text-center" style="width: 100px">ราคาขาย</th>
                    @endif
                    @if($type == 6)
                      <th class="text-center" style="width: 100px">วันที่ขาย</th>
                    @endif
                    <th class="text-center" style="width: 120px">เลขทะเบียน</th>
                    <th class="text-center" style="width: 80px">ที่มา</th>
                    <th class="text-center" style="width: 80px">Job No.</th>
                    <th class="text-center" style="width: 100px">สถานะ</th>
                    <th class="text-center" style="width: 150px">หมายเหตุ</th>

                    <th class="text-center" style="width: 180px">Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($data as $row)
                    <tr>
                      @php
                        $create_date = date_create($row->create_date);
                        $date_status = date_create($row->Date_Status);
                        $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
                      @endphp

                      @if($type != 6)
                        <td class="text-center">
{{--
                        <!-- แจ้งแตือนแบบกระพริบ -->
                          <!-- @php
                          date_default_timezone_set('Asia/Bangkok');
                          $Y = date('Y') + 543;
                          $m = date('m', strtotime('- 4 Month')) ;
                          $d = date('d');
                          $month = $Y.'-'.$m.'-'.$d;
                          @endphp
                          @if($row->create_date < $month && $row->Date_Soldout == null )
                          <a href="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}" title="ดูรายการ" data-toggle="modal" data-target="#modal-default">
                          <span class="fa fa-car fa-lg text-danger prem" title="รถอยู่ในสต็อกเกิน 4 เดือนแล้ว"></span>
                          </a>
                          @elseif($row->create_date > $month )
                          <span class="fa fa-car fa-lg" style="color: #FFF;"></span>
                          @endif -->
                        <!-- แจ้งแตือนแบบกระพริบ -->
--}}
{{--
                        <!-- แจ้งแตือนแบบกระพริบหมดอายุบัตร -->
                          <!-- @php
                          date_default_timezone_set('Asia/Bangkok');
                          $Y = date('Y') + 543;
                          $m1 = date('m', strtotime('+ 1 Month')) ;
                          $d = date('d');
                          $month1 = $Y.'-'.$m1.'-'.$d;
                          $Date_NumberUser = date_create($row->Date_NumberUser);
                          @endphp
                          @if($row->Date_NumberUser < $month1 && $row->Date_NumberUser != null )
                          <a href="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}" title="ดูรายการ" data-toggle="modal" data-target="#modal-default">
                          <span class="fa fa-credit-card fa-lg text-warning prem" title="บัตรประชาชนหมดอายุ {{date_format($Date_NumberUser, 'd-m-Y')}} "></span>
                          </a>
                          @elseif($row->Date_NumberUser > $month1 OR $row->Date_NumberUser == null )
                          <span class="fa fa-credit-card fa-lg" style="color: #FFF;"></span>
                          @endif -->
                        <!-- แจ้งแตือนแบบกระพริบหมดอายุบัตร -->
--}}
{{--
                        <!-- แจ้งแตือนแบบกระพริบหมดอายภาษี -->
                          <!-- @php
                          date_default_timezone_set('Asia/Bangkok');
                          $Y = date('Y') + 543;
                          $m2 = date('m', strtotime('+ 1 Month')) ;
                          $d = date('d');
                          $month2 = $Y.'-'.$m2.'-'.$d;
                          $Date_Expire = date_create($row->Date_Expire);
                          @endphp
                          @if($row->Date_Expire < $month2 && $row->Date_Expire != null )
                          <a href="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}" title="ดูรายการ" data-toggle="modal" data-target="#modal-default">
                          <span class="fa fa-ban fa-lg text-info prem" title="ภาษีหมดอายุ {{date_format($Date_Expire, 'd-m-Y')}} "></span>
                          </a>
                          @elseif($row->Date_Expire > $month2 OR $row->Date_Expire == null )
                          <span class="fa fa-credit-card fa-lg" style="color: #FFF;"></span>
                          @endif
                          <!-- แจ้งแตือนแบบกระพริบหมดอายุภาษี --> -->
--}}
                          {{ date_format($create_date, 'd-m-Y')}}
                        </td>

                        @if($row->Date_Status == Null)
                          <td class="text-center"> - </td>
                        @else
                          <td class="text-center">{{ date_format($date_status, 'd-m-Y')}}</td>
                        @endif
                      @endif

                      @if($type == 5)
                        <td class="text-center">{{number_format($row->Net_Price, 2)}}</td>
                      @endif
                      @if($type == 6)
                        <td class="text-center">{{ date_format($Date_Soldout_plus, 'd-m-Y')}}</td>
                      @endif
                      <td class="text-center">{{$row->Number_Regist}}</td>
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
                      <td class="text-center">{{$row->Job_Number}}</td>
                      <td class="text-center">
                        @if($row->Car_type == 1)
                          นำเข้าใหม่ @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                        @elseif ($row->Car_type  == 2)
                          ระหว่างทำสี @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                        @elseif ($row->Car_type  == 3)
                          รอซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                        @elseif ($row->Car_type  == 4)
                          ระหว่างซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                        @elseif ($row->Car_type  == 5)
                          พร้อมขาย @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                        @elseif ($row->Car_type  == 6)
                          ขายแล้ว
                        @endif
                      </td>

                      <td class="text-left">
                       @if($row->BorrowStatus == 1)
                       {{ $row->Check_Note }}
                       <br>
                       <font color="red">({{$row->Note_Borrow}})</font>
                       @else
                       {{ $row->Check_Note }}
                       @endif
                     </td>

                      <td class="text-center">
                          <a href="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-info btn-sm" title="ดูรายการ" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false">
                          <span class="glyphicon glyphicon-eye-open"></span> ดู
                          </a>

                        @if($type != 6)
                          <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                          <span class="glyphicon glyphicon-pencil"></span> แก้ไข
                          </a>
                        @elseif ($type == 6)
                          <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="ข้อมูลซื้อ" data-toggle="modal" data-target="#modal-buyinfo" data-backdrop="static" data-keyboard="false">
                          <span class="glyphicon glyphicon-pencil"></span> ข้อมูลขาย
                          </a>
                        @endif

                        @if($type == 1)
                          <div class="form-inline form-group">
                            @if($type == 1)
                            <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$row->Datacar_id) }}">
                            {{csrf_field()}}
                              <input type="hidden" name="_method" value="DELETE" />
                              <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                <span class="glyphicon glyphicon-trash"></span> ลบ
                              </button>
                            </form>
                            @endif
                          </div>
                         @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            $(function() {
               $('#table').DataTable(
                 {
                   "ordering" : false,
                   "lengthChange" : true,
                   // "pageLength": 25, //กำหนดแสดงข้อมูลเป็น 10 25 50 75 100
                   "paging" : true,
                   "searching" : true,
                   "info" : true,
                   "autoWidth" : true,
                    "oLanguage": {
                    "sLengthMenu": "แสดง _MENU_ รายการ ต่อหนึ่งหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ รายการ)",
                    "oPaginate": {
                    "sFirst": "หน้าแรก",
	                  "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
	                  "sLast": "หน้าสุดท้าย"
                    },
                    "sSearch": "ค้นหา :"
                    }
                    } );
                    }
               );
          </script>

          <script>
            $(".alert").fadeTo(3000, 500).slideUp(500, function(){
            $(".alert").alert('close');
            });
          </script>

          <script>
            function blinker() {
            	$('.prem').fadeOut(3000);
            	$('.prem').fadeIn(3000);
            }
            setInterval(blinker, 1000);
            </script>

        </div>

      </div>
    </section>

         <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลรายละเอียด...</h4>
              </div>
              <div class="modal-body">
                <div class="modal-footer"></div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
         </div>

         <div class="modal fade" id="modal-buyinfo">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ข้อมูลรายละเอียด...</h4>
              </div>
              <div class="modal-body">
                <div class="modal-footer"></div>
              </div>
            </div>
          </div>
         </div>
        <!-- /.modal -->

@endsection
