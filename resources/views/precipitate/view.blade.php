@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        เร่งรัดหนี้สิน
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-warning box-solid">
        <div class="box-header with-border">
          @if($type == 1)
            <h4 class="card-title" align="center"><b>ระบบข้อมูลติดตาม</b></h4>
          @elseif($type == 2)
            <h4 class="card-title" align="center"><b>รายงานแยกทีมติดตาม</b></h4>
          @elseif($type == 3)
            <h4 class="card-title" align="center"><b>ระบบแจ้งเตือนติดตาม</b></h4>
          @endif

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            @if($type == 1)
              <form method="get" action="{{ route('Precipitate', 1) }}">
                <div align="right" class="form-inline">
                  <a target="_blank" href="{{ action('PrecController@ReportPrecDue') }}" class="btn btn-primary btn-app">
                    <span class="glyphicon glyphicon-print"></span> ปริ้นรายการ
                  </a>
                  <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button >
                  <p></p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
              </form>
            @elseif($type == 2)
              <form method="get" action="{{ route('Precipitate', 2) }}">
                <div align="right" class="form-inline">
                  <a target="_blank" href="" class="btn btn-success btn-app">
                    <span class="fa fa-file-excel-o"></span> Excel
                  </a>
                  <a target="_blank" href="" class="btn btn-danger btn-app">
                    <span class="fa fa-file-pdf-o"></span> PDF
                  </a>
                  <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button >
                  <p></p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
                <div align="right" class="form-inline">
                  <label for="text" class="mr-sm-2">ทีมติดตาม : </label>
                  <select name="follower" class="form-control mb-2 mr-sm-2" id="text" style="width: 420px">
                    <option selected disabled value="">---เลือกทีมติดตาม---</option>
                      <!-- <option value="99" {{ ($follower == '99') ? 'selected' : '' }}>99</otion> -->
                      <option value="" {{ ($follower == '') ? 'selected' : '' }}>เลือกทั้งหมด</otion>
                      <option value="008" {{ ($follower == '008') ? 'selected' : '' }}> 008 - กะดะห์</otion>
                      <option value="99" {{ ($follower == '99') ? 'selected' : '' }}> 99 - ติดตามรวม</otion>
                      <option value="102" {{ ($follower == '102') ? 'selected' : '' }}>102 - นายอับดุลเล๊าะ กาซอ</otion>
                      <option value="104" {{ ($follower == '104') ? 'selected' : '' }}>104 - นายอนุวัฒน์ อับดุลรานี</otion>
                      <option value="105" {{ ($follower == '105') ? 'selected' : '' }}>105 - นายธีรวัฒน์ เจ๊ะกา</otion>
                      <option value="112" {{ ($follower == '112') ? 'selected' : '' }}>112 - นายราชัน เจ๊ะกา</otion>
                      <option value="113" {{ ($follower == '113') ? 'selected' : '' }}>113 - นายฟิฏตรี วิชา</otion>
                      <option value="114" {{ ($follower == '114') ? 'selected' : '' }}>114 - นายอานันท์ กาซอ</otion>
                  </select>
                </div>
              </form>
            @elseif($type == 3)
              <form method="get" action="{{ route('Precipitate', 3) }}">
                <div align="right" class="form-inline">
                  <a href="{{ action('PrecController@excel', $type) }}" class="btn btn-success btn-app">
                    <span class="fa fa-file-excel-o"></span> Excel
                  </a>
                  <button type="submit" class="btn btn-warning btn-app">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button >
                  <p></p>
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 180px;" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 180px;" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                </div>
              </form>
           @endif

            <div class="row">
              <div class="col-md-12">
                  <hr>
                  <div class="table-responsive">
                   <table class="table table-bordered" id="table">
                      <thead class="thead-dark bg-gray-light" >
                        <tr>
                          <th class="text-center">ลำดับ</th>
                          <th class="text-center">เลขที่สัญญา</th>
                          <th class="text-center">ชื่อ-สกุล</th>
                          @if($type == 3)
                          <th class="text-center">เบอร์โทร</th>
                          @endif
                          <th class="text-center">ชำระล่าสุด</th>
                          <th class="text-center">งวดละ</th>
                          <th class="text-center">ค้างชำระ</th>
                          <th class="text-center">งวดจริง</th>
                          <th class="text-center">คงเหลือ</th>
                          @if($type != 3)
                          <th class="text-center">เลขทะเบียน</th>
                          <th class="text-center">พนง</th>
                          <th class="text-center">สถานะ</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                              <td class="text-center"> {{$key+1}} </td>
                              <td class="text-center"> {{$row->CONTNO}}</td>
                              <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                              @if($type == 3)
                              <td class="text-left"> {{iconv('Tis-620','utf-8', $row->TELP)}} </td>
                              @endif
                              <td class="text-center">
                                @php
                                $LPAYD = date_create($row->LPAYD);
                                @endphp
                                {{ date_format($LPAYD, 'd-m-Y')}}
                              </td>
                              @if($type == 3)
                              <td class="text-center"> {{number_format($row->T_LUPAY, 2)}} </td>
                              @else
                              <td class="text-center"> {{number_format($row->DAMT, 2)}} </td>
                              @endif
                              <td class="text-center"> {{number_format($row->EXP_AMT, 2)}} </td>
                              <td class="text-center"> {{$row->HLDNO}} </td>
                              <td class="text-center"> {{number_format($row->BALANC - $row->SMPAY, 2 )}} </td>
                              @if($type != 3)
                              <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->REGNO)) }} </td>
                              <td class="text-center"> {{$row->BILLCOLL}} </td>
                              <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
                              @endif
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
           </div>

           @if($type == 1)
             <script type="text/javascript">
               $(document).ready(function() {
                 $('#table').DataTable( {
                   "order": [[ 1, "asc" ]]
                 } );
               } );
             </script>
           @elseif($type == 2 OR $type == 3)
             <script type="text/javascript">
               $(document).ready(function() {
                 $('#table').DataTable( {
                   "order": [[ 0, "asc" ]],
                   "pageLength": 50
                 } );
               } );
             </script>
           @endif

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>
        </div>

        <script>
        function blinker() {
        $('.prem').fadeOut(1500);
        $('.prem').fadeIn(1500);
        }
        setInterval(blinker, 1500);
        </script>

      </div>
    </section>

@endsection
