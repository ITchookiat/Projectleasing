@extends('layouts.master')
@section('title','กฏหมาย/รูปและแผนที')
@section('content')

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

  <style>
   readonly{
     background-color: #FFFFFF;
   }
  </style>

  <style>
      .fileUpload {
      position: relative;
      overflow: hidden;
      }
      .fileUpload input.upload {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0;
      padding: 0;
      font-size: 20px;
      cursor: pointer;
      opacity: 0;
      filter: alpha(opacity=0);
      }

      .btn--browse{
      border: 1px solid gray;
      border-left: 0;
      border-radius: 0 2px 2px 0;
      background-color: #ccc;
      color: black;
      height: 42px;
      padding: 10px 14px;
      }

      .f-input{
      height: 42px;
      background-color: white;
      border: 1px solid gray;
      width: 100%;
      max-width: 500px;
      float: left;
      padding: 0 14px;
      }
  </style>

  <style>
      * {
        box-sizing: border-box;
      }

      img {
        vertical-align: middle;
      }

      /* Position the image container (needed to position the left and right arrows) */
      .container1 {
        position: relative;
      }

      /* Hide the images by default */
      .mySlides {
        display: none;
      }

      /* Add a pointer when hovering over the thumbnail images */
      .cursor {
        cursor: pointer;
      }

      /* Next & previous buttons */
      .prev,
      .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
      }

      /* Position the "next button" to the right */
      .next {
        right: 0;
        border-radius: 3px 0 0 3px;
      }

      /* On hover, add a black background color with a little bit see-through */
      .prev:hover,
      .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
      }

      /* Number text (1/3 etc) */
      .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
      }

      /* Container for image text */
      .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
      }

      .row:after {
        content: "";
        display: table;
        clear: both;
      }

      /* Six columns side by side */
      .column {
        float: left;
        width: {{$column}}%;
      }

      /* Add a transparency effect for thumnbail images */
      .demo {
        opacity: 0.6;
      }

      .active,
      .demo:hover {
        opacity: 1;
      }
  </style>

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="card">
          <form name="form1" method="post" action="{{ route('MasterLegis.update',[$id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="type" value="11"/>

            <div class="card-header">
              <div class="row mb-1">
                <div class="col-6">
                  <h5>รูปและแผนที่</h5>   
                </div>
                <div class="col-6">
                  <div class="card-tools d-inline float-right">
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fas fa-save"></i> Save
                    </button>
                    <a class="btn btn-danger btn-sm" href="{{ route('MasterLegis.index') }}?type={{20}}">
                      <i class="far fa-window-close"></i> Close
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-warning card-tabs text-sm">
                <div class="card-header p-0 pt-1">
                  <div class="container-fluid">
                    <div class="row mb-1">
                      <div class="col-sm-6">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{2}}">ข้อมูลลูกหนี้</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="{{ route('MasterLegis.edit',[$id]) }}?type={{3}}">ชั้นศาล</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{7}}">ชั้นบังคับคดี</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="{{ route('MasterLegis.edit',[$id]) }}?type={{13}}">โกงเจ้าหนี้</a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-sm-6">
                        <div class="float-right form-inline">
                          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <a class="nav-link" href="{{ route('MasterLegis.edit',[$id]) }}?type={{8}}">สืบทรัพย์</a>
                            <a class="nav-link" href="{{ route('MasterCompro.edit',[$id]) }}?type={{2}}">ประนอมหนี้</a>
                            <a class="nav-link active" href="{{ route('MasterLegis.edit',[$id]) }}?type={{11}}">รูปและแผนที่</a>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>          
              </div>
            </div>
          
            <div class="card-body text-sm">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-id-badge fa-2x"></i></span>
                <div class="info-box-content">
                  <h5>{{ $data->Contract_legis }}</h5>
                  <span class="info-box-number" style="font-size: 20px;">{{ $data->Name_legis }}</span>
                </div>

                <div class="info-box-content">
                  <div class="form-inline float-right">
                    <small class="badge badge-danger" style="font-size: 18px;">
                      <i class="fas fa-sign"></i>&nbsp; สถานะ :
                      @if($data->Status_legis != Null)
                        <input type="text" name="StatusCase" class="form-control form-control-sm" value="{{$data->Status_legis}}" readonly>
                        <input type="date" name="DateStatuslegis" class="form-control form-control-sm" value="{{ $data->DateUpState_legis }}" readonly>
                      @else
                        <input type="text" class="form-control form-control-sm" value="--------- status ----------" readonly>
                        <input type="date" class="form-control form-control-sm" readonly>
                      @endif
                    </small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">
                        รูปภาพ
                        @if($SumImage != 0)
                          ({{$SumImage}})
                        @endif
                      </h3>
      
                      <div class="card-tools">
                        @if($SumImage != 0)
                          <a href="{{ action('LegislationController@deleteImageAll',$id) }}" title="ลบรูปทั้งหมด" onclick="return confirm('คุณต้องการลบรูปทั้งหมดหรือไม่?')" class="btn btn-box-tool">
                            <i class="fa fa-trash"></i>
                          </a>
                        @endif
                        <button type="button" class="btn btn-tool" onclick="showImg()" title="แสดงที่เพิ่มรูป"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      @if($SumImage == 0)
                        <div id="myImg">
                      @else
                        <div id="myImg" style="display:none;">
                      @endif
                        <div class="form-group">
                          <div class="file-loading">
                            <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                          </div>
                        </div>
                        <br><hr>
                      </div>

                      @if($SumImage > 0)
                        <div class="container1">
                          @foreach($dataImages as $key => $images)
                            <div class="mySlides">
                              <div class="numbertext">{{$key+1}} / {{$SumImage}}</div>
                              <img class="img-responsive" src="{{ asset('upload-image/'.$images->name_image) }}" style="width:675px; height:400px;">
                            </div>
                          @endforeach
                          <a class="prev" onclick="plusSlides(-1)">❮</a>
                          <a class="next" onclick="plusSlides(1)">❯</a>

                          <div class="caption-container">
                            <p id="caption"></p>
                          </div>

                          <div class="row" style="margin-left:1px;">
                            @foreach($dataImages as $images)
                            <div class="column">
                              <img class="demo cursor" src="{{ asset('upload-image/'.$images->name_image) }}" style="width:100%;height:100px;" onclick="currentSlide(1)" alt="{{ $images->name_image }}">
                            </div>
                            @endforeach
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">แผนที่</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" onclick="showMap()" title="แสดงละติจูดและลองจิจูด"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div id="myLat" style="display:none;">
                            <div class="form-group row mb-0">
                              <label class="col-sm-4 col-form-label text-right">ละติจูด : </label>
                              <div class="col-sm-8">
                                <input type="text" name="latitude" class="form-control form-control-sm" value="{{ $lat }}"/>
                              </div>
                            </div>
                            <div class="form-group row mb-0">
                              <label class="col-sm-4 col-form-label text-right">ลองจิจูด : </label>
                              <div class="col-sm-8">
                                </label> <input type="text" name="longitude" class="form-control form-control-sm" value="{{ $long }}"/>
                              </div>
                            </div>
                          </div>
                          <div id="map" style="width:100%;height:63vh"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" name="_method" value="PATCH"/>
          </form>
        </div>
      </section>
    </div>
  </section>

  <script type="text/javascript">
    $("#image-file").fileinput({
      uploadUrl:"{{ route('MasterAnalysis.store') }}",
      theme:'fa',
      uploadExtraData:function(){
        return{
          _token:"{{csrf_token()}}",
        }
      },
      allowedFileExtensions:['jpg','png','gif'],
      maxFileSize:10240
    })
  </script>

  <script>
      function showMap() {
      var x = document.getElementById("myLat");
      if (x.style.display === "none") {
      x.style.display = "block";
      } else {
      x.style.display = "none";
      }
      }
      function showImg() {
      var x = document.getElementById("myImg");
      if (x.style.display === "none") {
      x.style.display = "block";
      } else {
      x.style.display = "none";
      }
      }
  </script>

  @if($lat == null && $long ==null)
    <script>
      function initMap() {
        var myLatlng = {lat: 6.855323, lng: 101.220649};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          center: myLatlng
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Click to zoom'
        });

        map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });

        marker.addListener('click', function() {
          map.setZoom(15);
          map.setCenter(marker.getPosition());
        });
      }
    </script>
  @else
    <script>
      function initMap() {
        var myLatlng = {lat: {{ $lat }}, lng: {{ $long }}};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: myLatlng
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Click to zoom'
        });

        map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });

        marker.addListener('click', function() {
          map.setZoom(15);
          map.setCenter(marker.getPosition());
        });
      }
    </script>
  @endif

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHvHdio8MNE9aqZZmfvd49zHgLbixudMs&callback=initMap&language=th">
  </script>

  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
    }
  </script>
@endsection
