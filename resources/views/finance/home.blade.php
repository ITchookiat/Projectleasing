@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d', strtotime('-1 days'));
@endphp
@php
function DateThai($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("j",strtotime($strDate));

$strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay $strMonthThai $strYear";

}
@endphp

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        งานประเภทจัดไฟแนนซ์
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 align="center"><b></b></h3> -->
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('finance', 1) }}">ประเภทจัดประจำเดือน</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('finance', 2) }}">ตรวจงานโทร</a>
            </li> -->
          </ul>
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

            <form method="get" action="{{ route('finance', 1) }}">
              <div align="right" class="form-inline">

                <a target="_blank" href="{{ route('finance', 2) }}" class="btn btn-primary btn-app">
                  <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                </a>

                <button type="submit" class="btn btn-warning btn-app">
                <span class="glyphicon glyphicon-search"></span> Search
                </button>
                <p>
                </p>
                <label>เดือน : </label>
                <select name="Frommonth" class="form-control" style="width: 150px;">
                  <option value="" {{ ($fmonth == '') ? 'selected' : '' }} disabled>---เลือกเดือน---</option>
                  <option value="01" {{ ($fmonth == 01) ? 'selected' : '' }}>มกราคม</option>
                  <option value="02" {{ ($fmonth == 02) ? 'selected' : '' }}>กุมภาพันธ์</option>
                  <option value="03" {{ ($fmonth == 03) ? 'selected' : '' }}>มีนาคม</option>
                  <option value="04" {{ ($fmonth == 04) ? 'selected' : '' }}>เมษายน</option>
                  <option value="05" {{ ($fmonth == 05) ? 'selected' : '' }}>พฤษภาคม</option>
                  <option value="06" {{ ($fmonth == 06) ? 'selected' : '' }}>มิถุนายน</option>
                  <option value="07" {{ ($fmonth == 07) ? 'selected' : '' }}>กรกฎาคม</option>
                  <option value="08" {{ ($fmonth == 8) ? 'selected' : '' }}>สิงหาคม</option>
                  <option value="09" {{ ($fmonth == 9) ? 'selected' : '' }}>กันยายน</option>
                  <option value="10" {{ ($fmonth == 10) ? 'selected' : '' }}>ตุลาคม</option>
                  <option value="11" {{ ($fmonth == 11) ? 'selected' : '' }}>พฤศจิกายน</option>
                  <option value="12" {{ ($fmonth == 12) ? 'selected' : '' }}>ธันวาคม</option>
                </select>
                <label>ปี : </label>
                <select name="Fromyear" class="form-control" style="width: 150px;">
                  <option value="" disabled>--- เลือกปี ---</option>
                   @php
                       $Year = date('Y');
                   @endphp
                   @for ($i = 0; $i < 10; $i++)
                       <option value="{{ $Year }}" {{ ($fyear == $Year) ? 'selected' : '' }}>{{ $Year }}</option>
                       @php
                           $Year -= 1;
                       @endphp
                   @endfor
                </select>
              </div>
            </form>

            <hr>

            @if($fmonth == 01)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มกราคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 02)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กุมภาพันธ์ {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 03)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มีนาคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 04)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน เมษายน {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 05)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน พฤษภาคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 06)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มิถุนายน {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 07)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กรกฎาคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 8)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน สิงหาคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 9)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กันยายน {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 10)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน ตุลาคม {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 11)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน พฤศจิกายน {{ $fyear+543 }}</b></p>
            @elseif($fmonth == 12)
            <p align="center"><b>รายงานประเภทจัดไฟแนนซ์ ประจำเดือน ธันวาคม {{ $fyear+543 }}</b></p>
            @endif
            <table class="table table-bordered" style="width: 70%" align="center">
              <thead class="thead-light bg-gray-light">
                <tr>
                  <td><center>แบบ</center></td>
                  <td><center>ปัตตานี (01)</center></td>
                  <td><center>ยะลา (03)</center></td>
                  <td><center>นราธิวาส (04)</center></td>
                  <td><center>สายบุรี (05)</center></td>
                  <td><center>สุไหงโก-ลก (06)</center></td>
                  <td><center>เบตง (07)</center></td>
                  <td><center>ยอดรวม</center></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><center>กส.ค้ำมีหลักทรัพย์</center></td>
                  <td><center>{{ $count_pt1 }}</center></td>
                  <td><center>{{ $count_yl1 }}</center></td>
                  <td><center>{{ $count_nr1 }}</center></td>
                  <td><center>{{ $count_sb1 }}</center></td>
                  <td><center>{{ $count_kl1 }}</center></td>
                  <td><center>{{ $count_bt1 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum1 = $count_pt1+$count_yl1+$count_nr1+$count_sb1+$count_kl1+$count_bt1 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>กส.ค้ำไม่มีหลักทรัพย์</center></td>
                  <td><center>{{ $count_pt2 }}</center></td>
                  <td><center>{{ $count_yl2 }}</center></td>
                  <td><center>{{ $count_nr2 }}</center></td>
                  <td><center>{{ $count_sb2 }}</center></td>
                  <td><center>{{ $count_kl2 }}</center></td>
                  <td><center>{{ $count_bt2 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum2 = $count_pt2+$count_yl2+$count_nr2+$count_sb2+$count_kl2+$count_bt2 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>กส.ไม่ค้ำประกัน</center></td>
                  <td><center>{{ $count_pt3 }}</center></td>
                  <td><center>{{ $count_yl3 }}</center></td>
                  <td><center>{{ $count_nr3 }}</center></td>
                  <td><center>{{ $count_sb3 }}</center></td>
                  <td><center>{{ $count_kl3 }}</center></td>
                  <td><center>{{ $count_bt3 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum3 = $count_pt3+$count_yl3+$count_nr3+$count_sb3+$count_kl3+$count_bt3 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>ซข.ค้ำมีหลักทรัพย์</center></td>
                  <td><center>{{ $count_pt4 }}</center></td>
                  <td><center>{{ $count_yl4 }}</center></td>
                  <td><center>{{ $count_nr4 }}</center></td>
                  <td><center>{{ $count_sb4 }}</center></td>
                  <td><center>{{ $count_kl4 }}</center></td>
                  <td><center>{{ $count_bt4 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum4 = $count_pt4+$count_yl4+$count_nr4+$count_sb4+$count_kl4+$count_bt4 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>ซข.ค้ำไม่มีหลักทรัพย์</center></td>
                  <td><center>{{ $count_pt5 }}</center></td>
                  <td><center>{{ $count_yl5 }}</center></td>
                  <td><center>{{ $count_nr5 }}</center></td>
                  <td><center>{{ $count_sb5 }}</center></td>
                  <td><center>{{ $count_kl5 }}</center></td>
                  <td><center>{{ $count_bt5 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum5 = $count_pt5+$count_yl5+$count_nr5+$count_sb5+$count_kl5+$count_bt5 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>ซข.ไม่ค้ำประกัน</center></td>
                  <td><center>{{ $count_pt6 }}</center></td>
                  <td><center>{{ $count_yl6 }}</center></td>
                  <td><center>{{ $count_nr6 }}</center></td>
                  <td><center>{{ $count_sb6 }}</center></td>
                  <td><center>{{ $count_kl6 }}</center></td>
                  <td><center>{{ $count_bt6 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum6 = $count_pt6+$count_yl6+$count_nr6+$count_sb6+$count_kl6+$count_bt6 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center>VIP 1</center></td>
                  <td><center>{{ $count_pt7 }}</center></td>
                  <td><center>{{ $count_yl7 }}</center></td>
                  <td><center>{{ $count_nr7 }}</center></td>
                  <td><center>{{ $count_sb7 }}</center></td>
                  <td><center>{{ $count_kl7 }}</center></td>
                  <td><center>{{ $count_bt7 }}</center></td>
                  <td>
                    <center>
                      <b>{{ $sum7 = $count_pt7+$count_yl7+$count_nr7+$count_sb7+$count_kl7+$count_bt7 }}</b>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td><center><b>ยอดรวม</b></center></td>
                  <td><center><b>{{ $sum_count_pt }}</b></center></td>
                  <td><center><b>{{ $sum_count_yl }}</b></center></td>
                  <td><center><b>{{ $sum_count_nr }}</b></center></td>
                  <td><center><b>{{ $sum_count_sb }}</b></center></td>
                  <td><center><b>{{ $sum_count_kl }}</b></center></td>
                  <td><center><b>{{ $sum_count_bt }}</b></center></td>
                  <td>
                    <center>
                      <b>{{ $sum8 = $sum_count_pt+$sum_count_yl+$sum_count_nr+$sum_count_sb+$sum_count_kl+$sum_count_bt }}</b>
                    </center>
                  </td>
                </tr>
              </tbody>
            </table>
            <br>
          </div>

                  <!-- <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                    </button>
                    <a class="delete-modal btn btn-danger">
                      <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                    </a>
                  </div> -->

            </div>
            <!-- <div class="row"> -->
          </div>
            <!-- <div class="col-md-12"> -->

            <script type="text/javascript">
              $(function() {
                 $('#table1, #table2, #table22, #table3, #table33, #table4, #table44, #table5, #table55, #table6, #table66, #table7, #table77').DataTable(
                   {
                     "ordering" : false,
                     "lengthChange" : false,
                     "paging" : false,
                     "searching" : false,
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

        </div>

      </div>
    </section>

    <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <!-- send link to viewdetail page -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

@endsection
