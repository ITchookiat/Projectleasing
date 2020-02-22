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
            <h4 class="card-title p-3" align="center">ใบเสร็จชำระค่างวด</h4>
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

            @if($type == 9)
              <form name="form1" action="{{ route('legislation.report' ,[00, 1]) }}" method="get" id="formimage" enctype="multipart/form-data">
                @csrf

                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="form-inline" align="right">
                        <div class="row">
                          <div class="col-md-7">
                            <div class="row">
                                  <div class="" align="right">
                                    <label><font color="red">เลขที่สัญญา :</font></label>
                                    <input type="text" name="Contract" class="form-control" style="width: 200px;" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
                                  </div>
                                  <div class="" align="right">
                                    <label>เลขที่ใบเสร็จ :</label>
                                    <input type="text" name="NumberBill" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <br>
                                  <div class="" align="right">
                                    <label>จากวันที่ : </label>
                                    <input type="date" name="Fdate" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <div class="" align="right">
                                    <label>ถึงวันที่ : </label>
                                    <input type="date" name="Tdate" class="form-control" style="width: 200px;"/>
                                  </div>
                                  <br>
                              </div>
                            </div>

                          <div class="col-md-5">
                            <div class="form-inline" align="center">
                              <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
                                <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                              </button>
                              <a class="btn btn-app" href="{{ route('legislation',7) }}" style="background-color:#DB0000; color:#FFFFFF;">
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
            @endif

          </div>

    <script>
        $(function () {
            $('[data-mask]').inputmask()
        })
    </script>

    </section>
