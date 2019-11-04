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
      <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    @elseif($type == 7)
      <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานโนติส</h2>
      <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    @elseif($type == 8)
      <h2 class="card-title p-3" align="center">รายงาน รับชำระค่าติดตาม</h2>
      <h3 class="card-title p-3" align="center">จากวันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }}</h3>
    @endif
    <hr>
  <body>
    <br />
    @if($type == 1 or $type == 7)
      <table border="1">
        <thead>
          <tr align="center" style="line-height: 250%;">
            <th align="center" width="40px" style="background-color: #33FF00;"><b>ลำดับ</b></th>
            <th align="center" width="70px" style="background-color: #BEBEBE;"><b>เลขที่สัญญา</b></th>
            <th align="center" width="140px" style="background-color: #BEBEBE;"><b>ชื่อ-สกุล</b></th>
            <th align="center" width="70px" style="background-color: #BEBEBE;"><b>ชำระล่าสุด</b></th>
            <th align="center" width="50px" style="background-color: #BEBEBE;"><b>งวดละ</b></th>
            <th align="center" width="50px" style="background-color: #BEBEBE;"><b>ค้างชำระ</b></th>
            <th align="center" width="40px" style="background-color: #BEBEBE;"><b>งวดจริง</b></th>
            <th align="center" width="60px" style="background-color: #BEBEBE;"><b>คงเหลือ</b></th>
            <th align="center" width="60px" style="background-color: #BEBEBE;"><b>เลขทะเบียน</b></th>
            <th align="center" width="40px" style="background-color: #FFFF00;"><b>พนง</b></th>
            <th align="center" width="40px" style="background-color: #FFFF00;"><b>สถานะ</b></th>
            <th align="center" width="150px" style="background-color: #FFFF00;"><b>หมายเหตุ</b></th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $value)
              <tr align="center" style="line-height: 200%;">
                <td style="background-color: #33FF00; line-height:250%;" width="40px">{{$key+1}}</td>
                <td style="line-height:250%;" width="70px">{{$value->CONTNO}}</td>
                <td style="line-height:250%;" width="140px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->SNAM.$value->NAME1)."   ".str_replace(" ","",$value->NAME2))}}</td>
                <td style="line-height:250%;" width="70px">{{DateThai($value->LPAYD)}}</td>
                <td style="line-height:250%;" width="50px">{{number_format($value->DAMT, 2)}}</td>
                <td style="line-height:250%;" width="50px">{{number_format($value->EXP_AMT, 2)}}</td>
                <td style="line-height:250%;" width="40px">{{$value->HLDNO}}</td>
                <td style="line-height:250%;" width="60px">{{number_format($value->BALANC - $value->SMPAY, 2)}}</td>
                <td style="line-height:250%;" width="60px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->REGNO)) }}</td>
                <td style="line-height:250%;" width="40px">{{$value->BILLCOLL}}</td>
                <td style="line-height:250%;" width="40px">{{iconv('Tis-620','utf-8',str_replace(" ","",$value->CONTSTAT)) }}</td>
                <td style="line-height:250%;" width="150px"></td>
              </tr>
              @if($key == 15 && $key != $CountData)
                <div style="height: 0 !important; page-break-after: always !important;"></div>
              @endif
            @endforeach
        </tbody>
      </table>
    @elseif($type == 8)
      <table border="0">
        <tr style="line-height: 220%;">
          <td width="13%"></td>
          <td>
            <table border="1">
              <thead>
                <tr align="center" style="line-height: 250%;">
                  <th width="100px" style="background-color: #FFCC00;"><b>ลำดับ</b></th>
                  <th width="180px" style="background-color: #FFCC00;"><b>ชื่อ</b></th>
                  <th width="150px" style="background-color: #FFCC00;"><b>ค่าตาม</b></th>
                  <th width="150px" style="background-color: #FFCC00;"><b>รวมรายได้</b></th>
                </tr>
              </thead>
              <tbody>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">1</td>
                    <td style="line-height:250%;" width="180px">ทีมแบเลาะ</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary102, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary102, 2)}}</td>
                  </tr>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">2</td>
                    <td style="line-height:250%;" width="180px">ทีมแบฮะ</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary104, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary104, 2)}}</td>
                  </tr>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">3</td>
                    <td style="line-height:250%;" width="180px">ทีมพี่เบร์</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary105, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary105, 2)}}</td>
                  </tr>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">4</td>
                    <td style="line-height:250%;" width="180px">ทีมแบยี</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary113, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary113, 2)}}</td>
                  </tr>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">5</td>
                    <td style="line-height:250%;" width="180px">ทีมแบลัง</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary112, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary112, 2)}}</td>
                  </tr>
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">6</td>
                    <td style="line-height:250%;" width="180px">ทีมแบนัน</td>
                    <td style="line-height:250%;" width="150px">{{number_format($summary114, 2)}}</td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summary114, 2)}}</td>
                  </tr>
                    @if($DataOffice != Null)
                      <tr align="center" style="line-height: 200%;">
                        <td style="background-color: #33FF00; line-height:250%;" width="100px">7</td>
                        <td style="line-height:250%;" width="180px">บริษัท</td>
                        <td style="line-height:250%;" width="150px">{{number_format($summaryCKL, 2)}}</td>
                        <td style="background-color: #33FF00; line-height:250%;" width="150px">{{number_format($summaryCKL, 2)}}</td>
                      </tr>
                    @else
                      @php
                        $summaryCKL = 0;
                      @endphp
                    @endif
                  <tr align="center" style="line-height: 200%;">
                    <td style="background-color: #33FF00; line-height:250%;" width="100px">ผลรวมทั้งหมด</td>
                    <td style="line-height:250%;" width="330px"></td>
                    <td style="background-color: #33FF00; line-height:250%;" width="150px">
                      {{number_format($summary102+$summary104+$summary105+$summary113+$summary112+$summary114+$summaryCKL, 2)}}
                    </td>
                  </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>
    @endif
  </body>
</html>
