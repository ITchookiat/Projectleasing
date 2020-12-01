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
          <strong>ข่าวสาร (Informations)</strong>
        </h3>
        <div class="card-tools">
          @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
            <button type="button" class="btn btn-warning btn-sm" onclick="myFunction()">
              <i class="fas fa-edit"></i> Edit
            </button>
          @endif
          <a class="btn btn-primary btn-sm" href="{{ route('MasterEvents.index') }}">
            <i class="fas fa-caret-square-left"></i> Back
          </a>
        </div>
      </div>
      <div class="card-body text-sm">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="table">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 20px">No.</th>
                      <th class="text-center" style="width: 120px">Contents</th>
                      <th class="text-center" style="width: 50px">Duration</th>
                      <th class="text-center" style="width: 120px">Notes</th>
                      <th style="width: 30px"></th>
                      <th style="width: 30px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key => $row)
                      @php
                        $SetSDate = date('d-m-Y', strtotime($row->SDate_info));
                        $SetEDate = date('d-m-Y', strtotime($row->EDate_info));
                      @endphp
                      <tr>
                        <td class="text-center"> {{$key+1}} </td>
                        <td class="text-left"> 
                          <a href="{{ route('MasterInfo.show',$row->Info_id) }}" class="product-title">
                            {{$row->name_info}} 
                          </a>
                        </td>
                        <td class="text-center"> {{$SetSDate}} - {{$SetEDate}} </td>
                        <td class="text-left"> {{$row->Notes_info}} </td>
                        <td class="text-left"> {{$row->User_generate}} </td>
                        <td class="text-right">
                          @if($SetSDate >= date('d-m-Y'))
                            <button type="button" class="btn btn-warning btn-sm prem" title="แจ้งเตือน">
                              <i class="fas fa-bullhorn"></i>
                            </button>
                          @endif
                          <a href="{{ route('MasterInfo.show',$row->Info_id) }}" class="btn btn-primary btn-sm" title="ดูรายการ">
                            <i class="far fa-eye"></i>
                          </a>
                          <form method="post" class="delete_form" action="{{ route('MasterInfo.destroy',$row->Info_id) }}" style="display:inline;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="type" value="2" />
                            <button type="submit" data-name="{{ $row->name_info }}" class="btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                              <i class="far fa-trash-alt"></i>
                            </button>
                          </form>
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
  </section>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table').DataTable( {
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
        "lengthChange": true,
        "order": [[ 0, "asc" ]]
      });
    });
  </script>

  <script>
    function blinker() {
    $('.prem').fadeOut(1500);
    $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script>
  
@endsection

