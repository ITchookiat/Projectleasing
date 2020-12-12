@extends('layouts.master')
@section('title','infomation')
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="content-header p-1">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif
    </div>

    <div class="card">
      <div class="card-header ui-sortable-handle">
        <h3 class="card-title">
          <i class="far fa-newspaper fa-lg pr-2" style="color: rgb(252, 113, 0)"></i>
          <strong>ข่าวสารใหม่ (New Informations)</strong>
        </h3>
        <div class="card-tools">
          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
            <button type="button" class="btn btn-warning btn-sm" onclick="myFunction()">
              <i class="fas fa-edit"></i> Edit
            </button>

            <form method="post" class="delete_form" action="{{ route('MasterInfo.destroy',$item->Info_id) }}" style="display:inline;">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="type" value="1" />
              <button type="submit" data-name="{{ $item->name_info }}" class="btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                <i class="far fa-trash-alt"></i> Delete
              </button>
            </form>
          @endif

          @if($type == 1)
            <a class="btn btn-primary btn-sm" href="{{ route('MasterEvents.index') }}?type={{1}}">
              <i class="fas fa-caret-square-left"></i> Back
            </a>
          @elseif($type == 2)
            <a class="btn btn-primary btn-sm" href="{{ route('MasterEvents.index') }}?type={{2}}">
              <i class="fas fa-caret-square-left"></i> Back
            </a>
          @endif
        </div>
      </div>
      <div class="card-body">
        <div class="container" id="ShowPublic" style="display: show;">
          @php
            $SetSDate = date('d-m-Y', strtotime($item->SDate_info));
            $SetEDate = date('d-m-Y', strtotime($item->EDate_info));
          @endphp
          <span class="badge badge-danger float-right">
            <i class="far fa-clock"></i> {{$SetSDate}} - {{$SetEDate}}
          </span>
          
          <div class="mb-0">
            <u><h1 class="text-dark">{{$item->name_info}}</h1></u>
          </div>
          <P>{{$item->Notes_info}}</P>
          {!! str_replace('i-hear-too/', asset(''), $item->content_info) !!}
        </div>

        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
          <div id="ShowPrivate" style="display: none;">
            <form name="form1" method="post" action="{{ route('MasterInfo.update',$item->Info_id) }}" enctype="multipart/form-data" >
              @csrf
              @method('put')
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit"></i>&nbsp; Edit Informations</h3>
                    <div class="card-tools">
                      <button type="submit" class="btn btn-success btn-tool">
                        <i class="fas fa-save"></i> Update
                      </button>
                    </div>
                  </div>
                  <div class="card-body text-sm p-2">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group mb-1">
                          <label>Name Contents :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fas fa-highlighter"></i>
                              </span>
                            </div>
                            <input type="text" name="nameContents" class="form-control float-right form-control-sm" value="{{$item->name_info}}"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group mb-1">
                          <label>Start and End :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" name="dateRangInfo" class="form-control float-right form-control-sm" id="dateRangInfo" value="{{$item->SDate_info}} - {{$item->EDate_info}}">
                          </div>
                        </div>
                      </div>
                    </div>
      
                    <div class="form-group mb-1">
                      <label>Notes :</label>
                      <div class="input-group">
                        <textarea name="Note" class="form-control form-control-sm" placeholder="คำอธิบายสั้นๆ..." rows="3">{{$item->Notes_info}}</textarea>
                      </div>
                    </div>
      
                    <textarea name="messageInput" class="summernote">{{str_replace('i-hear-too/', asset(''), $item->content_info)}}</textarea>
                  </div>
                </div>
              <input type="hidden" name="type" value="1"/>
              <input type="hidden" name="_method" value="PATCH"/>
            </form>
          </div>
        @endif
      </div>
    </div>
  </section>

  <script>
    function myFunction() {
      var private = document.getElementById("ShowPrivate");
      var public = document.getElementById("ShowPublic");

      if (private.style.display === "none") {
        private.style.display = "block";
        public.style.display = "none";
      } else {
        private.style.display = "none";
        public.style.display = "block";
      }
    }
  </script>
  
  {{-- summernote --}}
  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
  </script>

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
@endsection

