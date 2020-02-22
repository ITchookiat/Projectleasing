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
  
  $thb = $dataDB->Gold_Payment.".00";
  $Pay_Amount = num2thai($thb);
@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
    <table border="0">
      <tbody>
        <tr>
          <th width="10px"></th>
          <th width="100px" align="left">วันที่ : {{ DateThai($dataDB->Date_Payment) }}</th>
        </tr>
        <tr>
          <th width="10px"></th>
          <th width="200px" align="left">เลขที่ใบเสร็จ : {{ $dataDB->Jobnumber_Payment }}<b></b></th>
        </tr>
      </tbody>
    </table>

    <h3 class="card-title p-3" align="center">ใบเสร็จรับชำระค่างวด</h3>
    <hr>

  <body style="margin-top: 0 0 0px;">
    <br>
    <table border="0">
      <tbody>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>ชื่อ - นามสกุล : </b></th>
          <th width="10px"></th>
          <th width="150px" align="left">{{ iconv('Tis-620','utf-8',str_replace(" ","",$data->SNAM.$data->NAME1)."   ".str_replace(" ","",$data->NAME2)) }}</th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>เลขที่สัญญา :</b></th>
          <th width="10px"></th>
          <th width="150px" align="left">{{ $dataDB->Contract_legis }}</th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>ที่อยู่ :</b></th>
          <th width="10px"></th>
          <th width="300px" align="left">
            {{ 
              iconv('Tis-620','utf-8',str_replace(" ","",$data->ADDRES))." ต.".iconv('Tis-620','utf-8',str_replace(" ","",$data->TUMB))." อ.".iconv('Tis-620','utf-8',str_replace(" ","",$data->AUMPDES))
              ." จ.".iconv('Tis-620','utf-8',str_replace(" ","",$data->PROVDES))."  ". $data->ZIP
            }}
          </th>
        </tr>
        <tr>
          <th></th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>ยี่ห้อ :</b></th>
          <th width="10px"></th>
          <th width="150px">{{iconv('Tis-620','utf-8',str_replace(" ","",$data->TYPE))}}</th>
          <th width="80px" align="right"><b>ป้ายทะเบียน :</b></th>
          <th width="10px"></th>
          <th width="150px">{{iconv('Tis-620','utf-8',str_replace(" ","",$data->REGNO))}}</th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>แบบ :</b></th>
          <th width="10px"></th>
          <th width="150px">{{iconv('Tis-620','utf-8',str_replace(" ","",$data->BAAB))}}</th>
          <th width="80px" align="right"><b>สี :</b></th>
          <th width="10px"></th>
          <th width="150px">{{iconv('Tis-620','utf-8',str_replace(" ","",$data->COLOR))}}</th>
        </tr>
      </tbody>
    </table>
    <br>
    <br>

    <table border="0">
      <tbody>
      <tr style="line-height:200%;">
          <th width="80px" align="right"><b>งวดที่ : </b></th>
          <th width="150px" align="center"> 
            {{ $dataDB->Period_Payment }} - {{ $dataDB->Period_Payment }}
            @if($dataDB->Gold_Payment < $dataDB->DuePay_Promise)
              *
            @endif
          </th>
          <th width="150px" align="right"></th>
        </tr>
        <tr style="line-height:180%;">
          <th width="80px" align="right"><b>ประเภทชำระ : </b></th>
          <th width="150px" align="center"> {{ $dataDB->Type_Payment }}</th>
          <th width="150px" align="right"></th>
        </tr>
        <tr style="line-height:180%;">
          <th width="80px" align="right"></th>
          <th width="300px" align="right">
            @php
              $SetPrice = ($dataDB->Gold_Payment / 1.07);
            @endphp
            {{number_format($SetPrice, 2)}}
          </th>
        </tr>
        <tr style="line-height:180%;">
          <th width="80px" align="right"></th>
          <th width="300px" align="right">7%</th>
        </tr>
        <tr style="line-height:180%;">
          <th width="80px" align="right"></th>
          <th width="300px" align="right">
            @php
              $SetVat = ($dataDB->Gold_Payment * 7) / 107;
            @endphp
            {{number_format($SetVat, 2)}}
          </th>
        </tr>
        <tr style="line-height:10%;">
          <th></th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>ยอดชำระ : </b></th>
          <th width="150px" align="center"><b> ( {{  $Pay_Amount  }} )</b></th>
          <th width="150px" align="right">{{number_format($dataDB->Gold_Payment, 2)}} บาท</th>
        </tr>
        <tr style="line-height:200%;">
          <th width="80px" align="right"><b>ยอดคงเหลือ : </b></th>
          <th width="300px" align="right">{{number_format($dataDB->Sum_Promise, 2)}} บาท</th>
        </tr>
      </tbody>
    </table>
  </body>
</html>
