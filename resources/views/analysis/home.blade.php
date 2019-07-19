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
                                    <a href="#" class="a1"><i class="fa fa-sitemap fa-5x"></i></a>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"><font size="6"></font></div>
                                    <div>แผนกวิเคราะห์</div>
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

                      <div class="col-lg-6 col-md-6">
                          <div class="panel bg-red">
                              <div class="panel-heading">
                                <div class="row">
                                  <div class="col-xs-3">
                                    <a href="#" class="a6"><i class="fa fa-gavel fa-5x"></i></a>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"><font size="6"></font></div>
                                    <div>แผนกกฏหมาย</div>
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
@endsection
