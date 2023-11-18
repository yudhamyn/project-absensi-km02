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
            <!-- Row start -->
            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('') }}/admin/pegawai/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table id="table-excel-pdf" class="table v-middle">
                                    <thead>
                                        <tr>
                                            <th>Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $p)
                                            <tr>
                                                <td>
                                                    <div class="media-box">
                                                        <img src="{{ url('') }}/assets/img/pegawai/{{ $p->gambar }}" class="media-avatar" alt="Customer">
                                                        <div class="media-box-body">
                                                            <a href="#">{{ $p->nama }}</a>
                                                            <p>NIP: #{{ $p->nip }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $p->jabatan->nama }}</td>
                                                <td>
                                                    @if ($p->is_active === 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Deactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $p->email }}</td>
                                                <td>
                                                    <div class="actions">
                                                        <a href="javascript:void(0);" class="btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-id="{{ $p->id }}">
                                                            <i class="icon-edit1 text-info"></i>
                                                        </a>
                                                        <form action="{{ url('') }}/admin/pegawai/{{ $p->id }}" method="post">
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
            </div>
            <!-- Row end -->

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

<!-- Modal Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('') }}/admin/pegawai/" method="post" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: scroll;">

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" id="id" type="hidden" name="id" required>
                        <input class="form-control" id="nama" type="text" name="nama" required>
                        <div class="field-placeholder">Name Pegawai <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->


                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <select class="select-single js-states" id="jenis_kelamin" name="jenis_kelamin" title="Select Product Category" data-live-search="true" required>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="field-placeholder">Jenis Kelamin <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <select class="select-single js-states select2" name="jabatan_id" title="Select Product Category" data-live-search="true" required>
                            @foreach ($jabatan as $j)
                                <option value="{{  $j->id }}">
                                    {{ $j->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="field-placeholder">Jabatan <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->


                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" type="email" id="email" name="email" required>
                        <div class="field-placeholder">Email <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <input class="form-control" type="text" id="password" name="password" required>
                        <div class="field-placeholder">Password <span class="text-danger">*</span></div>
                    </div>
                    <!-- Field wrapper end -->

                    <!-- Field wrapper start -->
                    <div class="field-wrapper">
                        <select class="form-select" id="is_active" name="is_active" title="Select Product Category" data-live-search="true" required>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        <div class="field-placeholder">Is Active <span class="text-danger">*</span></div>
                    </div>

                    <!-- Field wrapper end -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="gambar"></div>
                        </div>
                    </div>
                    <!-- Field wrapper start -->

                    <div class="field-wrapper mt-3">
                        <input class="form-control" type="file" name="gambar" id="input-foto" onchange="previewImg();" accept=".jpg, .jpeg, .png">
                        <div class="field-placeholder">Gambar</div>
                        <div class="form-text">
                            Foto Pegawai.
                        </div>
                    </div>
                    <!-- Field wrapper end -->
                    <input type="hidden" name="gambar_lama" id="gambar_lama">
                    
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
    $('.btn-edit').click(function() {
        var id_pegawai = $(this).data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'post',
            dataType: 'JSON',
            data: {
                id_pegawai: id_pegawai,
                _token: "{{ csrf_token() }}"
            },
            url: "{{ url('/admin/edit_pegawai') }}",
            success: function(data) {
                $.each(data, function(id, nip, nama, jenis_kelamin, jabatan_id, email, password, gambar, is_active, role) {
                    $("#id").val(data.id);
                    $("#nip").val(data.nip);
                    $("#nama").val(data.nama);
                    $("#jenis_kelamin").val(data.jenis_kelamin);
                    $("select[name=jabatan_id]").val(data.jabatan_id);
                    $("#email").val(data.email);
                    $("#password").val(data.password);
                    var gambar = `<img src="{{ url('') }}/assets/img/pegawai/` + data.gambar + `" class="img-thumbnail foto-pegawai" alt="Foto Pegawai" style="width: 90%;">`;
                    $(".gambar").html(gambar);
                    $("#gambar_lama").val(data.gambar);
                    $("#is_active").val(data.is_active);
                    $('#editForm').attr('action', "{{ url('') }}/admin/pegawai/" + data.id);
                });
            }
        })
    });

    function previewImg() {
        const gambar = document.querySelector('#input-foto');
        const imgPreview = document.querySelector('.foto-pegawai');

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