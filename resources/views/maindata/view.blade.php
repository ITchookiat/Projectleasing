@extends('layouts.master')
@section('title','ข้อมูลหลัก')
@section('content')

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

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
          <h3 align="center"><b>ข้อมูลสมาชิกผู้ใช้งาน</b></h3>
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

                <div align="right" class="form-inline form-group">
                  <a href="{{ route('regist') }}" class="btn btn-success">
                  <span class="glyphicon glyphicon-plus"></span> Register
                  </a>
                </div>

              <table class="table table-bordered" id="table">
                <thead class="thead-dark">
                  <br>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">branch</th>
                    <th class="text-center" width="150px">Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($users as $key => $row)
                    <tr>
                      <td class="text-center">{{ $key+1 }}</td>
                      <td class="text-center">{{ $row->name }}</td>
                      <td class="text-center" width='20%'>{{ $row->username }}</td>
                      <td class="text-center" width='20%'>{{ $row->email }}</td>
                      <td class="text-center">
                        @if($row->type == 1)
                          admin
                        @elseif ($row->type  == 2)
                          ฝ่ายอนุมัติ
                        @elseif ($row->type  == 3)
                          จัดไฟแนนท์
                        @elseif ($row->type  == 4)
                          ฝ่ายอนุมัติรถบ้าน
                        @elseif ($row->type  == 21)
                          กฏหมาย
                        @elseif ($row->type  == 31)
                          เร่งรัด
                        @endif
                      </td>
                      <td class="text-center">
                        @if($row->branch == 99)
                          admin
                        @elseif ($row->branch  == 01)
                          ปัตตานี
                        @elseif ($row->branch  == 03)
                          ยะลา
                        @elseif ($row->branch  == 04)
                          นราธิวาส
                        @elseif ($row->branch  == 05)
                          สายบุรี
                        @elseif ($row->branch  == 06)
                          โกลก
                        @elseif ($row->branch  == 07)
                          เบตง
                        @elseif ($row->branch  == 10)
                          รถบ้าน
                        @elseif ($row->branch  == 11)
                          รถยืดขายผ่อน
                        @elseif ($row->branch  == 21)
                          แผนกกฏหมาย
                        @elseif ($row->branch  == 31)
                          แผนกเร่งรัด
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="{{ action('UserController@edit',[$row['id']]) }}" class="btn btn-warning btn-sm">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                        </a>
                        <div class="form-inline form-group">
                        <form method="post" class="delete_form" action="{{ action('UserController@destroy',$row['id']) }}">
                        {{csrf_field()}}
                          <input type="hidden" name="_method" value="DELETE" />
                          <button type="submit" class="delete-modal btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                          </button>
                        </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

            </div>
          </div>

          <script type="text/javascript">
            $(function() {
               $('#table').DataTable();
            });
          </script>

          <script type="text/javascript">
          $(document).ready(function(){
            $('.delete_form').on('submit',function(){
              if (confirm("คุณต้องการลบข้อมูลหรือไม่")) {
                return true;
              }
              else {
                return false;
              }
              });
            });
          </script>

          <script>
            $(".alert").fadeTo(3000, 500).slideUp(500, function(){
            $(".alert").alert('close');
            });;
          </script>

        </div>

      </div>
    </section>

@endsection
