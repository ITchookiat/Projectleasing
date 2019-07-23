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
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report</title>
    <style>
    h1{
      font-size: 14px;
    }
    font, b{
      font-size: 10px;
    }
    </style>
  </head>
  <body style="margin:0;padding:0;">

    @if($fmonth == 01)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มกราคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 02)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กุมภาพันธ์ {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 03)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มีนาคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 04)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน เมษายน {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 05)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน พฤษภาคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 06)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน มิถุนายน {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 07)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กรกฎาคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 8)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน สิงหาคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 9)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน กันยายน {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 10)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน ตุลาคม {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 11)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน พฤศจิกายน {{ $fyear+543 }}</font></b></p>
    @elseif($fmonth == 12)
    <p align="center"><b><font size="+5">รายงานประเภทจัดไฟแนนซ์ ประจำเดือน ธันวาคม {{ $fyear+543 }}</font></b></p>
    @endif
    <table border="1">
      <thead class="thead-light bg-gray-light">
        <tr  align="center">
          <td width="100px"><b><center>แบบ</center></b></td>
          <td width="60px"><b><center>ปัตตานี (01)</center></b></td>
          <td width="60px"><b><center>ยะลา (03)</center></b></td>
          <td><b><center>นราธิวาส (04)</center></b></td>
          <td width="60px"><b><center>สายบุรี (05)</center></b></td>
          <td><b><center>สุไหงโก-ลก (06)</center></b></td>
          <td><b><center>เบตง (07)</center></b></td>
          <td><b><center>ยอดรวม</center></b></td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td width="100px"><b><center>กส.ค้ำมีหลักทรัพย์</center></b></td>
          <td width="60px"><center>{{ $count_pt1 }}</center></td>
          <td width="60px"><center>{{ $count_yl1 }}</center></td>
          <td><center>{{ $count_nr1 }}</center></td>
          <td width="60px"><center>{{ $count_sb1 }}</center></td>
          <td><center>{{ $count_kl1 }}</center></td>
          <td><center>{{ $count_bt1 }}</center></td>
          <td>
            <center>
              <b>{{ $sum1 = $count_pt1+$count_yl1+$count_nr1+$count_sb1+$count_kl1+$count_bt1 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>กส.ค้ำไม่มีหลักทรัพย์</center></b></td>
          <td width="60px"><center>{{ $count_pt2 }}</center></td>
          <td width="60px"><center>{{ $count_yl2 }}</center></td>
          <td><center>{{ $count_nr2 }}</center></td>
          <td width="60px"><center>{{ $count_sb2 }}</center></td>
          <td><center>{{ $count_kl2 }}</center></td>
          <td><center>{{ $count_bt2 }}</center></td>
          <td>
            <center>
              <b>{{ $sum2 = $count_pt2+$count_yl2+$count_nr2+$count_sb2+$count_kl2+$count_bt2 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>กส.ไม่ค้ำประกัน</center></b></td>
          <td width="60px"><center>{{ $count_pt3 }}</center></td>
          <td width="60px"><center>{{ $count_yl3 }}</center></td>
          <td><center>{{ $count_nr3 }}</center></td>
          <td width="60px"><center>{{ $count_sb3 }}</center></td>
          <td><center>{{ $count_kl3 }}</center></td>
          <td><center>{{ $count_bt3 }}</center></td>
          <td>
            <center>
              <b>{{ $sum3 = $count_pt3+$count_yl3+$count_nr3+$count_sb3+$count_kl3+$count_bt3 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>ซข.ค้ำมีหลักทรัพย์</center></b></td>
          <td width="60px"><center>{{ $count_pt4 }}</center></td>
          <td width="60px"><center>{{ $count_yl4 }}</center></td>
          <td><center>{{ $count_nr4 }}</center></td>
          <td width="60px"><center>{{ $count_sb4 }}</center></td>
          <td><center>{{ $count_kl4 }}</center></td>
          <td><center>{{ $count_bt4 }}</center></td>
          <td>
            <center>
              <b>{{ $sum4 = $count_pt4+$count_yl4+$count_nr4+$count_sb4+$count_kl4+$count_bt4 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>ซข.ค้ำไม่มีหลักทรัพย์</center></b></td>
          <td width="60px"><center>{{ $count_pt5 }}</center></td>
          <td width="60px"><center>{{ $count_yl5 }}</center></td>
          <td><center>{{ $count_nr5 }}</center></td>
          <td width="60px"><center>{{ $count_sb5 }}</center></td>
          <td><center>{{ $count_kl5 }}</center></td>
          <td><center>{{ $count_bt5 }}</center></td>
          <td>
            <center>
              <b>{{ $sum5 = $count_pt5+$count_yl5+$count_nr5+$count_sb5+$count_kl5+$count_bt5 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>ซข.ไม่ค้ำประกัน</center></b></td>
          <td width="60px"><center>{{ $count_pt6 }}</center></td>
          <td width="60px"><center>{{ $count_yl6 }}</center></td>
          <td><center>{{ $count_nr6 }}</center></td>
          <td width="60px"><center>{{ $count_sb6 }}</center></td>
          <td><center>{{ $count_kl6 }}</center></td>
          <td><center>{{ $count_bt6 }}</center></td>
          <td>
            <center>
              <b>{{ $sum6 = $count_pt6+$count_yl6+$count_nr6+$count_sb6+$count_kl6+$count_bt6 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><b><center>VIP 1</center></b></td>
          <td width="60px"><center>{{ $count_pt7 }}</center></td>
          <td width="60px"><center>{{ $count_yl7 }}</center></td>
          <td><center>{{ $count_nr7 }}</center></td>
          <td width="60px"><center>{{ $count_sb7 }}</center></td>
          <td><center>{{ $count_kl7 }}</center></td>
          <td><center>{{ $count_bt7 }}</center></td>
          <td>
            <center>
              <b>{{ $sum7 = $count_pt7+$count_yl7+$count_nr7+$count_sb7+$count_kl7+$count_bt7 }}</b>
            </center>
          </td>
        </tr>
        <tr align="center">
          <td width="100px"><center><b>ยอดรวม</b></center></td>
          <td width="60px"><center><b>{{ $sum_count_pt }}</b></center></td>
          <td width="60px"><center><b>{{ $sum_count_yl }}</b></center></td>
          <td><center><b>{{ $sum_count_nr }}</b></center></td>
          <td width="60px"><center><b>{{ $sum_count_sb }}</b></center></td>
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

  </body>
</html>
