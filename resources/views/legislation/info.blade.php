@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

@php
  function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
    //return "$strDay-$strMonthThai-$strYear";
  }
@endphp

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <style>
   readonly{
     background-color: #FFFFFF;
   }
  </style>

  <style>
    body {
      font-family: Arial;
      margin: 0;
    }
    * {
      box-sizing: border-box;
    }
    img {
      vertical-align: middle;
    }
    .container {
      position: relative;
    }
    .mySlides {
      display: none;
    }
    .cursor {
      cursor: pointer;
    }
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
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
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
    .column {
      float: left;
      width: 16.66%;
    }
    .demo {
      opacity: 0.6;
    }
    .active,
    .demo:hover {
      opacity: 1;
    }
  </style>

  <style>
    #todo-list{
    width:100%;
    margin:0 auto 50px auto;
    padding:5px;
    background:white;
    position:relative;
    /*box-shadow*/
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
     -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
          box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    /*border-radius*/
    -webkit-border-radius:5px;
     -moz-border-radius:5px;
          border-radius:5px;
    }
    #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
     -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
          box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
     -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
    }
    .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
     -moz-box-shadow:0 2px 0 -1px #ebebeb;
          box-shadow:0 2px 0 -1px #ebebeb;
    }
    .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
     -moz-box-shadow:none;
          box-shadow:none;
    }
    input[type="checkbox"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
    }
    .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 2px);
    left:0;
    width:0%;
    height:1px;
    background:#cd4400;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
     -moz-transition:.25s ease-in-out;
       -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    }
    .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
     -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
          box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
     -moz-transition:.25s ease-in-out;
       -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
     -moz-border-radius:4px;
          border-radius:4px;
    }
    .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
     -moz-box-shadow:inset 0 0 0 2px #949494;
          box-shadow:inset 0 0 0 2px #949494;
    }
    .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
    }
    :checked + .todo{
    color:#717171;
    }
    :checked + .todo:before{
    width:100%;
    }
    :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
     -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
          box-shadow:inset 0 0 0 2px #0eb0b7;
    }
    :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
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

      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h4 class="card-title p-3" align="center">แก้ไขข้อมูงานฟ้อง</h4>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs bg-warning">
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 2]) }}">ข้อมูลผู้เช่าซื้อ</a></li>
              <li class="nav-item"><a href="{{ action('LegislationController@edit',[$id, 3]) }}">ชั้นศาล</a></li>
              <li class="nav-item"><a href="#tab_3">ชั้นบังคับคดี</a></li>
              <li class="nav-item"><a href="#tab_4">ของกลาง</a></li>
              <li class="nav-item"><a href="#tab_5">โกงเจ้าหนี้</a></li>
              <li class="nav-item pull-right active"><a href="{{ action('LegislationController@edit',[$id, 11]) }}">รูปและแผนที่</a></li>
            </ul>
          </div>

          <div class="box-body">

            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                  <li>กรุณาลงชื่อ ผู้อนุมัติ {{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12"> <br />
                <form name="form1" method="post" action="{{ action('LegislationController@update',[$id,$type]) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="form-group" align="right">
                          <button type="submit" class="delete-modal btn btn-success">
                            <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                          </button>
                          <a class="delete-modal btn btn-danger" href="{{ route('legislation',2) }}">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                          </a>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> รูปภาพ </h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" onclick="showImg()"><i class="fa fa-eye"></i></button>
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body">

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
                                        <br><br>
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
                                <div class="box box-warning box-solid">
                                  <div class="box-header with-border">
                                    <h3 class="box-title"> แผนที่ </h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" onclick="showMap()"><i class="fa fa-eye"></i></button>
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                    </div>
                                  </div>

                                  <div class="box-body">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div id="myLat" style="display:none;">
                                          <div class="form-inline" align="center">
                                            <label>ละติจูด : </label> <input type="text" name="latitude" class="form-control" style="width:175px" value="{{ $lat }}"/>
                                            <label>ลองจิจูด : </label> <input type="text" name="longitude" class="form-control" style="width:175px" value="{{ $long }}"/>
                                            <!-- <button type="submit" class="btn btn-warning" style="width:100px">
                                              <span class="glyphicon glyphicon-search"></span> Search
                                            </button> -->
                                          </div>
                                          <br><br>
                                        </div>

                                        <div id="map" style="width:100%;height:63vh"></div>

                                      </div>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="_method" value="PATCH"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

<!-- เวลาแจ้งเตือน -->
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
        $(function () {
          $('[data-mask]').inputmask()
        })
      </script>

      <script type="text/javascript">
        $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
        $(".alert").alert('close');
        });
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

    </section>
@endsection
