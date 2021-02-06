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
                      <h5 class="">
                        ลูกหนี้ฟ้อง (Debtor Sued)
                      </h5>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="container-fluid">
                      <div class="row mb-0">
                        <div class="col-sm-12">
                          <div class="card-tools d-inline float-right">
                            <div class="input-group">
                              <input type="text" name="contract" id="contract" class="form-control form-control-sm" placeholder="ค้นหา" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="">
                              <button type="button" class="popup btn btn-outline-success btn-sm mr-sm-2">
                                <i class="fas fa-search"></i>
                              </button>
                              <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown">
                                <span class="fas fa-print pr-1"></span> ปริ้น
                              </button>
                            </div>

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

    <div class="modal fade" id="modal-events">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body" id="modal-body-event">
            <div id="ShowEvents"></div>
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
    $(".popup").click(function(ev){
        var Contno = $('#contract').val();
        var _token = $('input[name="_token"]').val();
  
      if (Contno != '') {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url:"{{ route('legislation.SearchData', 2) }}",
          method:"POST",
          data:{Contno:Contno,_token:_token},
  
          success:function(result){ //เสร็จแล้วทำอะไรต่อ
            console.log(result);
            $('#modal-events').modal('show');
            $('#ShowEvents').html(result);
          }
        })
        
      }
    });
  </script>

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
