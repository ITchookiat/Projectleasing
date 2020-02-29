@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">


      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-warning box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">เพิ่มข้อมูลชำระ</h4>
            <div class="box-tools pull-right">
              <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button> -->
            </div>
          </div>

          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <form name="form2" action="{{ route('legislation.store',[$id, $type]) }}" method="post" id="formimage" enctype="multipart/form-data">
              @csrf

              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="form-inline" align="right">

                      <script>
                          function adds(nStr){
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
                          function sperate(){
                            var num11 = document.getElementById('GoldPayment').value;
                            var num1 = num11.replace(",","");
                            console.log(num1);
                            document.form2.GoldPayment.value = adds(num1);
                          }
                      </script>

                      <div class="row">
                         <div class="col-md-8">
                           <div class="row">
                                <div class="" align="right">
                                   <label>วันที่ : </label>
                                   <input type="date" name="DatePayment" class="form-control" value="{{ date('Y-m-d') }}" style="width: 200px;"/>
                                </div>
                                <br>
                                <div class="" align="right">
                                   <label>ยอดชำระ :</label>
                                   <input type="text" name="GoldPayment" id="GoldPayment" class="form-control" value="" style="width: 200px;"  oninput="sperate();" maxlength="7"/>
                                 </div>
                                <br>
                                <div class="" align="right">
                                  <label>ประเภทชำระ : </label>
                                  <select name="TypePayment" class="form-control" style="width: 200px;" required>
                                  <option value="" selected>--- ประเภทชำระ ---</option>
                                  <option value="ชำระเงินสด">ชำระเงินสด</option>
                                  <option value="ชำระผ่านโอน">ชำระผ่านโอน</option>
                                  <option value="เงินก้อนแรก">เงินก้อนแรก</option>
                                  </select>
                                </div>
                                <br>
                                <div class="" align="right">
                                   <label>หมายเหตุ :</label>
                                   <input type="text" name="NotePayment" class="form-control" value="" style="width: 200px;"/>
                                   <input type="hidden" name="AdduserPayment" class="form-control" style="width: 200px;" value="{{ Auth::user()->name }}"/>
                                   <input type="hidden" name="FlagPayment" class="form-control" value="Y"/>
                                </div>

                            </div>
                          </div>

                         <div class="col-md-4">
                           <div class="form-inline" align="center">
                            <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                            </button>
                              <p></p>
                            <a class="btn btn-app" href="{{ action('LegislationController@edit',[$id, 4]) }}" style="background-color:#DB0000; color:#FFFFFF;">
                              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>

              </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </form>

          </div>


    </section>
