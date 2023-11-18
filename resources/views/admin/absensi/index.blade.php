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

            <!-- ABSEN HARI INI -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ABSENSI HARI INI</h5>
                            @if ($absensi === null)
                                <a href="{{ url('') }}/admin/absen/tambah" class="btn btn-primary stripes-btn absen-hari-ini">Absen Hari Ini</a>
                            @endif
                            <div class="table-responsive mt-2">
                                <table id="datatable" class="table v-middle">
                                    <thead>
                                        <tr>
                                            <th>Jumlah Pegawai</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Jumlah Pulang</th>
                                            <th>Jumlah Izin</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($absensi !== null) : ?>
                                            <tr>
                                                <td><?= ($absensi->jumlah_pegawai != null) ? "$absensi->jumlah_pegawai" : '0'; ?> Pegawai</td>
                                                <td><?= ($absensi->jumlah_pegawai_masuk != null) ? "$absensi->jumlah_pegawai_masuk" : '0'; ?> Pegawai</td>
                                                <td><?= ($absensi->jumlah_pegawai_pulang != null) ? "$absensi->jumlah_pegawai_pulang" : '0'; ?> Pegawai</td>
                                                <td><?= ($absensi->jumlah_izin != null) ? "$absensi->jumlah_izin" : '0'; ?> Pegawai</td>
                                                <td><?= ($absensi->total != null) ? "$absensi->total" : '0'; ?> Pegawai</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="{{ url('') }}/admin/absensi/{{ $absensi->kode_absensi }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail">
                                                            <i class="icon-external-link text-info"></i>
                                                        </a>
                                                        <form action="{{ url('') }}/admin/absensi/{{ $absensi->kode_absensi }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-hapus" style="border: none; outline: none; background: none; font-size: 16px; line-height: 16px;">
                                                                <i class="icon-x-circle text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- end ABSEN HARI INI -->

            <!-- RIWAYAT ABSEN -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">RIWAYAT ABSENSI</h5>
                            <div class="table-responsive">
                                <table id="datatable2" class="table v-middle">
                                    <thead>
                                        <tr>
                                            <th>Tgl</th>
                                            <th>Jumlah Pegawai</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Jumlah Pulang</th>
                                            <th>Jumlah Izin</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat_absensi as $absen)
                                            <?php if ($absen->tgl_absen != date('d-M-Y', time())) : ?>
                                                <tr>
                                                    <td><?= $absen->tgl_absen; ?> Pegawai</td>
                                                    <td><?= $absen->jumlah_pegawai; ?> Pegawai</td>
                                                    <td><?= ($absen->jumlah_pegawai_masuk == null) ? 0 : $absen->jumlah_pegawai_masuk; ?> Pegawai</td>
                                                    <td><?= ($absen->jumlah_pegawai_pulang == null) ? 0 : $absen->jumlah_pegawai_pulang; ?> Pegawai</td>
                                                    <td><?= ($absen->jumlah_izin == null) ? 0 : $absen->jumlah_izin; ?> Pegawai</td>
                                                    <td><?= $absen->total; ?> Pegawai</td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="{{ url('') }}/admin/absensi/<?= $absen->kode_absensi; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                                <i class="icon-external-link text-info"></i>
                                                            </a>
                                                            <form action="{{ url('') }}/admin/absensi/{{ $absen->kode_absensi }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn-hapus" style="border: none; outline: none; background: none; font-size: 16px; line-height: 16px;">
                                                                    <i class="icon-trash text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- end RIWAYAT ABSEN -->

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
    $('#datatable').DataTable({
        "ordering": true,
        "lengthMenu": [
            [-1, 5, 10, 25, 50],
            ["All", 5, 10, 25, 50]
        ],
    });

    $('#datatable2').DataTable({
        "ordering": true,
        "lengthMenu": [
            [-1, 5, 10, 25, 50],
            ["All", 5, 10, 25, 50]
        ],
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
    });

    $('.absen-hari-ini').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');

        Swal.fire({
            title: 'Kamu Yakin?',
            text: "Absen untuk hari ini akan dibuat!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, buat!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {

                document.location.href = href;

            }
        })

    })
</script>

{!! session('pesan') !!}
@endsection