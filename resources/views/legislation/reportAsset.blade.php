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

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

<!-- ส่วนหัว -->
  @if($type == 19)
    <h1 align="center" style="font-weight: bold;line-height:1px;"><b>รายงานลูกหนี้สิบทรัพย์</b></h1>
    <h3 align="center" style="font-weight: bold;line-height:10px;"><b>จากวันที่ @if($newfdate != Null)({{DateThai($newfdate)}})@endif ถึงวันที่ @if($newtdate != Null)({{DateThai($newtdate)}})@endif</b></h3>
    <hr>
  @endif

<!-- ส่วนข้อมูล -->
  @if($type == 19)
    <body>
      <br>
      <table border="1">
          <tr align="center" style="background-color: yellow;line-height: 200%;font-weight:bold;">
            <th style="width: 30px">ลำดับ</th>
            <th style="width: 60px">เลขที่สัญญา</th>
            <th style="width: 100px">ชื่อ-นามสกุล(ผู้ซื้อ)</th>
            <th style="width: 150px">ที่อยู่(ผู้ซื้อ)</th>
            <th style="width: 70px">เลขประชาชน(ผู้ซื้อ)</th>
            <th style="width: 100px">ชื่อ-นามสกุล(ผู้ค่ำ)</th>
            <th style="width: 150px">ที่อยู่(ผู้ค่ำ)</th>
            <th style="width: 70px">เลขประชาชน(ผู้ค่ำ)</th>
            <th style="width: 80px">สถานะลูกหนี้</th>
          </tr>
          @foreach($data as $key => $row)
          <tr style="line-height: 200%;">
            <td align="center" style="width: 30px"> {{$key+1}}</td>
            <td align="center" style="width: 60px"> {{$row->Contract_legis}}</td>
            <td align="center" style="width: 100px"> {{$row->Name_legis}}</td>
            <td align="center" style="width: 150px"> {{$row->Address_legis}}</td>
            <td align="center" style="width: 70px"> {{$row->Idcard_legis}}</td>
            <td align="center" style="width: 100px"> {{$row->NameGT_legis}}</td>
            <td align="center" style="width: 150px"> {{$row->AddressGT_legis}}</td>
            <td align="center" style="width: 70px"> {{$row->IdcardGT_legis}}</td>
            <td align="center" style="width: 80px">
              @foreach($SetaArry as $value)
                @if($value['id_status'] == $row->id)
                  {{$value['txt_status']}}
                @endif
              @endforeach
            </td>
          </tr>
          @endforeach
      </table>
    </body>
  @endif

</html>
