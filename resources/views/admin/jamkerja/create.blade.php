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
                                <img src="{{ url('') }}/assets/img/jamkerja/{{ $admin->gambar }}" alt="User Avatar">
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
            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Jam Kerja</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('') }}/admin/jamkerja" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" id="id" type="hidden" name="id" required>
                                            <input class="form-control" id="nama" type="text" name="nama" required>
                                            <div class="field-placeholder">Nama Jam Kerja <span class="text-danger">*</span></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" id="kode" type="text" name="kode" required>
                                            <div class="field-placeholder">Kode Jam Kerja <span class="text-danger">*</span></div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" id="jam_masuk" type="time" name="jam_masuk" required>
                                            <div class="field-placeholder">Jam Masuk <span class="text-danger">*</span></div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" id="jam_keluar" type="time" name="jam_keluar" required>
                                            <div class="field-placeholder">Jam Keluar <span class="text-danger">*</span></div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- Row end -->
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">© Presensi Jam Kerja By yudhamyn</div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->

</div>
<!-- *************
				************ Main container end *************
			************* -->

<!-- Modal Edit -->
<div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('') }}/admin/excel_jamkerja" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="excelModalLabel">Import Data Jam Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95%;">
                    <div class="modal-body" style="overflow: hidden; width: auto; height: 95%;">
                        <div class="row gutters">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="doc-block" style="padding: 13px;">
                                    <div class="doc-icon">
                                        <img src="{{ url('') }}/assets/template/presensi-abdul/img/docs/xls.svg" alt="Doc Icon">
                                    </div>
                                    <div class="doc-title">Template Excel</div>
                                    <a href="{{ url('') }}/admin/download_excel" class="btn btn-primary" target="_blank">Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="field-wrapper mt-3">
                            <input class="form-control" type="file" name="excel" accept=".xls, .xlsx" required>
                            <div class="field-placeholder">excel</div>
                            <div class="form-text">
                                File Excel.
                            </div>
                        </div>
                        <!-- Field wrapper end -->


                    </div>
                    <div class="slimScrollBar" style="background: rgb(214, 219, 230); width: 5px; position: absolute; top: 0px; opacity: 0.8; display: block; border-radius: 0px; z-index: 99; right: 1px; height: 55.798px;"></div>
                    <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(214, 219, 230); opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('.select2').select2();

    function previewImg() {
        const gambar = document.querySelector('#input-foto');
        const imgPreview = document.querySelector('.foto-jamkerja');

        const filegambar = new FileReader();
        filegambar.readAsDataURL(gambar.files[0]);

        filegambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

@endsection