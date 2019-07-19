<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
    <label align="right">วันที่ : <u>{{$date2}}</u></label>
    <h2 class="card-title p-3" align="center">รายงานนำเสนอ</h2>
    <hr>
  <body>
    <br />
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="50px"><b>ยี่ห้อ</b></th>
          <th class="text-center" width="25px"><b>สาขา</b></th>
          <th class="text-center" width="70px"><b>รถ</b></th>
          <th class="text-center" width="20px"><b>ปี</b></th>
          <th class="text-center" width="50px"><b>ทะเบียน</b></th>
          <th class="text-center" width="40px"><b>ยอดจัด</b></th>
          <th class="text-center" width="25px"><b>งวด</b></th>
          <th class="text-center" width="25px"><b>ค/บ</b></th>
          <th class="text-center" width="50px"><b>ค่าใช้จ่าย</b></th>
          <th class="text-center" width="40px"><b>คงเหลือ</b></th>
          <th class="text-center" width="35px"><b>คอม</b></th>
          <th class="text-center" width="35px"><b>หัก 3%</b></th>
          <th class="text-center" width="100px"><b>ผู้รับเงิน</b></th>
          <th class="text-center" width="100px"><b>ผู้รับคอม</b></th>
          <th class="text-center" width="40px"><b>รวม</b></th>
          <th class="text-center" width="40px"><b>ค่าคอม</b></th>
          <th class="text-center" width="40px"><b>ผู้ตรวจ</b></th>
        </tr>
      </thead>
      <tbody>
        @foreach($dataReport as $key => $value)
          <tr align="center">
            <td width="50px">{{$value->Brand_car}}</td>
            <td width="25px">
              @if($value->branch_car == 'ปัตตานี')
                ปน
              @elseif($value->branch_car == 'ยะลา')
                ยล
              @elseif($value->branch_car == 'นราธิวาส')
                นธ
              @elseif($value->branch_car == 'สายบุรี')
                สบ
              @elseif($value->branch_car == 'สุไหงโก-ลก')
                กล
              @elseif($value->branch_car == 'เบตง')
                บต
              @endif
            </td>
            <td width="70px">{{$value->status_car}}</td>
            <td width="20px">{{$value->Year_car}}</td>
            <td width="50px">{{$value->License_car}}</td>
            <td width="40px">{{number_format($value->Top_car)}}</td>
            <td width="25px">{{$value->Timeslacken_car}}</td>
            <td width="25px">{{$value->vat_Price}}</td>
            <td width="50px">{{number_format($value->tran_Price)}}</td>
            <td width="40px">{{number_format($value->balance_Price)}}</td>
            <td width="35px">{{number_format($value->Commission_car)}}</td>
            <td width="35px">{{number_format($value->commit_Price)}}</td>
            <td width="100px">{{$value->Payee_car}}</td>
            <td width="100px">{{$value->Agent_car}}</td>
            <td width="40px">
              @if($value->Accountbrance_car == $value->Accountagent_car)
                @php
                    $ArcSum = $value->balance_Price + $value->commit_Price;
                @endphp
                {{number_format($ArcSum)}}
              @else
                {{number_format($value->balance_Price)}}
              @endif
            </td>
            <td width="40px">
              @if($value->Accountbrance_car != $value->Accountagent_car)
                {{ number_format($value->Commission_car) }}
              @endif
            </td>
            <td width="40px"></td>
          </tr>
          <tr align="center">
            <td width="305px"></td>
            <td width="50px">{{$value->act_Price}}</td>
            <td width="40px"></td>
            <td width="35px"></td>
            <td width="35px"></td>
            <td width="100px">บัญชี : {{$value->Accountbrance_car}}</td>
            <td width="100px">บัญชี : {{$value->Accountagent_car}}</td>
            <td width="40px"></td>
            <td width="40px"></td>
            <td width="40px"></td>
          </tr>
          <tr align="center">
            <td width="305px"></td>
            <td width="50px"></td>
            <td width="40px"></td>
            <td width="35px"></td>
            <td width="35px"></td>
            <td width="100px">โทร : {{$value->Tellbrance_car}}</td>
            <td width="100px">โทร : {{$value->Tellagent_car}}</td>
            <td width="40px"></td>
            <td width="40px"></td>
            <td width="40px"></td>
          </tr>
        @endforeach
      </tbody>
    </table>


  </body>
</html>
