<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
    <label>วันที่ : {{$date}}</label>
    <h3 class="card-title p-3" align="center">แบบฟอร์มขออนุมัติเช่าซื้อรถยนต์</h3>
    <hr>

  <body style="margin-top: 0 0 0px;">

    <table border="0">
      <tbody>
        <tr align="center">
          <th width="180px">บริษัท ชูเกียรติลิสซิ่ง จำกัด</th>
          <th width="180px">เลขที่สัญญา <b>{{$dataReport->Contract_buyer}}</b></th>
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
          <th class="text-center" width="90px">เบอร์โทรศัพท์</th>
          <th class="text-center" width="90px">เบอร์โทรอื่นๆ</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="background-color: yellow;">
          <td width="120px"> <b>{{$dataReport->Name_buyer}}</b></td>
          <td width="120px"> <b>{{$dataReport->last_buyer}}</b></td>
          <td width="60px"> <b>{{$dataReport->Nick_buyer}}</b></td>
          <td width="60px"> <b>{{$dataReport->Status_buyer}}</b></td>
          <td width="90px"> <b>{{str_replace(",", ",     ", $dataReport->Phone_buyer)}}</b></td>
          <td width="90px"> <b>{{$dataReport->Phone2_buyer}}</b></td>
        </tr>
      </tbody>
    </table>
    <table border="1">
        <tr>
          <th align="right" width="120px"> คู่สมรส &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Mate_buyer}}</b></th>
          <th class="text-center" width="210px"> เลขบัตรประชาชน :  <b>{{$dataReport->Idcard_buyer}}</b></th>
          <th class="text-center" width="90px"> ใบขับขี่ :  <b>{{$dataReport->Driver_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Address_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ที่อยู่ปัจจุบัน/ส่งเอกสาร &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->AddN_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายละเอียดที่อยู่ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->StatusAdd_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> สถานที่ทำงาน &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Workplace_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ลักษณะบ้าน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->House_buyer}}</b></th>
          <th align="right" width="120px"> ประเภทบ้าน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->HouseStyle_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> อาชีพ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Career_buyer}}</b></th>
          <th align="right" width="120"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="180" style="background-color: yellow;"> <b>{{$dataReport->Purchase_buyer}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายได้ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Income_buyer}}</b></th>
          <th align="right" width="120"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="180" style="background-color: yellow;"> <b>{{$dataReport->Support_buyer}}</b></th>
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
          <th class="text-center" width="90px">เบอร์โทรศัพท์</th>
          <th class="text-center" width="90px">ความสัมพันธ์</th>
        </tr>
      </thead>
      <tbody>
        <tr align="center" style="background-color: yellow;">
          <td width="120px"> <b>{{$dataReport->name_SP}}</b></td>
          <td width="120px"> <b>{{$dataReport->lname_SP}}</b></td>
          <td width="60px"> <b>{{$dataReport->nikname_SP}}</b></td>
          <td width="60px"> <b>{{$dataReport->status_SP}}</b></td>
          <td width="90px"> <b>{{str_replace(",", ",     ", $dataReport->tel_SP)}}</b></td>
          <td width="90px"> <b>{{$dataReport->relation_SP}}</b></td>
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
          <th align="right" width="120px"> ประเภทบ้าน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->housestyle_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> เลขที่โฉนด &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->deednumber_SP}}</b></th>
          <th align="right" width="120px"> เนื้อที่ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->area_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> อาชีพ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->career_SP}}</b></th>
          <th align="right" width="120px"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->puchase_SP}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> รายได้ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->income_SP}}</b></th>
          <th align="right" width="120px"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="180" style="background-color: yellow;"> <b>{{$dataReport->support_SP}}</b></th>
        </tr>
    </table>

    <h4 align="left"><u>รายละเอียดรถยนต์</u></h4>
    @if($type == 1)
      <table border="1">
        <thead>
          <tr align="center">
            <th class="text-center" width="120px">ยี่ห้อ</th>
            <th class="text-center" width="60px">ปี</th>
            <th class="text-center" width="60px">สี</th>
            <th class="text-center" width="120px">ป้ายเดิม</th>
            <th class="text-center" width="90px">ป้ายใหม่</th>
            <th class="text-center" width="90px">เลขไมล์</th>
          </tr>
        </thead>
        <tbody>
          <tr align="center" style="background-color: yellow;">
            <td width="120px"> <b>{{$dataReport->Brand_car}}</b></td>
            <td width="60px"> <b>{{$dataReport->Year_car}}</b></td>
            <td width="60px"> <b>{{$dataReport->Colour_car}}</b></td>
            <td width="120px"> <b>{{$dataReport->License_car}}</b></td>
            <td width="90px"> <b>{{$dataReport->Nowlicense_car}}</b></td>
            <td width="90px"> <b>{{$dataReport->Mile_car}}</b></td>
          </tr>
        </tbody>
      </table>
      <table border="1">
        <tr>
          <th align="right" width="120px"> รุ่น &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->Model_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ยอดจัด &nbsp;</th>
          <th align="right" width="120px" style="background-color: yellow;"> <b>{{number_format($dataReport->Top_car)}} &nbsp;</b></th>
          <th align="right" width="120px"> ดอกเบี้ย &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Interest_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> VAT &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Vat_car}}</b></th>
          <th align="right" width="120px"> ระยะเวลาผ่อน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Timeslacken_car}}</b> งวด</th>
        </tr>
        <tr>
          <th align="right" width="120px"> ชำระต่องวด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Pay_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่างวด x ระยะเวลาผ่อน &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Paymemt_car}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->Timepayment_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ภาษี x ระยะเวลาผ่อน &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Tax_car}} &nbsp;</b> </th>
          <th align="right" width="120px"> <b>{{$dataReport->Taxpay_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ยอดผ่อนชำระทั้งหมด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->Totalpay1_car}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->Totalpay2_car}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> วันที่ชำระงวดแรก &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Dateduefirst_car}}</b></th>
          <th align="right" width="120px"> ประกันภัย &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Insurance_car}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แบบ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->status_car}}</b></th>
          <th align="right" width="120px"> เปอร์เซ็นต์จัดไฟแนนซ์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Percent_car}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ผู้รับเงิน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Payee_car}}</b></th>
          <th align="right" width="120px"> เลขที่บัญชี/สาขา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;">
            <b>
              @if($dataReport->Accountbrance_car != Null)
              {{$dataReport->Accountbrance_car}} / {{$dataReport->branchbrance_car}}
              @else
              
              @endif
            </b>
          </th>
        </tr>
        <tr>
          <th class="text-center" width="240px"></th>
          <th align="right" width="120px"> เบอร์โทรศัพท์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Tellbrance_car}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แนะนำ/นายหน้า &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Agent_car}}</b></th>
          <th align="right" width="120px"> เลขที่บัญชี/สาขา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;">
            <b>
              @if($dataReport->Accountagent_car != Null)
              {{$dataReport->Accountagent_car}} / {{$dataReport->branchAgent_car}}
              @else
              รับเงินสด
              @endif
            </b>
          </th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่าคอม &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{number_format($dataReport->Commission_car)}}</b> บาท</th>
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
          <th align="right" width="120px"> เจ้าหน้าที่สินเชื่อ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Loanofficer_car}}</b></th>
          <th align="right" width="120px"> สาขา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->branch_car}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ผู้อนุมัติ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->Approvers_car}}</b></th>
          <th align="right" width="120px"> หมายเหตุ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->Note_car}}</b></th>
        </tr>
      </table>
    @elseif($type == 4)
      <table border="1">
        <thead>
          <tr align="center">
            <th class="text-center" width="120px">ยี่ห้อ</th>
            <th class="text-center" width="60px">ปี</th>
            <th class="text-center" width="60px">สี</th>
            <th class="text-center" width="120px">ป้ายเดิม</th>
            <th class="text-center" width="90px">ป้ายใหม่</th>
            <th class="text-center" width="90px">เลขไมล์</th>
          </tr>
        </thead>
        <tbody>
          <tr align="center" style="background-color: yellow;">
            <td width="120px"> <b>{{$dataReport->brand_HC}}</b></td>
            <td width="60px"> <b>{{$dataReport->year_HC}}</b></td>
            <td width="60px"> <b>{{$dataReport->colour_HC}}</b></td>
            <td width="120px"> <b>{{$dataReport->oldplate_HC}}</b></td>
            <td width="90px"> <b>{{$dataReport->newplate_HC}}</b></td>
            <td width="90px"> <b>{{$dataReport->mile_HC}}</b></td>
          </tr>
        </tbody>
      </table>
      <table border="1">
        <tr>
          <th align="right" width="120px"> รุ่น &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->model_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ประเภทรถ &nbsp;</th>
          <th class="text-center" width="420px" style="background-color: yellow;"> <b>{{$dataReport->type_HC}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ราคารถ &nbsp;</th>
          <th align="right" width="120px" style="background-color: yellow;"> <b>{{$dataReport->price_HC}} &nbsp;</b></th>
          <th align="right" width="120px"> เงินดาวน์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->downpay_HC}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่าประกัน &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->insurancefee_HC}}</b></th>
          <th align="right" width="120px"> ค่าโอน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->transfer_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ยอดจัด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->topprice_HC}}</b></th>
          <th align="right" width="120px"> ดอกเบี้ย &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->interest_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> VAT &nbsp;</th>
          <th align="right" width="120px"> <b> 7%</b></th>
          <th align="right" width="120px"> ระยะเวลาผ่อน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->period_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ชำระต่องวด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->paypor_HC}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่างวด x ระยะเวลาผ่อน &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->payment_HC}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->payperriod_HC}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ภาษี x ระยะเวลาผ่อน &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->tax_HC}} &nbsp;</b> </th>
          <th align="right" width="120px"> <b>{{$dataReport->taxperriod_HC}} &nbsp;</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ยอดผ่อนชำระทั้งหมด &nbsp;</th>
          <th align="right" width="120px"> <b>{{$dataReport->totalinstalments_HC}} &nbsp;</b></th>
          <th align="right" width="120px"> <b>{{$dataReport->totalinstalments1_HC}} &nbsp;</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แบบ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->baab_HC}}</b></th>
          <th align="right" width="120px"> ค้ำประกัน &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->guarantee_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> วันที่ชำระงวดแรก &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->firstpay_HC}}</b></th>
          <th align="right" width="120px"> ประกันภัย &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->insurance_HC}}</b></th>
        </tr>
        <tr>
          <th class="text-center" width="540px"></th>
        </tr>
        <tr>
          <th align="right" width="120px"> แนะนำ/นายหน้า &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->agent_HC}}</b></th>
          <th align="right" width="120px"> เบอร์โทรศัพท์ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"><b>{{$dataReport->tel_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ค่าคอม &nbsp;</th>
          <th class="text-center" width="420" style="background-color: yellow;"> <b>{{($dataReport->commit_HC)}}</b> บาท</th>
        </tr>
        <tr>
          <th align="right" width="120px"> ประวัติซื้อ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->purchhis_HC}}</b></th>
          <th align="right" width="120px"> ประวัติค้ำ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->supporthis_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> พนักงาน &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->sale_HC}}</b></th>
          <th align="right" width="120px"> หมายเหตุ &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->other_HC}}</b></th>
        </tr>
        <tr>
          <th align="right" width="120px"> ผู้อนุมัติ &nbsp;</th>
          <th class="text-center" width="120px" style="background-color: yellow;"> <b>{{$dataReport->approvers_HC}}</b></th>
          <th align="right" width="120px"> ผู้ทำสัญญา &nbsp;</th>
          <th class="text-center" width="180px" style="background-color: yellow;"> <b>{{$dataReport->contrac_HC}}</b></th>
        </tr>
      </table>
    @endif
  </body>
</html>
