<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<section class="content">
    @if($type == 1){{-- หน้าตั้งค่าข้อมูลสินเชื่อ--}}
        <!-- <div class="modal-header">
            <h4 class="modal-title">ตั้งค่าข้อมูลสินเชื่อ</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div> -->
        <div class="modal-body">
            <div class="col-12">
                <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-home-tab" data-toggle="pill" href="#custom-tabs-home" role="tab" aria-controls="custom-tabs-home" aria-selected="false">ตั้งค่าข้อมูลเช่าซื้อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-profile-tab" data-toggle="pill" href="#custom-tabs-profile" role="tab" aria-controls="custom-tabs-profile" aria-selected="true">ตั้งค่าข้อมูลเงินกู้</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                          {{--ตั้งค่าเช่าซื้อ--}}
                            <div class="tab-pane fade active show" id="custom-tabs-home" role="tabpanel" aria-labelledby="custom-tabs-home-tab">
                                <form name="form2" action="{{ route('MasterSetting.update',[0]) }}?type={{1}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="_method" value="PATCH"/>  
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ค่าอากร :</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="Dutyvalue" value="{{($data != null)?$data->Dutyvalue_set:''}}" class="form-control form-control" placeholder="ป้อนค่าอากร" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ค่าการตลาด :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Marketvalue" value="{{($data != null)?$data->Marketvalue_set:''}}" class="form-control form-control" placeholder="ป้อนค่าการตลาด" required/>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-4 col-form-label text-right">แบบดอกเบี้ย :</label>
                                                <div class="col-sm-6">
                                                    <select id="" name="Interesttype" class="form-control form-control">
                                                    @if($data != null)
                                                        @if($data->Interesttype_set != null)
                                                            <option value="12" {{ ($data->Interesttype_set === '12') ? 'selected' : '' }}>ต่อเดือน</option>
                                                            <option value="1" {{ ($data->Interesttype_set === '1') ? 'selected' : '' }}>ต่อปี</option>
                                                        @else
                                                            <option value="" selected>--- เลือกแบบดอกเบี้ย ---</option>
                                                            <option value="12">ต่อเดือน</option>
                                                            <option value="1">ต่อปี</option>
                                                        @endif
                                                    @else
                                                            <option value="" selected>--- เลือกแบบดอกเบี้ย ---</option>
                                                            <option value="12">ต่อเดือน</option>
                                                            <option value="11">ต่อปี</option>
                                                    @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ค่าคอมหลังหัก :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="ComAgenttvalue" value="{{($data != null)?$data->Comagent_set:''}}" class="form-control form-control" placeholder="ป้อนค่าคอมหลังหัก" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ภาษี :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Taxvalue" value="{{($data != null)?$data->Taxvalue_set:''}}" class="form-control form-control" placeholder="ป้อนภาษี" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มผู้เช่าซื้อ :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabbuyer_set != null)
                                                            <input type="checkbox" name="TabBuyer" value="{{$data->Tabbuyer_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabBuyer" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabBuyer" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มผู้ค้ำ :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabsponser_set != null)
                                                            <input type="checkbox" name="TabSponser" value="{{$data->Tabsponser_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabSponser" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabSponser" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มรถยนต์ :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabcardetail_set != null)
                                                            <input type="checkbox" name="TabCardetail" value="{{$data->Tabcardetail_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabCardetail" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabCardetail" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มค่าใช้จ่าย :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabexpense_set != null)
                                                            <input type="checkbox" name="TabExpense" value="{{$data->Tabexpense_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabExpense" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabExpense" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ checker :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabchecker_set != null)
                                                            <input type="checkbox" name="TabChecker" value="{{$data->Tabchecker_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabChecker" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabChecker" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ ที่มารายได้ :</label>
                                                <div class="col-sm-4">
                                                    @if($data != null)
                                                        @if($data->Tabincome_set != null)
                                                            <input type="checkbox" name="TabIncome" value="{{$data->Tabincome_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabIncome" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabIncome" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="hidden" name="SetID" value="{{($data != null)?$data->Set_id:''}}"/>
                                    <input type="hidden" name="NameUser" value="{{auth::user()->name}}"/>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-success text-center"> <i class="fa fa-save"></i> บันทึก</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                          {{--ตั้งค่าเงินกู้--}}
                            <div class="tab-pane fade" id="custom-tabs-profile" role="tabpanel" aria-labelledby="custom-tabs-profile-tab">
                                <form name="form2" action="{{ route('MasterSetting.update',[0]) }}?type={{2}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="_method" value="PATCH"/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-4 col-form-label text-right">แบบดอกเบี้ย :</label>
                                                <div class="col-sm-6">
                                                    <select id="" name="Interesttype" class="form-control form-control">
                                                    @if($data2 != null)
                                                        @if($data2->Interesttype_set != null)
                                                            <option value="12" {{ ($data2->Interesttype_set === '12') ? 'selected' : '' }}>ต่อเดือน</option>
                                                            <option value="1" {{ ($data2->Interesttype_set === '1') ? 'selected' : '' }}>ต่อปี</option>
                                                        @else
                                                            <option value="" selected>--- เลือกแบบดอกเบี้ย ---</option>
                                                            <option value="12">ต่อเดือน</option>
                                                            <option value="1">ต่อปี</option>
                                                        @endif
                                                    @else
                                                            <option value="" selected>--- เลือกแบบดอกเบี้ย ---</option>
                                                            <option value="12">ต่อเดือน</option>
                                                            <option value="1">ต่อปี</option>
                                                    @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ค่าคอมหลังหัก :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="ComAgenttvalue" value="{{($data2 != null)?$data2->Comagent_set:''}}" class="form-control form-control" placeholder="ป้อนค่าคอมหลังหัก" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                            <label class="col-sm-4 col-form-label text-right">ภาษี :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Taxvalue" value="{{($data2 != null)?$data2->Taxvalue_set:''}}" class="form-control form-control" placeholder="ป้อนภาษี" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มผู้เช่าซื้อ :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabbuyer_set != null)
                                                            <input type="checkbox" name="TabBuyer" value="{{$data2->Tabbuyer_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabBuyer" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabBuyer" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มผู้ค้ำ :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabsponser_set != null)
                                                            <input type="checkbox" name="TabSponser" value="{{$data2->Tabsponser_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabSponser" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabSponser" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มรถยนต์ :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabcardetail_set != null)
                                                            <input type="checkbox" name="TabCardetail" value="{{$data2->Tabcardetail_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabCardetail" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabCardetail" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ แบบฟอร์มค่าใช้จ่าย :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabexpense_set != null)
                                                            <input type="checkbox" name="TabExpense" value="{{$data2->Tabexpense_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabExpense" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabExpense" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ checker :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabchecker_set != null)
                                                            <input type="checkbox" name="TabChecker" value="{{$data2->Tabchecker_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabChecker" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabChecker" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-8 col-form-label text-right">แท็บ ที่มารายได้ :</label>
                                                <div class="col-sm-4">
                                                    @if($data2 != null)
                                                        @if($data2->Tabincome_set != null)
                                                            <input type="checkbox" name="TabIncome" value="{{$data2->Tabincome_set}}" checked data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @else
                                                            <input type="checkbox" name="TabIncome" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                        @endif
                                                    @else
                                                        <input type="checkbox" name="TabIncome" value="on" data-toggle="toggle" data-on="เปิด" data-off="ปิด" data-onstyle="success" data-offstyle="danger" data-size="sm">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="hidden" name="SetID" value="{{($data2 != null)?$data2->Set_id:''}}"/>
                                    <input type="hidden" name="NameUser" value="{{auth::user()->name}}"/>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-success text-center"> <i class="fa fa-save"></i> บันทึก</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    @endif
    @if($type == 2)
        <form name="form1" action="#" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">โปรแกรมคำนวณค่างวด</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">ค่างวดเช่าซื้อ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">ค่างวดเงินกู้</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        {{--ค่างวดเช่าซื้อ--}}
                            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ประเภทรถ :</label>
                                            <div class="col-sm-6 mb-1">
                                            <select id="TypecarLS" name="TypecarLS" class="form-control form-control-sm">
                                                <option value="" selected style="color:red">--- ประเภทรถยนต์ ---</option>
                                                <option value="รถกระบะ">รถกระบะ</option>
                                                <option value="รถตอนเดียว">รถตอนเดียว</option>
                                                <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                                            </select>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ปีรถ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="YearcarLS" name="YearcarLS" class="form-control form-control" required/>
                                                {{--<select id="YearcarLS" name="YearcarLS" class="form-control form-control-sm" required>
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
                                                </select>--}}
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ระยะเวลา :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TimelackLS" name="TimelackLS" class="form-control form-control" required/>
                                                {{--<select id="TimelackLS" name="TimelackLS" class="form-control form-control-sm" required>
                                                    <option value="" selected>--- ระยะเวลาผ่อน ---</option>
                                                    <option value="12">12</option>
                                                    <option value="18">18</option>
                                                    <option value="24">24</option>
                                                    <option value="30">30</option>
                                                    <option value="36">36</option>
                                                    <option value="42">42</option>
                                                    <option value="48">48</option>
                                                    <option value="54">54</option>
                                                    <option value="60">60</option>
                                                    <option value="66">66</option>
                                                    <option value="72">72</option>
                                                    <option value="78">78</option>
                                                    <option value="84">84</option>
                                                </select>--}}
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ยอดจัด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TopcarLS" name="TopcarLS" class="form-control form-control" maxlength="7" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="background-color:#D0D4D7;">
                                    <div class="col-12">
                                        <br>
                                        <div class="form-group row mb-1 text-sm">
                                            <label class="col-sm-4 col-form-label text-right">ดอกเบี้ย/เดือน :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="InterestLS" name="InterestLS" class="form-control form-control" readonly/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ค่างวดละ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="DueLS" name="DueLS" class="form-control form-control" readonly/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ยอดชำระทั้งหมด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TotalpayLS" name="TotalpayLS" class="form-control form-control" readonly/>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                
                            </div>
                        {{--ค่างวดเงินกู้--}}
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">กรรมสิทธิ์ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <select id="OwnerLoan" name="OwnerLoan" class="form-control form-control-sm">
                                                    <option value="" selected style="color:red">--- กรรมสิทธิ์รถ ---</option>
                                                    <option value="ถือกรรมสิทธิ์">ถือกรรมสิทธิ์</option>
                                                    <option value="ไม่ถือกรรมสิทธิ์">ไม่ถือกรรมสิทธิ์</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ประเภทรถ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <select id="TypecarLoan" name="TypecarLoan" class="form-control form-control-sm">
                                                    <option value="" selected style="color:red">--- ประเภทรถยนต์ ---</option>
                                                    <option value="รถกระบะ">รถกระบะ</option>
                                                    <option value="รถตอนเดียว">รถตอนเดียว</option>
                                                    <option value="รถเก๋ง/7ที่นั่ง">รถเก๋ง/7ที่นั่ง</option>
                                                    <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ปีรถ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="YearcarLoan" name="YearcarLoan" class="form-control form-control" required/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ระยะเวลาจัด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TimelackLoan" name="TimelackLoan" maxlength="7" class="form-control form-control" required/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ยอดจัด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TopcarLoan" name="TopcarLoan" maxlength="7" class="form-control form-control" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="background-color:#D0D4D7;">
                                    <div class="col-12">
                                        <br>
                                        <div class="form-group row mb-1 text-sm">
                                            <label class="col-sm-4 col-form-label text-right">ดอกเบี้ย/เดือน :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="InrestLoan" name="InrestLoan" class="form-control form-control" readonly/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ค่างวดละ :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="DueLoan" name="DueLoan" class="form-control form-control" readonly/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ยอดชำระทั้งหมด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="TotalpayLoan" name="TotalpayLoan" class="form-control form-control" readonly/>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>
        </form>
    @endif
</section>

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

    $('#TypecarLS,#YearcarLS,#TimelackLS,#TopcarLS').on("input" ,function() {
        var GetType = document.getElementById('TypecarLS').value;
        var GetYear = document.getElementById('YearcarLS').value;
        var GetTimelack = document.getElementById('TimelackLS').value;
        var GetTopcar = document.getElementById('TopcarLS').value;
        var Topcar = GetTopcar.replace(",","");
        $("#TopcarLS").val(addCommas(Topcar));

        if(GetType != '' && GetYear != '' && GetTimelack != '' && Topcar != ''){
            if (GetType == "รถกระบะ" && GetYear >= 2015) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.47;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.50;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.54;
                } else if (GetTimelack >= 78 && GetTimelack <= 84) {
                var Interest = 0.60;
                }
            } else if (GetType == "รถกระบะ" && GetYear >= 2012 && GetYear <= 2014) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.79;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.80;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.81;
                }
            } else if (GetType == "รถกระบะ" && GetYear >= 2010 && GetYear <= 2011) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.90;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.91;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.92;
                }
            } else if (GetType == "รถกระบะ" && GetYear == 2009) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.04;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.05;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 1.06;
                }
            } else if (GetType == "รถกระบะ" && GetYear == 2008) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.20;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.21;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 1.22;
                }
            } else if (GetType == "รถกระบะ" && GetYear == 2007) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.21;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.22;
                }
            } else if (GetType == "รถกระบะ" && GetYear == 2006) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.22;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.23;
                }
            } else if (GetType == "รถกระบะ" && GetYear >= 2003 && GetYear <= 2005) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.56;
                }
            }

            if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear >= 2015) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.51;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.55;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.58;
                } else if (GetTimelack >= 78 && GetTimelack <= 84) {
                var Interest = 0.64;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear >= 2012 && GetYear <= 2014) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.80;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.81;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.82;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear >= 2010 && GetYear <= 2011) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 0.92;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 0.93;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 0.94;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear == 2009) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.05;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.06;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 1.07;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear == 2008) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.21;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.22;
                } else if (GetTimelack >= 66 && GetTimelack <= 72) {
                var Interest = 1.23;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear == 2007) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.22;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.23;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear == 2006) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.23;
                } else if (GetTimelack >= 54 && GetTimelack <= 60) {
                var Interest = 1.25;
                }
            } else if (GetType == "รถเก๋ง / รถ 7 ที่นั่ง" && GetYear == 2005) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.59;
                }
            }

            if (GetType == "รถตอนเดียว" && GetYear >= 2015) {
                if (GetTimelack >= 12 && GetTimelack <= 60) {
                var Interest = 0.90;
                }
            } else if (GetType == "รถตอนเดียว" && GetYear >= 2013 && GetYear <= 2014) {
                if (GetTimelack >= 12 && GetTimelack <= 60) {
                var Interest = 1.05;
                }
            } else if (GetType == "รถตอนเดียว" && GetYear >= 2010 && GetYear <= 2012) {
                if (GetTimelack >= 12 && GetTimelack <= 60) {
                var Interest = 1.20;
                }
            } else if (GetType == "รถตอนเดียว" && GetYear >= 2008 && GetYear <= 2009) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.40;
                }
            } else if (GetType == "รถตอนเดียว" && GetYear >= 2006 && GetYear <= 2007) {
                if (GetTimelack >= 12 && GetTimelack <= 48) {
                var Interest = 1.55;
                }
            } else if (GetType == "รถตอนเดียว" && GetYear >= 2004 && GetYear <= 2005) {
                if (GetTimelack >= 12 && GetTimelack <= 36) {
                var Interest = 1.70;
                }
            }
            var setInterest = Interest * 12;
            var Newinterest = (setInterest * (GetTimelack / 12)) + 100;
            var Resultperiod = Math.ceil(((((Topcar * Newinterest) / 100) * 1.07) / GetTimelack) /10) * 10;
            var Resulttotal = Resultperiod * GetTimelack;

            $("#InterestLS").val(Interest);
            $("#DueLS").val(addCommas(Resultperiod.toFixed(2)));
            $("#TotalpayLS").val(addCommas(Resulttotal.toFixed(2)));
         
        }



    });

    $('#OwnerLoan,#TypecarLoan,#YearcarLoan,#TimelackLoan,#TopcarLoan').on("input" ,function() {
        var GetOwn = document.getElementById('OwnerLoan').value;
        var GetTypeL = document.getElementById('TypecarLoan').value;
        var GetYearL = document.getElementById('YearcarLoan').value;
        var GetTimelackL = document.getElementById('TimelackLoan').value;
        var GetTopcarL = document.getElementById('TopcarLoan').value;
        var TopcarL = GetTopcarL.replace(",","");
        $("#TopcarLoan").val(addCommas(TopcarL));

        if(GetTypeL != '' && GetYearL != '' && GetTimelackL != '' && TopcarL != ''){

            if (GetOwn == 'ไม่ถือกรรมสิทธิ์') {
                var Extrainterest = '0.2';
            } else{
                var Extrainterest = '0.0';
            }
            

            if (GetTypeL == 'รถจักรยานยนต์') {
                var interest = 0.69;
            } else {
                if (TopcarL <= 100000) {
                    if (GetYearL >= 2003 && GetYearL <= 2009) {
                        if (GetTimelackL >= 12 && GetTimelackL <= 48) {
                        var interest = 0.86 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 54 && GetTimelackL <= 60) {
                        var interest = 0.96 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 66 && GetTimelackL <= 72) {
                        var interest = 0.99 + parseFloat(Extrainterest);
                        }
                    } else if (GetYearL >= 2010) {
                        if (GetTimelackL >= 12 && GetTimelackL <= 48) {
                        var interest = 0.78 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 54 && GetTimelackL <= 60) {
                        var interest = 0.86 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 66 && GetTimelackL <= 72) {
                        var interest = 0.96 + parseFloat(Extrainterest);
                        }
                    }
                } else if (TopcarL > 100000) {
                    if (GetYearL >= 2003 && GetYearL <= 2009) {
                        if (GetTimelackL >= 12 && GetTimelackL <= 48) {
                        var interest = 0.76 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 54 && GetTimelackL <= 60) {
                        var interest = 0.86 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 66 && GetTimelackL <= 72) {
                        var interest = 0.96 + parseFloat(Extrainterest);
                        }
                    } else if (GetYearL >= 2010) {
                        if (GetTimelackL >= 12 && GetTimelackL <= 48) {
                        var interest = 0.66 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 54 && GetTimelackL <= 60) {
                        var interest = 0.76 + parseFloat(Extrainterest);
                        } else if (GetTimelackL >= 66 && GetTimelackL <= 72) {
                        var interest = 0.86 + parseFloat(Extrainterest);
                        }
                    }
                }
            }

            var SetInterestL = ((interest/100)/1) * 12;
            var Process = (parseFloat(TopcarL) + (parseFloat(TopcarL) * parseFloat(SetInterestL) * (GetTimelackL / 12))) / GetTimelackL;      
            
            var str = Process.toString();
            var setstring = parseInt(str.split(".", 1));
            var Resultperiod = Math.ceil(setstring/10)*10;
            var Resulttotal = Resultperiod * GetTimelackL;
            
            $("#InrestLoan").val(interest);
            $("#DueLoan").val(addCommas(Resultperiod.toFixed(2)));
            $("#TotalpayLoan").val(addCommas(Resulttotal.toFixed(2)));

        }
    });
</script>
