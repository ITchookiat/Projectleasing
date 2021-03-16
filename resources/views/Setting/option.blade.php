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
                                            <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ค่าอากร :</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="Dutyvalue" value="{{($data != null)?$data->Dutyvalue_set:''}}" class="form-control form-control" placeholder="ป้อนค่าอากร" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ค่าการตลาด :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Marketvalue" value="{{($data != null)?$data->Marketvalue_set:''}}" class="form-control form-control" placeholder="ป้อนค่าการตลาด" required/>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ค่าคอมหลังหัก :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="ComAgenttvalue" value="{{($data2 != null)?$data2->Comagent_set:''}}" class="form-control form-control" placeholder="ป้อนค่าคอมหลังหัก" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ภาษี :</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="Taxvalue" value="{{($data2 != null)?$data2->Taxvalue_set:''}}" class="form-control form-control" placeholder="ป้อนภาษี" required/>
                                            </div>
                                            <label class="col-sm-1 col-form-label text-left">%</label>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
                                            <div class="form-group row mb-1">
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
    @elseif($type == 2)
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
                                    <div class="col-7">
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">ยอดจัด :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="demotopcar" name="demotopcar" maxlength="7" class="form-control form-control" placeholder="ป้อนยอดจัด" required/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ดอกเบี้ย/เดือน :</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="demointerest" name="demointerest" class="form-control form-control" placeholder="ป้อนดอกเบี้ย" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img class="float-right" src="{{ asset('dist/img/leasing02.png') }}" width="150" height="80" style="border-radius:75px;"/>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-bordered table-valign-middle">
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><b>12</b></td>
                                            <td class="text-center" width="200px"><span id="Period12"></span></td>
                                            <td class="text-center" rowspan="7" width="5px"></td>
                                            <td class="text-center"><b>54</b></td>
                                            <td class="text-center" width="200px"><span id="Period54"></span></td>
                                        </tr>
                                    
                                        <tr>
                                            <td class="text-center"><b>18</b></td>
                                            <td class="text-center"><span id="Period18"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>60</b></td>
                                            <td class="text-center"><span id="Period60"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>24</b></td>
                                            <td class="text-center"><span id="Period24"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>66</b></td>
                                            <td class="text-center"><span id="Period66"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>30</b></td>
                                            <td class="text-center"><span id="Period30"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>72</b></td>
                                            <td class="text-center"><span id="Period72"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>36</b></td>
                                            <td class="text-center"><span id="Period36"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>78</b></td>
                                            <td class="text-center"><span id="Period78"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>42</b></td>
                                            <td class="text-center"><span id="Period42"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>84</b></td>
                                            <td class="text-center"><span id="Period84"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>48</b></td>
                                            <td class="text-center"><span id="Period48"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            {{--ค่างวดเงินกู้--}}
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-4 col-form-label text-right">เงินต้น :</label>
                                            <div class="col-sm-6 mb-1">
                                                <input type="text" id="demotopcarP" name="demotopcar" maxlength="7" class="form-control form-control" placeholder="ป้อนเงินต้น" required/>
                                            </div>
                                            <label class="col-sm-4 col-form-label text-right">ดอกเบี้ย/เดือน :</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="demointerestP" name="demointerest" class="form-control form-control" placeholder="ป้อนดอกเบี้ย" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img class="float-right" src="{{ asset('dist/img/leasing03.png') }}" width="150" height="80" style="border-radius:75px;"/>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-bordered table-valign-middle">
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><b>12</b></td>
                                            <td class="text-center" width="200px"><span id="Period12P"></span></td>
                                            <td class="text-center" rowspan="7" width="5px"></td>
                                            <td class="text-center"><b>54</b></td>
                                            <td class="text-center" width="200px"><span id="Period54P"></span></td>
                                        </tr>
                                    
                                        <tr>
                                            <td class="text-center"><b>18</b></td>
                                            <td class="text-center"><span id="Period18P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>60</b></td>
                                            <td class="text-center"><span id="Period60P"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>24</b></td>
                                            <td class="text-center"><span id="Period24P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>66</b></td>
                                            <td class="text-center"><span id="Period66P"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>30</b></td>
                                            <td class="text-center"><span id="Period30P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>72</b></td>
                                            <td class="text-center"><span id="Period72P"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>36</b></td>
                                            <td class="text-center"><span id="Period36P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>78</b></td>
                                            <td class="text-center"><span id="Period78P"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>42</b></td>
                                            <td class="text-center"><span id="Period42P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"><b>84</b></td>
                                            <td class="text-center"><span id="Period84P"></span></td>
                                        </tr>

                                        <tr>
                                            <td class="text-center"><b>48</b></td>
                                            <td class="text-center"><span id="Period48P"></span></td>
                                            <!-- <td class="text-center"></td> -->
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>

                                    </tbody>
                                </table>
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

    $('#demotopcar,#demointerest').on("input" ,function() {
        var Gettopcar = document.getElementById('demotopcar').value;
        var Topcar = Gettopcar.replace(",","");
        var Getinterest = document.getElementById('demointerest').value;
        $("#demotopcar").val(addCommas(Topcar));

        if(Topcar != '' && Getinterest != ''){
            var Getinterest12 = Getinterest * 12;
            var Interest12 = (Getinterest12 * 1) + 100;
            var Period12 = Math.ceil(((((Topcar * Interest12) / 100) * 1.07) / 12) /10) * 10;
            $("#Period12").text(addCommas(Period12));

            var Getinterest18 = Getinterest * 12;
            var Interest18 = (Getinterest18 * 1.5) + 100;
            var Period18 = Math.ceil(((((Topcar * Interest18) / 100) * 1.07) / 18) /10) * 10;
            $("#Period18").text(addCommas(Period18));

            var Getinterest24 = Getinterest * 12;
            var Interest24 = (Getinterest24 * 2) + 100;
            var Period24 = Math.ceil(((((Topcar * Interest24) / 100) * 1.07) / 24) /10) * 10;
            $("#Period24").text(addCommas(Period24));

            var Getinterest30 = Getinterest * 12;
            var Interest30 = (Getinterest30 * 2.5) + 100;
            var Period30 = Math.ceil(((((Topcar * Interest30) / 100) * 1.07) / 30) /10) * 10;
            $("#Period30").text(addCommas(Period30));

            var Getinterest36 = Getinterest * 12;
            var Interest36 = (Getinterest36 * 3) + 100;
            var Period36 = Math.ceil(((((Topcar * Interest36) / 100) * 1.07) / 36) /10) * 10;
            $("#Period36").text(addCommas(Period36));

            var Getinterest42 = Getinterest * 12;
            var Interest42 = (Getinterest42 * 3.5) + 100;
            var Period42 = Math.ceil(((((Topcar * Interest42) / 100) * 1.07) / 42) /10) * 10;
            $("#Period42").text(addCommas(Period42));

            var Getinterest48 = Getinterest * 12;
            var Interest48 = (Getinterest48 * 4) + 100;
            var Period48 = Math.ceil(((((Topcar * Interest48) / 100) * 1.07) / 48) /10) * 10;
            $("#Period48").text(addCommas(Period48));

            var Getinterest54 = Getinterest * 12;
            var Interest54 = (Getinterest54 * 4.5) + 100;
            var Period54 = Math.ceil(((((Topcar * Interest54) / 100) * 1.07) / 54) /10) * 10;
            $("#Period54").text(addCommas(Period54));

            var Getinterest60 = Getinterest * 12;
            var Interest60 = (Getinterest60 * 5) + 100;
            var Period60 = Math.ceil(((((Topcar * Interest60) / 100) * 1.07) / 60) /10) * 10;
            $("#Period60").text(addCommas(Period60));

            var Getinterest66 = Getinterest * 12;
            var Interest66 = (Getinterest66 * 5.5) + 100;
            var Period66 = Math.ceil(((((Topcar * Interest66) / 100) * 1.07) / 66) /10) * 10;
            $("#Period66").text(addCommas(Period66));

            var Getinterest72 = Getinterest * 12;
            var Interest72 = (Getinterest72 * 6) + 100;
            var Period72 = Math.ceil(((((Topcar * Interest72) / 100) * 1.07) / 72) /10) * 10;
            $("#Period72").text(addCommas(Period72));

            var Getinterest78 = Getinterest * 12;
            var Interest78 = (Getinterest78 * 6.5) + 100;
            var Period78 = Math.ceil(((((Topcar * Interest78) / 100) * 1.07) / 78) /10) * 10;
            $("#Period78").text(addCommas(Period78));

            var Getinterest84 = Getinterest * 12;
            var Interest84 = (Getinterest84 * 7) + 100;
            var Period84 = Math.ceil(((((Topcar * Interest84) / 100) * 1.07) / 84) /10) * 10;
            $("#Period84").text(addCommas(Period84));

        }


    });

    $('#demotopcarP,#demointerestP').on("input" ,function() {
        var GettopcarP = document.getElementById('demotopcarP').value;
        var TopcarP = GettopcarP.replace(",","");
        var GetinterestP = document.getElementById('demointerestP').value;
        $("#demotopcarP").val(addCommas(TopcarP));

        if(TopcarP != '' && GetinterestP != ''){
            var InterestP = ((GetinterestP / 100) / 1) * 12; //กรณีจะคำนวณดอกเบี้ยต่อเดือน
            // var InterestP = ((GetinterestP / 100) / 1); //กรณีจะคำนวณดอกเบี้ยต่อปี

            var Process12P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (12 / 12))) / 12;
            var str12 = Process12P.toString();
            var setstring12 = parseInt(str12.split(".", 1));
            var Period12P = Math.ceil(setstring12/10)*10;
            $("#Period12P").text(addCommas(Period12P));

            var Process18P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (18 / 12))) / 18;
            var str18 = Process18P.toString();
            var setstring18 = parseInt(str18.split(".", 1));
            var Period18P = Math.ceil(setstring18/10)*10;
            $("#Period18P").text(addCommas(Period18P));

            var Process24P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (24 / 12))) / 24;
            var str24 = Process24P.toString();
            var setstring24 = parseInt(str24.split(".", 1));
            var Period24P = Math.ceil(setstring24/10)*10;
            $("#Period24P").text(addCommas(Period24P));

            var Process30P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (30 / 12))) / 30;
            var str30 = Process30P.toString();
            var setstring30 = parseInt(str30.split(".", 1));
            var Period30P = Math.ceil(setstring30/10)*10;
            $("#Period30P").text(addCommas(Period30P));

            var Process36P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (36 / 12))) / 36;
            var str36 = Process36P.toString();
            var setstring36 = parseInt(str36.split(".", 1));
            var Period36P = Math.ceil(setstring36/10)*10;
            $("#Period36P").text(addCommas(Period36P));

            var Process42P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (42 / 12))) / 42;
            var str42 = Process42P.toString();
            var setstring42 = parseInt(str42.split(".", 1));
            var Period42P = Math.ceil(setstring42/10)*10;
            $("#Period42P").text(addCommas(Period42P));

            var Process48P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (48 / 12))) / 48;
            var str48 = Process48P.toString();
            var setstring48 = parseInt(str48.split(".", 1));
            var Period48P = Math.ceil(setstring48/10)*10;
            $("#Period48P").text(addCommas(Period48P));

            var Process54P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (54 / 12))) / 54;
            var str54 = Process54P.toString();
            var setstring54 = parseInt(str54.split(".", 1));
            var Period54P = Math.ceil(setstring54/10)*10;
            $("#Period54P").text(addCommas(Period54P));

            var Process60P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (60 / 12))) / 60;
            var str60 = Process60P.toString();
            var setstring60 = parseInt(str60.split(".", 1));
            var Period60P = Math.ceil(setstring60/10)*10;
            $("#Period60P").text(addCommas(Period60P));

            var Process66P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (66 / 12))) / 66;
            var str66 = Process66P.toString();
            var setstring66 = parseInt(str66.split(".", 1));
            var Period66P = Math.ceil(setstring66/10)*10;
            $("#Period66P").text(addCommas(Period66P));

            var Process72P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (72 / 12))) / 72;
            var str72 = Process72P.toString();
            var setstring72 = parseInt(str72.split(".", 1));
            var Period72P = Math.ceil(setstring72/10)*10;
            $("#Period72P").text(addCommas(Period72P));

            var Process78P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (78 / 12))) / 78;
            var str78 = Process78P.toString();
            var setstring78 = parseInt(str78.split(".", 1));
            var Period78P = Math.ceil(setstring78/10)*10;
            $("#Period78P").text(addCommas(Period78P));

            var Process84P = (parseFloat(TopcarP) + (parseFloat(TopcarP) * parseFloat(InterestP) * (84 / 12))) / 84;
            var str84 = Process84P.toString();
            var setstring84 = parseInt(str84.split(".", 1));
            var Period84P = Math.ceil(setstring84/10)*10;
            $("#Period84P").text(addCommas(Period84P));
        }
    });
</script>
