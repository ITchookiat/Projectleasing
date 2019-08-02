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
@php
function DateThai2($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("d",strtotime($strDate));

$strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay-$strMonthThai-$strYear";

}
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
    <label align="right">วันที่ : <u>{{$date2}}</u></label>
    <h2 class="card-title p-3" align="center">รายงานที่อนุมัติ</h2>
    <h2 class="card-title p-3" align="center">จากวันที่ {{ DateThai2($newfdate) }} ถึงวันที่ {{ DateThai2($newtdate) }}</h2>

  <body>
    <br />
    <table border="1">
         <thead class="thead-dark bg-gray-light" >
           <tr align="center">
             <th width="30px">ลำดับ</th>
             <th>วันที่อนุมัติ</th>
             <th>สถานะ</th>
             <th>ยีห้อ</th>
             <th>รุ่น</th>
             <th>ทะเบียนเดิม</th>
             <th>ทะเบียนใหม่</th>
             <th>เลขสัญญา</th>
             <th>ปี</th>
             <th>ยอดจัด</th>
             <th>ผู้รับเงิน</th>
             <th>ผู้รับค่าคอม</th>
             <th>เลขกรมธรรม์</th>
           </tr>
         </thead>
         <tbody>
           @foreach($data as $key => $row)
             <tr align="center">
               <td width="30px"> {{ $key+1 }} </td>
               <td> {{ DateThai2($row->Date_Due)}} </td>
               <td> {{ $row->status_car}} </td>
               <td> {{ $row->Brand_car}} </td>
               <td> {{ $row->Model_car}} </td>
               <td> {{ $row->License_car}} </td>
               <td>
                 @if($row->Nowlicense_car == Null)
                 -
                 @else
                 {{ $row->Nowlicense_car }}
                 @endif
               </td>
               <td> {{ $row->Contract_buyer}} </td>
               <td> {{ $row->Year_car}} </td>
               <td>
                 @if($row->Top_car != Null)
                   {{ number_format($row->Top_car)}}
                 @else
                   0
                 @endif
               </td>
               <td>{{ $row->Payee_car}}</td>
               <td>{{ $row->Payee_car}}</td>
               <td>{{ $row->Payee_car}}</td>
             </tr>
             @endforeach

         </tbody>
       </table>

  </body>
</html>
