@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 531;
  $m = date('m');
  $d = date('d');

  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

<section class="content">
  <div class="card card-warning text-sm">
    <div class="card-header">
      <h5 class="card-title">เพิ่มรายการชำระ (New Payment)</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <form name="form2" action="{{ route('legislation.store',[$id, $type]) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <script>
          function adds(nStr){
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

          function sperate(){
            var input = document.getElementById('GoldPayment').value,   //ค่างวดรับชำระ
                inputCut = input.replace(",",""),
                def = document.getElementById('DuePrice').value,        //ค่างวดจากระบบ
                state = 0;
                round = Math.floor(inputCut/def);
            
            for (var i = 1; i <= round; i++) {
              input -= def;
              state = 31 * i;
              // console.log(i, def, state);
            }
            if (round == 0) {
              if (input > 0) {
                state += 31;
                // console.log(i, input, state);
              }
              
            }

            var DatePay = document.getElementById('Datepay').value,
                Setdate = new Date(DatePay);
                NewDatePay = DatePay.substring(DatePay.length - 2, DatePay.length)
            // console.log(inputCut);   

            Setdate.setDate(Setdate.getDate() + state);

              var dd = Setdate.getDate(),
                  mm = Setdate.getMonth() + 1,
                  yyyy = Setdate.getFullYear();


                // if (dd < 10) {
                //   var Newdd = '0' + dd;
                // }else {
                //   var Newdd = dd;
                // }
                var Newdd = NewDatePay;
                if (mm < 10) {
                  var Newmm = '0' + mm;
                }else {
                  var Newmm = mm;
                }
            var result = yyyy + '-' + Newmm + '-' + Newdd;
            // console.log(result);

            var SetTypePayment = document.getElementById('TypePayment').value;
            console.log(SetTypePayment);


            document.form2.GoldPayment.value = adds(inputCut);
            if(SetTypePayment == "เงินก้อนแรก(เงินสด)" || SetTypePayment == "เงินก้อนแรก(เงินโอน)"){
              document.getElementById('DatePayment').value = DatePay;
            }else{
              document.getElementById('DatePayment').value = result;
            }
          }
        </script>

        @if($data != NULL)
          <input type="hidden" id="Datepay" name="Datepay" class="form-control form-control-sm" value="{{ $data->Date_Payment }}"/>
          <input type="hidden" id="DuePrice" name="DuePrice" class="form-control form-control-sm" value="{{ $data->DuePay_Promise }}"/>
        @else
          <input type="hidden" id="Datepay" name="Datepay" class="form-control form-control-sm" value="{{ date('Y-m-d') }}"/>
          <input type="hidden" id="DuePrice" name="DuePrice" class="form-control form-control-sm" value="{{$dataPranom->DuePay_Promise}}"/>
        @endif

        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">วันที่ : </label>
              <div class="col-sm-8">
                <input type="date" id="DatePayment" name="DatePayment" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" readonly/>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-4 col-form-label text-right">ประเภทชำระ : </label>
              <div class="col-sm-8">
                <select id="TypePayment" name="TypePayment" class="form-control form-control-sm" oninput="sperate();" required>
                  <option value="" selected>--- ประเภทชำระ ---</option>
                  <option value="ชำระเงินสด">ชำระเงินสด</option>
                  <option value="ชำระผ่านโอน">ชำระผ่านโอน</option>
                  <option value="ชำระผ่านธนานัติ">ชำระผ่านธนานัติ</option>
                  <option value="เงินก้อนแรก(เงินสด)">เงินก้อนแรก(เงินสด)</option>
                  <option value="เงินก้อนแรก(เงินโอน)">เงินก้อนแรก(เงินโอน)</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">ยอดชำระ : </label>
              <div class="col-sm-8">
                <input type="text" name="GoldPayment" id="GoldPayment" class="form-control form-control-sm" oninput="sperate();" maxlength="7"/>
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-4 col-form-label text-right">หมายเหตุ : </label>
              <div class="col-sm-8">
                <input type="text" name="NotePayment" class="form-control form-control-sm"/>
                <input type="hidden" name="AdduserPayment" class="form-control form-control-sm" value="{{ Auth::user()->name }}"/>
                <input type="hidden" name="FlagPayment" class="form-control form-control-sm" value="Y"/>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-center">
        <button type="submit" class="btn btn-app" style="background-color:#189100; color:#FFFFFF;">
          <i class="fas fa-save"></i> Save
        </button>
        <a class="btn btn-app" href="{{ action('LegislationController@edit',[$id, 4]) }}" style="background-color:#DB0000; color:#FFFFFF;">
          <i class="fas fa-times"></i> ยกเลิก
        </a>
      </div>
      <input type="hidden" name="_token" value="{{csrf_token()}}" />
    </form>
  </div>
</section>