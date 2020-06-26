@extends('layouts.master')
@section('title','Home')
@section('content')

<style>
  i:hover {
    color: blue;
  }
</style>

<div class="content-header">
  <div class="row justify-content-center">
    <div class="col-md-12 table-responsive">
      <div class="card">
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <div align="center">
              <img class="img-responsive" src="{{ asset('dist/img/leasing02.png') }}" alt="User Image" style = "width: 40%">
          </div>
          <br><br>

          <div class="row">
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h2>แผนกสินเชื่อ</h2>
                  <br><br>
                </div>
                @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 3 or auth::user()->type == 4 or auth::user()->type == 31 or auth::user()->branch == 41)
                <div class="icon">
                  <i class="a1 fa fa-sitemap" data-toggle="modal" data-target="#modal-default" style="cursor: pointer;"></i>
                </div>
                @endif
                <a href="#" data-toggle="modal" data-target="#modal-default" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h2>แผนกเร่งรัด</h2>
                  <br><br>
                </div>
                @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 31 or auth::user()->branch == 41)
                <div class="icon">
                  <i class="a1 far fa-handshake" data-toggle="modal" data-target="#modal-precipitate" style="cursor: pointer;"></i>
                </div>
                @endif
                <a href="#" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h2>แผนกกฏหมาย</h2>
                  <br><br>
                </div>
                @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 31 or auth::user()->branch == 42)
                <div class="icon">
                  <i class="a1 fas fa-gavel" data-toggle="modal" data-target="#modal-legislation" style="cursor: pointer;"></i>
                </div>
                @endif
                <a href="#" data-toggle="modal" data-target="#modal-legislation" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <div class="col text-center">
          <h4 class="modal-title">แผนกสินเชื่อ</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 3 or auth::user()->type == 4 or auth::user()->type == 31 or auth::user()->branch == 41)
            @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->branch == 01 or auth::user()->branch == 03 or auth::user()->branch == 04 or auth::user()->branch == 05 or auth::user()->branch == 06 or auth::user()->branch == 07 or auth::user()->type == 31 or auth::user()->branch == 41)
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                  <span class="info-box-icon bg-blue">
                    <span class="info-box-icon">
                      <a href="{{ route('Analysis',1) }}" class="a1"><i class="fas fa-id-card fa-2x"></i></a>
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
                      <a href="{{ route('Analysis',4) }}" class="a1"><i class="fas fa-car fa-2x"></i></a>
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
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-precipitate" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <div class="col text-center">
          <h4 class="modal-title">แผนกเร่งรัด</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 31)
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon bg-yellow">
                <span class="info-box-icon">
                  <a href="{{ route('Precipitate',3) }}" class="a1"><i class="fas fa-sms fa-2x"></i></a>
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
                  <a href="{{ route('Precipitate',1) }}" class="a1"><i class="fas fa-users fa-2x"></i></a>
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
                  <a href="{{ route('Precipitate',4) }}" class="a1"><i class="fas fa-user-lock fa-2x"></i></a>
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
                  <a href="{{ route('Precipitate',5) }}" class="a1"><i class="fas fa-box-open fa-2x"></i></a>
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
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-legislation" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <div class="col text-center">
          <h4 class="modal-title">แผนกกฏหมาย</h4>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 21 or auth::user()->type == 31 or auth::user()->branch == 42)
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon bg-red">
                  <span class="info-box-icon">
                    <a href="{{ route('legislation',6) }}" class="a1"><i class="far fa-address-book fa-2x"></i></a>
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
                    <a href="{{ route('legislation',2) }}" class="a1"><i class="fa fa-balance-scale fa-2x"></i></a>
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
                    <a href="{{ route('legislation',8) }}" class="a1"><i class="fas fa-search-location fa-2x"></i></a>
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
                    <a href="{{ route('legislation',7) }}" class="a1"><i class="fas fa-hand-holding-usd fa-2x"></i></a>
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
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>

@endsection
