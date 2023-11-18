@extends('template.admin')
@section('content')
@include('template.sidebar.admin')

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
                                <img src="{{ url('') }}/assets/img/pegawai/{{ $admin->gambar }}" alt="User Avatar">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end md" aria-labelledby="userSettings">
                            <div class="header-profile-actions">
                                <a href="{{ url('') }}/admin/profile"><i class="icon-user1"></i>Profile</a>
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

            <!-- DETAIL ABSEN -->
            <div class="row gutters">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">DETAIL IZIN <span style="text-transform: uppercase;"><?= $absensi->pegawai->nama; ?></span></h5>

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="doc-block" style="padding: 13px;">
                                        <div class="doc-icon">
                                            <img src="{{ url('') }}/assets/template/presensi-abdul/img/docs/file.png" alt="Doc Icon">
                                        </div>
                                        <div class="doc-title">File Bukti Izin</div>
                                        <a href="{{ url('') }}/admin/download_izin/<?= $absensi->bukti_izin; ?>" class="btn btn-primary" target="_blank">Download</a>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="text-primary">Alasan</h6>
                                    <p><?= $absensi->alasan; ?></p>
                                    <p>Status Izin : <?= ($absensi->status_izin == 0) ? '<span class="badge bg-warning">Pending</span>' : '<span class="badge bg-success">Di Setujui</span>'; ?></p>
                                    <?php if ($absensi->status_izin == 0) : ?>
                                        <a href="{{ url('') }}/admin/izinkan/<?= $absensi->kode_absensi; ?>/<?= $absensi->pegawai_id; ?>" class="btn btn-success stripes-btn mt-3 btn-izinkan">Izinkan</a>
                                        
                                        <a href="{{ url('') }}/admin/ditolak/<?= $absensi->kode_absensi; ?>/<?= $absensi->pegawai_id; ?>" class="btn btn-danger stripes-btn mt-3 btn-ditolak">Tolak</a>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('') }}/admin/absensi/<?= $absensi->kode_absensi; ?>" class="btn btn-danger stripes-btn mt-3"><i class="icon-arrow-left"></i>Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end DETAIL ABSEN -->

        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">© Presensi Pegawai By yudhamyn</div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->

</div>
<!-- *************
				************ Main container end *************
			************* -->

<script>
    
    $('.btn-izinkan').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Izinkan Pegawai Ini Untuk Izin Absen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Izinkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
        })
    });

    $('.btn-ditolak').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Tolak Pegawai Ini Untuk Izin Absen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Tolak!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
        })
    });

</script>

{!! session('pesan') !!}
@endsection