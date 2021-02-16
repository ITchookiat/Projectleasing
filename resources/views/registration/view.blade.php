@extends('layouts.master')
@section('title','แผนกทะเบียน')
@section('content')
    <style>
        .feature-area {
            padding-top: 24px;
            padding-bottom: 75px;
            position: relative; }
            @media only screen and (min-width: 320px) and (max-width: 479px) {
        .feature-area {
            padding-top: 100px; } }
        .feature-area .sec-heading .sec__title {
            line-height: 55px; }
            @media (max-width: 480px) {
        .feature-area .sec-heading .sec__title {
            line-height: 40px; } }
        .feature-area .service-button {
            margin-top: 80px;
            text-align: right; }
            @media only screen and (min-width: 768px) and (max-width: 991px) {
        .feature-area .service-button {
            text-align: left;
            margin-top: 30px;
            margin-bottom: 35px; } }
            @media only screen and (min-width: 480px) and (max-width: 767px) {
        .feature-area .service-button {
            text-align: left;
            margin-top: 30px;
            margin-bottom: 35px; } }
            @media only screen and (min-width: 320px) and (max-width: 479px) {
        .feature-area .service-button {
            text-align: left;
            margin-top: 30px;
            margin-bottom: 35px; } }
        .feature-area .feature-box {
            margin-top: 25px;
            text-align: center; }
            .feature-area .feature-box .feature-item {
            position: relative;
            background-color: #fff;
            -webkit-border-radius: 20px 0 20px 0;
            -moz-border-radius: 20px 0 20px 0;
            border-radius: 20px 0 20px 0;
            -webkit-box-shadow: 0 0 40px rgba(82, 85, 90, 0.1);
            -moz-box-shadow: 0 0 40px rgba(82, 85, 90, 0.1);
            box-shadow: 0 0 40px rgba(82, 85, 90, 0.1);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            padding: 45px 30px 40px 30px;
            margin-bottom: 30px;
            z-index: 1; }
        .feature-area .feature-box .feature-item:after {
            position: absolute;
            content: '';
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #F66B5D;
            left: 0;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            transform: scale(0);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s; }
            @media (max-width: 1199px) {
        .feature-area .feature-box .feature-item {
            padding-right: 20px;
            padding-left: 20px; } }
            @media only screen and (min-width: 768px) and (max-width: 991px) {
        .feature-area .feature-box .feature-item {
            padding-right: 30px;
            padding-left: 30px;
            margin-bottom: 30px; } }
            @media only screen and (min-width: 481px) and (max-width: 767px) {
        .feature-area .feature-box .feature-item {
            width: 60%;
            margin-left: auto;
            margin-right: auto; } }
            @media only screen and (min-width: 480px) and (max-width: 767px) {
        .feature-area .feature-box .feature-item {
            padding-right: 30px;
            padding-left: 30px;
            margin-bottom: 30px; } }
            @media only screen and (min-width: 320px) and (max-width: 479px) {
        .feature-area .feature-box .feature-item {
            padding-right: 30px;
            padding-left: 30px;
            margin-bottom: 30px;
            width: 100%; } }
        .feature-area .feature-box .feature-item .feature__number {
            font-size: 35px;
            position: absolute;
            top: 3px;
            right: 5px;
            width: 60px;
            height: 55px;
            font-weight: 600;
            line-height: 55px;
            color: rgba(35, 61, 92, 0.3);
            -webkit-border-radius: 0 0 0 10px;
            -moz-border-radius: 0 0 0 10px;
            border-radius: 0 0 0 10px;
            z-index: 1;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            transform: scale(0);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s; }
        .feature-area .feature-box .feature-item .feature__icon {
            color: #F66B5D;
            display: inline-block;
            position: relative;
            width: 100px;
            height: 100px;
            line-height: 100px;
            margin-bottom: 30px;
            z-index: 1;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            background-color: rgba(246, 107, 93, 0.1);
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%; }
            @media (max-width: 1199px) {
        .feature-area .feature-box .feature-item .feature__icon {
            font-size: 45px;
            margin-top: 20px;
            margin-bottom: 35px; } }
            @media only screen and (min-width: 768px) and (max-width: 991px) {
        .feature-area .feature-box .feature-item .feature__icon {
            font-size: 65px;
            margin-bottom: 39px; } }
            @media only screen and (min-width: 480px) and (max-width: 767px) {
            .feature-area .feature-box .feature-item .feature__icon {
            font-size: 65px;
            margin-bottom: 39px; } }
            @media only screen and (min-width: 320px) and (max-width: 479px) {
        .feature-area .feature-box .feature-item .feature__icon {
            font-size: 65px;
            margin-bottom: 39px; } }
        .feature-area .feature-box .feature-item .feature__icon:before {
            font-size: 45px; }
        .feature-area .feature-box .feature-item .feature__icon:after {
            position: absolute;
            content: '';
            left: 50%;
            top: -8px;
            width: 50px;
            height: 25px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            background-color: #fff;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%); }
        .feature-area .feature-box .feature-item .feature__title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
            text-transform: capitalize; }
        .feature-area .feature-box .feature-item .feature__title a {
            color: #233d63;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s; }
        .feature-area .feature-box .feature-item .feature__desc {
            font-size: 16px;
            color: #677286;
            line-height: 28px;
            font-weight: 500; }
        .feature-area .feature-box .feature-item:hover {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0; }
        .feature-area .feature-box .feature-item:hover .feature__number {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        .feature-area .feature-box .feature-item:hover .feature__icon {
            background-color: #F66B5D;
            color: #fff; }
        .feature-area .feature-box .feature-item:hover .feature__title a {
            color: #F66B5D; }
        .feature-area .feature-box .feature-item:hover:after {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        .feature-area .feature-box .feature-item:hover:before {
            opacity: 0.2;
            visibility: visible;
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        .feature-area .feature-box .feature-item:before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("https://techydevs.com/demos/themes/html/minzel/images/dots3.png");
            background-size: cover;
            background-position: center;
            z-index: -1;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -ms-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
            -webkit-transform: scale(0.6);
            -moz-transform: scale(0.6);
            -ms-transform: scale(0.6);
            -o-transform: scale(0.6);
            transform: scale(0.6); }
    </style>

    <section class="feature-area">
        <div class="container">
            <div class="row mb-1">
                <div class="col-6">
                  <div class="form-inline">
                    <h5 class="">
                      ระบบทะเบียน (Registration System)
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
                        <li><a href="#" class="dropdown-item"> รายงาน ติดตามลูกหนี้ฟ้อง</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row feature-box">
                <div class="col-md-4 col-sm-6">
                    <div class="feature-item">
                        <span class="feature__number">01</span>
                        <span class="feature__icon">
                            <img src="{{ asset('dist/img/registration/01.png') }}" alt="Personal development" class="img-fluid">
                        </span>
                        <h3 class="feature__title">
                            <a href="#">Chookiat Leasing.</a>
                        </h3>
                        <p class="feature__desc">
                            sed quia lipsum dolor sit atur adipiscing elit is nunc quis
                            tellus sed ligula porta ultricies quis nec neulla.
                        </p>
                    </div><!-- end feature-item -->
                </div><!-- end col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <div class="feature-item">
                        <span class="feature__number">02</span>
                        <span class="feature__icon">
                            <img src="{{ asset('dist/img/registration/02.png') }}" alt="Personal development" class="img-fluid">
                        </span>
                        <h3 class="feature__title">
                            <a href="#">Chookiat Yont.</a>
                        </h3>
                        <p class="feature__desc">
                            sed quia lipsum dolor sit atur adipiscing elit is nunc quis
                            tellus sed ligula porta ultricies quis nec neulla.
                        </p>
                    </div><!-- end feature-item -->
                </div><!-- end col-md-4 -->
                <div class="col-md-4 col-sm-6">
                    <div class="feature-item">
                        <span class="feature__number">03</span>
                        <span class="feature__icon">
                            <img src="{{ asset('dist/img/registration/03.png') }}" alt="Personal development" class="img-fluid">
                        </span>
                        <h3 class="feature__title">
                            <a href="#">Chookiat Car.</a>
                        </h3>
                        <p class="feature__desc">
                            sed quia lipsum dolor sit atur adipiscing elit is nunc quis
                            tellus sed ligula porta ultricies quis nec neulla.
                        </p>
                    </div><!-- end feature-item -->
                </div><!-- end col-md-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
