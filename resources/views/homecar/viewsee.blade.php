
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

  <style>
    .a1 {color: #FBFCFC;}
    .a2 {color: #D35400;}
    .a3 {color: #1E8449;}
    .a4 {color: #A93226;}
    .a5 {color: #FF8C00;}

  </style>
  <style>
    .con3 {
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 25px;
      -webkit-user-select: 10px;
      -moz-user-select: 10px;
      -ms-user-select: 10px;
      user-select: 10px;
      border-radius: 25px;
    }

    .con3 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
      border-radius: 25px;
    }

    .checkmark3 {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #999;
      border-radius: 25px;
    }

    .con3:hover input ~ .checkmark3 {
      background-color: #ccc;
    }

    .con3 input:checked ~ .checkmark3 {
      background-color: blue;
    }

    .checkmark3:after {
      content: "";
      position: absolute;
      display: none;
      border-radius: 25px;
    }

    .con3 input:checked ~ .checkmark3:after {
      display: block;
    }

    .con3 .checkmark3:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
        </style>

   @php
    function DateThai($strDate)
        {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));

        $strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
        $strMonthThai=$strMonthCut[$strMonth];

        return "$strDay $strMonthThai $strYear";
        //return "$strDay-$strMonthThai-$strYear";
        }
    @endphp


    @php
    $create_date = date_create($datacar->create_date);
    $Date_NumberUser = date_create($datacar->Date_NumberUser);
    $Date_Expire = date_create($datacar->Date_Expire);

    $Date_soldoutplus = date_create($datacar->Date_Soldout_plus);
    $Date_Withdraw = date_create($datacar->Date_Withdraw);
    @endphp

    @if($datacar->Date_Soldout_plus == Null)
      @php
        $Date_soldoutplus = 'วว/ดด/ปปปป';
      @endphp
    @else
      @php
        $Date_soldoutplus = date_create($datacar->Date_Soldout_plus);
        $Date_soldoutplus = date_format($Date_soldoutplus, 'd-m-Y');

      @endphp
    @endif

    @if($datacar->Date_Withdraw == Null)
      @php
        $Date_Withdraw = 'วว/ดด/ปปปป';
      @endphp
    @else
      @php
        $Date_Withdraw = date_create($datacar->Date_Withdraw);
        $Date_Withdraw = date_format($Date_Withdraw, 'd-m-Y');

      @endphp
    @endif

  <!-- Main content -->
  <section class="content">

    <div class="panel panel-default">
      <div class="panel-heading" id="hidden" align="center">
        <!-- <a class="pull-left" onclick="window.print();">print</a> -->
      <font size="4px">ข้อมูลรถทะเบียน   <b>{{$datacar->Number_Regist}}</b></font>
        <a class="text-red pull-right" href="{{ URL::previous() }}"><font size="3px"> ปิด </font> </a>
      </div>

      <div class="panel-body table-responsive">
        <br>

        <div class="row">
          <div class="col-md-4">
              <div class="panel panel-success">
                <div class="panel-heading" id="hidden" align="center">
                  <i class="fa fa-clock-o fa-lg"></i> วันที่ซื้อ - ปัจจุบัน(หรือปิดการขาย)
                </div>
                <br>
                <p align="center">
                  @php
                      date_default_timezone_set('Asia/Bangkok');
                      $Y = date('Y') + 543;
                      $m = date('m');
                      $d = date('d');
                      $ifdate = $Y.'-'.$m.'-'.$d;
                  @endphp

                    @if($ifdate > $datacar->create_date && $datacar->Date_Soldout == Null)
                      @php
                        $Cldate = date_create($datacar->create_date);
                        $nowCldate = date_create($ifdate);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp

                      <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @elseif($datacar->Date_Soldout != Null)
                      @php
                        $Cldate = date_create($datacar->create_date);
                        $nowCldate = date_create($datacar->Date_Soldout);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp

                      <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @elseif($datacar->create_date == $ifdate)
                      <font color="red">0 ปี 0 เดือน 0 วัน</font>
                    @endif
                </p>
                <br>
              </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-info">
              <div class="panel-heading" id="hidden" align="center">
                <i class="fa fa-clock-o fa-lg"></i> นำเข้า - รอทำสี
              </div>
              <br>
              <p align="center">
                @if($datacar->Date_Color == Null && $datacar->Date_Wait == Null && $datacar->Date_Repair == Null && $datacar->Date_Sale == Null && $datacar->Date_Soldout == Null)
                  @php
                    $Cldate = date_create($datacar->create_date);
                    $nowCldate = date_create($ifdate);
                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                  @endphp

                  <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                @elseif($datacar->Date_Color != Null)
                  @php
                    $Cldate = date_create($datacar->Date_Color);
                    $nowCldate = date_create($datacar->create_date);
                    $ClDateDiff = date_diff($Cldate,$nowCldate);
                  @endphp

                  <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                @elseif($datacar->Date_Color == Null)
                  @if($datacar->Date_Color == Null && $datacar->Date_Wait != Null)
                    0 ปี 0 เดือน 0 วัน
                  @elseif($datacar->Date_Color == Null && $datacar->Date_Repair != Null)
                    0 ปี 0 เดือน 0 วัน
                  @elseif($datacar->Date_Color == Null && $datacar->Date_Sale != Null)
                    0 ปี 0 เดือน 0 วัน
                  @elseif($datacar->Date_Color == Null && $datacar->Date_Soldout != Null)
                    0 ปี 0 เดือน 0 วัน
                  @endif
                @endif
              </p>
              <br>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-info">
              <div class="panel-heading" id="hidden" align="center">
                <i class="fa fa-clock-o fa-lg"></i> ระหว่างทำสี
              </div>
              <br>
              <p align="center">
                @if($datacar->Date_Color != Null)
                  @if($datacar->Date_Wait == Null)
                      <!-- ช่องรอซ่อมไม่มีค่า/ระหว่างซ่อมมีค่า -->
                      @if($datacar->Date_Wait == Null && $datacar->Date_Repair != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Color);
                          $nowCldate = date_create($datacar->Date_Repair);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      <!-- ช่องรอซ่อมไม่มีค่า/ตั้งขายมีค่า -->
                      @elseif($datacar->Date_Wait == Null && $datacar->Date_Sale != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Color);
                          $nowCldate = date_create($datacar->Date_Sale);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      <!-- ช่องรอซ่อมไม่มีค่า/ขายแล้วมีค่า -->
                      @elseif($datacar->Date_Wait == Null && $datacar->Date_Soldout != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Color);
                          $nowCldate = date_create($datacar->Date_Soldout);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      <!-- ช่องรอซ่อมไม่มีค่า -->
                      @elseif($datacar->Date_Wait == Null)
                        @php
                          $Cldate = date_create($datacar->Date_Color);
                          $nowCldate = date_create($ifdate);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @endif
                  <!-- ช่องรอซ่อมค่า -->
                  @elseif($datacar->Date_Wait != Null)
                    @php
                      $Cldate = date_create($datacar->Date_Color);
                      $nowCldate = date_create($datacar->Date_Wait);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @endif
                @else($datacar->Date_Color == Null)
                    0 ปี 0 เดือน 0 วัน
                @endif
              </p>
              <br>
            </div>
          </div>
        </div> <!-- endrow -->

        <div class="row">
          <div class="col-md-4">
            <div class="panel panel-danger">
              <div class="panel-heading" id="hidden" align="center">
                <i class="fa fa-clock-o fa-lg"></i> รอซ่อม
              </div>
              <br>
              <p align="center">
                @if($datacar->Date_Wait != Null)
                  @if($datacar->Date_Repair == Null)
                      @if($datacar->Date_Repair == Null && $datacar->Date_Sale != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Wait);
                          $nowCldate = date_create($datacar->Date_Sale);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @elseif($datacar->Date_Repair == Null && $datacar->Date_Soldout != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Wait);
                          $nowCldate = date_create($datacar->Date_Soldout);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @elseif($datacar->Date_Repair == Null)
                        @php
                          $Cldate = date_create($datacar->Date_Wait);
                          $nowCldate = date_create($ifdate);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @endif
                  @elseif($datacar->Date_Repair != Null)
                    @php
                      $Cldate = date_create($datacar->Date_Wait);
                      $nowCldate = date_create($datacar->Date_Repair);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @endif
                @else($datacar->Date_Wait == Null)
                    0 ปี 0 เดือน 0 วัน
                @endif
              </p>
              <br>
            </div>
          </div>
          <div class="col-md-4">
              <div class="panel panel-default">
                  <div class="panel-heading" id="hidden" align="center">
                    <i class="fa fa-clock-o fa-lg"></i> ระหว่างซ่อม
                  </div>
                  <br>
                  <p align="center">
                    @if($datacar->Date_Repair != Null)
                      @if($datacar->Date_Sale == Null)
                        @if($datacar->Date_Sale == Null && $datacar->Date_Soldout != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Repair);
                            $nowCldate = date_create($datacar->Date_Soldout);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @elseif($datacar->Date_Sale == Null)
                          @php
                            $Cldate = date_create($datacar->Date_Repair);
                            $nowCldate = date_create($ifdate);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @endif
                      @elseif($datacar->Date_Sale != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Repair);
                          $nowCldate = date_create($datacar->Date_Sale);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @endif
                    @else($datacar->Date_Repair == Null)
                        0 ปี 0 เดือน 0 วัน
                    @endif
                  </p>
                  <br>
             </div>
           </div>
          <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading" id="hidden" align="center">
                  <i class="fa fa-clock-o"></i> พร้อมขาย - ขายได้
                </div>
                <br>
                <p align="center">
                @if($datacar->Date_Sale != Null)
                  @if($datacar->Date_Soldout == Null)
                    @php
                      $Cldate = date_create($datacar->Date_Sale);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @elseif($datacar->Date_Soldout != Null)
                    @php
                      $Cldate = date_create($datacar->Date_Soldout);
                      $nowCldate = date_create($datacar->Date_Sale);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @endif
                  @else($datacar->Date_Sale == Null)
                      0 ปี 0 เดือน 0 วัน
                  @endif
                </p>
                <br>
           </div>
          </div>
        </div> <!-- endrow -->

          <hr>
          <div class="row">
            <div class="col-md-12">
              @csrf
              @method('put')
              <div class="row">
                 <div class="col-md-5">
                    <div class="form-inline" align="right">
                      <label>วันที่ซื้อ :</label>
                      <input type="text" name="DateCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{date_format($create_date, 'd-m-Y')}}" readonly />
                    </div>
                  </div>
                @if(auth::user()->type == 1)
                 <div class="col-md-6">
                    <!-- <div class="form-inline form-group" align="center">
                      <label>ราคาซื้อ : &nbsp;</label>
                      <input type="text" name="PriceCar" class="form-control" style="width: 250px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Fisrt_Price, 2)}}" readonly />
                    </div> -->
                  </div>
                @endif
              </div> <!-- endrow -->

              <div class="row">
                 <div class="col-md-5">
                  <div class="form-inline" align="right">
                    <label>ราคาแนะนำ :</label>
                    @if($datacar->Offer_Price == '' OR $datacar->Offer_Price == Null )
                    <input type="text" name="OfferPrice" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                    @else
                    <input type="text" name="OfferPrice" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Offer_Price, 2)}}" readonly />
                    @endif
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-inline" align="right">
                    <label>ราคาต้นทุน :</label>
                    <input type="text" name="TotalPrice" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Fisrt_Price+$datacar->Repair_Price+$datacar->Offer_Price+$datacar->Color_Price+$datacar->Add_Price, 2)}}" readonly />
                  </div>
                 </div>
              </div> <!-- endrow -->

              <div class="row">
                 <div class="col-md-5">
                  <div class="form-inline" align="right">
                    <label>ราคาซ่อม :</label>
                    @if($datacar->Repair_Price == '' OR $datacar->Repair_Price == Null )
                    <input type="text" name="RepairCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                    @else
                    <input type="text" name="RepairCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Repair_Price, 2)}}" readonly />
                    @endif
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-inline" align="right">
                    <label>ราคาเพิ่มเติม:</label>
                    @if($datacar->Add_Price == '' OR $datacar->Add_Price == Null )
                    <input type="text" name="AddPrice" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                    @else
                    <input type="text" name="AddPrice" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Add_Price, 2)}}" readonly />
                    @endif
                  </div>
                 </div>
              </div> <!-- endrow -->

              <div class="row">
                 <div class="col-md-5">
                  <div class="form-inline" align="right">
                    <label>ราคาทำสี :</label>
                    @if($datacar->Color_Price == '' OR $datacar->Color_Price == Null )
                    <input type="text" name="ColorCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                    @else
                    <input type="text" name="ColorCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Color_Price, 2)}}" readonly />
                    @endif
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-inline" align="right">
                    <label>ราคาขาย :</label>
                    @if($datacar->Net_Price == '' OR $datacar->Net_Price == Null )
                    <input type="text" name="NetCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                    @else
                    <input type="text" name="NetCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Net_Price, 2)}}" readonly />
                    @endif
                  </div>
                 </div>
              </div> <!-- endrow -->

              <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                      <label>ราคาซื้อ :</label>
                      @if($datacar->Fisrt_Price == '' OR $datacar->Fisrt_Price == Null )
                      <input type="text" name="PriceCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="" readonly />
                      @else
                      <input type="text" name="PriceCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Fisrt_Price, 2)}}" readonly />
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                      <label>ต้นทุนบัญชี :</label>
                      @if($datacar->Accounting_Cost == '' OR $datacar->Accounting_Cost == Null )
                      <input type="text" name="AccountingCost" class="form-control" style="width: 200px;" placeholder="ต้นทุนบัญชี" value="" readonly />
                      @else
                      <input type="text" name="AccountingCost" class="form-control" style="width: 200px;" placeholder="ต้นทุนบัญชี" value="{{number_format($datacar->Accounting_Cost, 2)}}" readonly />
                      @endif
                    </div>
                  </div>
              </div> <!-- endrow -->

              <hr>

              <div class="row">
                 <div class="col-md-5">
                  <div class="form-inline" align="right">
                    <label>ยี่ห้อรถ :</label>
                    <select name="BrandCar" class="form-control" style="width: 200px;" disabled>
                      @foreach ($arrayBrand as $key => $value)
                        <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-inline" align="right">
                     <label>เลขทะเบียน :</label>
                     <input type="text" name="RegistCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Number_Regist}}" readonly />
                  </div>
                 </div>
              </div> <!-- endrow -->

              <div class="row">
                <div class="col-md-5">
                   <div class="form-inline" align="right">
                     <label>ที่มาของรถ :</label>
                     <select name="OriginCar" class="form-control" style="width: 200px;" disabled>
                       @foreach ($arrayOriginType as $key => $value)
                         <option disabled value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                       @endforeach
                     </select>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="form-inline" align="right">
                      <label>Sale :</label>
                      <input type="text" name="SaleCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Name_Sale}}" readonly />
                   </div>
                </div>
              </div> <!-- endrow -->

              <div class="row">
                 <div class="col-md-5">
                  <div class="form-inline" align="right">
                    <label>ลักษณะรถ :</label>
                    <input type="text" name="ModelCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Model_Car}}" readonly />
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-inline" align="right">
                    <label>เลขไมล์ :</label>
                    <input type="text" name="MilesCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน"  value="{{number_format($datacar->Number_Miles)}}" readonly />
                   </div>
                 </div>
              </div> <!-- endrow -->

              <div class="row">
                <div class="col-md-5">
                   <div class="form-inline" align="right">
                     <label>รุ่นรถ :</label>
                     <input type="text" name="VersionCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Version_Car}}" readonly />
                   </div>
                </div>
                <div class="col-md-6">
                  <div class="form-inline" align="right">
                    <label>เกียร์รถ :</label>
                    <input type="text" name="Gearcar" class="form-control" style="width: 70px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Gearcar}}" readonly />
                    <label>ปีที่ผลิต :</label>
                    <input type="text" name="YearCar" class="form-control" style="width: 65px;" placeholder="ยังไม่ป้อน" value="{{$datacar->Year_Product}}" readonly />
                  </div>
                </div>
              </div> <!-- endrow -->

              <div class="row">
                 <div class="col-md-5">
                   <div class="form-inline" align="right">
                      <label>ขนาด :</label>
                      <input type="text" name="SizeCar" class="form-control" style="width: 175px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Size_Car}}" readonly />
                      <label>ซีซี</label>

                    </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-inline" align="right">
                     <label>สีรถ :</label>
                     <input type="text" name="ColorCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Color_Car}}" readonly />
                   </div>
                 </div>
              </div> <!-- endrow -->


              <div class="row">
                  <div class="col-md-5">
                    <div class="form-inline" align="right">
                      <label>Job Number :</label>
                      <input type="text" name="JobCar" class="form-control" style="width: 200px;" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Job_Number}}" readonly />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                      <label>สถานะ :</label>
                      <select name="Cartype" class="form-control" style="width: 200px;" disabled>
                        @foreach ($arrayCarType as $key => $value)
                          <option disabled value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div> <!-- endrow -->

              @if($datacar->BorrowStatus != Null)
              <hr>
              <h3 align="center"><b>ข้อมูลการยืม</b></h3>
              <div class="row">
                  <div class="col-md-5">
                     <div class="form-inline" align="right">
                         <label>วันที่ยืมรถ :</label>
                         <input type="date" id="DateBorrowcar" name="DateBorrowcar" class="form-control" style="width: 200px;" value="{{$datacar->Date_Borrowcar}}" readonly/>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-inline" align="right">
                         <label>ชื่อผู้ยืม :</label>
                         <input type="text" name="NameBorrow" class="form-control" style="width: 200px;" placeholder="ป้อนชื่อผู้ยืม" value="{{$datacar->Name_Borrow}}" readonly />
                     </div>
                  </div>
               </div> <!-- endrow -->

              <div class="row">
                  <div class="col-md-5">
                     <div class="form-inline" align="right">
                         <label>วันที่คืนรถ : </label>
                         <input type="date" id="DateReturncar" name="DateReturncar" class="form-control" style="width: 200px;" value="{{$datacar->Date_Returncar}}" readonly />
                     </div>

                     <div class="form-inline" align="right">
                           <label>สถานะการยืม : </label>
                           <select name="BorrowStatus" class="form-control" style="width: 200px;" disabled>
                             @foreach ($arrayBorrowStatus as $key => $value)
                               <option value="{{$key}}" {{ ($key == $datacar->BorrowStatus) ? 'selected' : '' }}>{{$value}}</option>
                             @endforeach
                           </select>
                     </div>
                 </div>

                 <div class="col-md-6">
                     <div class="form-inline" align="right">
                         <label style="vertical-align: top;">เหตุผลการยืม : &nbsp;</label>
                         <textarea type="text" name="NoteBorrow" class="form-control" rows="2" style="width: 200px;" readonly placeholder="ป้อนหมายเหตุ">{{ $datacar->Note_Borrow }}</textarea>
                     </div>
                     <div class="form-inline" align="right">

                           @php
                               date_default_timezone_set('Asia/Bangkok');
                               $Y = date('Y') + 543;
                               $m = date('m');
                               $d = date('d');
                               $ifdate = $Y.'-'.$m.'-'.$d;
                           @endphp

                             @if($ifdate > $datacar->Date_Borrowcar && $datacar->Date_Returncar == Null)
                               @php
                                 $Cldate = date_create($datacar->Date_Borrowcar);
                                 $nowCldate = date_create($ifdate);
                                 $ClDateDiff = date_diff($Cldate,$nowCldate);
                                 $duration = $ClDateDiff->format("%a วัน")
                               @endphp

                               <label>ระยะเวลายืม : &nbsp;</label>
                               <input type="text" class="form-control" style="width: 200px;color:red;" value="{{ $duration }}" readonly />
                             @elseif($datacar->Date_Returncar != Null)
                               @php
                                 $Cldate = date_create($datacar->Date_Borrowcar);
                                 $nowCldate = date_create($datacar->Date_Returncar);
                                 $ClDateDiff = date_diff($Cldate,$nowCldate);
                                 $duration = $ClDateDiff->format("%a วัน")
                               @endphp

                               <label>ระยะเวลายืม : &nbsp;</label>
                               <input type="text" class="form-control" style="width: 200px;color:green;" value="{{ $duration }}" readonly />
                             <!-- @elseif($datacar->create_date == $ifdate)
                               <font color="red">0 ปี 0 เดือน 0 วัน</font> -->
                             @endif

                           <!-- <label>ระยะเวลายืม : &nbsp;</label>
                           <input type="text" class="form-control" style="width: 250px;" value="{{ $duration }}" readonly /> -->

                     </div>
                  </div>

               </div> <!-- endrow -->
               @endif

              <hr>
              <h3 align="center"><b>เช็คเอกสารรถยนต์</b></h3>
              <div class="table-responsive">
              <table class="table table-bordered" id="table" style="width: 100%;" align="center">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" width="20%">สัญญาซื้อขาย</th>
                    <th class="text-center">คู่มือ</th>
                    <th class="text-center">กุญแจ</th>
                    <th class="text-center">ป้ายภาษี</th>
                    <th class="text-center">พ.ร.บ.</th>
                    <th class="text-center">ประกัน</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="ContractsCar" disabled value="complete"{{ ($datacar->Contracts_Car == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="ManualCar" disabled value="complete"{{ ($datacar->Manual_Car == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="KeyReserve" disabled value="complete" {{ ($datacar->Key_Reserve == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="ExpireTax" disabled value="complete" {{ ($datacar->Expire_Tax == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="ActCar" disabled value="complete" {{ ($datacar->Act_Car == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                    <th class="text-center">
                      <label class="con3">
                      <input type="checkbox" name="InsuranceCar" disabled value="complete" {{ ($datacar->Insurance_Car == "complete") ? 'checked' : '' }}>
                      <span class="checkmark3"></span>
                      </label>
                    </th>
                  </tr>
                </tbody>
              </table>
              </div>

              <div class="row">
                   <div class="col-md-5">
                     <div class="form-inline" align="right">
                       <label style="vertical-align: top;">หมายเหตุ :</label>
                       <textarea type="text" name="CheckNote" class="form-control" rows="3" style="width: 200px;"  readonly>{{ $datacar->Check_Note }}</textarea>
                     </div>
                   </div>
                   <div class="col-md-6">

                     <div class="form-inline" align="right">
                       <label>วันที่หมดอายุ ปชช :</label>
                       @if($datacar->Date_NumberUser == Null)
                       <input type="text" class="form-control" name="DateNumberUser" style="width: 200px;" readonly value="ป้อนวันที่หมดอายุ ปชช">
                       @else
                       <input type="text" class="form-control" name="DateNumberUser" style="width: 200px;" readonly value="{{date_format($Date_NumberUser, 'd-m-Y')}}">
                       @endif
                     </div>

                    <div class="form-inline" align="right">
                        <label>วันที่หมดอายุภาษี :</label>
                        @if($datacar->Date_Expire == Null)
                        <input type="text" class="form-control" name="DateNumberUser" style="width: 200px;" readonly value="ป้อนวันที่หมดอายุ ภาษี">
                        @else
                        <input type="text" class="form-control" name="DateExpire" style="width: 200px;" readonly value="{{date_format($Date_Expire, 'd-m-Y')}}">
                        @endif
                      </div>
                   </div>
              </div>

          @if($setcarType == 6)
              <hr>
              <h3 align="center"><b>ข้อมูลการขาย</b></h3>

              <div class="row">
                  <div class="col-md-5">
                     <div class="form-inline" align="right">
                       <label> วันที่ขาย :</label>
                        <input type="text" class="form-control" name="DateSoldoutplus" style="width: 200px;" value="{{ $Date_soldoutplus }}" readonly/>
                     </div>
                  </div>

                    <div class="col-md-6">
                      <div class="form-inline" align="right">
                        <label> วันที่เบิก :</label>
                         <input type="text" class="form-control" name="DateWithdraw" style="width: 200px;" value="{{ $Date_Withdraw }}" readonly  />
                      </div>
                    </div>

              </div> <!-- endrow -->


              <div class="row">
                 <div class="col-md-5">
                    <div class="form-inline" align="right">
                        <label>ราคาขาย :</label>
                        @if ($datacar->Net_Priceplus == '')
                        <input type="text" name="NetPriceplus" class="form-control" style="width: 200px;" placeholder="ป้อนราคาขาย" value="{{$datacar->Net_Priceplus}}" readonly />
                        @else
                        <input type="text" name="NetPriceplus" class="form-control" style="width: 200px;" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" readonly />
                        @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-inline" align="right">
                       <label>จำนวนเงิน :</label>
                       @if ($datacar->Amount_Price == '')
                       <input type="text" name="AmountPrice" class="form-control" style="width: 200px;" placeholder="ป้อนจำนวนเงิน" value="{{ $datacar->Amount_Price }}" readonly />
                       @else
                       <input type="text" name="AmountPrice" class="form-control" style="width: 200px;" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" readonly />
                       @endif
                    </div>
                  </div>
              </div> <!-- endrow -->

              <div class="row">
                <div class="col-md-5" >
                  <div class="form-inline" align="right">
                    <label>ประเภทการขาย :</label>
                    <select name="TypeSale" class="form-control" style="width: 200px;" disabled>
                      @foreach ($arrayTypeSale as $key => $value)
                        <option value="{{$key}}" {{ ($key == $datacar->Type_Sale) ? 'selected' : '' }}>{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                   <div class="form-inline" align="right">
                      <label>นายหน้า :</label>
                      <input type="text" name="NameAgent" class="form-control" style="width: 200px;" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent != '' ?$datacar->Name_Agent: 'ไม่มีข้อมูล'}}" readonly/>
                   </div>
                </div>
              </div> <!-- endrow -->

              <div class="row">
                <div class="col-md-5">
                   <div class="form-inline" align="right">
                     <label>ผู้ซื้อ :</label>
                     <input type="text" name="NameBuyer" class="form-control" style="width: 200px;" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $datacar->Name_Buyer !='' ?$datacar->Name_Buyer: 'ไม่มีข้อมูล'}}" readonly  />
                    </div>
                 </div>

                <div class="col-md-6">
                   <div class="form-inline" align="right">
                     <label>Sale ขาย : &nbsp;</label>
                     <input type="text" name="NameSaleplus" class="form-control" style="width: 200px;" placeholder="ป้อนชื่อ Sale ขาย" value="{{ $datacar->Name_Saleplus != '' ?$datacar->Name_Saleplus: 'ไม่มีข้อมูล'}}" readonly />
                    </div>
                 </div>
              </div> <!-- endrow -->
            @endif

              <input type="hidden" name="_method" value="PATCH"/>
            </div>
          </div>

          {{-- </div> --}}

        </div>

        <!-- /.box-body -->
        <div class="box-footer"></div>

      </div>
    </section>

    <script type="text/javascript">
      $(function(){
        $("#image-file").fileinput({
          theme:'fa',
        })
      })
    </script>
