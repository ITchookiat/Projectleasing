  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $Y2 = date('Y') + 542;
    $m = date('m');
    $d = date('d');
    //$date = date('Y-m-d');
    $time = date('H:i');
    $date = $Y.'-'.$m.'-'.$d;
    $date2 = $Y2.'-'.'01'.'-'.'01';
  @endphp

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <style>
   readonly{
     background-color: #FFFFFF;
   }
  </style>

    <section class="content">

      <div class="panel panel-success">
        <div class="panel-heading" id="hidden" align="center">
          <font size="4px">เพิ่มข้อมูลขาย</font>
            <!-- <a class="text-red pull-right" href="{{ URL::previous() }}"><font size="5px"> ปิด </font> </a> -->
        </div>
        <div class="box-body">

          <form name="form1" method="post" action="{{ action('DatacarController@updateinfo',$id) }}" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12"> <br />
                  @csrf
                  @method('put')

                  <div class="row">
                      <div class="col-md-5">
                         <div class="form-inline form-group" align="right">
                           <label> วันที่ขาย :</label>
                            <input type="date" class="form-control" name="DateSoldoutplus" style="width: 220px;"  min="{{ $date2 }}" value="{{ $datacar->Date_Soldout_plus }}" />
                         </div>
                      </div>

                        <div class="col-md-6">
                          <div class="form-inline form-group" align="right">
                            <label> วันที่เบิก :</label>
                             <input type="date" class="form-control" name="DateWithdraw" style="width: 220px;" min="{{ $date2 }}" value="{{ $datacar->Date_Withdraw }}"  />
                          </div>
                        </div>

                  </div> <!-- endrow -->

                  <div class="row">
                     <div class="col-md-5">
                        <div class="form-inline form-group" align="right">
                            <label>ราคาขาย :</label>
                            <input type="text" name="NetPriceplus" class="form-control" style="width: 220px;" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" />
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-inline form-group" align="right">
                           <label>จำนวนเงิน :</label>
                           <input type="text" name="AmountPrice" class="form-control" style="width: 220px;" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" />
                        </div>
                      </div>
                  </div> <!-- endrow -->

                  <div class="row">
                    <div class="col-md-5" >
                      <div class="form-inline form-group" align="right">
                        <label>ประเภทการขาย :</label>
                        <select name="TypeSale" class="form-control" style="width: 220px;">
                            <option value="" selected>---เลือกประเภท---</option>
                          @foreach ($arrayTypeSale as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Type_Sale) ? 'selected' : '' }}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                       <div class="form-inline form-group" align="right">
                          <label>นายหน้า :</label>
                          <input type="text" name="NameAgent" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent }}"/>
                       </div>
                    </div>
                  </div> <!-- endrow -->

                  <div class="row">

                     <div class="col-md-5">
                        <div class="form-inline form-group" align="right">
                          <label>ผู้ซื้อ :</label>
                          <input type="text" name="NameBuyer" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $datacar->Name_Buyer }}"  />
                          </div>
                      </div>

                      <div class="col-md-6">
                         <div class="form-inline form-group" align="right">
                           <label>Sale ขาย :</label>
                           <input type="text" name="NameSaleplus" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อ Sale ขาย" value="{{ $datacar->Name_Saleplus }}" />
                           </div>
                       </div>
                  </div> <!-- endrow -->
                  <br>
                  <div class="box-footer">
                    <div class="form-group" align="center">
                      <button type="submit" class="delete-modal btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                      </button>
                      <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                        <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                      </a>
                     </div>
                    <input type="hidden" name="_method" value="PATCH"/>
                    </div>

                </div>
              </div>
          </form>

        </div>
      </div>

    </section>

    <script>
          $(".alert").fadeTo(3000, 500).slideUp(500, function(){
          $(".alert").alert('close');
          });;
        </script>
    <script type="text/javascript">
      $(function(){
        $("#image-file").fileinput({
          theme:'fa',
        })
      })
    </script>
