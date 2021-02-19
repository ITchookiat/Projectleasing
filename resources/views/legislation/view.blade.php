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

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Marcellus&display=swap');
    .card {
        border-radius: 10px;
        color: #5c647c;
        font-weight: 500
    }

    .div1 {
        background-color: #f7f6fb;
        border-radius: 10px 10px 0 0
    }

    .div2 {
        background-color: #ffffff border-radius: 0 0 10px 10px
    }

    .form-check-input {
        position: absolute;
        left: 55px;
        border-radius: 3px
    }

    .form-check-label,
    p {
        font-size: 13px
    }

    #btn-save {
        background-color: #415aeb;
        border-radius: 30px
    }

    .modal-content {
        border-radius: 1rem
    }

    .modal-content:hover {
        box-shadow: 2px 2px 2px rgb(128, 128, 127)
    }

    *:focus {
        outline: none
    }

    .option-input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -o-appearance: none;
        appearance: none;
        height: 21px;
        width: 21px;
        transition: all 0.15s ease-out 0s;
        background-color: #f9f8fe;
        border: 2px solid #a6b0e6;
        border-radius: 25px;
        color: #e6edf7;
        cursor: pointer;
        display: inline-block;
        outline: none;
        z-index: 1000
    }

    .option-input:checked {
        background-color: #415aeb
    }

    .option-input:checked::before {
        padding-left: 5px;
        position: absolute;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
        font-size: 15px;
        text-align: center
    }

    .option-input:checked::after+label:after {
        -webkit-animation: click-wave 0.15s;
        -moz-animation: click-wave 0.15s;
        animation: click-wave 0.15s;
        background: #E91E63;
        content: '';
        display: block;
        position: relative;
        z-index: 100
    }

    .option-input.radio {
        border-radius: 80%
    }

    .option-input.radio::after {
        border-radius: 30px
    }

    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
        float: left;
        margin-left: -4px !important
    }

    input[type="checkbox"]:focus {
        outline: thin dotted #333;
        outline: 0px auto -webkit-focus-ring-color;
        outline-offset: 0px
    }

    label {
        font-weight: 400;
        font-size: 15px;
        font-family: 'Manrope', sans-serif;
        margin-top: 7px
    }
  </style>

  <br>
  <div class="container">
    <div class="row mb-2">
      <div class="col-6">
        <div class="form-inline">
          <h5 class="">
            ระบบลูกหนี้กฎหมาย (Legal Debtor)
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
            
            <ul class="dropdown-menu text-sm" role="menu">
              {{-- <li><a href="{{ route('legislation.report',[0,20]) }}" class="dropdown-item"> รายงาน ติดตามลูกหนี้ฟ้อง</a></li> --}}
              <li><a class="dropdown-item"  data-toggle="modal" data-target="#modal-primary"> รายงาน ลูกหนี้กฏหมาย</a></li>
              <li class="dropdown-divider"></li>
              <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-2" data-link="{{ route('MasterCompro.show', 2) }}"> รายงาน การชำระค่างวด(บุคคล)</a></li>
              <li class="dropdown-divider"></li>
              <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-3" data-link="{{ route('MasterCompro.show', 3) }}"> รายงาน ตรวจสอบการรับชำระ</a></li>
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
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="single-card">
          <a href="{{ route('MasterCompro.index') }}?type={{1}}">
            <div class="card-icon">
              <img src="{{ asset('dist/img/legis/008.png') }}" alt="About the site">
              <div class="card-hover">
                  <i class="fa fa-link"></i>
              </div>
            </div>
          </a>
          <div class="card-content p-3">
            <a href="{{ route('MasterCompro.index') }}?type={{1}}"><h5><u>{{$data8}}</u></h5></a>
            <h4>ลูกหนี้ ประนอมหนี้</h4>
          </div>
        </div>
      </div>
    </div>
    <a id="button"></a>
  </div>

  {{-- รายงานรวม --}}
  <div class="modal fade show" id="modal-primary" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg">
      <form name="form1" action="{{ route('legislation.report',[0,20]) }}" target="_blank" method="get" id="formimage" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="card text-center">
            <div class="div1 py-3 px-3"> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                <span aria-hidden="true">&times;</span> 
              </button>
                <h5 class="text-center font-weight-bold"> รายงาน ลูกหนี้กฏหมาย </h5>
            </div>
            <div class="div2 py-2">
                <p class="px-4">You'll continue to see news from your selected preference of news sources on stories.</p>
                <hr class="d-flex my-0 mx-4">
                <div class="row">
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="1"> 
                      <label class="form-check-label" for="check1"> ลูกหนี้เตรียมฟ้อง</label> 
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="2"> 
                      <label class="form-check-label " for="check2"> ลูกหนี้รอฟ้อง</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="3"> 
                      <label class="form-check-label " for="check3"> ลูกหนี้ชั้นศาล</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="4"> 
                      <label class="form-check-label " for="check4"> ลูกหนี้ชั้นบังคับคดี</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="5"> 
                      <label class="form-check-label " for="check5"> ลูกหนี้ชั้นโกงเจ้าหนี้</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="6"> 
                      <label class="form-check-label " for="check6"> ลูกหนี้ปิดจบงาน</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="7"> 
                      <label class="form-check-label " for="check7"> ลูกหนี้สืบทรัพย์</label> 
                    </div> 
                  </div>
                  <div class="col-6">
                    <div class="form-check py-2"> 
                      <input class="form-check-input option-input" name="Flag" type="checkbox" value="8"> 
                      <label class="form-check-label " for="check8"> ลูกหนี้ทั้งหมด</label> 
                    </div> 
                  </div>
                </div>
                <br>
                <button class="btn text-white pt-0 pb-1 px-4 my-3" type="submit" id="btn-save">Prints</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- รายงานชำะค่างวด -->
  <div class="modal fade" id="modal-2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>
  <!-- รายงานตรวจสอบยอดชำระ -->
  <div class="modal fade" id="modal-3">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- Pup up ค้นหา --}}
  <div class="modal fade" id="modal-Show">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="modal-body-event">
          <p>One fine body…</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-2").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-2 .modal-body").load(link, function(){
        });
      });
      $("#modal-3").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-3 .modal-body").load(link, function(){
        });
      });
    });
  </script>

  {{-- <script src="{{ asset('js/scriptLegis.js') }}"></script> --}}
  {{-- <script>
    $("#button-id").click(function(e){
      e.preventDefault();
        var id = $('#ID').val();
        var url = "{{ route('MasterLegis.index') }}?type={{2}}&id="+id;
      FunctionGetUser(url);
    });
  </script>  --}}
  <script>
    $("#button-id").click(function(e){
    e.preventDefault();
        var id = $('#ID').val();
        $("#modal-Show .modal-body").load("{{ route('MasterLegis.index')}}?type=2&id="+id, function(){
            $('#modal-Show').modal('show');
        });
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

