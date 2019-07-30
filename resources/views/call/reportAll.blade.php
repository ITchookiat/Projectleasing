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
    @if( $ReportType == 1)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} ทุกสาขา</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_all as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    @if($ReportType == 2)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ปัตตานี (01)</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_pt as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

    <!-- แสดงงานโทรสาขา 02 และ 10 (ปัตตานี) -->
    <div class="table-responsive">
      <h1>งานโทรสาขา รหัส 02 และ 10 (ปัตตานี)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($pattani as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    @if($ReportType == 3)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา ยะลา (03)</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_yl as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

    <!-- แสดงงานโทรสาขา 02 และ 10 (pt]k) -->
    <div class="table-responsive">
      <h1>งานโทรสาขา รหัส 02 และ 10 (ยะลา)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($yala as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    @if($ReportType == 4)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา นราธิวาส (04)</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_nr as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

    <!-- แสดงงานโทรสาขา 02 และ 10 (pt]k) -->
    <div class="table-responsive">
      <h1>งานโทรสาขา รหัส 02 และ 10 (นราธิวาส)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($nara as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    @if($ReportType == 5)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สายบุรี (05)</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_sb as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

    <!-- แสดงงานโทรสาขา 02 และ 10 (pt]k) -->
    <div class="table-responsive">
      <h1>งานโทรสาขา รหัส 02 และ 10 (สายบุรี)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($saiburi as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    @if($ReportType == 6)
    <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา สุไงโก-ลก (06)</h1>
    <table border="1">
      <thead class="thead-dark bg-gray-light" >
        <tr>
          <th align="center" width="30px"><b>ลำดับ</b></th>
          <th align="center" width="70px"><b>เลขสัญญา</b></th>
          <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
          <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
          <th align="center" width="160px"><b>เบอร์โทร</b></th>
          <th align="center" width="50px"><b>ค้างชำระ</b></th>
          <th align="center" width="65px"><b>หมายเหตุ</b></th>
        </tr>
      </thead>

      <tbody>
        @foreach($data_kl as $key => $row)
        <tr>
          <td align="center" width="30px"><font>{{$key+1}}</font></td>
          @php
             $StrCon = explode("/",$row->contno);
             $SetStr1 = $StrCon[0];
             $SetStr2 = $StrCon[1];
             $fdate = date_create($row->fdate);
          @endphp
          <td align="center" width="70px"><font>{{$row->contno}}</font></td>
          <td width="125px"><font>{{ ' '.$row->name }}</font></td>
          <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
          <td width="160px">
            @php
            $cut = $row->tel;
            $tel = substr($cut, 0 , 30);
            @endphp
            <font>{{ $tel }}</font>
          </td>
          <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
          <td align="center" width="65px"> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

    <!-- แสดงงานโทรสาขา 02 และ 10 (pt]k) -->
    <div class="table-responsive">
      <h1>งานโทรสาขา รหัส 02 และ 10 (สุไงโก-ลก)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($kolok as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif

      @if($ReportType == 7)
      <h1>งานโทรค้าง 1 - 1.49 ดิววันที่ {{ DateThai($date)}} สาขา เบตง (07)</h1>
      <table border="1">
        <thead class="thead-dark bg-gray-light" >
          <tr>
            <th align="center" width="30px"><b>ลำดับ</b></th>
            <th align="center" width="70px"><b>เลขสัญญา</b></th>
            <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
            <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
            <th align="center" width="160px"><b>เบอร์โทร</b></th>
            <th align="center" width="50px"><b>ค้างชำระ</b></th>
            <th align="center" width="65px"><b>หมายเหตุ</b></th>
          </tr>
        </thead>

        <tbody>
          @foreach($data_bt as $key => $row)
          <tr>
            <td align="center" width="30px"><font>{{$key+1}}</font></td>
            @php
               $StrCon = explode("/",$row->contno);
               $SetStr1 = $StrCon[0];
               $SetStr2 = $StrCon[1];
               $fdate = date_create($row->fdate);
            @endphp
            <td align="center" width="70px"><font>{{$row->contno}}</font></td>
            <td width="125px"><font>{{ ' '.$row->name }}</font></td>
            <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
            <td width="160px">
              @php
              $cut = $row->tel;
              $tel = substr($cut, 0 , 30);
              @endphp
              <font>{{ $tel }}</font>
            </td>
            <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
            <td align="center" width="65px"> </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>

      <!-- แสดงงานโทรสาขา 02 และ 10 (เบตง) -->
      <div class="table-responsive">
        <h1>งานโทรสาขา รหัส 02 และ 10 (เบตง)</h1>
        <table border="1">
          <thead class="thead-dark bg-gray-light" >
            <tr>
              <th align="center" width="30px"><b>ลำดับ</b></th>
              <th align="center" width="70px"><b>เลขสัญญา</b></th>
              <th align="center" width="125px"><b>ชื่อลูกค้า</b></th>
              <th align="center" width="65px"><b>วันดิวงวดแรก</b></th>
              <th align="center" width="160px"><b>เบอร์โทร</b></th>
              <th align="center" width="50px"><b>ค้างชำระ</b></th>
              <th align="center" width="65px"><b>หมายเหตุ</b></th>
            </tr>
          </thead>

          <tbody>
            @foreach($betong as $key => $row)
            <tr>
              <td align="center" width="30px"><font>{{$key+1}}</font></td>
              @php
                 $StrCon = explode("/",$row->contno);
                 $SetStr1 = $StrCon[0];
                 $SetStr2 = $StrCon[1];
                 $fdate = date_create($row->fdate);
              @endphp
              <td align="center" width="70px"><font>{{$row->contno}}</font></td>
              <td width="125px"><font>{{ ' '.$row->name }}</font></td>
              <td align="center" width="65px"><font>{{ date_format($fdate, 'd-m-Y') }}</font></td>
              <td width="160px">
                @php
                $cut = $row->tel;
                $tel = substr($cut, 0 , 30);
                @endphp
                <font>{{ $tel }}</font>
              </td>
              <td align="center" width="50px"><font>{{ $row->exp_amt }}</font></td>
              <td align="center" width="65px"> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif

        @if($ReportType == 8)
        <p align="center"><b><font size="+3">รายงานการโทรไฟแนนซ์ ลูกค้าค้าง จากวันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }}</font></b></p>
        <table border="1">
          <thead class="thead-light bg-gray-light">
            <tr align="center">
              <td rowspan="2" valign="middle"><b>ชื่อสาขา</b></td>
              <td><b>ลูกค้ามาจ่าย</b></td>
              <td><b>ลูกค้ามาจ่าย</b></td>
              <td><b>ลูกค้าค้าง</b></td>
              <td><b>% ลูกค้ามาชำระ</b></td>
              <td><b>% ลูกค้ามาชำระ</b></td>
            </tr>
            <tr align="center">
              <td><b>เป็น 0 งวด</b></td>
              <td><b>ต่ำกว่า 1 งวด</b></td>
              <td><b>1 งวด</b></td>
              <td><b>เป็น 0 งวด</b></td>
              <td><b>ต่ำกว่า 1 งวด</b></td>
            </tr>
          </thead>
          <tbody>
            <tr align="center">
              <td>ปัตตานี (01)</td>
              <td>{{ $sum_pt_month_0 }}</td>
              <td>{{ $sum_pt_month_l1 }}</td>
              <td>{{ $sum_pt_month_1 }}</td>
              @if($sum_pt_month_0 == 0 && $sum_pt_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_pt_month_0 / $sum_pt_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_pt_month_l1 == 0 && $sum_pt_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_pt_month_l1 / $sum_pt_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td>ยะลา (03)</td>
              <td>{{ $sum_yl_month_0 }}</td>
              <td>{{ $sum_yl_month_l1 }}</td>
              <td>{{ $sum_yl_month_1 }}</td>
              @if($sum_yl_month_0 == 0 && $sum_yl_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_yl_month_0 / $sum_yl_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_yl_month_l1 == 0 && $sum_yl_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_yl_month_l1 / $sum_yl_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td>นราธิวาส (04)</td>
              <td>{{ $sum_nr_month_0 }}</td>
              <td>{{ $sum_nr_month_l1 }}</td>
              <td>{{ $sum_nr_month_1 }}</td>
              @if($sum_nr_month_0 == 0 && $sum_nr_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_nr_month_0 / $sum_nr_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_nr_month_l1 == 0 && $sum_nr_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_nr_month_l1 / $sum_nr_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td>สายบุรี (05)</td>
              <td>{{ $sum_sb_month_0 }}</td>
              <td>{{ $sum_sb_month_l1 }}</td>
              <td>{{ $sum_sb_month_1 }}</td>
              @if($sum_sb_month_0 == 0 && $sum_sb_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_sb_month_0 / $sum_sb_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_sb_month_l1 == 0 && $sum_sb_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_sb_month_l1 / $sum_sb_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td>สุไหงโก-ลก (06)</td>
              <td>{{ $sum_kl_month_0 }}</td>
              <td>{{ $sum_kl_month_l1 }}</td>
              <td>{{ $sum_kl_month_1 }}</td>
              @if($sum_kl_month_0 == 0 && $sum_kl_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_kl_month_0 / $sum_kl_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_kl_month_l1 == 0 && $sum_kl_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_kl_month_l1 / $sum_kl_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td>เบตง (07)</td>
              <td>{{ $sum_bt_month_0 }}</td>
              <td>{{ $sum_bt_month_l1 }}</td>
              <td>{{ $sum_bt_month_1 }}</td>
              @if($sum_bt_month_0 == 0 && $sum_bt_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_bt_month_0 / $sum_bt_month_1) * 100, 2)) }} %</td>
              @endif

              @if($sum_bt_month_l1 == 0 && $sum_bt_month_1 == 0)
              <td>0 %</td>
              @else
              <td>{{ round(number_format(($sum_bt_month_l1 / $sum_bt_month_1) * 100, 2)) }} %</td>
              @endif
            </tr>
            <tr align="center">
              <td><b><font>รวมทั้งหมด</font></b></td>
              <td><b><font>{{ $sum_all_month_0 }}</b></font></td>
              <td><b><font>{{ $sum_all_month_l1 }}</font></b></td>
              <td><b><font>{{ $sum_all_month_1 }}</font></b></td>
              @if($sum_all_month_0 == 0 && $sum_all_month_1 == 0)
              <td><b><font>0 %</font></b></td>
              @else
              <td><b><font>{{ round(number_format(($sum_all_month_0 / $sum_all_month_1) * 100, 2)) }} %</font></b></td>
              @endif

              @if($sum_all_month_l1 == 0 && $sum_all_month_1 == 0)
              <td><b><font>0 %</font></b></td>
              @else
              <td><b><font>{{ round(number_format(($sum_all_month_l1 / $sum_all_month_1) * 100, 2)) }} %</font></b></td>
              @endif
            </tr>
          </tbody>
        </table>
        <br>
        @endif
  </body>
</html>
