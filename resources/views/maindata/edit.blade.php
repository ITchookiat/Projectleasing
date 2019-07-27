@extends('layouts.master')
@section('title','ข้อมูลหลัก')
@section('content')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>

    <section class="content-header">
      <h1>
        ข้อมูลหลัก
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <h3 align="center"><b>แก้ไขข้อมูลสมาชิก</b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>

        <div class="box-body">

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                <li>กรุณากรอกข้อมูลให้ครบช่อง {{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- <div class="container"> --}}
            <div class="row">
              <div class="col-md-12"> <br />
                <form method="post" action="{{ action('UserController@update',$id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <div class="form-inline form-group" align="center">
                    <label>Username : &nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="main_username" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อผู้ใช้" value="{{$user->username}}" />
                  </div>

                  <div class="form-inline form-group" align="center">
                    <label>Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="main_name" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อ" value="{{$user->name}}" />
                  </div>

                  <div class="form-inline form-group" align="center">
                    <label>Enail : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="main_email" class="form-control" style="width: 400px;" placeholder="ป้อนอีเมลล์" value="{{$user->email}}" />
                  </div>

                  <div class="form-inline form-group" align="center">
                    <label>Role : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <!-- <input type="text" name="main_type" class="form-control" style="width: 400px;" value="{{$user->type}}" /> -->
                    <select name="section_type" class="form-control" style="width: 400px;">
                      @foreach ($arrayType as $key => $value)
                        <option value="{{$key}}" {{ ($key == $user->type) ? 'selected' : '' }}>{{$value}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-inline form-group" align="center">
                    <label>branch : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="branch" class="form-control" style="width: 400px;">
                      @foreach ($arrayBranch as $key => $value)
                        <option value="{{$key}}" {{ ($key == $user->branch) ? 'selected' : '' }}>{{$value}}</option>
                      @endforeach
                    </select>
                  </div>

                  <br>
                  <div class="form-group" align="center">
                    <button type="submit" class="delete-modal btn btn-success">
                      <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ route('ViewMaindata') }}">ยกเลิก</a>
                  </div>
                  <input type="hidden" name="_method" value="PATCH"/>
                </form>

              </div>
            </div>
          {{-- </div> --}}

        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>

      <script>
        $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").alert('close');
        });;
      </script>

    </section>

    <script type="text/javascript">
      $(function(){
        $("#image-file").fileinput({
          theme:'fa',
        })
      })
    </script>

@endsection
