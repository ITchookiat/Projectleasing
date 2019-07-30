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
            <img src="{{ asset('dist/img/leasingLogo.png') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('dist/img/leasingLogo.png') }}" class="img-circle" alt="User Image">
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
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="return confirm('ต้องการออกจากระบบหรือไม่?')">Sign out</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
