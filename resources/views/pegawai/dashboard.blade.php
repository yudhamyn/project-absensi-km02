@extends('template.pegawai')
@section('content')
@include('template.sidebar.pegawai')
<div class="main-container">
    <style>
        .btn-group-sm > .btn, .btn-sm {
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
            border-radius: .2rem !important;
        }
    </style>
    <!-- Page header starts -->
    <div class="page-header">

        <!-- Row start -->
        <div class="row gutters">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">

                <!-- Search container start -->
                <div class="search-container">

                    <!-- Toggle sidebar start -->
                    <div class="toggle-sidebar" id="toggle-sidebar">
                        <i class="icon-menu"></i>
                    </div>
                    <!-- Toggle sidebar end -->

                    <!-- Mega Menu Start -->
                    <div class="cd-dropdown-wrapper" style="opacity: 0;">
                    </div>
                    <!-- Mega Menu End -->

                    <!-- Search input group start -->
                    <div class="ui fluid category search" style="opacity: 0;">
                    </div>
                    <!-- Search input group end -->

                </div>
                <!-- Search container end -->

            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                <!-- Header actions start -->
                <ul class="header-actions">
                    <li class="dropdown">
                    </li>
                    <li class="dropdown">
                    </li>
                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            <span class="avatar">
                                <img src="{{ url('') }}/assets/img/pegawai/{{ $pegawai->gambar }}" alt="User Avatar">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end md" aria-labelledby="userSettings">
                            <div class="header-profile-actions">
                                <a href="{{ url('') }}/pegawai/profile"><i class="icon-user1"></i>Profile</a>
                                <a href="{{ url('') }}/logout"><i class="icon-log-out1"></i>Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Header actions end -->

            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Page header ends -->

    <!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">
        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <h5 class="d-flex align-items-center mb-0" style="gap: 10px;">
                                            <span class="icon" style="font-size: 20px;color: unset;">
                                                <i class="icon-input"></i>
                                            </span>
                                            Absen Masuk
                                        </h5>
                                        @if($detail_absen->absen_masuk == 0)
                                            <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>/edit?detail_id={{ $detail_absen->id }}" class="btn btn-sm btn-primary mt-3">Absen Sekarang</a>
                                        @else
                                            <h1>{{ date('H : i', $detail_absen->absen_masuk) }}</h1>
                                        @endif
                                    </div>

                                    <hr class="my-3">

                                    <div class="d-flex flex-column ">
                                        <h5 class="d-flex align-items-center mb-0" style="gap: 10px;">
                                            <span class="icon" style="font-size: 20px;color: unset;">
                                                <i class="icon-open_in_new"></i>
                                            </span>
                                            Absen Keluar
                                        </h5>
                                        @if($detail_absen->absen_pulang == 0)
                                        <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>/edit?detail_id={{ $detail_absen->id }}" class="btn btn-sm btn-primary mt-3">Absen Sekarang</a>
                                        @else
                                            <h1>{{ date('H : i', $detail_absen->absen_masuk) }}</h1>
                                        @endif
                                    </div>
                                </div>
                            </div>

                    <div class="profile-header">
                        <h1>Welcome, {{ $pegawai->nama }}</h1>
                        <div class="profile-header-content" style="background: #1273eb;">
                            <div class="profile-header-tiles">
                                <div class="row gutters">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="profile-tile">
                                            <span class="icon" style="background: #1273eb;">
                                                <i class="icon-server"></i>
                                            </span>
                                            <h6>Name - {{ $pegawai->nama }}</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="profile-tile">
                                            <span class="icon" style="background: #1273eb;">
                                                <i class="icon-award"></i>
                                            </span>
                                            <h6>NIP - <span>{{ $pegawai->nip }}</span></h6>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="profile-tile">
                                            <span class="icon" style="background: #1273eb;">
                                                <i class="icon-email"></i>
                                            </span>
                                            <h6><span>{{ $pegawai->email }}</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-avatar-tile">
                                <img src="{{ url('') }}/assets/img/pegawai/{{ $pegawai->gambar }}" class="img-fluid" alt="User Profile">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if ($absensi)
                @if ($detail_absen)
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                            <!-- <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <h5 class="d-flex align-items-center mb-0" style="gap: 10px;">
                                            <span class="icon" style="font-size: 20px;color: unset;">
                                                <i class="icon-input"></i>
                                            </span>
                                            Absen Masuk
                                        </h5>
                                        @if($detail_absen->absen_masuk == 0)
                                            <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>/edit?detail_id={{ $detail_absen->id }}" class="btn btn-sm btn-primary mt-3">Absen Sekarang</a>
                                        @else
                                            <h1>{{ date('H : i', $detail_absen->absen_masuk) }}</h1>
                                        @endif
                                    </div>

                                    <hr class="my-3">

                                    <div class="d-flex flex-column ">
                                        <h5 class="d-flex align-items-center mb-0" style="gap: 10px;">
                                            <span class="icon" style="font-size: 20px;color: unset;">
                                                <i class="icon-open_in_new"></i>
                                            </span>
                                            Absen Keluar
                                        </h5>
                                        @if($detail_absen->absen_pulang == 0)
                                        <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>/edit?detail_id={{ $detail_absen->id }}" class="btn btn-sm btn-primary mt-3">Absen Sekarang</a>
                                        @else
                                            <h1>{{ date('H : i', $detail_absen->absen_masuk) }}</h1>
                                        @endif
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <a href="{{ url('') }}/pegawai/absensi">
                                            <table class="table">
                                                <tr>
                                                    <th>Absen Hari Ini</th>
                                                    <td>{{ $absensi->tgl_absen }}</td>

                                                    <th>Masuk</th>
                                                    <td>
                                                        <?php if ($detail_absen->absen_masuk == 0) : ?>
                                                            <span class="badge rounded-pill bg-danger">Belum Absen</span>
                                                        <?php else : ?>
                                                            <?= date('H : i', $detail_absen->absen_masuk); ?>
                                                            <?php if ($detail_absen->status_masuk == 1) : ?>
                                                                <span class="badge bg-danger">Terlambat</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>

                                                    <th>Pulang</th>
                                                    <td>
                                                        <?php if ($detail_absen->absen_keluar == 0) : ?>
                                                            <span class="badge bg-danger">Belum Absen</span>
                                                        <?php else : ?>
                                                            <?= date('H : i', $detail_absen->absen_keluar); ?>
                                                        <?php endif; ?>
                                                    </td>

                                                    <th>Izin</th>
                                                    <td>
                                                        <?php if ($detail_absen->izin == NULL) : ?>
                                                            <span class="badge bg-primary">Tidak Izin</span>
                                                        <?php else : ?>
                                                            <?php if ($detail_absen->status_izin == 0) : ?>
                                                                <span class="badge bg-primary">Tunggu Persetujuan</span>
                                                            <?php else : ?>
                                                                <span class="badge bg-success">Di Izinkan</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card" style="height: 400px;">
                        <div class="card-body">
                            <h5 class="card-title">Lokasi Kantor</h5>
                            <iframe style="width: 100%; height: 95%;" src="https://www.google.com/maps?q={{ $pengaturan->latitude }},{{ $pengaturan->longitude }}&hl=es;z=14&output=embed"></iframe>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal Absen</h5>
                            <button type="button" class="btn btn-info stripes-btn" style="width: 100%;"> Jam Masuk {{ $pengaturan->jam_masuk }}</button>
                            <button type="button" class="btn btn-info stripes-btn mt-3" style="width: 100%;"> Jam Keluar {{ $pengaturan->jam_keluar }}</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">© Presensi Pegawai By yudhamyn</div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->

</div>
@endsection