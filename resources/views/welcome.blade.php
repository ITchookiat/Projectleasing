<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CHOOKIAT GROUP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <style>
            /*----  Main Style  ----*/
            #cards_landscape_wrap-2{
            text-align: center;
            background: #F7F7F7;
            }
            #cards_landscape_wrap-2 .container{
            padding-top: 0px; 
            padding-bottom: 10px;
            }
            #cards_landscape_wrap-2 a{
            text-decoration: none;
            outline: none;
            }
            #cards_landscape_wrap-2 .card-flyer {
            border-radius: 5px;
            }
            #cards_landscape_wrap-2 .card-flyer .image-box{
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
            border-radius: 5px;
            }
            #cards_landscape_wrap-2 .card-flyer .image-box img{
            -webkit-transition:all .9s ease; 
            -moz-transition:all .9s ease; 
            -o-transition:all .9s ease;
            -ms-transition:all .9s ease; 
            width: 100%;
            height: 200px;
            }
            #cards_landscape_wrap-2 .card-flyer:hover .image-box img{
            opacity: 0.7;
            -webkit-transform:scale(1.15);
            -moz-transform:scale(1.15);
            -ms-transform:scale(1.15);
            -o-transform:scale(1.15);
            transform:scale(1.15);
            }
            #cards_landscape_wrap-2 .card-flyer .text-box{
            text-align: center;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box .text-container{
            padding: 30px 18px;
            }
            #cards_landscape_wrap-2 .card-flyer{
            background: #FFFFFF;
            margin-top: 50px;
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
            }
            #cards_landscape_wrap-2 .card-flyer:hover{
            background: #fff;
            box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -ms-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            margin-top: 50px;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box p{
            margin-top: 10px;
            margin-bottom: 0px;
            padding-bottom: 0px; 
            font-size: 14px;
            letter-spacing: 1px;
            color: #000000;
            }
            #cards_landscape_wrap-2 .card-flyer .text-box h6{
            margin-top: 0px;
            margin-bottom: 4px; 
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            font-family: 'Roboto Black', sans-serif;
            letter-spacing: 1px;
            color: #00acc1;
            }
        </style>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Prompt:ital@1&display=swap');
        </style>
    </head>
    <body>
        <br>
        <div class="pricing-header px-3 py-3 pt-md-3 pb-md-0 mx-auto text-center">
            <h1 class="display-4">CHOOKIAT GROUP</h1>
            <p style="font-family: 'Prompt', sans-serif;">“ มุ่งมั่นในเรื่องของการดูแลลูกค้า ดูแลทีมงานให้เหมือนคนในครอบครัว ตั้งใจด้วยความซื่อสัตย์ ดูแลด้วยความจริงใจ ”</p>
        </div>

        <div id="cards_landscape_wrap-2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="{{ route('login') }}">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <div class="image-box">
                                        <img src="{{ asset('dist/img/leasing02.png') }}" alt=""/>
                                    </div>
                                    <div class="text-container">
                                        <h6>chookiat Leasing</h6>
                                        <p style="font-family: 'Prompt', sans-serif;">อาชีพไหนๆก็ได้กู้ ง่ายๆ คนใต้ด้วยกัน เราพร้อมเคียงข้างทุกความสำเร็จของคุณ</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="http://192.168.200.9/ProjectLabPM/public/login">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <div class="image-box">
                                        <img src="{{ asset('dist/img/leasing03.png') }}" alt=""/>
                                    </div>
                                    <div class="text-container">                                    
                                        <h6>chookiat LabPM</h6>
                                        <p style="font-family: 'Prompt', sans-serif;">จำนำทะเบียนแบบไม่โอนเล่ม เร็วสุด ไวสุด ในสามจังหวัดชายแดนภาคใต้ พร้อมให้บริการคุณในทุกโอกาส</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="http://192.168.200.9/ProjectHomeCar/public/login">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <div class="image-box">
                                       <img src="{{ asset('dist/img/leasing04.png') }}" alt="" />
                                    </div>
        
                                    <div class="text-container">
                                        <h6>chookiat HomeCar</h6>
                                        <p style="font-family: 'Prompt', sans-serif;">ศูนย์รวมรถยนต์มือสอง อันดับ 1 ในสามจังหวัดชายแดนภาคใต้ สาขาปัตตานี</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <a href="#">
                            <div class="card-flyer">
                                <div class="text-box">
                                    <div class="image-box">
                                       <img src="{{ asset('dist/img/Mazda.png') }}"/>
                                    </div>
                                    <div class="text-container">
                                        <h6>Mazda LabBP</h6>
                                        <p style="font-family: 'Prompt', sans-serif;">ศูนย์ซ่อมตัวถังและสี มาตรฐานจากโรงงานมาสด้า บริการด้วยทีมช่างมืออาชีพ รับประกันคุณภาพการซ่อม</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
