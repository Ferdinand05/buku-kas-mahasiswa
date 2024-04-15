<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">BUKU KAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.show', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item user-panel">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @role('super admin')
                    <li class="nav-item  user-panel">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endrole

                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="{{ route('kategori-transaksi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Kategori Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('jurusan-mahasiswa.index') }}" class="nav-link">
                        <i class=" nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Jurusan Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item user-panel">
                    <a href="{{ route('mahasiswa.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Mahasiswa
                        </p>
                    </a>
                </li>



                <li class="nav-header ">Transaksi</li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item user-panel">
                    <a href="{{ route('rekapitulasi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Rekapitulasi
                        </p>
                    </a>
                </li>
                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a href="{{ route('laporan-transaksi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan Transaksi
                        </p>
                    </a>
                </li>

                <li class="nav-item user-panel">
                    <a href="{{ route('laporan-mahasiswa.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-header">Utilitas</li>
                <li class="nav-item">
                    <a href="{{ route('log') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Logs
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
