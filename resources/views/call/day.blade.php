@extends('layouts.master')
@section('title','แผนกวิเคราะห์')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <section class="content-header">
      <h1>
        งานโทร
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 align="center"><b></b></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>


          <div class="box-body">

            @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong>สำเร็จ!</strong> {{ session()->get('success') }}
              </div>
            @endif

            <div class="row">
              <div class="col-md-12">

                <div class="card">
                  <div class="card-header d-flex p-0">
                    <ul class="nav nav-pills ml-auto p-2">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('call',1) }}">หน้าแรก</a>
                      </li>
                      <li class="nav-item  active">
                        <a class="nav-link" href="{{ route('call',2) }}">งานโทรประจำวัน</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('call',3) }}">งานโทรประจำเดือน</a>
                      </li>
                    </ul>
                  </div>
                </div>

            </div>
          </div>

          <script type="text/javascript">
            $(function() {
               $('#table').DataTable();
            });
          </script>

        </div>

      </div>
    </section>

@endsection
