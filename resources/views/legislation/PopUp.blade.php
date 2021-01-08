<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        @if($type == 1)
          ค้นหารายชื่อ
        @endif
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="card-body text-sm">
      @if($type == 1)
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">ฐานลูกหนี้ : </label>
              <div class="col-sm-9">
                <select name="DB_type" id="DB_type" class="form-control" style="color: red" required>
                  <option value="" selected>--------- เลือกฐานข้อมูล ---------</option>
                  <option value="1">ลูกหนี้ฟ้อง</option>
                  <option value="2">ลูกหนี้ประนอมหนี้</option>
                </select>
              </div>
            </div>
          </div> 
          <div class="col-6">
            <div class="card-tools d-inline float-right">
              <div class="input-group form-inline">
                <label>เลขที่สัญญา : &nbsp;&nbsp;</label>
                <input type="type" name="Contno" id="Contno" maxlength="12" class="form-control" data-inputmask="&quot;mask&quot;:&quot;99-9999/9999&quot;" data-mask="" required/>
                <span class="input-group-append">
                  <button type="button" class="btn btn-warning button">
                    <i class="fas fa-search"></i>
                  </button>
                </span>
              </div>
            </div>      
          </div>   
        </div>
        <hr>
      @endif   
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div id="LegisData"></div>
    </div>
  </div>
</section>

<script>
  $(function () {
      $('[data-mask]').inputmask()
  })
</script>

<script type="text/javascript">
  $(".button").click(function(ev){
      var DB_type = $('#DB_type').val();
      var Contno = $('#Contno').val();
      var _token = $('input[name="_token"]').val();

    if (Contno != '') {
      console.log(DB_type,Contno);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url:"{{ route('legislation.SearchData', 1) }}",
        method:"POST",
        data:{DB_type:DB_type,Contno:Contno,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          console.log(result);
          $('#LegisData').html(result);
        }
      })
    }
  });
</script>

