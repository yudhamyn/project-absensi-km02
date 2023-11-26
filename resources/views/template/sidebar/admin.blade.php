<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar content start -->
    <div class="sidebar-tabs">

        <!-- Tabs nav start -->
        <div class="nav" role="tablist" aria-orientation="vertical">
            <a href="#" class="logo">
                <img src="{{ url('') }}/assets/template/presensi-abdul/img/logo.jpg" alt="Uni Pro Admin">
            </a>
            <a class="nav-link {{ ($menu['tab'] == 'home') ? 'show active' : '' }}" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true">
                <i class="icon-home2"></i>
                <span class="nav-link-text">Dashboards</span>
            </a>
            <a class="nav-link {{ ($menu['tab'] == 'master') ? 'show active' : '' }}" id="master-tab" data-bs-toggle="tab" href="#tab-master" role="tab" aria-controls="tab-master" aria-selected="true">
                <i class="icon-database"></i>
                <span class="nav-link-text">Master Data</span>
            </a>
        </div>
        <!-- Tabs nav end -->

        <!-- Tabs content start -->
        <div class="tab-content">

            <!-- Home tab -->
            <div class="tab-pane fade {{ ($menu['tab'] == 'home') ? 'show active' : '' }}" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    <!-- Judul Halaman -->
                    {{ $judul_sidebar }}
                </div>
                <!-- Tab content header end -->
                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul class="tile-menu">
                            <li>
                                <a href="{{ url('') }}/admin" class="{{ ($menu['page'] == 'dashboard') ? 'current-page' : '' }}">
                                    <i class="icon-laptop"></i> Dashboard
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Sidebar menu ends -->
                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile blue">
                        <i class="icon-user"></i> Admin
                    </div>
                </div>
                <!-- Sidebar actions ends -->
            </div>

            <!-- Master Data Tab -->
            <div class="tab-pane fade {{ ($menu['tab'] == 'master') ? 'show active' : '' }}" id="tab-master" role="tabpanel" aria-labelledby="master-tab">
                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    <!-- Judul Halaman -->
                    {{ $judul_sidebar }}
                </div>
                <!-- Tab content header end -->
                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul class="tile-menu">
                            <li>
                                <a href="{{ url('') }}/admin/pegawai" class="{{ ($menu['page'] == 'pegawai') ? 'current-page' : '' }}">
                                    <i class="icon-users"></i> Pegawai
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('') }}/admin/jabatan" class="{{ ($menu['page'] == 'jabatan') ? 'current-page' : '' }}">
                                    <i class="icon-briefcase"></i> Jabatan
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('') }}/admin/absensi" class="{{ ($menu['page'] == 'absensi') ? 'current-page' : '' }}">
                                    <i class="icon-date_range"></i> Data Absen
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('') }}/admin/settings" class="{{ ($menu['page'] == 'settings') ? 'current-page' : '' }}">
                                    <i class="icon-settings1"></i> setting Absen
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('') }}/admin/jamkerja" class="{{ ($menu['page'] == 'jamkerja') ? 'current-page' : '' }}">
                                    <i class="icon-settings1"></i> Jam Kerja
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Sidebar menu ends -->
                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile blue">
                        <i class="icon-user"></i> Admin
                    </div>
                </div>
                <!-- Sidebar actions ends -->
            </div>

        </div>
        <!-- Tabs content end -->
    </div>
    <!-- Sidebar content end -->

</nav>
<!-- Sidebar wrapper end -->