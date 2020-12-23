@extends('layouts.master')
@section('title','infomation')
@section('content')

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

  <style>
    #todo-list{
    width:100%;
    margin:0 auto 50px auto;
    padding:5px;
    background:white;
    position:relative;
    /*box-shadow*/
    -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
          box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
    /*border-radius*/
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
          border-radius:5px;}
    #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
          box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
    -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
    }
    .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
    -moz-box-shadow:0 2px 0 -1px #ebebeb;
          box-shadow:0 2px 0 -1px #ebebeb;
    }
    .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
          box-shadow:none;
    }
    input[type="checkbox"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
    }
    .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 10px);
    left:0;
    width:0%;
    height:1px;
    background:#cd4400;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    }
    .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
    -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
          box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
          transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
          border-radius:4px;
    }
    .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
    -moz-box-shadow:inset 0 0 0 2px #949494;
          box-shadow:inset 0 0 0 2px #949494;
    }
    .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
    }
    :checked + .todo{
    color:#717171;
    }
    :checked + .todo:before{
    width:100%;
    }
    :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
    -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
          box-shadow:inset 0 0 0 2px #0eb0b7;
    }
    :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
    }
    /* Delete Items */

    .delete-item{
    display:block;
    position:absolute;
    height:36px;
    width:36px;
    line-height:36px;
    right:0;
    top:0;
    text-align:center;
    color:#d8d8d8;
    opacity:0;
    }
    .todo-wrap:hover .delete-item{
    opacity:1;
    }
    .delete-item:hover{
    color:#cd4400;
    }
  </style>
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
          <div class="float-right form-inline">
            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")            
              <button type="button" class="btn btn-warning btn-sm" onclick="myFunction()">
                <i class="fas fa-edit"></i> Edit
              </button>
              &nbsp;
              <form method="post" class="delete_form" action="{{ route('MasterInfo.destroy',$item->Info_id) }}" style="display:inline;">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="type" value="1" />
                <button type="submit" data-name="{{ $item->name_info }}" class="btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                  <i class="far fa-trash-alt"></i> Delete
                </button>
                &nbsp;
              </form>
            @endif
      <form name="form1" method="post" action="{{ route('MasterInfo.update',$item->Info_id) }}" enctype="multipart/form-data" >
            @if($item->UserPN_Noted == NULL or $item->UserYL_Noted == NULL or $item->UserNR_Noted == NULL)
              @if(auth::user()->type == "Admin" or auth::user()->position == "MASTER")   
                <button type="submit" class="btn btn-success btn-sm">
                  <i class="fas fa-save"></i> Save
                </button>
              @endif
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
        <br><br>
          @csrf
          <input type="hidden" name="type" value="2"/>
          <input type="hidden" name="_method" value="PATCH"/>
            <div class="float-right form-inline">

            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER" and auth::user()->branch == "01")
              <i class="fas fa-grip-vertical"></i>
              <span class="todo-wrap">
                @if($item->UserPN_Noted != NULL)
                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                    <input type="checkbox" id="1" name="PNUserNoted" value="Yes" {{ ($item->UserPN_Noted !== NULL) ? 'checked' : '' }} />
                  @else
                    <input type="checkbox" id="1" name="PNUserNoted" value="Yes" {{ ($item->UserPN_Noted !== NULL) ? 'checked' : '' }} disabled />
                @endif
              @else
                <input type="checkbox" id="1" name="PNUserNoted" value="Yes"/>
              @endif
                <label for="1" class="todo">
                  <i class="fa fa-check"></i>
                  <font color="red">Pattani Noted</font>
                </label>
              </span>
              &nbsp;
            @endif

            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER" and auth::user()->branch == "03")
              <i class="fas fa-grip-vertical"></i>
              <span class="todo-wrap">

                @if($item->UserYL_Noted != NULL)
                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                  <input type="checkbox" id="2" name="YLUserNoted" value="Yes" {{ ($item->UserYL_Noted !== NULL) ? 'checked' : '' }} />
                  @else
                  <input type="checkbox" id="2" name="YLUserNoted" value="Yes" {{ ($item->UserYL_Noted !== NULL) ? 'checked' : '' }} disabled/>
                  @endif
                @else
                  <input type="checkbox" id="2" name="YLUserNoted" value="Yes"/>
                @endif

                <label for="2" class="todo">
                  <i class="fa fa-check"></i>
                  <font color="red">Yala Noted</font>
                </label>
              </span>
              &nbsp;
            @endif

            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "MASTER" and auth::user()->branch == "04")
              <i class="fas fa-grip-vertical"></i>
              <span class="todo-wrap">
                @if($item->UserNR_Noted != NULL)
                  @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER")
                    <input type="checkbox" id="3" name="NRUserNoted" value="Yes" {{ ($item->UserNR_Noted !== NULL) ? 'checked' : '' }} />
                  @else
                    <input type="checkbox" id="3" name="NRUserNoted" value="Yes" {{ ($item->UserNR_Noted !== NULL) ? 'checked' : '' }} disabled />
                  @endif
                @else 
                  <input type="checkbox" id="3" name="NRUserNoted" value="Yes"/>
                @endif
                <label for="3" class="todo">
                  <i class="fa fa-check"></i>
                  <font color="red">Narathiwat Noted</font>
                </label>
              </span>
              &nbsp;
            @endif
              
            </div>
      </form>

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
                      <div class="col-10">
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
                      <div class="col-2">
                        <div class="form-group mb-1">
                          <label>Status :</label>
                          <div class="input-group">
                            @if($item->Status_info != NULL)
                              <input type="checkbox" name="Status" value="{{$item->Status_info}}" checked data-toggle="switchbutton" data-size="sm" data-onlabel="<i class='fas fa-book-reader'></i>" data-offlabel="<i class='fas fa-bell-slash'></i>" data-onstyle="success" data-offstyle="danger">
                            @else
                              <input type="checkbox" name="Status" value="Public" data-toggle="switchbutton" data-size="sm" data-onlabel="<i class='fas fa-book-reader'></i>" data-offlabel="<i class='fas fa-bell-slash'></i>" data-onstyle="success" data-offstyle="danger">
                            @endif
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

