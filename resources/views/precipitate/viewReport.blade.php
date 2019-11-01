@extends('layouts.master')
@section('title','แผนกเร่งรัดหนี้สิน')
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

      <div class="box box-warning box-solid" style="Background-color:#F5F5DC;">
        <div class="box-body">
          <form method="get" action="{{ route('Precipitate', 7) }}">
            <div align="right" class="form-inline">
                <a href="{{ action('PrecController@excel') }}?Fromdate={{$fdate}}&Todate={{$tdate}}&type={{1}}" class="btn btn-success btn-app">
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
          <hr />
          <div class="row">
            <div class="col-md-6">
              <div class="box box-widget widget-user">
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>

                <div class="widget-user-header bg-yellow">
                  <div class="widget-user-image">
                    <p><i class="fa fa-user-circle-o fa-5x"></i></p>
                  </div>
                  <h3 class="widget-user-username">ปล่อยงานตาม</h3>
                  <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-12 border-center">
                      <div class="table-responsive">
                       <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">พนง</th>
                              <th class="text-center">สถานะ</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dataFollow as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-center"> {{$row->CONTNO}}</td>
                                <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                                <td class="text-center"> {{$row->BILLCOLL}} </td>
                                <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-widget widget-user">
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>

                <div class="widget-user-header bg-red">
                  <div class="widget-user-image">
                    <p class=""><i class="fa fa-user-times fa-5x"></i></p>
                  </div>
                  <h3 class="widget-user-username">ปล่อยงานโนติส</h3>
                  <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>

                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-12 border-center">
                      <div class="table-responsive">
                       <table class="table table-bordered" id="table">
                          <thead class="thead-dark bg-gray-light" >
                            <tr>
                              <th class="text-center">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">พนง</th>
                              <th class="text-center">สถานะ</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($dataNotice as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}} </td>
                                <td class="text-center"> {{$row->CONTNO}}</td>
                                <td class="text-left"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->SNAM.$row->NAME1)."   ".str_replace(" ","",$row->NAME2))}} </td>
                                <td class="text-center"> {{$row->BILLCOLL}} </td>
                                <td class="text-center"> {{iconv('Tis-620','utf-8',str_replace(" ","",$row->CONTSTAT)) }} </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

@endsection
