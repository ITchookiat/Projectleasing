@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')


  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-6">
                    <div class="form-inline">
                      <h4 class="">
                        ลูกหนี้ฟ้อง (Debtor Sued)
                      </h4>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="container-fluid">
                      <div class="row mb-0">
                        <div class="col-sm-12">
                          <div class="card-tools d-inline float-right">
                            <button type="button" class="btn btn-outline-primary btn-Normal" data-toggle="dropdown">
                              <span class="fas fa-print"></span> ปริ้นรายงาน
                            </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('legislation.report',[0,20]) }}" class="dropdown-item"> รายงาน ติดตามลูกหนี้ฟ้อง</a></li>
                              </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body text-sm">
                <div class="row">
                  <div class="col-lg-6 col-6">
                    <div class="small-box bg-purple">
                      <div class="inner">
                        <h3>{{$data1}}</h3>
        
                        <p>ลูกหนี้ เตรียมฟ้อง</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-calendar-check"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{6}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-6 col-6">
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3>{{$data2}}</h3>
        
                        <p>ลูกหนี้ รอฟ้อง</p>
                      </div>
                      <div class="icon">
                        <i class="far fa-clock"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{21}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-4">
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3>{{$data3 - $data4 - $data5}}</h3>
        
                        <p>ลูกหนี้ ชั้นศาล</p>
                      </div>
                      <div class="icon p-0">
                        <i class="fas fa-balance-scale"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{22}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-4 col-4">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$data4}}</h3>
        
                        <p>ลูกหนี้ ชั้นบังคับคดี</p>
                      </div>
                      <div class="icon p-0">
                        <i class="fas fa-gavel"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{23}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-4 col-4">
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>{{$data5}}</h3>
        
                        <p>ลูกหนี้ โกงเจ้าหนี้</p>
                      </div>
                      <div class="icon p-0">
                        <i class="fas fa-people-arrows"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{24}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-6">
                    <div class="small-box bg-olive">
                      <div class="inner">
                        <h3>{{$data7}}</h3>
        
                        <p>ลูกหนี้ ปิดจบงาน</p>
                      </div>
                      <div class="icon p-0">
                        <i class="fas fa-user-check"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{25}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{$data6}}</h3>
        
                        <p>ลูกหนี้สืบทรัพย์ (Debtor investigate)</p>
                      </div>
                      <div class="icon p-0">
                        <i class="fas fa-map-marked-alt"></i>
                      </div>
                      <a href="{{ route('MasterLegis.index') }}?type={{8}}" class="small-box-footer">
                        เพิ่มเติม <i class="fas fa-arrow-circle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <a id="button"></a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
@endsection
