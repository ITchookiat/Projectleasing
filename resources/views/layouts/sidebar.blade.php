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
            <i class="fa fa-window-restore"></i> <span> ข้อมูลหลัก</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('ViewMaindata') }}"><i class="fa fa-id-badge text-red"></i>  ข้อมูลผู้ใช้งานระบบ</a></li>
          </ul>
        </li>
      @endif

      @if(session('type') == 1)
        <li class="treeview {{ (request()->is('Analysis/*')) ? 'active' : '' }} {{ (request()->is('call/*')) ? 'active' : '' }} {{ (request()->is('finance/*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-sitemap"></i> <span> แผนกสินเชื่อ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview {{ (request()->is('Analysis/Home/*')) ? 'active' : '' }} {{ (request()->is('Analysis/edit/*')) ? 'active' : '' }}">
                <a href="#">
                  <i class="fa fa-folder-open text-red"></i>สินเชื่อ
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 3 or auth::user()->type == 4)
                    @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->branch == 01 or auth::user()->branch == 03 or auth::user()->branch == 04 or auth::user()->branch == 05 or auth::user()->branch == 06 or auth::user()->branch == 07)
                      <li><a href="{{ route('Analysis',1) }}"><i class="fa fa-cube text-primary"></i>สินเชื่อ</a></li>
                      <li><a href="{{ route('Analysis',3) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน สินเชื่อ</a></li>
                    @endif
                    @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 4 or auth::user()->branch == 10 or auth::user()->branch == 11)
                      <li><a href="{{ route('Analysis',4) }}"><i class="fa fa-cube text-primary"></i>รถบ้าน</a></li>
                      <li><a href="{{ route('Analysis',6) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน รถบ้าน</a></li>
                      <li><a href="{{ route('Analysis',7) }}"><i class="fa fa-folder-open text-success"></i>รายงานการอนุมัติ</a></li>
                    @endif
                  @endif
                </ul>
            </li>
          </ul>
        </li>

        <li class="treeview {{ (request()->is('Precipitate/*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-handshake-o"></i> <span> แผนกเร่งรัด</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 31)
            <ul class="treeview-menu">
              <li class="treeview {{(request()->is('Precipitate/Home/3'))?'active':''}} {{(request()->is('Precipitate/Home/1'))?'active':''}} {{(request()->is('Precipitate/Home/4'))?'active':''}} {{(request()->is('Precipitate/Home/5'))?'active':''}} {{(request()->is('Precipitate/Home/11'))?'active':''}}">
                  <a href="#">
                    <i class="fa fa-folder-open text-red"></i>ระบบ
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('Precipitate',3) }}"><i class="fa fa-cube text-primary"></i>ระบบแจ้งเตือนติดตาม</a></li>
                    <li><a href="{{ route('Precipitate',1) }}"><i class="fa fa-cube text-primary"></i>ระบบปล่อยงานตาม</a></li>
                    <li><a href="{{ route('Precipitate',4) }}"><i class="fa fa-cube text-primary"></i>ระบบปล่อยงานโนติส</a></li>
                    <li><a href="{{ route('Precipitate',5) }}"><i class="fa fa-cube text-primary"></i>ระบบสต็อกรถเร่งรัด</a></li>
                    <li><a href="{{ route('Precipitate',11) }}"><i class="fa fa-cube text-primary"></i>ระบบปรับโครงสร้างหนี้</a></li>
                  </ul>
              </li>
              <li class="treeview {{(request()->is('Precipitate/Home/2'))?'active':''}} {{(request()->is('Precipitate/Home/7'))?'active':''}} {{(request()->is('Precipitate/Home/8'))?'active':''}} {{(request()->is('Precipitate/Home/9'))?'active':''}} {{(request()->is('Precipitate/Home/10'))?'active':''}}">
                  <a href="#">
                    <i class="fa fa-folder-open text-red"></i>รายงาน
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('Precipitate',2) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน แยกตามทีม</a></li>
                    <li><a href="{{ route('Precipitate',7) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน งานประจำวัน</a></li>
                    <li><a href="{{ route('Precipitate',8) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน รับชำระค่าติดตาม</a></li>
                    <li><a href="{{ route('Precipitate',9) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน ใบรับฝาก</a></li>
                    <li><a href="{{ route('Precipitate',10) }}"><i class="fa fa-clipboard text-yellow"></i>รายงาน หนังสือขอยืนยัน</a></li>
                  </ul>
              </li>
            </ul>
          @endif
        </li>

        <li class="treeview {{ (request()->is('Legislation/Home*')) ? 'active' : '' }} {{ (request()->is('Legislation/edit/*')) ? 'active' : '' }}"> <!-- /.DINsidebar -->
            <a href="#">
              <i class="fa fa-gavel"></i> <span> แผนกกฏหมาย</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            @if(auth::user()->type == 1 or auth::user()->type == 2 or auth::user()->type == 21 or auth::user()->type == 31)
              <ul class="treeview-menu">
                <li><a href="{{ route('legislation',1) }}"><i class="fa fa-cube text-primary"></i>รายชื่อส่งฟ้อง</a></li>
                <li><a href="{{ route('legislation',6) }}"><i class="fa fa-cube text-primary"></i>ลูกหนี้เตรียมฟ้อง</a></li>
                <li><a href="{{ route('legislation',2) }}"><i class="fa fa-cube text-primary"></i>ลูกหนี้ฟ้อง</a></li>
                <li><a href="{{ route('legislation',8) }}"><i class="fa fa-cube text-primary"></i>ลูกหนี้สืบทรัพย์</a></li>
                <li><a href="{{ route('legislation',7) }}"><i class="fa fa-cube text-primary"></i>ลูกหนี้ประนอมหนี้</a></li>
                <li><a href="{{ route('legislation',10) }}"><i class="fa fa-cube text-primary"></i>ลูกหนี้ของกลาง</a></li>
              </ul>
            @endif
          </li>

        <!-- <li>
            <a href="{{ route('report',1) }}"><i class="fa fa-newspaper-o text-red"></i>รายงาน ใบเบิกเงิน</a>
        </li> -->
      @elseif(session('type') == 2)
        <li class="treeview {{ (request()->is('datacar/view*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database"></i> <span> สต๊อกรถยนต์</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="{{ route('datacar',1) }}"><i class="fa fa-cube text-reD"></i> รถยนต์ทั้งหมด</a>
            </li>
            <li>
                <a href="{{ route('datacar',7) }}"><i class="fa fa-cube text-red"></i> รถยนต์นำเข้าใหม่</a>
            </li>
            <li>
                <a href="{{ route('datacar',2) }}"><i class="fa fa-cube text-red"></i> รถยนต์ระหว่างทำสี</a>
            </li>
            <li>
                <a href="{{ route('datacar',3) }}"><i class="fa fa-cube text-red"></i> รถยนต์รอซ่อม</a>
            </li>
            <li>
                <a href="{{ route('datacar',4) }}"><i class="fa fa-cube text-red"></i> รถยนต์ระหว่างซ่อม</a>
            </li>
            <li>
                <a href="{{ route('datacar',5) }}"><i class="fa fa-cube text-red"></i> รถยนต์ที่พร้อมขาย</a>
            </li>
            <li>
                <a href="{{ route('datacar',6) }}"><i class="fa fa-cube text-red"></i> รถยนต์ที่ขายแล้ว</a>
            </li>
            <li>
                <a href="{{ route('datacar',8) }}"><i class="fa fa-cube text-red"></i> รถยนต์ยืมใช้</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ (request()->is('datacar/viewreport*')) ? 'active' : '' }}"> <!-- /.DINsidebar -->
          <a href="#">
            <i class="fa fa-book"></i> <span> รายงาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li>
                <a href="{{ route('datacarreport',1) }}"><i class="fa fa-book text-success"></i> รายงานรถยนต์ทั้งหมด</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',2) }}"><i class="fa fa-book text-info"></i> รายงานรถยนต์พร้อมขาย</a>
            </li> -->
            <li>
                <a href="{{ route('datacarreport',3) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน สต๊อกบัญชี</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',4) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน วันหมดอายุบัตร</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',5) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน รถยึด</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',6) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน ยอดขาดทุนรถต่อคัน</a>
            </li>
        </li>
          </ul>
        </li>
      @endif

    </ul>
  </section>
</aside>
