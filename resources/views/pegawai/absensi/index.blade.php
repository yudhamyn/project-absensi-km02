@extends('template.pegawai')
@section('content')
@include('template.sidebar.pegawai')
<div class="main-container">

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

            <!-- PEMBERITAHUAN ABSEN -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Absen Hari Ini</div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <td>Masuk</td>
                                            <td>Pulang</td>
                                            <td>Izin</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody class="text-nowrap">
                                        <?php if ($absensi != null) : ?>
                                            <?php if ($detail_absen != null) : ?>
                                                <tr class="text-nowrap">
                                                    <?php if ($detail_absen->izin == null) : ?>
                                                        <td>
                                                            <?php if ($detail_absen->absen_masuk == 0) : ?>
                                                                <span class="badge bg-danger">Belum Absen</span>
                                                            <?php else : ?>
                                                                <?php if ($detail_absen->status_masuk == 1) : ?>
                                                                    <span class="badge bg-danger"><?= date('H : i', $detail_absen->absen_masuk); ?></span>
                                                                <?php else : ?>
                                                                    <?= date('H : i', $detail_absen->absen_masuk); ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($detail_absen->absen_pulang == 0) : ?>
                                                                <span class="badge bg-danger">Belum Absen</span>
                                                            <?php else : ?>
                                                                <?= date('H : i', $detail_absen->absen_pulang); ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php else : ?>
                                                        <td colspan="2">IZIN</td>
                                                    <?php endif; ?>
                                                    <td>
                                                        <?php if ($detail_absen->izin == null) : ?>
                                                            <span class="badge bg-primary">Tidak Izin</span>
                                                        <?php else : ?>
                                                            <?php if ($detail_absen->status_izin == 0) : ?>
                                                                <span class="badge bg-warning">Tunggu Persetujuan</span>
                                                            <?php else : ?>
                                                                <span class="badge bg-success">Di Izinkan</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($detail_absen->absen_masuk == null || $detail_absen->absen_pulang == null || $detail_absen->izin == null) : ?>
                                                            <?php if ($detail_absen->izin == null && $detail_absen->absen_pulang == null) : ?>
                                                                <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>/edit/" class="badge rounded-pill bg-primary">Absen</a>
                                                            <?php endif; ?>

                                                            <?php if ($detail_absen->absen_masuk != null && $detail_absen->absen_pulang != null) : ?>
                                                                <a href="{{ url('') }}/pegawai/absensi/<?= $detail_absen->kode_absensi; ?>" class="badge rounded-pill bg-success">Detail</a>
                                                            <?php endif; ?>

                                                            <?php if ($detail_absen->absen_masuk == null && $detail_absen->absen_pulang == null && $detail_absen->izin == null) : ?>
                                                                <a href="{{ url('') }}/pegawai/izin_absensi/<?= $detail_absen->kode_absensi; ?>" class="badge rounded-pill bg-success">Izin</a>
                                                            <?php endif; ?>

                                                            <?php if ($detail_absen->absen_masuk == null && $detail_absen->absen_pulang == null && $detail_absen->izin != null) : ?>
                                                                <a href="{{ url('') }}/pegawai/izin_absensi/<?= $detail_absen->kode_absensi; ?>" class="badge rounded-pill bg-success">Detail</a>
                                                            <?php endif; ?>

                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PEMBERITAHUAN ABSEN -->

            <!-- RIWAYAT ABSEN -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Riwayat Absen</div>
                            <div class="table-responsive">
                                <table class="table table-riwayat text-nowrap">
                                    <thead>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>Masuk</td>
                                            <td>Pulang</td>
                                            <td>Izin</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($riwayat_absensi != null) : ?>
                                            <?php foreach ($riwayat_absensi as $ra) : ?>
                                                <?php if ($ra->absensi->tgl_absen != date('d-M-Y', time())) : ?>
                                                    <tr class="text-nowrap">
                                                        <td class="text-nowrap">
                                                            <?= $ra->absensi->tgl_absen; ?>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <?php if ($ra->izin == null) : ?>
                                                                <?php if ($ra->absen_masuk == 0) : ?>
                                                                    <span class="badge bg-danger">Belum Absen</span>
                                                                <?php else : ?>
                                                                    <?php if ($ra->status_masuk == 1) : ?>
                                                                        <span class="badge bg-danger"><?= date('H : i', $ra->absen_masuk); ?></span>
                                                                    <?php else : ?>
                                                                        <?= date('H : i', $ra->absen_masuk); ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                IZIN
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <?php if ($ra->izin == null) : ?>
                                                                <?php if ($ra->absen_pulang == 0) : ?>
                                                                    <span class="badge bg-danger">Belum Absen</span>
                                                                <?php else : ?>
                                                                    <?= date('H : i', $ra->absen_pulang); ?>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                IZIN
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <?php if ($ra->izin == 0) : ?>
                                                                <span class="badge bg-primary">Tidak Izin</span>
                                                            <?php else : ?>
                                                                <?php if ($ra->status_izin == 0) : ?>
                                                                    <span class="badge bg-warning">Tunggu Persetujuan</span>
                                                                <?php else : ?>
                                                                    <span class="badge bg-success">Di Izinkan</span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <?php if ($ra->izin == 1) : ?>
                                                                <a href="{{ url('') }}/pegawai/izin_absensi/<?= $ra->kode_absensi; ?>" class="badge rounded-pill bg-success">Detail</a>
                                                            <?php else : ?>
                                                                <a href="{{ url('') }}/pegawai/absensi/<?= $ra->kode_absensi; ?>" class="badge rounded-pill bg-success">Detail</a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RIWAYAT ABSEN -->

        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">© Presensi Pegawai By yudhamyn</div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->

</div>
<script>
    $('.table-riwayat').DataTable();
</script>
@endsection