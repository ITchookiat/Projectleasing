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

                  <script>
                      function addCommas(nStr){
                         nStr += '';
                         x = nStr.split('.');
                         x1 = x[0];
                         x2 = x.length > 1 ? '.' + x[1] : '';
                         var rgx = /(\d+)(\d{3})/;
                         while (rgx.test(x1)) {
                           x1 = x1.replace(rgx, '$1' + ',' + '$2');
                          }
                        return x1 + x2;
                      }

                      function comma(){
                        var num11 = document.getElementById('NetPriceplus').value;
                        var num1 = num11.replace(",","");
                        var num22 = document.getElementById('AmountPrice').value;
                        var num2 = num22.replace(",","");
                        var num33 = document.getElementById('DownPrice').value;
                        var num3 = num33.replace(",","");
                        var num44 = document.getElementById('TransferPrice').value;
                        var num4 = num44.replace(",","");
                        var num55 = document.getElementById('SubdownPrice').value;
                        var num5 = num55.replace(",","");
                        var num66 = document.getElementById('InsurancePrice').value;
                        var num6 = num66.replace(",","");

                        var expense = parseFloat(num6) + parseFloat(num4);
                        var topcar = parseFloat(num1) - (parseFloat(num3) + parseFloat(expense));

                        document.form1.NetPriceplus.value = addCommas(num1);
                        document.form1.AmountPrice.value = addCommas(num2);
                        document.form1.DownPrice.value = addCommas(num3);
                        document.form1.TransferPrice.value = addCommas(num4);
                        document.form1.SubdownPrice.value = addCommas(num5);
                        document.form1.InsurancePrice.value = addCommas(num6);
                        if(!isNaN(topcar)){
                        document.form1.TopcarPrice.value = addCommas(topcar);
                        }
                      }
                  </script>

                  <div class="row">
                      <div class="col-md-6">
                         <div class="form-inline form-group" align="right">
                           <label> วันที่ขาย :</label>
                            <input type="date" class="form-control" name="DateSoldoutplus" style="width: 220px;"  min="{{ $date2 }}" value="{{ $datacar->Date_Soldout_plus }}" />
                         </div>
                      </div>

                        <div class="col-md-5">
                          <div class="form-inline form-group" align="right">
                            <label> วันที่เบิก :</label>
                             <input type="date" class="form-control" name="DateWithdraw" style="width: 220px;" min="{{ $date2 }}" value="{{ $datacar->Date_Withdraw }}"  />
                          </div>
                        </div>

                  </div> <!-- endrow -->

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-inline form-group" align="right">
                            <label>ราคาขาย :</label>
                            <input type="text" id="NetPriceplus" name="NetPriceplus" class="form-control" style="width: 220px;" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" oninput="comma();" />
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-inline form-group" align="right">
                           <label>จำนวนเงิน :</label>
                           <input type="text" id="AmountPrice" name="AmountPrice" class="form-control" style="width: 220px;" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" oninput="comma();" />
                        </div>
                      </div>
                  </div> <!-- endrow -->

                  <div class="row">
                    <div class="col-md-6" >
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

                    <div class="col-md-5">
                       <div class="form-inline form-group" align="right">
                          <label>นายหน้า :</label>
                          <input type="text" name="NameAgent" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent }}"/>
                       </div>
                    </div>
                  </div> <!-- endrow -->

                  <div class="row">

                     <div class="col-md-6">
                        <div class="form-inline form-group" align="right">
                          <label>ผู้ซื้อ :</label>
                          <input type="text" name="NameBuyer" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $datacar->Name_Buyer }}"  />
                          </div>
                      </div>

                      <div class="col-md-5">
                         <div class="form-inline form-group" align="right">
                           <label>Sale ขาย :</label>
                           <input type="text" name="NameSaleplus" class="form-control" style="width: 220px;" placeholder="ป้อนชื่อ Sale ขาย" value="{{ $datacar->Name_Saleplus }}" />
                           </div>
                       </div>
                  </div> <!-- endrow -->
                  <hr>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-inline form-group" align="right">
                          <label>เงินดาวน์ :</label>
                          <input type="text" id="DownPrice" name="DownPrice" class="form-control" style="width: 220px;" placeholder="ป้อนเงินดาวน์" value="{{number_format($datacar->Down_Price,2) }}" oninput="comma();"/>
                          </div>
                      </div>

                      <div class="col-md-5">
                         <div class="form-inline form-group" align="right">
                           <label>ค่าใช้จ่ายโอน :</label>
                           <input type="text" id="TransferPrice" name="TransferPrice" class="form-control" style="width: 220px;" placeholder="ป้อนค่าใช้จ่ายโอน" value="{{ number_format($datacar->Transfer_Price,2) }}" oninput="comma();"/>
                           </div>
                       </div>
                  </div> <!-- endrow -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-inline form-group" align="right">
                          <label>ซับดาวน์ :</label>
                          <input type="text" id="SubdownPrice" name="SubdownPrice" class="form-control" style="width: 220px;" placeholder="ป้อนซับดาวน์" value="{{ number_format($datacar->Subdown_Price,2) }}" oninput="comma();"/>
                          </div>
                      </div>

                      <div class="col-md-5">
                         <div class="form-inline form-group" align="right">
                           <label>ค่าประกัน :</label>
                           <input type="text" id="InsurancePrice" name="InsurancePrice" class="form-control" style="width: 220px;" placeholder="ป้อนค่าประกัน" value="{{ number_format($datacar->Insurance_Price,2) }}" oninput="comma();"/>
                           </div>
                       </div>
                  </div> <!-- endrow -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-inline form-group" align="right">

                          </div>
                      </div>

                      <div class="col-md-5">
                         <div class="form-inline form-group" align="right">
                           <label>ยอดจัด :</label>
                           <input type="text" id="TopcarPrice" name="TopcarPrice" class="form-control" style="width: 220px;" placeholder="ป้อนยอดจัด" value="{{ number_format($datacar->Topcar_Price,2) }}" oninput="comma();"/>
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
