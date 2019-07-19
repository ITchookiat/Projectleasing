@php
function DateThai($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("j",strtotime($strDate));

$strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay $strMonthThai $strYear";

}

function DateThai2($strDate)
{

$strYear = date("Y",strtotime($strDate))+543;

$strMonth= date("n",strtotime($strDate));

$strDay= date("d",strtotime($strDate));

$strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");

$strMonthThai=$strMonthCut[$strMonth];

return "$strDay/$strMonthThai/$strYear";

}
@endphp
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

  <!-- Main content -->
  <section class="content">

    <div class="panel panel-default">
      <div class="panel-heading" id="hidden" align="center">
      <font size="4px">เลขที่สัญญา {{$info->CONTNO}}</font>
        <a class="text-red pull-right" href="{{ URL::previous() }}"><font size="5px"> ปิด </font> </a>
      </div>

      <div class="panel-body table-responsive">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>กรุณากรอกข้อมูลให้ครบช่อง {{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif

              <br>

             <div class="col-sm-12">

                  <div class="row">
                    <div class="col-sm-6" align="right">
                          <div class="form-inline">
                          <label for="text" class="mr-sm-2">เลขที่สัญญา : </label>
                          <input type="text" name="startDate" class="form-control mb-2 mr-sm-2" style="width: 200px" value="{{ $info->CONTNO }}">
                          </div>
                    </div>

                    <div class="col-sm-5" align="right">
                        <div class="form-inline">
                        <label for="text" class="mr-sm-2">ชื่อลูกค้า : </label>
                        <input type="text" name="endDate" class="form-control mb-2 mr-sm-2" style="width: 200px" value="{{str_replace(" ","", iconv('Tis-620','utf-8',$info->SNAM.$info->NAME1))."   ".str_replace(" ","", iconv('Tis-620','utf-8',$info->NAME2))}}">
                        </div>
                    </div>

                    <div class="col-sm-1" align="right"> </div>

                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col-sm-6" align="right">
                          <div class="form-inline">
                          <label for="text" class="mr-sm-2">วันทำสัญญา : </label>
                          <input type="text" name="startDate" class="form-control mb-2 mr-sm-2" style="width: 200px" value="{{ DateThai($info->ISSUDT) }}">
                          </div>
                    </div>

                    <div class="col-sm-5" align="right">
                        <div class="form-inline">
                        <label for="text" class="mr-sm-2">วันชำระล่าสุด : </label>
                        <input type="text" name="endDate" class="form-control mb-2 mr-sm-2" style="width: 200px" value="{{ DateThai($info->LPAYD) }}">
                        </div>
                    </div>

                    <div class="col-sm-1" align="right"> </div>

                  </div>
                  <!-- end row -->

                  <div class="row">
                      <div class="col-sm-6" align="right">
                            <div class="form-inline">
                            <label for="text" class="mr-sm-2">ค่างวดงวดละ : </label>
                            <input type="text" name="startDate" class="form-control mb-2 mr-sm-2" style="width: 200px" value="{{ number_format($info->DAMT, 2) }}">
                            </div>
                      </div>

                      <div class="col-sm-5" align="right">
                          <div class="form-inline">
                          <label for="text" class="mr-sm-2">ยอดค้างชำระ : </label>
                          <input type="text" name="endDate" class="form-control mb-2 mr-sm-2 text-right text-red" style="width: 100px" value="{{ number_format($info->EXP_AMT, 2) }}">
                          <label for="text" class="mr-sm-2">ค้าง : </label>
                          <input type="text" name="endDate" class="form-control mb-2 mr-sm-2 text-right text-red" style="width: 59px" value="{{ number_format($info->EXP_PRD, 0) }}">
                          </div>
                      </div>

                    <div class="col-sm-1" align="left"> </div>

                  </div>
                  <!-- end row -->

                  <div class="row">
                      <div class="col-sm-6" align="right">
                            <div class="form-inline">
                            <label for="text" class="mr-sm-2">ค้างจากงวดที่ : </label>
                            <input type="text" name="startDate" class="form-control mb-2 mr-sm-2" style="width: 65px" value="{{ $info->EXP_FRM }}">
                            <label for="text" class="mr-sm-2">ถึงงวดที่ : </label>
                            <input type="text" name="startDate" class="form-control mb-2 mr-sm-2" style="width: 65px" value="{{ $info->EXP_TO }}">
                            </div>
                      </div>

                      <div class="col-sm-5" align="right">
                          <div class="form-inline">
                          <label for="text" class="mr-sm-2">สัญญาของสาขา : </label>
                          <input type="text" name="endDate" class="form-control mb-2 mr-sm-2 text-right text-red" style="width: 50px" value="{{ $info->LOCAT }}">
                          <label for="text" class="mr-sm-2">ค้างจริง : </label>
                          <input type="text" name="endDate" class="form-control mb-2 mr-sm-2 text-right text-red" style="width: 59px" value="{{ number_format($info->HLDNO, 2) }}">
                          </div>
                      </div>

                    <div class="col-sm-1" align="left"> </div>

                  </div>
                  <!-- end row -->

            <hr color="gray">

            <div class="row">
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs bg-gray">
              <li class="active"><a data-toggle="tab" href="#menu1">รายละเอียดสัญญา</a></li>
              <li><a data-toggle="tab" href="#menu2">ตารางชำระ</a></li>
              <!-- <li><a data-toggle="tab" href="#menu3">รายละเอียดลูกหนี้อื่น</a></li> -->
              <li><a data-toggle="tab" href="#menu4">ข้อมูลลูกค้า</a></li>
              <li><a data-toggle="tab" href="#menu5">ข้อมูลผู้ค้ำ</a></li>
              <li><a data-toggle="tab" href="#menu6">ข้อมูลรถ</a></li>
              </ul>

            <div class="tab-content">

              <div id="menu1" class="tab-pane fade in active">
                <br>
                <div class="row">

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ราคาขาย : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->NPRICE, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เงินดาวน์ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->NPAYRES, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เงินลงทุน : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->NCARCST, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">งวดแรก : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ DateThai($info->FDATE) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ค่างวด: </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:110px" value="{{ number_format($info->N_FUPAY, 2) }}">
                    <label for="text" class="mr-sm-2">เดือน</label>
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ดอกเบี้ย : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->NPROFIT, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ผู้ตรวจสอบ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->CHECKER }}">
                    </div>
                  </div>

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ภาษีขาย : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->VATPRC, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ภาษีดาวน์ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->VATPRES, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">จำนวนผ่อน : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->T_NOPAY }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">งวดสุดท้าย : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ DateThai($info->LDATE) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ภาษี : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->V_UPAY }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ชำระเงินเเล้ว : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->SMPAY, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">พน.เก็บเงิน : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->BILLCOLL }}">
                    </div>
                  </div>

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ราคาขายรวม :</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->TOTPRC, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เงินดาวน์รวม : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->TOTPRES, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ดอกเบี้ย(%) : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->EFRATE }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เบี้ยปรับ(%) : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->DELYRT }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">รวมภาษี : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ number_format($info->KEYINFUPAY, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ลูกหนี้คงเหลือ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px; color: red;" value="{{ number_format($info->BALANC - $info->SMPAY, 2) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">พนักงานขาย : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->SALCOD }}">
                    </div>
                  </div>

                </div>
                <!-- end row -->
              </div>
              <!-- end tab menu1 -->

              <div id="menu2" class="tab-pane fade">
                <br>
                  <div class="form-inline pull-right">
                    <label for="text" class="mr-sm-2">จำนวนงวด : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="text" style="width: 60px" value="{{ $info->T_NOPAY }}">

                    <label for="text" class="mr-sm-2">ยอดทั้งหมด : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="text" style="width: 100px" value="{{ number_format($info->BALANC, 2) }}">

                    <label for="text" class="mr-sm-2">ยอดชำระ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="text" style="width: 100px" value="{{ number_format($info->SMPAY, 2) }}">

                    <label for="text" class="mr-sm-2">ยอดคงเหลือ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="text" style="width: 100px" value="{{ number_format($info->BALANC - $info->SMPAY, 2) }}">
                  </div>
                <br><br>

                 <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                   <thead class="thead-dark">
                     <tr>
                       <th class="text-center">งวดที่</th>
                       <th class="text-center">กำหนดชำระ</th>
                       <th class="text-center">ค่างวด</th>
                       <th class="text-center">วันที่ชำระ</th>
                       <th class="text-center">ยอดชำระ</th>
                       <th class="text-center">เลขที่ใบกำกับ</th>
                       <th class="text-center">วันที่ใบกำกับ</th>
                     </tr>
                   </thead>
                 <tbody>
                   @foreach($info2 as $key => $row)
                     <tr>
                       <td class="text-center"> {{ $row->NOPAY }} </td>
                       <td class="text-center"> {{ DateThai2($row->DDATE) }} </td>
                       <td class="text-right"> {{ number_format($row->DAMT, 2) }} </td>
                       <td class="text-center">
                         @if($row->DATE1 == '')
                         @else
                         {{ DateThai2($row->DATE1) }}
                         @endif
                       </td>
                       <td class="text-right"> {{ number_format($row->PAYMENT, 2) }} </td>
                       <td class="text-center"> {{ $row->TAXINV }} </td>
                       <td class="text-center">
                         @if($row->TAXDT == '')
                         @else
                         {{ DateThai2($row->TAXDT) }}
                         @endif
                       </td>
                     </tr>
                   @endforeach
                 </tbody>
                 </table>

              </div>
              <!-- end tab menu2 -->

              <!-- <div id="menu3" class="tab-pane fade">
                Menu3
              </div> -->
              <!-- end tab menu3 -->

              <div id="menu4" class="tab-pane fade">
                <br>
                <div class="row">

                  <div class="col-sm-5" align="right">
                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ลำดับที่อยู่ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info->ADDRNO }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">กลุ่มลูกค้า : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info->GROUP1 }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">รหัสลูกค้า : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info->CUSCOD }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">เลขที่บัตร : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info->IDNO }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">วันเกิด : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ DateThai($info->BIRTHDT) }}">
                    </div>

                  </div>

                  <div class="col-sm-6" align="right">

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ที่อยู่ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info->ADDRES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ตำบล : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info->TUMB) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">อำเภอ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info->AUMPDES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">จังหวัด : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info->PROVDES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">รหัสไปรษณีย์ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info->ZIP }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">เบอร์โทร : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{iconv('Tis-620','utf-8',$info->TELP)}}">
                    </div>
                  </div>

                  <div class="col-sm-1" align="right"></div>

                  </div>

              </div>
              <!-- end tab menu4 -->

              <div id="menu5" class="tab-pane fade">
                <br>
                <div class="row">

                  <div class="col-sm-5" align="right">
                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ลำดับที่ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info3->GARNO }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ชื่อผู้ค้ำ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->NAME) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ความสัมพันธ์ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->RELATN) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ชื่อเล่น : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->NICKNM) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">เลขที่บัตร : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info3->IDNO }}">
                    </div>


                  </div>

                  <div class="col-sm-6" align="right">

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ที่อยู่ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->ADDRES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">ตำบล : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->TUMB) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">อำเภอ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->AUMPDES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">จังหวัด : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->PROVDES) }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">รหัสไปรษณีย์ : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ $info3->ZIP }}">
                    </div>

                    <div class="form-inline">
                      <label for="text" class="mr-sm-5" align="center">เบอร์โทร : </label>
                      <input type="text" class="form-control mb-5 mr-sm-5" id="text" style="width: 200px;" value="{{ iconv('TIS-620', 'utf-8', $info3->TELP) }}">
                    </div>
                  </div>

                  <div class="col-sm-1" align="right"></div>

                  </div>
              </div>
              <!-- end tab menu5 -->

              <div id="menu6" class="tab-pane fade">
                <br>
                <div class="row">

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ยี่ห้อรถ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ iconv('TIS-620', 'utf-8', $info->TYPE) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">รุ่นรถ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ iconv('TIS-620', 'utf-8', $info->MODEL) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">สีรถ : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ iconv('TIS-620', 'utf-8', $info->COLOR) }}">
                    </div>

                    <!-- <div class="form-inline">
                    <label for="text" class="mr-sm-2">จดทะเบียน : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ DateThai($info->ZIP) }}">
                    </div> -->
                  </div>

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ทะเบียน : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:160px" value="{{ iconv('TIS-620', 'utf-8', $info->REGNO) }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เลขตัวถัง : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:160px; font-size: 12px;" value="{{ $info->STRNO }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">เลขเครื่อง : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:160px" value="{{ $info->ENGNO }}">
                    </div>

                    <!-- <div class="form-inline">
                    <label for="text" class="mr-sm-2">ทะเบียนหมด : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ DateThai($info->LDATE) }}">
                    </div> -->
                  </div>

                  <div class="col-sm-4" align="right">
                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">กลุ่มสินค้า :</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->GCODE }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ขนาด : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->CC }}">
                    </div>

                    <div class="form-inline">
                    <label for="text" class="mr-sm-2">ปีผลิต : </label>
                    <input type="text" class="form-control mb-2 mr-sm-2" style="width:150px" value="{{ $info->MANUYR }}">
                    </div>
                  </div>

                </div>
                <!-- end row -->
              </div>
              <!-- end tab menu6 -->

              </div>
           <!-- end tab-content -->
         </div>
         <!-- end nav -->

            </div>
            <!-- end row -->

          </div>
          <!-- end col-sm-12 -->
    </section>

    <script type="text/javascript">
      $(function(){
        $("#image-file").fileinput({
          theme:'fa',
        })
      })
    </script>
