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
        $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay/$strMonthThai/$strYear";
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
    <label align="right">วันที่ปริ้น : {{DateThai2(date('Y-m-d'))}}</label>
      @if($type == 1)
        <h1 class="card-title p-3" align="center" style="line-height: 3px;">
          รายงานเบิกไปขนส่ง @if($type == 1) @if($company != null) ({{$company}}) @endif @endif
        </h1>
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
                    <th width="20px" align="center" style="background-color: #FFFF00;"><b>ที่</b></th>
                    <th width="55px" align="center" style="background-color: #FFFF00;"><b>วันที่รับลูกค้า</b></th>
                    <th width="120px" align="center" style="background-color: #FFFF00;"><b>ชื่อ-สกุล</b></th>
                    <th width="70px" align="center" style="background-color: #FFFF00;"><b>ทะเบียน</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>รับลูกค้า</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ลอกลาย</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ใบเสร็จ</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ค่าช่าง</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ย้ายเข้า</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>โอน</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ภาษี</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ป้าย</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>คู่มือ</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>รถใหม่</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>แก้ไข</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>ยกเลิก</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>อื่น</b></th>
                    <th width="35px" align="center" style="background-color: #FFFF00;"><b>พิเศษ</b></th>
                    <th width="50px" align="center" style="background-color: #FFFF00;"><b>คงเหลือ</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $row)
                    @php
                     @$TotalRemain += $row->Remainfee_regis;
                     $Extra = $row->TransInAmt_regis + $row->TransAmt_regis + $row->TaxAmt_regis + $row->RegAmt_regis +
                              $row->DocAmt_regis + $row->NewCarAmt_regis + $row->FixAmt_regis + $row->CancelAmt_regis +
                              $row->OtherAmt_regis;
                     @$otalReceipt += $row->RecptAmt_regis;
                     @$TotalExtra += $Extra;
                    @endphp
                <tr style="line-height: 150%;">
                    <td width="20px" align="center">{{$key+1}}</td>
                    <td width="55px" align="center">{{DateThai($row->Date_regis)}}</td>
                    <td width="120px" align="left"> {{$row->CustName_regis}}&nbsp;&nbsp;{{$row->CustSurN_regis}}</td>
                    <td width="70px" align="center">{{$row->Regno_regis}}</td>
                    <td width="35px" align="center">{{($row->CustAmt_regis != '')?$row->CustAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->CopyAmt_regis != '')?$row->CopyAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->RecptAmt_regis != '')?$row->RecptAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->TechAmt_regis != '')?$row->TechAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->TransInAmt_regis != '')?$row->TransInAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->TransAmt_regis != '')?$row->TransAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->TaxAmt_regis != '')?$row->TaxAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->RegAmt_regis != '')?$row->RegAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->DocAmt_regis != '')?$row->DocAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->NewCarAmt_regis != '')?$row->NewCarAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->FixAmt_regis != '')?$row->FixAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->CancelAmt_regis != '')?$row->CancelAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{($row->OtherAmt_regis != '')?$row->OtherAmt_regis:'-'}}</td>
                    <td width="35px" align="center">{{$Extra}}</td>
                    <td width="50px" align="center">{{number_format(($row->Remainfee_regis != '')?$row->Remainfee_regis:'0.00',0)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td width="805px"></td>
                </tr>
                <tr>
                    <td width="300px" align="center" style="background-color: #CCCCCC;">รวมเงินตามใบเสร็จ {{number_format(@$otalReceipt,2)}} บาท</td>
                    <td width="245px" align="center" style="background-color: #CCCCCC;">รวมเงินค่าพิเศษ {{number_format(@$TotalExtra,2)}} บาท</td>
                    <td width="260px" align="center" style="background-color: #CCCCCC;">รวมเงินคงเหลือ {{number_format(@$TotalRemain,2)}} บาท</td>
                </tr>
                <br>
            </tbody>
        </table>
    @elseif($type == 2)
      Receipt Page
    @endif
  </body>
</html>