@php
  function active($currect_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
      echo 'active'; //class name in css
    }
  }
@endphp


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-warning">
    <!-- Brand Logo -->
    <a href="{{ route('index','home') }}" class="brand-link">
      <img src="{{ asset('dist/img/leasingLogo1.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CHOOKIAT GROUP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div>
      

      @php
        if (isset($_GET['type'])) {
          if ($_GET['type'] == 1) {
            $ActivePloan = true;
            $ActiveP03 = true;
          }elseif ($_GET['type'] == 3) {
            $ActivePloan = true;
            $ActiveP04 = true;
          }elseif ($_GET['type'] == 4) {
            $ActiveMicro = true;
            $ActiveP07 = true;
          }elseif ($_GET['type'] == 5) {
            $ActiveMicro = true;
            $ActiveP06 = true;
          }
        }

        if (isset($_GET['type']) and Request::is('MasterAnalytical')) {
          $MasterAnalytical = true;
          if ($_GET['type'] == 1) {
            $Analytical01 = true;
          }elseif ($_GET['type'] == 2) {
            $Analytical02 = true;
          }
        }
      @endphp

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview {{ Request::is('MasterEvents') ? 'menu-open' : '' }} {{ Request::is('MasterInfo') ? 'menu-open' : '' }} {{ Request::is('MasterInfo/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fab fa-audible"></i>
              <span id="Info"></span>
              <p>
                Events and Information
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 15px;">
              <li class="nav-item">
                <a href="{{ route('MasterEvents.index') }}?type={{1}}" class="nav-link {{ Request::is('MasterEvents') ? 'active' : '' }} {{ Request::is('MasterInfo') ? 'active' : '' }} {{ Request::is('MasterInfo/*') ? 'active' : '' }}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>New Events and Infor</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(isset($MasterAnalytical)) {{($MasterAnalytical == true) ? 'menu-open' : '' }} @endif">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-server"></i>
              <span id="Info"></span>
              <p>
                Data Analyticals
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('MasterAnalytical.index') }}?type={{1}}" class="nav-link @if(isset($Analytical01)) {{($Analytical01 == true) ? 'active' : '' }} @endif">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Board Masters (Fn)</p>
                  </a>
                  <a href="{{ route('MasterAnalytical.index') }}?type={{2}}" class="nav-link @if(isset($Analytical02)) {{($Analytical02 == true) ? 'active' : '' }} @endif">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Board Finanaces (Fn)</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('Analysis/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                ระบบสินเชื่อ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก รถบ้าน" or auth::user()->type == "แผนก การเงินใน" or auth::user()->type == "แผนก กฏหมาย" or auth::user()->type == "แผนก ตรวจสอบ")
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview {{ Request::is('Analysis/Home/1') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/2') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/3') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/4') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/5') ? 'menu-open' : '' }}
                                                 {{ Request::is('Analysis/Home/6') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/7') ? 'menu-open' : '' }} 
                                                 {{ Request::is('Analysis/edit/1/*') ? 'menu-open' : '' }} {{ Request::is('Analysis/edit/4/*') ? 'menu-open' : '' }}
                                                 {{ Request::is('Analysis/deleteImageEach/1/*') ? 'menu-open' : '' }} {{ Request::is('Analysis/deleteImageEach/4/*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      สินเชื่อ
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ตรวจสอบ" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน" or auth::user()->type == "แผนก กฏหมาย")
                      <li class="nav-item">
                        <a href="{{ route('Analysis', 1) }}" class="nav-link {{ Request::is('Analysis/Home/1') ? 'active' : '' }} {{ Request::is('Analysis/Home/2') ? 'active' : '' }} {{ Request::is('Analysis/edit/1/*') ? 'active' : '' }}
                                                                              {{ Request::is('DataCustomer/*/*') ? 'active' : '' }} {{ Request::is('Analysis/Home/3') ? 'active' : '' }}">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>สินเชื่อ</p>
                        </a>
                      </li>
                    @endif
                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก รถบ้าน")
                      <li class="nav-item">
                        <a href="{{ route('Analysis',4) }}" class="nav-link {{ Request::is('Analysis/Home/4') ? 'active' : '' }} {{ Request::is('Analysis/Home/5') ? 'active' : '' }} {{ Request::is('Analysis/edit/4/*/*/*/*/*') ? 'active' : '' }}">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>รถบ้าน</p>
                        </a>
                        @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์")
                          <a href="{{ route('Analysis',7) }}" class="nav-link {{ Request::is('Analysis/Home/7') ? 'active' : '' }} ">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายงาน การอนุมัติ</p>
                          </a>
                        @endif
                      </li>
                    @endif
                  </ul>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview {{ Request::is('Analysis/Home/10') ? 'menu-open' : '' }} {{ Request::is('Analysis/edit/10/*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      เปลี่ยนสัญญา
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน" or auth::user()->type == "แผนก กฏหมาย")
                      <li class="nav-item">
                        <a href="{{ route('Analysis', 10) }}" class="nav-link {{ Request::is('Analysis/Home/10') ? 'active' : '' }} {{ Request::is('Analysis/edit/10*') ? 'active' : '' }}">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>สัญญาเช่าซื้อ</p>
                        </a>
                      </li>
                    @endif
                    @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก รถบ้าน")
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>สัญญารถบ้าน</p>
                        </a>
                      </li>
                    @endif
                  </ul>
                </li>
              </ul>
              @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->position == "MASTER")

                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview {{ Request::is('Analysis/Home/12') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/13') ? 'menu-open' : '' }} {{ Request::is('Analysis/Home/14') ? 'menu-open' : '' }} {{ Request::is('Analysis/edit/9/*') ? 'menu-open' : '' }} {{ Request::is('Analysis/edit/12/*') ? 'menu-open' : '' }} {{ Request::is('Analysis/deleteImageEach/9/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                      <i class="far fa-window-restore text-red nav-icon"></i>
                      <p>
                        มาตรการ COVID-19
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="margin-left: 15px;">
                      <li class="nav-item">
                        <a href="{{ route('Analysis',12) }}" class="nav-link {{ Request::is('Analysis/Home/12') ? 'active' : '' }} {{ Request::is('Analysis/Home/13') ? 'active' : '' }} {{ Request::is('Analysis/edit/12/*/*/*/*/*') ? 'active' : '' }}">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>มาตรการช่วยเหลือ</p>
                        </a>
                        <a href="{{ route('Analysis',14) }}" class="nav-link {{ Request::is('Analysis/Home/14') ? 'active' : '' }}">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>รายงาน มาตรการช่วยเหลือ</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              @endif
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('MasterMicroPloan') ? 'menu-open' : '' }} {{ Request::is('MasterMicroPloan/*/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                ระบบเงินกู้
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ตรวจสอบ" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน")
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview @if(isset($ActivePloan)) {{($ActivePloan == true) ? 'menu-open' : '' }} @endif">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      สัญญาเงินกู้ PLoan
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ตรวจสอบ" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน")
                        <li class="nav-item">
                          <a href="{{ route('MasterMicroPloan.index') }}?type={{1}}" class="nav-link @if(isset($ActiveP03)) {{($ActiveP03 == true) ? 'active' : '' }} @endif">
                            <i class="fas fa-car nav-icon"></i>
                            <p>เงินกู้รถยนต์ (P03)</p>
                          </a>
                          <a href="{{ route('MasterMicroPloan.index') }}?type={{3}}" class="nav-link @if(isset($ActiveP04)) {{($ActiveP04 == true) ? 'active' : '' }} @endif">
                            <i class="fas fa-biking nav-icon"></i>
                            <p>เงินกู้จักรยานยนต์ (P04)</p>
                          </a>
                        </li>
                      @endif
                  </ul>
                </li>
              </ul>
            @endif
         
            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ตรวจสอบ" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน")
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview @if(isset($ActiveMicro)) {{($ActiveMicro == true) ? 'menu-open' : '' }} @endif">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      สัญญาเงินกู้ Micro
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                      @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก ตรวจสอบ" or auth::user()->type == "แผนก จัดไฟแนนท์" or auth::user()->type == "แผนก การเงินใน")
                        <li class="nav-item">
                          <a href="{{ route('MasterMicroPloan.index') }}?type={{5}}" class="nav-link @if(isset($ActiveP06)) {{($ActiveP06 == true) ? 'active' : '' }} @endif">
                            <i class="fas fa-car nav-icon"></i>
                            <p>เงินกู้รถยนต์ (P06)</p>
                          </a>
                          <a href="{{ route('MasterMicroPloan.index') }}?type={{4}}" class="nav-link @if(isset($ActiveP07)) {{($ActiveP07 == true) ? 'active' : '' }} @endif">
                            <i class="fas fa-user nav-icon"></i>
                            <p>เงินกู้พนักงาน (P07)</p>
                          </a>
                        </li>
                      @endif
                  </ul>
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('Precipitate/*') ? 'menu-open' : '' }} {{ Request::is('MasterPrecipitate/*') ? 'menu-open' : '' }} {{ Request::is('Analysis/deleteImageEach/11/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-handshake"></i>
              <p>
                แผนกเร่งรัด
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก เร่งรัด" or auth::user()->type == "แผนก กฏหมาย")
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview {{ Request::is('Precipitate/Home/3') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/1') ? 'menu-open' : '' }} 
                                                 {{ Request::is('Precipitate/Home/4') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/5') ? 'menu-open' : '' }} 
                                                 {{ Request::is('Precipitate/Home/6') ? 'menu-open' : '' }}  {{ Request::is('Precipitate/Home/11') ? 'menu-open' : '' }} 
                                                 {{ Request::is('Precipitate/Home/12') ? 'menu-open' : '' }} {{ Request::is('Precipitate/DebtEdit/*') ? 'menu-open' : '' }} 
                                                 {{ Request::is('Analysis/deleteImageEach/11/*') ? 'menu-open' : '' }} {{ Request::is('MasterPrecipitate/*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      ระบบ
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    <li class="nav-item">
                      <a href="{{ route('Precipitate',3) }}" class="nav-link {{ Request::is('Precipitate/Home/3') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>ระบบแจ้งเตือนติดตาม</p>
                      </a>
                      <a href="{{ route('Precipitate',1) }}" class="nav-link {{ Request::is('Precipitate/Home/1') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>ระบบปล่อยงาน</p>
                      </a>
                      <a href="{{ route('Precipitate',5) }}" class="nav-link {{ Request::is('Precipitate/Home/5') ? 'active' : '' }} {{ Request::is('Precipitate/Home/6') ? 'active' : '' }} {{ Request::is('MasterPrecipitate/*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>ระบบสต็อกรถเร่งรัด</p>
                      </a>
                      <a href="{{ route('Precipitate',11) }}" class="nav-link {{ Request::is('Precipitate/Home/11') ? 'active' : '' }} {{ Request::is('Precipitate/Home/12') ? 'active' : '' }} {{ Request::is('Precipitate/DebtEdit/11/*/*/*/*/*') ? 'active' : '' }} {{ Request::is('Analysis/deleteImageEach/11/*/*/*/*/*/*') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>ระบบปรับโครงสร้างหนี้</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview {{ Request::is('Precipitate/Home/2') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/7') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/8') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/9') ? 'menu-open' : '' }} {{ Request::is('Precipitate/Home/10') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      รายงาน
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                    <li class="nav-item">
                      <a href="{{ route('Precipitate',2) }}" class="nav-link {{ Request::is('Precipitate/Home/2') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน แยกตามทีม</p>
                      </a>
                      <a href="{{ route('Precipitate',7) }}" class="nav-link {{ Request::is('Precipitate/Home/7') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน งานประจำวัน</p>
                      </a>
                      <a href="{{ route('Precipitate',8) }}" class="nav-link {{ Request::is('Precipitate/Home/8') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน รับชำระค่าติดตาม</p>
                      </a>
                      <a href="{{ route('Precipitate',9) }}" class="nav-link {{ Request::is('Precipitate/Home/9') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน ใบรับฝาก</p>
                      </a>
                      <a href="{{ route('Precipitate',10) }}" class="nav-link {{ Request::is('Precipitate/Home/10') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน หนังสือขอยืนยัน</p>
                      </a>
                      <a href="{{ route('Precipitate',15) }}" class="nav-link {{ Request::is('Precipitate/Home/15') ? 'active' : '' }}">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>รายงาน หนังสือทวงถาม</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            @elseif(auth::user()->type == "แผนก การเงินนอก")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('Precipitate',11) }}" class="nav-link {{ Request::is('Precipitate/Home/11') ? 'active' : '' }} {{ Request::is('Precipitate/Home/12') ? 'active' : '' }} {{ Request::is('Precipitate/DebtEdit/11/*/*/*/*/*') ? 'active' : '' }} {{ Request::is('Analysis/deleteImageEach/11/*/*/*/*/*/*') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>ระบบปรับโครงสร้างหนี้</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('Legislation/*') ? 'menu-open' : '' }} {{ Request::is('Legislation/edit/*') ? 'menu-open' : '' }} {{ Request::is('MasterCompro') ? 'menu-open' : '' }} {{ Request::is('MasterCompro/*/*') ? 'menu-open' : '' }} 
                                           {{ Request::is('MasterLegis/*/*') ? 'menu-open' : '' }} {{ Request::is('MasterLegis') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-gavel"></i>
              <p>
                แผนกกฏหมาย
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก กฏหมาย" or auth::user()->type == "แผนก เร่งรัด" or auth::user()->type == "แผนก การเงินนอก")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  @php
                    if (isset($_GET['type'])) {
                      if ($_GET['type'] == 20 || $_GET['type'] == 6 || $_GET['type'] == 21 || $_GET['type'] == 22 || $_GET['type'] == 23 || $_GET['type'] == 24 || $_GET['type'] == 25 || $_GET['type'] == 8 || Request::is('MasterLegis/*/*') || $_GET['type'] == 1 || $_GET['type'] == 2 || $_GET['type'] == 3) {
                        $SetActive20 = true;
                      }elseif ($_GET['type'] == 10) {
                        $SetActive10 = true;
                      }
                    }
                  @endphp
                  @if (auth::user()->type == "แผนก การเงินนอก")
                    <a class="nav-link {{ Request::is('Legislation/Home/1') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รายชื่อลูกหนี้</p>
                    </a>
                    <a href="{{ route('MasterLegis.index') }}?type={{20}}" class="nav-link @if(isset($SetActive20)) {{($SetActive20 == true) ? 'active' : '' }} @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>ระบบลูกหนี้กฎหมาย</p>
                    </a>
                    <a href="#" class="nav-link @if(isset($SetActive10)) {{($SetActive10 == true) ? 'active' : '' }} @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>ระบบลูกหนี้ของกลาง</p>
                    </a>
                  @else
                    <a data-toggle="modal" data-target="#modal-1" data-link="{{ route('MasterLegis.index') }}?type={{1}}" class="nav-link {{ Request::is('Legislation/Home/1') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รายชื่อลูกหนี้</p>
                    </a>
                    <a href="{{ route('MasterLegis.index') }}?type={{20}}" class="nav-link @if(isset($SetActive20)) {{($SetActive20 == true) ? 'active' : '' }} @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>ระบบลูกหนี้กฎหมาย</p>
                    </a>
                    <a href="{{ route('MasterLegis.index') }}?type={{10}}" class="nav-link @if(isset($SetActive10)) {{($SetActive10 == true) ? 'active' : '' }} @endif">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>ระบบลูกหนี้ของกลาง</p>
                    </a>
                  @endif
                 
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('MasterTreasury') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <span id="ShowData"></span>
              {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                แผนกการเงิน
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก วิเคราะห์" or auth::user()->type == "แผนก การเงินใน")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('MasterTreasury.index') }}?type={{2}}" class="nav-link {{ Request::is('MasterTreasury') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Approving Transfers</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-item has-treeview {{ Request::is('Account/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fab fa-leanpub"></i>
              <span id="ShowData"></span>
              <p>
                แผนกบัญชี
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก บัญชี" or auth::user()->type == "แผนก วิเคราะห์")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('Accounting', 1) }}" class="nav-link {{ Request::is('Account/Home/1') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Internal Audit</p>
                  </a>
                  <a href="{{ route('Accounting', 3) }}" class="nav-link {{ Request::is('Account/Home/3') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Report Credit</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>

          <li class="nav-header">Documents Part</li>
          <li class="nav-item has-treeview {{ Request::is('Document/*') ? 'menu-open' : '' }}">
            <a href="{{ route('document', 1) }}" class="nav-link active bg-yellow">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Data warehouse
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
              <!-- <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('document', 1) }}" class="nav-link {{ Request::is('Document/Home/1') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>รายการเอกสาร</p>
                  </a>
                </li>
              </ul> -->
          </li>
        </ul>
      </nav>

    </div>
  </aside>

  <!-- Pop up  -->
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background-color:#EAEDED">
        <div class="modal-body">
          {{-- <p>One fine body…</p> --}}
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-1").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-1 .modal-body").load(link, function(){
        });
      });
    });
  </script>

  {{-- แจ้งเตือนอนุมัติ แผนกการเงิน --}}
  <script type="text/javascript">
    SearchData(); //เรียกใช้งานทันที
    var Data = setInterval(() => {SearchData()}, 10000);

    function SearchData(){ 
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"{{ route('SearchData', [3, 0]) }}",
        method:"GET",
        data:{},
    
        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#ShowData').html(result);
        }
      });
    };
  </script>

  {{-- แจ้งเตือนข่าวสาร --}}
  <script type="text/javascript">
    ShowInfo(); //เรียกใช้งานทันที
    var Data1 = setInterval(() => {ShowInfo()}, 10000);

    function ShowInfo(){ 
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url:"{{ route('ShowInfo', [3, 0]) }}",
        method:"GET",
        data:{},
    
        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#Info').html(result);
        }
      });
    };
  </script>
