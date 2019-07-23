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
        งานโทร
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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('call',1) }}">งานโทรประจำวัน</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('call',2) }}">งานโทรประจำเดือน</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('call',3) }}">ตรวจงานโทร</a>
            </li>
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

            <form method="get" action="{{ route('call', 2) }}">
              <div align="right" class="form-inline">

                <a target="_blank" href="{{ route('monthreport', [8, $fmonth, $fyear]) }}" class="btn btn-primary btn-app">
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
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน มกราคม {{ $fyear }}</b></p>
            @elseif($fmonth == 02)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน กุมภาพันธ์ {{ $fyear }}</b></p>
            @elseif($fmonth == 03)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน มีนาคม {{ $fyear }}</b></p>
            @elseif($fmonth == 04)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน เมษายน {{ $fyear }}</b></p>
            @elseif($fmonth == 05)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน พฤษภาคม {{ $fyear }}</b></p>
            @elseif($fmonth == 06)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน มิถุนายน {{ $fyear }}</b></p>
            @elseif($fmonth == 07)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน กรกฎาคม {{ $fyear }}</b></p>
            @elseif($fmonth == 8)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน สิงหาคม {{ $fyear }}</b></p>
            @elseif($fmonth == 9)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน กันยายน {{ $fyear }}</b></p>
            @elseif($fmonth == 10)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน ตุลาคม {{ $fyear }}</b></p>
            @elseif($fmonth == 11)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน พฤศจิกายน {{ $fyear }}</b></p>
            @elseif($fmonth == 12)
            <p align="center"><b>รายงานการโทรไฟแนนซ์ ลูกค้าค้าง ประจำเดือน ธันวาคม {{ $fyear }}</b></p>
            @endif
            <table class="table table-bordered" style="width: 70%" align="center">
              <thead class="thead-light bg-gray-light">
                <tr>
                  <td rowspan="2" valign="middle"><center>ชื่อสาขา</center></td>
                  <td><center>ลูกค้ามาจ่าย</center></td>
                  <td><center>ลูกค้ามาจ่าย</center></td>
                  <td><center>ลูกค้าค้าง</center></td>
                  <td><center>% ลูกค้ามาชำระ</center></td>
                  <td><center>% ลูกค้ามาชำระ</center></td>
                </tr>
                <tr>
                  <td><center>เป็น 0 งวด</center></td>
                  <td><center>ต่ำกว่า 1 งวด</center></td>
                  <td><center>1 งวด</center></td>
                  <td><center>เป็น 0 งวด</center></td>
                  <td><center>ต่ำกว่า 1 งวด</center></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><center>ปัตตานี (01)</center></td>
                  <td><center>{{ $sum_pt_month_0 }}</center></td>
                  <td><center>{{ $sum_pt_month_l1 }}</center></td>
                  <td><center>{{ $sum_pt_month_1 }}</center></td>
                  @if($sum_pt_month_0 == 0 && $sum_pt_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_pt_month_0 / $sum_pt_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_pt_month_l1 == 0 && $sum_pt_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_pt_month_l1 / $sum_pt_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>ยะลา (03)</center></td>
                  <td><center>{{ $sum_yl_month_0 }}</center></td>
                  <td><center>{{ $sum_yl_month_l1 }}</center></td>
                  <td><center>{{ $sum_yl_month_1 }}</center></td>
                  @if($sum_yl_month_0 == 0 && $sum_yl_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_yl_month_0 / $sum_yl_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_yl_month_l1 == 0 && $sum_yl_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_yl_month_l1 / $sum_yl_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>นราธิวาส (04)</center></td>
                  <td><center>{{ $sum_nr_month_0 }}</center></td>
                  <td><center>{{ $sum_nr_month_l1 }}</center></td>
                  <td><center>{{ $sum_nr_month_1 }}</center></td>
                  @if($sum_nr_month_0 == 0 && $sum_nr_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_nr_month_0 / $sum_nr_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_nr_month_l1 == 0 && $sum_nr_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_nr_month_l1 / $sum_nr_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>สายบุรี (05)</center></td>
                  <td><center>{{ $sum_sb_month_0 }}</center></td>
                  <td><center>{{ $sum_sb_month_l1 }}</center></td>
                  <td><center>{{ $sum_sb_month_1 }}</center></td>
                  @if($sum_sb_month_0 == 0 && $sum_sb_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_sb_month_0 / $sum_sb_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_sb_month_l1 == 0 && $sum_sb_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_sb_month_l1 / $sum_sb_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>สุไหงโก-ลก (06)</center></td>
                  <td><center>{{ $sum_kl_month_0 }}</center></td>
                  <td><center>{{ $sum_kl_month_l1 }}</center></td>
                  <td><center>{{ $sum_kl_month_1 }}</center></td>
                  @if($sum_kl_month_0 == 0 && $sum_kl_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_kl_month_0 / $sum_kl_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_kl_month_l1 == 0 && $sum_kl_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_kl_month_l1 / $sum_kl_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>เบตง (07)</center></td>
                  <td><center>{{ $sum_bt_month_0 }}</center></td>
                  <td><center>{{ $sum_bt_month_l1 }}</center></td>
                  <td><center>{{ $sum_bt_month_1 }}</center></td>
                  @if($sum_bt_month_0 == 0 && $sum_bt_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_bt_month_0 / $sum_bt_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_bt_month_l1 == 0 && $sum_bt_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_bt_month_l1 / $sum_bt_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>รวม (02)</center></td>
                  <td><center>{{ $sum_02_month_0 }}</center></td>
                  <td><center>{{ $sum_02_month_l1 }}</center></td>
                  <td><center>{{ $sum_02_month_1 }}</center></td>
                  @if($sum_02_month_0 == 0 && $sum_02_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_02_month_0 / $sum_02_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_02_month_l1 == 0 && $sum_02_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_02_month_l1 / $sum_02_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center>รวม (10)</center></td>
                  <td><center>{{ $sum_10_month_0 }}</center></td>
                  <td><center>{{ $sum_10_month_l1 }}</center></td>
                  <td><center>{{ $sum_10_month_1 }}</center></td>
                  @if($sum_10_month_0 == 0 && $sum_10_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_10_month_0 / $sum_10_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_10_month_l1 == 0 && $sum_10_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_10_month_l1 / $sum_10_month_1) * 100, 2)) }} %</center></td>
                  @endif
                </tr>
                <tr>
                  <td><center><b><font color="red">รวมทั้งหมด</font></b></center></td>
                  <td><center><b><font color="red">{{ $sum_all_month_0 }}</b></font></center></td>
                  <td><center><b><font color="red">{{ $sum_all_month_l1 }}</font></b></center></td>
                  <td><center><b><font color="red">{{ $sum_all_month_1 }}</font></b></center></td>
                  @if($sum_all_month_0 == 0 && $sum_all_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_all_month_0 / $sum_all_month_1) * 100, 2)) }} %</center></td>
                  @endif

                  @if($sum_all_month_l1 == 0 && $sum_all_month_1 == 0)
                  <td><center>0 %</center></td>
                  @else
                  <td><center>{{ round(number_format(($sum_all_month_l1 / $sum_all_month_1) * 100, 2)) }} %</center></td>
                  @endif
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
