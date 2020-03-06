@extends('layouts.master')
@section('title','Home')
@section('content')

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 table-responsive">
            <div class="card">
                <div class="card-header">
                  <!-- <b><h3>Dashboard</h3></b> -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>
                    <br>
                    <!-- <a href="{{ route('datacar.create',1) }}" class="btn btn-success btn-app">
                    <span class="glyphicon glyphicon-plus"></span> เพิ่มข้อมูล
                    </a> -->
                    <div align="center">
                      <img class="img-responsive" src="{{ asset('dist/img/homecar.png') }}" alt="User Image" style = "width: 35%">
                    </div>
                    <div class="row">
                    <div class="col-lg-1 col-md-6"></div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                      <a href="{{ route('datacar',1) }}" class="a1"><i class="fa fa-car fa-5x"></i></a>

                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6"> {{$data1-$data6}} </font></div>
                                        <div>รถยนต์ทั้งหมด</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',1) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel bg-purple">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                      <a href="{{ route('datacar',2) }}" class="a2"><i class="fa fa-paint-brush fa-5x"></i></a>

                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6"> {{$data2}} </font></div>
                                        <div>รถยนต์ระหว่างทำสี</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',2) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel bg-navy">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <a href="{{ route('datacar',3) }}" class="a3"><i class="fa fa-exclamation-circle fa-5x"></i></a>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6">{{$data3}}</font></div>
                                        <div>รถยนต์รอซ่อม</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',3) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-6"></div>

                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel bg-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <a href="{{ route('datacar',4) }}" class="a4"><i class="fa fa-wrench fa-5x"></i></a>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6">{{$data4}}</font></div>
                                        <div>รถยนต์ระหว่างซ่อม</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',4) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel bg-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <a href="{{ route('datacar',5) }}" class="a5"><i class="fa fa-btc fa-5x"></i></a>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6">{{$data5}}</font></div>
                                        <div>รถยนต์พร้อมขาย</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',5) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel bg-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <a href="{{ route('datacar',6) }}" class="a6"><i class="fa fa-gavel fa-5x"></i></a>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><font size="6">{{$data6}}</font></div>
                                        <div>รถยนต์ที่ขายแล้ว</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('datacar',6) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">ดูเพิ่มเติม</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                  </div>


                </div>
            </div>
        </div>
    </div>


</div>
@endsection
