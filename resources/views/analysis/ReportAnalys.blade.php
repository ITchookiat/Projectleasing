<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
    <label>วันที่ : {{$date}}</label>
    <h3 class="card-title p-3" align="center">แบบฟอร์มขออนุมัติเช่าซื้อรถยนต์</h3>
    <hr>

  <body>

    <table border="0">
      <tbody>
        <tr align="center">
          <th width="180px">บริษัท ชูเกียรติลิสซิ่ง จำกัด</th>
          <th width="180px">เลขที่สัญญา {{$dataReport->Contract_buyer}}</th>
          <th width="180px">วันที่ทำสัญญา {{$newDateDue}}</th>
        </tr>
      </tbody>
    </table>

    <h4 align="left"><u>รายละเอียดผู้เช่าซื้อ</u></h4>
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="120px"><b>ชื่อ</b></th>
          <th class="text-center" width="120px"><b>สกุล</b></th>
          <th class="text-center" width="60px"><b>ชื่อเล่น</b></th>
          <th class="text-center" width="60px"><b>สถานะ</b></th>
          <th class="text-center" width="90px"><b>เบอร์โทรศัพท์</b></th>
          <th class="text-center" width="90px"><b>เบอร์โทรอื่นๆ</b></th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td width="120px">{{$dataReport->Name_buyer}}</td>
          <td width="120px">{{$dataReport->last_buyer}}</td>
          <td width="60px">{{$dataReport->Nick_buyer}}</td>
          <td width="60px">{{$dataReport->Status_buyer}}</td>
          <td width="90px">{{$dataReport->Phone_buyer}}</td>
          <td width="90px">{{$dataReport->Phone2_buyer}}</td>
        </tr>
      </tbody>
    </table>
    <table border="1">
        <tr>
          <th class="text-center" width="80px"><b>คู่สมรส : </b></th>
          <th class="text-center" width="150px">{{$dataReport->Mate_buyer}}</th>
          <th class="text-center" width="200px"><b>เลขบัตรประชาชน : </b> {{$dataReport->Idcard_buyer}}</th>
          <th class="text-center" width="110px"><b>ใบขับขี่ : </b> {{$dataReport->Driver_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ที่อยู่ : </b></th>
          <th class="text-center" width="400px">{{$dataReport->Address_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </b></th>
          <th class="text-center" width="400px">{{$dataReport->AddN_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>รายละเอียดที่อยู่ : </b></th>
          <th class="text-center" width="400px">{{$dataReport->StatusAdd_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>สถานที่ทำงาน : </b></th>
          <th class="text-center" width="400px">{{$dataReport->Workplace_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ลักษณะบ้าน : </b></th>
          <th class="text-center" width="90px">{{$dataReport->House_buyer}}</th>
          <th class="text-center" width="100px"><b>ประเภทบ้าน : </b></th>
          <th class="text-center" width="210px">{{$dataReport->HouseStyle_buyer}}</th>
        </tr>
        <tr>
          <th class="text-center" width="80px"><b>อาชีพ : </b></th>
          <th class="text-center" width="110px">{{$dataReport->Career_buyer}}</th>
          <th class="text-center" width="50px"><b>รายได้ : </b></th>
          <th class="text-center" width="90px">{{$dataReport->Income_buyer}}</th>
          <th class="text-center" width="105"><b>ประวัติซื้อ : </b>{{$dataReport->Purchase_buyer}}</th>
          <th class="text-center" width="105"><b>ค้ำ : </b>{{$dataReport->Support_buyer}}</th>
        </tr>
    </table>

    <h4 align="left"><u>รายละเอียดผู้ค้ำ</u></h4>
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="120px"><b>ชื่อ</b></th>
          <th class="text-center" width="120px"><b>สกุล</b></th>
          <th class="text-center" width="60px"><b>ชื่อเล่น</b></th>
          <th class="text-center" width="60px"><b>สถานะ</b></th>
          <th class="text-center" width="90px"><b>เบอร์โทรศัพท์</b></th>
          <th class="text-center" width="90px"><b>ความสัมพันธ์</b></th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td width="120px">{{$dataReport->name_SP}}</td>
          <td width="120px">{{$dataReport->lname_SP}}</td>
          <td width="60px">{{$dataReport->nikname_SP}}</td>
          <td width="60px">{{$dataReport->status_SP}}</td>
          <td width="90px">{{$dataReport->tel_SP}}</td>
          <td width="90px">{{$dataReport->relation_SP}}</td>
        </tr>
      </tbody>
    </table>
    <table border="1">
        <tr>
          <th class="text-center" width="80px"><b>คู่สมรส : </b></th>
          <th class="text-center" width="150px">{{$dataReport->mate_SP}}</th>
          <th class="text-center" width="310px"><b>เลขบัตรประชาชน : </b> {{$dataReport->idcard_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ที่อยู่ : </b></th>
          <th class="text-center" width="400px">{{$dataReport->add_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ที่อยู่ปัจจุบัน/ส่งเอกสาร : </b></th>
          <th class="text-center" width="400px">{{$dataReport->addnow_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>รายละเอียดที่อยู่ : </b></th>
          <th class="text-center" width="400px">{{$dataReport->statusadd_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>สถานที่ทำงาน : </b></th>
          <th class="text-center" width="400px">{{$dataReport->workplace_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>ลักษณะบ้าน :</b></th>
          <th class="text-center" width="90px">{{$dataReport->house_SP}}</th>
          <th class="text-center" width="100px"><b>ประเภทบ้าน :</b></th>
          <th class="text-center" width="210px">{{$dataReport->housestyle_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="140px"><b>เลขที่โฉนด :</b></th>
          <th class="text-center" width="90px">{{$dataReport->deednumber_SP}}</th>
          <th class="text-center" width="100px"><b>เนื้อที่ :</b></th>
          <th class="text-center" width="210px">{{$dataReport->area_SP}}</th>
        </tr>
        <tr>
          <th class="text-center" width="80px"><b>อาชีพ : </b></th>
          <th class="text-center" width="110px">{{$dataReport->career_SP}}</th>
          <th class="text-center" width="50px"><b>รายได้ : </b></th>
          <th class="text-center" width="90px">{{$dataReport->income_SP}}</th>
          <th class="text-center" width="105"><b>ประวัติซื้อ : </b>{{$dataReport->puchase_SP}}</th>
          <th class="text-center" width="105"><b>ค้ำ : </b>{{$dataReport->support_SP}}</th>
        </tr>
    </table>

    <h4 align="left"><u>รายละเอียดรถยนต์</u></h4>
    <table border="1">
      <thead>
        <tr align="center">
          <th class="text-center" width="90px"><b>ยี่ห้อ</b></th>
          <th class="text-center" width="90px"><b>ปี</b></th>
          <th class="text-center" width="90px"><b>สี</b></th>
          <th class="text-center" width="90px"><b>ป้ายเดิม</b></th>
          <th class="text-center" width="90px"><b>ป้ายใหม่</b></th>
          <th class="text-center" width="90px"><b>เลขไมล์</b></th>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td width="90px">{{$dataReport->Brand_car}}</td>
          <td width="90px">{{$dataReport->Year_car}}</td>
          <td width="90px">{{$dataReport->Colour_car}}</td>
          <td width="90px">{{$dataReport->License_car}}</td>
          <td width="90px">{{$dataReport->Nowlicense_car}}</td>
          <td width="90px">{{$dataReport->Mile_car}}</td>
        </tr>
      </tbody>
    </table>
    <table border="1">
      <tr>
        <th class="text-center" width="90px"><b>รุ่น : </b></th>
        <th class="text-center" width="450px">{{$dataReport->Model_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>ยอดจัด : </b></th>
        <th class="text-center" width="130px">{{number_format($dataReport->Top_car)}} บาท</th>
        <th class="text-center" width="130px"><b>ดอกเบี้ย : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Interest_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>VAT : </b></th>
        <th class="text-center" width="130px">{{$dataReport->Vat_car}}</th>
        <th class="text-center" width="130px"><b>ระยะเวลาผ่อน : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Timeslacken_car}} งวด</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>ชำระต่องวด : </b></th>
        <th class="text-center" width="400px">{{$dataReport->Pay_car}} บาท</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>ค่างวด x ระยะเวลาผ่อน : </b></th>
        <th class="text-center" width="130px">{{$dataReport->Paymemt_car}}</th>
        <th class="text-center" width="270px">{{$dataReport->Timepayment_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>ภาษี x ระยะเวลาผ่อน : </b></th>
        <th class="text-center" width="130px">{{$dataReport->Tax_car}} </th>
        <th class="text-center" width="270px">{{$dataReport->Taxpay_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>ยอดผ่อนชำระทั้งหมด : </b></th>
        <th class="text-center" width="130px">{{$dataReport->Totalpay1_car}}</th>
        <th class="text-center" width="270px">{{$dataReport->Totalpay2_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="540px"></th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>วันชำระงวดแรก : </b></th>
        <th class="text-center" width="130px">{{$dataReport->Dateduefirst_car}}</th>
        <th class="text-center" width="130px"><b>ประกันภัย : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Insurance_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="140px"><b>แบบ : </b></th>
        <th class="text-center" width="130px">{{$dataReport->status_car}}</th>
        <th class="text-center" width="130px"><b>เปอร์เซ็นต์จัดไฟแนนซ์ : </b></th>
        <th class="text-center" width="140px"> {{$dataReport->Percent_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>ผู้รับเงิน : </b></th>
        <th class="text-center" width="180px">{{$dataReport->Payee_car}}</th>
        <th class="text-center" width="130px"><b>เลขที่บัญชี/สาขา : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Accountbrance_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="270px"></th>
        <th class="text-center" width="130px"><b>เบอร์โทรศัพท์ : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Tellbrance_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>แนะนำ/นายหน้า : </b></th>
        <th class="text-center" width="180px">{{$dataReport->Agent_car}}</th>
        <th class="text-center" width="130px"><b>เลขที่บัญชี/สาขา : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Accountagent_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>ค่าคอม : </b></th>
        <th class="text-center" width="180px">{{number_format($dataReport->Commission_car)}} บาท</th>
        <th class="text-center" width="130px"><b>เบอร์โทรศัพท์ : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Tellagent_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>ประวัติซื้อ : </b></th>
        <th class="text-center" width="180px">{{$dataReport->Purchasehistory_car}}</th>
        <th class="text-center" width="130px"><b>ประวัติค้ำ : </b></th>
        <th class="text-center" width="140px">{{$dataReport->Supporthistory_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>เจ้าหน้าที่สินเชื่อ : </b></th>
        <th class="text-center" width="180px">{{$dataReport->Loanofficer_car}}</th>
        <th class="text-center" width="130px"><b>สาขา : </b></th>
        <th class="text-center" width="140px">{{$dataReport->branch_car}}</th>
      </tr>
      <tr>
        <th class="text-center" width="90px"><b>ผู้อนุมัติ : </b></th>
        <th class="text-center" width="450px">{{$dataReport->Approvers_car}}</th>
      </tr>

    </table>
  </body>
</html>
