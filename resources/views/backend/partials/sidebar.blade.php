<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pemeriksaan.index') }}"
                        class="nav-link {{ request()->routeIs('pemeriksaan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Pemeriksaan
                        </p>
                    </a>
                </li>
                @role('Admin')
                <li class="nav-item {{ request()->routeIs('penyakit.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('penyakit.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>
                            Penyakit
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penyakit.kategori.index') }}" class="nav-link {{ request()->routeIs('penyakit.kategori.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penyakit.daftar-penyakit.index') }}" class="nav-link {{ request()->routeIs('penyakit.daftar-penyakit.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Penyakit</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pengguna
                        </p>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
