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
      <form name="form1" action="{{ route('MasterRegister.update',[$data->id]) }}" method="post" id="formimage" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="_method" value="PATCH"/>

        <div class="modal-header bg-warning" style="border-radius: 30px 30px 0px 0px;">
          <div class="col text-center">
            <h5 class="modal-title"><i class="fas fa-edit"></i> แก้ไขรายการ</h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-5 col-form-label text-right"><font color="red">*** ป้ายทะเบียน :</font> </label>
                <div class="col-sm-7">
                  <input type="text" name="Registercar" class="form-control" value="" placeholder="ป้อนป้ายทะเบียน" required/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ยี่ห้อรถ : </label>
                <div class="col-sm-7">
                  <select name="Brandcar" class="form-control">
                    <option value="" selected>--- ยี่ห้อ ---</option>
                    <option value="MAZDA">MAZDA</option>
                    <option value="FORD">FORD</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-5 col-form-label text-right">รุ่นรถ : </label>
                <div class="col-sm-7">
                  <input type="text" name="Versioncar" class="form-control" value="" placeholder="ป้อนรุ่นรถ" />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ประเภทรถ : </label>
                <div class="col-sm-7">
                  <select id="Typecar" name="Typecar" class="form-control">
                    <option value="" selected>--- ประเภทรถ ---</option>
                    <option value="รถใช้งาน">รถใช้งาน</option>
                    <option value="รถ Demo">รถ Demo</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-5 col-form-label text-right">เลขตัวถัง :</label>
                <div class="col-sm-7">
                  <input type="text" name="Engnocar" class="form-control" value="" placeholder="ป้อนเลขตัวถัง"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">ปีรถ : </label>
                <div class="col-sm-7">
                  <select id="Yearcar" name="Yearcar" class="form-control">
                    <option value="" selected></option>
                    <option value="">--- เลือกปี ---</option>
                      @php
                          $Year = date('Y');
                      @endphp
                      @for ($i = 0; $i < 15; $i++)
                        <option value="{{ $Year }}">{{ $Year }}</option>
                        @php
                            $Year -= 1;
                        @endphp
                      @endfor
                  </select>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
              <label class="col-sm-5 col-form-label text-right">วันหมดอายุทะเบียน :</label>
                <div class="col-sm-7">
                  <input type="date" name="RegisterExpire" value="" class="form-control"/>
                </div>
              </div>
              <div class="form-group row mb-1">
              <label class="col-sm-5 col-form-label text-right">วันหมดอายุประกัน :</label>
                <div class="col-sm-7">
                  <input type="date" name="InsureExpire" value="" class="form-control"/>
                </div>
              </div>
              <div class="form-group row mb-1">
              <label class="col-sm-5 col-form-label text-right">วันหมดอายุ พรบ. :</label>
                <div class="col-sm-7">
                  <input type="date" name="ActExpire" value="" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-4 col-form-label text-right">บริษัทประกัน :</label>
                <div class="col-sm-7">
                  <input type="text" name="InsureCompany" value="" class="form-control" placeholder="ป้อนบริษัทประกัน"/>
                </div>
              </div>
              <div class="form-group row mb-1">
                <label class="col-sm-4 col-form-label text-right">สถานที่ซ่อม :</label>
                <div class="col-sm-7">
                  <select id="RepairPlace" name="RepairPlace" class="form-control">
                    <option value="" selected>--- เลือกสถานที่ซ่อม ---</option>
                    <option value="ซ่อมอู่">ซ่อมอู่</option>
                    <option value="ซ่อมห้าง">ซ่อมห้าง</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-1">
              <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="Notecar" rows="2" placeholder="ป้อนหมายเหตุ..."></textarea>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <!-- <input type="hidden" name="NameUser" value="{{auth::user()->name}}" class="form-control" placeholder="ป้อนชื่อ"/> -->
          <div style="text-align: center;">
              <button type="submit" class="btn btn-success text-center" style="border-radius: 50px;">อัพเดท</button>
              <button type="button" class="btn btn-danger" style="border-radius: 50px;" data-dismiss="modal">ยกเลิก</button>
          </div>
        </div>
      </form>
   @endif
  </section>
