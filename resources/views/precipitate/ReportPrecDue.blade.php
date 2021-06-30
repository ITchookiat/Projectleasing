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
        //$strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
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
    @elseif($type == 5)
      @if($stylePDF == 1)
      <h2 class="card-title p-3" align="center">รายงาน สต็อกรถเร่งรัด</h2>
      @elseif($stylePDF == 2)
      <h1 class="card-title p-3" align="left">รายงาน การยึดรถ</h1>
      @endif
      @if($fdate != '')
      <h3 class="card-title p-3" align="left" style="line-height: -15px;">วันที่ {{ DateThai($fdate) }} ถึง {{ DateThai($tdate) }}</h3>
      @endif
    @elseif($type == 7)
      <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานโนติส</h2>
      <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    @elseif($type == 8)
      <h2 class="card-title p-3" align="center">รายงาน รับชำระค่าติดตาม</h2>
      <h3 class="card-title p-3" align="center">จากวันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }}</h3>
    @elseif($type == 9)
    <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานเร่งรัด</h2>
    <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    @elseif($type == 10)
    <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานเตรียมฟ้อง</h2>
    <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3>
    @endif
    <hr>
    <body>
    <br />
    @if($type == 1 or $type == 7 or $type == 9 or $type == 10)
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
                <td style="line-height:250%;" width="140px" align="left">&nbsp;{{iconv('Tis-620','utf-8',str_replace(" ","",$value->SNAM.$value->NAME1)."   ".str_replace(" ","",$value->NAME2))}}</td>
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
    @elseif($type == 5)
      @if($stylePDF == 1)
        <table border="1">
          <thead>
            <tr align="center" style="line-height: 250%;">
              <th align="center" width="30px" style="background-color: #33FF00;"><b>ลำดับ</b></th>
              <th align="center" width="65px" style="background-color: #BEBEBE;"><b>เลขที่สัญญา</b></th>
              <th align="center" width="120px" style="background-color: #BEBEBE;"><b>ชื่อ-สกุล</b></th>
              <th align="center" width="65px" style="background-color: #BEBEBE;"><b>ยี่ห้อ</b></th>
              <th align="center" width="65px" style="background-color: #BEBEBE;"><b>ทะเบียน</b></th>
              <th align="center" width="35px" style="background-color: #BEBEBE;"><b>ปีรถ</b></th>
              <th align="center" width="60px" style="background-color: #BEBEBE;"><b>วันที่ยึด</b></th>
              <th align="center" width="35px" style="background-color: #BEBEBE;"><b>ทีมยึด</b></th>
              <th align="center" width="50px" style="background-color: #BEBEBE;"><b>ค่ายึด</b></th>
              <th align="center" width="200px" style="background-color: #BEBEBE;"><b>รายละเอียด</b></th>
              <th align="center" width="90px" style="background-color: #BEBEBE;"><b>สถานะ</b></th>
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
                <td style="line-height:250%;" width="120px" align="left"> {{$value->Name_hold}} </td>
                <td style="line-height:250%;" width="65px" align="left"> {{$value->Brandcar_hold}} </td>
                <td style="line-height:250%;" width="65px"> {{$value->Number_Regist}} </td>
                <td style="line-height:250%;" width="35px"> {{$value->Year_Product}} </td>
                <td style="line-height:250%;" width="60px"> {{DateThai($value->Date_hold)}} </td>
                <td style="line-height:250%;" width="35px"> {{$value->Team_hold}} </td>
                <td style="line-height:250%;" width="50px"> {{number_format($value->Price_hold,0)}}&nbsp;</td>
                <td style="line-height:250%;" width="200px" align="left"> {{$value->Note_hold}} </td>
                <td style="line-height:250%;" width="90px" align="left">
                  @if($value->Statuscar == 1)
                  รถยึด
                  @elseif($value->Statuscar == 3)
                  รถยึด (Ploan)
                  @elseif($value->Statuscar == 2)
                  ลูกค้ามารับรถคืน
                  @elseif($value->Statuscar == 4)
                  รับรถจากของกลาง
                  @elseif($value->Statuscar == 5)
                    @if($value->StatSold_Homecar != NULL)
                      ส่งรถบ้าน(ขายแล้ว)
                    @else 
                      ส่งรถบ้าน
                    @endif
                  @elseif($value->Statuscar == 6)
                  ลูกค้าส่งรถคืน
                  @endif
                  &nbsp;
                </td>
              </tr>
            @endforeach
            <tr style="line-height: 200%;">
              <td style="background-color: yellow;" width="475px" align="right"><b>รวมยอดค่ายึด &nbsp;</b></td>
              <td width="50px" align="right"><b> {{number_format($total)}} &nbsp;</b></td>
              <td style="background-color: yellow;" width="290px"><b>&nbsp;บาท</b></td>
            </tr>
          </tbody>
        </table>
      @elseif($stylePDF == 2)
      <table border="0">
        <tr>
          <td align="left" width="500px">
            <table border="1">
                <tr align="center" style="line-height: 250%;">
                  <th align="center" width="150px" style="background-color: #BEBEBE;"><b>สถานะรถ</b></th>
                  <th align="center" width="70px" style="background-color: #BEBEBE;"><b>จำนวนคัน</b></th>
                  <th align="center" width="70px" style="background-color: #BEBEBE;"><b>เปอร์เซ็นต์</b></th>
                </tr>
              <tbody>
                @foreach($data as $key => $value)
                  @php
                    @$total += $value->Price_hold;
                  @endphp
                @endforeach
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถยึดเช่าซื้อ(ที่ลาน) </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$HoldcarLeasing + $CusSendCar}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round((($HoldcarLeasing + $CusSendCar) / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถยึด Ploan </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$HoldcarPloan}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($HoldcarPloan / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <!-- <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> ลูกค้ามารับรถคืน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$CusGetBack}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($CusGetBack / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr> -->
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> ลูกค้ามาส่งรถคืน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$CusSendCar}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($CusSendCar / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> อยู่รถบ้าน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$HomecarSock}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($HomecarSock / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถบ้านตัดขายแล้ว </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$HomecarSoldout}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($HomecarSoldout / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;background-color: yellow; ">
                  <td style="line-height:250%;" width="150px" align="left"> รวมคัน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{$HoldcarAll}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($HoldcarAll / $HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
              </tbody>
            </table>
          </td>
          <td align="left">
            <table border="1">
                <tr align="center" style="line-height: 250%;">
                  <th align="center" width="150px" style="background-color: #BEBEBE;"><b>สถานะรถ</b></th>
                  <th align="center" width="70px" style="background-color: #BEBEBE;"><b>ค่ายึด</b></th>
                  <th align="center" width="70px" style="background-color: #BEBEBE;"><b>เปอร์เซ็นต์</b></th>
                </tr>
              <tbody>
                @foreach($data as $key => $value)
                  @php
                    @$total += $value->Price_hold;
                  @endphp
                @endforeach
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถยึดเช่าซื้อ(ที่ลาน) </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_HoldcarLeasing)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round((($Sum_HoldcarLeasing + $Sum_CusGetBack) / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถยึด Ploan </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_HoldcarPloan)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_HoldcarPloan / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <!-- <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> ลูกค้ามารับรถคืน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_CusGetBack)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_CusGetBack / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr> -->
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> ลูกค้ามาส่งรถคืน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_CusSendCar)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_CusSendCar / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> อยู่รถบ้าน </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_HomecarSock)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_HomecarSock / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;">
                  <td style="background-color: #A3F95A; line-height:250%;" align="left" width="150px"> รถบ้านตัดขายแล้ว </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_HomecarSoldout)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_HomecarSoldout / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
                <tr align="center" style="line-height: 200%;background-color: yellow; ">
                  <td style="line-height:250%;" width="150px" align="left"> รวมค่ายึด </td>
                  <td style="line-height:250%;" width="70px" align="right"> {{number_format($Sum_HoldcarAll)}} &nbsp;</td>
                  <td style="line-height:250%;" width="70px" align="right"> {{round(($Sum_HoldcarAll / $Sum_HoldcarAll) * 100)}}% &nbsp;</td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>
      @endif
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
