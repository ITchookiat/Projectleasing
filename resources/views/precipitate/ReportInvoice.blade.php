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
      <h4 align="left"><u>ประวัติผู้เช่าซื้อ/กู้</u></h4>
      <table border="0">
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>เลขที่สัญญา</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>ชือ - สกุล</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>ชือเล่น</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>ที่อยู่</b></td>
          <td width="400px">{{$value->CONTNO}}&nbsp;&nbsp;&nbsp;ตำบล {{$value->CONTNO}}&nbsp;&nbsp;&nbsp;อำเภอ {{$value->CONTNO}}&nbsp;&nbsp;&nbsp;จังหวัด {{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>เบอร์โทร</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>ทีทำงาน</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>หมายเหตุ</b></td>
          <td width="400px">{{$value->CONTNO}}</td>
        </tr>
      </table>

      <h4 align="left"><u>ผู้ค่ำประกัน</u></h4>
      <table border="0">
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>ชือ - สกุล</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>ชือเล่น</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>ที่อยู่</b></td>
          <td width="400px">{{$value->CONTNO}}&nbsp;&nbsp;&nbsp;ตำบล {{$value->CONTNO}}&nbsp;&nbsp;&nbsp;อำเภอ {{$value->CONTNO}}&nbsp;&nbsp;&nbsp;จังหวัด {{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>เบอร์โทร</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>ทีทำงาน</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
      </table>

      <h4 align="left"><u>รายละเอียดรถยนต์</u></h4>
      <table border="0">
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>ยี่ห้อ</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>แบบ</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>สี</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>หมายเลขตัวถัง</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
        <tr style="line-height: 240%;">
          <td width="30px"></td>
          <td width="80px"><b>หมายเลขเครื่อง</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
          <td width="80px"><b>หมายเลขทะเบียน</b></td>
          <td width="80px">{{$value->CONTNO}}</td>
        </tr>
      </table>

      <h4 align="left"><u>รายละเอียดสัญญา</u></h4>
      <table border="0">
        <tr>
          <td>
            <br />
            <table border="0">
              <tr style="line-height: 240%;">
                <td width="30px"></td>
                <td width="80px"><b>วันที่ทำสัญญา</b></td>
                <td width="160px">{{$value->CONTNO}}</td>
              </tr>
              <tr style="line-height: 240%;">
                <td width="30px"></td>
                <td width="80px"><b>จำนวนงวด</b></td>
                <td width="160px">{{$value->CONTNO}}</td>
              </tr>
              <tr style="line-height: 240%;">
                <td width="30px"></td>
                <td width="80px"><b>วันที่ผ่อนงวดแรก</b></td>
                <td width="160px">{{$value->CONTNO}}</td>
              </tr>
              <tr style="line-height: 240%;">
                <td width="30px"></td>
                <td width="80px"><b>วันที่ผ่อนงวดสุดท้าย</b></td>
                <td width="160px">{{$value->CONTNO}}</td>
              </tr>
            </table>
            <!-- <table border="1"><tr><td></td></tr></table> -->
            <p style="line-height: 10%;"></p>
            <table border="1" style="width: 230px;"><br />
              <table border="0">
                <tr style="line-height: 240%;">
                  <td width="30px"></td>
                  <td width="80px"><b>วันที่ชำระล่าสุด</b></td>
                  <td width="120px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 240%;">
                  <td width="30px"></td>
                  <td width="80px"><b>จำนนวนเงินชำระล่าสุด</b></td>
                  <td width="120px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 240%;">
                  <td width="30px"></td>
                  <td width="80px"><b>วันที่ผ่อนงวดแรก</b></td>
                  <td width="120px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 240%;">
                  <td width="30px"></td>
                  <td width="80px"><b>ลูกหนี้คงเหลือ</b></td>
                  <td width="120px">{{$value->CONTNO}}</td>
                </tr>
              </table>
            </table>
          </td>
          <td>
              <table border="1">
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ผ่อนงวดละ</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ชำระงวดละ</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>คงค้าง งวด</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>งวดที่</b></td>
                  <td width="55px">{{$value->CONTNO}}</td>
                  <td width="50px"><b>ถึงงวดที่</b></td>
                  <td width="55px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ยอดเงินคงค้าง</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>เบี้ยปรับ</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ค่าตาม + ค่าบอกเลิก</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ค่าโนติส</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>ค่ายึด</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
                <tr style="line-height: 220%;">
                  <td width="80px"><b>รวมยอด</b></td>
                  <td width="160px">{{$value->CONTNO}}</td>
                </tr>
              </table>
          </td>
        </tr>
      </table>
    @endforeach

  </body>
</html>
