@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

@php
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d', strtotime('-1 days'));
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $time = date('H:i');
  $date2 = $Y.'-'.$m.'-'.$d;
@endphp

<link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
<script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        สินเชื่อ
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="{{ action('AnalysController@edit',[$type,$id,$fdate,$tdate,$branch,$status]) }}" class="btn btn-info pull-left">
          <span class="glyphicon glyphicon-arrow-left"></span> ย้อนกลับ
          </a>
          <!-- <h3 align="center">รูปทั้งหมด</h3> -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">
            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12">

                        <input type="hidden" name="fdate" value="{{ $fdate }}" />
                        <input type="hidden" name="tdate" value="{{ $tdate }}" />
                        <input type="hidden" name="branch" value="{{ $branch }}" />
                        <input type="hidden" name="status" value="{{ $status }}" />

                        @if($countData == 0)
                        <div class="col-md-12" align="center">
                          <p>ไม่มีรูปแล้ว</p>
                        </div>
                        @else
                          @foreach($data as $key => $row)
                          <div class="col-lg-3 col-xs-12">
                          <!-- small box -->
                          <div class="small-box btn-default fixed" align="center">
                            <div class="inner" align="center">
                              <img class="img-bordered" src="{{ asset('upload-image/'.$row->Name_fileimage) }}" width="150" height="120" alt="Photo">
                            </div>

                            <a href="{{ action('AnalysController@destroyImage',[$row->fileimage_id,$type,$fdate,$tdate,$branch,$status]) }}" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบรูปนี้หรือไม่?')">
                              <span class="glyphicon glyphicon-trash"></span> ลบ
                            </a>
                              <br/>
                              <br/>
                          </div>
                         </div>
                         @endforeach
                        @endif

              </div>
           </div>
           <script type="text/javascript">
           $(document).ready(function() {
             $('#table').DataTable( {
               "order": [[ 1, "asc" ]]
             } );
           } );
           </script>

          <script type="text/javascript">
            $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert").alert('close');
            });
          </script>

          <script>
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })
          </script>

          <script type="text/javascript">
              $("#image-file").fileinput({
                uploadUrl:"{{ route('MasterAnalysis.store') }}",
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

        </div>

      </div>
    </section>

@endsection
