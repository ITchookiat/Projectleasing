
<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('index','home') }}" class="logo">
    <span class="logo-mini"><b>LS</b></span>
    <span class="logo-lg"><b>Chookiat</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->

  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    @if(auth::user()->type == 1)
    <ul class="nav navbar-nav">
      <li>
        <a href="{{ route('datacar',11) }}" >ระบบรถบ้าน</a>
      </li>
      <li>
        <a href="{{ route('datacar',11) }}" >ระบบขายฝาก</a>
      </li>
    </ul>
    @endif

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </li>
        <!-- <li>
          <a href="{{ route('logout') }}" onclick="return confirm('ต้องการออกจากระบบหรือไม่?')"><i class="fa fa-power-off"></i>  ออกจากระบบ </a>
        </li> -->

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('dist/img/avatar5.png') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('dist/img/leasingLogo1.jpg') }}" class="img-circle" alt="User Image">
              <p>
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->username }}</small>
              </p>
            </li>


            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <!-- <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="return confirm('ต้องการออกจากระบบหรือไม่?')">Sign out</a> -->
                <a class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-danger" data-backdrop="static" data-keyboard="false">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>

      </ul>
    </div>
  </nav>
</header>
<div class="modal fade in" id="modal-danger">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-body">
          <h5 align="center">คุณแน่ใจที่จะออกจากระบบหรือไม่ <i class="fa fa-question-circle"></i></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i>  ยกเลิก</button>
          <a href="{{ route('logout') }}" class="btn btn-success btn-outline" ><i class="fa fa-check-circle"></i>  ตกลง</a>
        </div>

        <!-- <div class="modal-body text-center"> คุณแน่ใจที่จะออกจากระบบหรือไม่ <i class="fa fa-question-circle"></i></div>
        <div class="modal-footer">
            <a href="{{ route('logout') }}" class="btn btn-success btn-block" >ตกลง</a>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"> ยกเลิก</button>
        </div> -->

      </div>
      <!-- /.modal-content -->
    </div>
  </div>
