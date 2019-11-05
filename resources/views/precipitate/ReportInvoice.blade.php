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
    <label align="right">วันที่ : <u>{{DateThai($date)}}</u></label>
    <h2 class="card-title p-3" align="center">รายงาน ใบแจ้งหนี้ (บริษัท ชูเกียรติลิสซิ่ง จำกัด)</h2>
  <body>

    @foreach($data as $key => $value)
      <h3 align="left"><u>ประวัติผู้เช่าซื้อ/กู้</u></h3>
      <br />
      <table border="0">
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>เลขที่สัญญา</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ชือ - สกุล</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->NAME1." ".$value->NAME2) }}</td>
          <td width="50px"><b>ชือเล่น</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->NICKNM) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ที่อยู่</b></td>
          <td width="400px">{{ iconv('TIS-620', 'utf-8', $value->ADDRES) }}&nbsp;&nbsp;&nbsp;ตำบล{{ iconv('TIS-620', 'utf-8', $value->TUMB) }}&nbsp;&nbsp;&nbsp;อำเภอ{{ iconv('TIS-620', 'utf-8', $value->AUMPDES) }}&nbsp;&nbsp;&nbsp;จังหวัด{{ iconv('TIS-620', 'utf-8', $value->PROVDES) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ทีทำงาน</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->CUSOFFIC) }}</td>
          <td width="50px"><b>เบอร์โทร</b></td>
          <td width="200px">{{$value->TELP}}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="50px"><b>หมายเหตุ</b></td>
          <td width="400px">{{ iconv('TIS-620', 'utf-8', $value->CUSMEMO) }}</td>
        </tr>
      </table>

      <h3 align="left"><u>ผู้ค่ำประกัน</u></h3>
      <br />
      <table border="0">
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ชือ - สกุล</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->NAME) }}</td>
          <td width="50px"><b>ชือเล่น</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->NICKARMGAR) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ที่อยู่</b></td>
          <td width="400px">{{ iconv('TIS-620', 'utf-8', $value->ADDARMGAR) }}&nbsp;&nbsp;&nbsp;ตำบล{{ iconv('TIS-620', 'utf-8', $value->TUMBARMGAR) }}&nbsp;&nbsp;&nbsp;อำเภอ{{ iconv('TIS-620', 'utf-8', $value->AUMARMGAR) }}&nbsp;&nbsp;&nbsp;จังหวัด{{ iconv('TIS-620', 'utf-8', $value->PROARMGAR) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ทีทำงาน</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->OFFICARMGAR) }}</td>
          <td width="50px"><b>เบอร์โทร</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->TELPARMGAR) }}</td>
        </tr>
      </table>

      <h3 align="left"><u>รายละเอียดรถยนต์</u></h3>
      <br />
      <table border="0">
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ยี่ห้อ</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->TYPE) }}</td>
          <td width="80px"><b>แบบ</b></td>
          <td width="100px">{{$value->MODEL}}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>สี</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->COLOR) }}</td>
          <td width="80px"><b>หมายเลขตัวถัง</b></td>
          <td width="200px">{{ iconv('TIS-620', 'utf-8', $value->STRNO) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>หมายเลขเครื่อง</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->ENGNO) }}</td>
          <td width="80px"><b>หมายเลขทะเบียน</b></td>
          <td width="100px">{{ iconv('TIS-620', 'utf-8', $value->REGNO) }}</td>
        </tr>
      </table>

      <h3 align="left"><u>รายละเอียดสัญญา</u></h3>
      <br />
      <table border="" width="100%">
          <tr style="line-height: 220%;">
              <td width="4%"></td>
              <!-- ฝั่งซ้าย -->
              <td width="33%">
                <!-- บน -->
                <table border="">
                  <tr>
                    <td width="100px"><b>วันทำสัญญา</b></td>
                    <td width="140px">{{DateThai($value->SDATE)}}</td>
                  </tr>
                  <tr>
                    <td width="100px"><b>จำนวนงวด</b></td>
                    <td width="140px">{{$value->T_NOPAY}}</td>
                  </tr>
                  <tr>
                    <td width="100px"><b>วันที่ผ่อนงวดแรก</b></td>
                    <td width="140px">{{DateThai($value->FDATE)}}</td>
                  </tr>
                  <tr>
                    <td width="100px"><b>วันที่ผ่อนงวดสุดท้าย</b></td>
                    <td width="140px">{{DateThai($value->LDATE)}}</td>
                  </tr>
                </table>
                <br>
                <br>
                <!-- ล่าง -->
                <table style="border-top-style: dashed;border-bottom-style: dashed;border-left-style: dashed;border-right-style: dashed;">
                  <tr style="line-height: 220%;">
                    <td>
                      <table border="0">
                        <tr>
                          <td width="100px"><b>วันที่ชำระล่าสุด</b></td>
                          <td width="70px" align="right">{{DateThai($value->LPAYD)}}</td>
                        </tr>
                        <tr>
                          <td width="100px"><b>จำนวนเงินชำระล่าสุด</b></td>
                          <td width="70px" align="right">{{number_format($value->LPAYA, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="100px"><b>ลูกหนี้คงเหลือ</b></td>
                          <td width="70px" align="right">{{number_format($value->BALANC - $value->SMPAY, 2)}}</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>

              <td width="10%"></td>
              <!-- ฝั่งขวา -->
              <td width="50%">
                <table style="border-top-style: dashed;border-bottom-style: dashed;border-left-style: dashed;border-right-style: dashed;">
                  <tr style="line-height: 200%;">
                    <td>
                      <table border="0">
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>ผ่อนงวดละ</b></td>
                          <td width="90px" colspan="2" align="right">{{number_format($value->T_LUPAY, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>ชำระแล้ว</b></td>
                          <td width="90px" colspan="2" align="right">{{number_format($value->SMPAY, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>คงค้าง งวด</b></td>
                          <td width="90px" colspan="2" align="right">{{number_format($value->HLDNO, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="30px"><b>งวดที่ :</b></td>
                          <td width="70px" align="center">{{$value->EXP_FRM}}</td>
                          <td width="40px"><b>ถึงงวดที่ :</b></td>
                          <td width="50px" align="right">{{$value->EXP_TO}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>ยอดเงินคงค้าง</b></td>
                          <td width="90px" colspan="2" align="right">{{number_format($value->EXP_AMT, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>เบี้ยปรับ</b></td>
                          <td width="90px" colspan="2" align="right">{{number_format($SumPay, 2)}}</td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>ค่าตาม+ค่าบอกเลิก</b></td>
                          <td width="90px" colspan="2" align="right">
                            @if($type == 2)
                              @if($value->HLDNO < 1.99)
                                @php
                                  $Count = 1200 + 850;
                                @endphp
                              @elseif($value->HLDNO < 2.99)
                                @php
                                  $Count = 2400 + 850;
                                @endphp
                              @elseif($value->HLDNO < 3.99)
                                @php
                                  $Count = 3600 + 850;
                                @endphp
                              @elseif($value->HLDNO < 4.69)
                                @php
                                  $Count = 4800 + 850;
                                @endphp
                              @endif
                              {{number_format($Count, 2)}}
                            @elseif($type == 4)
                              @if($value->HLDNO < 4.99)
                                @php
                                  $Count = 8800 + 850;
                                @endphp
                              @elseif($value->HLDNO < 5.69)
                                @php
                                  $Count = 11000 + 850;
                                @endphp
                              @endif
                              {{number_format($Count, 2)}}
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>ค่าโนติส</b></td>
                          <td width="90px" colspan="2" align="right">
                            @php
                              $Notice = 0;
                            @endphp
                            @if($type == 2)
                              @php
                                $Notice = 0;
                              @endphp
                            @elseif($type == 4)
                              @php
                                $Notice = 1500;
                              @endphp
                            @endif
                            {{number_format($Notice, 2)}}
                          </td>
                        </tr>
                        <tr>
                          <td width="10px"></td>
                          <td width="100px" colspan="2"><b>รวมยอด</b></td>
                          <td width="90px" colspan="2" align="right">
                            @php
                              $Sum = $value->EXP_AMT + $SumPay + $Count + $Notice;
                            @endphp
                            {{number_format($Sum, 2)}}
                          </td>
                        </tr>
                      </table>
                    </td>
                   </tr>
                </table>
              </td>
          </tr>
      </table>

      <h3 align="left"><u>ผู้แนะนำ</u></h3>
      <br />
      <table border="0">
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ชือ - สกุล</b></td>
          <td width="150px">{{ iconv('TIS-620', 'utf-8', $value->FNAME." ".$value->LNAME) }}</td>
          <td width="80px"><b>เลขผู้แนะนำ</b></td>
          <td width="80px">{{$value->MEMBERID}}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>ที่อยู่</b></td>
          <td width="400px">{{ iconv('TIS-620', 'utf-8', $value->ADDRESS) }}</td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="80px"><b>เบอร์โทร</b></td>
          <td width="80px">{{ iconv('TIS-620', 'utf-8', $value->TELPTBROKER) }}</td>
        </tr>
      </table>
      <table border="0">
        <tr style="line-height:10%;">
          <td></td>
        </tr>
        <tr style="line-height: 200%;">
          <td width="30px"></td>
          <td width="40px"><b>ผู้ติดตาม</b></td>
          <td width="190px">..............................................................</td>
          <td width="50px"><b>วันที่ส่งงาน</b></td>
          <td width="190px">......................................................................</td>
        </tr>
        <tr style="line-height: 150%;">
          <td width="30px"></td>
          <td width="50px"><b>ผลการตาม</b></td>
          <td width="460px">
            ...................................................................................
            ............................................................................
          </td>
        </tr>
        <tr style="line-height: 150%;">
          <td width="30px"></td>
          <td width="50px"></td>
          <td width="460px">
            ...................................................................................
            ............................................................................
          </td>
        </tr>
      </table>
    @endforeach

  </body>
</html>
