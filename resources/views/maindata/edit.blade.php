@extends('layouts.master')
@section('title','ข้อมูลหลัก')
@section('content')

    <!-- Main content -->
    {{-- <section class="content">
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

        </div>
      </div>
    </section> --}}


      <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>กรุณากรอกข้อมูลให้ครบช่อง {{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="" style="text-align:center;"><b>ข้อมูลสมาชิกผู้ใช้งาน</b></h3>
              </div>
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12"> <br />
                    <form method="post" action="{{ action('UserController@update',$id) }}" enctype="multipart/form-data">
                      @csrf
                      @method('put')

                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Username : </label>
                            <input type="text" name="main_username" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อผู้ใช้" value="{{$user->username}}" />
                          </div>
                        </div>
                      </div>
    
                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Name : </label>
                            <input type="text" name="main_name" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อ" value="{{$user->name}}" />
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Enail : </label>
                            <input type="text" name="main_email" class="form-control" style="width: 400px;" placeholder="ป้อนอีเมลล์" value="{{$user->email}}" />
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Role : </label>
                            <!-- <input type="text" name="main_type" class="form-control" style="width: 400px;" value="{{$user->type}}" /> -->
                            <select name="section_type" class="form-control" style="width: 400px;">
                              @foreach ($arrayType as $key => $value)
                                <option value="{{$key}}" {{ ($key == $user->type) ? 'selected' : '' }}>{{$value}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>branch : </label>
                            <select name="branch" class="form-control" style="width: 400px;">
                              @foreach ($arrayBranch as $key => $value)
                                <option value="{{$key}}" {{ ($key == $user->branch) ? 'selected' : '' }}>{{$value}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
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

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").alert('close');
    });;
  </script>

@endsection
