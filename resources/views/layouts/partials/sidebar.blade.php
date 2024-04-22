<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/image/logo40.jpg" alt="Perpustakaan 40" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          {{ auth()->user()->name }}
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('admin')
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('datauser') ? 'active' : '' }}">
                <a href="/datauser" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>User</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('databuku') ? 'active' : '' }}">
                <a href="/databuku" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Buku</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('datakategori') ? 'active' : '' }}">
                <a href="/datakategori" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Kategori</p>
                </a>
            </li>
            @endcan

            @can('admin_pustakawan')
            <li class="nav-item {{ Request::is('datapeminjaman') ? 'active' : '' }}">
                <a href="/datapeminjaman" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Peminjaman</p>
                </a>
            </li>
            @endcan

            <li class="nav-item {{ Request::is('datalaporan') ? 'active' : '' }}">
                <a href="/datalaporan" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Laporan Peminjaman</p>
                </a>
            </li>
        </ul>
    </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
