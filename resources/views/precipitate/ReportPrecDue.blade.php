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
    @elseif($type == 7)
      <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานโนติส</h2>
    @endif
    <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    <hr>
  <body>
    <br />
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 250%;">
          <th align="center" width="40px" style="background-color: #33FF00;"><b>ลำดับ</b></th>
          <th align="center" width="70px" style="background-color: #BEBEBE;"><b>เลขที่สัญญา</b></th>
          <th align="center" width="140px" style="background-color: #BEBEBE;"><b>ชื่อ-สกุล</b></th>
          <th align="center" width="80px" style="background-color: #BEBEBE;"><b>ชำระล่าสุด</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>งวดละ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>ค้างชำระ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>งวดจริง</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>คงเหลือ</b></th>
          <th align="center" width="60px" style="background-color: #BEBEBE;"><b>เลขทะเบียน</b></th>
          <th align="center" width="50px" style="background-color: #FFFF00;"><b>พนง</b></th>
          <th align="center" width="50px" style="background-color: #FFFF00;"><b>สถานะ</b></th>
          <th align="center" width="80px" style="background-color: #FFFF00;"><b>หมายเหตุ</b></th>
        </tr>
      </thead>
      <tbody>
          @foreach($data as $key => $value)
            <tr align="center" style="line-height: 200%;">
              <td style="background-color: #33FF00; line-height:250%;" width="40px">{{$key+1}}</td>
              <td style="line-height:250%;" width="70px">{{$value->CONTNO}}</td>
              <td style="line-height:250%;" width="140px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->SNAM.$value->NAME1)."   ".str_replace(" ","",$value->NAME2))}}</td>
              <td style="line-height:250%;" width="80px">{{DateThai($value->LPAYD)}}</td>
              <td style="line-height:250%;" width="60px">{{$value->DAMT}}</td>
              <td style="line-height:250%;" width="60px">{{$value->EXP_AMT}}</td>
              <td style="line-height:250%;" width="60px">{{$value->HLDNO}}</td>
              <td style="line-height:250%;" width="60px">{{$value->BALANC - $value->SMPAY}}</td>
              <td style="line-height:250%;" width="60px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->REGNO)) }}</td>
              <td style="line-height:250%;" width="50px">{{$value->BILLCOLL}}</td>
              <td style="line-height:250%;" width="50px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->CONTSTAT)) }}</td>
              <td style="line-height:250%;" width="80px"></td>
            </tr>
            @if($key == 15 && $key != $CountData)
              <div style="height: 0 !important; page-break-after: always !important;"></div>
            @endif
          @endforeach
      </tbody>
    </table>
  </body>
</html>
