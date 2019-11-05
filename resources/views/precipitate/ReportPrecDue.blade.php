<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    @php
      function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
    @endphp

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
    @if($type == 1)
    <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานตาม</h2>
    @elseif($type == 5)
    <h2 class="card-title p-3" align="center">รายงาน สต็อกรถเร่งรัด</h2>
      @if($fdate != '')
    <h3 class="card-title p-3" align="center">วันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }}</h3>
      @endif
    @endif
    <hr>
    <body>
    <br />
    @if($type != 5)
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 250%;">
          <th align="center" width="40px" style="background-color: #33FF00;"><b>ลำดับ</b></th>
          <th align="center" width="70px" style="background-color: #BEBEBE;"><b>เลขที่สัญญา</b></th>
          <th align="center" width="100px" style="background-color: #BEBEBE;"><b>ชื่อ-สกุล</b></th>
          <th align="center" width="100px" style="background-color: #BEBEBE;"><b>ชำระล่าสุด</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>งวดละ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>ค้างชำระ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>งวดจริง</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>คงเหลือ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>เลขทะเบียน</b></th>
          <th align="center" width="60px" style="background-color: #FFFF00;"><b>พนง</b></th>
          <th align="center" width="60px" style="background-color: #FFFF00;"><b>สถานะ</b></th>
          <th align="center" width="80px" style="background-color: #FFFF00;"><b>หมายเหตุ</b></th>
        </tr>
      </thead>
      <tbody>
          @foreach($data as $key => $value)
          <tr align="center" style="line-height: 200%;">
            <td style="background-color: #33FF00; line-height:250%;" width="40px">{{$key+1}}</td>
            <td style="line-height:250%;" width="70px">{{$value->CONTNO}}</td>
            <td style="line-height:250%;" width="100px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->SNAM.$value->NAME1)."   ".str_replace(" ","",$value->NAME2))}}</td>
            <td style="line-height:250%;" width="100px">{{DateThai($value->LPAYD)}}</td>
            <td style="line-height:250%;" width="60px">{{$value->DAMT}}</td>
            <td style="line-height:250%;" width="60px">{{$value->EXP_AMT}}</td>
            <td style="line-height:250%;" width="60px">{{$value->HLDNO}}</td>
            <td style="line-height:250%;" width="60px">{{$value->BALANC - $value->SMPAY}}</td>
            <td style="line-height:250%;" width="60px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->REGNO)) }}</td>
            <td style="line-height:250%;" width="60px">{{$value->BILLCOLL}}</td>
            <td style="line-height:250%;" width="60px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->CONTSTAT)) }}</td>
            <td style="line-height:250%;" width="80px"></td>
          </tr>
          @endforeach
      </tbody>
    </table>
    @elseif($type == 5)
    <!-- <h2 class="card-title p-3" align="center">รายงาน สต็อกรถเร่งรัด</h2>
    <hr>
    <br/> -->
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 250%;">
          <th align="center" width="30px" style="background-color: #33FF00;"><b>ลำดับ</b></th>
          <th align="center" width="65px" style="background-color: #BEBEBE;"><b>เลขที่สัญญา</b></th>
          <th align="center" width="150px" style="background-color: #BEBEBE;"><b>ชื่อ-สกุล</b></th>
          <th align="center" width="80px" style="background-color: #BEBEBE;"><b>ยี่ห้อ</b></th>
          <th align="center" width="70px" style="background-color: #BEBEBE;"><b>ทะเบียน</b></th>
          <th align="center" width="35px" style="background-color: #BEBEBE;"><b>ปีรถ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>วันที่ยึด</b></th>
          <th align="center" width="35px" style="background-color: #BEBEBE;"><b>ทีมยึด</b></th>
          <th align="center" width="45px" style="background-color: #BEBEBE;"><b>ค่ายึด</b></th>
          <th align="center" width="150px" style="background-color: #BEBEBE;"><b>รายละเอียด</b></th>
          <th align="center" width="90px" style="background-color: #FFFF00;"><b>สถานะ</b></th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $key => $value)
          @php
            @$total += $value->Price_hold;
          @endphp
        <tr align="center" style="line-height: 200%;">
          <td style="background-color: #33FF00; line-height:250%;" width="30px"> {{$key+1}} </td>
          <td style="line-height:250%;" width="65px"> {{$value->Contno_hold}} </td>
          <td align="left" style="line-height:250%;" width="150px"> {{$value->Name_hold}} </td>
          <td style="line-height:250%;" width="80px"> {{$value->Brandcar_hold}} </td>
          <td style="line-height:250%;" width="70px"> {{$value->Number_Regist}} </td>
          <td style="line-height:250%;" width="35px"> {{$value->Year_Product}} </td>
          <td style="line-height:250%;" width="60px"> {{DateThai($value->Date_hold)}} </td>
          <td style="line-height:250%;" width="35px"> {{$value->Team_hold}} </td>
          <td style="line-height:250%;" width="45px"> {{number_format($value->Price_hold,0)}}&nbsp;</td>
          <td style="line-height:250%;" width="150px" align="left"> {{$value->Note_hold}} </td>
          <td style="line-height:250%;" width="90px">
            @if($value->Statuscar == 1)
            ยึดจากลูกค้าครั้งแรก
            @elseif($value->Statuscar == 2)
            ลูกค้ามารับรถคืน
            @elseif($value->Statuscar == 3)
            ยึดจากลูกค้าครั้งที่สอง
            @elseif($value->Statuscar == 4)
            รับรถจากของกลาง
            @elseif($value->Statuscar == 5)
            ส่งรถบ้าน
            @endif
            &nbsp;
          </td>
        </tr>
        @endforeach
        <tr style="line-height: 200%;">
          <td width="525px" align="right"><b>รวมยอดค่ายึด &nbsp;</b></td>
          <td width="45px" align="center"><b> {{number_format($total)}} </b></td>
          <td><b>&nbsp;บาท</b></td>
        </tr>
      </tbody>
    </table>
    @endif
  </body>
</html>
