@extends('layouts.master')
@section('title','infomation')
@section('content')

  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    
  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-sm-6">
            <h4>เพิ่มข่าวสาร (New Informations)</h4>
          </div>
          <div class="col-sm-6">

          </div>
        </div>
      </div>
    </div>

    <form name="form1" action="{{ route('MasterInfo.store') }}" method="post" id="forminfo" enctype="multipart/form-data">
      @csrf
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-pager pr-1" style="color: rgb(252, 113, 0)"></i>
              Create Contents
            </h3>
            <div class="card-tools">
              <button type="submit" class="btn btn-success btn-tool">
                <i class="fas fa-save"></i> Save
              </button>
              <a class="btn btn-danger btn-tool" href="{{ route('MasterEvents.index') }}?type={{1}}">
                <i class="far fa-window-close"></i> Close
              </a>
            </div>
          </div>

          <div class="card-body text-sm p-2">
            <div class="row">
              <div class="col-10">
                <div class="form-group mb-1">
                  <label>Name Contents :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-highlighter"></i>
                      </span>
                    </div>
                    <input type="text" name="nameContents" class="form-control float-right form-control-sm" placeholder="ชื่อข่าวสาร" required/>
                  </div>
                </div>
                <div class="form-group mb-1">
                  <label>Start and End :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" name="DateRage" class="form-control float-right form-control-sm" id="dateRangInfo" required>
                  </div>
                </div>
              </div>
              <div class="col-2">
                <div class="form-group mb-1">
                  <label>Status :</label>
                  <div class="input-group">
                    <input type="checkbox" name="Status" value="Public" data-toggle="switchbutton" checked data-size="sm" data-onlabel="<i class='fas fa-book-reader pr-1'></i> Public" data-offlabel="<i class='fas fa-bell-slash pr-1'></i> Private" data-onstyle="success" data-offstyle="danger">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group mb-1">
              <label>Notes :</label>
              <div class="input-group">
                <textarea name="Note" class="form-control form-control-sm" placeholder="คำอธิบายสั้นๆ..." rows="3"></textarea>
              </div>
            </div>

            <textarea name="messageInput" class="summernote"></textarea>
          </div>
        </div>

      <input type="hidden" name="type" value="1" />
      <input type="hidden" name="_token" value="{{csrf_token()}}" />
    </form>
  </section>

  {{-- Date Rang --}}
  <script type="text/javascript">
    $('#dateRangInfo').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD'
      }
    })
  </script>

  {{-- summernote --}}
  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
  </script>
  
@endsection
