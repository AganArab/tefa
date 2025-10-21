<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('guru.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">iLab SMK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin iLab</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari..." aria-label="Search">
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
                <!-- Master Data -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('guru.index') }}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('mapel.index') }}" class="nav-link">
                                <i class="far fa-bookmark nav-icon"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ruangan.index') }}" class="nav-link">
                                <i class="far fa-building nav-icon"></i>
                                <p>Ruangan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Jadwal -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Jadwal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Senin') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Senin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Selasa') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Selasa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Rabu') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rabu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Kamis') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kamis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Jumat') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jumat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jadwal.hari', 'Sabtu') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sabtu</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>