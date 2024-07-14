<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('arsip') }}" class="nav-link ">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Arsip Surat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori') }}" class="nav-link ">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>
                            Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tentang') }}" class="nav-link ">
                        <i class="nav-icon fa-solid fa-info"></i>
                        <p>
                            Tentang Saya
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
