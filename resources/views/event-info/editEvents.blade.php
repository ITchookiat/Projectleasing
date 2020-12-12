
{{-- Date Rang --}}
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
<script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

<style>
  #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    width: 150px;
    height: 100px;
  }
  #myImg:hover {opacity: 0.7;}
</style>

<form name="form1" method="post" action="{{ route('MasterEvents.update',$data->events_id) }}" enctype="multipart/form-data">
  @csrf
  @method('put')
    <div class="card card-warning">
      <div class="card-header">
        <h4 class="card-title">
          <i class="fas fa-calendar-day pr-2" style="color: rgba(245, 58, 58, 0.966)"></i>New Events
        </h4>
        <div class="card-tools">
          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER")
            <a href="{{ action('EventController@DeleteEvents',[$data->events_id, $data->title, 1]) }}" data-name="{{ $data->title }}" class="btn btn-danger btn-tool AlertForm" title="ลบรายการ">
              <i class="far fa-trash-alt"></i>
            </a>
            <button type="submit" class="btn btn-success btn-tool">
              <i class="fas fa-save"></i> Save
            </button>
          @endif
            <a class="btn btn-warning btn-tool" href="{{ route('MasterEvents.index') }}?type={{1}}">
            <i class="far fa-window-close"></i> Close
          </a>
        </div>
      </div>
      <div class="card-body text-sm">
        <div class="form-group mb-1">
          <label>Name Events or title :</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-highlighter"></i>
              </span>
            </div>
            <input type="text" name="title" value="{{$data->title}}" class="form-control float-right form-control-sm" required/>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group mb-1">
              <label>Start and End:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" name="DateRage" id="reservation" value="{{$data->start_date}} - {{$data->end_date}}" class="form-control float-right form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group mb-1">
              <label>color :</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-palette"></i>
                  </span>
                </div>
                <input type="color" name="color" value="{{$data->color}}" class="form-control float-right form-control-sm" required/>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group mb-1">
          <label>Note :</label>
          <div class="input-group">
            <textarea name="Note" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="3">{{$data->Note_events}}</textarea>
          </div>
        </div>

        <div class="form-group mb-1">
          <label>Upload Images :</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="image_Event[]" class="custom-file-input" id="image_Event" multiple>
              <label class="custom-file-label" for="1">เลือกไฟล์ที่ต้องการ</label>
            </div>
          </div>
        </div>

        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
              รูปภาพผู้เช่าซื้อ
            </div>
            <div class="card-tools">
              @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER")
                <button href="{{ action('EventController@DeleteEvents',[$data->events_id, $data->title, 2]) }}" data-name="{{ $data->title }}" style="color: white;" class="btn btn-primary btn-tool DeleteImage" title="ลบรูปภาพทั้งหมด">
                  <i class="far fa-trash-alt"></i>
                </button>
              @endif
            </div>
          </div>
          
          <div class="card-body">
            <div class="row">
              @foreach($image as $key => $items)
                <div class="col-sm-3">
                  <a href="{{ asset('upload-Events/'.$data->title.'/'.$items->Name_fileimage) }}" class="MagicZoom" data-gallery="gallery" data-options="hint:true; zoomMode:magnifier;">
                    <img id="myImg" src="{{ asset('upload-Events/'.$data->title.'/'.$items->Name_fileimage) }}">
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>

      </div>
    </div>
  <input type="hidden" name="type" value="1"/>
  <input type="hidden" name="_method" value="PATCH"/>
</form>

{{-- Date Rang --}}
<script type="text/javascript">
  $('input[name="DateRage"]').daterangepicker({
    timePicker: true,
    timePicker24Hour: true,
    timePickerIncrement: 30,
    locale: {
      format: 'YYYY-MM-DD'
    }
  })
</script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>

<script type="text/javascript">
 $(document).ready(function () {
    $('.DeleteImage').click(function (evt) {
        var form = $(this).closest("form");
        var _this = $(this)

        evt.preventDefault();
        swal({
          icon: "error",
          title: "ต้องการลบรูปภาพทั้งหมดหรือไม่ ?",
          text: "หากลบแล้วจะไม่สามารถดึงข้อมูลกลับมาได้อีก !",
          buttons: true,
          dangerMode: true
        }).then((willDelete)=>{
          if (willDelete) {
              swal("ลบข้อมูลสำเร็จ !", {
                  icon: "success",
                  timer: 3000,
              })
              window.location.href = _this.attr('href')
          }
      });
    });

    $('.AlertForm').click(function (evt) {
      var Contract_buyer = $(this).data("name");
      var form = $(this).closest("form");
      var _this = $(this)
      
      evt.preventDefault();
      swal({
          title: `${Contract_buyer}`,
          icon: "warning",
          text: "คุณต้องการยืนยันการลบหรือไม่ ?",
          buttons: true,
          dangerMode: true,
      }).then((isConfirm)=>{
          if (isConfirm) {
              swal("ลบข้อมูลสำเร็จ !", {
                  icon: "success",
                  timer: 3000,
              })
              window.location.href = _this.attr('href')
          }
      });
    });
 });
</script>
