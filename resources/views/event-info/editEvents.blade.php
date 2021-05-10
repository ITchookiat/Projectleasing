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
          <i class="fas fa-calendar-day pr-2" style="color: rgba(245, 58, 58, 0.966)"></i>Update Events
        </h4>
        <div class="card-tools">
          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
            <a href="{{ action('EventController@DeleteEvents',[$data->events_id, $data->title, 1]) }}" data-name="{{ $data->title }}" class="btn btn-danger btn-tool AlertForm" title="ลบรายการ">
              <i class="far fa-trash-alt text-danger"></i>
            </a>
            <button type="submit" class="btn btn-success btn-tool">
              <i class="fas fa-save"></i> Update
            </button>
          @elseif(auth::user()->position == "MASTER")
            @if($data->Branch_user == auth::user()->branch)
            <a href="{{ action('EventController@DeleteEvents',[$data->events_id, $data->title, 1]) }}" data-name="{{ $data->title }}" class="btn btn-danger btn-tool AlertForm" title="ลบรายการ">
              <i class="far fa-trash-alt text-danger"></i>
            </a>
            <button type="submit" class="btn btn-success btn-tool">
              <i class="fas fa-save"></i> Update
            </button>
            @endif
          @endif
            <a class="btn btn-danger btn-tool" href="{{ route('MasterEvents.index') }}?type={{1}}">
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
                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                <input type="color" name="color" value="{{$data->color}}" class="form-control float-right form-control-sm" required/>
                @else
                  <input type="color" value="{{$data->color}}" class="form-control float-right form-control-sm" disabled/>
                  @if(auth::user()->position == "MASTER" and auth::user()->branch == "01")
                    <input type="hidden" name="color" value="{{$data->color}}"/>
                  @elseif(auth::user()->position == "MASTER" and auth::user()->branch == "03")
                    <input type="hidden" name="color" value="{{$data->color}}"/>
                  @elseif(auth::user()->position == "MASTER" and auth::user()->branch == "04")
                    <input type="hidden" name="color" value="{{$data->color}}"/>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group mb-1">
              <label>Note :</label>
              <div class="input-group mb-3">
                <textarea name="Note" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="10">{{$data->Note_events}}</textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">

            <!-- <div class="form-group mb-1">
              <label>Upload Images :</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="image_Event[]" class="custom-file-input" id="image_Event" multiple>
                  <label class="custom-file-label" for="1">เลือกไฟล์ที่ต้องการ</label>
                </div>
              </div>
            </div> -->

            <div class="card">
              <div class="card-header" style="background-color:{{$data->color}}">
                <div class="card-title">
                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER")
                  @if($data->Branch_user == auth::user()->branch or auth::user()->type == "Admin")
                  <button href="{{ action('EventController@DeleteEvents',[$data->events_id, $data->title, 2]) }}" data-name="{{ $data->title }}" style="color: white;" class="btn btn-primary btn-tool DeleteImage" title="ลบรูปภาพทั้งหมด">
                    <i class="far fa-trash-alt text-danger"></i>
                  </button>
                  @endif
                @endif
                Upload Images :
                </div>
                <div class="card-tools">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image_Event[]" class="custom-file-input" id="image_Event" multiple>
                      <label class="custom-file-label" for="1">เลือกรูปที่จะอัพโหลด</label>
                    </div>
                  </div>
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

        <div class="row">
          <div class="col-12">

            <div class="card card-warning">
              <div class="card-header" style="background-color:{{$data->color}}">
                <div class="card-title">
                  Upload Files :
                </div>
                <div class="card-tools">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="fileEvent[]" class="custom-file-input" id="exampleInputFile" multiple>
                      <label class="custom-file-label" for="exampleInputFile">เลือกไฟล์ที่จะอัพโหลด</label>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-striped table-valign-middle" id="table1">
                        <thead>
                          <tr>
                              <th class="text-center"  style="width: 50px;">No.</th>
                              <th class="text-left">File Name</th>
                              <th class="text-center">Date Upload</th>
                              <th class="text-right">#</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($file as $key => $row)
                              <tr>
                                <td class="text-center"> {{$key+1}}</td>
                                <td class="text-left"> 
                                  &nbsp;{{$row->Name_fileimage}}
                                </td>
                                <td class="text-center">
                                  &nbsp;{{DateThai(substr($row->created_at,0,10))}}
                                </td>
                                <td class="text-right">
                                  <a href="{{ action('EventController@download',[$row->Name_fileimage])}}?foldername={{$data->title}}" class="btn btn-info" title="ดาวน์โหลดไฟล์">
                                    <i class="fas fa-download"></i>
                                  </a>
                                  @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER")
                                    <button href="{{ action('EventController@DeleteEvents',[$row->fileimage_id, $data->title, 3]) }}" data-name="{{ $row->Name_fileimage }}" style="color: white;" class="btn btn-danger DeleteImage AlertForm" title="ลบไฟล์">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
      // var Contract_buyer = $(this).data("name");
      // var form = $(this).closest("form");
      var _this = $(this)
      
      evt.preventDefault();
      swal({
          title: "ต้องการไฟล์นี้หรือไม่",
          icon: "warning",
          text: "คุณต้องการยืนยันการลบหรือไม่ ?",
          buttons: true,
          dangerMode: true,
      }).then((isConfirm)=>{
          // if (isConfirm) {
          //     swal("ลบข้อมูลสำเร็จ !", {
          //         icon: "success",
          //         timer: 3000,
          //     })
          // }
              window.location.href = _this.attr('href')
      });
    });
 });
</script>
