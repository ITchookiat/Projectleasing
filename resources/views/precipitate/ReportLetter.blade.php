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
      function DateThai2($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
    @endphp

      @php
          function num2thai($thb) {
            list($thb, $ths) = explode('.', $thb);
            $ths = substr($ths.'00', 0, 0);
            $thaiNum = array('','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า');
            $unitBaht = array('บาทถ้วน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
            $unitSatang = array('สตางค์','สิบ');
            $THB = '';
            $j = 0;
            for($i=strlen($thb)-1; $i>=0; $i--,$j++) {
            $num = $thb[$i];
            $tnum = $thaiNum[$num];
            $unit = $unitBaht[$j];
            switch(true) {
            case $j==0 && $num==1 && strlen($thb)>1: $tnum = 'เอ็ด'; break;
            case $j==1 && $num==1: $tnum = ''; break;
            case $j==1 && $num==2: $tnum = 'ยี่'; break;
            case $j==6 && $num==1 && strlen($thb)>7: $tnum = 'เอ็ด'; break;
            case $j==7 && $num==1: $tnum = ''; break;
            case $j==7 && $num==2: $tnum = 'ยี่'; break;
            case $j!=0 && $j!=6 && $num==0: $unit = ''; break;
            }
            $S = $tnum . $unit;
            $THB = $S . $THB;
            }
            if($ths=='00') {
            $THS = 'ถ้วน';
            } else {
            $j=0;
            $THS = '';
            for($i=strlen($ths)-1; $i>=0; $i--,$j++) {
            $num = $ths[$i];
            $tnum = $thaiNum[$num];
            $unit = $unitSatang[$j];
            switch(true) {
            case $j==0 && $num==1 && strlen($ths)>1: $tnum = 'เอ็ด'; break;
            case $j==1 && $num==1: $tnum = ''; break;
            case $j==1 && $num==2: $tnum = 'ยี่'; break;
            case $j!=0 && $j!=6 && $num==0: $unit = ''; break;
            }
            $S = $tnum . $unit;
            $THS = $S . $THS;
            }
            }
            return $THB.$THS;
          }

          //$thb = ($data[$i]->EXP_AMT*100+1)/100;
          //$thb = $data->EXP_AMT;
          //$EXP_AMT = num2thai($thb);
      @endphp


  </head>
    @foreach($data as $data)
        <h2 class="card-title p-3" style="line-height: 3px;"><b>บริษัท ชูเกียรติลิสซิ่ง จำกัด</b></h2>
        <h5 class="card-title p-3" style="letter-spacing: 0.3px;line-height: 3px;"><b>17/8 ม.4 ต.รูสะมิแล อ.เมือง จ.ปัตตานี 9400 โทรศัพท์ 073-450702-704 แฟกซ์ 073-450700</b></h5>
    <body>
        <br>
          <table>
            <tr style="line-height: 250%;">
              <td width="130px"></td>
            </tr>
            <tr>
              <td width="120px"></td>
              <td width="50px"><b>กรุณาส่ง </b></td>
              <td width="400px">{{iconv('TIS-620', 'utf-8', $data->NAMESP)}} (ผู้ค้ำประกัน 1)</td>
            </tr>
            <tr>
              <td width="170px"></td>
              <td width="400px">เลขที่ {{iconv('TIS-620', 'utf-8', $data->ADDRESSP)}}</td>
            </tr>
            <tr>
              <td width="170px"></td>
              <td width="400px">ต.{{iconv('TIS-620', 'utf-8', $data->TUMBSP)}} อ.{{iconv('TIS-620', 'utf-8', $data->AUMPDESSP)}} จ.{{iconv('TIS-620', 'utf-8', $data->PROVDESSP)}}</td>
            </tr>
            <tr>
              <td width="170px"></td>
              <td width="400px">{{iconv('TIS-620', 'utf-8', $data->ZIPSP)}}</td>
            </tr>
            <tr style="line-height: 150%;">
              <td width="130px"></td>
            </tr>
            <tr>
              <td width="400px"></td>
              <td width="300px">วันที่ &nbsp;&nbsp;{{DateThai2(date('Y-m-d'))}}</td>
            </tr>
            <tr style="line-height: 50%;">
              <td width="130px"></td>
            </tr>
            <tr>
              <td width="30px">เรื่อง </td>
              <td width="300px">แจ้งให้มาชำระหนี้ สัญญาเช่าซื้อเลขที่ ({{$data->CONTNO}})</td>
            </tr>
            <tr>
              <td width="30px">เรียน </td>
              <td width="300px">{{iconv('TIS-620', 'utf-8', $data->NAMESP)}} ผู้ค้ำประกัน 1</td>
            </tr>
            <tr style="line-height: 150%;">
              <td width="130px"></td>
            </tr>
            <tr style="letter-spacing: 0px;">
              <td width="20px"></td>
              <td width="570px">
              ตามที่ท่านได้ตกลงทำสัญญาค้ำประกันรถยนต์ยี่ห้อ {{iconv('TIS-620', 'utf-8', $data->TYPE)}} รุ่น {{iconv('TIS-620', 'utf-8', $data->MODEL)}} 
              สี {{iconv('TIS-620', 'utf-8', $data->COLOR)}} เลขตัวถัง {{$data->STRNO }}
              </td>
            </tr>
            <tr style="line-height: 150%;letter-spacing: 0.3px;">
              <td width="570px">
              เลขเครื่อง {{$data->ENGNO }}  ทะเบียน {{ iconv('TIS-620', 'utf-8', $data->REGNO) }} ไปจาก บริษัท ชูเกียรติลิสซิ่ง จำกัด สำนักงานใหญ่ 
              ตามสัญญาซื้อ
              </td>
            </tr>
            <tr style="line-height: 150%;letter-spacing: 0.3px;">
              <td width="570px">
              ลงวันที่ {{ DateThai2($data->SDATE) }} รายละเอียดท่านทั้งสองแจ้งชัดดีอยู่แล้วนั้น บัดนี้ท่านได้ค้างค่าเช่าซื้อจำนวน&nbsp; {{number_format($data->HLDNO, 0)}} งวด
              </td>
            </tr>
            <tr style="line-height: 150%;letter-spacing: 0.3px;">
              <td width="570px">
              ติดต่อกันจำนวนเงิน {{number_format($data->EXP_AMT, 2)}} บาท @php $thb = ($data->EXP_AMT*100+1)/100; $EXP_AMT = num2thai($thb); @endphp {{$EXP_AMT}} (รวมภาษีมูลค่าเพิ่ม)
              ส่วนค่าเบี้ยปรับตาม
              </td>
            </tr>
            <tr style="line-height: 150%;letter-spacing: 0.3px;">
              <td width="570px">
              กฎหมายพร้อมค่าใช้จ่ายในการติดตามและอื่นๆ ขอให้ท่านมาติดต่อชำระส่วนที่ค้างทั้งหมดให้แล้วเสร็จภายใน  7  วัน
              </td>
            </tr>
            <tr style="line-height: 150%;letter-spacing: 0.3px;">
              <td width="570px">
              นับตั้งแต่วันที่ท่านได้รับหนังสือฉบับนี้
              </td>
            </tr>
            <tr style="line-height: 300%;">
              <td width="130px"></td>
            </tr>
            <tr style="line-height: 200%;">
              <td width="30px"></td>
              <td width="570px">จึงเรียนมาเพื่อโปรดดำเนินการด่วน</td>
            </tr>
            <tr style="line-height: 300%;">
              <td width="130px"></td>
            </tr>
            <tr style="line-height: 100%;">
              <td width="330px"></td>
              <td width="300px">ขอแสดงความนับถือ</td>
            </tr>
            <tr style="line-height: 300%;">
              <td width="130px"></td>
            </tr>
            <tr>
              <td width="310px"></td>
              <td width="300px">( นางสาวมาซีเตาะห์ แวสือนิ)</td>
            </tr>
            <tr>
              <td width="340px"></td>
              <td width="300px">ผู้รับมอบอำนาจ</td>
            </tr>
            <tr style="line-height: 450%;">
              <td width="130px"></td>
            </tr>
            <tr> 
              <td width="600px"> - หากท่านได้นำเงินดังกล่าวไปชำระก่อนได้รับจดหมายฉบับนี้ ทางบริษัทต้องขออภัยมา ณ ที่นี้ด้วย</td>
            </tr>
          </table>
        <br>
        <br>
        <br>
    </body>
  @endforeach
</html>
