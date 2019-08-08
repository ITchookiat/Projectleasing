@php
  function active($currect_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
      echo 'active'; //class name in css
    }
  }
@endphp
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left">
        <img src="{{ asset('dist/img/leasingLogo.png') }}" alt="User Image" style="width: 30%;">
      </div>
      <div class="pull-left info">
        <p>&nbsp;&nbsp;&nbsp;{{ Auth::user()->username }}</p>
        <a href="#">&nbsp;&nbsp;&nbsp;<i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      @if(auth::user()->type == 1)

        <li class="treeview {{ (request()->is('maindata/view*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span> ข้อมูลหลัก</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ViewMaindata') }}"><i class="fa fa-bookmark text-info"></i>  ข้อมูลผู้ใช้งานระบบ</a></li>
          </ul>
        </li>
      @endif

      <li class="treeview {{ (request()->is('Analysis/*')) ? 'active' : '' }} {{ (request()->is('call/*')) ? 'active' : '' }} {{ (request()->is('finance/*')) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-database"></i> <span> แผนกสินเชื่อ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li class="treeview {{ (request()->is('Analysis/Home/*')) ? 'active' : '' }} {{ (request()->is('Analysis/edit/*')) ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-folder-open text-info"></i>สินเชื่อ
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if(auth::user()->branch != 10 and auth::user()->branch != 11 and auth::user()->type != 4)
                  <li><a href="{{ route('Analysis',1) }}"><i class="fa fa-tags"></i>สินเชื่อ</a></li>
                  @if(auth::user()->type == 1 or auth::user()->type == 2)
                    <li><a href="{{ route('Analysis',4) }}"><i class="fa fa-tags"></i>รถบ้าน</a></li>
                  @endif
                @else
                    <li><a href="{{ route('Analysis',4) }}"><i class="fa fa-tags"></i>รถบ้าน</a></li>
                @endif
                <li><a href="{{ route('Analysis',3) }}"><i class="fa fa-tags"></i>รายงาน สินเชื่อ</a></li>
                <li><a href="{{ route('Analysis',3) }}"><i class="fa fa-tags"></i>รายงาน รถบ้าน</a></li>
              </ul>
          </li>

          <li>
              <a href="{{ route('call',1) }}"><i class="fa fa-steam text-danger"></i> งานโทร</a>
          </li>

          <li>
              <a href="{{ route('finance',1) }}"><i class="fa fa-steam text-success"></i> ประเภทจัดไฟแนนซ์</a>
          </li>
        </ul>
      </li>

      <li class="treeview {{ (request()->is('report/view*')) ? 'active' : '' }}"> <!-- /.DINsidebar -->
        <a href="#">
          <i class="fa fa-book"></i> <span> แผนกกฏหมาย</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
              <a href="#"><i class="fa fa-book text-yellow"></i> แผนกฏหมาย 1</a>
          </li>
        </ul>
      </li>

    </ul>
  </section>
      <!-- /.sidebar -->
</aside>
