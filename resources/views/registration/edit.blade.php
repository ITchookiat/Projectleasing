  @php
    function DateThai($strDate){
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));
      //$strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
      $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear";
      //return "$strDay-$strMonthThai-$strYear";
    }
  @endphp
  <section class="content">
   @if($type == 1) {{--หน้าดูรายละเอียด--}}
      <div class="modal-header bg-info" style="border-radius: 30px 30px 0px 0px;">
        <div class="col text-center">
          <h5 class="modal-title"><i class="fas fa-car"></i> {{$data->Contract_buyer}}</h5>
        </div>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ป้ายทะเบียน :</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ประเภทรถ : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-1">
            <label class="col-sm-4 col-form-label text-right">ยี่ห้อรถ : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">บริษัทประกัน : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">รุ่นรถ : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">สถานที่ซ่อม : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ปีรถ : </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
            <div class="form-group row mb-1">
             <label class="col-sm-4 col-form-label text-right">เลขตัวถัง :</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" value="" readonly/>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
              <div class="col-sm-7">
              <textarea class="form-control" name="Notecar" rows="3" placeholder="ป้อนหมายเหตุ..." readonly></textarea>
              </div>
            </div>
          </div>
        </div>
        <br>
      </div>
   @elseif($type == 2) {{--หน้าแก้ไข--}}
      <form name="form1" action="{{ route('MasterRegister.update',[$data->Reg_id]) }}" method="post" id="formimage" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="_method" value="PATCH"/>
          <input type="hidden" name="type" value="1"/>

        <div class="modal-header" style="border-radius: 30px 30px 0px 0px;">
          <div class="col text-center">
            <h5 class="modal-title"><i class="fas fa-edit"></i> แก้ไขรายการ</h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
            
          <div class="card card-warning card-tabs" style="margin-top:-20px;">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-1" data-toggle="pill" href="#tabs-5" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"><i class="fas fa-toggle-on"></i> ข้อมูลทั่วไป</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-2" data-toggle="pill" href="#tabs-6" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ค่าใช้จ่าย</a>
                </li>
                <!-- <li class="nav-item" >
                  <a class="nav-link" id="custom-tabs-3" data-toggle="pill" href="#tabs-7" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ค่าโอนออก</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-4" data-toggle="pill" href="#tabs-8" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-toggle-on"></i> ค่าอื่นๆ</a>
                </li> -->
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade active show" id="tabs-5" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <div class="row">
                    <div class="col-md-6">
                      วันที่รับ
                      <input type="date" name="dateaccept" class="form-control" value="{{$data->Date_regis}}" />
                    </div>
                    <div class="col-md-3">
                      ป้ายทะเบียนเดิม
                      <input type="text" name="licensecar" class="form-control" value="{{$data->Regno_regis}}"/>
                    </div>
                    <div class="col-md-3">
                      ป้ายทะเบียนใหม่
                      <input type="text" name="Newlicensecar" class="form-control" value="{{($data->NewReg_regis != '')?$data->NewReg_regis:'-'}}"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      ชื่อ
                      <input type="text" name="Namebuyer" class="form-control" value="{{$data->CustName_regis}}" />
                    </div>
                    <div class="col-md-3">
                      นามสกุล
                      <input type="text" name="Lastbuyer" class="form-control" value="{{$data->CustSurN_regis}}" />
                    </div>
                    <div class="col-md-3">
                      ยี่ห้อรถ
                      <!-- <input type="text" name="Brandcar" class="form-control" value="{{$data->Brand_regis}}"/> -->
                      <select name="Brandcar" class="form-control">
                        <option value="" selected>--- ยี่ห้อ ---</option>
                        <option value="MAZDA" {{ ($data->Brand_regis === 'MAZDA') ? 'selected' : '' }}>MAZDA</option>
                        <option value="FORD" {{ ($data->Brand_regis === 'FORD') ? 'selected' : '' }}>FORD</option>
                        <option value="ISUZU" {{ ($data->Brand_regis === 'ISUZU') ? 'selected' : '' }}>ISUZU</option>
                        <option value="MITSUBISHI" {{ ($data->Brand_regis === 'MITSUBISHI') ? 'selected' : '' }}>MITSUBISHI</option>
                        <option value="TOYOTA" {{ ($data->Brand_regis === 'TOYOTA') ? 'selected' : '' }}>TOYOTA</option>
                        <option value="NISSAN" {{ ($data->Brand_regis === 'NISSAN') ? 'selected' : '' }}>NISSAN</option>
                        <option value="HONDA" {{ ($data->Brand_regis === 'HONDA') ? 'selected' : '' }}>HONDA</option>
                        <option value="CHEVROLET" {{ ($data->Brand_regis === 'CHEVROLET') ? 'selected' : '' }}>CHEVROLET</option>
                        <option value="MG" {{ ($data->Brand_regis === 'MG') ? 'selected' : '' }}>MG</option>
                        <option value="SUZUKI" {{ ($data->Brand_regis === 'SUZUKI') ? 'selected' : '' }}>SUZUKI</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      รุ่นรถ
                      <input type="text" name="Modelcar" class="form-control" value="{{($data->Model_regis != null)?$data->Model_regis:'-'}}"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      ชนิดการโอน
                      <select name="Typetransfer" class="form-control">
                        <option value="">---เลือกชนิดการโอน---</option>
                        <option value="โอนจัดไฟแนนซ์" {{ ($data->TypeofReg_regis === 'โอนจัดไฟแนนซ์') ? 'selected' : '' }}>โอนจัดไฟแนนซ์</option>
                        <option value="โอนออก" {{ ($data->TypeofReg_regis === 'โอนออก') ? 'selected' : '' }}>โอนออก</option>
                        <option value="จดทะเบียนรถใหม่" {{ ($data->TypeofReg_regis === 'จดทะเบียนรถใหม่') ? 'selected' : '' }}>จดทะเบียนรถใหม่</option>
                        <option value="อื่นๆ" {{ ($data->TypeofReg_regis === 'อื่นๆ') ? 'selected' : '' }}>อื่นๆ</option>
                      </select>
                      บริษัท
                      <select name="Companyown" class="form-control">
                        <option value="">---เลือกบริษัท---</option>
                        <option value="CKL" {{ ($data->Comp_regis === 'CKL') ? 'selected' : '' }}>CKL - ชูเกียรติลิสซิ่ง</option>
                        <option value="CKY" {{ ($data->Comp_regis === 'CKY') ? 'selected' : '' }}>CKY - ชูเกียรติยนต์</option>
                        <option value="CKC" {{ ($data->Comp_regis === 'CKC') ? 'selected' : '' }}>CKC - ชูเกียรติคาร์</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      รายละเอียด
                      <textarea name="Describeregis" class="form-control" rows="4">{{$data->Desc_regis}}</textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                       วันที่เบิกไปขนส่ง
                      <input type="date" name="Datetransport" class="form-control" value="{{$data->CashoutDate_regis}}" />
                    </div>
                    <div class="col-md-3">
                       วันที่รับเล่มจากขนส่ง
                      <input type="date" name="Dategetregis" class="form-control" value="{{$data->DocrecDate_regis}}" />
                    </div>
                    <div class="col-md-6">
                      <table class="table table-bordered" align="center">
                        <thead>
                          <tr style="line-height:5px;">
                            <th class="text-center">เช็คเล่ม</th>
                            <th class="text-center">เช็คกุญแจ</th>
                            <th class="text-center">เช็คใบเสร็จ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="text-center">
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="customCheckbox4" type="checkbox" name="Doccheck" value="check" {{ ($data->DocChk_regis == "check") ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckbox4"></label>
                              </div>
                            </th>
                            <th class="text-center">
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="customCheckbox5" type="checkbox" name="Keycheck" value="check" {{ ($data->KeyChk_regis == "check") ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckbox5"></label>
                              </div>
                            </th>
                            <th class="text-center">
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="customCheckbox6" type="checkbox" name="Receiptcheck" value="check" {{ ($data->RecChk_regis == "check") ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckbox6"></label>
                              </div>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-6" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <div class="row">
                    <div class="col-md-4">
                        เงินที่รับจากลูกค้า/บริษัท
                        <input type="text" id="Budgetamount" name="Budgetamount" class="form-control" value="{{($data->CustAmt_regis != null)?$data->CustAmt_regis : 0}}" oninput="calculate();"/>
                        ค่าช่าง
                        <input type="text" id="Budgettecnique" name="Budgettecnique" class="form-control" value="{{($data->TechAmt_regis != null)?$data->TechAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                        เงินตามใบเสร็จ
                        <input type="text" id="Budgetreceipt" name="Budgetreceipt" class="form-control" value="{{($data->RecptAmt_regis != null)?$data->RecptAmt_regis : 0}}" oninput="calculate();"/>
                        ค่าลอกลาย
                        <input type="text" id="Budgetcopy" name="Budgetcopy" class="form-control" value="{{($data->CopyAmt_regis != null)?$data->CopyAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">คงเหลือ</h3>
                        </div>
                        <div class="card-body">
                          <input type="text" id="Remainfee" name="Remainfee" class="form-control text-center text-red" value="{{($data->Remainfee_regis != null)?$data->Remainfee_regis : '0.00'}}" style="border:none;"/>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษย้ายเข้า
                      <input type="text" id="TransferinExtra" name="TransferinExtra" class="form-control" value="{{($data->TransInAmt_regis != null)?$data->TransInAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษโอน
                      <input type="text" id="Transferextra" name="Transferextra" class="form-control" value="{{($data->TransAmt_regis != null)?$data->TransAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษรถใหม่
                      <input type="text" id="Newcarextra" name="Newcarextra" class="form-control" value="{{($data->NewCarAmt_regis != null)?$data->NewCarAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษภาษี
                      <input type="text" id="Taxextra" name="Taxextra" class="form-control" value="{{($data->TaxAmt_regis != null)?$data->TaxAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษป้าย
                      <input type="text" id="Regisextra" name="Regisextra" class="form-control" value="{{($data->RegAmt_regis != null)?$data->RegAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษคู่มือ
                      <input type="text" id="Docextra" name="Docextra" class="form-control" value="{{($data->DocAmt_regis != null)?$data->DocAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษแก้ไข
                      <input type="text" id="Editextra" name="Editextra" class="form-control" value="{{($data->FixAmt_regis != null)?$data->FixAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษยกเลิก
                      <input type="text" id="Cancelextra" name="Cancelextra" class="form-control" value="{{($data->CancelAmt_regis != null)?$data->CancelAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-2">
                      ค่าพิเศษอื่น
                      <input type="text" id="Otherextra" name="Otherextra" class="form-control" value="{{($data->OtherAmt_regis != null)?$data->OtherAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                    <div class="col-md-2">
                      ค่า EMS
                      <input type="text" id="EMSfee" name="EMSfee" class="form-control" value="{{($data->EMSAmt_regis != null)?$data->EMSAmt_regis : 0}}" oninput="calculate();"/>
                    </div>
                  </div>
                </div>
                <!-- <div class="tab-pane fade" id="tabs-7" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <div class="row">
                    <div class="col-md-4">
                        เงินที่รับจากลูกค้า/บริษัท
                        <input type="text" id="Budgetamount2" name="Budgetamount2" class="form-control" value=""/>
                        ค่าช่าง
                        <input type="text" id="Budgettecnique2" name="Budgettecnique2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                        เงินตามใบเสร็จ
                        <input type="text" id="Budgetreceipt2" name="Budgetreceipt2" class="form-control" value=""/>
                        ค่าลอกลาย
                        <input type="text" id="Budgetcopy2" name="Budgetcopy2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">คงเหลือ</h3>
                        </div>
                        <div class="card-body">
                          <input type="text" id="Remainfee2" name="Remainfee2" class="form-control text-center" value="0.00" style="border:none;"/>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษย้ายเข้า
                      <input type="text" id="TransferinExtra2" name="TransferinExtra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษโอน
                      <input type="text" id="Transferextra2" name="Transferextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษรถใหม่
                      <input type="text" id="Newcarextra2" name="Newcarextra2" class="form-control" value=""/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษภาษี
                      <input type="text" id="Taxextra2" name="Taxextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษป้าย
                      <input type="text" id="Regisextra2" name="Regisextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษคู่มือ
                      <input type="text" id="Docextra2" name="Docextra2" class="form-control" value=""/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษแก้ไข
                      <input type="text" id="Editextra2" name="Editextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษยกเลิก
                      <input type="text" id="Cancelextra2" name="Cancelextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-2">
                      ค่าพิเศษอื่น
                      <input type="text" id="Otherextra2" name="Otherextra2" class="form-control" value=""/>
                    </div>
                    <div class="col-md-2">
                      ค่า EMS
                      <input type="text" id="EMSfee2" name="EMSfee2" class="form-control" value=""/>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabs-8" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <div class="row">
                    <div class="col-md-4">
                        เงินที่รับจากลูกค้า/บริษัท
                        <input type="text" id="Budgetamount3" name="Budgetamount3" class="form-control" value=""/>
                        ค่าช่าง
                        <input type="text" id="Budgettecnique3" name="Budgettecnique3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                        เงินตามใบเสร็จ
                        <input type="text" id="Budgetreceipt3" name="Budgetreceipt3" class="form-control" value=""/>
                        ค่าลอกลาย
                        <input type="text" id="Budgetcopy3" name="Budgetcopy3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">คงเหลือ</h3>
                        </div>
                        <div class="card-body">
                          <input type="text" id="Remainfee3" name="Remainfee3" class="form-control text-center" value="0.00" style="border:none;"/>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษย้ายเข้า
                      <input type="text" id="TransferinExtra3" name="TransferinExtra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษโอน
                      <input type="text" id="Transferextra3" name="Transferextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษรถใหม่
                      <input type="text" id="Newcarextra3" name="Newcarextra3" class="form-control" value=""/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษภาษี
                      <input type="text" id="Taxextra3" name="Taxextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษป้าย
                      <input type="text" id="Regisextra3" name="Regisextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษคู่มือ
                      <input type="text" id="Docextra3" name="Docextra3" class="form-control" value=""/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      ค่าพิเศษแก้ไข
                      <input type="text" id="Editextra3" name="Editextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-4">
                      ค่าพิเศษยกเลิก
                      <input type="text" id="Cancelextra3" name="Cancelextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-2">
                      ค่าพิเศษอื่น
                      <input type="text" id="Otherextra3" name="Otherextra3" class="form-control" value=""/>
                    </div>
                    <div class="col-md-2">
                      ค่า EMS
                      <input type="text" id="EMSfee3" name="EMSfee3" class="form-control" value=""/>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>

          <div style="text-align: center;">
              <button type="submit" class="btn btn-success text-center" style="border-radius: 50px;">อัพเดท</button>
              <button type="button" class="btn btn-danger" style="border-radius: 50px;" data-dismiss="modal">ยกเลิก</button>
          </div>
        </div>
      </form>
   @endif
  </section>
  @include('registration.script')
