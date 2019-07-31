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

    <SCRIPT>
    function toggleOption(thisselect) {
        var selected = thisselect.options[thisselect.selectedIndex].value;
        toggleRow(selected);
    }

    function toggleRow(id) {
      var row = document.getElementById(id);
      if (row.style.display == '') {
        row.style.display = 'none';
      }
      else {
         row.style.display = '';
      }
    }

    function showRow(id) {
      var row = document.getElementById(id);
      row.style.display = '';
    }

    function hideRow(id) {
      var row = document.getElementById(id);
      row.style.display = 'none';
    }

    function hideAll() {
     hideRow('optionA');
     hideRow('optionB');
     hideRow('optionC');
     hideRow('optionD');
   }

</SCRIPT>

  </head>
    <label align="right">วันที่ : <u>{{$date2}}</u></label>
    <h2 class="card-title p-3" align="center">รายงานนำเสนอ</h2>
    <hr>
  <body>
    <br />
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 250%;">
          <th align="center" width="50px" style="background-color: #33FF00;"><b>ยี่ห้อ</b></th>
          <th align="center" width="25px" style="background-color: #BEBEBE;"><b>สาขา</b></th>
          <th align="center" width="50px" style="background-color: #BEBEBE;"><b>ทะเบียน</b></th>
          <th align="center" width="40px" style="background-color: #BEBEBE;"><b>ยอดจัด</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>เพิ่มเติม</b></th>
          <th align="center" width="40px" style="background-color: #FFFF00;"><b>คจช.ขนส่ง</b></th>
          <th align="center" width="30px" style="background-color: #FFFF00;"><b>อื่นๆ</b></th>
          <th align="center" width="40px" style="background-color: #FFFF00;"><b>ค่าประเมิน</b></th>
          <th align="center" width="30px" style="background-color: #FFFF00;"><b>อากร</b></th>
          <th align="center" width="40px" style="background-color: #FFFF00;"><b>การตลาด</b></th>
          <th align="center" width="50px" style="background-color: #BEBEBE;"><b>รวมค่าใช้จ่าย</b></th>
          <th align="center" width="40px" style="background-color: #BEBEBE;"><b>คงเหลือ</b></th>
          <th align="center" width="35px" style="background-color: #BEBEBE;"><b>หัก 3%</b></th>
          <th align="center" width="105px" style="background-color: #BEBEBE;"><b>ผู้รับเงิน</b></th>
          <th align="center" width="105px" style="background-color: #BEBEBE;"><b>ผู้รับคอม</b></th>
          <th align="center" width="50px" style="background-color: #BEBEBE;"><b>รวม</b></th>
        </tr>
      </thead>
      <tbody>
        @foreach($dataReport as $key => $value)


          <tr align="center" style="line-height: 200%;">
            <td width="50px" rowspan="3" style="background-color: #33FF00; line-height:550%;">{{$value->Brand_car}}</td>
            <td width="25px" rowspan="3" style="line-height:550%;">
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
            <td width="50px" rowspan="3" style="line-height:550%;">{{$value->License_car}}</td>
            <td width="40px" rowspan="3" style="line-height:550%;">{{number_format($value->Top_car)}}</td>
            <td width="60px">
              @if($value->act_Price != 0)
                พรบ. {{number_format($value->act_Price)}}
              @endif
            </td>
            <td width="40px" rowspan="3" style="background-color: #FFFF00; line-height:550%;">{{number_format($value->tran_Price)}}</td>
            <td width="30px" rowspan="3" style="background-color: #FFFF00; line-height:550%;">{{number_format($value->other_Price)}}</td>
            <td width="40px" rowspan="3" style="background-color: #FFFF00; line-height:550%;">{{ $value->evaluetion_Price }}</td>
            <td width="30px" rowspan="3" style="background-color: #FFFF00; line-height:550%;">{{ $value->duty_Price }}</td>
            <td width="40px" rowspan="3" style="background-color: #FFFF00; line-height:550%;">{{ $value->marketing_Price }}</td>
            <td width="50px" rowspan="3" style="line-height:550%;">{{number_format($value->totalk_Price)}}</td>
            <td width="40px" rowspan="3" style="line-height:550%;">{{number_format($value->balance_Price)}}</td>
            <td width="35px" rowspan="3" style="line-height:550%;">{{number_format($value->commit_Price)}}</td>
            <td width="105px">{{$value->Payee_car}}</td>
            <td width="105px">{{$value->Agent_car}}</td>
            <td width="50px">
              @if($value->Accountbrance_car == $value->Accountagent_car and $value->Accountbrance_car != Null)
                @php
                    $ArcSum = $value->balance_Price + $value->commit_Price;
                @endphp
                {{number_format($ArcSum)}}
              @elseif($value->Accountbrance_car == Null)
                สด {{number_format($value->balance_Price)}}
              @else
                รถ {{number_format($value->balance_Price)}}
              @endif
            </td>
          </tr>
          <tr align="center" style="line-height: 200%;">
            <td width="60px">
              @if($value->closeAccount_Price != 0)
                ปิดบัญชี {{number_format($value->closeAccount_Price)}}
              @endif
            </td>
            <td width="105px">
              @if($value->Accountbrance_car != Null)
                บัญชี :{{$value->Accountbrance_car}}/{{$value->branchbrance_car}}
              @endif
            </td>
            <td width="105px">
              @if($value->Accountagent_car != Null)
                บัญชี :{{$value->Accountagent_car}}/{{$value->branchAgent_car}}
              @endif
            </td>
            <td width="50px">
              @if($value->Accountbrance_car != $value->Accountagent_car and $value->Accountagent_car != Null)
                คอม {{ number_format($value->commit_Price) }}
              @elseif($value->Accountagent_car == Null and $value->Agent_car != Null)
                สด {{number_format($value->commit_Price)}}
              @elseif($value->Accountagent_car == Null)

              @endif
            </td>
          </tr>
          <tr align="center" style="line-height: 200%;">
            <td width="60px">
              @if($value->P2_Price != 0)
                @if($value->P2_Price > 6700)
                  ซื้อป1 {{number_format($value->P2_Price)}}
                @else
                  ซื้อป2+ {{number_format($value->P2_Price)}}
                @endif
              @endif
            </td>
            <td width="105px">
              @if($value->Tellbrance_car != Null)
                โทร : {{$value->Tellbrance_car}}
              @endif
            </td>
            <td width="105px">
              @if($value->Tellagent_car != Null)
                  โทร : {{$value->Tellagent_car}}
              @endif
            </td>
            <td width="50px"></td>
          </tr>

          <br>
          @if($key == 6)
          <!-- <div style="height: 0 !important; page-break-after: always !important;">
          </div>
          <tr id="optionA">
            <td></td>
          </tr> -->

          @endif
        @endforeach
      </tbody>
    </table>



  </body>
</html>
