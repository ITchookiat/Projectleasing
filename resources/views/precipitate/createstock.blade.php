@extends('layouts.master')
@section('title','เพิ่มข้อมูลสต็อกรถเร่งรัด')
@section('content')

  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $Y2 = date('Y') + 542;
    $m = date('m');
    $d = date('d');
    //$date = date('Y-m-d');
    $time = date('H:i');
    $date = $Y.'-'.$m.'-'.$d;
    $date2 = $Y2.'-'.$m.'-'.$d;
  @endphp

  <section class="content">
    <div class="content-header">
      <section class="content">
        <form name="form1" action="{{ route('MasterPrecipitate.store') }}" method="post" id="formimage" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header text-sm">
                  <div class="row">
                    <div class="col-5">
                      <div class="form-inline">
                        <h5>
                          @if($type == 6)
                            เพิ่มข้อมูลสต็อกรถ
                          @endif
                        </h5>
                      </div>
                    </div>
                    <div class="col-7">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-inline float-right">
                            <div class="info-box-content pr-2 text-sm">
                                <small class="badge badge-secondary" style="font-size: 16px;">
                                  <i class="fas fa-sign"></i>&nbsp; สถานะรถ :
                                    <select name="Statuscar" class="form-control">
                                      <option selected value="">---เลือกสถานะ---</option>
                                        <option value="1" {{ ($DB_type == 1) ? 'selected' : '' }}>รถยึด</otion>
                                        <option value="3" {{ ($DB_type != 1) ? 'selected' : '' }}>รถยึด (Ploan)</otion>
                                        <option value="2">ลูกค้ามารับรถคืน</otion>
                                        <option value="4">รับรถจากของกลาง</otion>
                                        <option value="5">ส่งรถบ้าน</otion>
                                        <option value="6">ลูกค้าส่งรถคืน</otion>
                                    </select>
                                </small>
                            </div>

                            <button type="submit" class="delete-modal btn btn-success">
                              <i class="fas fa-save"></i> บันทึก
                            </button>
                            &nbsp;
                            <a class="delete-modal btn btn-danger" href="{{ route('Precipitate', 5) }}">
                              <i class="far fa-window-close"></i> ยกเลิก
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <div class="row">
                    <div class="col-md-12">
                        <script>
                          function addCommas(nStr){
                          nStr += '';
                          x = nStr.split('.');
                          x1 = x[0];
                          x2 = x.length > 1 ? '.' + x[1] : '';
                          var rgx = /(\d+)(\d{3})/;
                          while (rgx.test(x1)) {
                          x1 = x1.replace(rgx, '$1' + ',' + '$2');
                          }
                          return x1 + x2;
                          }
      
                          function comma(){
                          var num11 = document.getElementById('Pricehold').value;
                          var num1 = num11.replace(",","");
                          document.form1.Pricehold.value = addCommas(num1);
      
                          var num22 = document.getElementById('Amounthold').value;
                          var num2 = num22.replace(",","");
                          document.form1.Amounthold.value = addCommas(num2);
      
                          var num33 = document.getElementById('Payhold').value;
                          var num3 = num33.replace(",","");
                          document.form1.Payhold.value = addCommas(num3);
      
                          var num44 = document.getElementById('CapitalAccount').value;
                          var num4 = num44.replace(",","");
                          document.form1.CapitalAccount.value = addCommas(num4);
      
                          var num55 = document.getElementById('CapitalTopprice').value;
                          var num5 = num55.replace(",","");
                          document.form1.CapitalTopprice.value = addCommas(num5);
                          }
                        </script>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="card card-warning">
                              <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-book"></i> ข้อมูลทั่วไป</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label><font color="red">เลขที่สัญญา : </font></label>
                                    @if($data == null)
                                      <input type="text" name="Contno" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้อนเลขที่สัญญา" />
                                    @else
                                      <input type="text" name="Contno" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->CONTNO))}}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                    @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-3">ชื่อ - สกุล : </label>
                                    @if($data == null)
                                      <input type="text" name="NameCustomer" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                    @else
                                      <input type="text" name="NameCustomer" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->SNAM))}}{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->NAME1))}}   {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->NAME2))}}" class="form-control form-control-sm" placeholder="ป้อนชื่อ" />
                                    @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-3">เลขบัตรประชาชน : </label>
                                    @if($data == null)
                                      <input type="text" name="IdcardCustomer" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                                    @else
                                      <input type="text" name="IdcardCustomer" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->IDNO))}}" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน"/>
                                    @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>ที่อยู่ผู้เช่าซื้อ : </label>
                                      @if($data == null)
                                        <input type="text" name="AddressCustomer" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                                      @else
                                        <input type="text" name="AddressCustomer" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',$data->ADDRES)}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->PROVDES))}}" class="form-control form-control-sm" placeholder="ป้อนรายละเอียดที่อยู่" />
                                      @endif
                                    </div>
                                  </div>
                                </div>

                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-3">เบอร์โทรศัพท์ : </label>
                                    @if($data == null)
                                      <input type="text" name="PhoneCustomer" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้อนเลขเบอร์โทรศัพท์"/>
                                    @else
                                      <input type="text" name="PhoneCustomer" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TELP))}}" class="form-control form-control-sm" placeholder="ป้อนเบอร์โทรศัพท์"/>
                                    @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                  </div>
                                </div>
                                <hr>              
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-3">ยี่ห้อรถ : </label>
                                      @if($data == null)
                                        <select name="Brandcar" style="width: 250px;" class="form-control form-control-sm">
                                          <option value="" selected>--- ยี่ห้อ ---</option>
                                          <option value="ISUZU">ISUZU</option>
                                          <option value="MITSUBISHI">MITSUBISHI</option>
                                          <option value="TOYOTA">TOYOTA</option>
                                          <option value="MAZDA">MAZDA</option>
                                          <option value="FORD">FORD</option>
                                          <option value="NISSAN">NISSAN</option>
                                          <option value="HONDA">HONDA</option>
                                          <option value="CHEVROLET">CHEVROLET</option>
                                          <option value="MG">MG</option>
                                          <option value="SUZUKI">SUZUKI</option>
                                        </select>
                                      @else
                                        <select name="Brandcar" style="width: 250px;" class="form-control form-control-sm">
                                          <option value="" selected>--- ยี่ห้อ ---</option>
                                          <option value="ISUZU" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'อีซูซุ') ? 'selected' : ''}}>ISUZU</option>
                                          <option value="MITSUBISHI" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'มิตซูบิชิ') ? 'selected' : ''}}>MITSUBISHI</option>
                                          <option value="TOYOTA" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'โตโยต้า') ? 'selected' : ''}}>TOYOTA</option>
                                          <option value="MAZDA" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'มาสด้า') ? 'selected' : ''}}>MAZDA</option>
                                          <option value="FORD" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'ฟอร์ด') ? 'selected' : ''}}>FORD</option>
                                          <option value="NISSAN" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'นิสสัน') ? 'selected' : ''}}>NISSAN</option>
                                          <option value="HONDA" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'ฮอนด้า') ? 'selected' : ''}}>HONDA</option>
                                          <option value="CHEVROLET" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'เชฟโรเล๊ต') ? 'selected' : ''}}>CHEVROLET</option>
                                          <option value="MG" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'เอ็มจี') ? 'selected' : ''}}>MG</option>
                                          <option value="SUZUKI" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE)) == 'ซูซูกิ') ? 'selected' : ''}}>SUZUKI</option>
                                        </select>
                                        <!-- <input type="text" name="Brandcar" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$data->TYPE))}}" class="form-control form-control-sm"/> -->
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>ป้ายทะเบียน : </label>
                                      @if($data == null)
                                        <input type="text" name="Number_Regist" style="width: 250px;" class="form-control form-control-sm" placeholder="ป้ายเดิม" required/>
                                      @else
                                        <input type="text" name="Number_Regist" style="width: 250px;"  value="{{iconv('Tis-620','utf-8',$data->REGNO)}}" class="form-control form-control-sm" placeholder="ป้ายเดิม" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
              
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-5">ปีรถ : </label>
                                    @if($data == null)
                                      <select id="Yearcar" name="Yearcar" style="width: 250px;" class="form-control form-control-sm">
                                        <option value="" selected>--- เลือกปี ---</option>
                                        @php
                                          $Year = date('Y');
                                        @endphp
                                        @for ($i = 0; $i < 20; $i++)
                                          <option value="{{ $Year }}">{{ $Year }}</option>
                                          @php
                                            $Year -= 1;
                                          @endphp
                                        @endfor
                                      </select>
                                    @else
                                      <input type="text" name="Yearcar" style="width: 250px;" value="{{iconv('Tis-620','utf-8',str_replace(" ","",$data->MANUYR))}}" class="form-control form-control-sm" placeholder="ปี" />
                                    @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-3">วันที่ยึด : </label>
                                    <input type="date" name="Datehold" class="form-control form-control-sm" style="width: 250px;" value="{{ date('Y-m-d') }}">
                                    </div>
                                  </div>
                                </div>
              
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-5">ทีมยึด : </label>
                                    @if($data == null)
                                    <select name="Teamhold" class="form-control form-control-sm" style="width: 250px">
                                      <option selected value="">---เลือกทีมยึด---</option>
                                        <option value="008">008 - เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</otion>
                                        <option value="047">047 - มาซีเตาะห์ แวสือนิ</otion>
                                        <option value="102">102 - นายอับดุลเล๊าะ กาซอ</otion>
                                        <option value="104">104 - นายอนุวัฒน์ อับดุลรานี</otion>
                                        <option value="105">105 - นายธีรวัฒน์ เจ๊ะกา</otion>
                                        <option value="112">112 - นายราชัน เจ๊ะกา</otion>
                                        <option value="113">113 - นายฟิฏตรี วิชา</otion>
                                        <option value="114">114 - นายอานันท์ กาซอ</otion>
                                    </select>
                                    @else 
                                    <select name="Teamhold" class="form-control form-control-sm" style="width: 250px">
                                      <option selected value="">---เลือกทีมยึด---</option>
                                        <option value="008" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '008') ? 'selected' : ''}}>008 - เจ๊ะฟารีด๊ะห์ เจ๊ะกาเดร์</otion>
                                        <option value="047" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '047') ? 'selected' : ''}}>047 - มาซีเตาะห์ แวสือนิ</otion>
                                        <option value="102" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '102') ? 'selected' : ''}}>102 - นายอับดุลเล๊าะ กาซอ</otion>
                                        <option value="104" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '104') ? 'selected' : ''}}>104 - นายอนุวัฒน์ อับดุลรานี</otion>
                                        <option value="105" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '105') ? 'selected' : ''}}>105 - นายธีรวัฒน์ เจ๊ะกา</otion>
                                        <option value="112" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '112') ? 'selected' : ''}}>112 - นายราชัน เจ๊ะกา</otion>
                                        <option value="113" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '113') ? 'selected' : ''}}>113 - นายฟิฏตรี วิชา</otion>
                                        <option value="114" {{(iconv('TIS-620', 'utf-8',str_replace(" ","",$data->BILLCOLL)) == '114') ? 'selected' : ''}}>114 - นายอานันท์ กาซอ</otion>
                                    </select>
                                    @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label class="pr-5">ค่ายึด : </label>
                                    <input type="text" id="Pricehold" name="Pricehold" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนค่ายึด" oninput="comma();">
                                    </div>
                                  </div>
                                </div>
              
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <!-- <div class="float-right form-inline">
                                      <label class="pr-3"><font color="red">สถานะรถ : </font></label>
                                      <select name="Statuscar" class="form-control" style="width: 250px">
                                        <option selected value="">---เลือกสถานะ---</option>
                                          <option value="1">รถยึด</otion>
                                          <option value="3">รถยึด (Ploan)</otion>
                                          <option value="2">ลูกค้ามารับรถคืน</otion>
                                          <option value="4">รับรถจากของกลาง</otion>
                                          <option value="5">ส่งรถบ้าน</otion>
                                          <option value="6">ลูกค้าส่งรถคืน</otion>
                                      </select>
                                    </div> -->
                                    <div class="float-right form-inline">
                                      <label style="vertical-align: top;">รายละเอียด : </label>
                                      <textarea name="Note" class="form-control form-control-sm" placeholder="ป้อนรายละเอียด" rows="5" style="width: 250px;"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-6">
  
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card card-info">
                              <div class="card-header">
                              <h3 class="card-title"><i class="fas fa-calendar"></i> ข้อมูลวันที่</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>วันที่มารับรถคืน : </label>
                                    <input type="date" name="Datecame" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>วันที่ส่งรถบ้าน : </label>
                                    <input type="date" name="DatesendStockhome" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card card-info">
                              <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-money"></i> ข้อมูลบัญชี</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>ค่างวดยึดค้าง : </label>
                                    <input type="text" id="Amounthold" name="Amounthold" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนค่างวดยึดค้าง" oninput="comma();" >
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>ชำระค่างวดยึด : </label>
                                    <input type="text" id="Payhold" name="Payhold" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนชำระค่างวดยึด" oninput="comma();">
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>วันที่เช็คต้นทุน : </label>
                                    <input type="date" name="DatecheckCapital" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>ต้นทุนยอดจัด : </label>
                                      <input type="text" id="CapitalTopprice" name="CapitalTopprice" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนต้นทุนยอดจัด" oninput="comma();">
                                    </div>
                                  </div>
                                </div>
                                <div class="row mb-1">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>ผลจากการขายได้ : </label>
                                      <input type="text" name="Soldout" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนข้อมูล">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>ต้นทุนบัญชี : </label>
                                      <input type="text" id="CapitalAccount" name="CapitalAccount" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนต้นทุนบัญชี" oninput="comma();">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card card-danger">
                              <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-users"></i> ข้อมูลผู้ค้ำ</h3>
                               
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>ชื่อ - สกุลผู้ค้ำ : </label>
                                      @if($dataGT == null)
                                        <input type="text" name="nameSP" style="width: 250px;" class="form-control form-control-sm" placeholder="ชื่อ" />
                                      @else
                                        <input type="text" name="nameSP" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',$dataGT->NAME)}}" class="form-control form-control-sm" placeholder="ชื่อ" />
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>เบอร์ติดต่อ : </label>
                                      @if($dataGT == null)
                                        <input type="text" name="phoneSP" style="width: 250px;" class="form-control form-control-sm" placeholder="เบอร์ติดต่อ" />
                                      @else
                                        <input type="text" name="phoneSP" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',$dataGT->TELP)}}" class="form-control form-control-sm" placeholder="เบอร์ติดต่อ" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
              
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>เลขบัตร ปชช. : </label>
                                      @if($dataGT == null)
                                        <input type="text" name="idcardSP" style="width: 250px;" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน" />
                                      @else
                                        <input type="text" name="idcardSP" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',$dataGT->IDNO)}}" class="form-control form-control-sm" placeholder="เลขบัตรประชาชน"/>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>ที่อยู่ของผู้ค้ำ : </label>
                                      @if($dataGT == null)
                                        <input type="text" name="addressSP" style="width: 250px;" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                      @else
                                        <input type="text" name="addressSP" style="width: 250px;" value="{{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->ADDRES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->TUMB))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->AUMPDES))}} {{iconv('TIS-620', 'utf-8',str_replace(" ","",$dataGT->PROVDES))}}" class="form-control form-control-sm" placeholder="รายละเอียดที่อยู่" />
                                      @endif
                                    </div>
                                  </div>
                                </div>
            
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="card card-warning">
                              <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-envelope"></i> จดหมายผู้เช่าซื้อ</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>เลขบาร์โค๊ด : </label>
                                      <input type="text" name="BarcodeNo" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนเลขบาร์โค๊ด">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>วันที่ส่งจดหมาย : </label>
                                      <input type="date" name="DatesendLetter" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                </div>
            
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label style="vertical-align: top;">หมายเหตุ : </label>
                                      <textarea name="Note2" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="3" style="width: 250px;"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>วันที่ได้รับจดหมาย : </label>
                                      <input type="date" name="DateBuyergetLetter" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="card card-danger">
                              <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-envelope"></i> จดหมายผู้ค้ำ</h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>บาร์โค๊ดผู้ค้ำ : </label>
                                      <input type="text" name="Barcode2" class="form-control form-control-sm" style="width: 250px;" placeholder="ป้อนบาร์โค๊ด">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>วันส่งจดหมาย : </label>
                                      <input type="date" name="Datesend" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                </div>
              
                                <div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label style="vertical-align: top;">หมายเหตุ : </label>
                                      <textarea name="Letter" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="3" style="width: 250px;"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                      <label>วันได้รับจดหมาย : </label>
                                      <input type="date" name="DateSupportGet" class="form-control form-control-sm" style="width: 250px;">
                                    </div>
                                  </div>
                                </div>
              
                                {{--<div class="row">
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>สถานะจดหมาย : </label>
                                    <!-- <input type="text" name="Accept" class="form-control" style="width: 250px;" placeholder="ป้อนข้อมูล"> -->
                                    <select name="Accept" class="form-control" style="width: 250px">
                                      <option selected disabled value="">---เลือก---</option>
                                        <option value="ได้รับ">ได้รับ</otion>
                                        <option value="รอส่ง">รอส่ง</otion>
                                        <option value="ส่งใหม่">ส่งใหม่</otion>
                                    </select>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="float-right form-inline">
                                    <label>ผลการขายได้ : </label>
                                    <input type="text" name="Soldout" class="form-control" style="width: 250px;" readonly>
                                    </div>
                                  </div>
                                </div>--}}
                              </div>
                            </div>
                          </div>
                        </div>
      
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="type" value="6" />
                        <input type="hidden" readonly name="Cartype" value="{{ $type }}" class="form-control" />
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </form>
      </section>
    </div>
  </section>

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
