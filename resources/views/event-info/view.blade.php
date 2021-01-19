@extends('layouts.master')
@section('title','infomation')
@section('content')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

  <style>
    span:hover {
      color: blue;
    }
  </style>

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
            <h4>กิจกรรมและข่าวสาร (Events and Information)</h4>
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">New Information</h3>
              <div class="card-tools">
                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                  <a href="{{ route('MasterInfo.create') }}" class="btn btn-warning btn-tool" title="เพิ่มข่าวสาร">
                    <i class="fas fa-pager pr-1"></i> New
                  </a>
                @else
                  <a href="#" class="btn btn-warning btn-tool" title="เพิ่มข่าวสาร">
                    <i class="fas fa-pager pr-1"></i> New
                  </a>
                @endif
              </div>
          </div>

          {{-- <div class="card-body">
            <div class="direct-chat-messages">
              <div class="direct-chat-msg">
                @foreach($Info as $row)
                  <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-0 pr-0">
                      <li class="item">
                        <div class="product-img">
                          <img src="{{ asset('dist/img/info.png') }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                          @php
                            $SetSDate = date('d-m-Y', strtotime($row->SDate_info));
                            $SetEDate = date('d-m-Y', strtotime($row->EDate_info));
                          @endphp
                          <a href="{{ route('MasterInfo.show',$row->Info_id) }}?type={{1}}" class="product-title">{{$row->name_info}}
                            <span class="badge badge-danger float-right prem" title="{{$SetSDate}} - {{$SetEDate}}">New</span></a>
                          <span class="product-description text-sm">
                            {{$row->Notes_info}}
                          </span>
                        </div>
                      </li>
                    </ul>
                  </div>
                @endforeach
              </div>
            </div>
          </div> --}}
          @foreach($Info as $row)
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <li class="item">
                  <div class="product-img">
                    <img src="{{ asset('dist/img/info.png') }}" alt="Product Image" class="img-size-50">
                  </div>
                  <div class="product-info">
                    @php
                      $SetSDate = date('d-m-Y', strtotime($row->SDate_info));
                      $SetEDate = date('d-m-Y', strtotime($row->EDate_info));
                    @endphp
                    <a href="{{ route('MasterInfo.show',$row->Info_id) }}?type={{1}}" class="product-title">{{$row->name_info}}
                      <span class="badge badge-danger float-right prem" title="{{$SetSDate}} - {{$SetEDate}}">New</span></a>
                    <span class="product-description text-sm">
                      {{$row->Notes_info}}
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          @endforeach
          <div class="card-footer text-center">
            <a href="{{ route('MasterInfo.index') }}" class="uppercase">View All Informations</a>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Events Chookiat Leasing</h3>
              <div class="card-tools">
                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER")
                  <button type="button" class="btn btn-danger btn-tool" data-toggle="modal" data-target="#modal-AddEvent" data-backdrop="static" data-keyboard="false">
                    <i class="fas fa-calendar-plus pr-1"></i> New Events
                  </button>
                @else
                  <button type="button" class="btn btn-danger btn-tool">
                    <i class="fas fa-calendar-plus pr-1"></i> New Events
                  </button>
                @endif
              </div>
            </div>
            <div class="card-body">
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Popup Add Events -->
    <form name="form1" action="{{ route('MasterEvents.store') }}" method="post" id="formEvent" enctype="multipart/form-data">
      @csrf
      <div class="modal fade" id="modal-AddEvent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <div class="card card-warning">
                <div class="card-header">
                  <h4 class="card-title">
                    <i class="fas fa-calendar-day pr-2" style="color: rgba(245, 58, 58, 0.966)"></i> New Events
                  </h4>
                  <div class="card-tools">
                    <button type="submit" class="btn btn-success btn-tool">
                      <i class="fas fa-save"></i> Save
                    </button>
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
                      <input type="text" name="title" class="form-control float-right form-control-sm" placeholder="ชื่อกิจกรรม" required/>
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
                          <input type="text" name="DateRage" class="form-control float-right form-control-sm" id="reservation" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group mb-1">
                        <label>colors :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="fas fa-palette"></i>
                            </span>
                          </div>
                          <input type="color" name="color" class="form-control float-right form-control-sm" required/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-1">
                    <label>Notes :</label>
                    <div class="input-group">
                      <textarea name="Note" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="3"></textarea>
                    </div>
                  </div>

                  <div class="form-group mb-1">
                    <label>Upload Images :</label>
                    <div class="file-loading">
                      <input id="image_Event" type="file" name="image_Event[]" accept="image/*" data-min-file-count="1" multiple >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <input type="hidden" name="type" value="1" />
      <input type="hidden" name="_token" value="{{csrf_token()}}" />
    </form>

    <div class="modal fade" id="modal-events">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body" id="modal-body-event">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer justify-content-between">
            <div id="ShowEvents"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    $(document).ready(function() {
      var sites = {!! json_encode($events->toArray()) !!};

      var calender = $('#calendar').fullCalendar({
        selectable: true,
        height: 550,
        showNonCurrentDates: false,
        editable: false,
        defaultView: 'month',
        header: {
          right: 'today prev,next',
          center: 'title',
          left: 'year,month,basicWeek,basicDay'
        },
        events: sites,
        // events:  [
        //   {
        //     start: '2020-11-01',
        //     allDay: true,
        //     rendering: 'background',
        //     backgroundColor: '#F00',
        //     title: 'full',
        //     textColor: '#000',
        //     className: 'event-full'
        //   }],

        eventClick: function(calEvent, jsEvent, view) {
          var eventID = calEvent.events_id;
          var _token = $('input[name="_token"]').val();

          $("#modal-events .modal-body").load("{{ route('Events.ShowEvent', 1)}}?id="+eventID, function(){
            $('#modal-events').modal('show');
          });

          // $.ajax({
          //   url:"{{ route('Events.ShowEvent', 1) }}",
          //   method:"POST",
          //   data:{eventID:eventID,_token:_token},

          //   success:function(result){ //เสร็จแล้วทำอะไรต่อ
          //     console.log(result);
          //     $('#modal-events').modal('show');
          //     $('#ShowEvents').html(result);
          //   }
          // })
        }
      });
    });
  </script>
  
   {{-- image --}}
  <script type="text/javascript">
    $("#image_Event").fileinput({
      uploadUrl:"{{ route('MasterEvents.store') }}",
      theme:'fa',
      uploadExtraData:function(){
        return{
          _token:"{{csrf_token()}}",
        }
      },
      allowedFileExtensions:['jpg','png','gif'],
      maxFileSize:10240
    })
  </script>

  {{-- Date Rang --}}
  <script type="text/javascript">
    $('#reservation').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD'
      }
    })
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(1500);
    $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script>
@endsection
