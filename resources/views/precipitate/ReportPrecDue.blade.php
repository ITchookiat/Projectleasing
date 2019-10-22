<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

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

    <SCRIPT>
      function toggleOption(thisselect) {
          var selected = thisselect.options[thisselect.selectedIndex].value;
          toggleRow(selected);
      }

      function toggleRow(id) {
        var row = document.getElementById(id);
        if (row.style.display == '') {
          row.style.display = 'none';
        }
        else {
           row.style.display = '';
        }
      }

      function showRow(id) {
        var row = document.getElementById(id);
        row.style.display = '';
      }

      function hideRow(id) {
        var row = document.getElementById(id);
        row.style.display = 'none';
      }

      function hideAll() {
       hideRow('optionA');
       hideRow('optionB');
       hideRow('optionC');
       hideRow('optionD');
     }
    </SCRIPT>

  </head>
    <label align="right">วันที่ : <u>{{$date}}</u></label>
    <h2 class="card-title p-3" align="center">รายงานขออนุมัติโอนเงินไฟแนนซ์</h2>
    <h4 class="card-title p-3" align="center">บริษัท ชูเกียรติลิสซิ่ง จำกัด</h4>
    <hr>
  <body>
    <br />
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 250%;">
          <th align="center" width="50px" style="background-color: #33FF00;"><b>ยี่ห้อ</b></th>
          <th align="center" width="65px" style="background-color: #BEBEBE;"><b>แบบ</b></th>
          <th align="center" width="20px" style="background-color: #BEBEBE;"><b>สาขา</b></th>
          <th align="center" width="45px" style="background-color: #BEBEBE;"><b>ทะเบียน</b></th>
          <th align="center" width="35px" style="background-color: #BEBEBE;"><b>ยอดจัด</b></th>
          <th align="center" width="55px" style="background-color: #BEBEBE;"><b>เพิ่มเติม</b></th>
          <th align="center" width="40px" style="background-color: #FFFF00;"><b>คจช.ขนส่ง</b></th>
          <th align="center" width="25px" style="background-color: #FFFF00;"><b>อื่นๆ</b></th>
          <th align="center" width="35px" style="background-color: #FFFF00;"><b>ค่าประเมิน</b></th>
          <th align="center" width="25px" style="background-color: #FFFF00;"><b>อากร</b></th>
          <th align="center" width="35px" style="background-color: #FFFF00;"><b>การตลาด</b></th>
          <th align="center" width="45px" style="background-color: #BEBEBE;"><b>รวมค่าใช้จ่าย</b></th>
          <th align="center" width="35px" style="background-color: #BEBEBE;"><b>คงเหลือ</b></th>
          <th align="center" width="30px" style="background-color: #BEBEBE;"><b>หัก 3%</b></th>
          <th align="center" width="110px" style="background-color: #BEBEBE;"><b>ผู้รับเงิน</b></th>
          <th align="center" width="110px" style="background-color: #BEBEBE;"><b>ผู้รับคอม</b></th>
          <th align="center" width="55px" style="background-color: #BEBEBE;"><b>รวม</b></th>
        </tr>
      </thead>
      <tbody>
          @foreach($data as $key => $value)
          @endforeach
      </tbody>
    </table>

  </body>
</html>
