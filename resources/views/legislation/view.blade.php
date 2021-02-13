@extends('layouts.master')
@section('title','แผนกกฏหมาย')
@section('content')

  <style>
    .main {
        width: 50%;
        margin: 50px auto;
    }

    /* Bootstrap 4 text input with search icon */

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }
  </style>

  <style>
    .card-content{
        padding: 1px 20px 20px;
        text-align: left;
        box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.3); 
    }

    .card-icon img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
        height: 100%;
        padding: 20px;
    }
    .card-icon {
        width: 100%;
        height: 100%;
        background-color: #f7c881;
    }

    .card-icon:hover {
        background-color: #54a7f0;
    }

    .card-content h4 {
        font-size: 16px;
        color: #333;
        font-weight: 600;
        line-height: 0.9;
        font-family: 'Open Sans', sans-serif;
        padding-top: 7px;
    }
  </style>

  <br>
  <div class="container">
    <div class="row mb-2">
      <div class="col-6">
        <div class="form-inline">
          <h5 class="">
            ลูกหนี้ฟ้อง (Debtor Sued)
          </h5>
        </div>
      </div>
      <div class="col-6">
        <div class="card-tools d-inline float-right">
          <div class="input-group">
            <input type="text" name="ID" id="ID" class="form-control" placeholder="ค้นหา" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="">
            <div class="input-group-append">
              <button class="btn btn-success mr-sm-1" id="button-id" type="button">
                <i class="fa fa-search"></i>
              </button>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown">
              <span class="fas fa-print pr-1"></span> ปริ้น
            </button>
            
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('legislation.report',[0,20]) }}" class="dropdown-item"> รายงาน ติดตามลูกหนี้ฟ้อง</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{6}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/001.png') }}" alt="Personal development">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
             <a href="{{ route('MasterLegis.index') }}?type={{6}}"><h5><u>{{$data1}}</u></h5></a>
            <h4>ลูกหนี้ เตรียมฟ้อง</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{21}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/002.png') }}" alt="Support services">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{21}}"><h5><u>{{$data2}}</u></h5></a>
            <h4>ลูกหนี้ รอฟ้อง</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{22}}">
            <div class="card-icon responsive">
              <img src="{{ asset('dist/img/legis/003.png') }}" alt="About the site">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{22}}"><h5><u>{{$data3 - $data4 - $data5}}</u></h5></a>
            <h4>ลูกหนี้ ชั้นศาล</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{23}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/004.png') }}" alt="About the site">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{23}}"><h5><u>{{$data4}}</u></h5></a>
            <h4>ลูกหนี้ ชั้นบังคับคดี</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{24}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/005.png') }}" alt="Support services">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{24}}"><h5><u>{{$data5}}</u></h5></a>
            <h4>ลูกหนี้ โกงเจ้าหนี้</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{25}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/006.png') }}" alt="About the site">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{25}}"><h5><u>{{$data7}}</u></h5></a>
            <h4>ลูกหนี้ ปิดจบงาน</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterLegis.index') }}?type={{8}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/007.png') }}" alt="About the site">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterLegis.index') }}?type={{8}}"><h5><u>{{$data6}}</u></h5></a>
            <h4>ลูกหนี้ สืบทรัพย์</h4>
          </div>
        </div>
      </div>
    </div>
    <a id="button"></a>
  </div>
  
  <div class="modal fade" id="modal-data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="ShowData">
          <div class="col-lg-6 col-6">
            <div class="small-box bg-purple">
              <div class="inner">
                <p id="textid"></p>
              </div>
              <div class="icon">
                <i class="far fa-calendar-check"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <div id="ShowEvents"></div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/scriptLegis.js') }}"></script>
  <script>
    $("#button-id").click(function(e){
      e.preventDefault();
        var id = $('#ID').val();
        var url = "{{ route('MasterLegis.index') }}?type={{2}}&id="+id;
      FunctionGetUser(url);
    });
  </script> 

  {{-- <script type="text/javascript">
    $("#button-id").click(function(e){
      e.preventDefault();
        var id = $('#ID').val();
        var url = "{{ route('MasterLegis.index') }}?type={{2}}&id="+id;
        $.get(url, function (data) {
          $('#modal-data').modal('show');
          // $('#ShowData').val(data.result);
          console.log(data);
          $('#textid').text(data.id);
          // $('.inner').empty();

          // วนลูปเอาค่า
          // data.forEach(element => {
          //   console.log(element.id);
          //   $('.modal-body').append(element.id);
          // });
        });
    });
  </script> --}}

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>
@endsection

