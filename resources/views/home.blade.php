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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br>

                  <div class="row">
                      <div class="col-lg-6 col-md-6">
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-3">
                                    <a href="#" data-toggle="modal" data-target="#modal-default" class="a1"><i class="fa fa-sitemap fa-5x"></i></a>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div><font size="5">แผนกสินเชื่อ</font></div>
                                  </div>
                                </div>
                              </div>
                              <a href="#" data-toggle="modal" data-target="#modal-default">
                                <div class="panel-footer">
                                  <span class="pull-left">ดูเพิ่มเติม</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                                </div>
                              </a>
                          </div>
                      </div>

                      <div class="col-lg-6 col-md-6">
                          <div class="panel bg-red">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-3">
                                    <a href="#" class="a6"><i class="fa fa-gavel fa-5x"></i></a>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div><font size="5">แผนกกฏหมาย</font></div>
                                  </div>
                                </div>
                              </div>
                              <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">ดูเพิ่มเติม</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                                </div>
                              </a>
                          </div>
                      </div>
                    </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="panel bg-purple">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3">
                                <a href="#" class="a2"><i class="fa fa-paint-brush fa-5x"></i></a>
                              </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge"><font size="6"></font></div>
                                <div>รถยนต์ระหว่างทำสี</div>
                              </div>
                            </div>
                          </div>
                          <a href="#">
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
                                <a href="#" class="a3"><i class="fa fa-exclamation-circle fa-5x"></i></a>
                              </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge"><font size="6"></font></div>
                                <div>รถยนต์รอซ่อม</div>
                              </div>
                            </div>
                          </div>
                          <a href="#">
                            <div class="panel-footer">
                              <span class="pull-left">ดูเพิ่มเติม</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                            </div>
                          </a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="panel bg-yellow">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3">
                                <a href="#" class="a4"><i class="fa fa-wrench fa-5x"></i></a>
                              </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge"><font size="6"></font></div>
                                <div>รถยนต์ระหว่างซ่อม</div>
                              </div>
                            </div>
                          </div>
                          <a href="#">
                            <div class="panel-footer">
                              <span class="pull-left">ดูเพิ่มเติม</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                            </div>
                          </a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="panel bg-green">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3">
                                <a href="#" class="a5"><i class="fa fa-btc fa-5x"></i></a>
                              </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge"><font size="6"></font></div>
                                <div>รถยนต์พร้อมขาย</div>
                              </div>
                            </div>
                          </div>
                          <a href="#">
                            <div class="panel-footer">
                              <span class="pull-left">ดูเพิ่มเติม</span>
                              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                              <div class="clearfix"></div>
                            </div>
                          </a>
                      </div>
                    </div>
                  </div> -->

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
          <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-red">
                <a href="{{ route('Analysis',1) }}" class="a1"><i class="fa fa-fax"></i></a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text"><br /></span>
                <span class="info-box-number">งานสินเชื่อ</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-green">
                <a href="{{ route('call',1) }}" class="a1"><i class="fa fa-phone"></i></a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text"><br /></span>
                <span class="info-box-number">งานโทร</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                <a href="{{ route('finance',1) }}" class="a1"><i class="fa fa-money"></i></a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text"><br /></span>
                <span class="info-box-number">ประเภทจัดไฟแนนซ์</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
