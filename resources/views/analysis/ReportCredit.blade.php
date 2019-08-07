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

    <style>
      td.container > div {
          width: 100%;
          height: 100%;
          overflow:hidden;
      }
      td.container {
          height: 20px;
      }
    </style>

  </head>
    <label align="right">วันที่ : <u>{{$date2}}</u></label>
    @if($ReportType == 11)
    <h2 class="card-title p-3" align="center">รายงานที่อนุมัติ</h2>
    <p class="card-title p-3" align="center">จากวันที่ {{ DateThai2($newfdate) }} ถึงวันที่ {{ DateThai2($newtdate) }}</p>
    @else
    <h2 class="card-title p-3" align="center">รายงานสินเชื่อ</h2>
    @endif
    <hr>
  <body>
    <br />
    @if($ReportType == 11)
    <table border="1">
         <thead class="thead-dark bg-gray-light" >
           <tr align="center">
             <th width="20px">ลำดับ</th>
             <th width="50px">วันที่อนุมัติ</th>
             <th width="65px">สถานะ</th>
             <th width="50px">ยีห้อ</th>
             <th width="90px">รุ่น</th>
             <th width="50px">ทะเบียนเดิม</th>
             <th width="50px">ทะเบียนใหม่</th>
             <th width="55px">เลขสัญญา</th>
             <th width="30px">ปี</th>
             <th width="35px">ยอดจัด</th>
             <th width="75px">ผู้รับเงิน</th>
             <th width="60px">เลขที่บัญชี</th>
             <th width="75px">ผู้รับค่าคอม</th>
             <th width="60px">เลขที่บัญชี</th>
             <th width="60px">เลขกรมธรรม์</th>
           </tr>
         </thead>
         <tbody>
           @foreach($data as $key => $row)
             <tr align="center">
               <td width="20px"> {{ $key+1 }} </td>
               <td width="50px"> {{ DateThai2($row->Date_Due)}} </td>
               <td width="65px"> {{ $row->status_car}} </td>
               <td width="50px"> {{ $row->Brand_car}} </td>
               <td width="90px" align="left"> {{ $row->Model_car}} </td>
               <td width="50px"> {{ $row->License_car}} </td>
               <td width="50px">
                 @if($row->Nowlicense_car == Null)
                 -
                 @else
                 {{ $row->Nowlicense_car }}
                 @endif
               </td>
               <td width="55px"> {{ $row->Contract_buyer}} </td>
               <td width="30px"> {{ $row->Year_car}} </td>
               <td width="35px">
                 @if($row->Top_car != Null)
                   {{ number_format($row->Top_car)}}
                 @else
                   -
                 @endif
               </td>
               <td width="75px" align="left"> {{ $row->Payee_car}}</td>
               <td width="60px"> {{ $row->Accountbrance_car}}</td>
               <td width="75px" align="left"> {{ $row->Payee_car}}</td>
               <td width="60px"> {{ $row->Accountagent_car}}</td>
               <td width="60px">{{ $row->Insurance_key}}</td>
             </tr>
             @endforeach

         </tbody>
       </table>
    @else
    @endif

  </body>
</html>
