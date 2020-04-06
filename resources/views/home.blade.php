@extends('layouts.master')
@section('title','Home')
@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 table-responsive">
        <div class="card">
          <div class="card-header">
          </div>

          <div class="card-body">
            <br><br><br>
            <div align="center">
              <img class="img-responsive" src="{{ asset('dist/img/leasing02.png') }}" alt="User Image" style = "width: 40%">
            </div>
            <br>

            <div class="row">
              <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h2>แผนกสินเชื่อ</h2>
                    <br><br>
                  </div>
                  <div class="icon">
                  <a href="#" data-toggle="modal" data-target="#modal-default" class="a1"><i class="fa fa-sitemap"></i></a>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal-default" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h2>แผนกเร่งรัด</h2>
                    <br><br>
                  </div>
                  <div class="icon">
                  <a href="#" data-toggle="modal" data-target="#modal-precipitate" class="a1"><i class="fa fa-handshake-o"></i></a>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal-precipitate" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-red">
                  <div class="inner">
                    <h2>แผนกกฏหมาย</h2>
                    <br><br>
                  </div>
                  <div class="icon">
                  <a href="#" data-toggle="modal" data-target="#modal-legislation" class="a1"><i class="fa fa-gavel"></i></a>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal-legislation" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>

            </div>
{{--
            @if(session('type') == 2)
              <br>
              <br>
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
            @endif
--}}
          </div>
        </div>
      </div>
    </div>

</div>

<div class="modal fade" id="modal-default" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #E6E6FA;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">ปิด</span></button>
        <p align="center" class="modal-title"><font size="5">แผนกสินเชื่อ</font></p>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 3 or auth::user()->type == 4)

              @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->branch == 01 or auth::user()->branch == 03 or auth::user()->branch == 04 or auth::user()->branch == 05 or auth::user()->branch == 06 or auth::user()->branch == 07)
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box bg-blue">
                    <span class="info-box-icon bg-blue">
                      <span class="info-box-icon">
                        <a href="{{ route('Analysis',1) }}" class="a1"><i class="fa fa-fax"></i></a>
                      </span>
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-text"><br /></span>
                      <span class="info-box-number">สินเชื่อ</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                        <span class="progress-description">
                          จำนวนรถที่อนุมัติ {{ $datafinance }} คัน
                        </span>
                    </div>
                  </div>
                </div>
              @endif

              @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4 or auth::user()->branch == 10 or auth::user()->branch == 11)
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box bg-blue">
                      <span class="info-box-icon bg-blue">
                        <span class="info-box-icon">
                          <a href="{{ route('Analysis',4) }}" class="a1"><i class="fa fa-automobile"></i></a>
                        </span>
                      </span>
                      <div class="info-box-content">
                        <span class="info-box-text"><br /></span>
                        <span class="info-box-number">รถบ้าน</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                          <span class="progress-description">
                            จำนวนรถที่อนุมัติ {{ $datahomecar }} คัน
                          </span>
                      </div>
                    </div>
                  </div>
              @endif
          @endif

          <!-- <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-green">
                <a href="{{ route('call',1) }}" class="a1"><i class="fa fa-phone"></i></a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text"><br /></span>
                <span class="info-box-number">งานโทร</span>
              </div>
            </div>
          </div> -->

          <!-- <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                <a href="{{ route('finance',1) }}" class="a1"><i class="fa fa-money"></i></a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text"><br /></span>
                <span class="info-box-number">ประเภทจัดไฟแนนซ์</span>
              </div>
            </div>
          </div> -->

        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-precipitate" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #E6E6FA;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">ปิด</span></button>
          <p align="center" class="modal-title"><font size="5">แผนกเร่งรัด</font></p>
        </div>
        <div class="modal-body">
          <div class="row">
            @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 31)
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
                  <span class="info-box-icon">
                    <a href="{{ route('Precipitate',3) }}" class="a1"><i class="fa fa-volume-control-phone"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">แจ้งเตือนติดตาม</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    จำนวนแจ้งเตือน {{ $datamassage }} ราย
                  </span>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
                  <span class="info-box-icon">
                    <a href="{{ route('Precipitate',1) }}" class="a1"><i class="fa fa-user-circle-o"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ปล่อยงานตาม</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    จำนวนงานตาม {{ $datafollow }} ราย
                  </span>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
                  <span class="info-box-icon">
                    <a href="{{ route('Precipitate',4) }}" class="a1"><i class="fa fa-user-times"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ปล่อยงานโนติส</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    จำนวนงานโนติส {{ $datanotice }} ราย
                  </span>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
                  <span class="info-box-icon">
                    <a href="{{ route('Precipitate',5) }}" class="a1"><i class="fa fa-car"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">Stock รถเร่งรัด</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    จำนวนรถในระบบ {{ $datastock }} คัน
                  </span>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-legislation" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #E6E6FA;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">ปิด</span></button>
        <p align="center" class="modal-title"><font size="5">แผนกกฏหมาย</font></p>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 21 or auth::user()->type == 31)
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon bg-red">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',6) }}" class="a1"><i class="fa fa-address-book-o"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ลูกหนี้เตรียมฟ้อง</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description">
                      จำนวนลูกหนี้เตรียมฟ้อง {{ $legisCourt }} ราย
                    </span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon bg-red">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',2) }}" class="a1"><i class="fa fa-bank"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ลูกหนี้ฟ้อง</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description">
                      จำนวนลูกหนี้ฟ้อง {{ $legisCourt2 }} ราย
                    </span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon bg-red">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',8) }}" class="a1"><i class="fa fa-map"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ลูกหนี้สืบทรัพย์</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description">
                      จำนวนลูกหนี้สืบทรัพย์ {{ $LegisAsset }} ราย
                    </span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon bg-red">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',7) }}" class="a1"><i class="fa fa-balance-scale"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">ลูกหนี้ประนอมหนี้</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description">
                      จำนวนลูกหนี้ประนอมหนี้ {{ $LegisCompro }} ราย
                    </span>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
