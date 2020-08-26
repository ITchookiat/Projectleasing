@extends('layouts.master')
@section('title','แผนกการเงิน')
@section('content')

  @php
    function DateThai($strDate){
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));
      $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
      $strMonthThai=$strMonthCut[$strMonth];
      return "$strDay $strMonthThai $strYear";
      //return "$strDay-$strMonthThai-$strYear";
    }
  @endphp

  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $m = date('m');
    $d = date('d');
    $time = date('H:i');
    $date2 = $Y.'-'.$m.'-'.$d;
  @endphp

  <style>
    span:hover {
      color: blue;
    }
    .round {
        width: 0.9em;
        height: 0.9em;
        background-color: white;
        border-radius: 50%;
        /* vertical-align: middle; */
        border: 1px solid #000;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
    }
    .round:checked {
        background-color: green;
    }
    .new_register{
      display: none;
    }
  </style>

  <script>
      $(function () {
          var $chk = $("#grpChkBox input:checkbox"); 
          var $tbl = $("#table1");
          var $tblhead = $("#table1 th");

          // $chk.prop('checked', false); 

          $chk.click(function () {
              var colToHide = $tblhead.filter("." + $(this).attr("name"));
              var index = $(colToHide).index();
              $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
          });
      });
  </script>

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-8">
                    <div class="form-inline">
                      <h4>
                        @if($type == 1)
                         รายการทะเบียนรถ (Registration Car)
                        @endif
                      </h4>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card-tools d-inline float-right">
                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ทะเบียน")
                        <!-- <a class="btn bg-success btn-sm" data-toggle="modal" data-target="#modal-newcar" data-backdrop="static" data-keyboard="false" style="border-radius: 40px;">
                          <span class="fas fa-plus"></span> เพิ่มใหม่
                        </a> -->
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="col-md-12">
                  <form method="get" action="{{ route('Register',1) }}">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control" />

                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control" />

                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>

                          <button type="button" class="btn bg-primary btn-app">
                            <span class="fas fa-print"></span> Print
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <hr>
                  
                @if($type == 1)
                  @if($countData != 0)
                    <div class="float-right form-inline" id="grpChkBox">
                      <p><input type="checkbox" name="no" class="round" checked/> ลำดับ</p>&nbsp;&nbsp;
                      <p><input type="checkbox" name="date" class="round"/> วันที่</p>&nbsp;&nbsp;
                      <!-- <p><input type="checkbox" name="register" class="round"/> ป้ายทะเบียน</p>&nbsp;&nbsp; -->
                      <!-- <p><input type="checkbox" name="name" class="round"/> ยี่ห้อรถ</p>&nbsp;&nbsp; -->
                      <p><input type="checkbox" name="new_register" class="round"/> ป้ายใหม่</p>&nbsp;&nbsp;
                      <!-- <p><input type="checkbox" name="note" class="round"/> หมายเหตุ</p>&nbsp;&nbsp;&nbsp; -->
                      <p><input type="checkbox" name="act" class="round" checked/> ตัวเลือก</p>&nbsp;&nbsp;&nbsp;
                    </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-striped table-valign-middle table-bordered" id="table1">
                      <thead>
                        <tr>
                          <th class="text-center no">ลำดับ</th>
                          <th class="text-center date">วันที่รับลูกค้า</th>
                          <th class="text-center register">ป้ายทะเบียน</th>
                          <th class="text-center name">ชื่อ-สกุล</th>
                          <th class="text-center new_register">ป้ายใหม่</th>
                          <th class="text-center note">หมายเหตุ</th>
                          <th class="text-center act">ตัวเลือก</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                          <tr>
                            <td class="text-center no">{{$key+1}}</td>
                            <td class="text-center date">{{DateThai($row->Date_Appcar)}}</td>
                            <td class="text-center register">{{$row->License_car}}</td>
                            <td class="text-left name">{{$row->Name_buyer}}&nbsp;&nbsp;&nbsp;{{$row->last_buyer}}</td>
                            <td class="text-center new_register">{{($row->Nowlicense_car != '')?$row->Nowlicense_car:'-'}}</td>
                            <td class="text-left note"></td>
                            <td class="text-center act">
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-view" title="ดูรายการ"
                                data-backdrop="static" data-keyboard="false"
                                data-link="{{ route('MasterRegister.edit',[$row->id]) }}?type={{1}}">
                                <i class="far fa-eye"></i>
                              </button>
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit" title="แก้ไขรายการ"
                                data-backdrop="static" data-keyboard="false"
                                data-link="{{ route('MasterRegister.edit',[$row->id]) }}?type={{2}}">
                                <i class="far fa-edit"></i>
                              </button>
                              <form method="post" class="delete_form" action="" style="display:inline;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" data-name="" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                  <i class="far fa-trash-alt"></i>
                                </button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @endif
                </div>
                <a id="button"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>

  <script>
    $(function () {
      $("#table1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": true,
        "order": [[ 0, "asc" ]],
      });
    });
  </script>

  <script>
    $(function () {
      $("#modal-view").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-view .modal-content").load(link, function(){
        });
      });

      $("#modal-edit").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-edit .modal-content").load(link, function(){
        });
      });

    });
  </script>

  <!-- Pop up ดูรายละเอียด -->
  <div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>

  <!-- Pop up แก้ไข -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="border-radius: 30px 30px 30px 30px;">
        
      </div>
    </div>
  </div>


@endsection
