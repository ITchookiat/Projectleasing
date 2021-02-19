
<form name="form1" method="post" action="#" enctype="multipart/form-data">
  @csrf
  @method('put')
    <div class="card card-warning">
      <div class="card-header">
        <h4 class="card-title">
          <i class="fas fa-calendar-day pr-2" style="color: rgba(245, 58, 58, 0.966)"></i>New Events
        </h4>
        <div class="card-tools">
            <button type="submit" class="btn btn-success btn-tool">
              <i class="fas fa-save"></i> Save
            </button>
            <a class="btn btn-warning btn-tool" href="#">
            <i class="far fa-window-close"></i> Close
          </a>
        </div>
      </div>
      <div class="card-body text-sm">
       
      </div>
    </div>
  <input type="hidden" name="type" value="1"/>
  <input type="hidden" name="_method" value="PATCH"/>
</form>
