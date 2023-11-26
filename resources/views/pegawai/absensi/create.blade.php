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
            <!-- ROW -->
            <div class="row">
                <?php if ($absensi->absen_masuk == null) : ?>
                    <h4>Absen Masuk</h4>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                {!! Session::get('jarak') !!}
                                <center>
                                    <div id="my_camera"></div>
                                </center>
                                <button type="button" class="btn btn-success mt-2" onclick="take_picture();">Ambil Gambar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hasil Gambar</h5>
                                <form class="myForm text-center" action="{{ url('') }}/pegawai/absensi_masuk" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <p>Jarak Sekarang <br><strong><span id="jarak-sekarang"></span></strong> Meter Dari Kantor</p>
                                    <input type="hidden" name="latitude">
                                    <input type="hidden" name="longitude">
                                    <input type="hidden" name="image_tag" class="image-tag">
                                    <input type="hidden" name="kode_absensi" value="<?= $absensi->kode_absensi; ?>">
                                    <input type="hidden" name="absensi_detail_id" value="<?= $absensi->id; ?>">
                                    <div id="result"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($absensi->absen_masuk != null) : ?>
                    <h4>Absen Pulang</h4>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if (strtotime(date('H:i', time())) >= strtotime($pengaturan->jam_keluar)) : ?>
                                    {!! session('pesan') !!}
                                    {!! session('jarak') !!}
                                    <center>
                                        <div id="my_camera"></div>
                                    </center>
                                    <button type="button" class="btn btn-success mt-2" onclick="take_picture();">Ambil Gambar</button>
                                <?php else : ?>
                                    <div class="alert alert-danger">Belum saatnya absen pulang</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hasil Gambar</h5>
                                <form class="myForm text-center" action="{{ url('') }}/pegawai/absensi_pulang" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <p>Jarak Sekarang <br><strong><span id="jarak-sekarang"></span></strong> Meter Dari Kantor</p>
                                    <input type="hidden" name="latitude">
                                    <input type="hidden" name="longitude">
                                    <input type="hidden" name="image_tag" class="image-tag">
                                    <input type="hidden" name="kode_absensi" value="<?= $absensi->kode_absensi; ?>">
                                    <input type="hidden" name="absensi_detail_id" value="<?= $absensi->id; ?>">
                                    <div id="result"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- ROW -->

        </div>
        <!-- Content wrapper end -->

        <!-- App Footer start -->
        <div class="app-footer">© Presensi Pegawai By Abduloh Malela</div>
        <!-- App footer end -->

    </div>
    <!-- Content wrapper scroll end -->


</div>

<script>
    function distance(lat1, lon1, lat2, lon2, unit) {
        if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
        } else {
            var radlat1 = Math.PI * lat1 / 180;
            var radlat2 = Math.PI * lat2 / 180;
            var theta = lon1 - lon2;
            var radtheta = Math.PI * theta / 180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180 / Math.PI;
            dist = dist * 60 * 1.1515;
            if (unit == "K") {
                dist = dist * 1.609344
            }
            if (unit == "N") {
                dist = dist * 0.8684
            }
            return dist;
        }
    }
    <?php if ($absensi->absen_masuk == null) : ?>
        Webcam.set({
            width: 220,
            height: 300,
            flip_horiz: true,
            image_format: 'png',
            png_quality: 100
        });
        Webcam.attach('#my_camera');

        function take_picture() {
            Webcam.snap(function(data_url) {
                $('.image-tag').val(data_url);

                var tag_img = '<img src="' + data_url + '"/><br><button type="submit" class="btn btn-primary stripes-btn mt-2">Kirim Absen</button>';
                $('#result').html(tag_img);
            });

        }

        setInterval(() => {
            getLocation();
            console.log('dihitung');
        }, 1000);

        setInterval(() => {
            var lat_2 = $('input[name=latitude]').val();
            var long_2 = $('input[name=longitude]').val();
            var hasil_jarak_km = distance(<?= $pengaturan->latitude ?>, <?= $pengaturan->longitude ?>, lat_2, long_2, 'K');
            var hasil_jarak_meter = hasil_jarak_km * 1000;
            var hasil_jarak_meter_bulat = Math.round(hasil_jarak_meter);
            $('#jarak-sekarang').html(hasil_jarak_meter_bulat);
        }, 1000);

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    // alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                    Swal.fire(
                        'Error!',
                        'Kamu harus mengizinkan Akses Lokasi!',
                        'error'
                    )
                    break;
            }
        }
    <?php endif; ?>

    <?php if ($absensi->absen_masuk != null) : ?>
        <?php if (strtotime(date('H:i', time())) >= strtotime($pengaturan->jam_keluar)) : ?>
            Webcam.set({
                width: 220,
                height: 300,
                flip_horiz: true,
                image_format: 'png',
                png_quality: 100
            });
            Webcam.attach('#my_camera');

            function take_picture() {
                Webcam.snap(function(data_url) {
                    $('.image-tag').val(data_url);

                    var tag_img = '<img src="' + data_url + '"/><br><button type="submit" class="btn btn-primary stripes-btn mt-2">Kirim Absen</button>';
                    $('#result').html(tag_img);
                });

            }

            setInterval(() => {
                getLocation();
            }, 1000);

            setInterval(() => {
                var lat_2 = $('input[name=latitude]').val();
                var long_2 = $('input[name=longitude]').val();
                var hasil_jarak_km = distance(<?= $pengaturan->latitude ?>, <?= $pengaturan->longitude ?>, lat_2, long_2, 'K');
                var hasil_jarak_meter = hasil_jarak_km * 1000;
                var hasil_jarak_meter_bulat = Math.round(hasil_jarak_meter);
                $('#jarak-sekarang').html(hasil_jarak_meter_bulat);
            }, 1000);

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                }
            }

            function showPosition(position) {
                document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
                document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        // alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                        Swal.fire(
                            'Error!',
                            'Kamu harus mengizinkan Akses Lokasi!',
                            'error'
                        )
                        break;
                }
            }
        <?php endif; ?>
    <?php endif; ?>
</script>

@endsection