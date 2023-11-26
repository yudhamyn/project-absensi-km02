@extends('template.admin')
@section('content')
@include('template.sidebar.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('') }}/admin/jamkerja/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="table-excel-pdf" class="table v-middle">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kode</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jamkerja as $p)
                                        <tr>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->kode }}</td>
                                            <td>{{ $p->jam_masuk }}</td>
                                            <td>{{ $p->jam_keluar }}</td>
                                            <td>
                                                <div class="actions">
                                                    <form action="{{ url('') }}/admin/jamkerja" method="get" hidden>
                                                        <input type="text" name="jam_kerja_id" value="{{ $p->id }}" hidden>
                                                        <button style="border: none; outline: none; background: none; font-size: 16px; line-height: 16px;">
                                                            <i class="icon-refresh text-danger"></i>
                                                        </button>
                                                    </form>

                                                    <a href="javascript:void(0);" class="btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-id="{{ $p->id }}">
                                                        <i class="icon-edit1 text-info"></i>
                                                    </a>
                                                    <form action="{{ url('') }}/admin/jamkerja/{{ $p->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-hapus" style="border: none; outline: none; background: none; font-size: 16px; line-height: 16px;">
                                                            <i class="icon-x-circle text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                @if($object_jam_kerja)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Jam Kerja {{ $object_jam_kerja->nama }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($data_jam_kerja as $item)
                                        <tr>
                                            <td style="width: 10px">
                                                <div class="form-check form-check-inline" style="margin: 0px;">
                                                    <input class="form-check-input jam_kerja_pegawai" type="checkbox" id="inlineCheckbox1" {{ $item->status ? 'checked' : '' }} data-jam_kerja_id="{{ $object_jam_kerja->id }}" data-pegawai_id="{{ $item->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->nip }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('') }}/admin/jamkerja/" method="post" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jam Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: scroll;">

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" id="id" type="hidden" name="id" required>
                        <input class="form-control" id="nama" type="text" name="nama" required>
                        <div class="field-placeholder">Nama Jam Kerja <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" id="kode" type="text" name="kode" required>
                        <div class="field-placeholder">Kode Jam Kerja <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" id="jam_masuk" type="time" name="jam_masuk" required>
                        <div class="field-placeholder">Kode Jam Kerja <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" id="jam_keluar" type="time" name="jam_keluar" required>
                        <div class="field-placeholder">Kode Jam Kerja <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{!! session('pesan') !!}

<script>
    $('.jam_kerja_pegawai').click(function(e) {

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'post',
            dataType: 'JSON',
            data: {
                jam_kerja_id: e.currentTarget.dataset.jam_kerja_id,
                pegawai_id: e.currentTarget.dataset.pegawai_id,
                status: e.currentTarget.checked,
                _token: "{{ csrf_token() }}"
            },
            url: "{{ url('/admin/jamkerja/pegawai') }}",
            success: function(data) {
                $.each(data, function(id, kode, nama, jam_masuk, jam_keluar) {
                    $("#id").val(data.id);
                    $("#kode").val(data.kode);
                    $("#nama").val(data.nama);
                    $("#jam_masuk").val(data.jam_masuk);
                    $("#jam_keluar").val(data.jam_keluar);
                    $('#editForm').attr('action', "{{ url('') }}/admin/jamkerja/" + data.id);
                });
            }
        })
    })
    $('.btn-edit').click(function() {
        var id_jamkerja = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'post',
            dataType: 'JSON',
            data: {
                id_jamkerja: id_jamkerja,
                _token: "{{ csrf_token() }}"
            },
            url: "{{ url('/admin/edit_jamkerja') }}",
            success: function(data) {
                $.each(data, function(id, kode, nama, jam_masuk, jam_keluar) {
                    $("#id").val(data.id);
                    $("#kode").val(data.kode);
                    $("#nama").val(data.nama);
                    $("#jam_masuk").val(data.jam_masuk);
                    $("#jam_keluar").val(data.jam_keluar);
                    $('#editForm').attr('action', "{{ url('') }}/admin/jamkerja/" + data.id);
                });
            }
        })
    });

    function previewImg() {
        const gambar = document.querySelector('#input-foto');
        const imgPreview = document.querySelector('.foto-jamkerja');

        const filegambar = new FileReader();
        filegambar.readAsDataURL(gambar.files[0]);

        filegambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    $('#table-excel-pdf').DataTable({
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
</script>

@endsection