<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    @php
      function DateThai($strDate){
        $strYear = date("Y")+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
      function DateThai2($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }

    @endphp
  </head>
    <label align="right">วันที่ปริ้น : {{DateThai(date('Y-m-d'))}}</label>
    <h1 class="card-title p-3" align="center" style="line-height: 3px;">รายการทะเบียนรถ</h1>
      @if($type == 1)
        @if($newfdate != null)
          <h4 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">ระหว่างวันที่ {{DateThai2($newfdate)}} ถึงวันที่ {{DateThai2($newtdate)}}</h4>
        @else
          <h4 style="font-weight: bold;line-height:10px;"> </h4>
        @endif
      @endif
    <hr>
  <body>
    @if($type == 1)
        <br>
        <table border="1">
            <thead>
                <tr align="center" style="line-height: 150%;">
                    <th width="30px" align="center" style="background-color: #FFFF00;"><b>ลำดับ</b></th>
                    <th width="100px" align="center" style="background-color: #FFFF00;"><b>วันที่รับลูกค้า</b></th>
                    <th width="70px" align="center" style="background-color: #FFFF00;"><b>ทะเบียนเดิม</b></th>
                    <th width="70px" align="center" style="background-color: #FFFF00;"><b>ทะเบียนใหม่</b></th>
                    <th width="70px" align="center" style="background-color: #FFFF00;"><b>ยี่ห้อ</b></th>
                    <th width="200px" align="center" style="background-color: #FFFF00;"><b>ชื่อ-สกุล</b></th>
                    <th width="90px" align="center" style="background-color: #FFFF00;"><b>ชนิดการโอน</b></th>
                    <th width="60px" align="center" style="background-color: #FFFF00;"><b>บริษัท</b></th>
                    <th width="60px" align="center" style="background-color: #FFFF00;"><b>คงเหลือ</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $row)
                    @php
                     @$TotalRemain += $row->Remainfee_regis;
                    @endphp
                <tr style="line-height: 150%;">
                    <td width="30px" align="center">{{$key+1}}</td>
                    <td width="100px" align="center">{{DateThai2($row->Date_regis)}}</td>
                    <td width="70px" align="center">{{$row->Regno_regis}}</td>
                    <td width="70px" align="center">{{($row->NewReg_regis != '')?$row->NewReg_regis:'-'}}</td>
                    <td width="70px" align="center">{{($row->Brand_regis != '')?$row->Brand_regis:'-'}}</td>
                    <td width="200px" align="left"> {{$row->CustName_regis}}&nbsp;&nbsp;&nbsp;{{$row->CustSurN_regis}}</td>
                    <td width="90px" align="center">{{($row->TypeofReg_regis != '')?$row->TypeofReg_regis:'-'}}</td>
                    <td width="60px" align="center">{{($row->Comp_regis != '')?$row->Comp_regis:'-'}}</td>
                    <td width="60px" align="center">{{($row->Remainfee_regis != '')?$row->Remainfee_regis:'0.00'}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6"></td>
                    <td width="210px" align="center" style="background-color: #CCCCCC;">รวมคงเหลือ {{number_format(@$TotalRemain,2)}} บาท</td>
                </tr>
                <br>
            </tbody>
        </table>
    @elseif($type == 2)
      Receipt Page
    @endif
  </body>
</html>