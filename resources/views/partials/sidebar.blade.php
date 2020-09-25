<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Point Of Sale</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Applications
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/home" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Point of Sale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lending Services</p>
                </a>
              </li>
            </ul>
          </li>
          @if(auth()->user()->role == 'admin')
          <li class="nav-item has-treeview">
            <a href="/product" class="nav-link {{ Request::is('product')? 'active' : '' }}">
              <i class="fas fa-clipboard nav-icon"></i>
                <p> Manage Products</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/store" class="nav-link {{ Request::is('store')? 'active' : '' }}">
              <i class="fas fa-store-alt nav-icon"></i>
              <p> Manage Stores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/account" class="nav-link {{ Request::is('account')? 'active' : '' }}">
              <i class="fas fa-users nav-icon"></i>
              <p> Manage Accounts</p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="/inventory" class="nav-link {{ Request::is('inventories')? 'active' : '' }}">
              <i class="fas fa-briefcase nav-icon"></i>
                <p> Manage Inventories</p>
            </a>
          </li> -->
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('inventories')? 'active' : '' }}">
              <i class=" fas fa-chart-area nav-icon"></i>
                <p> Analytics</p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="/analytics" class="nav-link {{ Request::is('analytics')? 'active' : '' }}">
            <i class="fas fa-chart-bar nav-icon"></i>
                <p> Analytics</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
          <a href="/report" class="nav-link {{ Request::is('report')? 'active' : '' }}">
            <i class="fas fa-file-word nav-icon"></i>
                <p> Reports</p>
            </a>
          </li>


          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>