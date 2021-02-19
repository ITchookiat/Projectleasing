
<style>
    .padding {
        padding: 3rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263)
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px
        }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #919aa3 !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }
</style>

@if($data != NULL)
  <div class="card user-card-full">
    <div class="card-tools d-inline float-right">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button> 
    </div>
    <div class="row m-l-0 m-r-0">
        <div class="col-sm-4 bg-c-lite-green user-profile">
            <div class="card-block text-center text-white">
                <div class="m-b-25"> 
                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                </div>
                <h5 class="f-w-600">{{$data->Contract_legis}}</h5>
                <p>{{$data->Name_legis}}</p> 
                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card-block">
                <h6 class="m-b-20 p-b-5 b-b-default f-w-600" style="color: rgb(255, 117, 25)">ข้อมูลเบื้องต้น</h6>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="m-b-10 f-w-600">ประเภทลูกหนี้</p>
                        <h6 class="text-muted f-w-400">
                            @if($data->Flag == 'Y')
                                ลูกหนี้งานฟ้อง (เช่าซื้อ)
                            @else
                                ลูกหนี้ประนอมหนี้เก่า
                            @endif
                        </h6>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">
                        @if($data->User_court != NULL)
                            ผู้ส่งฟ้อง
                        @else
                            ผู้ส่งประนอมหนี้
                        @endif
                    </p>
                    <h6 class="text-muted f-w-400">
                        @if($data->User_court != NULL)
                            {{ $data->User_court }}
                        @else
                            {{ $data->UserSend1_legis }}
                        @endif
                    </h6>
                  </div>
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">
                        @if($data->Flag == 'Y')
                            วันที่ฟ้อง
                        @else
                            วันที่ประนอมหนี้
                        @endif
                    </p>
                    <h6 class="text-muted f-w-400">
                        @if($data->fillingdate_court != NULL)
                            @if($data->Flag == 'Y')
                                {{ date('d-m-Y', strtotime($data->fillingdate_court)) }}
                            @else
                                {{ date('d-m-Y', strtotime($data->Date_Promise)) }}
                            @endif
                        @elseif($data->Date_Promise != NULL)
                            {{ date('d-m-Y', strtotime($data->Date_Promise)) }}
                        @else
                            -
                        @endif
                    </h6>
                  </div>
                </div>
                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600" style="color: rgb(255, 117, 25)">สถานะลูกหนี้</h6>
                <div class="row">
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">สถานะชั้นฟ้อง</p>
                    <h6 class="text-muted f-w-400">
                        @if($data->Status_legis != NULL)
                            @if($data->Status_legis == 'จ่ายจบก่อนฟ้อง' or $data->Status_legis == 'ยึดรถก่อนฟ้อง' or $data->Status_legis == 'หมดอายุความคดี')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{2}}">{{ $data->Status_legis }}</a>
                            @elseif($data->Status_legis == 'ปิดบัญชีชั้นศาล' or $data->Status_legis == 'ยึดรถชั้นศาล' or $data->Status_legis == 'ประนอมหนี้ชั้นศาล')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{3}}">{{ $data->Status_legis }}</a>
                            @elseif($data->Status_legis == 'ถอนบังคับคดีปิดบัญชี' or $data->Status_legis == 'ถอนบังคับคดียึดรถ' or $data->Status_legis == 'ประนอมหลังยึดทรัพย์' or $data->Status_legis == 'ถอนบังคับคดียอดเหลือน้อย' or $data->Status_legis == 'ถอนบังคับคดีขายเต็มจำนวน')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{7}}">{{ $data->Status_legis }}</a>
                            @elseif($data->Status_legis == 'ศาลพิพากษา' or $data->Status_legis == 'ประนีประนอม(จำหน่ายคดี)' or $data->Status_legis == 'ยื่นคำร้องให้ศาลพิพากษา' or $data->Status_legis == 'ปิดบัญชีโกงเจ้าหนี้')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{13}}">{{ $data->Status_legis }}</a>
                            @else
                                <a href="{{ route('MasterCompro.edit',[$data->id]) }}?type={{2}}">{{ $data->Status_legis }}</a>
                            @endif

                        @elseif($data->Flag_Class != NULL)
                            @if($data->Flag_Class == 'ลูกหนี้รอฟ้อง' or $data->Flag_Class == 'สถานะส่งสืบพยาน' or $data->Flag_Class == 'สถานะส่งคำบังคับ'or $data->Flag_Class == 'สถานะส่งตรวจผลหมาย' or $data->Flag_Class == 'สถานะส่งตั้งเจ้าพนักงาน' or $data->Flag_Class == 'สถานะส่งตรวจผลหมายตั้ง')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{3}}">{{ $data->Flag_Class }}</a>
                            @elseif($data->Flag_Class == 'สถานะส่งคัดโฉนด' or $data->Flag_Class == 'สถานะส่งยึดทรัพย์')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{7}}">{{ $data->Flag_Class }}</a>
                            @elseif($data->Flag_case != NULL)
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{13}}">โกงเจ้าหนี้</a>
                            @endif
                        @else
                            @if($data->Flag_status == 1)
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{6}}">ลูกหนี้เตรียมฟ้อง</a>
                            @else
                                -
                            @endif
                        @endif
                    </h6>
                  </div>
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">สถานะชั้นสืบทรัพย์</p>
                    <h6 class="text-muted f-w-400">
                        @if($data->propertied_asset != NULL)
                            @if($data->propertied_asset == 'Y')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{8}}">ลูกหนี้มีทรัพย์</a>
                            @elseif($data->propertied_asset == 'N')
                                <a href="{{ route('MasterLegis.edit',[$data->id]) }}?type={{8}}">ลูกหนี้ไม่มีทรัพย์</a>
                            @endif
                        @else
                            -
                        @endif
                    </h6>
                  </div>
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">ประเภทประนอมหนี้</p>
                    <h6 class="text-muted f-w-400">
                        @if($data->Promise_id != NULL)
                            @if($data->Flag == 'Y')
                               <a href="{{ route('MasterCompro.edit',[$data->id]) }}?type={{2}}">ลูกหนี้ประนอมหนี้ใหม่</a>
                            @else
                               <a href="{{ route('MasterCompro.edit',[$data->id]) }}?type={{3}}">ลูกหนี้ประนอมหนี้เก่า</a>
                            @endif
                        @else
                            -
                        @endif
                    </h6>
                  </div>
                  <div class="col-sm-6">
                    <p class="m-b-10 f-w-600">สถานะประนอมหนี้</p>
                    <h6 class="text-muted f-w-400">
                        @php
                            $lastday = date('Y-m-d', strtotime("-90 days"));
                        @endphp
                        @if($data->Status_Promise != NULL)
                            <font color="green">{{$data->Status_Promise}}</font>
                        @else
                            @if($data->DatePayment_Promise != NULL)
                                @if($data->DatePayment_Promise < $lastday)
                                    <font color="red">ลูกหนี้ขาดชำระ</font>
                                @else
                                    <font color="green">ลูกหนี้ปรชำระปกติ</font>
                                @endif
                            @else
                               -
                            @endif
                        @endif
                    </h6>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@else
    <div class="card user-card-full">
        <div class="card-tools d-inline float-right">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> 
        </div>
        <section class="content">
            <div class="error-page">
              <h2 class="headline text-danger"><i class="fas fa-exclamation-triangle text-danger"></i></h2>
              <div class="error-content">
                <h3 class="text-danger"> ไม่พบเลขที่สัญญาในระบบ.</h3>
                <p>
                  โปรดตรวจสอบเลขที่สัญญาใหม่อีกครั้ง.
                  หากมีข้อส่งสัยหรือเกิดข้อผิดพลาด โปรดติดต่อแผนกไอที (Dear Programmer) เบอร์ภายใน 240.
                </p>
              </div>
            </div>
        </section>
    </div>
@endif
