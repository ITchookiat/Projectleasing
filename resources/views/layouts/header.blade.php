
<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('index','home') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>LS</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Chookiat Leasing</b></span>
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> ระบบรถบ้าน </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('datacar',11) }}">ข้อมูลยอด</a></li>
          <li class="divider"></li>
          <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">สต็อกรถยนต์</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('datacar',1) }}">รถยนต์ทั้งหมด</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',2) }}">รถยนต์ระหว่างทำสี</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',3) }}">รถยนต์รอซ่อม</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',4) }}">รถยนต์ระหว่างซ่อม</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',5) }}">รถยนต์ที่พร้อมขาย</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',6) }}">รถยนต์ที่ขายแล้ว</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacar',8) }}">รถยนต์ทยืมใช้</a></li>
              <!--
                <li class="dropdown-submenu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                  </li>
                </ul>
              </li>
            -->
            </ul>
          </li>
          <li class="divider"></li>
          <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงาน</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('datacarreport',3) }}">รายงานสต๊อกบัญชี</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacarreport',4) }}">รายงานวันหมดอายุบัตร</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacarreport',5) }}">รายงานรถยึด</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('datacarreport',6) }}">รายงานสรุปกำไรรถยนต์</a></li>
            </ul>
          </li>
          <li class="divider"></li>
          <li><a href="{{ route('datacar',12) }}">รถยึดจากเร่งรัด</a></li>
        </ul>
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
              <img src="{{ asset('dist/img/leasingLogo1.png') }}" class="img-circle" alt="User Image">
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
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button> -->
          <h3 class="modal-title" align="center"><i class="fa fa-warning text-warning"> Alert </i></h3>
        </div>
        <div class="modal-body">
          <h5 align="center">คุณแน่ใจที่จะออกจากระบบหรือไม่?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-outline pull-left" data-dismiss="modal">ยกเลิก</button>
          <a href="{{ route('logout') }}" class="btn btn-success btn-outline" >ตกลง</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
