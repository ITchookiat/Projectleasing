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
                <div class="panel bg-yellow">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <a href="#" data-toggle="modal" data-target="#modal-legislation" class="a6"><i class="fa fa-gavel fa-5x"></i></a>
                      </div>
                      <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div><font size="5">แผนกกฏหมาย</font></div>
                      </div>
                    </div>
                  </div>
                  <a href="#" data-toggle="modal" data-target="#modal-legislation">
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
          @if(auth::user()->branch != 10 and auth::user()->branch != 11 and auth::user()->type != 4)
            <!-- ถ้าไม่ใช้สิทธิ กฏหมาย -->
            @if(auth::user()->type != 21)
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                  <span class="info-box-icon bg-red">
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

          <!-- Admin -->
            @if(auth::user()->type == 1 or auth::user()->type == 2)
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon bg-yellow">
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
          <!-- User standard -->
          @else
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
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
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 21)
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon bg-yellow">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',2) }}" class="a1"><i class="fa fa-bank"></i></a>
                  </span>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text"><br /></span>
                  <span class="info-box-number">งานฟ้อง</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                    <span class="progress-description">
                      จำนวนที่ส่งฟ้อง {{ $datalegis }} ราย
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
