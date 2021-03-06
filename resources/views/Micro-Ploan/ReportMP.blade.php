@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay-$strMonthThai-$strYear";
  }
@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
    <label>วันที่ : {{$date}}</label>
      <h3 class="card-title p-3" align="center" style="line-height: 3px;">แบบฟอร์มขออนุมัติเงินกู้</h3>
    <hr>

  <body style="margin-top: 0 0 0px;">
    <table border="0">
      <tbody>
        <tr align="center">
          <th width="180px">บริษัท ชูเกียรติลิสซิ่ง จำกัด</th>
          <th width="180px">เลขที่สัญญา <b>{{$dataReport->Contract_MP}}</b></th>
          <th width="180px">วันที่ทำสัญญา <b>{{$newDateDue}}</b></th>
        </tr>
      </tbody>
    </table>

    <h4 align="left"><u>รายละเอียดผู้เช่าซื้อ</u></h4>
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="120px">ชื่อ</th>
          <th class="text-center" width="120px">สกุล</th>
          <th class="text-center" width="60px">ชื่อเล่น</th>
          <th class="text-center" width="60px">สถานะ</th>
          <th class="text-center" width="85px">เบอร์โทรศัพท์</th>
          <th class="text-center" width="95px">เบอร์โทรอื่นๆ</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="background-color: yellow;">
          <td width="120px"> <b>{{$dataReport->Name_MP}}</b></td>
          <td width="120px"> <b>{{$dataReport->last_MP}}</b></td>
          <td width="60px"> <b>{{$dataReport->Nick_MP}}</b></td>
          <td width="60px"> <b>{{$dataReport->Status_MP}}</b></td>
          <td width="85px"> <b>{{str_replace(",", ",     ", $dataReport->Phone_MP)}}</b></td>
          <td width="95px"> <b>{{$dataReport->Phone2_MP}}</b></td>
        </tr>
      </tbody>
    </table>
    <table border="1">
        <tr>
          <th align="right" width="120px"> คู่สมรส &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Mate_MP}}</b></th>
          <th class="text-center" width="205px"> เลขบัตรประชาชน :  <b>{{$dataReport->Idcard_MP}}</b></th>
          <th class="text-center" width="95px"> ใบขับขี่ :  <b>{{$dataReport->Driver_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ &nbsp;</th>
          <th class="text-center" width="240px" style="background-color: yellow;"> <b>{{$dataReport->Address_MP}}</b></th>
          <td align="right" width="85px"> วัตถุประสงค์สินเชื่อ</td>
          <td width="95px"style="background-color: yellow;"> <b>{{$dataReport->Objective_car}}</b></td>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ปัจจุบัน/ส่งเอกสาร &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->AddN_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายละเอียดที่อยู่ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->StatusAdd_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> สถานที่ทำงาน &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Workplace_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ลักษณะบ้าน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->House_MP}}</b></th>
          <th align="right" width="60px"> เลขที่โฉนด &nbsp;</th>
          <th class="text-center" width="60px" style="background-color: yellow;"> <b>{{$dataReport->deednumber_MP}}</b></th>
          <th align="right" width="85px"> ประเภทหลักทรัพย์ &nbsp;</th>
          <th class="text-center" width="95px" style="background-color: yellow;"> <b>{{$dataReport->securities_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> อาชีพ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Career_MP}}</b></th>
          <th align="right" width="60"> เนื้อที่ &nbsp;</th>
          <th class="text-center" width="60" style="background-color: yellow;"> <b>{{$dataReport->area_MP}}</b></th>
          <th align="right" width="85"> ประเภทบ้าน &nbsp;</th>
          <th class="text-center" width="95" style="background-color: yellow;"> <b>{{$dataReport->HouseStyle_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> สถานะผู้เช่าซื้อ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->GradeMP_car}}</b></th>
          <th align="right" width="60"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="60" style="background-color: yellow;"> <b>{{$dataReport->Purchase_MP}}</b></th>
          <th align="right" width="85"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="95" style="background-color: yellow;"> <b>{{$dataReport->Support_MP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายได้ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;">
            <b>{{$dataReport->Income_MP}}</b>
          </th>
          <th align="right" width="60"> หักค่าใช้จ่าย &nbsp;</th>
          <th class="text-center" width="60" style="background-color: yellow;">
            @if($dataReport->BeforeIncome_MP != null)
              <b>{{number_format($dataReport->BeforeIncome_MP)}}</b>
            @endif
          </th>
          <th align="right" width="85"> รายได้หลังหัก คชจ. &nbsp;</th>
          <th class="text-center" width="95" style="background-color: yellow;">
            @if($dataReport->AfterIncome_MP != null)
              <b>{{number_format($dataReport->AfterIncome_MP)}}</b>
            @endif
          </th>
        </tr>
    </table>

    <h4 align="left"><u>รายละเอียดผู้ค้ำ</u></h4>
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="120px">ชื่อ</th>
          <th class="text-center" width="120px">สกุล</th>
          <th class="text-center" width="60px">ชื่อเล่น</th>
          <th class="text-center" width="60px">สถานะ</th>
          <th class="text-center" width="85px">เบอร์โทรศัพท์</th>
          <th class="text-center" width="95px">ความสัมพันธ์</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="background-color: yellow;">
          <td width="120px"> <b>{{$dataReport->name_SP}}</b></td>
          <td width="120px"> <b>{{$dataReport->lname_SP}}</b></td>
          <td width="60px"> <b>{{$dataReport->nikname_SP}}</b></td>
          <td width="60px"> <b>{{$dataReport->status_SP}}</b></td>
          <td width="85px"> <b>{{str_replace(",", ",     ", $dataReport->tel_SP)}}</b></td>
          <td width="95px"> <b>{{$dataReport->relation_SP}}</b></td>
        </tr>
      </tbody>
    </table>
    <table border="1">
        <tr>
          <th align="right" width="120px"> คู่สมรส &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->mate_SP}}</b></th>
          <th class="text-center" width="300px"> เลขบัตรประชาชน :  <b>{{$dataReport->idcard_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->add_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ปัจจุบัน/ส่งเอกสาร &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->addnow_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายละเอียดที่อยู่ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->statusadd_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> สถานที่ทำงาน &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->workplace_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ลักษณะบ้าน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->house_SP}}</b></th>
          <th align="right" width="60px"> เลขที่โฉนด &nbsp;</th>
          <th class="text-center" width="60px" style="background-color: yellow;"> <b>{{$dataReport->deednumber_SP}}</b></th>
          <th align="right" width="85px"> ประเภทหลักทรัพย์ &nbsp;</th>
          <th class="text-center" width="95px" style="background-color: yellow;"> <b>{{$dataReport->securities_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> อาชีพ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->career_SP}}</b></th>
          <th align="right" width="60px"> เนื้อที่ &nbsp;</th>
          <th class="text-center" width="60px" style="background-color: yellow;"> <b>{{$dataReport->area_SP}}</b></th>
          <th align="right" width="85px"> ประเภทบ้าน &nbsp;</th>
          <th class="text-center" width="95px" style="background-color: yellow;"> <b>{{$dataReport->housestyle_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายได้ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->income_SP}}</b></th>
          <th align="right" width="60px"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="60" style="background-color: yellow;"> <b>{{$dataReport->puchase_SP}}</b></th>
          <th align="right" width="85px"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="95" style="background-color: yellow;"> <b>{{$dataReport->support_SP}}</b></th>
        </tr>
    </table>

    <h4 align="left"><u>รายละเอียดรถ</u></h4>
      <table border="1">
        <thead>
          <tr align="center">
            <th class="text-center" width="120px">ยี่ห้อ</th>
            <th class="text-center" width="60px">ปี</th>
            <th class="text-center" width="60px">สี</th>
            <th class="text-center" width="120px">ป้ายเดิม</th>
            <th class="text-center" width="85px">ป้ายใหม่</th>
            <th class="text-center" width="95px">เลขไมล์</th>
          </tr>
        </thead>
        <tbody>
          <tr align="center" style="background-color: yellow;">
            <td width="120px"> <b>{{$dataReport->Brand_car}}</b></td>
            <td width="60px"> <b>{{$dataReport->Year_car}}</b></td>
            <td width="60px"> <b>{{$dataReport->Colour_car}}</b></td>
            <td width="120px"> <b>{{$dataReport->License_car}}</b></td>
            <td width="85px"> <b>{{$dataReport->Nowlicense_car}}</b></td>
            <td width="95px"> <b>{{$dataReport->Mile_car}}</b></td>
          </tr>
        </tbody>
      </table>
      <table border="1">
        <tr>
          <th align="right" width="120px"> รุ่น &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Model_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> เงินต้น &nbsp;</th>
          <th align="right" width="120px" style="background-color: yellow;"> <b>{{number_format($dataReport->Top_car)}} &nbsp;</b></th>
          <th align="right" width="120px"> ดอกเบี้ย/เดือน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Interest_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่าดำเนินการ &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Vat_car}} &nbsp;</b></th>
          <th align="right" width="120px"> ระยะเวลาผ่อน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;">
            <b>{{$dataReport->Timeslacken_car}} งวด </b>
           </th>
        </tr>
        <tr>
          <th align="right" width="120px"> ชำระต่องวด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Pay_car}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->Timepayment_car}} &nbsp;</b></th>
          <th align="right" width="85px"> ประเภทรถ &nbsp;</th>
          <th width="95px" style="background-color: yellow;"> <b>{{$dataReport->Typecardetails}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> กำไรจากดอกเบี้ย &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Tax_car}} &nbsp;</b> </th>
          <th align="right" width="120px"> <b>{{$dataReport->Taxpay_car}} &nbsp;</b></th>
          <th align="right" width="85px"> กลุ่มปีรถยนต์ &nbsp;</th>
          <th width="95px" style="background-color: yellow;"> <b>{{$dataReport->Groupyear_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ยอดผ่อนชำระทั้งสัญญา &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Totalpay1_car}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->Totalpay2_car}} &nbsp;</b></th>
          <th align="right" width="85px"> ราคากลาง &nbsp;</th>
          <th width="95px" style="background-color: yellow;"> <b>{{$dataReport->Midprice_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> วันที่ชำระงวดแรก &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Dateduefirst_car}}</b></th>
          <th align="right" width="120px"> ประกันภัย &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Insurance_car}}</b></th>
        </tr>
          @if($dataReport->Totalpay1_car != null)
            @php 
              $intersetAll = (str_replace(",","",$dataReport->Totalpay1_car) - str_replace(",","",$dataReport->Top_car));
            @endphp
          @else 
            @php 
              $intersetAll = 0;
            @endphp
          @endif
        <tr>
          <!-- <th class="text-center" width="540px"></th> -->
          <th class="text-center" width="240px"></th>
          <th align="right" width="120px"> ดอกผลทั้งสัญญา &nbsp;</th>
          <th class="text-center" width="180px"> <b>{{number_format($intersetAll,2)}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แบบ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->status_car}}</b></th>
          <th align="right" width="120px"> เปอร์เซ็นต์จัดไฟแนนซ์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Percent_car}}%</b></th>
        </tr>
        <tr>
          @if($dataReport->Salemethod_car != Null)
          <th align="right" width="120px">* &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;">
             @if($dataReport->Salemethod_car == 'on')
             กรรมสิทธิ์ในแบบซื้อขาย
             @endif
          </th>
          @else
          <th class="text-center" width="540px"></th>
          @endif
        </tr>
        <!-- <tr>
          <th align="right" width="120px"> ผู้รับเงิน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Payee_car}}</b></th>
          <th align="right" width="120px"> เลขที่บัญชี/สาขา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"><b>
            @if($dataReport->Accountbrance_car != Null)
              {{$dataReport->Accountbrance_car}} / {{$dataReport->branchbrance_car}}
            @else
            @endif
            </b>
          </th>
        </tr> -->
        <tr>
          <th align="right" width="120px"> ผู้รับเงิน &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Payee_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> เลขที่บัญชี/สาขา &nbsp;</th>
          <th align="left" width="420px" style="background-color: yellow;"> 
            @if($dataReport->Accountbrance_car != Null)
            <b>{{$dataReport->Accountbrance_car}} / {{$dataReport->branchbrance_car}}</b>
            @else
            @endif
          </th>
        </tr>
        <tr>
          <th align="right" width="120px"> เบอร์โทรศัพท์ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Tellbrance_car}}</b></th>
        </tr>
        <!-- <tr>
          <th class="text-center" width="240px"></th>
          <th align="right" width="120px"> เบอร์โทรศัพท์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Tellbrance_car}}</b></th>
        </tr> -->
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แนะนำ/นายหน้า &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Agent_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> เลขที่บัญชี/สาขา &nbsp;</th>
          <th align="left" width="420px" style="background-color: yellow;">
              @if($dataReport->Accountagent_car != Null)
                <b>{{$dataReport->Accountagent_car}} / {{$dataReport->branchAgent_car}}</b>
              @else

              @endif
          </th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่าคอม &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> @if($dataReport->Agent_car != null) <b>{{number_format($dataReport->Commission_car)}}</b> บาท @endif</th>
          <th align="right" width="120px"> เบอร์โทรศัพท์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Tellagent_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Purchasehistory_car}}</b></th>
          <th align="right" width="120px"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Supporthistory_car}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> เจ้าหน้าที่สินเชื่อ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Loanofficer_car}}</b></th>
          <th align="right" width="120px"> สาขา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->branch_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ผู้อนุมัติ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Approvers_car}}</b></th>

        </tr>
      </table>
      <br/><br/><br/><br/>
      <h4 align="left"><u>รายละเอียดเพิ่มเติม</u></h4>
      <table border="1">
        <tbody>
          <tr>
            <th align="right" width="120px"> หมายเหต/กรณีพิเศษ &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Note_car}}</b></th>
          </tr>
          <tr>
            <th align="right" width="120px"> รายละเอียดอาชีพ &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->CareerDetail_MP}}</b></th>
          </tr>
          <tr>
            <th align="right" width="120px"> ผลการประเมินลูกค้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->ApproveDetail_MP}}</b></th>
          </tr>
          <tr>
            <th align="right" width="120px"> แหล่งที่มาของลูกค้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Resource_news}}</b></th>
          </tr>
          <tr>
            <th class="text-center" width="540px"></th>
          </tr>
          <tr>
            <th align="right" width="120px"> ผลการตรวจสอบลูกค้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Memo_MP}}</b></th>
          </tr>
          <tr>
            <th align="right" width="120px"> ความพึงพอใจลูกค้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Prefer_MP}}</b></th>
          </tr>
          <tr>
            <th class="text-center" width="540px"></th>
          </tr>
          <tr>
            <th align="right" width="120px"> ผลการตรวจสอบนายหน้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Memo_broker}}</b></th>
          </tr>
          <tr>
            <th align="right" width="120px"> ความพึงพอใจนายหน้า &nbsp;</th>
            <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Prefer_broker}}</b></th>
          </tr>
        </tbody>
      </table>
  </body>
</html>
